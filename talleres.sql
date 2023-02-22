-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2023 a las 20:25:46
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
-- Base de datos: `talleres`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponentes`
--

CREATE TABLE `ponentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `apellidos` varchar(40) DEFAULT NULL,
  `imagen` varchar(32) DEFAULT NULL,
  `tags` varchar(120) DEFAULT NULL,
  `redes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ponentes`
--

INSERT INTO `ponentes` (`id`, `nombre`, `apellidos`, `imagen`, `tags`, `redes`) VALUES
(29, 'Perico', 'Perico', 'fuente.png', 'fuente', 'fuente'),
(30, 'Nahida', 'Nahida', 'nahida.png', 'Dendro', 'Dendro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmado` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_exp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `confirmado`, `token`, `token_exp`) VALUES
(2, 'Marcos', 'Ortiz', 'marcos@gmail.com', '$2y$04$FqHQaNrCYXpxsE7DcftKA.TJhtG32Hy9yAFJIhbwW2vccbTAOQnx2', 'alumno', 'si', NULL, NULL),
(3, 'Manolo', 'Peña', 'pemanolo@gmail.com', '$2y$10$BDSKfmZOfWx49SjAt5pKn.qx1aZSRQFTQpZ4xrvfZXMVSmKWpAyKm', 'alumno', 'si', NULL, NULL),
(12, 'Manolo Juan', 'Peña', 'pemanooolo@gmail.com', '$2y$10$u5wpbnRQleJpOJ5ZlBG.BuZPXrxq6yuWQhZwoCsRgzGGQeHHcvTce', 'user', 'si', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NzY4OTYyMTAsImV4cCI6MTY3Njg5OTgxMCwiZGF0YSI6WyJwZW1hbm9vb2xvQGdtYWlsLmNvbSJdfQ.1NI5zu9apCcTI_MfZHMaD_hAw_ShEOFD49YY_GKHlXQ', '0000-00-00 00:00:00'),
(13, 'safs', 'fasf', 'dsada@gmail.com', '$2y$10$/5d2QbnIYHYkBRJ/GmC6o.3w.3xxFL.NxtMmtMnFD3nn7nH/FsEeq', 'alumno', 'no', NULL, NULL),
(14, 'safsuhiuyg', 'guyhgh', 'dksfd@gmail.com', '$2y$10$0mPGb2.BTx.iNGMuH2hkF.A6acqU/BJb2AMfxH/gfO6VbAIPTEH9W', 'alumno', 'no', NULL, NULL),
(15, 'mfdskjfnskj', 'mfskdfm', 'b@gmail.com', '$2y$10$F8owx9mhj/Ew2QS7bqngBeSTjJOgAlYtPiUVotLmG2beVmQYbptrq', 'alumno', 'no', NULL, NULL),
(17, 'David', 'Tapias', 'lopez21tap@gmail.com', '$2y$10$0OFAtWmQqAL.ePtaINeo/u3SC65MuK2oLZIFnjdZnAYhKLC0V3NOC', 'alumno', 'no', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NzcwOTM3NjksImV4cCI6MTY3NzA5NzM2OSwiZGF0YSI6WyJsb3BlejIxdGFwQGdtYWlsLmNvbSJdfQ.8njeQp3XhEsO4eU47DIwetgPfpiyvWwNAgt2f0J4CFM', '0000-00-00 00:00:00'),
(18, 'Pedro', 'coco', 'coco@gmail.com', '$2y$10$yJiY5H0T/evZBfVKDRub0Oz6Jc4wazYl50okEK95VQGwvM8QsvFZi', 'alumno', 'no', NULL, NULL),
(19, 'Pepe', 'Perico', 'perico@gmail.com', '$2y$10$hZ5XciuN9UdA7ZaWNpJCCeEkrfpHhfgZysopZ/sR.gV/6ifD.DYA.', 'alumno', 'no', NULL, NULL),
(20, 'Alex', 'Corneto', 'corneto@gmail.com', '$2y$10$kqYiCfz3429vlhyO7PC2PeOlqpyEpzwF2bnpro9CTrhc1m51ft7Hu', 'alumno', 'no', NULL, NULL),
(21, 'Carmen', 'Ruiz', 'carmen@gmail.com', '$2y$10$h2iO.eqxHfb.aIiKZckFWuwh91NJz9RnnR2KgD9LQXoZRNKEJcYGO', 'alumno', 'no', NULL, NULL),
(22, 'Julian', 'Manzana', 'manzana@gmail.com', '$2y$10$1dNol5X8d96hRwaWt/Y.XeeGkx/0VgbeP7iJk7j/KnZ.46ll8iKwe', 'alumno', 'no', NULL, NULL),
(23, 'Alberto', 'Pera', 'pera@gmail.com', '$2y$10$JBdpCYoXJxJvywYo1AQ7l.m1RPH264gTCdoTvnclrJGkPb2r7VnOW', 'alumno', 'no', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NzcwNTk0NjQsImV4cCI6MTY3NzA2MzA2NCwiZGF0YSI6WyJwZXJhQGdtYWlsLmNvbSJdfQ.l6wibPK1IcUMDUF_YcF8yFTiQqWiqKHnbiZfaoDThAA', '0000-00-00 00:00:00'),
(24, 'asasas', 'asasassa', 'asasas@defx.ss', '$2y$10$lvEDClbj1ekIZHW1/3gVF.yobYa9X37uwLja.DVfQFMx0fEDy.wca', 'alumno', 'no', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ponentes`
--
ALTER TABLE `ponentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ponentes`
--
ALTER TABLE `ponentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
