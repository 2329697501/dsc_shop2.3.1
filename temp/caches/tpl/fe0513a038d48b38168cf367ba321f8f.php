<?php exit;?>001479537813c56902ce7d2b90910650113697248d92s:600:"a:2:{s:8:"template";s:537:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con mb-7">
    <?php $__Template->display($this->getTpl("tzlist")); ?>
<script>
/*店铺信息商品滚动*/
var swiper = new Swiper('.j-g-s-p-con', {
    scrollbarHide: true,
    slidesPerView: 'auto',
    centeredSlides: false,
    grabCursor: true
});
//异步数据
$(function(){
    var url = "<?php echo U('list', array('type'=>$type));?>";
    $('.community-list').infinite({url: url, template:'j-product'});
})
</script>
</body>
</html>
";s:12:"compile_time";i:1479451413;}";