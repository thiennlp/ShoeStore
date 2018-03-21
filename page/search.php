<?php
$category_1 = selectData('category', 'level = 0 AND is_display=1');
$data_size_1 = selectData("size", "1=1", "DISTINCT type_size");
$data = selectData("object", "1=1", "*");
//-----------------------PHÂN TRANG---------------------------------------//
$data_total = selectData("product", "product LIKE '%".$key."%'","*");
$total = count($data_total);
$numofpages = $total/$pp;
if ($trang <= 0) { 
    $page = 1; 
} else { 
    if ($trang <= ceil($numofpages)) 
        $page = $trang; 
    else 
        $page = 1; 
} 
$limitvalue = ($page * $pp) - $pp; 
$self = "/search-".$key."/";
//-----------------------PHÂN TRANG---------------------------------------//
?>
<ul class="breadcrumb" id="category-breadcrumb">
    <li><a href="/home"><?php echo $var_home; ?></a></li>
    <li><?php echo $var_search; ?></li>
</ul> 

<div id="container">
    <div class="row">
        <!--Sidebar-->
        <div class="col-md-3">
            <nav class="navbar">
                <div class="sidebar">                  
                    <div class="sidebar-nav">
                        <h1 class="page-header"><?php echo $var_search; ?></h1>
                        <ul class="nav">
                            <?php
                            for ($i = 0; $i < count($category_1); $i++) {
                                $category_2 = selectData("category", "level = '".$category_1[$i]['id_category']."' AND is_display=1");
                                ?>
                                <li>
                                    <h4><a class="search-header" href="/category/<?php echo bodau($category_1[$i][1]); ?>-<?php echo $category_1[$i]['id_category']; ?>"><?php echo $_SESSION['lang'] == 'english' ? ($category_1[$i][2] ? $category_1[$i][2] : $category_1[$i][1]) : $category_1[$i][1]; ?></a></h4>
                                    <ul class="nav nav-second-level" id="search-second-level">
                                        <?php for ($j = 0; $j < count($category_2); $j++) : ?>
                                            <li><a href="/category/<?php echo bodau($category_1[$i][1]); ?>-<?php echo $category_1[$i]['id_category']; ?>/<?php echo bodau($category_2[$j][1]); ?>-<?php echo $category_2[$j][0]; ?>/1"><?php echo $_SESSION['lang'] == 'english' ? ($category_2[$j][2] ? $category_2[$j][2] : $category_2[$j][1]) : $category_2[$j][1]; ?></a></li>
                                        <?php endfor; ?>
                                    </ul>
                                </li> 
                                <?php
                            }
                            ?>
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
                        <div class="image-search"></div>
                    </div>
                    <div class="search-result-options">
                        <div class="filter-by">Filter By</div>
                    </div>
                    <div class="search-options">
                        <form id="filterForm" class="form-horizontal" role="form">
                            <div class="col-md-2">
                                <div id="options-size" class="options-size">
                                    <select class="col-sm-5 item-cbb" name="option-size">
                                        <option value="0"> Size </option>
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
                                    <select class="col-sm-5 item-cbb" name="option-price">
                                        <option value="0"> Price </option>
                                        <option value="1"> Below $5 </option>
                                        <option value="2"> $5 - $10 </option>
                                        <option value="3"> $10 - $20 </option>
                                        <option value="4"> Over $5 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="options-size" class="options-object">
                                    <select class="col-sm-5 item-cbb" name="option-object">
                                        <option value="0"> Object </option>
                                        <?php for ($i = 0; $i < count($data); $i++) : ?>
                                            <option value="<?php echo $data[$i][0] ?>"> <?php echo $data[$i][1] ?> </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div id="options-size" class="options-color">
                                    <input type="text" id="modal-color-picker" name="option-color" placeholder="Color">
                                    <div class="color-picker" id="color-picker" style="display:none" ></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="grp-btn-search">
                                    <button id="option-btn-clear" type="button" class="btn btn-sm">Clear</button>
                                    <button id="option-btn-filter" type="button" class="btn btn-sm">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--Filter-->
            <?php $arr_product = selectData("product", "product LIKE '%".$key."%' ORDER BY date_up DESC LIMIT $limitvalue,$pp","*"); ?>
            <?php $arr_product = !empty($arr_product) ? $arr_product : array(); ?>
            <!--Product category-->
            <div class="row">
                <?php $i = 1; ?>
                <?php foreach ($arr_product as $item_pro) : ?>
                    <?php $detail_pro = selectData('detail', 'id_product=' . $item_pro['id_product']); ?>
                    <?php $campaign_pro = selectData("campaign", "id_product='".$item_pro['id_product']."' AND is_campaign = 1"); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail thumbnail-product">
                            <img src="/admin/<?php echo $detail_pro[0]['image']; ?>" alt="">
                            <div class="col-sm-12 caption caption-product">
                                <h4><a title="<?php echo $item_pro['product']; ?>" href="<?php echo xllink("product", $item_pro['product'], $item_pro['id_product'])?>"><?php echo $item_pro['product']; ?></a>
                                </h4>
                            </div>
                            <div class="clear"></div>
                            <div class="col-sm-12">
                                <div class="col-sm-5 promotion-data">
                                    <?php
                                    if ($campaign_pro) {
                                        ?>
                                        <span class="new-sales Low Stock rBadge1"><?php echo $var_sales; ?></span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="new Low Stock rBadge1"><?php echo $var_new; ?></span>
                                        <?php
                                    }
                                    if ($item_pro['total'] < 10) {
                                        ?>
                                        <span class="new-low Low Stock rBadge1"><?php echo $var_low; ?></span>
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
                <?php endforeach; ?>
            </div>
            <!--/Product category-->
            <div class="pagenition">
                <?php
                    echo setPage($self,$total,$pp,$page);
                ?>
            </div>
        </div>
        <!--/Content-->
    </div>
</div>
