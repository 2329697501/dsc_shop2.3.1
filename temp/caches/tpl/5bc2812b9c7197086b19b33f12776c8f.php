<?php exit;?>001477297880b149718e37fe7c5d613a2d1d302e7fe1s:2504:"a:2:{s:8:"template";s:2440:"<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $description; ?>"/>
    <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <title><?php echo $page_title; ?></title>
    <?php echo ectouch_global_assets('css');?>
    <?php echo ectouch_global_assets('js');?>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
    <script type="text/javascript">
        // 分享内容
        var shareContent = {
            title: '<?php echo $page_title; ?>',
            desc: '<?php echo $page_desc; ?>',
            link: '<?php echo $page_url; ?>',
            imgUrl: '<?php echo $page_img; ?>'
        };
        $(function(){
            var url = window.location.href;
            var jsConfig = {
                debug: false,
                jsApiList: [
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareWeibo',
                    'onMenuShareQZone'
                ]
            };
            $.post('<?php echo U("wechat/jssdk/index");?>', {url: url}, function (res) {
                if(res.status == 200){
                    jsConfig.appId = res.data.appId;
                    jsConfig.timestamp = res.data.timestamp;
                    jsConfig.nonceStr = res.data.nonceStr;
                    jsConfig.signature = res.data.signature;
                    // 配置注入
                    wx.config(jsConfig);
                    // 事件注入
                    wx.ready(function () {
                        wx.onMenuShareTimeline(shareContent);
                        wx.onMenuShareAppMessage(shareContent);
                        wx.onMenuShareQQ(shareContent);
                        wx.onMenuShareWeibo(shareContent);
                        wx.onMenuShareQZone(shareContent);
                    });
                }
            }, 'json');
        })
    </script>
</head>
<?php $__Template->display($this->getTpl("search")); ?>
";s:12:"compile_time";i:1477211480;}";