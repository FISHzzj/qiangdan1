<?php defined('IN_IA') or exit('Access Denied');?><!-- 2222 -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>用户中心_<?php  echo $this->yzShopSet['pctitle']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <link href="../addons/sz_yi/static/css/font-awesome.min.css" rel="stylesheet">
    <script language="javascript" src="../addons/sz_yi/static/js/require.js"></script>
    <script language="javascript" src="../addons/sz_yi/static/js/app/config.js?v=2"></script>
    <script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
    <script language="javascript" src="../addons/sz_yi/static/js/dist/jquery.gcjs.js"></script>


    <!-- <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/style.css"> -->

    <link rel="stylesheet" href="../addons/sz_yi/template/pc/default/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="../addons/sz_yi/template/pc/default/static/css/member-center.css">
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/pc/default/static/css/style.css">
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/pc/default/static/newpc/assets/css/common.css">
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/pc/default/static/newpc/assets/fontMain/iconfont.css">
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/pc/default/static/newpc/assets/css/base.css">
    <link href="../addons/sz_yi/template/pc/default/static/newpc/assets/css/royalslider.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/pc/default/static/newpc/assets/css/main.css">
    
    <!-- 前台和后台进行ajax传数据必须的样式和脚本 start -->
    <script language="javascript" src="../addons/sz_yi/static/js/require.js"></script>
    <script language="javascript" src="../addons/sz_yi/static/js/app/config.js?v=2"></script>
    <script language="javascript" src="../addons/sz_yi/static/js/dist/jquery.gcjs.js"></script>
    <script language="javascript">
        require(['core','tpl'],function(core,tpl){
            core.init({
                siteUrl: "<?php  echo $_W['siteroot'];?>",
                baseUrl: "<?php  echo $this->createMobileUrl('ROUTES')?>"
            });
        })
    </script>
    <!-- 前台和后台进行ajax传数据必须的样式和脚本 end -->
    </head>
    <body>
<style type="text/css">
    .menu{width: auto;background-color:#f2f2f2;}
    .header-box ul li.menu-item .myinfo{width: auto;}
    .header-box ul li .we-chat-qrcode{left: -17px;}
    .m-categoryWrap .m-all .menu1 {color: #fff;display: block;text-indent: 40px;text-decoration: none;width: 210px; height: 40px;line-height: 40px;z-index: 9999;position: absolute; top: 0px;left: -25px;font-size: 16px;}
    .header{margin-top: 0px !important;}
    .m-categoryWrap .m-all{width: 235px;}
    .m-categoryWrap .allCategory{width: 965px;}
    .header-box ul li .we-chat-qrcode{left: -17px;}
    .header-box ul .home i{font-size: 15px;}
    .header-top ul li i{font-size: 15px;}
    .active2{color: #e31939 !important;}
    /*智能搜索*/
     .result1 {position:absolute;top: 40px;left:0px;background: #fff;border: 1px solid #d2cece;width: 100%;height:293px;overflow-y:auto;padding-bottom:20px;}
    #search_container{display: none;}
    .result1 ul {margin:0;padding:0;}
   .result1 ul li { width:94%;border-bottom:1px solid #dedede; padding:0 3%; white-space:nowrap;overflow:hidden;text-overflow:ellipsis;padding-top:10px;padding-bottom:10px;}
   .result1 ul li  a {color:#999; text-decoration: none; }
</style>


<script language="javascript">
    require(['core','tpl'],function(core,tpl){
        core.init({
            siteUrl: "<?php  echo $_W['siteroot'];?>",
            baseUrl: "<?php  echo $this->createMobileUrl('ROUTES')?>"
        });
          $('#search').unbind('keyup').keyup(function(){
                var keywords = $.trim( $(this).val());
                if(keywords==''){
                    $('#search_container').html("");  
                    $('#search_container').css("display","none");  
                    return;
                }
                 $('#search_container').css("display","block");
                core.json('shop/util',{op:'search',keywords:keywords }, function (json) {
                     var result = json.result;
                     if(result.list.length>0){
                        $('#search_container').html(tpl('tpl_search_list',result));    
                     }
                     else{
                        $('#search_container').html("");         
                     }

                  }, true);
            });

            $('#search').bind('keypress', function (event) {  
                if (event.keyCode == "13") {  
                    // alert("test");  
                   search();  
                   return false;   //阻止回车之后的页面刷新而使得搜索的事件读不到  

                }
            });

             //点击搜索的操作处理

           function search(){

                var keywords = $.trim( $('#search').val() ); //获取商品名称

                var url = core.getUrl('shop/list',{keywords:keywords});

                location.href=  url;

            };

            $(document).ready(function(){
                $('.m-categoryWrap .allCategory li a').each(function(){
                    if($($(this))[0].href==String(window.location))
                        $(this).addClass('active2');
                    });
            })
    })
</script>
</head>
<body>
	<!--
	<script src="http://member.ecmoban.com/content/themes/ecmoban2014/js/jquery.min.js"></script>
    <script src="http://member.ecmoban.com/content/themes/ecmoban2014/bootstrap/js/bootstrap.min.js"></script>
    <script>var _hmt = _hmt || [];</script>
    -->

<!--     <div class="top-head fl wfs fz12">
    <div class="wrapper">
        <div class="left fl">尊敬的<?php  echo $this->yzShopSet['name']?>用户，欢迎登陆管理中心！</div>
            <div class="right fr" >
            您的账号：<?php  echo $_COOKIE['member_mobile']?>
                <a href="<?php  echo $this->createMobileUrl('member/forget')?>">[修改密码]</a>
                <a href="<?php  echo $this->createMobileUrl('member/logout')?>">[退出登录]</a>
            </div>
    </div>
</div>


<div class="head fl wfs">
<div class="wrapper">
    <a class="logo" href="<?php  echo $this->createMobileUrl('shop/index')?>">
        <?php  if($this->yzShopSet['pclogo']) { ?>
            <img src="<?php  echo $_W['siteroot'] . "attachment/" . $this->yzShopSet['pclogo']?>" style="width:270px;height:60px;" title="<?php  echo $this->yzShopSet['pctitle']?>">
        <?php  } else { ?>
            <img src="../addons/sz_yi/template/pc/default/static/images/logo.png" title="" alt="我是默认logo">
        <?php  } ?>
    </a>
    <div class="nav">
        <a class="index" href="<?php  echo $this->createMobileUrl('shop/index')?>">首页</a>
        <a class="member member-now" href="<?php  echo $this->createMobileUrl('order')?>">会员中心</a>
        <a class="order1 " href="<?php  echo $this->createMobileUrl('shop/cart')?>">购物车</a>

        <a class="account " href="<?php  echo $this->createMobileUrl('shop/favorite')?>">我的收藏</a>
        <a class="service " href="<?php  echo $this->createMobileUrl('shop/address')?>">收货地址</a>
    </div>
</div>
</div> -->



<!-- 新 -->
    <!-- 页面top -->
    <div class="header-top">
        <div class="header-box">
          <?php  if(empty($_W['usermess'])) { ?>
                <div id="login-info" class="login-info">
                    <a class="login color" href="<?php  echo $this->createMobileUrl('member/login')?>">请登录</a>
                    <a class="register" href="<?php  echo $this->createMobileUrl('member/register')?>">免费注册</a>
                </div>
            <?php  } else { ?>
                <div id="login-info" class="login-info">
                    <em>
                        <a  onfocus="this.blur();" style="text-decoration:none;cursor:default;" target="_blank" class="color"></a>
                    </em>
                    <a onfocus="this.blur();" style="text-decoration:none;cursor:default;">欢迎您,
                    <?php  if($_W['usermess']['nickname'] =='') { ?>
                       <?php  echo $_W['usermess']['realname'];?>
                    <?php  } else { ?>
                       <?php  echo $_W['usermess']['nickname'];?>
                    <?php  } ?>
                    </a>
                </div>
                <div id="login-info" class="login-info">
                    <em>
                        <a href="#" target="_blank" class="color"></a>
                    </em>
                    <a href="<?php  echo $this->createMobileUrl('member/logout')?>">退出</a>
                </div>
            <?php  } ?>

                <ul>
                    <li>
                        <a class="menu-hd home" href="<?php  echo $this->createMobileUrl('shop/index')?>">
                            <i class="iconfont" style="font-size: 15px;">&#xe67d;</i>
                            商城首页
                        </a>
                    </li>
                    <li>
                        <div class="menu">
                            <a class="menu-hd myinfo" href="<?php  echo $this->createMobileUrl('member/indexCenter')?>">
                                <i class="iconfont">&#xe63f;</i>
                                个人中心
                                <b></b>
                            </a>
                            <!-- <div id="menu-2" class="menu-bd" style="display: none;">
                                <span class="menu-bd-mask"></span>
                                <div class="menu-bd-panel">
                                    <a href="#" target="_blank">已买到的宝贝</a>
                                    <a href="#" target="_blank">我的地址管理</a>
                                    <a href="#" target="_blank">我收藏的宝贝</a>
                                    <a href="#" target="_blank">我收藏的店铺</a>
                                </div>
                            </div> -->
                        </div>
                    </li>
                    <li>
                        <a class="menu-hd cart" href="<?php  echo $this->createMobileUrl('shop/cart')?>" target="_top">
                            <i class="iconfont">&#xe68c;</i>
                                购物车
                            <span class=""><?php  echo $totalcart;?></span>
                            <b></b>
                        </a>
                    </li>
                    <li>
                      <a class="menu-hd" href="<?php  echo $this->createMobileUrl('shop/bandlist')?>" target="_blank">
                        <i class="iconfont">&#xe63f;</i>
                        卖家中心
                      </a>
                    </li>

                    <li class="menu-item">
                        <div class="menu">
                            <a class="menu-hd we-chat" href="#" target="_top">
                                <i class="iconfont" style="font-size: 13px;">&#xe661;</i>
                                关注商城
                                <b></b>
                            </a>
                            <div id="menu-5" class="menu-bd we-chat-qrcode">
                                <span class="menu-bd-mask" style="right: 0px;width: 103px;"></span>
                                <a target="_top">
                                    <img src="../attachment/<?php  echo $this -> pcerweilogo?>" alt="">
                                </a>
                                <p class="wechat" style="width: auto;">关注官方微信</p>
                            </div>
                        </div>
                    </li>

                </ul>
          </div>
    </div>

    <!-- 头部 -->
    <div class="header" style="margin-top: 0px;padding-top: 30px;background: white;">
        <div class="f-width1210">
            <div class="logoLeft">

                     <!-- logo左边 -->
                    <a href="<?php  echo $this->createMobileUrl('shop/index')?>" class="logo">
                        <!-- <img src="../attachment/<?php  if($_GPC['p'] == 'center') { ?><?php  echo $setcenter['shop']['pctoplogo'];?><?php  } else if($_GPC['p'] == 'coupon') { ?><?php  echo $setcoupon['shop']['pctoplogo'];?><?php  } else if($_GPC['p'] == 'withdraw') { ?><?php  echo $setwithdraw['shop']['pctoplogo'];?><?php  } else { ?><?php  echo $set['shop']['pctoplogo'];?><?php  } ?>"> -->
                         <img src="../attachment/<?php  echo $this -> pctoplogo?>">
                        <!-- <?php  if($this->yzShopSet['pclogo']) { ?>
                            <img src="<?php  echo $_W['siteroot'] . "attachment/" . $this->yzShopSet['pclogo']?>" style="width:270px;height:60px;" title="<?php  echo $this->yzShopSet['pctitle']?>">
                        <?php  } else { ?>
                            <img src="../addons/sz_yi/template/pc/default/static/images/logo.png" title="" alt="我是默认logo">
                        <?php  } ?> -->
                    </a>

                    <!-- logo左边 -->
                    <a href="#" class="logoRight">
                        <!-- <img src="../attachment/<?php  if($_GPC['p'] == 'center') { ?><?php  echo $setcenter['shop']['pctago'];?><?php  } else if($_GPC['p'] == 'coupon') { ?><?php  echo $setcoupon['shop']['pctago'];?><?php  } else if($_GPC['p'] == 'withdraw') { ?><?php  echo $setwithdraw['shop']['pctago'];?><?php  } else { ?><?php  echo $set['shop']['pctago'];?><?php  } ?>"> -->
                           <img src="../attachment/<?php  echo $this -> pctago?>">
                    </a>


            </div>
            <div class="search">
                <form>
                    <div class="searchDiv">
                        <?php  if($_GPC['p'] == 'bandlist') { ?>
                            <div class="fl f-relative" style="width: 80px;">
                                <div class="bs-chinese-region flat dropdown" data-submit-type="id" data-min-level="1" data-max-level="3">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="广州" data-toggle="dropdown" readonly="" value="" aria-expanded="false">
                                    <div class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <div>
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#province" data-next="city" role="tab" data-toggle="tab">省份</a></li>
                                                <li role="presentation"><a href="#city" data-next="district" role="tab" data-toggle="tab">城市</a></li>
                                                <li role="presentation"><a href="#district" data-next="street" role="tab" data-toggle="tab">县区</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="province">--</div>
                                                <div role="tabpanel" class="tab-pane" id="city">--</div>
                                                <div role="tabpanel" class="tab-pane" id="district">--</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <i class="iconfont f-col333 spanIcon"></i>
                            </div>
                        <?php  } ?>
                        <input class="keyword" name="search" id="search" placeholder="请输入要搜索的商品" style="width: 275px;" autocomplete="off">
                        <div class="searchBtn" id="searchBtns" onclick="search()">搜索</div>
                         <div id='search_container' class='result1'></div>
                    </div>
                </form>
                <div class="m-crumb f-marginT5">
                    <ul class="f-cb">
            <!--             <?php  if($_GPC['p'] == 'center') { ?>

                            <?php  if(is_array($setcenter['shop']['fmenus_name'])) { foreach($setcenter['shop']['fmenus_name'] as $k => $v) { ?>
                              <li><i>|</i><a href="<?php  echo $set['shop']['fmenus_url'][$k];?>"><?php  echo $v;?></a></li>
                            <?php  } } ?>

                        <?php  } else if($_GPC['p'] == 'coupon') { ?>

                            <?php  if(is_array($setcoupon['shop']['fmenus_name'])) { foreach($setcoupon['shop']['fmenus_name'] as $k => $v) { ?>
                             <li><i>|</i><a href="<?php  echo $set['shop']['fmenus_url'][$k];?>"><?php  echo $v;?></a></li>
                            <?php  } } ?>

                        <?php  } else if($_GPC['p'] == 'withdraw') { ?>

                             <?php  if(is_array($setwithdraw['shop']['fmenus_name'])) { foreach($setwithdraw['shop']['fmenus_name'] as $k => $v) { ?>
                              <li><i>|</i><a href="<?php  echo $set['shop']['fmenus_url'][$k];?>"><?php  echo $v;?></a></li>
                             <?php  } } ?>

                        <?php  } else { ?>


                        <?php  } ?> -->

                         <?php  if(is_array($_W['farr'])) { foreach($_W['farr'] as $k => $v) { ?>
                             <li><i>|</i><a href="<?php  echo $_W['farr_url'][$k];?>"><?php  echo $v;?></a></li>
                         <?php  } } ?>


                    </ul>
                </div>
            </div>
            <div class="header-right">
                <a href="#" target="_blank" title="">
                    <!-- <img src="../attachment/<?php  if($_GPC['p'] == 'center') { ?><?php  echo $setcenter['shop']['pctagt'];?><?php  } else if($_GPC['p'] == 'coupon') { ?><?php  echo $setcoupon['shop']['pctagt'];?><?php  } else if($_GPC['p'] == 'withdraw') { ?>{$$setwithdraw['shop']['pctagt']}<?php  } else { ?><?php  echo $set['shop']['pctagt'];?><?php  } ?>"> -->
                    <img src="../attachment/<?php  echo $this -> pctagt?>">
                </a>

            </div>
            <div class="f-cb"></div>
        </div>
    </div>


    <!-- 分类 -->
    <div class="m-categoryWrap" style="border-bottom:2px solid #e31939;">
        <div class="f-width1210">
            <div class="m-all f-bgColor fl">
                <a href="<?php  echo $this->createMobileUrl('shop/listfen')?>" class="menu1" title="查看全部商品分类">
                    <i class="iconfont">&#xe60e;</i>
                    全部商品分类
                </a>
            </div>
            <div class="fl allCategory">
                <ul>
      <!--               <li>
                        <a href="<?php  echo $this->createMobileUrl('shop/index')?>">首页</a>
                    </li>
                    <li>
                        <a href="<?php  echo $this->createMobileUrl('shop/list', array('order' => 'sales', 'by' => 'desc'))?>">全部商品</a>
                    </li>
                    <li>
                        <a href="<?php  echo $this->createMobileUrl('shop/bandlist')?>">商家列表</a>
                    </li>
                    <li>
                        <a href="<?php  echo $this->createMobileUrl('shop/notice')?>">店铺公告</a>
                    </li>
                    <?php  if($this->footer['commission']) { ?>
                        <li <?php  if($footer_current=='commission') { ?>class='active'<?php  } ?>>
                            <a href="<?php  echo $this->footer['commission']['url']?>">
                                <span><?php  echo $this->footer['commission']['text']?></span>
                            </a>
                        </li>
                    <?php  } ?>
                    <li>
                        <a href="<?php  echo $this->createMobileUrl('order')?>">会员中心</a>
                    </li> -->
                    <?php  if(is_array($_W['harr'])) { foreach($_W['harr'] as $k => $v) { ?>
                       <li>
                         <a href="<?php  echo $_W['harr_url'][$k];?>"><?php  echo $v;?></a>
                       </li>
                    <?php  } } ?>
                    <li style="float: right;">
                        <a href="<?php  echo $this->createMobileUrl('shop/bandlist')?>">商家列表</a>
                    </li>
                    <li class="f-cb"></li>

                </ul>
                <!-- <div class="Indexline">
                    <span style="left: 15px;"></span>
                </div> -->
            </div>
        </div>
    </div>

