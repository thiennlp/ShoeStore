<div class="page-blank">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
            </div>
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

<?php if ($notify_page_home) : ?>
    <!--Notice-->
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            history.back();
        });
    </script>
    <!--/Notice-->
<?php endif; ?>