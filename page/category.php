<?php
if (is_numeric($category)) {
    $category_1 = selectData('category', 'id_category = ' . $category);
    if ($category_1) {
        $category_2 = selectData("category", "level = '" . $category . "' AND is_display=1");
    }
}
$data_size_1 = selectData("size", "1=1", "DISTINCT type_size");
$data = selectData("object", "1=1", "*");
$image_default = 'http://placehold.it/800x300';
?>
<ul class="breadcrumb" id="category-breadcrumb">
    <li><a href="/home"><?php echo $var_home; ?></a></li>
    <?php
    if ($catid) {
        if (is_numeric($catid)) {
            $row_category = selectData("category", "id_category='" . $catid . "'", "category, category_english");
            $name = $_SESSION['lang'] == 'english' ? ($row_category[0][1] ? $row_category[0][1] : $row_category[0][0]) : $row_category[0][0];
        } else {
            $name = $catid;
        }
        ?>
        <li><a href="/category/<?php echo bodau($category_1[0]['category']); ?>-<?php echo $category; ?>"><?php echo $_SESSION['lang'] == 'english' ? ($category_1[0]['category_english'] ? $category_1[0]['category_english'] : $category_1[0]['category']) : $category_1[0]['category']; ?></a></li>
        <li><?php echo $name; ?></li>
        <?php
    } else {
        ?>
        <li><?php echo $_SESSION['lang'] == 'english' ? ($category_1[0]['category_english'] ? $category_1[0]['category_english'] : $category_1[0]['category']) : $category_1[0]['category']; ?></li>
        <?php
    }
    ?>
</ul> 

<div id="container">
    <div class="row">
        <!--Sidebar-->
        <div class="col-md-3">
            <nav class="navbar">
                <div class="sidebar">                  
                    <div class="sidebar-nav">
                        <ul class="nav">
                            <?php if ($category_1) : ?>
                                <h1 class="page-header"><?php echo $_SESSION['lang'] == 'english' ? ($category_1[0]['category_english'] ? $category_1[0]['category_english'] : $category_1[0]['category']) : $category_1[0]['category']; ?></h1>
                                <li>
                                    <ul class="nav nav-second-level" id="category-second-level">
                                        <?php for ($j = 0; $j < count($category_2); $j++) : ?>
                                            <li><a href="/category/<?php echo bodau($category_1[0]['category']); ?>-<?php echo $category; ?>/<?php echo bodau($category_2[$j]['category']); ?>-<?php echo $category_2[$j][0]; ?>/1" <?php echo $catid == $category_2[$j][0] ? 'id="sub-active"' : ''; ?>><?php echo $_SESSION['lang'] == 'english' ? ($category_2[$j][2] ? $category_2[$j][2] : $category_2[$j][1]) : $category_2[$j][1]; ?></a></li>
                                        <?php endfor; ?>
                                    </ul>
                                </li> 
                            <?php else : ?>
                                <h1 class="page-header"><?php echo $category_1[0]['category']; ?></h1>
                            <?php endif; ?>
                            <span class="special"><a href="/category/<?php echo bodau($category_1[0]['category']); ?>-<?php echo $category; ?>/new/1"><h1 <?php echo $catid == 'new' ? 'id="sub-active"' : ''; ?> class="page-header-promotion"><?php echo $var_new; ?> </h1></a></span>
                            <span class="special"><a href="/category/<?php echo bodau($category_1[0]['category']); ?>-<?php echo $category; ?>/best/1"><h1 <?php echo $catid == 'best' ? 'id="sub-active"' : ''; ?> class="page-header-promotion"><?php echo $var_best; ?>  </h1></a></span>
                            <span class="special"><a href="/category/<?php echo bodau($category_1[0]['category']); ?>-<?php echo $category; ?>/sales/1"><h1 <?php echo $catid == 'sales' ? 'id="sub-active"' : ''; ?> class="page-header-promotion"><?php echo $var_sales; ?>  </h1></a></span>
                        </ul>
                    </div>
                </div>                             
            </nav> 
        </div>
        <!--/Sidebar-->
        <!--Content-->
        <div class="col-md-9">
            <!--Filter-->
            <div class="row">
                <div class="col-md-12">
                    <div class="filter-panel">
                        <?php
                        if (is_numeric($catid)) {
                            $banner_category = selectData("category", "id_category='" . $catid . "'", "image");
                        } else {
                            $banner_category = selectData("category", "id_category='" . $category . "'", "image");
                        }
                        ?>
                        <img class="slide-image" src="<?php echo '/admin/' . $banner_category[0]['image']; ?>" alt="">
                    </div>
                    <div class="search-result-options">
                        <div class="filter-by">Filter By</div>
                    </div>
                    <div class="search-options">
                        <form id="filterForm" class="form-horizontal" role="form" method="post">
                            <div class="col-md-2">
                                <div id="options-size" class="options-size">
                                    <select class="col-sm-5 item-cbb" name="option-size">
                                        <option> Size </option>
                                        <?php for ($i = 0; $i < count($data_size_1); $i++) : ?>
                                            <optgroup label="<?php echo $data_size_1[$i][0] ?>">
                                                <?php $data_size_2 = selectData("size", "type_size = '" . $data_size_1[$i][0] . "'", "id_size, size"); ?>
                                                <?php for ($j = 0; $j < count($data_size_2); $j++) : ?>
                                                    <option value="<?php echo $data_size_2[$j][0] ?>"><?php echo $data_size_2[$j][1] ?></option>
                                                <?php endfor; ?>
                                            <?php endfor; ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="options-size" class="options-price">
                                    <?php
                                    if ($_SESSION['lang'] == 'english') {
                                        ?>
                                        <select class="col-sm-5 item-cbb" name="option-price">
                                            <option> Price </option>
                                            <option value="< 200.000"> Below 200.000 VND </option>
                                            <option value=">= 200.000 AND <= 400.000"> 200.000 - 400.000 VND </option>
                                            <option value=">= 400.000 AND <= 700.000"> 400.000 - 700.000 VND  </option>
                                            <option value="> 700.000"> Over 700.000 VND</option>
                                        </select>
                                        <?php
                                    } else {
                                        ?>
                                        <select class="col-sm-5 item-cbb" name="option-price">
                                            <option> Giá </option>
                                            <option value="< 200.000"> Dưới 200.000 VND </option>
                                            <option value=">= 200.000 AND <= 400.000"> 200.000 - 400.000 VND </option>
                                            <option value=">= 400.000 AND <= 700.000"> 400.000 - 700.000 VND  </option>
                                            <option value="> 700.000"> Trên 700.000 VND</option>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="options-size" class="options-object">
                                    <select class="col-sm-5 item-cbb" name="option-object">
                                        <option> Object </option>
                                        <?php for ($i = 0; $i < count($data); $i++) : ?>
                                            <option value="<?php echo $data[$i][0] ?>"> <?php echo $_SESSION['lang'] == 'english' ? ($data[$i][2] ? $data[$i][2] : $data[$i][1]) : $data[$i][1]; ?> </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="options-size" class="options-color">
                                    <input type="text" id="modal-color-picker" name="option-color" placeholder="Color" readOnly>
                                    <div class="color-picker" id="color-picker" style="display:none" ></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="grp-btn-search">
                                    <button id="option-btn-clear" type="button" class="btn btn-sm" onclick="return onClear()">Clear</button>
                                    <button id="option-btn-filter" name="btn-filter" type="submit" class="btn btn-sm">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--Filter-->
            <?php if (!isset($catid)) : ?>
                <?php $arr_category = selectData("category", "level = '" . $category . "'"); ?>
                <?php $arr_category = !empty($arr_category) ? $arr_category : array(); ?>
                <?php foreach ($arr_category as $item_cat) : ?>
                    <!--Banner category-->
                    <div class="row carousel-holder">
                        <div class="col-md-12">
                            <div class="category-panel">
                                <a href="/category/<?php echo bodau($category_1[0]['category']); ?>-<?php echo $category; ?>/<?php echo $item_cat['category']; ?>-<?php echo $item_cat['id_category']; ?>/1" title="<?php echo $category_1[0]['category']; ?>">
                                    <img class="slide-image" src="<?php echo '/admin/' . $item_cat['image']; ?>" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--/Banner category-->
                    <?php $arr_product = selectData("product", "id_category = '" . $item_cat['id_category'] . "' ORDER BY date_up DESC LIMIT 0,9", "*"); ?>
                    <?php $arr_product = !empty($arr_product) ? $arr_product : array(); ?>
                    <!--Product category-->
                    <div class="row">
                        <?php $i = 1; ?>
                        <?php foreach ($arr_product as $item_pro) : ?>
                            <?php $detail_pro = selectData('detail', 'id_product=' . $item_pro['id_product']); ?>
                            <?php $campaign_pro = selectData("campaign", "id_product='" . $item_pro['id_product'] . "' AND is_campaign = 1"); ?>
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <div class="thumbnail thumbnail-product">
                                    <img src="<?php echo '/admin/' . $detail_pro[0]['image']; ?>" alt="">
                                    <div class="col-sm-12 caption caption-product">
                                        <h4><a title="<?php echo $item_pro['product']; ?>" href="<?php echo xllink("product", $item_pro['product'], $item_pro['id_product']) ?>"><?php echo $item_pro['product']; ?></a>
                                        </h4>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-5 promotion-data">
                                            <?php
                                            if ($campaign_pro) {
                                                ?>
                                                <span class="new-sales Low Stock rBadge1"><?php echo $var_sales; ?></span>
                                                </br>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="new Low Stock rBadge1"><?php echo $var_new; ?></span>
                                                </br>
                                                <?php
                                            }
                                            if ($item_pro['total'] < 10) {
                                                ?>
                                                <span class="new-low Low Stock rBadge1"><?php echo $var_low; ?></span>
                                                </br>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <h4 class="pull-right"><?php echo number_format($detail_pro[0]['price']); ?> VND</h4>
                                        </div>
                                    </div>
                                    <div class="product-swatches">
                                        <ul class="swatch-list swatch-toggle">
                                            <?php
                                            $color = explode(",", $detail_pro[0]['color']);
                                            for ($j = 0; $j < count($color); $j++) {
                                                ?>
                                                <li><div style="background: <?php echo $color[$j]; ?>" class="col-sm-3 col-lg-3 col-md-3 color-product"></div></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                            <?php if ($i >= 8) break; ?>
                        <?php endforeach; ?>
                    </div>
                    <!--/Product category-->
                <?php endforeach; ?>
            <?php else : ?>
                <?php if (is_numeric($catid)) : ?>
                    <?php
                    $data_total = selectData("product", "id_category = '" . $catid . "'", "*");
                    $total = count($data_total);
                    $numofpages = $total / $pp;
                    if ($trang <= 0) {
                        $page = 1;
                    } else {
                        if ($trang <= ceil($numofpages))
                            $page = $trang;
                        else
                            $page = 1;
                    }
                    $limitvalue = ($page * $pp) - $pp;
                    $self = "/category/" . $category_1[0]['category'] . "-" . $category . "/" . $category_2[0]['category'] . "-" . $catid . "/";
                    ?>
                    <?php $arr_product = selectData("product", "id_category='" . $catid . "' ORDER BY date_up DESC LIMIT $limitvalue,$pp"); ?>
                    <?php $arr_product = !empty($arr_product) ? $arr_product : array(); ?>
                    <!--Product-->
                    </br>
                    <div class="row">
                        <?php foreach ($arr_product as $item_pro) : ?>
                            <?php $detail_pro = selectData('detail', 'id_product=' . $item_pro['id_product']); ?>
                            <?php $campaign_pro = selectData("campaign", "id_product='" . $item_pro['id_product'] . "' AND is_campaign = 1"); ?>
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <div class="thumbnail thumbnail-product">
                                    <img src="<?php echo '/admin/' . $detail_pro[0]['image']; ?>" alt="">
                                    <div class="col-sm-12 caption caption-product">
                                        <h4><a title="<?php echo $item_pro['product']; ?>" href="<?php echo xllink("product", $item_pro['product'], $item_pro['id_product']) ?>"><?php echo $item_pro['product']; ?></a>
                                        </h4>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-5 promotion-data">
                                            <?php
                                            if ($campaign_pro) {
                                                ?>
                                                <span class="new-sales Low Stock rBadge1"><?php echo $var_sales; ?></span>
                                                </br>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="new Low Stock rBadge1"><?php echo $var_new; ?></span>
                                                </br>
                                                <?php
                                            }
                                            if ($item_pro['total'] < 10) {
                                                ?>
                                                <span class="new-low Low Stock rBadge1"><?php echo $var_low; ?></span>
                                                </br>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-sm-7">
                                            <h4 class="pull-right"><?php echo number_format($detail_pro[0]['price']); ?> VND</h4>
                                        </div>
                                    </div>
                                    <div class="product-swatches">
                                        <ul class="swatch-list swatch-toggle">
                                            <?php
                                            $color = explode(",", $detail_pro[0]['color']);
                                            for ($i = 0; $i < count($color); $i++) {
                                                ?>
                                                <li><div style="background: <?php echo $color[$i]; ?>" class="col-sm-4 col-lg-4 col-md-4 color-product"></div></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pagenition">
                        <?php
                        echo setPage($self, $total, $pp, $page);
                        ?>
                    </div>
                    <!--/Product-->
                <?php else : ?>
                    <?php if ($catid == 'new') : ?>
                        <?php
                        $data_total = selectData("product", "product.id_category IN (SELECT category.id_category FROM category WHERE category.level = '" . $category . "')");
                        $total = count($data_total);
                        $numofpages = $total / $pp;
                        if ($trang <= 0) {
                            $page = 1;
                        } else {
                            if ($trang <= ceil($numofpages))
                                $page = $trang;
                            else
                                $page = 1;
                        }
                        $limitvalue = ($page * $pp) - $pp;
                        $self = "/category/" . $category_1[0]['category'] . "-" . $category . "/new/";
                        ?>
                        <?php $arr_product_new = selectData("product", "product.id_category IN (SELECT category.id_category FROM category WHERE category.level = '" . $category . "')  ORDER BY date_up DESC LIMIT $limitvalue,$pp"); ?>
                        <?php $arr_product_new = !empty($arr_product_new) ? $arr_product_new : array(); ?>
                        <!--Product-->
                        </br>
                        <div class="row">
                            <?php $i = 0; ?>
                            <?php foreach ($arr_product_new as $item_pro) : ?>
                                <?php $detail_pro = selectData('detail', 'id_product=' . $item_pro['id_product']); ?>
                                <?php $campaign_pro = selectData("campaign", "id_product='" . $item_pro['id_product'] . "' AND is_campaign = 1"); ?>
                                <div class="col-sm-4 col-lg-4 col-md-4">
                                    <div class="thumbnail thumbnail-product">
                                        <img src="<?php echo '/admin/' . $detail_pro[0]['image']; ?>" alt="">
                                        <div class="col-sm-12 caption caption-product">
                                            <h4><a title="<?php echo $item_pro['product']; ?>" href="<?php echo xllink("product", $item_pro['product'], $item_pro['id_product']) ?>"><?php echo $item_pro['product']; ?></a>
                                            </h4>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-5 promotion-data">
                                                <?php
                                                if ($campaign_pro) {
                                                    ?>
                                                    <span class="new-sales Low Stock rBadge1"><?php echo $var_sales; ?></span>
                                                    </br>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="new Low Stock rBadge1"><?php echo $var_new; ?></span>
                                                    </br>
                                                    <?php
                                                }
                                                if ($item_pro['total'] < 10) {
                                                    ?>
                                                    <span class="new-low Low Stock rBadge1"><?php echo $var_low; ?></span>
                                                    </br>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-sm-7">
                                                <h4 class="pull-right"><?php echo number_format($detail_pro[0]['price']); ?> VND</h4>
                                            </div>
                                        </div>
                                        <div class="product-swatches">
                                            <ul class="swatch-list swatch-toggle">
                                                <?php
                                                $color = explode(",", $detail_pro[0]['color']);
                                                for ($i = 0; $i < count($color); $i++) {
                                                    ?>
                                                    <li><div style="background: <?php echo $color[$i]; ?>" class="col-sm-4 col-lg-4 col-md-4 color-product"></div></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                                <?php if ($i >= 20) break; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php echo setPage($self, $total, $pp, $page) ?>
                        <!--/Product-->
                    <?php elseif ($catid == 'sales') : ?>
                        <?php
                        $data_total = selectData("product JOIN campaign", "product.id_product = campaign.id_product AND campaign.is_campaign = 1 AND product.id_category IN (SELECT category.id_category FROM category WHERE category.level = '" . $category . "')");
                        $total = count($data_total);
                        $numofpages = $total / $pp;
                        if ($trang <= 0) {
                            $page = 1;
                        } else {
                            if ($trang <= ceil($numofpages))
                                $page = $trang;
                            else
                                $page = 1;
                        }
                        $limitvalue = ($page * $pp) - $pp;
                        $self = "/category/" . $category_1[0]['category'] . "-" . $category . "/sales/";
                        ?>
                        <?php
                        $arr_product_sales = selectData("product JOIN campaign", "product.id_product = campaign.id_product AND campaign.is_campaign = 1 AND product.id_category IN (SELECT category.id_category FROM category WHERE category.level = '" . $category . "')  ORDER BY date_up DESC LIMIT $limitvalue,$pp");
                        $arr_product_sales = !empty($arr_product_sales) ? $arr_product_sales : array();
                        ?>
                        <!--Product-->
                        </br>
                        <div class="row">
                            <?php $i = 0; ?>
                            <?php foreach ($arr_product_sales as $item_pro) : ?>
                                <?php $detail_pro = selectData('detail', 'id_product=' . $item_pro['id_product']); ?>
                                <?php $campaign_pro = selectData("campaign", "id_product='" . $item_pro['id_product'] . "' AND is_campaign = 1"); ?>
                                <div class="col-sm-3 col-lg-3 col-md-3">
                                    <div class="thumbnail thumbnail-product">
                                        <img src="<?php echo '/admin/' . $detail_pro[0]['image']; ?>" alt="">
                                        <div class="col-sm-12 caption caption-product">
                                            <h4><a title="<?php echo $item_pro['product']; ?>" href="<?php echo xllink("product", $item_pro['product'], $item_pro['id_product']) ?>"><?php echo $item_pro['product']; ?></a>
                                            </h4>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-5 promotion-data">
                                                <?php
                                                if ($campaign_pro) {
                                                    ?>
                                                    <span class="new-sales Low Stock rBadge1"><?php echo $var_sales; ?></span>
                                                    </br>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="new Low Stock rBadge1"><?php echo $var_new; ?></span>
                                                    </br>
                                                    <?php
                                                }
                                                if ($item_pro['total'] < 10) {
                                                    ?>
                                                    <span class="new-low Low Stock rBadge1"><?php echo $var_low; ?></span>
                                                    </br>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-sm-7">
                                                <h4 class="pull-right"><?php echo number_format($detail_pro[0]['price']); ?> VND</h4>
                                            </div>
                                        </div>
                                        <div class="product-swatches">
                                            <ul class="swatch-list swatch-toggle">
                                                <?php
                                                $color = explode(",", $detail_pro[0]['color']);
                                                for ($i = 0; $i < count($color); $i++) {
                                                    ?>
                                                    <li><div style="background: <?php echo $color[$i]; ?>" class="col-sm-4 col-lg-4 col-md-4 color-product"></div></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                                <?php if ($i >= 20) break; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php echo setPage($self, $total, $pp, $page) ?>
                        <!--/Product-->
                    <?php elseif ($catid == 'best') : ?>
                        <?php
                        $data_total = selectData("product JOIN detail_bill", "product.id_product = detail_bill.id_product AND product.id_product IN (SELECT category.id_category FROM category WHERE category.level = '" . $category . "')");
                        $total = count($data_total);
                        $numofpages = $total / $pp;
                        if ($trang <= 0) {
                            $page = 1;
                        } else {
                            if ($trang <= ceil($numofpages))
                                $page = $trang;
                            else
                                $page = 1;
                        }
                        $limitvalue = ($page * $pp) - $pp;
                        $self = "/category/" . $category_1[0]['category'] . "-" . $category . "/best/";
                        ?>
                        <?php
                        $arr_product_best = selectData("product JOIN detail_bill", "product.id_product = detail_bill.id_product AND product.id_product IN (SELECT category.id_category FROM category WHERE category.level = '" . $category . "') ORDER BY detail_bill.count DESC");
                        $arr_product_best = !empty($arr_product_best) ? $arr_product_best : array();
                        ?>
                        <!--Product-->
                        </br>
                        <div class="row">
                            <?php $i = 0; ?>
                            <?php foreach ($arr_product_best as $item_pro) : ?>
                                <?php $detail_pro = selectData('detail', 'id_product=' . $item_pro['id_product']); ?>
                                <?php $campaign_pro = selectData("campaign", "id_product='" . $item_pro['id_product'] . "' AND is_campaign = 1"); ?>
                                <div class="col-sm-3 col-lg-3 col-md-3">
                                    <div class="thumbnail thumbnail-product">
                                        <img src="<?php echo '/admin/' . $detail_pro[0]['image']; ?>" alt="">
                                        <div class="col-sm-12 caption caption-product">
                                            <h4><a title="<?php echo $item_pro['product']; ?>" href="<?php echo xllink("product", $item_pro['product'], $item_pro['id_product']) ?>"><?php echo $item_pro['product']; ?></a>
                                            </h4>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-5 promotion-data">
                                                <?php
                                                if ($campaign_pro) {
                                                    ?>
                                                    <span class="new-sales Low Stock rBadge1"><?php echo $var_sales; ?></span>
                                                    </br>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="new Low Stock rBadge1"><?php echo $var_new; ?></span>
                                                    </br>
                                                    <?php
                                                }
                                                if ($item_pro['total'] < 10) {
                                                    ?>
                                                    <span class="new-low Low Stock rBadge1"><?php echo $var_low; ?></span>
                                                    </br>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-sm-7">
                                                <h4 class="pull-right"><?php echo number_format($detail_pro[0]['price']); ?> VND</h4>
                                            </div>
                                        </div>
                                        <div class="product-swatches">
                                            <ul class="swatch-list swatch-toggle">
                                                <?php
                                                $color = explode(",", $detail_pro[0]['color']);
                                                for ($i = 0; $i < count($color); $i++) {
                                                    ?>
                                                    <li><div style="background: <?php echo $color[$i]; ?>" class="col-sm-4 col-lg-4 col-md-4 color-product"></div></li>
                                                        <?php
                                                    }
                                                    ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                                <?php if ($i >= 20) break; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php echo setPage($self, $total, $pp, $page) ?>
                        <!--/Product-->
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <!--/Content-->
    </div>
</div>
