<?php

use App\Database\Models\user;

use App\Http\Requests\validation;
use App\Mail\code;

$title = "Register";
include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";

$validate = new validation;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $validate->setInput($_POST['first_name'] ?? "")->setInputName('first_name')->required()->string()->between(2,32);
    $validate->setInput($_POST['last_name'] ?? "")->setInputName('last_name')->required()->string()->between(2,32);
    $validate->setInput($_POST['email'] ?? "")->setInputName('email')->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')->unique('users' , 'email');
    $validate->setInput($_POST['phone'] ?? "")->setInputName('phone')->required()->regex('/01[0125][0-9]{8}$/' , "enter valid phone")->unique('users' , 'phone' , "phone exists");
    $validate->setInput($_POST['password'] ?? "")->setInputName('password')->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/' , "enter strong password");
    $validate->setInput($_POST['password_confirm'] ?? "")->setInputName('password_confirm')->required()->passwordMatch($_POST['password']);
    $validate->setInput($_POST['gender'] ?? "")->setInputName('gender')->required()->allowed(['m' ,'f']);
    if(empty($validate->getErrs())){
        $verificationCode = rand(10000,99999);
        $user = new user;
        $user->setFirst_name($_POST['first_name'])
        ->setLast_name($_POST['last_name'])
        ->setEmail($_POST['email'])
        ->setVerification_code($verificationCode)
        ->setPassword($_POST['password'])
        ->setPhone($_POST['phone'])
        ->setGender($_POST['gender']);
        if($user->createData()){
            // send verification code to user email
            $mailBody = "<p> Hello {$_POST['first_name']} </p> 
            <p> Your Verification Code :<b style='color:red;'> {$verificationCode} </b> </p>
            ";
            $verificationCode = new code($_POST['email'] , "verification code" , $mailBody);
            if($verificationCode->send()){
                echo "success";
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['page'] = "register";
                header('location:verification-code.php');die;
            }
            else{
                echo "try again later";
            }
        }
        else{
        }
    }
    
}
?>
        <div class="login-register-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active"  data-toggle="tab" href="#lg2">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg2" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="#" method="post">
                                                <input type="text" name="first_name" placeholder="first name">
                                                <?php  echo $validate->setInputName('first_name')->errMessage() ?? ""; ?>
                                                <input type="text" name="last_name" placeholder="last name">
                                                <?php  echo $validate->setInputName('last_name')->errMessage() ?? ""; ?>
                                                <input type="text" name="phone" placeholder="phone">
                                                <?php  echo $validate->setInputName('phone')->errMessage() ?? ""; ?>
                                                <input type="text" name="email" placeholder="email">
                                                <?php  echo $validate->setInputName('email')->errMessage() ?? ""; ?>
                                                <input type="password" name="password" placeholder="Password">
                                                <?php  echo $validate->setInputName('password')->errMessage() ?? ""; ?>
                                                <input type="password" name="password_confirm" placeholder="confirm Password">
                                                <?php  echo $validate->setInputName('password_confirm')->errMessage() ?? ""; ?>
                                                <select name="gender" >
                                                    <option value="m">male</option>
                                                    <option value="f">female</option>
                                                </select>
                                                <?php  echo $validate->setInputName('gender')->errMessage() ?? ""; ?>
                                                <div class="button-box">
                                                    <button type="submit"><span>Register</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
<?php 

include "layouts/footer.php";
include "layouts/scripts.php";
?>