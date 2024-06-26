<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="stili/stile_home.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salvati</title>
</head>

<body>
    <div class="page-container">
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

        <div class="main-content">
            <div class="contentt">
                <script>
                    function updateDisplay(input) {
                        document.getElementById("rangeValue").textContent = input.value;
                    }

                    // Call updateDisplay function with slider input element as argument
                    window.onload = function() {
                        updateDisplay(document.getElementById("like"));
                    }
                </script>
                <!-- Connect to the database -->
                <div class="content">
                <?php
                session_start();

                $conn = mysqli_connect("localhost", "root", "", "progettogpo");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if(!empty($_POST['città']) && isset($_POST['città'])){
                    $filtro_città=$_POST['città'];
                }else{
                    $filtro_città='%';
                }
                if(isset($_POST['like'])){
                    $filtro_like=$_POST['like'];
                }else{
                    $filtro_like='0';
                }
                $user="errore";
                if (isset($_SESSION['mail_user'])) {
                    $mail=$_SESSION['mail_user'];
                }
                else{
                    //header("location: accesso/index.php");
                    echo $_SESSION["mail_user"];
                }

                // Execute the SQL query to retrieve all projects and related information
                $sql = "SELECT bottega.ID_bottega, bottega.num_like, bottega.nome, bottega.indirizzo, bottega.città, bottega.descrizione, account.username, immagine.image
                        FROM bottega
                        INNER JOIN salvato ON salvato.ID_bottega = bottega.ID_bottega
                        INNER JOIN account ON account.email=bottega.email
                        LEFT JOIN immagine ON bottega.ID_bottega=immagine.ID_bottega
                        WHERE bottega.città LIKE '$filtro_città' AND bottega.num_like>$filtro_like AND salvato.email='$mail'
                        GROUP BY bottega.ID_bottega
                        ORDER BY bottega.ID_bottega DESC;";


                $result = mysqli_query($conn, $sql);
                if ($result){

                // Display each project and related information
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='container' >";
                            echo "<button class='wrapper' id='myButton_".$row["ID_bottega"]."' data-codice='".$row["ID_bottega"]."'>";
                                echo "<div class='informazioni'>";
                                    echo "<h2>". $row["nome"] ."</h2>";
                                    echo "<p style='float: right'>&#10084; ". $row["num_like"]."</p>";
                                    echo "<p> di ". $row["username"] ."</p>";
                                    echo "<p>". $row["indirizzo"] . " " .$row["città"] ."</p>";
                                    echo "<p>". $row["descrizione"] ."</p>";
                                echo "</div>";
                                echo "<div class='immagine'>";
                                    if(isset( $row["image"])){
                                        echo "<img src='immagini/". $row["image"] ."'>";
                                    }else
                                    {
                                        echo "<img src='immagini/nonpresente.jpg'>";
                                    }
                                echo "</div>";
                            echo "</button>";
                        echo "</div>";
                    }
                } else {
                    echo "Nessuna bottega salvata.";
                }
                }else{
                    echo "errore";
                }
                ?>
                </div>
                <script>
                    // Script per il pulsante "Mostra altro"
                    const buttons = document.querySelectorAll('button[id^="myButton_"]');

                    buttons.forEach(function(button) {
                        button.addEventListener("click", function() {
                            const codice = this.dataset.codice; // Get the project code
                            const url = "https://localhost/progettoGPO/bottega.php?codice=" + codice; // Create the URL with the project code
                            window.location.href  = url; // Redirect to the URL
                        });
                    });
                </script>
            </div>
        </div>
        <br>
        
    <footer>
            <div class="containerf">
                <div class="logo-left">
                    <img src="./img/LogoITI.png" alt="Logo" width="auto" height="150%">
                </div>
                <div class="contact-info">
                    <p>Recapito telefonico: 0587 53566</p>
                    <p>Email: pitf030003@istruzione.it</p>
                </div>
                <div class="logo-right">
                    <img src="./img/logo.jpeg" alt="Logo" width="auto" height="150%">
                </div>
            </div>
            <p>&copy; 2024 Workman Advisor</p>
        </footer>
    </div>
</body>
</html>
