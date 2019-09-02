-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2019 a las 21:00:07
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotels`
--

CREATE TABLE `hotels` (
  `id_hotel` int(11) NOT NULL,
  `hotel_name` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `address` varchar(35) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `category` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hotels`
--

INSERT INTO `hotels` (`id_hotel`, `hotel_name`, `city`, `address`, `phone_number`, `mail`, `category`) VALUES
(1, 'Pavillon Royal DC', 'Bogotá, DC', 'Calle 94 # 11-45', '7002423', 'pavillon@gmail.com', 4),
(2, 'Cabrera Imperial', 'Bogotá, DC', '	\r\nCalle 83, 36401', '7934693', 'cabrera_imperial.com', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id_service` int(11) NOT NULL,
  `service_name` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id_service`, `service_name`) VALUES
(1, 'Restaurante'),
(2, 'Wifi Gratis'),
(3, 'Piscina'),
(4, 'Barra Libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_has_hotels`
--

CREATE TABLE `services_has_hotels` (
  `services_id_service` int(11) NOT NULL,
  `hotels_id_hotel` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `qualification` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `services_has_hotels`
--

INSERT INTO `services_has_hotels` (`services_id_service`, `hotels_id_hotel`, `state`, `qualification`) VALUES
(1, 1, 1, 8.5),
(1, 2, 1, 9.2),
(2, 1, 1, 7),
(2, 2, 1, 9.6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`);

--
-- Indices de la tabla `services_has_hotels`
--
ALTER TABLE `services_has_hotels`
  ADD PRIMARY KEY (`services_id_service`,`hotels_id_hotel`),
  ADD KEY `fk_services_has_hotels_hotels1` (`hotels_id_hotel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `services_has_hotels`
--
ALTER TABLE `services_has_hotels`
  ADD CONSTRAINT `fk_services_has_hotels_hotels1` FOREIGN KEY (`hotels_id_hotel`) REFERENCES `hotels` (`id_hotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_services_has_hotels_services` FOREIGN KEY (`services_id_service`) REFERENCES `services` (`id_service`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
