<?php exit;?>0014798232261bdde2d587885e849bb00a1fdf1121c0s:2430:"a:2:{s:8:"template";s:2366:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<section class="purse-header-box text-center purse-f">
			<p>可用余额</p>
			<h2><?php echo $surplus_amount; ?></h2>
			<h5>冻结余额：<?php echo $frozen_money; ?></h5>
		 	<img src="<?php echo __TPL__;?>img/pur-bg.png">
			<div class="user-pur-box">
				<div class="user-nav-1-box g-s-i-title-2 dis-box text-center">
					<a href="<?php echo U('user/account/deposit');?>" class="box-flex">
						<h4 class="ellipsis-one purse-f"><i class="iconfont icon-money is-money-color"></i>充值</h4>
					</a>
					<a href="<?php echo U('user/account/accountraply');?>" class="box-flex">
						<h4 class="ellipsis-one purse-f"><i class="iconfont icon-wodetixian is-money-color"></i>提现</h4>
					</a>
				</div>
			</div>
		</section>
		<section class="b-color-f my-nav-box m-top10">
			<div class="user-money-list g-s-i-title-1 dis-box my-dingdan purse-f">
				<a href="<?php echo U('user/account/bonus');?>" class="box-flex text-center">
					<p class="t-remark3">红包</p>
					<h4 class="ellipsis-one"><?php echo $record_count; ?></h4>
					<div class="purse-ts-box" style="display:none"></div>
				</a>
				<a href="<?php echo U('user/account/cardlist');?>" class="box-flex text-center">
					<p class="t-remark3">银行卡</p>
					<h4 class="ellipsis-one"><?php echo $drp_card; ?></h4>
					<div class="purse-ts-box" style="display:none"></div>
				</a>
				<a href="#" class="box-flex text-center">
					<p class="t-remark3">当前抵用券</p>
					<h4 class="ellipsis-one"><?php echo $pay_points; ?></h4>
					<div class="purse-ts-box" style="display:none"></div>
				</a>
			</div>
		</section>
		<section class="b-color-f my-nav-box m-top10">
			<a href="<?php echo U('user/account/detail');?>">
				<div class="dis-box padding-all my-bottom">
					<h3 class="box-flex text-all-span my-u-title-size">账户明细</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>
			<a href="<?php echo U('user/account/log');?>">
				<div class="dis-box padding-all my-bottom">
					<h3 class="box-flex text-all-span my-u-title-size">申请记录</h3>
					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</a>
		</section>
	</body>

</html>";s:12:"compile_time";i:1479736826;}";