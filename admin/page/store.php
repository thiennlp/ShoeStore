<?php
$id_store = intval($_GET['id']);
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb bc-no-margin">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Home</a>
            </li>
            <li class="active">
                <i class="fa fa-university"></i> Store 
            </li>
        </ol>
    </div>
</div>
<hr class="hr-no-margin">
<div class="row">
    <div class="col-md-12">
    <?php
        if ($act == 'add') {
            //-----------------Get data input-----------------------------------------------------
            $store = addslashes($_POST['dk-store']);
            $hinhanh = $_FILES['dk-image']['name'];
            $phone = $_POST['dk-phone'];
            $address = $_POST['dk-address'];
            $address_english = $_POST['dk-address-english'];
            $time = $_POST['dk-time'];
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-plus'])) {
                if (!$hinhanh || !$store || !$phone || !$address) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Please input fill info !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                        <script>
                            $('#modalNotice').modal('show');
                            $(document).on('hide.bs.modal','#modalNotice', function () {
                                history.back();
                            });
                        </script>
                    <?php
                } else {
                    $type = pathinfo($_FILES['dk-image']['name'], PATHINFO_EXTENSION);
                    $typeFileAllow = array('png','jpg','jpeg', 'gif', 'png');
                    if ($hinhanh != NULL) {
                        if (in_array($type, $typeFileAllow)){ 
                            if ($_FILES['dk-image']['size'] > 1048576){
                                $class_alert = "alert alert-danger";
                                $content_notice = "File size > 1Mb !";
                                modalInfo($class_alert, $content_notice);
                                ?>
                                    <script>
                                        $('#modalNotice').modal('show');
                                    </script>
                                <?php
                            } else {
                                $path = "data/store/";
                                $tmp_name = $_FILES['dk-image']['tmp_name'];
                                $name = basename(md5($_FILES['dk-image']['name'].time()).".".$type);
                                $hinhanh = $path.$name;
                                // Move file ---------------------------------------------------------------------------
                                move_uploaded_file($tmp_name,$hinhanh);				
                                // Upload file -----------------------------------------------------------------------------
                                $insert_store = insertData("store", "store, image, phone, address, address_english, time", "'".$store."','".$hinhanh."','".$phone."','".$address."','".$address_english."','".$time."'");
                                if ($insert_store) {
                                    $class_alert = "alert alert-success";
                                    $content_notice = "Done !";
                                    modalInfo($class_alert, $content_notice);
                                    ?>
                                        <script>
                                            $('#modalNotice').modal('show');
                                            $(document).on('hide.bs.modal','#modalNotice', function () {
                                                parent.location = "?page=store";
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
                                            $(document).on('hide.bs.modal','#modalNotice', function () {
                                                history.back();
                                            });
                                        </script>
                                    <?php
                                }
                            }
                        } else {
                            $class_alert = "alert alert-danger";
                            $content_notice = "File not apply !";
                            modalInfo($class_alert, $content_notice);
                            ?>
                                <script>
                                    $('#modalNotice').modal('show');
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
                        <h3 class="panel-title">STORE</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-store">Store :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="dk-store" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-image">Image :</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="dk-image" id="dk-image" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-phone">Phone :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="dk-phone" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-address">Address (VN) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-address" style="height: 100px; "></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-address-english">Address (ENG) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-address-english" style="height: 100px; "></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-time">Time :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-time" style="height: 300px; "></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-save"></label>
                                    <div class="col-sm-5">
                                        <button type="submit" name="btn-plus" class="btn btn-primary">Save</button>
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
            $store = addslashes($_POST['dk-store']);
            $phone = $_POST['dk-phone'];
            $address = $_POST['dk-address'];
            $address_english = $_POST['dk-address-english'];
            $time = $_POST['dk-time'];
            //-------------------Get data from row have selected--------------------------------------------------------
            if ($id_store) {
                $row_store =  selectData("store", "id_store = '".$id_store."'", "*");
            }
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-update'])) {
                if (!$store || !$phone || !$address) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Please input fill info !";
                    modalInfo($class_alert, $content_notice);
                    ?>
                        <script>
                            $('#modalNotice').modal('show');
                            $(document).on('hide.bs.modal','#modalNotice', function () {
                                history.back();
                            });
                        </script>
                    <?php
                } else {
                    $hinhanh = $_FILES['dk-image']['name'];
                    $type = pathinfo($_FILES['dk-image']['name'], PATHINFO_EXTENSION);
                    $typeFileAllow = array('png','jpg','jpeg', 'gif', 'png');
                    if ($hinhanh != NULL) {
                        if (in_array($type, $typeFileAllow)){ 
                            if ($_FILES['dk-image']['size'] > 1048576){
                                $class_alert = "alert alert-danger";
                                $content_notice = "File size > 1Mb !";
                                modalInfo($class_alert, $content_notice);
                                ?>
                                    <script>
                                        $('#modalNotice').modal('show');
                                    </script>
                                <?php
                            } else {
                                $path = "data/store/";
                                $tmp_name = $_FILES['dk-image']['tmp_name'];
                                $name = basename(md5($_FILES['dk-image']['name'].time()).".".$type);
                                $hinhanh = $path.$name;
                                // Move file ---------------------------------------------------------------------------
                                move_uploaded_file($tmp_name,$hinhanh);				
                                // Upload file -----------------------------------------------------------------------------
                            }
                        } else {
                            $class_alert = "alert alert-danger";
                            $content_notice = "File not apply !";
                            modalInfo($class_alert, $content_notice);
                            ?>
                                <script>
                                    $('#modalNotice').modal('show');
                                </script>
                            <?php
                        }
                    } else {
                        $hinhanh = $row_store[0][2];
                    }
                    $update_store = updateData("store", "store='".$store."', image='".$hinhanh."', phone='".$phone."', address='".$address."', address_english='".$address_english."', time='".$time."'", "id_store = '".$id_store."'");
                    if ($update_store) {
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
                        $content_notice = $mysqli->error;
                        modalInfo($class_alert, $content_notice);
                        ?>
                            <script>
                                $('#modalNotice').modal('show');
                                $(document).on('hide.bs.modal','#modalNotice', function () {
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
                        <h3 class="panel-title">STORE</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-store">Store :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="dk-store" value="'.$row_store[0][1].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-image">Image :</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="dk-image" id="dk-image" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-phone">Phone :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="dk-phone" value="'.$row_store[0][3].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-address">Address (VN) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-address" style="height: 100px; ">'.$row_store[0][4].'</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-address-english">Address (ENG) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-address-english" style="height: 100px; ">'.$row_store[0][5].'</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-time">Time :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-time" style="height: 300px; ">'.$row_store[0][6].'</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-save"></label>
                                    <div class="col-sm-5">
                                        <button type="submit" name="btn-update" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="hr-no-margin">
            ';
        }  elseif ($act == 'del') {
            if ($id_store > 0) {
                modalConfirm("store", "$id_store = '".$id_store."'", "?page=store");
                ?>
                    <script>
                        $('#modalConfirm').modal('show');
                    </script>
                <?php
            } 
        } else {
            ?>
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title"><a class="link-plus" href="?page=store&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST STORE</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 5%">ID</th>
                            <th style="width: 30%">STORE</th>
                            <th style="width: 20%">IMAGE</th>
                            <th style="width: 15%">PHONE</th>
                            <th style="width: 20%">ADDRESS</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data =  selectData("store", "1=1", "*");
                            for ($i = 0; $i < count($data); $i++) {
                                ?>
                                <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                    <td><?php echo $data[$i][0] ?></td>
                                    <td><?php echo $data[$i][1] ?></td>
                                    <td><img class="image-banner" src="<?php echo $data[$i][2]; ?>"></td>
                                    <td><?php echo $data[$i][3] ?></td>
                                    <td><?php echo $data[$i][4] ?></td>
                                    <td><a href="index.php?page=store&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> ||
                                        <a href="index.php?page=store&act=del&id=<?php echo $data[$i][0]; ?>">Delete</a></td>
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