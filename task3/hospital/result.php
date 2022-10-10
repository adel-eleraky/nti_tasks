<?php 


session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $_SESSION['phone'] = $_POST['phone'];
}
if(!isset($_SESSION['phone'])){
    header('location:number.php');die;
}


if($_POST){
    switch($_POST['question1']){
        case 0 :
            $result1 = "bad" ;
            break;
        case 3 :
            $result1 = "good" ;
            break;
        case 5 :
            $result1 = "very good" ;
            break;
        case 10 :
            $result1 = "excellent" ;
            break;
    }
    switch($_POST['question2']){
        case 0 :
            $result2 = "bad" ;
            break;
        case 3 :
            $result2 = "good" ;
            break;
        case 5 :
            $result2 = "very good" ;
            break;
        case 10 :
            $result2 = "excellent" ;
            break;
    }
    switch($_POST['question3']){
        case 0 :
            $result3 = "bad" ;
            break;
        case 3 :
            $result3 = "good" ;
            break;
        case 5 :
            $result3 = "very good" ;
            break;
        case 10 :
            $result3 = "excellent" ;
            break;
    }
    switch($_POST['question4']){
        case 0 :
            $result4 = "bad" ;
            break;
        case 3 :
            $result4 = "good" ;
            break;
        case 5 :
            $result4 = "very good" ;
            break;
        case 10 :
            $result4 = "excellent" ;
            break;
    }
    switch($_POST['question5']){
        case 0 :
            $result5 = "bad" ;
            break;
        case 3 :
            $result5 = "good" ;
            break;
        case 5 :
            $result5 = "very good" ;
            break;
        case 10 :
            $result5 = "excellent" ;
            break;
    }
    $totalReview = $_POST['question1'] + $_POST['question2'] + $_POST['question3'] + $_POST['question4'] + $_POST['question5'] ;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/result.css">
    <title>hospital</title>
</head>
<body>
    <table>
        <thead>
            <th>question</th>
            <th>review</th>
        </thead>
        <tbody>
            <tr>
                <td>Are you satisfied with the level of cleanliness</td>
                <td><?= $result1 ?? "";?></td>
            </tr>
            <tr>
                <td>Are you satisfied with the services price</td>
                <td><?= $result2 ?? "";?></td>
            </tr>
            <tr>
                <td>Are you satisfied with the nursing service</td>
                <td><?= $result3 ?? "";?></td>
            </tr>
            <tr>
                <td>Are you satisfied with the level of doctors</td>
                <td><?= $result4 ?? "";?></td>
            </tr>
            <tr>
                <td>Are you satisfied with the calmness in the hospital</td>
                <td><?= $result5 ?? "";?></td>
            </tr>
            <tr>
                <td>total review</td>
                <td> <?= ($totalReview < 25 ) ? "bad" : "excellent" ; ?></td>
            </tr>
            <tr>
                <td colspan="2"><?= ($totalReview > 25) ? "thanks for the review" : "We will call you later on this phone : {$_SESSION['phone']}"; ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>