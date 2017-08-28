<?php exit;?>0014768895199319f453d4c365f859bdc3a121922c30s:3420:"a:2:{s:8:"template";s:3356:"<?php $__Template->display($this->getTpl("page_header")); ?>
    <div class="con">
        <div class="flow-done">
            <div class="flow-done-con">
                <?php if($order['pay_code'] == 'balance') { ?>
                <i class="iconfont icon-hookring2"></i>
                <p class="flow-done-title">余额支付成功</p>
                <?php } else { ?>
                <i class="iconfont icon-qian"></i>
                <p class="flow-done-title">付款金额</p>
                <?php if($child_order > 1) { ?>
                <p class="flow-done-price"><?php echo $total['amount_formated']; ?></p>
                <?php } else { ?>
                <p class="flow-done-price"><?php echo $order['order_amount']; ?></p>
                <?php } ?>
                <?php } ?>
            </div>
            <?php if($child_order > 1) { ?>
            <div class="flow-done-all">
                <?php $n=1;if(is_array($child_order_info)) foreach($child_order_info as $child) { ?>
                <div class="padding-all b-color-f flow-done-id">
                    <section class="dis-box">
                        <label class="t-remark g-t-temark">订单号：</label>
                        <span class="box-flex t-goods1 text-right"><?php echo $child['order_sn']; ?></span>
                    </section>
                </div>
                <?php $n++;}unset($n); ?>
            </div>
            <?php } else { ?>
            <div class="flow-done-all">
            <div class="padding-all b-color-f flow-done-id">
                <section class="dis-box">
                    <label class="t-remark g-t-temark">订单号：</label>
                    <span class="box-flex t-goods1 text-right"><?php echo $order['order_sn']; ?></span>
                </section>
                <?php if($store) { ?>
                <section class="dis-box">
                    <label class="t-remark g-t-temark">门店信息：</label>
                    <span class="box-flex t-goods1 text-right"><?php echo $store['stores_name']; ?>[<?php echo $store['province_name']; ?> <?php echo $store['city_name']; ?> <?php echo $store['district_name']; ?>] <?php echo $store['stores_address']; ?></span>
                </section>
                <section class="dis-box">
                    <label class="t-remark g-t-temark">自提码：</label>
                    <span class="box-flex t-goods1 text-right"><?php echo $pick_code; ?></span>
                </section>
                <?php } ?>
            </div>
            </div>
            <?php } ?>
            <div class="padding-all ect-button-more dis-box">
                <!-- <?php if($pay_online && $order['pay_code'] != 'balance') { ?> -->
                <!-- 如果是线上支付则显示支付按钮 -->
                <?php echo $pay_online; ?>
                <!-- <?php } ?> -->
            </div>
            <div class="flow-done-other">
                <?php if($child_order > 1) { ?>
                <a href="<?php echo U('user/index/index');?>">会员中心</a>
                <?php } else { ?>
                <a href="<?php echo U('user/order/detail', array('order_id'=>$order['order_id']));?>">查看订单</a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>";s:12:"compile_time";i:1476803119;}";