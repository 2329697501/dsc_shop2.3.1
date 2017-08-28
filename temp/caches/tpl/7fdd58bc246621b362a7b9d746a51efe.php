<?php exit;?>0014769306142e55b1e211b25bf1e29830c79bdad86cs:4514:"a:2:{s:8:"template";s:4450:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con mb-7">
    <!--头部导航-->
    <section class="b-color-f my-nav-box community">
        <div class=" t-s-i-title-1 dis-box my-dingdan purse-f">
            <a href="<?php echo U('community/index/list', array('type'=>3));?>" class="box-flex">
                <ul class="dis-box">
                    <li class="theme-left">
                    <div class="theme-box tm-zs">
                        <i class="iconfont icon-quanzi"></i></div>
                    </li>
                    <li class="box-flex">
                    <h4 class="ellipsis-one">圈子贴</h4>
                    <p class="t-remark3"><?php echo $quan['num']; ?>条</p>
                    <?php if($quan['has_new']) { ?>
                    <div class="purse-ts-box" style="display:block"></div>
                    <?php } ?>
                    </li>
                </ul>
            </a>
            <a href="<?php echo U('community/index/list', array('type'=>2));?>" class="box-flex">
                <ul class="dis-box">
                    <li class="theme-left">
                    <div class="theme-box tm-ls"><i class="iconfont icon-wenda"></i></div>
                    </li>
                    <li class="box-flex">
                    <h4 class="ellipsis-one">问答贴</h4>
                    <p class="t-remark3"><?php echo $wen['num']; ?>条</p>
                    <?php if($wen['has_new']) { ?>
                    <div class="purse-ts-box" style="display:block"></div>
                    <?php } ?>
                    </li>
                </ul>
            </a>
        </div>
        <div class=" t-s-i-title-1 dis-box my-dingdan purse-f">
            <a href="<?php echo U('community/index/list', array('type'=>1));?>" class="box-flex">
                <ul class="dis-box">
                    <li class="theme-left">
                    <div class="theme-box tm-ns"><i class="iconfont icon-xiao36"></i></div>
                    </li>
                    <li class="box-flex">
                    <h4 class="ellipsis-one">讨论贴</h4>
                    <p class="t-remark3"><?php echo $tao['num']; ?>条</p>
                    <?php if($tao['has_new']) { ?>
                    <div class="purse-ts-box" style="display:block"></div>
                    <?php } ?>
                    </li>
                </ul>
            </a>
            <a href="<?php echo U('community/index/list', array('type'=>4));?>" class="box-flex">
                <ul class="dis-box">
                    <li class="theme-left">
                    <div class="theme-box tm-hs"><i class="iconfont icon-paizhao"></i></div>
                    </li>
                    <li class="box-flex">
                    <h4 class="ellipsis-one">晒单贴</h4>
                    <p class="t-remark3"><?php echo $sun['num']; ?>条</p>
                    <?php if($sun['has_new']) { ?>
                    <div class="purse-ts-box" style="display:block"></div>
                    <?php } ?>
                    </li>
                </ul>
            </a>
        </div>
    </section>
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
    var url = "<?php echo U('index', array());?>";
    $('.community-list').infinite({url: url, template:'j-product'});
})
</script>
<script>
    function change_like_number(id) {
        if($("#red" + id).hasClass("active")){
            $("#red" + id).removeClass("active");
        }else{
            $("#red" + id).addClass("active");
        }
        var isclick = document.getElementById('isclick').value;
        $("#isclick").val(new Date().getTime());
        if(isclick < (new Date().getTime()-1000)) {
            $.ajax({
                type: "post",
                url: "<?php echo U('like');?>",
                data: {article_id: id},
                dataType: "json",
                success: function (data) {
                    $("#like_num" + id).html(data.like_num);
                    $("#islike" + id).val(data.is_like);
                }
            });
        }

    }
</script>
</body>
</html>
";s:12:"compile_time";i:1476844214;}";