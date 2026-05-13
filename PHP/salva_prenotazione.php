<?php
$host = "localhost";
$user = "root";
$password = "root";
$database = "studio_legale";

$connessione = new mysqli($host, $user, $password, $database);

if ($connessione->connect_error) {
    header("Location: ../PAGINE/Consulenza.php?errore=connessione");
    exit;
}

$nome = $_POST["nome"] ?? "";
$cognome = "";
$telefono = $_POST["telefono"] ?? "";
$email = $_POST["email"] ?? "";
$area = $_POST["area"] ?? "";
$data = $_POST["data"] ?? "";
$ora = $_POST["ora"] ?? "";
$messaggio = $_POST["messaggio"] ?? "";

$data_ora = $data . " " . $ora . ":00";

$sql = "INSERT INTO prenotazioni 
(nome, cognome, telefono, email, area, data_ora, orario, messaggio, data_invio)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $connessione->prepare($sql);

$stmt->bind_param(
    "ssssssss",
    $nome,
    $cognome,
    $telefono,
    $email,
    $area,
    $data_ora,
    $ora,
    $messaggio
);

if ($stmt->execute()) {
    header("Location: ../PAGINE/Consulenza.php?successo=1");
    exit;
} else {
    header("Location: ../PAGINE/Consulenza.php?errore=salvataggio");
    exit;
}

$stmt->close();
$connessione->close();
?>