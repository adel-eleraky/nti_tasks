<?php

if(isset($_POST['submit2'])){

    // total price
    $total = 0;
    for( $y=1; $y <= $_POST['productNum']; $y++){
        $total += ( $_POST["price{$y}"] * $_POST["quantity{$y}"] );
    }

    // discount
    if($total < 1000){
        $discount = 0;
    }
    elseif($total < 3000 ){
        $discount = $total * .1;
    }
    elseif($total < 4500 ){
        $discount = $total * .15;
    }
    elseif($total > 4500 ){
        $discount = $total * .2;
    }

    // delivery fees
    if($_POST['city'] == "cairo"){
        $delivery = 0;
    }
    elseif($_POST['city'] == "giza"){
        $delivery = 30;
    }
    elseif($_POST['city'] == "alex"){
        $delivery = 50;
    }
    elseif($_POST['city'] == "other"){
        $delivery = 100;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="supermarket.css">
    <title>supermarket</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <table>
                <thead>
                    <th>username</th>
                    <th>city</th>
                    <th>number of products</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="user" required value=<?= $_POST ? "{$_POST['user']}" : ""; ?> <?= $_POST ?  "readonly" : "" ?> ></td>
                        <td><select name="city" >
                            <option value="cairo" <?= ($_POST and $_POST['city'] == "cairo" ) ? "selected" : "" ?>>cairo</option>
                            <option value="giza" <?= ($_POST and $_POST['city'] == "giza" ) ? "selected" : "" ?>>giza</option>
                            <option value="alex" <?= ($_POST and $_POST['city'] == "alex") ? "selected" : "" ?>>alex</option>
                            <option value="other" <?= ($_POST and $_POST['city'] == "other") ? "selected" : "" ?>>other</option>
                        </select></td>
                        <td><input type="number" name="productNum" required value=<?= $_POST ? "{$_POST['productNum']}" : "" ?> <?= $_POST ?  "readonly" : "" ?> ></td>
                    </tr>
                    <tr><td colspan="3"><input type="submit" name="submit1" value="submit"></td></tr>
                </tbody>
            </table>
            <?php if(isset($_POST['submit1']) || isset($_POST['submit2'])){?>
                <table>
                    <tbody>
                        <th>product name</th>
                        <th>price</th>
                        <th>quantity</th>
                    </tbody>
                    <tbody>
                        <?php for( $x=1; $x <=$_POST['productNum']; $x++){?> 
                            <tr>
                                <td><input type="text" name="productName<?= $x;?>" required value=<?= $_POST["productName{$x}"] ?? ""; ?> <?= isset($_POST["productName{$x}"]) ?  "readonly" : "" ?>></td>
                                <td><input type="number" name="price<?= $x;?>" required value=<?= $_POST["price{$x}"] ?? ""; ?> <?= isset($_POST["price{$x}"]) ?  "readonly" : "" ?>></td>
                                <td><input type="number" name="quantity<?= $x;?>" required value=<?= $_POST["quantity{$x}"] ?? ""; ?> <?= isset($_POST["quantity{}$x"]) ?  "readonly" : "" ?>></td>
                            </tr>
                        <?php }?>
                        <tr><td colspan="3"><input type="submit" name="submit2" value="submit"></td></tr>
                    </tbody>
                </table>
            <?php }?>
            <?php if(isset($_POST['submit2'])){ ?>
                <table>
                    <tbody>
                        <tr>
                            <td>client name</td>
                            <td><?= $_POST['user'] ?></td>
                        </tr>
                        <tr>
                            <td>city</td>
                            <td><?= $_POST['city'] ?></td>
                        </tr>
                        <tr>
                            <td>total</td>
                            <td><?= $total; ?></td>
                        </tr>
                        <tr>
                            <td>discount</td>
                            <td><?= $discount; ?></td>
                        </tr>
                        <tr>
                            <td>total after discount</td>
                            <td><?= ($total - $discount); ?></td>
                        </tr>
                        <tr>
                            <td>Delivery</td>
                            <td><?= $delivery; ?></td>
                        </tr>
                        <tr>
                            <td>net total</td>
                            <td><?= ($total - $discount + $delivery); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php }?>
        </form>
    </div>
</body>
</html>