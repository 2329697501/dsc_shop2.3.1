<?php exit;?>0014794826066854303c3b214f679b877fe4799152fds:2048:"a:2:{s:8:"template";s:1984:"<div class="search-div j-search-div ts-3">
    <section class="search">
        <form action="<?php echo U('category/index/products', array('id'=>$cat_id));?>" method="post" id="search-form">
            <div class="text-all dis-box j-text-all text-all-back">
                <a class="a-icon-back j-close-search" href="javascript:;"><i class="iconfont icon-back"></i></a>
                <div class="box-flex input-text">
                    <input class="j-input-text" style="padding-left: 2px" type="text" name="inputkeyword" placeholder="<?php if($keywords) { ?><?php echo $keywords; ?><?php } else { ?>商品搜索<?php } ?>" />
                    <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                </div>
                <a type="button" class="btn-submit">搜索</a>
            </div>
        </form>
    </section>
    <section class="search-con">
        <div class="swiper-scroll history-search">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <p class="hos-search">
                        <label class="fl">最近搜索</label>
                        <span class="fr clear_history"><i class="iconfont icon-xiao10"></i></span>
                    </p>
                    <ul class="hot-search a-text-more a-text-one" id="search-con">
                        <?php $n=1;if(is_array($history_keywords)) foreach($history_keywords as $v) { ?>
                        <?php if($v) { ?>
                        <li><a href="<?php echo U('store/index/pro_list', array('keyword'=>$v,'ru_id'=>$ru_id));?>"><span><?php echo $v; ?></span></a></li>
                        <?php } ?>
                        <?php $n++;}unset($n); ?>
                    </ul>
                </div>
            </div>
        <div class="swiper-scrollbar"></div>
        </div>
    </section>
    <footer class="close-search j-close-search">
        点击关闭
    </footer>
</div>";s:12:"compile_time";i:1479396206;}";