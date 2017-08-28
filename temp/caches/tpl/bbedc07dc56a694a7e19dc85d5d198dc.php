<?php exit;?>001476941272ef3c960d5354f4020b864946d43f8772s:6812:"a:2:{s:8:"template";s:6748:"<?php $__Template->display($this->getTpl("page_header")); ?>
		<div id="loading"><img src="<?php echo __TPL__;?>img/loading.gif" /></div>
		<section class="b-color-f  my-nav-box">
			<a href="javascript:;">
				<div class="s-user-top">
					<div class="user-bg-box-1"><img src="<?php echo __TPL__;?>img/user-1.png"></div>
					<div class="user-bg2-box-1"><img src="<?php echo __TPL__;?>img/user-2.png"></div>
					<div class="dis-box s-xian-box s-user-top-1">
						<h3 class="box-flex text-all-span my-u-title-size s-user-img">头像</h3>
						<div class="box-flex t-goods1 text-right onelist-hidden jian-top">
                                                    <?php if($info['user_picture'] !=='' ) { ?>
						<div class="user-head-img-box-1"><img src="<?php echo $info['user_picture']; ?>"></div>
                                             <?php } else { ?>   
                                             <div class="user-head-img-box-1"><img src="<?php echo __TPL__;?>img/no_image.png"></div>
                                            <?php } ?>
                                              
						</div>
					</div>
				</div>
			</a>

			<div class="s-user-top">
				<div class="dis-box s-xian-box s-user-top-1">
					<h3 class="box-flex text-all-span my-u-title-size">用户名</h3>
					<div class="box-flex t-goods1 text-right onelist-hidden jian-top"><?php echo $info['username']; ?></div>
				</div>
			</div>
			<div class="s-user-top onclik-sex">
				<div class="dis-box s-xian-box s-user-top-1">
					<h3 class="box-flex text-all-span my-u-title-size">性别</h3>
                              
					<div id="sex" class="box-flex t-goods1 text-right onelist-hidden jian-top"><?php echo $info['sex']; ?></div>

					<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
				</div>
			</div>
			<a href="<?php echo U('user/profile/user_edit_mobile');?>">
				<div class="s-user-top onclik-admin">
					<div class="dis-box s-xian-box s-user-top-1">
						<h3 class="box-flex text-all-span my-u-title-size">手机</h3>
                                                <?php if($info['mobile_phone'] =='') { ?>
						<div class="box-flex t-goods1 text-right onelist-hidden jian-top">未绑定</div>
                                                <?php } else { ?>
                                                <div class="box-flex t-goods1 text-right onelist-hidden jian-top"><?php echo $info['mobile_phone']; ?></div>
                                                <?php } ?>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
					</div>
				</div>
			</a>
			<a href="<?php echo U('user/profile/user_edit_email');?>">
				<div class="s-user-top">
					<div class="dis-box s-user-top-1">
						<h3 class="box-flex text-all-span my-u-title-size">邮箱</h3>
                                                 <?php if($info['email'] =='') { ?>
						<div class="box-flex t-goods1 text-right onelist-hidden jian-top">未绑定</div>
                                                <?php } else { ?>
                                                <div class="box-flex t-goods1 text-right onelist-hidden jian-top"><?php echo $info['email']; ?></div>
                                                <?php } ?>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
					</div>
				</div>
			</a>
		</section>
		<section class="b-color-f my-nav-box m-top10">
			<a href="<?php echo U('user/index/edit_password');?>">
				<div class="s-user-top">
					<div class="dis-box s-xian-box s-user-top-1">
						<h3 class="box-flex text-all-span my-u-title-size">修改密码</h3>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
					</div>
				</div>
			</a>
			<a href="<?php echo U('index/addresslist');?>">
				<div class="s-user-top">
					<div class="dis-box s-xian-box s-user-top-1">
						<h3 class="box-flex text-all-span my-u-title-size">收货地址</h3>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
					</div>
				</div>
			</a>
			<a href="<?php echo U('user/profile/Realname');?>">
				<div class="s-user-top">
					<div class="dis-box s-xian-box s-user-top-1">
						<h3 class="box-flex text-all-span my-u-title-size">实名认证</h3>
						<span class="t-jiantou"><i class="iconfont icon-jiantou tf-180 jian-top"></i></span>
					</div>
				</div>
			</a>
		</section>
                <div class="ect-button-more padding-all">
                    <a class="btn-submit box-flex" type="button" href="<?php echo U('user/login/logout');?>">退出</a>
                </div>
		<!--updata-admin-->
		<div class=" my-sex-box">

			<div class="flow-consignee margin-lr">
					<ul class="user-nav-box g-s-i-title-3 dis-box text-center">
						<li class="box-flex  sex-default-color">
							<a href="javascript:;" class="<?php if($user_sex == 1) { ?>active<?php } ?>">
								<i class="iconfont icon-nan my-sex-size" ></i>
                            	<input type="radio" name="sex" value="1"/><h4 class="ellipsis-one">男</h4>
							</a>
						</li>
						<li class="box-flex sex-default-color" >
							<a href="javascript:;" class="sex-nv <?php if($user_sex == 2) { ?>active<?php } ?>">
								<i class="iconfont icon-nv my-sex-size" ></i>
                              	<input type="radio" name="sex" value="2"/><h4 class="ellipsis-one">女</h4>
							</a>
						<li>
					</ul>
					<div class="ect-button-more dis-box m-top12 updata-top my-sex-close">
                      <button  class="btn-submit box-flex" type="submit" value="submit">确定</button>
					</div>
			 </div>
			</div>
			<script>
				$(function($) {
					$(".onclik-sex").click(function() {
						$(".my-sex-box").addClass("current");
					});
					$(".my-sex-close").click(function() {
						$(".my-sex-box").removeClass("current");
					});
				});
				$(function() {
					$('.sex-default-color').click(function() {
						for (var i = 0; i < $('.sex-default-color').size(); i++) {
							if (this == $('.sex-default-color').get(i)) {
								$('.sex-default-color').eq(i).children('a').addClass('active');
							} else {
								$('.sex-default-color').eq(i).children('a').removeClass('active');
							}
						}
					})
				})
			</script>
	<script>
	$(".user-nav-box").click(function(){
		var sex = $(".active input[name='sex']").val();
		$.post("<?php echo U('user/profile/editprofile');?>",{sex:sex},function(data){
			$("#sex").text(data.sex);
		},"json");
		
	})
	
	
	</script>

	</body>

</html>";s:12:"compile_time";i:1476854872;}";