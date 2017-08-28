<?php exit;?>00147980378684f4601e483604fca8b5ba324ad02838s:4387:"a:2:{s:8:"template";s:4323:"<?php $__Template->display($this->getTpl("page_header")); ?>
<body class="b-color-f">
<div class="con" >
    <form action="<?php echo U('Realname');?>" method="post" onsubmit="return formcheck()">
        <section class="j-f-tel margin-lr">
            <div class="text-all dis-box j-text-all bank_card">
                <label>真实姓名</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="tel" name="real_name" placeholder="真实姓名" value="<?php echo $real_user['real_name']; ?>" />
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all bank_user_name">
                <label>身份证号</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="self_num" placeholder="身份证号" value="<?php echo $real_user['self_num']; ?>" />
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all bank_region">
                <label>银行</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="bank_name" placeholder="如:工商银行上海XXX路支行" value="<?php echo $real_user['bank_name']; ?>" />
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all bank_name">
                <label>银行卡号</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="bank_card" placeholder="银行卡号" value="<?php echo $real_user['bank_card']; ?>" />
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all bank_name">
                <label>手机号码</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="mobile_phone" placeholder="手机号码" value="<?php echo $real_user['bank_mobile']; ?>" />
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all bank_name">
                <label>短信验证码</label>
                <div class="box-flex input-text">
                    <input class="j-input-text inputcard" type="text" name="mobile_code" placeholder="短信验证码" />
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
                <button type="button" class="box-flex btn-submit j-submit-phone">获取验证码</button>
            </div>
            <button type="submit" value="sub" class="btn-submit">同意协议并确定</button>
        </section>
    </form>
</div>
<script>
    $(":input").keyup(function (){
        var name = $(this).attr("name");
        $("."+name).removeClass("active");
    });
    function formcheck(){
        var check = 0;
        $(".inputcard").each(function(){
            if($(this).val()==''){
                var name = $(this).attr("name");
                $("."+name).addClass("active");
//                d_messages('请输入完整的信息', 2);
                check = 1;
            }
        });
        if(check){
            alert('请输入完整的信息');
            return false;
        }
    }
    //获取验证码
    $('.j-submit-phone').click(function(){
        var phoneNum = $('input[name=mobile_phone]').val();
        if(phoneNum == ''){
            alert('请填写手机号码');
            return false;
        }
        $.ajax({
            url : "<?php echo U('RealnameSend');?>",
            data :　{mobile:phoneNum},
            type : 'post',
            dataType : 'json',
            success : function(data){
                d_messages(data.content, 2);
            }
        });
    });
</script>
</body>

</html>";s:12:"compile_time";i:1479717386;}";