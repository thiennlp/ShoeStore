<?php
$arr_product_recommend = selectData('product JOIN detail ON product.id_product=detail.id_product', '1=1 ORDER BY date_up DESC LIMIT 0,9');
if (isset($_POST['btn-buy'])) {
    $id_customer = selectData("customer", "id_account = '".$_SESSION['customer']."'", "id_customer");
    if ($id_customer) {
        addBill($_SESSION['cart_'], $id_customer[0][0]);
    }
}    
?>
<ul class="breadcrumb" id="category-breadcrumb">
    <li><a href="/home"><?php echo $var_home; ?></a></li>
    <li class="active"><?php echo $var_cart; ?></li>
</ul>
<!--Cart-->
<div class="container">
    <div class="header-cart">
        <h2><strong><?php echo $var_my_bag; ?></strong></h2>
    </div>
    <!--table-->
    <!--/table-->
    <div class="method">
        <!--row-->
        <!--Have data-->
        <?php
        $i = 1;
        if ($_SESSION['cart_']) {
            if ($_SESSION['lang'] == 'english') {
                ?>
                <!--header-->
                <div class="row margin-0 list-header hidden-sm hidden-xs">
                    <div class="col-md-6"><div class="header">PRODUCT</div></div>
                    <div class="col-md-2"><div class="header">QUANTITY</div></div>
                    <div class="col-md-2"><div class="header">PRICE</div></div>
                    <div class="col-md-2"><div class="header">TOTAL PRICE</div></div>
                </div>
                <!--/header-->
                <?php
            } else {
                ?>
                <!--header-->
                <div class="row margin-0 list-header hidden-sm hidden-xs">
                    <div class="col-md-6"><div class="header">SẢN PHẨM</div></div>
                    <div class="col-md-2"><div class="header">SỐ LƯỢNG</div></div>
                    <div class="col-md-2"><div class="header">GIÁ</div></div>
                    <div class="col-md-2"><div class="header">THÀNH TIỀN</div></div>
                </div>
                <!--/header-->
                <?php
            }
            $total = 0;
            foreach ($_SESSION['cart_'] as $product => $info) {
                $data_cart = explode(",", $info);
                $row_product = selectData("product", "id_product = '".$product."'", "id_product, product");
                $row_detail =  selectData("detail", "id_product = '".$product."'", "image, price");
                $row_campaign = selectData("campaign", "id_product='".$product."' AND is_campaign = 1", "price_to");
                if ($row_campaign) {
                    $price = $row_campaign[0][0];
                } else {
                    $price = $row_detail[0][1];
                }
                $total = $total + ($price * $data_cart[2]);
                ?>
                    <div class="row margin-0">
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <img class="image-cart" src="/admin/<?php echo $row_detail[0][0] ? $row_detail[0][0] : 'http://placehold.it/150x150' ?>" alt="<?php echo $row_product[0][1]; ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="propertyname"><a class="propertyname-name" href="<?php echo xllink("product", $row_product[0][1], $row_product[0][0])?>"><?php echo $row_product[0][1]; ?></a></div>
                                <div class="propertyname"><?php echo $_SESSION['lang'] == 'english' ? 'Color' : 'Màu sắc'; ?> : <?php echo $data_cart[1] ?></div>
                                <div class="propertyname">Size : <?php echo $data_cart[0] ?></div>
                                <div class="propertyname"><a class="propertyname-act" href="/cart/delete-<?php echo $row_product[0][0]; ?>"><?php echo $_SESSION['lang'] == 'english' ? 'REMOVE' : 'XÓA'; ?></a></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="col-md-10">
                                <div class="propertyname"><?php echo $data_cart[2] ?></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="col-md-10">
                                <div class="propertyname"><?php echo number_format($price) ?> VND</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="col-md-10">
                                <div class="propertyname"><?php echo number_format($price * $data_cart[2]) ?> VND</div>
                            </div>
                        </div>
                    </div>    
                <?php					
            }
            ?>
            <!--total-->
            <div class="row margin-0 list-header hidden-sm hidden-xs">
                <div class="col-md-10"><div class="total-cart-text"><?php echo $_SESSION['lang'] == 'english' ? 'TOTAL' : 'TỔNG TIỀN'; ?></div></div>
                <div class="col-md-2"><div class="total-cart-price"><?php echo number_format($total) ?> VND</div></div>
            </div>
            <!--/total-->
            </br>
            <div class="row margin-0">
                <div class="col-md-8">
                    <div class="free-ship">
                        <div class="text-free-ship"><?php echo $var_ship; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <?php
                        if (!isset($_SESSION['customer'])) {
                            ?>
                            <a href="/checkout"><button type="button" class="btn-checkout"><?php echo $var_checkout; ?></button></a>
                            <?php
                        } else {
                            ?>
                            <form role="form" method="POST">
                                <button type="submit" name="btn-buy" class="btn-checkout"><?php echo $var_buy; ?></button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            } else {
                ?>
                    <!--Don't have data-->
                    <div class="row margin-0 empty-data">
                        <span><?php echo $var_item_bag; ?></span>
                    </div>
                    </br>
                    <div class="row margin-0">
                        <div class="text-empty"><?php echo $var_ship; ?></div>
                    </div>
                <?php
            }
        ?>
        <!--/Don't have data-->
        <!--/row-->
    </div>
</div>
<!--/Cart-->
<!--Recommend-->
<div class="container">
    <div class="container">
        <div class="row" id="slider-text">
            <div class="col-md-6" >
                <h2><?php echo $var_recommend; ?></h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="Carousel" class="carousel slide">

                <ol class="carousel-indicators">
                    <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#Carousel" data-slide-to="1"></li>
                    <li data-target="#Carousel" data-slide-to="2"></li>
                </ol>

                <!-- Carousel items -->
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

                </div><!--.carousel-inner-->
                <a data-slide="prev" href="#Carousel" class="left carousel-control"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                <a data-slide="next" href="#Carousel" class="right carousel-control"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            </div><!--.Carousel-->

        </div>
    </div>
</div><!--.container-->
<!--/Recommend-->
<!--</div>-->
