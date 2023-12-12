-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2023 a las 23:04:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calculadora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre_categoria`) VALUES
(1, 'compras'),
(2, 'combustibles y lubricantes '),
(3, 'Mantenimiento de equipo de transporte'),
(4, 'Seguros y fianzas'),
(5, 'Cuota IMMS RCV e INFONAVIT'),
(6, 'Diversos'),
(7, 'Depreciaciones'),
(8, 'Comisiones bancarias'),
(9, 'Saldos y salarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contadores`
--

CREATE TABLE `contadores` (
  `cedula_profesional` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `fecha_titulacion` date DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contadores`
--

INSERT INTO `contadores` (`cedula_profesional`, `nombre`, `apellidos`, `correo`, `telefono`, `rfc`, `especialidad`, `fecha_titulacion`, `fecha_registro`) VALUES
('0129384765', 'Gprueba', 'Mprueba', 'Gprueba@gmail.com', '7561264856', 'MESG010426', 'contador público', '2023-12-14', '2023-12-11 15:49:11'),
('Mpruba2', 'Mpruba2', 'Mprueba2', 'Mprueba2@gmail.com', '7891276512', 'MPRUE2134', 'Contador', '2019-09-30', '2023-12-11 15:49:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contribuyentes`
--

CREATE TABLE `contribuyentes` (
  `rfc_contribuyente` varchar(13) NOT NULL,
  `curp_contribuyente` varchar(18) DEFAULT NULL,
  `nombre_contribuyente` varchar(100) NOT NULL,
  `paterno_contribuyente` varchar(50) NOT NULL,
  `materno_contibuyente` varchar(50) NOT NULL,
  `direccion_contribuyente` varchar(255) DEFAULT NULL,
  `telefono_contribuyente` varchar(15) DEFAULT NULL,
  `fecha_registro_contribuyente` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contribuyentes`
--

INSERT INTO `contribuyentes` (`rfc_contribuyente`, `curp_contribuyente`, `nombre_contribuyente`, `paterno_contribuyente`, `materno_contibuyente`, `direccion_contribuyente`, `telefono_contribuyente`, `fecha_registro_contribuyente`) VALUES
('CNTRY0123', 'CNTRY0123FRGLL', 'Contribuyente1', 'PaternoCont1', 'MaternoCont1', 'Calle No. 1 Contribuyente', '7561264852', '2023-12-11 18:07:30'),
('CTBYNT0202', 'CTBYNT0202MFGRLL', 'Contribuyente', 'Cont2Paterno', 'Cont2Materno', 'Calle No.2 Segundo C', '7561287654', '2023-12-11 18:07:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_mensuales`
--

CREATE TABLE `gastos_mensuales` (
  `gasto_id` int(11) NOT NULL,
  `rfc_contribuyente` varchar(13) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gastos_mensuales`
--

INSERT INTO `gastos_mensuales` (`gasto_id`, `rfc_contribuyente`, `mes`, `anio`, `monto`) VALUES
(1, 'CNTRY0123', 1, 2023, 2100.00),
(2, 'CTBYNT0202', 2, 2023, 36000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos_deducciones`
--

CREATE TABLE `ingresos_deducciones` (
  `registro_id` int(11) NOT NULL,
  `rfc_contribuyente` varchar(13) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `es_ingreso` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresos_deducciones`
--

INSERT INTO `ingresos_deducciones` (`registro_id`, `rfc_contribuyente`, `mes`, `anio`, `categoria_id`, `monto`, `es_ingreso`) VALUES
(1, 'CNTRY0123', 1, 2023, 2, 1000.00, 1),
(2, 'CNTRY0123', 2, 2023, 8, 3000.00, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_contadores_contribuyentes`
--

CREATE TABLE `relacion_contadores_contribuyentes` (
  `relacion_id` int(11) NOT NULL,
  `cedula_contador` varchar(20) DEFAULT NULL,
  `rfc_contribuyente` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `relacion_contadores_contribuyentes`
--

INSERT INTO `relacion_contadores_contribuyentes` (`relacion_id`, `cedula_contador`, `rfc_contribuyente`) VALUES
(1, '0129384765', 'CNTRY0123'),
(2, 'Mpruba2', 'CTBYNT0202');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre_rol`) VALUES
(11, 'Administrador'),
(22, 'Contador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contador_cedula` varchar(20) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `username`, `password`, `contador_cedula`, `rol_id`) VALUES
(1, 'contador 1', '1234', '0129384765', 11),
(2, 'Contador2', '7561', 'Mpruba2', 22);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `contadores`
--
ALTER TABLE `contadores`
  ADD PRIMARY KEY (`cedula_profesional`),
  ADD UNIQUE KEY `rfc` (`rfc`);

--
-- Indices de la tabla `contribuyentes`
--
ALTER TABLE `contribuyentes`
  ADD PRIMARY KEY (`rfc_contribuyente`),
  ADD UNIQUE KEY `curp_contribuyente` (`curp_contribuyente`);

--
-- Indices de la tabla `gastos_mensuales`
--
ALTER TABLE `gastos_mensuales`
  ADD PRIMARY KEY (`gasto_id`),
  ADD KEY `rfc_contribuyente` (`rfc_contribuyente`);

--
-- Indices de la tabla `ingresos_deducciones`
--
ALTER TABLE `ingresos_deducciones`
  ADD PRIMARY KEY (`registro_id`),
  ADD KEY `rfc_contribuyente` (`rfc_contribuyente`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `relacion_contadores_contribuyentes`
--
ALTER TABLE `relacion_contadores_contribuyentes`
  ADD PRIMARY KEY (`relacion_id`),
  ADD KEY `cedula_contador` (`cedula_contador`),
  ADD KEY `rfc_contribuyente` (`rfc_contribuyente`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `contador_cedula` (`contador_cedula`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gastos_mensuales`
--
ALTER TABLE `gastos_mensuales`
  ADD CONSTRAINT `gastos_mensuales_ibfk_1` FOREIGN KEY (`rfc_contribuyente`) REFERENCES `contribuyentes` (`rfc_contribuyente`);

--
-- Filtros para la tabla `ingresos_deducciones`
--
ALTER TABLE `ingresos_deducciones`
  ADD CONSTRAINT `ingresos_deducciones_ibfk_1` FOREIGN KEY (`rfc_contribuyente`) REFERENCES `contribuyentes` (`rfc_contribuyente`),
  ADD CONSTRAINT `ingresos_deducciones_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`);

--
-- Filtros para la tabla `relacion_contadores_contribuyentes`
--
ALTER TABLE `relacion_contadores_contribuyentes`
  ADD CONSTRAINT `relacion_contadores_contribuyentes_ibfk_1` FOREIGN KEY (`cedula_contador`) REFERENCES `contadores` (`cedula_profesional`),
  ADD CONSTRAINT `relacion_contadores_contribuyentes_ibfk_2` FOREIGN KEY (`rfc_contribuyente`) REFERENCES `contribuyentes` (`rfc_contribuyente`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`contador_cedula`) REFERENCES `contadores` (`cedula_profesional`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
