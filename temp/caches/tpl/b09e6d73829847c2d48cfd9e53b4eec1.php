<?php exit;?>0014795378710962124baf066829fed15bb177110dc8s:5413:"a:2:{s:8:"template";s:5349:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con">
		<section>
		<?php $n=1;if(is_array($list['top'])) foreach($list['top'] as $top) { ?>
			<ul class="brand-header-box">
				<li>
					<div class="brand-img-box">
						<img src="<?php echo $list1; ?>">
						<div class="brand-n-box-pos">
							<h2>今日之最</h2>
							<p>爆款新品 等你秒杀</p>
						</div>
						<div class="brend-day-box"><em><?php echo $mday; ?>/</em><span><?php echo $mon; ?></span></div>
				</li>
				<li>
					<div class="brand-right-box ">
						<h2><?php echo $top['brand_name']; ?></h2>
						<p class="fourlist-hidden"><?php echo $top['brand_desc']; ?></p>
					</div>
				</li>

			</ul>
			<div class="box mb-1 b-color-f">
			<div class="hot-container-div">
				<i class="iconfont icon-back"></i>
				<div class="swiper-container hot-container">
					<ul class="swiper-wrapper">
					<?php $n=1;if(is_array($top['goods'])) foreach($top['goods'] as $topgoods) { ?>
						<li  class="swiper-slide ">
							<a href="<?php echo $topgoods['url']; ?>">
								<img src="<?php echo $topgoods['goods_thumb']; ?>" />
								<p class="index-price text-c"><em><?php echo $topgoods['shop_price']; ?></em><br><del><em><?php echo $topgoods['market_price']; ?></em></del></p>
							</a>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
					<!-- 导航按钮 -->
				</div> <i class="iconfont icon-more"></i>
			</div>
			</div>
		<?php $n++;}unset($n); ?>
			<div class="box title inx-ms m-top08">
				<div class="box padding-all b-color-f">
					<h3 class="position-rel">
							<span class="fl inx-ms-time">热门大牌</span>
						</h3>
				</div>
				<!--轮播图-->
				<div class="padding-all hot-brand_street">
					<div class="swiper-container h-b-swiper-container">
						<div class="swiper-wrapper">
							<!--one-->
							<?php $n=1;if(is_array($list['center'])) foreach($list['center'] as $centerbrand) { ?>
							<div class="swiper-slide">
								<section class=" brand-name-list-box ">
									<div class="brand-cont-header ">
										<div class="my-brand-header ">
											<div class="goods-shop-info shopping-info-title ">
												<section class="dis-box s-i-title-con ">
													<div class="g-s-i-img "><img src="<?php echo $centerbrand['brand_logo']; ?>"></div>
													<div class="g-s-i-title box-flex ">
														<h3 class="ellipsis-one box-flex "><?php echo $centerbrand['brand_name']; ?></h3>
														<p class="t-remark m-top04 ">共有 <?php echo $centerbrand['count']; ?> 件商品</p>
													</div>
													<div class="g-s-info-add ">
														<a href="<?php echo $centerbrand['url']; ?> ">进入专区</a>
													</div>
												</section>
												<img class="bg " src="<?php echo __TPL__;?>img/shopping_info_b.png ">
											</div>
										</div>
									</div>
									<div class="brand-list-box dis-box ">
										<?php $n=1;if(is_array($centerbrand['goods'])) foreach($centerbrand['goods'] as $key=>$centerbrandgoods) { ?>
										<?php if($key == 0) { ?>
										<div class="brand-left-list-box "><a href="<?php echo $centerbrandgoods['url']; ?>" ><img src="<?php echo $centerbrandgoods['goods_thumb']; ?>"></a></div>
										<?php } ?>
										<?php $n++;}unset($n); ?>
										<div class="brand-right-list-box ">
											<?php $n=1;if(is_array($centerbrand['goods'])) foreach($centerbrand['goods'] as $key=>$centerbrandgoods) { ?>
											<?php if($key != 0 ) { ?><?php if($key < 3 ) { ?>
										<div class="brand-right-box-1 "><a href="<?php echo $centerbrandgoods['url']; ?>" ><img src="<?php echo $centerbrandgoods['goods_thumb']; ?>"></a></div>
											<?php } ?><?php } ?>
											<?php $n++;}unset($n); ?>
										</div>
									</div>
									<div class="box-flex pb-2-1 ">
										<h3 class="my-u-title-size "></h3> </div>
								</section>
							</div>
							<?php $n++;}unset($n); ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</div>

			<div class="box title inx-ms wallet-bt">
				<div class="box padding-all b-color-f ">
					<h3 class="position-rel ">
							<span class="fl inx-ms-time ">推荐大牌</span>

						</h3>

				</div>

			</div>
            <?php echo insert_ads(array('id'=>100, 'num'=>4));?>
		</section>
		<section class="">
			<ul class="my-brand-login ">
			<?php $n=1;if(is_array($brand15)) foreach($brand15 as $brand) { ?>
				<li>
					<a href="<?php echo $brand['url']; ?>"><img src="<?php echo $brand['brand_logo']; ?>"></a>
				</li>
			<?php $n++;}unset($n); ?>
				<li class="my-brand-text "><a href="<?php echo U('brand/index/nav');?>">查看更多</a></li>
			</ul>
		</section>
		</div>
	<!-- Initialize Swiper -->
	<script>
		$(function($) {
			var swiper = new Swiper('.h-b-swiper-container', {
				pagination: '.swiper-pagination',
				nextButton: '.swiper-button-next',
				prevButton: '.swiper-button-prev',
				slidesPerView: 1,
				paginationClickable: true,
				spaceBetween: 30,
			});
			var mySwiper = new Swiper('.hot-container', {
				slidesPerView: 3,
				 spaceBetween: 20,
				paginationClickable: true,
			});
		});
	</script>
	</body>


</html>
";s:12:"compile_time";i:1479451471;}";