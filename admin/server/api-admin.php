<?php

include_once("./controller/about.php");
include_once("./controller/banner.php");
include_once("./controller/category.php");
include_once("./controller/customer.php");
include_once("./controller/home.php");

// Get variable
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}
if ($page == 'logout') {
    unset($_SESSION['user']);
    header("Location: ?page=home");
}

// Pagination
$pp_product  = 20;
$pp_customer = 40;

// Get number page present
$trang = intval($_GET['trang']);
if (!$trang) {
    $trang = 1;
}

// Define variable for page
$result = array();
$data   = array();

// Process for page
switch ($page) {

    // Page customer
    case 'customer':

        // Get data
        $id_customer        = intval($_GET['id']);
        $data_customer      = array();
        $data['name']       = $_POST['dk-name'];
        $data['email']      = $_POST['dk-email'];
        $data['phone']      = $_POST['dk-phone'];
        $data['address']    = $_POST['dk-address'];
        $data['username']   = $_POST['dk-usrname'];
        $data['password']   = md5($_POST['dk-psw']);
        $data['permission'] = $_POST['permission'];
        $data['confirm']    = md5($_POST['dk-confirm']);
        $action_add         = $_POST['btn-plus'];
        $action_update      = $_POST['btn-update'];

        // Proccess follow action
        switch ($act) {

            // Action add
            case 'add':
                $result = addPageCustomer($data, $action_add);
                break;

            // Action edit
            case 'edit':
                $data_customer = selectData("customer", "id_customer = '" . $id_customer . "'", "*");
                $data_account  = selectData("account", "id_account = '" . $data_customer[0]['id_account'] . "'", "*");
                $result        = updatePageCustomer($data, $action_update, $data_customer, $data_account);
                break;

            // Action delete
            case 'del':
                break;

            // Load list
            default:
                $data_total                = selectData("customer", "1=1", "*");
                $data_pagination           = array();
                $$data_pagination['total'] = count($data_total);
                $numofpages                = $total / $pp_customer;
                if ($trang <= 0) {
                    $$data_pagination['page'] = 1;
                } else {
                    if ($trang <= ceil($numofpages))
                        $$data_pagination['page'] = $trang;
                    else
                        $$data_pagination['page'] = 1;
                }
                $limitvalue = ($page * $pp_customer) - $pp_customer;
                if ($limitvalue <= 0) {
                    $limitvalue = 0;
                }
                $data_pagination['self'] = "index.php?page=customer&trang=";
                $data_customer           = selectData("customer", "1=1 LIMIT $limitvalue,$pp_customer", "*");
                break;
        }
        break;

    // Page category
    case 'category':

        // Get data
        $id_category = intval($_GET['id']);
        if (isset($_GET['level'])) {
            $level = $_GET['level'];
        }
        $data_category            = array();
        $data['category']         = addslashes($_POST['dk-category']);
        $data['category_english'] = addslashes($_POST['dk-category-english']);
        $data['image']            = $_FILES['dk-image'];
        $data['level']            = $_POST['dk-level'];
        $action_add               = $_POST['btn-plus'];
        $action_update            = $_POST['btn-update'];
        $arr_option_category      = selectData("category", "level = 0", "id_category, category");

        // Proccess follow action
        switch ($act) {

            // Action add
            case 'add':
                $result = addPageCategory($data, $action_add);
                break;

            // Action edit
            case 'edit':
                $data_category = selectData("category", "id_category = '" . $id_category . "'", "*");
                $result        = updatePageCategory($data, $action_update, $data_category);
                break;

            // Action delete
            case 'del':
                break;

            // Load list
            default:
                $data_category = selectData("category", "level = 0", "*");
                if ($level == 2) {
                    $data_category = selectData("category", "level != 0 ORDER BY level", "*");
                }
                break;
        }
        break;

    // Page banner
    case 'banner':

        // Get data
        $id_banner           = intval($_GET['id']);
        $data_banner         = array();
        $data['image']       = $_FILES['dk-image'];
        $data['id_category'] = $_POST['dk-category'];
        $action_add          = $_POST['btn-plus'];
        $action_update       = $_POST['btn-update'];
        $data_category       = selectData("category", "level = 0", "id_category, category");

        // Proccess follow action
        switch ($act) {

            // Action add
            case 'add':
                $result = addPageBanner($data, $action_add);
                break;

            // Action edit
            case 'edit':
                $data_banner = selectData("about", "id_about = '" . $id_banner . "'", "*");
                $result      = updatePageBanner($data, $action_update, $data_banner);
                break;

            // Action delete
            case 'del':
                $result = deletePageBanner($id_banner);
                break;

            // Load list
            default:
                $data_banner = selectData("banner", "", "*");
                break;
        }
        break;

    // Page About
    case 'about':

        // Get data
        $id_about   = intval($_GET['id']);
        $data_about = array();

        $data['about']           = addslashes($_POST['dk-about']);
        $data['about_english']   = addslashes($_POST['dk-about-english']);
        $data['image']           = $_FILES['dk-image'];
        $data['content']         = $_POST['dk-content'];
        $data['content_english'] = $_POST['dk-content-english'];
        $action_add              = $_POST['btn-plus'];
        $action_update           = $_POST['btn-update'];


        // Proccess follow action
        switch ($act) {

            // Action add
            case 'add':
                $result = addPageAbout($data, $action_add);
                break;

            // Action delete
            case 'del':
                break;

            // Load list
            default:
                $data_about = selectData("about", "", "*");
                break;
        }
        break;

    // Page Home
    default:
        actionPageHome();
        break;
}

/*
 * Redirect to landing page
 * 
 * @param string $page
 * 
 */
function redirectToPage($page) {
    echo "<script>parent.location = '?page=" . $page . "';</script>";
}
