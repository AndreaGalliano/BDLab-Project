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
CALL unitua.insert_utente('giovanni.bianchi@docenti.unitua.it', 'Password#22');
CALL unitua.insert_utente('giovanni.pighizzini@docenti.unitua.it', 'Password#23');

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
CALL unitua.insert_studente('06680A', 'Mattia', 'Delledonne', 'EHDN2N416AGEB28P', 'M', '1234567880', '2021-09-23', 'In corso', 'mattia.delledonne@studenti.unitua.it', 1);
CALL unitua.insert_studente('456O0A', 'Michele', 'Bolis', 'BLSMCL02L20U920P', 'M', '3049586721', '2018-06-23', 'Fuoricorso', 'michele.bolis@studenti.unitua.it', 12);
CALL unitua.insert_studente('29049A', 'Pietro', 'Rusconi', 'RSCPTR02N10Y781Q', 'M', '0192837465', '2021-09-26', 'In corso', 'pietro.rusconi@studenti.unitua.it', 8);
CALL unitua.insert_studente('28790A', 'Alessandro', 'Mataloni', 'MTLLSR03G12H860O', 'M', '1099847756', '2021-09-25', 'In corso', 'alessandro.mataloni@studenti.unitua.it', 7);
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
CALL unitua.insert_docente('Giovanni', 'Bianchi', 'GZTC2PP5N8Y1BB4I', 'M', '5176815523', 'Associato', 'giovanni.bianchi@docenti.unitua.it', 7);
CALL unitua.insert_docente('Givanni', 'Pighizzini', 'FSKJK3FKSE35HW67', 'M', '1029448856', 'Ordinario', 'giovanni.pighizzini@docenti.unitua.it', 1);

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
    ruolo unitua.ruolo_segreteria,
    utente_email varchar
)
AS $$
    BEGIN
        INSERT INTO unitua.segreteria(nome, cognome, codFiscale, sesso, cellulare, ruolo, utente_email)
        VALUES (nome, cognome, codFiscale, sesso, cellulare, ruolo, utente_email);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_membro_segreteria('Luigi', 'Pepe', 'JYQV24A9R6V7JXXJ', 'M', '5809946869', 'Primo livello', 'luigi.pepe@segreteria.unitua.it');
CALL unitua.insert_membro_segreteria('Mario', 'Rossi', '2JIUU5D1NAYCN6MI', 'M', '8446867516', 'Secondo livello','mario.rossi@segreteria.unitua.it');

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
CALL unitua.insert_insegnamento('Algoritmi e strutture dati', '1', 'Esame di algoritmi del secondo anno di informatica (triennale)', 106, 1);
CALL unitua.insert_insegnamento('Algoritmica per il Web', '3', 'Esame di algoritmica per il web del terzo anno di informatica (triennale)', 100, 1);

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
CALL unitua.insert_esame(306, 'Presenza', 'Orale');
CALL unitua.insert_esame(307, 'Presenza', 'Scritto');

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

CALL unitua.insert_propedeuticita(300, 301); --Programmazione - S.O.
CALL unitua.insert_propedeuticita(300, 302); --Tecnologie web
CALL unitua.insert_propedeuticita(300, 303); --Basi di dati
CALL unitua.insert_propedeuticita(300, 306); --Algoritmi
CALL unitua.insert_propedeuticita(300, 307); --Algoritmica per il Web

SELECT * FROM unitua.propedeuticita;

--Inserimento record della tabella calendario:

SELECT pg_get_serial_sequence('unitua.calendario', 'codice_appello');
SELECT setval(pg_get_serial_sequence('unitua.calendario', 'codice_appello'), 1100, false);

CREATE OR REPLACE PROCEDURE unitua.insert_calendario(
    data_esame date,
    ora time,
    aula varchar,
    aperto boolean,
    esame int,
    anno_accademico int,
    docente int,
    CdL int
)
AS $$
    BEGIN
        INSERT INTO unitua.calendario (data_esame, ora, aula, aperto, esame, anno_accademico, docente, CdL)
        VALUES (data_esame, ora, aula, aperto, esame, anno_accademico, docente, CdL);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_calendario('2017-02-24', '8:30', 'P202', true, 500, '2017', 100, 1); --1100
CALL unitua.insert_calendario('2023-01-27', '9:00', 'P202', true, 500, '2023', 100, 1); --1101
CALL unitua.insert_calendario('2023-01-27', '14:30', 'S500', true, 501, '2023', 101, 1); --1102
CALL unitua.insert_calendario('2023-01-27', '8:45', 'OMEGA', true, 502, '2023', 102, 1); --1103
CALL unitua.insert_calendario('2023-06-13', '9:00', 'DELTA', true, 506, '2023', 106, 1);
CALL unitua.insert_calendario('2023-07-25', '14:30', 'BERTONI', true, 507, '2023', 100, 1);

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
    data_verbalizzazione date
)
AS $$
    BEGIN
        INSERT INTO unitua.valutazione (studente, calendario, esame, docente, voto, lode, respinto, data_verbalizzazione)
        VALUES (studente, calendario, esame, docente, voto, lode, respinto, data_verbalizzazione);
    END;
$$ LANGUAGE plpgsql;

CALL unitua.insert_valutazione('05460A', 1101, 500, 100, 23, false, false, '2022-02-02');
CALL unitua.insert_valutazione('05460A', 1102, 501, 101, 26, false, false, '2023-02-16');
CALL unitua.insert_valutazione('98007A', 1101, 500, 100, 20, false, false, '2022-02-02');
CALL unitua.insert_valutazione('98007A', 1102, 501, 101, 30, true, false, '2022-02-20');
CALL unitua.insert_valutazione('98007A', 1103, 502, 102, 25, false, false, '2022-01-07');

--CALL unitua.insert_valutazione('05460A', 1105, 507, 100, 27, false, false, '2023-07-02');
--SELECT * FROM unitua.iscritti;

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
    INSERT INTO unitua.storico_valutazione(ex_studente, calendario, esame, docente, voto, lode, respinto, data_verbalizzazione)
	VALUES (OLD.studente, OLD.calendario, OLD.esame, OLD.docente, OLD.voto, OLD.lode, OLD.respinto, OLD.data_verbalizzazione);
    
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_insert_storico
AFTER DELETE ON unitua.valutazione
FOR EACH ROW
EXECUTE FUNCTION unitua.trigger_insert_storico();


--Insert e query di verifica:

CALL unitua.insert_laurea(5, unitua.calcolo_voto_laurea('98007A', 5), '2023-04-20', false, '98007A', 100, 1);

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

--Trigger di controllo sulla valutazione (voto = null allora respinto = true):
CREATE OR REPLACE FUNCTION unitua.controlla_insufficienza()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.valutazione
        WHERE NEW.voto IS NULL AND NEW.respinto = false
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
    WHERE docente = OLD.docente;
		
	IF n_insegnamenti > 3
    THEN
        RAISE EXCEPTION 'Un docente può avere al massimo 3 insegnamenti di cui è responsabile.';
    END IF;

    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER conta_insegnamenti_max
AFTER INSERT OR UPDATE ON unitua.insegnamento
FOR EACH ROW
EXECUTE FUNCTION unitua.conta_insegnamenti_max();

/*
--Insert di prova:
CALL unitua.insert_insegnamento('Progettazione Motori di ricerca', '1', 'Descrizione', 100, 1);
CALL unitua.insert_insegnamento('Programmazione 2', '2', 'Esame di programmazione 2 del secondo anno di informatica (triennale)', 100, 1);
CALL unitua.insert_insegnamento('Reti', '3', 'Esame di reti del terzo anno di informatica (triennale)', 100, 1);
DELETE FROM unitua.insegnamento where nome_insegnamento='Reti di Calcolatori'
SELECT * FROM unitua.insegnamento;
DROP TRIGGER conta_insegnamenti_max ON unitua.insegnamento;
*/

--Trigger su insegnamenti di responsabilità di un docente 2:
CREATE OR REPLACE FUNCTION unitua.conta_insegnamenti_min()
RETURNS TRIGGER AS $$
DECLARE n_insegnamenti INT;
BEGIN 
    SELECT COUNT(*)
    INTO n_insegnamenti
    FROM unitua.insegnamento
    WHERE docente = OLD.docente;

    IF n_insegnamenti = 0
    THEN
        RAISE EXCEPTION 'Un docente deve essere responsabile di almeno 1 insegnamento %.', n_insegnamenti;
    END IF;

    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER conta_insegnamenti_min
BEFORE DELETE ON unitua.insegnamento
FOR EACH ROW
EXECUTE FUNCTION unitua.conta_insegnamenti_min();

/*
--Delete di prova:
DROP TRIGGER conta_insegnamenti_min ON unitua.insegnamento;
DELETE FROM unitua.insegnamento
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
CALL unitua.insert_calendario('2017-02-24', '8:30', 'P202', true, 503, '2017', 103, 1);

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
CALL unitua.insert_calendario('2023-01-27', '10:30', 'S406', true, 506, '2022', 100, 1);

SELECT * FROM unitua.calendario;
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
CALL unitua.insert_calendario('2022-02-22', '8:00', 'P204', true, 501, '2017', 100, 2);
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
CALL unitua.insert_calendario('2023-01-10', '8:30', 'ALFA', true, 502, 2023, 101, 1)
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
CALL unitua.insert_calendario('2023-01-29', '8:45', 'LAMBDA', true, 500, '2023', 102, 1);
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


--Vista per produrre il calendario completo degli esami:
CREATE OR REPLACE VIEW unitua.vista_calendario AS
    SELECT c.codice_appello, c.data_esame, c.ora, c.aula, c.aperto,
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
        WHERE vc.cdl = corso_di_laurea AND vc.aperto = true
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

SELECT * FROM unitua.iscritti;

--Creazione della vista per disiscrizione/visione iscrizioni confermate:
CREATE OR REPLACE VIEW unitua.vista_iscrizione AS
    SELECT isc.studente, c.codice_appello, c.aperto, c.data_esame, c.ora, c.aula, 
    e.codice AS codice_esame, i.nome_insegnamento,
    d.id AS codice_docente, d.nome, d.cognome, d.cdl,
    cd.tipologia, cd.descrizione
    FROM unitua.iscritti AS isc 
    JOIN unitua.docente AS d 
    ON isc.docente = d.id 
    JOIN unitua.esame AS e 
    ON isc.esame = e.codice
    JOIN unitua.insegnamento AS i 
    ON e.insegnamento = i.codice
	JOIN unitua.corso_di_laurea AS cd
	ON i.cdl = cd.codice
    JOIN unitua.calendario AS c 
    ON isc.calendario = c.codice_appello;

SELECT * FROM unitua.vista_iscrizione;

--Funzione che restituisce le iscrizioni di uno studente ad uno o più esami:
CREATE OR REPLACE FUNCTION unitua.get_iscrizioni (
    matricola_in text
)
RETURNS SETOF unitua.vista_iscrizione AS $$
DECLARE 
    all_info_iscrizione unitua.vista_iscrizione%ROWTYPE;
BEGIN
    FOR all_info_iscrizione IN 
        SELECT *
        FROM unitua.vista_iscrizione AS vi 
        WHERE vi.studente = matricola_in AND vi.aperto = true
    LOOP
        RETURN NEXT all_info_iscrizione;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;


--Procedura che disiscrive uno studente da un appello:
CREATE OR REPLACE PROCEDURE unitua.delete_iscritto (
    docente_in integer,
    matricola_in text,
    esame_in integer,
    calendario_in integer
)
AS $$
    BEGIN
        DELETE FROM unitua.iscritti AS i 
        WHERE i.docente = docente_in AND i.studente = matricola_in AND i.esame = esame_in AND i.calendario = calendario_in;
    END;
$$ LANGUAGE plpgsql;

--Vista per valutazione:
CREATE OR REPLACE VIEW unitua.valutazione_completa AS
    SELECT v.studente, s.nome AS nome_studente, s.cognome AS cognome_studente, v.codice AS codice_valutazione, 
    c.data_esame AS codice_appello, e.codice AS codice_esame,
    i.nome_insegnamento, d.cognome AS presidente,
    v.voto, v.lode, v.respinto, v.data_verbalizzazione
    FROM unitua.valutazione AS v 
    JOIN unitua.calendario AS c
    ON v.calendario = c.codice_appello
    JOIN unitua.studente AS s 
    ON v.studente = s.matricola
    JOIN unitua.esame AS e 
    ON v.esame = e.codice 
    JOIN unitua.insegnamento AS i 
    ON e.insegnamento = i.codice
    JOIN unitua.docente AS d 
    ON v.docente = d.id;

--Funzione che restituisce tutte le valutazioni di uno studente data la sua matricola:
CREATE OR REPLACE FUNCTION unitua.get_carriera (
    matricola_in text
)
RETURNS SETOF unitua.valutazione_completa AS $$
DECLARE
    all_valutazione unitua.valutazione_completa%ROWTYPE;
BEGIN
    FOR all_valutazione IN 
        SELECT *
        FROM unitua.valutazione_completa AS v 
        WHERE v.studente = matricola_in
    LOOP
        RETURN NEXT all_valutazione;
    END LOOP;

    RETURN;

END;
$$ LANGUAGE plpgsql;

/*
--Chiamata di verifica:
SELECT * FROM unitua.get_carriera('05460A');
*/

--Funzione che restituisce solo i voti sufficienti di uno studente:
CREATE OR REPLACE FUNCTION unitua.get_carriera_suff (
    matricola_in text 
)
RETURNS SETOF unitua.valutazione_completa AS $$
DECLARE
    all_valutazione_suff unitua.valutazione_completa%ROWTYPE;
BEGIN
    FOR all_valutazione_suff IN
        SELECT * 
        FROM unitua.valutazione_completa AS vc  
        WHERE vc.studente = matricola_in AND vc.voto >= 18
    LOOP
        RETURN NEXT all_valutazione_suff;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

--Vista per insegnamenti di un cdl diverso da quello in cui si risulta iscritti:
CREATE OR REPLACE VIEW unitua.insegnamenti_diversi AS
    SELECT i.codice AS codice_insegnamento, i.nome_insegnamento, i.descrizione,
    d.cognome AS presidente, cd.codice AS codice_cdl, cd.descrizione AS nome_cdl
    FROM unitua.insegnamento AS i 
    JOIN unitua.docente AS d 
    ON i.docente = d.id
    JOIN unitua.corso_di_laurea AS cd 
    ON i.cdl = cd.codice;

--Funzione che restituisce tutti gli insegnamenti dei corsi di laurea diversi da quello a cui si è iscritto:
CREATE OR REPLACE FUNCTION unitua.get_other_ins(
    corso_iscritto integer 
)
RETURNS SETOF unitua.insegnamenti_diversi AS $$
DECLARE
    all_other_ins unitua.insegnamenti_diversi%ROWTYPE;
BEGIN
    FOR all_other_ins IN
        SELECT *
        FROM unitua.insegnamenti_diversi AS ins
        WHERE ins.codice_cdl <> corso_iscritto
    LOOP
        RETURN NEXT all_other_ins;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

--Vista per esami propedeutici 1:
CREATE OR REPLACE VIEW unitua.esami_con_propedeuticita AS
    SELECT cd.codice AS codice_cdl, i.nome_insegnamento AS insegnamento_dipendente
    FROM unitua.insegnamento AS i
	JOIN unitua.propedeuticita AS p
	ON i.codice = p.insegnamento_con_propedeuticita
    JOIN unitua.corso_di_laurea AS cd
    ON i.cdl = cd.codice;
	
SELECT * FROM unitua.esami_con_propedeuticita;

--Vista per esami propedeutici 2:
CREATE OR REPLACE VIEW unitua.esami_propedeutici AS 
    SELECT i.nome_insegnamento AS insegnamento_propedeutico
    FROM unitua.insegnamento AS i 
    JOIN unitua.propedeuticita AS p 
    ON i.codice = p.insegnamento_propedeutico;

SELECT * FROM unitua.esami_propedeutici;

--Unione delle 2 viste:
CREATE OR REPLACE VIEW unitua.vista_prop_completa AS 
    SELECT v1.*, v2.*
    FROM (
        SELECT *, ROW_NUMBER() OVER (
            ORDER BY insegnamento_dipendente
        )
        AS rn1 
        FROM unitua.esami_con_propedeuticita
    ) v1
    FULL JOIN (
        SELECT *, ROW_NUMBER() OVER (
            ORDER BY insegnamento_propedeutico
        ) 
        AS rn2
        FROM unitua.esami_propedeutici
    ) v2 
    ON v1.rn1 = v2.rn2;

SELECT * FROM unitua.vista_prop_completa;

--Funzione che restituisce le propedeuticità di un cdl avuto per argomento:
CREATE OR REPLACE FUNCTION unitua.get_prop (
    cdl_in integer 
)
RETURNS SETOF unitua.vista_prop_completa AS $$
DECLARE 
    all_prop unitua.vista_prop_completa%ROWTYPE;
BEGIN
    FOR all_prop IN 
        SELECT *
        FROM unitua.vista_prop_completa AS vpc 
        WHERE codice_cdl = cdl_in
    LOOP
        RETURN NEXT all_prop;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

/*
--Chiamata di verifica:
SELECT * FROM unitua.get_prop(1);
*/

--Funzione booleana che dato il codice di un esame stabilisce se ha propedeuticità:
CREATE OR REPLACE FUNCTION unitua.check_esame (
    esame_in integer 
)
RETURNS BOOLEAN AS $$
DECLARE 
    esame_presente boolean := false;
BEGIN
    esame_presente := EXISTS (
        SELECT 1
        FROM unitua.propedeuticita AS p
        WHERE p.insegnamento_con_propedeuticita = esame_in
    );

    RETURN esame_presente;
END;
$$ LANGUAGE plpgsql;

/*
--Chiamata di verifica:
SELECT * FROM unitua.check_esame(301);
*/

--Vista per controllo dell'esame propedeutico superato:
CREATE OR REPLACE VIEW unitua.vista_prop_studente AS 
    SELECT DISTINCT v.studente, v.voto,
	e.codice AS codice_esame, i.nome_insegnamento
    FROM unitua.valutazione AS v
    JOIN unitua.esame AS e 
    ON v.esame = e.codice 
    JOIN unitua.insegnamento AS i 
    ON e.insegnamento = i.codice
    JOIN unitua.propedeuticita AS p 
    ON i.codice = p.insegnamento_propedeutico;

/*
--Query di prova:
SELECT * FROM unitua.vista_prop_studente;
*/

--Funzione booleana che dato un esame che si assuma sia in propedeuticità, restituisca se uno studente ha superato il relativo esame propedeutico:
CREATE OR REPLACE FUNCTION unitua.passato (
    matricola_in text,
    esame_in integer
)
RETURNS BOOLEAN AS $$
DECLARE 
    esame_passato boolean := false;
BEGIN
    esame_passato := EXISTS (
        SELECT *
        FROM unitua.vista_prop_studente AS vps
        WHERE vps.studente = matricola_in AND vps.voto >= 18
    );

    RETURN esame_passato;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.passato('05460A', 501);
*/

--Funzione che restituisce l'insegnamento a partire dall'esame avuto per argomento:
CREATE OR REPLACE FUNCTION unitua.get_ins (
    esame_in integer 
)
RETURNS INTEGER AS $$
DECLARE 
    insegnamento_trovato integer;
BEGIN 
    SELECT i.codice
    INTO insegnamento_trovato
    FROM unitua.insegnamento AS i 
    INNER JOIN unitua.esame AS e 
    ON i.codice = e.insegnamento
    WHERE e.codice = esame_in;

    RETURN insegnamento_trovato; 
END;
$$ LANGUAGE plpgsql;

--Funzione che restituisce l'esame a partire dall'insegnamento avuto per argomento:
CREATE OR REPLACE FUNCTION unitua.get_es (
    ins_in integer
)
RETURNS INTEGER AS $$
DECLARE 
    esame_trovato integer;
BEGIN
    SELECT e.codice 
    INTO esame_trovato 
    FROM unitua.esame AS e 
    JOIN unitua.insegnamento AS i 
    ON e.insegnamento = i.codice
	WHERE i.codice = ins_in;

    RETURN esame_trovato;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_es(307);
*/

--Vista per avere tutti i dati di un docente:
CREATE OR REPLACE VIEW unitua.all_docente AS 
    SELECT d.*, cd.descrizione AS laurea, COUNT(i.nome_insegnamento) AS numero_insegnamenti
    FROM unitua.docente AS d 
    JOIN unitua.insegnamento AS i 
    ON i.docente = d.id
    JOIN unitua.corso_di_laurea AS cd 
    ON d.cdl = cd.codice
	GROUP BY d.id, cd.codice;


--Funzione che, data la mail di un docente come argomento, restituisca tutti i suoi dati personali:
CREATE OR REPLACE FUNCTION unitua.get_info_doc (
    mail text
)
RETURNS SETOF unitua.all_docente AS $$
DECLARE
    all_info_doc unitua.all_docente%ROWTYPE;
BEGIN
    SELECT *
    INTO all_info_doc
    FROM unitua.all_docente AS ad 
    WHERE ad.utente_email = mail;

    RETURN NEXT all_info_doc;
END;
$$ LANGUAGE plpgsql;


--Vista completa con insegnamenti del docente (non con COUNT):
CREATE OR REPLACE VIEW unitua.all_ins AS 
    SELECT DISTINCT d.*, i.codice, i.nome_insegnamento, i.anno_insegnamento, i.descrizione
    FROM unitua.docente AS d 
    JOIN unitua.insegnamento AS i 
    ON i.docente = d.id;

SELECT * FROM unitua.all_ins;

--Funzione che data la mail di un docente restituisce gli insegnamenti di cui è responsabile:
CREATE OR REPLACE FUNCTION unitua.get_insegnamenti (
    mail text
)
RETURNS SETOF unitua.all_ins AS $$
DECLARE
    all_info_ins unitua.all_ins%ROWTYPE;
BEGIN
    FOR all_info_ins IN
        SELECT * 
        FROM unitua.all_ins AS ad 
        WHERE ad.utente_email = mail
    LOOP
        RETURN NEXT all_info_ins;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_insegnamenti('sebastiano.vigna@docenti.unitua.it');
*/

--Vista per visualizzare tutti gli iscritti ad un appello di un insegnamento:
CREATE OR REPLACE VIEW unitua.vista_iscritti AS 
    SELECT s.cognome, s.nome, s.matricola, ins.nome_insegnamento, 
    e.codice AS codice_esame, c.codice_appello
    FROM unitua.studente AS s
    JOIN unitua.iscritti AS i 
    ON s.matricola = i.studente
    JOIN unitua.esame AS e 
    ON i.esame = e.codice 
    JOIN unitua.insegnamento AS ins 
    ON e.insegnamento = ins.codice
    JOIN unitua.calendario AS c
    ON i.calendario = c.codice_appello;

--Funzione che restituisce gli iscritti ad un certo appello di un insegnamento:
CREATE OR REPLACE FUNCTION unitua.get_iscritti (
    esame_in integer, 
    appello_in integer
)
RETURNS SETOF unitua.vista_iscritti AS $$
DECLARE
    all_iscritti_appello unitua.vista_iscritti%ROWTYPE;
BEGIN
    FOR all_iscritti_appello IN
        SELECT *
        FROM unitua.vista_iscritti AS vi 
        WHERE vi.codice_esame = esame_in AND vi.codice_appello = appello_in
    LOOP
        RETURN NEXT all_iscritti_appello;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_iscritti(500, 1101);
SELECT * FROM unitua.get_iscritti(507, 1105);
*/

--Vista per avere un preciso appello:
CREATE OR REPLACE VIEW unitua.calendario_completo AS 
    SELECT c.codice_appello, c.anno_accademico, c.aperto, c.data_esame, c.esame,
    d.id, d.nome, d.cognome
    FROM unitua.calendario AS c
    JOIN unitua.docente AS d 
    ON c.docente = d.id;

SELECT * FROM unitua.calendario_completo;

--Funzione che restituisce i codici di tutti gli appelli di un docente con id del docente e anno accademico corrente avuti per argomento:
CREATE OR REPLACE FUNCTION unitua.get_appello (
    id_doc integer,
    anno integer,
    esame_in integer
)
RETURNS SETOF unitua.calendario_completo AS $$
DECLARE 
    cal_out unitua.calendario_completo%ROWTYPE;
BEGIN 
    FOR cal_out IN 
        SELECT *
        FROM unitua.calendario_completo AS cc
        WHERE cc.anno_accademico = anno AND cc.id = id_doc AND cc.esame = esame_in AND cc.aperto = true
    LOOP
        RETURN NEXT cal_out;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

/*
SELECT * FROM unitua.get_appello(100, 2023, 500);
*/

/*
--Trigger che rimuove un iscritto dopo aver inserito il voto:
CREATE OR REPLACE FUNCTION unitua.remove_iscritto()
RETURNS TRIGGER AS $$
BEGIN 
    DELETE FROM unitua.iscritti
    WHERE studente = NEW.studente;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER remove_iscritto
AFTER INSERT ON unitua.valutazione
FOR EACH ROW
EXECUTE FUNCTION unitua.remove_iscritto();
*/

/*
--Insert di prova (da eseguire una alla volta):
CALL unitua.insert_utente('giovanni.rana@studenti.unitua.it', 'PasswordRana');
CALL unitua.insert_studente('34560A', 'Giovanni', 'Rana', 'ABDPRL02L34H988O', 'M', '1234123412', '2022-09-25', 'In corso', 'giovanni.rana@studenti.unitua.it', 1);
CALL unitua.insert_iscritto(100, '34560A', 500, 1101);
SELECT * FROM unitua.iscritti;
CALL unitua.insert_valutazione('34560A', 1101, 500, 100, 21, false, false, '2023-06-28');
*/

--Funzione che rimuove un appello d'esame a partire dal codice dell'appello avuto per argomento:
CREATE OR REPLACE PROCEDURE unitua.remove_appello (
    codice_in integer 
)
AS $$
BEGIN 
    UPDATE unitua.calendario AS c 
    SET aperto = false
    WHERE c.codice_appello = codice_in;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica (da eseguire una alla volta):
CALL unitua.insert_calendario('2023-07-12', '9:00', 'SIGMA', true, 500, '2023', 100, 1);
SELECT * FROM unitua.calendario;
CALL unitua.remove_appello(1105);
SELECT * FROM unitua.calendario;
*/

--Funzione che restituisce il nome di un insegnamento a partire dal codice dell'esame corrispondente:
CREATE OR REPLACE FUNCTION unitua.get_name_ins (
    esame_in integer 
)
RETURNS TEXT AS $$
DECLARE 
    nome_out text;
BEGIN
    SELECT i.nome_insegnamento
    INTO nome_out
    FROM unitua.insegnamento AS i 
    INNER JOIN unitua.esame AS e 
    ON i.codice = e.insegnamento 
    WHERE e.codice = esame_in;

    RETURN nome_out;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_name_ins(500);
*/

--Vista su laurea e docente:
CREATE OR REPLACE VIEW unitua.vista_laurea AS 
    SELECT l.relatore, l.codice AS codice_laurea, l.voto, l.lode, l.data_laurea,
    l.studente, ex.nome, ex.cognome
    FROM unitua.laurea AS l 
    JOIN unitua.ex_studente AS ex 
    ON l.studente = ex.matricola;

/*
--Query di verifica:
SELECT * FROM unitua.vista_laurea;
*/

--Funzione che restituisce tutti i record della vista laurea a partire dall'id del docente avuto per argomento:
CREATE OR REPLACE FUNCTION unitua.get_laurea (
    id_doc integer
)
RETURNS SETOF unitua.vista_laurea AS $$
DECLARE
    record_out unitua.vista_laurea%ROWTYPE;
BEGIN 
    FOR record_out IN
        SELECT *
        FROM unitua.vista_laurea AS vl 
        WHERE vl.relatore = id_doc
    LOOP
        RETURN NEXT record_out;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_laurea(100);
*/

--Funzione che dato l'id di un docente e la matricola di uno studente per argomenti, restituisce tutti i record che ha inserito nella tabella valutazione:
CREATE OR REPLACE FUNCTION unitua.get_all_valutazioni (
    id_doc integer,
    matricola_in text 
)
RETURNS SETOF unitua.valutazione AS $$
DECLARE 
    record_out unitua.valutazione%ROWTYPE;
BEGIN
    FOR record_out IN
        SELECT *
        FROM unitua.valutazione AS v 
        WHERE v.docente = id_doc AND v.studente = matricola_in
    LOOP
        RETURN NEXT record_out;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_all_valutazioni(100, '05460A');
*/

--Procedura 1 (bocciati) che aggiorna la tabella valutazione dati il codice dell'appello, il codice dell'esame, del docente e la matricola dello studente:
CREATE OR REPLACE PROCEDURE unitua.update_valutazione1 (
    cod_valutazione integer,
    cod_appello integer,
    cod_esame integer, 
    id_doc integer,
    matricola text
)
AS $$
BEGIN
    UPDATE unitua.valutazione AS v
    SET voto = null,
        lode = false,
        respinto = true
    WHERE v.codice = cod_valutazione AND v.studente = matricola 
    AND v.calendario = cod_appello AND v.docente = id_doc AND v.esame = cod_esame;
END;
$$ LANGUAGE plpgsql;

/*
--Chiamata di verifica:
CALL unitua.update_valutazione1(1101, 500, 100, '05460A', 25, false);
*/

--Procedura 2 (promossi) che aggiorna la tabella valutazione dati il codice dell'appello, il codice dell'esame, del docente e la matricola dello studente:
CREATE OR REPLACE PROCEDURE unitua.update_valutazione2 (
	cod_valutazione integer,
    cod_appello integer,
    cod_esame integer, 
    id_doc integer,
    matricola text,
    voto_in integer,
    lode_in boolean
)
AS $$
BEGIN
    UPDATE unitua.valutazione AS v
    SET calendario = cod_appello,
		voto = voto_in,
        lode = lode_in,
		respinto = false
    WHERE v.codice = cod_valutazione AND v.studente = matricola
	AND v.docente = id_doc AND v.esame = cod_esame;
END;
$$ LANGUAGE plpgsql;

/*
--Chiamata di verifica:
SELECT * FROM unitua.valutazione;
SELECT * FROM unitua.calendario;
CALL unitua.update_valutazione2(1500, 1106, 500, 100, '05460A', 27, false);
*/

SELECT * FROM unitua.valutazione;

--Funzione che restituisce tutte le informazioni riguardanti un membro della segreteria:
CREATE OR REPLACE FUNCTION unitua.get_all_seg (
    email_in text
)
RETURNS SETOF unitua.segreteria AS $$
DECLARE
    record_out unitua.segreteria%ROWTYPE;
BEGIN
    SELECT *
    INTO record_out
    FROM unitua.segreteria AS s 
    WHERE s.utente_email = email_in;

    RETURN NEXT record_out;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_all_seg('luigi.pepe@segreteria.unitua.it');
*/

--Funzione che aggiorna i record della tabella studente:
CREATE OR REPLACE PROCEDURE unitua.update_stud (
    matricola_in text,
    nome_in text,
    cognome_in text,
    sesso_in unitua.sex,
    codFiscale_in text,
    numTelefono_in text,
    cdl_in integer
)
AS $$
BEGIN
    UPDATE unitua.studente AS s 
    SET nome = nome_in,
        cognome = cognome_in,
        sesso = sesso_in,
        codFiscale = codFiscale_in,
        cellulare = numTelefono_in,
        CdL = cdl_in
    WHERE s.matricola = matricola_in;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
CALL unitua.update_stud('05460A', 'Andrea', 'Galliano', 'GLLNDR02L26H860U', '3248662723', 1);
SELECT * FROM unitua.studente;
CALL unitua.update_stud('05460A', 'Andrea', 'Galliano', 'GLLNDR02L26H860U', '3248662724', 1);
SELECT * FROM unitua.studente;
*/

--Funzione che aggiorna i record della tabella docenti:
CREATE OR REPLACE PROCEDURE unitua.update_doc (
    id_in integer,
    nome_in text,
    cognome_in text,
    sesso_in unitua.sex,
    codFiscale_in text,
    numTelefono_in text,
    carica_in unitua.carica_accademica,
    cdl_in integer
)
AS $$
BEGIN
    UPDATE unitua.docente AS d 
    SET nome = nome_in,
        cognome = cognome_in,
        sesso = sesso_in,
        codFiscale = codFiscale_in,
        cellulare = numTelefono_in,
        carica = carica_in,
        CdL = cdl_in
    WHERE d.id = id_in;
END;
$$ LANGUAGE plpgsql;

--Funzione che restituisce 1 o 0 se l'id per argomento corrisponde a quello di un docente:
CREATE OR REPLACE FUNCTION unitua.is_doc(
    id_in integer
)
RETURNS INTEGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.docente AS d
        WHERE d.id = id_in
    ) THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END;      
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.is_doc(100);
SELECT * FROM unitua.is_doc(110);
*/

--Funzione che restituisce 1 o 0 se la matricola per argomento corrisponde a quella di uno studente:
CREATE OR REPLACE FUNCTION unitua.is_stud(
    matricola_in text
)
RETURNS INTEGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.studente AS s
        WHERE s.matricola = matricola_in
    ) THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END;      
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.is_stud('05460A');
SELECT * FROM unitua.is_stud('192822');
*/

--Procedura che aggiorna i dati di un corso di laurea:
CREATE OR REPLACE PROCEDURE unitua.update_cdl(
    codice_in integer,
    tipologia_in unitua.tipo_laurea,
    descrizione_in text
)
AS $$
BEGIN
    UPDATE unitua.corso_di_laurea AS cdl 
    SET tipologia = tipologia_in,
        descrizione = descrizione_in
    WHERE cdl.codice = codice_in;
END;
$$ LANGUAGE plpgsql;

/*
--Chiamata di verifica:
CALL unitua.update_cdl(15, 'Magistrale', 'Sociologia');
SELECT *
FROM unitua.corso_di_laurea AS cdl
WHERE cdl.codice = 15;
*/

--Funzione che restituisce tutti i dati di un corso di laurea a partire dal codice avuto per argomento:
CREATE OR REPLACE FUNCTION unitua.get_all_cdl (
    codice_in integer
)
RETURNS SETOF unitua.corso_di_laurea AS $$
DECLARE 
    record_out unitua.corso_di_laurea%ROWTYPE;
BEGIN 
    SELECT *
    INTO record_out
    FROM unitua.corso_di_laurea AS cdl 
    WHERE cdl.codice = codice_in;

    RETURN NEXT record_out;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_all_cdl(1);
*/

--Funzione che dato un ID per argomento restituisce 0 o 1 se appartiene al reparto segreteria:
CREATE OR REPLACE FUNCTION unitua.is_seg (
    id_in integer
)
RETURNS INTEGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.segreteria AS s 
        WHERE s.id = id_in
    ) THEN 
        RETURN 1;
    ELSE 
        RETURN 0;
    END IF;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.is_seg(200);
SELECT * FROM unitua.is_seg(210);
*/

--Procedura che aggiorna i dati di un membro della segreteria:
CREATE OR REPLACE PROCEDURE unitua.update_seg(
    id_in integer,
    nome_in text,
    cognome_in text,
    codFiscale_in text,
    sesso_in unitua.sex,
    cellulare_in text,
    ruolo_in unitua.ruolo_segreteria
)
AS $$
BEGIN 
    UPDATE unitua.segreteria AS s 
    SET nome = nome_in,
        cognome = cognome_in,
        codFiscale = codFiscale_in,
        sesso = sesso_in,
        cellulare = cellulare_in,
        ruolo = ruolo_in

    WHERE s.id = id_in;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
CALL unitua.update_seg(200, 'Luigi', 'Pepe', 'JYQV24A9R6V7JXJJ', 'M', '5809946869', 'Primo livello');
SELECT * FROM unitua.segreteria;
*/

--Funzione che dati il nome dell'insegnamento ed il docente responsabile ne restituisce il codice:
CREATE OR REPLACE FUNCTION unitua.get_ins_code (
    nome_in text,
    doc_in integer
)
RETURNS INTEGER AS $$
DECLARE
    cod_out INTEGER;
BEGIN
    SELECT i.codice 
    INTO cod_out 
    FROM unitua.insegnamento AS i 
    WHERE i.nome_insegnamento = nome_in AND i.docente = doc_in;

    RETURN cod_out;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_ins_code('Programmazione 1', 100);
*/

--Funzione che dato il codice di un esame e una matricola di uno studente stabilisce se lo studente ha già effettuato l'esame in passato:
CREATE OR REPLACE FUNCTION unitua.esame_fatto (
    matricola_in text,
    esame_in integer 
)
RETURNS INTEGER AS $$
BEGIN 
    IF EXISTS (
        SELECT 1 
        FROM unitua.valutazione AS v 
        WHERE v.studente = matricola_in AND v.esame = esame_in
    ) THEN 
        RETURN 1;
    ELSE
        RETURN 0;

    END IF;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.esame_fatto('05460A', 500);
*/

--Funzione che data una matricola e un codice esame restituisce il codice della valutazione già avvenuta:
CREATE OR REPLACE FUNCTION unitua.get_codice_val (
    matricola_in text,
    esame_in integer
)
RETURNS INTEGER AS $$
DECLARE 
    codice_out integer;
BEGIN
    SELECT v.codice
    INTO codice_out
    FROM unitua.valutazione AS v 
    WHERE v.studente = matricola_in AND v.esame = esame_in;
	
	RETURN codice_out;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_codice_val('05460A', 500);
*/

--Funzione che restituisce 0 o 1 in base all'appartenenza o meno del codice avuto per argomento all'interno della tabella corso di laurea:
CREATE OR REPLACE FUNCTION unitua.is_cdl (
    codice_in integer
)
RETURNS INTEGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.corso_di_laurea AS cdl
        WHERE cdl.codice = codice_in
    ) THEN
        RETURN 1;
    ELSE 
        RETURN 0;
    
    END IF;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.is_cdl(1);
SELECT * FROM unitua.is_cdl(25);
*/

--Funzione che restituisce tutti gli insegnamenti di un cdl avuto per argomento:
CREATE OR REPLACE FUNCTION unitua.get_all_insegnamenti (
    cdl_in integer
)
RETURNS SETOF unitua.insegnamento AS $$
DECLARE
    record_out unitua.insegnamento%ROWTYPE;
BEGIN
    FOR record_out IN
        SELECT *
        FROM unitua.insegnamento AS i 
        WHERE i.cdl = cdl_in
    LOOP
        RETURN NEXT record_out;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;


--Query di verifica:
SELECT * FROM unitua.get_all_insegnamenti(1);


--Vista insegnamenti-esami:
CREATE OR REPLACE VIEW unitua.esami_insegnamenti AS 
    SELECT i.codice AS codice_insegnamento, i.nome_insegnamento, i.anno_insegnamento,
	i.docente, i.cdl, e.codice AS codice_esame, e.tipologia, e.modalita
    FROM unitua.insegnamento AS i 
    JOIN unitua.esame AS e 
    ON i.codice = e.insegnamento;


--Query di verifica:
SELECT * FROM unitua.esami_insegnamenti;


--Funzione che dato per argomento il codice di un CdL restituisce gli elementi corrispondenti della vista esami_insegnamenti:
CREATE OR REPLACE FUNCTION unitua.get_all_es_ins (
    cdl_in integer
)
RETURNS SETOF unitua.esami_insegnamenti AS $$
DECLARE
    record_out unitua.esami_insegnamenti%ROWTYPE;
BEGIN 
    FOR record_out IN
        SELECT *
        FROM unitua.esami_insegnamenti AS ei 
        WHERE ei.cdl = cdl_in
    LOOP
        RETURN NEXT record_out;
    END LOOP;

    RETURN;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_all_es_ins(1);
*/

--Procedura che aggiorna gli elementi della tabella insegnamento:
CREATE OR REPLACE PROCEDURE unitua.update_ins (
    codice_in integer,
    nome_in text,
    anno_in unitua.anno,
    descrizione_in text
)
AS $$
BEGIN
    UPDATE unitua.insegnamento AS i 
    SET nome_insegnamento = nome_in,
        anno_insegnamento = anno_in,
        descrizione = descrizione_in
    WHERE i.codice = codice_in;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
CALL unitua.update_ins(300, 'Programmazione 1', '1', 'Esame di Programmazione 1 del primo anno di informatica (triennale)');
SELECT * FROM unitua.insegnamento;
*/

--Procedura che aggiorna gli elementi della tabella esame:
CREATE OR REPLACE PROCEDURE unitua.update_es (
    codice_in integer,
    tipologia_in unitua.tipo_esame,
    modalita_in unitua.modalita_verifica
)
AS $$
BEGIN
    UPDATE unitua.esame AS e
    SET tipologia = tipologia_in,
        modalita = modalita_in
    WHERE e.codice = codice_in;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
CALL unitua.update_es(501, 'Distanza', 'Scritto + Orale');
SELECT * FROM unitua.esame;
*/

--Vista ex studente e laurea:
CREATE OR REPLACE VIEW unitua.ex_stud_laureato AS 
    SELECT ex.*, l.codice, l.voto, l.bonus, l.relatore
    FROM unitua.ex_studente AS ex
    JOIN unitua.laurea AS l 
    ON ex.matricola = l.studente;


--Query di verifica:
CALL unitua.insert_utente('francesco.colombo@studenti.unitua.it', 'Pass');
CALL unitua.insert_studente('08899A', 'Francesco', 'Colombo', 'PALSKE3456OP00P0', 'M', '1232323455', '2021-09-23', 'In corso', 'francesco.colombo@studenti.unitua.it', 1);
--DELETE FROM unitua.studente AS s WHERE s.matricola = '08899A';
--SELECT * FROM unitua.ex_studente;
--SELECT * FROM unitua.ex_stud_laureato;


--Funzione che data la matricola di un'ex studente restituisce 0 o 1 in base al conseguimento o meno della laurea:
CREATE OR REPLACE FUNCTION unitua.is_laureato (
    matricola_in text
)
RETURNS INTEGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.laurea AS l 
        WHERE l.studente = matricola_in
    )
    THEN
        RETURN 1;
    ELSE 
        RETURN 0;
    
    END IF;
END;
$$ LANGUAGE plpgsql;


--Query di verifica:
SELECT * FROM unitua.is_laureato('98007A');
SELECT * FROM unitua.is_laureato('08899A');


--Funzione che restituisce 0 o 1 se uno studente è nella tabella ex studente:
CREATE OR REPLACE FUNCTION unitua.is_ex_stud(
    email_in text
)
RETURNS INTEGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.ex_studente AS s
        WHERE s.utente_email = email_in
    ) THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END;      
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.is_ex_stud('aldo.baglio@studenti.unitua.it');
*/

--Funzione che restituisce la matricola di un ex studente data la mail per argomento:
CREATE OR REPLACE FUNCTION unitua.get_ex_matricola (
    email_in text
)
RETURNS VARCHAR AS $$
DECLARE
    matricola_out text;
BEGIN
    SELECT s.matricola
    INTO matricola_out
    FROM unitua.ex_studente AS s
    WHERE s.utente_email = email_in;

    RETURN matricola_out;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.get_ex_matricola('aldo.baglio@studenti.unitua.it');
*/

--Funzione che ritorna 0 o 1 se la matricola e la mail avute per argomento coincidono con lo stesso studente oppure no:
CREATE OR REPLACE FUNCTION unitua.verifica_mat (
    matricola_in text,
    email_in text
)
RETURNS INTEGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM unitua.studente AS s 
        WHERE s.utente_email = email_in AND s.matricola = matricola_in
    )
    THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END;
$$ LANGUAGE plpgsql;

/*
--Query di verifica:
SELECT * FROM unitua.verifica_mat('05460A', 'andrea.galliano@studenti.unitua.it');
SELECT * FROM unitua.verifica_mat('05460A', 'luca.corradini@studenti.unitua.it');
*/