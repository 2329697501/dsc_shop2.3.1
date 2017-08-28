<?php exit;?>0014777335680ca052e8ec3d0c5a8e173fa9f3ca7a9cs:3630:"a:2:{s:8:"template";s:3566:"<?php $__Template->display($this->getTpl("page_header")); ?>
     <div class="con">
                    <form action="<?php echo U('user/account/account');?>" method="post" onsubmit="return check()">
			<div class="user-recharge b-color-f">
                           
				<section class="margin-lr">
				<div class="text-all dis-box j-text-all">
					<label class="t-remark">提现金额</label>
					<div class="box-flex input-text">
						<input class="j-input-text" type="text" placeholder="本次最大提现额度 <?php echo $surplus_amount; ?>" name="amount">
					</div>
				</div>
				</section>
				<section class="j-show-div j-show-get-val padding-lr">
					<div class="dis-box text-all">
						<label class="t-remark">提现方式</label>
                        <?php $n=1; if(is_array($bank)) foreach($bank as $key => $val) { ?>
                        <?php if($key==0) { ?>
                        <input type="hidden" name="bank_number" value="<?php echo $val['bank_card']; ?>">
                        <input type="hidden" name="real_name" value="<?php echo $val['bank_user_name']; ?>">
                         <input type="hidden" name="user_note" value="<?php echo $val['bank_region']; ?>">
						<div class="box-flex t-goods1 text-right onelist-hidden"><span>(<?php echo $val['bank_name']; ?>)<?php echo $val['bank_card']; ?></span></div>
                        <?php } ?>
                        <?php $n++;}unset($n); ?>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
					</div>
					<!--充值方式弹出层-->
					<div class="show-time-con ts-3 b-color-1 j-filter-show-div">
									<section class="goods-show-title of-hidden padding-all b-color-f">
										<h3 class="fl g-c-title-h3">选择银行卡</h3>
										<i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
									</section>
									<section class="s-g-list-con swiper-scroll">
										<div class="swiper-wrapper">
											<div class="swiper-slide select-two">
												<ul class="j-get-one padding-all">
                                                    <?php $n=1;if(is_array($bank)) foreach($bank as $key) { ?>
													<li class="ect-select">
														<label class="ts-1" name="<?php echo $key['bank_name']; ?>" card="<?php echo $key['bank_card']; ?>"><dd><span>(<?php echo $key['bank_name']; ?>)<?php echo $key['bank_card']; ?></span></dd><i class="fr iconfont icon-gou ts-1"></i></label>
													</li>
													<?php $n++;}unset($n); ?>
												</ul>
											</div>
											<div class="swiper-scrollbar"></div>
										</div>
									</section>
								</div>
				</section>
			</div>

			<div class="padding-all">
				<button type="submit" class="btn-submit">提交申请</button>
			</div>

               <input type="hidden" name="surplus_type" value="1">
               
                     </form>
			<!--提现layer-->
			<div class="mask-filter-div"></div>
		</div>
		<script type="text/javascript">
			$(function($) {});
            function check(){
                $(".ts-1").each(function (){
                   if($(this).hasClass("active")){
                       $("input[name=real_name]").val($(this).attr("name"));
                       $("input[name=bank_number]").val($(this).attr("card"));
                       a = 1;
                   }
                })
                if(a!=1){
                    return false;
                }
            }
		</script>
	</body>

</html>";s:12:"compile_time";i:1477647168;}";