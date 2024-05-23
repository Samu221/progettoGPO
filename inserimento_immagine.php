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

if (isset($_SESSION['username'])) {
    $user=$_SESSION['username'];
}
else{
    header("location: accesso/index.php");
}
$sql="  SELECT email
            FROM account
            WHERE username='$user'"; 

    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $mail=$row["email"];
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