<?php
session_start();
if (isset($_SESSION['registration_error'])) {
  $registration_error = $_SESSION['registration_error'];
  unset($_SESSION['registration_error']);
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
<div class="form-container" id="registrationForm" style="display:block">
    <h2>Registrazione</h2>
    <?php if (isset($registration_error)) : ?>
      <p style="color:red"><?php echo $registration_error; ?></p>
    <?php endif; ?>
    <form action="registration.php" method="post" onsubmit="return validateForm(this)">
      <p>Email:</p>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>
      <p>Username:</p>
      <input type="text" id="user" name="user" placeholder="Enter username" required>
      <p>Password:</p>
      <input type="password" id="pass" name="pass" placeholder="Enter password" required>
		<p id="passwordError" style="color:red; display:none; margin-bottom:5px;">La password deve contenere almeno 8 caratteri, una lettera maiuscola, una lettera minuscola, un numero e un carattere speciale.</p>
      <input type="submit" value="Registrati" style="background-color:black">
    </form>
    <p class="switch-form">Hai già un account? <a href="index.php" >Accedi</a></p>
  </div>
  </center>
  <script>
  function validateForm(form) {
    var password = form.pass.value;
    var passwordError = document.getElementById('passwordError');

    if (!isPasswordSecure(password)) {
      passwordError.style.display = 'block';
      return false;
    }

    passwordError.style.display = 'none';
    return true;
  }
  function isPasswordSecure(password) {
  // Controlla se la password ha una lunghezza minima di 8 caratteri
  if (password.length < 8) {
    return false;
  }

  // Controlla se la password contiene almeno un carattere speciale
  var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
  if (!hasSpecialChar) {
    return false;
  }

  // Controlla se la password contiene almeno un numero
  var hasNumber = /\d/.test(password);
  if (!hasNumber) {
    return false;
  }

  // Controlla se la password contiene almeno una lettera maiuscola e una minuscola
  var hasUpperCase = /[A-Z]/.test(password);
  var hasLowerCase = /[a-z]/.test(password);
  if (!hasUpperCase || !hasLowerCase) {
    return false;
  }

  // Se la password supera tutti i controlli, allora è sicura
  return true;
}
  </script>
  </body>
  </html>
