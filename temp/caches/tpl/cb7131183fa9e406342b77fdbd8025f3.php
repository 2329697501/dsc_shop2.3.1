<?php exit;?>001479718296fde11ed3f284fabc8e7c68ca24249715s:1196:"a:2:{s:8:"template";s:1132:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con">
	<?php if($comment_list) { ?>
	<div class="user-evaluation">
		<section class="product-list product-list-small">
			<ul>
				<?php $n=1;if(is_array($comment_list)) foreach($comment_list as $comment) { ?>
				<li>
					<div class="product-div">
						<a class="product-div-link"
							href="<?php echo U('goods/index/index',array('id'=>$comment['goods_id']));?>"></a>
						<img class="product-list-img" src="<?php echo $comment['goods_thumb']; ?>" />
						<div class="product-text">
							<h4><?php echo $comment['goods_name']; ?></h4>
							<a
								href="<?php echo U('user/index/add_comment',array('order_id'=>$comment['order_id'], 'goods_id'=>$comment['goods_id']));?>"
								class="btn-submit1 fr">评价晒单</a>
						</div>
					</div>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
		</section>
	</div>
	<?php } else { ?>
	<div class="no-div-message">
		<i class="iconfont icon-biaoqingleiben"></i>
		<p>亲，您还没有需要评价的订单哦～！</p>
	</div>
	<?php } ?>
</div>
</body>
</html>
";s:12:"compile_time";i:1479631896;}";