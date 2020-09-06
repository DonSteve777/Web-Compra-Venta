/*
  Recuerda que deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.*/
  USE `consiguelow`;
  /*
  La contraseña para adminuser y onlyuser usuarios es '12345' 
  pasword_hash('$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', PASSWORD_DEFAULT) == '12345'
  Para otrouser es 'contrasenia'
*/
INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `nombreUsuario`, `password`, `direccion`, `email`, `telefono`, `ciudad`, `codigo postal`, `tarjeta credito`)
 VALUES ('1', '52906370E', 'Álvaro abad', 'adminuser', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 'calle falsa 123', 'correo@gmail.com', '691585787', 'Madrid', '28022', '1111222233334444');
INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `nombreUsuario`, `password`, `direccion`, `email`, `telefono`, `ciudad`, `codigo postal`, `tarjeta credito`)
 VALUES ('2', '62906370E', 'Nestor Martínez', 'onlyuser', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 'calle verdadera 321', 'nestor@gmail.com', '659529598', 'Madrid', '25022', '1111222233334444');
INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `nombreUsuario`, `password`, `direccion`, `email`, `telefono`, `ciudad`, `codigo postal`, `tarjeta credito`)
 VALUES ('3', '72906370E', 'Otro Pérez', 'otroruser', '$2y$10$hZ9Q9EyjZ/scGOXoA8mMcO8C6/4/LOiyhCyV8QqHvtNwNKDqjKKsS', 'calle 13', 'otro21@gmail.com', '917473720', 'Cuenca', '22022', '1111222233334444');

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'user'),
(2, 'admin');

INSERT INTO `rolesUsuario` (`usuario`, `rol`) VALUES
(1, 1),
(1, 2),
(3, 1),
(2, 1);

/*se inserta en php si no existe una catogoría llamada 'sin categoría', que no se si habría que eliminar por optimización->REVISAR*/
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('1', ' sin categoria', 'sin categoria');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('2', 'categoria2', 'descripcion2');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('3', 'categoria3', 'descripcion 3');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('4', 'categoria4', 'descripcion 4');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('5', 'categoria5', 'descripcion 5');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('6', 'categoria6', 'descripcion 6');

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('7', 'categoria7', 'descripcion descripcion');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('8', 'categoria8', 'descripcion 4descripcion');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('9', 'categoria9', 'descripcion 5descripcion');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('10', 'categoria10', 'descripcion 6descripcion');

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('11', 'categoria11', 'descripcion descripcion3');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('12', 'categoria12', 'descripcion descripcion4');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('13', 'categoria13', 'descripcion descripcion5');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('14', 'categoria14', 'descripcion descripcion6');

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('15', 'categoria15', 'descripcion descripcion3');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('116', 'categoria16', 'descripcion descripcion4');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('17', 'categoria17', 'descripcion descripcion5');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('18', 'categoria18', 'descripcion descripciondescripcion6');

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('19', 'categoria19', 'descripcion descripciondescripcion3');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('20', 'categoria20', 'descripcion descripcion descripcion4');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('21', 'categoria21', 'descripcion descripcion descripcion5');
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES ('22', 'categoria22', 'descripcion descripcion6');

/*productos subidos por adminuser */
INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('1', 'producto1', '1', 'descripcion 1', '20.00', '1', '1', '1');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('3', 'producto3', '1', 'descripcion 3', '20.00', '3', '3',  '1');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('5', 'producto5', '1', 'descripcion 5', '20.00', '5', '5', '3');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('7', 'producto7', '1', 'descripcion  descripcion descripcion5', '20.00', '5', '0', '2');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('8', 'producto8', '1', 'descripcion  descripcion descripcion5', '20.00', '5', '0', '4');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('18', 'producto18', '1', 'descripcion  descripcion descripcion5', '200.00', '2', '4', '10');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('19', 'producto19', '1', 'descripcion  descripcion descripcion5', '230.00', '2', '4', '11');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('20', 'producto20', '1', 'descripcion  descripcion descripcion5', '200.00', '2', '4', '12');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('21', 'producto21', '1', 'descripcion  descripcion descripcion5', '200.00', '2', '4', '13');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,`categoria`) 
VALUES ('22', 'producto22', '1', 'descripcion  descripcion descripcion5', '200.00', '2', '4', '14');

/*productos subidos por onlyuser */
INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('4', 'producto4', '2', 'descripcion 4', '40.00', '3', '4', '2');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('6', 'producto6', '2', 'descripcion 6', '60.00', '3', '0', '4');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('9', 'producto9', '2', 'descripcion 6descripciondescripcion', '60.00', '3', '0', '4');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('10', 'producto10', '2', 'descripcion descripciondescripcion6', '60.00', '3', '0', '5');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('11', 'producto11', '2', 'descripcion  descripcion6', '60.00', '3', '0', '4');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('23', 'producto23', '2', 'descripcion  descripcion6descripcion6descripcion6descripcion6', '60.00', '3', '0', '15');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('24', 'producto24', '2', 'descripcion  descripcion6descripcion6descripcion6descripcion6', '60.00', '3', '0', '16');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('25', 'producto25', '2', 'descripcion  descripcion6descripcion6descripcion6descripcion6', '60.00', '3', '0', '1');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('26', 'producto26', '2', 'descripcion  descripcion6descripcion6descripcion6descripcion6', '6990.99', '3', '0', '1');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `categoria`) 
VALUES ('27', 'producto27', '2', 'descripcion  descripcion6descripcion6descripcion6descripcion6', '60.00', '3', '0', '1');

/*productos subidos por otrouser*/
INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('12', 'producto12', '3', 'descripcion 4', '40.00', '3', '4', '8');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('13', 'producto13', '3', 'descripcion 4', '40.00', '3', '4', '9');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('14', 'producto14', '3', 'descripcion 4', '40.00', '3', '4', '10');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('15', 'producto15', '3', 'descripcion 4', '40.00', '3', '4', '11');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('16', 'producto16', '3', 'descripcion 4', '40.00', '3', '4', '12');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('17', 'producto17', '3', 'descripcion 4', '40.00', '3', '4', '13');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('28', 'producto28', '3', 'descripcion 4', '40.00', '3', '4', '1');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('29', 'producto29', '3', 'descripcion 4', '40.00', '3', '4', '1');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('30', 'producto29', '3', 'descripcion 4', '40.00', '3', '4', '1');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('31', 'producto31', '3', 'descripcion 4', '2.00', '3', '4', '1');

INSERT INTO `productos` (`id`, `nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`,  `categoria`) 
VALUES ('32', 'producto32', '3', 'descripcion 4', '0.50', '3', '4', '1');



INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('1', '1', 'imagen1.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('2', '2', 'imagen2.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('3', '3', 'imagen3.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('4', '4', 'imagen4.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('5', '5', 'imagen5.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('6', '6', 'imagen6.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('7', '7', 'imagen7.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('8', '8', 'imagen8.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('9', '9', 'imagen9.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('10', '10', 'imagen10.tmp', 'image/jpeg');

INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('11', '11', 'imagen11.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('12', '12', 'imagen12.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('13', '13', 'imagen13.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('14', '14', 'imagen14.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('15', '15', 'imagen15.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('16', '16', 'imagen16.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('17', '17', 'imagen17.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('18', '18', 'imagen18.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('19', '19', 'imagen19.tmp', 'image/jpeg');

INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('20', '20', 'imagen20.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('21', '21', 'imagen21.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('22', '22', 'imagen22.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('23', '23', 'imagen23.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('24', '24', 'imagen24.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('25', '25', 'imagen25.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('26', '26', 'imagen26.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('27', '27', 'imagen27.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('28', '28', 'imagen28.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('29', '29', 'imagen29.tmp', 'image/jpeg');


INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('30', '30', 'imagen30.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('31', '31', 'imagen31.tmp', 'image/jpeg');
INSERT INTO `uploads` (`id`, `producto`, `name`, `mime_type`) VALUES ('32', '32', 'imagen32.tmp', 'image/jpeg');












