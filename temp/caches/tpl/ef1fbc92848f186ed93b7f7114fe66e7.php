<?php exit;?>001479649861773ae2de767dc6fc5f1a153e6c8ff971s:3692:"a:2:{s:8:"template";s:3628:"<?php $__Template->display($this->getTpl("page_header")); ?>
<body class="b-color-f">
	<?php if($type=='email') { ?>
		<div class="con" id="pjax-container">
			<!--根据邮箱找回-->
			<section class="user-center j-f-email margin-lr">
				<div class="text-all dis-box j-text-all">
					<label>用户名</label>
					<div class="input-text box-flex">
						<span class="j-user-name"><?php echo $user_name; ?></span>
						<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
					</div>
				</div>
				<div class="text-all dis-box j-text-all">
					<label>邮箱</label>
					<div class="input-text box-flex">
						<span class="j-number"><?php echo $email; ?></span>
						<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
					</div>
				</div>
				<div class="text-all dis-box j-text-all">
					<div class="input-text box-flex">
						<input class="j-input-text" name="code" type="text" placeholder="验证码"/>
						<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
					</div>
					<div class="box-flex input-text">
						<span id="sendverify">发送验证码</span>
						<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
					</div>
				</div>
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
				<input type="hidden" name="email" value="<?php echo $email; ?>" />
				<button type="submit" class="btn-submit j-submit">下一步</button>
			</section>
		</div>
		<div class="div-messages"></div>
	<?php } else { ?>
	<div class="con" id="pjax-container">
		<section class="user-center j-f-tel margin-lr">
			<div class="text-all dis-box j-text-all">
				<label>用户名：</label>
				<div class="box-flex input-text">
					<span class="n-input"><?php echo $user_name; ?></span>
					<i class="iconfont icon-guanbi is-null j-is-null"></i>
				</div>
			</div>
			<div class="text-all dis-box j-text-all">
				<label class="j_mobile_phone">手机号码：</label>
				<div class="box-flex input-text">
					<span class="j-number n-input"><?php echo $mobile_phone; ?></span>
					<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
				</div>
			</div>
			<div class="text-all dis-box j-text-all">
				<input class="j-input-text" name="code" type="text" placeholder="验证码"/>
				<div class="box-flex input-text text-right">
					<span id="sendverify">发送验证码</span>
					<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
				</div>
			</div>
			<button  id="next" class="btn-submit j-submit">下一步</button>
		</section>
		<div class="div-messages"></div>
	</div>
	<?php } ?>
        <script>
		//**  提交检验
        $('.j-submit').click(function(){
			var code = $('input[name=code]').val();
			if(code == ''){
				d_messages('请填写验证码');
				return false;
			}
			$.ajax({
				url : "<?php echo U('get_password_show');?>",
				data : {code : code},
				dataType : 'json',
				type : 'post',
				success : function(data){
					if(data.error == 0){
						window.location.href = "<?php echo U('edit_forget_password');?>";
					}else{
						d_messages(data.content);
					}
				}
			});
		});
		//发送验证码
		$('#sendverify').click(function(){
			var number = $('.j-number').text();
			$.ajax({
				url : "<?php echo U('send_sms');?>",
				data : {number : number, type : "<?php echo $type; ?>"},
				dataType : 'json',
				type : 'post',
				success : function(data){
					d_messages(data.content);
					if(data.error == 0){
						d_messages(data.content);
					}
				}
			});
		});

        </script>
	</body>

</html>";s:12:"compile_time";i:1479563461;}";