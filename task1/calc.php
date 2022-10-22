<?php

    
    $result = "";
    $operation = $_POST['add'] ?? $_POST['subtract'] ?? $_POST['multiply'] ?? $_POST['division'] ?? $_POST['modulus'] ?? "" ;
    
    if(!empty( $_POST['num1'] ) and !empty(  $_POST['num2']) ){
        switch($operation){
            case "add":
                $result = $_POST['num1'] + $_POST['num2'];
                break;
            case "subtract":
                $result = $_POST['num1'] - $_POST['num2'];
                break;
            case "multiply":
                $result = $_POST['num1'] * $_POST['num2'];
                break;
            case "division":
                $result = $_POST['num1'] / $_POST['num2'];
                break;
            case "modulus":
                $result = $_POST['num1'] % $_POST['num2'];
                break;
        }
        
    }
    $result = "<div class='result'> the result is {$result}
                </div>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/calc.css">
    <title>task1 - grade</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <label for="">number 1</label>
            <input type="number" name="num1" placeholder="enter first number" required>
            <label for="">number 2</label>
            <input type="number" name="num2" placeholder="enter second number" required>
            <button name="add" value="add">add</button>
            <button name="subtract" value="subtract">subtract</button>
            <button name="multiply" value="multiply">multiply</button>
            <button name="division" value="division">division</button>
            <button name="modulus" value="modulus">modulus</button>
            
            
            <?php 
                if(!empty($_POST)){
                    echo $result;
                }
            ?>
        </form>
    </div>
</body>

</html>