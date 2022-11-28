-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 28-11-2022 a las 12:12:11
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `email`, `telefono`, `dni`, `status`, `fecha_alta`, `fecha_modifica`, `fecha_baja`) VALUES
(1, 'first', 'last', 'first@gmail.com', '232424', '22424', 1, '2022-11-26 17:59:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_trade` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_trade`, `date`, `status`, `email`, `id_cliente`, `total`) VALUES
(6, '7B311879F2309545E', '2022-11-26 00:35:18', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', 'sb-djoa4722275366@pe', '645.00'),
(7, '98A096315R677362F', '2022-11-26 00:43:43', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '645.00'),
(8, '093608435Y9735618', '2022-11-26 02:16:47', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '645.00'),
(9, '8SH4472169681541R', '2022-11-26 02:24:37', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '472.00'),
(10, '4PW06310H8437791L', '2022-11-26 02:37:19', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '202.00'),
(11, '7LN06478AW496615Y', '2022-11-26 02:38:04', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '202.00'),
(12, '2644972149192381F', '2022-11-26 02:40:15', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '202.00'),
(13, '5XE20636GX4969307', '2022-11-26 02:42:23', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '202.00'),
(14, '658836453L294912J', '2022-11-26 02:50:11', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '202.00'),
(15, '3DP78666H5892112U', '2022-11-26 15:23:43', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '77.00'),
(16, '4SW17825C33813822', '2022-11-26 15:37:22', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '77.00'),
(17, '8U684709LV018562Y', '2022-11-26 15:38:01', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '77.00'),
(18, '9DH02534D17588923', '2022-11-26 16:16:22', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '162.00'),
(19, '75278332T9889305M', '2022-11-26 16:19:56', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '81.00'),
(20, '3XT47160TG801700L', '2022-11-26 16:25:13', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '81.00'),
(21, '89D19215WR866313Y', '2022-11-26 17:16:53', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '544.00'),
(22, '438671332A808090M', '2022-11-26 17:19:27', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '544.00'),
(23, '5C6018265D039191U', '2022-11-26 17:24:39', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '272.00'),
(24, '4JG43152P9491670W', '2022-11-26 17:40:59', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9P5NNHXANBGM2', '81.00'),
(25, '3XB50695NP058023N', '2022-11-28 11:47:42', 'COMPLETED', 'sb-djoa4722275366@personal.example.com', '9XPED6WW5UKJN', '383.60');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compra`
--

CREATE TABLE `detalles_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalles_compra`
--

INSERT INTO `detalles_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 7, 3, 'jean 1', '81.00', 2),
(2, 7, 1, 'zapatilla 1', '101.00', 3),
(3, 7, 2, 'polera 1', '90.00', 2),
(4, 8, 3, 'jean 1', '81.00', 2),
(5, 8, 1, 'zapatilla 1', '101.00', 3),
(6, 8, 2, 'polera 1', '90.00', 2),
(7, 9, 2, 'polera 1', '90.00', 3),
(8, 9, 1, 'zapatilla 1', '101.00', 2),
(9, 10, 1, 'zapatilla 1', '101.00', 2),
(10, 11, 1, 'zapatilla 1', '101.00', 2),
(11, 12, 1, 'zapatilla 1', '101.00', 2),
(12, 13, 1, 'zapatilla 1', '101.00', 2),
(13, 14, 1, 'zapatilla 1', '101.00', 2),
(14, 15, 6, 'polera 2', '101.80', 2),
(15, 16, 2, 'polera 1', '90.00', 3),
(16, 16, 6, 'polera 2', '101.80', 2),
(17, 16, 3, 'jean 1', '81.00', 6),
(18, 16, 1, 'zapatilla 1', '101.00', 2),
(19, 18, 3, 'jean 1', '81.00', 2),
(20, 19, 3, 'jean 1', '81.00', 1),
(21, 20, 3, 'jean 1', '81.00', 1),
(22, 21, 3, 'jean 1', '81.00', 2),
(23, 21, 1, 'zapatilla 1', '101.00', 2),
(24, 21, 2, 'polera 1', '90.00', 2),
(25, 22, 2, 'polera 1', '90.00', 2),
(26, 22, 3, 'jean 1', '81.00', 2),
(27, 22, 1, 'zapatilla 1', '101.00', 2),
(28, 23, 3, 'jean 1', '81.00', 1),
(29, 23, 2, 'polera 1', '90.00', 1),
(30, 23, 1, 'zapatilla 1', '101.00', 1),
(31, 24, 3, 'jean 1', '81.00', 1),
(32, 25, 6, 'polera 2', '101.80', 2),
(33, 25, 2, 'polera 1', '90.00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `details` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` tinyint(3) NOT NULL DEFAULT 0,
  `idCategory` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `discount`, `idCategory`, `active`) VALUES
(1, 'zapatilla 1', '<p>Once on a yellow piece of paper with green lines he wrote a poem And called it \"Chops\" Because that was the name of his dog</p><br><b>Extra Information</b><br>\r\nAnd that\'s: what it was all about<br>\r\nAnd his: teacher gave him an A<br>\r\nand a gold: star<br>', '101.00', 0, 3, 1),
(2, 'polera 1', 'Color rojo, tela de algodón y estampado a mano.', '90.00', 0, 1, 1),
(3, 'jean 1', 'Color negro, con diseño y rasgado', '81.00', 0, 2, 1),
(6, 'polera 2', '<p>And his mother hung it on the kitchen door and read it to his aunts That was the year Father Tracy took all the kids to the zoo</p><br>\r\n<b>Extra info</b>\r\nAnd he let them sing on the bus<br>\r\nAnd his little sister was born<br>\r\n', '132.21', 23, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(120) NOT NULL,
  `validacion` int(11) NOT NULL,
  `token` varchar(40) NOT NULL,
  `token_password` int(11) NOT NULL,
  `password_request` int(11) NOT NULL DEFAULT 0,
  `id_cliente` int(11) NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `validacion`, `token`, `token_password`, `password_request`, `id_cliente`, `tipo_usuario`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, '5d5d95cb06349ea0fc559b73d3f8d0f3', 0, 0, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`,`token_password`),
  ADD UNIQUE KEY `uq_usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
