<?php exit;?>00147959764681cbe15d23d0e074596d80bb12c70776s:1189:"a:2:{s:8:"template";s:1125:"<?php $__Template->display($this->getTpl("page_header")); ?>
	<body> 
		<div class="con">
			<div id="bs-example" class="b-l-page-pos">
					<ul class="nav bs-docs-sidenav" role="tablist">
					<?php $n=1;if(is_array($list)) foreach($list as $lis) { ?>
						<li ><a href="#link_<?php echo $lis['info']; ?>"><?php echo $lis['info']; ?></a></li>
					<?php $n++;}unset($n); ?>
					</ul>
			</div>
			<div class="brand-list-page brand-list-page" data-spy="scroll" data-target="#navbar-example" data-offset="0" >
			<?php $n=1;if(is_array($list)) foreach($list as $lis) { ?>
				<a class="b-l-a-id" id="link_<?php echo $lis['info']; ?>"><?php echo $lis['info']; ?></a>
				<ul>
				<?php $n=1;if(is_array($lis['list'])) foreach($lis['list'] as $li) { ?>
					<li><a href="<?php echo $li['url']; ?>"><img src="<?php echo $li['brand_logo']; ?>"><span><?php echo $li['brand_name']; ?></span></a></li>
				<?php $n++;}unset($n); ?>
				</ul>
			<?php $n++;}unset($n); ?>
			</div>
		</div>
		<script>
		$(function($){ 	
			$('body').scrollspy({target: '#bs-example'})
		});
		</script>
	</body>

</html>";s:12:"compile_time";i:1479511246;}";