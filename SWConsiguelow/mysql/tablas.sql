-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2020 at 03:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2


CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL,
  `password` varchar(80) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `ciudad` varchar(12) NOT NULL,
  `codigo postal` varchar(5) NOT NULL,
  `carrito` int(15) NOT NULL,
  `tarjeta credito` int(20) NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Estructura de tabla para la tabla `productos`
--
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `idVendedor` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` decimal(4,2) NOT NULL,
  `unidades` int(10) UNSIGNED NOT NULL,
  `talla` varchar(3) NOT NULL,
  `color` varchar(12) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY (`idVendedor`) REFERENCES `usuarios`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--
/*INSERT INTO `productos` (`nombre`, `idVendedor`, `descripcion`, `precio`, `unidades`, `talla`, `color`, `categoria`) VALUES ('Cascos Sanson', 1, 'Cascos musica', '40.99', 0, 'DEF', 'Blanco', 'electronica')*/

 
CREATE TABLE `uploads` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `producto` int(11) NOT NULL,
    `name` VARCHAR(64) NOT NULL,
    `mime_type` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`producto`) REFERENCES `productos`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla `carrito`
--
/*
CREATE TABLE `carrito` (
  `idCarrito` int(10) NOT NULL,
  `idProducto` int(10) UNSIGNED NOT NULL,
  `precio` decimal(4,2) NOT NULL,
  `talla` varchar(3) NOT NULL,
  `color` varchar(12) NOT NULL,
  `unidades` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `tipo` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`tipo`, `descripcion`) VALUES
('comida', 'Categoria dedicada a comida'),
('electronica', 'Categoria dedicada a electronica'),
('ropa', 'Categoria dedicada a prendas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallespedido`
--

CREATE TABLE `detallespedido` (
  `idDetalles` int(11) NOT NULL,
  `idProducto` int(10) UNSIGNED NOT NULL,
  `nombreProducto` varchar(50) NOT NULL,
  `precio` decimal(4,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioTotal` decimal(6,2) NOT NULL,
  `talla` varchar(12) NOT NULL,
  `color` varchar(15) NOT NULL,
  `fechaPedido` date NOT NULL,
  `idPedido` int(10) UNSIGNED NOT NULL,
  `idDistribuidor` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallespedido`
--

INSERT INTO `detallespedido` (`idDetalles`, `idProducto`, `nombreProducto`, `precio`, `cantidad`, `precioTotal`, `talla`, `color`, `fechaPedido`, `idPedido`, `idDistribuidor`) VALUES
(1, 1, '', '40.99', 1, '40.99', 'DEF', 'negro', '2020-03-12', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidores`
--

CREATE TABLE `distribuidores` (
  `idDistribuidor` int(9) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `felefono` varchar(9) NOT NULL,
  `email` varchar(25) NOT NULL,
  `direccion` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `distribuidores`
--

INSERT INTO `distribuidores` (`idDistribuidor`, `nombre`, `felefono`, `email`, `direccion`) VALUES
(1, 'distribuidor1', '915555555', 'vendedor1@ucm.es', 'C/Pajaro silvestre,155');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPago` int(15) NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idPago`, `tipo`) VALUES
(1, 'tarjeta'),
(2, 'tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `numero` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `cliente` varchar(9) NOT NULL,
  `producto` int(10) UNSIGNED NOT NULL,
  `nombreProducto` varchar(50) NOT NULL,
  `idPago` int(15) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idMensajero` int(9) NOT NULL,
  `pagado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`numero`, `fecha`, `cliente`, `producto`, `nombreProducto`, `idPago`, `cantidad`, `idMensajero`, `pagado`) VALUES
(1, '2020-03-12', '50258495', 1, '', 1, 1, 1, 0);
*/
-- --------------------------------------------------------