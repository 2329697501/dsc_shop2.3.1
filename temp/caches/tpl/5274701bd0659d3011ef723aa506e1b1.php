<?php exit;?>001479745741a4c1cc0ef37c2700ac30ca9396d3e7e5s:6205:"a:2:{s:8:"template";s:6141:"<?php $__Template->display($this->getTpl("page_header")); ?>
				<div class="con mb-7">
			<section class="search article-search">
				<div class="text-all dis-box j-text-all text-all-back">

					<div class="box-flex input-text new-group">
						<div class="box-flex">
							<input class="j-input-text" name="infokeyword" type="text" placeholder="搜索关键词" />
							<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
						</div>
					</div>
					<a type="button" class="btn-submit"><i class="iconfont icon-sousuo my-sousou"></i></a>
				</div>
			</section>
					<div class="shopping-list j-shopping-list">
						<div class="shopping-menu j-shopping-menu">
							<div class="dis-box b-color-f">
									<nav style="cursor: grab;" class="shopping-list-nav article-list-nav box-flex">
									<ul class="swiper-wrapper">
										<?php $n=1;if(is_array($data)) foreach($data as $dat) { ?>
										<li class="div<?php echo $dat['cat_id']; ?> swiper-slide article-li-select" category="<?php echo $dat['cat_id']; ?>"><?php echo $dat['cat_name']; ?></li>
										<?php $n++;}unset($n); ?>
									</ul>
								</nav>
								<div class="shopping-nav-select j-s-nav-select"><i class="iconfont icon-jiantou"></i></div>
							</div>
							<div class="shopping-abs shopping-new-con swiper-scroll">
								<div class="swiper-scroll">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<?php $n=1;if(is_array($data)) foreach($data as $da) { ?>
										<li class="div<?php echo $da['cat_id']; ?>" category="<?php echo $da['cat_id']; ?>"><?php echo $da['cat_name']; ?></li>
										<?php $n++;}unset($n); ?>
									</div>
								</div>
								<div class="swiper-scrollbar"></div>
                                                                </div>
							</div>
						</div>
					</div>
			<!--文章start-->
			<div class="article_info">
			<script id="j-product" type="text/html">
				<%if totalPage > 0%>
			<%each article_index_new as ain%>
			
					<section class="b-color-f m-top08 article-list">
						<a href="<%ain.url%>">
							<div class="art-tit-box padding-all">
								<h4 class="com-cont-box art-cont-box"><%ain.title%></h4>
								<%if ain.first_img%>
								<div class="art-img-box"><img src="<%ain.first_img%>"></div>
								<%/if%>
								<small><time><%ain.add_time%></time><span><%ain.author%></span></small>
							</div>
						</a>
						<!--caidan-->
						<div class="user-nav-box  com-list dis-box text-center  b-color-f">
							<div class="oncle-color-1 box-flex">
								<a href="javascript:;" id="red<%ain.article_id%>" <%if ain.islike == 1%> class="active"<%else%><%/if%>>
									<div class="com-icon" onClick="change_like_number(<%ain.article_id%>)">
										<i class="iconfont icon-zan"></i>
										<span id="like_num<%ain.article_id%>"><%if ain.like%><%ain.like%><%else%>0<%/if%></span>
										<input id="like<%ain.article_id%>" type="hidden" name="article_id" value="<%ain.article_id%>" />
										<input id="islike<%ain.article_id%>"  type="hidden" id="<%ain.article_id%>" name="islike" value="<%ain.islike%>" />
										<input id="isclick" type="hidden"  name="isclick" value="0" />
									</div>
								</a>
							</div>
							<div class="box-flex">
								<a href="<%ain.url%>">
									<div class="com-icon"><i class="iconfont icon-daipingjia"></i><span><%ain.comment_count%></span></div>
								</a>
							</div>
							<div class="box-flex">
								<a href="javascript:;">
									<div class="com-icon"><i class="iconfont icon-liulan"></i><span><%ain.views%></span></div>
								</a>
							</div>
						</div>
					</section>
			<%/each%>
			<% else %>
			<div class="no-div-message">
				<i class="iconfont icon-biaoqingleiben"></i>
				<p>亲，此处没有文章～！</p>
			</div>
			<%/if%>
			</script>
			</div>
			<!-- 文章end -->
		</div>
					<div class="mask-filter-div"></div>
	</div>
	</body>


	<script>
		function change_like_number(id) {
			if($("#red" + id).hasClass("active")){
				$("#red" + id).removeClass("active");
			}else{
				$("#red" + id).addClass("active");
			}
			var isclick = document.getElementById('isclick').value;
			$("#isclick").val(new Date().getTime());
			if(isclick < (new Date().getTime()-1000)) {
				$.ajax({
					type: "post",
					url: "<?php echo U('article/index/like');?>",
					data: {article_id: id},
					dataType: "json",
					success: function (data) {
						$("#like_num" + id).html(data.like_num);
						$("#islike" + id).val(data.is_like);
					}
				});
			}

		}
	</script>
<script>
	var url = 'index.php?r=article/index/index';
	var infinite = $('.article_info').infinite({url: url, template: 'j-product'});
	var swiper_nav = new Swiper('.shopping-list-nav', {
		scrollbarHide: true,
		slidesPerView: 'auto',
		centeredSlides: false,
		grabCursor: true
	});
	//搜索
	$(".btn-submit").click(function (){
		keyword = $("input[name=infokeyword]").val();
		if (keyword ||typeof(keyword) == "undefined")
		{
			infinite.onload('keyword='+keyword);
		}else{
			d_messages('请输入搜索关键字');
		}
	})

	$('.shopping-list-nav li').on('click', function(e) {
		var category = $(this).attr('category');
		var index = $(".shopping-list-nav li").index(this);
		$(this).siblings().removeClass("active");
		$('.shopping-abs .swiper-slide li').removeClass("active");

		$(".div"+category).addClass("active");

		swiper_nav.slideTo(index, 1000, false);//切换到第一个slide，速度为1秒
		infinite.onload('cat_id='+category);

	})

	$('.shopping-abs .swiper-slide li').on('click', function(e) {
		var index = $(".shopping-abs .swiper-slide li").index(this);
		$('.shopping-list-nav li').eq(index).trigger('click');
		$(".j-shopping-menu").removeClass("active");
		$(".mask-filter-div").removeClass("show")
	});

	$(".article-li-select").click(function(){
		$(".j-shopping-menu").removeClass("nav-active");
		$(".mask-filter-div").removeClass("show");
	});
</script>

</html>";s:12:"compile_time";i:1479659341;}";