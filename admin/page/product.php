<?php include("./module/breadcrumb.php"); ?>
<?php
$id_product = intval($_GET['id']);
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}
?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($act == 'add') {
            $data_size = selectData("size", "1=1", "DISTINCT type_size");
            for ($i = 0; $i < count($data_size); $i++) {
                $option_size .= '<option value="' . $data_size[$i][0] . '">' . $data_size[$i][0] . '</option>';
            }
            $data_object = selectData("object", "1 = 1", "id_object, object");
            for ($i = 0; $i < count($data_object); $i++) {
                $option_object .= '<option value="' . $data_object[$i][0] . '">' . $data_object[$i][1] . '</option>';
            }
            $data_category = selectData("category", "level = 0", "id_category, category");
            for ($i = 0; $i < count($data_category); $i++) {
                $option_category .= '<optgroup label="' . $data_category[$i][1] . '">';
                $data_category_sub = selectData("category", "level = '" . $data_category[$i][0] . "'", "id_category, category");
                for ($j = 0; $j < count($data_category_sub); $j++) {
                    $option_category .= '<option value="' . $data_category_sub[$j][0] . '">' . $data_category_sub[$j][1] . '</option>';
                }
                $option_category .= '</optgroup>';
            }
            //-----------------Get data input-----------------------------------------------------
            $product = addslashes($_POST['dk-product']);
            $id_category = $_POST['dk-category'];
            $color = $_POST['dk-color'];
            $price = $_POST['dk-price'];
            $type_size = $_POST['dk-size'];
            $summary = $_POST['dk-summary'];
            $summary_english = $_POST['dk-summary-english'];
            $import = $_POST['dk-import'];
            $id_age = $_POST['dk-age'];
            $date_up = time();
            //-----------------Event click Add-----------------------------------------------------
            if (isset($_POST['btn-plus'])) {
                if (!$product || !$id_category || !$color || !$price) {
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
                    $insert_product = insertData("product", "product, id_age, id_category, total, date_up", "'" . $product . "','" . $id_age . "','" . $id_category . "','" . $import . "','" . $date_up . "'");
                    if ($insert_product) {
                        $id_product = selectData("product", "product = '" . $product . "' AND date_up ='" . $date_up . "'", "id_product");
                        if ($id_product) {
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
                                        $path = "data/product/";
                                        $tmp_name = $_FILES['dk-image']['tmp_name'];
                                        $name = basename(md5($_FILES['dk-image']['name'] . time()) . "." . $type);
                                        $hinhanh = $path . $name;
                                        // Move file ---------------------------------------------------------------------------
                                        move_uploaded_file($tmp_name, $hinhanh);
                                        // Upload file -----------------------------------------------------------------------------
                                        $insert_detail = insertData("detail", "image, color, type_size, price, summary, summary_english, id_product", "'" . $hinhanh . "','" . $color . "','" . $type_size . "','" . $price . "','" . $summary . "','" . $summary_english . "','" . $id_product[0][0] . "'");
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
                        $class_alert = "alert alert-success";
                        $content_notice = "Done !";
                        modalInfo($class_alert, $content_notice);
                        ?>
                        <script>
                            $('#modalNotice').modal('show');
                            $(document).on('hide.bs.modal', '#modalNotice', function () {
                                parent.location = "?page=product";
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
            //----------------------Form for input information--------------------------------------
            echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">PRODUCT INFORMATION</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-product">Product :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="dk-product" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-image">Image:</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="dk-image" id="dk-image"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-category">Category :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="dk-category">
                                            ' . $option_category . '
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-color">Color :</label>
                                    <div class="col-sm-8">
                                        <input class="required-next-1" type="text" name="dk-color" value="" placeholder="Chọn màu" id="pickcolor" />
                                        <span id="call-picker" class="color-holder ">Color</span>
                                        <div class="color-picker" id="color-picker" style="display:none" ></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-size">Size :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="dk-size">
                                            ' . $option_size . '
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-price">Price :</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control required-next-2" name="dk-price" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-import">Import :</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="dk-import" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-object">Object :</label>
                                    <div class="col-sm-8">
                                        <form role="form" method="POST" class="form-horizontal" action="ajax-get-age.php">
                                            <select class="item-cbb" name="dk-object" onchange="getAge(this.value)">
                                                <option value="0">-- Đối tượng --</option>' . $option_object . '
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-age">Ages :</label>
                                    <div class="col-sm-8">
                                        <select id="optionAge" class="item-cbb" name="dk-age">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-summary">Detail (VN) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-summary" style="height: 300px; "></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-summary-english">Detail (ENG) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-summary-english" style="height: 300px; "></textarea>
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
            //-------------------Get data from row have selected--------------------------------------------------------
            if ($id_product) {
                $row_product = selectData("product", "id_product = '" . $id_product . "'", "*");
                $row_detail = selectData("detail", "id_product = '" . $id_product . "'", "*");
            }
            //-----------------------Get data from database for Select input----------------------------------
            $data_size_1 = selectData("size", "1=1", "DISTINCT type_size");
            for ($i = 0; $i < count($data_size_1); $i++) {
                $option_size .= '<optgroup label="' . $data_size_1[$i][0] . '">';
                $data_size_2 = selectData("size", "type_size = '" . $data_size_1[$i][0] . "'", "id_size, size");
                for ($j = 0; $j < count($data_size_2); $j++) {
                    if ($row_detail[0][3] == $data_size_2[$j][0]) {
                        $row_size[$j] = 'selected';
                    }
                    $option_size .= '<option ' . $row_sizer[$j] . ' value="' . $data_size_2[$j][0] . '">' . $data_size_2[$j][1] . '</option>';
                }
                $option_size .= '</optgroup>';
            }
            $data_size = selectData("size", "1=1", "DISTINCT type_size");
            for ($i = 0; $i < count($data_size); $i++) {
                if ($row_detail[0][3] == $data_size[$i][0]) {
                    $row_size[$i] = 'selected';
                }
                $option_size .= '<option ' . $row_size[$i] . ' value="' . $data_size[$i][0] . '">' . $data_size[$i][0] . '</option>';
            }

            $data_age = selectData("age", "id_age = '" . $row_product[0][2] . "'", "id_age, age, id_object");
            $option_age .= '<option value="' . $data_age[0][0] . '">' . $data_age[0][1] . '</option>';

            $data_object = selectData("object", "1 = 1", "id_object, object");
            for ($i = 0; $i < count($data_object); $i++) {
                if ($data_age[0][2] == $data_object[$i][0]) {
                    $row_age[$i] = 'selected';
                }
                $option_object .= '<option ' . $row_age[$i] . ' value="' . $data_object[$i][0] . '">' . $data_object[$i][1] . '</option>';
            }

            $data_category = selectData("category", "level = 0", "id_category, category");
            for ($i = 0; $i < count($data_category); $i++) {
                $option_categories .= '<optgroup label="' . $data_category[$i][1] . '">';
                $data_category_2 = selectData("category", "level = '" . $data_category[$i][0] . "'", "id_category, category");
                for ($j = 0; $j < count($data_category_2); $j++) {
                    $row_category[$j] = '';
                    if ($row_product[0][3] == $data_category_2[$j][0]) {
                        $row_category[$j] = 'selected';
                    }
                    $option_categories .= '<option ' . $row_category[$j] . ' value="' . $data_category_2[$j][0] . '">' . $data_category_2[$j][1] . '</option>';
                }
                $option_categories .= '</optgroup>';
            }
            //-----------------Get data input-----------------------------------------------------
            $product = addslashes($_POST['dk-product']);
            $id_category = $_POST['dk-category'];
            $color = $_POST['dk-color'];
            $price = $_POST['dk-price'];
            $type_size = $_POST['dk-size'];
            $summary = $_POST['dk-summary'];
            $summary_english = $_POST['dk-summary-english'];
            $import = $_POST['dk-import'];
            $id_age = $_POST['dk-age'];
            $date_up = time();
            //-----------------Event click Edit-----------------------------------------------------
            if (isset($_POST['btn-update'])) {
                if (!$product || !$id_category || !$summary) {
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
                    $total = intval($row_product[0][4]) + intval($import);
                    $update_product = updateData("product", "product='" . $product . "', id_age='" . $id_age . "', id_category='" . $id_category . "', total='" . $total . "', date_up='" . $date_up . "'", "id_product = '" . $id_product . "'");
                    if ($update_product) {
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
                                    $path = "data/product/";
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
                            $hinhanh = $row_detail[0][1];
                        }
                        if ($row_detail) {
                            $update_detail = updateData("detail", "image='" . $hinhanh . "', color='" . $color . "', type_size='" . $type_size . "', price='" . $price . "', summary='" . $summary . "', summary_english='" . $summary_english . "', id_product='" . $id_product . "'", "id_detail = '" . $row_detail[0][0] . "'");
                        } else {
                            $insert_detail = insertData("detail", "image, color, type_size, price, summary, summary_english, id_product", "'" . $hinhanh . "','" . $color . "','" . $type_size . "','" . $price . "','" . $summary . "','" . $summary_english . "','" . $id_product . "'");
                        }
                        $class_alert = "alert alert-success";
                        $content_notice = "Done !";
                        modalInfo($class_alert, $content_notice);
                        ?>
                        <script>
                            $('#modalNotice').modal('show');
                            $(document).on('hide.bs.modal', '#modalNotice', function () {
                                parent.location = "?page=product";
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
            //----------------------Form for input information--------------------------------------
            echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">PRODUCT INFORMATION</h3>
                    </div>
                    <div>
                        <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="tab-pane info-register fade in active">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-product">Product :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="dk-product" value="' . $row_product[0][1] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-image">Image:</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="dk-image" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-category">Category :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="dk-category">
                                            ' . $option_categories . '
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-color">Color :</label>
                                    <div class="col-sm-8">
                                        <input class="required-next-1" type="text" name="dk-color" value="' . $row_detail[0][2] . '" id="pickcolor">
                                        <span id="call-picker" class="color-holder ">Color</span>
                                        <div class="color-picker" id="color-picker" style="display:none" ></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-size">Size :</label>
                                    <div class="col-sm-8">
                                        <select class="item-cbb" name="dk-size">
                                            ' . $option_size . '
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-price">Price :</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control required-next-2" name="dk-price" value="' . $row_detail[0][4] . '">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-import">Import :</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="dk-import">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-object">Object :</label>
                                    <div class="col-sm-8">
                                        <form role="form" method="POST" class="form-horizontal" action="ajax-get-age.php">
                                            <select class="item-cbb" name="dk-object" onchange="getAge(this.value)">
                                                ' . $option_object . '
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-age">Ages :</label>
                                    <div class="col-sm-8">
                                        <select id="optionAge" class="item-cbb" name="dk-age">' . $option_age . '
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-summary">Detail (VN) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-summary" style="height: 300px; ">' . $row_detail[0][5] . '</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="dk-summary-english">Detail (ENG) :</label>
                                    <div class="col-sm-8">
                                        <textarea name="dk-summary-english" style="height: 300px; ">' . $row_detail[0][6] . '</textarea>
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
            if ($id_product > 0) {
                $id_detail = selectData("detail", "id_product = '" . $id_product . "'", "id_detail");
                if ($id_detail || empty($id_detail)) {
                    if (!empty($id_detail)) {
                        $del_detail = deleteData("detail", "id_detail = '" . $id_detail[0][0] . "'");
                    }
                    modalConfirm("product", "id_product = '" . $id_product . "'", "?page=product");
                    ?>
                    <script>
                        $('#modalConfirm').modal('show');
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
        } elseif ($act == 'upload') {
            $data_img = selectData("image", "id_product = '" . $id_product . "'", "*");
            //------------------Xử lý nút Upload--------------------------------------------------------
            if (isset($_POST['btn-upload'])) {

                for ($i = count($data_img); $i < 10; $i++) {
                    $hinhanh = $_FILES['img']['name'][$i];
                    $type = pathinfo($_FILES['img']['name'][$i], PATHINFO_EXTENSION);
                    $typeFileAllow = array('png', 'jpg', 'jpeg', 'gif', 'png');
                    if ($hinhanh != NULL) {
                        if (in_array($type, $typeFileAllow)) {
                            if ($_FILES['img']['size'][$i] < 1048576) {
                                $path = "data/product/";
                                $tmp_name = $_FILES['img']['tmp_name'][$i];
                                $name = basename(md5($_FILES['img']['name'][$i] . time()) . "." . $type);
                                $hinhanh = $path . $name;
                                // Move file ---------------------------------------------------------------------------
                                move_uploaded_file($tmp_name, $hinhanh);
                                // Upload file -----------------------------------------------------------------------------
                                $insert_image = insertData("image", "url, title, id_product", "'" . $hinhanh . "','', '" . $id_product . "'");
                            }
                        }
                    }
                }
                $class_alert = "alert alert-success";
                $content_notice = "Done !";
                modalInfo($class_alert, $content_notice);
                ?>
                <script>
                    $('#modalNotice').modal('show');
                    $(document).on('hide.bs.modal', '#modalNotice', function () {
                        parent.location = "?page=product";
                    });
                </script>
                <?php
            }
            //------------------Xử lý nút Delete--------------------------------------------------------
            if (isset($_POST['delete-image'])) {
                $id_image = $_POST['id-img'];
                $del_image = deleteData("image", "id_image = '" . $id_image . "'");
                if ($del_image) {
                    ?>
                    <script>
                        window.location.href = "?page=product&act=upload&id=<?php echo $id_product; ?>";
                    </script>
                    <?php
                }
            }
            //-----------Form for input information upload----------------------------------------------
            echo '
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">UPLOAD IMAGE</h3>
                </div>
                <div>
                    <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="tab-pane info-register fade in active">
                            ';
            for ($i = 0; $i < count($data_img); $i++) {
                echo '
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="dk-import">Image already exists :</label>
                                        <div class="col-sm-4">
                                            <input type="file" disabled/>' . $data_img[$i][1] . '
                                            <input name="id-img" type="hidden" value="' . $data_img[$i][0] . '"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" name="delete-image" class="btn btn-sm btn-primary">Delete</button>
                                        </div>
                                    </div>
                                ';
            }
            for ($i = count($data_img); $i < 10; $i++) {
                echo '
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="dk-import">Choose file :</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="img[]" />
                                        </div>
                                    </div>
                                ';
            }
            echo '
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-birthday"></label>
                                <div class="col-sm-8">
                                    <button type="submit" name="btn-upload" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="hr-no-margin">
            ';
        } elseif ($act == 'campaign') {
            //-------------------Get data from row have selected-----------------------------
            if ($id_product) {
                $row_detail = selectData("detail", "id_product = '" . $id_product . "'", "price");
                $row_campaign = selectData("campaign", "id_product = '" . $id_product . "'", "*");
            }
            //-----------------Get data input-----------------------------------------------------
            $price_to = $_POST['dk-campaign'];
            //-----------------Event click Save-----------------------------------------------------
            if (isset($_POST['btn-save'])) {
                if (intval($row_detail[0][0]) < intval($price_to)) {
                    $class_alert = "alert alert-danger";
                    $content_notice = "Price product need more than price campaigh !";
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
                    if ($row_campaign) {
                        $update_campaign = updateData("campaign", "is_campaign='" . $row_campaign[0][1] . "', price_from='" . $row_detail[0][0] . "', price_to='" . $price_to . "'", "id_campaign = '" . $row_campaign[0][0] . "'");
                        if ($update_campaign) {
                            $class_alert = "alert alert-success";
                            $content_notice = "Done !";
                            modalInfo($class_alert, $content_notice);
                            ?>
                            <script>
                                $('#modalNotice').modal('show');
                                $(document).on('hide.bs.modal', '#modalNotice', function () {
                                    parent.location = "?page=product";
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
                    } else {
                        $insert_campaign = insertData("campaign", "is_campaign, price_from, price_to, id_product", "0, '" . $row_detail[0][0] . "', '" . $price_to . "', '" . $id_product . "'");
                        if ($insert_campaign) {
                            $class_alert = "alert alert-success";
                            $content_notice = "Done !";
                            modalInfo($class_alert, $content_notice);
                            ?>
                            <script>
                                $('#modalNotice').modal('show');
                                $(document).on('hide.bs.modal', '#modalNotice', function () {
                                    parent.location = "?page=product";
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
            //-----------------Event click Del-----------------------------------------------------
            if (isset($_POST['btn-del'])) {
                $id_campaign = selectData("campaign", "id_product = '" . $id_product . "'", "id_campaign");
                if ($id_campaign) {
                    modalConfirm("campaign", "id_campaign = '" . $id_campaign[0][0] . "'", "?page=product");
                    ?>
                    <script>
                        $('#modalConfirm').modal('show');
                    </script>
                    <?php
                }
            }
            //----------------------Form for input information--------------------------------------
            echo '
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">CAMPAIGN</h3>
                </div>
                <div>
                    <form role="form" method="POST" class="form-horizontal">
                        <div class="tab-pane info-register fade in active">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-price">price :</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="dk-price" value="' . $row_detail[0][0] . '" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-campaign">Price campaign:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="dk-campaign" value="' . $row_campaign[0][3] . '">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-birthday"></label>
                                <div class="col-sm-8">
                                    <button type="submit" name="btn-save" class="btn btn-primary">Save</button>
                                    <button type="submit" name="btn-del" class="btn btn-default">Clear</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="hr-no-margin">
            ';
        } else {
            ?>
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title"><a class="link-plus" href="?page=product&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST PRODUCT</h3>
                    <div class="pull-right">
                        <button id="searchUser" class="btn btn-default btn-xs btn-search"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 5%">ID</th>
                            <th style="width: 30%">PRODUCT</th>
                            <th style="width: 20%">IMAGE</th>
                            <th style="width: 20%">CAMPAIGN</th>
                            <th style="width: 15%">CATEGORY</th>
                            <th style="width: 10%"></th>
                        </tr>
                        <tr class="tr-search">
                            <th style="width: 10%"><input type="text" class="form-control" placeholder="ID" disabled></th>
                            <th style="width: 30%"><input type="text" class="form-control" placeholder="Product" disabled></th>
                            <th style="width: 20%"></th>
                            <th style="width: 20%"></th>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data_total = selectData("product", "1=1", "*");
                        if ($category == 0) {
                            //-----------------------PHÂN TRANG---------------------------------------//
                            $total = count($data_total);
                            $numofpages = $total / $pp_product;
                            if ($trang <= 0) {
                                $page = 1;
                            } else {
                                if ($trang <= ceil($numofpages))
                                    $page = $trang;
                                else
                                    $page = 1;
                            }
                            $limitvalue = ($page * $pp_product) - $pp_product;
                            $self = "index.php?page=product&category=0&trang=";
                            //-----------------------PHÂN TRANG---------------------------------------//
                            $data = selectData("product", "1=1 ORDER BY date_up DESC LIMIT $limitvalue,$pp_product", "*");
                        } else {
                            //-----------------------PHÂN TRANG---------------------------------------//
                            $total = count($data_total);
                            $numofpages = $total / $pp_product;
                            if ($trang <= 0) {
                                $page = 1;
                            } else {
                                if ($trang <= ceil($numofpages))
                                    $page = $trang;
                                else
                                    $page = 1;
                            }
                            $limitvalue = ($page * $pp_product) - $pp_product;
                            $self = "index.php?page=product&category='" . $category . "'&trang=";
                            //-----------------------PHÂN TRANG---------------------------------------//
                            $data = selectData("product", "id_category = '" . $category . "'  ORDER BY date_up DESC LIMIT $limitvalue,$pp_product", "*");
                        }
                        for ($i = 0; $i < count($data); $i++) {
                            ?>
                            <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                <td><?php echo $data[$i][0] ?></td>
                                <td><?php echo $data[$i][1] ?></td>
                                <td>
                                    <div class="col-sm-12">
                                        <?php
                                        $data_image = selectData("detail", "id_product = '" . $data[$i][0] . "'", "image");
                                        ?>
                                        <img class="image-product" src="<?php echo $data_image[0][0] ? $data_image[0][0] : "http://placehold.it/400x400"; ?>">
                                    </div>
                                    <div class="col-sm-12 label-href"><a href="index.php?page=product&act=upload&id=<?php echo $data[$i][0]; ?>">Thêm hình ảnh</a></div>
                                </td>
                                <td>
                                    <?php
                                    $data_campaign = selectData("campaign", "id_product = '" . $data[$i][0] . "'", "id_campaign, is_campaign");
                                    if ($data_campaign) {
                                        if ($data_campaign[0][1] == 1) {
                                            ?>
                                            <div class="col-sm-12">
                                                <form class="form-horizontal" role="form" method="POST" action="ajax-update-campaign.php">
                                                    <input class="change-campaign" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>" checked>
                                                </form>
                                            </div>
                                            <div class="col-sm-12 label-href"><a href="index.php?page=product&act=campaign&id=<?php echo $data[$i][0]; ?>">Thông tin khuyến mãi</a></div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="col-sm-12">
                                                <form class="form-horizontal" role="form" method="POST" action="ajax-update-campaign.php">
                                                    <input class="change-campaign" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                                </form>
                                            </div>
                                            <div class="col-sm-12 label-href"><a href="index.php?page=product&act=campaign&id=<?php echo $data[$i][0]; ?>">Thông tin khuyến mãi</a></div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-sm-12">
                                            <form class="form-horizontal" role="form" method="POST" action="">
                                                <input class="change-campaign" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>" disabled>
                                            </form>
                                        </div>
                                        <div class="col-sm-12 label-href"><a href="index.php?page=product&act=campaign&id=<?php echo $data[$i][0]; ?>">Thêm khuyến mãi</a></div>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $datadm = selectData("category", "id_category = '" . $data[$i][3] . "'", "category");
                                    echo $datadm[0][0];
                                    ?>
                                </td>
                                <td><a href="index.php?page=product&act=edit&id=<?php echo $data[$i][0]; ?>">Sửa</a> || 
                                    <a href="index.php?page=product&act=del&id=<?php echo $data[$i][0]; ?>">Xóa</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="panel filterable">
                <div class="pagenition">
                    <?php
                    echo setPage($self, $total, $pp, $page);
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>