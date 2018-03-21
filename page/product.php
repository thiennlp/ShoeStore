<?php
$arr_product = selectData('product JOIN detail ON product.id_product=detail.id_product', 'product.id_product=' . $product);
$campaign_product = selectData("campaign", "id_product='".$product."' AND is_campaign = 1");
$arr_image_product = selectData('image', 'id_product=' . $product);
$arr_category_2 = selectData('category', 'id_category=' . $arr_product[0]['id_category'], 'id_category, category, level');
$arr_category_1 = selectData('category', 'id_category=' . $arr_category_2[0]['level'], 'id_category, category');
$arr_product_recommend = selectData("product JOIN detail ON product.id_product=detail.id_product", "product.id_category='".$arr_product[0]['id_category']."' AND product.id_product != '".$product."' ORDER BY product.date_up DESC LIMIT 0,9");
$arr_product_category = selectData("product JOIN detail ON product.id_product=detail.id_product", "product.id_category In (SELECT id_category FROM category WHERE level = '".$arr_category_2[0]['level']."') AND product.id_product != '".$product."' ORDER BY product.date_up DESC LIMIT 0,12");

//check empty
$arr_product = !empty($arr_product) ? $arr_product : array();
$arr_image_product = !empty($arr_image_product) ? $arr_image_product : array();
$arr_product_recommend = !empty($arr_product_recommend) ? $arr_product_recommend : array();
//----------------------------------------------

$data_size = selectData("size", "type_size = '".$arr_product[0]['type_size']."'");
for ($i = 0; $i < count($data_size); $i++) {
    $option_size .= '<option value="'.$data_size[$i][1].'">'.$data_size[$i][1].'</option>';
}
?>
<style>
    #img-thumb-product img:hover {
        border: 1px solid orangered;
        transform: scale(1.4);
    }
</style>
<script>
    $('[id^=img-thumb-product-]').click(function () {
        var href = $(this).attr('src');
        $('#img-res-product').attr('src', href);
    });
</script>
<ul class="breadcrumb" id="category-breadcrumb">
    <li><a href="/home"><?php echo $var_home; ?></a></li>
    <li><a href="/category/<?php echo str_replace(" ",'-',$arr_category_1[0]['category']); ?>-<?php echo $arr_category_1[0]['id_category']; ?>"><?php echo $_SESSION['lang'] == 'english' ? ($arr_category_1[0]['category_english'] ? $arr_category_1[0]['category_english'] : $arr_category_1[0]['category']) : $arr_category_1[0]['category']; ?></a></li>
    <li><a href="/category/<?php echo str_replace(" ",'-',$arr_category_1[0]['category']); ?>-<?php echo $arr_category_1[0]['id_category']; ?>/<?php echo str_replace(" ",'-',$arr_category_2[0]['category']); ?>-<?php echo $arr_category_2[0]['id_category']; ?>/1"><?php echo $_SESSION['lang'] == 'english' ? ($arr_category_2[0]['category_english'] ? $arr_category_2[0]['category_english'] : $arr_category_2[0]['category']) : $arr_category_2[0]['category']; ?></a></li>
    <li class="active"><?php echo $arr_product[0]['product']; ?></li>
</ul>
<!-- Page Content -->
<div>
    <!-- Portfolio Item Row -->
    <div class="row">
        <div class="col-md-8">
            <div class="image-product">
                <div class="col-sm-2 col-lg-2 col-md-2" id="img-thumb-product">
                    <?php $id_image = 1; ?>
                    <?php foreach ($arr_image_product as $item_image) : ?>
                        <img class="img-thumbnail" id="img-thumb-product-<?php echo $id_image; ?>" src="/admin/<?php echo $item_image['url']; ?>" alt="">
                        <hr class="hr-no-margin">
                    <?php $id_image++; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-sm-10 col-lg-10 col-md-10">
                    <img class="img-responsive" id="img-res-product" src="/admin/<?php echo $arr_product[0]['image']; ?>" alt="">
                </div>
            </div>
            <div class="clear"></div>
            <div class="similar-product">
                <div class="title-similar">
                    <h2><strong><?php echo $var_recommend; ?></strong></h2>
                </div>
                <div class="slider-similar">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Slide product recommend -->
                            <div id="Carousel" class="carousel slide">
                                <ol class="carousel-indicators">
                                    <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#Carousel" data-slide-to="1"></li>
                                    <li data-target="#Carousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">

                                    <!--Slide 1-->
                                    <div class="item active">
                                        <div class="row">
                                            <?php for ($i = 0; $i < 3; $i++) : ?>
                                                <div class="col-sm-4 col-lg-4 col-md-4">
                                                    <div class="thumbnail thumbnail-product">
                                                        <a title="<?php echo $arr_product_recommend[$i]['product']; ?>" href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product'])?>"><img src="/admin/<?php echo $arr_product_recommend[$i]['image']; ?>" alt=""></a>
                                                        <div class="caption caption-product caption-recommend">
                                                            <h5><a title="<?php echo $arr_product_recommend[$i]['product']; ?>" href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product'])?>"><?php echo $arr_product_recommend[$i]['product']; ?></a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <!--/Slide 1-->
                                    <!--Slide 2-->
                                    <div class="item">
                                        <?php for ($i = 3; $i < 6; $i++) : ?>
                                            <div class="col-sm-4 col-lg-4 col-md-4">
                                                <div class="thumbnail thumbnail-product">
                                                    <a title="<?php echo $arr_product_recommend[$i]['product']; ?>" href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product'])?>"><img src="/admin/<?php echo $arr_product_recommend[$i]['image']; ?>" alt=""></a>
                                                    <div class="caption caption-product caption-recommend">
                                                        <h5><a title="<?php echo $arr_product_recommend[$i]['product']; ?>" href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product'])?>"><?php echo $arr_product_recommend[$i]['product']; ?></a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                    <!--/Slide 2-->
                                    <!--Slide 3-->
                                    <div class="item">
                                        <?php for ($i = 6; $i < 9; $i++) : ?>
                                            <div class="col-sm-4 col-lg-4 col-md-4">
                                                <div class="thumbnail thumbnail-product">
                                                    <a title="<?php echo $arr_product_recommend[$i]['product']; ?>" href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product'])?>"><img src="/admin/<?php echo $arr_product_recommend[$i]['image']; ?>" alt=""></a>
                                                    <div class="caption caption-product caption-recommend">
                                                        <h5><a title="<?php echo $arr_product_recommend[$i]['product']; ?>" href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product'])?>"><?php echo $arr_product_recommend[$i]['product']; ?></a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>

                                    </div>
                                    <!--/Slide 3-->
                                </div>
                                <a data-slide="prev" href="#Carousel" class="left carousel-control"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                                <a data-slide="next" href="#Carousel" class="right carousel-control"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </div>
                            <!-- /Slide product recommend -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <h2 class="name-product"><strong><?php echo $arr_product[0]['product']; ?></strong></h2>
            <div class="ratings">
                <p class="pull-right">15 reviews</p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                </p>
            </div>
            <div class="clear"></div>
            <hr class="hr-no-margin">
            <div class="price">
                <span class="selectedlabel"><strong><?php echo $_SESSION['lang'] == 'english' ? 'PRICE' : 'GIÁ'; ?></strong></span>
                <?php
                if ($campaign_product) {
                    ?>
                    <div class="">
                        <span class="label-price price-from"><strong><?php echo number_format($campaign_product[0]['price_from']); ?></strong></span>
                        <span class="label-price price-cancel"></span>
                        <span class="label-price price-to"><strong><?php echo number_format($campaign_product[0]['price_to']); ?> VND</strong></span>
                    </div>
                    <?php
                } else {
                    ?>
                    <h3 class="label-price"><strong><?php echo number_format($arr_product[0]['price']); ?> VND</strong></h3>
                    <?php
                }
                ?>
            </div>
            <div class="clear"></div>
            <hr class="hr-no-margin">
            <form role="form" method="post">
                <div class="product-swatches">
                    <span class="selectedlabel"><strong><?php echo $_SESSION['lang'] == 'english' ? 'COLOR' : 'MÀU SẮC'; ?></strong></span>
                    <ul class="swatch-list swatch-toggle">
                        <?php
                        $color = explode(",", $arr_product[0]['color']);
                        for ($i = 0; $i < count($color); $i++) {
                            ?>
                            <li><input type="button" style="background: <?php echo $color[$i]; ?>" class="col-sm-4 col-lg-4 col-md-4 btn-color-product" onclick="selectColor('<?php echo $color[$i]; ?>')"></button></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <input type="hidden" name="dk-color" value="" id="selected-color">
                </div>
                <div class="error-color"><?php echo $err_content; ?></div>
                
                <div class="clear"></div>
                <hr class="hr-no-margin">
                <div class="size-chart-link">
                    <div class="">
                        <span class="size-chart-img"><strong>SIZE</strong></span>
                    </div>
                    <div class="">
                        <select class="col-sm-5 item-cbb-product" name="dk-size">
                            <?php
                                echo $option_size;
                            ?>
                        </select>
                        <select class="col-sm-5 item-cbb-product" name="dk-quality">
                            <?php
                            for ($i = 1; $i < 11; $i++) {
                                ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="add-cart">
                    <button id="add-to-cart" name="add-to-cart" type="submit" class="button-fancy-large add-to-cart add-to-cart-disabled "><strong><?php echo $var_add_cart; ?></strong></button>
                </div>
            </form>
            <div class="clear"></div>
            <hr class="hr-no-margin">
            <div class="product-detail">
                <h3><strong><?php echo $_SESSION['lang'] == 'english' ? 'DETAIL' : 'CHI TIẾT'; ?></strong></h3>
                <?php
                $summary = $_SESSION['lang'] == 'english' ? ($arr_product[0]['summary_english'] ? $arr_product[0]['summary_english'] : $arr_product[0]['summary']) : $arr_product[0]['summary'];
                ?>
                <span><?php echo $detail[0]; ?></span>
                <?php echo $summary; ?>
            </div>
        </div>

    </div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <div class="row carousel-holder">
        <div class="col-md-12">
            <div class="also-product"></div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="product-other"><?php echo $_SESSION['lang'] == 'english' ? 'CATEGORIES' : 'DANH MỤC'; ?></h3>
                </div>
                <div class="col-lg-12">
                    <?php foreach ($arr_product_category as $item_pro) : ?>
                    <?php $campaign_pro = selectData("campaign", "id_product='".$item_pro['id_product']."' AND is_campaign = 1"); ?>
                        <div class="col-sm-3 col-lg-3 col-md-3">
                            <div class="thumbnail thumbnail-product">
                                <img src="/admin/<?php echo $item_pro['image']; ?>" alt="">
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
                                        <h4 class="pull-right"><?php echo number_format($item_pro['price']); ?> VND</h4>
                                    </div>
                                </div>
                                <div class="product-swatches">
                                    <ul class="swatch-list swatch-toggle">
                                    <?php
                                        $color = explode(",", $item_pro['color']);
                                        for ($i = 0; $i < count($color); $i++) {
                                            ?>
                                            <li><div style="background: <?php echo $color[$i]; ?>" class="col-sm-3 col-lg-3 col-md-3 color-product"></div></li>
                                            <?php
                                        }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /Related Projects Row -->

</div>
<!-- /.container -->
