<?php exit;?>001479745778f42a2dbfd6c2c33b5d96a479b68d4903s:2623:"a:2:{s:8:"template";s:2559:"<?php $__Template->display($this->getTpl("page_header")); ?>
<body class="b-color-f">

		<div class="con" >

			<form action="<?php echo U('add_card');?>" method="post" onsubmit="return formcheck()">
				<section class="user-center j-f-tel margin-lr">
					<div class="text-all dis-box j-text-all bank_card">
						<label>卡号</label>
						<div class="box-flex input-text">
							<input class="j-input-text inputcard" type="tel" name="bank_card" placeholder="银行卡号" name='band_card'/>
							<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
						</div>
					</div>
					<div class="text-all dis-box j-text-all bank_user_name">
						<label>持卡人</label>
						<div class="box-flex input-text">
							<input class="j-input-text inputcard" type="text" name="bank_user_name" placeholder="持卡人姓名" />
							<i class="iconfont icon-guanbi1 is-null j-is-null"></i>
						</div>
					</div>
                    <div class="text-all dis-box j-text-all bank_region">
                        <label>开户行</label>
                        <div class="box-flex input-text">
                            <input class="j-input-text inputcard" type="text" name="bank_region" placeholder="如:工商银行上海XXX路支行" />
                            <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                        </div>
                    </div>
                    <div class="text-all dis-box j-text-all bank_name">
                        <label>银行</label>
                        <div class="box-flex input-text">
                            <input class="j-input-text inputcard" type="text" name="bank_name" placeholder="如:工商银行" />
                            <i class="iconfont icon-guanbi1 is-null j-is-null"></i>
                        </div>
                    </div>
                    <button type="submit" value="sub" class="btn-submit">提交</button>
					
				</section>
			</form>
		</div>
<script>
    $(":input").keyup(function (){
        var name = $(this).attr("name");
        $("."+name).removeClass("active");
    });
    function formcheck(){
    var check = 0;
        $(".inputcard").each(function(){
          if($(this).val()==''){
              var name = $(this).attr("name");
              $("."+name).addClass("active");
              d_messages('请输入完整的信息', 2);
              check = 1;
          }
        })
     if(check){
         return false;
     }
   }
</script>
	</body>

</html>";s:12:"compile_time";i:1479659378;}";