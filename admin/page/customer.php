<?php include("./module/breadcrumb.php"); ?>
<?php
$id_customer = intval($_GET['id']);
$class_alert;
$content_notice;
?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($act == 'add') {
            //-----------------Get data input-----------------------------------------------------
            $name = $_POST['dk-name'];
            $email = $_POST['dk-email'];
            $phone = $_POST['dk-phone'];
            $address = $_POST['dk-address'];
            $username = $_POST['dk-usrname'];
            $password = md5($_POST['dk-psw']);
            $permission = $_POST['permission'];
            $confirm = md5($_POST['dk-confirm']);
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-plus'])) {
                $row_account = selectData("account", "username = '" . $username . "'", "username");
                if (!$name || !$phone || !$address || !$username || !$password) {
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
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } else {
                    $insert_account = insertData("account", "username, password, permission", "'" . $username . "','" . $password . "','" . $permission . "'");
                    if ($insert_account) {
                        $id_account = selectData("account", "username = '" . $username . "' AND password = '" . $password . "'", "id_account");
                        if ($id_account) {
                            $insert_customer = insertData("customer", "name, email, phone, address, id_account", "'" . $name . "','" . $email . "','" . $phone . "','" . $address . "','" . $id_account[0][0] . "'");
                            if ($insert_customer) {
                                $class_alert = "alert alert-success";
                                $content_notice = "Done !";
                                modalInfo($class_alert, $content_notice);
                                ?>
                                <script>
                                    $('#modalNotice').modal('show');
                                </script>
                                <?php
                            } else {
                                $class_alert = "alert alert-danger";
                                $content_notice = "Register fail !";
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
                        <h3 class="panel-title">CUSTOMER INFORMATION</h3>
                    </div>
                    <div>
                        <form role="form" method="post" class="form-horizontal">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#info-customer">PERSONAL</a></li>
                                <li><a href="#info-account">ACCOUNT</a></li>
                            </ul>
                            <div id="info-customer" class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-name">Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="dk-name" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-email">E-mail:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="dk-email" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-phone">Phone :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required-next-1" name="dk-phone" placeholder="">
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
                                        <input type="text" class="form-control required-next-3" name="dk-usrname" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-psw">Password :</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required-next-4" name="dk-psw" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="confirm-psw">Confirm :</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required-next-5" name="dk-confirm" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-permission">Permission :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="permission">
                                            <option value="admin" disabled>Admin</option>
                                            <option value="customer">Customer</option>
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
            //-----------------Get data input-----------------------------------------------------
            $name = $_POST['dk-name'];
            $email = $_POST['dk-email'];
            $phone = $_POST['dk-phone'];
            $address = $_POST['dk-address'];
            $username = $_POST['dk-usrname'];
            $password = md5($_POST['dk-psw']);
            $permission = $_POST['permission'];
            $confirm = md5($_POST['dk-confirm']);
            //-------------------Get data from row have selected--------------------------------------------------------
            if ($id_customer) {
                $row_customer = selectData("customer", "id_customer = '" . $id_customer . "'", "*");
                $id_account = $row_customer[0][5];
            }
            if ($id_account) {
                $row_account = selectData("account", "id_account = '" . $id_account . "'", "*");
            }
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-update'])) {
                if (!$name || !$phone || !$address || !$username || !$password) {
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
                    $content_notice = "confirm password wrong !";
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
                    $content_notice = "E-mail fail ! !";
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
                        $(document).on('hide.bs.modal', '#modalNotice', function () {
                            history.back();
                        });
                    </script>
                    <?php
                } else {
                    $id_account = selectData("customer", "id_customer = '" . $id_customer . "'", "id_account");
                    if ($id_account) {
                        $update_account = updateData("account", "username='" . $username . "', password='" . $password . "', permission='" . $permission . "'", "id_account = '" . $id_account[0][0] . "'");
                        if ($update_account) {
                            $update_customer = updateData("customer", "name='" . $name . "', email='" . $email . "', phone='" . $phone . "', address='" . $address . "'", "id_customer = '" . $id_customer . "'");
                            if ($update_customer) {
                                $class_alert = "alert alert-success";
                                $content_notice = "Done !";
                                modalInfo($class_alert, $content_notice);
                                ?>
                                <script>
                                    $('#modalNotice').modal('show');
                                    $(document).on('hide.bs.modal', '#modalNotice', function () {
                                        parent.location = "?page=customer";
                                    });
                                </script>
                                <?php
                            } else {
                                $class_alert = "alert alert-danger";
                                $content_notice = "Update fail !";
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
            //----------------------Form for input information--------------------------------------
            echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">CUSTOMER INFORMATION</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#info-customer">PERSONAL</a></li>
                                <li><a href="#info-account">ACCOUNT</a></li>
                            </ul>
                            <div id="info-customer"  class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-name">Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="dk-name" value="' . $row_customer[0][1] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-email">E-mail:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="dk-email" value="' . $row_customer[0][2] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-phone">Phone :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required-next-1" name="dk-phone" value="' . $row_customer[0][3] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-address">Address :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-address" style="height: 100px; ">' . $row_customer[0][4] . '</textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="info-account" class="tab-pane info-register fade">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-usrname">Username :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required-next-3" name="dk-usrname" value="' . $row_account[0][1] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-psw">Password :</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required-next-4" name="dk-psw" value="' . $row_account[0][2] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="confirm-psw">Confirm :</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control required-next-5" name="dk-confirm" value="' . $row_account[0][2] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-permission">Permission :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="permission">
                                            <option value="admin" disabled>Admin</option>
                                            <option value="customer">Customer</option>
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
            if ($id_customer > 0) {
                $id_account = selectData("customer", "id_customer = '" . $id_customer . "'", "id_account");
                if ($id_account) {
                    $del_account = deleteData("account", "id_account = '" . $id_account[0][0] . "'");
                    if ($del_account) {
                        modalConfirm("customer", "id_customer = '" . $id_customer . "'", "?page=customer");
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
                    <h3 class="panel-title"><a class="link-plus" href="?page=customer&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST CUSTOMER</h3>
                    <div class="pull-right">
                        <button id="searchUser" class="btn btn-default btn-xs btn-search"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 5%">ID</th>
                            <th style="width: 20%">NAME</th>
                            <th style="width: 20%">EAMIL</th>
                            <th style="width: 30%">ADDRESS</th>
                            <th style="width: 15%">PHONE</th>
                            <th style="width: 10%"></th>
                        </tr>
                        <tr class="tr-search">
                            <th style="width: 10%"><input type="text" class="form-control" placeholder="ID" disabled></th>
                            <th style="width: 20%"><input type="text" class="form-control" placeholder="Name" disabled></th>
                            <th style="width: 20%"></th>
                            <th style="width: 25%"><input type="text" class="form-control" placeholder="Address" disabled></th>
                            <th style="width: 15%"><input type="text" class="form-control" placeholder="Phone" disabled></th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data_total = selectData("customer", "1=1", "*");
                        //-----------------------PHÂN TRANG---------------------------------------//
                        $total = count($data_total);
                        $numofpages = $total / $pp_customer;
                        if ($trang <= 0) {
                            $page = 1;
                        } else {
                            if ($trang <= ceil($numofpages))
                                $page = $trang;
                            else
                                $page = 1;
                        }
                        $limitvalue = ($page * $pp_customer) - $pp_customer;
                        $self = "index.php?page=customer&trang=";
                        //-----------------------PHÂN TRANG---------------------------------------//
                        $data = selectData("customer", "1=1 LIMIT $limitvalue,$pp_customer", "*");
                        for ($i = 0; $i < count($data); $i++) {
                            ?>
                            <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                <td><?php echo $data[$i][0] ?></td>
                                <td><?php echo $data[$i][1] ?></td>
                                <td><?php echo $data[$i][2] ?></td>
                                <td><?php echo $data[$i][3] ?></td>
                                <td><?php echo $data[$i][4] ?></td>
                                <td><a href="index.php?page=customer&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> || 
                                    <a href="index.php?page=customer&act=del&id=<?php echo $data[$i][0]; ?>">Del</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="panel filterable">
                <?php echo setPage($self, $total, $pp, $page) ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<!-- /.row -->