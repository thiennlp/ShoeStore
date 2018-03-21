<footer>
    <div class="footer" id="footer">
        <div class="footer-container">
            <div class="row">
                <div class="col-md-2 col-about">
                    <h3><?php echo $var_about; ?></h3>
                    <ul>
                        <?php
                        $data_about = selectData("about", "", "*");
                        for ($i = 0; $i < count($data_about); $i++) {
                            ?>
                            <li><a href="/about-<?php echo $data_about[$i][0]; ?>"><?php echo $data_about[$i][1]; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-3 col-store">
                    <h3><?php echo $var_store; ?></h3>
                    <ul>
                        <?php
                        $data_store = selectData("store", "", "*");
                        for ($i = 0; $i < count($data_store); $i++) {
                            ?>
                            <li><a href="/store-<?php echo $data_store[$i][0]; ?>"><?php echo $data_store[$i][1]; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-2 col-help">
                    <h3><?php echo $var_help; ?></h3>
                    <ul>
                        <?php
                        $data_help = selectData("help", "1=1", "*");
                        for ($i = 0; $i < count($data_help); $i++) {
                            ?>
                            <li><a href="/help-<?php echo $data_help[$i][0]; ?>"><?php echo $data_help[$i][1]; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-3 col-social">
                    <h3><?php echo $var_follow; ?></h3>
                    <ul class="social">
                        <li><a href="https://www.facebook.com/zacnjean" title=""><i class="facebook"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Comming soon !"><i class="zalo"></i></a></li>
                        <li><a href="https://www.instagram.com/zacnjean/" title=""><i class="instagram"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Comming soon !"><i class="youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-connect">
                    <h3><?php echo $var_e_member; ?> </h3>
                    <ul>
                        <li>
                            <div class="input-append newsletter-box text-center">
                                <div>
                                    <p><?php echo $var_offer; ?></p>
                                </div>
                                <div>
                                    <input type="text" id="input-search" class="full text-center" placeholder="<?php echo $_SESSION['lang'] == 'english' ? 'Enter mail' : 'Nhập Email'; ?>">
                                </div>
                                <div style="clear: both; margin-bottom: 5px;"></div>
                                <div>
                                    <button class="btn  bg-gray" type="button"><?php echo $var_sign_up; ?> <i class="fa fa-long-arrow-right"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>                   
        </div>                
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left" style="color: #000;"> Copyright © ZAC & JEAN. All rights reserved.</p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul> 
            </div>
        </div>
    </div>            
</footer>