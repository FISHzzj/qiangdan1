<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html ng-app="myApp">
<head>
<meta charset="utf-8">
<title><?php  echo $share['title'];?></title>
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<meta name="format-detection" content="telephone=no" />
<script>var require = {urlArgs: 'v=<?php  echo date('YmdHis');?>'};</script>
<script language="javascript" src="../addons/sz_yi/static/js/require.js"></script>
<script language="javascript" src="../addons/sz_yi/static/js/app/config.js"></script>
<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.11.1.min.js"></script>
<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery.gcjs.js"></script>
<link href="../addons/sz_yi/static/css/font-awesome.min.css" rel="stylesheet">
<link href="../addons/sz_yi/plugin/designer/template/imgsrc/designer.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/style.css">
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/static/css/bootstrap.min.css">
<style>
body {margin:0px; background:#f9f9f9; }
.fe-mod:hover{border:2px dashed rgba(0,0,0,0); cursor:default;}
.fe-mod,.fe-mod:hover {border:0px;}
.fe-mod-cube td {height:auto;}
ul,li{margin:0;padding:0}
#scrollDiv{width:250px;height:35px;line-height:35px;overflow:hidden; color:#FFF;}
#scrollDiv li{height:35px;padding-left:20px;}
#scrollDiv li p{ position:relative;}@font-face {	  font-family: 'FontAwesome';	  src: url('../web/themes/new/style/iconfont1/iconfont.eot');	  src: url('../web/themes/new/style/iconfont1/iconfont.eot?#iefix') format('embedded-opentype'),	  url('../web/themes/new/style/iconfont1/iconfont.woff') format('woff'),	  url('../web/themes/new/style/iconfont1/iconfont.ttf') format('truetype'),	  url('../web/themes/new/style/iconfont1/iconfont.svg#iconfont') format('svg');	}	@font-face {	  font-family: 'FontAwesome';	  src: url('../web/themes/new/style/iconfont1/iconfont1.eot');	  src: url('../web/themes/new/style/iconfont1/iconfont1.eot?#iefix') format('embedded-opentype'),	  url('../web/themes/new/style/iconfont1/iconfont1.woff') format('woff'),	  url('../web/themes/new/style/iconfont1/iconfont1.ttf') format('truetype'),	  url('../web/themes/new/style/iconfont1/iconfont1.svg#iconfont') format('svg');	}    .faboli39:before{content: '\e639';}    .faboli40:before{content: '\e642';}    .faboli41:before{content: '\e791';}    .faboli42:before{content: '\e633';}    .faboli43:before{content: '\e6be';}    .faboli44:before{content: '\e63a';}    .faboli45:before{content: '\e611';}    .faboli46:before{content: '\e6af';}    .faboli47:before{content: '\e894';}    .faboli48:before{content: '\e707';}    .faboli49:before{content: '\e6c1';}    .faboli50:before{content: '\e60c';}    .faboli51:before{content: '\e606';}    .faboli52:before{content: '\e63c';}    .faboli53:before{content: '\e617';}    .faboli54:before{content: '\e618';}    .faboli55:before{content: '\e803';}    .faboli56:before{content: '\e635';}    .faboli57:before{content: '\e88d';}    .faboli58:before{content: '\e63b';}    .faboli59:before{content: '\e607';}    .faboli60:before{content: '\e8b8';}    .faboli61:before{content: '\e600';}    .faboli62:before{content: '\e7b9';}     .faboli63:before{content: '\e665';}    .faboli64:before{content: '\e609';}    .faboli65:before{content: '\e60e';}    .faboli66:before{content: '\e663';}    .faboli67:before{content: '\e60b';}    .faboli68:before{content: '\e67d';}    .faboli69:before{content: '\e601';}    .faboli70:before{content: '\e600';}    .faboli71:before{content: '\e602';}    .faboli72:before{content: '\e6e3';}    .faboli73:before{content: '\e60b';}    .faboli74:before{content: '\e607';}    .faboli75:before{content: '\e611';}    .faboli76:before{content: '\e61d';}    .faboli77:before{content: '\e603';}    .faboli78:before{content: '\e6ab';}    .faboli79:before{content: '\e608';}    .faboli80:before{content: '\e612';}    .faboli81:before{content: '\e61a';}    .faboli82:before{content: '\e618';}    .faboli83:before{content: '\e61e';}    .faboli84:before{content: '\e601';}    .faboli85:before{content: '\e604';}    .faboli86:before{content: '\e62a';}     .faboli87:before{content: '\e626';}    .faboli88:before{content: '\e63b';}    .faboli89:before{content: '\e63a';}    .faboli90:before{content: '\e60d';}    .faboli91:before{content: '\e6ee';}    .faboli92:before{content: '\e605';}    .faboli93:before{content: '\e694';}    .faboli94:before{content: '\e60c';}    .faboli95:before{content: '\e617';}    .faboli96:before{content: '\e631';}    .faboli97:before{content: '\e608';}    .faboli98:before{content: '\e609';}    .faboli99:before{content: '\e616';}    .faboli100:before{content: '\e6b3';}    .faboli101:before{content: '\e60a';}    .faboli102:before{content: '\e91f';}
footer#footer-nav .menu-list li a > i{font-size: 26px;}
.model {position: fixed;left: 0;top: 0; right: 0;bottom: 0;z-index: 9999;height: 100%;width: 100%;background: rgba(0,0,0,0.8);display: none; }
.modelAlert1{display: none;font-size: 15px;width: 280px;height: 330px;position: fixed;left: 50%;top: 50%;margin-top: -180px;margin-left: -140px; background: white;text-align: center;line-height: 25px;z-index: 99999;border-radius: 5px;}
.modelAlert2 {display: none;font-size: 15px;width: 280px;height: 280px;position: fixed;left: 50%;top: 50%;margin-top: -180px;margin-left: -140px; background: white;text-align: center;line-height: 25px;z-index: 99999;border-radius: 5px;}
.f-yuan{position: absolute;top: 5px;right: 5px;width: 25px;height: 25px;line-height: 23px;text-align: center; border-radius: 50%; color: #ffffff;font-size: 14px;border: 2px solid #ffffff;}
.f-relative{position: relative;}
.num{background: red;position: absolute; border-radius: 50%;width: 15px; height: 15px;line-height: 30px;text-align: center;}
footer#footer-nav .menu-list li a{color: #747474;}
.modelAlert1 .erweima{width: 66px;position: absolute;left: 106px;top: 107px;}
.modelAlert2 .erweima{width:74%;position: absolute;left: 40px;top: 28px;}

.modelAlert1 .f-yuan{color: #ffffff;border: 2px solid #ffffff;}
.modelAlert2 .f-yuan{color: #282828;border: 1px solid #282828;width: 25px;height: 25px;font-size: 11px;line-height: 25px;}
.modelAlert2 .text{position: absolute;bottom: 11px;width: 100%;}
</style>

</head>
<body >
    <div ng-controller="MainCtrl">
        <!-- 浮动按钮 -->
        <div class="fe-floatico" style="position: fixed;" ng-style="{'width':pages[0].params.floatwidth,'top':pages[0].params.floattop}" ng-class="{'fe-floatico-right':pages[0].params.floatstyle=='right'}" ng-show="pages[0].params.floatico==1">
            <a href="{{pages[0].params.floathref || 'javascript:;'}}">
                <img ng-src="{{pages[0].params.floatimg || '../addons/sz_yi/plugin/designer/template/imgsrc/init-data/init-image-7.png'}}" style="width:100%;" />
            </a>
        </div>
        <!-- 关注按钮 -->
        <?php  if($guide['followed']!=1) { ?>
            <div style="height: 50px;" ng-show="pages[0].params.guide==1"></div>
            <a href="#">
                <div class="fe-guide" style="position: fixed;" ng-style="{'display':'block','background-color':pages[0].params.guidebgcolor,'opacity':pages[0].params.guideopacity}" ng-show="pages[0].params.guide==1">
                    <div class="fe-guide-faceimg" ng-style="{'border-radius':pages[0].params.guidefacestyle}">
                        <img src="<?php  echo $guide['logo'];?>" ng-style="{'border-radius':pages[0].params.guidefacestyle}" />
                    </div>
                    <div class="fe-guide-sub" onclick="show()" ng-style="{'color':pages[0].params.guidenavcolor,'background-color':pages[0].params.guidenavbgcolor}">{{pages[0].params.guidesub ||'立即关注'}}</div>
                    <div class="fe-guide-text"  ng-style="{'font-size':pages[0].params.guidesize,'color':pages[0].params.guidecolor}">
                        <p <?php  if(empty($guide['title2'])) { ?> style="line-height:40px;"<?php  } ?>><?php  echo $guide['title1'];?></p>
                        <p <?php  if(empty($guide['title1'])) { ?> style="line-height:40px;"<?php  } ?>><?php  echo $guide['title2'];?></p>
                    </div>
                </div>
            </a>
            <div class="model" onclick="hide()"></div>
            <!--样式一 -->
            <div class="modelAlert modelAlert1" style="background: url(../addons/sz_yi/template/mobile/style1/static/images/guanzhu.png) no-repeat center center;background-size: 100%;">
                 <div class="close1 f-yuan" onclick="hide()">X</div>
                 <img src="<?php  echo tomedia('qrcode_'.$_W['acid'].'.jpg');?>" class="erweima">
            </div> 

            <!--样式二 -->
            <!-- <div class="modelAlert modelAlert2">
                 <div class="close1 f-yuan" onclick="hide()">X</div>
                 <img src="../addons/sz_yi/template/mobile/style1/static/images/erweima.png" class="erweima">
                 <p class="text">识别二维码关注</p>
            </div> -->
        <?php  } ?>
        <div ng-repeat="Item in Items" class="fe-mod-repeat">
            <div ng-include="'../addons/sz_yi/plugin/designer/template/temp/show-'+Item.temp+'.html'" class="fe-mod-parent" id="{{Item.id}}" mid="{{Item.id}}" on-finish-render-filters></div>
        </div>
        <div ng-show="Items==''" style="line-height: 300px; text-align: center; font-size: 14px; color: #999;">
            <div id="core_loading" style="top:50%;left:50%;margin-left:-35px;margin-top:-50%;position:absolute;width:80px;height:60px;"><img src="../addons/sz_yi/static/images/loading.svg" width="80" /></div>
        </div>
        <div style="height: 50px;" ng-show="pages[0].params.footer==2"></div>
    </div>
<script type="text/javascript" src="../addons/sz_yi/plugin/designer/template/imgsrc/angular.min.js"></script>
<?php  $_W['angular_loaded']=true?>
<script type="text/javascript" src="../addons/sz_yi/plugin/designer/template/imgsrc/hhSwipe.js"></script>
<script type="text/javascript">
    function initswipe(jobj){
        var bullets = jobj.next().get(0).getElementsByTagName('a');
        var banner = Swipe(jobj.get(0), {
            auto: 4000,
            continuous: true,
            disableScroll:false,
            callback: function(pos) {
                var i = bullets.length;
                while (i--) {
                    $(bullets[i]).css("opacity",0.4);
                }
                $(bullets[pos]).css("opacity",0.6);
            }
        })
    }



    function show(){
        $(".model").fadeIn();
        $(".modelAlert").fadeIn();
    }

    function hide(){
        $(".model").fadeOut();
        $(".modelAlert").fadeOut();
    }

    var app = angular.module('myApp', []);
    app.controller('MainCtrl', ['$scope', function($scope){
            $scope.shop = {
                uniacid:'<?php  echo $_W["uniacid"];?>'
            };
            $scope.cols = [0,1,2,3];
            $scope.size = $(document.body).width()/4;
            $scope.pages = [<?php  echo $pageinfo;?>];
            $scope.system = [<?php  echo $system;?>];
            $scope.Items = [<?php  echo $data;?>];
            $scope.show = '1';
            
            $scope.hasCube = function(Item){
             
            	 var has = false;
                 var row=0,col = 0;
            	 for(var i=row;i<4;i++){
                    for(var j=col;j<4;j++){
                      if (Item.params.layout[i][j] && !Item.params.layout[i][j].isempty) {
                          has = true;
                          break;
                      }
                    }
                }
                return has;
                

            }
            
            $scope.$on('ngRepeatFinished',function(){
                $('.fe-mod-2 .swipe').each(function(){
                        initswipe($(this));
                 });
                 $('.fe-mod-8-main-img img').each(function(){
                     $(this).height($(this).width());    
                 });
                 $('.fe-mod-12 img').each(function(){
                     $(this).height($(this).width());    
                 });
                 $('.fe-mod-cube table  tr').each(function(){
                 	if( $(this).children().length<=0){
                 		$(this).html('<td></td>');
                 	}
                 });
            });
          
          
    }]);
    
    app.directive('stringHtml' , function(){
        return function(scope , el , attr){
            if(attr.stringHtml){
                scope.$watch(attr.stringHtml , function(html){
                    el.html(html || '');
                });
            }
        };
    });  
    app.directive("onFinishRenderFilters",function($timeout){
        return{
            restrict: 'A',
            link: function(scope,element,attr){
                if(scope.$last === true){
                    $timeout(function(){
                        scope.$emit('ngRepeatFinished');
                    });
                }
            }
        };
    });
</script>

<?php  if($footertype==1) { ?>
    <?php  $show_footer=true;$footer_current ='first'?>
<?php  } else if($footertype==2) { ?>
    <?php  $show_footer=false;?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('designer/menu', TEMPLATE_INCLUDEPATH)) : (include template('designer/menu', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
    <?php  $show_footer=false;?>
<?php  } ?>
 
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

<script type="text/javascript">
    // 微信分享
    require(['http://res.wx.qq.com/open/js/jweixin-1.0.0.js'], function(wx){
        /*微信JSSDK接口*/
        wx.config({
            debug: false,
            appId: '<?php  echo $signPackage["appId"];?>',
            timestamp: '<?php  echo $signPackage["timestamp"];?>',
            nonceStr: '<?php  echo $signPackage["nonceStr"];?>',
            signature: '<?php  echo $signPackage["signature"];?>',
            jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo']
        });
        wx.ready(function(){
            var data = {
                title: "<?php  echo $_W['shopshare']['title']; ?>", // 分享标题
                link: "<?php  echo $_W['shopshare']['link']; ?>", // 分享链接
                desc: "<?php  echo $_W['shopshare']['desc']; ?>",
                imgUrl: "<?php  echo tomedia($_W['shopshare']['imgUrl']); ?>", // 分享图标
                success: function () { 
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            };
            wx.onMenuShareTimeline(data);
            wx.onMenuShareAppMessage(data);
            wx.onMenuShareQQ(data);
            wx.onMenuShareWeibo(data);
        });
    });
</script>