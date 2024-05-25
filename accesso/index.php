<?php
session_start();
if (isset($_SESSION['login_error'])) {
  $login_error = $_SESSION['login_error'];
  unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="stili/registrazione.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <title>Accedi</title>
  	<link rel="icon" type="image/x-icon" href="/immagini/logo.png">
</head>
<body>
  <br>
  <center>
  <h1 class="titolo">Workman Advisor</h1>
  <br>
  <div class="form-container" id="loginForm" style="display:block ">
    <h2>Accesso</h2>
    <?php if (isset($login_error)) : ?>
      <p style="color:red"><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
      <p>Email:</p>
      <input type="email" id="mail" name="maillogin" placeholder="Enter email" required>
      <p>Password:</p>
      <input type="password" id="pass" name="passlogin" placeholder="Enter password" required>
      <input type="submit" value="Accedi" style="background-color:black">
    </form>
    <p class="switch-form">Non hai un account? <a href="registrazione.php" >Registrati</a></p>
  </div>

 
  
  </center>
  
</body>
</html>
