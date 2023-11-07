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
('Cereais'),
('tuberculos'),
('Hortaliças'),
('Frutas'),
('Leguminosas'),
('carnes'),
('ovo'),
('leite e derivados'),
('oléos e gorduras'),
('açúcares'),
('pães');

call inserirProdutos("Abóbora", "Leguminosas");
call inserirProdutos("Aipim", "Leguminosas");
call inserirProdutos("Banana-da-terra", "Frutas");
call inserirProdutos("Banana-prata", "Frutas");
call inserirProdutos("Batata-doce", "Leguminosas");
call inserirProdutos("Beterraba", "Leguminosas");
call inserirProdutos("Cenoura", "Leguminosas");
call inserirProdutos("Chuchu", "Leguminosas");
call inserirProdutos("Alface", "Hortaliças");

insert into documentos (nome) values
('CPF'),
('DAP'),
('Declaração de produção própria'),
('CAF'),
('CNPJ'),
('Declaração de produção da associação/cooperativa'),
('Declaração da associação/cooperativa do não emprego de menores de idade'),
('Prova de regularidade fiscal da associação/cooperativa'),
('Registro da organização');