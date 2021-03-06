<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header_center', TEMPLATE_INCLUDEPATH)) : (include template('common/header_center', TEMPLATE_INCLUDEPATH));?>
<link href="../addons/sz_yi/plugin/creditshop/template/mobile/default/images/css.css" rel="stylesheet" type="text/css"/>

<title><?php  if(empty($cate)) { ?>商品列表<?php  } else { ?><?php  echo $cate['name'];?><?php  } ?></title>
<style type='text/css'>
#list_loading { padding:10px 0 10px 0;color:#666;text-align: center;width:100%;float:left;}
.page_topbar .title{ text-align: left;}
</style>
<div id='container'  style="width:1200px;margin:10px auto 0;overflow: hidden;"></div>
<script id='tpl_main' type='text/html'>
   <div class="page_topbar">
    <div class="title"><?php  if(empty($cate)) { ?>商品列表<?php  } else { ?><?php  echo $cate['name'];?><?php  } ?></div>
</div>
<div class="list">
<div id="container_list"></div>
</div>

</script>
<script id='tpl_empty' type='text/html'>
    <div class="record_ico"><i class="fa fa-cubes"></i></div>
    <div class="record_no">未找到任何产品~</div>
</script>

<script id='tpl_list' type='text/html'>
    <%each list as goods%>
        <div class="good" onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%goods.id%>'">
             <div class="info">
                 
                <div class="classs"><%goods.subtitle%><%if goods.type=='1'%><span class="span1">抽奖</span><%else%><span class="span2">兑换</span><%/if%></div>
               
                
                <div class="name"><%goods.title%></div>
                <div class="price">
                      <%if goods.acttype==0%>
                            <%goods.credit%><i class="fa fa-database"></i> <i class="fa fa-plus"></i> <%goods.money%><i class="fa fa-rmb"></i>
                       <%/if%>
                       <%if goods.acttype==1%>
                          <%goods.credit%><i class="fa fa-database"></i>
                       <%/if%>

                       <%if goods.acttype==2%>
                          <%goods.money%><i class="fa fa-rmb"></i>
                       <%/if%>
                </div>
                <div class="img"><img src="<%goods.thumb%>"/></div>
            </div>
     </div>
    <%/each%>
</script>
<script language='javascript'>
    var page= 1;
 
    require(['tpl', 'core'], function(tpl, core) {
       
        core.pjson('creditshop/lists',{cate:"<?php  echo $cateid;?>"},function(json){
                     
                  $('#container').html(  tpl('tpl_main',json.result) );
                     
                     if(json.result.total<=0){
                        $('#container_list').html(  tpl('tpl_empty') );
                        $('.list_footer').hide();
                     }else{
                           $('#container_list').html(  tpl('tpl_list',json.result) );
                     }
                     if (json.result.list.length < json.result.pagesize) {
                            return;
                     }
                     var loaded = false;
                      var stop=true; 
                      $(window).scroll(function(){ 
                          if(loaded){ 
                              return;
                          }
                            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop()); 
                            if($(document).height() <= totalheight){ 
                                
                                if(stop==true){ 
                                    stop=false; 
                                    $("#container_list").append('<div id="list_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                                    page++;
                                    core.pjson('creditshop/lists', {page:page,cate:"<?php  echo $cateid;?>"}, function(morejson) { 
                                       
				stop = true;
                                        $('#list_loading').remove();
                                        $("#container_list").append(tpl('tpl_list', morejson.result));
                                        if (morejson.result.list.length <morejson.result.pagesize) {
                                 
                                            $('#container_list').append('<div id="list_loading">已经加载完全部记录</div>');
                                            loaded = true;
                                            $(window).scroll = null;
                                            return;
                                        }
                                    },true); 
                                } 
                            } 
                        });
            
                  
              
                     
         },true);
   });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
