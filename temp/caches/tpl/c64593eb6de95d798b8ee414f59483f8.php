<?php exit;?>001476889507a94031ca3117bec0b4efc994c786ccc1s:48707:"a:2:{s:8:"template";s:48642:"<?php $__Template->display($this->getTpl("page_header")); ?>

<link rel="stylesheet" type="text/css" href="<?php echo __TPL__;?>css/mobile-select-area.css">
<link rel="stylesheet" type="text/css" href="<?php echo __TPL__;?>css/dialog.css">
<form action="<?php echo U('flow/index/done');?>" method="post" name="theForm" id="theForm" onSubmit="return checkOrderForm(this)">
    <div class="con">
        <div class="flow-checkout">
            <?php if($isStoreOrder == 0) { ?>
            <section class="flow-checkout-adr padding-all">
                <a href="<?php echo U('flow/index/address_list');?>"></a>
                <p class="flow-no-adr" style="display:none"><i class="iconfont icon-dingwei"></i>请选择配送地址</p>
                <div class="flow-have-adr">
                    <p class="f-h-adr-title ">
                        <?php echo $consignee['consignee']; ?> &nbsp <?php echo $consignee['mobile']; ?>
                        <?php if($is_default) { ?><span class="t-first margin-lr">默认地址<?php } ?>
                    </p>
                    <p class="f-h-adr-con t-remark m-top04"><?php echo $consignee['region']; ?> <?php echo $consignee['address']; ?></p>
                </div>
                <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
            </section>
            <?php } elseif ($isStoreOrder == 1) { ?>
            <section class="flow-checkout-adr padding-all">
                <a href="<?php echo U('offline_store/index/StoreList', array('id'=>$store_goods_id));?>"></a>
                <p class="flow-no-adr" style="display:none"><i class="iconfont icon-dingwei"></i>请选择配送地址</p>
                <div class="flow-have-adr">
                    <p class="f-h-adr-title "><?php echo $store['stores_name']; ?></p>
                    <p class="f-h-adr-con t-remark m-top04"><?php echo $store['address']; ?></p>
                    <p class="f-05 col-7 m-top02">服务电话：<?php echo $store['stores_tel']; ?></p>
                    <p class="f-05 col-7 m-top02">营业时间：<?php echo $store['stores_opening_hours']; ?></p>
                    <p class="f-05 col-7 m-top02">门店地址：[<?php echo $store['province_name']; ?> <?php echo $store['city_name']; ?> <?php echo $store['district_name']; ?>] <?php echo $store['stores_address']; ?></p>
                </div>
                <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                <input type="hidden" name="ru_id[]" value="<?php echo $store['ru_id']; ?>" />
            </section>
            <?php } ?>
            <!-- 门店信息     -->
            <?php $n=1;if(is_array($goods_list)) foreach($goods_list as $ru) { ?>
            <section class="m-top10">
                <section class="flow-checkout-pro j-flow-checkout-pro <?php if($ru['goods_count'] < 2) { ?>active<?php } ?>">
                    <header class="b-color-f padding-all">
                        <?php echo $ru['ru_name']; ?>
                    </header>
                    <div class="product-list-small m-top1px b-color-f dis-box">
                        <?php if($ru['goods_count'] > 1) { ?>
                        <ul class="flow-checkout-smallpic box-flex">
                            <?php $n=1;if(is_array($ru['goods_list'])) foreach($ru['goods_list'] as $key=>$goods) { ?>
                            <?php if($key < 3) { ?>
                            <li><img class="product-list-img" src="<?php echo $goods['goods_thumb']; ?>" /></li>
                            <?php } ?>
                            <?php $n++;}unset($n); ?>
                        </ul>
                        <ul class="box-flex flow-checkout-bigpic">
                            <?php $n=1;if(is_array($ru['goods_list'])) foreach($ru['goods_list'] as $key=>$goods) { ?>
                            <li>
                                <div class="product-div">
                                    <a class="product-div-link" href="<?php echo $goods['url']; ?>"></a>
                                    <img class="product-list-img" src="<?php echo $goods['goods_thumb']; ?>" />
                                    <div class="product-text">
                                        <h4><?php echo $goods['goods_name']; ?></h4>
                                        <p><span class="p-price t-first "><?php echo $goods['formated_goods_price']; ?> <small class="fr t-remark">x<?php echo $goods['goods_number']; ?></small></span></p>
                                        <p class="dis-box p-t-remark"><?php echo nl2br($goods['goods_attr']);?></p>

                                    </div>
                                </div>
                            </li>
                            <?php $n++;}unset($n); ?>
                        </ul>
                        <span class="t-jiantou"><span class="f-c-a-count">共 <?php echo $ru['goods_count']; ?> 件</span><i class="iconfont icon-jiantou tf-180"></i></span>
                        <?php } else { ?>
                        <ul class="box-flex flow-checkout-bigpic">
                            <?php $n=1;if(is_array($ru['goods_list'])) foreach($ru['goods_list'] as $key=>$goods) { ?>
                            <li>
                                <div class="product-div">
                                    <a class="product-div-link" href="<?php echo $goods['url']; ?>"></a>
                                    <img class="product-list-img" src="<?php echo $goods['goods_thumb']; ?>" />
                                    <div class="product-text">
                                        <h4><?php echo $goods['goods_name']; ?></h4>
                                        <p><span class="p-price t-first "><?php echo $goods['formated_goods_price']; ?> <small class="fr t-remark">x<?php echo $goods['goods_number']; ?></small></span></p>
                                        <p class="dis-box p-t-remark"><?php echo nl2br($goods['goods_attr']);?></p>

                                    </div>
                                </div>
                            </li>
                            <?php $n++;}unset($n); ?>
                        </ul>
                        <?php } ?>
                    </div>
                </section>

                <section class="flow-checkout-select b-color-f">
                    <ul>
						<?php if($total['real_goods_count'] > 0) { ?>
                        <?php if($isStoreOrder == 0) { ?>
                        <li>
                            <section class="dis-box j-goods-dist <?php if(!empty($ru['shipping'])) { ?>j-show-div<?php } ?> j-show-get-val">
                                <label class="t-remark g-t-temark">配送方式</label>
                                <div class="box-flex t-goods1 text-right onelist-hidden">
                                    <?php $n=1;if(is_array($ru['shipping'])) foreach($ru['shipping'] as $sh) { ?>
                                    <?php if($sh['shipping_code'] != 'cac' && $ru['tmp_shipping_id'] == $sh['shipping_id']) { ?>
                                    <span>
                                        <?php echo $sh['shipping_name']; ?>
                                    </span>
                                    <em class="t-first">
                                        <?php if($sh['shipping_fee']) { ?>
                                        <?php echo $sh['format_shipping_fee']; ?>
                                        <?php } else { ?>
                                        免运费
                                        <?php } ?>
                                    </em>
                                    <?php } elseif ($sh['shipping_code'] == 'cac' && $ru['tmp_shipping_id'] == $sh['shipping_id']) { ?>
                                    <span> 门店自提 </span>
                                    <?php } ?>
                                    <?php $n++;}unset($n); ?>
                                    <?php if(empty($ru['shipping'])) { ?>
                                    <span>该地区不支持配送</span>
                                    <?php } ?>
                                </div>
                                <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                                <!--配送方式star-->
                                <div class="show-goods-dist ts-3 b-color-1 j-show-goods-text j-filter-show-div">
                                    <section class="goods-show-title of-hidden padding-all b-color-f">
                                        <h3 class="fl g-c-title-h3">配送方式</h3>
                                        <i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
                                    </section>
                                    <section class="s-g-list-con swiper-scroll">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide select-two">
                                                <ul class="j-get-one padding-all select-shipping">
                                                    <?php if($ru['shipping_type'] == 0) { ?>
                                                    <?php $n=1;if(is_array($ru['shipping'])) foreach($ru['shipping'] as $sh) { ?>
                                                    <?php if($sh['shipping_code'] != 'cac') { ?>
                                                    <li class="ect-select">
                                                        <label class="ts-1 dis-box <?php if($ru['tmp_shipping_id'] == $sh['shipping_id']) { ?>active<?php } ?>" data-type="0" data-shipping="<?php echo $sh['shipping_id']; ?>" data-ruid="<?php echo $ru['ru_id']; ?>">
                                                            <dd>
                                                                <span>
                                                                    <?php echo $sh['shipping_name']; ?>
                                                                </span>
                                                                <em class="t-first">
                                                                    <?php if($sh['shipping_fee']) { ?>
                                                                    <?php echo $sh['format_shipping_fee']; ?>
                                                                    <?php } else { ?>
                                                                    免运费
                                                                    <?php } ?>
                                                                </em>
                                                            </dd>
                                                            <i class="fr iconfont icon-gou ts-1"></i>
                                                        </label>
                                                    </li>
                                                    <?php } ?>
                                                    <?php $n++;}unset($n); ?>
                                                    <?php } ?>
                                                    <input type="hidden" name="ru_id[]" value="<?php echo $ru['ru_id']; ?>" />
                                                    <input type="hidden" name="ru_name[]" value="<?php echo $ru['ru_name']; ?>" />
                                                    <?php if($ru['self_point'] != '' && !empty($picksite_list)) { ?>
                                                    <!-- 自营商家有自提点 -->
                                                    <li class="ect-select goods-site">
                                                        <label class="ts-1 <?php if($ru['shipping_type'] == 1) { ?>active<?php } ?>" data-type="1" data-shipping="<?php echo $ru['self_point']['0']['shipping_id']; ?>" data-ruid="<?php echo $ru['ru_id']; ?>"><dd><span>门店自提</span></dd><i class="fr iconfont icon-gou ts-1"></i></label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                                <input type="hidden" name="shipping[]" value="<?php if($ru['shipping_type'] == 0) { ?><?php echo $ru['tmp_shipping_id']; ?><?php } else { ?><?php echo $ru['self_point']['0']['shipping_id']; ?><?php } ?>"/>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <!--配送方式end-->
                            </section>
                        </li>
                        <?php } ?>
						<?php } ?>
                        <!-- 自营商家 -->

                        <?php if($ru['shipping_type'] == 1 || ($ru['shipping_type'] == 0 && !empty($ru['tmp_shipping_id']))) { ?>
                        <li class="j-goods-site-li j-goods-site-li-time<?php echo $ru['ru_id']; ?> <?php if($ru['shipping_type'] == 0 && empty($ru['is_cac'])) { ?>show-temark-div<?php } ?>">
                            <section class="distribution-time j-distribution-time<?php echo $ru['ru_id']; ?> j-distribution-time b-color-f">
                                <div class="text-right dis-box">
                                    <label class="t-remark g-t-temark">时间</label>
                                    <span class="t-goods1 box-flex distribution-time-con">
                                        <input type="text" name="shipping_dateStr[<?php echo $ru['ru_id']; ?>]" value="<?php echo $ru['self_point']['0']['shipping_dateStr']; ?>" id="txt_area<?php echo $ru['ru_id']; ?>"/>
                                        <input type="hidden" id="hd_area"/>
                                    </span>
                                    <i class="iconfont icon-rili t-first"></i>
                                </div>
                            </section>
                            <script type="text/javascript" src="<?php echo __TPL__;?>js/dialog.js"></script>
                            <script type="text/javascript" src="<?php echo __TPL__;?>js/mobile-select-area.js"></script>
                            <script type="text/javascript">
            var selectArea2 = new MobileSelectArea();
            selectArea2.init({
            trigger: '.j-distribution-time<?php echo $ru['ru_id']; ?>,#txt_area<?php echo $ru['ru_id']; ?>',
                    data: <?php echo $shipping_date; ?>,
                    eventName: 'click',
                    level: 2,
                    callback: function(scroller, text, value){
                    if (value[0] == 0 || value[1] == 0){
                    d_messages('该时间无法配送，请另选配送时间');
                            return false;
                    }
                    $.post("<?php echo U('select_picksite');?>", {shipping_date: text[0], time_range: text[1]}, function(result){
                    if (result.error > 0){
                    if (result.err_msg){
                    d_messages(result.err_msg);
                    }
                    return false;
                    }
                    }, 'json');
                            return true;
                    }
            });</script>
                        </li>
                        <?php if($ru['self_point'] != '' && !empty($picksite_list)) { ?>
                        <li class="goods-site-li dis-box j-goods-site-li j-goods-site-li<?php echo $ru['ru_id']; ?> f-c-s-coupon <?php if($ru['shipping_type'] == 0 && empty($ru['is_cac'])) { ?>active<?php } ?>">
                            <label class="t-remark g-t-temark">自提点</label>
                            <div class="box-flex t-goods1 text-right onelist-hidden"><span><?php echo $ru['self_point']['0']['name']; ?></span></div>
                            <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                            <div id="j-filter-div" class="j-filter-div filter-div ts-5 filter-site-div">
                                <section class="close-filter-div j-close-filter-div">
                                    <div class="close-f-btn">
                                        <i class="iconfont icon-fanhui"></i>
                                        <span>关闭</span>
                                    </div>
                                </section>
                                <div class=" con-filter-div">
                                    <div class="flow-site j-flow-site">
                                        <div class="swiper-scroll">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <ul class="j-get-one select-two">
                                                        <?php $n=1; if(is_array($ru['self_point'])) foreach($ru['self_point'] as $key => $pick) { ?>
                                                        <li class="ect-select padding-lr">
                                                            <label class="ts-1 <?php if($key == 0) { ?>active<?php } ?>" data-point="<?php echo $pick['point_id']; ?>" data-ruid="<?php echo $ru['ru_id']; ?>">
                                                                <h4><?php echo $pick['name']; ?></h4>
                                                                <p>地址：<?php echo $pick['address']; ?></p>
                                                                <p>电话：<?php echo $pick['mobile']; ?></p>
                                                                <i class="fr iconfont icon-gou ts-1"></i>
                                                            </label>
                                                        </li>
                                                        <?php $n++;}unset($n); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="point_id[<?php echo $ru['ru_id']; ?>]" id="point_id<?php echo $ru['ru_id']; ?>" value="<?php echo $ru['self_point']['0']['point_id']; ?>">
                            <input type="hidden" id="cachepointid<?php echo $ru['ru_id']; ?>" value="<?php echo $ru['self_point']['0']['point_id']; ?>">
                        </li>
                        <?php } ?>
                        <input type="hidden" name="shipping_type[<?php echo $ru['ru_id']; ?>]" id="shipping_type<?php echo $ru['ru_id']; ?>" value="<?php echo $ru['shipping_type']; ?>">
                        <?php if($pack_list) { ?>
                        <!--<li class="dis-box j-show-div j-show-get-val">
                            <label class="t-remark g-t-temark">商品包装</label>
                            <div class="box-flex t-goods1 text-right onelist-hidden">
                                <?php if($pack_info['pack_name']) { ?>
                                <span><?php echo $pack_info['pack_name']; ?></span>
                                <em class="t-first"><?php echo $pack_info['format_pack_fee']; ?></em>
                                <span>免费额度</span>
                                <em class="t-first"><?php echo $pack_info['format_free_money']; ?></em>
                                <?php } else { ?>
                                <span>不要包装</span>
                                <?php } ?>
                            </div>
                            <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                                                        &lt;!&ndash;商品包装star&ndash;&gt;
                            <div class="show-goods-dist ts-3 b-color-1 j-show-goods-text j-filter-show-div goods-pack">
                                <section class="goods-show-title of-hidden padding-all b-color-f">
                                    <h3 class="fl g-c-title-h3">商品包装</h3>
                                    <i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
                                </section>
                                <section class="s-g-list-con swiper-scroll">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide select-two">
                                            <ul class="j-get-one padding-all">
                                                <li class="ect-select">
                                                    <label class="ts-1 <?php if(empty($order['pack_id'])) { ?>active<?php } ?>" onclick="selectPack(0)"><dd><span>不要包装</span></dd><i class="fr iconfont icon-gou ts-1"></i></label>
                                                </li>
                                                <?php $n=1;if(is_array($pack_list)) foreach($pack_list as $pack) { ?>
                                                <li class="ect-select goods-site">
                                                    <label class="ts-1 <?php if($order['pack_id'] == $pack['pack_id']) { ?>active<?php } ?>" onclick="selectPack(<?php echo $pack['pack_id']; ?>)">
                                                        <dd><span><?php echo $pack['pack_name']; ?></span> <em class="t-first"><?php echo $pack['format_pack_fee']; ?></em> <span>（订单满<em class="t-first"><?php echo $pack['format_free_money']; ?></em>免费）</span> </dd><i class="fr iconfont icon-gou ts-1"></i></label>
                                                </li>
                                                <?php $n++;}unset($n); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            &lt;!&ndash;商品包装end&ndash;&gt;
                            <input  type="hidden" name="pack" value="<?php echo $order['pack_id']; ?>" />
                        </li>-->
                        <?php } ?>
                        <?php } ?>
                        <li class="f-c-select-msg">
                            <label class="t-remark g-t-temark">买家留言<span class="t-remark">（50字）</span></label>
                            <div class="text-area1 m-top04">
                                <textarea name="postscript[]" class="text-area1" maxlength="50" placeholder="选填"></textarea>
                                <span></span>
                            </div>
                        </li>
                    </ul>
                    <p class="f-c-select-price text-right t-remark">共 <?php echo $ru['goods_count']; ?> 件商品，合计：<span class="t-first" id="ru_amount<?php echo $ru['ru_id']; ?>"><?php echo $ru['amount']; ?></span></p>
                    <input type="hidden"  id="amount<?php echo $ru['ru_id']; ?>" value="<?php echo $ru['amount']; ?>">
                    <input type="hidden"  id="goods_price_amount<?php echo $ru['ru_id']; ?>" value="<?php echo $ru['goods_price_amount']; ?>">
                </section>
            </section>
            <?php $n++;}unset($n); ?>

            <section class="m-top10">
                <ul>
                    <?php if($is_exchange_goods != 1 || $total['real_goods_count'] != 0) { ?>
                    <li class="dis-box padding-all m-top1px b-color-f j-show-div" id="payment">
                        <label class="t-remark g-t-temark">支付方式</label>
                        <div class="box-flex t-goods1 text-right onelist-hidden" id="payment_info">
                            <?php if($payment_selected['pay_name']) { ?>
                            <span><?php echo $payment_selected['pay_name']; ?><?php if($payment_selected['pay_fee']) { ?> <em class="t-remark">[手续费]</em><?php } ?></span> <?php if($payment_selected['pay_fee']) { ?><em class="t-first"><?php echo $payment_selected['format_pay_fee']; ?></em><?php } ?>
                            <?php } else { ?>
                            <span>请选择</span>
                            <?php } ?>
                        </div>
                        <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                        <!--支付方式star-->
                        <div class="show-goods-dist ts-3 b-color-1 j-show-goods-text j-filter-show-div">
                            <section class="goods-show-title of-hidden padding-all b-color-f">
                                <h3 class="fl g-c-title-h3">支付方式</h3>
                                <i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
                            </section>
                            <section class="s-g-list-con swiper-scroll">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide select-two">
                                        <ul class="j-get-one padding-all">
                                            <?php $n=1;if(is_array($payment_list)) foreach($payment_list as $payment) { ?>
                                            <li class="ect-select goods-site" onclick="selectPayment(<?php echo $payment['pay_id']; ?>)" date-code="<?php echo $payment['pay_code']; ?>">
                                                <label class="ts-1 <?php if($order['pay_id'] == $payment['pay_id']) { ?>active<?php } ?>">
                                                    <dd>
                                                        <span><?php echo $payment['pay_name']; ?><?php if($payment['pay_fee']) { ?><em class="t-remark">[手续费]</em><?php } ?></span>
                                                        <?php if($payment['pay_fee']) { ?><em class="t-first"><?php echo $payment['format_pay_fee']; ?></em><?php } ?>
                                                    </dd>
                                                    <i class="fr iconfont icon-gou ts-1"></i>
                                                </label>
                                            </li>
                                            <?php $n++;}unset($n); ?>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!--支付方式end-->
                        <input name="payment" type="hidden" value="<?php if($payment_selected) { ?><?php echo $order['pay_id']; ?><?php } else { ?>0<?php } ?>" />
                    </li>
                    <?php } else { ?>
                    <input name="payment" type="hidden" value="-1" />
                    <?php } ?>
                    <?php if($order['need_inv']) { ?>
                    <li class="dis-box padding-all m-top1px b-color-f f-c-receipt f-c-s-coupon j-f-c-receipt">
                        <label class="t-remark g-t-temark">发票信息</label>
                        <div class="box-flex t-goods1 text-right onelist-hidden">
                            <p class="receipt-title"><?php echo $order['inv_payee']; ?></p>
                            <p class="receipt-name"><?php echo $order['inv_content']; ?></p>
                        </div>
                        <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                        <div id="j-filter-div" class="j-filter-div filter-div ts-5 filter-receipt-div">
                            <div class=" con-filter-div">
                                <div class="flow-site j-flow-site swiper-scroll swiper-container-vertical swiper-container-free-mode">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide swiper-slide-active">
                                            <div class="flow-receipt">
                                                <section class="flow-receipt-title m-top10 invhead">
                                                    <header class="b-color-f padding-all">
                                                        发票抬头
                                                    </header>
                                                    <div class="b-color-f flow-receipt-title-con text-all-select">
                                                        <div class="text-all dis-box j-text-all">
                                                            <div class="box-flex input-text">
                                                                <input class="j-input-text" type="text" placeholder="可填写个人或单位名称" />
                                                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class="flow-receipt-cont m-top10">
                                                    <header class="b-color-f padding-all">
                                                        发票内容
                                                    </header>
                                                    <div class="m-top1px flow-receipt-cont-con b-color-f select-two">
                                                        <ul class="j-get-one">
                                                            <?php $n=1; if(is_array($inv_content_list)) foreach($inv_content_list as $key => $content) { ?>
                                                            <li class="ect-select invliall ">
                                                                <label class="<?php if($key == 0 ) { ?>invli<?php } else { ?>invliothers<?php } ?>  ts-1 <?php if($order['inv_content'] == $content) { ?>active<?php } ?>" data-type="<?php echo $key; ?>"><?php echo $content; ?><i class="fr iconfont icon-gou ts-1"></i></label>
                                                            </li>
                                                            <?php $n++;}unset($n); ?>
                                                        </ul>
                                                    </div>
                                                </section>
                                                <div class="ect-button-more dis-box padding-all">
                                                    <button class="btn-submit box-flex r-btn-submit">确定</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="need_inv" value="0" id="ECS_NEEDINV">
                        <input type="hidden" name="inv_type" value="0" id="inv_type">
                        <input type="hidden" name="inv_payee" value="<?php echo $order['inv_payee']; ?>" id="ECS_INVPAYEE">
                        <input type="hidden" name="inv_content" value="<?php echo $order['inv_content']; ?>" id="ECS_INVCONTENT">
                    </li>
                    <?php } ?>
                   <?php if($allow_use_bonus && $bonus_list) { ?>
                    <li class="dis-box padding-all m-top1px b-color-f f-c-s-coupon j-f-c-s-coupon">
                                           <label class="t-remark g-t-temark">红包(<?php echo $bonus_num; ?>张)</label>
                        <div class="box-flex t-goods1 text-right onelist-hidden">
                            <?php if($order_bonus) { ?>
                            <span class="coupon-text">优惠金额</span>
                            <em class="t-first coupon-price"><?php echo $order_bonus['type_money_format']; ?></em>
                            <?php } else { ?>
                            <span class="coupon-text">不使用红包</span>
                            <em class="t-first coupon-price"></em>
                            <?php } ?>
                        </div>
                        <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                        <div id="j-filter-div" class="j-filter-div filter-div ts-5 filter-coupon-div">
                            <div class=" con-filter-div">
                                <div class="flow-coupon">
                                    <ul class="select-three flow-couon-list padding-all">
                                        <?php $n=1;if(is_array($bonus_list)) foreach($bonus_list as $key=>$bonus) { ?>
                                        <li class="big-remark-all">
                                            <div class="dis-box">
                                                <div class="remark-all temark-<?php if($bonus['type_money']>=0) { ?><?php if($bonus['type_money']>=50) { ?><?php if($bonus['type_money']>=100) { ?>1<?php } else { ?>2<?php } ?><?php } else { ?>3<?php } ?><?php } else { ?>3<?php } ?> tb-lr-center">
                                                    <span class="b-r-a-price"><sup>¥</sup><?php echo $bonus['type_money']; ?></span>
                                                </div>
                                                <div class="box-flex b-color-f padding-all">
                                                    <?php if($bonus['shop_name']) { ?>
                                                    <h4><?php echo $bonus['shop_name']; ?></h4>
                                                    <?php } ?>
                                                    <p><?php echo $bonus['type_name']; ?></p>
                                                    <p class="t-remark"><?php echo $bonus['use_start_date']; ?> ~ <?php echo $bonus['use_end_date']; ?></p>
                                                    <div class="ect-select">
                                                        <label data-bonus="<?php echo $bonus['bonus_id']; ?>" data-money="<?php echo $bonus['type_money']; ?>" <?php if($order['bonus_id'] == $bonus['bonus_id']) { ?>class="active"<?php } ?>>
                                                               <i class="j-select-btn"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php $n++;}unset($n); ?>
                                    </ul>
                                    <div class="ect-button-more dis-box padding-all">
                                        <button class="btn-submit box-flex c-btn-submit" name="btncoupons">确定</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="bonus" value="<?php echo $order['bonus_id']; ?>" id="ECS_BONUS" />
                    </li>
             	 <?php } ?>           
           <?php if($user_coupons) { ?>
                        <li class="dis-box padding-all m-top1px b-color-f f-c-s-coupon j-f-c-s-coupon-1">
                                           <label class="t-remark g-t-temark">优惠券</label>
                        <div class="box-flex t-goods1 text-right onelist-hidden">
                            <?php if($order_bonus) { ?>
                            <span class="coupon-text">优惠金额</span>
                            <em class="t-first coupon-price"><?php echo $order_bonus['type_money_format']; ?></em>
                            <?php } else { ?>
                            <span class="coupon-text">不使用优惠券</span>
                            <em class="t-first coupon-price"></em>
                            <?php } ?>
                        </div>
                        <span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
                        <div id="j-filter-div" class="j-filter-div filter-div-1 ts-5 filter-coupon-div-1">
                            <div class=" con-filter-div-1">
                                <div class="flow-coupon">
                                    <ul class="select-three flow-couon-list padding-all">
                                        <?php $n=1;if(is_array($user_coupons)) foreach($user_coupons as $vo) { ?>
                                        <li class="big-remark-all">
                                            <div class="dis-box">
                                                <div class="remark-all temark-<?php if($bonus['type_money']>=0) { ?><?php if($bonus['type_money']>=50) { ?><?php if($bonus['type_money']>=100) { ?>1<?php } else { ?>2<?php } ?><?php } else { ?>3<?php } ?><?php } else { ?>3<?php } ?> tb-lr-center">
                                                    <span class="b-r-a-price"><sup>¥</sup> <?php echo $vo['cou_man']; ?></span>
                                                </div>
                                                <div class="box-flex b-color-f padding-all">
                                                   <p><?php echo $vo['cou_name']; ?></p>
                                                    <div class="ect-select">
                                                        <label data-coupont="<?php echo $vo['cou_id']; ?>" data-money="<?php echo $vo['cou_money']; ?>" <?php if($order['coupont'] == $vo['cou_id']) { ?>class="active"<?php } ?>>
                                                               <i class="j-select-btn"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php $n++;}unset($n); ?>
                                    </ul>
                                    <div class="ect-button-more dis-box padding-all">
                                        <button class="btn-submit box-flex cou-btn-submit" name="coupons">确定1</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="coupons" value="<?php echo $order['cou_id']; ?>" id="ECS_COUPONS" />
                    </li>

                    
           <?php } ?>  
                </ul>
            </section>
            <?php if($allow_use_integral) { ?>
            <section class="radio-switching padding-all m-top10 b-color-f <?php if($order['integral']) { ?>active<?php } ?>" onclick="changeIntegral(<?php echo $order_max_integral; ?>)">
                <label class="fl">本单可使用抵用券抵扣 <span class="t-first"><?php if($integral_money > $total['goods_price']) { ?><?php echo $total['goods_price_formated']; ?><?php } else { ?><?php echo $integral_money; ?><?php } ?></span></label>
                <span class="fr"><em class="ts-1"></em><hr class="ts-1" /></span>
                <input type="hidden" name="integral" value="<?php if($order['integral']) { ?><?php echo $order_max_integral; ?><?php } else { ?>0<?php } ?>" id="ECS_INTEGRAL" />
            </section>
            <?php } ?>

            <section class="m-top10" id="ECS_ORDERTOTAL">
               <?php $__Template->display($this->getTpl("order_total")); ?>
            </section>

        </div>
    </div>

    <div class="mask-filter-div"></div>
    <!--悬浮btn star-->
    <section class="filter-btn f-checkout-filter-btn dis-box">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
        <input type="hidden" id="store_id" name='store_id' value="<?php echo $store_id; ?>"/>

        <span class="box-flex t-remark">实付款 <?php if($total['exchange_integral']) { ?><em class="t-first"><?php echo $total['exchange_integral']; ?>抵用券 + </em><?php } ?><em class="t-first" id="amount"><?php echo $total['amount_formated']; ?></em></span>
        <?php if($isStoreOrder == 1) { ?><a href="<?php echo U('category/index/index');?>" class="btn-submit">继续购物</a><?php } ?>
        <a href="javascript:;" type="button" class="btn-submit" onclick="$('#theForm').submit();"><?php if($total['exchange_integral']) { ?>确认兑换<?php } else { ?>提交订单<?php } ?></a>
    </section>
</form>
<!--悬浮btn end-->
<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/main/shopping_flow.js"></script>
<script type="text/javascript">
                    var flow_no_payment = "<?php echo $lang['flow_no_payment']; ?>";
                    var flow_no_shipping = "<?php echo $lang['flow_no_shipping']; ?>";
                    $(function(){
                    //配送方式切换
                    $(".select-shipping li label").click(function(){
                    var type = $(this).attr("data-type");
                            var ru_id = $(this).attr("data-ruid");
                            var shipping = $(this).attr("data-shipping");
                            if (type == 1){
                    if ($(".j-goods-site-li-time" + ru_id).hasClass("show-temark-div")){
                    $(".j-goods-site-li-time" + ru_id).removeClass("show-temark-div");
                    }
                    if ($(".j-goods-site-li" + ru_id).hasClass("active")){
                    $(".j-goods-site-li" + ru_id).removeClass("active");
                    }

                    var cachepointid = $("#cachepointid" + ru_id).val();
                            $("#point_id" + ru_id).val(cachepointid);
                            var goods_price_amount = $("#goods_price_amount" + ru_id).val();
                            $("#ru_amount" + ru_id).html(goods_price_amount);
                            var mySwiper = new Swiper('.swiper-scroll', {
                            scrollbar: false,
                                    direction: 'vertical',
                                    slidesPerView: 'auto',
                                    mousewheelControl: true,
                                    freeMode: true
                            });
                    }
                    else{
                    if (!$(".j-goods-site-li-time" + ru_id).hasClass("show-temark-div")){
                    $(".j-goods-site-li-time" + ru_id).addClass("show-temark-div");
                    }
                    if (!$(".j-goods-site-li" + ru_id).hasClass("active")){
                    $(".j-goods-site-li" + ru_id).addClass("active");
                    }
                    $("#point_id" + ru_id).val("");
                            var amount = $("#amount" + ru_id).val();
                            $("#ru_amount" + ru_id).html(amount);
                    }
                    $(this).parents(".select-shipping").siblings("input[type=hidden]").val(shipping);
                            $.post("<?php echo U('shipping_fee');?>", {ru_id: ru_id, type: type, shipping_id:shipping}, function(result){
                            if (result.message){
                            d_messages(result.message);
                                    return false;
                            }
                            if (result.content){
                            $("#ECS_ORDERTOTAL").html(result.content);
                            }
                            if (result.amount){
                            $("#amount").html(result.amount);
                            }
                            if ($(".j-filter-show-div").hasClass("show")){
                            document.removeEventListener("touchmove", handler, false);
                                    $(".j-filter-show-div").removeClass("show");
                                    $(".mask-filter-div").removeClass("show");
                            }
                            $("#shipping_type" + ru_id).val(type);
                            }, 'json');
                    });
                            //自提点
                            $(".j-goods-site-li li label").click(function(){
                    var point = parseInt($(this).attr("data-point"));
                            var ru_id = parseInt($(this).attr("data-ruid"));
                            if (point > 0){
                    $.post("<?php echo U('select_picksite');?>", {picksite_id: point, ru_id:ru_id}, function(result){
                    if (result.error > 0){
                    if (result.err_msg){
                    d_messages(result.err_msg);
                    }
                    return false;
                    }
                    $("#point_id" + ru_id).val(point);
                    }, 'json');
                    }
                    });
                            //优惠券
                   $(".flow-couon-list .j-select-btn").click(function(){
                        var label = $(this).parent();
                        if (label.hasClass("active")){
                             label.removeClass("active");
                        }
                        else{
                        $(".flow-couon-list li label").removeClass("active");
                                label.addClass("active");
                        }
                    });
                            //抵用券
                            $(".radio-switching").click(function(){

                    });
                            $(".invhead").css('display', 'none');
                            $(".invliothers").click(function(){
                    $(".invhead").css('display', 'block');
                    });
                            $(".invli").click(function(){
                    $(".invhead").css('display', 'none');
                    });
                   });
                    //优惠券 2016-09-05
                    $(".blibli").click(function(){
                        
                        var label = $(this).parent();
                        if (label.hasClass("active")){
                             label.removeClass("active");
                        }
                        else{
                        $(".flow-couon-list li label").removeClass("active");
                                label.addClass("active");
                        }
                           
                    $name = $(this).attr("name");
                      
                    $value = $(this).attr("value");
                   
                    if ($name == 'couponsed'){
                         $(this).removeAttr("name");
                    $.get("<?php echo U('flow/index/changecount');?>", {cou_id: 0}, function (info) {
                    });
                    } else{
                    $(this).attr("name", "couponsed");
                        $.get("<?php echo U('flow/index/changecount');?>", {cou_id: $value}, function (info) {

                        });
                    }

                 })

</script>
</body>
</html>
";s:12:"compile_time";i:1476803107;}";