<?php exit;?>001479558510e1ca0f69802deda42e2471f66461d0b0s:6436:"a:2:{s:8:"template";s:6372:"<?php $__Template->display($this->getTpl("page_header-nav")); ?>
<div class="con mb-7">
<div class="act-header-box"><img src="<?php echo $info['activity_thumb']; ?>"></div>
<section class="m-top08 goods-evaluation">
    <a href="javascript:;">
        <div class="dis-box padding-all b-color-f  g-evaluation-title">
            <div class="box-flex"><h3 class="my-u-title-size">活动规则</h3> </div>
        </div>
    </a>

    <div class="padding-all-1 m-top1px b-color-f g-evaluation-con">
        <div class="of-hidden evaluation-list">
            <p class="act-cont">活动时间：<?php echo $info['start_time']; ?> - <?php echo $info['end_time']; ?></p>
            <p class="act-cont">金额上限：<?php echo $info['min_amount']; ?> </p>
            <p class="act-cont">金额下限：<?php echo $info['max_amount']; ?></p>
            <p class="act-cont">享受优惠的会员等级：<?php $n=1;if(is_array($info['user_rank'])) foreach($info['user_rank'] as $rank) { ?><?php echo $rank; ?>&nbsp;<?php $n++;}unset($n); ?></p>
            <p class="act-cont">
            优惠范围：<?php echo $info['act_range']; ?>
            <?php if($info['act_range_ext'] && $info['act_range_type'] != 3) { ?>
            (
            <?php $n=1;if(is_array($info['act_range_ext'])) foreach($info['act_range_ext'] as $range_ext) { ?>
            <?php echo $range_ext['name']; ?>&nbsp;
            <?php $n++;}unset($n); ?>
            )
            <?php } ?>
            </p>
            <p class="act-cont">优惠方式：<?php echo $info['act_type']; ?></p>
        </div>
    </div>
</section>
<?php if($info['gift']) { ?>
<section class="m-top08 goods-evaluation">
    <a href="javascript:;">
        <div class="dis-box padding-all b-color-f  g-evaluation-title">
            <div class="box-flex"><h3 class="my-u-title-size">赠品（特惠品）</h3> </div>
        </div>
    </a>

    <section class="product-list j-product-list product-list-medium" data="1">
        <ul>
            <?php $n=1;if(is_array($info['gift'])) foreach($info['gift'] as $goods) { ?>
            <li>
            <div class="product-div">
                <a class="product-div-link" href="<?php echo $goods['url']; ?>"></a>
                <img class="product-list-img" src="<?php echo $goods['thumb']; ?>">
                <div class="product-text">
                    <h4><?php echo $goods['name']; ?></h4>
                    <p class="dis-box p-t-remark"><span class="box-flex">库存:<?php echo $goods['goods_number']; ?></span><span class="box-flex">销量:<?php echo $goods['sales_volume']; ?></span></p>
                    <p><span class="p-price t-first ">
                        <?php echo $goods['price']; ?>
                    </span></p>
                </div>
            </div>
            </li>
            <?php $n++;}unset($n); ?>
        </ul>
    </section>
</section>
<?php } ?>
<section class="m-top08 goods-evaluation">
    <a href="javascript:;">
        <div class="dis-box padding-all b-color-f  g-evaluation-title">
            <div class="box-flex"><h3 class="my-u-title-size">推荐产品</h3> </div>
        </div>
    </a>

    <section class="product-list_s product-list j-product-list product-list-medium">
        <script id="j-product" type="text/html">
        <%if totalPage > 0%>
        <ul>
            <%each list as goods%>
            <li>
            <div class="product-div">
                <a class="product-div-link" href="<%goods.url%>"></a>
                <img class="product-list-img" src="<%goods.goods_thumb%>">
                <div class="product-text">
                    <h4><%goods.goods_name%></h4>
                    <p class="dis-box p-t-remark"><span class="box-flex">库存:<%goods.goods_number%></span><span class="box-flex">销量:<%goods.sales_volume%></span></p>
                    <p><span class="p-price t-first ">
                        <%if goods.promote_price%>
                            <%#goods.promote_price%>
                        <%else%>
                            <%#goods.shop_price%>
                        <%/if%>
                        <small><del><%#goods.market_price%></del></small>
                    </span></p>
                    <a href="javascript:void(0)" class="icon-flow-cart fr j-goods-attr" onclick="addToCart(<%goods.goods_id%>, 0)"><i class="iconfont icon-gouwuche"></i></a>
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
</section>
<script type="text/javascript">
//异步数据
$(function(){
    var url = "<?php echo U('goods_list', array('id'=>$info['act_id']));?>";
    //订单列表
    $('.product-list_s').infinite({url: url, template:'j-product'});
})
</script>
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
</body>
</html>
";s:12:"compile_time";i:1479472110;}";