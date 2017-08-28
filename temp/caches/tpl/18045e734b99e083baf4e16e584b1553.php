<?php exit;?>001478683420d664807b24c519b5a5e7fa67c26760f7s:10559:"a:2:{s:8:"template";s:10494:"<?php $__Template->display($this->getTpl("page_header")); ?>
<form action="<?php echo U('addcom');?>" method="post" enctype="multipart/form-data" onsubmit="return check()">
    <div class="con mb-8">
        <!--<div id="loading"><img src="<?php echo __TPL__;?>img/loading.gif" /></div>-->
        <!--头部导航-->

        <section class="padding-all select-one-1">
            <ul class="dis-box j-get-one">
                <li class="ect-select box-flex list-select promotion my-but-pre">
                    <label class="ts-1 dis-block <?php if($commentid && $commentid !=1) { ?><?php } else { ?>active<?php } ?>" data-commentid="1">讨论帖</label>
                </li>
                <li class="ect-select box-flex my-but-pre">
                    <label class="ts-1 dis-block <?php if($commentid == 2) { ?>active<?php } ?>" data-commentid="2">问答贴</label>
                </li>
                <li class="ect-select box-flex list-select hasgoods my-but-pre">
                    <label class="ts-1 dis-block <?php if($commentid == 3) { ?>active<?php } ?>" data-commentid="3">圈子贴</label>
                </li>
                <li class="ect-select box-flex list-select promotion my-but-pre">
                    <label class="ts-1 dis-block <?php if($commentid == 4) { ?>active<?php } ?>" data-commentid="4"
                           id="openpic">晒单贴</label>
                </li>
            </ul>
            <input type="hidden" name="commentid" value="<?php if($commentid) { ?><?php echo $commentid; ?><?php } else { ?>1<?php } ?>"/>
        </section>
        <section id="comment_rank" class="m-top06 padding-all b-color-f" <?php if($commentid == 4) { ?><?php } else { ?>style="display: none;"<?php } ?>>
            <div class="dis-box position-rel evaluation-all">
                <label class="t-remark g-t-temark">评价</label>
                <div class="evaluation-all-r j-evaluation-star">
					<span class="evaluation-star active ts-3"> <i class="iconfont icon-wujiaoxing"></i></span>
                    <span class="evaluation-star active ts-3"> <i class="iconfont icon-wujiaoxing"></i></span>
                    <span class="evaluation-star active ts-3"> <i class="iconfont icon-wujiaoxing"></i></span>
                    <span class="evaluation-star active ts-3"> <i class="iconfont icon-wujiaoxing"></i></span>
                    <span class="evaluation-star active ts-3"> <i class="iconfont icon-wujiaoxing"></i></span>
                    <input class="j-evaluation-value" type="hidden" name="comment_rank" value="5"/>
                </div>
            </div>
        </section>
        <section id="title" class="padding-all b-color-f" <?php if($commentid == 4) { ?>style="display: none;"<?php } ?>>
            <div class="text-all">
                <div class="input-text">
                    <input type="text" value="<?php echo $title; ?>" placeholder="标题" name="title">
                </div>
            </div>
        </section>
        <section class="padding-all b-color-f com-textarea">
            <div class="f-c-select-msg">
                <div class="text-area1 text-area2 m-top04">
                    <textarea name="content" class="text-area1" maxlength="300"
                              placeholder="留下点文字吧……"><?php echo $content; ?></textarea>
                    <span>300</span>
                </div>
            </div>
        </section>
        <?php if($postgoods) { ?>
        <div class="dis-box padding-all my-bottom b-color-f my-nav-box">
            <h3 class="box-flex text-all-span my-u-title-size-1">关联商品</h3>
        </div>
        <a href="<?php echo $postgoods['goods_url']; ?>">
            <section class="dis-box b-color-f padding-all">
                <div class="write-add-img-box b-color-f">
                    <div class="write-add-img"><img src="<?php echo $postgoods['goods_thumb']; ?>"></div>
                </div>
                <div class="box-flex gl-com"><p><?php echo $postgoods['goods_name']; ?></p></div>
                <div class="my-dete-box"><span class="t-jiantou fr"><i
                        class="iconfont icon-jiantou tf-180 jian-top int-jt1-box"></i></span></div>
            </section>
        </a>
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
        <input type="hidden" name="goods_id" value="<?php echo $postgoods['goods_id']; ?>"/>
        <?php } ?>
        <div id="pic" <?php if($commentid == 4) { ?><?php } else { ?>style="display: none;"<?php } ?>>
            <section class="box mb-1 title inx-ms m-top06 b-color-f et-new-p">
                <div class="t-shai" id="preview">
                </div>
            </section>
            <div class="padding-all mb-7">
                <div class="write-sd">
                <span class="span-file"><label>添加晒单图片</label>
                    <input type="file" name="pic" onchange="previewImage(this)" accept="image/*"/></span>
                </div>
            </div>
        </div>
    </div>
    <!--悬浮btn star-->
    <div class="ect-button-more filter-btn dis-box m-top12 padding-lr">
        <a onclick="addpost()" class="btn-reset box-flex btn-clear new-but">添加关联商品</a>
        <button type="submit" class="btn-submit box-flex">发帖</button>
    </div>
</form>
<!--悬浮btn end-->
<!--引用js-->

<script>
    function addpost() {
        var content = $("textarea[name=content]").val();
        var title = $("input[name=title]").val();
        var commentid = $("input[name=commentid]").val();
        var url = "<?php echo U('addpost');?>";
        var args = new Array(3);
        args['content'] = content;
        args['title'] = title;
        args['commentid'] = commentid;
        StandardPost(url, args);
    }
    function StandardPost(url, args) {
        var form = $("<form method='post'></form>");
        form.attr({"action": url});
        for (arg in args) {
            var input = $("<input type='hidden'>");
            input.attr({"name": arg});
            input.val(args[arg]);
            form.append(input);
        }
        form.submit();
    }
</script>
<script type="text/javascript">
    function previewImage(file) {
        var MAXWIDTH = $("#preview").width();
        var MAXHEIGHT = 180;
        var div = document.getElementById('preview');
        if (file.files && file.files[0]) {
            div.innerHTML = '<img id=imghead height=auto width=100%>';
            var img = document.getElementById('imghead');
            img.onload = function () {
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);

                img.style.marginTop = rect.top + 'px';
            }
            var reader = new FileReader();
            reader.onload = function (evt) {
                img.src = evt.target.result;
            }
            reader.readAsDataURL(file.files[0]);
        }
        else //IE
        {
            var sFilter = 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status = ('rect:' + rect.top + ',' + rect.left + ',' + rect.width + ',' + rect.height);
            div.innerHTML = "<div id=divhead style='width:" + rect.width + "px;height:" + rect.height + "px;margin-top:" + rect.top + "px;" + sFilter + src + "\"'></div>";
        }
    }
    function clacImgZoomParam(maxWidth, maxHeight, width, height) {
        var param = {top: 0, left: 0, width: width, height: height};
        if (width > maxWidth || height > maxHeight) {
            rateWidth = width / maxWidth;
            rateHeight = height / maxHeight;
            if (rateWidth > rateHeight) {
                param.width = maxWidth;
                param.height = Math.round(height / rateWidth);
            } else {
                param.width = Math.round(width / rateHeight);
                param.height = maxHeight;
            }
        }
        param.left = 0;
        param.top = 0;
        return param;
    }
</script>
<script>
    /*店铺信息商品滚动*/
    var swiper = new Swiper('.j-g-s-p-con', {
        scrollbarHide: true,
        slidesPerView: 'auto',
        centeredSlides: false,
        grabCursor: true
    });
    $('.ts-1').on('click', function () {
        var commentid = $(this).attr("data-commentid");
        $("input[name=commentid]").val(commentid);
        $('#pic').hide();
        $('#comment_rank').hide();
        $('#title').show();
    })
    $('#openpic').on('click', function () {
        $('#pic').show();
        $('#comment_rank').show();
        $('#title').hide();
    })
    function check() {
        var goodsid = $("input[name=goods_id]").val();
        if (!goodsid) {
            d_messages('请选择一件关联商品');
            return false;
        }
        var commentid = $(".ect-select .active").attr("data-commentid");
        if (!commentid) {
            d_messages('请选择帖子主题');
            return false;
        }
        var content = $("textarea[name=content]").val();
        if (content == '') {
            d_messages('请填写帖子内容');
            return false;
        }
        if (commentid == 4) {
            var order_id = document.querySelector("input[name=order_id]").value;
            if (!order_id) {
                d_messages('请选择已购买过的商品');
                return false;
            }
            var oInput = document.querySelector("input[type=file]").value;
            if (oInput == '') {
                d_messages('请上传一张图片');
                return false;
            }
        }else{
            var title = document.querySelector("input[name=title]").value;
            if (title == '') {
                d_messages('请填写标题');
                return false;
            }
        }
    }

</script>
</body>

</html>
";s:12:"compile_time";i:1478597020;}";