-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2024 a las 13:48:41
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
-- Base de datos: `db_task`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tk_estatestask`
--

CREATE TABLE `tk_estatestask` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tk_estatestask`
--

INSERT INTO `tk_estatestask` (`id`, `name`, `created_at`) VALUES
(1, 'Pendiente', '2024-02-20 14:27:32'),
(2, 'Realizada', '2024-02-20 14:27:32'),
(3, 'Cancelada', '2024-02-20 14:27:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tk_tasks`
--

CREATE TABLE `tk_tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `estate_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tk_tasks`
--

INSERT INTO `tk_tasks` (`id`, `title`, `description`, `estate_id`, `due_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Correr', 'Hacer ejercicio', 2, '2024-03-05', '2024-02-20 14:28:37', '2024-02-22 18:22:06', NULL),
(2, 'Leer', 'Estudiar para le examen', 1, '0000-00-00', '2024-02-20 17:09:28', '2024-02-21 23:52:32', NULL),
(10, 'Ir al gym', 'Debo hacer ejercicio', 1, '2024-02-25', '2024-02-20 20:55:16', '2024-02-21 04:11:49', '2024-02-21 03:12:12'),
(12, 'Comer', 'Ir al nuevo restaurante', 1, '2024-02-22', '2024-02-20 21:46:32', NULL, '2024-02-21 22:23:00'),
(13, 'Probar', 'Ir al nuevo restaurante', 3, '2024-02-09', '2024-02-21 15:11:32', '2024-02-21 23:45:12', NULL),
(17, 'Ir al Colegio', 'debo ir hacer mercado', 2, '2024-02-24', '2024-02-22 11:18:59', '2024-02-22 17:20:39', '2024-02-22 17:20:44'),
(19, 'Ir al Colegio', 'prueba de test', 3, '2024-02-24', '2024-02-22 12:14:45', '2024-02-22 18:22:30', '2024-02-22 18:23:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tk_estatestask`
--
ALTER TABLE `tk_estatestask`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tk_tasks`
--
ALTER TABLE `tk_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_estates` (`estate_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tk_estatestask`
--
ALTER TABLE `tk_estatestask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tk_tasks`
--
ALTER TABLE `tk_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tk_tasks`
--
ALTER TABLE `tk_tasks`
  ADD CONSTRAINT `fk_id_estates` FOREIGN KEY (`estate_id`) REFERENCES `tk_estatestask` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
