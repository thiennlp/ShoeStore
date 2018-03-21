<?php
$id_title = intval($_GET['id']);
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb bc-no-margin">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Home</a>
            </li>
            <li class="active">
                <i class="fa fa-audio-description"></i> Title 
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
            $title = addslashes($_POST['dk-title']);
            $title_english = addslashes($_POST['dk-title-english']);
            $keyword = addslashes($_POST['dk-keyword']);
            $content = $_POST['dk-content'];
            $page = $_POST['dk-page'];
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-plus'])) {
                echo $content;exit;
                if (!$title) {
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
                    $insert_title = insertData("title", "title, title_english, keyword, content, page", "'".$title."','".$title_english."','".$keyword."','".$content."','".$page."'");
                    if ($insert_title) {
                        $class_alert = "alert alert-success";
                        $content_notice = "Done !";
                        modalInfo($class_alert, $content_notice);
                        ?>
                            <script>
                                $('#modalNotice').modal('show');
                                $(document).on('hide.bs.modal','#modalNotice', function () {
                                    parent.location = "?page=title";
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
                        <h3 class="panel-title">TITLE</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-title">Title :</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control required" name="dk-title" placeholder="Vietnamese">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="dk-title-english" placeholder="English">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-keyword">Keyword :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="dk-keyword" placeholder="Vietnamese">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-page">Page :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="dk-page">
                                            <option value="home">-- Home --</option>
                                            <option value="cart">-- Cart --</option>
                                            <option value="about">-- About --</option>
                                            <option value="store">-- Store --</option>
                                            <option value="help">-- Help --</option>
                                            <option value="checkout">-- Checkout --</option>
                                            <option value="login">-- Login --</option>
                                            <option value="register">-- Register --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-content">Content :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-content" style="height: 300px; "></textarea>
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
            $title = addslashes($_POST['dk-title']);
            $title_english = addslashes($_POST['dk-title-english']);
            $keyword = addslashes($_POST['dk-keyword']);
            $content = $_POST['dk-content'];
            $page = $_POST['dk-page'];
            //-------------------Get data from row have selected--------------------------------------------------------
            if ($id_title) {
                $row_title =  selectData("title", "id_title = '".$id_title."'", "*");
            }
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-update'])) {
                if (!$title || !$content) {
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
                    $update_title = updateData("title", "title='".$title."', title_english='".$title_english."', keyword='".$keyword."', content='".$content."', page='".$page."'", "id_title = '".$id_title."'");
                    if ($update_title) {
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
                        <h3 class="panel-title">TITLE</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-title">Title :</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control required" name="dk-title" value="'.$row_title[0][1].'">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="dk-title-english" value="'.$row_title[0][2].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-keyword">Keyword :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="dk-keyword" value="'.$row_title[0][3].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-page">Page :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="dk-page">
                                            <option '.$row_title[0][5] == 'home' ? 'selected' : ''.' value="home">-- Home --</option>
                                            <option '.$row_title[0][5] == 'cart' ? 'selected' : ''.' value="cart">-- Cart --</option>
                                            <option '.$row_title[0][5] == 'about' ? 'selected' : ''.' value="about">-- About --</option>
                                            <option '.$row_title[0][5] == 'store' ? 'selected' : ''.' value="store">-- Store --</option>
                                            <option '.$row_title[0][5] == 'help' ? 'selected' : ''.' value="help">-- Help --</option>
                                            <option '.$row_title[0][5] == 'checkout' ? 'selected' : ''.' value="checkout">-- Checkout --</option>
                                            <option '.$row_title[0][5] == 'login' ? 'selected' : ''.' value="login">-- Login --</option>
                                            <option '.$row_title[0][5] == 'register' ? 'selected' : ''.' value="register">-- Register --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-content">Content :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-content" style="height: 300px; ">'.$row_title[0][4].'</textarea>
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
            if ($id_title > 0) {
                modalConfirm("title", "$id_title = '".$id_title."'", "?page=title");
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
                    <h3 class="panel-title"><a class="link-plus" href="?page=title&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST TITLE</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 10%">ID</th>
                            <th style="width: 25%">TITLE (VN)</th>
                            <th style="width: 25%">TITLE (ENG)</th>
                            <th style="width: 30%">KEYWORD</th>
                            <th style="width: 30%">PAGE</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data =  selectData("title", "1=1", "*");
                            for ($i = 0; $i < count($data); $i++) {
                                ?>
                                <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                    <td><?php echo $data[$i][0] ?></td>
                                    <td><?php echo $data[$i][1] ?></td>
                                    <td><?php echo $data[$i][2] ?></td>
                                    <td><?php echo $data[$i][3] ?></td>
                                    <td><?php echo $data[$i][5] ?></td>
                                    <td><a href="index.php?page=title&act=edit&id=<?php echo $data[$i][0]; ?>">Edit</a> ||
                                        <a href="index.php?page=title&act=del&id=<?php echo $data[$i][0]; ?>">Delete</a></td>
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