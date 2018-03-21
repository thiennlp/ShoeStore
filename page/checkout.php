<?php
if (isset($_POST['to-login'])) {
    $username	=	$_POST['username'];
    $password	=	md5($_POST['password']);
    $account = selectData("account", "username='".$username."' AND password='".$password."'", "id_account");
    if ($account) {
        $_SESSION['customer'] = true;
        $_SESSION['customer'] = $account[0][0];
        $error = '';
        $id_customer = selectData("customer", "id_account = '".$account[0][0]."'", "id_customer");
        if ($id_customer) {
            addBill($_SESSION['cart_'], $id_customer[0][0]);
        }
    } else {
        if (!$username || !$password) {
            $error = 'PLEASE PUT FILL INFORMATION !';
        } else {
            $error = 'LOGIN FAIL !';
        }
    } 
}
if (isset($_POST['btn-to-save'])) {
    $name	=	$_POST['name'];
    $email	=	$_POST['email'];
    $phone	=	$_POST['phone'];
    $address	=	$_POST['address'];
    $note	=	$_POST['note'];
    $account_underfine = selectData("account", "id_account = 99999", "*");
    if (!$account_underfine) {
        $password = md5('underfine99999');
        $insert_account = insertData("account", "username, password, permission", "'underfine99999','".$password."','customer'");
    }
    $insert_customer = insertData("customer", "name, email, phone, address, id_account", "'".$name."','".$email."','".$phone."','".$address."', 99999");
    $id_customer = selectData("customer", "name = '".$name."' AND phone = '".$phone."' AND address = '".$address."' AND email = '".$email."' AND id_account = 99999", "id_customer");
    if ($id_customer) {
        addBill($_SESSION['cart_'], $id_customer[0][0], $note);
    }
}
if (isset($_SESSION['customer'])) {
    ?>
    <script>
        window.location = "/home";
    </script>
    <?php
} else {
    ?>
    <!-- Modal Checkout for customer not login-->
    <div class="modal fade" id="modal-checkout" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-checkout modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="title-checkout"><?php echo $var_guest; ?></div>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <form role="form" method="POST" id="checkoutForm" action="">
                        <div class="row omb_row-sm-offset-3">
                            <div class="col-xs-12 col-sm-12">	
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                    <input type="text" class="form-control" name="name" placeholder="<?php echo $_SESSION['lang'] == 'english' ? 'Name' : 'Tên'; ?>">
                                </div>
                                <span class="help-block"></span>               
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input  type="text" class="form-control" name="email" placeholder="Email">
                                </div>
                                <span class="help-block"></span>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input  type="text" class="form-control" name="phone" placeholder="<?php echo $_SESSION['lang'] == 'english' ? 'Phone' : 'Số điện thoại'; ?>">
                                </div>
                                <span class="help-block"></span>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                    <textarea class="form-control" rows="4" name="address" placeholder="<?php echo $_SESSION['lang'] == 'english' ? 'Address' : 'Địa chỉ'; ?>" ></textarea>
                                </div>
                                <span class="help-block"></span>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                                    <textarea class="form-control" rows="4" name="note" id="note" placeholder="<?php echo $_SESSION['lang'] == 'english' ? 'Note' : 'Ghi chú'; ?>" ></textarea>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="row omb_row-sm-offset-3 omb_loginOr option-checkout">
                            <div class="col-xs-12 col-sm-12" style="padding: 0px;">
                                <span class="label-option"><?php echo $var_delivery; ?></span>
                            </div>
                        </div>
                        <div class="row omb_row-sm-offset-3">
                            <div class="col-xs-12 col-sm-12">	
                                <div class="input-group">
                                    <div class="radio">
                                        <label><input type="radio" name="opt_delivery" checked><?php echo $var_ship_opt; ?></label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="opt_delivery"><?php echo $var_store_opt; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row omb_row-sm-offset-3 omb_loginOr option-checkout">
                            <div class="col-xs-12 col-sm-12" style="padding: 0px;">
                                <span class="label-option"><?php echo $var_payment; ?></span>
                            </div>
                        </div>
                        <div class="row omb_row-sm-offset-3">
                            <div class="col-xs-12 col-sm-12">	
                                <div class="input-group">
                                    <div class="radio">
                                        <label><input type="radio" name="opt_payment" checked><?php echo $var_tranfer; ?></label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="opt_payment"><?php echo $var_to_ship; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row omb_row-sm-offset-3 omb_loginOr option-checkout">
                            <div class="col-xs-12 col-sm-12" style="padding: 0px;">
                                <span class="label-option"></span>
                            </div>
                        </div>
                        <div class="row omb_row-sm-offset-3">
                            <div class="col-xs-12 col-sm-12">	
                                <button id="btn-to-save" name="to-payment" class="btn btn-lg btn-block" type="submit"><?php echo $var_buy; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal report no item on cart-->
    <div class="modal fade" id="modal-report" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-report modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="title-checkout"><strong>JAC & JEANS COLLECTION'S</strong></h4>
                </div>
                <div class="modal-report modal-body">
                    <p><?php echo $var_item_bag; ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal  -->
    <div class="container">
        <div class="row">
            <div class="col-md-12" >
                <div class="title-login"></div>
            </div>
        </div>
        <div id="error-notice"><?php echo $error; ?></div>
        <div class="row">
            <div class="col-md-12" >
                <div class="content-login">
                    <div class="col-md-7" >
                        <div class="omb_login" >                   
                            <form id="loginform" class="form-horizontal" role="form" method="POST">
                                <h3 class="omb_authTitle">Login with</h3>
                                <div class="row omb_row-sm-offset-3 omb_socialButtons">
                                    <div class="col-xs-5 col-sm-3">
                                        <a href="#" class="btn btn-lg btn-block omb_btn-facebook">
                                            <i class="fa fa-facebook visible-xs"></i>
                                            <span class="hidden-xs">Facebook</span>
                                        </a>
                                    </div>
                                    <div class="col-xs-5 col-sm-3">
                                        <a href="#" class="btn btn-lg btn-block omb_btn-twitter">
                                            <i class="fa fa-twitter visible-xs"></i>
                                            <span class="hidden-xs">Twitter</span>
                                        </a>
                                    </div>	
                                    <div class="col-xs-5 col-sm-3">
                                        <a href="#" class="btn btn-lg btn-block omb_btn-google">
                                            <i class="fa fa-google-plus visible-xs"></i>
                                            <span class="hidden-xs">Google+</span>
                                        </a>
                                    </div>	
                                </div>

                                <div class="row omb_row-sm-offset-3 omb_loginOr">
                                    <div class="col-xs-12 col-sm-9">
                                        <hr class="omb_hrOr">
                                    </div>
                                </div>
                                <div class="row omb_row-sm-offset-3">
                                    <div class="col-xs-12 col-sm-9">	
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="username" placeholder="Username">
                                        </div>
                                        <span class="help-block"></span>
                                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input  type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                        <span class="help-block"></span>
                                        <?php
                                        if (count($_SESSION['cart_']) > 0) {
                                            ?>
                                            <button id="btn-to-login" name="to-login" type="submit"><?php echo $var_login; ?></button>
                                            <?php
                                        } else {
                                            ?>
                                            <button id="btn-to-login" name="to-login" type="button"><?php echo $var_login; ?></button>
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="row omb_row-sm-offset-3">
                                    <div class="col-xs-12 col-sm-9">
                                        <p class="omb_forgotPwd">
                                            <a href="#"><?php echo $var_forget; ?></a>
                                        </p>
                                    </div>
                                </div>
                            </form>                   
                        </div> 
                    </div>
                    <div class="col-md-1" ></div>
                    <div class="col-md-4">
                        <div class="omb_login omb_checkout">
                            <div class="content-asset" id="login-intercept-guest">
                                <h3 class="omb_authTitle">Guest Checkout</h3>
                                <div class="checkout-note">If you don't have account, you can create account during checkout for faster checkout and exclusive offers and access.
                                </div>
                            </div>
                            <div>
                                <?php
                                if (count($_SESSION['cart_']) > 0) {
                                    ?>
                                    <button id="btn-checkout" type="button" class="btn-checkout"><?php echo $var_checkout; ?></button>
                                    <?php
                                } else {
                                    ?>
                                    <button id="btn-cant-checkout" type="button" class="btn-checkout"><?php echo $var_checkout; ?></button>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="select-checkout"><strong><?php echo $_SESSION['lang'] == 'english' ? '-OR-' : 'HOẶC'; ?></strong></div>
                            <div>
                                <button type="button" class="btn-checkout-paypal"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


