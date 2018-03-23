<?php

include_once("variable.php");
include_once("common.php");
$pp = 30;
$trang = intval($_GET['trang']);
if (!$trang) {
    $trang = 1;
}
if ($page == 'product') {
    $arr_product = selectData('product JOIN detail ON product.id_product=detail.id_product', 'product.id_product=' . $product);
    $campaign_product = selectData("campaign", "id_product='" . $product . "' AND is_campaign = 1");
    $arr_image_product = selectData('image', 'id_product=' . $product);
    $arr_category_2 = selectData('category', 'id_category=' . $arr_product[0]['id_category'], 'id_category, category, level');
    $arr_category_1 = selectData('category', 'id_category=' . $arr_category_2[0]['level'], 'id_category, category');
    $arr_product_recommend = selectData("product JOIN detail ON product.id_product=detail.id_product", "product.id_category='" . $arr_product[0]['id_category'] . "' AND product.id_product != '" . $product . "' ORDER BY product.date_up DESC LIMIT 0,9");
    $arr_product_category = selectData("product JOIN detail ON product.id_product=detail.id_product", "product.id_category In (SELECT id_category FROM category WHERE level = '" . $arr_category_2[0]['level'] . "') AND product.id_product != '" . $product . "' ORDER BY product.date_up DESC LIMIT 0,12");
    $arr_product = !empty($arr_product) ? $arr_product : array();
    $arr_image_product = !empty($arr_image_product) ? $arr_image_product : array();
    $arr_product_recommend = !empty($arr_product_recommend) ? $arr_product_recommend : array();
    $data_size = selectData("size", "type_size = '" . $arr_product[0]['type_size'] . "'");
    $size = $_POST['dk-size'];
    $color = $_POST['dk-color'];
    $count = $_POST['dk-quality'];
    if (isset($_POST['add-to-cart'])) {
        $info = $size . ',' . $color . ',' . $count;
        if ($color) {
            if (isset($_SESSION['cart_'][$product])) {
                $_SESSION['cart_'][$product] = $_SESSION['cart_'][$product] + $info;
            } else {
                $_SESSION['cart_'][$product] = $info;
            }
        } else {
            $err_content = $_SESSION['lang'] == 'english' ? 'Please selected the product color !' : 'Vui lòng chọn màu sản phẩm !';
        }
    }
    $row_product = selectData("product", "id_product = '" . $product . "'", "id_product, product");
    $web_title = $row_product[0][1] . " Collection's";
    $web_keyword = '';
    $web_desc = $row_product[0][1];
} elseif ($page == 'category') {
    $join_table_filter = ' JOIN detail ON product.id_product = detail.id_product JOIN age ON product.id_age = age.id_age';
    $where_filter = '';
    $condition_size = '';
    $condition_price = '';
    $condition_object = '';
    $condition_color = '';

    // Filter follow size
    if (isset($size) && !empty($size)) {
        $from_size = ' AND detail.type_size = (SELECT size.type_size FROM size WHERE size.id_size = ' . $size . ')';
    }

    // Filter follow price
    if (isset($price) && !empty($price)) {
        $arr_price = explode('_', $price);
        if (!isset($arr_price[1])) {
            $condition_price = ' AND (detail.price > ' . $arr_price[0] . ')';
        } else {
            $condition_price = ' AND (detail.price BETWEEN ' . $arr_price[0] . ' AND ' . $arr_price[1] . ')';
        }
    }

    //Filter follow object
    if (isset($object) && !empty($object)) {
        $condition_object = ' AND age.id_object = ' . $object;
    }

    //Filter follow color
    if (isset($color) && !empty($color)) {
        $value_color = '%' . $color . '%';
        $condition_color = ' AND detail.color LIKE ' . '"' . $value_color . '"';
    }

    // sum condition filter
    $where_filter = $condition_size . $condition_price . $condition_object . $condition_color;
    if ($catid) {
        $category_ = selectData("category", "id_category = '" . $catid . "'", "category, category_english");
        $title_category = $_SESSION['lang'] == 'english' ? ($category_[0][1] ? $category_[0][1] : $category_[0][0]) : $category_[0][0];
        $web_title = $title_category . " Collection's";
        $web_keyword = '';
        $web_desc = '';
    } else {
        $category_ = selectData("category", "id_category = '" . $category . "'", "category, category_english");
        $title_category = $_SESSION['lang'] == 'english' ? ($category_[0][1] ? $category_[0][1] : $category_[0][0]) : $category_[0][0];
        $web_title = $title_category . " Collection's";
        $web_keyword = '';
        $web_desc = '';
    }
} elseif ($page == 'cart') {
    if (isset($_GET['act'])) {
        $act = $_GET['act'];
    }
    $id = intval($_GET['item']);
    //-------Xóa sản phẩm trong giỏ hàng------------
    if ($act == 'del') {
        if ($id > 0) {
            unset($_SESSION['cart_'][$id]);
            header("Location: /cart");
        }
    }
    $title = selectData("title", "page = 'cart'", "*");
    if ($title) {
        $web_title = $_SESSION['lang'] == 'english' ? ($title[0][2] ? $title[0][2] : $title[0][1]) : $title[0][1];
        $web_keyword = $title[0][3];
        $web_desc = $title[0][4];
    } else {
        $web_title = "MY CART IN ZAC & JEANS COLLECTION'S";
        $web_keyword = '';
        $web_desc = '';
    }
} elseif ($page == 'search') {
    $search = $_GET['key'];
    $web_title = "SEARCH " . $search . " - ZAC & JEANS COLLECTION'S";
    $web_keyword = '';
    $web_desc = '';
} elseif ($page == 'logout') {
    unset($_SESSION['customer']);
    unset($_SESSION['cart_']);
    reset($cart);
    header("Location: /home");
} elseif ($page == 'about') {
    $arr_about = selectData('about', '', '*');
    $title = selectData("title", "page = 'about'", "*");
    if ($title) {
        $web_title = $_SESSION['lang'] == 'english' ? ($title[0][2] ? $title[0][2] : $title[0][1]) : $title[0][1];
        $web_keyword = $title[0][3];
        $web_desc = $title[0][4];
    } else {
        $web_title = "ABOUT ZAC & JEANS COLLECTION'S";
        $web_keyword = '';
        $web_desc = '';
    }
} elseif ($page == 'help') {
    $arr_help = selectData('help', '', '*');
    $title = selectData("title", "page = 'help'", "*");
    if ($title) {
        $web_title = $_SESSION['lang'] == 'english' ? ($title[0][2] ? $title[0][2] : $title[0][1]) : $title[0][1];
        $web_keyword = $title[0][3];
        $web_desc = $title[0][4];
    } else {
        $web_title = "HELP ABOUT ZAC & JEANS COLLECTION'S";
        $web_keyword = '';
        $web_desc = '';
    }
} elseif ($page == 'store') {
    $arr_store = selectData('store');
    $title = selectData("title", "page = 'store'", "*");
    if ($title) {
        $web_title = $_SESSION['lang'] == 'english' ? ($title[0][2] ? $title[0][2] : $title[0][1]) : $title[0][1];
        $web_keyword = $title[0][3];
        $web_desc = $title[0][4];
    } else {
        $web_title = "STORE IN ZAC & JEANS COLLECTION'S";
        $web_keyword = '';
        $web_desc = '';
    }
} else {
    $banner = selectData("banner", "is_display = 1", "*");
    $arr_product_recommend = selectData('product JOIN detail ON product.id_product=detail.id_product', '1=1 ORDER BY date_up DESC LIMIT 0,9');
    $arr_product_recommend = isset($arr_product_recommend) ? $arr_product_recommend : array();
    $arr_product_sales = selectData('product JOIN campaign ON product.id_product = campaign.id_product JOIN detail ON product.id_product=detail.id_product', 'campaign.is_campaign = 1 ORDER BY date_up DESC LIMIT 0,9');
    $arr_product_sales = isset($arr_product_sales) ? $arr_product_sales : array();
    $arr_product_best = selectData('product JOIN detail_bill ON product.id_product = detail_bill.id_product JOIN detail', 'product.id_product=detail.id_product ORDER BY detail_bill.count DESC LIMIT 0,9');
    $arr_product_best = isset($arr_product_best) ? $arr_product_best : array();

    $title = selectData("title", "page = 'home'", "*");
    if ($title) {
        $web_title = $_SESSION['lang'] == 'english' ? ($title[0][2] ? $title[0][2] : $title[0][1]) : $title[0][1];
        $web_keyword = $title[0][3];
        $web_desc = $title[0][4];
    } else {
        $web_title = "ZAC & JEANS COLLECTION'S";
        $web_keyword = '';
        $web_desc = '';
    }
}
?>