<?php exit;?>001477108193536b4eae2d6e87fb0101e218639e81ces:2464:"a:2:{s:8:"template";s:2400:"<?php $__Template->display($this->getTpl("page_header")); ?>
    <div class="con b-color-f">
    <div class="goods-info of-hidden ect-tab b-color-f j-goods-info j-ect-tab ts-3">
        <div class="hd j-tab-title tab-title b-color-f of-hidden">
            <ul class="dis-box">
                <li class="box-flex active">商品详情</li>
                <li class="box-flex">规格参数</li>
            </ul>
        </div>
        <div id="j-tab-con" class="b-color-f m-top1px tab-con ">
            <div class="swiper-wrapper">
                <section class="swiper-slide ">
                    <div class="padding-all">
                        <?php echo $goods_desc; ?>
                    </div>
                </section>
                <section class="swiper-slide goods-info-attr">
                    <ul class="t-remark">
                        <?php $n=1;if(is_array($properties)) foreach($properties as $key=>$property_group) { ?>
                        <li class="of-hidden"><span class="fl"><?php echo $key; ?></span></li>
                            <?php $n=1;if(is_array($property_group)) foreach($property_group as $property) { ?>
                            <li class="of-hidden"><span class="fl"><?php echo $property['name']; ?></span><span class="fr"><?php echo $property['value']; ?></span></li>
                            <?php $n++;}unset($n); ?>
                        <?php $n++;}unset($n); ?>
                    </ul>
                </section>
                </div>
            </div>
        </div>
    </div>
   </div>
    <script type="text/javascript">
        /*切换*/
        var tabsSwiper = new Swiper('#j-tab-con', {
            speed: 100,
            noSwiping: true,
            autoHeight: true,
            onSlideChangeStart: function() {
                $(".j-tab-title .active").removeClass('active')
                $(".j-tab-title li").eq(tabsSwiper.activeIndex).addClass('active')
            }
        })
        $(".j-tab-title li").on('touchstart mousedown', function(e) {
            e.preventDefault()
            $(".j-tab-title .active").removeClass('active')
            $(this).addClass('active')
            tabsSwiper.slideTo($(this).index())
        })
        $(".j-tab-title li").click(function(e) {
            e.preventDefault()
        })
    </script>
</body>
</html>";s:12:"compile_time";i:1477021793;}";