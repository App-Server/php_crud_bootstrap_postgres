
CREATE TABLE leads (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    data_do_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE clientes
ADD COLUMN id SERIAL PRIMARY KEY,
ADD COLUMN data_do_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN nome VARCHAR(255),
ADD COLUMN email VARCHAR(255),
ADD COLUMN telefone VARCHAR(20);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(80) NOT NULL,
    data_do_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);