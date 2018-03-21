<?php
if (isset($_POST['to-login'])) {
    $username	=	$_POST['username'];
    $password	=	md5($_POST['password']);
    $account = selectData("account", "username='".$username."' AND password='".$password."'", "id_account");
    if ($account) {
        $_SESSION['customer'] = true;
        $_SESSION['customer'] = $account[0][0];
        $error = '';
        $class_alert = "alert alert-success";
        $content_notice = "Login Success!";
        modalInfo($class_alert, $content_notice);
        echo "<script>
            $(document).ready(function(){
                $('#modalNotice').modal('show');
                $(document).on('hide.bs.modal','#modalNotice', function () {
                    window.location.href = '/home';
                });
            });
        </script>";
    } else {
        if (!$username || !$password) {
            $error = $_SESSION['lang'] == 'english' ? 'PLEASE PUT FILL INFORMATION !' : 'VUI LÒNG NHẬP ĐẦY ĐỦ THÔNG TIN !';
        } else {
            $error = $_SESSION['lang'] == 'english' ? 'LOGIN FAIL !' : 'ĐĂNG NHẬP THẤT BẠI !';
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12" >
            <div class="title-login">
                <h2><strong><?php echo $var_login; ?></strong></h2>
                <?php
                $content = explode(".", $var_status_login);
                for ($i = 0; $i < count($content); $i++) {
                    ?>
                    <p><strong><?php echo $content[$i]; ?></strong></p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div id="error-notice"><?php echo $error; ?></div>
    <div class="row">
        <div class="col-md-12" >
            <div class="content-login">
                <div class="col-md-8" >
                    <div class="omb_login" >                   
                        <form id="loginform" class="form-horizontal" role="form" method="POST">
                            <h3 class="omb_authTitle"><?php echo $var_login; ?></h3>
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
                                        <input type="text" class="form-control" name="username" placeholder="<?php echo $_SESSION['lang'] == 'english' ? 'Username' : 'Tài khoản'; ?>">
                                    </div>
                                    <span class="help-block"></span>
                                                        
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input  type="password" class="form-control" name="password" placeholder="<?php echo $_SESSION['lang'] == 'english' ? 'Password' : 'Mật khẩu'; ?>">
                                    </div>
                                    <span class="help-block"></span>
                                    <button id="btn-to-login" name="to-login" type="submit"><?php echo $var_login; ?></button>
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
                <div class="col-md-3" >
                    <div class="panel-register">
                        <p><strong><?php echo $var_new_member; ?></strong></p>          
                        <div class="clear"></div>
                        <div class="to-register">
                            <button id="btn-to-register" type="button" onclick="window.location.href='/register';"><strong><?php echo $var_register; ?></strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

