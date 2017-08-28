<?php exit;?>0014796500498e5167d700b6bbc932ef20343ef6851es:2059:"a:2:{s:8:"template";s:1995:"<?php $__Template->display($this->getTpl("page_header")); ?>
<body class="b-color-f">
<div class="con">
    <!--根据手机找回-->
    <section class="user-center user-forget-tel margin-lr">
        <form id="formid" action="<?php echo U('user/login/EditForgetPassword');?>" method="post" >
        <div class="text-all dis-box j-text-all">
            <div class="input-text input-check  box-flex">
                <input class="j-input-text" type="password" name="password" placeholder="请输入新密码" />
                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
            </div>
            <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
        </div>
        <div class="text-all dis-box j-text-all">
            <div class="input-text input-check  box-flex">
                <input class="j-input-text" type="password" name="repassword" placeholder="请再输入一次新密码" />
                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
            </div>
            <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
        </div>
        <button type="button" onclick="forget()" class="btn-submit">确认修改</button>
        </form>
    </section>
</div>
<script>
    function forget(){
        var password = $('input[name=password]').val();
        var repassword = $('input[name=repassword]').val();
        if(password == ''){
            d_messages('请填写新密码');
            return false;
        }
        if(password.length < 6){
            d_messages('新密码不能小于6位');
            return false;
        }
        if(repassword == ''){
            d_messages('请确认新密码');
            return false;
        }
        if(password != repassword){
            d_messages('两次密码不一致');
            return false;
        }

        document.getElementById("formid").submit();
    }
</script>
</body>

</html>";s:12:"compile_time";i:1479563649;}";