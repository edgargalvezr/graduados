-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-12-2025 a las 14:35:12
-- Versión del servidor: 10.11.15-MariaDB-ubu2204
-- Versión de PHP: 8.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `graduado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `modalidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `codigo`, `nombre`, `modalidad`) VALUES
(1, '001853', 'MECANICA AUTOMOTRIZ MENCION MOTORES A DIESEL Y GASOLINA', 'PRESENCIAL'),
(2, '001854', 'MECANICA INDUSTRIAL MENCION MAQUINAS Y HERRAMIENTAS', 'PRESENCIAL'),
(3, '001855', 'ELECTRICIDAD MENCION ELECTROMECANICA', 'PRESENCIAL'),
(4, '541032A01-P-1601', 'TECNICO SUPERIOR EN SEGURIDAD CIUDADANA Y ORDEN PUBLICO', 'PRESENCIAL'),
(5, '550111B01-D-1601', 'EDUCACION INICIAL', 'DUAL'),
(6, '550713C01-P-1601', 'ENERGIAS ALTERNATIVAS', 'PRESENCIAL'),
(7, '550714B01-P-1601', 'ELECTROMECANICA', 'PRESENCIAL'),
(8, '550714B01-P-1601', 'ELECTROMECANICA', 'PRESENCIAL'),
(9, '550714B-P-01', 'TECNOLOGIA SUPERIOR EN ELECTROMECANICA', 'PRESENCIAL'),
(10, '550715F02-P-1601', 'MECANICA AUTOMOTRIZ', 'PRESENCIAL'),
(11, '550715F02-P-1601', 'MECANICA AUTOMOTRIZ', 'PRESENCIAL'),
(12, '550715G02-P-1601', 'MECANICA INDUSTRIAL', 'PRESENCIAL'),
(13, '550715G02-P-1601', 'MECANICA INDUSTRIAL', 'PRESENCIAL'),
(14, '550715I-P-01', 'TECNOLOGIA SUPERIOR EN MECANICA AUTOMOTRIZ', 'PRESENCIAL'),
(15, '550715K-P-01', 'TECNOLOGIA SUPERIOR EN MECANICA INDUSTRIAL', 'PRESENCIAL'),
(16, '550725E01-P-1601', 'MANTENIMIENTO Y SEGURIDAD INDUSTRIAL', 'PRESENCIAL'),
(17, '550922A01-D-1601', 'TECNOLOGIA SUPERIOR EN DESARROLLO INFANTIL INTEGRAL', 'DUAL'),
(18, '550922A-D-01', 'TECNOLOGIA EN DESARROLLO INFANTIL INTEGRAL', 'DUAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251110230602', '2025-11-10 18:08:48', 597),
('DoctrineMigrations\\Version20251111005913', '2025-11-10 20:00:24', 66),
('DoctrineMigrations\\Version20251111163607', '2025-11-11 11:43:52', 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio_posterior`
--

CREATE TABLE `estudio_posterior` (
  `id` int(11) NOT NULL,
  `graduado_id` int(11) NOT NULL,
  `institucion` varchar(255) NOT NULL,
  `titulo_obtenido` varchar(255) NOT NULL,
  `tipo_estudio` varchar(255) NOT NULL,
  `en_curso` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_laboral`
--

CREATE TABLE `experiencia_laboral` (
  `id` int(11) NOT NULL,
  `graduado_id` int(11) NOT NULL,
  `estado_laboral` varchar(50) NOT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `sector` varchar(50) DEFAULT NULL,
  `relacionado_carrera` tinyint(1) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `graduado`
--

CREATE TABLE `graduado` (
  `id` int(11) NOT NULL,
  `carrera_id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `cohorte` varchar(50) NOT NULL,
  `numero_registro` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `pais_residencia` varchar(100) DEFAULT NULL,
  `ciudad_residencia` varchar(255) DEFAULT NULL,
  `busca_empleo` tinyint(1) NOT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `interesado_colaborar` tinyint(1) NOT NULL,
  `logros_destacados` longtext DEFAULT NULL,
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `temas_interes_formacion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`temas_interes_formacion`)),
  `modalidad_preferida` varchar(100) DEFAULT NULL,
  `habilidades_clave` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`habilidades_clave`)),
  `aspiracion_salarial` decimal(10,2) DEFAULT NULL,
  `tipo_colaboracion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`tipo_colaboracion`)),
  `nombre_jefe_directo` varchar(255) NOT NULL,
  `email_contacto_rrhh` varchar(255) DEFAULT NULL,
  `telefono_contacto_rrhh` varchar(8) DEFAULT NULL,
  `permiso_contacto_empleador` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `graduado`
--

INSERT INTO `graduado` (`id`, `carrera_id`, `cedula`, `apellidos`, `nombres`, `cohorte`, `numero_registro`, `email`, `telefono`, `pais_residencia`, `ciudad_residencia`, `busca_empleo`, `cv_path`, `interesado_colaborar`, `logros_destacados`, `updated_at`, `temas_interes_formacion`, `modalidad_preferida`, `habilidades_clave`, `aspiracion_salarial`, `tipo_colaboracion`, `nombre_jefe_directo`, `email_contacto_rrhh`, `telefono_contacto_rrhh`, `permiso_contacto_empleador`) VALUES
(1, 1, '1234567890', 'Test Apellido', 'Test Nombre', '2024-A', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, '2025-11-22 16:43:20', NULL, NULL, NULL, NULL, '[]', 'N/A', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `nombres`, `apellidos`, `email`) VALUES
(1, 'danny', '[\"ROLE_ADMIN\",\"ROLE_USER\"]', '$2y$13$0PYeWV06WCUa/FKY3go.ke8Z6/lIv38V9TCVzIOQMtL5ibkV19EVe', 'Edgar', 'Galvez', 'edgar.galvez@istfo.edu.ec');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `estudio_posterior`
--
ALTER TABLE `estudio_posterior`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_95B38507146255DD` (`graduado_id`);

--
-- Indices de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6B31EEF3146255DD` (`graduado_id`);

--
-- Indices de la tabla `graduado`
--
ALTER TABLE `graduado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A28999687BF39BE0` (`cedula`),
  ADD KEY `IDX_A2899968C671B40F` (`carrera_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `estudio_posterior`
--
ALTER TABLE `estudio_posterior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `graduado`
--
ALTER TABLE `graduado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudio_posterior`
--
ALTER TABLE `estudio_posterior`
  ADD CONSTRAINT `FK_95B38507146255DD` FOREIGN KEY (`graduado_id`) REFERENCES `graduado` (`id`);

--
-- Filtros para la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD CONSTRAINT `FK_6B31EEF3146255DD` FOREIGN KEY (`graduado_id`) REFERENCES `graduado` (`id`);

--
-- Filtros para la tabla `graduado`
--
ALTER TABLE `graduado`
  ADD CONSTRAINT `FK_A2899968C671B40F` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
