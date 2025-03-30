-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-03-2025 a las 18:38:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `paises`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises_es`
--

CREATE TABLE `paises_es` (
  `Nombre` varchar(44) DEFAULT NULL,
  `Capital` varchar(25) DEFAULT NULL,
  `Poblacion` int(10) DEFAULT NULL,
  `Idiomas` varchar(142) DEFAULT NULL,
  `Continente` varchar(12) DEFAULT NULL,
  `Bandera` varchar(115) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `paises_es`
--

INSERT INTO `paises_es` (`Nombre`, `Capital`, `Poblacion`, `Idiomas`, `Continente`, `Bandera`) VALUES
('Islas Georgias del Sur y Sandwich del Sur', 'King Edward Point', 30, 'Inglés', 'Antártida', 'https://flagcdn.com/w320/gs.png'),
('Grenada', 'St. George\'s', 112519, 'Inglés', 'Norteamérica', 'https://flagcdn.com/w320/gd.png'),
('Suiza', 'Bern', 8654622, 'Francés, Swiss German, Italiano, Romansh', 'Europa', 'https://flagcdn.com/w320/ch.png'),
('Sierra Leone', 'Freetown', 7976985, 'Inglés', 'África', 'https://flagcdn.com/w320/sl.png'),
('Hungría', 'Budapest', 9749763, 'Húngaro', 'Europa', 'https://flagcdn.com/w320/hu.png'),
('Taiwán', 'Taipei', 23503349, 'Chino', 'Asia', 'https://flagcdn.com/w320/tw.png'),
('Wallis y Futuna', 'Mata-Utu', 11750, 'Francés', 'Oceanía', 'https://flagcdn.com/w320/wf.png'),
('Barbados', 'Bridgetown', 287371, 'Inglés', 'Norteamérica', 'https://flagcdn.com/w320/bb.png'),
('Islas Pitcairn', 'Adamstown', 56, 'Inglés', 'Oceanía', 'https://flagcdn.com/w320/pn.png'),
('Costa de Marfil', 'Yamoussoukro', 26378275, 'Francés', 'África', 'https://flagcdn.com/w320/ci.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
