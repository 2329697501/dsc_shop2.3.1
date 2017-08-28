<?php exit;?>0014769306007252b5c15ee506015dd9f4caf7fdeccas:31661:"a:2:{s:8:"template";s:31596:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con">
    <header class="dis-box header-menu b-color color-whie"><a class="" href="javascript:history.go(-1);"><i class="iconfont icon-back"></i></a>
        <h3 class="box-flex"><?php echo $page_title; ?></h3><a></a></header>
    <form name="ECS_FORMBUY" action="<?php echo U('exbuy');?>" id="ECS_FORMBUY" method="post" onsubmit="return get_exchange();">
    <div class="goods">
        <div class="goods-photo j-show-goods-img">
            <span class="goods-num" id="goods-num"><span id="g-active-num"></span>/<span id="g-all-num"></span></span>
            <div class="swiper-wrapper">
                <?php $n=1;if(is_array($goods_img)) foreach($goods_img as $goods_img) { ?>
                <li class="swiper-slide tb-lr-center"><img src="<?php echo $goods_img['img_url']; ?>"/></li>
                <?php $n++;}unset($n); ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <section class="goods-title b-color-f padding-all ">
            <div class="dis-box">
                <h3 class="box-flex"> <?php if(empty($goods['user_id'])) { ?>
                    <em class="em-promotion">自营</em>
                    <?php } ?>
                    <?php echo $goods['goods_name']; ?></h3></h3>
                <span class="heart j-heart <?php if($goods_collect) { ?>active<?php } ?>"  onclick="collect(<?php echo $goods['goods_id']; ?>)" id="ECS_COLLECT"><i class="ts-2"></i><em class="ts-2">收藏</em></span>
            </div>
        </section>
        <section class="goods-price padding-all b-color-f">
            <p class="p-price"><span class="t-first"><?php echo $goods['exchange_integral']; ?></span><em
                    class="g-p-tthree in-new">抵用券</em></p>
            <p class="p-market">市场价
                <del><?php echo $goods['market_price']; ?></del>
            </p>
            <p class=" dis-box g-p-tthree m-top06">
                <span class="box-flex text-left">销量 <?php echo $goods['sales_volume']; ?> <?php echo $goods['measure_unit']; ?></span>
                <span class="box-flex text-center">库存 <?php echo $goods['goods_number']; ?> <?php echo $goods['measure_unit']; ?></span>
            </p>
        </section>
        <section class="m-top04 padding-all b-color-f goods-promotion">
            <div class="dis-box">
                <label class="t-remark g-t-temark">促销</label>
                <div class="box-flex g-promotion-con">
                    <p><em class="em-promotion">兑换</em><span class="">每100抵用券可抵<?php echo $integral_scale; ?>现金</span></p>

                </div>
            </div>
        </section>

        <section class="m-top1px padding-all b-color-f goods-attr j-goods-attr j-show-div">
            <div class="dis-box">
                <label class="t-remark g-t-temark">已选</label>
                <div class="box-flex t-goods1 ">请选择</div>
                <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
            </div>
            <!--商品属性弹出层star-->
            <div class="mask-filter-div"></div>
            <div class="show-goods-attr j-filter-show-div ts-3 b-color-1">
                <section class="s-g-attr-title b-color-1  product-list-small">
                    <div class="product-div">
                        <img class="product-list-img" src="<?php echo $goods['goods_img']; ?>">
                        <div class="product-text">
                            <div class="dis-box position-rel">
                                <h4 class="box-flex"><?php echo $goods['goods_name']; ?></h4>
                                <i class="iconfont icon-guanbi2 show-div-guanbi"></i>
                            </div>
                            <p><span class="p-price t-first class-exchange"><?php echo $goods['exchange_integral']; ?></span><em
                                    class="g-p-tthree in-new">抵用券</em></p>
                            <p class="dis-box p-t-remark"><span class="box-flex">库存:<font class="goods_attr_num"><?php echo $goods['goods_number']; ?></font> <?php echo $goods['measure_unit']; ?></span>
                            </p>
                        </div>
                    </div>
                </section>
                <section class="s-g-attr-con swiper-scroll b-color-f padding-all m-top1px">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <?php $n=1;if(is_array($specification)) foreach($specification as $spec_key=>$spec) { ?>
                            <?php if($spec['values']) { ?>
                            <h4 class="t-remark"><?php echo $spec['name']; ?></h4>
                            <!-- 判断属性是复选还是单选 -->
                            <?php if($spec['attr_type'] == 1) { ?>
                            <ul class="select-one j-get-one m-top10">
                                <?php if($spec['is_checked'] > 0) { ?>
                                <!-- pc有属性图片 -->
                                <?php $n=1;if(is_array($spec['values'])) foreach($spec['values'] as $key=>$val) { ?>
                                <a class="ect-select dis-flex fl" href="javascript:;" <?php if($val['img_site']) { ?>onclick="location.href='<?php echo $val['img_site']; ?>'"<?php } ?>>
                                <label class="ts-1 <?php if($val['checked'] == 1) { ?>active<?php } ?>" for="spec_value_<?php echo $val['id']; ?>"><?php echo $val['label']; ?></label>
                                <input style="display:none" id="spec_value_<?php echo $val['id']; ?>" type="radio" name="spec_<?php echo $spec_key; ?>" value="<?php echo $val['id']; ?>" <?php if($val['checked'] == 1) { ?>checked<?php } ?> onclick="changePrice()" />
                                </a>
                                <?php $n++;}unset($n); ?>
                                <?php } else { ?>
                                <!-- pc没属性图片 -->
                                <?php $n=1;if(is_array($spec['values'])) foreach($spec['values'] as $key=>$val) { ?>
                                <a class="ect-select dis-flex fl" href="javascript:;" <?php if($val['img_site']) { ?>onclick="location.href='<?php echo $val['img_site']; ?>'"<?php } ?>>
                                <label class="ts-1 <?php if($key == 0) { ?>active<?php } ?>" for="spec_value_<?php echo $val['id']; ?>"><?php echo $val['label']; ?></label>
                                <input style="display:none" id="spec_value_<?php echo $val['id']; ?>" type="radio" name="spec_<?php echo $spec_key; ?>" value="<?php echo $val['id']; ?>" <?php if($key == 0) { ?>checked<?php } ?> onclick="changePrice()" />
                                </a>
                                <?php $n++;}unset($n); ?>
                                <?php } ?>
                            </ul>
                            <input type="hidden" name="spec_list" value="<?php echo $key; ?>" />

                            <?php } else { ?>
                            <ul class="select-one j-get-one m-top10">
                                <?php $n=1;if(is_array($spec['values'])) foreach($spec['values'] as $key=>$val) { ?>
                                <li class="ect-select dis-flex fl">
                                    <label class="ts-1 <?php if($key == 0) { ?>active<?php } ?>" for="spec_value_<?php echo $val['id']; ?>"><?php echo $val['label']; ?></label>
                                    <input type="checkbox" name="spec_<?php echo $spec_key; ?>[]" value="<?php echo $val['id']; ?>" id="spec_value_<?php echo $val['id']; ?>" onclick="changePrice()" <?php if($select_key == 0) { ?>checked<?php } ?> style="display:none" />
                                </li>
                                <?php $n++;}unset($n); ?>
                            </ul>
                            <?php } ?>
                            <?php } ?>
                            <?php $n++;}unset($n); ?>
                            <!-- 普通商品可修改数量 -->
                            <h4 class="t-remark">数量</h4>
                            <?php if($goods['goods_id'] > 0 && $goods['is_gift'] == 0 && $goods['parent_id'] == 0) { ?>
                            <div class="div-num dis-box m-top08">
                                <a class="num-less" onClick="changePrice('1')"></a>
                                <input class="box-flex" type="text" value="1" onblur="changePrice('2')" name="number" id="goods_number" />
                                <a class="num-plus" onClick="changePrice('3')"></a>
                            </div>
                            <?php } else { ?>
                            <div class="div-num dis-box m-top08 div-num-disabled">
                                <a class="num-less"></a>
                                <input class="box-flex" type="text" value="<?php echo $goods['goods_number']; ?>" name="number"/>
                                <a class="num-plus"></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="swiper-scrollbar"></div>
                </section>
                <section class="ect-button-more dis-box padding-all">
                    <input type="hidden" value="<?php echo $province_row['region_id']; ?>" id="province_id" name="province_region_id">
                    <input type="hidden" value="<?php echo $city_row['region_id']; ?>" id="city_id" name="city_region_id">
                    <input type="hidden" value="<?php if($district_row['region_id']) { ?><?php echo $district_row['region_id']; ?><?php } else { ?>0<?php } ?>"
                           id="district_id" name="district_region_id">
                    <input type="hidden" value="<?php echo $region_id; ?>" id="region_id" name="region_id">
                    <input type="hidden" value="<?php echo $goods_id; ?>" id="good_id" name="good_id">
                    <input type="hidden" value="<?php echo $user_id; ?>" id="user_id" name="user_id">
                    <input type="hidden" value="<?php echo $area_id; ?>" id="area_id" name="area_id">
                    <a class="btn-disab box-flex quehuo" href="javascript:;" <?php if($goods['review_status'] > 2) { ?>style="display:none"<?php } ?>>已经兑完</a>
                    <button type="sumbit" class="btn-submit box-flex add-to-cart" <?php if($goods['review_status'] <= 2) { ?>style="display:none"<?php } ?>>立即兑换</button>
                </section>
            </div>
            <!--商品属性弹出层end-->
        </section>
        <section class="m-top1px padding-all b-color-f goods-service j-show-div">
            <div class="dis-box">
                <label class="t-remark g-t-temark">服务</label>
                <div class="box-flex">
                    <div class="dis-box">
                        <p class="box-flex t-goods1"><?php if($goods['user_id'] > 0) { ?>
                            由<?php echo $goods['rz_shopName']; ?>发货并提供售后服务。
                            <?php } else { ?>
                            由<?php echo $basic_info['shop_name']; ?>发货并提供售后服务。
                            <?php } ?></p>
                        <i class="iconfont icon-102 goods-min-icon"></i>
                        <!--服务信息star-->
                        <div class="show-goods-service j-filter-show-div ts-3 b-color-1">
                            <section class="goods-show-title of-hidden padding-all b-color-f">
                                <h3 class="fl g-c-title-h3">服务说明</h3>
                                <i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
                            </section>
                            <section class="goods-show-con goods-big-service swiper-scroll">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <ul>
                                            <li class="m-top1px b-color-f padding-all of-hidden">
                                                <p class="dis-box t-remark3">
                                                    <em class="em-promotion"><i
                                                            class="iconfont icon-daifukuan"></i></em>
                                                    <span class="box-flex">货到付款</span>
                                                </p>
                                                <p class="g-b-s-con m-top08">支持送货上门后再收款，支持现金、POS机刷卡等方式</p>
                                            </li>
                                            <li class="m-top1px b-color-f padding-all of-hidden">
                                                <p class="dis-box t-remark3">
                                                    <em class="em-promotion"><i
                                                            class="iconfont icon-7tianwuliyoutuihuo"></i></em>
                                                    <span class="box-flex">7天退货</span>
                                                </p>
                                                <p class="g-b-s-con m-top08">自实际收货日期的次日起7天内，商品完好，可进行无理由退换货</p>
                                            </li>
                                            <li class="m-top1px b-color-f padding-all of-hidden">
                                                <p class="dis-box t-remark3">
                                                    <em class="em-promotion"><i
                                                            class="iconfont icon-tixingnaozhong"></i></em>
                                                    <span class="box-flex">极速达</span>
                                                </p>
                                                <p class="g-b-s-con m-top08">上午下单，下午送达</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </section>
                        </div>
                        <!--服务信息end-->
                    </div>
                    <div class="dis-box m-top08 g-r-rule">
                        <p class="box-flex t-remark3">
                            <em class="fl em-promotion"><i class="iconfont icon-daifukuan"></i></em><span class="fl">货到付款</span>
                        </p>
                        <p class="box-flex t-remark3">
                            <em class="fl em-promotion"><i class="iconfont icon-7tianwuliyoutuihuo"></i></em><span
                                class="fl">7天退货</span></p>
                        <p class="box-flex t-remark3">
                            <em class="fl em-promotion"><i class="iconfont icon-tixingnaozhong"></i></em><span
                                class="fl">极速达</span></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="m-top04 goods-evaluation">
            <a href="<?php echo U('goods/index/comment', array('id'=>$goods['goods_id']));?>">
                <div class="dis-box padding-all b-color-f  g-evaluation-title">
                    <label class="t-remark g-t-temark">用户评价</label>
                    <div class="box-flex t-goods1">好评率 <em class="t-first"><?php echo $comment_all['goodReview']; ?>%</em></div>
                    <div class="t-goods1"><em class="t-first"><?php echo $comment_all['allmen']; ?></em><span class="t-jiantou">人评论<i
                            class="iconfont icon-jiantou tf-180"></i></span></div>
                </div>
            </a>
            <?php if($good_comment) { ?>
            <div class="padding-all m-top1px b-color-f g-evaluation-con">
                <div class="of-hidden evaluation-list">
                    <div class="of-hidden ">
                        <p class="fl"><span class="grade-star g-star-5 fl"></span><em class="t-remark fl"><?php echo $good_comment[0]['username']; ?></em>
                        </p>
                        <p class="fr t-remark"><?php echo $good_comment[0]['add_time']; ?></p>
                    </div>
                    <p class="clear m-top10 t-goods1"><?php echo $good_comment[0]['content']; ?></p>
                    <?php if($good_comment[0]['goods']) { ?>
                    <p class="clear m-top08 t-remark"><?php echo $good_comment[0]['goods'][0]['goods_attr']; ?></p>
                    <?php } ?>
                    <div class="ect-button-more m-top10 dis-box">
                        <a href="<?php echo U('goods/index/infoimg', array('id'=>$goods['goods_id']));?>" class="box-flex btn-default">有图评价</a>
                        <a href="<?php echo U('goods/index/comment', array('id'=>$goods['goods_id']));?>" class="box-flex btn-default">全部评价</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </section>
        <section class="m-top04 padding-all goods-shop  b-color-f">
            <?php if($goods['user_id']) { ?>
            <div class="goods-shop-info">
                <a href="<?php echo $goods['store_url']; ?>" class="link-abs"></a>
                <section class="dis-box">
                    <div class="g-s-i-img"><img src="<?php echo $goods['shopinfo']['logo_thumb']; ?>"/></div>
                    <div class="g-s-i-title box-flex">
                        <h3 class="ellipsis-one"><?php echo $goods['rz_shopName']; ?></h3>
                        <p class="t-remark m-top04">已经有 <?php echo $collect_number; ?> 人关注</p>
                    </div>
                </section>
                <section class="dis-box goods-shop-score m-top12">
                    <p class="box-flex">
                        <label class="fl">商品</label><span class="t-first margin-lr fl"><?php echo $merch_cmt['cmt']['commentRank']['zconments']['score']; ?>分</span><em
                            class="em-promotion fl"><?php echo $merch_cmt['cmt']['commentRank']['zconments']['goodReview']; ?></em>
                    </p>
                    <p class="box-flex">
                        <label class="fl">服务</label><span class="t-low margin-lr fl"><?php echo $merch_cmt['cmt']['commentServer']['zconments']['score']; ?>分</span><em
                            class="em-promotion em-p-low fl"><?php echo $merch_cmt['cmt']['commentServer']['zconments']['goodReview']; ?></em>
                    </p>
                    <p class="box-flex">
                        <label class="fl">时效</label><span class="t-center margin-lr fl"><?php echo $merch_cmt['cmt']['commentDelivery']['zconments']['score']; ?>分</span><em
                            class="em-promotion em-p-center fl"><?php echo $merch_cmt['cmt']['commentDelivery']['zconments']['goodReview']; ?></em>
                    </p>
                </section>
            </div>
            <?php } ?>
            <?php if($new_goods) { ?>
            <div class="goods-shop-pic of-hidden">
                <h4 class="title-hrbg m-top06"><span>爆款新品</span>
                    <hr>
                </h4>
                <div class="g-s-p-con product-one-list of-hidden scrollbar-none j-g-s-p-con">
                    <div class="swiper-wrapper ">
                        <?php $n=1;if(is_array($new_goods)) foreach($new_goods as $k=>$v) { ?>
                        <li class="swiper-slide">
                            <div class="product-div">
                                <a href="<?php echo $v['url']; ?>"><img class="product-list-img" src="<?php echo $v['goods_img']; ?>"/></a>
                                <div class="product-text m-top06">
                                    <a href="<?php echo $v['url']; ?>"><h4><?php echo $v['name']; ?></h4></a>
                                    <p><span class="p-price t-first ">
                                                <?php if($v['promote_price']) { ?>
                                                <?php echo $v['promote_price']; ?>
                                                <?php } else { ?>
                                                <?php echo $v['shop_price']; ?>
                                                <?php } ?>
                                            </span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <?php $n++;}unset($n); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
              <div class="ect-button-more m-top10 dis-box goods-shop-btn">
                        <?php if(isset($basic_info['kf_appkey']) && !empty($basic_info['kf_appkey'])) { ?>
                            <a class="box-flex btn-default" href="<?php echo U('chat/index/index', array('goods_id'=> $goods['goods_id']));?>"><i class="iconfont icon-kefu t-first"></i>联系客服</a>
                        <?php } elseif (isset($basic_info['meiqia']) && !empty($basic_info['meiqia'])) { ?>
                            <a class="box-flex btn-default" href="https://static.meiqia.com/dist/standalone.html?eid=<?php echo $basic_info['meiqia']; ?>"><i class="iconfont icon-kefu t-first"></i>联系客服</a>
                        <?php } else { ?>
                            <?php if($basic_info['kf_type']) { ?>
                            <a class="box-flex btn-default" href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $basic_info['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8"><i class="iconfont icon-kefu t-first"></i>联系客服</a>
                            <?php } else { ?>
                            <a class="box-flex btn-default" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $basic_info['kf_qq']; ?>&site=qq&menu=yes"><i class="iconfont icon-kefu t-first"></i>联系客服</a>
                            <?php } ?>
                            <?php if($goods['user_id']) { ?>
                            <a class="box-flex btn-default" href="<?php echo $goods['store_url']; ?>"><i class="iconfont icon-dianpu t-two"></i>进入店铺</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
        </section>

        <section class="m-top04 product-sequence dis-box ">
            <a class="box-flex  a-change active">商品详情</a>
            <a class="box-flex ">规格参数</a>
        </section>
        <div id="j-tab-con" class="b-color-f m-top1px tab-con ">
            <div class="swiper-wrapper">
                <section class="swiper-slide ">
                    <div class="padding-all">
                        <?php echo $goods_desc; ?>
                    </div>
                </section>
                <section class="swiper-slide goods-info-attr">
                    <ul class="t-remark">
                        <?php $n=1;if(is_array($properties)) foreach($properties as $key=>$property_group) { ?>
                        <li class="of-hidden"><span class="fl"><?php echo $key; ?></span></li>
                        <?php $n=1;if(is_array($property_group)) foreach($property_group as $property) { ?>
                        <li class="of-hidden"><span class="fl"><?php echo $property['name']; ?></span><span
                                class="fr"><?php echo $property['value']; ?></span></li>
                        <?php $n++;}unset($n); ?>
                        <?php $n++;}unset($n); ?>
                    </ul>
                </section>
            </div>
        </div>
    </div>

    <!--悬浮btn star-->
    <section class="filter-btn dis-box">

        <a class="btn-disab box-flex quehuo" href="javascript:;" <?php if($goods['review_status'] > 2) { ?>style="display:none"<?php } ?>>已经兑完</a>
        <button type="sumbit" class="btn-submit box-flex add-to-cart" <?php if($goods['review_status'] <= 2) { ?>style="display:none"<?php } ?>>立即兑换</button>
    </section>
    <!--悬浮btn end-->
    </form>
</div>


<!--悬浮菜单e-->
<!--引用js-->
<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/jquery.json.js"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/main/common.js"></script>
<script type="text/javascript" src="<?php echo __TPL__;?>js/region_goods.js"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/jquery.infinite.js"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/template.js"></script>
<script>
    /*商品详情相册切换*/
    var swiper = new Swiper('.goods-photo', {
        paginationClickable: true,
        onInit: function (swiper) {
            document.getElementById("g-active-num").innerHTML = swiper.activeIndex + 1;
            document.getElementById("g-all-num").innerHTML = swiper.slides.length;
        },
        onSlideChangeStart: function (swiper) {
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
    $(function(){
        changePrice();
        //商品详情属性弹出层
        $(".click-show-attr").click(function(){
            $(".show-goods-attr").addClass("show");
            $(".mask-filter-div").addClass("show");
        });
    })
    function changePrice(type)
    {
        var max_number = <?php if($xiangou == 1) { ?><?php if($goods['is_xiangou']==1 && $goods['xiangou_num'] > 0) { ?><?php echo $goods['xiangou_num']; ?><?php } else { ?>-1<?php } ?><?php } else { ?>-1<?php } ?>;
        var min_number = 1;
        var qty = $("#goods_number").val();
        if(type == 1){
            if(qty >= min_number){
                qty--;
            }
        }
        if(type == 3){
            if(max_number == -1){
                max_number = $(".goods_attr_num").html() ? parseInt($(".goods_attr_num").html()) : 1;
            }
            if(qty <= max_number){
                qty++;
            }
        }
        if(qty <=0 ){ qty=1; }
        if(!/^[0-9]*$/.test(qty)){ qty = 1 }
        var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);

        //ecmoban模板堂 --zhuo start 限购
        <?php if($xiangou == 1) { ?>
        <?php if($goods['is_xiangou'] == 1 && $goods['xiangou_num'] > 0) { ?>
        var xiangou_num = <?php echo $goods['xiangou_num']; ?>;
        var xiangou = <?php echo $xiangou; ?>;
        if(qty > xiangou_num && xiangou_num > 0 && xiangou == 1){
            d_messages('不能超过限购数量');
            return false;
        }
        <?php } ?>
        <?php } ?>
        var warehouse = <?php if($region_id) { ?><?php echo $region_id; ?><?php } else { ?>0<?php } ?>;
        var area = <?php if($area_id) { ?><?php echo $area_id; ?><?php } else { ?>0<?php } ?>;
        $.get('<?php echo U("exprice");?>', {'id':<?php echo $goods_id; ?>, 'attr':attr, 'number':qty, 'warehouse_id':warehouse, 'area_id':area}, function(data){
            changePriceResponse(data);
        }, 'json');
    }

    /**
     * 接收返回的信息
     */
    function changePriceResponse(res){
        if (res.err_msg.length > 0){
            d_messages(res.err_msg);
        } else {
            //属性图片
            if(res.attr_img) {
                $(".s-g-attr-title .product-list-img").attr('src',res.attr_img);
            }
            //用户可购买的数量
            $("#goods_number").val(res.qty);
            //更改数量的同时显示
            var get_text = '';
            s_get_label = $(".show-goods-attr .s-g-attr-con").find("label.active"); //获取被选中label
            if(s_get_label.length > 0){
                s_get_label.each(function() {
                    get_text += $(this).text() + "、";
                });
            }
            var goods_number = $("#goods_number").val();
            goods_number = parseInt(goods_number) ? parseInt(goods_number) : 1;
            get_text = get_text + goods_number + "个";
            $(".j-goods-attr").find(".t-goods1").text(get_text);
            if ($(".goods_attr_num").length > 0){
                $(".goods_attr_num").html(res.attr_number);
            }
            if(res.err_no == 2){
                d_messages("该地区暂不支持配送");
            }
            else{
                if(res.attr_number <= 0){
                    $(".add-to-cart").hide();
                    $(".quehuo").show();
                }
                else{
                    <?php if($goods['review_status'] > 2) { ?>
                    $(".add-to-cart").show();
                    $(".quehuo").hide();
                    <?php } ?>
                }
            }
            //总价
            if ($(".class-exchange").length > 0){
                $(".class-exchange").html(res.t_ex_integral);
            }
            if($("#ECS_SHOPPRICE").length > 0){
                $("#ECS_SHOPPRICE").html(res.shop_price);
            }
        }
    }
    function get_exchange(){
        var qty = $("#goods_number").val();
        var number = Number($('.goods_attr_num').html());
        var user_id = <?php echo $user_id; ?>;
        var pay_points = '<?php echo $user['pay_points']; ?>';
        var total_points = Number($(".class-exchange").html());
        if(user_id > 0){
            if(qty > number){
                var message = "您最多可抵用券兑换" + number + "件商品!";
                d_messages(message);
                return false;
            }
            if(pay_points< total_points){
                var message = "对不起，您现有的抵用券值不够兑换本商品！";
                d_messages(message);
                return false;
            }
        }

    }
</script>
<script type="text/javascript">
    /*切换*/
    var tabsSwiper = new Swiper('#j-tab-con', {
        speed: 100,
        noSwiping: true,
        autoHeight: true,
        onSlideChangeStart: function () {
            $(".product-sequence.active").removeClass('active')
            $(".product-sequence").eq(tabsSwiper.activeIndex).addClass('active')
        }
    })
    $(".product-sequence a").on('touchstart mousedown', function (e) {
        e.preventDefault()
        $(this).addClass("active").siblings().removeClass("active");
        tabsSwiper.slideTo($(this).index())
    })
    $(".product-sequence a").click(function (e) {
        e.preventDefault()
    })
</script>
</body>
</html>";s:12:"compile_time";i:1476844200;}";