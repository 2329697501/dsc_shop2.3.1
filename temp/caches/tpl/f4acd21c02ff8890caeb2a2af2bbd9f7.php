<?php exit;?>0014797399951f83d77edece4824d626097013e94cf4s:2269:"a:2:{s:8:"template";s:2205:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">
			<div class="flow-consignee-list j-get-consignee-one select-three">
                            <?php $n=1;if(is_array($consignee_list)) foreach($consignee_list as $consignee) { ?>
				<section class="flow-checkout-adr m-top08">
					<div class="flow-set-adr of-hidden padding-all ">
						<div class="ect-select fl">
							<label class="dis-box <?php if($consignee['address_id'] == $address_id ) { ?>active<?php } ?>" onclick="adderss_user(<?php echo $consignee['address_id']; ?>)"">
								<i class="select-btn "></i>
                                                          
								<span class="t-first margin-lr  "><a class="ml10 ftx-05 " href="javascript:void(0);"><?php if($consignee['address_id'] == $address_id ) { ?>默认地址<?php } else { ?>设为默认<?php } ?></a></span>

							</label>
						</div>
                                            <div class="fr"><a href="<?php echo U('index/addaddress',array('address_id'=>$consignee['address_id']));?>"><i class="iconfont icon-bianji"></i>编辑</a><a href="<?php echo U('index/drop',array('address_id'=>$consignee['address_id']));?>"><i class="iconfont icon-xiao10"></i>删除</a></div>
					</div>
					<div class="flow-have-adr padding-all">
						<p class="f-h-adr-title">
							<label><?php echo $consignee['consignee']; ?></label><span><?php echo $consignee['mobile']; ?></span></p>
						<p class="f-h-adr-con t-remark m-top04"><?php echo $consignee['address']; ?></p>
					</div>
				</section>
				<?php $n++;}unset($n); ?>
				<div class="ect-button-more dis-box filter-btn padding-all">
					<a href="<?php echo U('index/addaddress');?>" class="btn-submit box-flex">新增收货人信息</a>
				</div>
			</div>
		</div>
         <script type="text/javascript">

                //设置默认收获地址
       function adderss_user(address_id){
                $.get('<?php echo U('user/index/ajax_make_address ' );?>',{address_id:address_id},function(data){
                   
                        
                },'json') ; 
               
            }
    </script>
	</body>

</html>";s:12:"compile_time";i:1479653595;}";