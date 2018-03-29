<?php

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
                $data_about = selectData("about", "", "*");
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

            // Action edit
            case 'edit':
                $data_about = selectData("about", "id_about = '" . $id_about . "'", "*");
                $result     = updatePageAbout($data, $action_update, $data_about);
                break;

            // Action delete
            case 'del':
                $result = deletePageAbout($id_about);
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
function addPageBanner($data, $action_add) {
    // Define notice
    $notice = array();

    if (isset($action_add)) {
        if (!$data['id_category']) {
            $class_alert           = "alert alert-danger";
            $content_notice        = "Please input fill info !";
            modalInfo($class_alert, $content_notice);
            $notice['id_category'] = TRUE;
        } else {
            $type          = pathinfo($data['image']['name'], PATHINFO_EXTENSION);
            $typeFileAllow = array('png', 'jpg', 'jpeg', 'gif', 'png');
            if ($data['image']['name'] != NULL) {
                if (in_array($type, $typeFileAllow)) {
                    if ($data['image']['size'] > 1048576) {
                        $class_alert          = "alert alert-danger";
                        $content_notice       = "File size > 1Mb !";
                        modalInfo($class_alert, $content_notice);
                        $notice['image_size'] = TRUE;
                    } else {
                        $path          = "data/banner/";
                        $tmp_name      = $data['image']['tmp_name'];
                        $name          = basename(md5($data['image']['name'] . time()) . "." . $type);
                        $image         = $path . $name;
                        // Move file ---------------------------------------------------------------------------
                        move_uploaded_file($tmp_name, $image);
                        // Upload file -----------------------------------------------------------------------------
                        $insert_banner = insertData("banner", "image, is_display, id_category", "'" . $image . "',1,'" . $data['id_category'] . "'");
                        if ($insert_banner) {
                            $class_alert       = "alert alert-success";
                            $content_notice    = "Done !";
                            modalInfo($class_alert, $content_notice);
                            $notice['success'] = TRUE;
                        } else {
                            $class_alert    = "alert alert-danger";
                            $content_notice = "Add banner fail !";
                            modalInfo($class_alert, $content_notice);
                            $notice['fail'] = TRUE;
                        }
                    }
                } else {
                    $class_alert     = "alert alert-danger";
                    $content_notice  = "File not apply !";
                    modalInfo($class_alert, $content_notice);
                    $notice['image'] = TRUE;
                }
            }
        }
    }
    return $notice;
}

/*
 * update item about Page About
 * 
 * @param array $data
 * @param string $action_update
 * @param array $data_about
 * 
 */
function updatePageAbout($data, $action_update, $data_about) {
    // Define notice
    $notice = array();

    if (isset($action_update)) {
        if (!$data['about'] || !$data['content']) {
            $class_alert    = "alert alert-danger";
            $content_notice = "Please input fill info !";
            modalInfo($class_alert, $content_notice);
            if (!$data['about']) {
                $notice['about'] = TRUE;
            } else {
                $notice['content'] = TRUE;
            }
        } else {
            $hinhanh = $data['image']['name'];
            if ($hinhanh != NULL) {
                $type          = pathinfo($data['image']['name'], PATHINFO_EXTENSION);
                $typeFileAllow = array('png', 'jpg', 'jpeg', 'gif', 'png');
                if (in_array($type, $typeFileAllow)) {
                    if ($data['image']['size'] > 1048576) {
                        $class_alert          = "alert alert-danger";
                        $content_notice       = "File size > 1Mb !";
                        modalInfo($class_alert, $content_notice);
                        $notice['image_size'] = TRUE;
                    } else {
                        $path     = "data/about/";
                        $tmp_name = $data['image']['tmp_name'];
                        $name     = basename(md5($data['image']['name'] . time()) . "." . $type);
                        $hinhanh  = $path . $name;
                        move_uploaded_file($tmp_name, $hinhanh);
                    }
                } else {
                    $class_alert     = "alert alert-danger";
                    $content_notice  = "File not apply !";
                    modalInfo($class_alert, $content_notice);
                    $notice['image'] = TRUE;
                }
            } else {
                $hinhanh = $data_about[0][3];
            }
            $update_about = updateData("about", "about='" . $data['about'] . "', about_english='" . $data['about_english'] . "', image='" . $hinhanh . "', content='" . $data['content'] . "', content_english='" . $data['content_english'] . "'", "id_about = '" . $data_about[0]['id_about'] . "'");
            if ($update_about) {
                $class_alert       = "alert alert-success";
                $content_notice    = "Done !";
                modalInfo($class_alert, $content_notice);
                $notice['success'] = TRUE;
            } else {
                $class_alert    = "alert alert-danger";
                $content_notice = "Update about fail !";
                modalInfo($class_alert, $content_notice);
                $notice['fail'] = TRUE;
            }
        }
    }
    return $notice;
}

/*
 * delete item about Page About
 * 
 * @param string $id_about
 * 
 */
function deletePageAbout($id_about) {
    if ($id_about > 0) {
        modalConfirm("about", "id_about = '" . $id_about . "'", "?page=about");
        return TRUE;
    }
    return FALSE;
}

/*
 * add item about Page About
 * 
 * @param array $data
 * @param string $action_add
 * 
 */
function addPageAbout($data, $action_add) {
    // Define notice
    $notice = array();

    // Add data about
    if (isset($action_add)) {
        if (!$data['about'] || !$data['content']) {
            $class_alert    = "alert alert-danger";
            $content_notice = "Please input fill info !";
            modalInfo($class_alert, $content_notice);
            if (!$data['about']) {
                $notice['about'] = TRUE;
            } else {
                $notice['content'] = TRUE;
            }
        } else {
            $type          = pathinfo($data['image']['name'], PATHINFO_EXTENSION);
            $typeFileAllow = array('png', 'jpg', 'jpeg', 'gif', 'png');
            if ($data['image']['name'] != NULL) {
                if (in_array($type, $typeFileAllow)) {
                    if ($data['image']['size'] > 1048576) {
                        $class_alert          = "alert alert-danger";
                        $content_notice       = "File size > 1Mb !";
                        modalInfo($class_alert, $content_notice);
                        $notice['image_size'] = TRUE;
                    } else {
                        $path         = "data/about/";
                        $tmp_name     = $data['image']['tmp_name'];
                        $name         = basename(md5($data['image']['name'] . time()) . "." . $type);
                        $hinhanh      = $path . $name;
                        move_uploaded_file($tmp_name, $hinhanh);
                        $insert_about = insertData("about", "about, about_english, image, content, content_english", "'" . $data['about'] . "','" . $data['about_english'] . "','" . $hinhanh . "','" . $data['content'] . "','" . $data['content_english'] . "'");
                        if ($insert_about) {
                            $class_alert       = "alert alert-success";
                            $content_notice    = "Done !";
                            modalInfo($class_alert, $content_notice);
                            $notice['success'] = TRUE;
                        } else {
                            $class_alert    = "alert alert-danger";
                            $content_notice = "Add about fail !";
                            modalInfo($class_alert, $content_notice);
                            $notice['fail'] = TRUE;
                        }
                    }
                } else {
                    $class_alert     = "alert alert-danger";
                    $content_notice  = "File not apply !";
                    modalInfo($class_alert, $content_notice);
                    $notice['image'] = TRUE;
                }
            }
        }
    }
    return $notice;
}

/*
 * Page Home
 * 
 */
function actionPageHome() {
    // Define notification
    $notify_page_home = FALSE;

    // Check login
    if ($_SESSION['user']) {
        redirectToPage('banner');
    }

    // Login user
    if (isset($_POST['btn-login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        if (!$username || !$password) {
            $class_alert      = "alert alert-danger";
            $content_notice   = "Please input fill info login !";
            modalInfo($class_alert, $content_notice);
            // Set notification
            $notify_page_home = TRUE;
        } else {
            $account = selectData("account", "username = '" . $username . "' AND password = '" . $password . "'", "*");
            if ($account) {
                $_SESSION['user'] = TRUE;
                $_SESSION['user'] = $account[0][0];
                redirectToPage('banner');
            } else {
                $class_alert      = "alert alert-danger";
                $content_notice   = 'The username or password is incorrect. Please input again';
                modalInfo($class_alert, $content_notice);
                // Set notification
                $notify_page_home = TRUE;
            }
        }
    }
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
