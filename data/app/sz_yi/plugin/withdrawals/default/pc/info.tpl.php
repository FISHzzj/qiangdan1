<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?> 
    <title>修改资料</title>
    <style type="text/css">
        body{background:#fff;}
        .customer_top {height:44px; width:100%;  background:#009BF8;  border-bottom:1px solid #ccc;}
        .customer_top .title {height:44px; width:auto;margin-left:10px; float:left; font-size:16px; line-height:44px; color:#fff;}
        .customer_top .title1{height: 44px;line-height: 44px;display: inline-block;width: 70%;text-align: center;color:#fff;font-size:16px;}
        .back{width: 18px;height: 19px;font-size: 22px;border-radius: 50%;float: left;line-height: 44px; font-family:serif,"PingFang SC", Helvetica, "Helvetica Neue", "微软雅黑", Tahoma, Arial, sans-serif;font-weight: bold;}
        .content{height: auto;padding-bottom: 10px;}
        .content .img{width: 120px;height: 140px;background: #fff;margin: 0 auto;padding-top:15px;} 
        .content .img>img{width:120px;}
        .inputLi{width: 98%;height: auto;background: #fff;margin: 0 auto;border-radius: 8px;padding: 13px;}
        .inputLi>span{display: block;height: 52px;font-size: 1.5em;line-height:40px;text-align:center;width:100%;padding:0;}
        .inputLi>p{border: 1px solid #3A3A3A;border-radius: 20px;height: 35px;line-height: 30px;text-indent: 12px;width: 100%;}
        .inputLi>p:nth-child(3)>span,.inputLi>p:nth-child(5)>span,.inputLi>p:nth-child(6)>span{letter-spacing: 0.37em;}
        .inputLi p input{border: 0;color: #ccc;margin-left: 6px;width: auto;height:33px;}
        input:focus{outline:none;}
        .submit{width: 50%;background:#009BF8 ;border-radius: 24px;margin: 0 auto;text-align: center;padding: 7px;font-size: 1.3em;margin-top: 30px;}
        .submit input{border: 0;background: none;color: #fff;}
    </style>
    <div class="content rightlist">
        <div class="page_topbar">
                <div class="title">完善资料</div>
        </div>
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
        
           
    </div>
   
    <script>
        require(['core'], function( core) {
            $('input[type="submit"]').click(function(){
                var data = {
                    op:'edit',
                    'realname'    : $('input[name="realname"]').val(),
                    'mobile'      : $('input[name="mobile"]').val(),
                    'banknumber'  : $('input[name="banknumber"]').val(),
                    'accountbank' : $('input[name="accountbank"]').val(),
                    'accountname' : $('input[name="accountname"]').val()
                };
                core.pjson('withdrawals/info', data, function(json) {
                    if (json.status == 1) {
                        alert('修改成功！');
                        window.location.href="<?php  echo $this->createPluginMobileUrl('withdrawals/cash_withdrawal')?>";
                    } else if (json.status == 0) {
                        core.tip.show(json.result);
                    }
                }, true);
            });
        });
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/bottom', TEMPLATE_INCLUDEPATH)) : (include template('common/bottom', TEMPLATE_INCLUDEPATH));?>