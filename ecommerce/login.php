<?php

use App\Database\Models\user;
use App\Http\Requests\validation;

$title = "Login"; 

include "layouts/header.php";
include "layouts/navbar.php";
include "App/Http/Middlewares/guest.php";
include "layouts/breadcrumb.php";

$validate = new validation;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $validate->setInput($_POST['email'] ?? "")->setInputName('email')->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/');
    $validate->setInput($_POST['password'] ?? "")->setInputName('password')->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/' , "you must enter a strong password");

    $user = new user;
    $user->setEmail($_POST['email']);
    //get user by email
    $result = $user->checkEmail();
    if($result->num_rows == 1){
        // var_dump($result->fetch_row());
        $user = $result->fetch_object();
        if(password_verify($_POST['password'] , $user->password)){
            // echo "correct password";
            if(is_null($user->email_verified_at)){
                // send verification code 
                // go to verification code page 
                // header('location:verification-code.php');die;
            }
            if(isset($_POST['remember_me'])){
                setcookie('remember_me' , md5($_POST['email']) , time() + 86400 * 7 , '/'  );
            
            }
            $_SESSION['user'] = $user;
            
                header('location:index.php');die;
        }else{
            $error =  "<p class='text-danger font-weight-bold'> Wrong email or password </p>";
        }
    }else{
        $error = "<p class='text-danger font-weight-bold'> Wrong email or password </p>";
    }



}

?>
        <div class="login-register-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> login </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form  method="post">
                                                <input type="text" name="email" placeholder="email">
                                                <?php echo $validate->setInputName('email')->errMessage(); ?>
                                                <input type="password" name="password" placeholder="Password">
                                                
                                                <?php echo $validate->setInputName('password')->errMessage(); ?>
                                                <?php  echo $error ?? "";?>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox" name="remember_me">
                                                        <label>Remember me</label>
                                                        <a href="forget-password.php">Forgot Password?</a>
                                                    </div>
                                                    <button type="submit"><span>Login</span></button>
                                                    
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