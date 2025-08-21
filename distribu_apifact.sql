-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-08-2025 a las 05:15:23
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `distribu_apifact`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `id_configuracion` int NOT NULL AUTO_INCREMENT,
  `nombre_sistema_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombre_empresa_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `web_empresa_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `logo_sistema_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `favicon_sistema_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_sunat_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave_sunat_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `keywords_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `servidor_correo_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario_correo_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave_correo_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `puerto_correo_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `seguridad_correo_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `paypal_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `culqi_configuracion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `creado_configuracion` date NOT NULL,
  `actualizado_configuracion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_configuracion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id_configuracion`, `nombre_sistema_configuracion`, `nombre_empresa_configuracion`, `descripcion_configuracion`, `web_empresa_configuracion`, `logo_sistema_configuracion`, `favicon_sistema_configuracion`, `id_sunat_configuracion`, `clave_sunat_configuracion`, `keywords_configuracion`, `servidor_correo_configuracion`, `usuario_correo_configuracion`, `clave_correo_configuracion`, `puerto_correo_configuracion`, `seguridad_correo_configuracion`, `paypal_configuracion`, `culqi_configuracion`, `creado_configuracion`, `actualizado_configuracion`) VALUES
(1, 'APIFACT', 'Developer technology', 'API REST FULL para la facturación electrónica SUNAT', 'https://developer-technology.net/', 'bG9nb19lbXBfMTY4NzkxOTUyNg==.png', '', '', '', '[\"sunat\",\"facturacion\",\"api\",\"cpe\"]', 'mail.distribuidoraoslim.com', 'soporte@distribuidoraoslim.com', 'P@ssword123', '465', 'ssl', '[{\"client_id\":\"\",\"secret_key\":\"\"}]', '[{\"public_key\":\"\",\"secret_key\":\"\"}]', '2023-03-09', '2023-06-28 02:32:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` int NOT NULL AUTO_INCREMENT,
  `ruc_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `razon_social_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombre_comercial_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `email_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_plan_empresa` int NOT NULL,
  `consumo_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccion_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `departamento_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `provincia_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `distrito_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ubigeo_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `logo_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fase_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario_sol_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave_sol_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `certificado_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `expira_certificado_empresa` date NOT NULL,
  `clave_certificado_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `client_id` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `client_secret` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `estado_empresa` int NOT NULL,
  `token_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave_secreta_empresa` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `proxima_facturacion_empresa` date NOT NULL,
  `creado_empresa` date NOT NULL,
  `actualizado_empresa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `ruc_empresa`, `razon_social_empresa`, `nombre_comercial_empresa`, `telefono_empresa`, `email_empresa`, `id_plan_empresa`, `consumo_empresa`, `direccion_empresa`, `departamento_empresa`, `provincia_empresa`, `distrito_empresa`, `ubigeo_empresa`, `logo_empresa`, `fase_empresa`, `usuario_sol_empresa`, `clave_sol_empresa`, `certificado_empresa`, `expira_certificado_empresa`, `clave_certificado_empresa`, `client_id`, `client_secret`, `estado_empresa`, `token_empresa`, `clave_secreta_empresa`, `proxima_facturacion_empresa`, `creado_empresa`, `actualizado_empresa`) VALUES
(1, '10318332504', 'OSTOS SILVA WALTER DARIO', 'DISTRIBUIDORA OSLIM', '933790334', 'empresa@gmail.com', 1, '[{\"periodo\":\"03-2023\",\"consultas\":0,\"documentos\":0},{\"periodo\":\"04-2023\",\"consultas\":0,\"documentos\":0},{\"periodo\":\"06-2023\",\"consultas\":34,\"documentos\":11},{\"periodo\":\"07-2023\",\"consultas\":42,\"documentos\":3},{\"periodo\":\"08-2023\",\"consultas\":2,\"documentos\":0},{\"periodo\":\"09-2023\",\"consultas\":4,\"documentos\":0}]', 'JR. SANTA PATRICIA MZ G LT.43 - SMP', 'LIMA', 'LIMA', 'SAN MARTIN DE PORRES', '150135', 'MTAzMTgzMzI1MDRfNjQ5YjliN2YzMDc0N18xNjg3OTE5NDg3LnBuZw==.png', 'beta', 'MODDATOS', 'moddatos', '', '0000-00-00', '', '', '', 1, 'e0562bc98c5c88dbc900f117ecf863b0b7e9ba7ab2747fd42c855cfbc5d915b1', 'd3h-1av-a9q-qta-crf-44d', '0000-00-00', '2023-02-23', '2023-09-05 11:17:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

DROP TABLE IF EXISTS `planes`;
CREATE TABLE IF NOT EXISTS `planes` (
  `id_plan` int NOT NULL AUTO_INCREMENT,
  `nombre_plan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion_plan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `precio_plan` float NOT NULL,
  `contiene_plan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ventas_plan` int NOT NULL,
  `creado_plan` date NOT NULL,
  `actualizado_plan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_plan`, `nombre_plan`, `descripcion_plan`, `precio_plan`, `contiene_plan`, `ventas_plan`, `creado_plan`, `actualizado_plan`) VALUES
(1, 'Ilimitado', 'Consultas ilimitadas', 150, '[{\"consultas\":\"ilimitado\",\"documentos\":\"ilimitado\"}]', 0, '2023-02-23', '2023-04-01 00:16:18'),
(2, 'Estándar', 'Solo para desarrollo', 50, '[{\"consultas\":\"1000\",\"documentos\":\"1000\"}]', 0, '2023-03-01', '2023-04-01 00:16:21'),
(3, 'Gratis', 'Plan gratis', 0, '[{\"consultas\":\"100\",\"documentos\":\"100\"}]', 0, '2023-03-01', '2023-03-29 17:50:09'),
(9, 'Premium', 'Plan premium', 100, '[{\"consultas\":\"2000\",\"documentos\":\"2000\"}]', 0, '2023-03-29', '2023-04-01 00:16:26'),
(10, 'Básico', 'plan basico', 30, '[{\"consultas\":\"500\",\"documentos\":\"500\"}]', 0, '2023-03-29', '2023-04-01 00:16:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `alias_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `email_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombres_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `avatar_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_empresa_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `rol_usuario` int NOT NULL,
  `estado_usuario` int NOT NULL,
  `metodo_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `verificado_usuario` int NOT NULL,
  `token_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `token_exp_usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `creado_usuario` date NOT NULL,
  `actualizado_usuario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `alias_usuario`, `clave_usuario`, `email_usuario`, `nombres_usuario`, `telefono_usuario`, `avatar_usuario`, `id_empresa_usuario`, `rol_usuario`, `estado_usuario`, `metodo_usuario`, `verificado_usuario`, `token_usuario`, `token_exp_usuario`, `creado_usuario`, `actualizado_usuario`) VALUES
(1, 'admin', '$2a$07$azybxcags23425sdg23sdeeKAqt96CqhlXh4xR.Kd9524vrpGvri6', 'admin@admin.com', 'Super Administrador', '935852750', '', '[{\"id\":\"1\"}]', 1, 1, 'Directo', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NTU3NTI3NzcsImV4cCI6MTc1NTgzOTE3NywiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6ImFkbWluQGFkbWluLmNvbSJ9fQ.X2CTj7XUBW8Lv3YWC13QBxXz_9xtz4LJKhTFzLIpAyI', '1755839177', '2023-02-24', '2025-08-21 05:06:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` int NOT NULL AUTO_INCREMENT,
  `id_usuario_venta` int NOT NULL,
  `id_plan_venta` int NOT NULL,
  `id_empresa_venta` int NOT NULL,
  `metodo_venta` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `trans_venta` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `moneda_venta` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `monto_venta` double NOT NULL,
  `tipo_cambio_venta` double NOT NULL,
  `estado_venta` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `creado_venta` date NOT NULL,
  `actualizado_venta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
