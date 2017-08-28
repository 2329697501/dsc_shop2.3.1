<?php exit;?>0014798233259bfd1284428857c117f654d4a954bf47s:10844:"a:2:{s:8:"template";s:10779:"<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<meta charset="utf-8">
		<title><?php echo $page_title; ?></title>

		<link href="css/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" />
		<!--字体图标库-->
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/fonts/iconfont.css">
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/css/swiper-3.2.5.min.css" />
		<!--主样式-->
		<link rel="stylesheet" href="<?php echo __TPL__;?>crowd/css/ectouch.css" />

	</head>

	<body>
		<div class="con m-b7">
			<div class="category">
				<div class="category-header-box active">
				<section class="search">
					<div class="text-all dis-box j-text-all text-all-back">
						<div class="box-flex input-text n-input-text i-search-input">
							<a class="a-search-input j-search-input" href="javascript:void(0)"></a>
							<i class="iconfont icon-sousuo"></i>
							<input class="j-input-text" type="text" placeholder="项目搜索" />
							<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
						</div>

					</div>
				</section>
				<section>
					<ul class="raise-cate-nav dis-box">
						<li class="box-flex" class="current">综合排序<i class="iconfont icon-xiajiantou"></i></li>
						<li class="box-flex">全部商品<i class="iconfont icon-xiajiantou"></i></li>
						<a class="a-sequence j-a-sequence"><i class="iconfont icon-pailie" data="1"></i></a>
					</ul>
					<div class="raise-content">
						<ul class="raise-list-box">

							<div class="catalog-nav-box select-one j-all-raise">
								<div class="j-get-one padding-all of-hidden">
								
									<li class="ect-select w-3 rsise-nav">
										<a href="<?php echo U('index',array('type'=>''));?>">
										<label class="ts-1 <?php if($type == '') { ?>active<?php } ?>">综合排序</label>
										</a>
									</li>
									<li class="ect-select w-3 rsise-nav">
										<a href="<?php echo U('index',array('type'=>'new','c_id'=> $id));?>">
										<label class="ts-1 <?php if($type == 'new') { ?>active<?php } ?>">最新上线</label>
										</a>
									</li>
									<li class="ect-select w-3 rsise-nav">
										<a href="<?php echo U('index',array('type'=>'amount','c_id'=> $id));?>">
										<label class="ts-1 <?php if($type == 'amount') { ?>active<?php } ?>">金额最多</label>
										</a>
									</li>
									<li class="ect-select w-3  rsise-nav">
										<a href="<?php echo U('index',array('type'=>'join_num','c_id'=> $id));?>">
										<label class="ts-1 <?php if($type == 'join_num') { ?>active<?php } ?>">支持最多</label>
										</a>
									</li>									
								</div>
								<div class="ect-button-more raise-button dis-box">
									<i class="iconfont icon-Collapse j-text-all"></i>			
								</div>
							</div>

						</ul>
						<ul class="raise-list-box">
							<div class="catalog-nav-box select-one j-cate-raise">
								<div class="j-get-one padding-all of-hidden">
									<li class="ect-select w-3 rsise-nav">
										<a href="<?php echo U('index',array('c_id'=>0));?>">
										<label class="ts-1 <?php if($id == 0) { ?>active<?php } ?>">全部商品</label>
										</a>
									</li>
									<?php $n=1;if(is_array($category)) foreach($category as $vo) { ?>
									<li class="ect-select w-3 rsise-nav">
									<a href="<?php echo U('index',array('c_id'=> $vo['id'],'type'=> $vo['type']));?>">
										<label class="ts-1 <?php if($id == $vo['id']) { ?>active<?php } ?>"><?php echo $vo['name']; ?></label>
									</a>
									</li>
									<?php $n++;}unset($n); ?>
								</div>
								<div class="ect-button-more raise-button dis-box">
									<i class="iconfont icon-Collapse j-text-all"></i>			
								</div>
							</div>
						</ul>
					</div>
				</section>
				</div>

				<section class="product-list j-product-list product-list-medium" data="1">
				<script id="j-product" type="text/html">
					<%if totalPage > 0 %>
					<ul>					
						<%each list as goods%>
						<li>
							<div class="product-div position-rel">
								<a class="product-div-link" href="<%goods.url%>"></a>
								<img class="product-list-img" src="<%goods.title_img%>" />
								<div class="product-text raise-category">
									<h4><%goods.title%></h4>
									<p class="col-9 f-03 raise-category-num">支持人数<em class="color-red"><%goods.join_num%></em><em class="col-9 f-02">人</em><em class="fr col-9"><i class="iconfont icon-shijian f-02"></i> 剩余时间：<%goods.shenyu_time%>天</em></p>
									<div class="raise-progressBar dis-box">
										<p class="wrap box-flex">
											<span class="bar" style="width:<%goods.baifen_bi%>%;"><i class="color"></i></span>
										</p>
										<p class="txt"><%goods.baifen_bi%> %</p>
									</div>
									<ul class="index-n-box of-hidden">
										<li class="col-9 f-03 onelist-hidden">已筹：<em class="color-red mr-small"><%#goods.join_money%> </em></li>
										<li class="col-9 f-03 onelist-hidden"><em class="col-9 m-l-05">目标：<em class="color-red"><%#goods.amount%></em></em></li>									
									</ul>
								</div>
								<div class="raise-cate-tag"><i class="iconfont icon-geren"></i><%goods.join_num%></div>
							</div>
						</li>				
						<%/each%>
					</ul>					
					 <% else %>
                    <div class="no-div-message">
                        <i class="iconfont icon-biaoqingleiben"></i>
                        <p>亲，此处没有内容～！</p>
                    </div>
                    <% /if %>
				</script>
				</section>
			</div>
			
		</div>
		<div class="search-div j-search-div ts-3">
			<section class="search raise-search">
			<form action="<?php echo U('index');?>" method="post">
				<div class="text-all dis-box j-text-all">
				
					<div class="box-flex input-text">
						<input class="j-input-text" id="keywordBox" name="keywords" type="text" placeholder="项目搜索" />
						<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
					</div>
					<a type="button" onclick="return check('keywordBox')"  class="btn-submit">搜索</a>
				</div>
			</form>
			</section>
			<section class="search-con">
				<div class="swiper-scroll history-search">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							
							<p class="hos-search">
								<label class="fl">最近搜索</label>
								<span class="fr" onclick="javascript:clearHistroy();"><i class="iconfont icon-xiao10 j-detail-close"></i></span>
							</p>

							<ul class="hot-search a-text-more a-text-one raise-search-cont">
								<?php $n=1;if(is_array($zcsearch_histroy)) foreach($zcsearch_histroy as $key=>$keyword) { ?>
								<li>
									<a href="<?php echo U('index', array('keywords'=>$keyword));?>"><span><?php echo $keyword; ?></span></a>
								</li>
								<?php $n++;}unset($n); ?>
								
							</ul>
						</div>
					</div>
					<div class="swiper-scrollbar"></div>
				</div>
			</section>
			<footer class="close-search j-close-search">
				点击关闭
			</footer>
		</div>

		<!--商品属性弹出层end-->
		<div class="div-messages"></div>
		<div class="raise-bg-box ts-3 active"></div>
		<!--悬浮菜单e-->
		
			<!--悬浮菜单s-->
	<div class="filter-top" id="scrollUp">
		<i class="iconfont icon-jiantou"></i>
	</div>

	<footer class="footer-nav dis-box">
		<a href="<?php echo U('site/index/index');?>" class="box-flex nav-list">
			<i class="nav-box i-home"></i><span>首页</span>
		</a>
		<a href="<?php echo U('crowd_funding/index/index');?>" class="box-flex nav-list active">
			<i class="nav-box i-zhongchou"></i><span>微筹广场</span>
		</a>
		<a href="<?php echo U('user/crowd/order');?>" class="box-flex position-rel nav-list">
			<i class="nav-box i-zhongchou-order"></i><span>微筹订单</span>
		</a>

		<a href="<?php echo U('user/crowd/index');?>" class="box-flex nav-list">
			<i class="nav-box i-zhongchou_user"></i><span>微筹中心</span>
		</a>
	</footer>
	<!--悬浮菜单e-->
		

		<!--引用js-->
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/swiper-3.2.5.min.js"></script>
		<script type="text/javascript" src="<?php echo __TPL__;?>crowd/js/ectouch.js"></script>
		<!--异步引用js-->
		<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/jquery.infinite.js"></script>
		<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/template.js"></script>
		<script type="text/javascript">
		$(function($) {
				$(".j-detail-close").click(function(){
					$(".raise-search-cont").addClass("active");
				})
				//nav
				window.onload = function() {
					var $li = $('.raise-cate-nav li');
					var $ul = $('.raise-content ul');

					$li['click'](function() {
						var $this = $(this);
						var $t = $this['index']();
						$li['removeClass']();
						$this['addClass']('current');
						$ul['css']('display', 'none');
						$ul['eq']($t).css('display', 'block');
					})
				}
				$(".j-text-all,.raise-bg-box").click(function() {
					$(".raise-content").addClass("active");
					$(".raise-bg-box").addClass("active");
					$(".category-header-box").addClass("active");
				});
				$(".raise-cate-nav li").click(function() {
					$(".raise-content").removeClass("active");
					$(".raise-bg-box").removeClass("active");
					$(".category-header-box").removeClass("active");
				});
			});
			/* 搜索验证 */
			function check(Id) {
				var strings = document.getElementById(Id).value;
				if(strings.replace(/(^\s*)|(\s*$)/g, "").length == 0) {
					alert('请输入搜索内容');
					return false;
				}
				$("form").submit();
				return true;
			}
			
			/* 清空搜索记录 */
			function clearHistroy(){
				$.get('<?php echo U("clearhistory");?>', {
				}, function(data) {
					if(data.status ==0){
						alert('删除失败')
					}else{
						
					}
				}, 'json');				
			}
			
			//异步数据
            $(function(){
                var url = "<?php echo U('index', array('c_id'=>$id, 'page'=>$page, 'type'=>$type, 'keywords'=>$keywords));?>";
                $('.product-list').infinite({url: url, template:'j-product'});
            })
		</script>
	</body>

</html>";s:12:"compile_time";i:1479736925;}";