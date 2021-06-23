<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>供应商提现</title>
<style type="text/css">
	body {margin:0px; background:#f2f2f2; padding:0px; -moz-appearance:none; font-family:"苹方";overflow-x: hidden;}
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
    }
    .hs-xuanzhong:before { content: "\d622";color:#e45050!important}
    .hs-xuan:before { content: "\e739"; }
    .hs-wei:before { content: "\e651"; }

	#header{ width:100%; }

    #user-info:after{content: "";display: block;clear: both;}
    #user-info{width: 100%; height: auto;background: #10BDFF;color: #fff;padding: 30px 0 10px 0;}
    #user-info .left{width:35%;float:left;min-width: 90px; height:80px; border-radius:50%;padding-left: 10%;overflow:hidden;padding-right:10px;}
	#user-info .left .img{float:right;margin-right:15px;}
	#user-info .left img{ border: 2px #fff solid; display: block;width:70px; height:70px; border-radius:50%;  }
    #user-info .title{width:60%;font-size:18px; padding-top: 3%;padding-bottom: 5%;float: left;}
    
    .mode{width: 100%;height: auto;font-family: "苹方";}
    text{font-size: 18px;color: #000;margin-left: 20px;font-weight: 500;}
    .submint{width: 50%;height: 40px;background: #FF3C3C;color: #fff;font-size:24px ;text-align: center;line-height:40px;margin: 10px auto;border-radius: 20px;}
    a:hover{text-decoration: none;}
    .confirm{width: 100%;height: 40px;background: #e45050;color:#fff;text-align: center;line-height: 40px;font-size: 16px;margin-top: 10px;}
</style>
<body>
    <div class="page_topbar" style="background: #fff;">
        <a href="#" class="back" onclick="history.back()">
          <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
        </a>
        <div class="title" style=" color: #282828;">供应商提现</div>
        <a href="#">
            <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
        </a>
      </div>

	<!-- <div id="header">
		<div id="user-info">
	    	<div class="left">
	           
                <div class="img">
                    <img src="<?php  echo $member['avatar'];?>" />
                </div>
	     	</div>
	     	<div class="title">
	     	 	<div ><?php  echo $member['nickname'];?></div>
	     	 	<div style="line-height:150%; color: #fff; font-size: 14px;">供应商奖金:<?php  echo $costmoney;?></div>
	     	</div>
	    </div> -->
	<!-- </div> -->
	<!--<p>可提现金额 <?php  echo $costmoney;?></p>-->
	<p style="width: 100%;height: 30px;color: #656565;font-size: 16px;display: inline-block;line-height:36px ;text-indent: 12px;">提现方式</p>
	<div class="mode">
		<div style="display: inline-block;width: 100%;">
            <?php  if(in_array('suppliermenu.wechat', $authority)) { ?>
            <div style="width: 100%;height: 60px;line-height: 60px;padding:0 10px 0 10px;box-sizing: border-box;background: #fff;margin-bottom: 10px;position: relative;">
              <!--   <a style="display: block;" onclick="return confirm('您确定要提现到微信吗？');" href="<?php  echo $this->createPluginMobileUrl('suppliermenu/order', array('applytype'=>2, 'op' => 'withdraw'));?>"> -->
                    <p style="width: 40px;height: 40px;margin-left: 10px;background: #08D618;border-radius: 6px;color: #fff;display: inline-block;line-height: 40px;">
                        <img src="/addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/9.png" style="width: 100%;height: 100%;" />
                    </p>
                    <text>微信</text>
                   <i class="hs hs-xuanzhong my_rightBtn" style="color: #e45050;position: absolute;right: 10px;font-size: 20px;"></i>
                <!-- </a> -->
            </div>
            <?php  } ?> <?php  if(in_array('suppliermenu.balance', $authority)) { ?>
            <div style="width: 100%;height: 60px;line-height: 60px;padding:0 10px 0 10px;box-sizing: border-box;background: #fff;margin-bottom: 10px;position: relative;">
                <!-- <a style="display: block;" onclick="return confirm('您确定要提现到余额吗？');" href="<?php  echo $this->createPluginMobileUrl('suppliermenu/order', array('applytype'=>3, 'op' => 'withdraw'))?>"> -->
                    <p style="width: 40px;height: 40px;margin-left: 10px;background:#ff3c3c;border-radius: 6px;color: #fff;display: inline-block;line-height: 40px;">
                        <img src="/addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/8.png" style="width: 100%;height: 100%;" />
                    </p>
                    <text>余额</text>
                   <i class="hs hs-wei my_rightBtn" style="color: #656565;position: absolute;right: 10px;font-size: 20px;"></i>
                <!-- </a> -->
            </div>
            <?php  } ?>
            <div style="width: 100%;height: 60px;line-height: 60px;padding:0 10px 0 10px;box-sizing: border-box;background: #fff;margin-bottom: 10px;position: relative;">
               <!--  <a style="display: block;" onclick="return confirm('您确定要提现到银行卡吗？');" href="<?php  echo $this->createPluginMobileUrl('suppliermenu/order', array('applytype'=>1, 'op' => 'withdraw'))?>"> -->
                    <p style="width: 40px;height: 40px;margin-left: 10px;background: #FF8C08;border-radius: 6px;color: #fff;display: inline-block;line-height: 40px;">
                        <img src="/addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/10.png" style="width: 100%;height: 100%;" />
                    </p>
                    <text>银行卡</text>
                    <i class="hs hs-wei my_rightBtn" style="color: #656565;position: absolute;right: 10px;font-size: 20px;"></i>
                <!-- </a> -->
            </div>

            <div class="confirm">确定</div>
        </div>

		
	</div>
	<!-- <div class="submint">
		确认提现 
	</div> -->
	
</body>
<script type="text/javascript">
    $('.my_rightBtn').click(function(){
       for(var i=0;i<$('.my_rightBtn').length;i++){
            $('.hs').eq(i).removeClass('hs-xuanzhong').addClass('hs-wei').css('color','#656565')
       }
       $(this).removeClass('hs-wei').addClass('hs-xuanzhong');
    });

    $('.confirm').click(function(){
         for(var i=0;i<$('.my_rightBtn').length;i++){
            if($('.my_rightBtn').eq(i).hasClass('hs-xuanzhong')){
                switch (i){
                    case 0:
                        confirm('您确定要提现到微信吗？');
                        window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/order', array('applytype'=>2, 'op' => 'withdraw'));?>'    
                        break;
                    case 1:
                        confirm('您确定要提现到余额吗？');
                         window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/order', array('applytype'=>3, 'op' => 'withdraw'))?>' 
                        break;
                     case 2:
                        confirm('您确定要提现到银行卡吗');
                         window.location.href = '<?php  echo $this->createPluginMobileUrl('suppliermenu/order', array('applytype'=>1, 'op' => 'withdraw'))?>' 
                        break;

                }
            };
       }
        
    });
</script>

<?php  $show_footer=true?>
<?php  $footer_current='member'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>