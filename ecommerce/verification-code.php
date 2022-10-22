<?php

use App\Database\Models\user;
use App\Http\Requests\validation;

$title = "verification code";
include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";

$validate = new validation;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $validate->setInput($_POST['verification_code'] ?? "")->setInputName('verification_code')->required()->numeric();
    
    if(empty($validate->errs)){
        
            
            $user = new user;
            $user->setEmail($_SESSION['email'])->setVerification_code($_POST['verification_code']);
            $result = $user->checkCode();
            if($result->num_rows == 1){
                $user->setEmail_verified_at(date('Y-m-d H:i:s'));
                if($user->verify()){
                    if($_SESSION['page'] == 'register'){

                        unset($_SESSION['verification-email']);
                        unset($_SESSION['page']);
                        header('refresh:3;url=login.php');
                    }elseif($_SESSION['page'] == 'forget'){
                        header('refresh:3;url=reset-password.php');
                    }
                    
                }else{
                    $error = "<div class='alert alert-danger text-center'> Something went wrong </div>";
                }
            }else{
                $wrongCode = "<p class='font-weight-bold text-danger'> Wrong Code </p>";
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
                                    <h4> verification code </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg2" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form  method="post">
                                                <input type="number" name="verification_code" required placeholder="enter verification code">
                                                <?php echo $validate->setInputName('verification_code')->errMessage(); ?>
                                                <div class="button-box">
                                                    <button type="submit"><span>verify</span></button>
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