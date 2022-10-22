<?php 



if($_POST){
    if($_POST['years'] <= 3){
        $interest = ($_POST['loan'] * .1)  * $_POST['years'];
        $afterInterest = $_POST['loan'] + $interest ;  
    }
    elseif($_POST['years'] > 3){
        $interest = ($_POST['loan'] * .15) * $_POST['years'] ;
        $afterInterest = $_POST['loan'] + $interest ;  
    }
    $monthlyPay =  $afterInterest / ($_POST['years'] * 12) ; 
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bank.css">
    <title>bank website</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <label for="name">username</label>
            <input type="text" name="name" id="name" required>
            <label for="loan">loan amount</label>
            <input type="number" name="loan" id="loan" required>
            <label for="years">loan years</label>
            <input type="number" name="years" id="years" required>
            <button>calculate</button>
        </form>
        <table  <?php echo $_POST ? "visible" : "hidden" ?> >
            <thead>
                <th>username</th>
                <th>loan</th>
                <th>interest</th>
                <th>total</th>
                <th>monthly</th>
            </thead>
            <tbody>
                <tr>
                    <td> <?= $_POST['name'] ?> </td>
                    <td> <?= $_POST['loan'] ?> </td>
                    <td> <?= $interest ?> </td>
                    <td> <?= $afterInterest ?> </td>
                    <td> <?= $monthlyPay ?> </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>