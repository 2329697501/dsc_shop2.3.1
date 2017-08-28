<?php exit;?>001479823302d49570309b5049de4af65400bb104affs:7163:"a:2:{s:8:"template";s:7099:"<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<meta charset="utf-8">
		<title>微筹中心</title>
		<!--字体图标库-->
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/fonts/iconfont.css">
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/css/swiper-3.2.5.min.css" />
		<!--主样式-->
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/css/ectouch.css" />
	</head>

	<body class=" ">
		<div id="loading"><img src="<?php echo __TPL__;?>crowd/img/loading.gif" /></div>
		<div class="con m-b7">
			<div class="raise-user-header">
				<div class="admin-bg-box">
					<div class="com-header">
						<div class="padding-all dis-box">
							<a>
								<?php if($info['user_picture'] !=='' ) { ?>
								<div class="user-head-img-box"><img src="<?php echo $info['user_picture']; ?>"></div>
								<?php } else { ?>
								<div class="user-head-img-box"><img src="<?php echo __TPL__;?>img/no_image.jpg"></div>
								<?php } ?>
							</a>
							<a class="box-flex">
								<div class="g-s-i-title-a ">
									<?php if($info['nick_name']!=='' ) { ?>
									<h4 class="ellipsis-one user-admin-size color-whie f-07"><?php echo $info['nick_name']; ?></h4> <?php } else { ?>
									<h4 class="ellipsis-one user-admin-size color-whie f-07"><?php echo $info['username']; ?></h4> <?php } ?>

									<p class="user-reg-top color-whie f-03"><?php echo $rank['user_rank']['rank_name']; ?></p>
								</div>
							</a>

							</ul>
						</div>
						</a>
					</div>
				</div>
			</div>

			<section class="m-top10 my-nav-box b-color-f">
				<a href="<?php echo U('user/crowd/order');?>">
					<div class="dis-box padding-all my-bottom">
						<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-iconfontquanbudingdan is-user-size  my-dingdan-color"></i>我的订单</h3>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
					</div>
				</a>
				<a href="<?php echo U('user/crowd/crowdbuy');?>">
					<div class="dis-box padding-all my-bottom">
						<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-zan is-user-size my-dingdan-color"></i>我的支持</h3>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
					</div>
				</a>
				<a href="<?php echo U('user/crowd/focus');?>">
					<div class="dis-box padding-all my-bottom">
						<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-02 is-user-size  my-dingdan-color"></i>我的关注</h3>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
					</div>
				</a>

			</section>
			<!-- <section class="m-top10 my-nav-box b-color-f">

			<a href="raise_help.html">
				<div class="dis-box padding-all my-bottom">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-tuandui is-user-size color-kf"></i>关于众筹</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>
			<a href="raise_feedback.html">
				<div class="dis-box padding-all my-bottom">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-tishi is-user-size my-dingdan-color"></i>意见反馈</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>
		</section> -->
			<section class="m-top10 my-nav-box">
				<div class="dis-box padding-all b-color-f">
					<h3 class="box-flex text-all-span my-u-title-size"><i class="iconfont icon-shijian is-user-size my-dingdan-color"></i>项目推荐</h3>
				</div>
				<!--<?php if($best_list) { ?>-->
				<div class="product-list-small m-top1px b-color-f raise-tuij-box dis-box ">
					<ul class="box-flex flow-checkout-bigpic flow-checkout-pro">

						<?php $n=1;if(is_array($best_list)) foreach($best_list as $goods) { ?>
						<li>
							<div class="product-div">
								<a class="product-div-link" href="<?php echo $goods['url']; ?>"></a>
								<img class="product-list-img" src="<?php echo $goods['title_img']; ?>">
								<div class="product-text">
									<h4><?php echo $goods['title']; ?></h4>
									<p class="col-3 f-05"><em class="color-red">￥<?php echo $goods['min_price']; ?></em><em class="col-9 f-02"> 起</em><em class="fr col-9 f-02"><i class="iconfont icon-shijian f-03"></i> 剩余时间：<?php echo $goods['shenyu_time']; ?>天</em></p>
									<div class="raise-progressBar raise-user-time dis-box">
										<p class="wrap box-flex">
											<span class="bar" style="width:<?php echo $goods['baifen_bi']; ?>%;"><i class="color"></i></span>
										</p>
										<p class="txt"><?php echo $goods['baifen_bi']; ?>%</p>
									</div>
									<p class="col-3 f-03"><em class="col-9">已筹资金:</em><em class="color-red">￥<?php echo $goods['join_money']; ?></em><em class="fr col-9 f-03">支持人:<em class="color-red"><?php echo $goods['join_num']; ?></em>人</em>
									</p>
								</div>

							</div>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
				</div>
				<!--<?php } else { ?>-->
				<div class="no-div-message flow-no-cart">
					<i class="iconfont icon-biaoqingleiben"></i>
					<p>亲，此处没有内容～！</p>
				</div>
				<!--<?php } ?>-->

			</section>
		</div>
		<!--悬浮菜单s-->
		<div class="filter-top" id="scrollUp">
			<i class="iconfont icon-jiantou"></i>
		</div>

		<footer class="footer-nav dis-box">
			<a href="<?php echo U('site/index/index');?>" class="box-flex nav-list">
				<i class="nav-box i-home"></i><span>首页</span>
			</a>
			<a href="<?php echo U('crowd_funding/index/index');?>" class="box-flex nav-list">
				<i class="nav-box i-zhongchou"></i><span>微筹广场</span>
			</a>
			<a href="<?php echo U('user/crowd/order');?>" class="box-flex position-rel nav-list">
				<i class="nav-box i-zhongchou-order"></i><span>微筹订单</span>
			</a>

			<a href="<?php echo U('user/crowd/index');?>" class="box-flex nav-list  active">
				<i class="nav-box i-zhongchou_user"></i><span>微筹中心</span>
			</a>
		</footer>
		<!--悬浮菜单e-->
		<!--引用js-->
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/swiper-3.2.5.min.js"></script>
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/ectouch.js"></script>
		<script>
			/*店铺信息商品滚动*/
			var swiper = new Swiper('.j-g-s-p-con', {
				scrollbarHide: true,
				slidesPerView: 'auto',
				centeredSlides: false,
				grabCursor: true
			});
		</script>
	</body>

</html>";s:12:"compile_time";i:1479736902;}";