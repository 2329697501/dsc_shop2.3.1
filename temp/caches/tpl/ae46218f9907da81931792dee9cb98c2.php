<?php exit;?>0014771480324f7d167500c4b37a55a0d6ae54f3198es:2418:"a:2:{s:8:"template";s:2354:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<section class="product-sequence dis-box">
			<a class="box-flex active " sort="goods_id" order="DESC">默认</a>
			<a class="box-flex" sort="amount" order="DESC">兑换量<i class="iconfont icon-xiajiantou"></i></a>
			<a class="box-flex" sort="popularity" order="DESC">抵用券值<i class="iconfont icon-xiajiantou"></i></a>
		</section>
		<section class="j-get-i-more j-money-divided">
			<script id="j-product" type="text/html">
				<%if totalPage > 0%>
			<div class="b-color-f padding-all product-list-small j-get-i-more">
				<ul>
						<%each goodslist as list%>
					<li>
						<div class="dis-box">
							<div class="ect-select">
								<label><i class="j-select-btn"></i></label>
							</div>
							<a href="<%list.url%>">
								<div class="box-flex">
									<div class="product-div">

										<div class="p-d-img fl">
											<img class="product-list-img my-auction-img" src="<%list.goods_thumb%>">
										</div>
										<div class="product-text-auction">
											<h4 class="onel	ist-hidden"><%list.goods_name%></h4>
											<span class="t-first auction-cont-box"><%list.exchange_integral%></span><small class="my-auction-small">抵用券</small>
											<p class="my-auction-small">市场价：<%#list.market_price%></p>
											<div><span class="auction-but-cont a-col-red">立即兑换</span></div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</li>
						<%/each%>
				</ul>
			</div>
				<%else%>
				<div class="no-div-message">
					<i class="iconfont icon-biaoqingleiben"></i>
					<p>亲，此处没有内容～！</p>
				</div>
				<%/if%>
			</script>
		</section>

	</body>
<script>
	var url = 'index.php?r=exchange/index/index';
	var infinite = $('.j-money-divided').infinite({url: url,template: 'j-product'});

	$(".product-sequence a").click(function (){
		var sort = $(this).attr('sort');
		var order = $(this).attr('order');
		infinite.onload('sort='+sort+'&order='+order);
		$(this).addClass("active").siblings().removeClass("active");
		if(order == 'DESC'){
			$(this).attr("order","ASC");
			$(this).removeClass("a-change");
		}else{
			$(this).attr("order","DESC");
			$(this).addClass("a-change");
		}

	})


</script>

</html>";s:12:"compile_time";i:1477061632;}";