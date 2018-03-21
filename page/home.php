<!--New Feature-->
<div id="feature" class="container">
    <div class="container">
        <div class="row" id="slider-text">
            <div class="col-md-6" >
                <h2><strong><?php echo $var_feature; ?></strong></h2>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Carousel -->
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                for ($i = 0; $i < count($data); $i++) {
                    ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php echo $i == 0 ? 'class="active"' : '' ?>></li>
                    <?php
                }
                ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner carousel-banner">
                <?php
                for ($i = 0; $i < count($data); $i++) {
                    $name_category = selectData("category", "id_category = '" . $data[$i][3] . "'", "category");
                    ?>
                    <div class="item <?php echo $i == 0 ? 'active' : '' ?>">
                        <a href="/category/<?php echo str_replace(" ", '-', $name_category[0][0]); ?>-<?php echo $data[$i][3]; ?>"><img src="/admin/<?php echo $data[$i][1]; ?>" alt=""></a>
                        <!-- Static Header -->
                        <div class="header-text hidden-xs">
                            <div class="col-md-12 text-center">
                                <h2>
                                    <span><?php echo $var_welcome; ?></span>
                                </h2>
                                <br>
                                <div class="">
                                    <a class="btn btn-theme btn-sm btn-min-block" href="/login"><?php echo $var_login; ?></a><a class="btn btn-theme btn-sm btn-min-block" href="/register"><?php echo $var_register; ?></a></div>
                            </div>
                        </div><!-- /header-text -->
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            <!--.Carousel-->
        </div><!-- /carousel -->
    </div>
</div>
<!--/New Feature-->
<!--Best-->
<?php if (!empty($arr_product_best) && count($arr_product_best) >= 9) : ?>
    <div class="container">
        <div class="container">
            <div class="row" id="slider-text">
                <div class="col-md-6" >
                    <h2><strong><?php echo $var_best; ?></strong></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="beCarousel" class="carousel slide">

                    <ol class="carousel-indicators">
                        <li data-target="#beCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#beCarousel" data-slide-to="1"></li>
                        <li data-target="#beCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Carousel items -->
                    <div class="carousel-inner">

                        <!--Slide 1-->
                        <div class="item active">
                            <div class="row">
                                <?php for ($i = 0; $i < 3; $i++) : ?>
                                    <?php if (!empty($arr_product_best[$i])) : ?>
                                        <div class="col-sm-4 col-lg-4 col-md-4">
                                            <div class="thumbnail thumbnail-product">
                                                <a href="<?php echo xllink("product", $arr_product_best[$i]['product'], $arr_product_best[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_best[$i]['image']; ?>" alt=""></a>
                                                <div class="caption caption-product caption-recommend">
                                                    <h5><a href="<?php echo xllink("product", $arr_product_best[$i]['product'], $arr_product_best[$i]['id_product']) ?>"><?php echo $arr_product_best[$i]['product']; ?></a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <!--/Slide 1-->
                        <!--Slide 2-->
                        <div class="item">
                            <?php for ($i = 3; $i < 6; $i++) : ?>
                                <?php if (!empty($arr_product_best[$i])) : ?>
                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail thumbnail-product">
                                            <a href="<?php echo xllink("product", $arr_product_best[$i]['product'], $arr_product_best[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_best[$i]['image']; ?>" alt=""></a>
                                            <div class="caption caption-product caption-recommend">
                                                <h5><a href="<?php echo xllink("product", $arr_product_best[$i]['product'], $arr_product_best[$i]['id_product']) ?>"><?php echo $arr_product_best[$i]['product']; ?></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <!--/Slide 2-->
                        <!--Slide 3-->
                        <div class="item">
                            <?php for ($i = 6; $i < 9; $i++) : ?>
                                <?php if (!empty($arr_product_best[$i])) : ?>
                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail thumbnail-product">
                                            <a href="<?php echo xllink("product", $arr_product_best[$i]['product'], $arr_product_best[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_best[$i]['image']; ?>" alt=""></a>
                                            <div class="caption caption-product caption-recommend">
                                                <h5><a href="<?php echo xllink("product", $arr_product_best[$i]['product'], $arr_product_best[$i]['id_product']) ?>"><?php echo $arr_product_best[$i]['product']; ?></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>

                        </div>
                        <!--/Slide 3-->

                    </div><!--.carousel-inner-->
                    <a data-slide="prev" href="#beCarousel" class="left carousel-control"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                    <a data-slide="next" href="#beCarousel" class="right carousel-control"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div><!--.Carousel-->

            </div>
        </div>
    </div>
<?php endif; ?>
<!--/Best-->
<!--Sales-->
<?php if (!empty($arr_product_sales) && count($arr_product_sales) >= 9) : ?>
    <div class="container">
        <div class="container">
            <div class="row" id="slider-text">
                <div class="col-md-6" >
                    <h2><strong><?php echo $var_sales; ?></strong></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="saCarousel" class="carousel slide">

                    <ol class="carousel-indicators">
                        <li data-target="#saCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#saCarousel" data-slide-to="1"></li>
                        <li data-target="#saCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Carousel items -->
                    <div class="carousel-inner">

                        <!--Slide 1-->
                        <div class="item active">
                            <div class="row">
                                <?php for ($i = 0; $i < 3; $i++) : ?>
                                    <?php if (!empty($arr_product_sales[$i])) : ?>
                                        <div class="col-sm-4 col-lg-4 col-md-4">
                                            <div class="thumbnail thumbnail-product">
                                                <a href="<?php echo xllink("product", $arr_product_sales[$i]['product'], $arr_product_sales[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_sales[$i]['image']; ?>" alt=""></a>
                                                <div class="caption caption-product caption-recommend">
                                                    <h5><a href="<?php echo xllink("product", $arr_product_sales[$i]['product'], $arr_product_sales[$i]['id_product']) ?>"><?php echo $arr_product_sales[$i]['product']; ?></a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <!--/Slide 1-->
                        <!--Slide 2-->
                        <div class="item">
                            <?php for ($i = 3; $i < 6; $i++) : ?>
                                <?php if (!empty($arr_product_sales[$i])) : ?>
                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail thumbnail-product">
                                            <a href="<?php echo xllink("product", $arr_product_sales[$i]['product'], $arr_product_sales[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_sales[$i]['image']; ?>" alt=""></a>
                                            <div class="caption caption-product caption-recommend">
                                                <h5><a href="<?php echo xllink("product", $arr_product_sales[$i]['product'], $arr_product_sales[$i]['id_product']) ?>"><?php echo $arr_product_sales[$i]['product']; ?></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <!--/Slide 2-->
                        <!--Slide 3-->
                        <div class="item">
                            <?php for ($i = 6; $i < 9; $i++) : ?>
                                <?php if (!empty($arr_product_sales[$i])) : ?>
                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail thumbnail-product">
                                            <a href="<?php echo xllink("product", $arr_product_sales[$i]['product'], $arr_product_sales[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_sales[$i]['image']; ?>" alt=""></a>
                                            <div class="caption caption-product caption-recommend">
                                                <h5><a href="<?php echo xllink("product", $arr_product_sales[$i]['product'], $arr_product_sales[$i]['id_product']) ?>"><?php echo $arr_product_sales[$i]['product']; ?></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>

                        </div>
                        <!--/Slide 3-->

                    </div><!--.carousel-inner-->
                    <a data-slide="prev" href="#saCarousel" class="left carousel-control"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                    <a data-slide="next" href="#saCarousel" class="right carousel-control"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div><!--.Carousel-->

            </div>
        </div>
    </div>
<?php endif; ?>
<!--/Sales-->
<!--Recommend-->
<?php if (!empty($arr_product_recommend)) : ?>
    <div class="container">
        <div class="container">
            <div class="row" id="slider-text">
                <div class="col-md-6" >
                    <h2><strong><?php echo $var_recommend; ?></strong></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="reCarousel" class="carousel slide">

                    <ol class="carousel-indicators">
                        <li data-target="#reCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#reCarousel" data-slide-to="1"></li>
                        <li data-target="#reCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Carousel items -->
                    <div class="carousel-inner">

                        <!--Slide 1-->
                        <div class="item active">
                            <div class="row">
                                <?php for ($i = 0; $i < 3; $i++) : ?>
                                    <?php if (!empty($arr_product_recommend[$i])) : ?>
                                        <div class="col-sm-4 col-lg-4 col-md-4">
                                            <div class="thumbnail thumbnail-product">
                                                <a href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_recommend[$i]['image']; ?>" alt=""></a>
                                                <div class="caption caption-product caption-recommend">
                                                    <h5><a href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product']) ?>"><?php echo $arr_product_recommend[$i]['product']; ?></a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <!--/Slide 1-->
                        <!--Slide 2-->
                        <div class="item">
                            <?php for ($i = 3; $i < 6; $i++) : ?>
                                <?php if (!empty($arr_product_recommend[$i])) : ?>
                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail thumbnail-product">
                                            <a href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_recommend[$i]['image']; ?>" alt=""></a>
                                            <div class="caption caption-product caption-recommend">
                                                <h5><a href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product']) ?>"><?php echo $arr_product_recommend[$i]['product']; ?></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <!--/Slide 2-->
                        <!--Slide 3-->
                        <div class="item">
                            <?php for ($i = 6; $i < 9; $i++) : ?>
                                <?php if (!empty($arr_product_recommend[$i])) : ?>
                                    <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail thumbnail-product">
                                            <a href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product']) ?>"><img src="<?php echo './admin/' . $arr_product_recommend[$i]['image']; ?>" alt=""></a>
                                            <div class="caption caption-product caption-recommend">
                                                <h5><a href="<?php echo xllink("product", $arr_product_recommend[$i]['product'], $arr_product_recommend[$i]['id_product']) ?>"><?php echo $arr_product_recommend[$i]['product']; ?></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>

                        </div>
                        <!--/Slide 3-->

                    </div><!--.carousel-inner-->
                    <a data-slide="prev" href="#reCarousel" class="left carousel-control"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                    <a data-slide="next" href="#reCarousel" class="right carousel-control"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div><!--.Carousel-->

            </div>
        </div>
    </div>
<?php endif; ?>
<!--/Recommend-->
