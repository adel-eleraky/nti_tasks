<?php

use App\Http\Requests\validation;

$title = "forget password";
include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";

$validate = new validation;

if($_SERVER['REQUEST_METHOD'] == "POST"){

}
?>
        <div class="login-register-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active"  data-toggle="tab" href="#lg2">
                                    <h4> forget password </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg2" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                                <input type="email" name="email" required placeholder="enter your email">
                                                <div class="button-box">
                                                    <button type="submit" name="submit"><span>verify</span></button>
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