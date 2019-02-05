-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2019 a las 01:51:18
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cementerio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiarios`
--

CREATE TABLE `beneficiarios` (
  `idBeneficiario` int(11) NOT NULL,
  `idTitulo` int(11) NOT NULL,
  `idCiudadano` int(11) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cementerios`
--

CREATE TABLE `cementerios` (
  `idCementerio` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Area` decimal(5,2) NOT NULL,
  `Legalizado` int(1) NOT NULL DEFAULT '0',
  `Panteonero` varchar(150) DEFAULT NULL,
  `Tipo` varchar(45) NOT NULL,
  `Estado` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cementerios`
--

INSERT INTO `cementerios` (`idCementerio`, `Nombre`, `Direccion`, `Area`, `Legalizado`, `Panteonero`, `Tipo`, `Estado`) VALUES
(1, 'Prueba', 'Chalatenango, Chalatenango', '500.00', 1, 'Ulises jaja', 'Publico', 1),
(2, 'Vera Cruz', 'Colonia Vera cruz', '200.00', 1, 'Nadie', 'Publico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudadanos`
--

CREATE TABLE `ciudadanos` (
  `idCiudadano` int(11) NOT NULL,
  `NombresCiudadano` varchar(45) NOT NULL,
  `ApellidosCiudadano` varchar(45) NOT NULL,
  `FechaNacimiento` varchar(45) DEFAULT NULL,
  `Profesion` varchar(45) DEFAULT NULL,
  `Domicilio` varchar(200) DEFAULT NULL,
  `DUI` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudadanos`
--

INSERT INTO `ciudadanos` (`idCiudadano`, `NombresCiudadano`, `ApellidosCiudadano`, `FechaNacimiento`, `Profesion`, `Domicilio`, `DUI`) VALUES
(1, 'kevin', 'Rivas', '12/03/2018', 'estudiante', 'Chalatenango, Chalatenango', '1234567890'),
(2, 'kevin', 'Rivas', '12/03/2018', 'estudiante', 'Chalatenango, Chalatenango', '1234567890'),
(3, 'Ramos', 'Galvez', '12/03/2018', 'estudiante', 'Chalatenango, Chalatenango', '1234567890'),
(4, 'Carlos', 'Rodriguez', '12/03/2018', 'estudiante', 'Chalatenango, La Nueva Concepcion', '1234567890'),
(8, 'Ulises', 'Rodriguez', '23/03/1998', 'estudiante', 'Chalatenango, La Nueva Concepcion', '1234567890'),
(9, 'Carlos', 'Alberto', '23/05/2018', 'Estudiante', 'Fn. Caja de Agua', '05505416-9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `idConfiguracion` int(11) NOT NULL,
  `ValorTitulacion` decimal(3,2) DEFAULT NULL,
  `ValorEnterramientoNicho` decimal(3,2) DEFAULT NULL,
  `ValorPermisoAbriryCerrar` decimal(3,2) DEFAULT NULL,
  `ValorEnterramientoTierra` decimal(3,2) DEFAULT NULL,
  `ValorEnterramientoTraslado` decimal(3,2) DEFAULT NULL,
  `ValorEnterramientoTraspaso` decimal(3,2) DEFAULT NULL,
  `ValorConstruccionNivel` decimal(3,2) DEFAULT NULL,
  `RutaTitulos` varchar(100) DEFAULT NULL,
  `Encabezado` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctlestadosnichos`
--

CREATE TABLE `ctlestadosnichos` (
  `idCtlEstadosNicho` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ctlestadosnichos`
--

INSERT INTO `ctlestadosnichos` (`idCtlEstadosNicho`, `Descripcion`, `Estado`) VALUES
(1, 'Disponible', 1),
(2, 'Ocupado', 1),
(3, 'Permiso Abrir/Cerrar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterramientos`
--

CREATE TABLE `enterramientos` (
  `idEnterramiento` int(11) NOT NULL,
  `idNicho` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `NombresFallecido` varchar(250) NOT NULL,
  `ApellidosFallecido` varchar(250) NOT NULL,
  `FUnoISAM` varchar(45) NOT NULL,
  `TipoInhumacion` varchar(45) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterramientosintitulo`
--

CREATE TABLE `enterramientosintitulo` (
  `idEnterramientoFosaComun` int(11) NOT NULL,
  `idCementerio` int(11) NOT NULL,
  `idTipoEnterramiento` int(11) NOT NULL,
  `NombreFallecido` varchar(250) NOT NULL,
  `ApellidosFallecido` varchar(250) NOT NULL,
  `Fecha` date NOT NULL,
  `Observaciones` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterramiento_cem_privado`
--

CREATE TABLE `enterramiento_cem_privado` (
  `idEnterramiento` int(11) NOT NULL,
  `Cementerios_idCementerio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exhumaciones`
--

CREATE TABLE `exhumaciones` (
  `idExhumacion` int(11) NOT NULL,
  `idEnterramiento` int(11) NOT NULL,
  `ViaJudicial` int(1) NOT NULL DEFAULT '0',
  `Fecha` date NOT NULL,
  `Observaciones` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nichos`
--

CREATE TABLE `nichos` (
  `idNicho` int(11) NOT NULL,
  `idParcela` int(11) NOT NULL,
  `idCtlEstadosNicho` int(11) NOT NULL,
  `NumeroOrden` int(11) NOT NULL DEFAULT '0',
  `Fecha` date NOT NULL,
  `Estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagosarrendamientos`
--

CREATE TABLE `pagosarrendamientos` (
  `idPagoArrendamiento` int(11) NOT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Direccion` varchar(55) DEFAULT NULL,
  `FechaPago` varchar(10) NOT NULL,
  `F1ISAM` varchar(45) NOT NULL,
  `Anios` int(2) NOT NULL,
  `idParcela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagosarrendamientos`
--

INSERT INTO `pagosarrendamientos` (`idPagoArrendamiento`, `Nombres`, `Apellidos`, `Direccion`, `FechaPago`, `F1ISAM`, `Anios`, `idParcela`) VALUES
(1, 'kevin', 'Mejia', 'Chalatenango, Chalatenango', '0000-00-00', 'PD1234', 2, 2),
(2, 'Andres', 'Rodriguez', 'Chalatenango, Chalatenango', '0000-00-00', 'PD1234', 2, 1),
(3, 'carmen', 'Mejia', 'Chalatenango, Chalatenango', '23/03/1998', 'PD1234', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcelas`
--

CREATE TABLE `parcelas` (
  `idParcela` int(11) NOT NULL,
  `idTipoParcela` int(11) NOT NULL,
  `idCementerio` int(11) NOT NULL,
  `Poligono` varchar(45) DEFAULT NULL,
  `CoordenadaX` varchar(45) DEFAULT NULL,
  `CoordenadaY` varchar(45) DEFAULT NULL,
  `Numero` varchar(45) NOT NULL,
  `Estado` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parcelas`
--

INSERT INTO `parcelas` (`idParcela`, `idTipoParcela`, `idCementerio`, `Poligono`, `CoordenadaX`, `CoordenadaY`, `Numero`, `Estado`) VALUES
(1, 1, 1, '14', '', '', '1234', 1),
(2, 2, 2, '20', NULL, NULL, '1654', 1);

--
-- Disparadores `parcelas`
--
DELIMITER $$
CREATE TRIGGER `Parcelas_AFTER_INSERT` AFTER INSERT ON `parcelas` FOR EACH ROW BEGIN

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoenterramiento`
--

CREATE TABLE `tipoenterramiento` (
  `idTipoEnterramiento` int(11) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipoenterramiento`
--

INSERT INTO `tipoenterramiento` (`idTipoEnterramiento`, `Tipo`, `Descripcion`, `Estado`) VALUES
(1, 'Fosa Comun', 'Inhumacion en fosa comun', 1),
(2, 'Cementerio Privado', 'Inhumacion en Cementerio privado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoparcela`
--

CREATE TABLE `tipoparcela` (
  `idTipoParcela` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipoparcela`
--

INSERT INTO `tipoparcela` (`idTipoParcela`, `Descripcion`) VALUES
(1, 'Perpetuidad'),
(2, 'Arrendamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotitulos`
--

CREATE TABLE `tipotitulos` (
  `idTipoTitulo` int(11) NOT NULL,
  `Tipo` varchar(60) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipotitulos`
--

INSERT INTO `tipotitulos` (`idTipoTitulo`, `Tipo`, `Descripcion`, `Estado`) VALUES
(1, 'Perpetuidad por Primera Vez', 'Título expedido por la autoridad municipal por primera vez', 1),
(2, 'Reposicion de Perpetuidad', 'Título expedido por la autoridad municipal en reposición de un título antiguo', 1),
(3, 'Traspaso', 'Título a perpetuidad por modificaciones en el registro', 1),
(4, 'Título Cancelado', 'Título a perpetuidad cancelado por modificaciones en el registro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos`
--

CREATE TABLE `titulos` (
  `idTitulo` int(11) NOT NULL,
  `idParcela` int(11) NOT NULL,
  `idTipoTitulo` int(11) NOT NULL,
  `NumeroTitulo` varchar(45) DEFAULT NULL,
  `idCiudadanoTitular` int(11) NOT NULL,
  `FechaExpedido` varchar(10) DEFAULT NULL,
  `NumeroRecibo` varchar(45) DEFAULT NULL,
  `FechaRecibo` varchar(10) DEFAULT NULL,
  `Imagen` varchar(500) DEFAULT NULL,
  `Observaciones` varchar(500) DEFAULT NULL,
  `Estado` int(1) NOT NULL DEFAULT '0',
  `Proceso` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `titulos`
--

INSERT INTO `titulos` (`idTitulo`, `idParcela`, `idTipoTitulo`, `NumeroTitulo`, `idCiudadanoTitular`, `FechaExpedido`, `NumeroRecibo`, `FechaRecibo`, `Imagen`, `Observaciones`, `Estado`, `Proceso`) VALUES
(1, 1, 3, '12345', 4, '23/03/2015', 'NF2345', '23/03/2015', 'fgsdfg', 'Se venció el plazo', 0, 0),
(6, 1, 3, '1254', 4, '23/03/2015', 'NF2345', '23/03/2015', 'fgsdfg', 'Se venció el plazo', 0, 0),
(7, 2, 1, '123456', 9, NULL, NULL, NULL, NULL, NULL, 0, 0),
(8, 1, 3, '54321', 4, '23/03/2015', 'NF2345', '23/03/2015', 'fgsdfg', 'Se venció el plazo', 0, 1),
(9, 1, 3, '1234', 4, '23/03/2015', 'NF2345', '23/03/2015', 'fgsdfg', 'Se venció el plazo', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslados`
--

CREATE TABLE `traslados` (
  `idTraslado` int(11) NOT NULL,
  `idEnterramiento` int(11) NOT NULL,
  `Interesado` varchar(200) NOT NULL,
  `Parentesco` varchar(45) NOT NULL,
  `Destino` varchar(200) NOT NULL,
  `Fecha` date NOT NULL,
  `Observaciones` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `NombreUsuario` varchar(45) NOT NULL,
  `CorreoUsuario` varchar(255) DEFAULT NULL,
  `Password` varchar(32) NOT NULL,
  `create_time` date NOT NULL,
  `Rol` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD PRIMARY KEY (`idBeneficiario`,`idTitulo`,`idCiudadano`),
  ADD KEY `fk_Beneficiarios_Titulos1_idx` (`idTitulo`),
  ADD KEY `fk_Beneficiarios_Ciudadanos1_idx` (`idCiudadano`);

--
-- Indices de la tabla `cementerios`
--
ALTER TABLE `cementerios`
  ADD PRIMARY KEY (`idCementerio`);

--
-- Indices de la tabla `ciudadanos`
--
ALTER TABLE `ciudadanos`
  ADD PRIMARY KEY (`idCiudadano`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`idConfiguracion`);

--
-- Indices de la tabla `ctlestadosnichos`
--
ALTER TABLE `ctlestadosnichos`
  ADD PRIMARY KEY (`idCtlEstadosNicho`);

--
-- Indices de la tabla `enterramientos`
--
ALTER TABLE `enterramientos`
  ADD PRIMARY KEY (`idEnterramiento`,`idNicho`),
  ADD KEY `fk_Enterramientos_Nichos1_idx` (`idNicho`);

--
-- Indices de la tabla `enterramientosintitulo`
--
ALTER TABLE `enterramientosintitulo`
  ADD PRIMARY KEY (`idEnterramientoFosaComun`,`idCementerio`,`idTipoEnterramiento`),
  ADD KEY `fk_Enterramiento_Fosa_Comun_Cementerios1_idx` (`idCementerio`),
  ADD KEY `fk_Enterramiento_Sin_Titulo_Tipo_Enterramiento1_idx` (`idTipoEnterramiento`);

--
-- Indices de la tabla `enterramiento_cem_privado`
--
ALTER TABLE `enterramiento_cem_privado`
  ADD PRIMARY KEY (`Cementerios_idCementerio`,`idEnterramiento`);

--
-- Indices de la tabla `exhumaciones`
--
ALTER TABLE `exhumaciones`
  ADD PRIMARY KEY (`idExhumacion`,`idEnterramiento`),
  ADD KEY `fk_Exhumaciones_Enterramientos1_idx` (`idEnterramiento`);

--
-- Indices de la tabla `nichos`
--
ALTER TABLE `nichos`
  ADD PRIMARY KEY (`idNicho`,`idParcela`,`idCtlEstadosNicho`),
  ADD KEY `fk_Nichos_Parcelas1_idx` (`idParcela`),
  ADD KEY `fk_Nichos_Ctl_Estados_Nichos1_idx` (`idCtlEstadosNicho`);

--
-- Indices de la tabla `pagosarrendamientos`
--
ALTER TABLE `pagosarrendamientos`
  ADD PRIMARY KEY (`idPagoArrendamiento`,`idParcela`),
  ADD KEY `fk_Pagos_Arrendamientos_Parcelas1_idx` (`idParcela`);

--
-- Indices de la tabla `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`idParcela`,`idTipoParcela`,`idCementerio`),
  ADD KEY `fk_Parcelas_Cementerios_idx` (`idCementerio`),
  ADD KEY `fk_Parcelas_Tipo_Parcela1_idx` (`idTipoParcela`);

--
-- Indices de la tabla `tipoenterramiento`
--
ALTER TABLE `tipoenterramiento`
  ADD PRIMARY KEY (`idTipoEnterramiento`);

--
-- Indices de la tabla `tipoparcela`
--
ALTER TABLE `tipoparcela`
  ADD PRIMARY KEY (`idTipoParcela`);

--
-- Indices de la tabla `tipotitulos`
--
ALTER TABLE `tipotitulos`
  ADD PRIMARY KEY (`idTipoTitulo`);

--
-- Indices de la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD PRIMARY KEY (`idTitulo`,`idParcela`,`idTipoTitulo`,`idCiudadanoTitular`),
  ADD KEY `fk_Titulos_Parcelas1_idx` (`idParcela`),
  ADD KEY `fk_Titulos_Tipo_Titulos1_idx` (`idTipoTitulo`),
  ADD KEY `fk_Titulos_Ciudadanos1_idx` (`idCiudadanoTitular`);

--
-- Indices de la tabla `traslados`
--
ALTER TABLE `traslados`
  ADD PRIMARY KEY (`idTraslado`,`idEnterramiento`),
  ADD KEY `fk_Traslados_Enterramientos1_idx` (`idEnterramiento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  MODIFY `idBeneficiario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cementerios`
--
ALTER TABLE `cementerios`
  MODIFY `idCementerio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ciudadanos`
--
ALTER TABLE `ciudadanos`
  MODIFY `idCiudadano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `idConfiguracion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ctlestadosnichos`
--
ALTER TABLE `ctlestadosnichos`
  MODIFY `idCtlEstadosNicho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `enterramientos`
--
ALTER TABLE `enterramientos`
  MODIFY `idEnterramiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `enterramientosintitulo`
--
ALTER TABLE `enterramientosintitulo`
  MODIFY `idEnterramientoFosaComun` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `exhumaciones`
--
ALTER TABLE `exhumaciones`
  MODIFY `idExhumacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nichos`
--
ALTER TABLE `nichos`
  MODIFY `idNicho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagosarrendamientos`
--
ALTER TABLE `pagosarrendamientos`
  MODIFY `idPagoArrendamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `idParcela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoenterramiento`
--
ALTER TABLE `tipoenterramiento`
  MODIFY `idTipoEnterramiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoparcela`
--
ALTER TABLE `tipoparcela`
  MODIFY `idTipoParcela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipotitulos`
--
ALTER TABLE `tipotitulos`
  MODIFY `idTipoTitulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `titulos`
--
ALTER TABLE `titulos`
  MODIFY `idTitulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `traslados`
--
ALTER TABLE `traslados`
  MODIFY `idTraslado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD CONSTRAINT `fk_Beneficiarios_Ciudadanos1` FOREIGN KEY (`idCiudadano`) REFERENCES `ciudadanos` (`idCiudadano`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Beneficiarios_Titulos1` FOREIGN KEY (`idTitulo`) REFERENCES `titulos` (`idTitulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `enterramientos`
--
ALTER TABLE `enterramientos`
  ADD CONSTRAINT `fk_Enterramientos_Nichos1` FOREIGN KEY (`idNicho`) REFERENCES `nichos` (`idNicho`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `enterramientosintitulo`
--
ALTER TABLE `enterramientosintitulo`
  ADD CONSTRAINT `fk_Enterramiento_Fosa_Comun_Cementerios1` FOREIGN KEY (`idCementerio`) REFERENCES `cementerios` (`idCementerio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Enterramiento_Sin_Titulo_Tipo_Enterramiento1` FOREIGN KEY (`idTipoEnterramiento`) REFERENCES `tipoenterramiento` (`idTipoEnterramiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `enterramiento_cem_privado`
--
ALTER TABLE `enterramiento_cem_privado`
  ADD CONSTRAINT `fk_Enterramiento_Cem_Privado_Cementerios1` FOREIGN KEY (`Cementerios_idCementerio`) REFERENCES `cementerios` (`idCementerio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `exhumaciones`
--
ALTER TABLE `exhumaciones`
  ADD CONSTRAINT `fk_Exhumaciones_Enterramientos1` FOREIGN KEY (`idEnterramiento`) REFERENCES `enterramientos` (`idEnterramiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nichos`
--
ALTER TABLE `nichos`
  ADD CONSTRAINT `fk_Nichos_Ctl_Estados_Nichos1` FOREIGN KEY (`idCtlEstadosNicho`) REFERENCES `ctlestadosnichos` (`idCtlEstadosNicho`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Nichos_Parcelas1` FOREIGN KEY (`idParcela`) REFERENCES `parcelas` (`idParcela`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagosarrendamientos`
--
ALTER TABLE `pagosarrendamientos`
  ADD CONSTRAINT `fk_Pagos_Arrendamientos_Parcelas1` FOREIGN KEY (`idParcela`) REFERENCES `parcelas` (`idParcela`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `parcelas`
--
ALTER TABLE `parcelas`
  ADD CONSTRAINT `fk_Parcelas_Cementerios` FOREIGN KEY (`idCementerio`) REFERENCES `cementerios` (`idCementerio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Parcelas_Tipo_Parcela1` FOREIGN KEY (`idTipoParcela`) REFERENCES `tipoparcela` (`idTipoParcela`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD CONSTRAINT `fk_Titulos_Ciudadanos1` FOREIGN KEY (`idCiudadanoTitular`) REFERENCES `ciudadanos` (`idCiudadano`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Titulos_Parcelas1` FOREIGN KEY (`idParcela`) REFERENCES `parcelas` (`idParcela`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Titulos_Tipo_Titulos1` FOREIGN KEY (`idTipoTitulo`) REFERENCES `tipotitulos` (`idTipoTitulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `traslados`
--
ALTER TABLE `traslados`
  ADD CONSTRAINT `fk_Traslados_Enterramientos1` FOREIGN KEY (`idEnterramiento`) REFERENCES `enterramientos` (`idEnterramiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
