<?php include("./module/breadcrumb.php"); ?>
<?php
$id_size = intval($_GET['id']);
$id_mode = $_GET['mode'];
?>
<div class="row">
    <div class="col-md-12">
    <?php
        if ($act == 'add') {
            $mode = 'combo';
            if (isset($_POST['btn-text'])) {
                $mode = 'text';
            } elseif (isset($_POST['btn-select'])) {
                $mode = 'combo';
            }
            $data_size = selectData("size", "1=1", "DISTINCT type_size");
            for ($i = 0; $i < count($data_size); $i++) {
                $option_size .= '<option value="'.$data_size[$i][0].'">'.$data_size[$i][0].'</option>';
            }
            //-----------------Get data input-----------------------------------------------------
            $size = $_POST['dk-size'];
            $type = $_POST['dk-type'];
            //-----------------Event click Add-----------------------------------------------------
            if(isset($_POST['btn-plus'])) {
                if (!$size || !$type) {
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
                    $insert_size = insertData("size", "size, type_size", "'".$size."','".$type."'");
                    if ($insert_size) {
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
                        <h3 class="panel-title">SIZE</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-size">Size :</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control required" name="dk-size" id="dk-size" placeholder="">
                                    </div>
                                </div>';
                                if ($mode == 'combo') {
                                    echo '
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="dk-type">Type :</label>
                                        <div class="col-sm-5">
                                            <select class="item-cbb" name="dk-size">
                                                '.$option_size.'
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" name="btn-text" class="btn btn-primary">Input</button>
                                        </div>
                                    </div>';

                                } elseif ($mode == 'text') {
                                    echo '
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="dk-type">Type :</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="dk-type" id="dk-type" placeholder="">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" name="btn-select" class="btn btn-primary">Select</button>
                                        </div>
                                    </div>';
                                }
                                echo '
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
            //-------------------Get data from row have selected--------------------------------------------------------
            if($id_size) {
                $row_size =  selectData("size", "id_size = '".$id_size."'", "*");
            }
            $data_size = selectData("size", "1=1", "DISTINCT type_size");
            for ($i = 0; $i < count($data_size); $i++) {
                if ($row_size[0][2] == $data_size[$i][0]) {
                    $r[$i] = 'selected';
                }
                $option_size .= '<option '.$r[$i].' value="'.$data_size[$i][0].'">'.$data_size[$i][0].'</option>';
            }
            //-----------------Get data input-----------------------------------------------------
            $size = $_POST['dk-size'];
            $type = $_POST['dk-type'];
            //-----------------Event click Edit-----------------------------------------------------
            if(isset($_POST['btn-update'])) {
                if (!$size || !$type) {
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
                    if ($id_size) {
                        $update_size = updateData("size", "size='".$size."', type_size='".$type."'", "id_size = '".$id_size."'");
                        if ($update_size) {
                            $class_alert = "alert alert-success";
                            $content_notice = "Done !";
                            modalInfo($class_alert, $content_notice);
                            ?>
                                <script>
                                    $('#modalNotice').modal('show');
                                    $(document).on('hide.bs.modal','#modalNotice', function () {
                                        parent.location = "?page=size";
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
                }
            }
            //----------------------Form for input information--------------------------------------
            echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">SIZE</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-size">Size :</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control required" name="dk-size" id="dk-size" value="'.$row_size[0][1].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-type">Type :</label>
                                    <div class="col-sm-5">
                                        <select class="item-cbb" name="dk-size">
                                            '.$option_size.'
                                        </select>
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
        } elseif ($act == 'del') {
            if ($id_size > 0) {
                modalConfirm("size", "id_size = '".$id_size."'", "?page=size");
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
                    <h3 class="panel-title"><a class="link-plus" href="?page=size&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST SIZE</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 20%">ID</th>
                            <th style="width: 30%">SIZE</th>
                            <th style="width: 30%">TYPE</th>
                            <th style="width: 20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data =  selectData("size", "1=1 ORDER BY type_size", "*");
                            for ($i = 0; $i < count($data); $i++) {
                                ?>
                                <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                    <td><?php echo $data[$i][0] ?></td>
                                    <td><?php echo $data[$i][1] ?></td>
                                    <td><?php echo $data[$i][2] ?></td>
                                    <td><a href="index.php?page=size&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> || 
                                        <a href="index.php?page=size&act=del&id=<?php echo $data[$i][0]; ?>">Delete</a></td>
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