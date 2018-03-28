<?php include("./module/breadcrumb.php"); ?>
<?php
$id_object = intval($_GET['id']);
?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($act == 'add') {
            $count = 4;
            //-----------------Get data input-----------------------------------------------------
            $object = $_POST['dk-object'];
            $object_english = $_POST['dk-object-english'];
            $age = $_POST['dk-age'];
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-plus'])) {
                $row_object = selectData("object", "object = '" . $object . "'", "object");
                if (!$object || !$age) {
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
                } elseif ($object == $row_object[0][0]) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Object is exist !";
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
                    $insert_object = insertData("object", "object, object_english", "'" . $object . "', '" . $object_english . "'");
                    if ($insert_object) {
                        $id_object = selectData("object", "object = '" . $object . "'", "id_object");
                        if ($id_object) {
                            $insert_age = insertData("age", "age, id_object", "'" . $age . "', '" . $id_object[0][0] . "'");
                            for ($i = 0; $i < $count; $i++) {
                                $age_next = $_POST['dk-age-next'][$i];
                                if ($age_next) {
                                    insertData("age", "age, id_object", "'" . $age_next . "', '" . $id_object[0][0] . "'");
                                }
                            }
                        }
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
                        <h3 class="panel-title">OBJECT</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-object">Object :</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control required" name="dk-object" placeholder="Vietnamese">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control required" name="dk-object-english" placeholder="English">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-age">Ages :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control required-next-1" name="dk-age" placeholder="Input ages (example 1 - 5 age)">
                                    </div>
                                </div>
                                ';
            for ($i = 0; $i < $count; $i++) {
                echo '
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="dk-age"></label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="dk-age-next[]" placeholder="Input ages (example 1 - 5 age)">
                                            </div>
                                        </div>
                                    ';
            }
            echo '
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-save"></label>
                                    <div class="col-sm-6">
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
        } elseif ($act == 'del') {
            if ($id_object > 0) {
                $data_age = selectData("age", "id_object = '" . $id_object . "'", "id_age");
                for ($i = 0; $i < count($data_age); $i++) {
                    deleteData("age", "id_age = '" . $data_age[$i][0] . "'");
                }

                modalConfirm("object", "id_object = '" . $id_object . "'", "?page=object");
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
                    <h3 class="panel-title"><a class="link-plus" href="?page=object&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST OBJECT</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 10%">ID</th>
                            <th style="width: 20%">OBJECT (VN)</th>
                            <th style="width: 20%">OBJECT (ENG)</th>
                            <th style="width: 40%"></th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    $data = selectData("object", "1=1", "*");
    for ($i = 0; $i < count($data); $i++) {
        ?>
                            <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                <td><?php echo $data[$i][0] ?></td>
                                <td><?php echo $data[$i][1] ?></td>
                                <td><?php echo $data[$i][2] ?></td>
                                <td>
        <?php
        $data_age = selectData("age", "id_object = '" . $data[$i][0] . "'", "age");
        if (count($data_age) > 0) {
            ?>
                                        </br>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Age</th>
                                                </tr>
                                            </thead>
                                            <tbody>
            <?php
            for ($j = 0; $j < count($data_age); $j++) {
                ?>
                                                    <tr class="<?php echo $j % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                                        <td><?php echo $data_age[$j][0] ?></td>
                                                    </tr>
                <?php
            }
            ?>
                                            </tbody>
                                        </table>
            <?php
        }
        ?>
                                </td>
                                <td><a href="index.php?page=object&act=del&id=<?php echo $data[$i][0]; ?>">Delete</a></td>
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