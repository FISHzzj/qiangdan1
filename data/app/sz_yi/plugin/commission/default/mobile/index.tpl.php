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



    .header {width: 100%;background: #00c1ff;color: #fff;position: relative;}

    .user-title{position: relative;z-index: 8;padding: 5% 5%;overflow: hidden;}

    .user-head { height: 60px; width: 60px; background: #fff; border-radius: 50%; border: 2px solid #fff;overflow: hidden;float: left;margin-top: 5px;}

    .user-head img { height: 100%; width: 100%; border-radius: 50%; }

    .user-info{float: left;margin-left: 10px}

    .user-other { width: auto;height: 24px;line-height: 24px;}

    .user-member { background: #fff; color: #00c1ff; border-radius: 12px; height: 20px; line-height: 20px;padding:2px 5px}



    .take { width: auto; padding: 2px 5px;border-radius: 5px; color: #fff;background: #f3691e;color: #eee}

    a.take:hover{color: #fff;text-decoration: none}

    .hs-other{margin-bottom: 20px;font-size: 16px}

    .hs-commission{background: #fff}

    .hs-commission li{float: left;text-align: center; width: 50%;padding-top: 15px;padding-bottom: 15px;border-bottom: 1px solid #f1f1f1; border-right: 1px solid #f1f1f1;max-height: 71px;position: relative;}

    .hs-commission li a{color: #666;font-size: 16px;text-decoration: none;display: block;}

    .hs-item{height: 40px;width:40px;background: #00c1ff;color: #fff;font-size: 25px;margin: 0 auto;border-radius: 10px;line-height: 40px;float: left;margin-left:10%;}

    .hs-item-list{float: left;margin-left:10%;font-size: 14px;text-align: left;height: 50px;width: 70px;white-space: nowrap;}

    .hs-list{float: left;margin-left: 5%;font-size: 14px;text-align: left;width: 90px}

    .hs-money { position: absolute; right: 5%; top: 15%; }

    .hs-commission li .hs-money a{color: #fff;font-size: 12px}

    #vector { position: absolute; top: 0; border: 0; width: 100%; height: 100%; z-index: 1;left: 0}

    .t_num i{ font-style:normal}

    .t_num { position: absolute; overflow: hidden; line-height: 28px; width: 100%; height: 28px; bottom: 0; left: 10% }

    .t_num span {font-size: 20px; position: absolute; }

    .hs-min{top: 20px;left: 100px}

    .hs-min span{font-size: 16px;height: 25px;line-height: 25px}

    .hs-user { background: rgba(0, 0, 0, .1); margin-top: 5px; position: relative; z-index: 2; }

    .hs-user li { width: 33.3333%; text-align: center; float: left; position: relative; padding-bottom: 10px; padding-top: 10px; }

    .hs-user li a { color: #eee; display: block;border-right: 1px solid #eee;}

    .hs-user li:last-child a {border-right:0}

    .content_type_content{color: #e45050;}

</style>

<div id='container' style="overflow: hidden;"></div>

<script id='tpl_main' type='text/html'>

    <div class="header clearfloat" <%if set.levelurl!=''%>onclick='location.href="<%set.levelurl%>"'<%/if%>>

        <div class="user-title">

            <div class="user-head"><img src="<%member.avatar%>"/></div>

            <div class="user-info">

                <div class="user-other"><%member.nickname%></div>

                <div class="user-other"><span class="user-member">

                <%if level%><%level.levelname%><%else%><%if set.levelname!=''%><%set.levelname%><%else%>????????????<%/if%><%/if%>

                </span></div>

                <div class="user-other">???????????????<%member.agenttime%></div>

            </div>

            <!--  <div class="hs-money">

                <a <%if commission_ok<=0 || commission_ok< set.withdraw || commission_ok< set.consume_withdraw || set.extract_commission!=1 %>href="javascript:;"<%else%>href="<?php  echo $this->createPluginMobileUrl('commission/apply')?>"<%/if%> id='withdraw' class="take"><span <%if commission_ok<=0 || commission_ok< set.withdraw || set.extract_commission!=1 %>class='disabled'<%/if%> ><?php  echo $this->set['texts']['withdraw']?></span></a>

            </div> -->

        </div>

        <ul class="hs-user clearfloat">

            <li>



                    <?php  echo $this->set['texts']['commission_total']?>

                    <div style="font-size:20px" ><%member.commission_total%></div>



            </li>

            <li>





                    <?php  echo $this->set['texts']['commission_pay']?>

                    <div class="timer" style="font-size:20px" data-to="<%member.commission_pay%>" data-speed="1500"><%member.commission_pay%></div>



            </li>

            <li>





                    <?php  echo $this->set['texts']['commission1']?>



                    <div class="timer" style="font-size:20px" data-to="<%member.commission_ok%>" data-speed="1500"></div>



            </li>

        </ul>

        <iframe id="vector" src="<?php  echo $this->createMobileUrl('member/vector',array('openid'=>$openid))?>"></iframe>

    </div>

    <ul class="clearfloat hs-commission">

        <!-- <li>

            <div class="hs-item-list">

                <?php  echo $this->set['texts']['commission_total']?>

                <div class="timer" style="font-size:20px" data-to="<%member.commission_total%>" data-speed="1500"></div>

            </div>

            <span class="hs-money"><a href="<?php  echo $this->createPluginMobileUrl('commission/withdraw')?>" class="take">????????????</a></span>

        </li>

        <li>

            <div class="hs-item-list">

                <?php  echo $this->set['texts']['commission_ok']?>

                <div class="timer" style="font-size:20px" data-to="<%member.commission_ok%>" data-speed="1500"></div>

            </div>

            <span class="hs-money"><a <%if commission_ok<=0 || commission_ok< set.withdraw || commission_ok< set.consume_withdraw || set.extract_commission!=1 %>href="javascript:;"<%else%>href="<?php  echo $this->createPluginMobileUrl('commission/apply')?>"<%/if%> id='withdraw' class="take"><span <%if commission_ok<=0 || commission_ok< set.withdraw || set.extract_commission!=1 %>class='disabled'<%/if%> ><?php  echo $this->set['texts']['withdraw']?></span></a></span>

        </li> -->

        <!--????????????-->

        <!-- <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/withdraw')?>">

                <span class="hs-item" style="background:#e84675"><i class="hs icon-wodeyongjin"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['commission1']?><br><span><%member.commission_ok%></span>???</span>

            </a>

        </li> -->

        <!--????????????-->

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/order')?>">

                <span class="hs-item" style="background:#ff7000"><i class="hs icon-mingxi"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['order']?><br><span><%member.ordercount0%></span>???</span>

            </a>

        </li>

        <!--????????????-->

        <li>

            <a href="<?php  echo $this->createMobileUrl('member/bonuscash')?>">

                <span class="hs-item" style="background:#17ba94"><i class="hs icon-zijinmingxi"></i></span>

                <span class="hs-list">????????????</span>



            </a>

        </li>



    <!--????????????-->

    <li>

            <a href="<?php  echo $this->createMobileUrl('member/bonuslog')?>">

                <span class="hs-item" style="background:#17ba94"><i class="hs icon-zijinmingxi"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['commission_detail']?><br><span>????????????</span></span>



            </a>

        </li>

        <!--????????????-->





        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/team')?>">

                <span class="hs-item" style="background:#f3bfc3"><i class="hs hs-fenxiao"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['myteam']?><br>

        <span><%member.agentcount%></span>???</span>

            </a>

        </li>

        <!--????????????-->

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/customer')?>">

                <span class="hs-item" style="background:#dd7188"><i class="hs icon-fenxiaoshang"></i></span>

                <span class="hs-list"><?php  echo $this->set['texts']['mycustomer']?><br>

        <span><%member.customercount%></span>???</span>

            </a>

        </li>

        <!--?????????-->

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/shares')?>" id='shares'>

                <span class="hs-item" style="background:#a171a3"><i class="fa fa-qrcode"></i></span>

                <span class="hs-list <%if set.spread_qrcode!=1 %>disabled<%/if%>">?????????<br><span>???????????????</span></span>

            </a>

        </li>

        <%if set.rank==1%>

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/rank')?>" id='rank'>

                <span class="hs-item" style="background:#a171a3"><i class="hs hs-fenxiao"></i></span>

                <span class="hs-list <%if set.is_rank!=1 %>disabled<%/if%>"><?php  echo $this->set['texts']['rank']?><br><span>????????????</span></span>

            </a>

        </li>

        <%/if%>

        <%if set.closemyshop!='1'%>

        <!--????????????-->

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/myshop/set')?>">

                <span class="hs-item" style="background:#d37782"><i class="fa fa-cog"></i></span>

                <span class="hs-list">????????????<br><span>??????????????????</span></span>

            </a>

        </li>

        <!--????????????-->

        <%if set.openselect%>

        <li>

            <a href="<?php  echo $this->createPluginMobileUrl('commission/myshop/select')?>">

                <span class="hs-item" style="background:#d37782"><i class="fa fa-star"></i></span>

                <span class="hs-list">????????????<br><span style="white-space: nowrap;">??????????????????</span></span>

            </a>

        </li>

        <%/if%>

        <!--????????????-->

        <!-- <li>

            <a href="javascript:;">

                <span class="hs-item" style="background:#d37782"><i class="hs icon-shenqing"></i></span>

                <span class="hs-list">????????????<br><span><%member.ordermoney0%></span>???</span>

            </a>

        </li> -->

    <%/if%>

    </ul>

    <div class="copyright">???????????? ?? <?php  if(empty($set1['copyright'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $set1['copyright'];?><?php  } ?> </div>

</script>

<!-- js -->

<script language="javascript">

require(['tpl', 'core'], function(tpl, core) {

var w = 0;

setInterval(function(){

  if(w!=0) return ;

  $.ajax( {

     url:"<?php  echo $this->createPluginMobileUrl('commission/order')?>",// ????????? action

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

      //core.tip.show('??????????????????????????????????????????!');

      return;

    }

  });

  $('#withdraw').click(function(){

    var withdraw   = "<?php  echo $this->set['texts']['withdraw']?>";

    var commission = "<?php  echo $this->set['texts']['commission']?>";

    if(json.result.extract_commission != 1){

      core.tip.show('???????????????????????????!');

      return;

    }

    if(!json.result.mycansettle){

       if(json.result.mysettlemoney>0){

        core.tip.show('??????????????????????????????????????????'+json.result.mysettlemoney+'???????????????'+ withdraw +'!');

        return;

       }

    }

    if(!json.result.mytotal){

      if(json.result.total_money > 0){

        core.tip.show('??????????????????????????????????????????'+json.result.total_money+'???????????????'+ withdraw +'!');

        return;

      }

    }

    if(!json.result.mymonth){

      if(json.result.month_money>0){

        core.tip.show('????????????????????????????????????????????????'+json.result.month_money+'???????????????'+ withdraw +'!');

        return;

      }

    }

    if(!json.result.cansettle){

       if(json.result.settlemoney>0){

       core.tip.show('??????'+json.result.settlemoney+'???????????????'+ withdraw +'!');

       }else{

        core.tip.show('?????????'+ commission +'!');

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

                core.tip.show('??????????????????????????????????????????'+json.result.mysettlemoney+'???????????????<?php  echo $this->set['texts']['withdraw']?>!');

                return;

             }

        }

        if(!json.result.cansettle){

             if(json.result.settlemoney>0){

             core.tip.show('??????'+json.result.settlemoney+'???????????????<?php  echo $this->set['texts']['withdraw']?>!');

             }else{

                core.tip.show('?????????<?php  echo $this->set['texts']['commission']?>!');

             }

        }

    });

},true);



$.ajax( {

   url:"<?php  echo $this->createPluginMobileUrl('commission/order')?>",// ????????? action

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