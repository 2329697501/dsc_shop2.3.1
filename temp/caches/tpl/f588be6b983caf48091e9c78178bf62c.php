<?php exit;?>001479820356986e4647443f21f4251d30295deb2d82s:1580:"a:2:{s:8:"template";s:1516:"<?php $__Template->display($this->getTpl("page_header-nav")); ?>
<div class="con">
			<div class="message">
				<div class="flow-done-con">
                    <!--<?php if($message['type'] == 'fail') { ?>-->
					<i class="iconfont icon-guanbi1"></i>
                    <!--<?php } ?>-->
                    <!--<?php if($message['type'] == 'success') { ?>-->
                    <i class="iconfont icon-hookring2"></i>
                    <!--<?php } ?>-->
                    <!--<?php if($message['type'] == 'warning') { ?>-->
                    <i class="iconfont icon-102"></i>
                    <!--<?php } ?>-->
					<p style="padding-left:1.5rem;padding-right:1.5rem"><?php echo $message['content']; ?></p>
				</div>
				<div class="padding-all message-a">
                    <!--<?php $n=1; if(is_array($message['url_info'])) foreach($message['url_info'] as $info => $url) { ?>-->
                    <a class="back" href="<?php echo $url; ?>"><?php echo $info; ?></a>
                    <!--<?php $n++;}unset($n); ?>-->
				</div>

			</div>
	</div>
        <script>
            window.onload = function(){
                setTimeout(url,3000);//1000毫秒=1秒后执行test方法
            }
            function url(){
                var a = '';
                $(".back").each(function (){
                    window.location.href = $(this).attr("href");
                    return false;
                });
            }
       </script>
	</body>
</html>";s:12:"compile_time";i:1479733956;}";