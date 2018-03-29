<?php
include_once("../server/connect.php");
include_once("../server/common.php");
include_once("../server/api-admin.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="../assets/image/font-end/icon.png" rel="shortcut icon" />
        <title>Welcome to Administrator</title>

        <!-- Bootstrap Core CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="assets/css/style-page-admin.css">

        <!-- Custom Fonts -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <!-- Bootstrap Core JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({selector: 'textarea'});</script>

        <!-- JS -->
        <script src="assets/javascript/js-page-admin.js"></script>
    </head>

    <body>
        <div id="wrapper">
            <!-- Modal notice from ajax -->
            <div class="modal fade" id="modalAjaxGood" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="title-checkout"><strong>ZAC & JEANS COLLECTION'S</strong></h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success">
                                <strong>Done !</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalAjaxFail" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="title-checkout"><strong>ZAC & JEANS COLLECTION'S</strong></h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                <strong>Update fail !</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End modal -->

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand title-home" href="/admin/">Admin - ZAC & JEAN Collection's</a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php
                            $bill = selectData("bill", "status = 0 ORDER BY date DESC", "id_customer, date");
                            ?>
                            <span class="badge cart-badge"><?php echo count($data); ?></span> NOTICE <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <?php
                            for ($i = 0; $i < count($bill); $i++) {
                                $customer = selectData("customer", "id_customer = '" . $bill[$i][0] . "'", "customer");
                                ?>
                                <li>
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> <?php echo $customer[0][0]; ?>
                                        <span class="pull-right text-muted small"><?php echo date('Y/m/d', $bill[$i][1]); ?></span>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="?page=bill&state=0">
                                    <strong>See All</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <?php
                        if (!isset($_SESSION['user'])) {
                            ?>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> UNDERFINE <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#"><i class="fa fa-user fa-fw"></i> ACCOUNT</a>
                                </li>
                            </ul>
                            <?php
                        } else {
                            $account = selectData("account", "id_account = '" . $_SESSION['user'] . "'", "username");
                            $row_account = $account;
                            $user = selectData("user", "id_account = '" . $_SESSION['user'] . "'", "id");
                            $row_user = $user;
                            ?>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> <?php echo strtoupper($row_account[0][0]); ?> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="?page=user&act=edit&id=<?php echo $row_user[0][0]; ?>"><i class="fa fa-user fa-fw"></i> ACCOUNT</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="?page=logout"><i class="fa fa-sign-out fa-fw"></i> LOGOUT</a>
                                </li>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>
                </ul>
                <?php if (isset($_SESSION['user'])) : ?>
                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">
                                <li>
                                    <a href="?page=banner"><i class="fa fa-picture-o fa-fw"></i> BANNER</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-dashboard fa-fw"></i> CATEGORY<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?page=category&level=0"><span>ALL</span></a>
                                        </li>
                                        <li>
                                            <a href="?page=category&level=1"><span>LEVEL 1</span></a>
                                        </li>
                                        <li>
                                            <a href="?page=category&level=2"><span>LEVEL 2</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> PRODUCT<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?page=product&category=0"><span>ALL</span></a>
                                        </li>
                                        <?php
                                        $data = selectData("category", "level = 0", "*");
                                        for ($i = 0; $i < count($data); $i++) {
                                            $data_sub = selectData("category", "level = '" . $data[$i][0] . "'", "*");
                                            ?>
                                            <li>
                                                <a href="#"><span <?php echo count($data_sub) > 0 ? 'class="fa arrow"' : ''; ?>></span><?php echo $data[$i][1]; ?></a>
                                                <ul class="nav nav-third-level">
                                                    <?php
                                                    for ($j = 0; $j < count($data_sub); $j++) {
                                                        ?>
                                                        <li>
                                                            <a href="?page=product&category=<?php echo $data_sub[$j][0]; ?>"><?php echo $data_sub[$j][1]; ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-plus-square fa-fw"></i> BILL<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?page=bill&state=0"><span>ALL</span></a>
                                        </li>
                                        <li>
                                            <a href="?page=bill&state=1"><span>NEW</span></a>
                                        </li>
                                        <li>
                                            <a href="?page=bill&state=2"><span>SHIPPING</span></a>
                                        </li>
                                        <li>
                                            <a href="?page=bill&state=3"><span>DONE</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="?page=customer"><i class="fa fa-user fa-fw"></i> CUSTOMER</a>
                                </li>
                                <li>
                                    <a href="?page=user"><i class="fa fa-user-secret fa-fw"></i> USER</a>
                                </li>
                                <li>
                                    <a href="?page=object"><i class="fa fa-user fa-fw"></i> OBJECT</a>
                                </li>
                                <li>
                                    <a href="?page=size"><i class="fa fa-wrench fa-fw"></i> SIZE</a>
                                </li>
                                <li>
                                    <a href="?page=store"><i class="fa fa-university fa-fw"></i> STORE</a>
                                </li>
                                <li>
                                    <a href="?page=about"><i class="fa fa-question-circle-o fa-fw"></i> ABOUT</a>
                                </li>
                                <li>
                                    <a href="?page=help"><i class="fa fa-leanpub fa-fw"></i> HELP</a>
                                </li>
                                <li>
                                    <a href="?page=title"><i class="fa fa-audio-description fa-fw"></i> TITLE</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </nav>

            <div id="page-wrapper">
                <?php
                $array_page = array('category', 'product', 'user', 'customer', 'bill', 'object', 'size', 'banner', 'store', 'about', 'help', 'title', 'sql');
                if (in_array($page, $array_page) && isset($_SESSION['user'])) {
                    include("page/$page.php");
                } else {
                    include("page/home.php");
                }
                ?>
            </div>
        </div>
    </body>
</html>