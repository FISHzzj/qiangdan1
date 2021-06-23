<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>查看物流</title>
<style type="text/css">
    body {margin:0px; background:#efefef; -moz-appearance:none;}

    .detail_good {height:auto;padding:10px;background:#fff;overflow: hidden;}
    .detail_good .good {height:80px; width:80px; float:left;margin-right:3%;border:1px solid #f1f1f1;box-sizing:border-box;padding-top:5px;text-align: center;}
    .detail_good .tips {width:76%; float:left;font-size:15px;color:#A1A1A1;}
    .detail_good .tips .name{color:#585858;}
    /* .detail_good .img { width:100%; } */
    .detail_good .good  img {width:70px;height:70px;vertical-align:middle;}

    .detail_express {height:auto;padding:10px;background:#fff;  margin-top:16px; border-top:1px solid #eaeaea;}
    .detail_express .ico {height:6px; width:10%; line-height:36px; float:left; text-align:center;}
    .detail_express .title {height:36px; width:90%; padding-left:10%; border-bottom:1px solid #eaeaea; line-height:36px; font-size:18px; color:#333;}
    .detail_express .content {height:auto; width:100%; padding:10px 0px; }
    .list-main {min-height:100px; background:#fff; padding:0 10px 0 10px;}
    .list {height:auto; border-left:1px solid #eee; padding-left:20px; position:relative;}
    .list .info {height:auto; border-top:1px solid #eee; padding:10px; font-size:14px; color:#666;}
    .list .info .step { height:auto;} 
    .list .info .time { height:20px;}
    .list .infoon { color:#25ae5e}
    .list .dot {height:10px; width:10px; border-radius:10px; background:#ddd; position:absolute; left:-6px; top:12px;}
    .list .doton {height:12px; width:12px; background:#25ae5e; border-radius:12px; border:1px solid #bbe2c9; left:-8px;}
</style>
<div id='container'>
    <div class="page_topbar">
     <a onclick="history.back(-1)" class="back"><i class="fa fa-angle-left"></i></a>
    <div class="title">查看物流</div>
</div>
 </div>
<div class="detail_good">

        
     <div class="good">
            <img src="<?php  echo $log['logo'];?>"/>
        </div>
   
    <div class="tips">
        <div class="name"><?php  echo $log['title'];?></div>
        <span>承运来源: <?php  echo $log['expresscom'];?></span>
        <br>
        <span>运单编号: <?php  echo $log['expresssn'];?><span><br/>
    </div>
</div> 

<div class='detail_express'>
    <div class="ico"><i class="fa fa-truck" style="color:#666; font-size:20px;"></i></div>
    <div class="title">物流跟踪</div>
    <div class='content' id='express_container'>
        <?php  if(empty($bb)) { ?>
        <p>未查询到物流信息</p>
        <?php  } else { ?>
        <div class="list-main">
            <?php  if(is_array($bb)) { foreach($bb as $row) { ?>
             <div class="list">
                 <div class="info " >
                     <div class='step'><?php  echo $row['context'];?></div>
                     <div class='time'><?php  echo $row['time'];?></div>
                 </div>
                 <div class="dot  <%if index==0%>doton<%/if%>"></div>
             </div>
            <?php  } } ?>
       </div>
        <?php  } ?>
    </div>
    
</div>

      <div style="height:80px;"></div>
</div>

<script id='tpl_detail' type='text/html'>
 <div class="page_topbar">
     <a onclick="history.back(-1)" class="back"><i class="fa fa-angle-left"></i></a>
    <div class="title">查看物流</div>
</div>
 </div>
<div class="detail_good">
    <%each goods as g%>
     <div class="good" onclick="location.href='<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%g.goodsid%>'">
            <img src="<%g.thumb%>"/>
        </div>
    <%/each%>
    <div class="tips">
        <%each goods as g%><div class="name"><%g.title%></div><%/each%>
        <span>承运来源: <%order.expresscom%></span>
        <br>
        <span>运单编号: <%order.expresssn%><span><br/>
    </div>
</div> 

<div class='detail_express'>
    <div class="ico"><i class="fa fa-truck" style="color:#666; font-size:20px;"></i></div>
    <div class="title">物流跟踪</div>
    <div class='content' id='express_container'>
      <%if $bb.length<=0%>
        <p>未查询到物流信息</p>
        <%else%>
        <div class="list-main">
            <%each $bb as row index%>
             <div class="list">
                 <div class="info <%if index==0%>infoon<%/if%>" <%if index==0%>style='border:none'<%/if%>>
                     <div class='step'><%row.step%></div>
                     <div class='time'><%row.time%></div>
                 </div>
                 <div class="dot  <%if index==0%>doton<%/if%>"></div>
             </div>
            <%/each%>
       </div>
        <%/if%>
    </div>
    
</div>
      <div style="height:80px;"></div>
</script>
<script id='tpl_express' type='text/html'>
      <%if list.length<=0%>
        <p>未查询到物流信息</p>
        <%else%>
        <div class="list-main">
            <%each list as row index%>
             <div class="list">
                 <div class="info <%if index==0%>infoon<%/if%>" <%if index==0%>style='border:none'<%/if%>>
                     <div class='step'><%row.step%></div>
                     <div class='time'><%row.time%></div>
                 </div>
                 <div class="dot  <%if index==0%>doton<%/if%>"></div>
             </div>
            <%/each%>
       </div>
        <%/if%>
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
