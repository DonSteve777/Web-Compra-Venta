<?php
namespace es\fdi\ucm\aw;

/**
 * Clase de  de gestiÃ³n de formularios.
 *
 * GestiÃ³n de token CSRF estÃ¡ basada en: https://www.owasp.org/index.php/PHP_CSRF_Guard
 */
class Form
{

  /**
   * Sufijo para el nombre del parÃ¡metro de la sesiÃ³n del usuario donde se almacena el token CSRF.
   */
  const CSRF_PARAM = 'csrf';

  /**
   * Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y como parÃ¡metro a comprobar para verificar que el usuario ha enviado el formulario.
   */
  private $formId;

  private $ajax;

  /**
   * URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesarÃ¡ el envÃ­o del formulario.
   */
  private $action;

  /**
   * Valor del atributo "class" de la etiqueta &lt;form&gt; asociada al formulario. Si este parÃ¡metro incluye la cadena "nocsrf" no se generÃ¡ el token CSRF para este formulario.
   */
  private $classAtt;

  /**
   * Valor del parÃ¡metro enctype del formulario.
   */
  private $enctype;

  /**
   * Se encarga de orquestar todo el proceso de creaciÃ³n y procesamiento de un formulario web.
   *
   * @param string $formId Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y como parÃ¡metro a comprobar para verificar que el usuario ha enviado el formulario.
   *
   * @param string $action (opcional) URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesarÃ¡ el envÃ­o del formulario. Por defecto la URL es $_SERVER['PHP_SELF']
   *
   * @param string $class (opcional) Valor del atributo "class" de la etiqueta &lt;form&gt; asociada al formulario. Si este parÃ¡metro incluye la cadena "nocsrf" no se generÃ¡ el token CSRF para este formulario.
   *
   * @param string enctype (opcional) Valor del parÃ¡metro enctype del formulario.
   */
  public function __construct($formId, $opciones = array() )
  {
    $this->formId = $formId;

    $opcionesPorDefecto = array( 'ajax' => false, 'action' => null, 'class' => null, 'enctype' => null );
    $opciones = array_merge($opcionesPorDefecto, $opciones);

    $this->ajax     = $opciones['ajax'];
    $this->action   = $opciones['action'];
    $this->classAtt = $opciones['class'];
    $this->enctype  = $opciones['enctype'];
    
    if ( !$this->action ) {
      $app = Aplicacion::getSingleton();
      $this->action = htmlspecialchars($_SERVER['REQUEST_URI']);
      $this->action = $app->resuelve($this->action);
    }
  }
  
  public function gestiona()
  {
    if ( ! $this->formularioEnviado($_POST) ) {
      return $this->generaFormulario();
    } else {
      // Valida el token CSRF si es necesario (hay un token en la sesiÃ³n asociada al formulario)
      $tokenRecibido = $_POST['CSRFToken'] ?? FALSE;
      
      if ( ($errores = $this->csrfguard_ValidateToken($this->formId, $tokenRecibido)) !== TRUE ) { 
          if ( ! $this->ajax ) {
            return $this->generaFormulario($errores, $_POST);
          } else {
            return $this->generaHtmlErrores($errores);
          }
      } else  {
        $result = $this->procesaFormulario($_POST);
        if ( is_array($result) ) {
          // Error al procesar el formulario, volvemos a mostrarlo
          if ( ! $this->ajax ) {
            return $this->generaFormulario($result, $_POST);
          } else {
            return $this->generaHtmlErrores($result);
          }
        } else {
          if ( ! $this->ajax ) {
            header('Location: '.$result);
            //header('Location: '.'index.php');
          } else {
            return $result;
          }
        }
      }
    }  
  }

  /**
   * Devuelve un <code>string</code> con el HTML necesario para presentar los campos del formulario. Es necesario asegurarse que como parte del envÃ­o se envÃ­a un parÃ¡metro con nombre <code$formId</code> (i.e. utilizado como valor del atributo name del botÃ³n de envÃ­o del formulario).
   */
  protected function generaCamposFormulario ($datos)
  {
    return '';
  }

  /**
   * Procesa los datos del formulario.
   */
  protected function procesaFormulario($datos)
  {

  }

  /**
   * FunciÃ³n que verifica si el usuario ha enviado el formulario. Comprueba si existe el parÃ¡metro <code>$formId</code> en <code>$params</code>.
   *
   * @param array $params Array que contiene los datos recibidos en el envÃ­o formulario.
   *
   * @return boolean Devuelve <code>TRUE</code> si <code>$formId</code> existe como clave en <code>$params</code>
   */
  private function formularioEnviado(&$params)
  {
    
    //echo  ($params['action'] ?? '') == $this->formId;
    return ($params['action'] ?? '') == $this->formId;
  } 

  /**
   * FunciÃ³n que genera el HTML necesario para el formulario.
   *
   *
   * @param array $errores (opcional) Array con los mensajes de error de validaciÃ³n y/o procesamiento del formulario.
   *
   * @param array $datos (opcional) Array con los valores por defecto de los campos del formulario.
   */
  private function generaFormulario($errores = array(), &$datos = array())
  {

    $html= $this->generaListaErrores($errores);

    $html .= '<form method="POST" action="'.$this->action.'" id="'.$this->formId.'"';
    if ( $this->classAtt ) {
      $html .= ' class="'.$this->classAtt.'"';
    }
    if ( $this->enctype ) {
      $html .= ' enctype="'.$this->enctype.'"';
    }
    $html .=' >';
    
    // Se genera el token CSRF si el usuario no solicita explÃ­citamente lo contrario.
    if ( ! $this->classAtt || strpos($this->classAtt, 'nocsrf') === false ) {
      $tokenValue = $this->csrfguard_GenerateToken($this->formId);
      $html .= '<input type="hidden" name="CSRFToken" value="'.$tokenValue.'" />';
    }

    $html .= '<input type="hidden" name="action" value="'.$this->formId.'" />';
    
    $html .= $this->generaCamposFormulario($datos);
    $html .= '</form>';
    return $html;
  }

  private function generaListaErrores($errores)
  {
    $html='';
    $numErrores = count($errores);
    if (  $numErrores == 1 ) {
      $html .= "<ul><li>".$errores[0]."</li></ul>";
    } else if ( $numErrores > 1 ) {
      $html .= "<ul><li>";
      $html .= implode("</li><li>", $errores);
      $html .= "</li></ul>";
    }
    return $html;
  }

  private function csrfguard_GenerateToken($formId)
  {
    if ( ! isset($_SESSION) ) {
      throw new Exception('La sesiÃ³n del usuario no estÃ¡ definida.');
    }
    
    if ( function_exists('hash_algos') && in_array('sha512', hash_algos()) ) {
      $token = hash('sha512', mt_rand(0, mt_getrandmax()));
    } else {
      $token=' ';
      for ($i=0;$i<128;++$i) {
        $r=mt_rand(0,35);
        if ($r<26){
          $c=chr(ord('a')+$r);
        } else{ 
          $c=chr(ord('0')+$r-26);
        } 
        $token.=$c;
      }
    }

    $_SESSION[$formId.'_'.self::CSRF_PARAM]=$token;

    return $token;
  }

  private function csrfguard_ValidateToken($formId, $tokenRecibido)
  {
    if ( ! isset($_SESSION) ) {
      throw new Exception('La sesiÃ³n del usuario no estÃ¡ definida.');
    }
    
    $result = TRUE;
    
    if ( isset($_SESSION[$formId.'_'.self::CSRF_PARAM]) ) {
      if ( $_SESSION[$formId.'_'.self::CSRF_PARAM] !== $tokenRecibido ) {
        $result = array();
        $result[] = 'Has enviado el formulario dos veces';
      }
      $_SESSION[$formId.'_'.self::CSRF_PARAM] = ' ';
      unset($_SESSION[$formId.'_'.self::CSRF_PARAM]);
    } else {
      $result = array();
      $result[] = 'Formulario no vÃ¡lido';
    }
      return $result;
  }
}