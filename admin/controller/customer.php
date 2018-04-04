<?php

/*
 * update item about Page Customer
 * 
 * @param array $data
 * @param string $action_update
 * @param array $data_customer
 * @param array $data_account
 * 
 */
function updatePageCustomer($data, $action_update, $data_customer, $data_account) {
    // Define notice
    $notice = array();
    if (isset($action_update)) {
        if (!$data['name'] || !$data['phone'] || !$data['address'] || !$data['username'] || !$data['password']) {
            $class_alert    = "alert alert-danger";
            $content_notice = "Please input fill info !";
            modalInfo($class_alert, $content_notice);
            if ($data['name']) {
                $notice['name'] = TRUE;
            } elseif ($data['phone']) {
                $notice['phone'] = TRUE;
            } elseif ($data['address']) {
                $notice['address'] = TRUE;
            } elseif ($data['username']) {
                $notice['username'] = TRUE;
            } else {
                $notice['password'] = TRUE;
            }
        } elseif ($data['password'] != $data['confirm']) {
            $class_alert                = "alert alert-danger";
            $content_notice             = "confirm password wrong !";
            modalInfo($class_alert, $content_notice);
            $notice['confirm_password'] = TRUE;
        } elseif ($data['email'] && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $class_alert     = "alert alert-danger";
            $content_notice  = "E-mail fail ! !";
            modalInfo($class_alert, $content_notice);
            $notice['email'] = TRUE;
        } elseif (strlen($data['password']) < 8) {
            $class_alert        = "alert alert-danger";
            $content_notice     = "Password need more than 8 characters !";
            modalInfo($class_alert, $content_notice);
            $notice['password'] = TRUE;
        } else {
            $id_account = selectData("customer", "id_customer = '" . $data_customer[0]['id_customer'] . "'", "id_account");
            if ($id_account) {
                $update_account = updateData("account", "username='" . $data['username'] . "', password='" . $data['password'] . "', permission='" . $data['permission'] . "'", "id_account = '" . $id_account[0][0] . "'");
                if ($update_account) {
                    $update_customer = updateData("customer", "name='" . $data['name'] . "', email='" . $data['email'] . "', phone='" . $data['phone'] . "', address='" . $address . "'", "id_customer = '" . $id_customer . "'");
                    if ($update_customer) {
                        $class_alert       = "alert alert-success";
                        $content_notice    = "Done !";
                        modalInfo($class_alert, $content_notice);
                        $notice['success'] = TRUE;
                    } else {
                        $class_alert    = "alert alert-danger";
                        $content_notice = "Update fail !";
                        modalInfo($class_alert, $content_notice);
                        $notice['fail'] = TRUE;
                    }
                } else {
                    $class_alert     = "alert alert-danger";
                    $content_notice  = $mysqli->error;
                    modalInfo($class_alert, $content_notice);
                    $notice['error'] = TRUE;
                }
            }
        }
    }


    return $notice;
}

/*
 * add item about Page Customer
 * 
 * @param array $data
 * @param string $action_add
 * 
 */
function addPageCustomer($data, $action_add) {
    // Define notice
    $notice = array();

    if (isset($action_add)) {
        $row_account = selectData("account", "username = '" . $data['username'] . "'", "username");
        if (!$data['name'] || !$data['phone'] || !$data['address'] || !$data['username'] || !$data['password']) {
            $class_alert    = "alert alert-danger";
            $content_notice = "Please input fill info !";
            modalInfo($class_alert, $content_notice);
            if ($data['name']) {
                $notice['name'] = TRUE;
            } elseif ($data['phone']) {
                $notice['phone'] = TRUE;
            } elseif ($data['address']) {
                $notice['address'] = TRUE;
            } elseif ($data['username']) {
                $notice['username'] = TRUE;
            } else {
                $notice['password'] = TRUE;
            }
        } elseif ($password != $confirm) {
            $class_alert                = "alert alert-danger";
            $content_notice             = "Confirm password wrong !";
            modalInfo($class_alert, $content_notice);
            $notice['confirm_password'] = TRUE;
        } elseif ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $class_alert     = "alert alert-danger";
            $content_notice  = "E-mail wrong ! !";
            modalInfo($class_alert, $content_notice);
            $notice['email'] = TRUE;
        } elseif ($row_account[0][0] == $username) {
            $class_alert             = "alert alert-danger";
            $content_notice          = "Account is exist !";
            modalInfo($class_alert, $content_notice);
            $notice['account_exist'] = TRUE;
        } elseif (strlen($password) < 8) {
            $class_alert        = "alert alert-danger";
            $content_notice     = "Password need more than 8 characters !";
            modalInfo($class_alert, $content_notice);
            $notice['password'] = TRUE;
        } else {
            $insert_account = insertData("account", "username, password, permission", "'" . $username . "','" . $password . "','" . $permission . "'");
            if ($insert_account) {
                $id_account = selectData("account", "username = '" . $username . "' AND password = '" . $password . "'", "id_account");
                if ($id_account) {
                    $insert_customer = insertData("customer", "name, email, phone, address, id_account", "'" . $name . "','" . $email . "','" . $phone . "','" . $address . "','" . $id_account[0][0] . "'");
                    if ($insert_customer) {
                        $class_alert       = "alert alert-success";
                        $content_notice    = "Done !";
                        modalInfo($class_alert, $content_notice);
                        $notice['success'] = TRUE;
                    } else {
                        $class_alert    = "alert alert-danger";
                        $content_notice = "Register fail !";
                        modalInfo($class_alert, $content_notice);
                        $notice['fail'] = TRUE;
                    }
                }
            } else {
                $class_alert     = "alert alert-danger";
                $content_notice  = $mysqli->error;
                modalInfo($class_alert, $content_notice);
                $notice['error'] = TRUE;
            }
        }
    }
    return $notice;
}
