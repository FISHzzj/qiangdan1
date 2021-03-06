<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>小店设置</title>
<script src="../addons/sz_yi/static/js/dist/ajaxfileupload.js" type="text/javascript"></script>
<style type="text/css">
    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;}
    a {text-decoration:none;}
 
    .myshop_addnav {height:44px; width:94%; padding:0 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:42px; color:#666; background:#fff;}
    .myshop_addnav {height:40px; width:94%; padding:0 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:40px; color:#666; }
.myshop_main {height:auto; padding:0px 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; background:#fff;}
.myshop_main .line {height:44px; width:100%; border-bottom:1px solid #f0f0f0; line-height:44px;position: relative;}

.myshop_main .line .label {float:left;width:70px;color: #999;font-size: 14px;height: 44px;line-height: 44px}
.myshop_main .line .info { float:right; width:100%; margin-left:-75px;text-align: right;overflow:hidden;height:44px;}
.myshop_main .line .info .inner { color:#666;margin-left:75px;}
.myshop_main .line1 {height:80px; width:100%; border-bottom:1px solid #f0f0f0; line-height:80px;}
.myshop_main .line input {float:left; height:44px; width:100%; padding:0px; margin:0px; border:0px; outline:none; font-size:16px; color:#666;padding-left:5px;}
.myshop_main .line select  {float:left; border:none;height:25px;width:100%;color:#666;font-size:16px;margin-top:10px;}
.myshop_sub1 {height:44px; width:94%; margin:14px 3% 0px;margin-bottom: 10px; background:#ff4f4f; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.myshop_sub2 {height:44px; width:94%; margin:14px 3% 0px; background:#ddd; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#666; border:1px solid #d4d4d4;}

.myshop_main .line2 {width:100%;  line-height:25px; color:#666;overflow:hidden; font-size:13px;word-break: break-all;}

textarea {height:60px;line-height:22px; width:100%;padding:5px;font-size:13px; background:#fff; padding-left:2%; border:1px solid #e9e9e9; margin:14px 0px 0; -webkit-appearance: none;} 
.myshop_menu {height:44px; background:#fff;}
.myshop_menu .nav {height:44px; width:50%; border-bottom:1px solid #f1f1f1;background:#fff; border-left:1px solid #f1f1f1; float:left; line-height:44px; font-size:14px; color:#666; text-align:center;}
.myshop_menu .navon {color:#00c1ff; border-bottom:2px solid #00c1ff;}
.myshop_main .line .nav {height:22px; width:40px; background:#ccc; margin:9px 0px; float:right; border-radius:40px;}
.myshop_main .line .on {background:#4ad966;}
.myshop_main .line .nav nav {height:20px; width:20px; background:#fff; margin:1px; border-radius:20px;}
.myshop_main .line .nav .on {margin-left:19px;}
.myshop_main .line span { color:#666;font-size:13px;}

  .myshop_main .pic { height:auto;border-radius:5px;color:#999;line-height:35px;font-size:13px;padding:5px;margin-top:10px;margin-bottom:10px;}
  .myshop_main .pic .plus { margin:3px; border:1px solid #eee; color:#999;  font-size:13px;line-height:35px; height: 35px;text-align:center;  }
  .myshop_main .pic .images {}
    
   .chooser {height: 100%; width: 100%; background:#efefef; position: fixed; top: 0px; left: 100%; z-index: 10;}
   .main {position:absolute;top:41px;  height:100%;width:100%;}
    #left_container { float:right;width:90px;height:100%;background:#efefef;overflow:auto;}
    #left_container .parent_item {width:94%; padding:0 3%; height:35px;line-height:35px;font-size:13px;float:left; text-align:center; color:#333;}
    #left_container .on {background:#fff;}
    
     
    #left_container .title {height:44px; width:100%; background:rgba(0,0,0,0.2); line-height:44px; font-size:16px; color:#fff; text-align:center;}
    #left_container .all {height:auto; width:80%; padding:10px 10%; color:#fff;}
    #left_container .all p {height:auto; width:100%; font-size:16px; line-height:20px; padding:0px; margin:0px;}
    #left_container .all p.category_item { padding-top:10px;}
    #left_container .all p.child {height:auto; width:100%; font-size:16px; line-height:20px;  padding-left:10px;padding-top:10px;}
    #left_container .all p.third {height:auto; width:100%; font-size:16px; line-height:20px;  padding-left:20px;padding-top:10px;}
    #left_container .all span {height:auto; width:95%; margin-left:5%; margin-bottom:10px; font-size:16px; line-height:20px; padding:0px;}
    
    
    
    #right_container { float:right;margin-right:-90px;width:100%;height:100%; z-index:1;overflow:auto;background:#fff;}
    #right_container .inner { margin-right: 90px; background:#fff;height:100%;padding:10px 10px  35px 10px;;}
    #right_container .inner .category_item { width:27%;float:left;padding:5px;color:#333;font-size:13px; text-align: center;}
    #right_container .inner .category_item .name {height:16px;overflow:hidden;width:100%; text-align: center;}
    #right_container .inner img{width:100%;}

    #right_container .search  {height:35px; width:100%; background:#fff;}
    #right_container .search .left_wrap {height:34px; width:100%; float:left;margin-left:10px; }
    #right_container .search .left { margin-right:35px;margin-top:3px;}
    #right_container .search .left input {width:100%; height:32px;line-height:30px;border:none;padding:0 0 0 10px; background:transparent;background:#e3e3e5; border-radius:3px 0px 0px 3px;}
    #right_container .search .right { position:relative; float:right;width:35px;margin-left:-70px;}
    #right_container .search .right .sub1 {height:32px; width:30px; float:left; background:#e3e3e5; border-radius:0px 3px 3px 0px; border:0px; padding:0px; margin-top:3px; font-size:16px; color:#6f737c;}
    #right_container .search .right .home1 {height:50px;width:30px; margin-left:5px;float: left; text-align:right; line-height:50px; color:#6f737c; font-size:14px;}
    
    
   .good {padding:10px 0; border-bottom:1px solid #e9e9e9;height: 65px}
   .good .img {height:50px; width:50px; float:left;}
   .good .img img {height:100%; width:100%;}
   .good .info {width:100%;float:left; margin-left:-50px;margin-right:-60px;}
   .good .info .info_inner { margin-left:60px;margin-right:65px;overflow: hidden; }
   .good .info .info_inner .name {height:32px;line-height:16px; width:100%; float:left; font-size:12px; color:#555;overflow:hidden;}
   .good .info .info_inner .price {height:16px;line-height:16px; width:100%; float:left; font-size:12px; color:#888;overflow:hidden;word-break: break-all}
   .good span { color:#666;}
   .good .option { float:right;width:60px;;height:54px;margin-left:-60px; text-align: center;line-height:54px;}
   .good .option i { color:#999;}
  .list_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
#list_loading { padding:10px;color:#666;text-align: center;float:left;margin-top:5px;}


.myshop_sub3 { position:absolute;;bottom:0;height:44px; width:100%; margin:0px; background:#f49c06; text-align:center; 
              font-size:16px; line-height:44px; color:#fff; }

</style>

<div id='container'></div> 


<div class="chooser" >
        <div class="page_topbar">
            <a href="javascript:;" class="back" onclick="closeChooser()"><i class="fa fa-angle-left"></i></a>
            <div class="title">自选商品</div>
        </div>
    <div class='main'>
        <div id='right_container'>
             <div class="search">
                    <div class='right'>
                        <button class="sub1" onclick="getGoods()"><i class="fa fa-search"></i></button>
                    </div>
                    <div class='left_wrap'>
                        <div class='left'>
                            <input type="text" id='keywords' class="input1" placeholder='搜索: 输入商品关键词' value='<?php  echo $_GPC['keywords'];?>'/>
                        </div>
                    </div>
                </div>
            <div class="inner"></div>
                
        </div>
        <div id='left_container'></div>
    </div>
    
    <div class="myshop_sub3" onclick='closeChooser()'>确认选择</div>
</div> 
<script id='tpl_category_list' type='text/html'>
   
    <div class="parent_item on" >全部商品</div>
    <div class="parent_item "  data-isnew="1">新上宝贝</div>
    <div class="parent_item "  data-isrecommand="1">推荐宝贝</div>
    <div class="parent_item "  data-ishot="1">热销宝贝</div>
    <div class="parent_item "  data-istime="1">限时秒杀</div>
    <div class="parent_item "  data-isdiscount="1">促销宝贝</div>
  
        
    <%each category as parent%>
        <div class="parent_item" data-pcate="<%parent.id%>">
            <%parent.name%>
        </div>
            <%each parent.children as child%>
                 <div class="parent_item" data-ccate="<%child.id%>">
                       <%child.name%>
                 </div>
                   <?php  if(intval($set['catlevel'])==3) { ?>
                    <%each child.children as third%>
                           <div class="parent_item" data-tcate="<%third.id%>">
                              <%third.name%>
                          </div>
                    <%/each%>
                    <?php  } ?>
           <%/each%>
         
    <%/each%>
    
    
</script>
 
    
<script id="tpl_goods_list" type="text/html">
     <%each goods as g%>
     <div class="good"  on="0" 
                 data-goodsid="<%g.id%>" 
                 data-thumb="<%g.thumb%>" 
                 data-title="<%g.title%>"
                 data-marketprice="<%g.marketprice%>">
            <div class="img" ><img src="<%g.thumb%>"/></div>
            <div class='info' >
                <div class='info_inner'>
                       <div class="name"><%g.title%></div>     
                       <div class='price'>价格:  <span class='marketprice'>￥<%g.marketprice%></div>
                </div>
            </div>
            <div class="option">
                <i class="fa fa-plus fa-2x"></i>
            </div>
        </div>
    <%/each%>
    
</script>
<script id='tpl_empty' type='text/html'>
 <div class="list_no"><i class="fa fa-shopping-cart" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">
         未搜索到任何商品</span></div>
 
</script>

<script id='tpl_main' type='text/html'>
    <div class="page_topbar">
        <a href="javascript:;" class="back" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/myshop')?>'"><i class="fa fa-angle-left"></i></a>
        <div class="title">小店设置</div>
    </div>
    <div class="myshop_menu">
        <div class="nav" style="border-left:0px;width:49%;" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/myshop',array('op'=>'set'))?>'">基本信息</div>
        <div class="nav  navon"  onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/myshop',array('op'=>'select'))?>'">自选商品</div>
    </div>
    <div class="myshop_main">
        <input type="hidden" id="img1" />
        <div class="line">
            <div class="label">开启自选</div>
            <div id='opengoods' class="nav  <?php  if(!empty($shop['selectgoods'])) { ?>on<?php  } ?>" on="<?php  echo $shop['selectgoods'];?>">
                <nav <?php  if(!empty($shop['selectgoods'])) { ?>class='on'<?php  } ?>></nav>
            </div>
        </div>
        <div class="line"><span>开启自选后，您的小店里只显示您选择的产品</span></div>
        <div id='divselect' <?php  if(empty($shop['selectgoods'])) { ?>style='display:none'<?php  } ?>>
            <div class="line">
                <div class="label">开启分类</div>
                <div id='opencategory' class="nav <?php  if(!empty($shop['selectcategory'])) { ?>on<?php  } ?>"  on="<?php  echo $shop['selectcategory'];?>">
                    <nav <?php  if(!empty($shop['selectcategory'])) { ?>class='on'<?php  } ?>></nav>
                </div>
            </div>
            <div class="line"><span>如果您选择的商品较多，建议您开启与总店同步分类</span></div>
            <div class="line2 pic">
                <div class="plus" onclick="openChooser()"><i class="fa fa-plus"></i> 选择商品</div>
                <div class="images">
                    <%each goods as g%>
                    <div data-goodsid="<%g.id%>" class="good">
                            <div class="img"><img src="<%g.thumb%>"></div>
                            <div class="info">
                                <div class="info_inner">
                                   <div class="name"><%g.title%></div> 
                                   <div class="price">价格:  <span class="marketprice">￥<%g.marketprice%></span>
                                </div>
                             </div>
                             </div>
                          <div onclick="$(this).closest('.good').remove()" class="option"><i class="fa fa-remove fa-2x"></i></div>
                    </div>
                    <%/each%>
                </div>
            </div>
        </div>
    </div>
    <div class="myshop_sub1" id='myshop_submit'>确认</div>
    <div style='height:5px;'></div>
</script>
<script id="tpl_img" type="text/html">
     <img src='<%url%>' tag="<%tag%>" img='<%filename%>'/>
</script>

<script language="javascript">
    
    var category = null;
    var loaded = false;
    var stop = true;
     var def_args = args  = null;
 
    function initArgs(){
            def_args = args  = {
               page:"1",
               isnew: 0,
               ishot: 0,
               isrecommand:0,
               isdiscount:0,
               keywords:'',
               istime:0,
               pcate:0,
               ccate:0,
               tcate:0,
               order:"",
               by:""
        };
        $("#right_container").scrollTop(0);
        $('#keywords').val('');
    }
      function bindCategoryEvents(){
             $(".parent_item").unbind('click').click(function(){
                 $('#right_container').scrollTop(0);
                    $('.parent_item').removeClass('on');
                    $(this).addClass('on');
                      loaded = false;
                      $('#list_loading').remove();
                 var item = $(this);
                      args  = {
                            page:1,
                            isnew: item.data('isnew') || 0,
                            ishot:item.data('ishot') || 0,
                            isrecommand:item.data('isrecommand')  || 0,
                            isdiscount:item.data('isdiscount')  || 0,
                            keywords:$.trim( $('#keywords').val() ) ,
                            istime: item.data('istime')  || 0,
                            pcate: item.data('pcate')  || 0,
                            ccate: item.data('ccate') || 0,
                            tcate: item.data('tcate') || 0,
                            order:"",
                            by:""
                     };
                     getGoods();
             });
             
        }
        var goodsids = [];
        function bindEvents() {
           var bw = $(document.body).width()-90;
            $('#right_container .good').each(function(){
              
                      if($('.images .good[data-goodsid=' + $(this).data('goodsid') + ']').length>0){
                      
                            $(this).attr('on',"1").find('i').removeClass('fa-plus').addClass('fa-check').css('color','#31cd00');;
                      }

                       $(this).unbind('click').click(function(){
                          var on =$(this).attr('on'); 
                          var gid = $(this).data('goodsid');
                          
                           if(on=='1'){
                              $(this).find('i').removeClass('fa-check').addClass('fa-plus').css('color','#999');
                           }
                           else{
                              $(this).find('i').removeClass('fa-plus').addClass('fa-check').css('color','#31cd00');;
                           }
                           on = on=='1'?'0':'1';
                           $(this).attr('on',on);
                           setGoods({
                               'id':$(this).data('goodsid'),
                               'title':$(this).data('title'),
                               'thumb':$(this).data('thumb'),
                               'marketprice':$(this).data('marketprice')
                           },on);
                       })
            })
        }
        function detail(id){
            location.href = "<?php  echo $this->createMobileUrl('shop/detail')?>&id="  + id;
        }
        function setGoods(goods,on){
            var has =false;
            var newgoodsid = [];
            var g = $(".images .good[data-goodsid=" + goods.id + "]");
            if(g.length>0){
                if(on=='1'){
                     return; 
                }
                else{
                  g.remove();
                }
            }
            else{
                if(on=='1'){
                                
                      var html='<div class="good" data-goodsid="' + goods.id+ '">';
            html+='<div class="img" ><img src="' + goods.thumb+'"/></div>';
            html+='<div class="info" >';
                html+='<div class="info_inner">';
                       html+='<div class="name">' + goods.title+ '</div>     ';
                       html+='<div class="price">价格:  <span class="marketprice">￥' + goods.marketprice+ '</div>';
                html+='</div>';
            html+='</div>';
            html+='<div class="option" onclick="$(this).closest(\'.good\').remove()"><i class="fa fa-remove fa-2x"></i>';
            html+='</div>';
        html+='</div>';
                    $('.images').append(html);
                }
            }
        }
        
       function getGoods() {
                require(['tpl', 'core'], function(tpl, core) {
                args.keywords =$.trim( $('#keywords').val() );
                core.json('shop/list', args, function (json) {
              
                if (json.result.goods.length <= 0) {
                    loaded = true;
                    $('#right_container').scroll = null;
                    $('#right_container .inner').html(tpl('tpl_empty'));
                    return;
                }
               
                $('#right_container .inner').html(tpl('tpl_goods_list',json.result));
                bindEvents();
               
               if(json.result.goods.length<json.result.pagesize){
                    loaded = true;
                    $('#right_container').scroll = null;
                    return;
                }
                
                stop =true;
                bindMore();
                
            }, true);
                });
        }
        function getGoodsMore() {
  
        require(['tpl', 'core'], function(tpl, core) {
            core.json('shop/list', args, function (json) {
                var result = json.result;
                 $('#right_container .inner').append(tpl('tpl_goods_list',result));
                bindEvents();
                $('#list_loading').remove();
                if (result.goods.length < result.pagesize) {
                        $('#right_container').append('<div id="list_loading">已经加载全部商品</div>');
                        loaded = true;
                        $('#right_container').scroll = null;
                        return;
                }
                stop=true;
                bindMore(); 
                
            });
        });
        }
          function bindMore() {
     
            $('#right_container').scroll(function () {
 
                if (loaded) {
                    return;
                }
             
                totalheight = parseFloat($('#right_container').height()) + parseFloat($('#right_container').scrollTop());
          
              if (parseFloat($('#right_container').height()) <= totalheight) {
                   
                    if (stop == true) {
                        stop = false;
                         $('#right_container .inner').append('<div id="list_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载更多商品</div>');
                  
                        if(args.page=='' || args.page=='undefined'){
                            args.page = 1;
                        }
                        args.page++;
                      
                        getGoodsMore();
                    }
                }
            });
        }
        
        
    function openChooser(){
        
        initArgs();
             
             if(category!=null){
                  $(".chooser").animate({left: 0}, 200);
                  bindCategoryEvents();
                  return;
             }
              require(['tpl', 'core'], function(tpl, core) {
                 core.json('shop/util',{op:'category'}, function (json) {
                 
                         
                 result = json.result;
                  $('#left_container').html(tpl('tpl_category_list',result));
             
                
                 bindCategoryEvents();
                  $(".chooser").animate({left: 0}, 200,function(){
                       getGoods();
                  });
                
              }, true);
          });
        }
        function closeChooser(){
              $(".chooser").animate({left: "100%"}, 200);
        }
        
        
    require(['tpl', 'core'], function(tpl, core) { 
    
      
           core.pjson('commission/myshop',{op:'select'},function(json){
               
                if(json.status==-1){
                    core.message(json.result,"<?php  echo $this->createPluginMobileUrl('commission/myshop')?>",'error');
                    return;
                }
                  
             $('#container').html(  tpl('tpl_main',json.result) );    
               
               $('div.nav').click(function(){
                    var on = $(this).attr('on');
                    if(on=='1'){
                        $(this).removeClass('on').attr('on','0').find('nav').removeClass('on');
                        if($(this).attr('id')=='opengoods'){
                            $('#divselect').hide(); 
                        }
                    }
                    else{
                        $(this).addClass('on').attr('on','1').find('nav').addClass('on');
                        if($(this).attr('id')=='opengoods'){
                           $('#divselect').show();
                        }
                    }
                })
           
            $('.main').height( $(document.body).height() - 90);
                
                 var bw = $(document.body).width()-90;
                 $('#right_container .inner').width( bw);
                 $('#right_container .search').width( bw);
                      
                            $('#myshop_submit').click(function(){
                         
                             var goodsids=[];
                             $('.images .good').each(function(){
                                 goodsids.push( $(this).data('goodsid') );
                             });
                           var selectgoods = $('#opengoods').attr('on');
                            if(selectgoods=='1' && goodsids.length<=0){
                                core.tip.show('请选择商品');
                                return;
                            }
                                 if($(this).attr('saving')=='1'){
                                   return;
                               }
                               
                             $(this).html('正在处理...').attr('saving',1);
                          
                                core.pjson('commission/myshop',{
                                    op:'select' ,
                                    selectgoods: selectgoods,
                                    selectcategory: $('#opencategory').attr('on'),
                                    goodsids:goodsids
                                 },function(postjson){
                                     $('#myshop_submit').html('确认').removeAttr('saving');
                                     if(postjson.status==1){
                                        location.href = core.getUrl('plugin/commission/myshop');
                                     }
                                     else{
                                      
                                         core.tip.show(postjson.result);
                                     }
                                },true,true);

                           });
                       
           },true);
      
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
