<?php

/**
 *
 * Get data from database
 *
 * @param string $table table
 * @param string $condition condition
 * @param string $field field
 * 
 * @return array $list
 */
function selectData($table, $condition = '', $field = '*') {
    global $mysqli;
    $list = array();
    $sql = "SELECT $field FROM $table WHERE $condition";
    if ($condition == NULL || $condition == '') {
        $sql = "SELECT $field FROM $table";
    }
    $row = $mysqli->query($sql);
    if ($row != FALSE) {
        while ($data = $row->fetch_array()) {
            $list[] = $data;
        }
    }
    return $list;
}

/**
 *
 * Insert data to database
 *
 * @param string $table table
 * @param string $column column
 * @param string $value value
 * 
 * @return boolean
 */
function insertData($table, $column, $value) {
    global $mysqli;
    return $query = $mysqli->query("INSERT INTO $table($column) VALUES ($value)");
}

/**
 *
 * Update record in table $table with value in condition $where
 *
 * @param string $table table
 * @param string $set set
 * @param string $where where
 * 
 * @return boolean
 */
function updateData($table, $set, $where) {
    global $mysqli;
    return $query = $mysqli->query("UPDATE $table SET $set  WHERE $where");
}

/**
 *
 * Delete record from table
 *
 * @param string $table table
 * @param string $where where
 * 
 * @return boolean
 */
function deleteData($table, $where) {
    global $mysqli;
    return $query = $mysqli->query("DELETE FROM $table WHERE $where");
}

/**
 *
 * Add bill
 *
 * @param string $cart cart
 * @param string $id id
 * @param string $note note
 * 
 */
function addBill($cart, $id, $note = '') {
    $total_bill = 0;
    $date = time();
    foreach ($cart as $product => $info) {
        $data = explode(",", $info);
        $price = selectData("detail", "id_product = '" . $product . "'", "price");
        $row_campaign = selectData("campaign", "id_product='" . $product . "' AND is_campaign = 1", "price_to");
        if ($row_campaign) {
            $price = $row_campaign[0][0];
        } else {
            $price = $price[0][0];
        }
        $total = $price * $data[2];
        $total_bill = $total_bill + $total;
    }
    //--------------------Lấy giá trị giỏ hàng hiện tại---------------
    $insert_bill = insertData("bill", "id_customer, date, price, status, note", "'" . $id . "', '" . $date . "', '" . $total_bill . "', 0, '" . $note . "'");
    $bill = selectData("bill", "id_customer = '" . $id . "' AND date = '" . $date . "'", "id_bill");
    if ($insert_bill && $bill) {
        foreach ($cart as $product => $info) {
            $data = explode(",", $info);
            $price = selectData("detail", "id_product = '" . $product . "'", "price");
            $row_campaign = selectData("campaign", "id_product='" . $product . "' AND is_campaign = 1", "price_to");
            if ($row_campaign) {
                $price = $row_campaign[0][0];
            } else {
                $price = $price[0][0];
            }
            $total = $price * $data[2];
            $insert_detail_bill = insertData("detail_bill", "id_bill, id_product, size, color, count, price", "'" . $bill[0][0] . "', '" . $product . "', '" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "', '" . $total . "'");
            if ($insert_detail_bill) {
                $total_product = selectData("product", "id_product = '" . $product . "'", "total");
                $update_total = $total_product[0][0] - $data[2];
                $update_product = updateData("product", "total='" . $update_total . "'", "id_product = '" . $product . "'");
            }
        }
        unset($_SESSION['cart_']);
        reset($cart);
        $class_alert = "alert alert-success";
        $content_notice = "Order Success. </br>The system will process your order soon. </br>Thank you!";
        modalInfo($class_alert, $content_notice);
    } else {
        $class_alert = "alert alert-danger";
        $content_notice = "An error has occurred on the system. </br>Please try again later!";
        modalInfo($class_alert, $content_notice);
    }
    echo "<script>
            $(document).ready(function(){
                $('#modalNotice').modal('show');
                $(document).on('hide.bs.modal','#modalNotice', function () {
                    window.location.href = '?page=home';
                });
            });
        </script>";
}

/**
 *
 * Display notice
 *
 * @param string $class_alert class_alert
 * @param string $content_notice content_notice
 * 
 */
function modalInfo($class_alert, $content_notice) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalNotice" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="title-checkout"><strong>ZAC & JEANS COLLECTION'S</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="<?php echo $class_alert; ?>">
                        <strong><?php echo strtoupper($content_notice); ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 *
 * Display modal confirm
 *
 * @param string $table table
 * @param string $where where
 * @param string $url url
 * 
 */
function modalConfirm($table, $where, $url) {
    //-----------------Event click Del-----------------------------------------------------
    if (isset($_POST['btn-del'])) {
        $del_size = deleteData($table, $where);
        ?>
        <script>
            $('#modalConfirm').modal('hide');
            parent.location = "<?php echo $url ?>";
        </script>
        <?php
    }
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="POST" class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="title-checkout"><strong>ZAC & JEANS COLLECTION'S</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <strong>DO YOU WANT DELETE RECORD ?</strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btn-del" class="btn btn-primary">YES</button>
                        <button type="submit" class="btn btn-default" data-dismiss="modal">NO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

/**
 *
 * Get Value Input by JS
 *
 * @param string $id id
 *
 * @return string 
 */
function getValue($id) {
    ?>
    <script>
        return document.getElementById("<?php echo $id; ?>").value;
    </script>
    <?php
}

/**
 *
 * Get data from database
 *
 * @param string $str
 *
 * @return string 
 */
function bodau($str) {
    // In thường
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = html_entity_decode($str);
    $str = str_replace(array(' ', '_'), '-', $str);
    $str = html_entity_decode($str);
    $str = str_replace("ç", "c", $str);
    $str = str_replace("Ç", "C", $str);
    $str = str_replace(" / ", "-", $str);
    $str = str_replace("/", "-", $str);
    $str = str_replace(" – ", "-", $str);
    $str = str_replace("_", "-", $str);
    $str = str_replace(" ", "-", $str);
    $str = str_replace("ß", "ss", $str);
    $str = str_replace("&", "", $str);
    $str = str_replace("%", "percent", $str);
    $str = str_replace("—-", "-", $str);
    $str = str_replace("—", "-", $str);
    $str = str_replace("–", "-", $str);
    $str = str_replace(".", "-", $str);
    $str = str_replace(":", "-", $str);
    $str = str_replace(",", "", $str);
    $str = str_replace("?", "", $str);
    $str = str_replace("(", "", $str);
    $str = str_replace(")", "", $str);
    // In Hoa
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(Đ)/", 'd', $str);
    // Chuyển chữ hoa thành chữ Thường
    $str = strtolower($str);
    $str = str_replace(" ", '-', $str);
    return $str; // Trả về chuỗi đã chuyển
}

/**
 *
 * XỬ LÝ LINK SẢN PHẨM
 *
 * @param string $a
 * @param string $title
 * @param string $id
 *
 * @return string 
 */
function xllink($a, $title, $id) {
    $title = bodau($title);
    $url = "/{$a}/{$title}-{$id}";
    return $url;
}

/**
 *
 * Phân trang hiển thị
 *
 * @param string $self
 * @param string $page_total
 * @param string $page_limit
 * @param string $page_num
 *
 * @return html 
 */
function setPage($self, $page_total, $page_limit, $page_num) {
    DIE;
    $numofpages = ceil($page_total / $page_limit);
    if ($numofpages > '1') {
        $range = 4;
        $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
        $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
        $page_min = $page_num - $range_min;
        $page_max = $page_num + $range_max;

        $page_min = ($page_min < 1) ? 1 : $page_min;
        $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
        if ($page_max > $numofpages) {
            $page_min = ($page_min > 1) ? $numofpages - $range + 1 : 1;
            $page_max = $numofpages;
        }

        $page_min = ($page_min < 1) ? 1 : $page_min;

        // start paging
        $page_pagination .= '<div class="pagenition">';
        if (($page_num > ($range - $range_min)) && ($numofpages > $range)) {
            $page_pagination .= '<a title="First" href="' . $self . '1.html">First</a> ';
        }

        if ($page_num != 1) {
            $page_pagination .= '<a href="' . $self . '' . ($page_num - 1) . '.html"><span class="glyphicon glyphicon-backward"></span></a> ';
        }

        for ($i = $page_min; $i <= $page_max; $i++) {
            if ($i == $page_num)
                $page_pagination .= "<span class='current'>" . $i . '</span> ';
            else
                $page_pagination .= '<a href="' . $self . '' . $i . '.html">' . $i . '</a> ';
        }

        if ($page_num < $numofpages) {
            $page_pagination .= ' <a href="' . $self . '' . ($page_num + 1) . '.html"><span class="glyphicon glyphicon-forward"></span></a>';
        }

        if (($page_num < ($numofpages - $range_max)) && ($numofpages > $range)) {
            $page_pagination .= ' <a title="Last" href="' . $self . '' . $numofpages . '">Last</a> ';
        }
        $page_pagination = "<span class='sotrang'>Page : </span>" . $page_pagination;
        // end paging
        $page_pagination .= '</div>';
    }
    return $page_pagination;
}

/**
 *
 * Set language
 *
 * @param string $language
 *
 * @return string 
 */
function setLang($language) {
    $_SESSION['lang'] = true;
    if ($language) {
        $_SESSION['lang'] = $language;
        return 'lang/' . $language . '.php';
    } else {
        $_SESSION['lang'] = 'vietnamese';
        return 'lang/vietnamese.php';
    }
}

/**
 *
 * curPageURL
 *
 * @return string 
 */
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

?>

