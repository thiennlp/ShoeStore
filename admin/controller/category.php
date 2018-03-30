<?php

/*
 * update item about Page Category
 * 
 * @param array $data
 * @param string $action_update
 * @param array $data_category
 * 
 */
function updatePageCategory($data, $action_update, $data_category) {
    // Define notice
    $notice     = array();
    $is_display = $data_category[0]['is_display'];
    if (isset($_POST['btn-update'])) {
        if (!$data['category']) {
            $class_alert        = "alert alert-danger";
            $content_notice     = "Please input fill info !";
            modalInfo($class_alert, $content_notice);
            $notice['category'] = TRUE;
        } else {
            $image         = $data['image']['name'];
            $type          = pathinfo($_FILES['dk-image']['name'], PATHINFO_EXTENSION);
            $typeFileAllow = array('png', 'jpg', 'jpeg', 'gif', 'png');
            if ($image != NULL) {
                if (in_array($type, $typeFileAllow)) {
                    if ($data['image']['size'] > 1048576) {
                        $class_alert          = "alert alert-danger";
                        $content_notice       = "File size > 1Mb !";
                        modalInfo($class_alert, $content_notice);
                        $notice['image_size'] = TRUE;
                    } else {
                        $path     = "data/category/";
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
                $image = $data_category[0]['image'];
            }
            $update_category = updateData("category", "category='" . $data['category'] . "', category_english='" . $data['category_english'] . "', image='" . $image . "', is_display='" . $is_display . "', level='" . $data['level'] . "'", "id_category = '" . $data_category['id_category'] . "'");
            if ($update_category) {
                $class_alert       = "alert alert-success";
                $content_notice    = "Done !";
                modalInfo($class_alert, $content_notice);
                $notice['success'] = TRUE;
            } else {
                $class_alert    = "alert alert-danger";
                $content_notice = "Add category fail !";
                modalInfo($class_alert, $content_notice);
                $notice['fail'] = TRUE;
            }
        }
    }
    return $notice;
}

/*
 * add item about Page Category
 * 
 * @param array $data
 * @param string $action_add
 * 
 */
function addPageCategory($data, $action_add) {
    // Define notice
    $notice = array();

    if (isset($action_add)) {
        if (!$data['category'] || !$data['image']) {
            $class_alert    = "alert alert-danger";
            $content_notice = "Please input fill info !";
            modalInfo($class_alert, $content_notice);
            if (!$data['category']) {
                $notice['category'] = TRUE;
            } else {
                $notice['image'] = TRUE;
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
                        $path            = "data/category/";
                        $tmp_name        = $data['image']['tmp_name'];
                        $name            = basename(md5($data['image']['name'] . time()) . "." . $type);
                        $image           = $path . $name;
                        // Move file ---------------------------------------------------------------------------
                        move_uploaded_file($tmp_name, $image);
                        // Upload file -----------------------------------------------------------------------------
                        $insert_category = insertData("category", "category, category_english, image, is_display, level", "'" . $data['category'] . "','" . $data['category_english'] . "','" . $image . "', 1,'" . $data['level'] . "'");
                        if ($insert_category) {
                            $class_alert       = "alert alert-success";
                            $content_notice    = "Done !";
                            modalInfo($class_alert, $content_notice);
                            $notice['success'] = TRUE;
                        } else {
                            $class_alert    = "alert alert-danger";
                            $content_notice = "Add category fail !";
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
