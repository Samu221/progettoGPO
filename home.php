<html>
<head>
    <link rel="stylesheet" href="stile_home.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <header>
        <div class="header-content">
            <a href="home.php" class="link">
                <img src="immagini/logo.png" alt="Logo" class="logo">
            </a>
            <h1 class="h1"> Workman Advisor </h1>
        </div>
        <a href="account.php" class="account-link">
            <img src="immagini/account.png" alt="Icona Account" style="width: 40px;">
        </a>
        <a href="/percorso-del-tuo-account" class="salvati-link">
            <img src="immagini/salvati.png" alt="Icona Salvati" style="width: 40px;">
        </a>
    </header>
    <form action="home.php" method="post" class="filtro">
        <div>
        <input type="text" id="città" name="città" placeholder="Cerca per città">
        <div>
        <div>
            <p>numero minimo di like:</p>
            <input type="range" id="like" name="like" min="0" max="500" value="0" oninput="updateDisplay(this)">
            <label id="rangeValue"></label>
        </div>
        <input type="submit" value="Ricerca">
    </form>

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
    <?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "progettogpo";

    $conn = mysqli_connect($host, $user, $password, $database);

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
    // Execute the SQL query to retrieve all projects and related information
    $sql = "SELECT bottega.orario, bottega.nome, bottega.indirizzo, bottega.città, bottega.descrizione, account.username, immagine.image
            FROM bottega
            INNER JOIN account ON account.email=bottega.email
            LEFT JOIN immagine ON bottega.ID_bottega=immagine.ID_bottega
            WHERE bottega.città LIKE '$filtro_città' AND bottega.num_like>$filtro_like
            GROUP BY bottega.ID_bottega;";


    $result = mysqli_query($conn, $sql);
    if ($result){

    // Display each project and related information
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='container'>";
                echo "<div class='wrapper'>";
                    echo "<div class='informazioni'>";
                        echo "<h2>". $row["nome"] ."</h2>";
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
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Nessun progetto trovato.";
    }
    }else{
        echo "errore";
    }
    ?>
</body>
</html>