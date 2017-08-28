<?php exit;?>0014796986821d80fa85c8694a13a348f9f19b693458s:4498:"a:2:{s:8:"template";s:4434:"<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<meta charset="utf-8">
		<title>我的关注</title>
		<!--字体图标库-->
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/fonts/iconfont.css">
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/css/swiper-3.2.5.min.css" />
		<!--主样式-->
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/css/ectouch.css" />

	</head>

	<body>
		<div id="loading"><img src="<?php echo __TPL__;?>crowd/img/loading.gif" /></div>
		<div class="con">
			<div class="goods-info user-order of-hidden ect-tab j-ect-tab ts-3 p-t0">
				<nav class=" j-tab-title tab-title b-color-f of-hidden">
					<ul class="dis-box">
						<li class="box-flex <?php if($type == 1) { ?>active<?php } ?>"><a href="<?php echo U('user/crowd/focus',array('type'=>''));?>">全部关注</a></li>
						<li class="box-flex <?php if($type == 2) { ?>active<?php } ?>"><a href="<?php echo U('user/crowd/focus',array('type'=>'2'));?>">进行中</a></li>
						<li class="box-flex <?php if($type == 3) { ?>active<?php } ?>"><a href="<?php echo U('user/crowd/focus',array('type'=>'3'));?>">已成功</a></li>
						<!-- <li class="box-flex <?php if($type == 4) { ?>active<?php } ?>"><a href="{:U('mycrowd/index/focus',array('type'=>'4'))}">已失败</a></li> -->
					</ul>
				</nav>
				<div id="j-tab-con" class="tab-con">
					<div class="swiper-wrapper">
						
						<section class="swiper-slide">
							<?php $n=1;if(is_array($zc_focus)) foreach($zc_focus as $goods) { ?>
							<section class="flow-checkout-pro">								
								<div class="my-nav-box product-list-small m-top1px b-color-f raise-tuij-box dis-box ">
									<ul class="box-flex  flow-checkout-pro">
										<li>
											<div class="product-div">
												<a class="product-div-link" href="<?php echo $goods['url']; ?>"></a>
												<img class="product-list-img" src="<?php echo $goods['title_img']; ?>">
												<div class="product-text">
													<h4><?php echo $goods['title']; ?></h4>
													<p class="col-3 f-05"><em class="color-red">￥<?php echo $goods['min_price']; ?></em><em class="col-9 f-02"> 起</em><em class="fr col-9 f-02"><i class="iconfont icon-shijian"></i> 剩余时间：<?php echo $goods['shenyu_time']; ?>天</em></p>
													<div class="raise-progressBar raise-user-time dis-box">
														<p class="wrap box-flex">
															<span class="bar" style="width:<?php echo $goods['baifen_bi']; ?>%;"><i class="color"></i></span>
														</p>
														<p class="txt"><?php echo $goods['baifen_bi']; ?>%</p>
													</div>
													<p class="col-3 f-03"><em class="col-9">已筹资金:</em><em class="color-red">￥<?php echo $goods['join_money']; ?></em><!-- 元 --><em class="fr col-9 f-03">支持人:<em class="color-red"><?php echo $goods['zhichi_num']; ?></em>人</em>
													</p>
												</div>

											</div>
										</li>
									</ul>
								</div>								
							</section>
							<?php $n++;}unset($n); ?>
							
						</section>
						
						
						
					</div>
				</div>
			</div>
		</div>
		</div>
		<!--引用js-->
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/swiper-3.2.5.min.js"></script>
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/ectouch.js"></script>
		<script>
			/*切换*/
			/*var tabsSwiper = new Swiper('#j-tab-con', {
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
			})*/
		</script>
	</body>

</html>";s:12:"compile_time";i:1479612282;}";