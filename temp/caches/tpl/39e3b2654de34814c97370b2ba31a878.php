<?php exit;?>0014768895079680979cdb554814d89e3730b4da0c1as:4125:"a:2:{s:8:"template";s:4061:"<section class="flow-checkout-tprice">
    <header class="b-color-f padding-all">
        <?php echo $lang['goods_all_price']; ?><span class="t-first fr"><?php echo $total['goods_price_formated']; ?></span>
    </header>
    <ul class="m-top1px b-color-f">
        <!-- 折扣 -->
        <?php if($total['discount'] > 0) { ?>
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['discount']; ?></label>
            <span class="t-first fr">- <?php echo $total['discount_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 税 -->
        <?php if($total['tax'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['tax']; ?></label>
            <span class="t-first fr">+ <?php echo $total['tax_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 配送费用 -->
        <?php if($total['shipping_fee'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['shipping_fee']; ?></label>
            <span class="t-first fr">+ <?php echo $total['shipping_fee_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 保价费用 -->
        <?php if($total['shipping_insure'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['insure_fee']; ?></label>
            <span class="t-first fr">+ <?php echo $total['shipping_insure_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 支付费用 -->
        <?php if($total['pay_fee'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['pay_fee']; ?></label>
            <span class="t-first fr">+ <?php echo $total['pay_fee_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 包装费用 -->
        <?php if($total['pack_fee'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['pack_fee']; ?></label>
            <span class="t-first fr">+ <?php echo $total['pack_fee_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 贺卡费用 -->
        <?php if($total['card_fee'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['card_fee']; ?></label>
            <span class="t-first fr">+ <?php echo $total['card_fee_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 余额 -->
        <?php if($total['surplus'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['use_surplus']; ?></label>
            <span class="t-first fr">- <?php echo $total['surplus_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 抵用券 -->
        <?php if($total['integral'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['use_integral']; ?></label>
            <span class="t-first fr">- <?php echo $total['integral_formated']; ?></span>
        </li>
        <?php } ?>
        <!-- 红包 -->
        <?php if($total['bonus'] > 0  && (isset($bonus_list) || $order['bonus_id'] > 0)) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl"><?php echo $lang['use_bonus']; ?></label>
            <span class="t-first fr">- <?php echo $total['bonus_formated']; ?></span>
        </li>
        <?php } ?>
          <!-- 优惠券 -->
        <?php if($total['couponts'] > 0 &&$order['coupont'] > 0) { ?> 
        <li class="padding-all of-hidden">
            <label class="t-remark g-t-temark fl">优惠券</label>
            <span class="t-first fr">- <?php echo $total['coupons_formated']; ?></span>
        </li>
        <?php } ?>
        
    </ul>
</section>
";s:12:"compile_time";i:1476803107;}";