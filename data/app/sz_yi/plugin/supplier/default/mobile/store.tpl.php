<?php defined('IN_IA') or exit('Access Denied');?><!-- 14542 -->
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>



<script>window.PointerEvent = undefined</script>
<?php  if($op == 'list') { ?>
<title>商家列表</title>

<style type="text/css">
	html,body{
		width:100%;
		height: 100%;
		margin: 0;
		padding: 0;
		overflow-x: hidden;	
		overflow-y: auto;	
	}
	::-webkit-scrollbar {width: 3px;}
	::-webkit-scrollbar-track { -webkit-box-shadow: inset 0 0 6px rgba(238,238,238,0.3); border-radius: 10px;}
	::-webkit-scrollbar-thumb {border-radius: 10px;    background: rgba(0,0,0,0.1);-webkit-box-shadow: inset 0 0 6px rgba(238,238,238,0.4);}
	/*.headermes{
		width: 100%;
		height: 54px;
		display: flex;
		display: -webkit-flex;
		align-items: center;
		-webkit-align-items: center;
		background: #eee;
		
	}
	.headermes 	input{
		width: 86%;
		height:40px;	
		border-radius:5px ;
		padding-left:12px ;
		border: 1px solid #ccc;
		display: flex;
		margin-top: 3px;
		align-items: center;
		display: -webkit-flex;
		-webkit-align-items: center;
		line-height: 40px;
		
	}*/
	#inputsele::-webkit-input-placeholder{
		color: #555;
		font-weight: 650;
		font-size: 16px;
		
	}
	.contents .contents_list{
		height: 91px;
		border-bottom: 1px solid #eee;
		width: 92%;
		margin: 0 auto;
		line-height: 91px;
	}


	.contents_list >div{
	   float: left;
	}
	
	.contents_list_left{
		display: flex;
		display: -webkit-flex;
		justify-content: center;
		-webkit-justify-content: center;
		width:80%;
		height:80px;
		
	
	}
	.contents_list_rigth{
		width: 20%;
		height:91px;
		line-height:91px;
	}	
	#spanbtn{
		display:inline-block;
		width:95%;
		height: 30px;
		color: #31A4F0;
		border: 1px solid #029fea;
		text-align: center;
		line-height: 30px;
		border-radius:15px ;
	}
	.contents_list_img{
		width:48px;
		height:48px;
		
	}
	.contents_list_img img{
		width: 100%;
		height: 100%;
	}
	.contents_list_text{
		width: 83%;
		padding-left: 8px;
		font-size: 13px;
		color: #555;
		margin-top: 18px;
		
	}
	.contents_list_text li{
		list-style: none;
		line-height:30px;
		display:block;
		white-space:nowrap; 
		overflow:hidden; 
		text-overflow:ellipsis;
	}
	.contents_list1{
		padding: 16px 0;
		width: 100%;
		margin: auto;
		display:flex;
		display: -webkit-flex;
		justify-content: center;
		-webkit-justify-content: center;
	}
	.contents_list1 a{
		display: flex;
		display: -webkit-flex;
		justify-content: center;
		-webkit-justify-content: center;
		width: 33%;
		height:123.75px;
	}
	.contents_list1 img{
		width: 86%;
		height: 86%;
	}
	.customer_top {height:44px; width:100%;}
    .customer_top .title {height:28px; width:10%; float:left; font-size:16px; line-height:44px; color:#000;}
    .back{width: 15px;height: 30px;font-size: 28px;border-radius: 50%;float: left;line-height: 46px;text-align: center; font-family: arial, helvetica, sans-serif;}
	#container{padding-bottom: 18px;}
	.headermes {height:40px; width:100%; margin:5px 4px; background:transparent; color:#555; line-height:40px; font-size:14px;z-index: 999;}


	/* 新版 */
	.swiper-wrapper img{width: 100%;}
	.dropdown-menu{position: fixed;top:82px;border:0px;}
	.f-colorRed{color: #e45050;}
	.block-slider ul li.u-indexActive .object-name{color:#e45050;}
	.block-slider ul li.u-indexActive{border-bottom: 1px solid #e45050; }
	.f-colorgray{color:#a5a5a5}
	a{color:#282828;}
	.dropdown-menu{z-index: 99999;}
	.shopList li{margin:0 0 5px 0;}
	.shopList p { margin: 0 0 0px;}
	.u-goshop{top: 20px;border: 1px solid #e45050;color:#e45050;}
	.juli{top: 66px;}
	.big{position: relative;}
	a:hover, a:focus{text-decoration: none;}
	#iscroll01{background: white;}
	.form-control:focus{border:0px !important;box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 1px 1px rgba(0,0,0,.075);}

	
</style>

	<div class="page_topbar">
		<a href=" " class="back" onclick="history.back()">
	    <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
	  </a>
		<div class="title" style=" color: #282828;">商家列表</div>
	  <a href="#">
	      <i class="iconfont  headerRightIcon" style="color: #282828;">&#xe60a;</i>
	  </a>
	</div>
	<div class="content" style="margin-top: 0px;">
		<div class="big">
		      	<!-- 搜索框 -->
			      	<div class="m-searchDiv">
			      	  	<div class="fl f-relative" style="width: 30%;">
			      	  		<div class="bs-chinese-region flat dropdown" data-submit-type="id" data-min-level="1" data-max-level="3">
			      	  			<!-- <input type="text" class="form-control" name="address" id="address" placeholder="定位中" data-toggle="dropdown" readonly="" value="440100"> -->
			      	  			<input type="text" class="form-control" name="address" id="address" placeholder="定位中" data-toggle="dropdown" readonly="" value="" data-dingwei="0">
			      	  			<div class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			      	  				<div>
			      	  					<ul class="nav nav-tabs" role="tablist">
			      	  						<li role="presentation" class="active"><a href="#province" data-next="city" role="tab" data-toggle="tab">省份</a></li>
			      	  						<li role="presentation"><a href="#city" data-next="district" role="tab" data-toggle="tab">城市</a></li>
			      	  						<li role="presentation"><a href="#district" data-next="street" role="tab" data-toggle="tab">县区</a></li>
			      	  					</ul>
			      	  					<div class="tab-content">
			      	  						<div role="tabpanel" class="tab-pane active" id="province">--</div>
			      	  						<div role="tabpanel" class="tab-pane" id="city">--</div>
			      	  						<div role="tabpanel" class="tab-pane" id="district">--</div>
			      	  					</div>
			      	  				</div>
			      	  			</div>
			      	  		</div>     	  		
			      	  		<i class="iconfont f-col333 spanIcon" style="font-size: 13px;">&#xe61f;</i>
			      	  	</div>
			      	  	<input type="text" class="searchInput fl "   placeholder="输入店铺名称">
			      	  	<div class="fr search" style="margin-top: 5px;"  id='search' >
			      	  		<i class="iconfont f-col333 searchIcon">&#xe699;</i>
			      	  	</div>

			      	  	<div class="f-cb"></div>
			      	</div>
		<!-- 轮播图 -->
		<div class="swiper-container f-relative" data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="1000">
			<div class="swiper-wrapper">
			    <div class="swiper-slide"><img src="../addons/sz_yi/template/mobile/style1/static/images/lunbo1.png" alt=""></div>
			    <div class="swiper-slide"><img src="../addons/sz_yi/template/mobile/style1/static/images/lunbo2.jpg" alt=""></div>
			    <div class="swiper-slide"><img src="../addons/sz_yi/template/mobile/style1/static/images/lunbo3.png" alt=""></div>
			</div>
	      	<div class="swiper-pagination"></div>     	
		</div>
		<!--搜索-->
		<div class="search1"> 
		    <div class="topbar1">
		        <div class='right'>
		            <button class="sub1"><i class="fa fa-search"></i></button>
		            <div class="home1">取消</div>
		        </div>
		        <div class='left_wrap'> 
		            <div class='left'>
		                <input type="text"   id='keywords' class="input1"   placeholder='请输入店铺名'/>
		            </div>
		        </div>
		    </div>
		    <div id='search_container' class='result1'>
		    </div>
		   
		</div>
	</div>


		<!-- 分类 -->
		<div class="block block-slider block-slider4 iscroll info" id="iscroll01">
			<div class="scroller">
				<ul>					
					<li class="u-indexActive">
						<a href="javascript:void(0);" >
							<span class="object-name u-shengluehao">全部</span>
						</a>
					</li>
					<?php  if(is_array($supplier_cate)) { foreach($supplier_cate as $row) { ?>
					<li cate_id="<?php  echo $row['id'];?>">
						<a href="javascript:void(0);" class="u-shengluehao" >
							<span class="object-name u-shengluehao" ><?php  echo $row['name'];?></span>
						</a>
					</li>
					<?php  } } ?>
				</ul>
			</div>
		</div>	

		<!-- 商家列表 -->
		<div>
			<ul class="shopList">
				
			</ul>
			<!-- <div class="weui-loadmore">
			  <i class="weui-loading"></i>
			  <span class="weui-loadmore__tips">正在加载</span>
			</div> -->
		</div>

		<div id="allmap"></div>

		

	</div>
<!-- 商家列表 -->
<!-- <script id='tpl_list' type='text/html'>
    
       <%each list as sl%>

		<li>
			<a  href="<%sl.url%>">
				<img src="../addons/sz_yi/template/mobile/style1/static/images/bg4.png" alt="" class="logo">
				<p class="f-fsize16"><%sl.storename%</p>
				<p class="f-fsize13 f-colorgray">惊喜不断的吃货平台</p>
				<p class="f-fsize12 f-colorRed">销量：
					<span class="f-marginR10"><%sl.to ? sl.to : 0%></span>
					共<span><%sl.goodstatol%></span>件商品
				</p>
				<div class="u-btn u-goshop">去购物</div>
				<div class="juli" data-alon="113.297094" data-alon="23.179881">定位中</div>
			</a>
		</li>



        <div class="contents" style="margin-bottom: 10px;background: #fff;">
		 <%if sl.goods.length>0%>
		<div class="contents_list1">
		 <%each sl.goods as item%>
			<a href="<%item.gurl%>"><img src="<%item.thumb%>"/></a>	       
		 <%/each%>
			 <%if sl.goods.length<2%>
			    <a href ='javascript:void(0)'><img src='/addons/sz_yi/plugin/supplier/template/mobile/default/img/6.jpg'/></a>
			    <a href ='javascript:void(0)'><img src='/addons/sz_yi/plugin/supplier/template/mobile/default/img/6.jpg'/></a>
			    <%else if sl.goods.length<3%>
			    <a href ='javascript:void(0)'><img src='/addons/sz_yi/plugin/supplier/template/mobile/default/img/6.jpg'/></a>
			 <%/if%>
		</div>
		 
		<%else%>
		<div class="contents_list1">
			<a href ='javascript:void(0)'><img src='/addons/sz_yi/plugin/supplier/template/mobile/default/img/no_good.png'/></a>
			<a href ='javascript:void(0)'><img src='/addons/sz_yi/plugin/supplier/template/mobile/default/img/no_good.png'/></a>
			<a href ='javascript:void(0)'><img src='/addons/sz_yi/plugin/supplier/template/mobile/default/img/no_good.png'/></a>			
		</div>
		<%/if%>
    <%/each%>
    
</script> -->

<!-- 商家列表 -->
<script id='tpl_list1' type='text/html'>   
		<li>
			<a data-href="url">
			<img  data-src="store.logo" alt="" class="logo">
			<p class="f-fsize16" data-content="storename" style="color: #282828;"></p>
			<p class="f-fsize13 f-colorgray" data-content="description"></p>
			<p class="f-fsize12" style="color: #282828;margin-top: 4px;">销量：
				<span class="f-marginR10" data-content="to"></span>
				共<span data-content="goodstatol"></span>件商品
			</p>
			<div class="u-btn u-goshop">去购物</div>
			<div class="juli" data-value="lat" data-alt="lng">定位中</div>
			<input type="hidden" data-value="lat" data-alt="lng" class="juliInput"></input>
			</a>
		</li>   
</script>



<!-- 空 -->
<script id='tpl_empty' type='text/html'>
    <div class="log_no">
        <i class="fa fa-file-text-o" style="font-size:100px;"></i><br><br>
        <span style="line-height:18px; font-size:16px;">您还没有相关 ~</span>
    </div>
</script>
<!-- 搜索 -->
<script id='tpl_search_list' type='text/html'>
     <ul>
	     <%each list as value%>
			<li><i class="fa fa-angle-right"></i> <a href="<%value.url%>"><%value.storename%></a></li>
	     <%/each%>
    </ul>      	
</script>
<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/bootstrap.js"></script>
<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/bootstrap-chinese-region.js"></script>
<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/iscroll.js"></script>
<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/swiper.min.js"></script>
<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/jquery.loadTemplate.min.js"></script>
<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/jquery-weui.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=fgLe6PL2rbdcBi904tBIaMsUGhAT5P0j"></script>
<script>


$(function(){

		     /*地址*/
		    $.getJSON('../addons/sz_yi/template/mobile/style1/static/js/sql_areas.json',function(data){
				for (var i = 0; i < data.length; i++) {
					var area = {id:data[i].id,name:data[i].cname,level:data[i].level,parentId:data[i].upid};
						data[i] = area;
				}
				$('.bs-chinese-region').chineseRegion('source',data);
			});


		    /*定位*/
	 		var map = new BMap.Map("container"); //初始化地图类  
	 		var geolocation = new BMap.Geolocation();  
	 		// 创建地理编码实例      
	 		var myGeo = new BMap.Geocoder();      
	 		geolocation.getCurrentPosition(function(r){  
	 		if(this.getStatus() == BMAP_STATUS_SUCCESS){  
	 		var pt = r.point;   
	 		$("#address").attr("lngss",pt.lng);
	 		$("#address").attr("latss",pt.lat);
	 		
	 		// 根据坐标得到地址描述    
	 		myGeo.getLocation(pt, function(result){      
	 			if (result){   
	 					/*alert(pt.lng);
	 					alert(pt.lat);*/
	 					var addComp = result.addressComponents; 
	 					console.log(result)
	 					var province= addComp.province;
	 					var city= addComp.city;
	 					var district= addComp.district;
	 					var address=addComp.province+"-"+city+"-"+district;
	 					$("#address").val(addComp.district)
	 					$("#address").attr("data-address",address) 
	 				  	
	 				}  

	 				var keyword = $(".searchInput").val();	
	 				var cate_id = "";
	 				var dingwei = $("#address").attr("data-dingwei");

	 				setTimeout(function(){
	 					var address = $("#address").attr("data-address");
	 					loadData(keyword,address,cate_id,dingwei,0);
	 				},1500);

	 				 
	 		   })  
	 		 };
	 	});


	 		



	/*0定位  1不定位*/
	var dingwei = 0;


	$(".search").on("click",function(){
		
		var keyword = $(".searchInput").val();
		var address = $("#address").attr("data-address");
		var cate_id = "";
		var dingwei = $("#address").attr("data-dingwei");	
		loadData(keyword,address,cate_id,dingwei,0);


	})
	
	

	$(".scroller li").on("click",function(){		
		var keyword = $(".searchInput").val();
		var cate_id = $(this).attr("cate_id");
		var address = $("#address").attr("data-address");
		/*$("#address").attr("dingwei",0);*/
		var dingwei = $("#address").attr("data-dingwei");
		loadData(keyword,address,cate_id,dingwei,0);
	})




	/*var page = 0;
	var pageSize = 3;*/

	function loadData(keyword,address,cate_id,dingwei){
			var url = '<?php  echo $this->createPluginMobileUrl('supplier/store')?>';
			var data = {		
				keyword : keyword,
				address : address,	
				cate_id : cate_id,
				dingwei : dingwei,
				/*page    : page,*/
			}

			 $.ajax({
		        type: "post",
		        url:url,
		        data: data,
		        success: function (data) {      	
		        	var json = JSON.parse(data)
		        	data = json;
		        	for(var i = 0;i<data.length;i++){
		        		if(data[i].description==null){
		        		    data[i].description="暂无";
		        		}
		        	}
		        	/*if(data.length==0){
		        		$(".weui-loadmore").hide();
		        		$("#shopList").destroyInfinite();
		        	}

		        	if (data.length < pageSize){ 
						$('.weui-loadmore').hide();
						$("#shopList").destroyInfinite();
					} */

		        	if(data.length>0){
		        		/*page += pageSize;*/
		        		$(".shopList").loadTemplate("#tpl_list1",data);
		        		loading = false;
		        		var lngss=$("#address").attr("lngss");
		        		var latss=$("#address").attr("latss");
		        		var pointA = new BMap.Point(lngss,latss);
		        		var map = new BMap.Map("container"); //初始化地图类  

		        		$(".juliInput").each(function(){
		        			var a=$(this).attr("alt");
		        			var b=$(this).attr("value");		        		
		        			if(a=="undefined"||b==""){
		        				$(this).parent().children(".juli").text("");
		        			}else{
		        				var pointB = new BMap.Point(a,b);		        				
		        				var mi=(map.getDistance(pointA,pointB)).toFixed(1);
		        				
		        				if(mi>1000){
		        					$(this).parent().children(".juli").text((mi/1000).toFixed(1)+'km');
		        				}else{
		        					$(this).parent().children(".juli").text(mi+'m');
		        				}   
		        			}
		        			 
		        			
		        		})
		        	}else{
		        		$(".shopList").html("");
		        	}		        	
		        	
		         }
		        
		    });
	}


      $(window).scroll(function(){  
      /*	alert(1)*/
           var $this =$(this),  
           viewH =$(this).height(),//可见高度  
           contentH =$(this).get(0).scrollHeight,//内容高度  
           scrollTop =$(this).scrollTop();//滚动高度  
          //if(contentH - viewH - scrollTop <= 100) { //到达底部100px时,加载新内容  
         /* console.log(contentH)
          console.log(viewH)*/
          console.log(scrollTop)


          if(scrollTop/(contentH -viewH)>=0.95){ //到达底部100px时,加载新内容  
         	/*alert(2)*/
          }  
       });  

})



window.PointerEvent = undefined;
/*轮播图*/
	    $(".swiper-container").swiper({
	        loop: true,
	        autoplay: 3000
	      });

	    /*左右滑动*/
	       reFun();
	       $(window).resize(function() {
	       	reFun();
	       });
	       function reFun() {
	       	var _ww = $(window).width();
	       	var _hh = Math.round(_ww / 360 * 176);
	       	$('.royalSlider,.rsOverflow').css({
	       		'height': _hh + 'px',
	       		'max-height': _hh + 'px'
	       	});

	       	$('.iscroll').each(function(e) {
	       		var _c = $(this).attr('class');
	       		var _r = _c.match(/block-slider\d/);
	       		var _n = _r[0].substr(-1);
	       		console.log(_n)
	       		var _scroller = $(this).find('.scroller');
	       		var _scroll_li = $(this).find('.scroller li');
	       		var _len = _scroll_li.length;
	       		var _scroll_li_w = parseInt(_ww / _n);
	       		var _scroller_w = _scroll_li_w * _len;
	       		_scroll_li.width(_scroll_li_w);
	       		_scroller.width(_scroller_w);
	       	});

	       	loaded();
	       };

	       function loaded() {
	       	new IScroll('#iscroll01', {
	       		preventDefault:false,
	       		scrollbars: false,
	       		useTransition: true,
	       		scrollY: false,
	       		vScrollbar: false,
	       		scrollX: true,
	       		interactiveScrollbars: true,
	       		shrinkScrollbars: 'scale'
	       	});

	       }


	     $(".scroller li").on("click",function(){
	     	if($(this).hasClass('u-indexActive')){

	     	}else{
	     		$(".scroller li").removeClass('u-indexActive');
	     		$(this).addClass('u-indexActive');
	     	}
	     })

	   

/*var page = 1;
require(['core','tpl'], function(core,tpl) {
    core.pjson('supplier/store', {
        page: page,
        op : 'list'
    }, function(json) {
        console.log(json);
        if (!json.result.list.length) {
            $('#container').html(tpl('tpl_empty'));
            return; 
        } else if (json.result.list.length > 0) {
            var list = json.result;
           $('#container').html(tpl('tpl_list',list));
        }
        var loaded = false;
        var stop = true;
        $(window).scroll(function() {
            if (loaded) {
                return;
            }
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if ($(document).height() <= totalheight) {

                if (stop == true) {
                    stop = false;
                    $('#container').append('<div id="coupon_loading" style="text-align: center;><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                    page++;
                    core.pjson('supplier/store', {
                        page: page,
                        op : 'list'
                    },
                    function(morejson) {
                        console.log(morejson);
                        stop = true;
                        $('#coupon_loading').remove();
                        $("#container").append(tpl('tpl_list', morejson.result));
                        if (morejson.result.list.length < morejson.result.pagesize) {
                            $('#container').append('<div id="coupon_loading" style="text-align: center;">已经加载全部</div>');
                            loaded = true;
                            return;
                        }
                    },
                    true);
                }
            }
        });
    },
    true);
});*/
</script>
<?php  } else if($op == 'storefavoritelist') { ?>
<title>已关注的店铺</title>
<style type="text/css">
    body { margin: 0px; background: #f2f2f2; font-family: '微软雅黑'; -moz-appearance: none; }
    a { text-decoration: none; }
    @font-face {font-family: "iconfont";
      src: url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.eot?t=1474179952'); /* IE9*/
      src: url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.eot?t=1474179952#iefix') format('embedded-opentype'), /* IE6-IE8 */
      url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.woff?t=1474179952') format('woff'), /* chrome, firefox */
      url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.ttf?t=1474179952') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
      url('../addons/sz_yi/template/mobile/style1/static/fonts/iconfont02.svg?t=1474179952#iconfont') format('svg'); /* iOS 4.1- */
    }
    @font-face {font-family: "iconfont";
      src: url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.eot?t=1474179952'); /* IE9*/
      src: url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.eot?t=1474179952#iefix') format('embedded-opentype'), /* IE6-IE8 */
      url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.woff?t=1474179952') format('woff'), /* chrome, firefox */
      url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.ttf?t=1474179952') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
      url('../addons/sz_yi/template/mobile/style1/shop/fonts/iconfont1.svg?t=1474179952#iconfont') format('svg'); /* iOS 4.1- */
    }
    @font-face {font-family: "iconfont";
      src: url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.eot?t=1474945964'); /* IE9*/
      src: url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.eot?t=1474945964#iefix') format('embedded-opentype'), /* IE6-IE8 */
      url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.woff?t=1474945964') format('woff'), /* chrome, firefox */
      url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.ttf?t=1474945964') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
      url('../addons/sz_yi/template/mobile/style1/member/fonts/iconfont.svg?t=1474945964#iconfont') format('svg'); /* iOS 4.1- */
    }
    .hs {
      font-family:"iconfont" !important;
      font-style:normal;
      -webkit-font-smoothing: antialiased;
      -webkit-text-stroke-width: 0.2px;
      -moz-osx-font-smoothing: grayscale;
    }
    .hs-xuan:before { content: "\e739"; }
    .hs-wei:before { content: "\e651"; }
    .hs-xuanzhong:before { content: "\d622"; }
    .hs-guan:before { content: "\e933"; }
    .hs-xuanzhong{color: #e45050 !important;}
    .log_top { height: 44px; width: 100%; background: #f8f8f8; border-bottom: 1px solid #e3e3e3; }
    .log_top .title { height: 44px; width: auto; margin-left: 10px; float: left; font-size: 16px; line-height: 44px; color: #666; }
    .log_menu { height: 44px; background: #fff; }
    .log_menu .nav { height: 44px; width: 20%; border-bottom: 1px solid #f1f1f1; background: #fff; border-left: 1px solid #f1f1f1; float: left; line-height: 44px; font-size: 14px; color: #666; text-align: center; }
    .log_menu .navon { color: #00c1ff; border-bottom: 2px solid #00c1ff; }
    .log_title { height: 40px; padding: 5px; line-height: 50px; font-size: 16px; color: #666; }
    .log_list { height: auto; overflow: hidden; padding: 10px; background: #fff; margin-top: 5px; }
    .log_list .left { width: 70%; float: left; color: #999; margin-right: -20%; font-size: 14px; }
	.log_list .left .img{width:20%;float:left;min-width:50px;} 
	.log_list .left .img>img{width:90%;} 
    .log_list .left .inner {margin-right: -20% }
    .log_list .left .inner>p {margin-bottom:0px; }
    .log_list .left span { color: #666; font-size: 13px; line-height: 28px; }
    .log_list .right { height: 100%; width: 30%; float: right; font-size: 14px; text-align: right; line-height: 3.2em; margin-left: -20%; }
    .log_list .right span { color: #f90; }
    .log_no { height: 100px; width: 100%; margin: 50px 0px 60px; color: #ccc; font-size: 12px; text-align: center; }
    #coupon_loading { padding:10px;color:#666;text-align: center;}
    .emptyDiv{background: #f2f2f2;border-radius: 2px;padding: 15px;margin: 0 auto;width: 75%;position: relative;border-radius: 2px;}
   .emptyLine1{position: absolute;height: 1px;background: #a2a2a2;top:40px;left: 30px;width: 70px;}
   .emptyLine2{position: absolute;height: 1px;background: #a2a2a2;top:40px;right:30px;width: 70px;}
   .emptyText{font-size: 14px;color:#656565;margin-top: 10px}
   .coupon_no {height: 115px;margin: 100px 0px 60px;color: #ccc; font-size: 12px;text-align: center;}

	.favorite_no {height:40px;  padding-top:100px; margin:50px 0px;}
	.favorite_no_nav {height:38px; width:43%; background:#eee; margin:0px 3%; float:left; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
	.favorite_top {height:44px; background:#FFF; padding:0px 3%; border-bottom:1px solid #eaeaea;}
	.favorite_top .title {height:44px; width:auto; float:left; font-size:16px; line-height:44px; color:#666;}
	.favorite_top .nav {height:30px; width:auto; background:#fff; padding:0px 10px; border:1px solid #eaeaea; border-radius:5px; float:right; line-height:30px; margin:6px 0px 0px 16px; color:#666; font-size:14px;}
	.favorite_main {height:auto; width:100%;background:#fff; border-bottom:1px solid #eaeaea;}
	.favorite_good {height:120px; width:100%; padding:20px 0px; border-bottom:1px solid #eaeaea;background: white;}
	.favorite_good .ico {height:20px; width:30px;  float:left ; font-size:24px;margin-top:25px;color:#666;z-index:2;position: relative;text-align:right;display: none}
	.favorite_good .img {height:80px; width:80px; background:#f99; float:left;z-index:2;position: relative;margin-left:10px;}
	.favorite_good .img img {height:100%; width:100%}
	.favorite_good .info {height:80px; width:100%; float:left;margin-left:-120px;margin-right:-30px;position: relative;}
	.favorite_good .info .inner {margin-left:130px;margin-right:30px;}
	.favorite_good .info .inner .name {height:40px; width:100%; line-height:20px; color:#656565 ; overflow:hidden; font-size:14px;}
	.favorite_good .info .inner .other {height:30px; width:100%;}
	.favorite_good .info .inner .other .price {height:30px; width:auto; float:left; line-height:30px; font-size:14px; color:#666; overflow:hidden; color:#e45050;font-size: 17px;}
	/*.favorite_good .info .inner .other .price span {color:#666;font-size:12px;text-decoration: line-through}*/
	.favorite_good .right { float:right;width:30px;height:20px;margin-left:-30px; color:#666;font-size:18px;margin-top:25px;text-align:center;z-index:2;position: relative;}
	.favorite_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
	.favorite_no_menu {height:40px; width:100%;}
	.favorite_no_nav {height:38px; width:43%; background:#eee; margin:0px 3%; float:left; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;}
	#favorite_loading { padding:10px;color:#666;text-align: center;}
	.removeD { position: fixed; bottom: 55px; left: 0; z-index: 1111; display: none; width: 100%; height: 45px; line-height: 45px; background: #d6d6d6; }
	.removeD .all{margin-left: 10px;height: 45px;line-height: 45px;float: left;}
	.favorite_Tip{height: 40px;background: #f2f2f2;line-height: 40px;color: #656565;padding:0 0 0 10px;}
	.LJbug{border-radius: 3px;color: #e45050;width: auto;height: 25px;position: absolute;right: -20px;bottom: -3px;padding: 0 5px;line-height: 25px;}
	.disabled {background: #ccc !important;}
	.emptyDiv{background: #f2f2f2;height: 180px;}


</style>

<!-- <div class="log_top"> -->
  <!--   <div class="title" onclick='history.back()'><i class='fa fa-chevron-left'></i> 已收藏的店铺</div>
</div> -->
<div class="page_topbar" style="background: #fff;">
    <a href="#" class="back" onclick="history.back()">
      <i class="iconfont arrow" style="color: #282828;">&#xe618;</i>
    </a>
    <div class="title" style=" color: #282828;">已关注的店铺</div>
    <a href="#" >
        <i class="headerRightIcon" style="width:35px;color: #282828;" onclick="complete($(this))">编辑</i>
    </a>
    
 </div>
<div id='container'></div>
<script id='tpl_list' type='text/html'>
	
	  <div class="favorite_Tip">最近一个月的店铺关注</div>
	  <%each list as item%> 
	  
	  <div class="favorite_good" data-storeid="<%item.storeid%>" > 
	      <div class="ico"><i class="hs hs-wei"></i></div>
	      <div class="img" onclick='window.location.href="<%item.url%>"'><img src="<%item.logo%>"/></div>
	      <div class="info">
	          <div class="inner">
	              <div class="name"  onclick='window.location.href="<%item.url%>"'><%item.storename%></div>
	                <div class="other">
	                		<div class="">销量：<%item.salercount%></div>
	                       <div class=""  onclick='window.location.href="<%item.url%>"'><%item.createtime%></div>
	                       <div class="LJbug cancel" data-storeid="<%item.storeid%>">取消关注</div>
	                </div>
	          </div>
	      </div>
		
	  </div>
	<%/each%>
	<div class="removeD clearfloat">
		    <div class="all ico" sel='0' style="background: white;float: left;width: 50%;margin-left: 0;margin-top: 0px;    font-size: 16px;">
		        <i class="hs hs-wei" style="padding:0 0 0 10px;font-size: 20px;color: rgb(153, 153, 153);float:left;margin-top: 2px;"></i>
		        <span style="float:left;margin-left:5px">全选</span>
		    </div>
		    <div class="disabled" style="width:50%;float:left;background:#e45050;color:#fff;text-align: center;" id="removefavorite" >取消关注</div>
		</div>



</script>
<script id='tpl_empty' type='text/html'>
	<div class="coupon_no">
	    <div>
	      <div class="emptyDiv">
	         
	          <img style="width:60px;display:block;margin:0 auto;" src="../addons/sz_yi/plugin/suppliermenu/template/mobile/default/images/gzlog.png" alt="">
	       
	          <div class="f-fsize14" style="color: #656565;margin-top: 11px;">赶快去关注店铺吧</div>
	           <!-- <div class="emptyText" >收藏夹空空如也 ~</div>  -->
	      </div>
	     
	    </div>
	</div>
</script>
<script language = 'javascript' >
function bindEvents(){
                               
            $(".ico").unbind('click').click(function(){
                setSelect($(this),$(this).parent().attr('sel'))
            });

            $(".all").click(function(){
                var $icon = $(this).find('i');
                var sel = $(this).attr('sel');
                $(".ico").each(function(){
                    setSelect($(this),sel)
                });
                setSelect($icon,sel,true);
            });

            $('.remove').click(function(){
                var ids = [ $(this).closest('.favorite_good').data('favoriteid') ];
                removeFavorite(ids); 
            });

         }
function setSelect(obj, sel){
        if(sel=='1'){
             obj.find('i').addClass('hs-wei').removeClass('hs-xuanzhong').css('color', '#656565');
        }
        else{
             obj.find('i').removeClass('hs-wei').addClass('hs-xuanzhong').css('color', '#e45050');
        }
        sel =sel==1?0:1;
        obj.parent().attr('sel',sel);
   
        calctotal();
    }

 //编辑
    function complete(obj){
      var _this = obj;
      if($(".favorite_good .ico").css('display')=="none"){
          $(".favorite_good .ico").show();
          _this.text("完成");
          $(".removeD").show();
          $(".LJbug").hide();
      }else{
          $(".favorite_good .ico").hide();
          _this.text("编辑");
          $(".removeD").hide();
          $(".LJbug").show();
      }
    }

     function calctotal(){
        var total = 0;
        $(".favorite_good").each(function(){
            var $this = $(this);
            var sel = $this.attr('sel')=='1';
            if(sel){
                total++;
            }
        });
           if(total<=0){
                $("#removefavorite").addClass('disabled');
            }
            else{
                $("#removefavorite").removeClass('disabled');
            }

        return total;
    }



    

	

var page = 1;
require(['core', 'tpl'], function(core, tpl) {
    core.pjson('supplier/store', {page : page, op : 'storefavoritelist'}, function(json) {
        if (!json.result.list.length) {
            $('#container').html(tpl('tpl_empty'));
            return;
        } else if (json.result.list.length > 0) {
            var list = json.result;
            console.log(list);
            $('#container').html(tpl('tpl_list',list));
            bindEvents();    	
        }
        var loaded = false;
        var stop = true;
        $(window).scroll(function() {
            if (loaded) {
                return;
            }
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if ($(document).height() <= totalheight) {
                if (stop == true) {
                    stop = false;
                    $('#container').append('<div id="coupon_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载...</div>');
                    page++;
                    core.pjson('supplier/store', {page : page, op : 'storefavoritelist'}, function(morejson) {
                        stop = true;
                        $('#coupon_loading').remove();
                        $("#container").append(tpl('tpl_list', morejson.result));
                        if (morejson.result.list.length < morejson.result.pagesize) {
                            $('#container').append('<div id="coupon_loading">已经加载全部</div>');
                            loaded = true;
                            return;
                        }
                    },
                    true);
                }
            }
        });


	    $('.cancel').click(function(){
	    	var obj = $(this);
	    	var storeid = obj.data("storeid");
	    	console.log(storeid);
	    	core.pjson('supplier/store', {op : 'delstorefavorite', storeid : storeid}, function(json) {
                console.log(json);
                if (json.status == 1) {
                    core.tip.show(json.result);
                    obj.parents('.log_list').slideUp();
                }
            }, true);
	    });

	    $('#removefavorite').click(function(){

    	   

    	    	/*var html="<div class='coupon_no'>"
    					    +"<div>"
    					      +"<div class='emptyDiv'>"
    					          +"<div class='emptyLine1'></div>"
    					          +"<i class='fa fa-file-text-o' style='font-size:45px;margin-top: 5px;'></i>"
    					        +"<div class='emptyLine2'></div>"
    					          +"<div class='f-fsize14' style='color: #656565;margin-top: 11px;'>"
    					          +"赶紧去收藏宝贝把</div>"
    					      +"</div>"
    					      +"<div class='emptyText'>收藏夹空空如也 ~</div> "
    					   +" </div>"
    					+"</div>";*/

    	    	var ids = [];
    	    	$('.favorite_good[sel=1]').each(function(){
    	    	    ids.push($(this).data('storeid')) ;
    	    	})
    	    	if(ids.length<=0){
    	    	    core.tip.show('未选择商品');
    	    	    return;
    	    	}else{
    	    		var url="<?php  echo $this->createPluginMobileUrl('supplier/store')?>"
    	    		var data={
    	    			op:'removefavorite',
    	    			ids:ids,
    	    		};
    	    		core.tip.confirm('确认取消收藏这些店铺?',function(){

    	    			$.ajax({
	    	    			type:"post",
	    	    			url:url,
	    	    			data:data,
	    	    			success:function(data){
	    	    				var json = JSON.parse(data)
	    			        	data = json;
	    			        	$('.favorite_good').attr('del',0);
	    	    				console.log(data)
	    	    				if(data.status==1) {
	    	    				    for(var i in ids){    				        
	    	    				        $('.favorite_good[data-storeid=' + ids[i]+ ']').attr('del',1).fadeOut(500,function(){
	    	    				            $('.favorite_good[data-storeid=' + ids[i]+ ']').remove();
	    	    				        })
	    	    				    }
	    	    				    if($('.favorite_good[del=0]').length<=0){
	    	    						 $('#container').css("background","#f2f2f2")
	    	    				         /*$('#container').html(html);*/
	    	    				         $('#container').html(tpl('tpl_empty'));
	    	    				    }else{
	    	    				       
	    	    				}
	    	    			}    	    				
	    	    				   
	    	    			}
    	    		})

    	    		  })
    	    		
    	    	}

    	    
	    	    
	    	
	    })

	    


	    


	    


    },
    true);
});
</script>


<?php  } ?>
<?php  $show_footer='true';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>