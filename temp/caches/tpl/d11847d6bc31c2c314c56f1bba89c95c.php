<?php exit;?>001479718300441ace1e4e66229f0d9f6221dd7ad171s:2644:"a:2:{s:8:"template";s:2580:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="con">
	<div class="user-evaluation">
		<section class="product-list product-list-small">
			<ul>
				<li>
					<div class="product-div">
						<a class="product-div-link"
							href="<?php echo U('goods/index/index',array('id'=>$goods_info['goods_id']));?>"></a>
						<img class="product-list-img" src="../<?php echo $goods_info['goods_thumb']; ?>" />
						<div class="product-text">
							<h4><?php echo $goods_info['goods_name']; ?></h4>
						</div>
					</div>
				</li>
			</ul>
		</section>
		<form method="post" action="<?php echo U('add_comment');?>" name="theForm" enctype="multipart/form-data">
		<section class="m-top06 padding-all b-color-f">
			<div class="dis-box position-rel evaluation-all">
				<label class="t-remark g-t-temark">评价</label>
				<div class="evaluation-all-r j-evaluation-star">
					<span class="evaluation-star active ts-3"> <i
						class="iconfont icon-wujiaoxing"></i>
					</span> <span class="evaluation-star active ts-3"> <i
						class="iconfont icon-wujiaoxing"></i>
					</span> <span class="evaluation-star active ts-3"> <i
						class="iconfont icon-wujiaoxing"></i>
					</span> <span class="evaluation-star active ts-3"> <i
						class="iconfont icon-wujiaoxing"></i>
					</span> <span class="evaluation-star active ts-3"> <i
						class="iconfont icon-wujiaoxing"></i>
					</span> <input class="j-evaluation-value" type="hidden"
						name="comment_rank" value="5" />
				</div>
			</div>
		</section>
		<section class="m-top1px padding-all b-color-f">
			<div class="text-area1">
				<textarea rows="4" maxlength="100" placeholder="填写评论内容 (0-100字)" name="content"></textarea>
				<span></span>
			</div>
		</section>
        <section class="m-top1px padding-all b-color-f">
            <label class="t-remark g-t-temark" style="float:left">晒图</label><input  type="file" name="pic" >
        </section>
		<input type="hidden" name="comment_id" value="" />
		<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
		<input type="hidden" name="goods_id" value="<?php echo $goods_id; ?>" />
		<input type="hidden" name="sign" value="" />
		<input type="hidden" name="rec_id" value="" />
		<div class="ect-button-more padding-all">
            <button class="btn-submit box-flex" type="submit">提交评论</button>
        </div>
		</form>
		<section class="padding-all">
			<div id="demo" class="demo"></div>
		</section>
	</div>
</div>

</body>
</html>";s:12:"compile_time";i:1479631900;}";