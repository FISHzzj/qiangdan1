<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
/* 底部 */
.u-btn {
    display: block;
    background: #b7434d;
    width: 80px;
    height: 40px;
    line-height: 40px;
    color: white;
    font-size: 14px;
    border-radius: 5px;
    text-align: center;
}
.g-footer {
    bottom: 0px;
    width: 100%;
}
.m-footer {
    margin: 0 auto;
    width: 1210px;
}

.g-mn2 {
    float: left;
    width: 100%;
}
.g-mn2c {
    margin-right:160px;
    margin-left: 10px;
}
.g-bd2 {
    margin: 10px 0 10px;
}
.g-mn2 {
    float: left;
    width: 100%;
}

.m-list1 {
    line-height: 23px;
}
.m-list1 ul {
    margin-left: -10px;
}
.m-footer ul.m-fristUl li.m-fristLi {
    width: 18%;
    margin-top: 15px;
}
.m-list1 ul {
    margin-left: -10px;
}
.m-list1 li {
    float: left;
    padding-left: 10px;
}
.m-footer ul.m-fristUl li p.u-footerTitle {
    font-size: 15px;
    margin: 0px 0px 7px 0px;
    font-weight: bold;
    text-align: center;
}
.m-footer ul.m-fristUl li p.u-footerItem {
    font-size: 12px;
    color: #676767;
    margin: 3px 0px;
    text-align: center;
}
.u-weixindiv {
    border-right: 1px solid white;
    margin-left: -290px !important;
    margin-top: 10px;
    margin-right: 70px;
}
.u-guanzhu {
    font-size: 15px;
    margin: 5px 0px 7px 0px;
    text-align: center;
    font-weight: bold;
}
.g-sd2 {
    position: relative;
    float: right;
    width: 145px;
    margin-left: -145px;
}
.u-marginT15 {
    margin-top: 15px;
}
.Nitem {
    font-size: 12px;
    color: #bbbbbb;
    margin: 3px 0px;
}
.u-footerTitleN {
    font-size: 19px;
    margin: 0px 0px 7px 0px;
    color: white;
}
.g-footer {
    height:auto;
}
.f-bootom {
    font-size: 13px;
    text-align: center;
    height: 40px;
    line-height: 40px;
    background: #333538;
    color: #ccc;
}
.footerImg {
    width: 1210px;
    height: auto;
    margin: 0px auto 0 auto;
    /* border-bottom: 1px solid #eee; */
}
 .footerImg img {
    width: auto;
    height: auto;
    max-width: 1210px;
    max-height: 110px;
}
.kefu{background: white;border:1px solid #e31939;color: #e31939;border-radius: 3px; width: 130px;height: 33px;line-height: 30px;}
.kefu:hover{background:#e31939;color: white; }
.bottomList a {
    padding: 0px 8px;
    color: #ccc;
}
.bottomList .info-text p {
    margin: 0;
    line-height: 25px;
}
.bottomList em{color:#ccc; }
.f-tac{text-align: center;}
.f-cb {
    clear: both;
}
</style>

<div class="g-footer">
        <div class="g-bd5 f-cb m-footer">
            <div class="g-bd2 f-cb">
                <div class="g-mn2" style="margin-bottom:20px;">
                    <div class="g-mn2c">
                       <div class="g-bd2 f-cb">
                            <div class="g-mn2">
                                <div class="g-mn2c">
                                   <div class="m-list1">
                                        <ul class="f-cb m-fristUl">
                                           <?php  if(is_array($_W['arrfooter'])) { foreach($_W['arrfooter'] as $name => $row) { ?>
                                               <li class="m-fristLi">
                                                    <ul>
                                                        <li>
                                                            <p class="u-footerTitle"><?php  echo $name;?></p>
                                                            <?php  if(is_array($row)) { foreach($row as $item) { ?>
                                                               <a href="<?php  echo $item['advurl'];?>"><?php  echo $item['name'];?></p></a>
                                                            <?php  } } ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php  } } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="g-sd2 f-tac u-weixindiv">
                                <p class="u-guanzhu">微信扫一扫</p>
                                <img src="../attachment/images/6/2017/08/c4K0hL0wWh2BY4YbLbd2l4fJ0c42HF.jpg" style="width:110px;height:110px;">
                                <!-- <img src="../attachment/<?php  echo $set['shop']['pcerweilogo'];?>" style="width:110px;height:110px;"> -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="g-sd2 u-marginT15">
                    <p class="f-fsize18 f-colorRed f-fwb f-marginT10" style=" color:<?php  echo $this -> pcgucolor?>"><?php  echo $this -> pcgutitle?></p>
                    <p class="f-marginT10" style=" color:<?php  echo $this -> pcworkcolor?>"><?php  echo $this -> pcworktitle?></p>
                    <a href="javascript:;"><div class="u-btn kefu f-marginT10">客服在线</div></a>
                </div>
            </div>

        </div>
        <div class="f-cb"></div>

        <div class="fo" style="background: #333538;padding-top: 13px;">
            <p class="bottomList f-tac ">
                    <?php  if(is_array($_W['footerarr'])) { foreach($_W['footerarr'] as $k => $v) { ?>
                        <a href="<?php  echo $_W['footerarr_url']['fmenu_url'][$k];?>" target="_blank"><?php  echo $v;?></a>
                        <?php  if($k != $coutfooter) { ?>
                           <em>|</em>
                        <?php  } ?>
                    <?php  } } ?>

            </p>
            <div class="f-cb"></div>
            <div class="f-bootom" style="height: 30px;"><?php  echo $this -> contentfooters?></div>
        </div>

</div>

<div style="display:none;">
    <?php  echo htmlspecialchars_decode($this->yzShopSet['diycode'])?>
</div>
<script id='tpl_show_message' type='text/html'><div class="sweet-alert" style="display:block;">
        <%if type=='error'%><div class="icon error animateErrorIcon" style="display: block;"><span class="x-mark animateXMark"><span class="line left"></span><span class="line right"></span></span></div><%/if%>
        <%if type=='warning'%><div class="icon warning pulseWarning" style="display: block;"><span class="body pulseWarningIns"></span><span class="dot pulseWarningIns"></span></div><%/if%>
        <%if type=='success'%><div class="icon success animate" style="display: block;"><span class="line tip animateSuccessTip"></span><span class="line long animateSuccessLong"></span><div class="placeholder"></div><div class="fix"></div></div><%/if%>
        <div class="info"><%message%><%if url%><br><span>如果您的浏览器没有自动跳转请点击此处</span><%/if%></div>

        <div class="sub"
             <%if url%>
                    onclick="location.href='<%url%>'"
             <%else%>
                    <%if js%>
                        onclick="<%js%>"
                    <%else%>
                        onclick="history.back()"
                    <%/if%>
             <%/if%>
             >
        <%if type=='success'%><div class="green">确认</div><%/if%>
        <%if type=='warning'%><div class="grey">确认</div><%/if%>
        <%if type=='error'%><div class="red">确认</div><%/if%>
        </div>
</script>
</body>
</html>