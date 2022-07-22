<!-- 
  CREATE TABLE `usuarios` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`senha` VARCHAR(255) NOT NULL,
	`data_criado` DATETIME NOT NULL COMMENT 'CURRENT_TIMESTAMP',
	`admin` BOOLEAN COMMENT 'false',
  primary key(id)
); 
-->