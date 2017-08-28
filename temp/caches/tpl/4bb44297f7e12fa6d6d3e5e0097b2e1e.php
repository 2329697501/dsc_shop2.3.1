<?php exit;?>001479807407fe924244979c72ff71635ef8cfb8164bs:3541:"a:2:{s:8:"template";s:3477:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">
        <?php if($consignee_list) { ?>      
                    <div class="flow-consignee-list j-get-consignee-one select-three">
                           <?php $n=1;if(is_array($consignee_list)) foreach($consignee_list as $consignee) { ?>
				<section class="flow-checkout-adr m-top08" id="list<?php echo $consignee['address_id']; ?>">
					<div class="flow-set-adr of-hidden padding-all ">
						<div class="ect-select fl">
							<label class="dis-box <?php if($address_id == $consignee['address_id']) { ?>active<?php } ?>" onclick="adderss_user(<?php echo $consignee['address_id']; ?>)">
								<i class="select-btn"></i>
                                                       
							</label>
						</div>
                                            <div class="fr" ><a href="<?php echo U('flow/index/edit_address',array('address_id'=>$consignee['address_id']));?>"><i class="iconfont icon-bianji"></i>编辑</a><a onclick="del(<?php echo $consignee['address_id']; ?>)"><i class="iconfont icon-xiao10" ></i>删除</a></div>
					</div>
					<div class="flow-have-adr padding-all">
								<p class="f-h-adr-title ">
                                                                  <label><?php echo $consignee['consignee']; ?></label>
                                                                 <span><?php echo $consignee['mobile']; ?></span>
                                                  <?php if($consignee['address_id']==$defulte_id ) { ?>
                                                    <span class="t-first margin-lr active">默认地址</span>
                                                  <?php } ?>
                                                                     </p>
                             <p class="f-h-adr-con t-remark m-top04" onclick="adderss_user(<?php echo $consignee['address_id']; ?>)"><?php echo $consignee['address']; ?>
                                
                                                  </p>
					</div>
				</section>
                           <?php $n++;}unset($n); ?>
				<div class="ect-button-more dis-box filter-btn padding-all">
					<a href="<?php echo U('flow/index/add_address');?>" class="btn-submit box-flex">新增收货人信息</a>
				</div>
			</div> 
            <?php } else { ?>
			<div class="no-div-message">
				<i class="iconfont icon-biaoqingleiben"></i>
				<p>亲，还没有收货地址哦～！</p>
				<a href="<?php echo U('flow/index/add_address');?>" class="t-first">点击添加一个收货地址</a>
			</div>
			<?php } ?>	
		</div>
        <script type="text/javascript">
            //点击设置地址
            function adderss_user(address_id){
                if(address_id){
                    $.get("<?php echo U('flow/index/set_address');?>", {address_id:address_id}, function(data){
                        if(data.status==1){
                            if(data.url){
                                window.location.href = data.url;
                            }
                        }
                    },'json') ;
                }
            }
        </script>
       <script>
        function del(address_id){
            $("#list"+address_id).hide();
            $.get("<?php echo U('flow/index/address_list');?>",{address_id:address_id},function(){});
        }
     </script>
	</body>
</html>";s:12:"compile_time";i:1479721007;}";