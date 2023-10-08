INSERT INTO `localidades` (`id`, `nome`) 
VALUES 
(NULL, 'Eunápolis');

INSERT INTO `localidades` (`id`, `nome`) 
VALUES 
(NULL, 'Salto da Divisa');

INSERT INTO `localidades` (`id`, `nome`) 
VALUES 
(NULL, 'Porto Seguro');

INSERT INTO `instituicoes` (`id`, `nome`, `CNPJ`, `email`, `senha`, `localidades_id`) 
VALUES 
(NULL, 'IFBA', '23423434', 'pedro2323@gmail.com', 'wewewe', '1');

INSERT INTO `agricultores` (`id`, `nome`, `CAF`, `CPF`, `senha`, `telefone`, `email`, `localidades_id`) 
VALUES 
(NULL, 'pero', '23213321232', '31123123', '123123123', '123123123', '213213123', '2');
-----
insert into subtipo (nome)
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