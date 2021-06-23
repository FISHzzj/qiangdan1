<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<title>兑换详情</title>
<script type="text/javascript" src="../addons/sz_yi/static/js/dist/area/cascade.js"></script>
<script type="text/javascript" src="../addons/sz_yi/template/pc/default/static/newpc/js/jquery.citys.js"></script>
<link rel="stylesheet" href="../addons/sz_yi/template/pc/default/static/newpc/css/common2.css">
<link rel="stylesheet" href="../addons/sz_yi/template/pc/default/static/newpc/css/cssreset-min.css">
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/navigation', TEMPLATE_INCLUDEPATH)) : (include template('common/navigation', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>

       .addorder_user {height:54px;  background:#fff; padding:0 5px; border-bottom:1px solid #eaeaea; margin-top:-5px;}
    .addorder_user .info .ico { float:left;  height:50px; width:30px; line-height:50px; font-size:26px; text-align:center; color:#666}
    .addorder_user .info .info1 {height:44px; width:100%; float:left;margin-left:-30px;margin-right:-30px;}
    .addorder_user .info .info1 .inner { margin-left:30px;margin-right:30px;overflow:hidden;}
    .addorder_user .info .info1 .inner .user {height:30px; width:100%; font-size:16px; color:#333; line-height:35px;overflow:hidden;}
    .addorder_user .info .info1 .inner .address {height:20px; width:100%; font-size:14px; color:#999; line-height:20px;overflow:hidden;}
    .addorder_user .info .ico2 {height:50px; width:30px;padding-top:15px; float:right; font-size:16px; text-align:right; color:#999;}
   .addorder_user .info .info2{ margin-right: -45px;}
   .addorder_user .info .info2 .inner { margin-right:45px;overflow:hidden;}
    .addorder_user .info .ico3 { width:45px;}
  .addorder_user .info .ico3 i {font-size:24px; color:#999;}
        .chooser {overflow:auto; width: 100%; background:#efefef; position: fixed; top: 0px; right: -100%; z-index: 999;}
    .chooser .address {height:50px; background:#fff; padding:10px;; border-bottom:1px solid #eaeaea;}
    .chooser .address .ico {float:left; height:50px; width:30px; line-height:50px; float:left; font-size:20px; text-align:center; color:#999;}
    .chooser .address .info {height:50px; width:100%;float:left;margin-left:-30px;margin-right:-30px;}
    .chooser .address .info .inner { margin-left:35px;margin-right:30px;}
    .chooser .address .info .inner .name {height:28px; width:100%; font-size:16px; color:#666; line-height:28px;overflow:hidden;}
    .chooser .address .info .inner .addr {height:22px; width:100%; font-size:14px; color:#999; line-height:22px;overflow: hidden;}
    .chooser .address .edit {height:50px; width:30px; float:right;margin-left:-30px;text-align:center;line-height:50px;color:#666;}

    .chooser .add_address {height:44px; padding:5px; background:#fff; border-bottom:1px solid #eaeaea; line-height:44px; font-size:16px; color:#666;}

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
    .address_main .line select  { border:none;height:25px;width:100%;color:#666;font-size:16px;}



    .address_main .address_sub1 {height:44px; margin:14px 5px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .address_main .address_sub2 {height:44px; margin:14px  5px; background:#ddd; border-radius:4px; text-align:center; font-size:18px; line-height:44px; color:#666; border:1px solid #d4d4d4;}
.exchange_confirm {position: fixed;  bottom:0; width:100%; height:40px; line-height: 40px; background:#f90; color:#fff;font-size:14px; text-align: center;z-index:1000}
.select { -webkit-appearance: none };

  .carrier_input_info {height:auto;width:100%; background:#fff; margin-top:14px;  border-bottom:1px solid #e8e8e8;}
    .carrier_input_info .row { padding:0 5px; height:40px; background:#fff; border-bottom:1px solid #e8e8e8; line-height:40px; color:#999;}
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
.selectAddress2{padding: 0px 10px;border:1px solid #bbbbbb;width: 80%;cursor: pointer;margin:7px 0px 10px 13px;}
.selectAddress:hover{background: #f9f9f9;}
.f-fl{float: left;}
  /* 简易数据表格-格边框 */
  .m-table{table-layout:fixed;width:100%;line-height:1.5;}
  .m-table th,.m-table td{padding:10px;border:1px solid #ddd;}
  .m-table th{font-weight:bold;}
/*   .m-table tbody tr:nth-child(2n){background:#fafafa;} */
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
  .editAddress,.removeAddress,.moren,.saveBtn,.info_price .sub,.confirmBtn{cursor: pointer;}
  .moren{width: 65px;height: 20px;line-height: 20px;color: white;background:#d8d8d8;border-radius: 5px;text-align: center;font-size: 11px;}
  .moren.active{background:#e31939; }
  .tbtr{background: #f1f1f1;}
  .saveBtn:hover,.info_price .sub:hover,.confirmBtn:hover{background: #fd7e81;}
  .scoll{overflow: auto;max-height: 222px;}
  .pop-choose-spec-close{position: absolute;right: 10px;}
  .f-relative{position: relative;}
  .price{text-align: left;}
  .confirmBtn{width: 85px;height: 30px;line-height: 30px;color: white;background: #e31939; border-radius: 3px; text-align: center;font-size: 11px;margin-top: 10px;}
  .notice{min-height: 100px;margin-top: 1px;border:1px solid #e6e6e6;border-top: 0px;padding: 30px 40px;color: gray;font-size: 13px;margin-bottom: 10px;}
  .editconBtn{width: 85px;height: 30px;line-height: 30px;color: white;background: #e31939;border-radius: 3px;text-align: center;font-size: 11px;margin-top: 10px;cursor: pointer;}
  .cancelBtn{width: 85px;height: 30px;line-height: 30px;color: white;background: #a9a9a9;border-radius: 3px;text-align: center;font-size: 11px;margin-top: 10px;cursor: pointer;}
  .editconBtn:hover{background: #fd7e81; }
  .cancelBtn:hover{background: #bababa;}
  .header{width: auto;text-align: left;margin: 30px auto 0 auto;}
  ::-webkit-scrollbar{width:0px}
</style>


<div id='address_container'></div>
<div id='container' style="width:1200px;margin:10px auto 0;overflow: hidden;"></div>

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
   <!--  <a href="<?php  echo $this->createPluginMobileUrl('creditshop')?>" class="btn" ><i class="fa fa-home"></i></a> -->
    <div class="title">兑换详情</div>
</div>

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
                            <%if goods.type=='1'%>活动<%else%>使用<%/if%>时间：&nbsp;&nbsp;<span class="dtime">兑换之日起至<%goods.endtime_str%></span>
                        </div>
                        <div class="price_time">
                              剩余时间：&nbsp;&nbsp;<span class="stime">00 天 20 时 52 分 44 秒</span>
                        </div>
                    <%else%>
                        使用到期    
                    <%/if%>
                </div>
          </div>
          <div class="info_text">
         <div class="price_line">

                          使用范围：&nbsp;&nbsp;
                          <span>
                            <%if goods.area==''%>全国<%else%><%goods.area%><%/if%> <%if goods.dispatch>0%>
                              <span style='color:#f90'>(需额外支付运费<%goods.dispatch%>元)</span>
                            <%/if%>
                          </span>
        </div>
         <div class="price_line">
          <%if goods.price>0%>
                   商品原价：&nbsp;&nbsp;<span class="price_line_sp">￥<%=goods.price%></span>
          <%/if%>
        </div>
        <!-- 未选择地址时候 -->
        <div class="tab1">
          <div class="f-fl">收货地址：</div>
          <%if duistatus == 2 %>
              <%if defaultstaus == 1 %>
                     <div class="selectAddress2 f-fl selectAdd">
                         <div>
                           <input type="hidden" name="jiid" id="jiid" value="<%log.id%>">
                           <input type="hidden" name="choseaid" id="choseaid" value="<%defaultaddress.id%>">
                           <span style="margin-right: 20px;">收货人:<span class="aname">
                           <%defaultaddress.realname%></span></span>
                           <span>联系电话:<span class="aphone"><%defaultaddress.mobile%></span></span>
                         </div>
                         <div>
                           <span>收货地址:<span class="add">
                             <%defaultaddress.province%>
                             <%defaultaddress.city%>
                             <%defaultaddress.area%>
                             <%defaultaddress.address%>
                           </span>
                         </div>
                     </div>
              <%else%>
                   <div class="selectAddress f-fl selectAdd" id="choseaddress">请选择收货地址</div>
              <%/if%>
          <%else%>
              <div><%address.province%><%address.city%><%address.area%><%address.address%></div>
          <%/if%>
        </div>

        <!-- 已选择地址时候 -->
       <div class="tab2" style="display: none;">
         <div class="f-fl">收货地址：</div>
         <div class="selectAddress2 f-fl selectAdd">
             <div>
               <input type="hidden" name="jiid" id="jiid" value="<%log.id%>">
               <input type="hidden" name="choseaid" id="choseaid" value="">
               <span style="margin-right: 20px;">收货人:<span class="aname"></span></span>
               <span>联系电话:<span class="aphone"></span></span>
             </div>
             <div>
               <span>收货地址:<span class="add">/span></span>
             </div>
         </div>
       </div>
        <div class="cl-b"></div>
              <div class="info_price">
                          <%if duistatus == 2 %>
                                <%if goods.canbuy%>
                                  <%if goods.type=='1'%>
                                   <div class="<%if goods.canbuy%>sub<%else%>sub2<%/if%>" id="btnsub" style="margin-top: 5px;"> 立即抽奖 </div>
                                  <%else%>
                                  <div class="<%if goods.canbuy%>sub<%else%>sub2<%/if%>" id="btndui" style="margin-top: 5px;"> 立即兑换</div>
                                  <%/if%>
                                <%else%>
                                   <%goods.buymsg%>
                                <%/if%>

                          <%else%>
                              <div style="margin-top: 5px;background: #ff4a4e;color:#fff;border-radius: 0;width: 182px;height:40px;line-height:40px;text-align: center;float: left;margin:0 0 0 3px;">
                                已兑换</div>
                          <%/if%>

                    <!-- <div class="">
                        <%if goods.acttype!=0 && goods.acttype!=1 &&goods.acttype!=2%>
                          <span style="font-size:16px;line-height:55px;display:block;">免费<%if goods.type=='1'%>抽奖<%else%>兑换<%/if%></span>
                          <%/if%>
                    </div> -->
                    <!-- <input type="hidden" id="needpaydispatch" value="<%if goods.isverify==0 && goods.dispatch>0%>1<%else%>0<%/if%>" />
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
                                <%/if%> -->
         </div>
                    <div class="cl-b"></div>
                    <!-- <div class="price_line" style="height:30px;line-height:30px;color:#666666;">兑换成功后，请在后面再进行确认填写好地址！</div> -->

                </div>
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
                  <div style="font-size: 13px;line-height: 30px;"><%=goods.noticedetail%></div>
              </div>
            <%/if%>

            <div id='comment_container' style="margin:0 30px 30px;overflow: hidden;width:1140px;padding:10px">

                <%if goods.goodsdetail!=''%>
                    <!-- <div class='ctitle'>商品简介:</div> -->
                    <%=goods.goodsdetail%>
                    <%/if%>


                    <!-- <div class='ctitle'><%if goods.type=='1'%>活动<%else%>使用<%/if%>范围:</div>
                    <div class='ccontent'><%if goods.area==''%>全国<%else%><%goods.area%><%/if%> <%if goods.dispatch>0%><span style='color:#f90'>(需额外支付运费<%goods.dispatch%>元)</span><%/if%></div>

                    <%if goods.isendtime=='1'%>
                    <div class='ctitle'><%if goods.type=='1'%>活动<%else%>使用<%/if%>有效期:</div>
                    <div class='ccontent'>兑换之日起至<%goods.endtime_str%></div>
                    <%/if%> -->

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


      </div>
</div>


<!--
      <div class="info_top" onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%goods.id%>'">
      <img src="<%goods.thumb%>"/>
        <div class="info">
          <div class="classs"><%goods.subtitle%></div>
            <div class="name"><%goods.title%></div>
        </div>
    </div>

        <div class="info_price">
            <div class="num">
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


      <%if goods.isverify==1 && log.status==2 && log.storeid!=0%>
         <div style='height:40px;'></div>
          <%/if%>
    </div>

       <%if goods.isverify==1 && log.status==2 && log.storeid!=0%>
               <div class='exchange_confirm'>确认兑换</div>
        <%/if%> -->

<div class="pop-choose-spec-mask" style="display: none;"></div>
  <div id="1" class="pop-choose-spec-main" style="display: none;">
      <div class="f-borderB f-paddingB5 f-relative">
        添加收货地址
        <a class="pop-choose-spec-close" href="javascript:void(0);" title="关闭">×</a>
      </div>

      <div class="mainModel">
          <div class="g-part1">
              <div class="g-group">
                  <input type="hidden" class="tid">
                  <div class="f-fl one">
                    <div class="remark">
                      <span class="red">*</span>
                      <span>收货人</span>
                    </div>

                    <div>
                      <input type="text" placeholder="请输入收货人" name="name" class="shouhuoname">
                    </div>
                  </div>
                  <div class="f-fl one">
                    <div class="remark">
                      <span class="red">*</span>
                      <span>手机号码</span>
                    </div>
                    <div>
                      <input type="number" placeholder="请输入手机号码" name="phone" class="shouhuomobile">
                    </div>
                  </div>
              </div>

              <div class="g-group">
                  <div class="f-fl one">
                    <div class="remark">
                      <span class="red">*</span>
                      <span>选择地址</span>
                    </div>

                    <div>
                       <!-- <div class="line">
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
                       </div> -->



                      <div id="demo2" class="citys">
                          <p>
                              <select name="province"></select>
                              <select name="city"></select>
                              <select name="area"></select>

                              <input type="hidden" class="province" id="sel-provance">
                              <input type="hidden" class="city" id="sel-city">
                              <input type="hidden" class="area" id="sel-area">
                          </p>
                          <!-- <p id="place">请选择地区</p> -->
                      </div>


                    </div>
                  </div>
                  <div class="f-fl one">
                    <div class="remark">
                      <span class="red">*</span>
                      <span>详细地址</span>
                    </div>
                    <div>
                      <input type="text" placeholder="请输入详细地址" name="address" class="shouhuoaddress">
                    </div>
                  </div>
              </div>

              <div class="f-cb"></div>

              <div class="g-group btn1" id="caubtn">
                  <div class="saveBtn">保存收货地址</div>
              </div>
              <div class="g-group btn2" style="display: none;">
                  <div class="editconBtn f-fl f-marginR10">修改收货地址</div>
                  <div class="cancelBtn f-fl">取消修改</div>
              </div>
              <div class="f-cb"></div>

              <div class="g-group" style="margin-top: 30px;">
                  <div class="f-size12 red">
                  已有<span id="shushou"><%totaladdress%></span>个收货地址
                  <!-- (最多只能添加20个地址) -->
                  </div>
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
                      <%each alladdress as ads%>
                          <tr class="showaddress" data-id="<%ads.id%>">
                              <td class="addname"><%ads.realname%></td>
                              <td class="addphone"><%ads.mobile%></td>
                              <td class="addpro"><%ads.province%>-<%ads.city%>-<%ads.area%></td>
                              <td class="add"><%ads.address%></td>
                              <td>
                                  <span class="editAddress" data-id="<%ads.id%>">编辑</span>
                                  <span>|</span>
                                  <span class="removeAddress" data-id="<%ads.id%>">删除</span>
                              </td>
                              <td>
                                  <div class="moren <%if ads.isdefault=='1'%>active<%/if%>" data-id="<%ads.id%>">
                                    默认地址
                                  </div>
                              </td>
                          </tr>
                      <%/each%>
                  </tbody>
              </table>
            </div>
            <div class="confirmBtn">确定</div>
          </div>
      </div>
  </div>
 </script>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('pop', TEMPLATE_INCLUDEPATH)) : (include template('pop', TEMPLATE_INCLUDEPATH));?>
<script language="javascript">
function tab(n){
    $('#con_'+n).fadeIn();
    $('#con_'+n).siblings().hide();
    $('#nav_'+n).addClass('navon');
    $('#nav_'+n).siblings().removeClass('navon');

  }




    window.logid = '';
    window.selectStoreID = 0;
    require(['tpl', 'core'], function(tpl, core) {

          // cascdeInit('广东省','广州市','吉邦科技园');

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
      // if($('#sel-area').val()=='请选择地区'){
    //                 core.tip.show('请选择地区!');
    //                 return;
    //             }
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
                                       confirmButtonColor:'#ff4a4e' ,
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
                                            confirmButtonColor:'#ff4a4e' },function(){
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
                                       confirmButtonColor:'#ff4a4e' ,
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
                          confirmButtonColor:'#ff4a4e' },function(){
                            location.reload();
                          });
             }else{
             swal({ 'title':'',text:'兑换失败，请重试!',confirmButtonText: '确 定',confirmButtonColor:'#ff4a4e'},function(){
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
            var goods = result.goods;

            if(json.status==-1){
                core.message( json.result ,"<?php  echo $this->createPluginMobileUrl('creditshop/log')?>",'error');
                return;
            }

           $('#container').html(  tpl('tpl_main',result) );

            setTimer(goods);

            //保存地址的操作处理
            $(".saveBtn").on("click",function(){

                var shouhuoname = $('.shouhuoname').val();  //收货人
                var shouhuomobile = $('.shouhuomobile').val(); //收货手机号码
                var selprovance = $('#sel-provance').val(); //省份
                var selcity = $('#sel-city').val(); //城市
                var selarea = $('#sel-area').val();  //区域
                var shouhuoaddress = $('.shouhuoaddress').val(); //详细地址
                if(shouhuoname == ''){
                   alert('收货人不能为空!');
                   return;
                }
                if(shouhuomobile == ''){
                   alert('收货人手机号码不能为空!');
                   return;
                }
                var regExp = /^(86)?((13\d{9})|(15[0,1,2,3,5,6,7,8,9]\d{8})|(18[0,5,6,7,8,9]\d{8}))$/;
                if( !regExp.test(shouhuomobile) ){
                   alert("手机号格式错误!");
                   return;
                }
                if(selprovance == ''){
                   alert('请选择详细地址!');
                   return;
                }
                if(shouhuoaddress == ''){
                   alert('详细地址不能为空!');
                   return;
                }
                core.pjson('creditshop/log',{
                    op:'adddizhi',
                    shouhuoname:shouhuoname,
                    shouhuomobile:shouhuomobile,
                    selprovance:selprovance,
                    selcity:selcity,
                    selarea:selarea,
                    shouhuoaddress:shouhuoaddress,
                },function(json){
                     // console.log(json);
                     if(json.status == 1){
                          var countadd = json.result.countadd; //获取地址数量
                          var chaid = json.result.chaid; //获取插入id
                          $('#shushou').text(countadd);
                          var tianaddress = json.result.danaddress; //获取添加地址信息
                          var str = '';
                          if(countadd == '1'){
                              str = 'active';
                          }else{
                              str = '';
                          }

                        /*  <tr class="showaddress" data-id="<%ads.id%>">
                              <td class="addname"><%ads.realname%></td>
                              <td class="addphone"><%ads.mobile%></td>
                              <td class="addpro"><%ads.province%>-<%ads.city%>-<%ads.area%></td>
                              <td class="add"><%ads.address%></td>
                              <td>
                                  <span class="editAddress" data-id="<%ads.id%>">编辑</span>
                                  <span>|</span>
                                  <span class="removeAddress" data-id="<%ads.id%>">删除</span>
                              </td>
                              <td>
                                  <div class="moren <%if ads.isdefault=='1'%>active<%/if%>" data-id="<%ads.id%>">
                                    默认地址
                                  </div>
                              </td>
                          </tr>*/
                          var html ="<tr class='showaddress' data-id='"+chaid+"'>"
                              +"<td class='addname'>"+shouhuoname+"</td>"
                              +"<td class='addphone'>"+shouhuomobile+"</td>"
                              +"<td class='addpro'>"+selprovance+"-"+selcity+"-"+selarea+"</td>"
                              +"<td class='add'>"+shouhuoaddress+"</td>"
                              +"<td>"
                                 + "<span class='editAddress' data-id='"+chaid+"'>编辑</span>"
                                 + "<span>&nbsp;|&nbsp;</span>"
                                  +"<span class='removeAddress' data-id='"+chaid+"'>删除</span>"
                              +"</td>"
                              +"<td>"
                                  +"<div class='moren "+str+"'>默认地址</div>"
                              +"</td>"
                            +"</tr>";
                          $('.shouhuoname').val('');
                          $('.shouhuomobile').val('');
                          $('#selprovance').val('');
                          $('#selcity').val('');
                          $('#selarea').val('');
                          $('.shouhuoaddress').val('');
                          $(".tbody").append(html);
                          bindEvent();
                     }else{
                         alert('保存地址失败!');
                     }

                });

            })

           /*初始化地址插件*/
            $('#demo2').citys({
                required:false,
                nodata:'disabled',
                onChange:function(data){
                    var text = data['direct']?'(直辖市)':'';
                    $(".province").val(data['province']);
                    $(".city").val(data['city']);
                    $(".area").val(data['area']);
                    /*$('#place').text('当前选中地区：'+data['province']+text+' '+data['city']+' '+data['area']);*/
                }
            });


            //确定选择地址的操作处理
            $(".confirmBtn").on("click",function(){
                $(".tbody tr").each(function(){
                  if($(this).hasClass('tbtr')){
                    var addressid = $(this).data('id');  //获取地址id
                    $(".pop-choose-spec-mask").fadeOut();
                    $(".pop-choose-spec-main").fadeOut();
                    $(".tab1").hide()
                    $(".tab2").show();
                    core.pjson('creditshop/log',{
                        op:'showdizhi',
                        addressid:addressid
                    },function(json){
                         var addressarr = json.result.showaddress;
                         $(".tab2 .aname").text(addressarr.realname);
                         $(".tab2 .aphone").text(addressarr.mobile);
                         var xiangxi = addressarr.province+addressarr.city+addressarr.area+addressarr.address;
                         $(".tab2 .add").text(xiangxi);
                         $('#choseaid').val(addressid);
                          $("body").css("overflow","auto");
                    });

                  }

                });

            })

            //点击立即兑换的操作处理
            $("#btndui").on("click",function(){

                if( confirm("确定立即兑换吗？请注意收货地址!") ){
                        var choseaid = $('#choseaid').val(); //获取选择地址id
                        var jiid = $('#jiid').val(); //获取商品兑换记录id
                        if(choseaid == ''){
                          alert('请选择收货地址');
                          return;
                        }
                        core.pjson('creditshop/log',{
                            op:'lijiduihuan',
                            choseaid:choseaid,
                            jiid:jiid
                        },function(json){
                             console.log(json);
                             if(json.status == 1){
                                alert('兑换成功!');
                                window.location.href = '<?php  echo $this->createPluginMobileUrl("creditshop/log")?>';
                             }else{
                                alert('无法兑换!');
                             }
                        });
                }

            })


            $(".pop-choose-spec-mask,.pop-choose-spec-close").on("click",function(){
                $(".pop-choose-spec-mask").fadeOut();
                $(".pop-choose-spec-main").fadeOut();
                $("html,body").css({
                  "overflow":"auto",
                  "padding–right":"0px",
                });
                /*$("#container").css("width","1210px");*/
                /*$(".pop-choose-spec-main").css("margin-left","-400px");*/
            })

            $(".selectAdd").on("click",function(){
              $(".pop-choose-spec-mask").fadeIn();
              $(".pop-choose-spec-main").fadeIn();
              $("html,body").css({
                "overflow":"hidden",
                "padding–right":"17px",
              });

              /*$("#container").css("width","1210px");*/
              /*$(".pop-choose-spec-main").css("margin-left","-409px");*/

            })

            bindEvent();
            moren();
            function moren(){
              //设置默认地址
              $(".moren").on("click",function(){
                   if( confirm("是否设置该地址为默认地址!") ){
                       var aids = $(this).data('id'); //获取记录id
                       This = $(this);
                       core.pjson('creditshop/log',{
                            op:'setdefaults',
                            aids:aids
                        },function(json){
                             // console.log(json);
                             if(json.status == 1){
                                 alert('设置成功!');
                                 $(".moren").removeClass("active");
                                 This.addClass("active");
                                 event.stopPropagation();
                             }else{
                                alert('设置失败!');
                             }
                        });
                   }
              })
            }

            function bindEvent(){

              //删除地址的操作处理
              $(".removeAddress").on("click",function(){
                var That = $(this);
                if(confirm("是否删除该地址？"))
                {
                  That.parents("tr").remove();
                  var jiid = That.data('id'); //获取地址记录id
                  core.pjson('creditshop/log_detail',{
                        op:'deladdress',
                        jiid:jiid
                  },function(json){
                       if(json.status == 1){
                           alert('删除成功!');
                       }else{
                          alert('删除失败!');
                       }
                  });
                }
              })


              $(".tbody tr").on("click",function(){
                $(".tbody tr").removeClass('tbtr');
                $(this).addClass('tbtr');
              })


              //编辑地址的操作处理
              $(".editAddress").on("click",function(){
                   var addname = $(this).parents("tr").find(".addname").text();
                   var addphone = parseInt($(this).parents("tr").find(".addphone").text());
                   var addpro = $(this).parents("tr").find(".addpro").text();
                   var add = $(this).parents("tr").find(".add").text();
                   var addpro = $(this).parents("tr").find(".addpro").text();

                   var arr = addpro.split("-");
                    $('#demo2').citys({
                      required:true,
                      nodata:'disabled',
                      valueType:'name',
                      province:arr[0],
                      city:arr[1],
                      area:arr[2],
                      onChange:function(data){
                          var text = data['direct']?'(直辖市)':'';
                          $(".province").val(data['province']);
                          $(".city").val(data['city']);
                          $(".area").val(data['area']);
                      }

                  });


                   $("input[name='name']").val(addname);
                   $("input[name='phone']").val(addphone);
                   $("input[name='address']").val(add);
                   $("#sel-provance").val(arr[0]);
                   $("#sel-city").val(arr[1]);
                   $("#sel-area").val(arr[2]);

                   $(".btn1").hide();
                   $(".btn2").show();
                   var eid = $(this).data('id'); //获取编辑地址id
                   $(".tid").val(eid);

                  $(".editconBtn").on("click",function(){
                      var tid= $(".tid").val();
                      $(".showaddress").each(function(){
                           var id = $(this).attr("data-id");
                           if(tid==id){
                              var shouhuoname = $(".shouhuoname").val();
                              var shouhuomobile = $(".shouhuomobile").val();
                              var shouhuoaddress = $(".shouhuoaddress").val();
                              var provance = $("#sel-provance").val();
                              var city = $("#sel-city").val();
                              var area = $("#sel-area").val();


                              $(this).find(".addname").text(shouhuoname);
                              $(this).find(".addphone").text(shouhuomobile);
                              $(this).find(".add").text(shouhuoaddress);
                              $(this).find(".addpro").text(provance+"-"+city+"-"+area);
                              // alert("修改成功");

                              //更新收获地址
                              core.pjson('creditshop/log_detail',{op:'editaddress',biid:id,shouhuoname:shouhuoname,shouhuomobile:shouhuomobile,shouhuoaddress:shouhuoaddress,provance:provance,city:city,area:area},function(json){
                                    //console.log(json);
                                    if(json.status == 1){
                                          // alert('修改成功!');
                                          $(".tid").val("");
                                          $(".shouhuoname").val("");
                                          $(".shouhuomobile").val("");
                                          $(".shouhuoaddress").val("");
                                          $(".btn2").hide();
                                          $(".btn1").show();
                                          $('#demo2').citys({
                                              required:false,
                                              nodata:'disabled',
                                              onChange:function(data){
                                                  var text = data['direct']?'(直辖市)':'';
                                                  $(".province").val(data['province']);
                                                  $(".city").val(data['city']);
                                                  $(".area").val(data['area']);
                                              }
                                          });
                                    }else{
                                       alert('修改失败!');
                                    }

                              });



                           }
                      })
                  })

                  $(".cancelBtn").on("click",function(){
                    $(".tid").val("");
                    $(".shouhuoname").val("");
                    $(".shouhuomobile").val("");
                    $(".shouhuoaddress").val("");
                    $(".btn2").hide();
                    $(".btn1").show();

                    $('#demo2').citys({
                        required:false,
                        nodata:'disabled',
                        onChange:function(data){
                            var text = data['direct']?'(直辖市)':'';
                            $(".province").val(data['province']);
                            $(".city").val(data['city']);
                            $(".area").val(data['area']);

                        }
                    });
                  })

              });

              // $(".updateadd").on("click",function(){
              //     alert(1);
              // })

            }



            setTimer(goods);
            function setTimer(){
                setTimeHtml(goods);
                window.timer = setInterval(function(){
                    setTimeHtml(goods);
                },1000);

            }

            function setTimeHtml(goods){

                    var current = Math.floor(new Date().getTime()/1000);

                    var ts = 0;//计算剩余的毫秒数

                    var prefix = '';

                    ts = goods.endtime - current;

                   // console.log(goods.usetimesh);

                    /*if(goods.timestate=='before'){

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



                        prefix = "活动剩余: ";

                        if(ts<=0){

                            clearInterval(window.timer);

                            window.canbuy =false;

                            $('.info_timestate').remove();

                            $('#btnsub').removeClass('sub').addClass('sub2').html( '活动已结束' );

                        }

                    }*/

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
       if( log.storeid==0)       {
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
