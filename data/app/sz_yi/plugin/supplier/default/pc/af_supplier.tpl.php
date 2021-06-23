<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>
<title>供应商申请</title>     
<script language="javascript" src="../addons/sz_yi/static/js/require.js"></script>
<script language="javascript" src="../addons/sz_yi/static/js/app/config.js?v=2"></script>
<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery.gcjs.js"></script>
<style type="text/css">
body{background:#efefef;font-family:微软雅黑;-moz-appearance:none;margin:0;}
.info_main{margin-top:14px;border-top:1px solid #e8e8e8;height:auto;background:#fff;border-bottom:1px solid #e8e8e8;position:relative;}
.info_main .line{height:40px;border-bottom:1px dashed #e8e8e8;line-height:40px;color:#999;width:88%;margin:8px 0 0 15px;}
.info_main .line .title{height:30px;width:30px;line-height:40px;color:#444;float:left;font-size:16px;margin-left:13px;}
.info_main .line .info{width:100%;float:right;margin-left:-80px;}
.info_main .line .inner{margin-left:80px;}
.info_main .line .inner input{height:38px;width:100%;display:block;border:0;float:left;font-size:16px;margin:0;padding:0;}
.info_main .line .inner .user_sex{line-height:40px;}
.info_sub{height:44px;background:#10BDFF;text-align:center;font-size:16px;line-height:44px;color:#fff;border-radius:25px;margin:27px 34px;}
.info_sub1{height:48px;background:#10BDFF;text-align:center;font-size:20px;line-height:48px;color:#fff;border-radius:25px;margin:56px 46px;}
.select{border:1px solid #ccc;height:25px;}
.empty{width:100%;height:50px;}
.spot{width:20px;height:20px;position:absolute;top:152px;left:28px;}
.spot1{width:10px;height:10px;position:absolute;top:125px;left:16px;}
.icoImg{width:130px;height:80px;background:#10BDFF;position:relative;border-radius:8px;margin:0 auto;}
.spot2{width:20px;height:20px;position:absolute;top:152px;right:28px;}
.spot3{width:10px;height:10px;position:absolute;top:130px;right:10px;}
.icoImg img{width:60px;height:60px;position:absolute;top:10px;left:35px;}
.bar{width:75%;height:55px;line-height:19px;margin:10px 20px 10px auto;}
.bar .centerico{width:55%;height:5px;border-radius:8px;background:#ccc;float:left;transform:translateY(16px);-webkit-transform:translateY(16px);margin:0;padding:0;}
.input[type=radio]{-webkit-appearance:radio;appearance:radio;background:#ccc;border:initial;padding:initial;}
.input{width:20px!important;height:20px!important;margin-top:12px!important;}
#container{height:100%;}
.spanClass{height:100%;width:50%;background:#10BDFF;margin:0;padding:0;}
.alert{position:absolute;top:0;bottom:0;left:0;right:0;background-color:rgba(0,0,0,.5);z-index:99;}
.alert-bg{position:absolute;top:20%;left:18%;width:60%;height:52%;background-color:#fff;border-radius:10px;text-align:center;}
.close-alert{display:inline-block;width:20px;height:20px;border-radius:50%;background-color:#ccc;line-height:20px;position:absolute;top:-10px;right:-10px;}
.alert-bg p{font-size:20px;letter-spacing:3px;}
.alert-bg img{width:110px;height:110px;border-radius:50%;}
.alert-bg .reapply{display:block;width:150px;height:30px;font-size:18px;text-align:center;line-height:27px;border-radius:15px;background-color:#0ff;margin:2px auto;}
.spot img,.spot1 img,.spot2 img,.spot3 img,.bar .leftico img,.bar .rightico img,.info_main .line .title img{width:100%;height:100%;}
.bar .leftico,.bar .rightico{width:35px;height:35px;border-radius:50%;background:#10BDFF;text-align:center;color:#fff;float:left;}
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
<div id="container" class="rightlist"></div></div>
<!-- <script id="member_info" type="text/html">
    <div class="page_topbar">
		<div class="title">供应商申请</div>
	</div>
	<?php  if(empty($af_supplier)){?>
    <div class="info_main">
        <div class="line"><div class="title">姓名</div><div class='info'><div class='inner'><input type="text" id='realname' placeholder="请输入您的姓名"  value="" /></div></div></div>
        <div class="line"><div class="title">手机号码</div><div class='info'><div class='inner'><input type="text" id='mobile' placeholder="请输入您的手机号码"  value="" /></div></div></div>
        <div class="line"><div class="title">微信号</div><div class='info'><div class='inner'><input type="text" id='weixin' placeholder="请输入微信号" value=""/></div></div></div>
		<div class="line"><div class="title">产品名称</div><div class='info'><div class='inner'><input type="text" id='productname' placeholder="请输入产品名称" value=""/></div></div></div>
    </div>
    <div class="info_sub">提交申请</div>
	<?php  }?>
	<?php  if(!empty($af_supplier)){?>
		<div class="page_topbar">
			<div class="title">您已经提交过申请了</div>
		</div>
		<div class="info_sub1">确定</div>
	<?php  }?>
</script> -->

<script id="member_info" type="text/html">
    <div class="page_topbar" style="background:#10BDFF ;">
        <a href="javascript:;" class="back" onclick="history.back()" style="color: white;"><i class="fa fa-angle-left"></i><text style="font-size: 15px;width: 64px;top: 2px;position: absolute;">返回</text></a>
        
        <div class="title" style="color: white;">供应商申请</div>
    </div>

    <?php  if(!empty($af_supplier) && $af_supplier['status'] == 0) { ?>
        <div style="width: 100%;height: 100%;background: #fff;display: inline-block;">
            <!--<div style="background:#00c1ff;width:50px;height:50px;border-radius:50%;margin:10px auto;color:#fff;line-height: 50px;"><i style="font-size:28px" class="fa fa-check"></i></div>-->
            <div class="empty">
        
        </div>
        <div class="spot">
          <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/spot1.png"/>
        </div>
        <div class="spot1">
          <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/spot1.png"/>
        </div>
        <div class="spot2">
          <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/spot.png"/>
        </div>
        <div class="spot3">
          <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/spot.png"/>
        </div>
        <div class="icoImg">
          <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/if.png"/>
        </div>
        <div class="bar">
          <div class="leftico">
            <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/rightico2.png"/>
          </div>
          <div class="centerico">
            <span class="spanClass" style="float: right;"></span>       
          </div>
          <div class="rightico">
            <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/leftico2.png"/>
          </div>
        </div>
            <div style="text-align: center;font-size: 20px;margin-top:10px;">您已经提交申请,请耐心等待</div>
             <div class="info_sub1">确定</div>
        </div>
       
    <?php  } else { ?>
    <div class="info_main">
      <div class="empty">
        
      </div>
      <div class="spot">
        <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/spot.png"/>
      </div>
      <div class="spot1">
        <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/spot.png"/>
      </div>
      <div class="spot2">
        <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/spot1.png"/>
      </div>
      <div class="spot3">
        <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/spot.png"/>
      </div>
      <div class="icoImg">
        <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/application.png"/>
      </div>
      <div class="bar">
        <div class="leftico">
          <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/leftico1.png"/>
        </div>
        <div class="centerico">
          <span class="spanClass" style="float: left;"></span>        
        </div>
        <div class="rightico">
          <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/rightico1.png"/>
        </div>
      </div>
        <div class="line">
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
        </div>
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
                    <input type="text" id='realname' placeholder="请输入您的姓名" value="<?php  echo $af_supplier['realname'];?>"" />
                </div>
            </div>
        </div>
        <div class="line">
            <div class="title">
                <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/phone.png"/>
            </div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" id='mobile' placeholder="请输入您的手机号码" value="<?php  echo $af_supplier['mobile'];?>"" />
                </div>
            </div>
        </div>
        <div class="line">
            <div class="title">
               <img src="/addons/sz_yi/plugin/supplier/template/mobile/default/img/weichart.png"/>
            </div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" id='weixin' placeholder="请输入微信号" value="<?php  echo $af_supplier['weixin'];?>"" />
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
                  
                    <!-- <input type="text" id='productname' placeholder="请输入产品名称" value="<?php  echo $af_supplier['productname'];?>"" /> -->
                    <select id='productname' style="width: 98%;border: 0;height: 38px;margin: 0;background: 0;">
                        <option value="-1">请选择</option>
                        <?php  if(is_array($category)) { foreach($category as $item) { ?>
                            <option value="<?php  echo $item['name'];?>" <?php  if($item['name'] == $af_supplier['productname']) { ?> selected <?php  } ?>><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
        </div>
         <div class="info_sub">提交申请</div>
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
    require(['tpl', 'core'], function(tpl, core) {
        core.pjson('supplier/af_supplier',{},function(json){
            if (json.result.member) {
                var data = json.result.member;
                $('#container').html(tpl('member_info', data));
                    $('.info_sub1').click(function(){
                        window.location.href="<?php  echo $this->createMobileUrl('member/center')?>";
                    });
                $('.info_sub').click(function() {
                    if($(this).attr('saving')=='1')
                    {
                        return;
                    }
                    if( $('input[name="applytype"]:checked').val() == null ){
                       core.tip.show('请选择类型!');
                       return;
                    }

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
                            'productname': $('#productname').val(),
                            'applytype' : $('input[name = "applytype"]:checked').val(),
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
                })
            }
        });

    })
</script>
<!-- <script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        core.pjson('supplier/af_supplier',{},function(json){
            if (json.result.member) {
                var data = json.result.member;
                $('#container').html(tpl('member_info', data));
        				$('.info_sub1').click(function(){
        				 window.location.href="<?php  echo $this->createMobileUrl('order')?>";
        				});
                $('.info_sub').click(function() {
			
                    if($(this).attr('saving')=='1')
                    {
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
					   if( $('#productname').isEmpty()){
                           core.tip.show('请输入产品名!');
                           return;
                       }
                  
                   $(this).html('正在处理...').attr('saving',1);
                    core.pjson('supplier/af_supplier', {
                       'memberdata':{
                            'realname': $('#realname').val(),
                            'mobile': $('#mobile').val(),
                            'weixin': $('#weixin').val(),
							'productname': $('#productname').val()
                        }
                    }, function(json) {
                       
                        if(json.status==1){
                             core.tip.show('提交申请成功');
                             <?php  if(!empty($_GPC['returnurl'])) { ?>
                                 location.href="<?php  echo urldecode($_GPC['returnurl'])?>";
                             <?php  } else { ?>
                                 location.href="<?php  echo $this->createMobileUrl('member')?>";
                             <?php  } ?>
                        }
                        else{
                            $('.info_sub').html('确认').removeAttr('saving');
                            core.tip.show('提交申请失败!');
                        }
                    },true,true);
                })
            }
        });

    })
</script> -->

