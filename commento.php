<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    
    $conn = mysqli_connect("localhost", "root", "", "progettogpo");
    
    if (!$conn) {
        die("Errore nella connessione a MySQL: " . mysqli_connect_error());
    }

    if (isset($_GET['codice'])) {
        $idBottega=$_GET["codice"];
        echo $idBottega;
    }
    else{
        echo "errore codice bottega";
        header("location: progetto.php?codice='$idBottega'");
    }
    if (isset($_SESSION['mail_user'])) {
        $mail=$_SESSION['mail_user'];
    }
    else{
		header("location: accesso/index.php");
    }

    if(!isset($_POST["commento"])){
        echo "qualcosa è andato storto <a href='home.php'>torna alla home</a>";
    }
    else{
        $commento=$_POST["commento"];
        $query="    INSERT INTO commento (email, ID_bottega, testo)
                    VALUES ('$mail', $idBottega, '$commento')";
        if (!mysqli_query($conn, $query)) {
            echo "qualcosa è andato storto <a href='home.php'>torna alla home</a>";        
        }
        else{
            header("location: bottega.php?codice=$idBottega");
        }
    }
    exit();
    mysqli_close($conn);

?>
