<?php exit;?>001479707262d651b445ef6c0f4711f333417e5e1dd2s:15155:"a:2:{s:8:"template";s:15090:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">
			<div class="shopping-info j-shopping-info">
				<header>
					<section class="search">
						<div class="text-all dis-box j-text-all">
							<div class="box-flex input-text n-input-text">
								<a class="a-search-input j-search-input" href="javascript:void(0)"></a>
								<input type="text" placeholder="店铺商品搜索" />
								<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
							</div>
							<a type="button" class="btn-submit">搜索</a>
						</div>
					</section>
				</header>
				<input type="hidden" name="shop_id" value="<?php echo $info['shop_id']; ?>" >
				<input type="hidden" name="maxpage" value="<?php echo $info['shop_id']; ?>" >
				<input type="hidden" name="page" value="<?php echo $page; ?>" >
				<div class="goods-shop-info shopping-info-title">
					<section class="dis-box s-i-title-con">
						<div class="g-s-i-img"><img src="<?php echo $info['shop_logo']; ?>" /></div>
						<div class="g-s-i-title box-flex">
							<h3 class="ellipsis-one box-flex"><?php echo $info['shop_name']; ?></h3>
							<p class="t-remark m-top04">已经有 <span class="num<?php echo $info['ru_id']; ?>"><?php echo $info['count_gaze']; ?></span> 人关注</p>
						</div>
                        <div class="g-s-info-add">
							<a class="gaze<?php echo $info['ru_id']; ?> <?php echo $info['gaze_status']; ?>"  onclick="addgaze(<?php echo $info['ru_id']; ?>)">关注</a>
						</div>
					</section>
					<img class="bg" src="<?php echo __TPL__;?>img/shopping_info_b.png" />
				</div>
				<div class="shopping-info-nums b-color-f">
					<ul class="dis-box text-center">
						<li class="box-flex">
							<a href="<?php echo U('store/index/pro_list',array('ru_id'=>$info['ru_id']));?>">
								<h4><?php echo $info['count_goods']; ?></h4>
								<p class="t-remark3 m-top02">全部商品</p>
							</a>
						</li>
						<li class="box-flex">
							<a href="<?php echo U('store/index/pro_list',array('ru_id'=>$info['ru_id'],'type'=>'is_new'));?>">
								<h4><?php echo $info['count_goods_new']; ?></h4>
								<p class="t-remark3 m-top02">新品</p>
							</a>
						</li>
						<li class="box-flex">
							<a href="<?php echo U('store/index/pro_list',array('ru_id'=>$info['ru_id'],'type'=>'is_promote'));?>">
								<h4><?php echo $info['count_goods_promote']; ?></h4>
								<p class="t-remark3 m-top02">推荐</p>
							</a>
						</li>
					</ul>
				</div>
				<!-- <?php if($info['count_bonus']>0) { ?> -->
				<section class="j-goods-coupon m-top08 padding-all b-color-f goods-coupon " ru-id="<?php echo $info['ru_id']; ?>">
					<div class="dis-box " >
						<label class="t-remark g-t-temark">领取优惠券 (<?php echo $info['count_bonus']; ?>)</label>
						<div class="box-flex g-coupon-con">
							<ul class="dis-box">
							   <!-- <?php $n=1;if(is_array($info['bonus_all'])) foreach($info['bonus_all'] as $k=>$key) { ?> -->
							   <li class="box-flex"><span class="remark-all temark-3"><?php if($key['min_goods_amount']) { ?><?php echo $key['min_goods_amount']; ?>减<?php echo $key['type_money']; ?><?php } else { ?><?php echo $key['type_money']; ?><?php } ?></span></li>
							   <!-- <?php $n++;}unset($n); ?> -->
							</ul>
						</div>
					</div>
				</section>
				<!-- <?php } ?> -->
				<!-- <?php if($info['shop_flash']) { ?> -->
				<div class="goods-photo goods-photo-auto m-top08">
					<div class="swiper-wrapper">
					    <!-- <?php $n=1;if(is_array($info['shop_flash'])) foreach($info['shop_flash'] as $key) { ?> -->
						<li class="swiper-slide tb-lr-center"><img src="<?php echo $key; ?>" /></li>
					    <!-- <?php $n++;}unset($n); ?> -->
					</div>
					<!-- Add Pagination -->
					<div class="swiper-pagination"></div>
				</div>
				<!-- <?php } ?> -->
				<div class="shopping-info-hot product-list  product-list-medium m-top06 b-color-f">
					<h3 class="">热门商品</h3>
					<ul >
					<!-- <?php $n=1;if(is_array($info['goods_list'])) foreach($info['goods_list'] as $key) { ?> -->
						<li>
							<div class="product-div">
								<a class="product-div-link" href="<?php echo $key['goods_url']; ?>"></a>
								<img class="product-list-img" src="<?php echo $key['goods_thumb']; ?>" />
								<div class="product-text">
									<h4><?php echo $key['goods_name']; ?></h4>
									<p class="dis-box p-t-remark"><span class="box-flex">库存:12800</span><span class="box-flex">销量:12800</span></p>
									<p><span class="p-price t-first ">
                                     <?php if($key['is_promote'] && $key['gmt_end_time']) { ?>
                                     <?php echo $key['promote_price']; ?>
                                     <?php } else { ?>
                                     <?php echo $key['shop_price_formated']; ?>
                                     <?php } ?>
                                     <small><del><?php echo $key['market_price']; ?></del></small></span>
                                    </p>
									<a href="javascript:void(0)" class="icon-flow-cart fr j-goods-attr"><i class="iconfont icon-gouwuche"></i></a>
								</div>
							</div>
						</li>
                   
				    <!-- <?php $n++;}unset($n); ?> -->
					</ul>
					<div class="padding-all shopping-list-more"><a href="<?php echo U('store/index/pro_list',array('ru_id'=>$info['ru_id']));?>">查看更多</a></div>
				</div>
				
			</div>
			<div class="b-menu-fixed j-menu-fixed">
					<ul class="dis-box text-center">
						<li class="box-flex"><a href="<?php echo U('shop_about',array('ru_id'=>$info['ru_id']));?>">店铺详情</a></li>
						<li class="box-flex">
							<i class="iconfont icon-caidan"></i>热门分类
                            <?php if($info['shop_category']) { ?>
							<ul class="children-ul">
								<!-- <?php $n=1;if(is_array($info['shop_category'])) foreach($info['shop_category'] as $key) { ?> -->
									<li class="bigcat" cat-id="<?php echo $key['cat_id']; ?>"><a href="<?php echo U('store/index/pro_list',array('ru_id'=>$info['ru_id'],'cat_id'=>$key['cat_id']));?>" class="onelist-hidden"><span class=""><?php echo $key['cat_name']; ?></span></a></li>
								<!-- <?php $n++;}unset($n); ?> -->
							</ul>
                            <?php } ?>
						</li>
						<li class="box-flex"><i class="iconfont icon-kefu"></i>客服
                            <!--<?php if($info['shop_wangwang'] || $info['shop_qq'] ||$info['kf_appkey']) { ?>-->
							<ul class="children-ul">
                                <!--<?php if($info['shop_qq']) { ?>-->
                                <li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $info['shop_qq']; ?>&amp;site=qq&amp;menu=yes" target="_blank">QQ</a></li>
							    <!--<?php } ?>-->
                                <!--<?php if($info['shop_wangwang']) { ?>-->
                                <li><a href="http://www.taobao.com/webww/ww.php?ver=3&touid=$info['shop_wangwang']&siteid=cntaobao&status=1&charset=utf-8" target="_blank">旺旺</a></li>
                                <!--<?php } ?>-->
                                  <!-- <?php if($info['kf_appkey'] &&$info['is_IM'] ==1 ) { ?>-->
                                <li><a class="box-flex btn-default" href="<?php echo U('chat/index/index', array('ru_id'=> $info['ru_id']));?>">IM</a></li>
                               <!-- <?php } ?>-->
                            </ul>
                            <!--<?php } ?>-->
						</li>
					</ul>
				</div>
			<div class="search-div j-search-div ts-3">
				<section class="search">
					<div class="text-all dis-box j-text-all">
						<div class="box-flex input-text n-input-text">
							<input class="j-input-text" type="text"  placeholder="商品搜索" />
							<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
						</div>
						<a type="button" class="btn-submit">搜索</a>
					</div>
				</section>
                <!--search -->

                <div class="search-div j-search-div ts-3">
                    <section class="search">

                            <div class="text-all dis-box j-text-all text-all-back">
                                <a class="a-icon-back j-close-search" href="javascript:;"><i class="iconfont icon-back"></i></a>
                                <div class="box-flex input-text">
                                    <input class="j-input-text" style="padding-left:1rem " type="text" name="infokeyword" placeholder="<?php if($keywords) { ?><?php echo $keywords; ?><?php } else { ?>商品搜索<?php } ?>" />
                                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                                </div>
                                <a type="button" class="btn-submit">搜索</a>
                            </div>

                    </section>
                    <section class="search-con">
                        <div class="swiper-scroll history-search">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <p class="hos-search">
                                        <label class="fl">最近搜索</label>
                                        <span class="fr clear_history"><i class="iconfont icon-xiao10"></i></span>
                                    </p>
                                    <ul class="hot-search a-text-more a-text-one" id="search-con">
                                        <?php $n=1;if(is_array($history_keywords)) foreach($history_keywords as $v) { ?>
                                        <li><a href="<?php echo U('store/index/pro_list', array('keyword'=>$v,'ru_id'=>$info['ru_id']));?>"><span><?php echo $v; ?></span></a></li>
                                        <?php $n++;}unset($n); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </section>
                    <footer class="close-search j-close-search">
                        点击关闭
                    </footer>
                </div>

                <!--search -->
                <div class="mask-filter-div"></div>
			<!--领取优惠券star-->
		<div class="show-goods-coupon j-filter-show-div ts-3 b-color-1">
			<section class="goods-show-title of-hidden padding-all b-color-f">
				<h3 class="fl g-c-title-h3">领取店铺优惠券 (<span class="bonus-number">0</span>)</h3>
				<i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
			</section>
			<!-- 优惠卷 -->
			<section class="goods-show-con padding-all">
			<div class="cart-bonus">
			
			</div>
			</section>
		  
				<!-- end/优惠卷  -->
		</div>
		<div class="div-messages"></div>
		<input type="hidden" name="type" value="<?php echo $type; ?>">
		<input type="hidden" name="ru_id" value="<?php echo $info['ru_id']; ?>">
		<input type="hidden" name="maxpage" value="<?php echo $maxpage; ?>">
		<input type="hidden" name="page" value="">

		<script>
		var type  = $("input[name=type]").val();
		var ru_id = $("input[name=ru_id]").val();
		var maxpage = $("input[name=maxpage]").val();
		var page = $("input[name=page]").val();
		var sort;
		var url = 'index.php?r=store/index/pro_list';
		var bid;
		var cat_id;
        var keyword;
		 //店铺关注
	    function addgaze(shop){
		    if(shop!=''){
		    	$.post('index.php?r=store/index/add_collect', {shopid: shop}, function(data){
                    var num = $(".num"+shop).text();
			    	if(data.error == 1){
                      $(".gaze"+shop).addClass("active");
                      num = num*1 + 1;
                      $(".num"+shop).text(num);
                      d_messages(data.msg);
					}
			    	if(data.error == 2){
                      $(".gaze"+shop).removeClass("active");
                      num = num*1 - 1;
                      $(".num"+shop).text(num);
                      d_messages(data.msg);
				    }
                    if(data.error <= 0){
                        layer.open({
                            content: '请登录后关注该店铺',
                            btn: ['立即登录', '取消'],
                            shadeClose: false,
                            yes: function () {
                                window.location.href = 'index.php?r=user/login';
                            },
                            no: function () {
                            }
                        });
                    }
				}, 'json');
		    }
        }
        //弹出优惠券
        /*-*/
        $(".j-goods-coupon").click(function() {
            var ru_id = $(this).attr("ru-id");
            $.ajax({type: "POST",url: "index.php?r=cart/index/cart_bonus",data: {ru_id:ru_id}, dataType:"json", async:false, success:
                    function(data){
                        if(data.data!=0){
                            $(".cart-bonus").html(data.data);
                            $(".bonus-number").text(data.number);
                            $(".show-goods-coupon").addClass("show");
                        }
                    }});
        });
        //清空搜索
	    $(".clear_history").click(function(){
            if(history){
                $.get("<?php echo U('category/index/clear_history');?>", '', function(data){
                    if(data.status){
                        $("#search-con").remove();
                    }
                }, 'json');
            }
        });
        //搜索
        $(".btn-submit").click(function (){
            keyword = $("input[name=infokeyword]").val();
            location.href = url+"&ru_id="+ru_id+"&keyword="+keyword;
        })
          //分类
        $(".brand").click(function (){
           bid = $(this).attr("bid");
           $.post(url, {type:type,ru_id:ru_id,bid:bid}, function(data){
         	    $("input[name=showword]").val(keyword);
		    	var html = template('j-product', data);
		    	$(".show-filter-div").removeClass("show-filter-div");
				$('.store_info').html(html);
			}, 'json');
        })
         $(".category").click(function (){
           cat_id = $(this).attr("cat-id");
           $.post(url, {type:type,ru_id:ru_id,cat_id:cat_id}, function(data){
         	    $("input[name=showword]").val(keyword);
		    	var html = template('j-product', data);
		    	$(".show-filter-div").removeClass("show-filter-div");
				$('.store_info').html(html);
			}, 'json');
        })
			/*商品详情相册切换*/
						var swiper = new Swiper('.goods-photo', {
							paginationClickable: true,
							pagination : '.swiper-pagination',
						});
					
		</script>
	</body>

</html>
";s:12:"compile_time";i:1479620862;}";