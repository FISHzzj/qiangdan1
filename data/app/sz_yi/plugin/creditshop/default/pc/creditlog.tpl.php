<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header_center', TEMPLATE_INCLUDEPATH)) : (include template('common/header_center', TEMPLATE_INCLUDEPATH));?>
<link href="../addons/sz_yi/plugin/creditshop/template/mobile/default/images/css.css" rel="stylesheet" type="text/css"/>

<title>我的积分</title>
<style type='text/css'>
  body { background:#fff }
#log_loading { padding:10px;color:#666;text-align: center;}
/*.page_topbar { position:fixed; top:0px;width:100%; z-index: 100}
.index_title  {position:fixed; top:220px;width:100%;}*/
.my_int_container,.my_shop,#my_line_list{position: static;}
body{max-width: none;}
</style>
<div id='container' style='width:1200px;margin:10px auto 0;overflow: hidden;'></div>

<script id='tpl_empty' type='text/html'>
    <div class="record_ico"><i class="fa fa-database"></i></div>
    <div class="record_no">您还没有兑换记录哦~</div>
</script>

<script id='tpl_main' type='text/html'>
 <div class="page_topbar">
    <a href="<?php  echo $this->createPluginMobileUrl('creditshop')?>" class="back"><i class="fa fa-angle-left"></i></a>
    <div class="title">我的积分</div>
</div>

    <?php  if(!empty($this->set['crediturl'])) { ?>
    <div class="my_rule"><a href="<?php  echo $this->set['crediturl']?>"><i class="fa fa-question-circle" style="padding-right:5px;"></i>积分说明</a></div>
    <?php  } ?>
       <div class='my_int_container'>
    <div class="my_int">
        <div class="text">积分</div>
        <div class="num"><?php  echo $credit;?></div>
    </div>
    </div>
   
    <div class="my_shop">
        <a href="<?php  echo $this->createPluginMobileUrl('creditshop')?>"><i class="fa fa-shopping-cart"></i> 积分商城</a>
        <a href="<?php  echo $this->createPluginMobileUrl('creditshop/log')?>"><i class="fa fa-align-justify"></i> 兑换记录</a>
    </div>
    <div class="index_title" style="margin-top: 10px;"><span style="background:#fff;">积分明细</span></div>
    <div id="my_line_list">
        
    </div>
    <div class="index_footer"><?php echo empty($this->set['copyright'])?"版权所有 ©".$shop['name']:html_entity_decode($this->set['copyright'])?></div>
</script>

<script id='tpl_list' type='text/html'>
    <%each list as row%> 
    <div class="my_line">
          <div class="right" style="color:#093">-<%row.credit%></div>
    	<div class="left">
        	<div class="desc"><%if row.type==0%>兑换<%else%>抽取<%/if%><%row.title%></div>
            <div class="date"><%row.createtime%></div>
        </div>
    </div>
 <%/each%>
</script>

<script language='javascript'>
    var page= 1;
      var loaded = false;
                      var stop=true; 
    require(['tpl', 'core'], function(tpl, core) {
       
        core.pjson('creditshop/creditlog',{},function(json){
                  $('#container').html(  tpl('tpl_main',json.result) );
                  if(json.result.total<=0){
                        $('#my_line_list').html(  tpl('tpl_empty') );
                        $('.index_footer').hide();
                     }else{
                           $('#my_line_list').html(  tpl('tpl_list',json.result) );
                     }
                var height = $(window).height()-265;
  
                $('#my_line_list').height(height);
                
                      $('#my_line_list').scroll(function(){ 
                
                          if(loaded){ 
                              return;
                          }  
                          nScrollHight = $('#my_line_list')[0].scrollHeight;
                          nScrollTop =$('#my_line_list')[0].scrollTop;
                          if(nScrollTop + height >= nScrollHight) {
                                
                                if(stop==true){ 
                                    stop=false; 
                                    $("#my_line_list").append('<div id="log_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                                    page++;
                                    core.pjson('creditshop/creditlog', {page:page}, function(morejson) {  
                                        stop = true;
                                        $('#log_loading').remove();
                                        $("#my_line_list").append(tpl('tpl_list', morejson.result));
                                        if (morejson.result.list.length <morejson.result.pagesize) {
                                          
                                            $('#my_line_list').append('<div id="log_loading">已经加载完全部记录</div>');
                                            loaded = true;
                                            $('#my_line_list').scroll = null;
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
