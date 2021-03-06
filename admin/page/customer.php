<!--Breadcrumb-->
<?php include("./module/breadcrumb.php"); ?>

<!--List data-->
<div class="row">
    <div class="col-md-12">
        <?php if ($act == 'add') { ?>
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
        <?php } elseif ($act == 'edit') { ?>
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
            <?php
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
                    $class_alert    = "alert alert-danger";
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
                            <th style="width: 20%">EMAIL</th>
                            <th style="width: 30%">ADDRESS</th>
                            <th style="width: 15%">PHONE</th>
                            <th style="width: 10%">ACTION</th>
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
                        <?php foreach ($data_customer as $key => $customer) : ?>
                            <tr class="<?php echo $key % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                <td><?php echo $customer['id_customer'] ?></td>
                                <td><?php echo $customer['name'] ?></td>
                                <td><?php echo $customer['email'] ?></td>
                                <td><?php echo $customer['address'] ?></td>
                                <td><?php echo $customer['phone'] ?></td>
                                <td>
                                    <a href="index.php?page=customer&act=edit&id=<?php echo $customer['id_customer'] ?>">Edit</a> || 
                                    <a href="index.php?page=customer&act=del&id=<?php echo $customer['id_customer'] ?>">Del</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="panel filterable">
                <?php echo setPage($data_pagination['self'], $data_pagination['total'], $pp, $data_pagination['page']) ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php if ($result['name'] || $result['phone'] || $result['address'] || $result['username'] || $result['password'] || $result['confirm_password'] || $result['email'] || $result['account_exist'] || $result['fail'] || $result['error']) : ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            history.back();
        });
    </script>
<?php endif; ?>
<?php if ($result['success']) : ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            parent.location = "?page=customer";
        });
    </script>
<?php endif; ?>