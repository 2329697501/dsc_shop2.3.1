<?php exit;?>001479597656322ac5ebb790a50e424f8fcc04877356s:7465:"a:2:{s:8:"template";s:7401:"<?php $__Template->display($this->getTpl("page_header")); ?>

	<div id="loading"><img src="<?php echo __TPL__;?>img/loading.gif" /></div>
	<div class="con mb-7">
		<div class="brand-list-info">
			<!--<header>-->
				<!--<section class="search">-->
					<!--<div class="text-all dis-box j-text-all">-->
						<!--<div class="box-flex input-text n-input-text">-->
							<!--<a class="a-search-input j-search-input" href="javascript:void(0)"></a>-->
							<!--<input type="text" placeholder="品牌商品搜索" />-->
							<!--<i class="iconfont icon-guanbi1 is-null j-is-null"></i>-->
						<!--</div>-->
						<!--<a type="button" class="btn-submit">搜索</a>-->
					<!--</div>-->
				<!--</section>-->
			<!--</header>-->
			<div class="brand-cont-header brand-list-info-bch">
				<div class="my-brand-header ">
					<div class="goods-shop-info shopping-info-title ">
						<section class="dis-box s-i-title-con ">
							<div class="g-s-i-img "><img src="<?php echo $brand_info['brand_logo']; ?> "></div>
							<div class="g-s-i-title box-flex ">
								<h3 class="ellipsis-one box-flex "><?php echo $brand_info['brand_name']; ?></h3>
								<p class="t-remark m-top04 ">共有 <?php echo $brand_goods_count; ?> 件商品</p>
							</div>
							<!--<div class="g-s-info-add ">
								<a href="# ">进入专区</a>
							</div>-->
						</section>
						<img class="bg " src="<?php echo __TPL__;?>img/shopping_info_b.png ">
					</div>
				</div>
			</div>
			<div class="shopping-info-nums b-color-f">
				<ul class="dis-box text-center">
					<li class="box-flex">
						 <a href="<?php echo U('brand/index/goods_list', array('id'=>$brand_id,'type'=>''));?>">
							<h4 id="all"><?php echo $brand_goods_count; ?></h4>
							<p class="t-remark3 m-top02">全部商品</p>
						 </a>
					</li>
					<li class="box-flex">
						 <a href="<?php echo U('brand/index/goods_list', array('id'=>$brand_id,'type'=>'new'));?>">
							<h4 id="new"><?php echo $brand_goods_new; ?></h4>
							<p class="t-remark3 m-top02">新品</p>
						 </a>
					</li>
					<li class="box-flex">
						 <a href="<?php echo U('brand/index/goods_list', array('id'=>$brand_id,'type'=>'hot'));?>">
							<h4 id="promote"><?php echo $brand_goods_hot; ?></h4>
							<p class="t-remark3 m-top02">热销</p>
						 </a>
					</li>
				</ul>
			</div>

			<div class="shopping-info-hot product-list  product-list-medium m-top06 b-color-f">
				<!--<h3 class="">热门产品</h3>-->
				<section class="brand-goodlist">
				<script id="j-product" type="text/html">
				<%if totalPage > 0%>
				<ul id="list-all">

				<%each list as goodslis%>

					<li class="<%goodslis.firsttype%>">
						<div class="product-div">
							<a class="product-div-link" href="<%goodslis.url%>"></a>
							<img class="product-list-img" src="<%goodslis.goods_thumb%>" />
							<div class="product-text">
								<h4><%goodslis.goods_name%></h4>
								<p class="dis-box p-t-remark"><span class="box-flex">库存:12800</span><span class="box-flex">销量:<%goodslis.sales_count%></span></p>
								<p><span class="p-price t-first "><!--<?php if($goods['promote_price']) { ?>--><%#goodslis.promote_price%><!--<?php } else { ?>--><%#goodslis.shop_price%><!--<?php } ?>--><small><del><%#goodslis.market_price%></del></small></span></p>
								<a href="javascript:void(0)" class="icon-flow-cart fr j-goods-attr"><i class="iconfont icon-gouwuche"></i></a>
							</div>
						</div>
					</li>
				<%/each%>

				</ul>
				<%else%>
				<div class="no-div-message">
					<i class="iconfont icon-biaoqingleiben"></i>
					<p>亲，此处没有内容～！</p>
				</div>
				<%/if%>
				</script>
				</section>
				<!--<div class="padding-all shopping-list-more"><a href="<?php echo U('brand/index/nav');?>">查看更多</a></div>-->
			</div>
		</div>
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
            <footer class="close-search j-close-search">点击关闭</footer>
        </div>
	</div>
	<div class="filter-top filter-top-index" id="scrollUp">
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
		<a href="<?php echo U('drp/user/index');?>" class="box-flex nav-list">
			<i class="nav-box i-user"></i><span><?php echo $custom; ?>中心</span>
		</a>
		<?php } elseif ($community) { ?>
		<a href="<?php echo U('community/index/index');?>" class="box-flex nav-list">
			<i class="nav-box i-user"></i><span>社区</span>
		</a>
		<?php } else { ?>
		<a href="<?php echo U('user/index/index');?>" class="box-flex nav-list">
			<i class="nav-box i-user"></i><span>我</span>
		</a>
		<?php } ?>
	</footer>
	<!--悬浮菜单e-->

	<script>
		$(function(){
			var url = "<?php echo U('goods_listasc', array('id'=>$brand_id));?>";
			//品牌列表
			$('.brand-goodlist').infinite({url: url, template:'j-product'});
		});
	</script>
</body>
</html>";s:12:"compile_time";i:1479511256;}";