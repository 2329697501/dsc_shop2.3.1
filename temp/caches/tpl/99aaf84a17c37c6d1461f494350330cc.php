<?php exit;?>001476930436ee472243c817f1f8bcff084bde2d2bc6s:4832:"a:2:{s:8:"template";s:4768:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div id="loading"><img src="<?php echo __TPL__;?>img/loading.gif" /></div>
		<div class="con">
			<section class="m-top08 goods-evaluation">
				<div class="share-cont-box b-color-f">
					<h3 class="my-u-title-size">分成明细</h3>
					<h4 class="f-04 col-4">本网店为鼓励推荐新用户注册，现开展<?php if($separate_by == 0) { ?>推荐注册分成<?php } ?><?php if($separate_by == 1) { ?>推荐订单分成<?php } ?>活动，活动流程如下：</h4>
					<?php if($separate_by == 0) { ?>
					<p class="f-03 col-8">
						1、将本站提供给您的推荐代码，发送到论坛、博客上。
						<br/> 2、访问者点击链接，访问网店。
						<br/> 3、在访问者点击链接的 <?php echo $expire; ?><?php echo $expire_unit; ?> 内，若该访问者在本站注册，即认定该用户是您推荐的，您将获得等级抵用券 <?php echo $level_register_all; ?> 的奖励 (当您的等级抵用券超过 <?php echo $level_register_up; ?> 时，不再获得奖励)。
						<br/> 4、该用户今后在本站的一切消费，您均能获得一定比例的提成。目前实行的提成总额为订单金额的 <?php echo $level_money_all; ?> 、抵用券的 <?php echo $level_point_all; ?> ，分配给您、推荐您的人等，具体分配规则请参阅 我推荐的会员。
						<br/> 5、提成由管理员人工审核发放，请您耐心等待。
						<br/> 6、您可以通过分成明细来查看您的介绍、分成情况。
					</p>
					<?php } ?>
					<?php if($separate_by == 1) { ?>
					<p class="f-03 col-8">
						1、在浏览商品时，点击推荐此商品，获得推荐代码，将其发送到论坛、博客上。
						<br/> 2、访问者点击链接，访问网店。
						<br/> 3、在访问者点击链接的 <?php echo $expire; ?><?php echo $expire_unit; ?> 内，若该访问者在本站有订单，即认定该订单是您推荐的。
						<br/> 4、您将获得该订单金额的 <?php echo $level_money_all; ?> 、抵用券的 <?php echo $level_point_all; ?>的奖励。
						<br/> 5、提成由管理员人工审核发放，请您耐心等待。
						<br/> 6、您可以通过分成明细来查看您的介绍、分成情况。
					</p>
					<?php } ?>
				</div>
				<?php if($share['on'] == 1) { ?>
				<?php if($goodsid == 0) { ?>
				<?php if($share['config']['separate_by'] == 0) { ?>
				<div class="padding-all b-color-f share-cont-box">
					<h3 class="my-u-title-size active">我的推荐会员</h3>
					<table class="share-table-box">
						<tr>
							<th>等级</th>
							<th>人数</th>
							<th>抵用券分成百分比</th>
							<th>现金分成百分比</th>
						</tr>
						<?php $n=1; if(is_array($affdb)) foreach($affdb as $key => $list) { ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $list['num']; ?></td>
							<td><?php echo $list['point']; ?></td>
							<td><?php echo $list['money']; ?></td>
						</tr>
						<?php $n++;}unset($n); ?>
					</table>
				</div>
				<?php } ?>
				<div class="padding-all b-color-f share-cont-box">
					<h3 class="my-u-title-size">分享二维码</h3>
					<br/>
					<div class="share-ewm-box">
						<div class="share-ewm-box-1">
							<img src="<?php echo $ewm; ?>">
						</div>
						<p class="text-c col-8 f-02 m-top04">长按扫描二维码</p>
					</div>
				</div>
				<div class="padding-all b-color-f share-cont-box">
					<h3 class="my-u-title-size">我的分成</h3>
					<div class="affiliate-ajax">
						<script id="j-product" type="text/html">
							<%if totalPage > 0%>
							<%each logdb as val%>
						<div class="dis-shop-list p-r ptb-1">
							<div class="dis-box">
								<div class="box-flex">
									<h5 class="f-05 col-3">订单号</h5>
									<p class="f-03 col-9 m-top02"><%val.order_sn%></p>
								</div>
								<div class="box-flex">
									<h5 class="f-05 col-3 text-right"><%#val.money%></h5>
									<p class="f-04 color-red text-right m-top02"><%if val.is_separate == 1%>已分成<%else%>等待处理<%/if%></p>
								</div>
							</div>
							<p class="f-02 col-9 m-top04">分成模式:<%if val.separate_type == 1 || val.separate_type == 0%>推荐注册分成<%else%>订单分成<%/if%>  抵用券分成:<%val.point%></p>
						</div>
							<%/each%>
							<%else%>
							<%/if%>
						</script>
					</div>
				</div>
				<?php } ?>
				<?php } ?>
		</div>
<script>
	$(function () {
		var url = "<?php echo U('affiliate');?>";
		//订单列表
		$('.affiliate-ajax').infinite({url: url, template: 'j-product'});
	})
</script>
<?php $__Template->display($this->getTpl("page_footer")); ?>";s:12:"compile_time";i:1476844036;}";