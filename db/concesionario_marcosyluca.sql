-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 02:14:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionario_marcosyluca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidor`
--

CREATE TABLE `distribuidor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `telefono` bigint(252) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distribuidor`
--

INSERT INTO `distribuidor` (`id`, `nombre`, `telefono`, `empresa`, `img`) VALUES
(1, '  Jose Jose', 2494851356, '  Ford', '  '),
(2, 'Rigoberto Flores', 2494533658, 'Chevrolet', ''),
(3, 'Roberto Rodriguez', 2494555553, 'Mercedes Benz', ''),
(13, '  Luca Bossio', 2494623222, '  si', 'https://e0.pxfuel.com/wallpapers/607/127/desktop-wallpaper-bumblebee-transformers.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contrasenia` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`) VALUES
(1, 'webadmin', '$2y$10$N0cPJxPjD2kU8PBt1HtwGO4A4JGL635BbK4vE6XxqVlb5WZn46yGW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(250) NOT NULL,
  `modelo` varchar(250) NOT NULL,
  `año` int(11) NOT NULL,
  `puertas` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `id_distribuidor` int(11) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `marca`, `modelo`, `año`, `puertas`, `hp`, `precio`, `id_distribuidor`, `categoria`, `img`) VALUES
(33, 'BMW', 'X5', 2021, 5, 335, 60000, 13, ' SUV', 'https://www.pngmart.com/files/3/BMW-X5-PNG-File.png'),
(34, 'Audi', 'A4', 2018, 4, 252, 28000, 2, 'Sedán', 'https://www.motortrend.com/uploads/sites/10/2015/11/2014-audi-a4-2-tdi-sedan-angular-front.png'),
(35, 'Mercedes-Benz', 'C-Class', 2019, 4, 255, 32000, 3, 'Sedán', 'https://www.motortrend.com/uploads/sites/10/2016/11/2017-mercedes-benz-c-class-300-sport-sedan-angular-front.png'),
(38, 'Volkswagen', 'Golf', 2017, 4, 170, 20000, 1, 'Hatchback', 'https://th.bing.com/th/id/R.c8ca6f11253dc5dbc23e5c75905870c3?rik=KeLyN0VBY57BwQ&pid=ImgRaw&r=0'),
(41, 'Chevrolet', 'Corsa', 1221, 2, 2, 2, 1, 'lujo', 'https://th.bing.com/th/id/R.9b265357f335c753da77d711389b8703?rik=b3Z4u87LjrHcbA&riu=http%3a%2f%2fwww.hongliyangzhi.com%2fmanufacturers%2fchevrolet%2fchevrolet-corsa%2fchevrolet-corsa-wind-2004%2fchevrolet-corsa-wind-2004-1.jpg&ehk=Cg5QSuryj3G6%2fj0mbf658Qnv6xR65wccHUb%2bSStETzo%3d&risl=&pid=ImgRaw&r=0'),
(42, 'Toyota', 'Corolla', 2021, 4, 130, 20000, 1, 'Sedán', 'https://www.kindpng.com/picc/m/13-136481_toyota-corolla-2011-hd-png-download.png'),
(43, 'Honda', 'Civic', 2020, 4, 158, 22000, 2, 'Sedán', 'https://di-uploads-pod3.s3.amazonaws.com/silkohonda/uploads/2016/09/2016-Honda-Civic.png'),
(44, 'Ford', 'Mustang', 2019, 2, 450, 35000, 1, 'Deportivo', 'https://pngimg.com/uploads/mustang/mustang_PNG12.png'),
(45, 'Chevrolet', 'Silverado', 2022, 4, 355, 40000, 3, 'Camioneta', 'https://purepng.com/public/uploads/medium/purepng.com-red-chevrolet-silverado-high-desert-carcarvehicletransportchevrolet-961524651885erwpa.png'),
(50, 'Nissan', 'Leaf', 2021, 5, 147, 30000, 1, 'Eléctrico', 'https://www-europe.nissan-cdn.net/content/dam/Nissan/nissan_europe/vehicles/2019_LEAF_Full_PES/Range_Charging/2019-nissan-leaf-19tdieulhdpace013-thumbnail.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `distribuidor`
--
ALTER TABLE `distribuidor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distribuidor` (`id_distribuidor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `distribuidor`
--
ALTER TABLE `distribuidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`id_distribuidor`) REFERENCES `distribuidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
