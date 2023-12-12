DROP TABLE IF EXISTS paciente;

CREATE TABLE IF NOT EXISTS paciente (
    id              INTEGER PRIMARY KEY,
    sus           TEXT    NOT NULL,
    nome            TEXT    NOT NULL,
    email           TEXT    NOT NULL,
    dataNascimento  TEXT,
    sexo            TEXT,
    senha           TEXT
);

DROP TABLE IF EXISTS funcionario;

CREATE TABLE IF NOT EXISTS funcionario (
    id              INTEGER PRIMARY KEY,
    nome            TEXT    NOT NULL,
    email           TEXT    NOT NULL,
    senha           TEXT
);

DROP TABLE IF EXISTS medico;

CREATE TABLE IF NOT EXISTS medico (
    id              INTEGER PRIMARY KEY,
    nome            TEXT    NOT NULL,
    crm             TEXT    NOT NULL,
    especialidade   INTEGER   
);

DROP TABLE IF EXISTS consulta;

CREATE TABLE IF NOT EXISTS consulta (
    id               INTEGER PRIMARY KEY,
    data_agenda      TEXT   NOT NULL,
    hora             TEXT   NOT NULL,  
    cancelado        INTEGER,
    medico_id        INTEGER,
    paciente_id      INTEGER

);

<--1 pra muitos | consulta --> 