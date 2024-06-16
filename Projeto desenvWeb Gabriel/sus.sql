CREATE SCHEMA `web` ;

CREATE TABLE `usuarios` (
  `idusuarios` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `paciente` (
  `cns` bigint NOT NULL,
  `nome_paciente` varchar(80) NOT NULL,
  `idade_paciente` int NOT NULL,
  PRIMARY KEY (`cns`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `medico` (
  `crm` varchar(11) NOT NULL,
  `nome_medico` varchar(80) NOT NULL,
  `espec_medico` varchar(45) NOT NULL,
  PRIMARY KEY (`crm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `hospital` (
  `codigo_hosp` int NOT NULL,
  `endereco_hosp` varchar(45) NOT NULL,
  `nome_hosp` varchar(45) NOT NULL,
  `idhospital` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idhospital`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `enfermeiro` (
  `coren` varchar(16) NOT NULL,
  `nome_enfermeiro` varchar(45) NOT NULL,
  `cargo_enfermeiro` varchar(45) NOT NULL,
  PRIMARY KEY (`coren`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `consulta` (
  `idconsulta` int NOT NULL AUTO_INCREMENT,
  `cns` bigint DEFAULT NULL,
  `crm` varchar(11) DEFAULT NULL,
  `coren` varchar(16) DEFAULT NULL,
  `data_consulta` varchar(45) DEFAULT NULL,
  `codigo_hosp` int DEFAULT NULL,
  PRIMARY KEY (`idconsulta`),
  KEY `cns_idx` (`cns`),
  KEY `crm_idx` (`crm`),
  KEY `coden_idx` (`coren`),
  KEY `codigo_hosp_idx` (`codigo_hosp`),
  CONSTRAINT `cns` FOREIGN KEY (`cns`) REFERENCES `paciente` (`cns`),
  CONSTRAINT `codigo_hosp` FOREIGN KEY (`codigo_hosp`) REFERENCES `hospital` (`idhospital`),
  CONSTRAINT `coren` FOREIGN KEY (`coren`) REFERENCES `enfermeiro` (`coren`),
  CONSTRAINT `crm` FOREIGN KEY (`crm`) REFERENCES `medico` (`crm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

