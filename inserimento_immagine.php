<?php
session_start();
// Connessione al database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "progettogpo";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_SESSION['mail_user'])) {
    $mail=$_SESSION['mail_user'];
}
else{
    header("location: accesso/index.php");
}
    $immagine = file_get_contents($_FILES["immagine"]["tmp_name"]);
    $immagine = addslashes($immagine);
// Inserimento dell'immagine nel database
$query = "UPDATE account SET immagine = '" . $immagine . "' WHERE email = '" . $mail . "'";

if ($conn->query($query) === TRUE) {
    header("location: account.php");
} else {
    echo "Errore nell'inserimento dell'immagine: " . $conn->error;
}

$conn->close();

?>