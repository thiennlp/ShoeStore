<header>
    <div id="header">
        <!--Search-->
        <div class="col-sm-12">
            <ul class="nav navbar-nav navbar-right nav-language">
                <li class="li-language">
                    <form method="POST">
                        <button type="submit" name="btn-english" class="btn-language uk"></button>
                        <button type="submit" name="btn-vietnamese" class="btn-language vn"></button>
                    </form>
                </li>
<!--                <li class = "formSearch">
                    <form class = "navbar-form navbar-search" method = "POST">
                        <div class = "form-group" style = "display:inline;">
                            <div class = "input-group" style = "display:table;">
                                <input class = "form-control" id = "input-search" name = "content-search" placeholder = "<?php echo $var_search; ?>" type = "text" onkeypress = "return onSearch(event)">
                                <span id = "btn-on-search" class = "input-group-addon"><span class = "glyphicon glyphicon-search"></span></span>
                            </div>
                        </div>
                    </form>
                </li>-->
                <li>
                    <a class="ref-cart" href="/cart" title="View Cart">
                        <div class="cart">
                            <span class="badge cart-badge"><?php echo count($_SESSION['cart_']) ?></span>	
                        </div>
                    </a>
                <li>
            </ul>
        </div>
        <!--/Search-->
        <!--Menu-->
        <nav class="navbar navbar-inverse">                        
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/home"><span class="site-name">SHOE&SHOE</span></a>
            </div>
            <div class="collapse navbar-collapse js-navbar-collapse">
                <ul class="nav navbar-nav navbar-right nav-site">
                    <li class="dropdown mega-dropdown">
                        <a href="/about" class="dropdown-toggle"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $var_about; ?></a>				
                    </li>
                    <li class="dropdown mega-dropdown">
                        <a href="/store" class="dropdown-toggle"><span class="glyphicon glyphicon-eye-open"></span>  <?php echo $var_store; ?></a>				
                    </li>
                    <li class="dropdown mega-dropdown">
                        <a href="/help" class="dropdown-toggle"><span class="glyphicon glyphicon-question-sign"></span>  <?php echo $var_help; ?></a>				
                    </li>
                    <?php
                    if (!isset($_SESSION['customer'])) {
                        ?>
                        <li class="dropdown mega-dropdown">
                            <a href="/login" class="dropdown-toggle"><span class="glyphicon glyphicon-log-in"></span>  <?php echo $var_login_register; ?></a>			
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="dropdown mega-dropdown"><a href="/logout" class="dropdown-toggle"><span class="glyphicon glyphicon-log-out"></span> <?php echo $var_logout; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <!--/Menu-->
        <!--Category-->
        <nav class="navbar navbar-inverse">
            <!--/MenuCategory-->
            <div class="collapse navbar-collapse js-navbar-collapse navbar-inverse-edit2" style="padding-left: 0">
                <ul class="nav navbar-nav">
                    <?php
                    $data_category_1 = selectData("category", "level=0 AND is_display=1", "*");
                    for ($i = 0; $i < count($data_category_1); $i++) {
                        $data_category_2 = selectData("category", "level='" . $data_category_1[$i][0] . "' AND is_display=1", "*");
                        if ($data_category_2) {
                            ?>
                            <li class="dropdown mega-dropdown mega-dropdown-menu">
                                <a href="/category/<?php echo bodau($data_category_1[$i][1]); ?>-<?php echo $data_category_1[$i][0]; ?>" class="dropdown-toggle" <?php echo $category == $data_category_1[$i][0] ? 'id="active"' : ''; ?>><?php echo $_SESSION['lang'] == 'english' ? ($data_category_1[$i][2] ? $data_category_1[$i][2] : $data_category_1[$i][1]) : $data_category_1[$i][1]; ?> <span class="caret"></span></a>				
                                <ul class="dropdown-menu mega-dropdown-menu-1">
                                    <li class="col-sm-3">
                                        <ul>
                                            <li class="dropdown-header"><?php echo $var_category_list; ?></li>
                                            <?php
                                            for ($j = 0; $j < count($data_category_2); $j++) {
                                                ?>
                                                <li><a href="/category/<?php echo bodau($data_category_1[$i][1]); ?>-<?php echo $data_category_1[$i][0]; ?>/<?php echo bodau($data_category_2[$j][1]); ?>-<?php echo $data_category_2[$j][0]; ?>/1"><?php echo $_SESSION['lang'] == 'english' ? ($data_category_2[$j][2] ? $data_category_2[$j][2] : $data_category_2[$j][1]) : $data_category_2[$j][1]; ?></a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <li class="col-sm-3">
                                        <ul><li class="dropdown-header special-category-index"><a href="/category/<?php echo bodau($data_category_1[$i][1]); ?>-<?php echo $data_category_1[$i][0]; ?>/new/1"><?php echo $new; ?> </a></li></ul>
                                        <ul><li class="dropdown-header special-category-index"><a href="/category/<?php echo bodau($data_category_1[$i][1]); ?>-<?php echo $data_category_1[$i][0]; ?>/best/1"><?php echo $best; ?> </a></li></ul>
                                        <ul><li class="dropdown-header special-category-index"><a href="/category/<?php echo bodau($data_category_1[$i][1]); ?>-<?php echo $data_category_1[$i][0]; ?>/sales/1"><?php echo $sales; ?> </a></li></ul>
                                    </li>
                                </ul>				
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="dropdown mega-dropdown">
                                <a href="/category/<?php echo bodau($data_category_1[$i][1]); ?>-<?php echo $data_category_1[$i][0]; ?>" class="dropdown-toggle" <?php echo $category == $data_category_1[$i][0] ? 'id="active"' : ''; ?>><?php echo strtoupper($data_category_1[$i][1]); ?></a>				
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <!--/MenuCategory-->
            </div>
        </nav>
        <!--/Category-->
    </div>
</header>