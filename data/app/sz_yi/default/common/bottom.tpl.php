<?php defined('IN_IA') or exit('Access Denied');?><style>
h6 span{color:#000000 !important;font-weight: 100;}
</style>
<link rel="stylesheet" type="text/css" href="../addons/sz_yi/template/pc/default/static/css/footer.css">
<div class="cover-page-foot fl wfs">
    <p class="subnav">
        <?php  if($this->yzShopSet['fmenu_name']) { ?>
            <?php  if(is_array($this->yzShopSet['fmenu_name'])) { foreach($this->yzShopSet['fmenu_name'] as $k => $v) { ?>
            <a target="_blank" href="<?php  echo $this->yzShopSet['fmenu_url'][$k]?>"><?php  echo $v;?></a>
            <?php  } } ?>
        <?php  } else { ?>
            <a target="_blank" href="<?php  echo $this->createMobileUrl('shop/index')?>">首页</a>
            <a target="_blank" href="<?php  echo $this->createMobileUrl('shop/list', array('order' => 'sales', 'by' => 'desc'))?>">全部商品</a>
            <a target="_blank" href="<?php  echo $this->createMobileUrl('shop/notice')?>">店铺公告</a>
            <?php  if($this->footer['commission']) { ?>
            <a target="_blank" href="<?php  echo $this->footer['commission']['url']?>"><?php  echo $this->footer['commission']['text']?></a>
            <?php  } ?>
            <a target="_blank" href="<?php  echo $this->createMobileUrl('member/indexCenter')?>">会员中心</a>
        <?php  } ?>
    </p>
    <p class="copyright"><?php  echo htmlspecialchars_decode($this->yzShopSet['pccopyright'])?></p>
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