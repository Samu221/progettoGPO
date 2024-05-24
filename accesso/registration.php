<?php
    session_start();

    $servername = 'localhost';
    $name = 'root';
    $password = '';
    $nomeDB = 'progettogpo';

    $conn = mysqli_connect($servername, $name, $password, $nomeDB);

    if (!$conn) {
        die("Errore nella connessione a MySQL: " . mysqli_connect_error());
    }

    $name = $_POST['user'];
    $pw = $_POST['pass'];
	$mail = $_POST['email'];
    
    $name=filter_var($name, FILTER_SANITIZE_EMAIL);
    $mail=filter_var($mail, FILTER_SANITIZE_EMAIL);

    // Utilizzo di funzione di hashing sicura (bcrypt) per la password
    $pw_hashed = SHA1($pw);

    
    
    $query_check_email = "SELECT email FROM account WHERE email='$mail'";
    $result_check_email = mysqli_query($conn, $query_check_email);

    if (mysqli_num_rows($result_check_email) > 0) {
      $_SESSION['registration_error'] = 'Email già registrata.';
      header('Location: registrazione.php');
      exit();
	}
    else{
	$query_check = "SELECT username FROM account WHERE username='$name'";
    $result_check = mysqli_query($conn, $query_check);
    if (mysqli_num_rows($result_check) > 0) {      
    $_SESSION['registration_error'] = 'Username non disponibili.';
      header('Location: registrazione.php');

    } else {
        $query_insert = "INSERT INTO account (email, username, password) VALUES ('$mail', '$name', '$pw_hashed')";

        if (mysqli_query($conn, $query_insert)) {
            $_SESSION["mail_user"] = $mail;
            header("location: ../home.php");
            exit();
        } else {
            echo "Errore nella registrazione: " . mysqli_error($conn);
        }
    }
    }

    mysqli_close($conn);
?>
