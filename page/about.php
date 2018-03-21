<style>
    a:hover, a:focus {
        text-decoration: none !important;
    }
    .sidebar-nav {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .sidebar-nav li a h3 {
        color: orangered;
        font-size: 28px;
        font-family: "DIN Next W01 Bold",arial;
        padding-top: 5px;
        text-decoration: none;
    }
    .sidebar-nav .first a {
        border-top: 0.5px solid #000;
    }
    .sidebar-nav .text-menu a {
        color: #000;
        display: block;
        border-bottom: 0.5px solid #000;
        padding: 9.5px 10px 9.5px 11px;
        letter-spacing: .6px;
        font-size: 16px;
        font-family: "DIN Next W01 Regular",arial;
    }
    .sidebar-nav .text-menu .icon {
        float: right;
    }
    .sidebar-nav .text-menu a:hover {
        color: orangered;
    }
    .sidebar-nav .text-menu .text-menu-active {
        text-decoration: none;
        color: orangered;
    }
    .navbar-default {
        background-color: #eeeeee;
        border-bottom:6px solid #00cdc0;
    }
    .navbar {
        margin-bottom: 2px;
    }
    .card {
        display: inline-block;
        position: relative;
        width: 100%;
        margin: 25px 0;
        box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
        border-radius: 3px;
        color: rgba(0,0,0, 0.87);
        background: #fff;
    }
    .card .card-height-indicator {
        margin-top: 100%;
    }
    .card .title {
        margin-top: 0;
        margin-bottom: 5px;
    }
    .card .card-image {
        height: 60%;
        position: relative;
        overflow: hidden;
        margin-left: 15px;
        margin-right: 15px;
        margin-top: -30px;
        border-radius: 6px;
    }
    .card .card-image img {
        width: 100%;
        height: 100%;
        border-radius: 6px;
        pointer-events: none;
    }
    .card .card-image .card-title {
        position: absolute;
        bottom: 15px;
        left: 15px;
        color: #fff;
        font-size: 1.3em;
        text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5);
    }
    .card .category:not([class*="text-"]) {
        color: #999999;
    }
    .card .card-content {
        padding: 15px 20px;
    }
    .card .card-content .category {
        margin-bottom: 0;
    }
    .card .card-content .header {
        color: #000;
        font-weight: bold;
        font-family: "DIN Next W01 Regular",arial!important;
        margin-top: 30px;
    }
    .card .card-content .question {
        color: red;
    }
    .card .card-content .title {
        color: #000;
        font-weight: 400;
    }
    .card .card-header {
        box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
        border-radius: 3px;
        padding: 15px;
        background-color: #999999;
    }
    .card .card-header .title {
        color: #FFFFFF;
    }
    .card .card-header .category {
        margin-bottom: 0;
        color: rgba(255, 255, 255, 0.62);
    }
    .card .card-header.card-chart {
        padding: 0;
        min-height: 160px;
    }
    .card .card-header.card-chart + .content h4 {
        margin-top: 0;
    }
    .card [data-background-color="orange"] {
        background: orangered;
    }
    .card [data-background-color] {
        color: #FFFFFF;
    }
    .card [data-background-color] a {
        color: #FFFFFF;
    }
    .card-about {
        padding: 20px;
    }
    .image-about {
        width: 25%;
    }
    @media (max-width: 767px) {
        .card-content {
            border: none;
        }
    }
</style>
<ul class="breadcrumb" id="category-breadcrumb">
    <li><a href="/home"><?php echo $var_home; ?></a></li>
    <li class="active"><?php echo $var_about; ?></li>
</ul>
<!--HELP-->
<div id="container">
    <!-- Sidebar -->
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <ul class="sidebar-nav">
                    <li><a><h3> <?php echo $var_about; ?></h3></a></li>
                    <li class="text-menu"><a class="<?php echo $about == $arr_about[0]['id_about'] || $about == NULL ? 'text-menu-active' : ''; ?>" href="/about-<?php echo $arr_about[0]['id_about']; ?>"><?php echo $_SESSION['lang'] == 'english' ? ($arr_about[0]['about_english'] ? $arr_about[0]['about_english'] : $arr_about[0]['about']) : $arr_about[0]['about']; ?></a></li>
                    <?php for ($i = 1; $i < count($arr_about); $i++) : ?>
                        <li class="text-menu"><a class="<?php echo $about == $arr_about[$i]['id_about'] ? 'text-menu-active' : ''; ?>" href="/about-<?php echo $arr_about[$i]['id_about']; ?>"><?php echo $_SESSION['lang'] == 'english' ? ($arr_about[$i]['about_english'] ? $arr_about[$i]['about_english'] : $arr_about[$i]['about']) : $arr_about[$i]['about']; ?> </a></li>
                    <?php endfor; ?>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <?php if ($about == $arr_about[0]['id_about'] || $about == NULL) : ?>
                                <div class="card-header" data-background-color="orange">
                                    <h3 class="title"><i class="glyphicon glyphicon-question-sign"></i> <?php echo $_SESSION['lang'] == 'english' ? ($arr_about[0]['about_english'] ? $arr_about[0]['about_english'] : $arr_about[0]['about']) : $arr_about[0]['about']; ?></h3>
                                </div>
                                <div class="card-about">
                                    <img class="image-about" src="/admin/<?php echo $arr_about[0]['image']; ?>">
                                </div>
                                <div class="card-content table-responsive">
                                    <p><?php echo $_SESSION['lang'] == 'english' ? ($arr_about[0]['content_english'] ? $arr_about[0]['content_english'] : $arr_about[0]['content']) : $arr_about[0]['content']; ?></p>
                                </div>
                            <?php endif; ?>
                            <?php
                            for ($i = 1; $i < count($arr_about); $i++) {
                                if ($about == $arr_about[$i]['id_about']) {
                                    ?>
                                    <div class="card-header" data-background-color="orange">
                                        <h3 class="title"><i class="glyphicon glyphicon-question-sign"></i> <?php echo $_SESSION['lang'] == 'english' ? ($arr_about[$i]['about_english'] ? $arr_about[$i]['about_english'] : $arr_about[$i]['about']) : $arr_about[$i]['about']; ?></h3>
                                    </div>
                                    <div class="card-about">
                                        <img class="image-about" src="/admin/<?php echo $arr_about[$i]['image']; ?>">
                                    </div>
                                    <div class="card-content table-responsive">
                                        <p><?php echo $_SESSION['lang'] == 'english' ? ($arr_about[$i]['content_english'] ? $arr_about[$i]['content_english'] : $arr_about[$i]['content']) : $arr_about[$i]['content']; ?></p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>      
</div>