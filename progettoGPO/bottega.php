<?php
    if (isset($_GET['codice'])) {
        $idBottega=$_GET["codice"];
    }
    $conn = new mysqli("localhost", "root", "", "progettogpo");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT nome FROM bottega WHERE ID_bottega=$idBottega";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $nome=$row["nome"];
    }
    


?>
<html>
<head>
    <link rel="stylesheet" href="stili/stile_bottega.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  echo "$nome"?></title>
</head>
<body>    
    <header style="padding-right: 1rem;">
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
        $sql = "SELECT bottega.orario, bottega.num_like, bottega.indirizzo, bottega.città, bottega.descrizione, account.username, account.email
                FROM bottega
                INNER JOIN account ON account.email=bottega.email
                WHERE bottega.ID_bottega=$idBottega";

        $sql_img = "  SELECT immagine.image
                        FROM bottega, immagine 
                        WHERE bottega.ID_bottega=immagine.ID_bottega AND bottega.ID_bottega=$idBottega";
        $result = mysqli_query($conn, $sql);
        $result_img = mysqli_query($conn, $sql_img);
        
        
        if($row = mysqli_fetch_assoc($result)) {
            echo "<h2 class='titolo' " . $nome. "</h2>";
            echo "  <div class='container info'>";
            echo "      <div class='container ambito'>";
            echo "          <p>Artigiano: " . $row["username"] . "</p>";
            echo "          <p>Contatto: " . $row["email"] . "</p>";
            echo "      </div>";
            echo "      <div class='container likes'>";
            echo "          <button class='like-button' id='myButton_".$idBottega."' data-codice='".$idBottega."'>&#10084;</button>";
            echo "          <span class='like-count'>" . $row["num_like"] . "</span>";
            echo "      </div>";
            echo "      <div class='container descrizione'>";
            echo "          <p>Descrizione: " . $row["descrizione"] . "</p>";
            echo "      </div>";
            echo "  </div>";
            echo "  <div class='container image'>";
        }
        else{
            echo "errore, bottega non trovata";
        }
        
        if (mysqli_num_rows($result_img) > 0) {
            while($row = mysqli_fetch_assoc($result_img)) {
                echo "<center><img class='mySlides' src='immagini/".$row["image"] ."' alt='Immagine della bottega'></center>";
        
            }
        }
        else{
            echo "immagini non trovate";
        }
        echo "</div>";
        
        // Close the database connection
        mysqli_close($conn);
    ?>
    <form method="post" action="commento.php?codice=<?php echo $idBottega;?>" class="commenti">
        <input type="submit" value="Invia" class="input">
        <div class="testo">
            <input type="text" maxlength="500" id="commento" name="commento" required placeholder="Scrivi un commento" style="width:100%">
        </div>
    </form> 
</body>
<script>
    // Script per i like
    const buttons = document.querySelectorAll('button[id^="myButton_"]');

    buttons.forEach(function(button) {
        button.addEventListener("click", function() {
            const codice = this.dataset.codice; // Get the project code
            const url = "like.php?codice=" + codice; // Create the URL with the project code
            window.location.href = url; // Redirect to the URL
        });
    });
    // Automatic Slideshow - change image every 3 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  setTimeout(carousel, 3000);
}
</script>
</html>