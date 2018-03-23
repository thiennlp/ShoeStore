<ul class="breadcrumb" id="category-breadcrumb">
    <li><a href="/home"><?php echo $var_home; ?></a></li>
    <li class="active"><?php echo $var_store; ?></li>
</ul>
<!--PAGE STORE-->
<div id="container" class="toggled">
    <div class="row">
        <div class="col-md-12">
            <!--Side bar-->
            <div class="col-md-3">
                <ul class="sidebar-nav">
                    <li><a><h3> <?php echo $var_store; ?></h3></a></li>
                    <?php for ($i = 0; $i < count($arr_store); $i++) : ?>
                        <li class="text-menu"><a class="<?php echo $store == $arr_store[$i]['id_store'] ? 'text-menu-active' : ''; ?>" href="/store-<?php echo $arr_store[$i]['id_store']; ?>"><?php echo $arr_store[$i]['store']; ?> </a></li>
                    <?php endfor; ?>
                </ul>
            </div>
            <!--/Side bar-->
            <!--Content-->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($store == $arr_store[0]['id_store'] || $store == NULL) : ?>
                            <div class="col-md-6">
                                <div class="col-md-12 foundation">
                                    <h3><?php echo $arr_store[0]['store']; ?></h3>
                                    <div class="col-md-12 foundation_sm">
                                        <ul>
                                            <li><i class="fa fa-address-book-o" aria-hidden="true"></i>Address : <?php echo $_SESSION['lang'] == 'english' ? ($arr_store[0]['address_english'] ? $arr_store[0]['address_english'] : $arr_store[0]['address']) : $arr_store[0]['address']; ?></li>
                                            <li><i class="fa fa-flag" aria-hidden="true"></i>Time : <?php echo $arr_store[0]['time']; ?></li>
                                            <li><i class="fa fa-phone" aria-hidden="true"></i>Phone : <?php echo $arr_store[0]['phone']; ?> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="image-store" src="/admin/<?php echo $arr_store[0]['image']; ?>">
                            </div>
                        <?php endif; ?>
                        <?php for ($i = 1; $i < count($arr_store); $i++) : ?>
                            <?php if ($store == $arr_store[$i]['id_store']) : ?>
                                <div class="col-md-6">
                                    <div class="col-md-12 foundation">
                                        <h3><?php echo $arr_store[$i]['store']; ?></h3>
                                        <div class="col-md-12 foundation_sm">
                                            <ul>
                                                <li><i class="fa fa-address-book-o" aria-hidden="true"></i>Address : <?php echo $_SESSION['lang'] == 'english' ? ($arr_store[$i]['address_english'] ? $arr_store[$i]['address_english'] : $arr_store[$i]['address']) : $arr_store[$i]['address']; ?></li>
                                                <li><i class="fa fa-flag" aria-hidden="true"></i>Time : <?php echo $arr_store[$i]['time']; ?></li>
                                                <li><i class="fa fa-phone" aria-hidden="true"></i>Phone : <?php echo $arr_store[$i]['phone']; ?> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img class="image-store" src="/admin/<?php echo $arr_store[$i]['image']; ?>">
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <!--/Content-->
        </div>        
    </div> 
</div>
<!--/PAGE STORE-->
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
    .header-top {
        padding: 64px 0;
        letter-spacing: 1.8px;
        font-size: 48px;
        color: #000;
        font-family: UniqloBoldRegular, arial !important;
        font-weight: bold;
        text-align: center;
    }
    .header-store {
        padding: 64px 0;
        letter-spacing: 1.8px;
        font-size: 48px;
        color: #000;
        font-family: UniqloBoldRegular, arial !important;
        font-weight: bold;
        text-align: center;
        border-top: 3px solid #bebebe;
        border-bottom: 3px solid #bebebe;
    }
    .header-store-menu {
        color: orangered;
        padding-left: 1 % ;
        margin-top: 0px;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .foundation{
        margin-top: 10px;
        padding: 0 0 5px;
    }
    .foundation h3{
        border-bottom: 1px solid #bebebe;
        padding-left:3 % ;
        margin-top: 0px;
        padding-top: 5px;
        padding-bottom: 5px;
        font-size:16px;
        font-weight: bold;
    }
    .foundation_sm ul{
        margin:0px;
        padding:0px;
    }
    .foundation_sm li i{
        padding-right: 6px;
    }
    .time-store {
        margin-left: 20px;
        list-style-type: circle;
    }
    .image-store {
        width: 100%;
        margin-top: 60px;
    }
    @media (max-width: 990px) {
        .image-store {
            width: 50%;
        }
    }
</style>