<?php exit;?>0014768883215aa3465cd07681773dfd0073bda0f0b2s:13229:"a:2:{s:8:"template";s:13164:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con mb-7">
    <div id="loading"><img src="<?php echo __TPL__;?>img/loading.gif"/></div>
    <!--晒单列表-->
    <section class="com-nav article-list">
        <div class="art-tit-box padding-all">
            <h4 class="com-cont-box art-cont-box"><?php echo $article['title']; ?></h4>
            <small>
                <time><?php echo $article['add_time']; ?></time>
                <span><?php echo $article['author']; ?></span></small>
        </div>
        <div class=" dis-n-detail padding-all"><?php echo $article['content']; ?></div>
        <div class="padding-all  b-color-f  m-top06 fx-deta-box">
            <ul class="dis-box com-list-1">
                <li class="box-flex">
                    <div class="yuan oncle-color-1" onclick="dianzan(<?php echo $article['article_id']; ?>)">
                        <a href="javascript:;" id="red<?php echo $article['article_id']; ?>" <?php if($islike) { ?> class="active" <?php } else { ?><?php } ?>>
                        <i class="iconfont icon-zan icon-yuan1"></i>
                        <p id="like_num"><?php echo $like_num; ?></p>
                        <input id="like" type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>"/>
                        <input id="islike" type="hidden" id="<?php echo $article['article_id']; ?>" name="islike" value="<?php echo $islike; ?>"/>
                        <input id="isclick" type="hidden" name="isclick" value="0"/>
                        </a>
                    </div>

                </li>
                <li class="box-flex j-show-div">
                    <div class="yuan oncle-color new-color">
                        <i class="iconfont icon-fenxiang"></i>
                        <p>分享</p>
                    </div>

                    <div class="com-icon">
                        <section class="j-show-div j-show-get-val padding-lr">
                            <!--充值方式弹出层-->
                            <div class="show-time-con ts-3 b-color-1 j-filter-show-div">
                                <section class="goods-show-title of-hidden padding-all b-color-f">
                                    <h3 class="fl g-c-title-h3">分享到：</h3>
                                    <i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
                                </section>
                                <section class="s-g-list-con swiper-scroll">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide select-two">
                                            <ul class="j-get-one padding-all ul-4 pt-1 is-over">
                                                <div class="bdsharebuttonbox" data-tag="share_1">
                                                    <a class="bds_weixin" data-cmd="weixin"></a>
                                                    <a class="bds_sqq" data-cmd="sqq"></a>
                                                    <a class="bds_qzone" data-cmd="qzone" href="#"></a>
                                                    <a class="bds_tsina" data-cmd="tsina"></a>
                                                    <a class="bds_pyq user-shop-fx"></a>
                                                </div>
                                                <script>
                                                    window._bd_share_config = {
                                                        common: {
                                                            bdText: '<?php echo $article['content_fx']; ?>',
                                                            bdDesc: '<?php echo $article['title']; ?>',
                                                            bdUrl: window.location.href
                                                        },
                                                        share: [{
                                                            "bdSize": 16
                                                        }],
                                                        image: [{
                                                            viewType: 'list',
                                                            viewPos: 'top',
                                                            viewColor: 'black',
                                                            viewSize: '16',
                                                            viewList: ['qzone', 'tsina', 'huaban', 'tqq', 'renren']
                                                        }],
                                                        selectShare: [{
                                                            "bdselectMiniList": ['qzone', 'tqq', 'kaixin001', 'bdxc', 'tqf']
                                                        }]
                                                    }
                                                    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
                                                </script>
                                            </ul>
                                        </div>
                                        <div class="swiper-scrollbar"></div>
                                    </div>
                                </section>
                            </div>
                        </section>
                    </div>

                </li>
            </ul>
        </div>
    </section>
    <section>
        <div class="dis-box padding-all my-bottom b-color-f my-nav-box m-top06">
            <h3 class="box-flex text-all-span my-u-title-size-1">关联商品</h3>
        </div>

        <ul class="dis-box b-color-f padding-all">
            <?php if($recommend_goods) { ?>
            <li class="write-add-img-box b-color-f">
                <div class="write-add-img"><a href="<?php echo $recommend_goods['url']; ?>"><img src="<?php echo $recommend_goods['thumb']; ?>"></a></div>
            </li>
            <li class="box-flex gl-com">
                <p><a href="<?php echo $recommend_goods['url']; ?>"><?php echo $recommend_goods['name']; ?></a></p>
            </li>
            <?php } ?>
            <?php if($acticle_goods) { ?>
            <li class="write-add-img-box b-color-f">
                <div class="write-add-img"><a href="<?php echo $acticle_goods['goods_url']; ?>"><img src="<?php echo $acticle_goods['goods_thumb']; ?>"></a></div>
            </li>
            <li class="box-flex gl-com">
                <p><a href="<?php echo $acticle_goods['goods_url']; ?>"><?php echo $acticle_goods['goods_name']; ?></a></p>
            </li>
            <?php } ?>
            <div class="my-dete-box">
                <span class="t-jiantou fr"></span></div>
        </ul>

    </section>
    <section>

        <!--评论列表-->
        <?php if($commentfirst) { ?>
        <div class="dis-box padding-all my-bottom b-color-f my-nav-box m-top06">
            <h3 class="box-flex text-all-span my-u-title-size-1">评论列表</h3>
        </div>
        <?php $n=1; if(is_array($commentfirst)) foreach($commentfirst as $key => $cf) { ?>
        <ul class="padding-all b-color-f my-com-max-box">
            <li class="com-img-left">
                <div class="com-left-box"><img src="<?php echo $cf['user_picture']; ?>"></div>
            </li>
            <li class="com-con-right">
                <ul class="dis-box">
                    <li class="box-flex">
                        <div class="com-adm-box">
                            <h4 id="<?php echo $cf['comment_id']; ?>"><?php echo $cf['user_name']; ?></h4>
                            <p><?php echo $cf['comment_time']; ?></p>
                        </div>
                    </li>
                    <li class="not">
                        <div class="com-data-right  com-list-1">
									<span class="oncle-color" onclick="comment2(<?php echo $cf['comment_id']; ?>)"><span
                                            class="my-right1"><?php if($cf['count'] > 0) { ?><?php echo $cf['count']; ?><?php } else { ?>0<?php } ?><i
                                            class="iconfont icon-daipingjia"></i></span>
									</span>
                        </div>
                    </li>
                </ul>
                <p class="com-con-m"><?php echo $cf['content']; ?></p>
                <?php $n=1; if(is_array($cf['second'])) foreach($cf['second'] as $ke => $cs) { ?>
                <?php if($ke <10) { ?>
                <div class="pl-hf-box padding-all">
                    <p><span><?php echo $cs['user_name']; ?> : </span><?php echo $cs['content']; ?></p>
                    <div class="x-jiant"></div>
                </div>
                <?php } ?>
                <?php $n++;}unset($n); ?>
            </li>
        </ul>
        <?php $n++;}unset($n); ?>
        <?php } ?>
    </section>
</div>
<section class="filter-btn consult-filter-btn padding-all" style="display:list-item; height:5rem;">
    <div class="dis-box">
        <div class="box-flex text-all">
            <input class="j-input-text" type="text" name='comment' placeholder="回复文章:" value="">
        </div>
        <button type="button" class="btn-submit">发送</button>
    </div>
</section>
<input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>"/>
<input type="hidden" name="cid" value=""/>
<div class="mask-filter-div"></div>
<div class="shopping-prompt ts-2">
    <img src="<?php echo __TPL__;?>img/fengxiang.png" />
</div>

<script>
//    function init() {
//        clip = new ZeroClipboard.Client(); //初始化对象
//        ZeroClipboard.setMoviePath("js/clipboard/ZeroClipboard.swf");设置flash
//        clip.setHandCursor( true ); //设置手型
//        clip.addEventListener('mouseDown', function (client) {  //创建监听
//            copylink(); //设置需要复制的代码
//        });
//        clip.glue( 'd_clip_button'); //将flash覆盖至指定ID的DOM上
//    }
    function copylink(){
        clip.setText(window.location.href);
    }
    $(function ($) {
        //分享弹框
        $(".goods-share-img").click(function () {
            $(".share-bg-box-y").addClass("display-current");
            $(".share-ts-title-y").addClass("display-current");
        });
        $(".share-bg-box-y").click(function () {
            $(".share-bg-box-y").removeClass("display-current");
            $(".share-ts-title-y").removeClass("display-current");
        });

    });
    $('.mb-7').click(function () {
        $(".j-input-text").attr('placeholder', '回复文章:');
        $("input[name='cid']").val('');
    })
    function comment2(cid) {
        c_id = cid;
        event.stopPropagation();
        cname = document.getElementById(cid).innerHTML;
        $(".j-input-text").attr('placeholder', '回复' + cname + ':');
        $("input[name='cid']").val(c_id);
    }

    $('.btn-submit').click(function () {
        $.ajax({
            type: "post",
            url: "<?php echo U('article/index/commnet');?>",
            data: {
                content: $("input[name='comment']").val(),
                article_id: $("input[name='article_id']").val(),
                cid: $("input[name='cid']").val()
            },
            dataType: "json",
            success: function (data) {
                status(data);
            }
        });
        function status(json) {
            window.location.href = json;
        }

    });



    function dianzan(id) {
        if ($("#red" + id).hasClass("active")) {
            $("#red" + id).removeClass("active");
        } else {
            $("#red" + id).addClass("active");
        }
        var islike = document.getElementById('islike').value;
        var article_id = document.getElementById('like').value;
        var isclick = document.getElementById('isclick').value;
        $("#isclick").val(new Date().getTime());
        if (isclick < (new Date().getTime() - 1000)) {
            $.ajax({
                type: "post",
                url: "<?php echo U('article/index/like');?>",
                data: {article_id: article_id, islike: islike},
                dataType: "json",
                success: function (data) {
                    $("#like_num").html(data.like_num);
                    $("#islike").val(data.is_like);
                }
            });
        }


    }

    /*店铺信息商品滚动*/
    var swiper = new Swiper('.j-g-s-p-con', {
        scrollbarHide: true,
        slidesPerView: 'auto',
        centeredSlides: false,
        grabCursor: true
    });
</script>

</body>

</html>";s:12:"compile_time";i:1476801921;}";