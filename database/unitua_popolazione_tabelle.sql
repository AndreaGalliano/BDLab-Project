--Inserimento record della tabella corso_di_laurea:

SELECT pg_get_serial_sequence('unitua.corso_di_laurea', 'codice');
SELECT setval(pg_get_serial_sequence('unitua.corso_di_laurea', 'codice'), 1, false);

CREATE OR REPLACE PROCEDURE unitua.insert_corso_di_laurea (tipologia unitua.tipo_laurea, descrizione varchar)
    AS $$
BEGIN
    INSERT INTO unitua.corso_di_laurea(tipologia, descrizione)
    VALUES (tipologia, descrizione);
END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_corso_di_laurea('Triennale', 'Informatica');
CALL unitua.insert_corso_di_laurea('Triennale', 'Informatica Musicale');
CALL unitua.insert_corso_di_laurea('Triennale', 'Comunicazione Digitale');
CALL unitua.insert_corso_di_laurea('Triennale', 'Sicurezza informatica');
CALL unitua.insert_corso_di_laurea('Magistrale', 'Informatica');
CALL unitua.insert_corso_di_laurea('Magistrale', 'Sicurezza Informatica');
CALL unitua.insert_corso_di_laurea('Ciclo Unico', 'Medicina');
CALL unitua.insert_corso_di_laurea('Triennale', 'Fisica');
CALL unitua.insert_corso_di_laurea('Triennale', 'Storia dell arte');
CALL unitua.insert_corso_di_laurea('Triennale', 'Biotecnologie');
CALL unitua.insert_corso_di_laurea('Triennale', 'Chimica');
CALL unitua.insert_corso_di_laurea('Triennale', 'Beni culturali');
CALL unitua.insert_corso_di_laurea('Magistrale', 'Matematica');
CALL unitua.insert_corso_di_laurea('Triennale', 'Mediazione Linguistica');

SELECT * FROM unitua.corso_di_laurea;

--Inserimento record della tabella utente:

CREATE OR REPLACE PROCEDURE unitua.insert_utente (email varchar, pw varchar)
    AS $$
BEGIN
    INSERT INTO unitua.utente(email, pw)
    VALUES (email, md5(pw));
END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_utente('andrea.galliano@studenti.unitua.it', 'Password#1');
CALL unitua.insert_utente('giacomo.comitani@studenti.unitua.it', 'Password#2');
CALL unitua.insert_utente('mattia.delledonne@studenti.unitua.it', 'Password#3');
CALL unitua.insert_utente('daniele.deluca@studenti.unitua.it', 'Password#4');
CALL unitua.insert_utente('luca.corradini@studenti.unitua.it', 'Password#5');
CALL unitua.insert_utente('luca.favini@studenti.unitua.it', 'Password#6');
CALL unitua.insert_utente('matteo.zagheno@studenti.unitua.it', 'Password#7');
CALL unitua.insert_utente('alessandro.mataloni@studenti.unitua.it', 'Password#8');
CALL unitua.insert_utente('pietro.rusconi@studenti.unitua.it', 'Password#9'); --Modificata: NuovaPass
CALL unitua.insert_utente('davide.gioffre@studenti.unitua.it', 'Password#10');
CALL unitua.insert_utente('sebastiano.vigna@docenti.unitua.it', 'Password#11');
CALL unitua.insert_utente('vincenzo.piuri@docenti.unitua.it', 'Password#12');
CALL unitua.insert_utente('valerio.bellandi@docenti.unitua.it', 'Password#13');
CALL unitua.insert_utente('stefano.montanelli@docenti.unitua.it', 'Password#14');
CALL unitua.insert_utente('luigi.pepe@segreteria.unitua.it', 'Password#15');
CALL unitua.insert_utente('mario.rossi@segreteria.unitua.it', 'Password#16');
CALL unitua.insert_utente('michele.bolis@studenti.unitua.it', 'Password#17');
CALL unitua.insert_utente('elena.casiraghi@docenti.unitua.it', 'Password#20');
CALL unitua.insert_utente('rebecca.turconi@studenti.unitua.it', 'Password#21');
CALL unitua.insert_utente('giovanni.bianchi@docente.unitua.it', 'Password#22');

SELECT * FROM unitua.utente;

--Inserimento record della tabella studente:

CREATE OR REPLACE PROCEDURE unitua.insert_studente(
    matricola varchar(6), 
    nome varchar,
    cognome varchar, 
    codFiscale varchar(16), 
    sesso unitua.sex, 
    cellulare varchar(10), 
    data_immatricolazione date, 
    stato unitua.stato_studente,
    utente_email varchar,
	CdL_codice int
)
AS $$
    BEGIN
        INSERT INTO unitua.studente(matricola, nome, cognome, codFiscale, sesso, cellulare, data_immatricolazione, stato, utente_email, CdL)
        VALUES (matricola, nome, cognome, codFiscale, sesso, cellulare, data_immatricolazione, stato, utente_email, CdL_codice);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_studente('05460A', 'Andrea', 'Galliano', 'GLLNDR02L26H860U', 'M', '3248662724', '2021-09-25', 'In corso', 'andrea.galliano@studenti.unitua.it', 1);
CALL unitua.insert_studente('06078A', 'Luca', 'Corradini', 'ABDPRL02L34H900O', 'M', '1234567890', '2021-09-23', 'In corso', 'luca.corradini@studenti.unitua.it', 1);
CALL unitua.insert_studente('456O0A', 'Michele', 'Bolis', 'BLSMCL02L20U920P', 'M', '3049586721', '2018-06-23', 'Fuoricorso', 'michele.bolis@studenti.unitua.it', 12);
CALL unitua.insert_studente('29049A', 'Pietro', 'Rusconi', 'RSCPTR02N10Y781Q', 'M', '0192837465', '2021-09-26', 'In corso', 'pietro.rusconi@studenti.unitua.it', 8);
CALL unitua.insert_studente('28790A', 'Alessandro', 'Mataloni', 'MTLLSR03G12H860O', 'M', '1099847756', '2021-09-25', 'In corso', 'alessandro.mataloni@studenti.unitua.it', 7);
CALL unitua.insert_studente('987180', 'Mattia', 'Delle Donne', 'GBZLJ3XKZ9QC47EH', 'M', '1146096218', '2021-09-20', 'In corso', 'mattia.delledonne@studenti.unitua.it', 2);
CALL unitua.insert_studente('990037', 'Rebecca', 'Turconi', 'IZ1Y16YEMBUAZ2CL', 'F', '9875033567', '2021-07-14', 'In corso', 'rebecca.turconi@studenti.unitua.it', 13);
CALL unitua.insert_studente('98007A', 'Giacomo', 'Comitani', '8TT88LD0TB5HL0HG', 'M', '0812891071', '2021-03-10', 'In corso', 'giacomo.comitani@studenti.unitua.it', 1);

SELECT * FROM unitua.studente;

--Query di prova con join:
SELECT s.matricola, s. nome, s.cognome, u.pw, s.CdL, corso.descrizione
FROM unitua.studente AS s
JOIN unitua.corso_di_laurea AS corso 
ON s.CdL = corso.codice
JOIN unitua.utente AS u
ON s.utente_email = u.email
WHERE s.CdL IS NOT NULL;

--Inserimento record della tabella docente:
SELECT pg_get_serial_sequence('unitua.docente', 'id');
SELECT setval(pg_get_serial_sequence('unitua.docente', 'id'), 100, false);

CREATE OR REPLACE PROCEDURE unitua.insert_docente(
    nome varchar,
    cognome varchar,
    codFiscale varchar(16),
    sesso unitua.sex,
    cellulare varchar(10),
    carica unitua.carica_accademica,
    utente_email varchar,
	CdL_codice int
)
AS $$
    BEGIN
        INSERT INTO unitua.docente(nome, cognome, codFiscale, sesso, cellulare, carica, utente_email, CdL)
        VALUES (nome, cognome, codFiscale, sesso, cellulare, carica, utente_email, CdL_codice);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_docente('Sebastiano', 'Vigna', 'VGNSBT02L25T990P', 'M', '3455901246', 'Ordinario', 'sebastiano.vigna@docenti.unitua.it', 1);
CALL unitua.insert_docente('Vincenzo', 'Piuri', '05ZZXQFRMB01VUCG', 'M', '9274327622', 'Ordinario', 'vincenzo.piuri@docenti.unitua.it', 1);
CALL unitua.insert_docente('Valerio', 'Bellandi', 'PF1ZMRQ7U2YCHKLS', 'M', '5176815545', 'Ordinario', 'valerio.bellandi@docenti.unitua.it', 1);
CALL unitua.insert_docente('Stefano', 'Montanelli', 'P43P58V6JBJBSOB2', 'M', '2685716768', 'Ordinario', 'stefano.montanelli@docenti.unitua.it', 1);
CALL unitua.insert_docente('Elena', 'Casiraghi', 'GZTC2T05N8Y1BB4I', 'M', '8666676946', 'Associato', 'elena.casiraghi@docenti.unitua.it', 1);
CALL unitua.insert_docente('Giovanni', 'Bianchi', 'GZTC2PP5N8Y1BB4I', 'M', '5176815523', 'Associato', 'giovanni.bianchi@docente.unitua.it', 7);

SELECT * FROM unitua.docente;


--Inserimento record della tabella segreteria:

SELECT pg_get_serial_sequence('unitua.segreteria', 'id');
SELECT setval(pg_get_serial_sequence('unitua.segreteria', 'id'), 200, false);

CREATE OR REPLACE PROCEDURE unitua.insert_membro_segreteria(
    nome varchar,
    cognome varchar,
    codFiscale varchar(16),
    sesso unitua.sex,
    cellulare varchar(10),
    utente_email varchar
)
AS $$
    BEGIN
        INSERT INTO unitua.segreteria(nome, cognome, codFiscale, sesso, cellulare, utente_email)
        VALUES (nome, cognome, codFiscale, sesso, cellulare, utente_email);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_membro_segreteria('Luigi', 'Pepe', 'JYQV24A9R6V7JXXJ', 'M', '5809946869', 'luigi.pepe@segreteria.unitua.it');
CALL unitua.insert_membro_segreteria('Mario', 'Rossi', '2JIUU5D1NAYCN6MI', 'M', '8446867516', 'mario.rossi@segreteria.unitua.it');

SELECT * FROM unitua.segreteria;

--Inserimento record della tabella insegnamenti:

SELECT pg_get_serial_sequence('unitua.insegnamento', 'codice');
SELECT setval(pg_get_serial_sequence('unitua.insegnamento', 'codice'), 300, false);

CREATE OR REPLACE PROCEDURE unitua.insert_insegnamento(
    nome_insegnamento varchar,
    anno_insegnamento unitua.anno,
    descrizione varchar,
    docente int,
    CdL int
)
AS $$
    BEGIN 
        INSERT INTO unitua.insegnamento(nome_insegnamento, anno_insegnamento, descrizione, docente, CdL)
        VALUES (nome_insegnamento, anno_insegnamento, descrizione, docente, CdL);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_insegnamento('Programmazione 1', '1', 'Esame di programmazione 1 del primo anno di informatica (triennale)', 100, 1);
CALL unitua.insert_insegnamento('Sistemi Operativi', '2', 'Esame di sistemi operativi del secondo anno di informatica (triennale)', 101, 1);
CALL unitua.insert_insegnamento('Tecnologie Web e Mobile', '2', 'Esame di TWM del secondo anno di informatica (triennale)', 102, 1);
CALL unitua.insert_insegnamento('Basi di dati', '2', 'Esame di basi di dati del secondo anno di informatica (triennale)', 103, 1);
CALL unitua.insert_insegnamento('Visualizzazione Scientifica', '3', 'Esame di visualizzazione scientifica del terzo anno di informatica (triennale)', 104, 1);
CALL unitua.insert_insegnamento('Anatomia 1', '1', 'Esame di Anatomia 1 del primo anno di medicina e chirurgia', 105, 7);

SELECT * FROM unitua.insegnamento;

--Inserimento record della tabella esami:

SELECT pg_get_serial_sequence('unitua.esame', 'codice');
SELECT setval(pg_get_serial_sequence('unitua.esame', 'codice'), 500, false);

CREATE OR REPLACE PROCEDURE unitua.insert_esame(
    insegnamento int,
    tipologia unitua.tipo_esame,
    modalita unitua.modalita_verifica
)
AS $$
    BEGIN
        INSERT INTO unitua.esame(insegnamento, tipologia, modalita)
        VALUES (insegnamento, tipologia, modalita);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_esame(300, 'Presenza', 'Scritto + Orale');
CALL unitua.insert_esame(301, 'Presenza', 'Scritto');
CALL unitua.insert_esame(302, 'Presenza', 'Scritto');
CALL unitua.insert_esame(303, 'Distanza', 'Scritto');
CALL unitua.insert_esame(304, 'Presenza', 'Scritto');
CALL unitua.insert_esame(305, 'Presenza', 'Orale');

SELECT * FROM unitua.esame;

--Inserimento record della tabella propedeuticita:
CREATE OR REPLACE PROCEDURE unitua.insert_propedeuticita (
    insegnamento_propedeutico int,
    insegnamento_con_propedeuticita int
)
AS $$
    BEGIN
        INSERT INTO unitua.propedeuticita (insegnamento_propedeutico, insegnamento_con_propedeuticita)
        VALUES (insegnamento_propedeutico, insegnamento_con_propedeuticita);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_propedeuticita(300, 301); --

SELECT * FROM unitua.propedeuticita;

--Inserimento record della tabella calendario:

SELECT pg_get_serial_sequence('unitua.calendario', 'codice_appello');
SELECT setval(pg_get_serial_sequence('unitua.calendario', 'codice_appello'), 1100, false);

CREATE OR REPLACE PROCEDURE unitua.insert_calendario(
    data_esame date,
    ora time,
    aula varchar,
    esame int,
    anno_accademico int,
    docente int,
    CdL int
)
AS $$
    BEGIN
        INSERT INTO unitua.calendario (data_esame, ora, aula, esame, anno_accademico, docente, CdL)
        VALUES (data_esame, ora, aula, esame, anno_accademico, docente, CdL);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_calendario('2017-02-24', '8:30', 'P202', 500, '2017', 100, 1); --1100
CALL unitua.insert_calendario('2023-01-27', '9:00', 'P202', 500, '2023', 100, 1); --1101
CALL unitua.insert_calendario('2023-01-27', '14:30', 'S500', 501, '2023', 101, 1); --1102
CALL unitua.insert_calendario('2023-01-27', '8:45', 'OMEGA', 502, '2023', 102, 1); --1103

SELECT * FROM unitua.calendario;

--Inserimento record della tabella iscitti:

CREATE OR REPLACE PROCEDURE unitua.insert_iscritto(
    docente int,
    studente varchar,
    esame int,
    calendario int
)
AS $$
    BEGIN 
        INSERT INTO unitua.iscritti (docente, studente, esame, calendario)
        VALUES (docente, studente, esame, calendario);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_iscritto(100, '05460A', 500, 1100);
CALL unitua.insert_iscritto(100, '98007A', 500, 1100);

SELECT * FROM unitua.iscritti;

--Inserimento record della tabella valutazione:

SELECT pg_get_serial_sequence('unitua.valutazione', 'codice');
SELECT setval(pg_get_serial_sequence('unitua.valutazione', 'codice'), 1500, false);

CREATE OR REPLACE PROCEDURE unitua.insert_valutazione(
    studente varchar,
    calendario int,
    esame int,
    docente int,
    voto unitua.voto_esame,
    lode boolean,
    respinto boolean,
    data_verbalizzazione date,
    accettato boolean
)
AS $$
    BEGIN
        INSERT INTO unitua.valutazione (studente, calendario, esame, docente, voto, lode, respinto, data_verbalizzazione, accettato)
        VALUES (studente, calendario, esame, docente, voto, lode, respinto, data_verbalizzazione, accettato);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_valutazione('05460A', 1101, 500, 100, 23, false, false, '2022-02-02', true);
CALL unitua.insert_valutazione('98007A', 1101, 500, 100, 20, false, false, '2022-02-02', true);
CALL unitua.insert_valutazione('98007A', 1102, 501, 101, 30, true, false, '2022-02-20', true);
CALL unitua.insert_valutazione('98007A', 1103, 502, 102, 25, false, false, '2022-01-07', true);

SELECT * FROM unitua.valutazione;

--Inserimento record della tabella laurea:

SELECT pg_get_serial_sequence('unitua.laurea', 'codice');
SELECT setval(pg_get_serial_sequence('unitua.laurea', 'codice'), 1000, false);

CREATE OR REPLACE PROCEDURE unitua.insert_laurea(
    bonus int,
    voto unitua.voto_laurea,
    data_laurea date,
    lode boolean,
    studente varchar,
    relatore int,
    CdL int
)
AS $$
    BEGIN
        INSERT INTO unitua.laurea(bonus, voto, data_laurea, lode, studente, relatore, CdL)
        VALUES (bonus, voto, data_laurea, lode, studente, relatore, CdL);
    END;
$$ LANGUAGE plpgsql;


--Funzione di calcolo media voti di uno studente:
CREATE OR REPLACE FUNCTION unitua.calcolo_media(
    stud_matricola varchar
)
RETURNS numeric AS $$
DECLARE media numeric;
BEGIN
    SELECT AVG(voto) INTO media
    FROM unitua.valutazione
    WHERE studente = stud_matricola;

    RETURN media;
END;
$$ LANGUAGE plpgsql;

/*
--Prova funzione:
SELECT * FROM unitua.calcolo_media('98007A');
*/

--Funzione di calcolo del voto di laurea:
CREATE OR REPLACE FUNCTION unitua.calcolo_voto_laurea(
    stud_matricola varchar,
    pti_bonus int
)
RETURNS unitua.voto_laurea AS $$
DECLARE
    media numeric;
    voto_finale int;
BEGIN
    media := unitua.calcolo_media(stud_matricola);

    --Costrutto switch per stabilire il voto di laurea finale:
    CASE
        WHEN media >= 20 AND media < 22.5 THEN
            voto_finale := 76 + pti_bonus;
        WHEN media >= 22.5 AND media < 25 THEN
            voto_finale := 81 + pti_bonus;
        WHEN media >= 25 AND media < 27.5 THEN
            voto_finale := 86 + pti_bonus;
        WHEN media >= 27.5 AND media < 30 THEN
            voto_finale := 91 + pti_bonus;

        ELSE
            voto_finale := 60 + pti_bonus;
    END CASE;

    RETURN voto_finale;
END;
$$ LANGUAGE plpgsql;


--1. Trigger per l'eliminazione dei record dalla tabella studente:

CREATE OR REPLACE FUNCTION unitua.trigger_delete_studente()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM unitua.studente 
    WHERE matricola = NEW.studente;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_delete_studente
AFTER INSERT ON unitua.laurea
FOR EACH ROW
EXECUTE FUNCTION unitua.trigger_delete_studente();

--2. Trigger per l'aggiunta dei record in ex_studente:

CREATE OR REPLACE FUNCTION unitua.trigger_insert_ex_studente()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO unitua.ex_studente (matricola, nome, cognome, codFiscale, sesso, cellulare, data_immatricolazione, stato, utente_email, CdL)
	VALUES (OLD.matricola, OLD.nome, OLD.cognome, OLD.codFiscale, OLD.sesso, OLD.cellulare, OLD.data_immatricolazione, OLD.stato, OLD.utente_email, OLD.CdL);

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_insert_ex_studente
AFTER DELETE ON unitua.studente
FOR EACH ROW
EXECUTE FUNCTION unitua.trigger_insert_ex_studente();

--3. Trigger spostamento da valutazione a storico_valutazione:

CREATE OR REPLACE FUNCTION unitua.trigger_insert_storico()
RETURNS TRIGGER AS $$
DECLARE valutazione unitua.valutazione%ROWTYPE;
BEGIN
    INSERT INTO unitua.storico_valutazione(ex_studente, calendario, esame, docente, voto, lode, respinto, data_verbalizzazione, accettato)
	VALUES (OLD.studente, OLD.calendario, OLD.esame, OLD.docente, OLD.voto, OLD.lode, OLD.respinto, OLD.data_verbalizzazione, OLD.accettato);
    
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_insert_storico
AFTER DELETE ON unitua.valutazione
FOR EACH ROW
EXECUTE FUNCTION unitua.trigger_insert_storico();


--Insert e query di verifica:

CALL unitua.insert_laurea(5, unitua.calcolo_voto_laurea('98007A', 5), '2023-04-20', false, '98007A', 102, 1);

SELECT * FROM unitua.laurea;

SELECT * FROM unitua.valutazione;

SELECT * FROM unitua.storico_valutazione;

SELECT * FROM unitua.studente;

SELECT * FROM unitua.ex_studente;

--Trigger di controllo sull'inserimento dell'insegnamento 1:
CREATE OR REPLACE FUNCTION unitua.controllo_anno_insegnamento_mag()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.anno_insegnamento IN ('3', '4', '5') AND EXISTS (
        SELECT 1
        FROM unitua.corso_di_laurea
        WHERE codice = NEW.CdL AND tipologia = 'Magistrale'
    ) THEN
        RAISE EXCEPTION 'Non è possibile inserire % come anno di un insegnamento di un CdL magistrale.', NEW.anno_insegnamento;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_anno_insegnamento_mag
BEFORE INSERT ON unitua.insegnamento
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_anno_insegnamento_mag();

/*
--Insert di prova del trigger precedente:
CALL unitua.insert_insegnamento('Crittografia', '3', 'Corso di Crittografia del CdL in Sicurezza Informatica (Magistrale)', 100, 6);
*/

--Trigger di controllo sull'inserimento dell'insegnamento 2:
CREATE OR REPLACE FUNCTION unitua.controllo_anno_insegnamento_tri()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.anno_insegnamento IN ('4', '5') AND EXISTS (
        SELECT 1
        FROM unitua.corso_di_laurea
        WHERE codice = NEW.CdL AND tipologia = 'Triennale'
    ) THEN
        RAISE EXCEPTION 'Non è possibile inserire % come anno di un insegnamento di un CdL triennale.', NEW.anno_insegnamento;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_anno_insegnamento_tri
AFTER INSERT ON unitua.insegnamento
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_anno_insegnamento_tri();


--Trigger di controllo inserimento studente:
CREATE OR REPLACE FUNCTION unitua.controllo_insert_stud()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.utente_email
	NOT LIKE '%@studenti%'
    THEN
        RAISE EXCEPTION 'Lo studente deve essere registrato con dominio @studenti';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_insert_stud
BEFORE INSERT ON unitua.studente
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_insert_stud();

/*
--Insert di verifica:
CALL unitua.insert_utente('giovanni.rana@docenti.unitua.it', 'PassKey');
CALL unitua.insert_studente('08871A', 'Giovanni', 'Rana', 'JSY1937SFAQI9QO0', 'M', '9238475610', '2021-10-9', 'In corso', 'giovanni.rana@docenti.unitua.it', 1);
*/

--Trigger di controllo inserimento docente:
CREATE OR REPLACE FUNCTION unitua.controllo_insert_doc()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.utente_email
	NOT LIKE '%@docenti%'
    THEN
        RAISE EXCEPTION 'Il docente deve essere registrato con dominio @docenti';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_insert_doc
BEFORE INSERT ON unitua.docente
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_insert_doc();

/*
--Insert di verifica:
CALL unitua.insert_utente('giovanni.rana@studenti.unitua.it', 'PassKey');
CALL unitua.insert_docente('08871A', 'Giovanni', 'Rana', 'JSY1937SFAQI9QO0', 'M', '9238475610', '2021-10-9', 'In corso', 'giovanni.rana@studenti.unitua.it', 1);
*/

--Trigger di controllo inserimento membro della segreteria:
CREATE OR REPLACE FUNCTION unitua.controllo_insert_segret()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.utente_email
	NOT LIKE '%@segreteria%'
    THEN
        RAISE EXCEPTION 'Il membro della segreteria deve essere registrato con dominio @segreteria';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_insert_segret
BEFORE INSERT ON unitua.segreteria
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_insert_segret();

/*
--Insert di verifica:
CALL unitua.insert_utente('giovanni.rana@segreteria.unitua.it', 'PassKey');
CALL unitua.insert_docente('08871A', 'Giovanni', 'Rana', 'JSY1937SFAQI9QO0', 'M', '9238475610', '2021-10-9', 'In corso', 'giovanni.rana@segreteria.unitua.it', 1);
*/


--Trigger di controllo su inserimento nome e cognome dello studente:
CREATE OR REPLACE FUNCTION unitua.controlla_nome_cognome()
RETURNS TRIGGER AS $$
DECLARE
    mail_splittata varchar[];
	mail_splittata2 varchar[];
    nome_mail varchar;
    cognome_mail varchar;
BEGIN
    mail_splittata := string_to_array(NEW.utente_email, '.');
    nome_mail := mail_splittata[1];
	mail_splittata2 := string_to_array(mail_splittata[2], '@');
    cognome_mail := mail_splittata2[1];

    IF LOWER(NEW.nome) <> LOWER(nome_mail) THEN
        RAISE EXCEPTION 'Il nome dello studente non corrisponde a quello sulla mail: %.', nome_mail;
    END IF;

    IF LOWER(NEW.cognome) <> LOWER(cognome_mail) THEN
        RAISE EXCEPTION 'Il cognome dello studente non corrisponde al cognome sulla mail: %.', cognome_mail;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controlla_nome_cognome
BEFORE INSERT ON unitua.studente
FOR EACH ROW
EXECUTE FUNCTION controlla_nome_cognome();

/*
--Insert di prova:
CALL unitua.insert_utente('giovanni.rana@studenti.unitua.it', 'PassKey');
CALL unitua.insert_studente('08871A', 'Giovanni', 'Rana', 'JSY1937SFAQI9QO0', 'M', '9238475610', '2021-10-9', 'In corso', 'giovanni.rana@studenti.unitua.it', 1);
*/


--Trigger di controllo iscrizione esami del proprio CdL:
CREATE OR REPLACE FUNCTION unitua.controllo_iscrizione_esame1()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.studente AS s 
        JOIN unitua.docente AS d
		ON NEW.docente = d.id
        WHERE s.matricola = NEW.studente AND s.CdL <> d.CdL
    ) THEN
        RAISE EXCEPTION 'Non puoi iscriverti ad un esame che non fa parte del tuo corso di laurea.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_iscrizione_esame1
BEFORE INSERT ON unitua.iscritti
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_iscrizione_esame1();

/*
--Insert di prova del trigger precedente:
CALL unitua.insert_iscritto(101, '05460A', 501, 1102);
CALL unitua.insert_iscritto(105, '05460A', 505, 1104);

SELECT * FROM unitua.iscritti;
*/


--1. Trigger di controllo sulle valutazioni (voto != 30 --> lode = false):
CREATE OR REPLACE FUNCTION unitua.controllo_lode()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.valutazione
        WHERE NEW.voto <> 30 AND NEW.lode = true
    ) THEN
        RAISE EXCEPTION 'Impossibile inserire la lode allo studente, il voto è pari a %', NEW.voto;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_lode
BEFORE INSERT ON unitua.valutazione
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_lode();

/*
--Insert di prova:
CALL unitua.insert_valutazione('05460A', 1103, 503, 103, 24, true, false, '2022-10-23', true);
*/

--2. Trigger di controllo sulle valutazioni (se voto >= 18, respinto = false):
CREATE OR REPLACE FUNCTION unitua.controlla_respinto()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.valutazione
        WHERE NEW.voto >= 18 AND NEW.respinto = true
    ) THEN
        RAISE EXCEPTION 'Errore nell inserimento del voto. Lo studente ha ricevuto un voto pari a %, non è stato respinto.', NEW.voto;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controlla_respinto
BEFORE INSERT ON unitua.valutazione
FOR EACH ROW
EXECUTE FUNCTION unitua.controlla_respinto();

/*
--Insert di prova:
CALL unitua.insert_valutazione('05460A', 1103, 503, 103, 24, false, true, '2022-10-23', true);
*/

--Trigger di controllo sulle valutazioni (se respinto = true, accettato = false):
CREATE OR REPLACE FUNCTION unitua.controlla_respinto_notAcc()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.valutazione
        WHERE NEW.respinto = true AND NEW.accettato = true
    ) THEN
        RAISE EXCEPTION 'Errore nell inserimento del voto. Lo studente è stato respinto e non può accettare/rifiutare il voto.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controlla_respinto_notAcc
BEFORE INSERT ON unitua.valutazione
FOR EACH ROW
EXECUTE FUNCTION unitua.controlla_respinto_notAcc();

/*
--Insert di prova:
CALL unitua.insert_valutazione('05460A', 1103, 503, 103, null, false, true, '2022-10-23', true);
*/

--Trigger di controllo sulla valutazione (voto = null allora respinto = true):
CREATE OR REPLACE FUNCTION unitua.controlla_insufficienza()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.valutazione
        WHERE NEW.voto IS NULL AND respinto = true
    ) THEN
        RAISE EXCEPTION 'Lo studente deve necessariamente essere respinto poiché il voto è = null.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controlla_insufficienza
AFTER INSERT ON unitua.valutazione
FOR EACH ROW
EXECUTE FUNCTION unitua.controlla_insufficienza();

/*
--Insert di prova:
CALL unitua.insert_valutazione('05460A', 1103, 503, 103, null, false, true, '2022-10-23', false);
*/

--Trigger su insegnamenti di responsabilità di un docente 1:
CREATE OR REPLACE FUNCTION unitua.conta_insegnamenti_max()
RETURNS TRIGGER AS $$
DECLARE n_insegnamenti INT;
BEGIN
    SELECT COUNT(*)
	INTO n_insegnamenti
    FROM unitua.insegnamento
    WHERE docente = NEW.docente;
		
	IF n_insegnamenti > 3
    THEN
        RAISE EXCEPTION 'Un docente può avere al massimo 3 insegnamenti di cui è responsabile.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER conta_insegnamenti_max
AFTER INSERT ON unitua.insegnamento
FOR EACH ROW
EXECUTE FUNCTION unitua.conta_insegnamenti_max();

/*
--Insert di prova:
CALL unitua.insert_insegnamento('Progettazione Motori di ricerca', '1', 'Descrizione', 100, 1);
CALL unitua.insert_insegnamento('Programmazione 2', '2', 'Esame di programmazione 2 del secondo anno di informatica (triennale)', 100, 1);
CALL unitua.insert_insegnamento('Reti', '3', 'Esame di reti del terzo anno di informatica (triennale)', 100, 1);

SELECT * FROM unitua.insegnamento;
*/

--Trigger su insegnamenti di responsabilità di un docente 1:
CREATE OR REPLACE FUNCTION unitua.conta_insegnamenti_min()
RETURNS TRIGGER AS $$
DECLARE n_insegnamenti INT;
BEGIN 
    SELECT COUNT(*)
    INTO n_insegnamenti
    FROM unitua.insegnamento
    WHERE docente = NEW.docente;

    IF n_insegnamenti = 0
    THEN
        RAISE EXCEPTION 'Un docente deve essere responsabile di almeno 1 insegnamento.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER conta_insegnamenti_min
BEFORE DELETE ON unitua.insegnamento
FOR EACH ROW
EXECUTE FUNCTION unitua.conta_insegnamenti_min();

/*
--Delete di prova:
DELETE * FROM unitua.insegnamento
WHERE docente = 100;
*/

--Trigger ora e aula esame:
CREATE OR REPLACE FUNCTION unitua.controllo_ora_aula()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.calendario
        WHERE NEW.ora = ora AND NEW.aula = aula AND NEW.data_esame = data_esame
    ) THEN
        RAISE EXCEPTION 'Prenotazione non disponibile. Questa aula è già occupata.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_ora_aula
BEFORE INSERT ON unitua.calendario
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_ora_aula();

/*
--Insert di prova:
CALL unitua.insert_calendario('2017-02-24', '8:30', 'P202', 503, '2017', 103, 1);

SELECT * FROM unitua.calendario;
*/

--Trigger su calendario (solo 1 esame al giorno per insegnamento):
CREATE OR REPLACE FUNCTION unitua.controllo_esame_al_giorno()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.calendario AS c
		JOIN unitua.insegnamento AS i
		ON c.docente = i.docente
		JOIN unitua.esame AS e
		ON e.insegnamento = i.codice
        WHERE c.data_esame = NEW.data_esame AND i.codice = e.insegnamento
    ) THEN
        RAISE EXCEPTION 'Non è possibile inserire più di un esame al giorno per lo stesso insegnamento.';
    END IF;
	
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_esame_al_giorno
BEFORE INSERT ON unitua.calendario
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_esame_al_giorno();


/*
--Insert di prova:
CALL unitua.insert_calendario('2023-01-27', '10:30', 'S406', 506, '2022', 100, 1);

SELECT * FROM unitua.calendario;
*/

--Trigger di controllo sugli esami propedeutici:
CREATE OR REPLACE FUNCTION unitua.controllo_propedeuticita()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.esame AS e
        JOIN unitua.propedeuticita AS p
        ON e.insegnamento = p.insegnamento_con_propedeuticita
        LEFT JOIN unitua.valutazione AS v 
        ON NEW.studente = v.studente
        WHERE v.accettato = false OR v.accettato IS NULL
    ) THEN
        RAISE EXCEPTION 'Non puoi iscriverti a questo esame poiché non rispetteresti le propedeuticità del tuo CdL.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_propedeuticita
BEFORE INSERT OR UPDATE ON unitua.iscritti
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_propedeuticita();

/*
--Insert di prova:
CALL unitua.insert_utente('roberto.bolle@studenti.unitua.it', 'Prova');
CALL unitua.insert_studente('05578A', 'Roberto', 'Bolle', 'APLW30PLQ208AWU8', 'M', '9283746510', '2021-09-10', 'In corso', 'roberto.bolle@studenti.unitua.it', 1);
CALL unitua.insert_valutazione('05578A', 1101, 500, 100, 25, false, false, '2022-02-02', true);
CALL unitua.insert_iscritto(101, '05578A', 502, 1102);
*/

--Trigger di controllo inserimento esami per i docenti 2:
CREATE OR REPLACE FUNCTION unitua.controllo_esami_docenti1()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.calendario AS c
        JOIN unitua.docente AS d
        ON c.docente = d.id
        WHERE NEW.CdL <> d.CdL
    ) THEN
        RAISE EXCEPTION 'Il corso di laurea inserito nel calendario non corrisponde al corso di laurea di riferimento.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_esami_docenti1
BEFORE INSERT ON unitua.calendario
FOR EACH ROW 
EXECUTE FUNCTION unitua.controllo_esami_docenti1();

/*
--Insert di prova:
CALL unitua.insert_calendario('2022-02-22', '8:00', 'P204', 501, '2017', 100, 2);
*/

--Trigger di controllo su calendario (anno della data = A.A.):
CREATE OR REPLACE FUNCTION unitua.controllo_anno_acc()
RETURNS TRIGGER AS $$
BEGIN 
    IF EXISTS (
        SELECT 1
        FROM unitua.calendario
        WHERE NEW.anno_accademico <> EXTRACT(year FROM NEW.data_esame)
    ) THEN
        RAISE EXCEPTION 'L anno accademico inserito non coincide con l anno accademico della data.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_anno_acc
BEFORE INSERT ON unitua.calendario
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_anno_acc();

/*
--Insert di prova:
CALL unitua.insert_calendario('2023-01-10', '8:30', 'ALFA', 502, 2023, 101, 1)
*/

--Trigger controllo insegnamenti docente:
CREATE OR REPLACE FUNCTION unitua.controllo_esami_docenti2()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.calendario
        JOIN unitua.esame AS e
        ON NEW.esame = e.codice
        JOIN unitua.insegnamento AS i
        ON e.insegnamento = i.codice
        WHERE NEW.docente <> i.docente
    ) THEN
        RAISE EXCEPTION 'Non è possibile inserire l esame di un insegnamento di cui non si è responsabili.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER controllo_esami_docenti2
BEFORE INSERT ON unitua.calendario
FOR EACH ROW
EXECUTE FUNCTION unitua.controllo_esami_docenti2();

/*
--Insert di prova:
CALL unitua.insert_calendario('2023-01-29', '8:45', 'LAMBDA', 500, '2023', 102, 1);
*/

--Funzione per autenticazione utente:
CREATE OR REPLACE FUNCTION unitua.verifica(
    mail text,
    pass text
)
RETURNS SETOF unitua.utente AS $$
DECLARE
    mail_verificato unitua.utente%ROWTYPE;
BEGIN
    SELECT email 
    INTO mail_verificato
    FROM unitua.utente
    WHERE email = mail AND pw = md5(pass);
	
    RETURN NEXT mail_verificato;
END;
$$ LANGUAGE plpgsql;

SELECT * FROM unitua.verifica('giacomo.comitani@studenti.unitua.it', 'Password#2');

--Creazione della vista per restituire i dati completi dalla funzione:
CREATE OR REPLACE VIEW unitua.vista_studente_completo AS
    SELECT s.*, cdl.*
    FROM unitua.studente AS s
    JOIN unitua.corso_di_laurea AS cdl
    ON cdl.codice = s.CdL;

--Funzione per restituire le informazioni di uno studente:
CREATE OR REPLACE FUNCTION unitua.get_info(
	mail text
)
RETURNS SETOF unitua.vista_studente_completo AS $$
DECLARE
	all_info unitua.vista_studente_completo%ROWTYPE;
BEGIN
	SELECT * 
	INTO all_info
	FROM unitua.vista_studente_completo as s
	WHERE s.utente_email = mail;
	
	RETURN NEXT all_info;
END;
$$ LANGUAGE plpgsql;

SELECT * FROM unitua.get_info('andrea.galliano@studenti.unitua.it');

--Funzione per l'aggiornamento della password per un utente che intende modificarla:
CREATE OR REPLACE FUNCTION unitua.change_pw(
    mail text,
    old_pw text,
    new_pw text
)
RETURNS INTEGER AS $$
DECLARE 
    aggiornato varchar;
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.utente AS u
        WHERE u.pw = md5(old_pw)
    ) THEN
        UPDATE unitua.utente
        SET pw = md5(new_pw)
        WHERE email = mail
	    RETURNING email INTO aggiornato;
  
    END IF; 
    
	IF aggiornato IS NOT NULL
	THEN
		RETURN '1';
	ELSE
		RETURN '0';
	END IF;
END;
$$ LANGUAGE plpgsql;

/*
--Query di prova:
SELECT * FROM unitua.change_pw('giacomo.comitani@studenti.unitua.it', 'Password#2', 'PassCambiata');
*/

--Funzione che restituisce tutte le valutazioni data la matricola:
CREATE OR REPLACE FUNCTION unitua.get_carriera(
    matricola text
)
RETURNS SETOF unitua.valutazione AS $$
DECLARE
    all_carriera unitua.valutazione%ROWTYPE;
BEGIN
    SELECT v.*
    INTO all_carriera
    FROM unitua.valutazione AS v
    WHERE v.studente = matricola;

    RETURN NEXT all_carriera;
END;
$$ LANGUAGE plpgsql;


--Query di prova:
SELECT * FROM unitua.get_carriera('05460A');


--Vista per produrre il calendario completo degli esami:
CREATE OR REPLACE VIEW unitua.vista_calendario AS
    SELECT c.codice_appello, c.data_esame, c.ora, c.aula, c.anno_accademico, 
    e.codice AS codice_esame, i.nome_insegnamento,
	d.id AS codice_docente, d.nome, d.cognome,  d.cdl, 
	cd.tipologia, cd.descrizione
    FROM unitua.calendario AS c
    JOIN unitua.docente AS d
    ON c.docente = d.id
    JOIN unitua.corso_di_laurea AS cd
    ON c.CdL = cd.codice
    JOIN unitua.esame AS e
    ON c.esame = e.codice
    JOIN unitua.insegnamento AS i 
    ON e.insegnamento = i.codice;

--Funzione per visualizzare il calendario completo degli esami per un certo studente:
CREATE OR REPLACE FUNCTION unitua.get_calendario (
    corso_di_laurea integer
)
RETURNS SETOF unitua.vista_calendario AS $$
DECLARE
    all_info_cal unitua.vista_calendario%ROWTYPE;
BEGIN
    FOR all_info_cal IN
        SELECT *
        FROM unitua.vista_calendario AS vc 
        WHERE vc.cdl = corso_di_laurea
    LOOP
        RETURN NEXT all_info_cal;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

/*
--Select di verifica:
SELECT * FROM unitua.get_calendario(1);
*/

--Funzione che restituisca il CdL di uno studente data la sua email:
CREATE OR REPLACE FUNCTION unitua.get_cdl(
    email_in text
)
RETURNS INTEGER AS $$
DECLARE 
	cdl_stud INTEGER;
BEGIN
    SELECT s.CdL
    INTO cdl_stud
    FROM unitua.studente AS s
    WHERE s.utente_email = email_in;

    RETURN cdl_stud; 
END;
$$ LANGUAGE plpgsql;

/*
--Select di verifica:
SELECT * FROM unitua.get_cdl('andrea.galliano@studenti.unitua.it');
*/

--Funzione che restituisce la matricola di uno studente dato il suo indirizzo email:
CREATE OR REPLACE FUNCTION unitua.get_matricola (
    email_in text
)
RETURNS VARCHAR AS $$
DECLARE
    matricola_out text;
BEGIN
    SELECT s.matricola
    INTO matricola_out
    FROM unitua.studente AS s
    WHERE s.utente_email = email_in;

    RETURN matricola_out;
END;
$$ LANGUAGE plpgsql;

/*
--Verifica della funzione:
SELECT * FROM unitua.get_matricola('andrea.galliano@studenti.unitua.it');
*/