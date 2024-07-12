-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2024 a las 17:36:07
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consejo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxiliar`
--

CREATE TABLE `auxiliar` (
  `id_auxiliar` int(11) NOT NULL,
  `nombre_auxiliar` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dni_auxiliar` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion_auxiliar` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_auxiliar` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo_auxiliar` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones_cargo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria_afip` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cuit_cuil` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mail_auxiliar` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auxiliar`
--

INSERT INTO `auxiliar` (`id_auxiliar`, `nombre_auxiliar`, `dni_auxiliar`, `direccion_auxiliar`, `telefono_auxiliar`, `cargo_auxiliar`, `observaciones_cargo`, `categoria_afip`, `cuit_cuil`, `mail_auxiliar`) VALUES
(1, 'Miguel BolaÃ±os Perez Migues Esteban Jose', '4702523', 'Seaasasas', '515152649', 'Cocina', 'Desayuno', 'Responsable Inscripto', '262062301', 'dfedf@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `id_esc` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `link` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cuit_cuil` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_servicio` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `expediente` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `historial_legajo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `id_esc`, `fecha`, `titulo`, `link`, `cuit_cuil`, `tipo_servicio`, `estado`, `expediente`, `historial_legajo`) VALUES
(1, 2, '2024-06-06', 'addsds', 'fafa.com', '47088077', 'Polmero', 'iniciado', 'no', 'fdfdfdfd'),
(2, 2, '2024-06-05', 'addsds', 'fafa.com', '47088077', 'plomero', 'iniciado', 'no', 'fdfdfdfd'),
(3, 2, '2024-06-04', 'addsds', 'fafa.com', '47088077', 'plomero', 'iniciado', 'no', 'fdfdfdfd'),
(4, 2, '2024-06-04', 'addsds', 'fafa.com', '47088077', 'plomero', 'iniciado', 'no', 'fdfdfdfd'),
(5, 21, '2024-06-12', '1212', 'https://chatgpt.com/c/b7942346-f94f-45e8-8e83-ac4e', '21324', 'plomero', 'en eso', 'si', 'https://chatgpt.com'),
(6, 21, '2024-05-29', '1212', 'https://chatgpt.com/c/b7942346-f94f-45e8-8e83-ac4e', '21324', 'plomero', 'en eso', 'si', 'dwsdsd'),
(7, 2, '2024-06-05', 'addsds', 'fafa.com', '47088077', 'plomeroasasa', 'iniciado', 'no', 'fdfdfdfd'),
(8, 1, '2024-06-18', 'dsd', 'https://chatgpt.com/c/b7942346-f94f-45e8-8e83-ac4e', '262062301', 'plomero', '143', '123124', 'https://chatgpt.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

CREATE TABLE `escuela` (
  `id_esc` int(11) NOT NULL,
  `nombre_escuela` varchar(255) NOT NULL,
  `direccion_escuela` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `vicedirector` varchar(255) DEFAULT NULL,
  `telefono_director` varchar(20) DEFAULT NULL,
  `telefono_escuela` varchar(20) DEFAULT NULL,
  `mail_escuela` varchar(50) NOT NULL,
  `rama_escuela` varchar(50) DEFAULT NULL,
  `numero_escuela` varchar(50) DEFAULT NULL,
  `cantidad_alumnos` int(11) DEFAULT NULL,
  `fecha_fundacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`id_esc`, `nombre_escuela`, `direccion_escuela`, `director`, `vicedirector`, `telefono_director`, `telefono_escuela`, `mail_escuela`, `rama_escuela`, `numero_escuela`, `cantidad_alumnos`, `fecha_fundacion`) VALUES
(15, 'Escuela Primaria', 'Pachamama 1232232', 'Messina', 'Suma Aguerre', '2202020', '66220022', 'dsds@gmail.com', 'Primario', '5556', 143, '2024-06-27'),
(16, 'Escuela Tecnica', 'Pachamama 123', 'Messina', 'Suma Aguerre', '2202020', '2212121', 'mdsds@gmail.com', 'Secundario', '13123', 41, '2024-07-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `legajo`
--

CREATE TABLE `legajo` (
  `id_legajo` int(11) NOT NULL,
  `cuit_cuil` varchar(20) NOT NULL,
  `proveedor_auxiliar` varchar(20) NOT NULL,
  `historial_legajo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `legajo`
--

INSERT INTO `legajo` (`id_legajo`, `cuit_cuil`, `proveedor_auxiliar`, `historial_legajo`) VALUES
(1, '262062301', 'Proveedor', 'dwsdsd'),
(3, '20-20454621-5', 'Auxiliar', 'https://chatgpt.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `tipo_servicio` varchar(50) DEFAULT NULL,
  `observaciones_servicio` text DEFAULT NULL,
  `categoria_afip` varchar(50) DEFAULT NULL,
  `cuit_cuil` varchar(20) NOT NULL,
  `mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `dni`, `direccion`, `telefono`, `tipo_servicio`, `observaciones_servicio`, `categoria_afip`, `cuit_cuil`, `mail`) VALUES
(4, 'Carlos fabian tempel', '20454621', 'pistacho y cimarrÃ³n', '34567823', 'cerrajero', 'abre casas', 'tributo al mono', '20-20454621-5', 'carlosfabian@castor.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auxiliar`
--
ALTER TABLE `auxiliar`
  ADD PRIMARY KEY (`id_auxiliar`),
  ADD UNIQUE KEY `cuit_cuil` (`cuit_cuil`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`id_esc`);

--
-- Indices de la tabla `legajo`
--
ALTER TABLE `legajo`
  ADD PRIMARY KEY (`id_legajo`),
  ADD UNIQUE KEY `cuit_cuil` (`cuit_cuil`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `cuit_cuil` (`cuit_cuil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auxiliar`
--
ALTER TABLE `auxiliar`
  MODIFY `id_auxiliar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `escuela`
--
ALTER TABLE `escuela`
  MODIFY `id_esc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `legajo`
--
ALTER TABLE `legajo`
  MODIFY `id_legajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
