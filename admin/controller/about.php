<?php

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
