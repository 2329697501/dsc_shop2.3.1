<?php exit;?>0014795377757b0f7756d10c81285616e50363d83bd2s:1852:"a:2:{s:8:"template";s:1788:"<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $page_title; ?></title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
</head>
<body>
<script type="text/javascript" src="<?php echo __TPL__;?>js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>layer/m/layer.m.js"></script>
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, errorPosition);
        } else {
            errorPosition();
        }
    }

    function showPosition(position) {
        $.post("index.php?r=store/map/index", {
            lng: position.coords.longitude,
            lat: position.coords.latitude
        }, function (data) {
            if (data.error == 0) {
                // console.log("Latitude: " + position.coords.latitude + "<br />Longitude: " + position.coords.longitude);
                window.location.href = data.url;
            } else {
                alert(data.message);
            }
        }, 'json');
    }

    function errorPosition() {
      
    }

    function alert(message) {
        layer.open({
            content: message,
            btn: ['OK'],
            yes: function () {
                window.location.href = "index.php?r=store";
            }
        });
    }

    getLocation();
</script>
</body>
</html>";s:12:"compile_time";i:1479451375;}";