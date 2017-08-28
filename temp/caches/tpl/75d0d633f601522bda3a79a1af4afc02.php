<?php exit;?>0014771389631433afb3f5d101970a3726e1fca77281s:3312:"a:2:{s:8:"template";s:3248:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con b-color-f">
    <section class="user-center user-login margin-lr">
        <form class="login-form validation" action="<?php echo U('index');?>" method="post">
            <div class="text-all dis-box j-text-all" name="usernamediv">
                <label>账 号</label>
                <div class="box-flex input-text">
                    <input class="j-input-text" name="username" datatype="*" nullmsg="请输入用户名"
                           type="text" placeholder="用户名/手机号/邮箱"/>
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
            </div>
            <div class="text-all dis-box j-text-all" name="passworddiv">
                <label>密 码</label>
                <div class="box-flex input-text">
                    <input class="j-input-text" name="password" type="password" datatype="*" nullmsg="请输入密码" placeholder="请输入密码"/>
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
                <i class="iconfont icon-yanjing is-yanjing j-yanjing disabled"></i>
            </div>
            <input type="hidden" name="back_act" value="<?php echo $back_act; ?>"/>
            <a class="fr t-remark" href="<?php echo U('get_password');?>">忘记密码？</a>
            <button type="submit" class="btn-submit">登录</button>

        </form>
        <a class="a-first u-l-register" href="<?php echo U('register');?>">新用户注册</a>
        <div class="other-login">
            <h4 class="title-hrbg"><span>第三方登录</span>
                <hr/>
            </h4>
            <ul class="dis-box">
                <li class="box-flex"><a href="<?php echo U('oauth/index/index', array('type'=>'qq','back_url'=>$back_act));?>"><span
                        class="qq"><i class="iconfont icon-qq"></i></span>QQ</a></li>
                <li class="box-flex"><a
                        href="<?php echo U('oauth/index/index', array('type'=>'weibo','back_url'=>$back_act));?>"><span
                        class="xinlang"><i class="iconfont icon-xinlang"></i></span>微博</a></li>
                <?php if($is_wechat) { ?>
                <li class="box-flex"><a
                        href="<?php echo U('oauth/index/index', array('type'=>'wechat','back_url'=>$back_act));?>"><span
                        class="weixin"><i class="iconfont icon-weixin"></i></span>微信</a></li>
                <?php } ?>
            </ul>
        </div>
    </section>
</div>
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
</script>
</body>

</html>";s:12:"compile_time";i:1477052563;}";