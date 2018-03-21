<?php
$id_banner = intval($_GET['id']);
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb bc-no-margin">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Home</a>
            </li>
            <li class="active">
                <i class="fa fa-fw fa-picture-o"></i> Banner 
            </li>
        </ol>
    </div>
</div>
<hr class="hr-no-margin">
<div class="row">
    <?php
        if ($act == 'add') {
            //-----------------Get data input-----------------------------------------------------
            $hinhanh = $_FILES['dk-image']['name'];
            $id_category = $_POST['dk-category'];
            //-----------------------Get data from database for Select input----------------------------------
            $datadm =  selectData("category", "level = 0", "id_category, category");
            for ($i = 0; $i < count($datadm); $i++) {
                $option_category .= '<option value="'.$datadm[$i][0].'">'.$datadm[$i][1].'</option>';
            }
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-plus'])) {
                if (!$hinhanh || !$id_category) {
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
                                $path = "data/banner/";
                                $tmp_name = $_FILES['dk-image']['tmp_name'];
                                $name = basename(md5($_FILES['dk-image']['name'].time()).".".$type);
                                $hinhanh = $path.$name;
                                // Move file ---------------------------------------------------------------------------
                                move_uploaded_file($tmp_name,$hinhanh);				
                                // Upload file -----------------------------------------------------------------------------
                                $insert_banner = insertData("banner", "image, is_display, id_category", "'".$hinhanh."',1,'".$id_category."'");
                                if ($insert_banner) {
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
                <div class="col-md-12">
                    <div class="panel panel-primary filterable">
                        <div class="panel-heading">
                            <h3 class="panel-title">BANNER</h3>
                        </div>
                        <div>
                            <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                <div class="tab-pane info-register fade in active">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="dk-image">Image :</label>
                                        <div class="col-sm-5">
                                            <input type="file" name="dk-image" id="dk-image" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="dk-category">Category :</label>
                                        <div class="col-sm-5">
                                            <select class="item-cbb" name="dk-category">
                                                '.$option_category.'
                                            </select>
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
                </div>
            ';
        } elseif ($act == 'del') {
            if ($id_banner > 0) {
                modalConfirm("banner", "id_banner = '".$id_banner."'", "?page=banner");
                ?>
                    <script>
                        $('#modalConfirm').modal('show');
                    </script>
                <?php
            } 
        } else {
            ?>
            <div class="col-md-12">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a class="link-plus" href="?page=banner&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST BANNER</h3>
                    </div>

                    <table class="table">
                        <thead>
                            <tr class="tr-title">
                                <th style="width: 10%">ID</th>
                                <th style="width: 35%">IMAGE</th>
                                <th style="width: 20%">DISPLAY</th>
                                <th style="width: 20%">CATEGORY</th>
                                <th style="width: 15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $data =  selectData("banner", "1=1", "*");
                                for ($i = 0; $i < count($data); $i++) {
                                    ?>
                                    <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                        <td><?php echo $data[$i][0] ?></td>
                                        <td><img class="image-banner" src="<?php echo $data[$i][1]; ?>"></td>
                                        <td>
                                            <?php
                                                if ($data[$i][2] == 1) {
                                                    ?>
                                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-banner.php">
                                                            <input class="change-banner" type="checkbox" checked data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                                        </form>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-banner.php">
                                                            <input class="change-banner" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                                        </form>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $datadm =  selectData("category", "id_category = '".$data[$i][3]."'", "category");
                                                echo $datadm[0][0];
                                            ?>
                                        </td>
                                        <td><a href="index.php?page=banner&act=del&id=<?php echo $data[$i][0]; ?>">Delete</a></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr class="hr-no-margin">
            </div>
            <?php
        }
    ?>
</div>
<!-- /.row -->