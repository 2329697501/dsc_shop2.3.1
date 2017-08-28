<?php exit;?>00147980745577e5b5aace80e878aaf368068afb58a4s:1075:"a:2:{s:8:"template";s:1011:"亲爱的店长，您好：
   快来看看吧，又有新订单了。
    订单号:<?php echo $order['order_sn']; ?> 
 订单金额:<?php echo $order['order_amount']; ?>，
 用户购买商品:<?php $n=1;if(is_array($goods_list)) foreach($goods_list as $goods_data) { ?><?php echo $goods_data['goods_name']; ?>(货号:<?php echo $goods_data['goods_sn']; ?>)    <?php $n++;}unset($n); ?> 

 收货人:<?php echo $order['consignee']; ?>， 
 收货人地址:<?php echo $order['address']; ?>，
 收货人电话:<?php echo $order['tel']; ?> <?php echo $order['mobile']; ?>, 
 配送方式:<?php echo $order['shipping_name']; ?>(费用:<?php echo $order['shipping_fee']; ?>), 
<?php if($order['pay_id'] == 1) { ?>
 付款方式:<?php echo $order['pay_name']; ?>(费用:<?php echo $order['surplus']; ?>)。
<?php } else { ?>
 付款方式:<?php echo $order['pay_name']; ?>(费用:<?php echo $order['pay_fee']; ?>)。
<?php } ?>

               系统提醒
               <?php echo $send_date; ?>";s:12:"compile_time";i:1479721055;}";