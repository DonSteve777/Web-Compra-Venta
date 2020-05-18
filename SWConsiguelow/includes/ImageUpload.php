<?php
namespace es\fdi\ucm\aw;
use es\fdi\ucm\aw\Imagen;


Class ImageUpload {

    private $folder = F_PATH;
    private $f_size = F_SIZE;
	private $files = array();
	private $productId;
    
    public function __construct($files, $productId){
		$this->files = $files;
		$this->$productId = $productId;
    }

    private function check_img_size($tmpname){
		$size_conf = substr(F_SIZE, -1);
		$max_size = (int)substr(F_SIZE, 0, -1);

		switch($size_conf){
			case 'k':
			case 'K':
				$max_size *= 1024;
				break;
			case 'm':
			case 'M':
				$max_size *= 1024;
				$max_size *= 1024;
				break;
			default:
				$max_size = 1024000;
		}

		if(filesize($tmpname) > $max_size){
			return false;
		} else {
			return true;
		}
    }

    	/* Checks the true mime type of the given file */
	private function check_img_mime($tmpname){
		$finfo = finfo_open( FILEINFO_MIME_TYPE );
		$mtype = finfo_file( $finfo, $tmpname );
		$this->mtype = $mtype;
		if(strpos($mtype, 'image/') === 0){
            finfo_close( $finfo );
			return true;
		} else {
            finfo_close( $finfo );
			return false;
		}
		
	}
    
    /* Handles the uploading of images */
	public  function uploadImages(){
        $result = array();
        $target = 'C:\xampp\htdocs\gitLocal\SWConsiguelo\SWConsiguelow\data\productos\\';
       /* foreach($this->files['imagen']['tmp_name'] as $value)
        {*/
            $file_name = $this->files['imagen']['name'];//[$key];
            $file_size =$this->files['imagen']['size'];//[$key];
            $file_tmp =$this->files['imagen']['tmp_name'];//[$key];
            $file_type=$this->files['imagen']['type'];//[$key];  

            // Checks the true MIME type of the file
            if($this->check_img_mime($file_tmp)){
                // Checks the size of the the image
                if($this->check_img_size($file_tmp)){
					$src = $target.time().$file_name;
					move_uploaded_file($file_tmp, $src );
					$imagen = new Imagen($productId, $file_name, $src, $file_type); 
					$imagen = Imagen::inserta($imagen);	//setea el id
                }
            }
	   return $result;
    }


}