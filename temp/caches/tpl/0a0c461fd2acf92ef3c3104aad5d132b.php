<?php exit;?>0014795660440d7314f272e1fffbe19df6c00438d416s:2440:"a:2:{s:8:"template";s:2376:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">
			<div class="flow-coupon user-coupon">
				<div class="hd tab-title j-tab-title  b-color-f">
					<ul class="dis-box">
						<li class="box-flex active"><a href="#">未使用(<?php echo $status['one']; ?>)</a></li>
						<li class="box-flex"><a href="#">已使用(<?php echo $status['two']; ?>)</a></li>
						<li class="box-flex"><a href="#">已过期(<?php echo $status['three']; ?>)</a></li>
					</ul>
				</div>
				<div id="j-tab-con">
					<div class="swiper-wrapper">
						<section class="swiper-slide swiper-no-swiping ">
							<ul class="padding-all  bonus-list">
							<script id="j-bonus" type="text/html">
							<%each bonus as key%>
								<li class="big-remark-all">
									<div class="dis-box position-rel">
									<%if key.near_time%>
									<div class="remark-out">快过期</div>
									<%/if%>
									<a class="product-div-link"></a>
									<div class="remark-all temark-<%if key.type_money>=0%><%if key.type_money>=50%><%if key.type_money>=100%>1<%else%>2<%/if%><%else%>3<%/if%><%else%>3<%/if%> tb-lr-center">
										<span class="b-r-a-price"><sup>¥</sup><%key.type_money%></span>
									</div>
									<div class="box-flex b-color-f padding-all position-rel">
										<h4><%key.rz_shopName%></h4>
										<p><%key.type_name%></p>
										<p class="t-remark"><%key.use_startdate%> ~ <%key.use_enddate%></p>
									</div>
									</div>
								</li>
							<%/each%>
							</script>
							</ul>
						</section>
					</div>
			</div>
                <div class="user-coupon-add padding-all filter-btn">
                    <a href="<?php echo U('add_bonus');?>" type="button" class="btn-submit">添加优惠券/红包</a>

                </div>
		</div>
		<!--引用js-->

		<script>
			var url = 'index.php?r=user/account/bonus';
			var infinite = $('.bonus-list').infinite({url: url, template:'j-bonus'});

			$(".j-tab-title li").on('touchstart mousedown', function(e) {
				e.preventDefault();
				$(".j-tab-title .active").removeClass('active');
				$(this).addClass('active');

				//切换选项卡
				infinite.onload(url + '&type=' + $(this).index());
			});
			$(".j-tab-title li").click(function(e) {
				e.preventDefault()
			})

		</script>
	</body>
	
</html>";s:12:"compile_time";i:1479479644;}";