<ul class="breadcrumb" id="category-breadcrumb">
    <li><a href="/home"><?php echo $var_home; ?></a></li>
    <li><a href="/category/<?php echo str_replace(" ", '-', $arr_category_1[0]['category']); ?>-<?php echo $arr_category_1[0]['id_category']; ?>"><?php echo $_SESSION['lang'] == 'english' ? ($arr_category_1[0]['category_english'] ? $arr_category_1[0]['category_english'] : $arr_category_1[0]['category']) : $arr_category_1[0]['category']; ?></a></li>
    <li><a href="/category/<?php echo str_replace(" ", '-', $arr_category_1[0]['category']); ?>-<?php echo $arr_category_1[0]['id_category']; ?>/<?php echo str_replace(" ", '-', $arr_category_2[0]['category']); ?>-<?php echo $arr_category_2[0]['id_category']; ?>/1"><?php echo $_SESSION['lang'] == 'english' ? ($arr_category_2[0]['category_english'] ? $arr_category_2[0]['category_english'] : $arr_category_2[0]['category']) : $arr_category_2[0]['category']; ?></a></li>
    <li class="active"><?php echo $arr_product[0]['product']; ?></li>
</ul>
<!--PAGE PRODUCT-->
<div>
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
                <span class="selectedlabel"><strong><?php echo $var_price; ?></strong></span>
                <?php if ($campaign_product) : ?>
                    <div>
                        <span class="label-price price-from"><strong><?php echo number_format($campaign_product[0]['price_from']); ?></strong></span>
                        <span class="label-price price-cancel"></span>
                        <span class="label-price price-to"><strong><?php echo number_format($campaign_product[0]['price_to']); ?> VND</strong></span>
                    </div>
                <?php else : ?>
                    <h3 class="label-price"><strong><?php echo number_format($arr_product[0]['price']); ?> VND</strong></h3>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <hr class="hr-no-margin">
            <form role="form" method="post">
                <div class="product-swatches">
                    <span class="selectedlabel"><strong><?php echo $_SESSION['lang'] == 'english' ? 'COLOR' : 'MÀU SẮC'; ?></strong></span>
                    <ul class="swatch-list swatch-toggle">
                        <?php $color = explode(",", $arr_product[0]['color']); ?>
                        <?php for ($i = 0; $i < count($color); $i++) : ?>
                            <li><input type="button" style="background: <?php echo $color[$i]; ?>" class="col-sm-4 col-lg-4 col-md-4 btn-color-product" onclick="selectColor('<?php echo $color[$i]; ?>')"></button></li>
                        <?php endfor; ?>
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
                            <?php foreach ($data_size as $size) : ?>
                                <option value="<?php echo $size['id_size'] ?>"><?php echo $size['size'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="col-sm-5 item-cbb-product" name="dk-quality">
                            <?php for ($i = 1; $i < 11; $i++) : ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
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
                <h3><strong><?php echo $var_detail; ?></strong></h3>
                <?php $summary = $_SESSION['lang'] == 'english' ? ($arr_product[0]['summary_english'] ? $arr_product[0]['summary_english'] : $arr_product[0]['summary']) : $arr_product[0]['summary']; ?>
                <span><?php echo $detail[0]; ?></span>
                <?php echo $summary; ?>
            </div>
        </div>
    </div>
    <div class="row carousel-holder">
        <div class="col-md-12">
            <div class="also-product"></div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="product-other"><?php echo $var_category ?></h3>
                </div>
                <div class="col-lg-12">
                    <?php foreach ($arr_product_category as $item_pro) : ?>
                        <?php $campaign_pro = selectData("campaign", "id_product='" . $item_pro['id_product'] . "' AND is_campaign = 1"); ?>
                        <div class="col-sm-3 col-lg-3 col-md-3">
                            <div class="thumbnail thumbnail-product">
                                <img src="/admin/<?php echo $item_pro['image']; ?>" alt="">
                                <div class="col-sm-12 caption caption-product">
                                    <h4><a title="<?php echo $item_pro['product']; ?>" href="<?php echo xllink("product", $item_pro['product'], $item_pro['id_product']) ?>"><?php echo $item_pro['product']; ?></a>
                                    </h4>
                                </div>
                                <div class="clear"></div>
                                <div class="col-sm-12">
                                    <div class="col-sm-5 promotion-data">
                                        <?php if ($campaign_pro) : ?>
                                            <span class="new-sales Low Stock rBadge1"><?php echo $var_sales; ?></span>
                                            <hr class="margin-no-boder">
                                        <?php else : ?>
                                            <span class="new Low Stock rBadge1"><?php echo $var_new; ?></span>
                                            <hr class="margin-no-boder">
                                        <?php endif; ?> 
                                        <?php if ($item_pro['total'] < 10) : ?>
                                            <span class="new-low Low Stock rBadge1"><?php echo $var_low; ?></span>
                                            <hr class="margin-no-boder">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-sm-7">
                                        <h4 class="pull-right"><?php echo number_format($item_pro['price']); ?> VND</h4>
                                    </div>
                                </div>
                                <div class="product-swatches">
                                    <ul class="swatch-list swatch-toggle">
                                        <?php $color = explode(",", $item_pro['color']); ?>
                                        <?php for ($i = 0; $i < count($color); $i++) : ?>
                                            <li><div style="background: <?php echo $color[$i]; ?>" class="col-sm-3 col-lg-3 col-md-3 color-product"></div></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/PAGE PRODUCT-->
<style>
    #img-thumb-product img:hover {
        border: 1px solid orangered;
        transform: scale(1.4);
    }
    .margin-no-boder {
        margin: 5px 0px; 
        border:0;
    }
</style>
<script>
    $('[id^=img-thumb-product-]').click(function () {
        var href = $(this).attr('src');
        $('#img-res-product').attr('src', href);
    });
</script>