<?php exit;?>00147773355862a8879c5b90d6f2a8389b0f0a9c6cf2s:1366:"a:2:{s:8:"template";s:1302:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">

			<form action="<?php echo U('user/index/addcard');?>">
				<section class=" j-f-tel">
					<div class="b-color-f padding-lr">
                         <?php $n=1;if(is_array($card_list)) foreach($card_list as $card) { ?>
							<div id="list<?php echo $card['id']; ?>" class="text-all dis-box j-text-all b-color-f card-div position-rel">

								<div class="card-list">
                                    <i onclick="card(<?php echo $card['id']; ?>)" class="iconfont icon-xiao10"></i>
									<p><?php echo $card['bank_name']; ?></p>
									<span>尾号<?php echo $card['bank_card']; ?></span>
								</div>
								<span class="t-jiantou"></span>
							</div>
						<?php $n++;}unset($n); ?>	
					</div>
					<div class="dis-box padding-all">
						<input type="hidden" name="u-h-forget" value="u-f-tel" />
                        <a href="<?php echo U('user/account/addcard');?>" class="btn-submit box-flex">+添加银行卡</a>
					</div>
				</section>
			</form>

		</div>
	</body>
    <script>
        function card(id){
            $("#list"+id).hide();
            $.get("<?php echo U('user/account/cardlist');?>",{id:id},function(){});
        }
    </script>
</html>";s:12:"compile_time";i:1477647158;}";