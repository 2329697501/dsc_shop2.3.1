<?php exit;?>001479823228ae1369b0089ff84a2d118c956716c4fas:1323:"a:2:{s:8:"template";s:1259:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">
            <?php if(count($account_log)>0) { ?>
		
            
            
            <section class=" j-f-tel padding-lr b-color-f">
                      <?php $n=1;if(is_array($account_log)) foreach($account_log as $item) { ?>
					<div class="text-all dis-box j-text-all b-color-f card-div">
						<div>
							<?php if($item['short_change_desc_part1']) { ?>
							<p><?php echo $item['short_change_desc_part1']; ?></p>
							<p><?php echo $item['short_change_desc_part2']; ?></p>
							<?php } else { ?>
							<p><?php echo $item['short_change_desc']; ?></p>
							<?php } ?>
							<span><?php echo $item['change_time']; ?></span>
						</div>
						<div class="box-flex input-text text-right"><span class="t-remark"><?php echo $item['amount']; ?></span></div>
					</div>
			<?php $n++;}unset($n); ?>	
		</section>
            
            
            
             <?php } else { ?>
                <div class="no-div-message">
                    <i class="iconfont icon-biaoqingleiben"></i>
                    <p>亲，此处没有内容～！</p>
                </div>
             <?php } ?>

		</div>
	</body>

</html>";s:12:"compile_time";i:1479736828;}";