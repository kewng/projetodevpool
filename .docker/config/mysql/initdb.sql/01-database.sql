CREATE USER 'root'@'localhost' IDENTIFIED BY 'asdf000';

CREATE SCHEMA `devpool_erp` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `devpool_erp`;

CREATE TABLE IF NOT EXISTS `devpool_erp`.`exemplo` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) NOT NULL,
	`dataCriacao` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `devpool_erp`.`produtos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) NOT NULL,
	`descricao` TEXT NULL,
	`preco` DECIMAL(11,2) NOT NULL,
	`unidadeMedida` VARCHAR NULL,
	`situacao`CHAR(1) NOT NULL,
	PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `devpool_erp`.`vendaItem` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`idVenda` INT(11) NOT NULL,
	`idProduto` INT(11) NOT NULL,
	`quantidade` INT(11) NOT NULL,
	`preco` DECIMAL(11,2) NOT NULL,
	PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `devpool_erp`.`venda` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) NOT NULL,
	`dataVenda` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
	`subtotal` DECIMAL(11,2) NOT NULL,
	`desconto` INT(3) NOT NULL,
	`totalVenda` DECIMAL(11,2) NOT NULL,
	`produtos` TEXT NOT NULL,
	PRIMARY KEY (`id`));

