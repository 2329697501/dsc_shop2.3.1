<?php exit;?>00147692606934d48de4c33402536b93a2877c6e96f1s:996:"a:2:{s:8:"template";s:933:"<?php $__Template->display($this->getTpl("page_header")); ?>
<div class="topic-list">
	<script id="j-product" type="text/html">
		<%if totalPage > 0%>
		<%each list as val%>
		<section>
			<a href="<%val.url%>">
				<div class="act-header-box-list">
					<div class="act-right-box"><%val.keywords%></div>
					<img src="<%val.topic_img%>">
				</div>
				<div class="padding-all b-color-f ">
					<h3 class="my-u-title-size"><%val.title%></h3>
					<p class="act-cont"><%val.start_time%> - <%val.end_time%> </p>
				</div>
			</a>
		</section>
		<%/each%>
		<%else%>
		<div class="no-div-message">
			<i class="iconfont icon-biaoqingleiben"></i>
			<p>亲，此处没有内容～！</p>
		</div>
		<%/if%>
	</script>
</div>
<script>
	//异步数据
	$(function(){
		var url = "<?php echo U('index');?>";
		$('.topic-list').infinite({url: url, template:'j-product'});
	})
</script>
	</body>

</html>";s:12:"compile_time";i:1476839669;}";