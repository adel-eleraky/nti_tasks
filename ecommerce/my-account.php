<?php

use App\Database\Models\user;
use App\Http\Requests\validation;

$title = "my account";
include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";


$validate = new validation;

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['update_password'])){
        $user = new user;
        $user->setEmail($_SESSION['user']->email);
        $result = $user->checkEmail();
        if($result->num_rows == 1){

            $user = $result->fetch_object();
        
            // update password
            // password verify
            if(password_verify($_POST['old_password'] , $user->password)){
                $validate->setInput($_POST['new_password'])->setInputName('new_password')->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/' , "you must enter a strong password");
                $validate->setInput($_POST['password_confirm'])->setInputName('password_confirm')->required()->passwordMatch($_POST['new_password']);
            }
            // check errors
            if(empty($validate->errs)){
                // update the password in database
                $user = new user;
                $user->setPassword(password_hash($_POST['new_password'] , PASSWORD_BCRYPT))->setEmail($_SESSION['user']->email)->updatePassword();
            }
        }
    }
    // update personal information
    if(! empty($_POST['update_information'])){
        // validation 
        $validate->setInput($_POST['first_name'] ?? "")->setInputName('first_name')->string()->between(2,32);
        $validate->setInput($_POST['last_name'] ?? "")->setInputName('first_name')->string()->between(2,32);
        $validate->setInput($_POST['email'] ?? "")->setInputName('email')->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/' ,"enter valid email")->unique('users' , 'email' , "email exists in database");
        $validate->setInput($_POST['phone'] ?? "")->setInputName('phone')->regex('/01[0125][0-9]{8}$/' , "enter valid phone")->unique('users' , 'phone' , 'phone exists in database');
        
        // update in database
        $user = new user;
        $user->setEmail($_SESSION['user']->email);
        $result = $user->checkEmail();
        
        if($result->num_rows == 1){
            
            
            $user = new user;
            $user->setId($_SESSION['user']->id);
            // update first name
            if(! empty($_POST['first_name'])){
                $user->setFirst_name($_POST['first_name']);
            }
            if(! empty($_POST['last_name'])){
                $user->setLast_name($_POST['last_name']);
            }
            if(! empty($_POST['email'])){
                $user->setEmail($_POST['email']);
            }
            if(! empty($_POST['phone'])){
                $user->setPhone($_POST['phone']);
            }
            if(empty($validate->errs)){
                $user->updateInformation();
            }
        }

    }
}


?>
        

        <!-- my account start -->
        <div class="checkout-area pb-80 pt-100">
            <div class="container">
                <div class="row">
                    <div class="ml-auto mr-auto col-lg-9">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                                    </div>
                                    <div id="my-account-1" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            
                                            <form method="POST">
                                                <div class="billing-information-wrapper">
                                                    <div class="account-info-wrapper">
                                                        <h4>My Account Information</h4>
                                                        <h5>Your Personal Details</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>First Name</label>
                                                                <input type="text" name="first_name">
                                                                <?php  echo $validate->setInputName('first_name')->errMessage() ?? ""; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Last Name</label>
                                                                <input type="text" name="last_name">
                                                                <?php  echo $validate->setInputName('last_name')->errMessage() ?? ""; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>Email Address</label>
                                                                <input type="email" name="email">
                                                                <?php  echo $validate->setInputName('email')->errMessage() ?? ""; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Telephone</label>
                                                                <input type="text" name="phone">
                                                                <?php  echo $validate->setInputName('phone')->errMessage() ?? ""; ?>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="billing-back-btn">
                                                        <div class="billing-back">
                                                            <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                        </div>
                                                        <div class="billing-btn">
                                                            <button type="submit" name="update_information" value="submit">Continue</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                                    </div>
                                    <div id="my-account-2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form method="POST">
                                                <div class="billing-information-wrapper">
                                                    <div class="account-info-wrapper">
                                                        <h4>Change Password</h4>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>old password</label>
                                                                <input type="password" name="old_password">
                                                                <?php  echo $validate->setInputName('old_password')->errMessage() ?? ""; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>New Password</label>
                                                                <input type="password" name="new_password">
                                                                <?php  echo $validate->setInputName('new_password')->errMessage() ?? ""; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>New Password Confirm</label>
                                                                <input type="password" name="password_confirm">
                                                                <?php  echo $validate->setInputName('password_confirm')->errMessage() ?? ""; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="billing-back-btn">
                                                        <div class="billing-back">
                                                            <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                        </div>
                                                        <div class="billing-btn">
                                                            <button type="submit" name="update_password">Continue</button>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries   </a></h5>
                                    </div>
                                    <div id="my-account-3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="billing-information-wrapper">
                                                <div class="account-info-wrapper">
                                                    <h4>Address Book Entries</h4>
                                                </div>
                                                <div class="entries-wrapper">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                            <div class="entries-info text-center">
                                                                <p>Farhana hayder (shuvo) </p>
                                                                <p>hastech </p>
                                                                <p> Road#1 , Block#c </p>
                                                                <p> Rampura. </p>
                                                                <p>Dhaka </p>
                                                                <p>Bangladesh </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                            <div class="entries-edit-delete text-center">
                                                                <a class="edit" href="#">Edit</a>
                                                                <a href="#">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-back">
                                                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                    </div>
                                                    <div class="billing-btn">
                                                        <button type="submit">Continue</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>4</span> <a href="wishlist.php">Modify your wish list   </a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- my account end -->
        
		
<?php 

include "layouts/footer.php";
include "layouts/scripts.php";
?>