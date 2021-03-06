<?php defined('IN_IA') or exit('Access Denied');?><?php  $copyright = m('common')->getCopyright(true)?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php  if(!empty($copyright) && !empty($copyright['title'])) { ?><?php  echo $copyright['title'];?><?php  } ?></title>
        <link rel="shortcut icon" href="<?php  echo $_W['siteroot'];?><?php  echo $_W['config']['upload']['attachdir'];?>/<?php  if(!empty($_W['setting']['copyright']['icon'])) { ?><?php  echo $_W['setting']['copyright']['icon'];?><?php  } else { ?>images/global/wechat.jpg<?php  } ?>" />
        <link href="<?php  echo WX_SHOP_LOCAL?>static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
        <link href="<?php  echo WX_SHOP_LOCAL?>static/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
        <link href="<?php  echo WX_SHOP_LOCAL?>static/css/animate.css" rel="stylesheet">
        <link href="<?php  echo WX_SHOP_LOCAL?>static/css/v3.css?v=4.1.0" rel="stylesheet">
        <link href="<?php  echo WX_SHOP_LOCAL?>static/css/common_v3.css?v=2.0.0" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php  echo WX_SHOP_LOCAL?>static/fonts/v3/iconfont.css?v=2016070717">
        <link rel="stylesheet" type="text/css" href="<?php  echo WX_SHOP_LOCAL?>static/fonts/iconfont.css?v=2016070717">

        <style type="text/css">
        /*二级导航*/
        .wb-header > ul {
            height: 100%;
            margin: 0;
            border-bottom: 1px solid #efefef;
            float: left;
        }
        .wb-topbar-search {
            width: 400px;
            z-index: 10;
            background-color: #fff;
            border: 1px solid #efefef;
            border-top: none;
            position: relative;
            float: left;
        }
        .wb-panel {
            top: 110px;
            bottom: 0;
            width: 40%;
            height: 100%;
            right: 60px;
            font-size: 12px;
            color: #888;
            transition: all 0.3s;
            background: #fff;
            z-index: 100;
            float: left;
            border-bottom: 1px solid #efefef;
        }
        .switch-version-box {
            border: none;
            float: left;
        }
        .switch-version {
            height: 26px;
            width: 70px;
            background: #1085d7;
            color: #fff !important;
            font-size: 12px;
            line-height: 26px;
            text-align: center;
            cursor: pointer;
            position: relative;
            margin: 15px 20px 0 0;
            border: none;
        }
        .wb-header > ul > li {
            float: left;
            width: 50px;
            height: 100%;
            text-align: center;
            border-left: 1px solid #efefef;
            line-height: 55px;
            cursor: pointer;
        }
        .fui-list-group {
            height: 120px;
            border-bottom: 1px solid #e6ecf1; 
        }
        .fui-list {
            width: 25%;
            height: 120px;
            float: left;
            padding: 38px 10px 20px;
        }
        .fui-list a{
            width: 100%;
            height: 100%;
        }
        .fui-list-media {
            float: left;
            padding-left: 23px;
            height: 100%;
            width: 20%;
        }
        .fui-list-inner{
            width: 80%;
            height: 100%;
            float: left;
        }
        .fast-nav.in{
            display: block;
        }
        .fast-nav .fast-list {
            padding-top: 26px;
            padding-left: 15px;
            height: 100%;
            width: 15%;
            float: left;
            border-right: 1px solid #efefef;
        }
        .fast-nav .fast-list.list{
            width: 70%;
            border-bottom: none;
        }
        .fast-nav .fast-list.list .list-inner.in{
            display: block;
        }
        /*菜单管理*/
        .wb-subnav div ul{
            margin-left: 20px;
        }
        .wb-subnav div ul.single{
            margin-left: 0px;
        }
        .page-header{
            margin-top: 110px;
        }
        .page-heading{
            position: relative;
            margin-top: 10px;
            width: 100%;
            height: 80px;
        }
        .form-horizontal.form-validate{
            background: #fff;
        }
        .page-heading h2{
            height: 40px;
            line-height: 40px;
        }
        .page-heading span{
            position: absolute;
            left: 0px;
            top: 45px;
        }
        .page-toolbar.row{
            margin:0px;
        }
        .col-sm-4,.col-sm-5,.col-sm-6{
            width: 20%;
            float: left;
        }
        .btn-group .btn-default{
            float: left;
        }

        .col-sm-6.pull-right{
            width: 80%;
            float: left;
            position: relative;
        }
        .form-control.input-sm.select-sm{
            width: 40%;
            float: left;
        }
        .page-toolbar .col-sm-6.pull-right .input-group{
            width: 40%;
            float: left;
        }
        </style>

        <script src="<?php  echo WX_SHOP_LOCAL?>static/fonts/iconfont.js"></script>

        <script src="./resource/js/lib/jquery-1.11.1.min.js"></script>
        <script src="<?php  echo WX_SHOP_LOCAL?>static/js/dist/jquery/jquery.gcjs.js"></script>
        <script src="./resource/js/app/util.js"></script>


        <script type="text/javascript">
            window.sysinfo = {
            <?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
            <?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
            <?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
            <?php  if(!empty($_W['uid'])) { ?>'uid': '<?php  echo $_W['uid'];?>',<?php  } ?>
            'isfounder': <?php  if(!empty($_W['isfounder'])) { ?>1<?php  } else { ?>0<?php  } ?>,
            'siteroot': '<?php  echo $_W['siteroot'];?>',
                    'siteurl': '<?php  echo $_W['siteurl'];?>',
                    'attachurl': '<?php  echo $_W['attachurl'];?>',
                    'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
                    'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
                    'module' : {'url' : '<?php  if(defined('MODULE_URL')) { ?><?php echo MODULE_URL;?><?php  } ?>', 'name' : '<?php  if(defined('IN_MODULE')) { ?><?php echo IN_MODULE;?><?php  } ?>'},
            'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
            'account' : <?php  echo json_encode($_W['account'])?>,
            };
        </script>


        <!-- 兼容易福1.5.3 -->
        <?php  if(IMS_VERSION >= 1.5) { ?>
         <link href="./resource/css/HaiSheng.common.css?v=1.0.9" rel="stylesheet">
        <script type="text/javascript" src="./resource/js/lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="./resource/js/app/common.min.js?v=20170802"></script>
        <script type="text/javascript">if(util){util.clip = function(){}}</script>
        <?php  } ?>
        <script src="https://cdn.bootcss.com/socket.io/2.2.0/socket.io.js"></script>
        

        <script src="<?php  echo WX_SHOP_LOCAL?>static/js/require.js"></script>

        <?php  if(IMS_VERSION > 0.8 && IMS_VERSION != '1.0.0') { ?>
        <script src="<?php  echo WX_SHOP_LOCAL?>static/js/config1.0.js"></script>
        <?php  } else { ?>
        <script src="./resource/js/app/config.js"></script>
        <?php  } ?>

        <script>
            require.config({
                waitSeconds: 0
            });
        </script>
        <script src="<?php  echo WX_SHOP_LOCAL?>static/js/myconfig.js"></script>
        <script type="text/javascript">
            if (navigator.appName == 'Microsoft Internet Explorer') {
                if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                    alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
                }
            }
            myrequire.path = "<?php  echo $_W['siteroot'];?>addons/wx_shop/static/js/";

            function preview_html(txt)
            {
                var win = window.open("", "win", "width=300,height=600"); // a window object
                win.document.open("text/html", "replace");
                win.document.write($(txt).val());
                win.document.close();
            }
            // 二级菜单点击事件显示导航
            window.onload=function(){
                // 获取当前节点元素
               var  menu=document.getElementsByClassName('menu-active');
                list=document.getElementsByClassName('list-inner');
                
                // 移入移除显示隐藏
                for (var i = 0;i<menu.length;i++) {
                    menu[i].onmouseover=function(){
                        for (var j=0;j<menu.length;j++) {
                            if(menu[j]===this){
                                index=j;
                                list[index].addClass('in');
                            }else{

                            }
                        }
                    }
                    menu[i].onmouseout=function(){
                        for (var j=0;j<menu.length;j++) {
                            if(menu[j]===this){
                                index=j;
                                list[index].removeClass('in');
                            }else{
                                
                            }
                        }
                    }
                }
            }
        </script>
    

    <body>
<!--efwww_com-->