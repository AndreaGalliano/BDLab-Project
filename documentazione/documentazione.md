# DOCUMENTAZIONE PROGETTUALE BASI DI DATI - Andrea Galliano 05460A

## INDICE

- [Introduzione](#introduzione)
- [Analisi dei requisiti](#studio-della-realtà-dinteresse-e-analisi-dei-requisiti)
- [Progettazione concettuale](#progettazione-concettuale)
- [Progettazione logica](#progettazione-logica)
- [Normalizzazione](#normalizzazione)
- [Vincoli intrarelazionali](#vincoli-intrarelazionali)


## INTRODUZIONE:
Il progettot d'esame prevede la realizzazione di una piattaforma di gestione di insegnamenti ed esami universitari, con relativo controllo di tutte le entità e funzionalità che la piattaforma stessa deve avere per funzionare in maniera corretta.  
La proposta di soluzione è atta a rappresentare fedelmente e in maniera completa la realtà d'interesse, scongiurando possibilità di dati incosistenti, duplicati e/o  ambiguità. Ogni scelta implementativa è opportunamente motivata per far funzionare tutti i punti che compongono il progetto (database relazionale con funzioni e trigger e applicativo web che si interfaccia con il DB per la visualizzazione dei dati).

## Studio della realtà d'interesse e analisi dei requisiti:
Il primo passo per realizzare al meglio la base di dati è studiare approfonditamente la realtà d'interesse e analizzare i requisiti in modo tale da avere un'idea solida su come realizzare uno schema concettuale completo.  
Partendo con ordine, la prima cosa che salta all'occhio è la necessità di realizzazione delle utenze che compongono il database, proprio per questo motivo sono necessarie le seguenti 4 entità:  
1. **UTENTE** : si tratta di un qualsiasi individuo, facente parte del DB, che è in grado di interfacciarsi con le relative funzionalità mediante un opportuno sistema di autenticazione (nel nostro caso si è optato per una *classica* autenticazione realizzata tramite email e password).  
Ciò che ci permette di identificare univocamente ogni utente è proprio la mail.  
Salta subito all'occhio che non tutti gli utenti sono uguali ed è essenziale *scomporli* grazie alle 3 entità elencate sotto;  
2. **SEGRETERIA** : è l'entità che rappresenta un qualsiasi membro della segreteria dell'università, che deve poter essere opportunamente identificato e svolgere le attività classiche per un qualsiasi membro di una segreteria della realtà d'interesse (vedremo più avanti che proprio il profilo del segreterio/a gode di particolari libertà all'interno dell'applicativo web, soprattutto se comparato agli altri utenti del sistema).  
Ogni membro della segreteria dovrà presentare quindi un codice identificativo (ID), il proprio nome, cognome, codice fiscale, il sesso, il numero di telefono e il suo ruolo (che può dividersi in *primo livello* e *secondo livello*).
3. **DOCENTE** : si tratta dei prof. che gestiscono tutto ciò che concerne gli insegnamenti, gli esami, i calendari ecc...  
Un docente è composto dal suo ID, dal nome, cognome, dal codice fiscale, dal sesso, il numero di telefono e dalla sua carica accademica (che si divide in *ordinario*, *associato* e *ricercatore*).  
Intuitivamente si capisce subito che la chiave primaria che comporrà questa entità dovrà essere chiave esterna per tutte le altre relative alla gestione delle funzionalità del docente stesso.
4. **STUDENTE** : sono gli studenti iscritti ai vari corsi di laurea dell'ateneo e sono identificati univocamente tramite il loro numero di matricola. Possono iscriversi agli esami, prendere valutazione e conseguire la laurea.  
Oltre alla matricola, uno studente presenta il proprio nome e cognome, il codice fiscale, il sesso, il numero di telefono, la data di immatricolazione e lo stato (che può essere *in corso* o *fuoricorso*).
5. **EX STUDENTE** : sono gli studenti che hanno terminato il loro percorso di studi; all'interno di questa entità sono compresi sia gli studenti che hanno terminato gli studi tramite conseguimento della laurea, sia quelli che hanno effettuato la rinuncia. Devono comunque poter avere un vero e proprio archivio dati sul loro percorso universitario passato e si interfacciano con la base di dati tramite login e password, esattamente come gli altri utenti.  
I suoi attributi sono esattamente gli stessi dello studente attualmente iscritto, con la differenza che *fanno tutti parte del passato*.

Una volta assimilate le utenze da realizzare, è il momento di analizzare le restanti entità che compongono la base di dati: dapprima risulta necessaria la gestione dei vari corsi di laurea, dei relativi insegnamenti ed esami e, conseguentemente, anche del relativo calendario degli appelli d'esame.  
Successivamente ci si occuperà delle valutazioni che un docente dà (e che, parallelamente, uno studente riceve) e del conseguimento della laurea da parte degli studenti.  
Infine è bene comporre correttamente un __archivio__ che faccia in modo *conservare* le valutazioni passate degli ex studenti.  
Dunque, seguendo proprio l'ordine dell'analisi appena fatta abbiamo:  
1. **CORSO DI LAUREA** : un corso di laurea è identificato da un proprio codice, dalla tipologia (*triennale*, *magistrale* o a *ciclo unico*) e la descrizione (ovvero il nome).
2. **INSEGNAMENTO** : si tratta del corso di cui un docente è responsabile effettuando le lezioni durante il semestre. Ogni insegnamento è caratterizzato da un proprio codice identificativo, dal nome, l'anno accademico in cui è previsto (da 1 a 3 per i corsi di laurea triennali, da 1 a 2 per i corsi di laurea magistrali e da 1 a 5 per i corsi di laurea a ciclo unico) e una breve descrizione.  
Va fatta particolare attenzione soprattutto alla gestione della propedeuticità degli insegnamenti, che all'interno dello schema concettuale e non solo svolge un ruolo molto importante.
3. **ESAME** : un esame è l'entità che rappresenta la verifica che un docente effettua per capire che gli studenti abbiano appreso le nozioni del corso svolto durante un semestre.
Presenta 3 caratteristiche fondamentali: un codice identificativo, la tipologia (*a distanza* oppure *in presenza*) e la modalità (*scritto*, *orale* o *scritto + orale*).
4. **CALENDARIO** : l'entità calendario non è altro che la rappresentazione degli appelli d'esame che compongono un particolare corso di laurea. Ogni calendario/appello è formato da un codice, da un attributo che segnali se si tratta di un appello aperto oppure chiuso, dalla data dell'esame, dall'ora, dall'aula e dall'anno accademico.
5. **ISCRITTO** : l'entità iscritto non è altro che una tabella che tiene traccia di tutti gli studenti che si iscrivono ad un certo appello e ha come attributi le chiavi primarie delle entità **docente**, **studente**, **esame** e **calendario**. Sarà di fondamentale importanza per le interrogazioni al database (soprattutto grazie alla clausola **JOIN**).
6. **VALUTAZIONE** : questa entità non fa altro che tenere traccia di tutti i voti assegnati da parte dei docenti agli studenti che si sono iscritti ad un certo appello e hanno quindi sostenuto l'esame.  
Per ogni valutazione abbiamo un codice che la identifichi, il voto che ha conseguito lo studente, l'eventuale lode, un attributo che faccia capire se è stato respinot e la data di verbalizzazione.
7. **LAUREA** : nel momento in cui un qualsiasi studente termina il proprio percorso di studi e consegue la laurea, è opportuno che vi sia un'entità che tenga traccia di tutti i dati che riguardano la laurea stessa dell'ormai ex studente dell'università.  
La laurea, esattamente come le altre entità che compongono il DB, viene univocamente identificata tramite un codice, ha un voto, la lode, eventuali punti di bonus acquisiti in sede di laurea e la data.
8. **STORICO VALUTAZIONE** : un qualsiasi ex studente deve poter avere sempre a propria disposizione, oltre ai dati riguardanti la laurea nel caso in cui fosse arrivato a termine del percorso di studi, **tutta** la propria carriera. Chiaramente questo è possibile perché, anche dopo la rinuncia agli studi o al raggiungimento del titolo di studio, l'ex studente rimane comunque all'interno del sistema e la sua mail e password sono attive e valide.  

## PROGETTAZIONE CONCETTUALE:  
Alla luce di ciò che abbiamo ipotizzato nel corso dell'analisi dei requisiti, è possibile comporre una prima versione di uno **schema entità-relazione** che tenga conto di tutte le proprietà delle entità e di come esse sono collegate fra di loro mediante relazioni.
Oltre a questo, è opportuno comporre lo schema E.R. indicando anche le cardinalità che presentano le relazioni.  

![Schema E.R.](ER_progetto_esame.png)  
  
Come è possibile evincere dallo schema sopra riportato, vi è una gerarchia padre-figli riguardante gli utenti che compongono la base di dati e quelli che sono effettivamente i fruitori del sistema: i membri della segreteria, i docenti, gli studenti e gli ex studenti.  
Come ci suggeriscono le regole di composizione di un qualsiasi DB, le generalizzazioni sono una semplificazione necessaria in fase di progettazione concettuale, che però non trovano realizzazione effettiva dalla fase di progettazione logica in poi. Diventa dunque necessaria una ristrutturazione di questo schema Entity Relationship, facendo in modo tale che l'entità padre sia **collegata alle figlie tramite una relazione** con carinalità 1:1.  

__Ecco lo schema concettuale aggiornato:__

![Schema E.R. ristrutturato](ER_ristrutturato.png)  
<br>
Un appunto necessario riguardante questo schema *Entity Relationhip* riguarda l'associazione ricorsiva **PROPEDEUTICITA'**, che risulta di fondamentale gestione per quanto concerne lo schema logico (sarà di fatto un'ulteriore relazione), per la realizzazione vera e propria del DB e per tutte le funzionalità dell'applicativo web, in particolare per quanto riguarda ciò che potrà fare/non fare lo studente.

## PROGETTAZIONE LOGICA:
Una volta conclusa la fase di progettazione concettuale, è tempo di concentrarsi sulla progettazione logica, andando a creare le relazioni e andando ad applicare, ove necessaario, le opportune regole di normalizzazione.  
Coerentemente con le regole di composizione dello schema logico, andranno sottolineate eventuali chiavi primarie e/o esterne.  
<br>
*Lo schema logico si presenta al momento così:*  
- **Corsi di laurea** (<u>Codice</u>, tipologia, descrizione)
- **Utenti** (<u>E-mail</u>, password)  
- **Studenti** (<u>Matricola</u>, nome, cognome, codice fiscale, sesso, cellulare, data immatricolazione, stato, *utente email*)  
- **Docenti** (<u>ID docente</u>, nome, cognome, codice fiscale, sesso, cellulare, carica accademica, *utente email*)  
- **Segreteria** (<u>ID</u>, nome, cognome, codice fiscale, sesso, cellulare, ruolo, *utente email*)  
- **Ex Studenti** (<u>Matricola</u>, nome, cognome, codice fiscale, sesso, cellulare, stato, *utente email*)  
- **Lauree** (<u>Codice</u>, ex studente, *relatore*, voto, data laurea, lode, punti bonus) 
- **Insegnamenti** (<u>Codice</u>, nome, anno esame, descrizione, *docente*, *corso di laurea*)   
- **Propedeuticità** (<u>*Esame propedeutico*</u>, <u>*esame con propedeuticità*</u>)
- **Esami** (<u>Codice</u>, *insegnamento*, tipologia, modalità)  
- **Calendari** (<u>Codice appello</u>, *esame*, *docente*, data esame, ora, aula, aperto, anno accademico)  
- **Iscritti** (<u>*docente*</u>, <u>*studente*</u>, <u>*esame*</u>, <u>*calendario*</u>)  
- **Valutazioni** (<u>Codice valutazione</u>, *studente*, *calendario*, *esame*, *docente*, voto, lode, respinto, data di verbalizzazione)  
- **Storico Valutazioni** (<u>Codice valutazione</u>, *studente*, *calendario*, *esame*, *docente*, voto, lode, respinto, data di verbalizzazione)  

### NORMALIZZAZIONE:
Lo schema logico non presenta relazioni ed attributi che risultano predisposti all'inconsistenza dei dati e ad evenutali violazioni delle 4 regole di normalizzazione.  
In particolare, va posto l'accento sull'attributo *__voto__* della relazione __*valutazioni*__ e __*storico valutazioni*__, che dopo un'analisi iniziale potrebbe potrebbe pensare possa assumere, oltre alla classica forma del voto in trentesimi compreso fra 18 e 30, anche quella testuale di "*respinto*"; questo non risulta però corretto nel momento in cui si va ad applicare la **prima regola di normalizzazione**, che esprime il concetto di __*atomicità*__ degli attributi. Esattamente per questo motivo, è ragionevole avvalersi sia di un attributo *__voto__* numerico (che non presenti clausole di nullità, ma che sia compreso all'interno del dominio fra 18 e 30), sia di un attributo *__respinto__* boolean, che certifichi se il superamento o il mancato superamento di un certo esame da parte dello studente. Per le funzionalità necessarie al completo funzionamento del progetto, inoltre, l'attributo *__respinto__*, al contrario di *__voto__*, non deve essere nullo ([qui tutti i vincoli](#vincoli-intrarelazionali)).

## VINCOLI INTRARELAZIONALI:
|RELAZIONE   |ATTRIBUTO   |TIPO|VINCOLO   |DOMINIO|
|---------   |--------|--------|---------|----|
|**UTENTE**  |**email**|varchar|PRIMARY KEY|
|            |pw|varchar|NOT NULL|
|**SEGRETERIA**|**ID**|serial|PRIMARY KEY|
|            |Nome|varchar|NOT NULL|
|            |Cognome|varchar|NOT NULL|
|            |CodFiscale|varchar|NOT NULL, UNIQUE, MAX_LENGTH = 16|
|            |Sesso|ENUM|NOT NULL|Sesso = {'M', 'F', 'Non specificato'} |
|            |Cellulare|varchar|NOT NULL, UNIQUE, MAX_LENGTH = 10|
|            |Ruolo|ENUM|NOT NULL|Ruolo = {'Primo livello', 'Secondo livello'}|
|            |Utente email|varchar|FOREIGN KEY|
|**DOCENTE** |**ID**|serial|PRIMARY KEY|
|            |Nome|varchar|NOT NULL|
|            |Cognome|varchar|NOT NULL|
|            |CodFiscale|varchar|NOT NULL, UNIQUE, MAX_LENGTH = 16|
|            |Sesso|ENUM|NOT NULL|Sesso = {'M', 'F', 'Non specificato'} |
|            |Cellulare|varchar|NOT NULL, UNIQUE, MAX_LENGTH = 10|
|            |Carica accademica|ENUM|NOT NULL|Carica accademica = {'Ordinario', 'Associato', 'Ricercatore'}|
|            |Utente email|varchar|FOREIGN KEY|
|**STUDENTE**|**Matricola**|varchar|PK - NOT NULL|
|            |Nome|varchar|NOT NULL|
|            |Cognome|varchar|NOT NULL|
|            |CodFiscale|varchar|NOT NULL, UNIQUE, MAX_LENGTH = 16|
|            |Sesso|ENUM|NOT NULL|Sesso = {'M', 'F', 'Non specificato'} |
|            |Cellulare|varchar|NOT NULL, UNIQUE, MAX_LENGTH = 10|
|            |Data immatricolazione|date|NOT NULL|
|            |Stato|ENUM|NOT NULL|Stato = {'In corso', 'Fuoricorso'}|
|            |Utente email|varchar|FOREIGN KEY|
|**EX STUDENTE**|**Matricola**|varchar|PK - NOT NULL|
|               |Nome|varchar|NOT NULL|
|               |Cognome|varchar|NOT NULL|
|               |CodFiscale|varchar|NOT NULL, UNIQUE, MAX_LENGTH = 16|
|               |Sesso|ENUM|NOT NULL|Sesso = {'M', 'F', 'Non specificato'} |
|               |Cellulare|varchar|NOT NULL, UNIQUE, MAX_LENGTH = 10|
|               |Stato|ENUM|NOT NULL|Stato = {'In corso', 'Fuoricorso'}|
|               |Utente email|varchar|FOREIGN KEY|