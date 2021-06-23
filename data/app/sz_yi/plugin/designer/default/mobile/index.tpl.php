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

<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery-1.7.2.js"></script>

<script language="javascript" src="../addons/sz_yi/static/js/dist/jquery.gcjs.js"></script>

<link href="../addons/sz_yi/static/css/font-awesome.min.css" rel="stylesheet">

<link href="../addons/sz_yi/plugin/designer/template/imgsrc/designer.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/default/static/css/style.css">

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/static/css/bootstrap.min.css">

<link src="../addons/sz_yi/plugin/designer/template/imgsrc/swiper/css/swiper.css">



<style>

*{ margin: 0; padding: 0; box-sizing: border-box; }

body {margin:0px; background:#f9f9f9; }

.fe-mod:hover{border:2px dashed rgba(0,0,0,0); cursor:default;}

.fe-mod>.container{padding:0;}

.fe-mod,.fe-mod:hover {border:0px;}

.fe-mod2{z-index:99999;}

.fe-mod-cube td {height:auto;}

ul,li{margin:0;padding:0}

#scrollDiv{width:250px;height:35px;line-height:35px;overflow:hidden; color:#FFF;}

#scrollDiv li{height:35px;padding-left:20px;}

#scrollDiv li p{ position:relative;}



    /**

    * qin

    */

    .banner-list {display:inline-block;float:left;}

    .banner-list .banner .img {width:80%; margin: 0 auto;}

    .banner-list .banner .img img {width:100%;}

    .banner-list .banner .title div {display: -webkit-box;

-webkit-box-orient: vertical;

-webkit-line-clamp: 2;

overflow: hidden; }

    .banner-list .banner .title, .banner-list .banner .card-price { text-align: center; }

    /*0731*/

.cl-b { clear: both;}



/*search*/

.search { width: 100%; height: 60px; overflow: hidden; }

.search #a_logo1{ float: left; width: 60px; height: 60px; margin: 0; }

.search .msg img,.search .a-logo1 img { width: 30px; height: 30px; margin: 15px;}

.search .search-form { float: left; width: 100%; height: 60px; margin-right: -60px; padding-right: 70px;   }

.search .msg {float: left; width: 60px;height: 60px; margin-left: -60px; }



.search-form .keywords {position: relative; height: 38px; width: 100%; margin: 11px 0; border: 1px solid #333; border-radius: 5px;background-color: #efefef; overflow: hidden;}

.search-form .keywords input{ float: left; height: 38px; line-height: 38px; background-color: rgba(0,0,0,0); border: 0px; }

.search-form .keywords>input { width: 38px; }



.search-form .keywords img { position: absolute; left: 9px; top: 9px; width: 20px; height: 20px; overflow: hidden;}

.search-input-box { width: 100%;height: 38px; padding-left: 38px;  }

.search-input-box input { width: 100%;height: 38px; margin: 0;  }



/*nav*/

.btn_nav { width: 100%; height: 44px; overflow: hidden; }

.btn_nav nav { width: 100%; height: 70px; overflow: hidden; }

.btn_nav p { display: block; height: 70px; line-height: 44px; word-break:keep-all; white-space:nowrap;overflow-y: hidden; overflow-x:scroll;  -webkit-overflow-scrolling : touch;  }

.btn_nav p a { display: inline-block; height: 44px; padding: 0 6px; color: #999;}

.btn_nav p a.select { color: #333; }

.fe-mod2{position: fixed;top:0;width: 100%;max-width: 720px;margin:auto 0;z-index: 999;background: #313131;}

.search div{display: inline-block;}

.search .fe-mod-4-con{flex:9;}

.fe-panel-editor-line>.form-group { margin-bottom: 0px !important; }

.search{display: -webkit-inline-flex;

display: -moz-inline-flex;

display: -ms-inline-flex;

display: -o-inline-flex;

display: inline-flex;-ms-align-items: -webkit-center;

align-items: -webkit-center;width: 100%;padding: 10px 0;}

.search div{display: -webkit-inline-block;}

.search .fe-mod-4-con{-webkit-flex:9;-moz-flex:9;-ms-flex:9;-o-flex:9;}

.fe-panel-editor-line>.form-group {margin-bottom: 0px !important; }
/* 模态框 */
.model{position: fixed;left: 0;top: 0;right: 0;bottom: 0;z-index: 9999;height: 100%; width: 100%;background: rgba(0,0,0,0.6);}
.modelAlert{font-size: 15px;width:256px;position:fixed;left:50%;top:50%;margin-top:-180px;margin-left:-128px;text-align: center;line-height: 25px;z-index: 99991;border-radius: 5px;}
.closeModel{color: #fff;text-align: center;height: 40px;line-height: 40px;border-radius: 5px;font-size: 16px;background: #ff6801;}
.modelAlert .tit{margin: 15px 0 10px 0px;color: #282828; font-size: 14px;}
.gunscollcontent{position: relative;height:300px;background:url(../addons/sz_yi/template/mobile/style1/static/images/guanzhu.png)no-repeat;background-size: 100%;}
.gunscollcontent>.erweima{position: absolute;top: 54px;left: 51px;width: 154px;height: 145px;background: #fac;}
.close2{border:2px solid white;font-size: 15px;text-align: center;width: 25px;height: 25px;line-height: 17px;position: absolute;right: 5px;top:5px;color: white;border-radius: 50%;}
</style>



</head>

<body >

    <div ng-controller="MainCtrl" class="main-ctrl-pa">



        <!-- 浮动按钮 -->

        <div class="fe-floatico" style="position: fixed;" ng-style="{'width':pages[0].params.floatwidth,'top':pages[0].params.floattop}" ng-class="{'fe-floatico-right':pages[0].params.floatstyle=='right'}" ng-show="pages[0].params.floatico==1">

            <a href="{{pages[0].params.floathref || 'javascript:;'}}">

                <img ng-src="{{pages[0].params.floatimg || '../addons/sz_yi/plugin/designer/template/imgsrc/init-data/init-image-7.png'}}" style="width:100%;" />

            </a>

        </div>

        <!-- 关注按钮 -->

        <?php  if($guide['followed']!=1) { ?>

            <div style="height: auto;" ng-show="pages[0].params.guide==1"></div>

           <!--  <a href="<?php  echo $guide['followurl'];?>"> -->

                <div class="fe-guide" id="attention" style="position: fixed;" ng-style="{'display':'block','background-color':pages[0].params.guidebgcolor,'opacity':pages[0].params.guideopacity}" ng-show="pages[0].params.guide==1">

                    <div class="fe-guide-faceimg" ng-style="{'border-radius':pages[0].params.guidefacestyle}">

                        <img src="<?php  echo $guide['logo'];?>" ng-style="{'border-radius':pages[0].params.guidefacestyle}" />

                    </div>

                    <div class="fe-guide-sub attention" ng-style="{'color':pages[0].params.guidenavcolor,'background-color':pages[0].params.guidenavbgcolor}">{{pages[0].params.guidesub ||'立即关注'}}</div>

                    <div class="fe-guide-text"  ng-style="{'font-size':pages[0].params.guidesize,'color':pages[0].params.guidecolor}">
                        <p <?php  if(empty($guide['title2'])) { ?> style="line-height:40px;"<?php  } ?>><?php  echo $guide['title1'];?></p>

                        <p <?php  if(empty($guide['title1'])) { ?> style="line-height:40px;"<?php  } ?>><?php  echo $guide['title2'];?></p>
                    </div>
                </div>
            <!-- </a> -->

        <?php  } ?>

        <div ng-repeat="Item in Items" class="fe-mod-repeat">

            <div ng-include="'../addons/sz_yi/plugin/designer/template/temp/show-'+Item.temp+'.html'" class="fe-mod-parent" id="{{Item.id}}" mid="{{Item.id}}" on-finish-render-filters></div>

        </div>

        <div ng-show="Items==''" style="line-height: 300px; text-align: center; font-size: 14px; color: #999;">

            <div id="core_loading" style="top:50%;left:50%;margin-left:-35px;margin-top:-50%;position:absolute;width:80px;height:60px;"><img src="../addons/sz_yi/static/images/loading.svg" width="80" /></div>

        </div>

        <div style="height: 50px;" ng-show="pages[0].params.footer==2"></div>

    </div>

 <div class="model" style="display: none;"></div>
        <div class="modelAlert" style="display: none;">
          <div class="gunscollcontent" style="position: relative;">
            <img src="../attachment/qrcode_<?php  echo $_W['uniacid'];?>.jpg" alt="" class="erweima">
            <!-- <div class="erweima"></div> -->
            <div class="close2">x</div>
          </div>
        </div>
    </div>
<script>

    window.onload = function(){

    	setTimeout(function(){

    		var search2 = document.getElementById("search2");
            var attention = document.getElementById("attention")

	        if(search2){

                if(attention){
                    $(".main-ctrl-pa").css('padding-top','110px');
                    $("#search2").css("top","50px");
                }else{

                    $(".main-ctrl-pa").css('padding-top','60px');
                    $("#search2").css("top","0px");
                }

	        }else{

	            $(".main-ctrl-pa").css('padding-top','0px');

	        }

    	},50);

        // alert(22222)
        setTimeout(function(){

	       $(".attention").on("click",function(){
		    $(".model").fadeIn();

		    $(".modelAlert").fadeIn();
		  })
		  $(".model").on("click",function(){
		    $(".model").fadeOut();
		    $(".modelAlert").fadeOut();
		  })

          $(".close2").on("click",function(){
             $(".model").fadeOut();
             $(".modelAlert").fadeOut();
           })
	},50);

    }


</script>

<script type="text/javascript" src="../addons/sz_yi/plugin/designer/template/imgsrc/angular.min.js"></script>

<?php  $_W['angular_loaded']=true?>

<script type="text/javascript" src="../addons/sz_yi/plugin/designer/template/imgsrc/hhSwipe.js"></script>

<script type="text/javascript" src="../addons/sz_yi/plugin/designer/template/imgsrc/swiper/js/swiper.jquery.min.js"></script>

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

        });

    }

    function goodsswipe(jobj){

        var mySwiper = Swiper(jobj,{

            speed: 2000,

            loop: false,

            disableScroll:false,

            slidesPerView : 3,

            resistance : false,

            freeMode: true,

            freeModeFluid: true,

            momentumRatio: 5,

            slidesPerGroup:1,

            touchRatio: .95,

        })

        // var mySwiper = new Swiper(jobj,{

        //     // effect : 'coverflow',

        //     // slidesPerView: 3,

        //     // centeredSlides: true,

        //     autoplay: 2000,

        //     // effect : 'coverflow',

        //     slidesPerView : 1.5,

        //     centeredSlides : true,

        //     autoplayDisableOnInteraction : false,

        // })

    }

    var app = angular.module('myApp', []);

    app.controller('MainCtrl', ['$scope', function($scope){

            $scope.shop = {

                uniacid:'<?php  echo $_W["uniacid"];?>'

            };

            $scope.cols = [0,1,2,3];

            $scope.size = $(document.body).width()/4;

            $scope.pages = [<?php  echo $pageinfo;?>];
            // console.log($scope.pages);

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





            //angularjs 数据渲染成功后的回调，如需对angular操作的模块进行操作，将代码写在这里是最好的

            $scope.$on('ngRepeatFinished',function(){

                //轮播， 先找到符合条件的对象，然后调用swipe函数

                $('.fe-mod-2 .swipe').each(function(){

                        initswipe($(this));

                 });



                //原理同上

                $('.fe-mod-8 .swiper-container' ).each(function(){

                    goodsswipe($(this));

                })

                $('.swiper-container .swiper-wrapper').each(function(){

                    $(this).width($(this).children().length*$(this).children('.swiper-slide').width() + 50);

                    $(this).height($(this).children().height());

                })

                 $('.fe-mod-8-main-img>img').each(function(){

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

    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('menu', TEMPLATE_INCLUDEPATH)) : (include template('menu', TEMPLATE_INCLUDEPATH));?>

<?php  } else { ?>

    <?php  $show_footer=false;?>

<?php  } ?>
<?php  if($show_footer) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>


 <script>

     require(['http://res.wx.qq.com/open/js/jweixin-1.0.0.js'],function(wx){

                 window.shareData = <?php  echo json_encode($_W['shopshare'])?>;



    jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || { jsApiList:[] };

    jssdkconfig.debug = false;

    jssdkconfig.jsApiList = ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','showOptionMenu',        ];

    wx.config(jssdkconfig);

    wx.ready(function () {

        wx.showOptionMenu();

        wx.onMenuShareAppMessage(window.shareData);

        wx.onMenuShareTimeline(window.shareData);

        wx.onMenuShareQQ(window.shareData);

        wx.onMenuShareWeibo(window.shareData);

    });

      });

</script>







