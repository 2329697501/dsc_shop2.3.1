<?php exit;?>001476930614a49dde436056c5dfb35ab75e80cf50bbs:6590:"a:2:{s:8:"template";s:6526:"<!--晒单列表-->
<div class="community-list">
    <script id="j-product" type="text/html">
        <%if totalPage > 0%>
        <%each list as val%>
        <section class="com-nav m-top06" id="delete_mycom<%val.dis_id%>">
                <?php if($action == 'index' ||  $action == 'list') { ?>
                <ul class="dis-box padding-all">
                    <li class="com-left">
                        <div class="com-left-box"><img src="<%val.user_picture%>"></div>
                    </li>
                    <li class="box-flex">
                        <div class="com-adm-box new-t">
                            <h4><%val.user_name%></h4>
                        </div>
                    </li>
                    <li>
                        <div class="t-time"><i class="iconfont icon-shijian my-com-size"></i><span><%val.add_time%></span></div>
                    </li>
                </ul>
                <?php } else { ?>
                <div class="dis-box padding-all">
                    <div class="box-flex position-rel">
                        <a href="<%val.url%>" class="link-abs"> </a>
                            <div class="com-left-box fl"><img src="<%val.user_picture%>"></div>
                            <div class="fl com-adm-box">
                                <h4><%val.user_name%></h4>
                                <p><%val.add_time%></p>
                            </div>
                    </div>
                    <span><i class="iconfont icon-xiao10 my-com-size" onclick="delete_com(<%val.dis_type%>,<%val.dis_id%>)"></i></span>
                </div>
                <?php } ?>
            <div class="margin-lr com-min-tit position-rel">
                <a href="<%val.url%>" class="link-abs"> </a>
                <%if val.dis_type == 1%>
                <em class="em-promotion-1 tm-ns">讨</em>
                <%else if val.dis_type == 2%>
                <em class="em-promotion-1 tm-ls">问</em>
                <%else if val.dis_type == 3%>
                <em class="em-promotion-1">圈</em>
                <%else if val.dis_type == 4%>
                <em class="em-promotion-1 tm-hs-1">晒</em>
                <%/if%>
                <span> <%val.dis_title%></span>
            </div>
            <div class="user-nav-box  com-list dis-box text-center">
                <div class="box-flex" onClick="tz_dianzan(<%val.dis_type%>,<%val.dis_id%>)">
                    <a href="javascript:;" id="red<%val.dis_id%>" <%if val.islike == 1%>
                    class="active"<%else%><%/if%>>
                    <div class="com-icon">
                        <i class="iconfont icon-zan"></i>
                        <span id="like_num<%val.dis_id%>"><%val.like_num%></span>
                        <input id="islike<%val.dis_id%>" type="hidden" id="<%val.dis_id%>" name="islike"
                               value="<%val.islike%>"/>
                        <input id="isclick" type="hidden" name="isclick" value="0"/>
                    </div>
                    </a>
                </div>
                <div class="box-flex">
                    <a href="<%val.url%>">
                        <div class="com-icon"><i
                                class="iconfont icon-daipingjia"></i><span><%val.community_num%></span></div>
                    </a>
                </div>
                <div class="box-flex">
                    <a href="javascript:;">
                        <div class="com-icon"><i
                                class="iconfont icon-liulan"></i><span><%val.dis_browse_num%></span></div>
                    </a>
                </div>
            </div>
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
<div class="mask-filter-div"></div>
<!--尾部浮动导航-->
<?php $__Template->display($this->getTpl("com_footer")); ?>
</div>
<!--引用js-->

<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/jquery.infinite.js"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__;?>script/template.js"></script>
<script>
    function delete_com(dis_type, dis_id) {
        layer.open({
            content: '确实要删除该帖吗？',
            btn: ['删除', '取消'],
            shadeClose: false,
            yes: function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo U('deletemycom');?>",
                    data: {dis_type: dis_type, dis_id: dis_id},
                    dataType: "json",
                    success: function (data) {
                        if (data.error == 0) {
                            $("#delete_mycom" + dis_id).remove('');
                            $.each($(".oncle-color a"),function(){
                                if($(this).attr('distype') == dis_type){
                                    var a = parseInt($(this).children('p').html())-1;
                                    $(this).children('p').html(a);
                                    d_messages('删除成功');
                                }
                            });
                        }
                    }
                });
            },
            no: function () {
            }
        });
    }
</script>
<script>
    function tz_dianzan(dis_type, dis_id) {
        var isclick = document.getElementById('isclick').value;
        $("#isclick").val(new Date().getTime());
        if (isclick < (new Date().getTime() - 1000)) {
            $.ajax({
                type: "post",
                url: "<?php echo U('like');?>",
                data: {dis_type: dis_type, dis_id: dis_id},
                dataType: "json",
                success: function (data) {
                    if (data) {
                        if (data.is_like == 1) {
                            $("#red" + dis_id).addClass("active");
                        } else {
                            $("#red" + dis_id).removeClass("active");
                        }
                        $("#like_num" + dis_id).html(data.like_num);
                        $("#islike" + dis_id).val(data.is_like);
                    }
                }
            });
        }
    }
</script>";s:12:"compile_time";i:1476844214;}";