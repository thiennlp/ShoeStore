<?php include("./module/breadcrumb.php"); ?>
<?php $id_user = intval($_GET['id']); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($act == 'add') {
            //-----------------Get data input-----------------------------------------------------
            $name = $_POST['dk-name'];
            $sex = $_POST['dk-sex'];
            $birthday = $_POST['dk-birthday'];
            $phone = $_POST['dk-phone'];
            $address = $_POST['dk-address'];
            $username = $_POST['dk-usrname'];
            $password = md5($_POST['dk-psw']);
            $permission = $_POST['dk-permission'];
            $confirm = md5($_POST['dk-confirm']);
            //-----------------Event click Edit-----------------------------------------------------
            if (isset($_POST['btn-plus'])) {
                $row_account = selectData("account", "username = '" . $username . "'", "username");
                if (!$name || !$phone || !$username || !$password) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Please input fill info !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                    <script>
                        $('#modalNotice').modal('show');
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } elseif ($password != $confirm) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Confirm password wrong !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                    <script>
                        $('#modalNotice').modal('show');
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } elseif ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "E-mail wrong ! !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                    <script>
                        $('#modalNotice').modal('show');
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } elseif ($row_account[0][0] == $username) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Account is exist !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                    <script>
                        $('#modalNotice').modal('show');
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } elseif (strlen($password) < 8) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Password need more than 8 characters !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                    <script>
                        $('#modalNotice').modal('show');
                    </script>
                    <?php
                } else {
                    $insert_account = insertData("account", "username, password, permission", "'" . $username . "','" . $password . "','" . $permission . "'");
                    if ($insert_account) {
                        $id_account = selectData("account", "username = '" . $username . "' AND password = '" . $password . "'", "id_account");
                        if ($id_account) {
                            $insert_user = insertData("user", "name, sex, birthday, address, phone, id_account", "'" . $name . "', '" . $sex . "','" . $birthday . "','" . $address . "','" . $phone . "','" . $id_account[0][0] . "'");
                            if ($insert_user) {
                                $class_alert = "alert alert-success";
                                $content_notice = "Done !";
                                modalInfo($class_alert, $content_notice);
                                ?>
                                <script>
                                    $('#modalNotice').modal('show');
                                    $(document).on('hide.bs.modal', '#modalNotice', function () {
                                        location.reload(true);
                                    });
                                </script>
                                <?php
                            } else {
                                $class_alert = "alert alert-danger";
                                $content_notice = "register fail !";
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
            //----------------------Form for input information--------------------------------------
            echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">USER INFORMATION</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#info-indiv">PERSONAL</a></li>
                                <li><a href="#info-account">ACCOUNT</a></li>
                            </ul>
                            <div id="info-indiv" class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-name">Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="dk-name" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-sex"> Sex : </label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline"><input type="radio" name="dk-sex" value="Nam" checked>Male</label>
                                        <label class="radio-inline"><input type="radio" name="dk-sex" value="Nu">Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-birthday">Birthday :</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="dk-birthday" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-phone">Phone :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required-next-1" name="dk-phone" id="dk-phone" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-address">Address :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-address" style="height: 100px; "></textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="info-account" class="tab-pane info-register fade">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-usrname">Username :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required-next-2" name="dk-usrname" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-psw">Passwrod :</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required-next-3" name="dk-psw" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-confirm">Confirm :</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required-next-4" name="dk-confirm" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-permission">Permission :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="dk-permission">
                                            <option value="admin">Admin</option>
                                            <option value="customer" disabled>Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-save"></label>
                                    <div class="col-sm-8">
                                        <button type="submit" name="btn-plus" class="btn btn-primary">Save</button>
                                        <button id="btnClear" type="button" name="btn-clear" class="btn btn-default">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="hr-no-margin">
            ';
        } elseif ($act == 'edit') {
            //-------------------Get data from row have selected--------------------------------------------------------
            if ($id_user) {
                $row_user = selectData("user", "id = '" . $id_user . "'", "*");
                $id_account = $row_user[0][6];
            }
            if ($id_account) {
                $row_account = selectData("account", "id_account = '" . $id_account . "'", "*");
            }
            //-----------------------Get data from database that match with row have selected------------------------------------
            //------------------------Sex-------------------------------------------
            if ($row_user[0][2] == 'Nam') {
                $sex_selected .= '<label class="radio-inline"><input type="radio" name="dk-sex" checked value="Nam">Male</label>
                            <label class="radio-inline"><input type="radio" name="dk-sex" value="Nu">Female</label>';
            } else {
                $sex_selected .= '<label class="radio-inline"><input type="radio" name="dk-sex" value="Nam">Male</label>
                            <label class="radio-inline"><input type="radio" name="dk-sex" checked value="Nu">Female</label>';
            }
            //-----------------Get data input-----------------------------------------------------
            $name = $_POST['dk-name'];
            $sex = $_POST['dk-sex'];
            $birthday = $_POST['dk-birthday'];
            $phone = $_POST['dk-phone'];
            $address = $_POST['dk-address'];
            $username = $_POST['dk-usrname'];
            $password = md5($_POST['dk-psw']);
            $permission = $_POST['dk-permission'];
            $confirm = md5($_POST['dk-confirm']);
            //-----------------Event click Edit-----------------------------------------------------
            if (isset($_POST['btn-update'])) {
                $row_account = selectData("account", "username = '" . $username . "'", "username");
                if (!$name || !$phone || !$username || !$password) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Please input fill info !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                    <script>
                        $('#modalNotice').modal('show');
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } elseif ($password != $confirm) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Confirm password wrong !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                    <script>
                        $('#modalNotice').modal('show');
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } elseif ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "E-mail wrong ! !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                    <script>
                        $('#modalNotice').modal('show');
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } elseif (strlen($password) < 8) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Pasword need more than 8 characters !";
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
                    $id_account = selectData("user", "id = '" . $id_user . "'", "id_account");
                    if ($id_account) {
                        $update_account = updateData("account", "username='" . $username . "', password='" . $password . "', permission='" . $permission . "'", "id_account = '" . $id_account[0][0] . "'");
                        if ($update_account) {
                            $update_user = updateData("user", "name='" . $name . "', sex='" . $sex . "', birthday='" . $birthday . "', address='" . $address . "', phone='" . $phone . "'", "id = '" . $id_user . "'");
                            if ($update_user) {
                                $class_alert = "alert alert-success";
                                $content_notice = "Done !";
                                modalInfo($class_alert, $content_notice);
                                ?>
                                <script>
                                    $('#modalNotice').modal('show');
                                    $(document).on('hide.bs.modal', '#modalNotice', function () {
                                        parent.location = "?page=user";
                                    });
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
                }
            }
            //----------------------Form for input information--------------------------------------
            echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">USER INFORMATION</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#info-indiv">PERSONAL</a></li>
                                <li><a href="#info-account">ACCOUNT</a></li>
                            </ul>
                            <div id="info-indiv" class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-name">Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="dk-name" value="' . $row_user[0][1] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-sex"> Sex : </label>
                                    <div class="col-sm-8">
                                        ' . $sex_selected . '
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-birthday">Birthday :</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="dk-birthday" value="' . $row_user[0][3] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-phone">Phone :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required-next-1" name="dk-phone" value="' . $row_user[0][5] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-address">Address :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-address" style="height: 100px; ">' . $row_user[0][4] . '</textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="info-account" class="tab-pane info-register fade">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-usrname">Username :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required-next-2" name="dk-usrname" value="' . $row_account[0][1] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-psw">Password :</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required-next-3" name="dk-psw" value="' . $row_account[0][2] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-confirm">Confirm :</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required-next-4" name="dk-confirm" value="' . $row_account[0][2] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-permission">Permission :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="dk-permission">
                                            <option value="admin">Admin</option>
                                            <option value="customer" disabled>Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-save"></label>
                                    <div class="col-sm-8">
                                        <button type="submit" name="btn-update" class="btn btn-primary">Save</button>
                                        <button id="btnClear" type="button" name="btn-clear" class="btn btn-default">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="hr-no-margin">
            ';
        } elseif ($act == 'del') {
            if ($id_user > 0) {
                $id_account = selectData("user", "id = '" . $id_user . "'", "id_account");
                if ($id_account) {
                    $del_account = deleteData("account", "id_account = '" . $id_account[0][0] . "'");
                    if ($del_account) {
                        modalConfirm("user", "id = '" . $id_user . "'", "?page=user");
                        ?>
                        <script>
                            $('#modalConfirm').modal('show');
                        </script>
                        <?php
                    }
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
        } else {
            ?>
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title"><a class="link-plus" href="?page=user&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST USER</h3>
                    <div class="pull-right">
                        <button id="searchUser" class="btn btn-default btn-xs btn-search"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">NAME</th>
                            <th style="width: 10%">SEX</th>
                            <th style="width: 15%">BIRTHDAY</th>
                            <th style="width: 30%">ADDRESS</th>
                            <th style="width: 15%">PHONE</th>
                            <th style="width: 10%"></th>
                        </tr>
                        <tr class="tr-search">
                            <th style="width: 10%"><input type="text" class="form-control" placeholder="ID" disabled></th>
                            <th style="width: 20%"><input type="text" class="form-control" placeholder="Name" disabled></th>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>
                            <th style="width: 25%"><input type="text" class="form-control" placeholder="Address" disabled></th>
                            <th style="width: 15%"><input type="text" class="form-control" placeholder="Phone" disabled></th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = selectData("user", "1=1", "*");
                        for ($i = 0; $i < count($data); $i++) {
                            ?>
                            <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                <td><?php echo $data[$i][0] ?></td>
                                <td><?php echo $data[$i][1] ?></td>
                                <td><?php echo $data[$i][2] ?></td>
                                <td><?php echo $data[$i][3] ?></td>
                                <td><?php echo $data[$i][4] ?></td>
                                <td><?php echo $data[$i][5] ?></td>
                                <td><a href="index.php?page=user&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> || 
                                    <a href="index.php?page=user&act=del&id=<?php echo $data[$i][0]; ?>">Del</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr class="hr-no-margin">
            <?php
        }
        ?>
    </div>
</div>
<!-- /.row -->