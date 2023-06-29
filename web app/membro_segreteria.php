<h4 id="titolino">Creazione di un nuovo profilo membro della segreteria:</h4>
    <form method="POST" action="new_profilo.php" id="form_add">
        <div class="form-group" id="divform">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" aria-describedby="nome" name="nome" placeholder="Inserisci nome" required>
        </div>
        <div class="form-group" id="divform">
            <label for="cognome">Cognome:</label>
            <input type="text" class="form-control" id="cognome" aria-describedby="cognome" name="cognome" placeholder="Inserisci cognome" required>
        </div>
        <div class="form-group" id="divform">
            <label for="old_pw">Password:</label>
            <input type="text" class="form-control" id="old_pw" name="old_pw" placeholder="Inserisci password" required>
        </div>
        <div class="form-group" id="divform">
            <label for="codFiscale">Codice fiscale:</label>
            <input type="text" class="form-control" id="codFiscale" aria-describedby="codFiscale" name="codFiscale" size="16" placeholder="Inserisci codice fiscale" required>
        </div>
        <div class="form-group" id="divform">
            <select class="form-control" id="sesso" name="sesso" required>
                <option value="M">Maschio</option>
                <option value="F">Femmina</option>
                <option value="Non specificato">Non specificato</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <label for="cellulare">Numero di telefono:</label>
            <input type="number" class="form-control" id="cellulare" aria-describedby="callulare" name="cellulare" size="10" placeholder="Inserisci numero di telefono" required>
        </div>
        <div class="form-group" id="divform">
            <select class="form-control" id="ruolo" name="ruolo" required>
                <option value="Primo livello">Primo livello</option>
                <option value="Secondo livello">Secondo livello</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <button type="submit" class="btn btn-primary" id="crea">Crea</button>   
        </div>
    </form>