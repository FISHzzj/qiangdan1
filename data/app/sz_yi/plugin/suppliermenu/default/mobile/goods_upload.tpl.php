<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<title>发布宝贝</title>
 <script type="text/javascript" src="<?php echo MODULE_URL.'plugin/suppliermenu/res/dropload.min.js?'.time();?>"></script>
 <script type="text/javascript" src="<?php echo MODULE_URL.'plugin/suppliermenu/res/baidu.js?'.time();?>"></script> 
<script type="text/javascript" src="<?php echo MODULE_URL.'plugin/suppliermenu/res/jquery.form.js?'.time();?>"></script>
<script src="../addons/sz_yi/static/js/dist/ajaxfileupload.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo MODULE_URL.'plugin/suppliermenu/res/s.js?'.time();?>"></script>
<script type="text/javascript">
  System.config({
    map:{
      systemJsText:'<?php  echo MODULE_URL.'plugin/suppliermenu/res/txt.js';?>',
      systemJsCss:'<?php  echo MODULE_URL.'plugin/suppliermenu/res/css.js';?>',
      systemJsJson:'<?php  echo MODULE_URL.'plugin/suppliermenu/res/json.js';?>'
    },
    baseURL: '<?php  echo MODULE_URL.'plugin/suppliermenu/res/';?>',
  });

System['import']('<?php  echo MODULE_URL.'plugin/suppliermenu/res/css/goods_upload.css!systemJsCss';?>').then(function (a){});
 
System['import']('<?php  echo MODULE_URL.'plugin/suppliermenu/res/tpl/tpl-pcate-box.html!systemJsText';?>').then(function (a){$("body").append(a)});
System['import']('<?php  echo MODULE_URL.'plugin/suppliermenu/res/tpl/tpl-ccate-box.html!systemJsText';?>').then(function (a){$("body").append(a)});
System['import']('<?php  echo MODULE_URL.'plugin/suppliermenu/res/tpl/tpl-tcate-box.html!systemJsText';?>').then(function (a){$("body").append(a)});
System['import']('<?php  echo MODULE_URL.'plugin/suppliermenu/res/tpl/tpl-img-box.html!systemJsText';?>').then(function (a){$("body").append(a)});

 

</script>
<style type="text/css">
  body{background: #f2f2f2;}
  .page_topbar{background: #fff;}
  input{outline: none!important;}
  #upload_img>li>#select-box{top:10px;margin:0;}
  #upload_img>li>#img-box{top: 10px;}
  .box{background: #fff;}
  #line-box#line-box{margin-top: 0;border-bottom:none;}
  #line-box ul>li{border-bottom: 1px solid #eaeaea;color:#656565;}
  #footer>span:nth-child(1){background: #1bbcf2;}
  #footer>span:nth-child(2){background: #e45050;}
  #content-box{border:none;text-align: left;}
</style>

<script type="text/html" id="tpl-big-body">
<div id="big_body" >
<form method="post" enctype="multipart/form-data" id="showDataForm">
   <!--  <div class="customer_top">
		<div class="title" onclick='history.back()'><span class="back">&lt;</span>返回</div>
		<div class="title1">
			发布宝贝
		</div>
	</div> -->
  <div class="page_topbar">
    <a href="#" class="back" onclick="history.back()">
      <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
    </a>
    <div class="title" style=" color: #282828;">发布宝贝</div>
    <a href="#">
        <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
    </a>
  </div>
    <ul id="upload_img" class="box">
        <li style="text-align: left;">
            <span style="color:#656565;line-height: 88px;text-align: left;">商品图片:</span>
        </li>
        <li>

            <div id="select-box">
                <div style="font-size:30px;">+</div>
                <div style="font-size:10px;">添加图片</div>
                <input type="file" id="file" name="files[]"  accept="image/*;capture=camcorder" onchange="handleFiles(this)" multiple="true" />
            </div>
        </li>
    </ul>
    <div id="line-box" class="box">
        <ul>
			<li>
                <span>商品标题：</span>
                <div>
					<input type="text" name="title" value="<%if status%><%goods.title%><%/if%>" placeholder="输入商品标题">
                </div>
			</li>
            <li>
                <span>现<i></i>价：</span>
                <div>
                    <input type="text" name="marketprice" value="<%if status%><%goods.marketprice%><%/if%>" placeholder="0.00" />
                </div>
            </li>
            <li>
                <span>原<i></i>价：</span>
                <div>
                    <input type="text" name="productprice" value="<%if status%><%goods.productprice%><%/if%>" placeholder="0.00" />
                </div>
            </li>
            <li>
                <span>成<i></i>本：</span>
                <div>
                    <input type="text" name="costprice" value="<%if status%><%goods.costprice%><%/if%>" placeholder="0.00" />
                </div>
            </li>
            <li  id="ckcsify">
                <span>分<i></i>类：</span>
				        <span id="getback"></span>
                <span>></span>
            </li>
            <li>
                <span>运<i></i>费：</span>
                <div>包邮</div>
            </li>
            <li>
                <span>库<i></i>存：</span>
                <div>
					<input  type="text" name="total" value="<%if status%><%goods.total%><%/if%>">
				</div>
            </li>
            <li>
                <span>重<i></i>量：</span>
                <div >
					<input  type="text" name="weight" value="<%if status%><%goods.weight%><%/if%>"> 
				</span>
            </li>
        </ul>
    </div>
    <div id="content-box" class="box">
        <div onclick="
            $('#big_body').hide();
            System['import']('<?php  echo MODULE_URL.'plugin/suppliermenu/res/tpl/tpl-cotent1.html!systemJsText';?>').then(function (html){
              console.log(html)
                $('body').append(  baidu.template(html)  ); 
                $('#content').html( $('input[name=\''+'content'+'\']').val() );
            });
            
          ">
            <p style="height:40px;line-height:40px;">宝贝描述 
			<span style="font-weight: bold;margin-right:10px;float:right; font-size: 16px;line-height: 40px; font-family:serif,'PingFang SC', Helvetica, 'Helvetica Neue', '微软雅黑', Tahoma, Arial, sans-serif;">&gt;</span></p>
        </div>
    </div>
    <div id="footer">
        <span onclick='a(0);'>放入仓库</span>
        <span onclick='a(1);'>立即上架</span>
    </div>
    <input type="hidden" name="content" value="<%if status%><%goods.content%><%/if%>" />
    <input type="hidden" name="pcate" value="<%if status%><%goods.pcate%><%/if%>" />
    <input type="hidden" name="ccate" value="<%if status%><%goods.ccate%><%/if%>" />
    <input type="hidden" name="tcate" value="<%if status%><%goods.tcate%><%/if%>"/>
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
</form>

</div>
</script>

<script type="text/html" id="tpl-loading">
    <div id="loading" style="position: absolute; top:0px; left:0px; width:100%;padding-top:200px; text-align: center; height:100%; ">
         <img   src="<?php echo MODULE_URL.'plugin/suppliermenu/res/loading.gif?'.time();?>"/>
    </div>
</script>

<script type="text/javascript">
    require(['tpl', 'core'], function(tpl, core) {
       core.pjson('suppliermenu/goods', {id:'<?php echo empty($_GPC['id'])?0:$_GPC['id'];?>',op:'post','ac':'get' }, function(json) {
              
            $('body').append(tpl('tpl-big-body',json.result));

			$("#ckcsify").click(function(){
				var that= this;
				pcate(that);
			});
            if(json.result.status){
                $("#select-box").parent().before( baidu.template('tpl-img-box',{data:{img:json.result.goods.thumb}}  ));

                for(var x in json.result.goods.thumb_url ){
                    $("#select-box").parent().before( baidu.template('tpl-img-box',{data:{img:json.result.goods.thumb_url[x]}}  ));
                }
            }
       }, true,true);
    });
</script>

<script type="text/javascript">
require(['tpl', 'core'], function(tpl, core) {
	$(document).on('change','#imgfile',function(){
        core.loading('正在上传');
        $.ajaxFileUpload({
            url: core.getUrl('util/uploader'),
            data: {file: "describe"},
            secureuri: false, 
            fileElementId: 'imgfile', 
            dataType: 'json', 
            success: function(res, status) {
                console.log(res);
                core.removeLoading();                              								 	
                var img = document.createElement("img");
        		img.src = res.url;
				$('.msbox').append( img );
            },
            error: function(data, status, e) {
                core.removeLoading();
                core.tip.show('上传失败!');
            }
        });
    });
})
    function  handleFiles(q)
    {
      var files =  q.files;
      if(files.length)
      {
          console.log(files.length);
          for(var x =0 ;x<files.length;x++ ){
             var file = files[x];
             if(!/image\/\w+/.test(file.type)){
                  alert("文件必须为图片！"+file.type);
                  return ;
             }
          }
          $.ajaxFileUpload({  
              url:'<?php  echo $this->createPluginMobileUrl('suppliermenu/goods',array( 'op'=>'upload')) ;?>',  
              secureuri:false,  
              fileElementId:$(q).attr('id'), //file的id  
              dataType:"text", // 返回数据类型为文本  
              success:function(data,status){  
                console.log(data);
                console.log(status);
                  var obj = JSON.parse(data);
                  for(var x in obj.result.url){
                    $("#select-box").parent().before( baidu.template('tpl-img-box',{data:{img:obj.result.url[x]}}  ));
                  }   

              }  
          }) ;
      }
    }
</script>

<script type="text/javascript">
	var ol1,ol2,ol3;

function pcate(){
    $('#big_body').hide();
    require(['tpl', 'core'], function(tpl, core) {
       core.pjson('suppliermenu/cate', {type:0}, function(json) {
            console.log(json);
            $('body').append(tpl('tpl-pcate-box',json.result));
       }, true);
    });
}


function ccate(a){
	ol1=$(a).text();
    $('#big_body').hide();
    $("input[name='pcate']").val($(a).attr('id'));

    require(['tpl', 'core'], function(tpl, core) {
       core.pjson('suppliermenu/cate', {type:$(a).attr('id')}, function(json) {
        console.log(json.result)
             if(json.result.status){
                  $('body').append(tpl('tpl-ccate-box',json.result));
             }else{
                  /*core.tip.show('没有下级分类');*/
                      ol1=$(a).text();
                      $('.big_body').hide();
                      $('#big_body').show();
                      $("input[name='pcate']").val($(a).attr('id'));
                      $("#getback").text(ol1);
                      return ol1
             }
       }, true);
    });

}

function ccate2(a){
  ol2=$(a).text();
    $('#big_body').hide();
    $("input[name='ccate']").val($(a).attr('id'));

    require(['tpl', 'core'], function(tpl, core) {
       core.pjson('suppliermenu/cate', {type:$(a).attr('id')}, function(json) {
        console.log(json.result)
             if(json.result.status){
              console.log()
                  $('body').append(tpl('tpl-tcate-box',json.result));
             }else{
                  /*core.tip.show('没有下级分类');*/
                  ol2=$(a).text();
                  $('.big_body').hide();
                  $('#big_body').show();
                  $("input[name='ccate']").val($(a).attr('id'));
                  $("#getback").text(ol1+"-"+ol2);
                  return ol1+"-"+ol2
             }
       }, true);
    });

}


function tcate(a){
	ol3=$(a).text();
	console.log(ol1+"-"+ol2+"-"+ol3);
    $('.big_body').hide();
    $("input[name='tcate']").val($(a).attr('id'));
  	$("#getback").text(ol1+"-"+ol2+"-"+ol3);
  	return ol1+"-"+ol2+"-"+ol3;
}

function dataURLtoBlob(dataurl) {
    var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], {type:mime});
}
 

 function a(status){
 
      require(['tpl', 'core'], function(tpl, core) { 
        $('#big_body').append(tpl('tpl-loading')); 

        var data = {};
        if($("input[name='title']").val()==''){
          $("#loading").remove();
          core.tip.show('商品标题不能为空');
          return;
        }

        data['title'] = {data:[$("input[name='title']").val()]};
 
        if($("input[name='marketprice']").val()==''){
          $("#loading").remove();
          core.tip.show('市场价不能为空');
          return;
        }
        data['marketprice'] = {data:[$("input[name='marketprice']").val()]};

        /*if($("input[name='productprice']").val()==''){
          $("#loading").remove();
          core.tip.show('原价不能为空');
          return;
        }*/

        data['productprice'] = {data:[$("input[name='productprice']").val()]};

        /*if($("input[name='costprice']").val()==''){

          $("#loading").remove();
          core.tip.show('成本价不能为空');
          return;
        }*/

        data['costprice'] = {data:[$("input[name='costprice']").val()]};
        var files = new Array();
        $("input[name='file[]']").each(function(){
            files.push($(this).val());
        });

        data['post[]'] = {data:files };

 
        if($("input[name='pcate']").val()==''){
             $("#loading").remove();
             core.tip.show('分类不能为空');
             return;
        }

        data['pcate'] = {data:[$("input[name='pcate']").val()]};

        if($("input[name='ccate']").val()==''){
             $("#loading").remove();
             core.tip.show('分类不能为空');

             return;
        }

        data['pcate']   = {data:[$("input[name='pcate']").val()]};
        data['ccate']   = {data:[$("input[name='ccate']").val()]};
        data['tcate']   = {data:[$("input[name='tcate']").val()]};
        data['content'] = {data:[$("input[name='content']").val()]};
        data['status']  = {data:[status]};
        data['total']   = {data:[$("input[name='total']").val()]};
        data['weight']  = {data:[$("input[name='weight']").val()]};

        System['import']('<?php  echo MODULE_URL.'plugin/suppliermenu/res/js/FormData.js';?>').then(function (a){
            var fd =  a.append( data);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php  echo $this->createPluginMobileUrl('suppliermenu/goods',array( 'op'=>'post','ac'=>'sub','id'=>$id)) ;?>', true);
            xhr.send(fd);
            xhr.onreadystatechange=function(){
              if (xhr.readyState==4 && xhr.status==200)
              { 
                    var obj = JSON.parse(xhr.responseText);
                    console.log(obj);
                    if(!obj)  {core.tip.show('提交失败');return;}
                    if(!obj.result.status) {core.tip.show(obj.result.msg); return;}
                    alert('成功');
                    window.location.href = '<?php  echo  $this->createPluginMobileUrl('suppliermenu/goods');?>';

              }
            };
            $("#loading").remove();
        });
     });
}

</script>
<!--编辑文字图片-->
<script type="text/javascript">

//	function ProcessFile( that ) { 
//	      var file = that.files;
//		    //console.log(file)
//		if ( file ) {
//			for(var i=0;i<file.length;i++) {
//			   var filetyle=file[i].type;
//		       console.log(filetyle);
//		       if (filetyle.indexOf('image')!=-1) {
//		       	      var reader = new FileReader();
//				      reader.readAsDataURL( file[i] );
//					reader.onload = function ( event ) { 
//						 console.log(event);
//						var txt = event.target.result;
//						var img = document.createElement("img");
//						img.src = txt;						
//						$('.msbox').append( img );					
//				  };		       			       	
//		        } else{
//		       	   alert('请选择图片')
//		       }
//						
//		    } 
//
//		}
//		
// };
// $(document).on('change','#file',function(){
// 	    ProcessFile(this);
// });

</script>
