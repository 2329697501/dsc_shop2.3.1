<?php exit;?>001479453733e46bc2f1143111a0fdb19c0e0a83a6c7s:7292:"a:2:{s:8:"template";s:7228:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div class="con">
			<div class="shopping-about">
				<section class="padding-all goods-shop b-color-f">
					<header class="goods-shop-info">
						<a href="<?php echo U('store/index/shop_info',array('id'=>$info['ru_id']));?>" class="link-abs"></a>
						<section class="dis-box">
							<div class="g-s-i-img"><img src="<?php echo $info['shop_logo']; ?>" /></div>
							<div class="g-s-i-title box-flex">
								<h3 class="ellipsis-one"><?php echo $info['shop_name']; ?></h3>
								<p class="t-remark m-top04">已经有 <?php echo $info['count_gaze']; ?> 人关注</p>
							</div>
							<div class="g-s-info-add">
								
								<a class="gaze<?php echo $info['shop_id']; ?> <?php echo $info['gaze_status']; ?>"  onclick="addgaze(<?php echo $info['shop_id']; ?>)">关注</a>
							</div>
						</section>
						<section class="dis-box goods-shop-score m-top12">
							<p class="box-flex">
								<label class="fl">商品</label><span class="t-first margin-lr fl"><?php echo $info['commentrank']; ?></span><em class="em-promotion fl"><?php echo $info['commentrank_font']; ?></em></p>
							<p class="box-flex">
								<label class="fl">服务</label><span class="t-low margin-lr fl"><?php echo $info['commentserver']; ?></span><em class="em-promotion em-p-low fl"><?php echo $info['commentserver_font']; ?></em></p>
							<p class="box-flex">
								<label class="fl">时效</label><span class="t-center margin-lr fl"><?php echo $info['commentdelivery']; ?></span><em class="em-promotion em-p-center fl"><?php echo $info['commentdelivery_font']; ?></em></p>
						</section>
						
					</header>
				</section>
			</div>
			<div class="shopping-info-nums b-color-f m-top1px">
				<ul class="dis-box text-center">

					<li class="box-flex">
                    <a href="<?php echo U('store/index/pro_list',array('ru_id'=>$info['ru_id']));?>">
						<h4><?php echo $info['count_goods']; ?></h4>
						<p class="t-remark3 m-top02">全部商品</p>
                    </a>
					</li>


					<li class="box-flex">
                    <a href="<?php echo U('store/index/pro_list',array('ru_id'=>$info['ru_id'],'type'=>'is_new'));?>">
						<h4><?php echo $info['count_goods_new']; ?></h4>
						<p class="t-remark3 m-top02">新品</p>
                    </a>
                    </li>

                    <li class="box-flex">
                    <a href="<?php echo U('store/index/pro_list',array('ru_id'=>$info['ru_id'],'type'=>'is_promote'));?>">

						<h4><?php echo $info['count_goods_promote']; ?></h4>
						<p class="t-remark3 m-top02">促销</p>
                    </a>
                    </li>

				</ul>
			</div>
			<div class="m-top08 shopping-about-icon">
				<section class="padding-all b-color-f m-top1px">
                    <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $info['shop_qq']; ?>&amp;site=qq&amp;menu=yes">
					<div class="dis-box">
						<label class="t-remark p-top g-t-temark">在线客服</label>
						<span class="box-flex p-top"></span>
						<span class="t-jiantou fr"><i class="iconfont icon-kefu"></i></span>
					</div>
                    </a>
				</section>
                <section class="padding-all b-color-f m-top1px">
                    <div class="dis-box j-show-div">
                        <label class="t-remark p-top g-t-temark">店铺二维码</label>
                        <span class="box-flex"></span>
                        <span class="t-jiantou fr"><i class="iconfont icon-904anquansaoma"></i></span>
                        <div class="show-temark-div j-filter-show-div">
                        	<h4><?php echo $info['shop_name']; ?></h4>
                        	<div class="img-new-box"><img src="<?php echo $info['code']; ?>"></div>
                        	<p>邀请好友扫一扫分享店铺给TA</p>
                        </div>
                    </div>
                </section>
				<section class="padding-all b-color-f m-top1px">
                    <a href="tel:<?php echo $info['shop_tel']; ?>">
					<div class="dis-box">
						<label class="t-remark p-top g-t-temark">商家电话</label>
						<span class="box-flex p-top t-goods1"><?php echo $info['shop_tel']; ?></span>
						<span class="t-jiantou fr"><i class="iconfont icon-a"></i></span>
					</div>
                    </a>
				</section>
			</div>
			<div class="m-top08">
				<section class="padding-all b-color-f m-top1px">
					<div class="dis-box">
						<label class="t-remark g-t-temark">店铺简介</label>
						<span class="box-flex t-goods1"><?php echo $info['shop_name']; ?></span>
					</div>
				</section>
				<section class="padding-all b-color-f m-top1px">
					<div class="dis-box">
						<label class="t-remark g-t-temark">公司名称</label>
						<span class="box-flex t-goods1"><?php echo $info['shop_desc']; ?></span>
					</div>
				</section>
				<section class="padding-all b-color-f m-top1px">
					<div class="dis-box">
						<label class="t-remark g-t-temark">开店时间</label>
						<span class="box-flex t-goods1"><?php echo $info['shop_start']; ?></span>
					</div>
				</section>
				<section class="padding-all b-color-f m-top1px">
					<div class="dis-box">
						<label class="t-remark g-t-temark">所在地区</label>
						<span class="box-flex t-goods1"><?php echo $info['shop_address']; ?></span>
					</div>
				</section>
			</div>
		</div>
        <div class="mask-filter-div"></div>
		<script>

		 //店铺关注
         function addgaze(shop){
             if(shop!=''){
                 $.post('index.php?r=store/index/add_collect', {shopid: shop}, function(data){
                     if(data.error==1){
                         $(".gaze"+shop).addClass("active");
                     }
                     if(data.error==2){
                         $(".gaze"+shop).removeClass("active");
                     }
                     var num = $(".num"+shop).text();
                     if(data.error==1){
                         num = num*1 + 1;
                         $(".num"+shop).text(num);
                     }else if(data.error==2){
                         if(num>0)
                         {
                             num = num*1 - 1;
                             $(".num"+shop).text(num);
                         }
                     }
                     if(data.error>0){
                         d_messages(data.msg);
                     }else {
                         layer.open({
                             content: '请登录后关注该店铺',
                             btn: ['立即登录', '取消'],
                             shadeClose: false,
                             yes: function () {
                                 window.location.href = 'index.php?r=user/login';
                             },
                             no: function () {
                             }
                         });
                     }
                 }, 'json');
             }
         }

        </script>
	</body>

</html>";s:12:"compile_time";i:1479367333;}";