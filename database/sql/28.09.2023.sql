ALTER TABLE `com_vistorias`
	ADD COLUMN `operador_id` INT NOT NULL COMMENT 'Nome do Operador' AFTER `ck_clas_risc_muito_alta`;

	RENAME TABLE gestaocedeclaravel.cedec_rpm TO gestaocedeclaravel.cedec_rdc;
ALTER TABLE gestaocedeclaravel.cedec_rdc 
COMMENT='RDC - Região de Defesa Civil';

ALTER TABLE gestaocedeclaravel.aju_pedido_pedidos ADD updated_at TIMESTAMP NULL;
ALTER TABLE gestaocedeclaravel.aju_pedido_pedidos ADD created_at TIMESTAMP NULL;

ALTER TABLE `com_comdec`
	ADD COLUMN `regiaodc` INT NULL DEFAULT NULL COMMENT 'Regiao de Defes Civil' AFTER `updated_at`;


