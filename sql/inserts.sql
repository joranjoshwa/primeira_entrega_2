INSERT INTO `uf` (`id`, `nome`)
VALUES
(NULL, 'Bahia'),
(NULL, 'Minas Gerais');

INSERT INTO `localidades` (`id`, `nome`, `uf_id`) 
VALUES 
(NULL, 'Eunápolis', (SELECT id FROM uf WHERE nome = 'Bahia')),
(NULL, 'Salto da Divisa', (SELECT id FROM uf WHERE nome = 'Minas Gerais')),
(NULL, 'Porto Seguro', (SELECT id FROM uf WHERE nome = 'Bahia'));

insert into subtipos (nome)
values
('cereais'),
('tuberculos'),
('hortaliças'),
('frutas'),
('leguminosas'),
('carnes'),
('ovo'),
('leite e derivados'),
('oléos e gorduras'),
('açúcares'),
('pães');

call inserirProdutos("Abóbora", "leguminosas");
call inserirProdutos("Aipim", "leguminosas");
call inserirProdutos("Banana-da-terra", "frutas");
call inserirProdutos("Banana-prata", "frutas");
call inserirProdutos("Batata-doce", "leguminosas");
call inserirProdutos("Beterraba", "leguminosas");
call inserirProdutos("Cenoura", "leguminosas");
call inserirProdutos("Chuchu", "leguminosas");
call inserirProdutos("Alface", "hortaliças");

insert into documentos (nome) values
('CPF'),
('DAP'),
('declaração de produção própria'),
('CAF'),
('CNPJ'),
('Declaração de produção da associação/cooperativa'),
('Declaração da associação/cooperativa do não emprego de menores de idade'),
('Prova de regularidade fiscal da associação/cooperativa'),
('Registro da organização');