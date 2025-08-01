-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2025 a las 03:31:39
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
-- Base de datos: `hotel_reservas_5`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` bigint(20) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(2, 'Aseo'),
(3, 'Cocina'),
(4, 'Electrónica'),
(1, 'Lencería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `salario` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellido`, `telefono`, `correo`, `fecha_entrada`, `fecha_salida`, `salario`) VALUES
(3, 'LEONARDI', 'CARDOZO ', '3112196188', '', '2025-07-28', '2025-07-29', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id_habitacion` bigint(20) UNSIGNED NOT NULL,
  `nombre_hab` varchar(15) DEFAULT NULL,
  `id_tiphab` int(11) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL CHECK (`estado` in ('A','I'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` bigint(20) UNSIGNED NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_disponible` int(11) DEFAULT 0,
  `fecha_ingreso` date DEFAULT curdate(),
  `fecha_actualizacion` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_producto`, `cantidad_disponible`, `fecha_ingreso`, `fecha_actualizacion`) VALUES
(1, 1, 30, '2025-07-01', '2025-07-20'),
(2, 2, 50, '2025-07-01', '2025-07-22'),
(3, 3, 100, '2025-07-10', '2025-07-24'),
(4, 4, 10, '2025-07-05', '2025-07-20'),
(5, 5, 8, '2025-07-02', '2025-07-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario`
--

CREATE TABLE `movimientos_inventario` (
  `id_movimiento` bigint(20) UNSIGNED NOT NULL,
  `id_producto` int(11) NOT NULL,
  `tipo_movimiento` varchar(10) DEFAULT NULL CHECK (`tipo_movimiento` in ('entrada','salida')),
  `cantidad` int(11) NOT NULL,
  `fecha_movimiento` date DEFAULT curdate(),
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos_inventario`
--

INSERT INTO `movimientos_inventario` (`id_movimiento`, `id_producto`, `tipo_movimiento`, `cantidad`, `fecha_movimiento`, `observacion`) VALUES
(1, 1, 'entrada', 30, '2025-07-01', 'Ingreso inicial de sábanas'),
(2, 2, 'entrada', 50, '2025-07-01', 'Ingreso inicial de toallas'),
(3, 3, 'entrada', 100, '2025-07-10', 'Compra de productos de aseo'),
(4, 4, 'entrada', 10, '2025-07-05', 'Compra ollas para cocina'),
(5, 5, 'entrada', 8, '2025-07-02', 'Compra secadores para habitaciones'),
(6, 2, 'salida', 10, '2025-07-15', 'Distribución toallas a habitaciones'),
(7, 3, 'salida', 20, '2025-07-18', 'Reposición de jabón en baños comunes'),
(8, 1, 'salida', 5, '2025-07-22', 'Cambio de sábanas dañadas en habitaciones'),
(9, 5, 'salida', 2, '2025-07-23', 'Entrega de secadores a habitaciones VIP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `codigo_producto` varchar(20) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `unidad_medida` varchar(20) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `costo_unitario` decimal(10,2) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo_producto`, `nombre_producto`, `descripcion`, `id_categoria`, `id_proveedor`, `unidad_medida`, `precio_unitario`, `costo_unitario`, `ubicacion`, `estado`) VALUES
(1, 'LEN001', 'Sábana doble 300 hilos', 'Sábana blanca para cama doble', 1, 1, 'unidad', 55000.00, 40000.00, 'Bodega Lencería', 'disponible'),
(2, 'LEN002', 'Toalla de cuerpo', 'Toalla hotelera blanca 70x140 cm', 1, 2, 'unidad', 30000.00, 22000.00, 'Bodega Lencería', 'disponible'),
(3, 'ASE001', 'Jabón líquido manos', 'Jabón antibacterial 500ml', 2, 2, 'botella', 8000.00, 6000.00, 'Bodega Aseo', 'disponible'),
(4, 'COC001', 'Olla 24cm acero', 'Olla para cocina industrial', 3, 1, 'unidad', 85000.00, 70000.00, 'Bodega Cocina', 'disponible'),
(5, 'ELE001', 'Secador de cabello', 'Secador 2000w para habitaciones', 4, 1, 'unidad', 120000.00, 95000.00, 'Bodega Electrónica', 'disponible'),
(10, 'COC002', 'CAFE LA CUBANA 500 gramos ', 'Cafe La Cubana 500 gramos molido', 3, 3, 'unidad', 32000.00, 28000.00, 'Ibagué', 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `contacto`, `direccion`) VALUES
(1, 'Distribuidora Hotelera S.A.', 'contacto@hotelera.com', 'Cra 12 #34-56, Bogotá'),
(2, 'Suministros Express SAS', 'ventas@suministrosexpress.com', 'Calle 45 #67-89, Medellín'),
(3, 'LEONARDI GEOVANNY CARDOZO ESTRADA', 'carleo79@hotmail.com', 'Manzana 3 Casa 5 B/Nuevo Armero, Ibagué');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservacion2`
--

CREATE TABLE `reservacion2` (
  `id_reservacion` bigint(20) UNSIGNED NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `adultos` int(11) NOT NULL,
  `kids` int(11) NOT NULL,
  `tipo_habitacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `habitacion` varchar(10) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`id`, `nombre`, `apellido`, `telefono`, `habitacion`, `fecha_entrada`, `fecha_salida`, `precio`) VALUES
(1, 'LEONARDI', 'CARDOZO', '3112196188', '201', '2025-07-26', '2025-07-28', 350000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `id_tipohab` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `cap_max_adulto` int(11) DEFAULT NULL,
  `cap_max_kids` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre_categoria` (`nombre_categoria`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id_habitacion`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD PRIMARY KEY (`id_movimiento`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `reservacion2`
--
ALTER TABLE `reservacion2`
  ADD PRIMARY KEY (`id_reservacion`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`id_tipohab`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id_habitacion` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  MODIFY `id_movimiento` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservacion2`
--
ALTER TABLE `reservacion2`
  MODIFY `id_reservacion` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id_tipohab` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
