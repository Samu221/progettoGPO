<?php
    $servername = 'localhost';
    $name = 'root';
    $password = '';
    $nomeDB = 'progettogpo';

    // Create connection
    $conn = mysqli_connect($servername, $name, $password, $nomeDB);

    // Check connection
    if (!$conn) {
        die("Errore nella connessione a MySql: " . mysqli_connect_error());
    }

    session_start();

    $email = $_POST['maillogin'];
    $pw = $_POST['passlogin'];

    // Using prepared statements to prevent SQL injection
    $query = "	SELECT username, password 
				FROM account 
				WHERE email=?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Check if user exists
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $username, $hashed_password);
            mysqli_stmt_fetch($stmt);

            // Verify password
            if (SHA1($pw) == $hashed_password) {
                $_SESSION["username"] = $username;
                header("location: ../home.php");
                exit(); // Ensure script stops here after redirect
            } else {
                $_SESSION['login_error'] = 'Email e/o password sono sbagliati.';
                header('Location: index.php');
            }
        } else {
            $_SESSION['login_error'] = 'Email e/o password sono sbagliati.';
            header('Location: index.php');
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Errore nella query: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
