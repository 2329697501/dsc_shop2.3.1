<?php exit;?>001476941326df36801a45db6d4606261c2330173939s:2929:"a:2:{s:8:"template";s:2865:"<?php $__Template->display($this->getTpl("admin/header")); ?>
<div class="wrapper">
  <div class="title"><?php echo $ur_here; ?></div>
  <div class="content">
  	<div class="explanation" id="explanation">
        <div class="ex_tit">
        	<i class="sc_icon"></i>
        	<h4>操作提示</h4>
        	<span id="explanationZoom" title="收起提示"></span>
        </div>
        <ul>
        	  <li>请填写有效的APP_ID。</li>
        	  <li>"*"为必填项。</li>
        </ul>
    </div>
  	<div class="flexilist">
  		<div class="main-info">
    <form action="<?php echo U('edit');?>" method="post" class="form-horizontal" role="form">
      <div class="switch_info">
        <?php $n=1; if(is_array($info['config'])) foreach($info['config'] as $key => $vo) { ?>
        <div class="item">
          <div class="label-t"><?php echo $vo['label']; ?>：</div>
          <div class="label_value">
          	<input type="text" name="cfg_value[]" maxlength="50" class="text" value="<?php echo $vo['value']; ?>" />
	          <input name="cfg_name[]" type="hidden" value="<?php echo $vo['name']; ?>" />
	          <input name="cfg_type[]" type="hidden" value="<?php echo $vo['type']; ?>" />
	          <input name="cfg_label[]" type="hidden" value="<?php echo $vo['label']; ?>" />
	        </div>
        </div>
        <?php $n++;}unset($n); ?>
        <div class="item">
          <div class="label-t">申请地址：</div>
          <div class="label_value"> <a href="<?php echo $info['website']; ?>" class="btn button" target="_blank">立即申请</a></div>
        </div>
        <div class="item">
          <div class="label-t">&nbsp;</div>
          <div class="label_value info_btn">
              <input type="hidden"  name="type" value="<?php echo $info['type']; ?>" />
              <input type="submit" value="编辑" class="button" />
              <input type="reset" value="重置" class="button button_reset" />
          </div>
        </div>
      </div>
    </form>
    </div>
    </div>
  </div>
</div>
<script>
	$("#explanationZoom").on("click",function(){
		var explanation = $(this).parents(".explanation");
		var width = $(".content").width();
		if($(this).hasClass("shopUp")){
			$(this).removeClass("shopUp");
			$(this).attr("title","收起提示");
			explanation.find(".ex_tit").css("margin-bottom",10);
			explanation.animate({
				width:width-28
			},300,function(){
				$(".explanation").find("ul").show();
			});
		}else{
			$(this).addClass("shopUp");
			$(this).attr("title","提示相关设置操作时应注意的要点");
			explanation.find(".ex_tit").css("margin-bottom",0);
			explanation.animate({
				width:"100"
			},300);
			explanation.find("ul").hide();
		}
	});
</script>
<?php $__Template->display($this->getTpl("admin/footer")); ?>";s:12:"compile_time";i:1476854926;}";