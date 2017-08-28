<?php exit;?>001477298779806819d1baa87eca7bd263d758ecd6dcs:6026:"a:2:{s:8:"template";s:5962:"<?php $__Template->display($this->getTpl("page_header-nav")); ?>
<div class="con">
    <div class="category-top blur-div">
        <header>
            <section class="search">
                <div class="text-all dis-box j-text-all text-all-back">
                    <a class="a-icon-back j-close-search" href="javascript:history.go(-1);"><i class="iconfont icon-back"></i></a>
                    <div class="box-flex input-text n-input-text i-search-input">
                        <a class="a-search-input j-search-input" href="javascript:void(0)"></a>
                        <i class="iconfont icon-sousuo"></i>
                        <input class="j-input-text" type="text" placeholder="商品/店铺搜索" />
                        <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                    </div>
                    <?php if($cat_id) { ?>
                    <a href="javascript:void(0)" class="s-filter j-s-filter">筛选</a>
                    <?php } ?>
                </div>
            </section>
        </header>
        <aside>
            <div class="menu-left m-b7" id="sidebar">
                <div class="swiper-scroll">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <ul>
                                <?php $n=1;if(is_array($category)) foreach($category as $key=>$val) { ?>

                                <li data="<?php echo U('category/index/childcategory', array('id'=>$val['id']));?>" data-id="<?php echo $val['id']; ?>"><?php echo sub_str($val['name'], 4,'');?></li>

                                <?php $n++;}unset($n); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <section class="menu-right padding-all m-b7">
           <div class="loading"><img src="<?php echo __TPL__;?>img/loading.gif" /></div> 
            <!--<ul class="mune-no-img"></ul>-->
            <ul class="child_category"></ul>
            <script id="category" type="text/html">
            <%each category as value%>
                    <%if value.cat_id%>
                    <a href="<%value.url%>"><h5><%value.name%></h5></a>
                    <!--<ul class="mune-no-img">-->
                    <ul>
                    <%each value.cat_id as cat%>
                        <li class="w-3"><a href="<%cat.url%>"></a><img src="<%cat.cat_img%>" alt="<%cat.name%>" /><span><%cat.name%></span></li>
                    <%/each%>
                    </ul>
                    <%else%>
                    <li class="w-3"><a href="<%value.url%>"></a><img src="<%value.cat_img%>" alt="<%value.name%>" /><span><%value.name%></span></li>
                    <%/if%>
            <%/each%>
            </script>
        </section>
    </div>
    	<!--悬浮菜单s-->
	<div class="filter-top filter-top-index" id="scrollUp">
		<i class="iconfont icon-jiantou"></i>
	</div>

	<footer class="footer-nav dis-box">
		<a href="<?php echo U('site/index/index');?>" class="box-flex nav-list">
			<i class="nav-box i-home"></i><span>首页</span>
		</a>
		<a href="<?php echo U('category/index/index');?>" class="box-flex nav-list  active">
			<i class="nav-box i-cate"></i><span>分类</span>
		</a>
		<a href="javascript:;" class="box-flex nav-list j-search-input">
			<i class="nav-box i-shop"></i><span>搜索</span>
		</a>
		<a href="<?php echo U('cart/index/index');?>" class="box-flex position-rel nav-list">
			<i class="nav-box i-flow"></i><span>购物车</span>
		</a>
		<?php if($filter) { ?>
		<a href="<?php echo U('drp/user/index');?>" class="box-flex nav-list">
			<i class="nav-box i-user"></i><span><?php echo $custom; ?>中心</span>
		</a>
		<?php } elseif ($community) { ?>
		<a href="<?php echo U('community/index/index');?>" class="box-flex nav-list">
			<i class="nav-box i-user"></i><span>社区</span>
		</a>
		<?php } else { ?>
		<a href="<?php echo U('user/index/index');?>" class="box-flex nav-list">
			<i class="nav-box i-user"></i><span>我</span>
		</a>
		<?php } ?>
	</footer>
	<!--悬浮菜单e-->

<script type="text/javascript">
$(function(){
    var cat_id = 0;
    ajaxAction($("#sidebar li:first"), $("#sidebar li:first").attr("data"), $("#sidebar li:first").attr("data-id"));
    $("#sidebar li").click(function(){
        var li = $(this);
        var url = $(this).attr("data");
        var id = $(this).attr("data-id");
        ajaxAction(li, url, id);
    });
    function ajaxAction(obj, url, id){
        if(cat_id != id){
            $.ajax({
                type: 'get',
                url: url,
                data: '',
                cache: true,
                async: false,
                dataType: 'json',
                beforeSend: function(){
                    $(".loading").show();
                },
                success: function(result){
                    if(typeof(result.code) == 'undefined'){
                        $(".child_category").animate({
                            scrollTop: 0
                        }, 0);
                        template.config('openTag', '<%');
                        template.config('closeTag', '%>');
                        var html = template('category', result);
                        $(".child_category").html(html);
                        //$(".child_category ul").html(result);
                        obj.addClass("active").siblings("li").removeClass("active");
                    }
                    else{
                        d_messages(result.message);
                    }
                },
                complete: function(){
                    $(".loading").hide();
                }
            });
            cat_id = id;
        }
    }
})
</script>
	</body>
</html>
";s:12:"compile_time";i:1477212379;}";