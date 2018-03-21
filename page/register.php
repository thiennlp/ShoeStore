<?php
if (isset($_POST['to-register'])) {
    $name	=	$_POST['name'];
    $email	=	$_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $username	=	$_POST['username'];
    $password	=	md5($_POST['password']);
    $re_password = md5($_POST['re-password']);

    $row_account = selectData("account", "username='".$username."' AND password='".$password."'", "id_account");
    if (!$name || !$phone || !$address || !$username || !$password) {
        $error = $_SESSION['lang'] == 'english' ? 'PLEASE PUT FILL INFORMATION !' : 'VUI LÒNG NHẬP ĐẦY ĐỦ THÔNG TIN !';
    } elseif ($password != $re_password) {
        $error = $_SESSION['lang'] == 'english' ? 'CONFIRM PASSWORD FAIL !' : 'XÁC NHẬN MẬT KHẨU CHƯA ĐÚNG !';
    } elseif ($email && !filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = $_SESSION['lang'] == 'english' ? 'EMAIL WRONG !' : 'EMAIL KHÔNG HỢP LỆ !';
    } elseif ($row_account) {
        $error = $_SESSION['lang'] == 'english' ? 'USERNAME IS EXIST !' : 'USERNAME ĐÃ TỒN TẠI !';
    } elseif (strlen($password) < 8) {
        $error = $_SESSION['lang'] == 'english' ? 'PASSWORD NEED MORE THAN 8 CHARACTER !' : 'MẬT KHẨU PHẢI DÀI HƠN 8 KÝ TỰ !';
    } else {
        $insert_account = insertData("account", "username, password, permission", "'".$username."','".$password."','customer'");
        if ($insert_account) {
            $id_account =  selectData("account", "username = '".$username."' AND password = '".$password."'", "id_account");
            if ($id_account) {
                $insert_customer = insertData("customer", "name, email, phone, address, id_account", "'".$name."','".$email."','".$phone."','".$address."','".$id_account[0][0]."'");
                if ($insert_customer) {
                    $error = '';
                    ?>
                        <script>
                            parent.location = "/login";
                        </script>
                    <?php
                } else {
                    $error = $_SESSION['lang'] == 'english' ? 'REGISTER FAIL !' : 'ĐĂNG KÝ THÀNH VIÊN THẤT BẠI !';
                }
            }
        } else {
            $error = $_SESSION['lang'] == 'english' ? 'DONE REGISTER !' : 'ĐĂNG KÝ THÀNH VIÊN THÀNH CÔNG';
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12" >
            <div class="title-login">
                <h2><strong><?php echo $var_register; ?></strong></h2>
                <?php
                $content = explode(".", $var_status_register);
                for ($i = 0; $i < count($content); $i++) {
                    ?>
                    <p><strong><?php echo $content[$i]; ?></strong></p>
                    <?php
                }
                ?>       
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <div class="panel-to-login">
                <p><strong><?php echo $var_exist; ?></strong></p>    
                <div class="to-login">
                    <button id="btn-to-login" type="button" onclick="window.location.href='/login';"><strong><?php echo $var_login; ?> <span class="glyphicon glyphicon-arrow-right"></span></strong></button>
                </div>      
            </div>
        </div>
    </div>
    <div id="error-notice"><?php echo $error; ?></div>
    <div class="row">
        <div class="col-md-12" >
            <div class="content-register">
                <div class="col-md-12" >
                    <div class="omb_register" >                   
                        <form id="loginform" class="form-horizontal" role="form" method="POST">
                            <h3 class="omb_authTitle"><?php echo $var_info_register; ?></h3>
                            
                            <div class="row omb_row-sm-offset-3">
                                <div class="col-xs-12 col-sm-9">	
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                    </div>
                                    <span class="help-block"></span>               
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input  type="text" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <span class="help-block"></span>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input  type="text" class="form-control" name="phone" placeholder="Phone">
                                    </div>
                                    <span class="help-block"></span>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                        <textarea class="form-control" rows="5" name="address" id="address" placeholder="Address" ></textarea>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="row omb_row-sm-offset-3 omb_loginOr">
                                <div class="col-xs-12 col-sm-9">
                                    <hr class="omb_hrOr">
                                    <span class="omb_spanOr"></span>
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
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input  type="password" class="form-control" name="re-password" placeholder="Confirm password">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="row omb_row-sm-offset-3 omb_loginOr">
                                <div class="col-xs-12 col-sm-9">
                                    <hr class="omb_hrOr">
                                    <span class="omb_spanOr"></span>
                                </div>
                            </div>
                            <div class="row omb_row-sm-offset-3">
                                <div class="col-xs-12 col-sm-9">	
                                    <button id="btn-to-save" name="to-register" class="btn btn-lg btn-block" type="submit"><?php echo $var_register; ?></button>
                                </div>
                            </div>
                        </form>                   
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

