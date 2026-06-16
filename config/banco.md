CREATE DATABASE agenda;
USE agenda;



-- =========================
-- TABELA TB_CONTATOS
-- =========================
CREATE TABLE tb_contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserts contatos
INSERT INTO tb_contatos (nome, email, telefone)
VALUES 
('Carlos Silva', 'carlos@email.com', '(11) 99999-1111'),
('Ana Souza', 'ana@email.com', '(11) 98888-2222'),
('Lucas Pereira', 'lucas@email.com', '(11) 97777-3333');



-- =========================
-- TABELA TB_CLIENTES
-- =========================
CREATE TABLE tb_clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    endereco VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserts clientes
INSERT INTO tb_clientes (nome, cpf, email, telefone, endereco)
VALUES
('Mariana Lima', '123.456.789-00', 'mariana@email.com', '(11) 96666-1111', 'Rua das Flores, 120'),
('João Santos', '987.654.321-00', 'joao@email.com', '(11) 95555-2222', 'Av. Central, 450'),
('Fernanda Costa', '456.789.123-00', 'fernanda@email.com', '(11) 94444-3333', 'Rua Azul, 78');



-- =========================
-- TABELA TB_PRODUTOS
-- =========================
CREATE TABLE tb_produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    imagem VARCHAR(255) null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserts produtos
INSERT INTO tb_produtos (nome, descricao, preco, estoque)
VALUES
('Notebook Dell', 'Notebook Intel i5 com 8GB RAM', 3500.00, 10),
('Mouse Gamer', 'Mouse RGB 7200 DPI', 120.50, 25),
('Teclado Mecânico', 'Teclado mecânico switch blue', 280.90, 15);