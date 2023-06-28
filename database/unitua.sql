DROP SCHEMA IF EXISTS unitua CASCADE;

CREATE SCHEMA unitua;

CREATE TYPE unitua.tipo_laurea AS ENUM ('Triennale', 'Magistrale', 'Ciclo Unico');

CREATE TABLE unitua.corso_di_laurea (
    codice serial PRIMARY KEY,
    tipologia unitua.tipo_laurea NOT NULL,
    descrizione varchar NOT NULL CHECK (descrizione <> '')
);

CREATE TABLE unitua.utente (
    email varchar PRIMARY KEY CHECK (email <> ''),
    pw varchar NOT NULL CHECK (pw <> '')
);

CREATE TYPE unitua.sex AS ENUM ('M', 'F', 'Non specificato');

CREATE TYPE unitua.stato_studente AS ENUM ('In corso', 'Fuoricorso');

CREATE TABLE unitua.studente (
    matricola varchar(6) PRIMARY KEY,
    nome varchar NOT NULL CHECK (nome <> ''),
    cognome varchar NOT NULL CHECK (cognome <> ''),
    codFiscale varchar(16) NOT NULL UNIQUE CHECK (codFiscale <> ''),
    sesso unitua.sex NOT NULL,
    cellulare varchar(10),
    data_immatricolazione date NOT NULL,
    stato unitua.stato_studente NOT NULL,
	utente_email varchar NOT NULL,
    FOREIGN KEY(utente_email)
        REFERENCES unitua.utente(email) ON DELETE CASCADE,
    CdL int NOT NULL,
    FOREIGN KEY(CdL)
        REFERENCES unitua.corso_di_laurea(codice) ON DELETE CASCADE
);

CREATE TYPE unitua.carica_accademica AS ENUM ('Ordinario', 'Associato', 'Ricercatore');

CREATE TABLE unitua.docente (
    id serial PRIMARY KEY,
    nome varchar NOT NULL CHECK (nome <> ''),
    cognome varchar NOT NULL CHECK (cognome <> ''),
    codFiscale varchar(16) NOT NULL UNIQUE CHECK (codFiscale <> ''),
    sesso unitua.sex NOT NULL,
    cellulare varchar(10),
    carica unitua.carica_accademica NOT NULL,
	utente_email varchar NOT NULL,
    FOREIGN KEY(utente_email)
        REFERENCES unitua.utente(email) ON DELETE CASCADE,
    CdL int NOT NULL,
    FOREIGN KEY(CdL)
        REFERENCES unitua.corso_di_laurea(codice) ON DELETE CASCADE
);

CREATE TYPE unitua.ruolo_segreteria AS ENUM ('Primo livello', 'Secondo livello');

CREATE TABLE unitua.segreteria (
    id serial PRIMARY KEY,
    nome varchar NOT NULL CHECK (nome <> ''),
    cognome varchar NOT NULL CHECK (cognome <> ''),
    codFiscale varchar(16) NOT NULL UNIQUE CHECK (codFiscale <> ''),
    sesso unitua.sex NOT NULL,
    cellulare varchar(10),
    ruolo unitua.ruolo_segreteria NOT NULL,
	utente_email varchar NOT NULL,
    FOREIGN KEY(utente_email)
        REFERENCES unitua.utente(email) ON DELETE CASCADE
);

CREATE DOMAIN unitua.voto_laurea int CHECK (
    VALUE BETWEEN 60 AND 110
);

CREATE TABLE unitua.laurea (
    codice serial PRIMARY KEY,
    bonus int NOT NULL,
    voto unitua.voto_laurea NOT NULL,
    data_laurea date NOT NULL,
    lode boolean NOT NULL,
    studente varchar NOT NULL,
    relatore int NOT NULL,
    FOREIGN KEY(relatore)
        REFERENCES unitua.docente(id) ON DELETE CASCADE,
    CdL int NOT NULL,
    FOREIGN KEY (CdL)
        REFERENCES unitua.corso_di_laurea(codice) ON DELETE CASCADE
);

CREATE TABLE unitua.ex_studente (
    matricola varchar(6) PRIMARY KEY,
    nome varchar NOT NULL CHECK (nome <> ''),
    cognome varchar NOT NULL CHECK (cognome <> ''),
    codFiscale varchar(16) NOT NULL CHECK (codFiscale <> ''),
    sesso unitua.sex NOT NULL,
    cellulare varchar(10),
    data_immatricolazione date NOT NULL,
    stato unitua.stato_studente NOT NULL,
	utente_email varchar NOT NULL,
    FOREIGN KEY(utente_email)
        REFERENCES unitua.utente(email) ON DELETE CASCADE,
    CdL int NOT NULL,
    FOREIGN KEY (CdL)
        REFERENCES unitua.corso_di_laurea(codice) ON DELETE CASCADE
);

CREATE TYPE unitua.anno AS ENUM ('1', '2', '3', '4', '5');

CREATE TABLE unitua.insegnamento (
    codice serial PRIMARY KEY,
    nome_insegnamento varchar NOT NULL CHECK (nome_insegnamento <> ''),
    anno_insegnamento unitua.anno NOT NULL,
    descrizione varchar,
    docente int NOT NULL,
    FOREIGN KEY (docente)
        REFERENCES unitua.docente(id) ON DELETE CASCADE,
    CdL int NOT NULL,
    FOREIGN KEY (CdL)
        REFERENCES unitua.corso_di_laurea(codice) ON DELETE CASCADE
);

CREATE TYPE unitua.tipo_esame AS ENUM ('Presenza', 'Distanza');
CREATE TYPE unitua.modalita_verifica AS ENUM('Scritto', 'Orale', 'Scritto + Orale');

CREATE TABLE unitua.esame (
    codice serial PRIMARY KEY,
    insegnamento int NOT NULL,
    tipologia unitua.tipo_esame NOT NULL,
    modalita unitua.modalita_verifica NOT NULL,
    FOREIGN KEY (insegnamento)
        REFERENCES unitua.insegnamento(codice) ON DELETE CASCADE
); 
--Così docente inserisce le sessioni d'esame e si controlla che inserisca SOLO i suoi insegnamenti

CREATE TABLE unitua.propedeuticita (
    insegnamento_propedeutico int NOT NULL, --Programmazione I
    insegnamento_con_propedeuticita int NOT NULL, --Programmazione II, Basi di Dati, Sis. Op. ecc...
    FOREIGN KEY(insegnamento_propedeutico)
        REFERENCES unitua.insegnamento(codice) ON DELETE CASCADE,
    FOREIGN KEY(insegnamento_con_propedeuticita)
        REFERENCES unitua.insegnamento(codice) ON DELETE CASCADE,
    PRIMARY KEY(insegnamento_propedeutico, insegnamento_con_propedeuticita)
);

CREATE TABLE unitua.calendario (
    codice_appello serial PRIMARY KEY,
	data_esame date NOT NULL,
    ora time NOT NULL,
    aula varchar NOT NULL CHECK (aula <> ''),
    esame int NOT NULL,
    FOREIGN KEY(esame)
        REFERENCES unitua.esame(codice) ON DELETE CASCADE,
    anno_accademico int NOT NULL,
    docente int NOT NULL,
    FOREIGN KEY(docente)
        REFERENCES unitua.docente(id) ON DELETE CASCADE,
    CdL int NOT NULL,
    FOREIGN KEY(CdL)
        REFERENCES unitua.corso_di_laurea(codice)
);

CREATE TABLE unitua.iscritti (
    docente int NOT NULL,
    FOREIGN KEY(docente)
        REFERENCES unitua.docente(id) ON DELETE CASCADE,
    studente varchar NOT NULL,
    FOREIGN KEY(studente)
        REFERENCES unitua.studente(matricola) ON DELETE CASCADE,
    esame int NOT NULL,
    FOREIGN KEY(esame)
        REFERENCES unitua.esame(codice) ON DELETE CASCADE,
    calendario int NOT NULL,
    FOREIGN KEY(calendario)
        REFERENCES unitua.calendario(codice_appello) ON DELETE CASCADE,
    PRIMARY KEY (docente, studente, esame, calendario)
);

CREATE DOMAIN unitua.voto_esame int CHECK (
    VALUE BETWEEN 18 AND 30
);

CREATE TABLE unitua.valutazione (
    codice serial,
    studente varchar(6) NOT NULL,
    FOREIGN KEY(studente)
        REFERENCES unitua.studente(matricola) ON DELETE CASCADE,
    calendario int NOT NULL,
    FOREIGN KEY(calendario)
        REFERENCES unitua.calendario(codice_appello) ON DELETE CASCADE,
    esame int NOT NULL,
    FOREIGN KEY(esame)
        REFERENCES unitua.esame(codice) ON DELETE CASCADE,
    docente int NOT NULL,
    FOREIGN KEY(docente)
        REFERENCES unitua.docente(id) ON DELETE CASCADE,
    voto unitua.voto_esame,
    lode boolean,
    respinto boolean NOT NULL,
    data_verbalizzazione date NOT NULL,
    PRIMARY KEY (codice, studente)
);

CREATE TABLE unitua.storico_valutazione (
    codice serial PRIMARY KEY,
    ex_studente varchar(6) NOT NULL,
    FOREIGN KEY(ex_studente)
        REFERENCES unitua.ex_studente(matricola) ON DELETE CASCADE,
    calendario int NOT NULL,
    FOREIGN KEY (calendario)
        REFERENCES unitua.calendario(codice_appello) ON DELETE CASCADE,
    esame int NOT NULL,
    FOREIGN KEY(esame)
        REFERENCES unitua.esame(codice) ON DELETE CASCADE,
    docente int NOT NULL,
    FOREIGN KEY(docente)
        REFERENCES unitua.docente(id) ON DELETE CASCADE,
    voto unitua.voto_esame NOT NULL,
    lode boolean NOT NULL,
    respinto boolean NOT NULL,
    data_verbalizzazione date NOT NULL
);
