<?php exit;?>001479804951d67a239ee077f900415db208e5b5d9acs:6288:"a:2:{s:8:"template";s:6224:"<?php $__Template->display($this->getTpl("page_header")); ?>
            <form action="<?php echo U('flow/index/add_address');?>" method="post">
                <div class="con b-color-f">
                    <div class="flow-consignee margin-lr">
                        <section>
                            <input type="hidden" value="<?php echo $province_row['region_id']; ?>" id="province_id" name="province_region_id">
                            <input type="hidden" value="<?php echo $city_row['region_id']; ?>" id="city_id" name="city_region_id">
                            <input type="hidden" value="<?php if($district_row['region_id']) { ?><?php echo $district_row['region_id']; ?><?php } else { ?>0<?php } ?>" id="district_id" name="district_region_id">
                            <input type="hidden" value="<?php echo $region_id; ?>" id="region_id" name="region_id">
                        </section>
                        <div class="text-all dis-box j-text-all">
                            <label>收货人</label>
                            <div class="box-flex input-text">
                                <input name='consignee' class="j-input-text" type="text" placeholder="请输入收货人姓名" />
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                        </div>
                        <div class="text-all dis-box j-text-all">
                            <label>手机号码</label>
                            <div class="box-flex input-text">
                                <input class="j-input-text" name='mobile' type="tel" placeholder="请输入联系电话" />
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                        </div>
                        <section class="text-all j-filter-city">
                                <label class="fl">所在地区</label>
                                <span class="show-region text-all-span">请选择</span>
                                <span class="t-jiantou fr"><i class="iconfont icon-jiantou tf-180"></i></span>

                        </section>
                       <div class="text-all ">
                            <label>详细信息</label>
                            <div class="box-flex input-text">
                                <input class="j-input-text" name='address' type="text" value="<?php echo $consignee_list['address']; ?>" placeholder="详细地址" />
                                <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                            </div>
                        </div>
                        <div class="ect-button-more dis-box m-top12">
                            <input type="submit" name="submit"  class="btn-submit box-flex"  value="保存"/>
                        </div>
                    </div>
                </div>
                <div class="filter-city-div ts-5 c-filter-div c-city-div">

                    <section class="close-filter-div j-close-filter-div">
                        <div class="close-f-btn">
                            <i class="iconfont icon-fanhui"></i>
                            <span>关闭</span>
                        </div>
                    </section>
                    <section class="con-filter-div">
                        <aside>
                            <div class="menu-left j-city-left scrollbar-none" id="sidebar">
                                <ul >
                                    <!-- 省、直辖市 -->
                                    <?php $n=1;if(is_array($province_list)) foreach($province_list as $province) { ?>

                                    <li region="<?php echo $province['region_id']; ?>" <?php if($goods_region['province'] == $province['region_id']) { ?>class="active"<?php } ?> onclick="region.getBbb(<?php echo $province['region_id']; ?>, 2, <?php echo $user_id; ?>)"><?php echo $province['region_name']; ?></li>
                                    <?php $n++;}unset($n); ?>
                                </ul>
                            </div>
                        </aside>
                        <section class="menu-right j-city-right">
                            <div class="select-two j-get-city-one">
                                <?php $n=1;if(is_array($city_list)) foreach($city_list as $city) { ?>
                                <?php if($city['district_list']) { ?>

                                <ul class="padding-all j-sub-menu">
                                    <?php $n=1;if(is_array($city['district_list'])) foreach($city['district_list'] as $district) { ?>
                                    <li class="ect-select">
                                        <label onclick="region.cccDdd(<?php echo $district['region_id']; ?>, <?php echo $city['region_id']; ?>, <?php echo $user_id; ?>)" class="ts-1 <?php if($goods_region['district'] == $district['region_id']) { ?>active<?php } ?>"><?php echo $district['region_name']; ?><i class="fr iconfont icon-gou ts-1"></i></label>
                                    </li>
                                    <?php $n++;}unset($n); ?>
                                </ul>
                                <?php } else { ?>
                                <a class="select-title padding-all j-menu-select" onclick="region.cccDdd(<?php echo $district['region_id']; ?>, <?php echo $city['region_id']; ?>, <?php echo $user_id; ?>)">
                                    <label class="fl"><?php echo $city['region_name']; ?></label>
                                    <span class="fr t-jiantou j-t-jiantou" id="j-t-jiantou"><i class="iconfont icon-jiantou tf-180 ts-2"></i></span>
                                </a>
                                <?php } ?>
                                <?php $n++;}unset($n); ?>
                            </div>
                            
                        </section>
                    </section>
                    
                </div>
          </form>
	</body>

</html>";s:12:"compile_time";i:1479718551;}";