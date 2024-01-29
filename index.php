<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>titolo</title>
</head>
<body>
   <h1> hello world</h1> 
   <form action="api/utente/valida_utente.php" method="POST">
    <div>
      <label>Email: </label>
      <input type="text" name="email">
    </div>
    <br>
    <div>
      <label>Username: </label>
      <input type="text" name="username">
    </div>
    <br>
    <div>
      <label>Password: </label>
      <input type="password" name="password">
    </div>
    <br>
    <input type="submit" name="submit" value="Submit">
  </form>
</body>

</html>