<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>支付界面</title>
<style type="text/css">
   .customer_top {
        height: 44px;
        width: 100%;
        background: #009BF8;
        border-bottom: 1px solid #ccc;
   }
   .customer_top .title {
        height: 44px;
        width: auto;
        margin-left: 10px;
        float: left;
        font-size: 16px;
        line-height: 44px;
        color: #fff;
    }
   .title1{    
        height: 44px;
        line-height: 44px;
        display: inline-block;
        width: 70%;
        text-align: center;
        color: #fff;
        font-size: 16px;
  }

</style>

<body>
<script language="javascript">
    require(['core','tpl'],function(core,tpl){
        core.init({
            siteUrl: "http://zs1.aada.top/",
            baseUrl: "http://zs1.aada.top/app/index.php?i=6&c=entry&do=ROUTES&m=sz_yi"
        });
    })
</script>
    <title>支付界面</title>
    <style type="text/css">
        body{background:#fff;}
        .customer_top {height:44px; width:100%;  background:#009BF8;  border-bottom:1px solid #ccc;}
        .customer_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#fff;}
        .customer_top .title1{height: 44px;line-height: 44px;display: inline-block;width: 70%;text-align: center;color:#fff;font-size:16px;}
        .back{width: 18px;height: 20px;font-size: 22px;border-radius: 50%;float: left;line-height: 44px; font-family: serif,"PingFang SC", Helvetica, "Helvetica Neue", "微软雅黑", Tahoma, Arial, sans-serif;font-weight: bold;}
        .content{width: 100%;height: auto;padding-bottom: 10px;}
        .content .img{width: 120px;height: 140px;background: #fff;margin: 0 auto;padding-top:15px;} 
        .content .img>img{width:120px;}
        .inputLi{width: 98%;height: auto;background: #fff;margin: 0 auto;border-radius: 8px;padding: 13px;}
        .inputLi>span{display: block;height: 52px;font-size: 1.6em;;line-height:40px;text-align:center;}
        .inputLi>p{border: 1px solid #3A3A3A;border-radius: 20px;height: 35px;line-height: 30px;text-indent: 12px;width: 100%;}
        .inputLi>p:nth-child(2)>span,.inputLi>p:nth-child(3)>span{letter-spacing: 0.37em;}
        .inputLi p input{border: 0;color: #ccc;margin-left: 6px;width: auto;height:33px;}
        input:focus{outline:none;}
        .submit{width: 50%;background:#009BF8 ;border-radius: 24px;margin: 0 auto;text-align: center;padding: 7px;font-size: 1.3em;margin-top: 30px;}
        .submit input{border: 0;background: none;color: #fff;}
        
    </style>
    <div class="customer_top">
        <div class="title" onclick=""><span class="back">&lt;</span>返回</div>
        <div class="title1">
            支付界面
        </div>
    </div>
    <div class="content">
       <!--  <div class="img">
            <img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/edpsw.png">
        </div> -->
        <div class="inputLi">
            <span></span>
            <p><span>金额:</span><input type="text" id="money"> </p>
            <input type="hidden" name="shopopenid" id="shopopenid" value="<?php  echo $uid;?>">
            <input type="hidden" name="type" id="type" value="<?php  echo $type;?>">
            <div class="submit">
                 <input type="submit" name="确认支付" value="确认支付">
            </div>   
        </div>   
    </div>

    
    
    <script>
         //判断是不是微信登录的    
         function isWeiXin() {
            var ua = window.navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == 'micromessenger') {
                return true;
            } else {
                return false;
            }
        }

        require(['core'], function( core) {
            //用户扫码支付成功后的返回操作
            function rechargeok() {
                 var money = $('#money').val();  //获取输入金额
                 var uid = $('#shopopenid').val();  //获取店铺openid]
                 var openid ='<?php  echo $openid;?>';
                 // alert(money);
                 core.pjson('suppliermenu/pay', {
                    op: 'pay_success',
                    money: money,
                    uid: uid,
                    type:1,
                    openid:openid
                 }, function (json) {
                    if (json.status == 1) {
                        var url = "<?php  echo $this->createMobileUrl('shop')?>";
                        window.location.href = url;
                        return;
                    }
                 }, true, true);

             }    

            //用户点击确认支付的操作
            $('input[type="submit"]').click(function(){

                    var money = $('#money').val();  //获取输入金额
                    var shopopenid = $('#shopopenid').val();  //获取店铺openid
                    var type = $('#type').val();
                    if (!$('#money').isNumber()) {
                   		console.log(shopopenid);
                        core.tip.show('请输入数字金额!');
                        return;
                    }

                    $('.button').attr('submitting', 1);

                    //对微信支付进行操作处理
                    core.pjson('suppliermenu/pay', {op: 'recharge', openid:"<?php  echo $openid;?>",type: type, money: money, uid:"<?php  echo $uid;?>"}, function (rjson) {
                         // core.tip.show(rjson.result);
                        if(rjson.status!=1){
                            $('.button').removeAttr('submitting');
                            core.tip.show(rjson.result);
                            return;
                        }
                        // var url = "<?php  echo $this->createPluginMobileUrl('suppliermenu/pay',array('op'=>'pay_success','type'=>1,'uid'=>$uid))?>";
                        //  url  = url+'&price='+money+'&openid='+'<?php  echo $openid;?>';
                        //调用支付接口
                        if(rjson.result.type == 1){
                            var wechat = rjson.result.wechat;
                            WeixinJSBridge.invoke('getBrandWCPayRequest', {
                                        'appId': wechat.appid ? wechat.appid : wechat.appId,
                                        'timeStamp': wechat.timeStamp,
                                        'nonceStr': wechat.nonceStr,
                                        'package': wechat.package,
                                        'signType': wechat.signType,
                                        'paySign': wechat.paySign,
                                    }, function (res) {
                                        if (res.err_msg == 'get_brand_wcpay_request:ok') {
                                            rechargeok();
                                            // alert(1);
                                            // window.location.href = url;
                                        } else if(res.err_msg=='get_brand_wcpay_request:cancel') {
                                            $('.button').removeAttr('submitting');
                                            core.tip.show('取消支付');
                                        } else {
                                            $('.button').removeAttr('submitting');
                                            alert(res.err_msg);
                                        }
                            });
                        }else if(rjson.result.type == 2){
                            var result = rjson.result.alipay;
                            if(result.success){
                               window.location.href = result.url;
                            }
                            
                            
                        }
                    }, true, true);

                
            });
        });
    </script>

 



   
</body>

