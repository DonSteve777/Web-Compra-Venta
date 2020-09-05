/*
  Recuerda que deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.*/
  USE `consiguelow`;
  /*
  La contraseña para ambos usuarios es '12345' 
  pasword_hash('$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', PASSWORD_DEFAULT) == '12345'
*/
INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `nombreUsuario`, `password`, `direccion`, `email`, `telefono`, `ciudad`, `codigo postal`, `tarjeta credito`) VALUES ('1', '52906370E', 'alvaro', 'alvarouser', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 'calle falsa 123', 'correo@gmail.com', '123123123', 'Madrid', '28022', '123123');
INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `nombreUsuario`, `password`, `direccion`, `email`, `telefono`, `ciudad`, `codigo postal`, `tarjeta credito`) VALUES ('2', '62906370E', 'nestor', 'nestoruser', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 'calle verdadera 321', 'nestor@gmail.com', '12312313', 'Madrid', '28022', '123123');

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'user'),
(2, 'admin');

INSERT INTO `rolesUsuario` (`usuario`, `rol`) VALUES
(1, 1),
(1, 2),
(2, 1);

/*se inserta en php si no existe una catogoría llamada 'sin categoría', que no se si habría que eliminar por optimización->REVISAR*/
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('1', ' sin categoria', 'sin categoria');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('2', 'categoria2', 'descripcion2');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('3', 'categoria3', 'descripcion 3');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('4', 'categoria4', 'descripcion 4');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('5', 'categoria5', 'descripcion 5');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('6', 'categoria6', 'descripcion 6');
/*
categoria 1: productos 1 y 3
categoria 2: producto 4
categoria 3: producto 2 y 5
categoria 4: producto 6
categoria 5: --
categoria 6: --
*/
INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('1', 'producto1', '1', 'descripcion 1', '20.00', '1', '1', '1');
INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('2', 'producto2', '2', 'descripcion 2', '20.00', '3', '2', '3');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('3', 'producto3', '1', 'descripcion 3', '20.00', '3', '3',  '1');
INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('4', 'producto4', '2', 'descripcion 4', '40.00', '3', '4', '2');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('5', 'producto5', '1', 'descripcion 5', '20.00', '5', '5', '3');
INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('6', 'producto6', '2', 'descripcion 6', '60.00', '3', '0', '4');
/*vendedores
  alvarouser: producto 1, 3 y 5
  nestoruser: producto 2, 4, y 6
*/

INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('4', '1', 'imagen1.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('5', '2', 'imagen2.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('6', '3', 'imagen3.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('12', '4', 'imagen4.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('13', '5', 'imagen5.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('14', '6', 'imagen6.tmp', 'image/jpeg');








