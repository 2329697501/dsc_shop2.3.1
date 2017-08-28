<?php exit;?>0014790160770969735e9d30a36ae56e00631791342cs:21562:"a:2:{s:8:"template";s:21497:"<?php $__Template->display($this->getTpl("page_header")); ?>
<body>
<form  name="formReturn" method="post" action="<?php echo U('user/refound/submit_return');?>" enctype="multipart/form-data" class="validform">
    <input type="hidden" name="return_type" value="0">
    <input name="return_rec_id" value="<?php echo $return_rec_id; ?>" type="hidden" />
    <input name="return_g_id" value="<?php echo $return_g_id; ?>" type="hidden" />
    <input name="return_g_number" value="<?php echo $return_g_number; ?>" type="hidden" />
    <div class="con m-b7">
        <!--商品list -s-->
        <section class="flow-checkout-pro j-flow-checkout-pro b-bor">
            <div class="product-list-small b-color-f dis-box">
                <ul class="box-flex flow-checkout-bigpic" style="display:block;">
                    <li>
                        <div class="product-div">
                            <img class="product-list-img" src="<?php echo $goods['goods_thumb']; ?>">
                            <div class="product-text">
                                <h4><?php echo $goods['goods_name']; ?></h4>
                                <p>
                                    <span class="p-price t-first "><em>¥</em><?php echo $goods['goods_price']; ?><small class="fr t-remark">x<?php echo $goods['goods_number']; ?></small></span>
                                </p>
                                <p class="dis-box p-t-remark"><?php echo $goods['goods_attr']; ?></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!--商品list -e-->
        <section class="user-return-list-box padding-all b-color-f m-top08">
            <h4 class="f-05 col-7">申请服务<em>*</em></h4>
            <div class="select-one-1 ect-bg-colorf user-service n-user-service">
                <ul class="dis-box j-get-one ect-radio-2 j-refound-type">
                    <li class="ect-select  list-select promotion my-but-pre j-return-rom">
                        <input name="return_type" type="radio" id="msg-type0" checked="checked" value="0">
                        <label class="ts-1 dis-block" for="msg-type0">维修<i></i></label>
                    </li>
                    <li class="ect-select my-but-pre j-return-attribute">
                        <input name="return_type" type="radio" id="msg-type1" value="2">
                        <label class="ts-1 dis-block" for="msg-type1">换货<i></i></label>
                    </li>
                    <li class="ect-select list-select hasgoods my-but-pre j-return-rom">
                        <input name="return_type" type="radio" id="msg-type2" value="1">
                        <label class="ts-1 dis-block" for="msg-type2">退货<i></i></label>
                    </li>
                </ul>
            </div>
        </section>
        <section class="user-return-list-box  b-color-f m-top08 user-return-attribute-box">
            <h4 class="f-05 col-7">换货属性<em>*</em></h4>
            <section class="j-refound-spec">
                <script id="j-refound" type="text/html">
                    <%each spec_list as spec key%>
                    <input type="hidden" name="attr_val[]" id="spec_<%key%>">
                    <div class="select-one user-service n-user-service s-return-box m-top1px">
                        <p class="f-03 col-7"><%spec.name%>:</p>
                        <!-- 判断属性是复选还是单选 -->
                        <ul class="select-one j-get-one m-top04">
                            <%each spec.values as spec_value%>
                            <a class="ect-select dis-flex position-rel fl" href="javascript:;">
                                <label class="ts-1 j-select-spec" id="for_<%key%>" value="<%spec_value.id%>"><%spec_value.label%></label>
                            </a>
                            <%/each%>
                        </ul>
                    </div>
                    <%/each%>
                </script>
            </section>
        </section>
        <section class="user-return-list-box padding-all b-color-f m-top08">
            <h4 class="f-05 col-7 j-refound-cause">退货原因<em>*</em></h4>
            <div class="user-return-content position-rel">
                <select class="select" name="parent_id">
                    <?php echo $cause_list; ?>
                </select>
                <i class="iconfont icon-more tf-90 ts-5"></i>
            </div>
        </section>
        <section class="user-return-list-box padding-all b-color-f m-top08">
            <h4 class="f-05 col-7">商品数量<em>*</em></h4>
            <div class="div-num dis-box m-top08">
                <a class="num-less" data-min-num="1"></a>
                <input class="box-flex" type="text" value="1" name="number" id="goods_number" readonly  nullmsg="换货数量不能为空" datatype="n" errormsg="换货数量为数字">
                <a class="num-plus" data-max-num="<?php echo $goods['goods_number']; ?>"></a>
            </div>

        </section>
        <section class="user-return-list-box padding-all b-color-f m-top08">
            <h4 class="f-05 col-7 j-refound-description">退款说明<em>*</em></h4>
            <div class="user-return-cont-right position-rel">
                <textarea rows="3" name="return_brief" placeholder="请填写退款描述"></textarea>
            </div>
        </section>
        <section class="user-return-list-box padding-all b-color-f m-top08">
            <input type="hidden" name="credentials" value="0">
            <li class="select-three j-select-all">
                <section class="j-get-i-more">
                    <header class="of-hidden dis-box">
                        <div class="ect-select box-flex">
                            <label class="dis-box label-this-all">
                                <em class=" box-flex f-06 col-3 n-ti-name"> 有质检报告</em>
                                <i class="j-select-btn"></i>
                            </label>
                        </div>
                    </header>
                </section>
            </li>
        </section>
        <section class="user-return-list-box padding-all b-color-f m-top08">
            <h4 class="f-05 col-7">图片信息</h4>
            <div class="form-group add-img-n-maxbox"style="margin-bottom:0">
                <div class=" ">
                    <div class="over-n position-rel n-apply-img-box" name="add_img"></div> 
                     <div class="n-add-ts-cont">
                        <input type='hidden' name='textfield' id='textfield' class='txt' />
                	 </div>
                </div>          
                <li class="user-return-img position-rel text-c m-top10">
                    <h5 class="m-top08"><i class="iconfont icon-jiahao"></i></h5>
                    <p class="f-03 col-9">上传凭证</p>
                    <input type="file" name="file" class="file" id="file" size="28" onchange="document.getElementById('textfield').value=this.value;UpladFile()" />
                </li>
            </div>
        </section>

        <!--个人信息-->
        <section class="user-return-list-box padding-all b-color-f m-top08">
            <h4 class="f-05 col-7">个人信息<em>*</em></h4>
            <ul class="user-register of-hidden">
                <li class="text-all dis-box j-text-all">
                    <div class="box-flex input-text">
                        <input class="j-input-text" type="text" name="addressee" placeholder="收货人" datatype="*" nullmsg="请输入收货人姓名" >
                        <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                    </div>
                </li>
                <li class="text-all dis-box j-text-all">
                    <div class="box-flex input-text">
                        <input class="j-input-text" type="tel" name="mobile" placeholder="手机号码"  datatype="m" errormsg="手机号码格式不正确" nullmsg="请填写手机号码">
                        <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                    </div>
                </li>
                <li class="text-all dis-box j-text-all">
                    <div class="box-flex input-text">
                        <input class="j-input-text" type="text" placeholder="请输入邮箱">
                        <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                    </div>
                </li>
                <li class="text-all n-return-box-list dis-box j-filter-city">
                    <div class="n-return-input">所在地区:</div>
                    <div class="box-flex"><span class="show-region text-all-span"><?php echo $user_address; ?></span>
                        <span class="t-jiantou fr"><i class="iconfont icon-jiantou tf-180"></i></span></div>
                </li>
                <li class="text-all dis-box j-text-all">
                    <div class="user-return-cont-left">详细地址 :</div>
                    <div class="box-flex">
                        <div class="user-return-cont-right position-rel">
                            <textarea rows="3" name="return_address" tip="请填写详细地址" altercss="user-return-cont-left" class="user-return-cont-left" datatype="*" nullmsg="请填写详细地址">请填写详细地址</textarea>
                        </div>
                    </div>
                </li>
                <li class="text-all dis-box">
                    <div class="user-return-cont-left">留言 :</div>
                    <div class="box-flex">
                        <div class="user-return-cont-right position-rel">
                            <textarea rows="3" name="return_remark" tip="请填写留言" altercss="user-return-cont-left" class="user-return-cont-left">请填写留言</textarea>
                        </div>
                    </div>
                </li>
            </ul>
        </section>

        <div class="filter-city-div ts-5 c-filter-div c-city-div">
            <section>
                <input type="hidden" value="<?php echo $user_address_id['province']; ?>" id="province_id" name="province_region_id">
                <input type="hidden" value="<?php echo $user_address_id['city']; ?>" id="city_id" name="city_region_id">
                <input type="hidden" value="<?php echo $user_address_id['district']; ?>" id="district_id" name="district_region_id">
                <input type="hidden" value="<?php echo $region_id; ?>" id="region_id" name="region_id">
            </section>
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
        <div class="padding-all user-bg m-top12">
            <h4 class="f-05 col-6 mb-1"> 服务说明</h4 >
            <p class="f-03 col-9">1.附件赠品，退换货时请一并退回。</p>
            <p class="f-03 col-9 m-top04">2.关于物流损，请您在收到货时务必仔细检查，如发现商品外包装或商品本身外观存在异常，需当场向派送人员指出，并拒收整个包裹；如您在收到货后发现外观异常，请在收货24小时内提交退换货申请，如超时未申请，将无法受理。</p>
            <p class="f-03 col-9 m-top04">3.关于商品实物与网站描述不符；商创保证所出商品均为正品行货，并与时下市场上同样直流商品一致，但因厂家会在没有任何提前通知的情况下更改产品包装，产地或者一些附件，所以我们无法确保您收到的货物与商城图片、产地、附件说明完全一致。</p>
            <p class="f-03 col-9 m-top04">4、如果您在使用时对商品质量表示置疑，您可出具相关书面鉴定，我们会按照国家法律规定予以处理。</p>
        </div>
    </div>

    <section class="filter-btn dis-box">
        <input type="submit" class="btn-submit box-flex click-show-attr add-to-cart" value="提交申请">
    </section>
</form>
<!--引用js-->
<script type="text/javascript">
    //退货属性
    $(".j-return-attribute").click(function() {
        $(".user-return-attribute-box").addClass("active");
        swiper_scroll();
    });
    $(".j-return-rom").click(function() {
        $(".user-return-attribute-box").removeClass("active");
    });
    //表单验证
    $(".validform").Validform({
        tipSweep : true,
        tiptype : function(msg){
            d_messages(msg);
        }
    });

    var xhr;
    function createXMLHttpRequest()
    {
        if(window.ActiveXObject)
        {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        else if(window.XMLHttpRequest)
        {
            xhr = new XMLHttpRequest();
        }
    }
    function UpladFile()
    {
        var fileObj = document.getElementById("file").files[0];
        if(fileObj == undefined){
            return false;
        }
        var rec_id  = $('input[name="return_rec_id"]').val();
        var FileController = "<?php echo U('user/refound/img_return');?>";
        var form = new FormData();
        form.append("myfile", fileObj);
        form.append("rec_id", rec_id);
        createXMLHttpRequest();
        xhr.onreadystatechange = handleStateChange;
        xhr.open("post", FileController, true);
        xhr.send(form);
    }
    function handleStateChange()
    {
        if(xhr.readyState == 4)
        {
            if (xhr.status == 200 || xhr.status == 0)
            {
                var result = xhr.responseText;
                var obj =  JSON.parse(result);
                if(obj.error == 1){
                    d_messages(obj.content);
                    return false;
                }
                var i = '';
                var new_img = '';

                $('div[name="add_img"]').empty();
                for (i=0;i<obj.length;i++){
                    new_img += "<div class='goods-info-img-box'><div class='goods-info-img'><img src='" + obj[i].pic + "' width='100%'/></div></div>";
                    new_img += "<input name='img[]' type='hidden' value='"+obj[i].pic+"'>";
                }
                new_img += '<a class="apply_goods_return clear_pictures" href="javascript:void(0);">清空图片</a>';
                $('div[name="add_img"]').append(new_img);
            }
        }
    }
    var rec_id = $("input[name='return_rec_id']").val();

    $('div[name=add_img]').on( 'click','.clear_pictures',function(){
        $.post("<?php echo U('clear_pictures');?>", {rec_id:rec_id}, function(data){
            if(data.error == 0){
                $('div[name=add_img]').empty();
            }
        }, 'json');
    });

    $('.j-select-btn').click(function(){
        var cre = $('input[name="credentials"]').val();
        if(cre == 0){
            $('input[name="credentials"]').val(1);
        }else{
            $('input[name="credentials"]').val(0);
        }
    });

    //换货数量
    var num;
    var min_num;
    var max_num;
    $(".div-num a").click(function () {
        if ($(this).hasClass("num-less")) {
            num = parseInt($(this).siblings("input").val());
            min_num = parseInt($(this).attr("data-min-num"));
            if (num > min_num) {
                num -= 1;
                $(this).siblings("input").val(num);
            } else {
                d_messages("不能小于最小数量");
                $(this).siblings("input").val(min_num);
            }
            return false;
        }
        if ($(this).hasClass("num-plus")) {
            num = parseInt($(this).siblings("input").val());
            max_num = parseInt($(this).attr("data-max-num"));
            if (num < max_num) {
                num += 1;
                $(this).siblings("input").val(num);
            } else {
                d_messages("不能大超过最大数量");
                $(this).siblings("input").val(max_num);
            }
            return false;
        }
    });
    $('input[name=attr_num]').blur(function(){
        num = parseInt($(this).val());
        min_num = parseInt($(this).siblings('a.num-less').attr('data-min-num'));
        max_num = parseInt($(this).siblings('a.num-plus').attr('data-max-num'));
        if(num < min_num){
            d_messages("不能小于最小数量");
            $(this).val(min_num);
            return false;
        }else if(num > max_num){
            d_messages("不能大超过最大数量");
            $(this).val(max_num);
            return false;
        }
    });


    //退换货类型切换
    var reound_data = '';
    var html = '';
    $.ajaxSetup({
        async : false
    });
    $('.j-refound-type li').click(function(){
        if($(this).index() == 0){
            $('.j-refound-cause').html('维修原因<em>*</em>');
            $('.j-refound-description').html('维修说明<em>*</em>');
            $('.j-refound-description').parent().find('[name=return_brief]').attr('placeholder', '请填写维修说明')
        }else if($(this).index() == 1){
            $('.j-refound-cause').html('换货原因<em>*</em>');
            $('.j-refound-description').html('换货说明<em>*</em>');
            $('.j-refound-description').parent().find('[name=return_brief]').attr('placeholder', '请填写换货说明')

            var id = $('input[name=return_rec_id]').val();
            $('.j-refound-data').empty();

            if(reound_data == ''){
                $.post("<?php echo U('get_spec');?>", {id:id}, function(data){
                    if(data.error == 0){
                        reound_data = data;
                    }
                },'json','');
            }
            template.config('openTag', '<%');
            template.config('closeTag', '%>');
            var t = template('j-refound', {spec_list : reound_data.spec});
            $('.j-refound-spec').html(t);

        }else if($(this).index() == 2){
            $('.j-refound-cause').html('退货原因<em>*</em>');
            $('.j-refound-description').html('退货说明<em>*</em>');
            $('.j-refound-description').parent().find('[name=return_brief]').attr('placeholder', '请填写退货说明')
        }
    });
    //商品属性选择
    $('.j-refound-spec').on('click', '.j-select-spec', function(){
        var label_id = $(this).attr('id');
        label_id = label_id.replace('for', 'spec');
        $('#'+label_id).val($(this).attr('value'));
    });
</script>
</body>
</html>";s:12:"compile_time";i:1478929677;}";