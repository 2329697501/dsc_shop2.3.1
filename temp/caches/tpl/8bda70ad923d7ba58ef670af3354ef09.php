<?php exit;?>001479505508b0bba3461e9a1172fd1f4416852ac497s:13762:"a:2:{s:8:"template";s:13697:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con">
	<div class="flow-checkout">

		<?php if($offline_store) { ?>
			<!--门店自提码  -->
			<section class="flow-checkout-adr padding-all">
				<a class="product-div-link" href="<?php echo U('offline_store/index/OfflineStoreDetail', array('id'=>$store_id));?>"></a>
				<div class="flow-have-adr">
					<p class="f-h-adr-title ">自提码<em class="f-05 col-7">（<?php echo $order['pick_code']; ?> <?php echo $offline_store['stores_name']; ?>）</em></p>
				</div>
				<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
			</section>
		<?php } else { ?>
			<section class="flow-checkout-adr padding-all">
				<div class="flow-have-adr">
					<p class="f-h-adr-title">
						<label><?php echo $order['consignee']; ?> <?php echo $order['mobile']; ?></label>
					</p>
					<p class="f-h-adr-con t-remark m-top04"><?php echo $order['detail_address']; ?></p>
				</div>
			</section>
		<?php } ?>
		<section class="m-top10">

			<section class="flow-checkout-pro j-flow-checkout-pro">
				<header class="b-color-f padding-all"><?php echo $order['shop_name']; ?></header>
				<div class="f-c-p-orderid padding-all m-top1px b-color-f">

					<h4 class="t-remark2">
						<label class="t-remark">订单号：</label><?php echo $order['order_sn']; ?>

					</h4>
					<p class="t-remark3 m-top04"><?php echo $order['formated_add_time']; ?></p>
				</div>
				<div class="product-list-small b-color-f dis-box">
                    <?php if($goods_count > 1) { ?>
					<ul class="flow-checkout-smallpic box-flex">
						<?php $n=1;if(is_array($goods_list)) foreach($goods_list as $key=>$val) { ?>
                        <?php if($key < 3) { ?>
						<li><img class="product-list-img" src="<?php echo $val['goods_thumb']; ?>" /></li>
                        <?php } ?>
						<?php $n++;}unset($n); ?>
					</ul>
					<ul class="box-flex flow-checkout-bigpic">
						<?php $n=1;if(is_array($goods_list)) foreach($goods_list as $val) { ?>
						<li>
							<div class="product-div">
								<a class="product-div-link"
									href="<?php echo U('goods/index/index',array('id'=>$val['goods_id']));?>"></a>
								<img class="product-list-img" src="<?php echo $val['goods_thumb']; ?>" />
								<div class="product-text">
									<h4><?php echo $val['goods_name']; ?></h4>
									<p>
										<span class="p-price t-first "><?php echo $val['goods_price']; ?><small
											class="fr t-remark">x<?php echo $val['goods_number']; ?></small></span>
									</p>
									<p class="dis-box p-t-remark"><?php echo nl2br($val['goods_attr']);?></p>
								</div>
							</div>
						</li>
                        <?php $n++;}unset($n); ?>
					</ul>
					<span class="t-jiantou"><span class="f-c-a-count">共<?php echo $goods_count; ?> 件</span><i class="iconfont icon-jiantou tf-180"></i></span>
                    <?php } else { ?>
                    <ul class="box-flex flow-checkout-bigpic" style="display:block;">
                        <?php $n=1;if(is_array($goods_list)) foreach($goods_list as $val) { ?>
                        <li>
                            <div class="product-div">
                                <a class="product-div-link"  href="<?php echo U('goods/index/index',array('id'=>$val['goods_id']));?>"></a>
                                <img class="product-list-img" src="<?php echo $val['goods_thumb']; ?>" />
                                <div class="product-text">
                                    <h4><?php echo $val['goods_name']; ?></h4>
                                    <p>
										<span class="p-price t-first "><?php echo $val['goods_price']; ?><small class="fr t-remark">x<?php echo $val['goods_number']; ?></small></span>
                                    </p>
                                    <p class="dis-box p-t-remark"><?php echo nl2br($val['goods_attr']);?></p>
                                </div>
                            </div>
                        </li>
                        <?php $n++;}unset($n); ?>
                    </ul>
                    <?php } ?>
				</div>
			</section>

			<section class="flow-checkout-select m-top10 b-color-f">
				<ul>
                    <?php if($order['shipping_id']) { ?>
					<li>
						<section class="dis-box ">
							<label class="t-remark g-t-temark">配送方式</label>
							<div class="box-flex t-goods1 text-right onelist-hidden">
                                <?php if($offline_store) { ?>
                                <span>门店自提</span>
                                <?php } else { ?>
								<span><?php echo $order['shipping_name']; ?></span>
                                <?php if($order['shipping_fee'] > 0) { ?><em class="t-first"><?php echo $order['formated_shipping_fee']; ?></em><?php } ?>
                                <?php } ?>
							</div>
						</section>
					</li>
                    <?php } ?>
                    <?php if($order['point']) { ?>
					<li class="goods-site-li dis-box">
                        <label class="t-remark g-t-temark">自提点</label>
						<div class="box-flex t-goods1 text-right onelist-hidden">
                            <span><?php echo $order['point']['name']; ?></span>
                        </div>
					</li>
                    <li class="goods-site-li dis-box">
                        <label class="t-remark g-t-temark">提货时间</label>
                        <div class="box-flex t-goods1 text-right onelist-hidden">
                            <span><?php echo $order['point']['pickDate']; ?></span>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if($order['pack_id']) { ?>
                    <li class="dis-box">
                        <label class="t-remark g-t-temark">商品包装</label>
                        <div class="box-flex t-goods1 text-right onelist-hidden">
                            <span><?php echo $order['pack_name']; ?></span>
                            <em class="t-first"><?php echo $order['formated_pack_fee']; ?></em>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if($order['postscript']) { ?>
					<li><label class="t-remark g-t-temark">买家留言</label>
						<p class="m-top04" style="font-size: 1.3rem;"><?php echo $order['postscript']; ?></p>
                    </li>
                    <?php } ?>
				</ul>
			</section>
		</section>

		<section class="m-top10">
			<ul>
				<li class="dis-box padding-all m-top1px b-color-f j-show-div" id="payment">
					<label class="t-remark g-t-temark">支付方式</label>
					<div class="box-flex t-goods1 text-right onelist-hidden">
						<span><?php echo $order['pay_name']; ?></span> <?php if($order['pay_fee'] > 0) { ?><em class="t-first"><?php echo $order['formated_pay_fee']; ?>手续费</em><?php } ?>
					</div>
					<?php if($payment_list) { ?>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
					<!--支付方式star-->
					<div class="show-goods-dist ts-3 b-color-1 j-show-goods-text j-filter-show-div">
						<section class="goods-show-title of-hidden padding-all b-color-f">
							<h3 class="fl g-c-title-h3">切换支付方式</h3>
							<i class="iconfont icon-guanbi1 show-div-guanbi fr"></i>
						</section>
						<section class="s-g-list-con swiper-scroll">
							<div class="swiper-wrapper">
								<div class="swiper-slide select-two">
									<ul class="j-get-one padding-all">
										<?php $n=1;if(is_array($payment_list)) foreach($payment_list as $payment) { ?>
										<li class="ect-select goods-site"  date-payid="<?php echo $payment['pay_id']; ?>">
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
					<?php } ?>
				</li>

                <?php if($order['inv_type']) { ?>
				<li class=" padding-all m-top1px b-color-f ">
						<label class="t-remark g-t-temark">发票信息</label>
						<div class="box-flex t-goods1 text-right onelist-hidden">
							<span><?php echo $order['inv_payee']; ?><?php echo $order['inv_content']; ?></span> <em class="t-first"><?php echo $order['formated_tax']; ?></em>
						</div>
				</li>
                <?php } ?>
                <?php if($order['bonus_id']) { ?>
				<li class="dis-box padding-all m-top1px b-color-f"><label
					class="t-remark g-t-temark">红包</label>
					<div class="box-flex t-goods1 text-right onelist-hidden">
						<span>红包金额</span> <em class="t-first"><?php echo $order['formated_bonus']; ?></em>
					</div>
                </li>
                <?php } ?>
				<?php if($order['coupons']) { ?>
				<?php $n=1;if(is_array($order['coupons'])) foreach($order['coupons'] as $val) { ?>
				<li class="dis-box padding-all m-top1px b-color-f"><label
						class="t-remark g-t-temark">优惠券</label>
					<div class="box-flex t-goods1 text-right onelist-hidden">
						<span>优惠券金额</span> <em class="t-first">-<?php echo $val['cou_money']; ?></em>
					</div>
				</li>
				<?php $n++;}unset($n); ?>
				<?php } ?>
			</ul>
		</section>
		<section class="m-top10">
			<section class="flow-checkout-tprice">
				<header class="b-color-f padding-all">
					商品金额<span class="t-first fr"><?php echo $order['formated_goods_amount']; ?></span>
				</header>
				<ul class="m-top1px b-color-f">
                    <?php if($order['discount'] > 0) { ?>
					<li class="padding-all of-hidden">
                        <label class="t-remark g-t-temark fl">商品优惠</label>
                        <span class="t-first fr">-<?php echo $order['formated_discount']; ?></span>
                    </li>
                    <?php } ?>
                    <?php if($order['shipping_fee'] > 0 && empty($order['point'])) { ?>
					<li class="padding-all of-hidden">
                        <label class="t-remark g-t-temark fl">运费</label>
                        <span class="t-first fr">+<?php echo $order['formated_shipping_fee']; ?></span>
					</li>
                    <?php } ?>
                    <?php if($order['integral']) { ?>
					<li class="padding-all of-hidden">
                        <label class="t-remark g-t-temark fl">抵用券</label>
                        <span class="fr t-first">-<?php echo $order['formated_integral_money']; ?></span>
                    </li>
                    <?php } ?>
					<?php if($order['bonus']>0) { ?>
					<li class="padding-all of-hidden">
						<label class="t-remark g-t-temark fl">使用红包</label>
						<span class="fr t-first">-<?php echo $order['formated_bonus']; ?></span>
					</li>
					<?php } ?>
					<?php if($order['coupons']>0) { ?>
					<?php $n=1;if(is_array($order['coupons'])) foreach($order['coupons'] as $val) { ?>
					<li class="padding-all of-hidden">
						<label class="t-remark g-t-temark fl">使用优惠券</label>
						<span class="fr t-first">-<?php echo $val['cou_money']; ?></span>
					</li>
					<?php $n++;}unset($n); ?>
					<?php } ?>
                                       <li class="padding-all of-hidden">
                                           <label class="t-remark g-t-temark fl"><?php echo $order['msg']; ?></label>
                                           <span class="fr t-first"><?php echo $order['handler']; ?></span>
                                       </li>
				</ul>

			</section>
		</section>

	</div>

</div>
<?php if($payment_list) { ?>
<div class="mask-filter-div"></div>
<?php } ?>
<!--悬浮btn star-->
<div class="filter-btn f-checkout-filter-btn  dis-box">
	<p class="u-o-checkout-price t-remark text-left box-flex m-top04">
            应付总额：<span class="t-first"><?php echo $order['formated_order_amount']; ?></span>
	</p>
	<?php if($order['order_amount'] > 0 && empty($order['hidden_pay_button'])) { ?>
        <div class="n-right-width" >
        <?php echo $order['pay_online']; ?>
        </div>
        <?php } ?>
	<?php if($order['invoice_no']) { ?>
	<?php echo $order['invoice_no']; ?>
	<?php } ?>
</div>
<!--悬浮btn end-->
<script>
	var scorll_swiper = new Swiper('.swiper-scroll', {
		direction : 'vertical',
		slidesPerView : 'auto',
		mousewheelControl : true,
		freeMode : true
	});
</script>
<script>
	$(function () {

		$(".ect-select").click(function(){
			var url = "<?php echo U('changepayment');?>";
			var args = new Array(2);
			args['order_id'] = <?php echo $order['order_id']; ?>;
			args['pay_id'] = $(this).attr('date-payid');
			StandardPost(url, args);
		})
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
	})
</script>
</body>

</html>";s:12:"compile_time";i:1479419108;}";