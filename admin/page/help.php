<?php
$id_help = intval($_GET['id']);
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb bc-no-margin">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Home</a>
            </li>
            <li class="active">
                <i class="fa fa-leanpub"></i> Help 
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
            $help = addslashes($_POST['dk-help']);
            $help_english = addslashes($_POST['dk-help-english']);
            $content = $_POST['dk-content'];
            $content_english = $_POST['dk-content-english'];
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-plus'])) {
                if (!$help || !$content) {
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
                } else {
                    $insert_help = insertData("help", "help, help_english, content, content_english", "'".$help."','".$help_english."','".$content."','".$content_english."'");
                    if ($insert_help) {
                        $class_alert = "alert alert-success";
                        $content_notice = "Done !";
                        modalInfo($class_alert, $content_notice);
                        ?>
                            <script>
                                $('#modalNotice').modal('show');
                                $(document).on('hide.bs.modal','#modalNotice', function () {
                                    parent.location = "?page=help";
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
            //----------------------Form for input information--------------------------------------
            echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">HELP</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-help">Help :</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control required" name="dk-help" placeholder="Vietnamese">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="dk-help-english" placeholder="English">
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
            $help = addslashes($_POST['dk-help']);
            $help_english = addslashes($_POST['dk-help-english']);
            $content = $_POST['dk-content'];
            $content_english = $_POST['dk-content-english'];
            //-------------------Get data from row have selected--------------------------------------------------------
            if ($id_help) {
                $row_help =  selectData("help", "id_help = '".$id_help."'", "*");
            }
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-update'])) {
                if (!$help || !$content) {
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
                } else {
                    $update_help = updateData("help", "help='".$help."', help_english='".$help_english."', content='".$content."', content_english='".$content_english."'", "id_help = '".$id_help."'");
                    if ($update_help) {
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
                        <h3 class="panel-title">HELP</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-store">help :</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control required" name="dk-help" value="'.$row_help[0][1].'">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="dk-help-english" value="'.$row_help[0][2].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-content">Content (VN) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-content" style="height: 300px; ">'.$row_help[0][3].'</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-content-english">Content (ENG) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-content-english" style="height: 300px; ">'.$row_help[0][4].'</textarea>
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
        }  elseif ($act == 'del') {
            if ($id_help > 0) {
                modalConfirm("help", "$id_help = '".$id_help."'", "?page=help");
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
                    <h3 class="panel-title"><a class="link-plus" href="?page=help&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST HELP</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 10%">ID</th>
                            <th style="width: 15%">HELP (VN)</th>
                            <th style="width: 15%">HELP (ENG)</th>
                            <th style="width: 25%">CONTENT (VN)</th>
                            <th style="width: 25%">CONTENT (ENG)</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data =  selectData("help", "1=1", "*");
                            for ($i = 0; $i < count($data); $i++) {
                                ?>
                                <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                    <td><?php echo $data[$i][0] ?></td>
                                    <td><?php echo $data[$i][1] ?></td>
                                    <td><?php echo $data[$i][2] ?></td>
                                    <td><?php echo substr($data[$i][3], 0, 70); ?>...</td>
                                    <td><?php echo substr($data[$i][4], 0, 70); ?>...</td>
                                    <td><a href="index.php?page=help&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> ||
                                        <a href="index.php?page=help&act=del&id=<?php echo $data[$i][0]; ?>">Delete</a></td>
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