<?php exit;?>001477357744c94e81de511ef78bdfda9fca20e8ef8bs:2424:"a:2:{s:8:"template";s:2360:"<?php $__Template->display($this->getTpl("admin/header")); ?>

<div class="wrapper">
	<div class="title">手机端-授权登陆</div>
	<div class="content">
		<div class="list-div" id="listDiv">
			<table id="list-table" cellpadding="0" cellspacing="0" border="0">
			  <tr class="active">
			    <th class="text-center" width="20%"><div class="tDiv">插件名称</div></th>
			    <th class="text-center"><div class="tDiv">插件版本</div></th>
			    <th class="text-center" width="15%"><div class="tDiv">插件作者</div></th>
			    <th class="text-center" width="15%"><div class="tDiv">作者QQ</div></th>
			    <th class="text-center" width="10%"><div class="tDiv">电子邮箱</div></th>
			    <th class="text-center" width="10%"><div class="tDiv">操作</div></th>
			  </tr>
			  <?php $n=1; if(is_array($modules)) foreach($modules as $key => $vo) { ?>
			  <tr>
			    <td class="text-center"><div class="tDiv"><?php echo $vo['name']; ?></div></td>
			    <td class="text-center"><div class="tDiv"><?php echo $vo['version']; ?></div></td>
			    <td class="text-center"><div class="tDiv"><?php echo $vo['author']; ?></div></td>
			    <td class="text-center"><div class="tDiv"><?php echo $vo['qq']; ?></div></td>
			    <td class="text-center"><div class="tDiv"><?php echo $vo['email']; ?></div></td>
			    <td class="text-center handle">
			    	  <div class="tDiv a3">
						    	<?php if($vo['install'] == 1) { ?>
						    	<a href="<?php echo U('edit', array('type'=>$vo['type']));?>" class="btn_edit"><i class="icon icon-edit"></i>编辑</a> | <a href="<?php echo U('uninstall', array('type'=>$vo['type']));?>" class="btn_trash"><i class="icon icon-trash"></i>卸载</a>
						    	<?php } else { ?>
						    	<a href="<?php echo U('install', array('type'=>$vo['type']));?>"  class="btn_inst"><i class="sc_icon sc_icon_inst"></i>安装插件</a>
						    	<?php } ?>
					    </div>
			    </td>
			  </tr>
			  <?php $n++;}unset($n); ?>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).on("mouseenter",".list-div tbody td",function(){
		$(this).parents("tr").addClass("tr_bg_blue");
	});

	$(document).on("mouseleave",".list-div tbody td",function(){
		$(this).parents("tr").removeClass("tr_bg_blue");
	});
</script>
<?php $__Template->display($this->getTpl("admin/footer")); ?>";s:12:"compile_time";i:1477271344;}";