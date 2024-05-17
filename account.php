<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="stili/stile_account.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Account</title>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="home.php" class="logo-link">
                <img src="img/logo.jpeg" alt="Logo" class="logo">
            </a>
            <div class="h1"><h1> Workman Advisor </h1></div>
            
        </div>
        <a href="account.php" class="account-link">
            <img src="img/account.png" alt="Icona Account" style="width: 40px;">
        </a>
        <a href="salvati.php" class="salvati-link">
            <img src="img/salvati.png" alt="Icona Salvati" style="width: 40px;">
        </a>
    </header>
    <?php
    session_start();
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "progettogpo");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
	if (isset($_SESSION['username'])) {
        $user=$_SESSION['username'];
    }
    else{
		header("location: accesso/index.php");
    }
    $sql="  SELECT username, email, immagine, artigiano
            FROM account
            WHERE username='$user'"; 

    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='informazioni'>";
            echo "<p class='username'>Username: " . $row["username"] . "</p>";
            echo "<p class='email'>Email: " . $row["email"] . "</p>";
            if($row["artigiano"]){
                echo "<p class='artigiano'>Ruolo: Artigiano<br>";
            }
            else{
                echo "<p class='artigiano'>Ruolo: Utente<br>";
            }
        echo "</div>";
        echo "<div class='immagine'>";
            if(!empty($row["immagine"]) && !is_null($row["immagine"]) ){
                echo "<img class='immagine' src='data:image/jpeg;base64," . base64_encode($row["immagine"]). ">";
            }else{
                echo "<img class='immagine' src='immagini/nonpresente.jpg'<br>";
            }
        echo "</div>";
    } else {
		header("location: accesso/index.php");
    }

    ?>
    <br>
    <div class="modifica"><a href="modifica_profilo.html">modifica profilo</a></div>
    <br>
    
</body>
</html>
