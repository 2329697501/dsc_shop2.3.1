<?php exit;?>00147736458050fa1e060f7277a70fe79cb35e1834f2s:6979:"a:2:{s:8:"template";s:6915:"<?php $__Template->display($this->getTpl("page_header")); ?>

<div class="con mb-2">
    <header class="user-address-search dis-box j-search-address">
        <label class="b-color-f"><i class="iconfont icon-sousuo"></i>城市关键词</label>
    </header>
    <?php if(empty($_GET['keywords'])) { ?>
    <div class="user-add-title dis-box b-color-f padding-all" id="link_pos">
        <div class="box-flex">
            <h4>当前：<span class="j-current_city"><?php if($current_city['region_name']) { ?><?php echo $current_city['region_name']; ?><?php } else { ?>未知<?php } ?></span> <em class="col-9 f-05">GPS定位</em></h4>
        </div>
        <div class="box-flex position-rel">
            <a class="product-div-link" href=""><h4 class="fr"><i class="iconfont icon-dingwei1 color-red"></i>重新定位</h4></a>
        </div>
    </div>
    <section class="user-pos-left-maxbox">
        <div class="user-add-title user-pos-box">
            <h4>已定位城市</h4>
            <ul class="location-list-box of-hidden">
                <li class="switch_city">
                    <a class="j-current_location_city" href="javascript:void(0);">未知</a>
                </li>
            </ul>
        </div>
        <?php if($recent_city) { ?>
        <div class="user-add-title user-pos-box">
            <h4>最近访问城市</h4>
            <ul class="of-hidden">
                <?php $n=1; if(is_array($recent_city)) foreach($recent_city as $key => $vo) { ?>
                <li class="switch_city">
                    <a data-city="<?php echo $key; ?>" href="javascript:void(0);"><?php echo $vo; ?></a>
                </li>
                <?php $n++;}unset($n); ?>
            </ul>
        </div>
        <?php } ?>
        <div class="user-add-title user-pos-box" id="link_shop">
            <h4>热门城市</h4>
            <ul class="of-hidden">
                <li class="dis-flex switch_city">
                    <a data-city="52" href="javascript:void(0);">北京</a>
                </li>
                <li class="dis-flex switch_city">
                    <a data-city="321" href="javascript:void(0);">上海</a>
                </li>
                <li class="dis-flex switch_city">
                    <a data-city="76" href="javascript:void(0);">广州</a>
                </li>
                <li class="dis-flex switch_city">
                    <a data-city="77" href="javascript:void(0);">深圳</a>
                </li>
                <li class="dis-flex switch_city">
                    <a data-city="322" href="javascript:void(0);">成都</a>
                </li>
                <li class="dis-flex switch_city">
                    <a data-city="311" href="javascript:void(0);">西安</a>
                </li>
            </ul>
        </div>
    </section>
    <?php } else { ?>
    <div class="user-pos-search-list">
        <?php if($city_list) { ?>
            <span class="b-l-a-id">以下包含 “<?php echo $_GET['keywords']; ?>” 的城市</span>
        <?php } else { ?>
            <span class="b-l-a-id">没有找到 “<?php echo $_GET['keywords']; ?>” 相关的城市</span>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="user-pos-search-list" data-spy="scroll" data-target="#navbar-example" data-offset="0">
        <?php $n=1; if(is_array($city_list)) foreach($city_list as $key => $list) { ?>
        <a class="b-l-a-id" id="link_<?php echo $key; ?>"><?php echo $key; ?></a>
        <ul>
            <?php $n=1;if(is_array($list)) foreach($list as $city) { ?>
            <li class="switch_city">
                <a data-city="<?php echo $city['region_id']; ?>" href="javascript:void(0);"><?php echo $city['region_name']; ?></a>
            </li>
            <?php $n++;}unset($n); ?>
        </ul>
        <?php $n++;}unset($n); ?>
    </div>
    <div id="bs-example" class="b-l-page-pos-n">
        <ul class="nav bs-docs-sidenav" role="tablist">
            <li>
                <a href="#link_pos">#</a>
            </li>
            <li>
                <a href="#link_shop">热门</a>
            </li>
            <?php $n=1; if(is_array($city_list)) foreach($city_list as $key => $list) { ?>
            <li>
                <a href="#link_<?php echo $key; ?>"><?php echo $key; ?></a>
            </li>
            <?php $n++;}unset($n); ?>
        </ul>
    </div>
    <!--弹出搜索-->
    <section class=" t-search-footer">
        <form onsubmit="return doSearch();">
            <div class="user-address-search dis-box j-text-all">
                <div class="box-flex">
                    <div class="user-search-input position-rel">
                        <i class="iconfont icon-sousuo"></i>
                        <input class="j-input-text ts-5" name="keywords" type="text" placeholder="城市关键词" id="newinput"
                               autofocus="autofocus">
                        <i class="iconfont icon-guanbi1 is-null j-is-null now-top"></i>
                    </div>

                </div>
                <div class="user-right-search">
                    <div class="search-box b-color text-c">
                        <button>搜索</button>
                    </div>
                </div>
            </div>
            </from>
    </section>
    <div class="ec-fresh-bg ts-3"></div>
</div>

<script src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"></script>
<script>
    $(function ($) {
        $('body').scrollspy({
            target: '#bs-example'
        })

        // 查询城市信息
        var city_name = remote_ip_info.city;
        $.post('<?php echo U("info");?>', {city_name: city_name}, function(data){
            $('.j-current_location_city').attr('data-city', data.region_id).html(data.region_name);
        }, 'json')

        // 切换城市
        $('.switch_city').bind('click', function () {
            var city_id = $(this).children('a').attr('data-city');
            var city_name = $(this).children('a').text();

            $.post('<?php echo U("index");?>', {city_id: city_id, city_name: city_name}, function (data) {
                $('.j-current_city').html(city_name);
                d_messages('已切换到' + city_name);
                setTimeout(function(){
                    window.location.href = '<?php echo U("site/index/index");?>';
                }, 1000);
            });
        })
    });

    function doSearch(){
        var keyword = $('.j-input-text').val();
        if(keyword == ''){
            d_messages('请输入您要查找的城市名称');
            return false;
        }
        window.location.href = "<?php echo U('location/index/index');?>&keywords=" + keyword;
        return false;
    }
</script>
</body>
</html>";s:12:"compile_time";i:1477278180;}";