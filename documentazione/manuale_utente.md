# MANUALE UTENTE

Dopo aver scaricato tutte le diractory contenute all'interno della repository, seguire i seguenti passaggi per la parte relativa alla base di dati e all'applicazione web.

## 1) Database:
Per creare un database "unitua" vuoto:
1. Stabilire la connesione con un server **PostgreSQL 15** (versione più aggiornata e attualmente disponibile) in locale o remoto;
2. Da **PgADMIN** aprire il *query tool* ed eseguire il file [unitua](../database/unitua.sql).
3. In alternativa, da **DBeaver** aprire un nuovo *script SQL* ed eseguire il file [unitua](../database/unitua.sql).  

Nel caso in cui si volesse popolare il database con dei record iniziali d'esempio, con annesse procedure, funzioni e trigger, aprire il *query tool* di PGAdmin o DBeaver immettendo il codice di questo [file](../database/unitua_popolazione_tabelle.sql) SQL ed eseguirlo.

## 2) Applicativo Web:
1. Avviare un **Web Server** generico (ad esempio *Xampp*), all'interno della quale è presente la cartella *Web App*;
2. Aggiungere un apposito file *connection.php* all'interno della directory *script* scrivendolo nel seguente modo:
    - Aprire il tag php;
    - Dichiarare una variabile **$connection** che ci indichi se la connessione stabilita è andata a buon fine;
    - Assegnare questa variabile al risultato della funzione *pg_connect()*, che riceve in ingresso l'**host**, il **numero della porta**, il **nome del DB**, lo **user** e la **password** per stabilire la connesione;
    - Chiudere il tag php.
3. Aprire l'applicativo Web dal file [index.php](../web%20app/pagine/index.php).