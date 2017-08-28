<?php exit;?>001479115716a2d7dd97b66b3cab2ce1780caa466560s:3870:"a:2:{s:8:"template";s:3806:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">
    <?php if($type) { ?>
            <section class=" j-f-tel padding-lr b-color-f mb-1">
                <div class="text-all dis-box j-text-all b-color-f card-div">
                    <div>
                        <p>账户充值</p>
                        <span></span>
                    </div>
                    <div class="box-flex input-text text-right">
                        <p><?php echo $amount; ?></p>
                        <span class="color-red"></span>
                    </div>
                </div>
            </section>

            <section class=" j-f-tel padding-lr b-color-f">
                <div class="text-all dis-box j-text-all b-color-f card-div">
                    <div>
                        <p>支付方式<span><?php echo $payment['payment']; ?>&nbsp;手续费：[<?php echo $pay_fee; ?>]</span></p>

                    </div>
                </div>
                <div class="text-all dis-box j-text-all b-color-f card-div">
                    <div>
                        <p>支付方式描述</p>
                        <span><?php echo $payment['pay_desc']; ?></span>
                    </div>
                </div>
            </section>
            <div class="margin-lr">
                <div class="ect-button-more dis-box m-top12">
                    <a class="btn-reset box-flex" href="javascript:history.go(-1)">取消</a>
                    <?php echo $but; ?>
                </div>
            </div>
    <?php } else { ?>
                      <?php $n=1;if(is_array($account_log)) foreach($account_log as $item) { ?>
			<form action="">
				<section class=" j-f-tel padding-lr b-color-f mb-1">
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p><?php echo $item['type']; ?></p>
							<span><?php echo $item['add_time']; ?></span>
						</div>
						<div class="box-flex input-text text-right">
							<p><?php echo $item['amount']; ?></p>
							<span class="color-red"><?php echo $item['pay_status']; ?></span>
						</div>
					</div>
				</section>

				<section class=" j-f-tel padding-lr b-color-f">
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p><?php if($item['type']=='提现') { ?>银行卡<?php } else { ?>支付方式<?php } ?><span><?php echo $item['payment']; ?>&nbsp;手续费：[<?php echo $item['pay_fee']; ?>]</span></p>

						</div>
					</div>
                    <?php if($item['pay_desc']) { ?>
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p>支付方式描述</p>
							<span><?php echo $item['pay_desc']; ?></span>
						</div>
					</div>
                    <?php } ?>
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p>会员备注</p>
							<span><?php echo $item['user_note']; ?></span>
						</div>
					</div>
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<p>管理员备注</p>
							<span><?php echo $item['short_admin_note']; ?></span>
						</div>
					</div>
				</section>
				<div class="margin-lr">
					<div class="ect-button-more dis-box m-top12">
                                            <?php if($item['pay_status']=='未确认') { ?>
                                            <a class="btn-submit box-flex" href="<?php echo U('user/account/cancel',array('id'=>$item['id']));?>">取消</a>
                                            <?php } ?>
						   <?php echo $item['handle']; ?>
					</div>
				</div>
			</form>
                     <?php $n++;}unset($n); ?>
        <?php } ?>
		</div>
	</body>

</html>";s:12:"compile_time";i:1479029316;}";