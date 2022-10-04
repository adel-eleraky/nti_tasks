<?php 
    
    $percentage = "";
    $grade = "";
    if($_POST){
        $sum = $_POST['math'] + $_POST['physics'] + $_POST['chemistry'] + $_POST['biology'] + $_POST['computer'];
        $percentage = ( $sum / 500 ) * 100 ;
    }
    if($percentage >= 0 and $percentage < 40){
        $grade = " F";
    }
    elseif($percentage >= 40 and $percentage < 60){
        $grade = " E";
    }
    elseif($percentage >= 60 and $percentage < 70){
        $grade = " D";
    }
    elseif($percentage >= 70 and $percentage < 80){
        $grade = " C";
    }
    elseif($percentage >= 80 and $percentage < 90){
        $grade = " B";
    }
    elseif($percentage >= 90 and $percentage <= 100 ){
        $grade = " A";
    }
    $message = "<div class='result'>
                    percentage: {$percentage}% , Grade: {$grade} 
                </div>";
    if($percentage > 100){
        $message = "error ( wrong marks)";
    }
    

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/grade.css">
    <title>task1 - grade</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <label for="">math</label>
            <input type="number" name="math" required placeholder="enter math degree" max="100" min="0">
            <label for="">physics</label>
            <input type=" number" name="physics" required placeholder="enter physics degree" max="100" min="0">
            <label for="">chemistry</label>
            <input type="number" name="chemistry" required placeholder="enter chemistry degree" max="100" min="0">
            <label for="">biology</label>
            <input type="number" name="biology" required placeholder="enter biology degree" max="100" min="0">
            <label for="">computer</label>
            <input type="number" name="computer" required placeholder="enter computer degree" max="100" min="0">
            <button>calculate</button>
        </form>
        <?php  
            if($_POST){
                echo $message;
            }
        ?>
    </div>


</body>

</html>