<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<title>兑换详情</title>
<style type='text/css'>

       .addorder_user {height:54px;  background:#fff; padding:0 5px; border-bottom:1px solid #eaeaea; margin-top:-5px;}
    .addorder_user .info .ico { float:left;  height:50px; width:30px; line-height:50px; font-size:26px; text-align:center; color:#666}
    .addorder_user .info .info1 {width:100%; float:left;margin-left:-30px;margin-right:-30px;}
    .addorder_user .info .info1 .inner { margin-left:30px;margin-right:30px;overflow:hidden;}
    .addorder_user .info .info1 .inner .user { width:100%; font-size:16px; color:#333; line-height:35px;overflow:hidden;}
    .addorder_user .info .info1 .inner .address {height:20px; width:100%; font-size:14px; color:#999; line-height:20px;overflow:hidden;}
    .addorder_user .info .ico2 {height:50px; width:30px;padding-top:8px; float:right; font-size:16px; text-align:right; color:#999;}
   .addorder_user .info .info2{ margin-right: -45px;}
   .addorder_user .info .info2 .inner { margin-right:45px;overflow:hidden;}
    .addorder_user .info .ico3 { width:45px;}
	.addorder_user .info .ico3 i {font-size:24px; color:#999;}
        .chooser {overflow:auto; width: 100%; background:#efefef; position: fixed; top: 0px; right: -100%; z-index: 999;}
    .chooser .address {height:70px; background:#fff; padding:10px;; border-bottom:1px solid #eaeaea;}
    .chooser .address .ico {float:left; height:50px; width:30px; line-height:50px; float:left; font-size:20px; text-align:center; color:#999;}
    .chooser .address .info {height:50px; width:100%;float:left;margin-left:-30px;margin-right:-30px;}
    .chooser .address .info .inner { margin-left:35px;margin-right:30px;}
    .chooser .address .info .inner .name {height:28px; width:100%; font-size:16px; color:#666; line-height:28px;overflow:hidden;}
    .chooser .address .info .inner .addr {height:22px; width:100%; font-size:14px; color:#999; line-height:22px;overflow: hidden;}
    .chooser .address .edit {height:65px; width:30px; float:right;margin-left:-30px;text-align:center;line-height:50px;color:#666;}

    .chooser .add_address {height:54px; padding:5px; background:#fff; border-bottom:1px solid #eaeaea; line-height:44px; font-size:16px; color:#666;}

 .chooser_store { overflow: auto; width: 100%; background:#efefef; position: fixed; top: 0px; right: -100%; z-index: 999; }
    .chooser_store .store {height:50px; background:#fff; padding:10px;; border-bottom:1px solid #eaeaea;}
    .chooser_store .store .ico {float:left; height:50px; width:30px; line-height:50px; float:left; font-size:20px; text-align:center; color:#999;}
    .chooser_store .store .info {height:50px; width:100%;float:left;margin-left:-30px;margin-right:-45px;}
    .chooser_store .store .info .inner { margin-left:35px;margin-right:45px;}
    .chooser_store .store .info .inner .name {height:28px; width:100%; font-size:16px; color:#666; line-height:28px;overflow:hidden;}
    .chooser_store .store .info .inner .addr {height:22px; width:100%; font-size:14px; color:#999; line-height:22px;overflow: hidden;}
    .chooser_store .store .edit {height:50px; width:45px; float:right;margin-left:-30px;text-align:center;line-height:50px;color:#666;}
    .chooser_store .store .edit a { color:#999;}
    .chooser_store .store .edit i { font-size:24px; color:#999;}


    .address_main {height:100%; width:100%; background:#fff;  position: fixed; top: 0px; right: -100%; z-index: 9999;}


      .address_main {height:100%; width:100%; background:#fff;  position: fixed; top: 0px; right: -100%; z-index: 9999;}

    .address_main .line {height:44px; margin: 0 5px; border-bottom:1px solid #f0f0f0; line-height:44px;}


    .address_main .line input {float:left; height:44px; padding:0 5px;  border:0px; outline:none; font-size:16px; color:#666;padding-left:5px;}
    .address_main .line select  { border:none;height:25px;width:100%;color:#666;font-size:16px;line-height: 25px;}



    .address_main .address_sub1 {height:44px; margin:14px 5px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .address_main .address_sub2 {height:44px; margin:14px  5px; background:#ddd; border-radius:4px; text-align:center; font-size:18px; line-height:44px; color:#666; border:1px solid #d4d4d4;}
    .exchange_confirm {position: fixed;  bottom:0; width:100%; height:50px; line-height: 50px; background:#f90; color:#fff;font-size:14px; text-align: center;z-index:1000}
    .select { -webkit-appearance: none };

  .carrier_input_info {height:auto;width:100%; background:#fff; margin-top:14px;  border-bottom:1px solid #e8e8e8;}
    .carrier_input_info .row { padding:0 5px; height:40px; background:#fff; border-bottom:1px solid #e8e8e8; line-height:40px; color:#999;}
    .carrier_input_info .row .title {height:40px; width:85px; line-height:40px; color:#444; float:left; font-size:16px;}
    .carrier_input_info .row .info { width:100%;float:right;margin-left:-85px; }
    .carrier_input_info .row .inner { margin-left:85px; }
    .carrier_input_info .row .inner input {height:30px; color:#666;background:transparent;margin-top:0px; width:100%;border-radius:0;padding:0px; margin:0px; border:0px; float:left; font-size:16px;}
    .info_price .num2 {height: 55px;font-size: 24px;color: #f90;float: left;line-height: 55px;}
    .info_content{padding: 10px 17px;}
    .info_bottom legend{height: auto;margin-bottom: 10px;padding-bottom: 10px;}
    .info_bottom .footer{line-height: 15px;}
    #container{overflow: hidden;}
    .info_bottom .footer{height: 40px;}
    .page_topbar a.btn{height: auto;line-height: 31px;}
    .info_top .info{padding-top: 0px;}
    #cover img{width: auto;}
    .verify .btn{height: 40px !important;}


</style>
<script type="text/javascript" src="../addons/sz_yi/static/js/dist/area/cascade.js"></script>


<div id='address_container'></div>
<div id='container'></div>

<script id='tpl_address_list' type='text/html'>

    <div class="chooser choose_address" >
        <%each list as address%>
        <div class="address"
             data-addressid='<%address.id%>'
             data-realname='<%address.realname%>'
             data-mobile='<%address.mobile%>'
             data-address='<%address.address%>'
             >
            <div class="ico" ><%if selectedAdressID==address.id%><i class="fa fa-check" style="color:#0c9"></i><%/if%></div>
            <div class="info">
                <div class='inner'>
                    <div class="name"><%address.realname%>(<%address.mobile%>)</div>
                    <div class="addr"><%address.address%></div>
                </div>
            </div>
            <div class="edit"><i class='fa fa-pencil'></i></div>
        </div>
        <%/each%>
        <div class="add_address"><i class="fa fa-plus-circle" style="margin-left:3%; margin-right:10px; line-height:44px; font-size:20px;"></i>新增收货地址</div>
    </div>
</script>

<script id='tpl_address_new' type='text/html'>

    <input type='hidden' id='edit_addressid' value="<%address.id%>" />
    <div class="address_main" >
        <div class="line"><input type="text" placeholder="收件人" id="realname" value="<?php  if(address.realname) { ?><%address.realname%><?php  } ?>" /></div>
        <div class="line"><input type="text" placeholder="联系电话"  id="mobile" value="<?php  if(address.mobile) { ?><%address.mobile%><?php  } ?>"/></div>

        <div class="line"><select id="sel-provance" onchange="selectCity();" class="select"><option value="" selected="true">所在省份</option></select></div>
        <div class="line"><select id="sel-city" onchange="selectcounty()" class="select"><option value="" selected="true">所在城市</option></select></div>
        <div class="line"><select id="sel-area" class="select"><option value="" selected="true">所在地区</option></select></div>

        <div class="line"><input type="text" placeholder="详细地址"  id="address" value="<?php  if(address.address) { ?><%address.address%><?php  } ?>"/></div>
<!--        <div class="line"><input type="text" placeholder="邮政编码"  id="zipcode" value="<?php  if(address.zipcode) { ?><%address.zipcode%><?php  } ?>"/></div>-->

        <div class="address_sub1">确认</div>
        <div class="address_sub2">取消</div>
    </div>
</script>

<script type='text/html' id='tpl_main'>


		<div class="chooser_store" >
			<%each stores as store%>
			<div class="store"
				 data-storeid='<%store.id%>'
		data-storename='<%store.storename%>'
		data-address='<%store.address%>'
		data-lng='<%store.lng%>'
		data-lat='<%store.lat%>'
		data-tel='<%store.tel%>'
				 >
				<div class="ico store_ico_<%store.id%>" ><i class="fa fa-check" style="display:none;color:#0c9"></i></div>
				<div class="info">
					<div class='inner'>
						<div class="name"><%store.storename%></div>
						<div class="addr"><%store.address%></div>
					</div>
				</div>
				<div class="edit">
			<a href="tel:<%store.tel%>"><i class='fa fa-phone fa-2x'></i></a>
			 <a href="http://api.map.baidu.com/marker?location=<%store.lat%>,<%store.lng%>&title=<%store.storename%>&name=<%store.storename%>&content=<%store.address%>&output=html"><i class='fa fa-map-marker  fa-2x'></i></a></div>
			  </div>

			<%/each%>
	</div>

    <div class="page_topbar">
    <a href="<?php  echo $this->createPluginMobileUrl('creditshop/log')?>" class="back" ><i class="fa fa-angle-left"></i></a>
    <a href="<?php  echo $this->createPluginMobileUrl('creditshop')?>" class="btn" ><i class="fa fa-home"></i></a>
    <div class="title">兑换详情</div>
</div>
      <div class="info_top" onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%goods.id%>'">
    	<img src="<%goods.thumb%>"/>
        <div class="info">
        	<div class="classs"><%goods.subtitle%></div>
            <div class="name"><%goods.title%></div>
        </div>
    </div>

        <div class="info_price">
            <div class="num2">
            <%if goods.acttype==0%>
                 <%goods.credit%><i class="fa fa-database" style="margin-left: 5px;"></i> <i class="fa fa-plus" style='color:#999;'></i> <%goods.money%><i class="fa fa-rmb" style="margin-left: 5px;"></i>
            <%/if%>
            <%if goods.acttype==1%>
               <%goods.credit%><i class="fa fa-database" style="margin-left: 5px;"></i>
            <%/if%>

            <%if goods.acttype==2%>
               <%goods.money%><i class="fa fa-rmb" style="margin-left: 5px;"></i>
            <%/if%>
    <%if goods.acttype!=0 && goods.acttype!=1 &&goods.acttype!=2%>
			<span style="font-size:16px;line-height:55px;display:block;">免费<%if goods.type=='1'%>抽奖<%else%>兑换<%/if%></span>
			<%/if%>
            </div>
            <input type="hidden" id="needpaydispatch" value="<%if goods.isverify==0 && goods.dispatch>0%>1<%else%>0<%/if%>" />
            <%if goods.isverify==0%>

                <%if log.dispatchstatus==0%>

                        <%if goods.isendtime==1%>
                              <%if goods.currenttime>goods.endtime%>
                                  <div class="sub2">商品已过期</div>
                              <%else%>
                                  <%if goods.dispatch>0%>
                                  <div class="sub">支付运费</div>
                                  <%else%>
                                  <div class="sub">确认兑换</div>
                                  <%/if%>
                              <%/if%>
                         <%else%>
                                <%if goods.dispatch>0%>
                                  <div class="sub">支付运费</div>
                                  <%else%>
                                  <div class="sub">确认兑换</div>
                                  <%/if%>
                         <%/if%>
                 <%else%>
                 <div class="sub2">已兑换</div>
                 <%/if%>
            <%else%>
		  <%if log.storeid!='0'%>
                      <div class="sub2">已兑换</div>
		  <%else%>
		     <div class="sub">确认兑换</div>
		  <%/if%>
            <%/if%>
        </div>



        <div class="info_content">

            <%if goods.isverify==0%>

      <div class="addorder_user addorder_user_0">
          <input type='hidden' id='addressid' value='<%log.addressid%>' />
        <div class="info address_select" id='address_info' <%if log.addressid==0%>style='display:none'<%/if%>>
             <div class='info1'>
                 <div class='inner'>
                        <div class="user">收件人：<span id='address_realname'><%address.realname%></span>(<span id='address_mobile'><%address.mobile%></span>)</div>
                        <div class="address"><span id='address_address'><%address.address%></span></div>
                 </div>
             </div>
             <div class="ico2"><i class='fa fa-angle-right fa-2x'></i></div>
        </div>
        <%if log.addressid==0%>
        <div class='info address_select' id='address_select'>
            <div class='info1'>
                 <div class='inner'>
                     <div class="user" style='padding-top:8px;'>请选择收货地址</div>
                 </div>
            </div>
            <div class="ico2"><i class='fa fa-angle-right fa-2x'></i></div>
        </div>
        <%/if%>

    </div>
	 <%else%>
	 <input type='hidden' id='storeid' value='<%log.storeid%>' />
	  <div class="carrier_input_info" >
				<div class="row">
					<div class='title'>联系人姓名</div>
					<div class='info'>
						<div class='inner'><input type="text" placeholder="联系人姓名" id="carrier_realname" value="<%if log.realname==''%><%member.realname%><%else%><%log.realname%><%/if%>" style='height:40px;' <%if log.realname!=''%>readonly<%/if%>/></div>
					</div>
				</div>
				<div class="row">
					<div class='title'>联系人手机</div>
					<div class='info'>
						<div class='inner'><input type="text" placeholder="联系人手机"  id="carrier_mobile"value="<%if log.mobile==''%><%member.mobile%><%else%><%log.mobile%><%/if%>" style='height:40px;' <%if log.mobile!=''%>readonly<%/if%>/></div>
					</div>
				</div>
		</div>

	 <%if store%>
	    <div class="addorder_user" style='border-top:1px solid #e8e8e8; '>
	    <div class="info address_select" >
             <div class='info1 info2'>
                 <div class='inner'>
                        <div class="user"><%store.storename%></div>
                        <div class="address"><%store.address%></div>
                 </div>
             </div>
		<div class="ico2 ico3">
				<a href="tel:<%store.tel%>"><i class='fa fa-phone fa-2x'></i></a>
				<a href="http://api.map.baidu.com/marker?location=<%store.lat%>,<%store.lng%>&title=<%store.storename%>&name=<%store.storename%>&content=<%store.address%>&output=html"><i class='fa fa-map-marker  fa-2x'></i></a>
		</div>
        </div>
		</div>
	 <%else%>

	 <div class="addorder_user" id='store_info' style='display:none;'>
	    <div class="info address_select" >
             <div class='info1 info2'>
                 <div class='inner'>
                        <div class="user"></div>
                        <div class="address"></div>
                 </div>
             </div>
		<div class="ico2 ico3">
				<a href="#" class='tellink'><i class='fa fa-phone fa-2x'></i></a>
				<a href="#" class='maplink'><i class='fa fa-map-marker  fa-2x'></i></a>
		</div>
        </div>
		</div>

	   <div class="addorder_user store_select"  id='store_select'>
			     <div class='info store_select'>
				<div class='info1'>
					 <div class='inner'>
						 <div class="user" style='padding-top:8px;'>请选择兑换门店</div>
					 </div>
				</div>
				<div class="ico2"><i class='fa fa-angle-right fa-2x'></i></div>
	    </div>
	   </div>

	 <%/if%>


            <%/if%>

	   <%if goods.price>0%>
		<div class='ctitle'>商品原价: <span style='color:#f90'>￥<%=goods.price%></span></div>

            <%/if%>

            <%if goods.goodsdetail!=''%>
            <div class='ctitle'>商品简介:</div>
            <%=goods.goodsdetail%>
            <%/if%>


            <div class='ctitle'><%if goods.type=='1'%>活动<%else%>使用<%/if%>范围:</div>
            <div class='ccontent'><%if goods.area==''%>全国<%else%><%goods.area%><%/if%> <%if goods.dispatch>0%><span style='color:#f90'>(需额外支付运费<%goods.dispatch%>元)</span><%/if%></div>

            <%if goods.isendtime=='1'%>
            <div class='ctitle'><%if goods.type=='1'%>活动<%else%>使用<%/if%>有效期:</div>
            <div class='ccontent'>兑换之日起至<%goods.endtime_str%></div>
            <%/if%>

            <div class='ctitle'>兑换流程:</div>
            <%=goods.detail%>

            <%if goods.noticedetail!=''%>
              <div class='ctitle'>注意事项:</div>
                <%=goods.noticedetail%>
            <%/if%>

            <%if goods.subdetail!=''%>
              <div class='ctitle'>商家介绍:</div>
            <%=goods.subdetail%>
            <%/if%>

                <fieldset class="info_bottom">
                        <legend>重要说明</legend>

                        <div class="content" style="margin:0px;">
                        商品兑换流程请仔细参照商品详情页的"兑换流程"、"注意事项"与"使用时间"，除商品本身不能正常兑换外，商品一经兑换，一律不退还积分。（如商品过期、兑换流程操作失误、仅限新用户兑换)
                        </div>


            </fieldset>

      <%if goods.isverify==1 && log.status==2 && log.storeid!=0%>
         <div style='height:40px;'></div>
          <%/if%>
    </div>
    <div class="footer f-tac">
      活动由<?php  echo $shop['name'];?>提供，与商品生产公司无关。
    </div>

       <%if goods.isverify==1 && log.status==2 && log.storeid!=0%>
               <div class='exchange_confirm'>确认兑换</div>
        <%/if%>
 </script>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('pop', TEMPLATE_INCLUDEPATH)) : (include template('pop', TEMPLATE_INCLUDEPATH));?>
<script language="javascript">
    window.logid = '';
    window.selectStoreID = 0;
    require(['tpl', 'core'], function(tpl, core) {

         //新增地址
        function addAddress(obj) {

            core.json('shop/address', {'op': 'new'}, function(addaddress_json) {

                var result = addaddress_json.result;
                $('#address_container').html(tpl('tpl_address_new', result));
                cascdeInit(result.address.province,result.address.city);
                <?php  if($trade['shareaddress']=='1') { ?>
                    var shareAddress = <?php  echo json_encode($shareAddress)?>;
                                WeixinJSBridge.invoke('editAddress',shareAddress,function(res){
                                    if(res.err_msg=='edit_address:ok'){
                                        $("#realname").val( res.userName  );
                                        $('#mobile').val( res.telNumber );
                                        $('#address').val( res.addressDetailInfo );
                                        cascdeInit(res.proviceFirstStageName,res.addressCitySecondStageName,res.addressCountiesThirdStageName);
                                    }
                    });
                <?php  } ?>
					$(".chooser").height($(document.body).height());
                $(".address_main").animate({right: "0px"}, 200);
                $('.address_sub2').click(function() {
                    $(".address_main").animate({right: "-100%"}, 200);
                });
                $('.address_sub1').click(function() {
                    saveAddress($(this));
                });

            }, true);
        }

  //保存地址
        function saveAddress(obj) {
            if (obj.attr('saving') == '1') {
                return;
            }

            if ($('#realname').isEmpty()) {
                core.tip.show('请输入收件人!');
                return;
            }
            if (!$('#mobile').isMobile()) {
                core.tip.show('请输入正确的联系电话!');
                return;
            }
 	   if($('#sel-provance').val()=='请选择省份'){
                    core.tip.show('请选择省份!');
                    return;
                }
	       if($('#sel-city').val()=='请选择城市'){
                    core.tip.show('请选择城市!');
                    return;
                }
		  if($('#sel-area').val()=='请选择地区'){
                    core.tip.show('请选择地区!');
                    return;
                }
            if ($('#address').isEmpty()) {
                core.tip.show('请输入详细地址!');
                return;
            }
            $('.address_sub1').html('正在处理...').attr('disabled', true);
            obj.attr('saving', '1');
            core.json('shop/address', {
                op: 'submit',
                id: $('#edit_addressid').val(),
                addressdata: {
                    realname: $('#realname').val(),
                    mobile: $('#mobile').val(),
                    address: $('#address').val(),
                    province: $('#sel-provance').val(),
                    city: $('#sel-city').val(),
                    area: $('#sel-area').val(),
                 //   zipcode: $('#zipcode').val(),
                }
            }, function(saveaddress_json) {
                if (saveaddress_json.status == 1) {
                    $("#addressid").val(saveaddress_json.result.addressid);
                    $("#address_realname").html($('#realname').val());
                    $("#address_mobile").html($('#mobile').val());
                    $("#address_address").html($('#address').val());
                    $("#address_select").show();
                    $(".address_main").animate({right: "-100%"}, 200);
                    $('#address_new').hide();
                    $('#address_select').hide();
                    $('#address_info').show();
                }
                else {
                    core.tip.show('保存失败,请重试');
                }
                obj.removeAttr('saving');
            }, true, true);

        }
        function payDispatch(){
           var needdispatchpay = $('#needpaydispatch').val()=='1';
           require(['core', 'sweetalert'],function(core, swal){
                  if($("#addressid").val()=='' || $("#addressid").val()=='0'){
                     core.tip.show('请选择收货地址!') ;
                     return;
                  }
                  var tiptext= needdispatchpay?'确认兑换并支付运费吗？':'确认兑换吗?';

                  swal({ 'title':'',text:tiptext,
                                       confirmButtonText: '确 定',
                                       confirmButtonColor:'#f90' ,
                                       cancelButtonText: '取 消',
                                        showCancelButton: true,
                                   },function(isConfirm){

                                    if(isConfirm){
                                    	 core.loading();
                                          setTimeout(function(){
                                          core.pjson('creditshop/log' ,{'op':'paydispatch','id':"<?php  echo $_GPC['id'];?>",'addressid': $('#addressid').val()},function(json){
                                              var result = json.result;
                                                 if(needdispatchpay && !result.wechat){
                                                     core.tip.show(json.result);
                                                     return;
                                                 }
                                                 if(needdispatchpay){
	                                                 var wechat = result.wechat;
	                                                        require(['http://res.wx.qq.com/open/js/jweixin-1.0.0.js'],function(wx){
	                                                           jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || { jsApiList:[] };
	                                                           jssdkconfig.debug = false;
	                                                           jssdkconfig.jsApiList = ['checkJsApi','chooseWXPay'];
	                                                           wx.config(jssdkconfig);
	                                                            wx.ready(function () {
	                                                                   $('.button').removeAttr('submitting');
	                                                                    var appid = wechat.appid?wechat.appid:wechat.appId;
	                                                                   wx.chooseWXPay({
	                                                                       'appId' :  appid,
	                                                                       'timestamp': wechat.timeStamp,
	                                                                       'nonceStr' : wechat.nonceStr,
	                                                                       'package' :  wechat.package,
	                                                                       'signType' : wechat.signType,
	                                                                       'paySign' : wechat.paySign,
	                                                                       success: function (res) {
	                                                                              payResult();
	                                                                       },fail:function(res){
	                                                                              alert(res.errMsg);
	                                                                       }
	                                                                   });
	                                                               });
	                                                        });
                                                }else{
                                                	payResult();
                                                }
                                          },true,true);
                                          },1000);
                                    } else{
                                    	core.removeLoading();
                                    }
                             });

             });
        }

        function payResult(){
        	  var needdispatchpay = $('#needpaydispatch').val()=='1';
        	  var tiptext= needdispatchpay?'运费支付成功!':'兑换成功!';

              require(['core', 'sweetalert'],function(core, swal){
                     core.pjson('creditshop/log' ,{'op':'payresult','id':"<?php  echo $_GPC['id'];?>"},function(json){
                           var result = json.result;
                           if(json.status!=1){
                               core.tip.show(json.result);
                               return;
                           }
                           swal({ 'title':'',text:tiptext,
                                            confirmButtonText: '确 定',
                                            confirmButtonColor:'#f90' },function(){
                                            location.reload();
                           });
                    },true,true);
             });
        }
       function setStore(){

           require(['core', 'sweetalert'],function(core, swal){
         	if($.trim( $("#carrier_realname").val() )==''){
                     core.tip.show('请填写联系人!') ;
                     return;
                  }
		if($.trim( $("#carrier_mobile").val() )==''){
                     core.tip.show('请填写联系电话!') ;
                     return;
                  }
                  if($("#storeid").val()=='' || $("#storeid").val()=='0'){
                     core.tip.show('请选择兑换门店!') ;
                     return;
                  }

                  swal({ 'title':'',text:'确认选择此门店进行兑换吗？',
                                       confirmButtonText: '确 定',
                                       confirmButtonColor:'#f90' ,
                                       cancelButtonText: '取 消',
                                        showCancelButton: true,
                                   },function(isConfirm){

                                    if(isConfirm){
                                    	 core.loading();
											setTimeout(function(){
											core.pjson('creditshop/log' ,{'op':'setstore','id':"<?php  echo $_GPC['id'];?>",'storeid': $('#storeid').val(),'realname':$.trim( $("#carrier_realname").val() ),'mobile':$.trim( $("#carrier_mobile").val() )},function(json){
												if(json.status==1){
													   swal({ 'title':'',text:'操作成功，请到您选择的门店进行兑换！', imageUrl:'../addons/sz_yi/plugin/creditshop/template/mobile/default/images/lo1.gif',
													confirmButtonText: '确 定',
													confirmButtonColor:'#f90' },function(){
														location.reload();
													});
					   }else{
					   swal({ 'title':'',text:'兑换失败，请重试!',confirmButtonText: '确 定',confirmButtonColor:'#f90'},function(){
														location.reload();
												   });
						}

											},true,true);

                                          },1000);
                                    } else{
                                    	core.removeLoading();
                                    }
                             });

             });
        }

        core.pjson('creditshop/log',{op:'detail',id:"<?php  echo $_GPC['id'];?>"},function(json){
            var result = json.result;

            if(json.status==-1){
                core.message( json.result ,"<?php  echo $this->createPluginMobileUrl('creditshop/log')?>",'error');
                return;
            }

           $('#container').html(  tpl('tpl_main',result) );
           $('.chooser_store').height($(document.body).height());
           var canpay = false;
           var canselectaddress =false;
           var goods =result.goods;
           var log = result.log;
           if(goods.isverify==0){

                if(log.dispatchstatus==0){
                    canpay = true; //未付运费
                 	canselectaddress = true; //可以选择地址
                }
                if(goods.isendtime==1){
                   if(goods.currenttime>goods.endtime){
                      canpay = false;//不在期限内
                   }
                } else{
                     canpay =true;//无期限
                }
           } else{
	     if( log.storeid==0)		   {
			 canpay = true;
		 }
           }
           if(log.status==3){
               canpay = false;
           }


           if(canselectaddress) {
                    $('#address_new').click(function() {
                        addAddress($(this));
                    });

                    //选择地址
                     $('.address_select').click(function() {

                    core.json('shop/address', {}, function(addresslist_json) {
                        //默认地址
                        addresslist_json.result.selectedAdressID = $("#addressid").val();

                        $('#address_container').html(tpl('tpl_address_list', addresslist_json.result));
                        $('.address .ico,.address .info').click(function() {
                            var $this = $(this).parent();
                            $("#addressid").val($this.data('addressid'));
                            $("#address_realname").html($this.data('realname'));
                            $("#address_mobile").html($this.data('mobile'));
                            $("#address_address").html($this.data('address'));
                            $(".choose_address").animate({right: "-100%"}, 200);
                            $('#address_select').hide();
                            $('#address_info').show();
                        });
                        //地址编辑
                        $('.address .edit').click(function() {
                            var addressid = $(this).parent().data('addressid');
                            core.json('shop/address', {op: 'get', id: addressid}, function(getaddress_json) {
                                $('#address_container').html(tpl('tpl_address_new', getaddress_json.result));
								$(".chooser").height($(document.body).height());
                                $(".address_main").animate({right: "0px"}, 200);
                                var address = getaddress_json.result.address;
                                cascdeInit(address.province, address.city, address.area);
                                $('.address_sub2').click(function() {
                                    $(".address_main").animate({right: "-100%"}, 200);
                                });
                                $('.address_sub1').click(function() {
                                    saveAddress($(this));
                                });

                            }, true);
                        })
						$(".chooser").height($(document.body).height());
                        $(".choose_address").animate({right: "0px"}, 200);
                        $('.add_address').click(function() {
                            addAddress($(this));
                        })
                    }, true);

                });
            }

			if( goods.isverify==1  && log.storeid==0){
				 $('.chooser_store').css('height',$(document.body).height());
					$('.store_select').click(function(){

						$('.chooser .ico i').hide();
						$('.chooser .store_ico_' + window.selectStoreID + ' i').show();
						$(".chooser_store").animate({right: "0"}, 200);
						$('.chooser_store .store .info').unbind('click').click(function(){
							var store = $(this).closest('.store');
							var storeid = store.data('storeid');
							window.selectStoreID = storeid;
							var storename = store.data('storename');
							var address = store.data('address');
							$('#storeid').val(storeid);
							$('#store_info .user').html(storename);
							$('#store_info .address').html(address);
							$('#store_info .tellink').attr('href','tel:'+ store.data('tel'));
							var mapurl = "http://api.map.baidu.com/marker?location=" + store.data('lat') + "," + store.data('lng') + "&title=" +  store.data('storename') + "&name=" + store.data('storename') + "&content="+ store.data('address') + "&output=html";
							$('#store_info .maplink').attr('href',mapurl);
							$('#store_info').show();
						          $('#store_select').hide();

							 $(".chooser_store").animate({right: "-100%"}, 200);
						})
					});
			}

            if(canpay) {
                $('.sub').click(function(){
		  if(goods.isverify==0 ){
		       payDispatch();
		  }else{
	                 setStore();
		  }
                });
            }

           if(goods.isverify==1 && log.status==2){
                 $('.exchange_confirm').click(function(){
                      ExchangeHandler.verify(log.id);
                 });
           }

        },true);

    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
