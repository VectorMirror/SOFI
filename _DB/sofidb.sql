CREATE TABLE `roles` (
  `rol_id` INT(11) NOT NULL AUTO_INCREMENT,
  `rol_permiso` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `roles` (`rol_id`, `rol_permiso`) VALUES
(1, 'Administrador'),
(2, 'Director'),
(3, 'Subdirector'),
(4, 'Departamento');

CREATE TABLE `unidades` (
  `uni_id` INT(11) NOT NULL AUTO_INCREMENT,
  `uni_num` INT(11) NOT NULL,
  `uni_unidad` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`uni_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `unidades` (`uni_id`, `uni_num`, `uni_unidad`) VALUES
(1, 100, 'SECRETARIO DEL RAMO '),
(2, 102, 'DIRECCION GENERAL DE VINCULACION'),
(3, 110, 'UNIDAD DE ASUNTOS JURIDICOS'),
(4, 111, 'DIRIRECCION GENERAL DE COMUNICACION SOCIAL'),
(5, 112, 'ORGANO INTERNO DE CONTROL'),
(6, 114, 'DIRECCION GENERAL DE PLANEACION'),
(7, 200, 'SUBSECRETARIO DE INFRAESTRUCTURA'),
(8, 205, 'U. INFRAESTRUCTURA CARRETERA PARA EL DESARROLLO REG'),
(9, 210, 'DIR. GRAL. DE CARRETERAS'),
(10, 211, 'DIR. GRAL. DE CONSERVACION DE CARRETERAS'),
(11, 212, 'DIR. GRAL. DE SERVICIOS TECNICOS'),
(12, 214, 'DIR. GRAL. DE DESARROLLO CARRETERO'),
(13, 300, 'SUBSECRETARIA DEL TRANSPORTE'),
(14, 310, 'DIR. GRAL. DE AERONAUTICA CIVIL'),
(15, 311, 'DIRECCION GENERAL DE DESARROLLO FERROVIARIO Y MULTIMODAL'),
(16, 312, 'DIR. GRAL. DE AUTOTRANSPORTE FEDERAL'),
(17, 313, 'DIR. GRAL. DE PROTECT. Y MED. PREV. EN EL TRANSP'),
(18, 400, 'SUBSECRETARIA DE COMUNICACIONES'),
(19, 410, 'DIR. GRAL. DE SISTEMAS DE RADIO Y TELEVISION'),
(20, 411, 'DIR. GRAL. DE POLITICA DE TELECOMUNICACIONES Y RADIODIFUSION'),
(21, 414, 'UNIDAD DE LA RED FEDERAL'),
(22, 415, 'COORDINACION DE LA SOCIEDAD DE LA INFORMACION Y EL CONOCIMIENTO'),
(23, 500, 'COORD. GENERAL DE PUERTOS Y MARINA MERCANTE'),
(24, 510, 'DIR. GRAL. DE PUERTOS'),
(25, 511, 'DIR. GRAL. DE MARINA MERCANTE'),
(26, 512, 'DIR. GRAL. DE FOMENTO Y ADMINISTRACION PORTUARIA'),
(27, 600, 'COORDINACION GENERAL DE CENTRO S.C.T'),
(28, 611, 'DIR. GRAL. DE EVALUACION'),
(29, 621, 'CENTRO S.C.T AGUASCALIENTES'),
(30, 622, 'CENTRO S.C.T BAJA CALIFORNIA'),
(31, 623, 'CENTRO S.C.T BAJA CALIFORNIA SUR'),
(32, 624, 'CENTRO S.C.T CAMPECHE'),
(33, 625, 'CENTRO S.C.T COAHUILA'),
(34, 626, 'CENTRO S.C.T COLIMA'),
(35, 627, 'CENTRO S.C.T CHIAPAS'),
(36, 628, 'CENTRO S.C.T CHIHUAHUA'),
(37, 630, 'CENTRO S.C.T DURANGO'),
(38, 631, 'CENTRO S.C.T GUANAJUATO'),
(39, 632, 'CENTRO S.C.T GUERRERO'),
(40, 633, 'CENTRO S.C.T HIDALGO'),
(41, 634, 'CENTRO S.C.T JALISCO'),
(42, 635, 'CENTRO S.C.T MEXICO'),
(43, 636, 'CENTRO S.C.T MICHOACAN'),
(44, 637, 'CENTRO S.C.T MORELOS'),
(45, 638, 'CENTRO S.C.T NAYARIT'),
(46, 639, 'CENTRO S.C.T NUEVO LEON'),
(47, 640, 'CENTRO S.C.T OAXACA'),
(48, 641, 'CENTRO S.C.T PUEBLA'),
(49, 642, 'CENTRO S.C.T QUERETARO'),
(50, 643, 'CENTRO S.C.T QUINTANA ROO'),
(51, 644, 'CENTRO S.C.T SAN LUIS POTOSI'),
(52, 645, 'CENTRO S.C.T SINALOA'),
(53, 646, 'CENTRO S.C.T SONORA'),
(54, 647, 'CENTRO S.C.T TABASCO'),
(55, 648, 'CENTRO S.C.T TAMAULIPAS'),
(56, 649, 'CENTRO S.C.T TLAXCALA'),
(57, 650, 'CENTRO S.C.T VERACRUZ'),
(58, 651, 'CENTRO S.C.T YUCATAN'),
(59, 652, 'CENTRO S.C.T ZACATECAS'),
(60, 700, 'UNIDAD DE ADMINISTRACION Y FINANZAS'),
(61, 710, 'DIR. GRAL. DE PROG. ORGANIZACION Y PRESUP.'),
(62, 711, 'DIR. GRAL. DE RECURSOS HUMANOS'),
(63, 712, 'DIR. GRAL. DE RECURSOS MATERIALES'),
(64, 713, 'UNIDAD DE TECNOLOGIA DE INFORMACION Y COMUNICACIONES');


CREATE TABLE `remitentes`(
    `rem_id` INT(11) NOT NULL AUTO_INCREMENT,
    `rem_remitente` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`rem_id`)
)ENGINE = INNODB DEFAULT CHARSET = utf8;

CREATE TABLE `destinatarios`(
    `dest_id` INT(11) NOT NULL AUTO_INCREMENT,
    `dest_destinatario` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`dest_id`)
)ENGINE = INNODB DEFAULT CHARSET = utf8;

    
    create TABLE `empresas`(
    `emp_id`INT(11) not null AUTO_INCREMENT,
    `emp_empresa` VARCHAR(50)not null,
    PRIMARY key(`emp_id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cargos`(
    `cargo_id` INT(11) NOT NULL AUTO_INCREMENT,
    `cargo_cargo` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`cargo_id`)
)ENGINE = INNODB DEFAULT CHARSET = utf8;

INSERT INTO `cargos` (`cargo_id`, `cargo_cargo`) VALUES
(1, 'Dirección Coordinadora de Innovación y Desarrollo Tecnológico'),
(2, 'Dirección de Desarrollo Tecnológico'),
(3, 'Dirección de Administración y Gestión Electrónica de Documentos'),
(4, 'Subdirección de Sistemas Administrativos'),
(5, 'Subdirección de Implementación y Administración de Aplicaciones'),
(6, 'Subdirección de Gestión Electrónica de Documentos'),
(7, 'Departamento de Portales y Administración de Contenido'),
(8, 'Departamento de Sistemas Ejecutivos');

CREATE TABLE `usuarios` (
  `usu_id` INT(11) NOT NULL AUTO_INCREMENT,
  `usu_nombre` VARCHAR(50) NOT NULL,
  `usu_apellidoP` VARCHAR(50) NOT NULL,
  `usu_apellidoM` VARCHAR(50) NOT NULL,
  `usu_adscripcion` INT(11) NOT NULL,
  `usu_correo` VARCHAR(50) NOT NULL,
  `usu_pass` VARCHAR (100) NOT NULL,
  `usu_activo` INT(1) NOT NULL DEFAULT 0,
  `usu_rol` INT(11) NOT NULL,
  `usu_unidad` INT(11) NOT NULL,
  `usu_fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usu_id`), 
  FOREIGN KEY (`usu_adscripcion`) REFERENCES `cargos`(`cargo_id`),
  FOREIGN KEY (`usu_rol`) REFERENCES `roles`(`rol_id`),
  FOREIGN KEY (`usu_unidad`) REFERENCES `unidades`(`uni_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `oficios` (
  `ofi_id` INT(11) NOT NULL AUTO_INCREMENT,
  `ofi_subidoPor` INT(11) NOT NULL,
  `ofi_caracter` VARCHAR(50) NOT NULL,
  `ofi_referencia` VARCHAR(30) NOT NULL DEFAULT 'N/A',
  `ofi_numero` VARCHAR(30) NOT NULL DEFAULT 'N/A',
  `ofi_respuesta` VARCHAR(5) NOT NULL DEFAULT 'N/A',
  `ofi_activo` INT(2) NOT NULL DEFAULT 0,
  `ofi_remitente` INT(11) NOT NULL,
  `ofi_destinatario` INT(11) NOT NULL,
  `ofi_cargo` INT(11) DEFAULT NULL,
  `ofi_unidad` INT(11) DEFAULT NULL,
  `ofi_empresa` INT(11) DEFAULT NULL,
  `ofi_asunto` VARCHAR(50) NOT NULL,
  `ofi_descripcion` VARCHAR(250) NOT NULL,
  `ofi_fechaE` DATE NOT NULL,
  `ofi_fechaSICT` DATE DEFAULT NULL,
  `ofi_fechaResp` DATE DEFAULT NULL,
  `ofi_fechaSOFI` DATETIME NOT NULL DEFAULT current_timestamp(),
  `ofi_url` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`ofi_id`),
  FOREIGN KEY (`ofi_subidoPor`) REFERENCES `usuarios`(`usu_id`),
  FOREIGN KEY (`ofi_remitente`) REFERENCES `remitentes`(`rem_id`),
  FOREIGN KEY (`ofi_destinatario`) REFERENCES `destinatarios`(`dest_id`),
  FOREIGN KEY (`ofi_cargo`) REFERENCES `cargos`(`cargo_id`),
  FOREIGN KEY (`ofi_unidad`) REFERENCES `unidades`(`uni_id`),
  FOREIGN KEY (`ofi_empresa`) REFERENCES `empresas`(`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;