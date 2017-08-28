<?php exit;?>001477533963f6c2d8c6314467713b00c5ae22f66f47s:933:"a:2:{s:8:"template";s:870:"<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ECTouch Message</title>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>layer/layer.js"></script>
</head>
<body>
<script type="text/javascript">
layer.msg('<?php echo $data['message']; ?>', {icon: <?php echo $data['type']; ?>, offset: '150px', time: 1000, title: '<?php echo $data['title']; ?>'});
(function(){
	var time = 1;
	var href = '<?php echo $data['url']; ?>';
	var interval = setInterval(function(){
		--time;
		if(time <= 0) {
			window.location.href = href;
			clearInterval(interval);
		};
	}, 1000);
})();
</script>
</body>
</html>";s:12:"compile_time";i:1477447563;}";