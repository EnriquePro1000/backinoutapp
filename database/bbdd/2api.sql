-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2021 a las 18:55:08
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `2api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `access_token`
--

CREATE TABLE `access_token` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(400) NOT NULL,
  `created_in` datetime NOT NULL,
  `expires_in` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `access_token`
--

INSERT INTO `access_token` (`id`, `user_id`, `token`, `created_in`, `expires_in`) VALUES
(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjFcL2lub3V0YXBwXC9hcGlcL3B1YmxpY1wvYXBpXC9sb2dpbiIsImlhdCI6MTYyMzUwNDIyMiwiZXhwIjoxNjIzNTA3ODIyLCJuYmYiOjE2MjM1MDQyMjIsImp0aSI6Im1lTnVCdTQ0VXRrcTJBUmEiLCJzdWIiOjEsInBydiI6IjRlNzA5MzhlNzA4YjM1N2JhZDJhNzBlNTg4OGMxNGMzN2NhOTczZmUifQ.G4CJnlekrvt3Tk6NK1WvzsRj-SeO5Doqs4Iz6aiElmI', '2021-06-12 13:23:42', '2021-06-12 19:23:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `area_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `numberid` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `othername` varchar(50) DEFAULT NULL,
  `flastname` varchar(20) NOT NULL,
  `slastname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `createdate` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  `updatedby` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `country_id`, `area_id`, `type_id`, `numberid`, `firstname`, `othername`, `flastname`, `slastname`, `email`, `email_verified_at`, `password`, `remember_token`, `active`, `createdate`, `created_by`, `updatedate`, `updatedby`) VALUES
(1, 1, 1, 1, '1065819503', 'Enrique', 'Jose', 'de Armas', 'Osia', 'ejdao2015@hotmail.com', NULL, '$2y$10$g11glnxSpXdSMVFCFaMMkeHbWswvBz3ggsiOXadYDyBNlMHBVpAKK', NULL, 1, '2021-06-12 07:39:30', 1, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `access_token`
--
ALTER TABLE `access_token`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
