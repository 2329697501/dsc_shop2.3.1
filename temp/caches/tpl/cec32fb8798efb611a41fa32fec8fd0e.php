<?php exit;?>001479115680029802281deee274117567b57221402cs:4022:"a:2:{s:8:"template";s:3958:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">
                         <form action="<?php echo U('user/account/account');?>" method="post">
			<div class="user-recharge b-color-f">
				<section class="m-top1px margin-lr">
					<div class="text-all dis-box j-text-all">
						<label class="t-remark">充值金额</label>
						<div class="box-flex input-text">
                                                    <input class="j-input-text" type="text" placeholder="" name="amount">
					</div>
					</div>
				</section>
				<section class="m-top1px padding-tb margin-lr" style="padding-bottom:0;">
					<div class="f-c-select-msg">
						<label class="t-remark">会员备注<span class="t-remark">（50字）</span></label>
						<div class="text-area1 m-top04">
                                                    <textarea class="text-area1" name="user_note" maxlength="50" placeholder="选填"></textarea>
							<span>50</span>
						</div>
					</div>
				</section>
				<section class="padding-lr j-show-div j-show-get-val">
					<div class="text-all dis-box ">
						<label class="t-remark">充值方式</label>
						<div class="box-flex t-goods1 text-right onelist-hidden"><span> </span> <em class="t-first"></em></div>
                                           
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
					</div>
					<!--充值方式弹出层-->
					<div class="show-time-con ts-3 b-color-1 j-filter-show-div">
									<section class="goods-show-title of-hidden padding-all b-color-f">
										<h3 class="fl g-c-title-h3">充值方式</h3>
										<i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
									</section>
									<section class="s-g-list-con swiper-scroll">
										<div class="swiper-wrapper">
											<div class="swiper-slide select-two">
												<ul class="j-get-one padding-all">
                                                                                                    <?php $n=1;if(is_array($payment)) foreach($payment as $list) { ?>
													<li class="ect-select">
														<label class="ts-1" onclick="show(<?php echo $list['pay_id']; ?>)"  ><dd><span><?php echo $list['pay_name']; ?> 手续费：</span> <em class="t-first"><?php echo $list['pay_fee']; ?></em></dd><i class="fr iconfont icon-gou ts-1"></i></label>
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
                            <button type="submit" class="btn-submit" name="submit" value="sub">提交申请</button>
			</div>
                 
                             <!--提现layer-->
                             <div class="mask-filter-div"></div>
                             <div class="two-btn ect-padding-tb ect-padding-lr ect-margin-tb text-center">
                                 <input type="hidden" name="surplus_type" value="0" />
                                 <input type="hidden" name="payment_id" value="0" />
                                 <input type="hidden" name="pay_code" value="0" />
                                 <input type="hidden" name="pay_name" value="0" />
                                 <input type="hidden" name="pay_fee" value="0" />
                                 <input type="hidden" name="rec_id" value="0" />

                             </div>
          </form>
		</div>
		<!--引用js-->

		<script type="text/javascript">
			function show(pid){
                           $("input[name=payment_id]").val(pid);
                        }
		</script>
	</body>

</html>";s:12:"compile_time";i:1479029280;}";