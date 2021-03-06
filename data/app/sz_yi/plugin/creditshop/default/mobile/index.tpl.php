<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<title>积分商城</title>
<style type="text/css">
  body{background: #f2f2f2;}
    .banner {overflow:hidden;position:relative;height:auto;}
    .banner  .main_image{width:100%;position:relative;top:0;left:0;}
  .banner .main_image ul{}
  .banner .main_image li{float:left;}
  .banner .main_image li img{display:block;width:100%; }
  .banner .main_image li a{display:block;width:100%;}

    div.flicking_con{position:absolute;bottom:10px;z-index:1;width:100%;height:12px;}
    div.flicking_con .inner { width:100%;height:9px;text-align:center;}
    div.flicking_con a{position:relative; width:10px;height:9px;background:url('../addons/sz_yi/template/mobile/default/static/images/dot.png') 0 0 no-repeat;display:inline-block;text-indent:-1000px}
    div.flicking_con a.on{background-position:0 -9px}
</style>
<div id='container'></div>
<script id='tpl_main'  type='text/html'>
    <%if advs.length>0%>
    <div class="banner">

        <%if advs.length>1%>
        <div class="flicking_con"><div class="inner">
            <%each advs as value index %>
            <a class="<%if index==0%>on<%/if%>" href="#@"><%index%></a>
            <%/each%>
            </div>
        </div>
        <%/if%>
        <div class="main_image" id='banner'>
            <ul>
                <%each advs as adv %>
                <li <%if adv.link%>onclick="location.href='<%adv.link%>'"<%/if%>> <img src="<%adv.thumb%>"></li>
                <%/each%>
            </ul>
        </div>
    </div>
    <%/if%>
    <div class="index_sub">
        <a href="<?php  echo $this->createPluginMobileUrl('creditshop/creditlog')?>"><i class="fa fa-database"></i> 积分<d><%credit%></d></a>
        <a href="<?php  echo $this->createPluginMobileUrl('creditshop/log')?>"><i class="fa fa-align-justify"></i> 兑换记录</a>
    </div>
    <%if tops.length>0%>
    <div class="top">
       <div class="left">
           <%if tops.length>0%>
           <a href="<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%tops[0].id%>">
              <div class="info">
             	<div class="classs"><%tops[0].subtitle%>
                    <%if tops[0].type=='1'%><span class="span1">抽奖</span><%/if%>
                </div>
                  <div class="name"><%tops[0].title%></div>
                  <div class="price"><%tops[0].credit%><i class="fa fa-database"></i></div>
                  <div class="img"><img src="<%tops[0].thumb%>" style='height:100px;'/></div>
              </div>
           </a>
           <%/if%>
        </div>
        
        <div class="right">
             <%if tops.length>1%>
             <a href="<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%tops[1].id%>">
                        <div class="good">
                           <div style="height:99px; float:left; margin-right:-99px; width:100%;">
                               <div class="info">
                                     <%if tops[1].subtitle!=''%><div class="classs"><%tops[1].subtitle%></div><%/if%>
                                     <div class="name"><%tops[1].title%></div>
                                            <div class="price"><%tops[1].credit%><i class="fa fa-database"></i></div>
                                            <%if tops[1].type=='1'%><span class="span1">抽奖</span><%/if%>
                                  </div>
                           </div>
                           <div class="img"><img src="<%tops[1].thumb%>"/></div>
                        </div>
             </a>
             <%/if%>
             <%if tops.length>2%>
               <a href="<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%tops[2].id%>">
          <div class="good">
                           <div style="height:99px; float:left; margin-right:-99px; width:100%;">
                               <div class="info">
                                     <%if tops[2].subtitle!=''%><div class="classs"><%tops[2].subtitle%></div><%/if%>
                                     <div class="name"><%tops[2].title%></div>
                                     <div class="price"><%tops[2].credit%><i class="fa fa-database"></i></div>
                                     <%if tops[2].type=='1'%><span class="span1">抽奖</span><%/if%>
                                  </div>
                           </div>
                           <div class="img"><img src="<%tops[2].thumb%>"/></div>
                        </div>
             </a>
             <%/if%>
        </div>
    </div>
    <%/if%>
    
    <%if category.length>0%>
    <div class="class1">
        <%each category as value%>
        <a href="<?php  echo $this->createPluginMobileUrl('creditshop/lists')?>&cate=<%value.id%>">
            <div class="class2">
                <div class="class3">
                    <div class="ico ico1"><img src='<%value.thumb%>' /></div>
                    <div class="text"><%value.name%></div>
                </div>
            </div>
        </a>
       <%/each%>
    </div>
    <%/if%>
    
    <%if recommands.length>0%>
    <div class="index_title clr">
      <span class="lt">推荐专区</span>
      <!-- <a href="#" class="rt">更多<i class="fa fa-angle-right"></i></a> -->
    </div>
        <div class="list">
           <%each recommands as value%>
           <a href="<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%value.id%>">
                <div class="good">
                    <div class="info">
                        <div class="classs"><%value.subtitle%><%if value.type=='1'%><span class="span1">抽奖</span><%/if%></div>
                        <div class="name"><%value.title%></div>
                        <div class="price"><%value.credit%><i class="fa fa-database"></i></div>
                        <div class="img"><img src="<%value.thumb%>"/></div>
                    </div>
                </div>
            </a>
            <%/each%>
        </div>
    <%/if%>
    
    <%if vips.length>0%>
    <div class="index_title clr">
      <span class="lt">特权专区</span>
      <!-- <a href="#" class="rt">更多<i class="fa fa-angle-right"></i></a> -->
    </div>
        <div class="list">
           <%each vips as value%>
           <a href="<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%value.id%>">
                <div class="good">
                    <div class="info">
                        <div class="classs"><%value.subtitle%><%if value.type=='1'%><span class="span1">抽奖</span><%/if%></div>
                        <div class="name"><%value.title%></div>
                        <div class="price"><%value.credit%><i class="fa fa-database"></i></div>
                        <div class="img"><img src="<%value.thumb%>"/></div>
                    </div>
                </div>
            </a>
            <%/each%>
        </div>
    <%/if%>
    
    <%if times.length>0%>
    <div class="index_title clr">
      <span class="lt">限时活动</span>
      <!-- <a href="#" class="rt">更多<i class="fa fa-angle-right"></i></a> -->
    </div>
        <div class="list">
           <%each times as value%>
           <a href="<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%value.id%>">
                <div class="good">
                    <div class="info">
                        <div class="classs"><%value.subtitle%><%if value.type=='1'%><span class="span1">抽奖</span><%/if%></div>
                        <div class="name"><%value.title%></div>
                        <div class="price"><%value.credit%><i class="fa fa-database"></i></div>
                        <div class="img"><img src="<%value.thumb%>"/></div>
                    </div>
                </div>
            </a>
            <%/each%>
        </div>
    <%/if%>
    
    <%if reccategory.length>0%>
        <%each reccategory as rc%>
                <%if rc.goods.length>0%>
                <div class="index_title clr">
                  <span class="lt"><%rc.name%></span>
                  <!-- <a href="#" class="rt">更多<i class="fa fa-angle-right"></i></a> -->
                </div>
                    <div class="list">
                       <%each rc.goods as value%>
                       <a href="<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%value.id%>">
                            <div class="good">
                                <div class="info">
                                    <div class="classs"><%value.subtitle%><%if value.type=='1'%><span class="span1">抽奖</span><%/if%></div>
                                    <div class="name"><%value.title%></div>
                                    <div class="price"><%value.credit%><i class="fa fa-database"></i></div>
                                    <div class="img"><img src="<%value.thumb%>"/></div>
                                </div>
                            </div>
                        </a>
                        <%/each%>
                    </div>
                  <%/if%>
        <%/each%>
    <%/if%>
    
    <div class="index_footer"><?php echo empty($this->set['copyright'])?"版权所有 ©".$shop['name']:html_entity_decode($this->set['copyright'])?></div>
 </script>
 
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        core.pjson('creditshop',{},function(json){
            var result = json.result;   
            $('#container').html(  tpl('tpl_main',result) );
            
              if (result.advs.length > 0) {
          
                require(['jquery','jquery.touchslider','swipe'], function ($) {
              
                    
                    new Swipe($('#banner')[0], {
			speed:300,
			auto:4000,
			callback: function(){
			  
                                 $(".flicking_con  .inner  a").removeClass("on").eq(this.index).addClass("on");
		}
	  }); 
       
                    
                
                })
            } 
            
        },true);
        
    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
