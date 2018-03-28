<?php include("./module/breadcrumb.php"); ?>
<?php
$id_category = intval($_GET['id']);
if (isset($_GET['level'])) {
    $level = $_GET['level'];
}
?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($act == 'add') {
            $category = addslashes($_POST['dk-category']);
            $category_english = addslashes($_POST['dk-category-english']);
            $hinhanh = $_FILES['dk-image']['name'];
            $level = $_POST['dk-level'];
            if (isset($_POST['btn-plus'])) {
                if (!$category || !$hinhanh) {
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
                } else {
                    $type = pathinfo($_FILES['dk-image']['name'], PATHINFO_EXTENSION);
                    $typeFileAllow = array('png', 'jpg', 'jpeg', 'gif', 'png');
                    if ($hinhanh != NULL) {
                        if (in_array($type, $typeFileAllow)) {
                            if ($_FILES['dk-image']['size'] > 1048576) {
                                $class_alert = "alert alert-danger";
                                $content_notice = "File size > 1Mb !";
                                modalInfo($class_alert, $content_notice);
                                ?>
                                <script>
                                    $('#modalNotice').modal('show');
                                </script>
                                <?php
                            } else {
                                $path = "data/category/";
                                $tmp_name = $_FILES['dk-image']['tmp_name'];
                                $name = basename(md5($_FILES['dk-image']['name'] . time()) . "." . $type);
                                $hinhanh = $path . $name;
                                // Move file ---------------------------------------------------------------------------
                                move_uploaded_file($tmp_name, $hinhanh);
                                // Upload file -----------------------------------------------------------------------------
                                $insert_category = insertData("category", "category, category_english, image, is_display, level", "'" . $category . "','" . $category_english . "','" . $hinhanh . "', 1,'" . $level . "'");
                                if ($insert_category) {
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
            ?>
            <!--Form add-->          
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">CATEGORY</h3>
                </div>
                <div>
                    <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="tab-pane info-register fade in active">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-category">Category:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control required" name="dk-category" placeholder="Vietnamese">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="dk-category-english" placeholder="English">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-image">Poster:</label>
                                <div class="col-sm-8">
                                    <input type="file" name="dk-image" id="dk-image"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-level">Level:</label>
                                <div class="col-sm-8">
                                    <?php $arr_option_category = selectData("category", "level = 0", "id_category, category") ?>
                                    <select class="item-cbb" name="dk-level">
                                        <option value="0">-- Danh mục gốc --</option>
                                        <?php foreach ($arr_option_category as $option) : var_dump($option); ?>
                                            <option value="<?php echo $option['id_category'] ?>">-- <?php echo $option['category'] ?> --</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-save"></label>
                                <div class="col-sm-8">
                                    <button type="submit" name="btn-plus" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="hr-no-margin">
            <!--/Form add-->
            <?php
        } elseif ($act == 'edit') {
            if ($id_category) {
                $row = selectData("category", "id_category = '" . $id_category . "'", "*");
            }
            $datadm = selectData("category", "level = 0", "*");
            for ($i = 0; $i < count($datadm); $i++) {
                if ($row[0][5] == $datadm[$i][0]) {
                    $r[$i] = 'selected';
                }
                $option_category .= '<option ' . $r[$i] . ' value="' . $datadm[$i][0] . '">' . $datadm[$i][1] . '</option>';
            }
            if ($row[0][4] == 1) {
                $display .= '<input type="checkbox" name="dk-display" checked data-toggle="toggle">';
            } else {
                $display .= '<input type="checkbox" name="dk-display" data-toggle="toggle">';
            }
            $category = addslashes($_POST['dk-category']);
            $category_english = addslashes($_POST['dk-category-english']);
            $is_display = $row[0][4];
            $level = $_POST['dk-level'];
            if (isset($_POST['btn-update'])) {
                if ($id_category) {
                    if (!$category) {
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
                    } else {
                        $hinhanh = $_FILES['dk-image']['name'];
                        $type = pathinfo($_FILES['dk-image']['name'], PATHINFO_EXTENSION);
                        $typeFileAllow = array('png', 'jpg', 'jpeg', 'gif', 'png');
                        if ($hinhanh != NULL) {
                            if (in_array($type, $typeFileAllow)) {
                                if ($_FILES['dk-image']['size'] > 1048576) {
                                    $class_alert = "alert alert-danger";
                                    $content_notice = "File size > 1Mb !";
                                    modalInfo($class_alert, $content_notice);
                                    ?>
                                    <script>
                                        $('#modalNotice').modal('show');
                                    </script>
                                    <?php
                                } else {
                                    $path = "data/category/";
                                    $tmp_name = $_FILES['dk-image']['tmp_name'];
                                    $name = basename(md5($_FILES['dk-image']['name'] . time()) . "." . $type);
                                    $hinhanh = $path . $name;
                                    move_uploaded_file($tmp_name, $hinhanh);
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
                            $hinhanh = $row[0][3];
                        }
                        $update_category = updateData("category", "category='" . $category . "', category_english='" . $category_english . "', image='" . $hinhanh . "', is_display='" . $is_display . "', level='" . $level . "'", "id_category = '" . $id_category . "'");
                        if ($update_category) {
                            $class_alert = "alert alert-success";
                            $content_notice = "Done !";
                            modalInfo($class_alert, $content_notice);
                            ?>
                            <script>
                                $('#modalNotice').modal('show');
                                $(document).on('hide.bs.modal', '#modalNotice', function () {
                                    parent.location = "?page=category";
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
            ?>
            <!--Form edit-->
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">CATEGORY</h3>
                </div>
                <div>
                    <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="tab-pane info-register fade in active">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-category">Category:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control required" name="dk-category" id="dk-category" value="<?php echo $row[0][1] ?>">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="dk-category-english" value="<?php echo $row[0][2] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-image">Poster:</label>
                                <div class="col-sm-8">
                                    <input type="file" name="dk-image" id="dk-image" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-birthday">Level:</label>
                                <div class="col-sm-8">
                                    <select class="item-cbb" name="dk-level">
                                        <option value="0">-- Danh mục gốc --</option>
                                        <?php echo $option_category ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-save"></label>
                                <div class="col-sm-8">
                                    <button type="submit" name="btn-update" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="hr-no-margin">
            <!--/Form edit-->
            <?php
        } elseif ($act == 'del') {
            if ($id_category > 0) {
                modalConfirm("category", "id_category = '" . $id_category . "'", "?page=category");
                ?>
                <script>
                    $('#modalConfirm').modal('show');
                </script>
                <?php
            }
        } else {
            if ($level == 1) {
                ?>
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a class="link-plus" href="?page=category&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST CATEGORY</h3>
                    </div>

                    <table class="table">
                        <thead>
                            <tr class="tr-title">
                                <th style="width: 5%">ID</th>
                                <th style="width: 15%">CATEGORY (VN)</th>
                                <th style="width: 15%">CATEGORY (ENG)</th>
                                <th style="width: 45%">BANNER</th>
                                <th style="width: 10%">DISPLAY</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = selectData("category", "level = 0", "*");
                            for ($i = 0; $i < count($data); $i++) {
                                ?>
                                <tr>
                                    <td><?php echo $data[$i][0] ?></td>
                                    <td><?php echo $data[$i][1] ?></td>
                                    <td><?php echo $data[$i][2] ?></td>
                                    <td><img class="image-category" src="<?php echo $data[$i][3] ? $data[$i][3] : "http://placehold.it/800x300"; ?>"></td>
                                    <td>
                                        <?php
                                        if ($data[$i][4] == 1) {
                                            ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" checked data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                            </form>
                                            <?php
                                        } else {
                                            ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><a href="index.php?page=category&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> || 
                                        <a href="index.php?page=category&act=del&id=<?php echo $data[$i][0]; ?>">Del</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr class="hr-no-margin">
                <?php
            } elseif ($level == 2) {
                ?>
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a class="link-plus" href="?page=category&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST CATEGORY</h3>
                    </div>

                    <table class="table">
                        <thead>
                            <tr class="tr-title">
                                <th style="width: 5%">ID</th>
                                <th style="width: 15%">CATEGORY (VN)</th>
                                <th style="width: 15%">CATEGORY (ENG)</th>
                                <th style="width: 45%">BANNER</th>
                                <th style="width: 10%">DISPLAY</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = selectData("category", "level != 0 ORDER BY level", "*");
                            for ($i = 0; $i < count($data); $i++) {
                                ?>
                                <tr>
                                    <td><?php echo $data[$i][0] ?></td>
                                    <td><?php echo $data[$i][1] ?></td>
                                    <td><?php echo $data[$i][2] ?></td>
                                    <td><img class="image-category" src="<?php echo $data[$i][3] ? $data[$i][3] : "http://placehold.it/800x300"; ?>"></td>
                                    <td>
                                        <?php
                                        if ($data[$i][4] == 1) {
                                            ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" checked data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                            </form>
                                            <?php
                                        } else {
                                            ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><a href="index.php?page=category&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> || 
                                        <a href="index.php?page=category&act=del&id=<?php echo $data[$i][0]; ?>">Del</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr class="hr-no-margin">
                <?php
            } else {
                ?>
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a class="link-plus" href="?page=category&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST CATEGORY</h3>
                    </div>

                    <table class="table">
                        <thead>
                            <tr class="tr-title">
                                <th style="width: 5%">ID</th>
                                <th style="width: 60%">CATEGORY</th>
                                <th style="width: 15%">DISPLAY</th>
                                <th style="width: 10%">LEVEL</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = selectData("category", "level = 0", "*");
                            for ($i = 0; $i < count($data); $i++) {
                                ?>
                                <tr>
                                    <td><?php echo $data[$i][0] ?></td>
                                    <td><?php echo $data[$i][1] ?>
                                        <?php
                                        $data_sub = selectData("category", "level = '" . $data[$i][0] . "'", "*");
                                        if (count($data_sub) > 0) {
                                            ?>
                                            </br></br>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">ID</th>
                                                        <th style="width: 60%">Category</th>
                                                        <th style="width: 15%">Display</th>
                                                        <th style="width: 10%">Level</th>
                                                        <th style="width: 10%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    for ($j = 0; $j < count($data_sub); $j++) {
                                                        ?>
                                                        <tr class="<?php echo $j % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                                            <td><?php echo $data_sub[$j][0] ?></td>
                                                            <td><?php echo $data_sub[$j][1] ?></td>
                                                            <td>
                                                                <?php
                                                                if ($data_sub[$j][4] == 1) {
                                                                    ?>
                                                                    <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                                        <input class="change-display" type="checkbox" checked data-toggle="toggle" value="<?php echo $data_sub[$j][0] ?>">
                                                                    </form>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                                        <input class="change-display" type="checkbox" data-toggle="toggle" value="<?php echo $data_sub[$j][0] ?>">
                                                                    </form>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $data_sub[$j][5] ?></td>
                                                            <td><a href="index.php?page=category&act=edit&id=<?php echo $data_sub[$j][0]; ?>">Sửa</a> || 
                                                                <a href="index.php?page=category&act=del&id=<?php echo $data_sub[$j][0]; ?>">Xóa</a></td>
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
                                    <td>
                                        <?php
                                        if ($data[$i][4] == 1) {
                                            ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" checked data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                            </form>
                                            <?php
                                        } else {
                                            ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $data[$i][5] ?></td>
                                    <td><a href="index.php?page=category&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> || 
                                        <a href="index.php?page=category&act=del&id=<?php echo $data[$i][0]; ?>">Del</a></td>
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
        }
        ?>
    </div>
</div>