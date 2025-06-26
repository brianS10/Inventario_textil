-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2025 a las 06:02:51
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
-- Base de datos: `inventario_textil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rollos`
--

CREATE TABLE `rollos` (
  `id` int(11) NOT NULL,
  `tipo_tela` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `largo_original` decimal(6,2) NOT NULL,
  `metros_disponibles` decimal(6,2) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rollos`
--

INSERT INTO `rollos` (`id`, `tipo_tela`, `color`, `largo_original`, `metros_disponibles`, `fecha_ingreso`) VALUES
(1, 'Algodón', 'Azul', 10.00, 8.90, '2025-06-25'),
(2, 'Lino', 'Azul', 20.00, 20.00, '2025-06-25'),
(4, 'algodon', 'rojo', 100.00, 40.00, '2025-06-25'),
(5, 'algodon', 'azul', 1.00, 0.00, '2025-06-24'),
(6, 'Lana', 'Rojo', 30.00, 30.00, '2025-06-19'),
(8, 'Algodón', 'Naranja', 30.00, 30.00, '2025-07-04'),
(9, 'Poliéster', 'Gris', 60.00, 58.00, '2025-06-25'),
(10, 'Lino', 'Marrón', 60.00, 60.00, '2025-06-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `rollo_id` int(11) NOT NULL,
  `metros_vendidos` decimal(6,2) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `rollo_id`, `metros_vendidos`, `fecha_venta`) VALUES
(1, 1, 0.10, '2025-06-26 00:49:09'),
(2, 4, 60.00, '2025-06-26 01:05:00'),
(4, 5, 1.00, '2025-06-26 02:20:50'),
(6, 1, 1.00, '2025-06-26 02:33:45'),
(7, 9, 2.00, '2025-06-26 02:43:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rollos`
--
ALTER TABLE `rollos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rollo_id` (`rollo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rollos`
--
ALTER TABLE `rollos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`rollo_id`) REFERENCES `rollos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
