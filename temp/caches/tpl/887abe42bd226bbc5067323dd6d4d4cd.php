<?php exit;?>00147969857927a249f41c539a960136c10a69aef21fs:2315:"a:2:{s:8:"template";s:2251:"<?php $__Template->display($this->getTpl("page_header")); ?>
<style>
    .flow-accessories .product-list .product-div{position:relative;}
    .flow-accessories .product-list .product-div .a-accessories-clear{position: absolute;
    font-size: 1.8rem;
    color: #888;
    right: 1.3rem;
    bottom: 1.3rem;}
    .flow-accessories .product-list .product-div .a-accessories-clear i{font-size:1.8rem;}
</style>
 <div class="store_info">
     
<script id="j-product" type="text/html">
			<div class="flow-accessories blur-div">
                              <%if goods_list !=''%>
                             <%each goods_list as goods%>  
			<section class="product-list j-product-list product-list-small">
					<ul>
						<li>
							<div class="product-div">
                                                            <a href="<%goods.url%>">
								<img class="product-list-img" src="<%goods.goods_thumb%>" />
								<div class="product-text">
									<a href="<%goods.url%>"><h4><%goods.goods_name%></h4></a>
									<p class="dis-box p-t-remark"><span class="box-flex">库存:<%goods.goods_number%></span></p>
									<p><span class="p-price t-first "><%#goods.shop_price%></span></p>
                                    <a href="<%goods.del%>" class="a-accessories-clear"><i class="iconfont icon-xiao10 fr"></i></a>
								</div>
                                                                
							</div>
                                                  
						</li>
					</ul>
				</section>
                                 <%/each%>
                                  <%else%>
                                 <div class="no-div-message">
				   <i class="iconfont icon-biaoqingleiben"></i>
				<p>亲，还没有收藏商品哦～！</p>
			</div>
                                    <%/if%>
		</div>
		 </script>
		<script>
			/*店铺信息商品滚动*/
			var swiper = new Swiper('.j-f-n-c-prolist', {
				scrollbarHide: true,
				slidesPerView: 'auto',
				centeredSlides: false,
				grabCursor: true
			});
			
                      $('.store_info').infinite({url: "<?php echo U('user/index/collectionlist');?>", template:'j-product'});
		
		</script>
	</body>

</html>";s:12:"compile_time";i:1479612179;}";