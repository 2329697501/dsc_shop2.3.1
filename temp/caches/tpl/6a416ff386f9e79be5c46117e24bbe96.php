<?php exit;?>00147981458180e65d5ed632cc8303cecf0520f30dd8s:3623:"a:2:{s:8:"template";s:3559:"<?php $__Template->display($this->getTpl("page_header")); ?>
    <div class="con b-color-f">
    		<header class="dis-box header-menu n-header-menu b-color color-whie">
				<a class="" href="javascript:history.go(-1);"><i class="iconfont icon-back"></i></a>
				<h3 class="box-flex"><nav class="n-goods-shop-list-nav box-flex swiper-container-horizontal ">
							<ul class="swiper-wrapper  dis-box text-c">
								<li class="div1 box-flex swiper-slide position-rel swiper-slide-active" category="1">
									<a class="product-div-link" href="<?php echo U('index', array('id'=>$goods_id));?>"></a>商品</li>
								<li class="div3 box-flex swiper-slide active position-rel swiper-slide-next" category="3">
									<a class="product-div-link" href="<?php echo U('info', array('id'=>$goods_id));?>"></a>详情</li>
								<li class="div4 box-flex swiper-slide position-rel" category="4">
									<a class="product-div-link" href="<?php echo U('comment', array('id'=>$goods_id));?>"></a>评论</li>
							</ul>
						</nav>
				</h3>
				<a>
					<i class="iconfont icon-13caidan j-nav-box"></i></a>
		</header>
    <div class="goods-info of-hidden ect-tab b-color-f j-goods-info j-ect-tab ts-3"style="padding-top:0">
        <div class="hd j-tab-title tab-title b-color-f of-hidden" style="position:static">
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
    	<?php $__Template->display($this->getTpl("header_nav")); ?>
</body>
</html>";s:12:"compile_time";i:1479728181;}";