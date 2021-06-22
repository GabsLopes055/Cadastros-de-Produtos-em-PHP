-- MySQL Script generated by MySQL Workbench
-- Mon May  3 22:08:06 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering
SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS,
	UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS,
	FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE,
	SQL_MODE = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8;
USE `mydb`;
-- -----------------------------------------------------
-- Table `mydb`.`USUARIOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`USUARIOS` (
	`ID_USUARIO` INT NOT NULL AUTO_INCREMENT,
	`NOME_COMPLETO` VARCHAR(45) NOT NULL,
	`NOME_USUARIO` VARCHAR(45) NOT NULL,
	`SENHA` INT(32) NOT NULL,
	`CARGO` ENUM('Administrador', 'Gerente', 'Funcionario') NOT NULL,
	`DATA_CADASTRO` DATE NOT NULL,
	PRIMARY KEY (`ID_USUARIO`),
	UNIQUE INDEX `ID_USUARIO_UNIQUE` (`ID_USUARIO` ASC) VISIBLE
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `mydb`.`LISTA_PEDIDOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`LISTA_PEDIDOS` (
	`ID_LISTA` INT NOT NULL AUTO_INCREMENT,
	`TITULO` VARCHAR(255) NOT NULL,
	`DATA_CADASTRO` DATE NOT NULL,
	`PEDIDO` VARCHAR(45) NOT NULL,
	`LISTA_PEDIDOS` TEXT NOT NULL,
	`ID_USUARIO_CADASTRO` INT NOT NULL,
	PRIMARY KEY (`ID_LISTA`),
	INDEX `fk_LISTA_PEDIDOS_USUARIOS_idx` (`ID_USUARIO_CADASTRO` ASC) VISIBLE,
	CONSTRAINT `fk_LISTA_PEDIDOS_USUARIOS` FOREIGN KEY (`ID_USUARIO_CADASTRO`) REFERENCES `mydb`.`USUARIOS` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `mydb`.`FORNECEDOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`FORNECEDOR` (
	`ID_FORNECEDOR` INT NOT NULL AUTO_INCREMENT,
	`NOME_FORNECEDOR` VARCHAR(45) NOT NULL,
	`DATA_CADASTRO` DATE NOT NULL,
	`ENDERECO_FORNECEDOR` VARCHAR(100) NOT NULL,
	`CONTATO_FORNECEDOR` VARCHAR(50) NOT NULL,
	`USUARIOS_ID_USUARIO` INT NOT NULL,
	PRIMARY KEY (`ID_FORNECEDOR`),
	INDEX `fk_FORNECEDOR_USUARIOS1_idx` (`USUARIOS_ID_USUARIO` ASC) VISIBLE,
	CONSTRAINT `fk_FORNECEDOR_USUARIOS1` FOREIGN KEY (`USUARIOS_ID_USUARIO`) REFERENCES `mydb`.`USUARIOS` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `mydb`.`ENTRADA_PRODUTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ENTRADA_PRODUTO` (
	`ID_PRODUTO` INT NOT NULL AUTO_INCREMENT,
	`NOME_PRODUTO` VARCHAR(100) NOT NULL,
	`QUANTIDADE` INT NOT NULL,
	`DATA_CADASTRO` DATE NOT NULL,
	`VALOR_UNITARIO` DECIMAL(10, 2) NOT NULL,
	`NUMERO_NOTA` INT NOT NULL,
	`FORNECEDOR_ID_FORNECEDOR` INT NOT NULL,
	`ID_USUARIO_CADASTRO` INT NOT NULL,
	PRIMARY KEY (`ID_PRODUTO`),
	INDEX `fk_ENTRADA_PRODUTO_FORNECEDOR1_idx` (`FORNECEDOR_ID_FORNECEDOR` ASC) VISIBLE,
	INDEX `fk_ENTRADA_PRODUTO_USUARIOS1_idx` (`ID_USUARIO_CADASTRO` ASC) VISIBLE,
	CONSTRAINT `fk_ENTRADA_PRODUTO_FORNECEDOR1` FOREIGN KEY (`FORNECEDOR_ID_FORNECEDOR`) REFERENCES `mydb`.`FORNECEDOR` (`ID_FORNECEDOR`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT `fk_ENTRADA_PRODUTO_USUARIOS1` FOREIGN KEY (`ID_USUARIO_CADASTRO`) REFERENCES `mydb`.`USUARIOS` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `mydb`.`ESTOQUE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ESTOQUE` (
	`ID_PRODUTO_ESTOQUE` INT NOT NULL AUTO_INCREMENT,
	`QUANTIDADE` INT NOT NULL,
	`ESTOQUE_MINIMO` INT NULL,
	`ENTRADA_PRODUTO_ID_PRODUTO` INT NOT NULL,
	PRIMARY KEY (`ID_PRODUTO_ESTOQUE`),
	INDEX `fk_ESTOQUE_ENTRADA_PRODUTO1_idx` (`ENTRADA_PRODUTO_ID_PRODUTO` ASC) VISIBLE,
	CONSTRAINT `fk_ESTOQUE_ENTRADA_PRODUTO1` FOREIGN KEY (`ENTRADA_PRODUTO_ID_PRODUTO`) REFERENCES `mydb`.`ENTRADA_PRODUTO` (`ID_PRODUTO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `mydb`.`SAIDA_PRODUTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`SAIDA_PRODUTO` (
	`ID_VENDA` INT NOT NULL AUTO_INCREMENT,
	`QUANTIDADE` INT NOT NULL,
	`VALOR_VENDA` DECIMAL(10, 2) NOT NULL,
	`DATA_VENDA` DATE NOT NULL,
	`FORMA_PAGAMENTO` ENUM('DIN', 'CRE', 'DEB') NOT NULL,
	`ID_USUARIO_CADASTRO` INT NOT NULL,
	`ID_PRODUTO_ESTOQUE` INT NOT NULL,
	PRIMARY KEY (`ID_VENDA`),
	INDEX `fk_SAIDA_PRODUTO_USUARIOS1_idx` (`ID_USUARIO_CADASTRO` ASC) VISIBLE,
	INDEX `fk_SAIDA_PRODUTO_ESTOQUE1_idx` (`ID_PRODUTO_ESTOQUE` ASC) VISIBLE,
	CONSTRAINT `fk_SAIDA_PRODUTO_USUARIOS1` FOREIGN KEY (`ID_USUARIO_CADASTRO`) REFERENCES `mydb`.`USUARIOS` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT `fk_SAIDA_PRODUTO_ESTOQUE1` FOREIGN KEY (`ID_PRODUTO_ESTOQUE`) REFERENCES `mydb`.`ESTOQUE` (`ID_PRODUTO_ESTOQUE`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;
SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
/* ALIMENTANDO TABELAS */
-- USUARIOS
-- INSERT INTO `usuarios`(
-- 		`NOME_COMPLETO`,
-- 		`NOME_USUARIO`,
-- 		`SENHA`,
-- 		`CARGO`,
-- 		`DATA_CADASTRO`
-- 	)
-- VALUES (
-- 		'GABRIEL LOPES TEIXEIRA',
-- 		'GABRIEL.TEIXEIRA',
-- 		md5('123'),
-- 		'GERENTE',
-- 		now()
-- 	);
-- -- FORNECEDORES
-- INSERT INTO `fornecedor`(
-- 		`NOME_FORNECEDOR`,
-- 		`DATA_CADASTRO`,
-- 		`ENDERECO_FORNECEDOR`,
-- 		`CONTATO_FORNECEDOR`,
-- 		`USUARIOS_ID_USUARIO`
-- 	)
-- VALUES (
-- 		'FORNECEDOR 2',
-- 		NOW(),
-- 		'SÃO PAULO2',
-- 		'FORNECEDOR2@GMAIL.COM',
-- 		2
-- 	);
-- INSERT INTO `fornecedor`(
-- 		`NOME_FORNECEDOR`,
-- 		`DATA_CADASTRO`,
-- 		`ENDERECO_FORNECEDOR`,
-- 		`CONTATO_FORNECEDOR`,
-- 		`USUARIOS_ID_USUARIO`
-- 	)
-- VALUES (
-- 		'FORNECEDOR 5',
-- 		NOW(),
-- 		'SÃO PAULO5',
-- 		'FORNECEDOR5@GMAIL.COM',
-- 		(
-- 			SELECT NOME_COMPLETO
-- 			FROM USUARIOS
-- 			WHERE ID_USUARIO = 4
-- 		)
-- 	);
-- SELECT F.NOME_FORNECEDOR,
-- 	F.DATA_CADASTRO,
-- 	F.ENDERECO_FORNECEDOR,
-- 	F.CONTATO_FORNECEDOR,
-- 	U.NOME_COMPLETO AS 'QUEM CADASTROU'
-- FROM FORNECEDOR F
-- 	INNER JOIN USUARIOS U
-- WHERE USUARIOS_ID_USUARIO = ID_USUARIO;
-- -- ENTRADA DE PRODUTOS
-- INSERT INTO `entrada_produto`(
-- 		`NOME_PRODUTO`,
-- 		`QUANTIDADE`,
-- 		`DATA_CADASTRO`,
-- 		`VALOR_UNITARIO`,
-- 		`NUMERO_NOTA`,
-- 		`FORNECEDOR_ID_FORNECEDOR`,
-- 		`ID_USUARIO_CADASTRO`
-- 	)
-- VALUES (
-- 		'CAPA MOTOROLA - MOTO G8',
-- 		10,
-- 		NOW(),
-- 		9.90,
-- 		8263,
-- 		4,
-- 		4
-- 	);
-- SELECT PRODUTO.NOME_PRODUTO,
-- 	PRODUTO.QUANTIDADE,
-- 	PRODUTO.VALOR_UNITARIO,
-- 	PRODUTO.NUMERO_NOTA,
-- 	FORNECEDOR.NOME_FORNECEDOR AS 'FORNECEDOR',
-- 	USUARIOS.NOME_USUARIO AS 'QUEM CADASTROU'
-- FROM ENTRADA_PRODUTO PRODUTO
-- 	INNER JOIN FORNECEDOR FORNECEDOR ON FORNECEDOR_ID_FORNECEDOR = ID_FORNECEDOR
-- 	INNER JOIN USUARIOS USUARIOS ON ID_USUARIO_CADASTRO = ID_USUARIO;

-- SELECT F.* FROM fornecedor F INNER JOIN usuarios U ON USUARIOS_ID_USUARIO = ID_USUARIO