-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2021 a las 06:54:12
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
(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2lub3V0YXBwXC9hcGlcL3B1YmxpY1wvYXBpXC9sb2dpbiIsImlhdCI6MTYyMzczMTI4MSwiZXhwIjoxNjIzNzUyODgxLCJuYmYiOjE2MjM3MzEyODEsImp0aSI6Im9MVUxpQm15Qnc2YjBmcWsiLCJzdWIiOjEsInBydiI6IjRlNzA5MzhlNzA4YjM1N2JhZDJhNzBlNTg4OGMxNGMzN2NhOTczZmUifQ.ste-XPpn2DFJDjPg1qz4hAJbcK7i5v055Rbo-hQeVpg', '2021-06-14 23:28:01', '2021-06-15 05:28:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'ADMINISTRACION', '2021-06-13 01:48:49', 1, NULL, NULL),
(2, 'FINANCIERA', '2021-06-13 01:48:49', 1, NULL, NULL),
(3, 'COMPRAS', '2021-06-13 01:48:49', 1, NULL, NULL),
(4, 'INFRASTRUCTURA', '2021-06-13 01:48:49', 1, NULL, NULL),
(5, 'OPERACION', '2021-06-13 01:48:49', 1, NULL, NULL),
(6, 'TALENTO HUMANO', '2021-06-13 01:48:49', 1, NULL, NULL),
(7, 'SERVICIOS VARIOS', '2021-06-13 01:48:49', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbrev` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `abbrev`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'co', 'COLOMBIA', '2021-06-13 02:32:10', 1, NULL, NULL),
(2, 'us', 'ESTADOS UNIDOS', '2021-06-13 02:32:10', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permits`
--

CREATE TABLE `permits` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permits`
--

INSERT INTO `permits` (`id`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'CREATE NEW USERS', '2021-06-13 00:28:02', 1, NULL, NULL),
(2, 'IN/OUT REGISTER', '2021-06-13 00:28:02', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permit_role`
--

CREATE TABLE `permit_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permit_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permit_role`
--

INSERT INTO `permit_role` (`id`, `permit_id`, `role_id`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 1, '2021-06-13 00:30:12', 1, NULL, NULL),
(2, 2, 1, '2021-06-13 00:30:12', 1, NULL, NULL),
(3, 2, 2, '2021-06-13 00:30:36', 1, '2021-06-13 00:30:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'ADMINISTRATOR', '2021-06-13 00:27:02', 1, NULL, NULL),
(2, 'EMPLOYEE', '2021-06-13 00:27:02', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typeid`
--

CREATE TABLE `typeid` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbrev` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `typeid`
--

INSERT INTO `typeid` (`id`, `abbrev`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'C.C.', 'CEDULA DE CIUDADANIA', '2021-06-13 00:10:14', 1, NULL, NULL),
(2, 'C.E.', 'CEDULA DE EXTRANJERIA', '2021-06-13 00:10:14', 1, NULL, NULL),
(3, 'PASAPORTE', 'PASAPORTE', '2021-06-13 00:10:14', 1, NULL, NULL),
(4, 'PEP', 'PERMISO ESPECIAL DE PERMANENCIA', '2021-06-13 00:14:06', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `area_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `typeid_id` int(10) UNSIGNED NOT NULL,
  `numberid` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `othername` varchar(50) DEFAULT NULL,
  `flastname` varchar(20) NOT NULL,
  `slastname` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `country_id`, `area_id`, `role_id`, `typeid_id`, `numberid`, `firstname`, `othername`, `flastname`, `slastname`, `email`, `email_verified_at`, `password`, `remember_token`, `active`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 1, 1, 1, '1065819503', 'Enrique', 'Jose', 'de Armas', 'Osia', 'enrique.dearmas@cidenet.com.co', NULL, '$2y$10$g11glnxSpXdSMVFCFaMMkeHbWswvBz3ggsiOXadYDyBNlMHBVpAKK', NULL, 1, '2021-06-12 07:39:30', 1, NULL, NULL),
(53, 1, 1, 2, 1, '57413963', 'RAQUEL', 'MARIA', 'OSIAS', 'OSIAS', 'raquel.osias@cidenet.com.co', NULL, NULL, NULL, 1, '2021-06-13 00:00:00', 1, '2021-06-14 11:02:15', 1),
(55, 1, 1, 2, 1, '43434677', 'LILYBETH', 'MARTA', 'MEJIA', 'CASTILLO', 'lilybeth.mejia@cidenet.com.co', NULL, NULL, NULL, 1, '2021-06-13 00:00:00', 1, '2021-06-14 16:03:27', 1),
(57, 2, 2, 2, 3, '2345435545', 'ENRIQUE', NULL, 'DE ARMAS', 'BARRIOS', 'enrique.dearmas.6@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-13 00:00:00', 1, '2021-06-14 02:55:51', 1),
(58, 1, 7, 2, 4, '8000478963', 'JOHAN', NULL, 'GARCIA', 'GUTIERREZ', 'johan.garcia@cidenet.com.co', NULL, NULL, NULL, 1, '2021-06-13 00:00:00', 1, NULL, NULL),
(61, 1, 5, 2, 4, '234543554', 'MARTIN', 'ALEJANDRO', 'CUELLO', 'PEDROZO', 'martin.cuello.2@cidenet.com.co', NULL, NULL, NULL, 1, '2021-06-13 00:00:00', 1, '2021-06-14 04:01:00', 1),
(63, 2, 2, 2, 1, '56546452', 'ENRIQUE', 'ANTONIO', 'GUTIERREZ', 'MARIN', 'enrique.gutierrez.2@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-13 00:00:00', 1, '2021-06-14 14:33:51', 1),
(69, 2, 1, 2, 2, '6667576767', 'JOSE', 'ENRIQUE', 'DE ARMAS', 'OSIA', 'jose.cifuentes@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, '2021-06-14 04:04:27', 1),
(70, 1, 7, 2, 1, '34545454', 'LASIE', NULL, 'MCDONALD', 'TRUMP', 'lasie.mcdonald.1@cidenet.com.co', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, '2021-06-14 23:20:52', 1),
(74, 1, 4, 2, 1, '3456456', 'ANDREA', 'KATRINA', 'MOZO', 'MEJIA', 'andrea.mozo.22@cidenet.com.co', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, '2021-06-14 04:06:50', 1),
(75, 2, 2, 2, 2, '56776663', 'PEDRO', 'ANTONIO', 'CIFUENTES', 'BENAVIDES', 'pedro.cifuentes.3@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(100, 2, 1, 2, 1, '325423423', 'ENRIQUE', 'ANTONIO', 'DE ARMAS', 'BENAVIDES', 'enrique.dearmas.10@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(101, 2, 1, 2, 1, '45687686', 'FELIPE', NULL, 'DE ARMAS', 'BENAVIDES', 'felipe.dearmas@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, '2021-06-14 16:11:09', 1),
(102, 2, 1, 2, 1, '43234432', 'ENRIQUE', NULL, 'DE ARMAS', 'BENAVIDES', 'enrique.dearmas.9@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(103, 2, 2, 2, 1, '34432423', 'ENRIQUE', NULL, 'DE ARMAS', 'BENAVIDES', 'enrique.dearmas.11@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(106, 2, 1, 2, 2, '324342', 'ENRIQUE', 'SADDSDD', 'DE ARMAS', 'BENAVIDES', 'enrique.dearmas.14@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(111, 1, 2, 2, 1, 'w34555', 'ENRIQUE', NULL, 'DE ARMAS', 'DSFFD', 'enrique.dearmas.12@cidenet.com.co', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(112, 2, 2, 2, 1, '54665gegrfrg', 'ENRIQUE', 'ANTONIO', 'DE ARMAS', 'BENAVIDES', 'enrique.dearmas.13@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(121, 1, 2, 2, 2, '342442342443', 'ENRIQUE', 'ANTONIO', 'DE ARMAS', 'BENAVIDES', 'enrique.dearmas.15@cidenet.com.co', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(132, 2, 1, 2, 2, '1065819503as', 'ENRIQUE', 'ANTONIO', 'DE ARMAS', 'BENAVIDES', 'enrique.dearmas.16@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL),
(133, 2, 2, 2, 2, 'awddawadw', 'DAWADWDAW', 'DAWDAWDWA', 'DWADWDWAD', 'ADWDWA', 'dawadwdaw.dwadwdwad@cidenet.com.us', NULL, NULL, NULL, 1, '2021-06-14 00:00:00', 1, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permits`
--
ALTER TABLE `permits`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permit_role`
--
ALTER TABLE `permit_role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `typeid`
--
ALTER TABLE `typeid`
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
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permits`
--
ALTER TABLE `permits`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permit_role`
--
ALTER TABLE `permit_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `typeid`
--
ALTER TABLE `typeid`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
