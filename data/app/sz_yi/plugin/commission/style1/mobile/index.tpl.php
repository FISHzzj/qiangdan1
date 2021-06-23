<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<title><?php  echo $this->set['texts']['center']?></title>

<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/mobile/style1/static/css/style1.css">

<style type="text/css">

    @font-face {font-family: "iconfont";

        src: url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.eot?t=1474171079');

        src: url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.eot?t=1474171079#iefix') format('embedded-opentype'),

        url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.woff?t=1474171079') format('woff'),

        url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.ttf?t=1474171079') format('truetype'),

        url('../addons/sz_yi/plugin/commission/template/mobile/style1/static/fonts/iconfont.svg?t=1474171079#iconfont') format('svg');

    }

    body{background: #f2f2f2;}

    .hs{

      font-family:"iconfont" !important;

      font-style:normal;

      -webkit-font-smoothing: antialiased;

      -webkit-text-stroke-width: 0.2px;

      -moz-osx-font-smoothing: grayscale;

    }

    .icon-zijinmingxi:before { content: "\d600"; }

    .icon-wodeyongjin:before { content: "\d601"; }

    .icon-fenxiaoshang:before { content: "\d602"; }

    .icon-mingxi:before { content: "\d604"; }

    .icon-shenqing:before { content: "\d605"; }



    .header {width: 100%;color: #fff;position: relative}

    .user-title{position: relative;z-index: 8;padding: 5% 5%;overflow: hidden;background: url(../addons/sz_yi/plugin/commission/template/mobile/default/static/images/bg.jpg) ;}

    .user-head { height: 60px; width: 60px; background: #fff; border-radius: 50%; border: 2px solid #fff;overflow: hidden;float: left;margin-top: 5px;}

    .user-head img { height: 100%; width: 100%; border-radius: 50%; }

    .user-info{float: left;margin-left: 10px;margin-top: 10px;}

    .user-other { width: auto;height: 24px;line-height: 24px;}

    .user-member { background: #fff; color: #00c1ff; border-radius: 12px; height: 20px; line-height: 20px;padding:2px 5px}



    .take { width: auto; padding: 2px 5px;border-radius: 5px; color: #fff;background: #f3691e;color: #eee}

    a.take:hover{color: #fff;text-decoration: none}

    .hs-other{margin-bottom: 20px;font-size: 16px}

    .hs-commission{background: #fff;padding:15px 0 15px 0;}

    .hs-commission li{float: left;text-align: center; width: 33.3%;padding-top: 15px;padding-bottom: 15px;position: relative;text-align: center;}

    .hs-commission li a{color: #656565 ;font-size: 16px;text-decoration: none;display: block;}

    .hs-item{height: 40px;width:40px;background: #00c1ff;color: #fff;font-size: 25px;margin: 0 auto;border-radius: 10px;line-height: 40px;margin-left:10%;display: block;}

    .hs-item-list{margin-left:10%;font-size: 14px;text-align: left;height: 50px;width: 70px;white-space: nowrap;}

    .hs-list{font-size: 14px;text-align: center;width:100%;display: block;margin:8px 0 0 0;}

    .hs-money { position: absolute; right: 5%; top: 15%; }

    .hs-commission li .hs-money a{color: #fff;font-size: 12px}

    #vector { position: absolute; top: 0; border: 0; width: 100%; height: 100%; z-index: 1;left: 0}

    .t_num i{ font-style:normal}

    .t_num { position: absolute; overflow: hidden; line-height: 28px; width: 100%; height: 28px; bottom: 0; left: 10% }

    .t_num span {font-size: 20px; position: absolute; }

    .hs-min{top: 20px;left: 100px}

    .hs-min span{font-size: 16px;height: 25px;line-height: 25px}

    .hs-user { background:#fff; position: relative; z-index: 2; border-bottom: 10px solid #f2f2f2;color:#656565;}

    .hs-user li { width: 33.3333%; text-align: center; float: left; position: relative;margin:19px 0 19px 0;border-right: 1px solid #656565; }

    .hs-user li a { color: #eee; display: block;border-right: 1px solid #eaeaea;}

    .hs-user li:last-child a {border-right:0}



     .hs-commission li a>img{width:65px;height: 65px;}

     .page_topbar a.btn{top: -7px;right: 3px;}

    .content_type {

          margin-bottom: 10px;

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

</style>

<div class="page_topbar">

   <a href=" " class="back" onclick="history.back()">

    <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>

  </a>

  <div class="title" style=" color: #282828;">分销中心</div>

  <a href="#" class="btn"><i class="iconfont  headerRightIcon" style="color: #282828;"></i></a>



</div>

<div id='container' style="overflow: hidden;"></div>

<script id='tpl_main' type='text/html'>

    <div class="header" <%if set.levelurl!=''%>onclick='location.href="<%set.levelurl%>"'<%/if%>>

        <div class="user-title">

            <div class="user-head"><img src="<%member.avatar%>"/></div>

            <div class="user-info">

                <div class="user-other"><%member.nickname%></div>
                <div class="user-other">推荐人：<%member.agentmember%></div>



                <div class="user-other">加入时间：<span class="time"><%member.agenttime%></span></div>

                <div class="user-other" style="position: absolute;right: 10px;bottom: 5px;padding: 3px 7px;

    background: rgba(0, 0, 0, 0.4);border-radius: 5px;line-height: 19px;">

                <%if level%><%level.levelname%><%else%><%if set.levelname!=''%><%set.levelname%><%else%>普通等级<%/if%><%/if%>

                </div>

            </div>



        </div>



         <ul class="content_type">

                <li>

                    <div class="content_type_title f-fsize14">

                      <?php  echo $this->set['texts']['commission_total']?>

                    </div>



                    <div class="content_type_content timer" data-to="<%member.commission_total%>" data-speed="1500"><%todayprice%>

                    </div>

                </li>

                <li style="border-right: 0px;">

                    <div class="content_type_title f-fsize14">

                      <?php  echo $this->set['texts']['commission_pay']?>

                    </div>

                    <div class="content_type_content timer" data-to="<%member.commission_pay%>" data-speed="1500"><%todayprice%>

                    </div>

                </li>

                <li style="border-left: 1px solid #282828;border-right: 0px;">

                    <div class="content_type_title f-fsize14">

                    <?php  echo $this->set['texts']['commission1']?>

                    </div>

                    <div class="content_type_content timer" data-to="<%member.commission_ok%>" data-speed="1500"><%todaycount%>

                    </div>

                </li>



        </ul>







       <!--  <iframe id="vector" src="<?php  echo $this->createMobileUrl('member/vector',array('openid'=>$openid))?>"></iframe> -->

    </div>

    <ul class="clearfloat hs-commission">

         <!--分销订单-->

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/order')?>">

                <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/oder.png">

                <span class="hs-list"><?php  echo $this->set['texts']['order']?><br><span><%member.ordercount0%></span>个</span>

            </a>

        </li>

        <!--佣金提现-->

        <li>

            <a href="<?php  echo $this->createMobileUrl('member/bonuscash')?>">

                   <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/Mmoney.png">

                <span class="hs-list">佣金提现<br><span>&nbsp;</span></span>



            </a>

        </li>



    <!--提现明细-->

        <li>

            <a href="<?php  echo $this->createMobileUrl('member/bonuslog')?>">

                   <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/detail.png">

                <span class="hs-list">提现明细<br><span>&nbsp;</span></span>



            </a>

        </li>

        <!--我的团队-->



        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/team')?>">

                  <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/mytuan.png">

                <span class="hs-list"><?php  echo $this->set['texts']['myteam']?><br>

                <span><%member.agentcount%></span>人</span>

            </a>

        </li>

        <!--我的客户-->

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/customer')?>">

                  <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/myteam.png">

                <span class="hs-list"><?php  echo $this->set['texts']['mycustomer']?><br>

        <span><%member.customercount%></span>人</span>

            </a>

        </li>

        <!--二维码-->

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/shares')?>" id='shares'>

                   <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/myer.png">

                <span class="hs-list <%if set.spread_qrcode!=1 %>disabled<%/if%>">二维码<br><span>推广二维码</span></span>

            </a>

        </li>

        <%if set.rank==1%>

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/rank')?>" id='rank'>

                   <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/myshop.png">

                <span class="hs-list <%if set.is_rank!=1 %>disabled<%/if%>"><?php  echo $this->set['texts']['rank']?><br><span>级别详细</span></span>

            </a>

        </li>

        <%/if%>

        <%if set.closemyshop!='1'%>

        <!--小店设置-->

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/myshop/set')?>">

                   <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/shopre.png">

                <span class="hs-list">小店设置<br><span>设置我的小店</span></span>

            </a>

        </li>

        <!--自选商品-->

        <%if set.openselect%>

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/myshop/select')?>">

                  <img src="../addons/sz_yi/plugin/commission/template/mobile/default/static/images/myshop.png">

                <span class="hs-list">自选商品<br><span style="white-space: nowrap;">自选小店商品</span></span>

            </a>

        </li>

        <%/if%>

        <!--订单总计-->

        <!-- <li>

            <a href="javascript:;">

                <span class="hs-item" style="background:#d37782"><i class="hs icon-shenqing"></i></span>

                <span class="hs-list">订单总计<br><span><%member.ordermoney0%></span>元</span>

            </a>

        </li> -->

    <%/if%>

    </ul>

    <div class="copyright">版权所有 © <?php  if(empty($set1['copyright'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $set1['copyright'];?><?php  } ?> </div>

</script>

<!-- js -->

<script language="javascript">











require(['tpl', 'core'], function(tpl, core) {

var w = 0;

setInterval(function(){

  if(w!=0) return ;

  $.ajax( {

     url:"<?php  echo $this->createPluginMobileUrl('commission/order')?>",// 跳转到 action

     data:{

       com:1

    },

    type:'post',

    cache:false,

    success:function(data){$(".abc").text(data);w = 1;},

    error:function(){}

  });

},300);

core.pjson('commission',{},function(json){

  var result = json.result;

  $('#container').html(  tpl('tpl_main',result) );

  $('#shares').click(function(){

    if(json.result.spread_qrcode != 1){

      console.log(json.result.spread_qrcode);

      //core.tip.show('您的等级不允许生成推广二维码!');

      return;

    }

  });

  $('#withdraw').click(function(){

    var withdraw   = "<?php  echo $this->set['texts']['withdraw']?>";

    var commission = "<?php  echo $this->set['texts']['commission']?>";

    if(json.result.extract_commission != 1){

      core.tip.show('您的等级不允许提现!');

      return;

    }

    if(!json.result.mycansettle){

       if(json.result.mysettlemoney>0){

        core.tip.show('您需要自己购买订单完成，共计'+json.result.mysettlemoney+'元才能申请'+ withdraw +'!');

        return;

       }

    }

    if(!json.result.mytotal){

      if(json.result.total_money > 0){

        core.tip.show('您需要自己购买订单完成，共计'+json.result.total_money+'元才能申请'+ withdraw +'!');

        return;

      }

    }

    if(!json.result.mymonth){

      if(json.result.month_money>0){

        core.tip.show('您本月需要自己购买订单完成，共计'+json.result.month_money+'元才能申请'+ withdraw +'!');

        return;

      }

    }

    if(!json.result.cansettle){

       if(json.result.settlemoney>0){

       core.tip.show('需到'+json.result.settlemoney+'元才能申请'+ withdraw +'!');

       }else{

        core.tip.show('无可提'+ commission +'!');

       }

    }

  });

  //new add

  $(function(){

      $.fn.countTo = function (options) {

        options = options || {};



        return $(this).each(function () {

          // set options for current element

          var settings = $.extend({}, $.fn.countTo.defaults, {

            from:            $(this).data('from'),

            to:              $(this).data('to'),

            speed:           $(this).data('speed'),

            refreshInterval: $(this).data('refresh-interval'),

            decimals:        $(this).data('decimals')

          }, options);



          // how many times to update the value, and how much to increment the value on each update

          var loops = Math.ceil(settings.speed / settings.refreshInterval),

            increment = (settings.to - settings.from) / loops;



          // references & variables that will change with each update

          var self = this,

            $self = $(this),

            loopCount = 0,

            value = settings.from,

            data = $self.data('countTo') || {};



          $self.data('countTo', data);



          // if an existing interval can be found, clear it first

          if (data.interval) {

            clearInterval(data.interval);

          }

          data.interval = setInterval(updateTimer, settings.refreshInterval);



          // initialize the element with the starting value

          render(value);



          function updateTimer() {

            value += increment;

            loopCount++;



            render(value);



            if (typeof(settings.onUpdate) == 'function') {

              settings.onUpdate.call(self, value);

            }



            if (loopCount >= loops) {

              // remove the interval

              $self.removeData('countTo');

              clearInterval(data.interval);

              value = settings.to;



              if (typeof(settings.onComplete) == 'function') {

                settings.onComplete.call(self, value);

              }

            }

          }



          function render(value) {

            // var formattedValue = settings.formatter.call(self, value, settings);

            var formattedValue = Number(value).toFixed(2);

            $self.html(formattedValue);

          }

        });

      };



      $.fn.countTo.defaults = {

        from: 0,               // the number the element should start at

        to: 0,                 // the number the element should end at

        speed: 1000,           // how long it should take to count between the target numbers

        refreshInterval: 100,  // how often the element should be updated

        decimals: 0,           // the number of decimal places to show

        formatter: formatter,  // handler for formatting the value before rendering

        onUpdate: null,        // callback method for every time the element is updated

        onComplete: null       // callback method for when the element finishes updating

      };



      function formatter(value, settings) {

        return value.toFixed(settings.decimals);

      }



      // custom formatting example

      $('.count-title').data('countToOptions', {

        formatter: function (value, options) {

          return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');

        }

      });



      // start all the timers

      $('.timer').each(count);

      function count(options) {

        var $this = $(this);

        options = $.extend({}, options || {}, $this.data('countToOptions') || {});

        $this.countTo(options);

      }

  });

},true);



/*

core.pjson('commission',{},function(json){



  console.log(json);return;

    var result = json.result;

    // alert(  JSON.stringify(result));



    $('#container').html(  tpl('tpl_main',result) );

    $('#withdraw').click(function(){

        if(!json.result.mycansettle){

             if(json.result.mysettlemoney>0){

                core.tip.show('您需要自己购买订单完成，共计'+json.result.mysettlemoney+'元才能申请<?php  echo $this->set['texts']['withdraw']?>!');

                return;

             }

        }

        if(!json.result.cansettle){

             if(json.result.settlemoney>0){

             core.tip.show('需到'+json.result.settlemoney+'元才能申请<?php  echo $this->set['texts']['withdraw']?>!');

             }else{

                core.tip.show('无可提<?php  echo $this->set['texts']['commission']?>!');

             }

        }

    });

},true);



$.ajax( {

   url:"<?php  echo $this->createPluginMobileUrl('commission/order')?>",// 跳转到 action

   data:{

       com:1

  },

  type:'post',

  cache:false,

  dataType:'json',

  success:function(data) {

     // $("#abc").text(data);

  },

  error : function() {

  }

});

*/

})

</script>

<!-- footer -->

<?php  $show_footer=true;$footer_current ='commission'?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>