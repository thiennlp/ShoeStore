<?php
if (isset($_POST['btn-login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (!$username || !$password) {
        $class_alert = "alert alert-danger";
        $content_notice = "Please input fill info login !";
        modalInfo($class_alert, $content_notice);
        ?>
        <script>
            $('#modalNotice').modal('show');
            $(document).on('hide.bs.modal', '#modalNotice', function () {
                history.back();
            });
        </script>
        <?php
    } else {
        $account = selectData("account", "username = '" . $username . "' AND password = '" . $password . "'", "*");
        if ($account) {
            $_SESSION['user'] = true;
            $_SESSION['user'] = $account[0][0];
            ?>
            <script>
                parent.location = "?page=banner";
            </script>
            <?php
        } else {
            $class_alert = "alert alert-danger";
            $content_notice = $mysqli->error;
            modalInfo($class_alert, $content_notice);
            ?>
            <script>
                $('#modalNotice').modal('show');
                $(document).on('hide.bs.modal', '#modalNotice', function () {
                    history.back();
                });
            </script>
            <?php
        }
    }
}
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand title-home" href="#">Admin - ZAC & JEAN Collection's</a>
    </div>
    <!-- /.navbar-header -->
</nav>
<div class="page-blank">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
            </div>
            <!-- Page Heading -->
            <div class="col-md-8 panel panel-primary panel-login">
                <div class="panel-heading">
                    <h4 class="title-checkout"><strong>LOGIN</strong></h4>
                </div>
                <div>
                    <form role="form" method="POST" id="loginForm">
                        <div class="row omb_row-sm-offset-3">
                            <div class="col-md-12">	
                                <div class="col-md-12 input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                                <span class="help-block"></span>

                                <div class="col-md-12 input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input  type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <span class="help-block"></span>
                                <div class="col-md-12 input-group">
                                    <button name="btn-login" type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span> LOGIN</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>