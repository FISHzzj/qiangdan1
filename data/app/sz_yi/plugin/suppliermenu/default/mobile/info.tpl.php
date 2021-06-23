<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($op == 'edit') { ?>
    <title>修改资料</title>
    <style type="text/css">
		body{background:#fff;}
        .info_main {height:auto;  background:#fff; margin-top:14px; border-bottom:1px solid #e8e8e8; border-top:1px solid #e8e8e8;}
        .info_main .line {margin:0 10px; height:40px; border-bottom:1px solid #e8e8e8; line-height:40px; color:#999;}
        .info_main .line .title {height:40px; width:90px; line-height:40px; color:#000000; float:left; font-size:16px;padding-left:0px }
        .info_main .line .info { width: 100%; float: right; margin-left: -100px; height: 39px; overflow: hidden; }
        .info_main .line .inner { margin-left:100px; }
        .info_main .line input {height:35px; width:100%;display:block; padding:0px; margin:0px; border:0px; float:left; font-size:16px;color:#989898;}
        .info_main .line .inner .user_sex {line-height:40px;}
        .info_sub {height:44px; margin:14px 10px; background:#e45050; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
        .info_sub:hover{background: #e66868;}
        .info_main{margin-top: 0}
        .select { border: 1px solid #ccc; height: 30px; margin-top: 6px; line-height: 20px; background: #5c5c5c; color: #fff; padding: 0 5px; border-radius: 3px; }
        .page_topbar{background:#fff;}
        .home{position: absolute;right: 15px;top: 0;color: #000}

        .line .pic { width:100%;height:40px;border-radius:5px;color:#999;padding:3px;line-height:35px;font-size:13px;padding-left:10px;}
            .line .pic span {float:left;width:150px;}
            .line .pic .plus { float:right; margin-right:20px;  width:30px;height:30px;border:1px solid #e9e9e9; color:#dedede;; font-size:18px;line-height:30px;text-align:center;}
            .line .pic .plus i { left:7px;top:7px;}
            .line .pic .images { width:auto;}
            .line .pic .images .img { float:left; position:relative;width:30px;height:30px;border:1px solid #e9e9e9;margin-right:5px;}
           .line .pic .images .img img { position:absolute;top:0; width:100%;height:100%;}
            .line .pic .images .img .minus { position:absolute;color:red;width:8px;height:12px;top:-15px;right:-1px;}
            a:hover{
              text-decoration:none;
            }


    </style>
    <div class="page_topbar">
        <a href="#" class="back" onclick="history.back()">
            <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
         </a>
        <div class="title" style=" color: #282828;">修改密码</div>
    </div>
    <div style="margin:10px;color:#000">补全账户资料</div>
    <div class="info_main">
        <div class="line">
            <div class="title">真实姓名</div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" placeholder="请输入真实姓名" value="<?php  echo $info['realname'];?>" name="realname" />
                </div>
            </div>
        </div>

        <div class="line">
            <div class="title">手机号码</div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" placeholder="请输入手机号码" value="<?php  echo $info['mobile'];?>" name="mobile" />
                </div>
            </div>
        </div>

        <div class="line">
            <div class="title">银行卡号</div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" placeholder="请输入银行卡号" value="<?php  echo $info['banknumber'];?>" name="banknumber" />
                </div>
            </div>
        </div>

        <div class="line">
            <div class="title">开&nbsp;户&nbsp;行</div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" placeholder="请输入开户行" value="<?php  echo $info['accountbank'];?>" name="accountbank" />
                </div>
            </div>
        </div>

        <div class="line">
            <div class="title">开&nbsp;户&nbsp;名</div>
            <div class='info'>
                <div class='inner'>
                    <input type="text" placeholder="请输入开户名" value="<?php  echo $info['accountname'];?>" name="accountname" />
                </div>
            </div>
        </div>
       
    </div>
    <div class="info_sub">确认修改</div>


    <!-- <div class="customer_top">
            <div class="title" onclick='history.back()'><span class="back">&lt;</span>返回</div>
            <div class="title1">
                修改资料
            </div>
    </div>
    <div class="content">
        <div class="img">
                <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/edinfo.png" />
            </div>
        <div class="inputLi">
            <span>PERSONAL INFOMATION</span>
            <p>真实姓名：<input type="text" value="<?php  echo $info['realname'];?>" name="realname"></p>
            <p><span>手机</span>号：<input type="text" value="<?php  echo $info['mobile'];?>" name="mobile"></p>
            <p>银行卡号：<input type="text" value="<?php  echo $info['banknumber'];?>" name="banknumber"></p>
            <p><span>开户</span>行：<input type="text" value="<?php  echo $info['accountbank'];?>" name="accountbank"></p>
            <p><span>开户</span>名：<input type="text" value="<?php  echo $info['accountname'];?>" name="accountname"></p>
                <div class="submit">
                     <input type="submit" name="确认修改" value="确认修改">
                </div>             
        </div>       
    </div> -->
   
    <script>
        require(['core'], function( core) {
            $('.info_sub').click(function(){
                var data = {
                    op:'edit',
                    'realname'    : $('input[name="realname"]').val(),
                    'mobile'      : $('input[name="mobile"]').val(),
                    'banknumber'  : $('input[name="banknumber"]').val(),
                    'accountbank' : $('input[name="accountbank"]').val(),
                    'accountname' : $('input[name="accountname"]').val()
                };
                core.pjson('suppliermenu/info', data, function(json) {
                    if (json.status == 1) {
                        alert('修改成功！');
                        window.location.href="<?php  echo $this->createPluginMobileUrl('suppliermenu/index')?>";
                    } else if (json.status == 0) {
                        core.tip.show(json.result);
                    }
                }, true);
            });
        });
    </script>
<?php  } else if($op == 'editpwd') { ?>
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/aui.css">
    <title>修改密码</title>
    <style type="text/css">
		body{background:#f2f2f2;}
        .aui-list .aui-list-header{background:#f2f2f2;font-size: 0.7rem;color:#282828;}
        .aui-btn-danger{background-color: #e45050 !important;}
        .aui-btn-block{padding: 0.45rem 0;}
        .aui-list .aui-list-header{padding: 10px 8px 10px 12px;}
		.aui-list .aui-list-item{min-height: 2.5rem;}
        ::-webkit-input-placeholder { /* WebKit browsers */  
            color:    #989898; 
        }  
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */  
           color:    #989898; 
           opacity:  1;  
        }  
        ::-moz-placeholder { /* Mozilla Firefox 19+ */  
           color:    #989898;   
           opacity:  1;  
        }  
        :-ms-input-placeholder { /* Internet Explorer 10+ */  
           color:    #989898; 
        }  
    </style>
    <div class="page_topbar">
        <a href="#" class="back" onclick="history.back()">
            <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
        </a>
        <div class="title" style=" color: #282828;">修改密码</div>
    </div>
    <div class="aui-container">
        <div class="aui-content  ">
            <ul class="aui-list aui-form-list ">
                <li class="aui-list-header" style="padding-top:20px;">旧密码：</li>
                <li class="aui-list-item">
                    <div class="aui-list-item-inner">
                        
                        <div class="aui-list-item-input">
                            <input type="password" name="oldpwd"  placeholder="6-20字符,区分大小写">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="aui-content ">
            <ul class="aui-list aui-form-list">
                <li class="aui-list-header">新密码：</li>
                <li class="aui-list-item">
                    <div class="aui-list-item-inner">
                        
                        <div class="aui-list-item-input">
                            <input type="password" name="newpwd1" placeholder="6-20字符,区分大小写">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="aui-content ">
            <ul class="aui-list aui-form-list aui-margin-b-15">
                <li class="aui-list-header">确认密码：</li>
                <li class="aui-list-item">
                    <div class="aui-list-item-inner">
                        
                        <div class="aui-list-item-input">
                            <input type="password" name="newpwd2" placeholder="6-20字符,区分大小写">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="aui-content " style="padding:0px 15px;">
            <p><div class="aui-btn aui-btn-danger aui-btn-block confirm">确定</div></p> 
        </div>
    </div>


	<!-- <div class="content">
            <div class="img">
            <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/edpsw.png" />
        </div>
            <div class="inputLi">
                <span>CHANGE PASSWORD</span>
                <p><span>旧密</span>码：<input type="password"  name="oldpwd"></p>
                <p><span>新密</span>码：<input type="password" name="newpwd1"></p>
                <p><span>手机</span>号：   <input type="password" placeholder="请输入手机号码" name="phone"></p>
                <p><span>重复密码</span>：<input type="password" name="newpwd2"> </p>
                
            <div class="submit">
                 <input type="submit" name="确认修改" value="确认修改">
            </div>   
            </div>   
        </div> -->
    
    <script>
        require(['core'], function( core) {
            $('.confirm').click(function(){
                var data = {
                    op:'editpwd',
                    'oldpwd'  : $('input[name="oldpwd"]').val(),
                    'newpwd1' : $('input[name="newpwd1"]').val(),
                    'newpwd2' : $('input[name="newpwd2"]').val()
                };
                console.log(data);
                core.pjson('suppliermenu/info', data, function(json) {
                    console.log(json);
                    if (json.status == 1) {
                        alert('修改成功！');
                        window.location.href="<?php  echo $this->createPluginMobileUrl('suppliermenu/index')?>";
                    } else if (json.status == 0) {
                        core.tip.show(json.result);
                    }
                }, true);
            });
        });
    </script>
<?php  } else if($op == 'editstore') { ?>
<title>我的店铺</title>
<style type="text/css">
    
    body { margin: 0px; background: #f2f2f2;width: 100%; font-family: '微软雅黑'; -moz-appearance: none; overflow-x: hidden;color: #282828;}
    a { text-decoration: none; }

    #coupon_loading { padding:10px;color:#666;text-align: center;}
    #container{width: 100%;height: auto;margin-top: 17px;padding-bottom: 20px;overflow-x: hidden;}
    .center{width: 100%;margin: 0 auto;}
    .center .title{font-size: 16px;padding: 10px;background: white;margin-bottom: 10px;}
    .center .title input{border: 0;margin-left: 20px;}
    .center .portrait{background: white;font-size: 16px;height:124px;line-height: 88px;padding: 10px;width: 100%;margin-bottom: 10px;}
    .img{width:26px;height:30%;margin: 0 auto;height: 30%;}
    .img img{width: 100%;height: 100%;}
    .center .signs{background: white;font-size: 16px;height: 124px;line-height: 88px;padding: 10px;width: 100%;margin-bottom: 10px;}
    .upload-img1 {width: 100px;height: 100px;background: #f2f2f2;float:left;text-align: center;margin-left: 20px;position: relative;}
    
    .upload-img {width: 197px;height: 100px;background: #f2f2f2;float:left;text-align: center;margin-left: 20px;position: relative;}
    .share{font-size: 16px;color: #ccc;height: 60px;width: 100%;height: 120px;padding: 10px;background: white;}
    textarea{width: 100%;height: 100%;border: 1px solid #eaeaea;padding: 10px;color: #282828;}
    .confirm{height: 40px;background: #e45050;color: #fff;font-size: 16px;margin: 0 auto;text-align: center;line-height: 40px;margin-top: 20px;}
    .upload-img1 input{display:inline-block;position: absolute;left: 0px;width: 100px;height: 100px;top:0px;opacity: 0;}
    .upload-img input{display:inline-block;position: absolute;left: 0px;width: 197px;height: 100px;top:0px;opacity: 0;}
    .imgclass{width: 100%;height: 100%;}
    #description::-webkit-input-placeholder{color:#989898;}
</style>  
<div class="">
    <div class="page_topbar">
        <a href="#" class="back" onclick="history.back()">
        <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
      </a>
        <div class="title" style=" color: #282828;">我的店铺</div>
      <a href="#">
          <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
      </a>
    </div>
</div>
<form>
    <div id='container'>
        <div class="center">
            <div class="title">
                小店名称:
                <input type="text" name="" id="storename" placeholder="请输入小店名称" value="<?php  echo $storeData['storename'];?>" />
            </div>
            <div class="portrait">
                <div style="float: left;">小店头像:</div>
                <div class="upload-img1 ">
                    <p class="img"><img class="imgclass" src="/addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/plus.png" /></p>
                    <text>添加图片</text>
                    <input type="file" name="logoimg" id="logo" value="" />
                    <input type="hidden" name="logo" value="<?php  echo $storeData['logo'];?>" />
                </div>
            </div>
            <div class="signs">
                <div style="float: left;">小店店招:</div>
                <div class="upload-img ">
                    <p class="img"><img class="imgclass" src="/addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/plus.png" /></p>
                    <text>添加图片</text>
                    <input type="file" name="signboardimg" id="signboard" value="" />
                    <input type="hidden" name="signboard" value="<?php  echo $storeData['signboard'];?>" />
                </div>
            </div>
            <div class="share">
                <textarea name="description" id="description" rows="" cols="" placeholder="小店简介，分享你的小店"><?php  echo $storeData['description'];?></textarea>
            </div>
        </div>
        <div class="confirm">
            确认修改
        </div>
    </div>
</form>

<script src="../addons/sz_yi/static/js/dist/ajaxfileupload.js" type="text/javascript"></script>

<script type="text/javascript">

require(['tpl', 'core'], function(tpl, core) {
    var logo = "<?php  echo $storeData['logo'];?>";
    var signboard = "<?php  echo $storeData['signboard'];?>";
    if (logo) {
        var img = document.createElement("img");
        img.src = '../attachment/'+logo;
        img.className='imgclass';
        $('.upload-img1 p').remove();
        $('.upload-img1 text').remove();
        $(".upload-img1").append( img );
    }
    if (signboard) {
        var img = document.createElement("img");
        img.src = '../attachment/'+signboard;
        img.className='imgclass';
        $('.upload-img p').remove();
        $('.upload-img text').remove();
        $(".upload-img").append( img );
    }
    $('#logo').change(function() {
        core.loading('正在上传');
        console.log('test');
        $.ajaxFileUpload({
            url: core.getUrl('util/uploader'),
            data: {file: "logoimg"},
            secureuri: false, 
            fileElementId: 'logo', 
            dataType: 'json', 
            success: function(res, status) {
                console.log(res);
                core.removeLoading();
                var img = document.createElement("img");
        		img.src = res.url;
        		img.className='imgclass';
                $('.upload-img1 .imgclass').remove();
                $('input[name="logo"]').val(res.filename); // 把上传成功后的地址写入隐藏域
                $('.upload-img1 p').remove();
                $('.upload-img1 text').remove();
                $(".upload-img1").append( img );
            }, error: function(data, status, e) {
                core.removeLoading();
                core.tip.show('上传失败!');
            }
        });
    });
    /*图片上传*/
	
	$('#signboard').change(function(){
		core.loading('正在上传');
        console.log('test');
        $.ajaxFileUpload({
            url: core.getUrl('util/uploader'),
            data: {file: "signboardimg"},
            secureuri: false, 
            fileElementId: 'signboard', 
            dataType: 'json', 
            success: function(res, status) {
                console.log(res);
                core.removeLoading();
                var img = document.createElement("img");
        		img.src = res.url;
        		img.className='imgclass';
                $('.upload-img .imgclass').remove();
                $('input[name="signboard"]').val(res.filename); // 把上传成功后的地址写入隐藏域
                $('.upload-img p').remove();
                $('.upload-img text').remove();
                $(".upload-img").append( img );
            }, error: function(data, status, e) {
                core.removeLoading();
                core.tip.show('上传失败!');
            }
        });
	});

    $('.confirm').click(function(){
        var logo = $('input[name="logo"]').val();
        var signboard = $('input[name="signboard"]').val();
        var description = $('#description').val();
        var description = $('#description').val();
        var storename = $('#storename').val();

        core.pjson('suppliermenu/info', {
            op : 'editstore',
            logo : logo,
            signboard : signboard,
            description : description,
            storename : storename,
        }, function(json) {
            console.log(json);
            if (json.status == 1) {
                core.tip.alert('修改成功！');
            } else if (json.status == 0) {
                core.tip.show(json.result);
            }
        }, true);
    });
});		
	
</script>
<?php  } ?>
<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>