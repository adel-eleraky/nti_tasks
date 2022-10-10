<?php

session_start();


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $_SESSION['phone'] = $_POST['phone'];
}

if(!isset($_SESSION['phone'])){
    header('location:number.php');die;
}

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/review.css">
    <title>hospital</title>
</head>
<body>
    <form action="result.php" method="POST">
        <input type="hidden" name="phone" value="<?= $_SESSION['phone']?>">
        <table>
            <thead>
                <th>Question</th>
                <th>bad</th>
                <th>good</th>
                <th>very good</th>
                <th>excellent</th>
            </thead>
            <tbody>
                <tr>
                    <td>Are you satisfied with the level of cleanliness</td>
                    <td><input type="radio" name="question1" value="0" required></td>
                    <td><input type="radio" name="question1" value="3" ></td>
                    <td><input type="radio" name="question1" value="5" ></td>
                    <td><input type="radio" name="question1" value="10" ></td>
                </tr>
                <tr>
                    <td>Are you satisfied with the services price</td>
                    <td><input type="radio" name="question2" value="0" required></td>
                    <td><input type="radio" name="question2" value="3"></td>
                    <td><input type="radio" name="question2" value="5"></td>
                    <td><input type="radio" name="question2" value="10"></td>
                </tr>
                <tr>
                    <td>Are you satisfied with the nursing service</td>
                    <td><input type="radio" name="question3" value="0" required></td>
                    <td><input type="radio" name="question3" value="3"></td>
                    <td><input type="radio" name="question3" value="5"></td>
                    <td><input type="radio" name="question3" value="10"></td>
                </tr>
                <tr>
                    <td>Are you satisfied with the level of doctors</td>
                    <td><input type="radio" name="question4" value="0" required></td>
                    <td><input type="radio" name="question4" value="3"></td>
                    <td><input type="radio" name="question4" value="5"></td>
                    <td><input type="radio" name="question4" value="10"></td>
                </tr>
                <tr>
                    <td>Are you satisfied with the calmness in the hospital </td>
                    <td><input type="radio" name="question5" value="0" required></td>
                    <td><input type="radio" name="question5" value="3"></td>
                    <td><input type="radio" name="question5" value="5"></td>
                    <td><input type="radio" name="question5" value="10"></td>
                </tr>
                <tr><td colspan="5"><input type="submit" value="submit"></td></tr>
            </tbody>
        </table>
    </form>
</body>
</html>

