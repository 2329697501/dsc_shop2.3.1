<?php exit;?>0014796493339203e0539ae9ac894c57ba05905df07as:3153:"a:2:{s:8:"template";s:3089:"<?php $__Template->display($this->getTpl("page_header")); ?>
<body class="b-color-f">
<div class="con" id="pjax-container">
    <div id="show">
        <section class="user-center j-f-tel margin-lr">
            <div class="text-all dis-box j-text-all">
                <div class="box-flex input-text">
                    <input class="j-input-text" name="username" type="text" placeholder="用户名/手机号/邮箱"/>
                    <i class="iconfont icon-guanbi is-null j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all">
                <div class="box-flex input-text">
                    <input class="j-input-text" name="verify" datatype="*" nullmsg="请输入图片验证码" type="text"
                           placeholder="请输入验证码"/>
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
                <img src="<?php echo U('captcha/index/index');?>" onclick="this.src='<?php echo U('captcha/index/index');?>'"
                     height="36" class="ipt-check-btn j-verify-img"/>
            </div>
            <input type="hidden" name="enabled_sms" value="1"/>
            <button id="next" class="btn-submit">下一步</button>
        </section>
    </div>
    <div class="div-messages"></div>
</div>
<script>
    $("#next").click(function () {
        var mobile = $("input[name=username]");
        var captcha = $('input[name=verify]').val();
        var isBoo = true;

        if (mobile.val() == '') {
            d_messages('请输入用户信息！', 2);
            return false;
        }
        if (captcha == null || captcha == "") {
            d_messages('请输入验证码！', 2);
            return false;
        } else {
            $.ajax({
                url: "<?php echo U('Checkcode');?>",
                async: false,
                data: {code: captcha},
                dataType: 'json',
                success: function (data) {
                    if (data == 0) {
                        isBoo = false;
                    }
                }
            });
        }
        $('.j-verify-img').attr('src', "<?php echo U('captcha/index/index');?>");
        if (!isBoo) {
            d_messages('验证码不正确！', 2);
            return false;
        }

        $.ajax({
            url : "<?php echo U('GetPassword');?>",
            data :　{username : $('input[name=username]').val(), email : $('.j-email').text()},
            dataType : 'json',
            type : 'post',
            success : function(data){
                if(data.error == 0){
                    if(data.user_info != ''){
                        window.location.href = "<?php echo U('get_password_show');?>&type="+data.mail_or_phone;
                    }
                }else if(data.error == 1){
                    d_messages(data.content);
                }
            }
        });
        return false;
    });
</script>
</body>

</html>";s:12:"compile_time";i:1479562933;}";