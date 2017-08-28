<?php exit;?>001479647035061d518b0e505881e579b9ddd54aa797s:11013:"a:2:{s:8:"template";s:10948:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con b-color-f">
    <div class="user-center user-register of-hidden">
        <div class="hd j-tab-title">
            <ul class="dis-box">
                <?php if($show) { ?>
                <li class="box-flex active">快速注册</li>
                <?php } else { ?>
                <li class="box-flex active">邮箱注册</li>
                <?php } ?>
            </ul>
        </div>
        <div id="j-tab-con">
            <div class="swiper-wrapper">
                <?php if($show) { ?>
                <section class="swiper-slide swiper-no-swiping">
                    <form action="<?php echo U('register');?>" method="post" class="validation">
                        <div class="text-all dis-box j-text-all">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="verify" datatype="*" nullmsg="请输入图片验证码" type="text"
                                       placeholder="请输入验证码"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                            <img src="<?php echo U('captcha/index/index');?>" onclick="this.src='<?php echo U('captcha/index/index');?>'"
                                 height="36" class="ipt-check-btn j-verify-img"/>
                        </div>
                        <div class="text-all dis-box j-text-all" name="mobilediv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" id="mobile_phone" name="mobile" datatype="m"
                                       nullmsg="请输入手机号码" errormsg="手机号码格式不正确" type="tel" placeholder="请输入手机号"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                            <a type="button" class="ipt-check-btn" href="#" id="sendsms">获取短信验证码</a>
                        </div>
                        <div class="text-all dis-box j-text-all" name="mobile_codediv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="mobile_code" datatype="*" nullmsg="请输入短信验证码"
                                       type="number" placeholder="请输入短信验证码"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                        </div>
                        <div class="text-all dis-box j-text-all" name="smspassworddiv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="smspassword" datatype="*6-20" nullmsg="请设置6-20位登录密码"
                                       errormsg="密码至少6位数" type="password" placeholder="请设置6-20位登录密码"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                            <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
                        </div>
                        <input name="enabled_sms" type="hidden" value="1"/>
                        <input type="hidden" name="back_act" value="<?php echo $back_act; ?>"/>
                        <input type="hidden" id="flag" value="<?php echo $flag; ?>">
                        <button type="submit" class="btn-submit">注册</button>
                        <div class="u-l-register fl">注册即视为同意《<a href="<?php echo U('article/index/detail', array('cat_id'=>-1));?>"
                                                                class="a-first">用户注册协议</a>》
                        </div>
                    </form>
                </section>
                <?php } else { ?>
                <section class="swiper-slide swiper-no-swiping">
                    <form action="<?php echo U('register');?>" method="post" class="validation">
                        <div class="text-all dis-box j-text-all" name="mobilediv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" id="username" name="username" datatype="s6-20"
                                       nullmsg="请输入您的用户名"
                                       errormsg="用户名需6位字母或数字" type="name" placeholder="请输入您的用户名"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                        </div>
                        <div class="text-all dis-box j-text-all" name="emaildiv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="email" type="text" datatype="e" nullmsg="请输入您的邮箱地址"
                                       errormsg="电子邮箱格式不正确" placeholder="请输入邮箱"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                        </div>
                        <div class="text-all dis-box j-text-all" name="passworddiv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="password" type="password" datatype="*6-20"
                                       nullmsg="请设置6-20位登录密码"
                                       errormsg="密码至少6位数" placeholder="请输入密码"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                            <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
                        </div>
                        <div class="text-all dis-box j-text-all" name="confirm_passworddiv">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="confirm_password" type="password" datatype="*"
                                       recheck="password" nullmsg="请再次输入密码"
                                       errormsg="再次输入的密码不正确" placeholder="请再次输入密码"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                            <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
                        </div>
                        <?php if($enabled_captcha) { ?>
                        <div class="text-all dis-box j-text-all">
                            <div class="box-flex input-text">
                                <input class="j-input-text" name="captcha" datatype="*" nullmsg="请输入图片验证码" type="text"
                                       placeholder="请输入验证码"/>
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                            <img src="<?php echo U('captcha/index/index');?>" onclick="this.src='<?php echo U('captcha/index/index');?>'"
                                 height="36" class="ipt-check-btn j-verify-img"/>
                        </div>
                        <?php } ?>
                        <input type="hidden" name="enabled_sms" value="2"/>
                        <button type="submit" class="btn-submit">注册</button>
                        <a href="<?php echo U('index');?>" class="a-first u-l-register fr">已注册直接登录</a>
                    </form>
                </section>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="div-messages"></div>
<!--引用js-->
<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/main/sms.js"></script>
<script>
    $(function () {
        $.Tipmsg.r = null;
        $(".validation").Validform({
            tiptype: function (msg) {
                d_messages(msg);
            },
            tipSweep: true,
            ajaxPost: true,
            callback: function (data) {
                // {"info":"demo info","status":"y"}
                if (data.status === 'y') {
                    window.location.href = data.url;
                } else {
                    d_messages(data.info);
                }
            }
        });
    })
    var time = 60;
    var c = 1;
    function data() {
        if (time == 0) {
            c = 1;
            $("#sendsms").html("发送验证码");
            time = 60;
            return;
        }

        if (time != 0) {
            if ($(".ipt-check-btn").attr("class").indexOf("disabled") < 0) {
                $(".ipt-check-btn").addClass('disabled');
            }
            c = 0;
            $("#sendsms").html("<span>重新获取(" + time + ")</span>");
            time--;
        }
        setTimeout(data, 1000);
    }

    $("#sendsms").click(function () {
        var myreg = /^13[0-9]{9}|15[012356789][0-9]{8}|18[0-9]{9}|14[579][0-9]{8}|17[0-9]{9}$/;
        var mobile = $("input[name=mobile]").val();
        var verify_code = $("input[name=verify]").val();

        if (verify_code == '') {
            d_messages('请输入图片验证码');
            return false;
        }
        if (mobile == '') {
            d_messages('请输入手机号');
            return false;
        }
        if (!myreg.test(mobile)) {
            d_messages('请输入有效的手机号');
            return false;
        }
        if (c == 0) {
            d_messages('发送频繁');
            return;
        }

        $.post('index.php?r=sms/index/send', {
            mobile: mobile,
            verify_code: verify_code,
            flag: 'register'
        }, function (res) {
            d_messages(res.msg);
            if (res.code == 2) {
                data();
            } else {
                $('.j-verify-img').click();
            }
        }, 'json');
    })

    /*切换*/
    var tabsSwiper = new Swiper('#j-tab-con', {
        speed: 0,
        noSwiping: true,
        autoHeight: true
    })
    $(".j-tab-title li").on('touchstart mousedown', function (e) {
        e.preventDefault()
        $(".j-tab-title .active").removeClass('active')
        $(this).addClass('active')
        tabsSwiper.slideTo($(this).index())
    })
    $(".j-tab-title li").click(function (e) {
        e.preventDefault()
    })

</script>
</body>

</html>";s:12:"compile_time";i:1479560635;}";