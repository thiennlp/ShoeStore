<?php

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
