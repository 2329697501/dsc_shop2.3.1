<?php exit;?>001479693322f5728a5b25e14c9ce20ca634cb3e9638s:2296:"a:2:{s:8:"template";s:2232:"<?php $__Template->display($this->getTpl("page_header")); ?>
<body class="b-color-f">
		<div class="con" id="pjax-container">
			<!--根据手机找回-->
			<form action="<?php echo U('edit_password');?>" method="post" onsubmit="return check()" >
			<section class="user-center user-forget-tel margin-lr">
				<div class="text-all dis-box j-text-all" name="userpassworddiv">
					<div class="input-text input-check  box-flex">
						<input class="j-input-text" name="old_password" type="password" placeholder="请输入旧密码" />
						<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
					</div>
					<i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
				</div>
				<div class="text-all dis-box j-text-all" name="userpassworddiv">
					<div class="input-text input-check  box-flex">
						<input class="j-input-text" name="new_password1" type="password" placeholder="请输入新密码" />
						<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
					</div>
					<i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
				</div>
				<div class="text-all dis-box j-text-all" name="userpassworddiv">
					<div class="input-text input-check  box-flex">
						<input class="j-input-text" type="password" name="new_password" placeholder="确认输入新密码" />
						<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
					</div>
					<i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
				</div>
				<input type="hidden" name="uid" value="<?php echo $uid; ?>" >
				<button type="submit" class="btn-submit">确认修改</button>
			</section>
			</form>
		</div>
        <script>
        function check(){
            var word      =$("input[name=new_password1]");
            var word2     =$("input[name=new_password]");
            if(word.val() == ''){
				 d_messages('新密码不能为空',2);
				 $("div[name=userpassworddiv]").addClass("active");
				 return false;
			 }
            if(word.val() != word2.val()){
  				 d_messages('两次密码不一致',2);
  				 $("div[name=userpassword]").addClass("active");
  				 return false;
  			 }
           
       }
        </script>
	</body>

</html>";s:12:"compile_time";i:1479606922;}";