<?php defined('IN_IA') or exit('Access Denied');?><script id='tpl_show_message' type='text/html'>
	<style>
		body{ background: #fff; }
	</style>
	<div class="sweet-alert" style="display:block;">
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
<?php 
        
    if (empty($_W['shopshare'])) {
        
        $set = m('common')->getSysset();
  
        $_W['shopshare'] = array(
           'title'=>empty($set['share']['title'])?$set['shop']['name']:$set['share']['title'],
           'imgUrl'=>empty($set['share']['icon'])?tomedia($set['shop']['logo']):tomedia($set['share']['icon']),
           'desc'=>empty($set['share']['desc'])?$set['shop']['description']:$set['share']['desc'] ,
           'link'=>$this->createMobileUrl('shop')
        );
           
            
        $plugin_commission = p('commission');
         if($plugin_commission){
       
              $set = $plugin_commission->getSet();
               if(!empty($set['level'])){
            
                    $openid = m('user')->getOpenid();
                    $member = m('member')->getMember($openid);
                    
                    if(!empty($member) && $member['status']==1 && $member['isagent']==1){
                    	
                    	if (empty($set['closemyshop'])){
                       
                    	    $myshop = $plugin_commission->getShop($member['id']);
                    	    $_W['shopshare'] = array(
				               'title'=> $myshop['name'],
				               'imgUrl'=>tomedia($myshop['logo']),
				               'desc'=>$myshop['desc'],
				               'link'=>$this->createPluginMobileUrl('commission/myshop',array('mid'=>$member['id']))
				            );
                    	}
                    	else{
                    
                    	    $setdata1 = pdo_fetch('select * from ' . tablename('sz_yi_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
                            $set1 = unserialize($setdata1['sets']);
                            $_W['shopshare']['link'] = $set1['share']['url'];
                    	   //$_W['shopshare']['link'] = $this->createMobileUrl('shop',array('mid'=>$member['id'])); 
                    	}
                    	
                        if(empty($set['become_reg']) && ( empty($member['realname']) || empty($member['mobile']))){
                            $trigger = true;
                        }
                     } 
                     else if(!empty($_GPC['mid'])){
                     	$m = m('member')->getMember($_GPC['mid']);
                     	if(!empty($m) && $m['status']==1 && $m['isagent']==1){
                          if (empty($set['closemyshop'])){
                        	    $myshop = $plugin_commission->getShop($_GPC['mid']);
                        	    $_W['shopshare'] = array(
					               'title'=> $myshop['name'],
					               'imgUrl'=>tomedia($myshop['logo']),
					               'desc'=>$myshop['desc'],
					               'link'=>$this->createPluginMobileUrl('commission/myshop',array('mid'=>$member['id']))
					            );
                        	}
                        	else{
                        	   $_W['shopshare']['link'] = $this->createPluginMobileUrl('commission/myshop',array('mid'=>$_GPC['mid']));
                        	}
                        } else{
                       	   $_W['shopshare']['link'] = $this->createMobileUrl('shop',array('mid'=>$_GPC['mid']));
                        }
                     }
               }
         }
  
    }
?>
<span style='display:none'><?php  $shopset = m('common')->getSysset('shop')?><?php  echo htmlspecialchars_decode($shopset['diycode'])?></span>
<script language='javascript'>
	$(function(){
		$.ajax({
			url: "<?php  echo $this->createMobileUrl('runtasks')?>",
			cache:false 
		});
	})
</script>
 <script>
     require(['http://res.wx.qq.com/open/js/jweixin-1.0.0.js'],function(wx){


          
             
        window.shareData = <?php  echo json_encode($_W['shopshare'])?>;
        // console.log(window.shareData);
		jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || { jsApiList:[] };
	    <?php  if($trigger) { ?>
	            window.shareData.trigger =function(e){
	                
	                require(['core'],function(core){
	                    core.message('需要完善您的资料才能继续操作!',"<?php  echo $this->createMobileUrl('member/info',array('returnurl'=>urlencode($_W['siteurl'].$_SERVER['QUERY_STRING'])))?>",'warning');
	                    return;
	                })   
	                wx.cancel();
	            }
	    <?php  } ?>
	    jssdkconfig.debug =false;
		jssdkconfig.jsApiList = ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','showOptionMenu','scanQRCode','chooseWXPay'];
		wx.config(jssdkconfig);
		wx.ready(function () {
			wx.showOptionMenu();
			wx.onMenuShareAppMessage(window.shareData);
			wx.onMenuShareTimeline(window.shareData);
			wx.onMenuShareQQ(window.shareData);
			wx.onMenuShareWeibo(window.shareData);
       

                      <?php  
                           if( !empty($_W['testp']) &&false){
                       ?>
var data = <?php  echo json_encode($wechat);?>;
alert(JSON.stringify(data));
data.success = function() { alert(); };
wx.chooseWXPay(data);

                     <?php 


                           }
                      ?>
                                         
	
	            $("#a_logo1").click(function(){
	          
	            wx.scanQRCode({
	                needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
	                scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
	                success: function (res) {
	                var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
	            }
	            });
	        });
	
	      });

    
	});
</script>
</body></html>
