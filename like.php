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
    }
    if (isset($_SESSION['mail_user'])) {
        $mail=$_SESSION['mail_user'];
    }
    else{
		header("location: accesso/index.php");
    }

    $query="    SELECT *
                FROM salvato
                WHERE email='$mail' AND ID_bottega=$idBottega";
                
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    if($num_rows){
            $query="    DELETE FROM salvato
                        WHERE email='$mail' AND ID_bottega=$idBottega";
            if (mysqli_query($conn, $query)) {
                echo "Records deleted: " . $project_code;
                $query = "  UPDATE bottega 
                            SET num_like = num_like - 1 
                            WHERE ID_bottega = $idBottega";

                if (mysqli_query($conn, $query)) {
                    echo "Records updated: " . $idBottega;
                    header("location: bottega.php?codice=$idBottega");
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
				} 
            }
            else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
     

    }
    else{
        $query="    INSERT INTO salvato (email, ID_bottega)
                    VALUES ('$mail', $idBottega)";
        if (mysqli_query($conn, $query)) {
            echo "Records inserted: " . $idBottega;
             $query = "  UPDATE bottega 
                    SET num_like = num_like + 1 
                    WHERE ID_bottega = $idBottega";

            if (mysqli_query($conn, $query)) {
                echo "Records updated: " . $project_code;
                header("location: bottega.php?codice=$idBottega");
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    
	echo "qualcosa è andato storto <a href='home.php'>torna alla home</a>";
    exit();
    mysqli_close($conn);

?>
