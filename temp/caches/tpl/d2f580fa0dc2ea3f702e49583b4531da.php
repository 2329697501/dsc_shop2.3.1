<?php exit;?>001479445675d98886e66a108e09b1a8eb62f32ec2d3s:3587:"a:2:{s:8:"template";s:3523:"<?php $__Template->display($this->getTpl("page_header")); ?>
            <?php if($topic['htmls'] == '') { ?>
            <script language="javascript">
                var topic_width = "100%";
                var topic_height = "100%";

                var img_url = "<?php echo $topic['topic_img']; ?>";

                if (img_url.indexOf('.swf') != -1) {
                    document.write('<div class="topic_banner"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="' + topic_width + '" height="' + topic_height + '">');
                    document.write('<param name="movie" value="' + img_url + '"><param name="quality" value="high">');
                    document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
                    document.write('<embed src="' + img_url + '" wmode="opaque" menu="false" quality="high" width="' + topic_width + '" height="' + topic_height + '" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent"/>');
                    document.write('</object></div>');
                }
                else {
                    document.write('<section class="toppic-con"><img src="' + img_url + '"/> </section>');
                }
            </script>
            <?php } else { ?>
            <?php echo $topic['htmls']; ?>
            <?php } ?>

        <div class="toppic-prolist">
            <?php $n=1; if(is_array($sort_goods_arr)) foreach($sort_goods_arr as $key => $sort) { ?>
            <section class="product-list j-product-list product-list-medium b-color-f">
                <h3 class="fl g-c-title-h3 padding-all"><?php echo $key; ?></h3>
                <ul class="topic-list">
                    <?php $n=1;if(is_array($sort)) foreach($sort as $goods) { ?>
                    <li>
                        <div class="product-div">
                            <a class="product-div-link" href="<?php echo $goods['url']; ?>"></a>
                            <img class="product-list-img" src="<?php echo $goods['goods_thumb']; ?>"/>
                            <div class="product-text">
                                <h4><?php echo $goods['short_style_name']; ?></h4>
                                </p>
                                <p><span class="p-price t-first ">
                                    <!-- <?php if($goods['promote_price'] != "") { ?> -->
                                        <?php echo $goods['promote_price']; ?>
                                    <!-- <?php } else { ?>-->
                                        <?php echo $goods['shop_price']; ?>
                                    <!--<?php } ?>-->
                                </span></p>
                                <a href="javascript:void(0);" class="icon-flow-cart fr j-goods-attr"><i
                                        class="iconfont icon-gouwuche"></i></a>
                            </div>
                        </div>
                        <div class="toppic-btn">
                            <a href="<?php echo $goods['url']; ?>" class="btn-submit">立即购买</a>
                        </div>
                    </li>
                    <?php $n++;}unset($n); ?>
                </ul>
            </section>
            <?php $n++;}unset($n); ?>
        </div>
    </body>
</html>";s:12:"compile_time";i:1479359275;}";