<?php

/*
 * delete item about Page Banner
 * 
 * @param string $id_banner
 * 
 */
function deletePageBanner($id_banner) {
    if ($id_banner > 0) {
        return TRUE;
    }
    return FALSE;
}

/*
 * add item about Page Banner
 * 
 * @param array $data
 * @param string $action_add
 * 
 */
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
