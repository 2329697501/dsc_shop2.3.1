<?php exit;?>001478166028d005a561c71bd1792ad2c192b51f49d3s:29539:"a:2:{s:8:"template";s:29474:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con">
			    <header class="dis-box header-menu n-header-menu b-color color-whie">
        <a class="" href="javascript:history.go(-1);"><i class="iconfont icon-back"></i></a>
        <h3 class="box-flex">团购详情</h3>
        <a><i class="iconfont icon-13caidan j-nav-box"></i></a>
    </header>
    <?php $__Template->display($this->getTpl("header_nav")); ?>
	<form name="ECS_FORMBUY" action="<?php echo U('buy');?>" id="ECS_FORMBUY" method="post" onsubmit="return get_groupbuy();">
			<div class="goods">
				<div class="goods-photo j-show-goods-img">
					<div id="fnTimeCountDown" class="group-time-box" data-end="<?php echo $group_buy['formated_end_date']; ?>">
						<span class="day">00</span>天
						<span class="hour">00</span>时
						<span class="mini">00</span>分
						<span class="sec">00</span>秒
					</div>
					<span class="goods-num" id="goods-num">
						<span id="g-active-num"></span>/<span id="g-all-num"></span>
					</span>
					<div class="swiper-wrapper">
						<?php $n=1;if(is_array($goods_img)) foreach($goods_img as $goods_img) { ?>
						<li class="swiper-slide tb-lr-center"><img src="<?php echo $goods_img['img_url']; ?>"/></li>
						<?php $n++;}unset($n); ?>
					</div>
					<!-- Add Pagination -->
					<div class="swiper-pagination"></div>
				</div>

				<section class="goods-title b-color-f padding-all ">
					<div class="dis-box">
						<h3 class="box-flex"> <?php if(empty($goods['user_id'])) { ?><em class="em-promotion">自营</em><?php } ?><?php echo $goods['goods_name']; ?></h3>
						<span class="heart j-heart <?php if($goods_collect) { ?>active<?php } ?>"  onclick="collect(<?php echo $goods['goods_id']; ?>)" id="ECS_COLLECT"><i class="ts-2"></i><em class="ts-2">收藏</em></span>
					</div>
				</section>
				<section class="goods-price padding-all b-color-f">
					<p class="p-price"><span class="t-first">￥<?php echo $group_buy['price_ladder']['0']['price']; ?></span><em class="em-promotion"><?php echo $group_buy['zhekou']; ?>折</em></p>
					<p class="p-market">市场价 <del><?php echo $goods['market_price']; ?></del></p>
					<!-- <?php if($group_buy['deposit'] > 0) { ?> 保证金额-->
					<p class="p-market">保证金 <?php echo $group_buy['formated_deposit']; ?></p>
					<!--<?php } ?>-->

					<p class=" dis-box g-p-tthree m-top06">
						<span class="box-flex text-left">销量 <?php echo $goods['sales_volume']; ?> <?php echo $goods['measure_unit']; ?></span>
						<span class="box-flex text-center">库存 <font class="goods_attr_num"></font> <?php echo $goods['measure_unit']; ?></span>
					</p>
				</section>
				<section class="m-top1px padding-all b-color-f goods-attr j-goods-attr j-show-div">
					<div class="dis-box">
						<label class="t-remark g-t-temark">已选</label>
						<div class="box-flex t-goods1 ">请选择</div>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
					</div>
					<!--商品属性弹出层star-->
					<div class="mask-filter-div"></div>
					<div class="show-goods-attr j-filter-show-div ts-3 b-color-1">
						<!--<section class="s-g-attr-title b-color-1  product-list-small">-->
							<!--<div class="product-div">-->
								<!--<img class="product-list-img" src="<?php echo $goods['goods_img']; ?>">-->
								<!--<div class="product-text">-->
									<!--<div class="dis-box position-rel">-->
										<!--<h4 class="box-flex"><?php echo $goods['goods_name']; ?></h4>-->
										<!--<i class="iconfont icon-guanbi2 show-div-guanbi"></i>-->
									<!--</div>-->
									<!--<p><span class="p-price t-first class-exchange"><?php echo $goods['exchange_integral']; ?></span><em-->
											<!--class="g-p-tthree in-new">价格</em></p>-->
									<!--<p class="dis-box p-t-remark"><span class="box-flex">库存:<font class="goods_attr_num"><?php echo $goods['goods_number']; ?></font> <?php echo $goods['measure_unit']; ?></span>-->
									<!--</p>-->
								<!--</div>-->
							<!--</div>-->
						<!--</section>-->
						<section class="s-g-attr-title b-color-1  product-list-small">
							<div class="product-div">
								<img class="product-list-img" src="<?php echo $goods['goods_img']; ?>">
								<div class="product-text">
									<div class="dis-box position-rel">
										<h4 class="box-flex"><?php echo $goods['goods_name']; ?></h4>
										<i class="iconfont icon-guanbi2 show-div-guanbi"></i>
									</div>
									<p><span class="p-price t-first ">¥<?php echo $group_buy['price_ladder']['0']['price']; ?></span></p>
									<p class="dis-box p-t-remark"><span class="box-flex">限购数量：<?php echo $group_buy['restrict_amount']; ?> <?php echo $goods['measure_unit']; ?></span></p>
								</div>
							</div>
						</section>

						<section class="s-g-attr-con swiper-scroll b-color-f padding-all m-top1px">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<?php $n=1;if(is_array($specification)) foreach($specification as $spec_key=>$spec) { ?>
									<?php if($spec['values']) { ?>
									<h4 class="t-remark"><?php echo $spec['name']; ?></h4>
									<!-- 判断属性是复选还是单选 -->
									<?php if($spec['attr_type'] == 1) { ?>
									<ul class="select-one j-get-one m-top10">
										<?php if($spec['is_checked'] > 0) { ?>
										<!-- pc有属性图片 -->
										<?php $n=1;if(is_array($spec['values'])) foreach($spec['values'] as $key=>$val) { ?>
										<a class="ect-select dis-flex fl" href="javascript:;" <?php if($val['img_site']) { ?>onclick="location.href='<?php echo $val['img_site']; ?>'"<?php } ?>>
										<label class="ts-1 <?php if($val['checked'] == 1) { ?>active<?php } ?>" for="spec_value_<?php echo $val['id']; ?>"><?php echo $val['label']; ?></label>
										<input style="display:none" id="spec_value_<?php echo $val['id']; ?>" type="radio" name="spec_<?php echo $spec_key; ?>" value="<?php echo $val['id']; ?>" <?php if($val['checked'] == 1) { ?>checked<?php } ?> onclick="changePrice()" />
										</a>
										<?php $n++;}unset($n); ?>
										<?php } else { ?>
										<!-- pc没属性图片 -->
										<?php $n=1;if(is_array($spec['values'])) foreach($spec['values'] as $key=>$val) { ?>
										<a class="ect-select dis-flex fl" href="javascript:;" <?php if($val['img_site']) { ?>onclick="location.href='<?php echo $val['img_site']; ?>'"<?php } ?>>
										<label class="ts-1 <?php if($key == 0) { ?>active<?php } ?>" for="spec_value_<?php echo $val['id']; ?>"><?php echo $val['label']; ?></label>
										<input style="display:none" id="spec_value_<?php echo $val['id']; ?>" type="radio" name="spec_<?php echo $spec_key; ?>" value="<?php echo $val['id']; ?>" <?php if($key == 0) { ?>checked<?php } ?> onclick="changePrice()" />
										</a>
										<?php $n++;}unset($n); ?>
										<?php } ?>
									</ul>
									<input type="hidden" name="spec_list" value="<?php echo $key; ?>" />

									<?php } else { ?>
									<ul class="select-one j-get-one m-top10">
										<?php $n=1;if(is_array($spec['values'])) foreach($spec['values'] as $key=>$val) { ?>
										<li class="ect-select dis-flex fl">
											<label class="ts-1 <?php if($key == 0) { ?>active<?php } ?>" for="spec_value_<?php echo $val['id']; ?>"><?php echo $val['label']; ?></label>
											<input type="checkbox" name="spec_<?php echo $spec_key; ?>[]" value="<?php echo $val['id']; ?>" id="spec_value_<?php echo $val['id']; ?>" onclick="changePrice()" <?php if($select_key == 0) { ?>checked<?php } ?> style="display:none" />
										</li>
										<?php $n++;}unset($n); ?>
									</ul>
									<?php } ?>
									<?php } ?>
									<?php $n++;}unset($n); ?>
									<!-- 普通商品可修改数量 -->
									<h4 class="t-remark">数量</h4>
									<?php if($goods['goods_id'] > 0 && $goods['is_gift'] == 0 && $goods['parent_id'] == 0) { ?>
									<div class="div-num dis-box m-top08">
										<a class="num-less" onClick="changePrice('1')"></a>
										<input class="box-flex" type="text" value="1" onblur="changePrice('2')" name="number" id="goods_number" />
										<a class="num-plus" onClick="changePrice('3')"></a>
									</div>
									<?php } else { ?>
									<div class="div-num dis-box m-top08 div-num-disabled">
										<a class="num-less"></a>
										<input class="box-flex" type="text" value="<?php echo $goods['goods_number']; ?>" name="number"/>
										<a class="num-plus"></a>
									</div>
									<?php } ?>
								</div>
							</div>
							<div class="swiper-scrollbar"></div>
						</section>
						<section class="ect-button-more dis-box padding-all">
							<input type="hidden" value="<?php echo $province_row['region_id']; ?>" id="province_id" name="province_region_id">
							<input type="hidden" value="<?php echo $city_row['region_id']; ?>" id="city_id" name="city_region_id">
							<input type="hidden" value="<?php if($district_row['region_id']) { ?><?php echo $district_row['region_id']; ?><?php } else { ?>0<?php } ?>"
								   id="district_id" name="district_region_id">
							<input type="hidden" value="<?php echo $region_id; ?>" id="region_id" name="region_id">
							<input type="hidden" value="<?php echo $warehouse_id; ?>" id="warehouse_id" name="warehouse_id">
							<input type="hidden" value="<?php echo $goods_id; ?>" id="good_id" name="good_id">
							<input type="hidden" value="<?php echo $user_id; ?>" id="user_id" name="user_id">
							<input type="hidden" value="<?php echo $area_id; ?>" id="area_id" name="area_id">
							<input type="hidden" value="<?php echo $group_buy_id; ?>" id="group_buy_id" name="group_buy_id">
							<a class="btn-disab box-flex quehuo" href="javascript:void(0);" <?php if($goods['is_end'] != 1) { ?>style="display:none"<?php } ?>>团购结束</a>
							<button type="sumbit" class="btn-submit box-flex add-to-cart" <?php if($goods['is_end'] == 1) { ?>style="display:none"<?php } ?>>立刻团</button>
						</section>
					</div>
					<!--商品属性弹出层end-->
				</section>
				<section class="m-top1px padding-all b-color-f goods-service j-show-div">
					<div class="dis-box">
						<label class="t-remark g-t-temark">服务</label>
						<div class="box-flex">
							<div class="dis-box">
								<p class="box-flex t-goods1"><?php if($goods['user_id'] > 0) { ?>
									由<?php echo $goods['rz_shopName']; ?>发货并提供售后服务。
									<?php } else { ?>
									由<?php echo $basic_info['shop_name']; ?>发货并提供售后服务。
									<?php } ?></p>
								<i class="iconfont icon-102 goods-min-icon"></i>
								<!--服务信息star-->
								<div class="show-goods-service j-filter-show-div ts-3 b-color-1">
									<section class="goods-show-title of-hidden padding-all b-color-f">
										<h3 class="fl g-c-title-h3">服务说明</h3>
										<i class="iconfont icon-guanbi2 show-div-guanbi fr"></i>
									</section>
									<section class="goods-show-con goods-big-service swiper-scroll">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<ul>
													<li class="m-top1px b-color-f padding-all of-hidden">
														<p class="dis-box t-remark3">
															<em class="em-promotion"><i
																	class="iconfont icon-daifukuan"></i></em>
															<span class="box-flex">货到付款</span>
														</p>
														<p class="g-b-s-con m-top08">支持送货上门后再收款，支持现金、POS机刷卡等方式</p>
													</li>
													<li class="m-top1px b-color-f padding-all of-hidden">
														<p class="dis-box t-remark3">
															<em class="em-promotion"><i
																	class="iconfont icon-7tianwuliyoutuihuo"></i></em>
															<span class="box-flex">7天退货</span>
														</p>
														<p class="g-b-s-con m-top08">自实际收货日期的次日起7天内，商品完好，可进行无理由退换货</p>
													</li>
													<li class="m-top1px b-color-f padding-all of-hidden">
														<p class="dis-box t-remark3">
															<em class="em-promotion"><i
																	class="iconfont icon-tixingnaozhong"></i></em>
															<span class="box-flex">极速达</span>
														</p>
														<p class="g-b-s-con m-top08">上午下单，下午送达</p>
													</li>
												</ul>
											</div>
										</div>

									</section>
								</div>
								<!--服务信息end-->
							</div>
							<div class="dis-box m-top08 g-r-rule">
								<p class="box-flex t-remark3">
									<em class="fl em-promotion"><i class="iconfont icon-daifukuan"></i></em><span class="fl">货到付款</span>
								</p>
								<p class="box-flex t-remark3">
									<em class="fl em-promotion"><i class="iconfont icon-7tianwuliyoutuihuo"></i></em><span
										class="fl">7天退货</span></p>
								<p class="box-flex t-remark3">
									<em class="fl em-promotion"><i class="iconfont icon-tixingnaozhong"></i></em><span
										class="fl">极速达</span></p>
							</div>
						</div>
					</div>
				</section>
				<section class="m-top1px padding-all b-color-f goods-promotion">
					<a href="<?php echo U('goods/index/info', array('id'=>$goods['goods_id']));?>">
					<div class="dis-box">
						<label class="t-remark g-t-temark">查看商品详情</label>
						<div class="box-flex"></div>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180"></i></span>
					</div>
					</a>
				</section>
				<section class="m-top04 goods-evaluation">
					<a href="<?php echo U('goods/index/comment', array('id'=>$goods['goods_id']));?>">
						<div class="dis-box padding-all b-color-f  g-evaluation-title">
							<label class="t-remark g-t-temark">用户评价</label>
							<div class="box-flex t-goods1">好评率 <em class="t-first"><?php echo $comment_all['goodReview']; ?>%</em></div>
							<div class="t-goods1"><em class="t-first"><?php echo $comment_all['allmen']; ?></em><span class="t-jiantou">人评论<i class="iconfont icon-jiantou tf-180"></i></span></div>
						</div>
					</a>
					<?php if($good_comment) { ?>
					<div class="padding-all m-top1px b-color-f g-evaluation-con">
						<div class="of-hidden evaluation-list">
							<div class="of-hidden ">
								<p class="fl"><span class="grade-star g-star-5 fl"></span><em class="t-remark fl"><?php echo $good_comment['0']['username']; ?></em>
								</p>
								<p class="fr t-remark"><?php echo $good_comment['0']['add_time']; ?></p>
							</div>
							<p class="clear m-top10 t-goods1"><?php echo $good_comment['0']['content']; ?></p>
							<?php if($good_comment['0']['goods']) { ?>
							<p class="clear m-top08 t-remark"><?php echo $good_comment[0]['goods'][0]['goods_attr']; ?></p>
							<?php } ?>
							<div class="ect-button-more m-top10 dis-box">
								<a href="<?php echo U('goods/index/infoimg', array('id'=>$goods['goods_id']));?>" class="box-flex btn-default">有图评价</a>
								<a href="<?php echo U('goods/index/comment', array('id'=>$goods['goods_id']));?>" class="box-flex btn-default">全部评价</a>
							</div>
						</div>
					</div>
					<?php } ?>
				</section>
				<section class="m-top04 padding-all goods-shop  b-color-f">
					<?php if($goods['user_id']) { ?>
					<div class="goods-shop-info">
						<a href="<?php echo $goods['store_url']; ?>" class="link-abs"></a>
						<section class="dis-box">
							<div class="g-s-i-img"><img src="<?php echo $goods['shopinfo']['logo_thumb']; ?>"/></div>
							<div class="g-s-i-title box-flex">
								<h3 class="ellipsis-one"><?php echo $goods['rz_shopName']; ?></h3>
								<p class="t-remark m-top04">已经有 <?php echo $collect_number; ?> 人关注</p>
							</div>
						</section>
						<section class="dis-box goods-shop-score m-top12">
							<p class="box-flex">
								<label class="fl">商品</label><span class="t-first margin-lr fl"><?php echo $merch_cmt['cmt']['commentRank']['zconments']['score']; ?>分</span><em
									class="em-promotion fl"><?php echo $merch_cmt['cmt']['commentRank']['zconments']['goodReview']; ?></em>
							</p>
							<p class="box-flex">
								<label class="fl">服务</label><span class="t-low margin-lr fl"><?php echo $merch_cmt['cmt']['commentServer']['zconments']['score']; ?>分</span><em
									class="em-promotion em-p-low fl"><?php echo $merch_cmt['cmt']['commentServer']['zconments']['goodReview']; ?></em>
							</p>
							<p class="box-flex">
								<label class="fl">时效</label><span class="t-center margin-lr fl"><?php echo $merch_cmt['cmt']['commentDelivery']['zconments']['score']; ?>分</span><em
									class="em-promotion em-p-center fl"><?php echo $merch_cmt['cmt']['commentDelivery']['zconments']['goodReview']; ?></em>
							</p>
						</section>
					</div>
					<?php } ?>
					<?php if($merchant_group_goods) { ?>
					<div class="goods-shop-pic of-hidden">
						<h4 class="title-hrbg m-top06"><span>该商铺的其他团购</span>
							<hr>
						</h4>
						<div class="g-s-p-con product-one-list of-hidden scrollbar-none j-g-s-p-con">
							<div class="swiper-wrapper ">
								<?php $n=1;if(is_array($merchant_group_goods)) foreach($merchant_group_goods as $k=>$v) { ?>
								<li class="swiper-slide">
									<div class="product-div">
										<a href="<?php echo U('groupbuy/index/detail',array('id'=>$v['act_id']));?>"><img class="product-list-img" src="<?php echo $v['goods_thumb']; ?>"/></a>
										<div class="product-text m-top06">
											<a href="<?php echo U('groupbuy/index/detail',array('id'=>$v['act_id']));?>"><h4><?php echo $v['act_name']; ?></h4></a>
											<p><span class="p-price t-first ">
                                                <?php if($v['promote_price']) { ?>
                                                <?php echo $v['promote_price']; ?>
                                                <?php } else { ?>
                                                <?php echo $v['shop_price']; ?>
                                                <?php } ?>
                                            </span>
											</p>
										</div>
									</div>
								</li>
								<?php $n++;}unset($n); ?>
							</div>
						</div>
					</div>
					<?php } ?>
				   <div class="ect-button-more m-top10 dis-box goods-shop-btn">
                        <?php if(isset($basic_info['kf_appkey']) && !empty($basic_info['kf_appkey'])) { ?>
                            <a class="box-flex btn-default" href="<?php echo U('chat/index/index', array('goods_id'=> $goods['goods_id']));?>"><i class="iconfont icon-kefu t-first"></i>联系客服</a>
                        <?php } elseif (isset($basic_info['meiqia']) && !empty($basic_info['meiqia'])) { ?>
                            <a class="box-flex btn-default" href="https://static.meiqia.com/dist/standalone.html?eid=<?php echo $basic_info['meiqia']; ?>"><i class="iconfont icon-kefu t-first"></i>联系客服</a>
                        <?php } else { ?>
                            <?php if($basic_info['kf_type']) { ?>
                            <a class="box-flex btn-default" href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $basic_info['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8"><i class="iconfont icon-kefu t-first"></i>联系客服</a>
                            <?php } else { ?>
                            <a class="box-flex btn-default" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $basic_info['kf_qq']; ?>&site=qq&menu=yes"><i class="iconfont icon-kefu t-first"></i>联系客服</a>
                            <?php } ?>
                            <?php if($goods['user_id']) { ?>
                            <a class="box-flex btn-default" href="<?php echo $goods['store_url']; ?>"><i class="iconfont icon-dianpu t-two"></i>进入店铺</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
				</section>

			</div>

			<!--悬浮btn star-->
			<section class="filter-btn dis-box">
				      <?php if(isset($basic_info['kf_appkey']) && !empty($basic_info['kf_appkey'])) { ?>
                    <a class="filter-btn-kefu filter-btn-a" href="<?php echo U('chat/index/index', array('goods_id'=> $goods['goods_id']));?>"><i class="iconfont icon-kefu"></i><em>客服</em></a>
                <?php } elseif (isset($basic_info['meiqia']) && !empty($basic_info['meiqia'])) { ?>
                    <a class="filter-btn-kefu filter-btn-a" href="https://static.meiqia.com/dist/standalone.html?eid=<?php echo $basic_info['meiqia']; ?>"><i class="iconfont icon-kefu"></i><em>客服</em></a>
                <?php } else { ?>
                    <?php if($basic_info['kf_type']) { ?>
                    <a class="filter-btn-kefu filter-btn-a" href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $basic_info['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8"><i class="iconfont icon-kefu"></i><em>客服</em></a>
                    <?php } else { ?>
                    <a class="filter-btn-kefu filter-btn-a" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $basic_info['kf_qq']; ?>&site=qq&menu=yes"><i class="iconfont icon-kefu"></i><em>客服</em></a>
                    <?php } ?>
                <?php } ?>
				<a class="filter-btn-shop filter-btn-a"><i class="iconfont icon-dianpu"></i><em>店铺</em></a>
				<a class="btn-disab box-flex quehuo" href="javascript:void(0);" <?php if($goods['is_end'] != 1) { ?>style="display:none"<?php } ?>>团购结束</a>
				<button type="sumbit" class="btn-submit box-flex add-to-cart" <?php if($goods['is_end'] == 1) { ?>style="display:none"<?php } ?>>立即团</button>
				<!--<a class="btn-submit box-flex">立即团购</a>-->
			</section>
			<!--悬浮btn end-->
	</form>
</div>

		<script>
			/*商品详情相册切换*/
			var swiper = new Swiper('.goods-photo', {
				paginationClickable: true,
				onInit: function(swiper) {
					document.getElementById("g-active-num").innerHTML = swiper.activeIndex + 1;
					document.getElementById("g-all-num").innerHTML = swiper.slides.length;
				},
				onSlideChangeStart: function(swiper) {
					document.getElementById("g-active-num").innerHTML = swiper.activeIndex + 1;
				}
			});
			/*店铺信息商品滚动*/
			var swiper = new Swiper('.j-g-s-p-con', {
				scrollbarHide: true,
				slidesPerView: 'auto',
				centeredSlides: false,
				grabCursor: true
			});
			$(function(){
				changePrice();
				//商品详情属性弹出层
				$(".click-show-attr").click(function(){
					$(".show-goods-attr").addClass("show");
					$(".mask-filter-div").addClass("show");
				});
			})
			/**
			 * 点选可选属性或改变数量时修改商品价格的函数
			 */
			function changePrice(type)
			{
				var max_number = <?php if($xiangou == 1) { ?><?php if($goods['is_xiangou']==1 && $goods['xiangou_num'] > 0) { ?><?php echo $goods['xiangou_num']; ?><?php } else { ?>-1<?php } ?><?php } else { ?>-1<?php } ?>;
				var min_number = 1;
				var qty = $("#goods_number").val();
				if(type == 1){
					if(qty >= min_number){
						qty--;
					}
				}
				if(type == 3){
					if(max_number == -1){
						max_number = $(".goods_attr_num").html() ? parseInt($(".goods_attr_num").html()) : 1;
					}
					if(qty <= max_number){
						qty++;
					}
				}
				if(qty <=0 ){ qty=1; }
				if(!/^[0-9]*$/.test(qty)){ qty = 1 }
				var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);

				//ecmoban模板堂 --zhuo start 限购
				<?php if($xiangou == 1) { ?>
				<?php if($goods['is_xiangou'] == 1 && $goods['xiangou_num'] > 0) { ?>
				var xiangou_num = <?php echo $goods['xiangou_num']; ?>;
				var xiangou = <?php echo $xiangou; ?>;
				if(qty > xiangou_num && xiangou_num > 0 && xiangou == 1){
					d_messages('不能超过限购数量');
					return false;
				}
				<?php } ?>
				<?php } ?>
				var warehouse = <?php if($region_id) { ?><?php echo $region_id; ?><?php } else { ?>0<?php } ?>;
				var area = <?php if($area_id) { ?><?php echo $area_id; ?><?php } else { ?>0<?php } ?>;
				$.get('<?php echo U("price");?>', {'id':<?php echo $goods_id; ?>, 'attr':attr, 'number':qty, 'warehouse_id':warehouse, 'area_id':area}, function(data){
					changePriceResponse(data);
				}, 'json');
			}

			/**
			 * 接收返回的信息
			 */
			function changePriceResponse(res){
				if (res.err_msg.length > 0){
					d_messages(res.err_msg);
				} else {
					//属性图片
					if(res.attr_img) {
						$(".s-g-attr-title .product-list-img").attr('src',res.attr_img);
					}
					//用户可购买的数量
					$("#goods_number").val(res.qty);
					//更改数量的同时显示
					var get_text = '';
					s_get_label = $(".show-goods-attr .s-g-attr-con").find("label.active"); //获取被选中label
					if(s_get_label.length > 0){
						s_get_label.each(function() {
							get_text += $(this).text() + "、";
						});
					}
					var goods_number = $("#goods_number").val();
					goods_number = parseInt(goods_number) ? parseInt(goods_number) : 1;
					get_text = get_text + goods_number + "个";
					$(".j-goods-attr").find(".t-goods1").text(get_text);
					if ($(".goods_attr_num").length > 0){
						$(".goods_attr_num").html(res.attr_number);
					}
					if(res.err_no == 2){
						d_messages("该地区暂不支持配送");
					}
					else{
						if(res.attr_number <= 0){
							$(".add-to-cart").hide();
							$(".quehuo").show().text("已抢完");
						}
						else{
							<?php if($goods['is_end'] != 1) { ?>
							$(".add-to-cart").show();
							$(".quehuo").hide();
							<?php } ?>
						}
					}
					//总价
					if ($("#ECS_GOODS_AMOUNT").length > 0){
						$("#ECS_GOODS_AMOUNT").html(res.result);
					}
					if($("#ECS_SHOPPRICE").length > 0){
						$("#ECS_SHOPPRICE").html(res.shop_price);
					}
					if($("#ECS_DISCOUNT").length > 0){
						$("#ECS_DISCOUNT").html(res.discount);
					}
				}
			}
			function get_groupbuy(){
				var qty = $("#goods_number").val();
				var number = Number($('.goods_attr_num').html()); //库存
				var restrict_amount = Number(<?php echo $group_buy['restrict_amount']; ?>); //限购数量

				if(restrict_amount > 0 && restrict_amount < qty){
					var message = "您最多可团购" + restrict_amount + "件商品!";
					d_messages(message);
					return false;
				}

				if(qty > number){
					var message = "库存不足，您最多可团购" + number + "件商品!";
					d_messages(message);
					return false;
				}
			}
			 /*团购详情倒计时*/
			$.extend($.fn,{
				fnTimeCountDown:function(d){
					this.each(function(){
						var $this = $(this);
						var o = {
							sec: $this['find'](".sec"),
							mini: $this['find'](".mini"),
							hour: $this['find'](".hour"),
							day: $this['find'](".day")
						};
						var f = {
							haomiao: function(n){
								if(n < 10)return "00" + n.toString();
								if(n < 100)return "0" + n.toString();
								return n.toString();
							},
							zero: function(n){
								var _n = parseInt(n, 10);//解析字符串,返回整数
								if(_n > 0){
									if(_n <= 9){
										_n = "0" + _n
									}
									return String(_n);
								}else{
									return "00";
								}
							},
							dv: function(){
								d = d || Date.UTC(2050, 0, 1); //如果未定义时间，则我们设定倒计时日期是2050年1月1日
								var _d = $this['data']("end") || d;
								var now = new Date(),
										endDate = new Date(_d.replace(/-/g, "/"));
								//现在将来秒差值
								//alert(future.getTimezoneOffset());
								var dur = (endDate - now.getTime()) / 1000 , mss = endDate - now.getTime() ,pms = {
									sec: "00",
									mini: "00",
									hour: "00",
									day: "00",
								};
								if(mss > 0){
									pms.sec = f.zero(dur % 60);
									pms.mini = Math.floor((dur / 60)) > 0? f.zero(Math.floor((dur / 60)) % 60) : "00";
									pms.hour = Math.floor((dur / 3600)) > 0? f.zero(Math.floor((dur / 3600)) % 24) : "00";
									pms.day = Math.floor((dur / 86400)) > 0? f.zero(Math.floor((dur / 86400))) : "00";

								}else{
									pms.day=pms.hour=pms.mini=pms.sec="00";
									$(".btn-submit").remove();
									$(".btn-disab").css('display','block');
								}
								return pms;
							},
							ui: function(){
								if(o.sec){
									o.sec.html(f.dv().sec);
								}
								if(o.mini){
									o.mini.html(f.dv().mini);
								}
								if(o.hour){
									o.hour.html(f.dv().hour);
								}
								if(o.day){
									o.day.html(f.dv().day);
								}
								setTimeout(f.ui, 1);
							}
						};
						f.ui();
					});
				}
			});
		</script>
		<script type="text/javascript">
			$("#fnTimeCountDown").fnTimeCountDown("<?php echo $group_buy['formated_end_date']; ?>");
		</script>
<?php $__Template->display($this->getTpl("page_footer")); ?>";s:12:"compile_time";i:1478079628;}";