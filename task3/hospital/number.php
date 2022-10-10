<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/number.css">
    <title>hospital</title>
</head>
<body>
    <div class="container">
        <form action="review.php" method="POST">
            <label for=""> number </label>
            <input type="number" name="phone" id="" required>
            <input type="submit" value="submit">
        </form>
    </div>
</body>
</html>