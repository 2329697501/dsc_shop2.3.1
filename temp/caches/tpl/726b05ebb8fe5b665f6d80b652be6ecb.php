<?php exit;?>001479804571faaf36d3674d9d858f7ce44227499f59s:11931:"a:2:{s:8:"template";s:11866:"<?php $__Template->display($this->getTpl("page_header-nav")); ?>
<div class="my-admin-header-box">
			<div class="my-user-box">
				<div class="padding-all dis-box">
					<a href="<?php echo U('profile/index');?>">
                                            <?php if($info['user_picture'] !=='' ) { ?>
						<div class="user-head-img-box"><img src="<?php echo $info['user_picture']; ?>"></div>
                                             <?php } else { ?>
                                             <div class="user-head-img-box"><img src="<?php echo __TPL__;?>img/no_image.jpg"></div>
                                            <?php } ?>
					</a>
					<div class="user-bg-box"><img src="<?php echo __TPL__;?>img/user-1.png"></div>
					<div class="user-bg2-box"><img src="<?php echo __TPL__;?>img/user-2.png"></div>
					<a href="<?php echo U('profile/index');?>" class="box-flex">
						<div class="g-s-i-title-a ">
                                                     <?php if($info['nick_name']!=='' ) { ?>
							<h4 class="ellipsis-one user-admin-size"><?php echo $info['nick_name']; ?></h4>
                                                        <?php } else { ?>
                                                        <h4 class="ellipsis-one user-admin-size"><?php echo $info['username']; ?></h4>
                                                      <?php } ?>
							<p class="color-whie f-03 user-reg-top"><?php echo $rank['user_rank']['rank_name']; ?></p>
						</div>
					</a>
					<div class="user-right-maxbox">
						<a href="<?php echo U('index/messagelist');?>">
						<?php if($cache_info ) { ?>
							<div class="email-box"></div>
						<?php } ?>
							<i class="iconfont icon-youxiang is-youxiang j-yanjing disabled"></i>
						</a>
						<a href="<?php echo U('profile/index');?>">
							<div class="user-right-box color-whie">
								<i class="iconfont icon-shezhi f-07"></i>
								<span class="my-t-remark">设置</span>
							</div>
						</a>
					</div>
					</ul>
				</div>
				</a>
			</div>


		<div class=" my-nav-box my-shoucang-bg">
			<div class="user-nav-box g-s-i-title-1 dis-box text-center">
				<a href="<?php echo U('user/index/collectionlist');?>" class="box-flex" >
					<h5 class="ellipsis-one f-2 color-whie"><?php echo $goods_num['num']; ?></h5>
					<p class="f-03 color-whie">收藏</p>
				</a>
				<a href="<?php echo U('user/index/storelist');?>" class="box-flex">
					<h5 class="ellipsis-one f-2 color-whie"><?php echo $store_num['num']; ?></h5>
					<p class="f-03 color-whie">关注</p>
				</a>
			</div>
		</div>

</div>
		<section class="b-color-f goods-attr j-goods-attr my-nav-box m-top10">
			<a href="<?php echo U('order/index',array('status'=>0));?>">
				<div class="dis-box padding-all wallet-bt">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-iconfontquanbudingdan is-user-size my-dingdan-color"></i>我的订单</h3>
					<div class="box-flex t-goods1 text-right onelist-hidden jian-top">全部订单</div>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>
			<ul class="user-money-list g-s-i-title-2 dis-box text-center my-dingdan">
				<a href="<?php echo U('user/order/index', array('status'=>1));?>" class="box-flex">

					<li>
						<h4 class="ellipsis-one"><i class="iconfont icon-daifukuan my-img-size"></i></h4>
						<p class="t-remark3">待付款</p>
						<div class="user-list-num"><?php echo $pay_count; ?></div>
					</li>
				</a>
				<a href="<?php echo U('user/order/index',array('status'=>2));?>" class="box-flex">
					<li>
						<h4 class="ellipsis-one"><i class="iconfont icon-wodetubiaosvg03 my-img-size"></i></h4>
						<p class="t-remark3">待收货</p>
						<div class="user-list-num"><?php echo $confirmed_count; ?></div>
					</li>
				</a>
				<a href="<?php echo U('user/index/comment_list');?>" class="box-flex">
					<li>
						<h4 class="ellipsis-one"><i class="iconfont icon-daipingjia my-img-size"></i></h4>
						<p class="t-remark3">待评价</p>
						<div class="user-list-num"><?php echo $not_comment; ?></div>
					</li>
				</a>
				<a href="<?php echo U('user/refound/index');?>" class="box-flex">
					<li>
						<h4 class="ellipsis-one"><i class="iconfont icon-tuihuanhuo my-img-size"></i></h4>
						<p class="t-remark3">退换货</p>
						<div class="user-list-num"><?php echo $return_count; ?></div>
					</li>
				</a>
			</ul>
		</section>
		<section class="m-top10 my-nav-box b-color-f goods-attr j-goods-attr ">
			<a href="<?php echo U('user/account/index');?>">
				<div class="dis-box padding-all wallet-bt">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-qianbao is-user-size my-qianbao-color"></i>我的钱包</h3>
					<div class="box-flex t-goods1 text-right onelist-hidden jian-top">资金管理</div>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>
			<ul class="user-money-list g-s-i-title-1 dis-box text-center">
				<a href="<?php echo U('user/account/index');?>" class="box-flex">
					<li>
						<h4 class="ellipsis-one"><?php echo $user_pay['user_money']; ?></h4>
						<p class="t-remark3">余额</p>
					</li>
				</a>
				<a href="<?php echo U('user/account/bonus');?>" class="box-flex">
					
                                        <li>
						<h4 class="ellipsis-one"><?php echo $bonus; ?></h4>
						<p class="t-remark3">红包</p>
					</li>
				</a>
				<a href="javascript:;" class="box-flex">
					<li>
						<h4 class="ellipsis-one"><?php echo $user_pay['pay_points']; ?></h4>
						<p class="t-remark3">抵用券</p>
					</li>
				</a>
				
				<!--<a href="<?php echo U('user/account/coupont');?>" class="box-flex">
					<li>
                                                <?php if($couponses == '' ) { ?>
                                                     <h4 class="ellipsis-one">0</h4>
                                                <?php } else { ?>
                                                    <h4 class="ellipsis-one"><?php echo $couponses; ?></h4>
                                                <?php } ?>
						<p class="t-remark3">优惠券</p>
					</li>
				</a>-->
			</ul>
		</section>
		<section class="m-top10 my-nav-box b-color-f goods-attr j-goods-attr">

			<?php if($share) { ?>
			<a href="<?php echo U('user/index/affiliate');?>">
				<div class="dis-box padding-all wallet-bt">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-fenxiang  is-user-size my-dingdan-color"></i>我的分享</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>
			<?php } ?>
            <?php if($drp) { ?>
            <a href="<?php echo U('drp/index/index');?>">
				<div class="dis-box padding-all wallet-bt">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-dianpu is-user-size my-qianbao-color"></i>我的微店</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
            </a>
            <?php } ?>
			<a href="<?php echo U('user/crowd/index');?>">
				<div class="dis-box padding-all wallet-bt">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-tuoguan is-user-size my-dingdan-color"></i>我的微筹</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
            </a>
            <a href="<?php echo U('user/index/helpcenter');?>">
				<div class="dis-box padding-all">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-49 is-user-size my-dingdan-color"></i>帮助中心</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>
			<!--<a href="javascript:;">
				<div class="dis-box padding-all">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-fenxiang is-user-size my-fengxiang-color"></i>我的分享</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>-->
		</section>
		<?php if($history) { ?>
		<section class="m-top10 my-nav-box clearHistory m-b7">
				<div class="dis-box padding-all b-color-f">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-shijian is-user-size my-shijian-color"></i>浏览历史</h3>
					<span class="jian-top clear_history"><i class="iconfont icon-xiao10 is-xiao10 jian-top"></i><span class="q-title jian-top">清空</span>
				</div>
			<section class="goods-shop-pic m-top1px of-hidden padding-all b-color-f">
				<div style="cursor: grab;" class="g-s-p-con product-one-list of-hidden scrollbar-none j-g-s-p-con swiper-container-horizontal" >
					<div class="swiper-wrapper " id="search-con">
                                              <?php $n=1;if(is_array($history)) foreach($history as $k=>$v) { ?>
						<li class="swiper-slide swiper-slide-active">
							<div class="product-div">
								<a class="product-div-link" href="<?php echo $v['url']; ?>"></a>
								<img class="product-list-img" src="<?php echo $v['goods_thumb']; ?>">
								<div class="product-text m-top06">
									<h4><?php echo $v['short_name']; ?></h4>
									<p><span class="p-price t-first "><?php echo $v['shop_price']; ?></span></p>
								</div>
							</div>
						</li>
                                                <?php $n++;}unset($n); ?>
                                        </div>
                                </div>

			</section>
		</section>
		<?php } ?>
  <!--悬浮菜单s-->
	<div class="filter-top" id="scrollUp">
		<i class="iconfont icon-jiantou"></i>
	</div>
	<footer class="footer-nav dis-box">
		<a href="<?php echo U('site/index/index');?>" class="box-flex nav-list">
			<i class="nav-box i-home"></i><span>首页</span>
		</a>
		<a href="<?php echo U('category/index/index');?>" class="box-flex nav-list">
			<i class="nav-box i-cate"></i><span>分类</span>
		</a>
		<a href="javascript:;" class="box-flex nav-list j-search-input">
			<i class="nav-box i-shop"></i><span>搜索</span>
		</a>
		<a href="<?php echo U('cart/index/index');?>" class="box-flex position-rel nav-list">
			<i class="nav-box i-flow"></i><span>购物车</span>
		</a>
		<?php if($filter) { ?>
		<a href="<?php echo U('drp/user/index');?>" class="box-flex nav-list active">
			<i class="nav-box i-user"></i><span><?php echo $custom; ?>中心</span>
		</a>
		<?php } elseif ($community) { ?>
		<a href="<?php echo U('community/index/index');?>" class="box-flex nav-list active">
			<i class="nav-box i-user"></i><span>社区</span>
		</a>
		<?php } else { ?>
		<a href="<?php echo U('user/index/index');?>" class="box-flex nav-list active">
			<i class="nav-box i-user"></i><span>我</span>
		</a>
		<?php } ?>
	</footer>
	<!--悬浮菜单e-->
		<script>
			/*店铺信息商品滚动*/
			var swiper = new Swiper('.j-g-s-p-con', {
				scrollbarHide: true,
				slidesPerView: 'auto',
				centeredSlides: false,
				grabCursor: true
			});

       $(function(){
        //清除搜索记录
        var history = <?php if($history) { ?><?php echo $history; ?><?php } else { ?>""<?php } ?>;
        $(".clear_history").click(function(){
            if(history){
	            $.get("<?php echo U('user/index/clear_history');?>", '', function(data){
	        		if(data.status == 1){
			            $(".clearHistory").remove();
	                }
	            }, 'json');
            }
        });
    })
</script>
	</body>

</html>
";s:12:"compile_time";i:1479718171;}";