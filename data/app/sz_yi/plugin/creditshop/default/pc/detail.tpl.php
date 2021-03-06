<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header_center', TEMPLATE_INCLUDEPATH)) : (include template('common/header_center', TEMPLATE_INCLUDEPATH));?>
<link href="../addons/sz_yi/plugin/creditshop/template/mobile/default/images/css.css" rel="stylesheet" type="text/css"/>
<title>商品详情</title>

<style type='text/css'>
    body{background: #fff;}
    .addorder_user {float:left;height:54px; width:100%;  background:#fff; border-bottom:1px solid #eaeaea; }
    .addorder_user .info .ico { float:left;  height:50px; width:30px; line-height:50px; font-size:26px; text-align:center; color:#666}
    .addorder_user .info .info1 {height:44px; width:100%; float:left;margin-left:-30px;margin-right:-30px;}
    .addorder_user .info .info1 .inner { margin-left:30px;margin-right:30px;overflow:hidden;}
    .addorder_user .info .info1 .inner .user {height:30px; padding-left:15px; width:100%; font-size:16px; color:#333; line-height:35px;overflow:hidden;}
    .addorder_user .info .info1 .inner .address {padding-left:15px; height:20px; width:100%; font-size:14px; color:#999; line-height:20px;overflow:hidden;}
    .addorder_user .info .ico2 {height:50px; width:30px;padding-right:15px;padding-top:15px; float:right; font-size:16px; text-align:right; color:#999;}

    .chooser { overflow: auto; width: 100%; background:#efefef; position: fixed; top: 0px; right: -100%; z-index: 999;}
    .chooser .store {height:50px; background:#fff; padding:10px;; border-bottom:1px solid #eaeaea;}
    .chooser .store .ico {float:left; height:50px; width:30px; line-height:50px; float:left; font-size:20px; text-align:center; color:#999;}
    .chooser .store .info {height:50px; width:100%;float:left;margin-left:-30px;margin-right:-45px;}
    .chooser .store .info .inner { margin-left:35px;margin-right:45px;}
    .chooser .store .info .inner .name {height:28px; width:100%; font-size:16px; color:#666; line-height:28px;overflow:hidden;}
    .chooser .store .info .inner .addr {height:22px; width:100%; font-size:14px; color:#999; line-height:22px;overflow: hidden;}
    .chooser .store .edit {height:50px; width:45px; float:right;margin-left:-30px;text-align:center;line-height:50px;color:#666;}
    .chooser .store .edit a { color:#999;}
    .chooser .store .edit i { font-size:24px; color:#999;}

  .carrier_input_info {height:auto;width:100%; background:#fff; margin-top:14px;  border-top:1px solid #e8e8e8;}
    .carrier_input_info .row { padding:0 15px; height:40px; background:#fff; border-bottom:1px solid #e8e8e8; line-height:40px; color:#999;}
    .carrier_input_info .row .title {height:40px; width:85px; line-height:40px; color:#444; float:left; font-size:16px;}
    .carrier_input_info .row .info { width:100%;float:right;margin-left:-85px; }
    .carrier_input_info .row .inner { margin-left:85px; }
    .carrier_input_info .row .inner input {height:30px; color:#666;background:transparent;margin-top:0px; width:100%;border-radius:0;padding:0px; margin:0px; border:0px; float:left; font-size:16px;}
 .sp-bg{background: #fff;overflow:hidden;}
 .info_top{width: 440px;height: 440px;margin:30px 0 30px 0;float: left;border: 1px solid #ddd;}
 .info_top>img{width:438px;height: 438px;}
 .right-sp{width: 700px;float: left;padding: 30px 3% 30px 3% ;}
/*新*/
 .right-sp>.info{height: 140px;line-height:15px;width: 100%;}
 .right-sp>.info>.name{height: 40px;width: 65%;font-size: 18px;color: #666;font-weight: 700;}
 .right-sp>.info>.price{ padding:12px 12px;background-color: #F3F3F3;height:90px;width: 100%;font-size: 14px;color: #666666;line-height: 40px;}
 .right-sp>.info>.price>.price_time{height: 30px;}
 .info_text{ padding:12px 20px 0 12px;width: 100%;font-size: 14px;color: #666666;line-height: 30px;}
 .info_text>.info_line{height: 30px;}
 .price_line_sp{color:#e31939;}
 .info_price{border-bottom: none;}
 .info_price .sub{background: #ff4a4e;color:#fff;border-radius: 0;width: 182px;height:40px;line-height:40px;text-align: center;float: left;margin:0 0 0 3px;}

 .sp-bg .menu {height: 40px; width: 100%;background: #fff!important;border: 1px solid #dddddd;}
 .sp-bg .menu .nav {
    height: 40px;
    width: 105px;
    float: left;
    font-size: 14px;
    color: #666;
    text-align: center;
    line-height: 40px;
    cursor: pointer;
}
 .sp-bg .menu .navon {
    width: 105px;
    height: 38px;
    line-height: 38px;
    background: #ff4a4e;
    border-top: 1px solid #ff4a4e!important;
    border-bottom: 1px solid #ff4a4e!important;
    color: #fff!important;
}
.selectAddress{padding: 0px 10px;border:1px solid #bbbbbb;width: 120px;margin-bottom: 10px;cursor: pointer;}
.selectAddress2{padding: 0px 10px;border:1px solid #bbbbbb;width: 80%;margin-bottom: 10px;cursor: pointer}
.selectAddress:hover{background: #f9f9f9;}
.f-fl{float: left;}
.notice{min-height: 100px;margin-top: 1px;border:1px solid #e6e6e6;border-top: 0px;padding: 30px 40px;color: gray;font-size: 13px;margin-bottom: 10px;}


</style>

<div id='container'  style="width:1200px;margin:10px auto 0;overflow: hidden;"></div>

<script type='text/html' id='tpl_main'>

    <div class="chooser" >
        <%each stores as store%>
        <div class="store"
             data-storeid='<%store.id%>'
	data-storename='<%store.storename%>'
	data-address='<%store.address%>'
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
	<!--
    <div class="page_topbar">
    <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
    <a href="<?php  echo $this->createPluginMobileUrl('creditshop')?>" class="btn" ><i class="fa fa-home"></i></a>
    <div class="title">商品详情</div>
</div>-->
<div class="sp-bg">
      <div class="info_top">
    	  <img src="<%goods.thumb%>"/>
      </div>
      <div class="right-sp">
      <div class="info">
             <div class="classs"><%goods.subtitle%></div>
            <div class="name"><%goods.title%></div>
            <div class="price">

                    <%if goods.canbuy%>
                     <div class="price_time">
                            活动时间：&nbsp;&nbsp;&nbsp;&nbsp;<span class="dtime"><%goods.timestarts%> —— <%goods.timeends%></span>
                      </div>
                      <div class="price_time">
                            剩余时间：&nbsp;&nbsp;&nbsp;&nbsp;<span class="stime">00 天 20 时 52 分 44 秒</span>
                      </div>
                       <!-- <%if goods.type=='1'%>立即抽奖<%else%>立即兑换<%/if%> -->

                    <%else%>

                       <%goods.buymsg%>

                    <%/if%>

            </div>
      </div>
      <div class="info_text">
         <div class="price_line">
                          使用范围：&nbsp;&nbsp;&nbsp;&nbsp;<span>全国</span>
        </div>
         <div class="price_line">
          <%if goods.price>0%>
                   商品原价：&nbsp;&nbsp;&nbsp;&nbsp;<span class="price_line_sp">￥<%=goods.price%></span>
          <%/if%>
        </div>
        <!-- 未选择地址时候 -->
        <!-- <div class="tab1">
          <div class="f-fl">收货地址：</div>
          <div class="selectAddress f-fl selectAdd">请选择收货地址</div>
        </div> -->

        <!-- 已选择地址时候 -->
       <!--  <div class="tab2">
         <div class="f-fl">收货地址：</div>
         <div class="selectAddress2 f-fl selectAdd">
             <div>
               <span style="margin-right: 20px;">收货人:小明</span>
               <span>联系电话:13288842752</span>
             </div>
             <div>
               <span>收货地址:广东省广州市天河区主机幼儿园</span>
             </div>
         </div>
       </div> -->
        <div class="cl-b"></div>
      </div>
      <div class="info_price">
           <!--  <div class="num">
            <%if goods.acttype==0%>
                 <%goods.credit%><i class="fa fa-database"></i> <i class="fa fa-plus" style='color:#999;'></i> <%goods.money%><i class="fa fa-rmb"></i>
            <%/if%>
            <%if goods.acttype==1%>
               <%goods.credit%><i class="fa fa-database"></i>
            <%/if%>

            <%if goods.acttype==2%>
               <%goods.money%><i class="fa fa-rmb"></i>
            <%/if%>

			<%if goods.acttype!=0 && goods.acttype!=1 &&goods.acttype!=2%>
			<span style="font-size:16px;line-height:55px;display:block;">免费<%if goods.type=='1'%>抽奖<%else%>兑换<%/if%></span>
			<%/if%>

            </div> -->
            <div class="<%if goods.canbuy%>sub<%else%>sub2<%/if%>" id="btnsub" style="margin-top: 5px;">
                     <%if goods.canbuy%>
                       <%if goods.type=='1'%>立即抽奖<%else%>立即兑换<%/if%>
                       <%else%>
                       <%goods.buymsg%>
                       <%/if%>
            </div>
            <div class="cl-b"></div>
            <div class="price_line" style="height:30px;line-height:30px;color:#666666;">兑换成功后，请在后面再进行确认填写好地址！</div>

        </div>

	      <%if goods.isverify==1 && goods.type==0%>

    <input type='hidden' id='storeid' value='' />
		 <div class="carrier_input_info" >
				<div class="row">
					<div class='title'>联系人姓名</div>
					<div class='info'>
						<div class='inner'><input type="text" placeholder="联系人姓名" id="carrier_realname" value="<%member.realname%>" style='height:40px;'/></div>
					</div>
				</div>
				<div class="row">
					<div class='title'>联系人手机</div>
					<div class='info'>
						  <div class='inner'><input type="text" placeholder="联系人手机"  id="carrier_mobile"value="<%member.mobile%>" style='height:40px;'/></div>
					</div>
				</div>
		</div>

		  <div class="addorder_user store_select" id="store_info" style="display:none;">

			<div class="info store_select">
				 <div class='info1'>
					 <div class='inner'>
							<div class="user"></div>
							<div class="address"></div>
					 </div>
				 </div>
				 <div class="ico2"><i class='fa fa-angle-right  fa-2x'></i></div>
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

       <!--  <div class="info_content">
               <div class="info_timestate" <%if goods.timestate==''%>style="display:none"<%/if%>></div>

		<%if goods.price>0%>
		<div class='ctitle'>商品原价: <span style='color:#f90'>￥<%=goods.price%></span></div>

    <%/if%>


        </div>
        </div> -->

</div>
<div class="cl-b"></div>
<div class="menu">
    <div id="nav_2" class="nav navon" onclick="tab(2)">商品简介</div>
    <div id="nav_3" class="nav" onclick="tab(3)">商家介绍</div>
</div>
<div>
  <div class="con" id="con_2" >
      <%if goods.noticedetail!=''%>
        <div class="notice">
            <div class='ctitle' style="margin-bottom: 15px;">注意事项:</div>
            <div style="line-height: 30px;font-size: 13px;"><%=goods.noticedetail%></div>
        </div>
      <%/if%>
      <div id='comment_container' style="margin:0 30px 30px;overflow: hidden;width:1140px;padding:10px">
          <%if goods.goodsdetail!=''%>
              <!-- <div class='ctitle'>商品简介:</div> -->
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






        <fieldset class="info_bottom">
            <legend>重要说明</legend>
            <div class=content>
              商品兑换流程请仔细参照商品详情页的"兑换流程"、"注意事项"与"使用时间"，除商品本身不能正常兑换外，商品一经兑换，一律不退还积分。（如商品过期、兑换流程操作失误、仅限新用户兑换)
             </div>
                 <!--  <div class=footer>
                  活动由<?php  echo $shop['name'];?>提供，与商品生产公司无关。
                 </div> -->

        </fieldset>
      </div>
  </div>
  <div class="con" id="con_3" style="display: none;">
    <div id='recommand_container' style="margin-top: 1px;padding: 30px 40px;color: gray;">
        <%if goods.subdetail!=''%>
            <%=goods.subdetail%>
          <%else%>
              暂无介绍
        <%/if%>
    </div>
  </div>
</div>

<style type="text/css">
    /* 简易数据表格-格边框 */
  .m-table{table-layout:fixed;width:100%;line-height:1.5;}
  .m-table th,.m-table td{padding:10px;border:1px solid #ddd;}
  .m-table th{font-weight:bold;}
  .m-table tbody tr:nth-child(2n){background:#fafafa;}
  .m-table tbody tr:hover{background:#f0f0f0;}
  .m-table .cola{width:100px;}
  .m-table .colb{width:200px;}
  /* 简易数据表格-行边框*/
  .m-table-row th,.m-table-row td{border-width:0 0 1px;}
  .red{color:#e31939;}
  .one{width: 50%;}
  .pop-choose-spec-main{padding: 10px;top:40%;}
  .inputModel{border:1px solid #eeeeee;padding: 5px;width: 65%;}
  .pop-choose-spec-main{margin-left: -400px;min-width: 800px;}
  .remark{padding: 5px;}
  .g-group{margin-bottom: 10px;}
  .line{float: left;margin-right: 5px;}
  .line select{border: 1px solid #eeeeee;padding: 0px 6px;}
  .saveBtn{width: 85px;height: 30px;line-height: 30px;color: white;background:#e31939;border-radius: 3px;text-align: center;font-size: 11px;margin-top: 10px; }
  .f-cb{clear: both;}
  .editAddress,.removeAddress,.moren,.saveBtn,.info_price .sub{cursor: pointer;}
  .moren{width: 65px;height: 20px;line-height: 20px;color: white;background:#d8d8d8;border-radius: 5px;text-align: center;font-size: 11px;}
  .moren.active{background:#e31939; }
  .tbtr{background: #f1f1f1;}
  .saveBtn:hover,.info_price .sub:hover{background: #fd7e81;}
  .scoll{overflow: auto;max-height: 300px;}
  .pop-choose-spec-close{position: absolute;right: 10px;}
  .f-relative{position: relative;}

</style>
<div class="pop-choose-spec-mask" style="display: none;"></div>
  <div id="1" class="pop-choose-spec-main" style="display: none;">
      <div class="f-borderB f-paddingB5 f-relative">
        添加收货地址
        <a class="pop-choose-spec-close" href="javascript:void(0);" title="关闭">×</a>
      </div>

      <div class="mainModel">
          <div class="g-part1">
              <div class="g-group">
                  <div class="f-fl one">
                    <div class="remark">
                      <span class="red">*</span>
                      <span>收货人</span>
                    </div>

                    <div>
                      <input type="text" placeholder="请输入收货人" name="name" class="inputModel">
                    </div>
                  </div>
                  <div class="f-fl one">
                    <div class="remark">
                      <span class="red">*</span>
                      <span>手机号码</span>
                    </div>
                    <div>
                      <input type="text" placeholder="请输入手机号码" name="phone" class="inputModel">
                    </div>
                  </div>
              </div>

              <div class="g-group">
                  <div class="f-fl one">
                    <div class="remark">
                      <span class="red">*</span>
                      <span>收货人</span>
                    </div>

                    <div>
                       <div class="line">
                         <select id="sel-provance" onchange="selectCity();" class="select">
                            <option value="" selected="true">所在省份</option>
                         </select>
                       </div>
                       <div class="line">
                          <select id="sel-city" onchange="selectcounty()" class="select">
                              <option value="" selected="true">所在城市</option>
                          </select>
                       </div>
                       <div class="line">
                           <select id="sel-area" class="select">
                              <option value="" selected="true">所在地区</option>
                           </select>
                       </div>
                    </div>
                  </div>
                  <div class="f-fl one">
                    <div class="remark">
                      <span class="red">*</span>
                      <span>详细地址</span>
                    </div>
                    <div>
                      <input type="text" placeholder="请输入详细地址" name="address" class="inputModel">
                    </div>
                  </div>
              </div>

              <div class="f-cb"></div>

              <div class="g-group">
                  <div class="saveBtn">保存收货地址</div>
              </div>

              <div class="g-group" style="margin-top: 30px;">
                  <div class="f-size12 red">已有3个收货地址</div>
              </div>
          <div class="scoll">
              <table class="m-table m-table-row">
                  <thead>
                      <tr class="tbtr">
                        <th class="cola">收货人</th>
                        <th class="cola">联系电话</th>
                        <th class="cola">所在地区</th>
                        <th class="cola">详细地址</th>
                        <th class="cola">操作</th>
                        <th class="cola">默认值</th>
                      </tr>
                  </thead>
                  <tbody class="tbody">
                      <tr>
                        <td>小明</td>
                        <td>13288842752</td>
                        <td>广东省 广州市 天河区</td>
                        <td>主机幼儿园</td>
                        <td>
                            <span class="editAddress">编辑</span>
                            <span>|</span>
                            <span class="removeAddress">删除</span>
                        </td>
                        <td>
                            <div class="moren active">默认地址</div>
                        </td>
                      </tr>
                      <tr>
                        <td>小明</td>
                        <td>13288842752</td>
                        <td>广东省 广州市 天河区</td>
                        <td>主机幼儿园</td>
                        <td>
                            <span class="editAddress">编辑</span>
                            <span>|</span>
                            <span class="removeAddress">删除</span>
                        </td>
                        <td>
                            <div class="moren">默认地址</div>
                        </td>
                      </tr>
                  </tbody>
              </table>
            </div>
          </div>
      </div>
  </div>
 </script>
 <script type="text/javascript" src="../addons/sz_yi/static/js/dist/area/cascade.js"></script>
<script language="javascript">
function tab(n){
    $('#con_'+n).fadeIn();
    $('#con_'+n).siblings().hide();
    $('#nav_'+n).addClass('navon');
    $('#nav_'+n).siblings().removeClass('navon');

  }
    window.logid = '';
    window.canbuy = false;
    window.timer = 0;
    window.selectStoreID = 0;
    require(['tpl', 'core','sweetalert'], function(tpl, core,swal) {

        function lottery(goods){
              var type = goods.type;
               if(type==0){

                                          core.pjson('creditshop/detail' ,{'op':'lottery','id':"<?php  echo $id;?>",'logid':window.logid},function(json){

                                              if(json.status==2){  setTimeout(function(){
                                                 swal({ 'title':'',text:'恭喜您，兑换成功!', imageUrl:'../addons/sz_yi/plugin/creditshop/template/mobile/default/images/lo1.gif',
                                                  confirmButtonText: '确 定',
                                                  confirmButtonColor:'#f90' },function(){
                                                      location.href =core.getUrl('plugin/creditshop/log',{shine:1});
                                                  });   },1);
                                              }
				     else if(json.status==3){
						setTimeout(function(){
                                                 swal({ 'title':'',text:'恭喜您，优惠券兑换成功!', imageUrl:'../addons/sz_yi/plugin/creditshop/template/mobile/default/images/lo1.gif',
                                                  confirmButtonText: '确 定',
                                                  confirmButtonColor:'#f90' },function(){
                                                      location.href =core.getUrl('plugin/creditshop/log',{shine:1});
                                                  });   },1);

				     } else{
                                                  core.tip.show( json.result);
                                              }
                                          },true,true);


               }else{
                    swal({   title: "",   text: "努力抽奖中，请稍后....",  imageUrl:'../addons/sz_yi/plugin/creditshop/template/mobile/default/images/lo.gif',  showConfirmButton: false });

                                   setTimeout(function(){
                                       core.pjson('creditshop/detail' ,{'op':'lottery','id':"<?php  echo $id;?>",'logid':window.logid},function(json){
                                           if(json.status==-1){
                                                swal({ 'title':'',text:json.result,confirmButtonText: '确 定',confirmButtonColor:'#f90'},function(){

                                                });
                                           }
                                           else if(json.status==2){
                                              swal({ 'title':'',text:'恭喜您, 您中奖啦!', imageUrl:'../addons/sz_yi/plugin/creditshop/template/mobile/default/images/lo1.gif',
                                                  confirmButtonText: '确 定',
                                                  confirmButtonColor:'#f90' },function(){
                                                      location.href =core.getUrl('plugin/creditshop/log',{shine:1});
                                                  });
                                            }  else if(json.status==3){
                                              swal({ 'title':'',text:'恭喜中奖，优惠券已经发到您账户啦, !', imageUrl:'../addons/sz_yi/plugin/creditshop/template/mobile/default/images/lo1.gif',
                                                  confirmButtonText: '确 定',
                                                  confirmButtonColor:'#f90' },function(){
                                                      location.href =core.getUrl('plugin/creditshop/log',{shine:1});
                                                  });
                                            } else {
                                                swal({ 'title':'',text:'很遗憾, 您没有中奖!',confirmButtonText: '确 定',confirmButtonColor:'#f90'},function(){
                                                      location.reload();
                                                });
                                            }
                                       },false,true);
                                 },1000);
                 }

        }
        function pay(goods){

                            core.pjson('creditshop/detail' ,{'op':'pay','id':"<?php  echo $id;?>",'storeid':goods.storeid,'realname':goods.realname,'mobile':goods.mobile},function(json){
                                if(json.status!=1){
                                    core.tip.show(json.result);
                                    return;
                                }

                                var result = json.result;
                                window.logid = result.logid;

                                if(result.wechat){
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
                                                             lottery(goods);
                                                    },fail:function(res){
                                                        alert(res.errMsg);
                                                    }
                                                });
                                            });
                                     });
                                } else{
                                    lottery(goods);
                                }

                            },true,true);

        }
        function setTimer(goods){

            setTimeHtml(goods);
            window.timer = setInterval(function(){
                setTimeHtml(goods);
            },1000);
        }
        function setTimeHtml(goods){
            var current = Math.floor(new Date().getTime()/1000);
                var ts = 0;//计算剩余的毫秒数
                var prefix = '';

                if(goods.timestate=='before'){
                    ts = goods.timestart - current;
                    prefix = "距离活动: ";
                    if(ts<=0){
                        goods.timestate='after';
                        $('#btnsub').removeClass('sub2').addClass('sub').html( goods.type==0?'立即兑换':'立即抽奖');
                        window.canbuy = true;
                    }
                }
                else if(goods.timestate=='after'){
                    ts = goods.timeend - current;

                    //prefix = "活动剩余: ";
                    prefix = "";
                    if(ts<=0){
                        clearInterval(window.timer);
                        window.canbuy =false;
                        $('.info_timestate').remove();
                        $('.stime').html( '活动已结束' );
                    }
                }
                var dd = parseInt(ts / 60 / 60 / 24, 10);//计算剩余的天数
                var hh = parseInt(ts  / 60 / 60 % 24, 10);//计算剩余的小时数
                var mm = parseInt(ts  / 60 % 60, 10);//计算剩余的分钟数
                var ss = parseInt(ts % 60, 10);//计算剩余的秒数
                dd = checkTime(dd);
                hh = checkTime(hh);
                mm = checkTime(mm);
                ss = checkTime(ss);
                $('.stime').html(prefix+ "<span>" + dd + "</span>天<span>" + hh + "</span>时<span>" + mm + "</span>分<span>" + ss + "</span>秒");
        }
        function checkTime(i)
            {
               if (i < 10) {
                   i = "0" + i;
                }
               return i;
            }
        core.pjson('creditshop/detail',{id:"<?php  echo $id;?>"},function(json){
            var result = json.result;
            var goods = result.goods;
            if(!goods){
                core.message('商品已下架或被删除!',"<?php  echo $this->createPluginMobileUrl('creditshop')?>",'error');
                return;
            }

            window.canbuy = goods.canbuy;

            $('#container').html(  tpl('tpl_main',result) );



            $(".moren").on("click",function(){
               $(".moren").removeClass("active");
               $(this).addClass("active");
               core.tip.show('设置成功');

            })

            $(".saveBtn").on("click",function(){
              var html ="<tr>"
                          +"<td>小明</td>"
                          +"<td>13288842752</td>"
                          +"<td>广东省 广州市 天河区</td>"
                          +"<td>主机幼儿园</td>"
                          +"<td>"
                             + "<span class='editAddress'>编辑</span>"
                             + "<span>|</span>"
                              +"<span class='removeAddress'>删除</span>"
                          +"</td>"
                          +"<td>"
                              +"<div class='moren'>默认地址</div>"
                          +"</td>"
                        +"</tr>"

              $(".tbody").append(html);
            })

            $(".pop-choose-spec-mask,.pop-choose-spec-close").on("click",function(){
                $(".pop-choose-spec-mask").fadeOut();
                $(".pop-choose-spec-main").fadeOut();
            })

            $(".selectAdd").on("click",function(){
              $(".pop-choose-spec-mask").fadeIn();
              $(".pop-choose-spec-main").fadeIn();
            })




             if(goods.timestate!=''){
                         setTimer(goods);
            }

                $('#btnsub').click(function(){
                 if (!window.canbuy){
                        return;
                 }
                 if(goods.followneed=='1' && !result.followed){
                        swal({   title: "提示",   text: goods.followtext ,    confirmButtonText: '立即去关注',
                                    confirmButtonColor:'#f90' },function(){
                                    location.href = goods.followurl;
                          });
                        return;
                  }

                  goods.storeid =0;
              		goods.realname = '';
              		goods.mobile = '';
                 if(goods.type==0){
          		     if(goods.isverify==1){
          				 if($.trim( $('#carrier_realname').val())==''){
          					 core.tip.show('请填写联系人');
          					 return;
          				 }
          				 if($.trim( $('#carrier_mobile').val())==''){
          					 core.tip.show('请填写联系电话');
          					 return;
          				 }
          				if($('#storeid').val()=='' || $('#storeid').val()=='0') {
          					core.tip.show('请选择兑换门店');
          					 return;
          				}
          		     }
                		  goods.storeid = $('#storeid').val();
                		  goods.realname = $('#carrier_realname').val();
                		  goods.mobile = $('#carrier_mobile').val();

                       swal({ 'title':'',text:'确认要兑换吗？',
                                       confirmButtonText: '确 定',
                                       confirmButtonColor:'#ff4a4e' ,
                                       cancelButtonText: '取 消',
                                        showCancelButton: true,
                                   },function(isConfirm){
                                    if(isConfirm){
                                         pay(goods);
                                    }
                       });
                       return;
                 }
                 else{
                     pay(goods);
                 }
              });

			  //门店选择,兑换直接选择门店，抽奖中了以后选择
	    if(goods.isverify==1 && goods.type==0){
  		   $('.chooser').css('height',$(document.body).height());
  		   $('.store_select').click(function(){

	       $('.chooser .ico i').hide();
         $('.chooser .store_ico_' + window.selectStoreID + ' i').show();
			   $(".chooser").animate({right: "0"}, 200);
			   $('.chooser .store .info').unbind('click').click(function(){
				   var store = $(this).closest('.store');
				   var storeid = store.data('storeid');
				   window.selectStoreID = storeid;
				   var storename = store.data('storename');
				   var address = store.data('address');
				   $('#storeid').val(storeid);
				   $('#store_info .user').html(storename);
				   $('#store_info .address').html(address);
				   $('#store_info').show();
				  $('#store_select').hide();
			           $(".chooser").animate({right: "-100%"}, 200);
			   })
		   });
              }


        },true);



       /*cascdeInit('湖北省','黄石市','黄石港区');*/



    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
