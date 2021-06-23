<?php defined('IN_IA') or exit('Access Denied');?><!-- 1475278 11-->
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>商家管理</title>
<style type="text/css">
    th{font-weight: 200;}
    body {margin:0px; background:#eee; padding:0px; -moz-appearance:none;font-family: "苹方";overflow-x: hidden;}
	a:link,a:visited,a:hover,a:active{color:#fff;}

    #big_body{width:100%;margin:0px;}
    #header{ width:100%; }
    #user-info:after{content: "";display: block;clear: both;}
    #user-info{width: 100%; height: auto;background: #10BDFF;color: #fff;padding: 30px 0 10px 0;}
    #user-info .left{width:35%;float:left;min-width: 90px; height:80px; border-radius:50%;padding-left: 10%;overflow:hidden;padding-right:10px;}
	#user-info .left .img{float:right;margin-right:15px;}
	#user-info .left img{ border: 2px #fff solid; display: block;width:70px; height:70px; border-radius:50%;  }
    #user-info .title{width:60%;font-size:18px; padding-top: 3%;padding-bottom: 5%;float: left;}

	.list3{display:flex;display:-webkit-flex;justify-content:center;width: 100%;background: white;        padding: 9px 0px;color:#282828;}
	.list3 li{list-style:none;width:32%;}
	.list3 li:nth-child(3){border-right:0;}
	.list3 li span{display:block;text-align:center;font-size: 15px;}
    .timer span{font-size: 20px !important;}
    .header {width: 100%;color: #fff;position: relative}
    .user-title{position: relative;z-index: 8;padding: 5% 5%;overflow: hidden;background: url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/bg.jpg) ;}
    .user-head { height: 60px; width: 60px; background: #fff; border-radius: 50%; border: 2px solid #fff;overflow: hidden;float: left;margin-top: 5px;}
    .user-head img { height: 100%; width: 100%; border-radius: 50%; }
    .user-info{float: left;margin-left: 10px;margin-top: 10px;}
    .user-other {color:white; width: auto;height: 24px;line-height: 24px;margin-bottom: 5px;}
    .user-member { background: #fff; color: #00c1ff; border-radius: 12px; height: 20px; line-height: 20px;padding:2px 5px}

	/* #data{ float:left; width: 100%; padding-top: 15px; padding-bottom: 15px; background: #10BDFF; text-align:center; text-align: center;color: #fff;  }
    #data table{ width: 100%; height:25px; margin:auto; text-align:center;  color:#999;  }
    #data table th{ color:#fff; height:100%;position: relative; border-right:#ececee 1px solid;}
    #data table th>#top{display: block;width: 100%; text-align: center; }
    #data table th>#bottom {display: block; width: 100%;text-align: center;color: #fff; font-weight: 600; } */

    .list-button{ width:100%; padding-top:10px; padding-bottom: 10px; background: #fff;text-align: center;}
    .list-button table{width:100%;margin: 0 auto;display: inline-block;}
    .list-button table tbody{display: -webkit-box;display: flex;display:-webkit-flex;justify-content:  flex-start;flex-wrap:wrap;-webkit-flex-wrap:wrap;}
    .list-button table  tr{ width: 25%;}
    .list-button table  tr:last-child{border-bottom:none;}
    .list-button table  th{    padding-bottom: 10px;  padding-top: 10px; color: #818181; font-size: 16px; }
    .list-button table a{ color: #000;font-size: 14px;    display: block; width: 100%; min-height: 24px; }
    .list-button table  th .left{    text-align: center; float: left;  }
    .list-button table  th #right{ float: right; }
    .list-button table  th #right img{ display: block; width: 9px;height: 15px; margin-top: 5px; }
   	.list-button table  th .left #img{ padding-left:3px; padding-right:3px; border-radius:50%; text-align: center;  }
   	.list-button table  th .left img {  margin:auto; width:15px; height:15px; }


    .content_type {
    width: 100%;
    height: 70px;
    background: #fff;
    display: -webkit-flex;
    display: flex;
}
.content_type>li {
    margin: 15px 0 15px 0;
    width: 33%;
    text-align: center;
    border-right: 1px solid #282828;
}
.content_type_title {
    color: #282828;
}
.content_type_content {
    color: #e45050;
    font-size: 15px;
}
.list_type{height: 40px;line-height: 22px;display: flex;display: -webkit-flex;background: #fff;width: 100%;margin:10px 0 0 0;}
.list_son{flex:1;-webkit-flex:1;text-align: center;color:#656565;height:40px;}
.list_sonN{margin:10px 0 10px 0;border-right: 1px solid #eaeaea;}
.list_on{color:#e45050;border-bottom: 2px solid #e45050;}
.makecode{line-height:40px;width:100%;background: #408bfe;color:#fff;text-align: center;}
.makecode2{display: none;}
.num{right: 20px;display: none;z-index: 999;}
@media screen and (max-width: 320px){
    .num{right: 15px;}
}
</style>
<div class="page_topbar">
   <a href=" " class="back" onclick="history.back()">
    <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
  </a>
  <div class="title" style=" color: #282828;">商家管理</div>
  <a href="#" class="btn"><i class="iconfont  headerRightIcon" style="color: #282828;"></i></a>

</div>
<script id="tpl_header" type="text/html">
    <div id="header"  class="headermes">
        <div class="user-title">
            <div class="user-head"><img src="<%member.avatar%>"/></div> 
            <div class="user-info">
                <div class="user-other"><%member.nickname%></div>               
                <div class="user-other">加入时间：<span class="time"><%member.agenttime%></span></div>
            </div>           
        </div>
        <div id="data">
            <ul class="content_type">
                    <li>
                        <div class="content_type_title f-fsize14">成交总额</div>
                        <div class="content_type_content"><%allprice%></div>
                    </li> 
                    <li style="border-right: 0px;">
                        <div class="content_type_title f-fsize14">日成交总额</div>
                        <div class="content_type_content"><%todayprice%></div>
                    </li> 
                    <li style="border-left: 1px solid #282828;border-right: 0px;">
                        <div class="content_type_title f-fsize14">今日订单</div>
                        <div class="content_type_content"><%todaycount%></div>
                    </li> 
                    
            </ul>
        </div>	
    </div>

    <div class ="list-button" style="margin-top: 10px;">
         <table>
              <tr>
                   <th>
                       <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/order')?>">
                            <div id="left" style="text-align: center;">
                                 <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                    <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon1.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                 </span>
                                 <span style=" display: inline-block;">
                                    订单管理
                                 </span>
                            </div>
                        </a>
                   </th>
              </tr>
              <tr>
                   <th>
                       <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/order',array('op'=>'withdraw'))?>">
                            <div id="left" style="text-align: center;">
                                 <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                    <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon2.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                 </span>
                                 <span style=" display: inline-block;">
                                    商家提现
                                 </span>
                            </div>
                        </a>
                   </th>
              </tr>
              <tr>
                   <th>
                       <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/order',array('op'=>'withdrawlist'))?>">
                            <div id="left" style="text-align: center;">
                                 <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                    <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon3.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                 </span>
                                 <span style=" display: inline-block;">
                                    提现记录
                                 </span>
                            </div>
                        </a>
                   </th>
              </tr>
              <tr>
                   <th>
                       <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/info',array('op'=>'editpwd'))?>">
                            <div id="left" style="text-align: center;">
                                 <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                    <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon4.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                 </span>
                                 <span style=" display: inline-block;">
                                    修改密码
                                 </span>
                            </div>
                        </a>
                   </th>
              </tr>
         </table>
    </div>
</script>    
    
<script id="tpl_list-buttons" type="text/html">

    <div class="list_type">
         <div class="list_son list_on">
             <div class="list_sonN">线上店铺</div>
         </div>
         <div class="list_son">
             <div class="list_sonN">线下管理</div>
         </div>          
    </div>
    
    <div class="makecode1">  
        <div class="list-button">
            <table>
                  <tr>
                       <th>
                           <a href="<?php  echo $this->createPluginMobileUrl('supplier/store',array('op'=>'skip','storeid'=>$uid))?>">
                                <div id="left" style="text-align: center;">
                                     <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                        <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon5.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                     </span>
                                     <span style=" display: inline-block;color: #848484;">
                                        我的店铺
                                     </span>
                                </div>
                            </a>
                       </th>
                  </tr>
                  <tr>
                       <th>
                           <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/goods',array('op'=>'post'))?>">
                                <div id="left" style="text-align: center;">
                                     <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                        <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon6.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                     </span>
                                     <span style=" display: inline-block;color: #848484;">
                                        发布宝贝
                                     </span>
                                </div>
                            </a>
                       </th>
                  </tr>
                  <tr>
                       <th>
                           <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/goods')?>">
                                <div id="left" style="text-align: center;">
                                     <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                        <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon7.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                     </span>
                                     <span style=" display: inline-block;color: #848484;">
                                        宝贝管理
                                     </span>
                                </div>
                            </a>
                       </th>
                  </tr>
                  <tr>
                       <th>
                           <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/info',array('op'=>'editstore'))?>">
                                <div id="left" style="text-align: center;">
                                     <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                        <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon8.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                     </span>
                                     <span style=" display: inline-block;color: #848484;">
                                        店铺装修
                                     </span>
                                </div>
                            </a>
                       </th>
                  </tr>
                  <tr>
                       <th>
                           <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/bulletin',array('uid'=>$uid,'op'=>'display'))?>">
                                <div id="left" style="text-align: center;">
                                     <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                        <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon9.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                     </span>
                                     <span style=" display: inline-block;color: #848484;">
                                        消息留言
                                     </span>
                                </div>
                            </a>
                       </th>
                  </tr>
             </table>
        </div>
    </div>
    <div class="makecode2">
        <div class="list-button">
            <table>
                  <tr>
                       <th>
                           <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/store_management',array('uid'=>$uid,'op'=>'display'))?>">
                                <div id="left" style="text-align: center;">
                                     <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                        <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon5.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                     </span>
                                     <span style=" display: inline-block;color: #848484;">
                                        店铺管理
                                     </span>
                                </div>
                            </a>
                       </th>
                    </tr>
                    <tr>
                        <th>
                           <a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/pay_log')?>">
                                <div id="left" style="text-align: center;">
                                     <span id="img" style="display: inline-block;width: 45px;height:45px;position: relative;">
                                        <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/shopIcon5.png" style="width: 70%;height: 70%;top: 10px;position: absolute;left: 7px;"/>
                                     </span>
                                     <span style=" display: inline-block;color: #848484;">
                                         线下支付记录
                                     </span>
                                </div>
                            </a>
                       </th>
                  </tr>
             </table>
        </div>
        <div class="makecode">      
            <a href=<?php  echo $this->createPluginMobileUrl('suppliermenu/pay',array('op'=>'code'))?>>生成收款二维码</a>
        </div>
    </div>
    <div class="copyright">版权所有 © 广州KT </div>
</script>
<div id="big_body"></div>

<script type="text/javascript">

require(['tpl', 'core'], function(tpl, core) {
	core.pjson('suppliermenu/index', {op:'getinfo'}, function(json) {
        console.log(json);
        $("#big_body").append(tpl('tpl_list-buttons', json.result));
		$("#big_body").prepend(tpl('tpl_header',json.result));


          var time=parseInt($(".time").text());
          var newTime = new Date(time);

          console.log(newTime)

          $(".num").each(function(){
            var index=$(".num").index(this)+1;
            <?php  if($read_count > 0 ) { ?>
                if(index  == 10){
                    $(this).show();
                }
            <?php  } ?>
            <?php  if($read_supplier > 0 ) { ?>
            if(index==4){
                $(this).show();
            }
            <?php  } ?>
          })

        

        //切换
        $('.list_son').click(function(){
            $(this).addClass('list_on').siblings().removeClass('list_on');
            if($(this).index()==1){
                $('.makecode').show();
                $('.makecode2').show();
                $('.makecode1').hide();

            }else{
                $('.makecode').hide();
                $('.makecode1').show();
                $('.makecode2').hide();
            }
        });
	}, true);	 
})
</script>

<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>