<?php
$id_about = intval($_GET['id']);
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb bc-no-margin">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Home</a>
            </li>
            <li class="active">
                <i class="fa fa-question-circle-o"></i> About 
            </li>
        </ol>
    </div>
</div>
<hr class="hr-no-margin">
<div class="row">
    <?php
    if ($act == 'add') {
        //-----------------Get data input-----------------------------------------------------
        $about = addslashes($_POST['dk-about']);
        $about_english = addslashes($_POST['dk-about-english']);
        $hinhanh = $_FILES['dk-image']['name'];
        $content = $_POST['dk-content'];
        $content_english = $_POST['dk-content-english'];
        //-----------------Event click Add-----------------------------------------------------
        if (isset($_POST['btn-plus'])) {
            if (!$about || !$content) {
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
                            $path = "data/about/";
                            $tmp_name = $_FILES['dk-image']['tmp_name'];
                            $name = basename(md5($_FILES['dk-image']['name'] . time()) . "." . $type);
                            $hinhanh = $path . $name;
                            // Move file ---------------------------------------------------------------------------
                            move_uploaded_file($tmp_name, $hinhanh);
                            // Upload file -----------------------------------------------------------------------------
                            $insert_about = insertData("about", "about, about_english, image, content, content_english", "'" . $about . "','" . $about_english . "','" . $hinhanh . "','" . $content . "','" . $content_english . "'");
                            if ($insert_about) {
                                $class_alert = "alert alert-success";
                                $content_notice = "Done !";
                                modalInfo($class_alert, $content_notice);
                                ?>
                                <script>
                                    $('#modalNotice').modal('show');
                                    $(document).on('hide.bs.modal', '#modalNotice', function () {
                                        parent.location = "?page=about";
                                    });
                                </script>
                                <?php
                            } else {
                                $class_alert = "alert alert-danger";
                                $content_notice = "Add about fail !";
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
        //----------------------Form for input information--------------------------------------
        echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">ABOUT</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-about">About :</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control required" name="dk-about" placeholder="Vietnamese">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="dk-about-english" placeholder="English">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-image">Image :</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="dk-image" id="dk-image" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-content">Content (VN) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-content" style="height: 300px; "></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-content-english">Content (ENG) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-content-english" style="height: 300px; "></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-plus"></label>
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
        $about = addslashes($_POST['dk-about']);
        $about_english = addslashes($_POST['dk-about-english']);
        $content = $_POST['dk-content'];
        $content_english = $_POST['dk-content-english'];
        //-------------------Get data from row have selected--------------------------------------------------------
        if ($id_about) {
            $row_about = selectData("about", "id_about = '" . $id_about . "'", "*");
        }
        //-----------------Event click Add-----------------------------------------------------
        if (isset($_POST['btn-update'])) {
            if (!$about || !$content) {
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
                            $path = "data/about/";
                            $tmp_name = $_FILES['dk-image']['tmp_name'];
                            $name = basename(md5($_FILES['dk-image']['name'] . time()) . "." . $type);
                            $hinhanh = $path . $name;
                            // Move file ---------------------------------------------------------------------------
                            move_uploaded_file($tmp_name, $hinhanh);
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
                    $hinhanh = $row_about[0][3];
                }
                $update_about = updateData("about", "about='" . $about . "', about_english='" . $about_english . "', image='" . $hinhanh . "', content='" . $content . "', content_english='" . $content_english . "'", "id_about = '" . $id_about . "'");
                if ($update_about) {
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
                    $content_notice = "Update about fail !";
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
                        <h3 class="panel-title">ABOUT</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-store">About :</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control required" name="dk-about" value="' . $row_about[0][1] . '">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="dk-about-english" value="' . $row_about[0][2] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-image">Image :</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="dk-image" id="dk-image" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-content">Content (VN) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-content" style="height: 300px; ">' . $row_about[0][4] . '</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-content-english">Content (ENG) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-content-english" style="height: 300px; ">' . $row_about[0][5] . '</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-update"></label>
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
        if ($id_about > 0) {
            modalConfirm("about", "$id_about = '" . $id_about . "'", "?page=about");
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
                <h3 class="panel-title"><a class="link-plus" href="?page=about&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST ABOUT</h3>
            </div>

            <table class="table">
                <thead>
                    <tr class="tr-title">
                        <th style="width: 10%">ID</th>
                        <th style="width: 25%">ABOUT (VN)</th>
                        <th style="width: 25%">ABOUT (ENG)</th>
                        <th style="width: 30%">IMAGE</th>
                        <th style="width: 10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = selectData("about", "1=1", "*");
                    for ($i = 0; $i < count($data); $i++) {
                        ?>
                        <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                            <td><?php echo $data[$i][0] ?></td>
                            <td><?php echo $data[$i][1] ?></td>
                            <td><?php echo $data[$i][2] ?></td>
                            <td><img class="image-banner" src="<?php echo $data[$i][3]; ?>"></td>
                            <td><a href="index.php?page=about&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> ||
                                <a href="index.php?page=about&act=del&id=<?php echo $data[$i][0]; ?>">Delete</a></td>
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
<!-- /.row -->