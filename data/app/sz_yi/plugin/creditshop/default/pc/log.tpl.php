<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('member/center', TEMPLATE_INCLUDEPATH)) : (include template('member/center', TEMPLATE_INCLUDEPATH));?>
<link href="../addons/sz_yi/plugin/creditshop/template/mobile/default/images/css.css" rel="stylesheet" type="text/css"/>
<link href="../addons/sz_yi/template/pc/default/static/newpc/fontMain/iconfont.css" rel="stylesheet" type="text/css"/>
<title>兑换记录</title>

<?php  if($_GPC['shine']==1) { ?>
<script type='text/javascript' src='../addons/sz_yi/plugin/creditshop/template/mobile/default/images/jquery.color.js'></script>
<?php  } ?>
<style type='text/css'>
  body { background:#fff }
  #log_loading { padding:10px;color:#666;text-align: center;}
    /* 简易数据表格-格边框 */
  .m-table{table-layout:fixed;width:100%;line-height:1.5;}
  .m-table th,.m-table td{padding:10px;border:1px solid #ddd;}
  .m-table th{font-weight:bold;}
  .m-table tbody tr:nth-child(2n){background:#fafafa;}
  .m-table tbody tr:hover{background:#f0f0f0;}
  .m-table .cola{width:100px;}
  .m-table .colb{width:200px;}
  /* 简易数据表格-行边框*/
  .m-table-row th,.m-table-row td{border-width:0 0 1px;}
  .contain{width: 960px;margin: 0 auto;}
  .tbtr {background: #f1f1f1;}
  .editAddress,.removeAddress,.moren,.saveBtn,.info_price .sub{cursor: pointer;}
  .goodImg{width: 50px;height: 50px;position: absolute;left: 0px;top:0px;}
  .f-relative{position: relative;}
  .tb1{padding-left: 70px;}
  .tb1 .desc{    height: 20px;
    line-height: 20px;
    font-size: 13px;
    color: #666;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    content: "...";}
   .tb1 .result{    height: 20px;
    line-height: 20px;
    font-size: 12px;
    color: #666;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    content: "...";}
    .u-btn{    
        width: 115px;
        height: 30px;
        line-height: 30px;
        color: white;
        background: #e31939;
        border-radius: 3px;
        text-align: center;
        font-size: 11px;
        margin-top: 10px;
    }
    .shouhuo{background: #c1c1c1;}
    .duihuan{width: 80px;}
    .m-table-row .tbody tr{height: 80px;}
    .u-btn{cursor: pointer;}
    .duihuan:hover{background: #ff5b75;}
    
</style>
<div id='container'  class="rightlist" ></div>
<script id='tpl_main' type='text/html'>
<!-- <div id="container_list"></div> -->
<table class="m-table m-table-row">
          <thead>
              <tr class="tbtr">
                <th class="cola">商品信息</th>
                <th class="cola" style="padding-left: 35px;">消耗</th>
                <th class="cola" style="padding-left: 50px;">状态</th>
                <th class="cola" style="padding-left: 34px;">操作</th>
              </tr>
          </thead>
          <tbody class="tbody" id="container_list">

          </tbody>
</table>
</script>
<script id='tpl_empty' type='text/html'>
    <div class="record_ico"><i class="fa fa-database"></i></div>
    <div class="record_no">您还没有兑换记录哦~</div>
</script>
<script id='tpl_list' type='text/html'>
    <%each list as log i%>
                          <tr>
                            <td>
                                <div class="f-relative tb1">
                                    <img src="<%log.thumb%>" class="goodImg" <%if log.type==0%>
                                <%if log.status==1 || log.status==2%>onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/log',array('op'=>'detail'))?>&id=<%log.id%>'"<%/if%>
                                <%else%>
                                    <%if log.status==1%>onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%log.goodsid%>'"<%/if%>
                                    <%if log.status==2 || log.status==3%>onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/log',array('op'=>'detail'))?>&id=<%log.id%>'"<%/if%>
                                <%/if%>>
                                    <div class="desc"> <%if log.type==0%>兑换<%else%>抽取<%/if%><%log.title%></div>
                                    <div class="result">
                                        <%if log.goodstype==0%>
                                            <%if log.type==0%>
                                                <%if log.status==2%>兑奖码: <%log.eno%><%/if%>
                                                <%if log.status==3%>已兑换~<%/if%>
                                            <%else%>
                                                <%if log.status==1%>未中奖~<%/if%>
                                                <%if log.status==2%>兑奖码: <%log.eno%><%/if%>
                                                <%if log.status==3%>已兑换~<%/if%>
                                            <%/if%>
                                        <%else%>
                                           <%if log.status==1%>未中奖~<%/if%>
                                            <%if log.status==3%>优惠券已发放~<%/if%>
                                        <%/if%>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <%if log.acttype==0%>
                                    <span style="color: #ffa700;">
                                        <span class="f-fwb"><%log.credit%></span>
                                        <i class="iconfont" style="">&#xe606;</i>
                                    </span>
                                    <span>
                                        <i class="iconfont" style="color: gray;font-size: 13px;">&#xe646;</i>
                                    </span>
                                    <span style="color: #ffa700;">
                                        <span class="f-fwb"><%log.money%></span>
                                        <i class="iconfont" style="font-size: 18px;">&#xe604;</i>
                                    </span>
                                    <%/if%>

                                    <%if log.acttype==1%>
                                      <span style="color: #ffa700;">
                                        <span class="f-fwb"><%log.credit%></span>
                                        <i class="iconfont" style="">&#xe606;</i>
                                      </span>
                                    <%/if%>

                                    <%if log.acttype==2%>
                                      <span style="color: #ffa700;">
                                        <span class="f-fwb"><%log.money%></span>
                                        <i class="iconfont" style="font-size: 18px;">&#xe604;</i>
                                      </span>
                                    <%/if%>
                                </div>
                            </td>
                            <!-- <td>
                                <div>
                                    <span style="color: #ffa700;">
                                        <span class="f-fwb">1</span>
                                        <i class="iconfont" style="">&#xe606;</i>
                                    </span>
                                    <span >
                                        <i class="iconfont" style="color: gray;font-size: 13px;">&#xe646;</i>
                                    </span>
                                    <span style="color: #ffa700;">
                                        <span class="f-fwb">1.00</span>
                                        <i class="iconfont" style="font-size: 18px;">&#xe604;</i>
                                    </span>
                                </div>
                            </td> -->
                            <td>
                                <%if log.status==2%><div class="u-btn shouhuo">未填写收货地址</div><%/if%>
                                <%if log.status==3%><div class="u-btn shouhuo">已填写</div><%/if%>
                            </td>
                            <td>
                              <%if log.status==2%>
                                 <a href="<?php  echo $this->createPluginMobileUrl('creditshop/log',array('op'=>'detail'))?>&id=<%log.id%>"><div class="u-btn duihuan">确认兑换</div></a>
                              <%/if%>
                              <%if log.status==3%>
                                 <a href="<?php  echo $this->createPluginMobileUrl('creditshop/log',array('op'=>'detail'))?>&id=<%log.id%>"><div class="u-btn duihuan">已兑换</div></a>
                              <%/if%>
                           
                            </td>
                          </tr>


    <!-- <div class="record_line"
           <%if log.type==0%>
                    <%if log.status==1 || log.status==2%>onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/log',array('op'=>'detail'))?>&id=<%log.id%>'"<%/if%>
                <%else%>
                    <%if log.status==1%>onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/detail')?>&id=<%log.goodsid%>'"<%/if%>
                    <%if log.status==2 || log.status==3%>onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop/log',array('op'=>'detail'))?>&id=<%log.id%>'"<%/if%>
                <%/if%>
             
         >
        <div class="img"><img src="<%log.thumb%>"></div>
        <div class="go" ><i class='fa fa-angle-right'></i></div>
             <div  class="info">
          <div class="desc">
                     
                <%if log.type==0%>兑换<%else%>抽取<%/if%><%log.title%></div>
       
            <div class="price">
              
             <%if log.acttype==0%>
                 <%log.credit%><i class="fa fa-database" style=" padding-left:5px;"></i> <i class="fa fa-plus" style=" padding-left:5px;"></i> <%log.money%><i class="fa fa-rmb" style=" padding-left:5px;"></i>
            <%/if%>
            <%if log.acttype==1%>
               <%log.credit%><i class="fa fa-database" style=" padding-left:5px;"></i>
            <%/if%>
    
            <%if log.acttype==2%>
               <%log.money%><i class="fa fa-rmb" style=" padding-left:5px;"></i>
            <%/if%><%if log.goodstype==0%>
                <span style='font-size:12px;'>
               <%if log.isverify==1 && log.storeid==0%>请选择门店<%/if%>
                     <%if log.isverify==0 && log.addressid==0%>请选择地址<%/if%>
        
            </span>  <%/if%>
            </div>
             <div class="result">
                  <%if log.goodstype==0%>
                    <%if log.type==0%>
                        <%if log.status==2%>兑奖码: <%log.eno%><%/if%>
                        <%if log.status==3%>已兑换~<%/if%>
                    <%else%>
                        <%if log.status==1%>未中奖~<%/if%>
                        <%if log.status==2%>兑奖码: <%log.eno%><%/if%>
                        <%if log.status==3%>已兑换~<%/if%>
                    <%/if%>
            <%else%>
               <%if log.status==1%>未中奖~<%/if%>
                    <%if log.status==3%>优惠券已发放~<%/if%>
            <%/if%>
            </div>
        </div>
    </div> -->
<%/each%>
</script>
<script language='javascript'>
    var page= 1;
 
    require(['tpl', 'core'], function(tpl, core) {
       
        core.pjson('creditshop/log',{},function(json){

                     
                     $('#container').html(  tpl('tpl_main',json.result) );
                     
                     if(json.result.total<=0){
                        $('#container_list').html(  tpl('tpl_empty') );
                     }else{
                           $('#container_list').html(  tpl('tpl_list',json.result) );
                     }
  
                <?php  if($_GPC['shine']==1) { ?>
                     var first = $('.record_line:first-child');
                     if(first.length>0){
                         first.animate({backgroundColor:'#ff0'},300,null,function(){
                               first.animate({backgroundColor:'#fff'},200);
                         });
                     }
                <?php  } ?>
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
                                    $("#container_list").append('<div id="log_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                                    page++;
                                    core.pjson('creditshop/log', {page:page}, function(morejson) {  
                                        stop = true;
                                        $('#log_loading').remove();
                                        $("#container_list").append(tpl('tpl_list', morejson.result));
                                        bindEvents();
                                        if (morejson.result.list.length <morejson.result.pagesize) {
                                          
                                            $('#container_list').append('<div id="log_loading">已经加载完全部记录</div>');
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