<?php exit;?>001476926072c76eda05496539c3ca38ac1ec136456fs:3375:"a:2:{s:8:"template";s:3311:"<?php $__Template->display($this->getTpl("page_header")); ?>
<?php $n=1;if(is_array($list)) foreach($list as $k=>$v) { ?>
<section class="goods-shop  b-color-f no-shopping-title <?php if($k > 0) { ?>m-top04<?php } ?>">
    <div class="goods-shop-pic of-hidden padding-all wallet-bt">
        <div class="g-s-p-con product-one-list of-hidden scrollbar-none j-g-s-p-con swiper-container-horizontal">
            <div class="swiper-wrapper">
                <?php $n=1;if(is_array($v['goods_list'])) foreach($v['goods_list'] as $key=>$goods) { ?>
                <li class="swiper-slide <?php if($key == 0) { ?>swiper-slide-active<?php } elseif ($key == 1) { ?>swiper-slide-next<?php } ?>">
                <div class="product-div">
                    <a class="product-div-link" href="<?php echo $goods['url']; ?>"></a>
                    <img class="product-list-img" src="<?php echo $goods['goods_thumb']; ?>">
                    <div class="product-text m-top06">
                        <h4><?php echo $goods['goods_name']; ?></h4>
                        <p><span class="p-price t-first "><?php echo $goods['rank_price']; ?></span></p>
                    </div>
                </div>
                </li>
                <?php $n++;}unset($n); ?>
            </div>
        </div>
    </div>
</section>
<section class="padding-all b-color-f">
    <ul class="int-nav-box my-new-m">
        <li class="int-max-tit"><?php echo $v['act_name']; ?> (<span><?php echo $v['package_number']; ?>件</span>)<span class="t-jiantou fr"><i class="iconfont icon-jiantou tf-180 jian-top int-jt-box"></i></span></li>
        <li class="int-title">套餐价：<span class="int-nav-box"><?php echo $v['package_amounte']; ?></span>(已优惠 <?php echo $v['saving']; ?>)</li>
    </ul>
    <ul class="int-cont" style="display:none">
        <li>起止时间：<?php echo $v['start_time']; ?>～<?php echo $v['end_time']; ?></li>
        <li>简单描述：<?php echo $v['act_desc']; ?></li>
    </ul>
    <section class="dis-box int-but-top">
        <a class="btn-submit box-flex" onclick="javascript:addPackageToCart(<?php echo $v['act_id']; ?>, <?php echo $area_id; ?>, <?php echo $region_id; ?>)">立即购买</a>
    </section>
</section>
<input name="confirm_type" id="confirm_type" type="hidden" value="3" />
<?php $n++;}unset($n); ?>
<script>
$(function($) {
    $(".int-nav-box").click(function() {
        $(this).find(".int-jt-box").toggleClass("current");					
        $(".int-cont").toggle();			
    });
    $(".int-nav-box-1").click(function() {
        $(this).find(".int-jt-box").toggleClass("current");					
        $(".int-cont-1").toggle();
    });
});
/*商品详情相册切换*/
var swiper = new Swiper('.goods-photo', {
paginationClickable: true,
onInit: function(swiper) {
document.getElementById("g-active-num").innerHTML = swiper.activeIndex + 1;
document.getElementById("g-all-num").innerHTML = swiper.slides.length;
},
onSlideChangeStart: function(swiper) {
document.getElementById("g-active-num").innerHTML = swiper.activeIndex + 1;
}
});
/*店铺信息商品滚动*/
var swiper = new Swiper('.j-g-s-p-con', {
scrollbarHide: true,
slidesPerView: 'auto',
centeredSlides: false,
grabCursor: true
});
</script>
</body>
</html>
";s:12:"compile_time";i:1476839672;}";