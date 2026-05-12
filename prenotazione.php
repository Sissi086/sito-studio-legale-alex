<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "studio_legale";

$connessione = new mysqli($host, $user, $password, $database);

if ($connessione->connect_error) {
    die("Errore connessione database: " . $connessione->connect_error);
}

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$telefono = $_POST["telefono"];
$data_ora = $_POST["data_ora"];
$orario = $_POST["orario"];
$messaggio = $_POST["messaggio"];

$sql = "INSERT INTO prenotazioni 
(nome, cognome, telefono, data_ora, orario, messaggio)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $connessione->prepare($sql);

$stmt->bind_param(
    "ssssss",
    $nome,
    $cognome,
    $telefono,
    $data_ora,
    $orario,
    $messaggio
);

if ($stmt->execute()) {

    echo "
    <h1>Prenotazione inviata correttamente!</h1>
    <a href='index.html'>Torna alla Home</a>
    ";

} else {

    echo "Errore durante il salvataggio.";

}

$stmt->close();
$connessione->close();

?>