<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Cache" content="no-cache">
<link rel="stylesheet" type="text/css" href="../addons/wx_shop/template/account/default3/style.css?v=2.0.0">
<link rel="stylesheet" href="../addons/wx_shop/template/account/default3/css/flex_style.css">
	<script type="text/javascript" src="../addons/wx_shop/template/account/default3/js/jquery-1.10.2.js"></script>

<style type="text/css">
    body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, button, textarea, p, blockquote, th, td {
        margin: 0;
        padding: 0;
    }
    html,body{
        width: 100%;
        height: 100%;
    }
    input::-webkit-input-placeholder {
        /* color: #fff;  */
    } 
    input:-moz-placeholder {
        /* color: #fff;  */
    } 
    input::-moz-placeholder {
        /* color: #fff;  */
    } 
    input:-ms-input-placeholder {
        /* color: #fff;  */
    } 
    .fui-page, .fui-page-group{
        position: fixed;
    }
   
    .li_box{
        /* width: 100%; */
        /* height: 100%; */
        /* background-color: #7f6afd; */
        
    }
    .ls_head{
        width: 100%;
        height: 45px;
        /* color: #fff; */
        font-size: 13px;
        padding: 0 10px;
        box-sizing: border-box;
        position: absolute;
        top: 0;
        left: 0;
    }
    .le_head{
        width: auto;
        height: 100%;
    }
    .le_head img{
        width: 25px;
        height: 25px;
    }
    .back_btn{
        height: 45px;
        padding: 0 15px;
    }
    .back_btn::before{
        content: " ";
        display: inline-block;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        height: 10px;
        width: 10px;
        border-width: 0 0 2px 2px;
        border-color: #666;
        border-style: solid;
        position: relative;
        top:13px;
        /* left: 10px; */
    }
    .ls_conte{
        width: 100%;
        height: auto;
    }
    .mobile_cont{
        width: 90%;
        border-bottom: 1px solid #bddaf8;
        box-sizing: border-box;
        margin-bottom: 5px;
        /* padding: 15px 0; */
    }
    .input_inp{
        /* width: 60%; */
        height: 100%;
        /* color: #fff; */
        font-size: 16px;
    }
    .input_inp input{
        width: 100%;
        height: 90%;
        /* color: #fff; */
        background-color: rgba(0, 0, 0, 0);
        font-size: 14px;
        border: 0;
        outline: none;
        padding: 15px 0;
    }
    .mobile_codet{
        width: 90%;
        height: 40px;
        margin-bottom: 5px;
        border-bottom: 1px solid #bddaf8;
        box-sizing: border-box;
    }
    .mobile_codes{
        width: 70%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0);
        border-radius: 10px;
        box-sizing: border-box;
    }
    .Code_btn{
        width: 30%;
        height: 100%;
    }
    .Code_btn input{
        width: 85%;
        height: 80%;
        background-color: rgba(0, 0, 0, 0);
        /* color: #fff; */
        font-size: 12px;
        border: 0;
        border-radius: 8px;
        box-sizing: border-box;
        outline: none;
    }
    .tijiao_box{
        width: 100%;
        height: 60px;
        margin-top: 15px;
    }
    .jonh-btn{
        width: 100%;
        height: 30px;
        /* color: #fff; */
    }
    .jonh-btn a{
        /* color: #fff; */
        outline: none;
        text-decoration:none;
    }
    .tj_btn{
        width: 80%;
        height: 45px;
        color: #fff;
        background-color: #3a9bff;
        border-radius: 25px;
        border: 0;
        box-sizing: border-box;
        outline: none;
    }
    .code_num{
        width: 50% !important;
    }
    .copy_pop{
        width: 100%;
        height: auto;
        position: fixed;
        bottom: 5%;
        left: 0;
        display: none;
    }
    .copy_prop{
        border-radius: 5px;
        /* color: #fff; */
        background-color: rgba(94, 94, 94, 0.8);
        font-size: 16px;
        padding: 5px 20px;
    }
    .register_title{
        font-size: 23px;
        color: black;
        font-weight: bolder;
        margin: 50px 0px 30px;
        padding: 0 20px;
    }
</style>

<div class="fui-page">
    <div class="fui-content" >
        <div class="li_box ">
            <div class="ls_head flex flex-ver ">
                <div class="le_head back_btn">
                    <!-- <img src="../addons/wx_shop/template/account/default3/images/lastgo.png" alt=""> -->
                </div>
                <!-- <p>??????</p> -->
            </div>
            <div class="register_title">????????????</div>
            <div class="ls_conte flex flex-center">
                <div class="mobile_cont">
                    <div class="input_inp flex flex-ver">
                        <input class="name_input" type="text" placeholder="??????????????????4~12???????????????" onKeyUp="value=value.replace(/[\W]/g,'')" maxlength="11">
                    </div>
                </div>
                
                <div class="mobile_codet flex">
                    <div class="mobile_codes flex">
                        <div class="input_inp flex flex-ver">
                            <input class="mobile_input" type="tel" placeholder="??????????????????">
                        </div>
                    </div>
                    <div class="Code_btn flex flex-justify">
                        <input type="button" class="btnSendCode" id="btnSendCode" value="???????????????">
                    </div>
                </div>
                <div class="mobile_cont">
                    <div class="input_inp flex flex-ver">
                        <input class="code_input" type="tel" placeholder="??????????????????">
                    </div>
                </div>
                <div class="mobile_cont">
                    <div class="input_inp flex flex-ver">
                        <input class="passwd_new" type="password" placeholder="???????????????">
                    </div>
                </div>
                <div class="mobile_cont">
                    <div class="input_inp flex flex-ver">
                        <input class="passwd_ok" type="password" placeholder="?????????????????????">
                    </div>
                </div>
                <div class="mobile_cont">
                    <div class="input_inp flex flex-ver">
                        <input class="passwd_zf" type="password" placeholder="?????????????????????">
                    </div>
                </div>
                <div class="mobile_cont">
                    <div class="input_inp flex flex-ver">
                        <input class="passwd_zfok" type="password" placeholder="?????????????????????">
                    </div>
                </div>
                <div class="mobile_cont">
                    <div class="input_inp flex flex-ver">
                        <p>????????????</p>
                        <input class="code_num" type="text" placeholder="??????????????????" value="<?php  echo $sjyqm['rcode'];?>">
                    </div>
                </div>
    
                <!-- ?????? -->
                <div class="tijiao_box flex flex-justify">
                    <button class="tj_btn">????????????</button>
                </div>
                <!-- <div class="jonh-btn flex flex-justify">
                    <p>???????????? </p>
                </div> -->
                <div class="jonh-btn flex flex-justify">
                    <!-- <a href="https://www.03675.com/app.php/19"> -->
                    <a href="https://www.guanzhu.mobi/p/8bDxv">
                        <p>??????APP </p>
                    </a>
                </div>
                <!-- ????????????????????? -->
                <div class="copy_pop flex flex-center">
                    <div class="copy_prop flex flex-center">
                        <p class="copy_text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // ??????????????????
    var localstroage = window.localStorage;
    var InterValObj; //timer?????????????????????
    var count = 60; //???????????????1?????????
    var curCount;//??????????????????
    var tokenurl = "";
    var hosturl = window.location.protocol+"//"+window.location.host;
    // console.log(hosturl)
  
    window.onload=function (){
        // var tourl = window.location.href;	//???????????????cookie
        // var tokenurl = tourl.lastIndexOf("rcode");
        // if(tokenurl){
        //     var incode = ("incode".length)+1;
        //     var yaoqm = incode+tokenurl;
        //     var str=tourl.substring(yaoqm,tourl.length);
        //     console.log(str)
        //     $(".code_num").val(str);
        // }else{
        //     $(".code_num").val("");
        // }
        var viewHeight = window.innerHeight; //????????????????????????
        $("input").focus(function()
        {
            $(".li_box").css("height",viewHeight);
        }).blur(function()
        {
            $(".li_box").css("height","100%");
        });
        function isMobile(str) {
            return $.trim(str) !== '' && /^1[3|4|5|6|7|8|9][0-9]\d{8}$/.test($.trim(str));
        }
        apiready = function(){
            $(".jonh-btn").hide();
        };
        $(".le_head").click(function(){
            document.referrer === '' ?
            window.location.href = '#' :
            window.history.go(-1);
        })
        $('#btnSendCode').click(function(){
            if(!$('.mobile_input').val()){
                $(".copy_text").text("?????????????????????!");
                $(".copy_pop").css("display","flex");
                setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                return;
            }
            var mobile_text = $(".mobile_input").val();
            // isMobile(str);
            if(!isMobile(mobile_text)){
                $(".copy_text").text("???????????????????????????!");
                $(".copy_pop").css("display","flex");
                setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                return;
            }
        ???	curCount = count;
            $.ajax({
                url:""+hosturl+"/app/index.php?i=96&c=entry&m=wx_shop&do=mobile&r=account.verifycode",    //?????????url??????
                dataType:"json",   //???????????????json
                async:true,//????????????????????????????????????????????????ajax????????????
                data:{
                    "mobile": mobile_text,
                    "imgcode": 0,
                    "temp": "sms_reg"
                },    //?????????
                type:"POST",   //????????????
                success:function(res){
                    //?????????????????????
                    // console.log(res);
                    if(res.status == 0){
                        $(".copy_text").text(res.result.message);
                        $(".copy_pop").css("display","flex");
                        setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                        return;
                    }
                    $("#btnSendCode").attr("disabled", "true");//??????button?????????????????????
                    $("#btnSendCode").val(curCount + "???????????????????????????");
                ??????InterValObj = window.setInterval(SetRemainTime, 1000); //??????????????????1???????????????
                }
            });

        });
        //timer????????????
        function SetRemainTime() {
            if (curCount == 0) {                
                window.clearInterval(InterValObj);//???????????????
                $("#btnSendCode").removeAttr("disabled");//????????????
                $("#btnSendCode").val("?????????????????????");
            }
            else {
                curCount--;
                $("#btnSendCode").val(curCount + "??????????????????");
            }
        }


        // ????????????
        $(".tj_btn").click(function(){
            var yqminof = localstroage.getItem('loadcool');
            var username = $(".name_input").val(); //??????
            var mobile_text = $(".mobile_input").val(); //??????
            var codenum = $(".code_input").val(); //?????????
            var passwd_text = $(".passwd_new").val(); //??????
            var passwd_text1 = $(".passwd_ok").val(); //??????
            var passwd_zf = $(".passwd_zf").val(); //????????????
            var passwd_zf1 = $(".passwd_zfok").val(); //????????????
            var code_num = $(".code_num").val(); //?????????
            if(!username){
                $(".copy_text").text("???????????????!");
                $(".copy_pop").css("display","flex");
                setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                return;
            }
            if(!codenum){
                $(".copy_text").text("??????????????????!");
                $(".copy_pop").css("display","flex");
                setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                return;
            }
            if(!passwd_text){
                $(".copy_text").text("???????????????!");
                $(".copy_pop").css("display","flex");
                setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                return;
            }
            if(passwd_text1 != passwd_text){
                $(".copy_text").text("?????????????????????!");
                $(".copy_pop").css("display","flex");
                setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                return;
            }
            if(!passwd_zf){
                $(".copy_text").text("?????????????????????!");
                $(".copy_pop").css("display","flex");
                setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                return;
            }
            if(passwd_zf != passwd_zf1){
                $(".copy_text").text("???????????????????????????!");
                $(".copy_pop").css("display","flex");
                setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                return;
            }
            $.ajax({
                url:""+hosturl+"/app/index.php?i=96&c=entry&m=wx_shop&do=mobile&r=account.register",    //?????????url??????
                dataType:"json",   //???????????????json
                async:true,//????????????????????????????????????????????????ajax????????????
                data:{
                        "name" : username,	//??????
                        "mobile": mobile_text, //?????????
                        "pwd": passwd_text, //??????
                        "pwd2": passwd_zf, //??????
                        "verifycode": codenum, //?????????
                        "invitcode": code_num //?????????
                    },    //?????????
                type:"POST",   //????????????
                success:function(res){
                    //?????????????????????
                    // console.log(res);
                    if(res.status == 0){
                        $(".copy_text").text(res.result.message);
                        $(".copy_pop").css("display","flex");
                        setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                        return;
                    };
                    if(res.status == 1){
                        $(".copy_text").text(res.result.message);
                        $(".copy_pop").css("display","flex");
                        setTimeout(function(){$(".copy_pop").css("display","none");},1000)
                        window.location.href= "https://www.guanzhu.mobi/p/8bDxv"
                        // location.replace("http://wth226.com/dist/#/login")
                    }
                }
            });
        })
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>