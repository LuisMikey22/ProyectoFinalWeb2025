-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2025 a las 15:33:56
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
-- Base de datos: `anuiesne_ehqa`
--

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `rol`) VALUES
(1, 'angel', '1234', 'admin'),
(2, 'axdi', '1234', 'admin'),
(3, 'luis', '1234', 'admin'),
(4, 'random', '1234', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`nombre`, `apellidos`) VALUES
('israel', 'duran encinas'),
('alejandro', 'perez lopez'),
('angel de jesus', 'castro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bestsellingart`
--

CREATE TABLE `bestsellingart` (
  `id` int(10) NOT NULL,
  `category` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bestsellingart`
--

INSERT INTO `bestsellingart` (`id`, `category`, `image`, `description`, `price`) VALUES
(1, 'CAT-bestsellingart', 'bestSellingArt (1).png', 'Set de guantes para horno, Algodón.', 70),
(2, 'CAT-bestsellingart', 'bestSellingArt (2).png', 'Amigurumi de Coraje, Algodón.', 72),
(3, 'CAT-bestsellingart', 'bestSellingArt (3).png', 'Organizador de cables de manzana, Algodón.', 45),
(4, 'CAT-bestsellingart', 'bestSellingArt (4).png', 'Amigurumi de Mike Wazowski, Algodón.', 78),
(5, 'CAT-bestsellingart', 'bestSellingArt (5).png', 'Porta botellas con lazo, Algodón.', 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newart`
--

CREATE TABLE `newart` (
  `id` int(10) NOT NULL,
  `category` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `newart`
--

INSERT INTO `newart` (`id`, `category`, `image`, `description`, `price`) VALUES
(1, 'CAT-newart', 'newArtItem (1).png', 'Bufanda delgada de ojos, Algodón.', 100),
(2, 'CAT-newart', 'newArtItem (2).png', 'Cajita organizadora, Algodón.', 55),
(3, 'CAT-newart', 'newArtItem (3).png', 'Moño pequeño azul, Algodón.', 40),
(4, 'CAT-newart', 'newArtItem (4).png', 'Sombrero con diseño, Algodón.', 70),
(5, 'CAT-newart', 'newArtItem (5).png', 'Rosa individual, Algodón.', 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seasonalart`
--

CREATE TABLE `seasonalart` (
  `id` int(10) NOT NULL,
  `category` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seasonalart`
--

INSERT INTO `seasonalart` (`id`, `category`, `image`, `description`, `price`) VALUES
(1, 'CAT-seasonalart', 'seasonArtItem (1).png', 'Ramo de tulipanes y flores, Algodón.', 85),
(2, 'CAT-seasonalart', 'seasonArtItem (2).png', 'Bolsa de estrella de rayas, Algodón.', 150),
(3, 'CAT-seasonalart', 'seasonArtItem (3).png', 'Bolsa cangurera, Algodón.', 60),
(4, 'CAT-seasonalart', 'seasonArtItem (4).png', 'Funda de laptop, Algodón.', 50),
(5, 'CAT-seasonalart', 'seasonArtItem (5).png', 'Bolsa tejida a rayas, Algodón.', 120);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bestsellingart`
--
ALTER TABLE `bestsellingart`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `newart`
--
ALTER TABLE `newart`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seasonalart`
--
ALTER TABLE `seasonalart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bestsellingart`
--
ALTER TABLE `bestsellingart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `newart`
--
ALTER TABLE `newart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `seasonalart`
--
ALTER TABLE `seasonalart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
