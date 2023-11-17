CREATE TABLE `com_rat` (
	`id` INT NULL COMMENT 'Identificador RAT',
	`dt_ocorrencia` TIMESTAMP NULL COMMENT 'Data da Ocorrência',
	`operador_id` INT NULL DEFAULT NULL COMMENT 'Operador',
	`ocorrencia_id` INT NULL DEFAULT NULL COMMENT 'Cod Ocorrência',
	`alvo_id` INT NULL DEFAULT NULL COMMENT 'Cod Alvo',
	`cobrade_id` INT NULL DEFAULT NULL COMMENT 'Cod Cobrade',
	`lugar_descricao` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Descrição do Lugar',
	`operacao_nome` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Nome da Operação',
	`endereco` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Endereço da Ocorrência',
	`numero` VARCHAR(10) NULL DEFAULT NULL COMMENT 'Número',
	`bairro` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Bairro',
	`estado` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Estado',
	`referencia` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Referência',
	`acoes` MEDIUMTEXT NULL COMMENT 'Ações Executradas'
)
COMMENT='Relatorio de Atividades Técnicas'
COLLATE='utf8mb3_general_ci'
;

ALTER TABLE `com_rat`
	CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador RAT' FIRST,
	ADD COLUMN `update_at` TIMESTAMP NULL DEFAULT NULL AFTER `acoes`,
	ADD COLUMN `created_at` TIMESTAMP NULL DEFAULT NULL AFTER `update_at`,
	ADD PRIMARY KEY (`id`);

ALTER TABLE `com_rat`
	ADD COLUMN `num_ocorrencia` VARCHAR(12) NOT NULL DEFAULT '0' AFTER `id`;

	ALTER TABLE `com_rat`
	CHANGE COLUMN `update_at` `updated_at` TIMESTAMP NULL DEFAULT NULL AFTER `acoes`;

	CREATE TABLE `com_rat_ocorrencia` (
	`id` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Tabela',
	`cod` VARCHAR(10) NULL DEFAULT NULL COMMENT 'Codigo da Ocorrência',
	`descricao` VARCHAR(70) NULL DEFAULT NULL COMMENT 'Descrição da Ocorrência',
	PRIMARY KEY (`id`)
)
COMMENT='Rat Código Ocorrencia'
COLLATE='utf8mb3_general_ci'
;
ALTER TABLE `com_rat_ocorrencia`
	CHANGE COLUMN `descricao` `descricao` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Descrição da Ocorrência' COLLATE 'utf8mb3_general_ci' AFTER `cod`;

/*insert into com_rat_ocorrencia (cod, descricao) values ('DC0001', 'REUNIÃO COMUNITÁRIA OU COM ENTIDADES DIVERSAS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0002', 'REUNIÃO COM ASSOCIAÇÃO DE MORADORES');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0003', 'REUNIÃO COM OUTROS TIPOS DE ENTIDADES');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0004', 'AÇÃO CIVICO-SOCIAL (ACISO)');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0005', 'PARTICIPAÇÃO EM REUNIÕES DE MEIO AMBIENTE');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0006', 'OUTRAS	AÇÕES	DE	DEFESA	SOCIAL	(DISCRIMINAR	NO HISTÓRICO)');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0007', 'VISTORIA EM RISCO DE DESABAMENTO/DESMORONAMENTO');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0008', 'VISTORIA EM RISCO DE DESLIZARNENTO / CORRIDA DE MASSA');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0009', 'VISTORIA EM RISCO DE ROMPIMENTO DE BARRAGENS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0010', 'VISTORIA EM RISCO DE INUNDAÇÃO / ALAGAMENTO / ENXURRADA');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0011', 'OUTROS TIPOS DE VISTORIAS OPERACIONAIS DIVERSAS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0012', 'DEMONSTRAÇÕES PROFISSIONAIS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0013', 'ATIVIDADES EM ESTANDES');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0014', 'VOO DE DEMONSTRAÇÃO');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0015', 'OUTROS TIPOS DE DEMONSTRAÇÕES PROFISSIONAIS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0016', 'PALESTRA DE DEFESA CIVIL');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0017', 'OUTROS TIPOS DE PALESTRAS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0018', 'PROJETOS SOCIAIS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0019', 'ABASTECIMENTO DE ÁGUA');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0020', 'DISTRIBUIÇÃO DE MATERIAIS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0021', 'EVACUAÇÃO DE ÁREAS DE RISCO');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0022', 'OUTROS TIPOS DE AÇÕES DE APOIO À COMUNIDADE');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0023', 'ABALOS SÍSMICOS. (TREMORES DE TERRA)');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0024', 'DESCARGAS ATMOSTENCAS (RAIOS)');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0025', 'VENDAVAL');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0026', 'CHUVAS INTENSAS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0027', 'GRANIZO');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0028', 'QUEDAS TOMBAMENTOS ROLAMENTOS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0029', 'DESLIZAMENTOS CORRIDA DE MASSA');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0030', 'INUNDAÇÕES / ALAGAMENTOS / ENXURRADAS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0031', 'OUTROS TIPOS DE DESASTRES/EVENTOS DE GRANDE IMPACTO DE ORIGEM NATURAL');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0032', 'ROMPIMENTO E COLAPSO DE BARRAGENS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0033', 'COLAPSO DE EDIFICAÇÕES');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0034', 'OUTROS TIPOS DE DESASTRES / EVENTOS DE GRANDE IMPACTO DE ORIGEM TECNOLÓGICA');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0035', 'MAPEAMENTO DE ÁREAS DE RISCO');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0036', 'MONITORAMENTO');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0037', 'ORIENTAÇÃO À POPULAÇÃO RESIDENTE EM ÁREAS DE RISCO');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0038', 'AÇÕES	DE	PREPARAÇÃO	ENVOLVENDO	DEFESA	CIVIL ESTADUAL/MUNICIPAL');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0039', 'OUTROS TIPOS DE AÇÕES DA GESTÃO DO RISCO DE DESASTRE');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0040', 'COMUNICAÇOES, DENÚNCIAS, RECLAMAÇÕES E SOLICITAÇÕES DIVERSAS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0041', 'APOIO A ÓRGÃOS FEDERAIS ');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0042', 'APOIO A ÓRGÃOS ESTADUAIS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0043', 'APOIO A ÓRGÃOS MUNICIPAIS');
insert into com_rat_ocorrencia (cod, descricao) values ('DC0044', 'APOIO A EMPRESAS / INSTITUIÇÕES PRIVADAS');*/

CREATE TABLE `com_rat_alvo` (
	`id` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador da Tabela',
	`alvo` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Nome do Alvo',
	PRIMARY KEY (`id`)
)
COMMENT='Alvo da Ocorrencia RAT'
COLLATE='utf8mb3_general_ci'
;

/*
insert into com_rat_alvo (alvo) values ("PESSOA");
insert into com_rat_alvo (alvo) values ("INSTITUICAO FILANTROPICA1 ONO");
insert into com_rat_alvo (alvo) values ("CONDOIMINIO");
insert into com_rat_alvo (alvo) values ("COOPERATIVA");
insert into com_rat_alvo (alvo) values ("DEPOSITO");
insert into com_rat_alvo (alvo) values ("EMBARCACAO AEREA / NAUTICA / TERRESTRE");
insert into com_rat_alvo (alvo) values ("ESTABELECIMENTO COMERCIAL / SERVICOS");
insert into com_rat_alvo (alvo) values ("ESTABELECIMENTO INDUSTRIAL / PRODUCAO / EXTRA");
insert into com_rat_alvo (alvo) values ("LOCAL / ESTABELECIMENTO DE LAZER / CULTURA!");
insert into com_rat_alvo (alvo) values ("RESIDENCIANOVEL RURAL");
insert into com_rat_alvo (alvo) values ("INSTITUICAO DE ENSINO");
insert into com_rat_alvo (alvo) values ("INSTITUICAO FINANCEIRA");
insert into com_rat_alvo (alvo) values ("INSTITUICAO PUBLICA");
insert into com_rat_alvo (alvo) values ("RESIDENCIA PLURIFAMLIAR / HOSPEDAGEM");
insert into com_rat_alvo (alvo) values ("RESIDENCIA UNIFAMILIAR URBANA");
insert into com_rat_alvo (alvo) values ("SERVICO DE SAUDE");
insert into com_rat_alvo (alvo) values ("SINDICATO / ASSOCIACAO DE CLASSE");
insert into com_rat_alvo (alvo) values ("AREA / EDIFICAÇÃO ESPECIAL");
insert into com_rat_alvo (alvo) values ("UNIDADE DE CONSERVAÇÃO DA NATUREZA");
*/

ALTER TABLE `com_rat`
	CHANGE COLUMN `operacao_nome` `envolvidos` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Envolvidos' COLLATE 'utf8mb3_general_ci' AFTER `lugar_descricao`;

ALTER TABLE `com_rat`
	ADD COLUMN `nome_operacao` VARCHAR(110) NULL DEFAULT NULL COMMENT 'Nome da Operação' AFTER `envolvidos`;


ALTER TABLE `com_rat`
	ADD COLUMN `cep` VARCHAR(10) NULL DEFAULT NULL COMMENT 'Cep' AFTER `referencia`;

ALTER TABLE `com_rat`
	ADD COLUMN `municipio_id` INT NULL DEFAULT NULL COMMENT 'Identificador do Municipio' AFTER `dt_ocorrencia`;


ALTER TABLE `pip_pmda`
	ADD COLUMN `protocolo` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Protocolo PMDA' AFTER `updated_at`;


ALTER TABLE `com_vistorias`
	CHANGE COLUMN `tel` `cel` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Telefone' COLLATE 'utf8mb3_general_ci' AFTER `municipio_id`,
	ADD COLUMN `municipio` TINYINT(1) NULL DEFAULT NULL AFTER `ae_outros_txt`,
	ADD COLUMN `num_morador` INT NULL DEFAULT NULL COMMENT 'Número de Moradores' AFTER `resp_vistoriador`,
	ADD COLUMN `idosos` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem idosos' AFTER `num_morador`,
	ADD COLUMN `criancas` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem Crianças' AFTER `idosos`,
	ADD COLUMN `pess_dif_loc` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `criancas`,
	ADD COLUMN `bairro` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Bairro' AFTER `pess_dif_loc`,
	ADD COLUMN `cep` VARCHAR(15) NULL DEFAULT NULL COMMENT 'Cep da Ocorrencia' AFTER `bairro`,
	ADD COLUMN `latitude` VARCHAR(11) NULL DEFAULT NULL COMMENT 'Latitude' AFTER `cep`,
	ADD COLUMN `longitude` VARCHAR(11) NULL DEFAULT NULL COMMENT 'Longitude' AFTER `latitude`,
	ADD COLUMN `abast_agua` VARCHAR(9) NULL DEFAULT NULL COMMENT 'Tem Abastecimento de Água' AFTER `longitude`,
	ADD COLUMN `sist_drenag` VARCHAR(2) NULL DEFAULT NULL COMMENT 'Possui sistema de Drenagem' AFTER `abast_agua`;

	ALTER TABLE `com_vistorias`
	ADD COLUMN `nr_moradias` INT NULL DEFAULT NULL COMMENT 'Número de Moradias' AFTER `sist_drenag`;

	ALTER TABLE `com_vistorias`
ADD COLUMN `ck_esgo_sant_canalizado` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `nr_moradias`,
ADD COLUMN `ck_esgo_sant_fossa_similar` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_esgo_sant_canalizado`,
ADD COLUMN `ck_esgo_sant_superficie` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_esgo_sant_fossa_similar`,
ADD COLUMN `ck_sis_viar_acesso_estrada` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_esgo_sant_superficie`,
ADD COLUMN `ck_sis_viar_acesso_av_rua` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_sis_viar_acesso_estrada`,
ADD COLUMN `ck_sis_viar_acesso_beco_viela` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_sis_viar_acesso_av_rua`,
ADD COLUMN `ck_sis_viar_acesso_trilhas` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_sis_viar_acesso_beco_viela`,
ADD COLUMN `ck_tp_revest_via_asfaldo` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_sis_viar_acesso_trilhas`,
ADD COLUMN `ck_tp_revest_via_parale_pedra` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_tp_revest_via_asfaldo`,
ADD COLUMN `ck_tp_revest_via_n_asfalto` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_tp_revest_via_parale_pedra`,
ADD COLUMN `ck_cond_acesso_veicular` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_tp_revest_via_n_asfalto`,
ADD COLUMN `ck_cond_acesso_veicular4x4` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_cond_acesso_veicular`,
ADD COLUMN `ck_cond_acesso_a_pe` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_cond_acesso_veicular4x4`,
ADD COLUMN `ck_dist_encosta_menor_2_m` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_cond_acesso_a_pe`,
ADD COLUMN `ck_dist_encosta_2_4_m` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_dist_encosta_menor_2_m`,
ADD COLUMN `ck_dist_encosta_4_6_m` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_dist_encosta_2_4m`,
ADD COLUMN `ck_dist_encosta_maior_6_m` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_dist_encosta_4_6_m`,
ADD COLUMN `ck_mat_constr_alvenaria` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_dist_encosta_maior_6_m`,
ADD COLUMN `ck_mat_constr_madeira` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_mat_constr_alvenaria`,
ADD COLUMN `ck_mat_contr_mist_plas_mad_lata` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_mat_constr_madeira`,
ADD COLUMN `ck_cons_estr_baixa` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_mat_contr_mist_plas_mad_lata`,
ADD COLUMN `ck_cons_estr_media` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_cons_estr_baixa`,
ADD COLUMN `ck_cons_estr_alta` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_cons_estr_media`,
ADD COLUMN `ck_el_estr_trinc_pilar` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_cons_estr_alta`,
ADD COLUMN `ck_el_str_trinca_viga` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_estr_trinc_pilar`,
ADD COLUMN `ck_el_str_trinc_lage` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_trinca_viga`,
ADD COLUMN `ck_el_str_incl_muro` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_trinc_lage`,
ADD COLUMN `ck_el_str_mur_pared_def` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_incl_muro`,
ADD COLUMN `ck_el_str_cic_desliza` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_mur_pared_def`,
ADD COLUMN `ck_el_str_degr_abat` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_cic_desliza`,
ADD COLUMN `ck_el_str_inclin_arv` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_degr_abat`,
ADD COLUMN `ck_el_str_incl_poste` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_inclin_arv`,
ADD COLUMN `ck_el_constr_trinc_parede` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_incl_poste`,
ADD COLUMN `ck_el_contr_trinc_piso` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_constr_trinc_parede`,
ADD COLUMN `ck_el_constr_trinc_muro` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_contr_trinc_piso`,
ADD COLUMN `ck_ag_pot_lixo_entulho` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_constr_trinc_muro`,
ADD COLUMN `ck_ag_pot_aterr_bot_fora` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_ag_pot_lixo_entulho`,
ADD COLUMN `ck_ag_pot_veg_inadeq` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_ag_pot_aterr_bot_fora`,
ADD COLUMN `ck_ag_pot_cort_vert` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_ag_pot_veg_inadeq`,
ADD COLUMN `ck_ag_pot_tubl_romp` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_ag_pot_cort_vert`,
ADD COLUMN `ck_ag_pot_conc_flux_superfic` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_ag_pot_tubl_romp`,
ADD COLUMN `ck_proc_geo_desliza` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_ag_pot_conc_flux_superfic`,
ADD COLUMN `ck_proc_geo_qued_rolam_bloc` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_proc_geo_desliza`,
ADD COLUMN `ck_proc_geo_inundac` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_proc_geo_qued_rolam_bloc`,
ADD COLUMN `ck_vuln_baixa` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_proc_geo_inundac`,
ADD COLUMN `ck_vuln_media` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_vuln_baixa`,
ADD COLUMN `ck_vuln_alta` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_vuln_media`,
ADD COLUMN `ck_vuln_muito_alta` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_vuln_alta`,
ADD COLUMN `ck_clas_risc_baixa` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_vuln_muito_alta`,
ADD COLUMN `ck_clas_risc_media` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_clas_risc_baixa`,
ADD COLUMN `ck_clas_risc_alta` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_clas_risc_media`,
ADD COLUMN `ck_clas_risc_muito_alta` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_clas_risc_alta`;

ALTER TABLE `com_vistorias`
	CHANGE COLUMN `bairro` `bairro` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Bairro' COLLATE 'utf8mb3_general_ci' AFTER `pess_dif_loc`,
	CHANGE COLUMN `cep` `cep` VARCHAR(15) NULL DEFAULT NULL COMMENT 'Cep da Ocorrencia' COLLATE 'utf8mb3_general_ci' AFTER `bairro`,
	CHANGE COLUMN `latitude` `latitude` VARCHAR(11) NULL DEFAULT NULL COMMENT 'Latitude' COLLATE 'utf8mb3_general_ci' AFTER `cep`,
	CHANGE COLUMN `longitude` `longitude` VARCHAR(11) NULL DEFAULT NULL COMMENT 'Longitude' COLLATE 'utf8mb3_general_ci' AFTER `latitude`,
	CHANGE COLUMN `abast_agua` `abast_agua` VARCHAR(9) NULL DEFAULT NULL COMMENT 'Tem Abastecimento de Água' COLLATE 'utf8mb3_general_ci' AFTER `longitude`,
	CHANGE COLUMN `sist_drenag` `sist_drenag` VARCHAR(2) NULL DEFAULT NULL COMMENT 'Possui sistema de Drenagem' COLLATE 'utf8mb3_general_ci' AFTER `abast_agua`,
	CHANGE COLUMN `nr_moradias` `nr_moradias` INT(11) NULL DEFAULT NULL COMMENT 'Número de Moradias' AFTER `sist_drenag`;


ALTER TABLE `com_vistorias`
	ADD COLUMN `updated_at` TIMESTAMP NULL AFTER `ck_clas_risc_muito_alta`;
ALTER TABLE `com_vistorias`
	ADD COLUMN `created_at` TIMESTAMP NULL AFTER `updated_at`;

ALTER TABLE `com_vistorias`
	CHANGE COLUMN `municipio` `municipio` VARCHAR(70) NULL DEFAULT NULL AFTER `ae_outros_txt`;
ALTER TABLE `com_vistorias`
CHANGE COLUMN `sist_drenag` `sist_drenag` VARCHAR(15) NULL DEFAULT NULL COMMENT 'Possui sistema de Drenagem' COLLATE 'utf8mb3_general_ci' AFTER `abast_agua`;

ALTER TABLE `com_interdicao`
	ADD COLUMN `bairro` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Bairro' AFTER `publicacao`,
	ADD COLUMN `cep` VARCHAR(10) NULL DEFAULT NULL COMMENT 'cep' AFTER `bairro`;

ALTER TABLE `com_interdicao`
	ADD COLUMN `updated_at` TIMESTAMP NULL AFTER `cep`;
ALTER TABLE `com_interdicao`
	ADD COLUMN `created_at` TIMESTAMP NULL AFTER `updated_at`;


	ALTER TABLE `com_vistorias`
	CHANGE COLUMN `ck_mat_contr_mist_plas_mad_lata` `ck_mat_constr_mist_plas_mad_lata` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_mat_constr_madeira`,
	CHANGE COLUMN `ck_el_estr_trinc_pilar` `ck_el_str_trinc_pilar` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_cons_estr_alta`,
	CHANGE COLUMN `ck_el_str_trinca_viga` `ck_el_str_trinc_viga` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_trinc_pilar`,
	CHANGE COLUMN `ck_el_str_inclin_arv` `ck_el_str_incl_arv` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_degr_abat`,
	CHANGE COLUMN `ck_el_constr_trinc_parede` `ck_el_constr_trinc_parede` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_str_incl_poste`,
	CHANGE COLUMN `ck_el_contr_trinc_piso` `ck_el_constr_trinc_piso` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_constr_trinc_parede`,
	CHANGE COLUMN `ck_el_constr_trinc_muro` `ck_el_constr_trinc_muro` TINYINT(1) NULL DEFAULT NULL COMMENT 'Tem pessoas com dificuldade de locomoção' AFTER `ck_el_constr_trinc_piso`;

	ALTER TABLE `com_vistorias`
	CHANGE COLUMN `municipio` `nom_municipio` VARCHAR(70) NULL DEFAULT NULL COMMENT 'Nome do Municipio da Vistoria' COLLATE 'utf8mb3_general_ci' AFTER `ae_outros_txt`;
	ALTER TABLE `com_vistorias`
	ADD COLUMN `ck_cond_acesso_veicula2_rodas` TINYINT(1) NULL DEFAULT NULL COMMENT 'Condiçoes de Acesso veiculos 2 rodas' AFTER `ck_cond_acesso_veicular4x4`;

	INSERT INTO `gestaocedeclaravel`.`com_rat_alvo` (`alvo`) VALUES ('OUTROS ( DISCRIMINAR NO HISTORICO )');


ALTER TABLE `aju_pedido_antecs`
ADD COLUMN `updated_at` TIMESTAMP NULL AFTER `tramit_parecer`;
	
ALTER TABLE `aju_pedido_antecs`
ADD COLUMN `created_at` TIMESTAMP NULL AFTER `updated_at`;

ALTER TABLE `aju_pedido_itens`
ADD COLUMN `updated_at` TIMESTAMP NULL AFTER `tp_item`;
	
ALTER TABLE `aju_pedido_itens`
	ADD COLUMN `created_at` TIMESTAMP NULL AFTER `updated_at`;

/*casa ok */

ALTER TABLE gestaocedeclaravel.aju_pedido_itens CHANGE familia_at familia_at int(11) DEFAULT NULL NULL COMMENT 'Quantidade de Familias Atendidas';





