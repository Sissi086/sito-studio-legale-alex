<?php
$host = "localhost";
$user = "root";
$password = "root";
$database = "studio_legale";

$connessione = new mysqli($host, $user, $password, $database);

$prenotazioni = [];

if (!$connessione->connect_error) {
    $sql = "SELECT * FROM prenotazioni ORDER BY data_ora ASC";
    $risultato = $connessione->query($sql);

    if ($risultato && $risultato->num_rows > 0) {
        while ($riga = $risultato->fetch_assoc()) {
            $prenotazioni[] = $riga;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione | Studio Legale Draganoiu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+SC:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../CSS/Consulenza.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="nav">
        <div class="logo">
            <img src="../IMMAGINI/studioLegale.png" alt="Logo Studio Legale Draganoiu">
        </div>

        <div class="pagine_navigazione">
            <a href="../index.html">Home</a>
            <a href="ChiSono.html">Chi Sono</a>
            <a href="Servizi.html">Servizi</a>
            <a href="Aree.html">Aree</a>
            <a href="Consulenza.php">Prenotazione</a>
            <a href="Costi.html">Costi</a>
            <a href="Risultati.html">Risultati</a>
            <a href="contatti.html">Contatti</a>
        </div>
    </nav>

    <!-- HERO -->
    <header class="hero-prenotazione">
        <div class="hero-content">
            <span class="sottotitoloHero">Prenotazione consulenza</span>

            <h1>Fissa un appuntamento con lo studio</h1>

            <p>
                Compila il modulo con i tuoi dati e indica giorno e orario preferiti.
                Verrai ricontattato per confermare la disponibilità e definire le modalità della consulenza.
            </p>
        </div>
    </header>

    <main>

        <!-- INTRO -->
        <section class="intro-prenotazione">
            <span class="etichettaSezione">Richiesta appuntamento</span>

            <h2>Raccontaci brevemente la tua esigenza</h2>

            <p>
                Il modulo consente di inviare una richiesta preliminare allo studio. Le informazioni inserite
                permettono di comprendere meglio la situazione e di organizzare un primo confronto in modo
                più preciso e ordinato.
            </p>
        </section>

        <!-- FORM UNICA -->
        <section class="prenotazione">
            <div class="form-card">

                <div class="form-intestazione">
                    <h3>Modulo di prenotazione</h3>
                    <p>
                        Inserisci i tuoi dati, scegli una data indicativa e descrivi brevemente il motivo
                        della richiesta. I campi contrassegnati sono utili per poterti ricontattare correttamente.
                    </p>
                </div>

                <form class="form-prenotazione" action="../PHP/salva_prenotazione.php" method="POST">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nome">Nome e cognome</label>
                            <input type="text" id="nome" name="nome" placeholder="Es. Mario Rossi" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="tel" id="telefono" name="telefono" placeholder="Es. 333 1234567" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Es. nome@email.it" required>
                        </div>

                        <div class="form-group">
                            <label for="area">Area di consulenza</label>
                            <select id="area" name="area">
                                <option value="">Seleziona un’area</option>
                                <option value="diritto-civile">Diritto civile</option>
                                <option value="diritto-lavoro">Diritto del lavoro</option>
                                <option value="diritto-famiglia">Diritto di famiglia</option>
                                <option value="diritto-commerciale">Diritto commerciale</option>
                                <option value="altro">Altro</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="data">Data preferita</label>
                            <input type="date" id="data" name="data" required>
                        </div>

                        <div class="form-group">
                            <label for="ora">Orario preferito</label>
                            <input type="time" id="ora" name="ora" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="messaggio">Messaggio</label>
                        <textarea id="messaggio" name="messaggio"
                            placeholder="Descrivi brevemente la tua esigenza o il motivo della consulenza"></textarea>
                    </div>

                    <button type="submit" class="btn-primary">Invia richiesta di prenotazione</button>

                    <p class="nota-form">
                        L’invio del modulo non conferma automaticamente l’appuntamento. Lo studio provvederà
                        a ricontattarti per confermare data, orario e disponibilità.
                    </p>

                </form>
            </div>
        </section>
<section class="sezione-prenotazioni">

    <div class="intestazione-prenotazioni">
        <span class="etichettaSezione">Agenda appuntamenti</span>
        <h2>Prenotazioni registrate</h2>
        <p>
            In questa sezione vengono mostrate le richieste di consulenza salvate nel database.
            Ogni nuova prenotazione comparirà automaticamente dopo l’invio del modulo.
        </p>
    </div>

    <?php if (isset($_GET["successo"])) { ?>
        <div class="messaggio-esito successo">
            Prenotazione salvata correttamente.
        </div>
    <?php } ?>

    <?php if (isset($_GET["errore"])) { ?>
        <div class="messaggio-esito errore">
            Si è verificato un errore durante il salvataggio della prenotazione.
        </div>
    <?php } ?>

    <?php if (count($prenotazioni) > 0) { ?>

        <div class="prenotazioni-grid">

            <?php foreach ($prenotazioni as $prenotazione) { ?>

                <?php
                $dataFormattata = date("d/m/Y", strtotime($prenotazione["data_ora"]));
                $oraFormattata = date("H:i", strtotime($prenotazione["data_ora"]));
                ?>

                <article class="prenotazione-card">

                    <div class="data-box">
                        <span class="giorno"><?php echo date("d", strtotime($prenotazione["data_ora"])); ?></span>
                        <span class="mese"><?php echo date("m/Y", strtotime($prenotazione["data_ora"])); ?></span>
                    </div>

                    <div class="prenotazione-info">
                        <h3><?php echo htmlspecialchars($prenotazione["nome"]); ?></h3>

                        <p><strong>Data:</strong> <?php echo $dataFormattata; ?></p>
                        <p><strong>Ora:</strong> <?php echo $oraFormattata; ?></p>

                        <?php if (!empty($prenotazione["area"])) { ?>
                            <p><strong>Area:</strong> <?php echo htmlspecialchars($prenotazione["area"]); ?></p>
                        <?php } ?>

                        <p><strong>Telefono:</strong> <?php echo htmlspecialchars($prenotazione["telefono"]); ?></p>

                        <?php if (!empty($prenotazione["email"])) { ?>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($prenotazione["email"]); ?></p>
                        <?php } ?>

                        <?php if (!empty($prenotazione["messaggio"])) { ?>
                            <p class="messaggio-card">
                                <?php echo htmlspecialchars($prenotazione["messaggio"]); ?>
                            </p>
                        <?php } ?>
                    </div>

                </article>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="nessuna-prenotazione">
            <h3>Nessuna prenotazione registrata</h3>
            <p>Quando verrà inviata una richiesta, comparirà qui sotto forma di scheda.</p>
        </div>

    <?php } ?>

</section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footerContenuto">
            <img id="Logo" src="../IMMAGINI/StudioBianco.png" alt="Logo Studio Legale Draganoiu">

            <div class="footerInfo">
                <p>Email: info@studiodraganoiu.it</p>
                <p>Telefono: 123 456 7890</p>
            </div>
        </div>
    </footer>
<script src="../JS/animazioni.js"></script>
</body>

</html>