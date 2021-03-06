<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>小店设置</title>
<script src="../addons/sz_yi/static/js/dist/ajaxfileupload.js" type="text/javascript"></script>
<style type="text/css">
    body {margin:0px; background:#efefef; font-family:'微软雅黑'; -moz-appearance:none;}
    a {text-decoration:none;}
    .myshop_addnav {height:44px; width:94%; padding:0 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:42px; color:#666; background:#fff;}
    .myshop_addnav {height:40px; width:94%; padding:0 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; line-height:40px; color:#666; }
.myshop_main {height:auto; padding:0px 3%; border-bottom:1px solid #f0f0f0; border-top:1px solid #f0f0f0; margin-top:14px; background:#fff;}
.myshop_main .line {height:44px; width:100%; border-bottom:1px solid #f0f0f0; line-height:44px;}

.myshop_main .line .label { float:left;width:70px;color: #999;height: 44px;line-height: 44px;font-size: 14px}
.myshop_main .line .info { float:right; width:100%; margin-left:-75px;text-align: right;overflow:hidden;height:44px;}
.myshop_main .line .info .inner { color:#666;margin-left:75px;}

.myshop_main .line1 {height:80px; width:100%; border-bottom:1px solid #f0f0f0; line-height:80px;}
.myshop_main .line1 .label { float:left;width:70px;color: #999;height:80px;line-height: 80px;font-size: 14px}
.myshop_main .line1 .info { float:right; width:100%; margin-left:-75px;;overflow:hidden;height:80px;}
.myshop_main .line1 .info .inner { color:#666;margin-left:75px;padding-top:10px;}
.myshop_main .line1 .info .inner .plus { float:left;width:60px;height:60px;border:1px solid #efefef; color:#efefef;; font-size:45px;line-height:55px;text-align:center;}
.myshop_main .line1 .info .inner .plus1 { float:left;width:90%;height:60px;border:1px solid #efefef; color:#efefef;; font-size:45px;line-height:55px;text-align:center;}

.myshop_main .line1 .info .inner .preview1,.myshop_main .line1 .info .inner .preview0{ position:absolute; width:100%;height:100%;z-index:2;top: -2px;left: 0;border:0}

.myshop_main .line1 .info .inner .preview0 img,.myshop_main .line1 .info .inner .preview1 img { width:100%;height:100%;border: 0}

.myshop_main .line input {float:left; height:30px;width:100%; border:0px; outline:none; font-size:16px; color:#666;padding-left:5px;margin-bottom: -5px}
.myshop_main .line select  {float:left; border:none;height:25px;width:100%;color:#666;font-size:16px;margin-top:10px;}
.myshop_sub1 {height:44px; width:94%; margin:14px 3% 0px; background:#e45050; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
.myshop_sub2 {height:44px; width:94%; margin:14px 3% 0px; background:#ddd; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#666; border:1px solid #d4d4d4;}

.myshop_main .line2 {width:100%;  line-height:25px; color:#666;overflow:hidden; font-size:13px;word-break: break-all;}

textarea {height:60px;line-height:22px; width:100%;padding:5px;font-size:13px; background:#fff; padding-left:2%; border:1px solid #e9e9e9; margin:14px 0px 0; -webkit-appearance: none;} 
.myshop_menu {height:44px; background:#fff;}
.myshop_menu .nav {height:44px; width:50%; border-bottom:1px solid #f1f1f1;background:#fff; border-left:1px solid #f1f1f1; float:left; line-height:44px; font-size:14px; color:#666; text-align:center;}
.myshop_menu .navon {color:#e45050; border-bottom:2px solid #e45050;}
  
</style>
<div id='container'></div>

<script id='tpl_main' type='text/html'>
   <div class="page_topbar">
    <a href="javascript:;" class="back" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/myshop')?>'"><i class="fa fa-angle-left"></i></a>
    <div class="title">小店设置</div>
</div>
    <%if shop.openselect%>
    <div class="myshop_menu">
            <div class="nav navon" style="border-left:0px;width:49%;" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/myshop',array('op'=>'set'))?>'">基本信息</div>
            <div class="nav"  onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/myshop',array('op'=>'select'))?>'">自选商品</div>
    </div>
  <%/if%>    
    
 <div class="myshop_main" >
     
     <input type="hidden" id="img0" />
     <input type="hidden" id="img1" />
        <div class="line"><div class="label">小店名称</div><div class="info"><div class="inner"><input type="text" id="shopname" value="<%shop.name%>"/></div></div></div>
        <div class="line1"><div class="label">小店头像</div><div class="info"><div class="inner">
                    <div class="plus" style="position:relative;">
                        <input type="file" data-tag="0" name='imgFile0' id='imgFile0' style="position:absolute;left:0;z-index:3;width:60px;height:60px;-webkit-tap-highlight-color: transparent;filter:alpha(Opacity=0); opacity: 0;" />
                        <i class="fa fa-plus"  style="position:absolute;top:10px;right:12px;z-index:1"></i>
                        <div id="preview0" class="preview0">
                            <%if shop.logo!=''%><img src='<%shop.logo%>' /><%/if%>
                        </div>
                    </div>
                    
                </div></div></div>
                <div class="line1">
                    <div class="label">小店店招</div>
                    <div class="info">
                        <div class="inner">
                            <div class="plus1" style="position:relative;">
                                <input type="file" data-tag="1" name='imgFile1' id='imgFile1' style="position:absolute;left:0;z-index:3;width:100%;height:60px;-webkit-tap-highlight-color: transparent;filter:alpha(Opacity=0); opacity: 0;" />
                                <i class="fa fa-plus"  style="position:absolute;top:10px;right:40%;z-index:1"></i>
                                <div id="preview1" class="preview1">
                                    <%if shop.img!=''%><img src='<%shop.img%>' /><%/if%>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="line2"><textarea id="desc" placeholder="小店简介,分享你的小店"><%shop.desc%></textarea></div>
    </div>
    <div class="myshop_sub1" id='myshop_submit'>确认</div>
</script>
 <script id="tpl_img" type="text/html">
     <img src='<%url%>' tag="<%tag%>" img='<%filename%>'/>
</script>

<script language="javascript">
    
    require(['tpl', 'core'], function(tpl, core) {
       
           core.pjson('commission/myshop',{op:'set'},function(json){
                
                  
                         $('#container').html(  tpl('tpl_main',json.result) );    
               
                      
                            $('#myshop_submit').click(function(){
                               if($(this).attr('saving')=='1'){
                                   return;
                               }
                               
                                $(this).html('正在处理...').attr('saving',1);
                                var shopdata = {
                                        name: $('#shopname').val(),
                                        desc: $('#desc').val()
                                }
                                if(!$('#img0').isEmpty()){
                                    shopdata.logo = $('#img0').val();
                                }
                                if(!$('#img1').isEmpty()){
                                    shopdata.img = $('#img1').val();
                                }
                                    
                                core.pjson('commission/myshop',{
                                    op:'set',
                                    shopdata:shopdata
                                 },function(postjson){
                                     if(postjson.status==1){
                                        location.href = core.getUrl('plugin/commission/myshop');
                                     }
                                     else{
                                         $(this).html('确认').removeAttr('saving');
                                         core.tip.show('操作失败');
                                     }
                                },true,true);

                           });
                           
                            //上传图片
            $('input[type=file]').change(function() {

                core.loading('正在上传');
                
                var tag= $(this).data('tag');
               
                $.ajaxFileUpload({
                    url: core.getUrl('util/uploader'),
                    data: {file: "imgFile" + tag},
                    secureuri: false, //异步
                    fileElementId: 'imgFile'+ tag, //上传控件ID
                    dataType: 'json', //返回的数据信息格式
                    success: function(res, status) {
                        core.removeLoading();
                        var obj = $(tpl('tpl_img', res));
                        $('.preview' + tag).html(obj);
                        $('#img' + tag).val( res.filename );
                    }, error: function(data, status, e) {
                        core.removeLoading();
                        core.tip.show('上传失败!');
                    }
                });
            });
                   
           },true);
      
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
