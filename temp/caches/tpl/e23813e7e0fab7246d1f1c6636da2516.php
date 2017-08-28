<?php exit;?>001479823505c2e0ad0b3ed91d198ad214a900e6e50fs:2043:"a:2:{s:8:"template";s:1979:"<?php $__Template->display($this->getTpl("page_header")); ?>


<div class="padding-lr user-consult">
<?php $n=1;if(is_array($message_list)) foreach($message_list as $message) { ?>
    <section class="cons-list dis-box">
        <div class="box-flex m-top02">
            <div class="cons-admin text-right"><?php echo $info['username']; ?><span><?php echo $message['msg_time']; ?></span></div>
            <div class="fr m-top04">
                <div class="cons-cont-1"><?php echo $message['msg_title']; ?></div>
            </div>
        </div>
        <?php if($info['user_picture'] !='' ) { ?>
        <div class="cons-head-img-box cons-head-img-boxr"><img src="<?php echo $info['user_picture']; ?>"></div>
        <?php } else { ?>   
        <div class="cons-head-img-box cons-head-img-boxr"><img src="<?php echo __TPL__;?>img/no_image.jpg"></div>
        <?php } ?>     
    </section>
    <?php if($message['re_msg_content']!="" ) { ?>
    <section class="cons-list dis-box">
        <div class="cons-head-img-box text-center"><i class="iconfont icon-kefu c-kefu-size "></i></div>
        <div class="box-flex m-top02">
            <div class="cons-admin"><?php echo $message['re_user_name']; ?><span><?php echo $message['re_msg_time']; ?></span></div>
            <div class="fl">
                <div class="cons-cont m-top04"><?php echo $message['re_msg_content']; ?></div>
            </div>
        </div>
    </section>
    <?php } ?>
<?php $n++;}unset($n); ?>
</div>

<form action="<?php echo U('user/index/addmessage');?>" method="post">
            <div class="filter-btn consult-filter-btn padding-all">
			<div class=" dis-box ">
				<div class="box-flex text-all "><input class="j-input-text" type="text" placeholder="说点什么吧～" name="msg_title"></div>
                                <input type="submit" value=提交 class="btn-submit"/>
				</div>
		</div>  
</form>

                
	</body>

</html>";s:12:"compile_time";i:1479737105;}";