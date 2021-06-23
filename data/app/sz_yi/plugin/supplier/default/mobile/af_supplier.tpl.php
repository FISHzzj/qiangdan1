<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>商家申请</title>
<style type="text/css">
    body {margin:0px; background:#f2f2f2; font-family:'微软雅黑'; -moz-appearance:none;}
    .info_main {height:auto;  position: relative;margin-top: 40px;}
    .empty{width: 100%;height: 50px;}
    .spot{width: 20px;height: 20px;position: absolute;top: 152px;left: 28px;}
    .spot img{width: 100%;height: 100%;}
    .spot1{width: 10px;height: 10px;position: absolute;top: 125px;left: 16px;}
    .spot1 img{width: 100%;height: 100%;}
    .icoImg{width: 130px;height: 80px;margin: 0 auto;position: relative;border-radius: 8px;}
    .spot2{width:20px;height: 20px;position: absolute;top: 152px;right: 28px;}
    .spot2 img{width: 100%;height: 100%;}
    .spot3{width: 10px;height: 10px;position: absolute;top: 130px;right: 10px;}
    .spot3 img{width: 100%;height: 100%;}
    .icoImg{width: 130px;height: 80px;margin: 0 auto;position: relative;border-radius: 8px;}
    .icoImg img{width:60px;height: 60px;position: absolute;top: 10px;left: 35px;}
    .bar{width: 75%;margin: 10px auto;height: 55px;line-height: 19px; margin-right: 20px;}
    .bar .leftico{width: 35px;height: 35px;border-radius: 50%;background: #10BDFF;text-align: center;color: #fff;float: left;}
    .bar .leftico img{width: 100%;height: 100%;}
    .bar .rightico{width: 35px;height: 35px;border-radius: 50%;background: #10BDFF;text-align: center;color: #fff;float: left;}
    .bar .rightico img{width: 100%;height: 100%;}
    .bar .centerico{width:55%;height: 5px;border-radius: 8px;background:#ccc;float: left;padding: 0;margin: 0;transform: translateY(16px);-webkit-transform:translateY(16px);}
    .info_main .line {margin:10px auto; height:45px;  line-height:40px; color:#999;width: 88%;background: white;border-radius: 5px;}
    .info_main .line .title {height:30px; width:30px; line-height:40px; color:#444; float:left; font-size:16px;margin-left: 13px;}
    .info_main .line .title img{width: 100%;height: 100%;}
    .info_main .line .info { width:100%;float:right;margin-left:-80px;}
    .info_main .line .inner { margin-left:80px; }
    .info_main .line .inner input {height:45px; width:100%;display:block; padding:0px; margin:0px; border:0px; float:left; font-size:16px;}
    .info_main .line .inner .user_sex {line-height:40px;}
    .info_sub {height:44px; margin:22px 22px 5px 22px; background:#e45050; border-radius:5px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .info_sub1 {height:30px; margin:15px auto;width: 100px; background:#e45050; border-radius:10px; text-align:center; font-size:15px; line-height:30px; color:#fff;}
    .select { border:1px solid #ccc;height:25px;}
    .input[type="radio"]{
            -webkit-appearance: radio;
            appearance: radio;
             background: #ccc;
            padding: initial;
            border: initial;

    }
    input::-webkit-input-placeholder, textarea::-webkit-input-placeholder { 
    color: #989898; 
    } 
    input:-moz-placeholder, textarea:-moz-placeholder { 
    color: #989898;  
    } 
    input::-moz-placeholder, textarea::-moz-placeholder { 
    color: #989898; 
    } 
    input:-ms-input-placeholder, textarea:-ms-input-placeholder { 
    color: #989898; 
    } 
    .input{
        width: 20px !important;
        height: 20px !important;
        margin-top: 12px !important;
    }
    #container{height: 100%;}
    .spanClass{
    	height: 100%;
    	width:50%;
    	background: #10BDFF;
    	padding: 0;
    	margin: 0;
    	
    }
    .alert {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background-color: rgba(0, 0, 0, .5);
			z-index: 99;

		}

		.alert-bg {
			position: absolute;
			top: 20%;
			left: 18%;
			width: 60%;
			height: 52%;
			background-color: #fff;
			border-radius: 10px;
			text-align: center;

		}
		.close-alert {
			display: inline-block;
			width: 20px;
			height: 20px;
			border-radius: 50%;
			background-color: #ccc;
			line-height: 20px;
			position: absolute;
			top: -10px;
			right: -10px;

		}
		.alert-bg p {
			font-size: 20px;
			letter-spacing: 3px;
		}
		.alert-bg img {
			width: 110px;
			height: 110px;
			border-radius: 50%;
		}
		.alert-bg .reapply {
			display: block;
			margin: 2px auto;
			width: 150px;
			height: 30px;
			font-size: 18px;
			text-align: center;
			line-height: 27px;
			border-radius: 15px;
			background-color: #0ff;
		}
       @font-face {font-family: "iconfont";
  src: url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.eot?t=1474179952'); /* IE9*/
  src: url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.eot?t=1474179952#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.woff?t=1474179952') format('woff'), /* chrome, firefox */
  url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.ttf?t=1474179952') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
  url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.svg?t=1474179952#iconfont') format('svg'); /* iOS 4.1- */
}
@font-face {font-family: "iconfont";
  src: url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.eot?t=1474179952'); /* IE9*/
  src: url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.eot?t=1474179952#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.woff?t=1474179952') format('woff'), /* chrome, firefox */
  url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.ttf?t=1474179952') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
  url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.svg?t=1474179952#iconfont') format('svg'); /* iOS 4.1- */
}

.hs {
  font-family:"iconfont" !important;
  font-style:normal;
  -webkit-font-smoothing: antialiased;
  -webkit-text-stroke-width: 0.2px;
  -moz-osx-font-smoothing: grayscale;
  font-size: 20px;
}
.hs-xuanzhong{color: #e45050 !important;}

.ico{margin: 0 5px 0 20px;float: left;}

.hs-xuan:before { content: "\e739"; }
.hs-wei:before { content: "\e651"; }
.hs-xuanzhong:before { content: "\d622"; }

.model{position: fixed;left: 0;top: 0;right: 0;bottom: 0;z-index: 100;height: 100%; width: 100%;background: rgba(0,0,0,0.6);display: none;}
.modelAlert{display: none;font-size: 15px;width:250px;height:355px;position:fixed;left:50%;top:50%;margin-top:-180px;margin-left:-125px; background: white;text-align: center;line-height: 25px;z-index: 102;border-radius: 5px;}
.closeModel{color: #fff;text-align: center;height: 40px;line-height: 40px;border-radius: 5px;font-size: 16px;background: #ff6801;}
.modelAlert .tit{color: #282828; font-size: 14px;border-bottom: 1px solid #d6d6d6;height: 45px;line-height: 45px;margin-bottom: 10px;}
.gunscoll{overflow: scroll;}
.gunscollcontent{height: 256px;font-size: 12px; padding: 0 10px 10px;color: #656565;}
.empty1{height: 6px;border-bottom: 1px solid #d6d6d6;}
.close1{font-size: 14px;color:#282828;height: 43px;line-height: 43px;}
.disabled{background: #bdbdbd !important;}

</style>
<script src="../addons/sz_yi/static/js/dist/mobiscroll/mobiscroll.core-2.5.2.js" type="text/javascript"></script>
<script src="../addons/sz_yi/static/js/dist/mobiscroll/mobiscroll.core-2.5.2-zh.js" type="text/javascript"></script>
<link href="../addons/sz_yi/static/js/dist/mobiscroll/mobiscroll.core-2.5.2.css" rel="stylesheet" type="text/css" />
<link href="../addons/sz_yi/static/js/dist/mobiscroll/mobiscroll.animation-2.5.2.css" rel="stylesheet" type="text/css" />
<script src="../addons/sz_yi/static/js/dist/mobiscroll/mobiscroll.datetime-2.5.1.js" type="text/javascript"></script>
<script src="../addons/sz_yi/static/js/dist/mobiscroll/mobiscroll.datetime-2.5.1-zh.js" type="text/javascript"></script>
<script src="../addons/sz_yi/static/js/dist/mobiscroll/mobiscroll.android-ics-2.5.2.js" type="text/javascript"></script>
<link href="../addons/sz_yi/static/js/dist/mobiscroll/mobiscroll.android-ics-2.5.2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../addons/sz_yi/static/js/dist/area/cascade.js"></script>
<div id="container"></div>
<script id="member_info" type="text/html">
     <div class="page_topbar" style="background:white ;">
        <a href="javascript:;" class="back" onclick="history.back()" style="color: white;">
         
         <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
        </a>
        
        <div class="title" style=" color: #282828;">商家申请</div>
        <a href="#">
            <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
        </a>
    </div> 
 

    <?php  if(!empty($af_supplier) && $af_supplier['status'] == 0) { ?>
        <div style="width: 100%;background:#f2f2f2;display: inline-block;">
            <!--<div style="background:#00c1ff;width:50px;height:50px;border-radius:50%;margin:10px auto;color:#fff;line-height: 50px;"><i style="font-size:28px" class="fa fa-check"></i></div>-->
            <div class="empty" style="height: 100px;">
    		
	    	</div>
            <div style="width: 80%;margin:0 auto;padding: 10px;border-radius: 2px;">
    	    	<div class="icoImg">
    	    		<img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/if.png"/>
    	    	</div>

                <div style="text-align: center;font-size: 14px;color: #656565;">
                    您已经提交申请
                    <br>请耐心等待申请通过
                </div>
                <div class="info_sub1">确定</div>
             </div>
        </div>

       
    <?php  } else { ?>
    <div class="info_main">
        <!-- <div class="line">
            <div class="title"> 
               <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/Supplier.png"/>
            </div>
            <div class='info'>
                <div class='inner'>
                    <?php  if($set['switch'] == 1) { ?>
                    <label style="float: left;margin-left:2px;font-weight: normal;margin-right: 6px;">
                        <input type="radio" value="1" name="applytype" class="input" <?php  if($af_supplier['type'] == 1) { ?>checked<?php  } ?>>
                        <text style="display: inline-block;margin-top: 2px;margin-left: 3px;">供应商</text>
                    </label>
                    <?php  } ?>
                    <?php  if($set['storeswitch'] == 1) { ?>
                    <label style="float: left;margin-left:2px;font-weight: normal;">
                        <input type="radio" value="2" name="applytype" class="input" <?php  if($af_supplier['type'] == 2) { ?>checked<?php  } ?>>
                        <text style="display: inline-block;margin-top: 2px;margin-left: 3px;"> 商家</text>
                    </label>
                    <?php  } ?>
                </div>
            </div>
        </div> -->
        <input type="hidden" name="applytype" value="2">
        <div class="line">
            <div class="title">
                <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/pc.png"/>
            </div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" id='username' placeholder="请输入用户名" value="<?php  echo $af_supplier['username'];?>" <?php  if($af_supplier['username']) { ?> disabled="" <?php  } ?>/>
                </div>
            </div>
        </div>
        <div class="line">
            <div class="title">
                 <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/password.png"/>
            </div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" id='password' placeholder="请输入密码" value="<?php  echo $af_supplier['password'];?>" />
                </div>
            </div>
        </div>
        <div class="line">
            <div class="title">
              <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/name.png"/>
            </div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" id='realname' placeholder="请输入您的姓名" value="<?php  echo $af_supplier['realname'];?>" />
                </div>
            </div>
        </div>
        <div class="line">
            <div class="title">
                <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/phone.png"/>
            </div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" id='mobile' placeholder="请输入您的手机号码" value="<?php  echo $af_supplier['mobile'];?>"/>
                </div>
            </div>
        </div>
        <div class="line">
            <div class="title">
               <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/weichart.png"/>
            </div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" id='weixin' placeholder="请输入微信号" value="<?php  echo $af_supplier['weixin'];?>" />
                </div>
            </div>
        </div>
        <div class="line">
            <div class="title">
                <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/industry.png"/>
            </div>
            <div class='info'>
                <div class='inner' style="position: relative;">
                	<div style="width: 20px;height: 20px;position: absolute;right: 10px;">
                		<img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/downtriangle.png" style="height: 100%;width: 100%;"/>
                	</div>
                	

                    <select id='productname' style="width: 98%;border: 0;height: 38px;margin: 0;background: 0;">
                        <option value="-1">请选择</option>
                        <?php  if(is_array($category)) { foreach($category as $item) { ?>
                            <option value="<?php  echo $item['id'];?>" <?php  if($item['name'] == $af_supplier['productname']) { ?> selected <?php  } ?>><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
        </div>
        
         <div class="info_sub disabled">提交</div>
         <div class="xieyi" sel="0">
            <div class="ico" onclick="setSelect()">
                <i class="hs hs-wei" style="color: rgb(153, 153, 153);"></i>
            </div>
            <div class="fl" style="margin-top: 4px;">
                <span>本人已阅读并同意  </span>
                <span class="xieyispan" style="color: #e45050;" onclick="show()">商家申请协议</span>
            </div>
            <div class="f-cb"></div>            
         </div>
         <div class="model" onclick="hide()"></div>
         <div class="modelAlert">
             <div class="gunscoll">
                 <div class="tit">商家申请协议</div>
                 <div class="gunscollcontent">
                        <?php  echo $supplier_content['title'];?>
                     <?php  echo $supplier_content['content'];?>
                 </div>
                 
             </div>
             <div class="empty1"></div>
             <div class="close1" onclick="hide()">关闭</div>
         </div>
    </div>
   
    <?php  } ?>
    <?php  if($af_supplier['status'] == 1) { ?>
        <div class="off">
            <div class="alert">
				<div class="alert-bg">
					<span class="close-alert">X</span>
					<h2>非常遗憾</h2>
					<p>您的申请被驳回</p>
                    <p>原因:<?php  echo $af_supplier['account'];?></p>
					<img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/fail.png">
					<button class="reapply" id="application">重新申请</button>
				</div>
			</div>
           <!-- <p><button id="application">点击重新申请</button></p>-->
        </div>
        <script type="text/javascript">
            $(function(){
                $('.info_main').hide();
                $('.info_sub').hide();
                $('#application').click(function(){
                    $('.off').hide();
                    $('.info_main').show();
                    $('.info_sub').show();
                   			      				     
                });
                $('.close-alert').click(function(){
                	$('.off').remove();
                    $('.info_main').show();
                    $('.info_sub').show();
                	// window.location.href="<?php  echo $this->createMobileUrl('member/center')?>";
                	
                })
            });
         
            
            
        </script>
    <?php  } ?>
</script>
<script language="javascript">
function show(){
    $(".model").fadeIn();
    $(".modelAlert").fadeIn();
}

function hide(){
    $(".model").fadeOut();
    $(".modelAlert").fadeOut();
}

         function setSelect(){
           var sel=$(".ico").parent().attr('sel');
                        if(sel==1){
                                 $(".ico").find('i').addClass('hs-wei').removeClass('hs-xuanzhong').css('color', '#999');
                                 $(".ico").parent().attr('sel',0);
                                 $(".info_sub").addClass("disabled");
                            }else{
                                 $(".ico").find('i').removeClass('hs-wei').addClass('hs-xuanzhong').css('color', '#00c1ff');
                                 $(".ico").parent().attr('sel',1);
                                 $(".info_sub").removeClass("disabled");
                            }
            }

    require(['tpl', 'core'], function(tpl, core) {


        core.pjson('supplier/af_supplier',{},function(json){
            if (json.result.member) {
                var data = json.result.member;
                $('#container').html(tpl('member_info', data));
                    $('.info_sub1').click(function(){
                        window.location.href="<?php  echo $this->createMobileUrl('member/center')?>";
                    });
                $('.info_sub').click(function() {

                    if($(".xieyi").attr("sel")==0){

                    }else{                    
                        if($(this).attr('saving')=='1')
                        {
                            return;
                        }
                        // if( $('input[name="applytype"]:checked').val() == null ){
                        //    core.tip.show('请选择类型!');
                        //    return;
                        // }

                        if( $('#username').isEmpty()){
                           core.tip.show('请输入用户名!');
                           return;
                        }
                        if( $('#password').isEmpty()){
                           core.tip.show('请输入密码!');
                           return;
                        }
                        if( $('#realname').isEmpty()){
                           core.tip.show('请输入姓名!');
                           return;
                        }
                        if(!$('#mobile').isMobile()){
                           core.tip.show('请输入正确手机号码!');
                           return;
                        }
                        if( $('#weixin').isEmpty()){
                           core.tip.show('请输入微信号!');
                           return;
                        }
                        if( $('#productname').val() == -1 || $('#productname').val() == null ){
                           core.tip.show('请选择行业类别!');
                           return;
                        }
                        $(this).html('正在处理...').attr('saving',1);
                        core.pjson('supplier/af_supplier', {
                           'memberdata':{
                                'username': $('#username').val(),
                                'password': $('#password').val(),
                                'realname': $('#realname').val(),
                                'mobile': $('#mobile').val(),
                                'weixin': $('#weixin').val(),
                                'cate_id': $('#productname').val(),
                                'applytype' : 2,
                            }
                        }, function(json) {

                            if(json.status==1){
                                 // core.tip.show('提交申请成功');
                                 <?php  if(!empty($_GPC['returnurl'])) { ?>
                                     location.href="<?php  echo urldecode($_GPC['returnurl'])?>";
                                 <?php  } else { ?>
                                     location.href="<?php  echo $this->createPluginMobileUrl('supplier/af_supplier')?>";
                                 <?php  } ?>
                            }else if(json.status==2){
                              $('.info_sub').html('确认').removeAttr('saving');
                                core.tip.show('用户名已存在');
                            }else{
                              $('.info_sub').html('确认').removeAttr('saving');
                                core.tip.show('提交申请失败!');
                            }
                        },true,true);
                    }

                    
                })
            }
        });

    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>