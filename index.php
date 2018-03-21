<?php
include_once("/server/connect.php");
include_once("/server/common.php");
include_once("/server/api.php");

$lang = setLang($_SESSION['lang']);
include_once($lang);
if (isset($_POST['btn-english'])) {
    $lang = setLang('english');
     include_once($lang);
}
if (isset($_POST['btn-vietnamese'])) {
    $lang = setLang('vietnamese');
     include_once($lang);
}
include_once($lang);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $web_title; ?></title>
        <meta name="description" content="<?php echo $web_description; ?>">
        <meta name="keywords" content="<?php echo $web_keywords; ?>">
        <link href="/assets/image/font-end/icon.png" rel="shortcut icon" />
        <!-- Custom Fonts -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <!--Css-->
        <link href="/assets/css/style.css" rel="stylesheet" />
        <link href="/assets/css/style-category.css" rel="stylesheet" />
        <link href="/assets/css/style-cart.css" rel="stylesheet" />
        <link href="/assets/css/style-log.css" rel="stylesheet" />
        <!-- Bootstrap Core JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- JS -->
        <script src="/assets/javascript/js-base.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <!--Header-->
            <?php include("page/header.php") ?>
            <!--/Header-->
            <!--Main-->
            <main>
                <div id="main">
                    <?php
                    $array_page = array('category', 'about', 'store', 'help', 'login', 'register', 'cart', 'product', 'search', 'checkout');
                    if (in_array($page, $array_page)) {
                        include("page/$page.php");
                    } else {
                        include("page/home.php");
                    }
                    ?>
                </div>
            </main>
            <!--/Main-->
            <!--Footer-->
            <?php include("page/footer.php") ?>
            <!--/Footer-->
            <button onclick="topFunction()" id="back-top" title="Go to top">TOP</button>
        </div>
    </body>
</html>