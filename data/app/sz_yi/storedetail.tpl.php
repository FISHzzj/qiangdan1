<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<head>
	<meta charset="UTF-8">
	<title><?php  echo $store['storename'];?></title>	
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/jquery-weui.min.js"></script>
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/swiper.min.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=fgLe6PL2rbdcBi904tBIaMsUGhAT5P0j"></script>
	<style type="text/css">
	.weui-cells{margin-top: 15px;}
	.weui-left{width: 40%;}
	.weui-left{font-size: 15px;}
	.weui-cell__ft {color: #282828;font-size: 15px;width: 60%;text-align: left;}
	.lubiao{width: 15px;vertical-align: bottom;margin-right: 5px;}
	.star{vertical-align: bottom;color: gray;}
	.u-goshop{width: 85px;height: 32px;line-height: 29px;color:#e45050;border:1px solid #e45050;}
	.sel_n .sel_body_name{height: auto !important;}
	.closeBtn{background-color: #0c88e8;;margin: 10px auto;width: 90%;}
	.closeBtn:active,.closeBtn:hover{background: #499fe2;color: white; }
	.RouteAddressOuterBkg{background: white !important; }
	.color-warning{color: #0087ff;}
	a{color:#282828;}
	header{z-index: 2 !important;}
	p{margin:0px;}
	.shopList li{padding: 20px 0px 20px 95px;margin-bottom: 20px;}
	.shopList li img{top:15px;}
	</style>
</head>
<body>
	<header>		
		<div class="header_top">
			<div class="header_top">
				<a href="javascript:history.go(-1)">
					<i class="iconfont arrow f-col333">&#xe618;</i>
				</a>
					线下门店
				<a href="#">
					<i class="iconfont f-col333 headerRightIcon">&#xe60a;</i>
				</a>
			</div>
		</div>
	</header>
	<div>
		<div class="swiper-container f-relative" data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="1000">
			<div class="swiper-wrapper">
			<?php  if(empty($store['piclist'])) { ?>
			    <div class="swiper-slide"><img src="../addons/sz_yi/template/mobile/style1/static/images/4a.png" alt=""></div>
			    <div class="swiper-slide"><img src="../addons/sz_yi/template/mobile/style1/static/images/4a.png" alt=""></div>
			    <div class="swiper-slide"><img src="../addons/sz_yi/template/mobile/style1/static/images/4a.png" alt=""></div>
			<?php  } else { ?>
				<?php  if(is_array($store['piclist'])) { foreach($store['piclist'] as $row) { ?>
				<div class="swiper-slide"><img src="<?php  echo $row;?>" alt=""></div>
				<?php  } } ?>
			<?php  } ?>
			</div>
	      	<div class="swiper-pagination"></div>
	    </div>
	    <div>
		    <div class="weui-cells">
		    		<div class="weui-cell">
		    	    <div class="weui-left" style="font-size: 18px;">
		    	      <p>门店信息</p>
		    	    </div>
		    	    <div class="weui-cell__ft"></div>
		    	  </div>
		    	  <div class="weui-cell">
		    	    <div class="weui-left">
		    	      <p>门店名称：</p>
		    	    </div>
		    	    <div class="weui-cell__ft"><?php  echo $store['storename'];?></div>
		    	  </div>

		    	  <div class="weui-cell">
		    	    <div class="weui-left">
		    	      <p>门店电话：</p>
		    	    </div>
		    	    <div class="weui-cell__ft"><?php  echo $store['tel'];?></div>
		    	  </div>

		    	  <div class="weui-cell">
		    	    <div class="weui-left">
		    	      <p>所属商家：</p>
		    	    </div>
		    	    <div class="weui-cell__ft"><?php  echo $store_data['storename'];?></div>
		    	  </div>

		    	  <div class="weui-cell">
		    	    <div class="weui-left">
		    	      <p>门店位置：</p>
		    	    </div>
		    	    <div class="weui-cell__ft address2" data-lngss="<?php  echo $store['lng'];?>" data-latss="<?php  echo $store['lat'];?>"><?php  echo $store['address'];?></div>
		    	  </div>

		    	  <div class="weui-cell">
		    	    <div class="weui-cell__hd f-marginR5" >
		    	    	<i class="iconfont star" data-type="<?php  echo $status;?>" data-storeid="<?php  echo $store['id'];?>">&#xe611;</i>
		    	    </div>
		    	    <div class="weui-cell__bd f-fsize15">
		    	      <p>收藏</p>
		    	    </div>
		    	    <div class="weui-cell__ft" style="text-align: right;">
		    	    	<img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/lubiao.png" class="lubiao">
		    	    	<!-- <span class="d-juli" id='show-actions'>定位中</span> -->
		    	    	<a href="http://api.map.baidu.com/marker?location=39.916979519873,116.41004950566&title=黄村地铁口&content=百度奎科大厦&output=html" class="d-juli" id='show-actions' >定位中</a>
		    	    	<input type="hidden" class="address1" data-address="" data-lng="113.30764968" data-lat="23.1200491">
		    	    </div>
		    	</div>
			</div>
	    </div>
	</div>

<!-- 	<p><a href="http://api.map.baidu.com/marker?location=39.916979519873,116.41004950566&title=黄村地铁口&content=百度奎科大厦&output=html">adsasdasdasdasdasdasdasd</a></p> 网页打开 -->

	<ul class="shopList" style="margin-top: 10px;">
		<li>
			<img src="../attachment/<?php  echo $store_data['logo'];?>" alt="" class="logo">
			<p class="f-fsize16"><?php  echo $store_data['storename'];?></p>
			<p class="f-fsize13 f-colorgray"><?php  echo $cate['name'];?></p>
			<p class="f-fsize12 f-colorRed f-marginT5">销量：
				<span class="f-marginR10"><?php  echo $store_data['to'];?></span>
			</p>
			<a href="<?php  if($store['type'] == 2) { ?><?php  echo $this->createPluginMobileUrl('supplier/store',array('op'=>skip,'storeid'=>$store_data['storeid']))?><?php  } else { ?><?php  echo $this->createMobileUrl('shop')?><?php  } ?>">
				<div class="u-btn u-goshop">进入线上店铺</div>
			</a>
		</li>
	</ul>

<div id="mapWrap" class="weui-popup__container">
  <div class="weui-popup__overlay"></div>
  <div class="weui-popup__modal">
  	<header style="z-index: 1 !important;">		
		<div class="header_top" style="top: 1px;font-size: 15px;">
			<div class="header_top">
				<a href="javascript:(0);">
					<i class="iconfont arrow f-col333 close-popup">关闭</i>
				</a>
					线下门店
			</div>
		</div>
	</header>
    <div id="l-map"></div>
	<div id="r-result"></div>
	<a href="javascript:;" class="weui-btn closeBtn close-popup">关闭</a>
  </div>
</div>


<script type="text/javascript">
	/*轮播图*/
	$(".swiper-container").swiper({
	      loop: true,
	      autoplay: 3000
	});

	var type = $(".star").attr("data-type");
	if(type ==1){
		$(".star").css("color","#fdca00");
		$(".star").parents(".weui-cell").find(".weui-cell__bd p").text("已收藏");
	}else{
		$(".star").css("color","gray")
		$(".star").parents(".weui-cell").find(".weui-cell__bd p").text("收藏");
	}


	$(".star").on("click",function(){
		var type = $(this).attr("data-type");
		var storeid = $(this).attr("data-storeid")
		var url ="<?php  echo $this->createPluginMobileUrl('suppliermenu/storelist',array('op'=>'collect'))?>"
		var This = $(this);
		$.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
			data: {'storeid':storeid,'status':type},
			success:function(data){
				if(type == 0){
					This.css("color","#fdca00");
					This.attr("data-type",1);
					This.parents(".weui-cell").find(".weui-cell__bd p").text("已收藏");
				}else{
					This.css("color","gray")
					This.attr("data-type",0);
					This.parents(".weui-cell").find(".weui-cell__bd p").text("收藏");
				}
			}
		})
	})

	/*定位*/
	
    var map = new BMap.Map("l-map");
	var geolocation = new BMap.Geolocation();  
	// 创建地理编码实例      
	var myGeo = new BMap.Geocoder();      
	geolocation.getCurrentPosition(function(r){  
	if(this.getStatus() == BMAP_STATUS_SUCCESS){  
	var pt = r.point;   
	// 根据坐标得到地址描述    
	myGeo.getLocation(pt, function(result){      
	    if (result){   
	            console.log(result)
	            var lat = $(".address1").attr("data-lat",result.point.lat);
				var lng = $(".address1").attr("data-lng",result.point.lng);  

				var alon=$(".address2").attr('data-lngss');
               	var alat=$(".address2").attr('data-latss');
               	var pointB = new BMap.Point(alon,alat);  // 创建点坐标B
               	var mi=(map.getDistance(pt,pointB)).toFixed(1);

               	var point = alat+","+alon;
               	var address1 = result.address;
               	var address2 = $(".address2").text();

               	/*<a href="http://api.map.baidu.com/marker?location=39.916979519873,116.41004950566&title=黄村地铁口&content=百度奎科大厦&output=html" class="d-juli" id='show-actions' >定位中</a>*/
              	var href = "http://api.map.baidu.com/marker?location="+point+"&title="+address2+"&content="+address1+"&output=html"
               	$(".d-juli").attr("href",href);

               		if(mi>1000){
               			$(".d-juli").text("距离"+(mi/1000).toFixed(1)+'km');
               		}else{
               			$(".d-juli").text("距离"+mi+'m');
               		}   
	        }      
	    });   
	   }  
	});  



	/*$(".d-juli").on("click",function(){

		 $.actions({
          title: "选择出行方式",
          onClose: function() {
            console.log("close");
          },
          actions: [
            {
              text: "步行规划",
              className: "color-warning",
              onClick: function() {
               			$("#mapWrap").popup();
                		var lat = $(".address1").attr("data-lat");
                		var lng = $(".address1").attr("data-lng");
                		var address2 =$(".address2").text();
                		var lacation =lat+","+lng;
                		var url ='http://api.map.baidu.com/geocoder/v2/?callback=renderReverse&location='+lacation+'&output=json&pois=1&ak=fgLe6PL2rbdcBi904tBIaMsUGhAT5P0j';
                		console.log(url);
                		$.ajax({
                			url: url,
                			type: 'post',
                			dataType: 'jsonp',
                			data:"",
                			success:function(data){
                				console.log(data)
                				if(data.result){
                					var map = new BMap.Map("l-map");
                					var address1 = data.result.formatted_address;
                					// 百度地图API功能
                					map.centerAndZoom(new BMap.Point(113.30764968,23.1200491), 12);

                					var walking = new BMap.WalkingRoute(map, {renderOptions: {map: map, panel: "r-result", autoViewport: true}});
                					walking.search(address1, address2);
                				}
                			}
                		})
              }
            },
            {
              text: "驾车规划",
              className: "color-warning",
              onClick: function() {
               			$("#mapWrap").popup();
                		var lat = $(".address1").attr("data-lat");
                		var lng = $(".address1").attr("data-lng");
                		var address2 =$(".address2").text();
                		var lacation =lat+","+lng;
                		var url ='http://api.map.baidu.com/geocoder/v2/?callback=renderReverse&location='+lacation+'&output=json&pois=1&ak=fgLe6PL2rbdcBi904tBIaMsUGhAT5P0j';
                		console.log(url);
                		$.ajax({
                			url: url,
                			type: 'post',
                			dataType: 'jsonp',
                			data:"",
                			success:function(data){
                				console.log(data)
                				if(data.result){
                					var map = new BMap.Map("l-map");
                					var address1 = data.result.formatted_address;
                					// 百度地图API功能
                					map.centerAndZoom(new BMap.Point(113.30764968,23.1200491), 12);

                					var driving = new BMap.DrivingRoute(map, {renderOptions: {map: map, panel: "r-result", autoViewport: true}});
                					driving.search(address1, address2);
                				}
                			}
                		})
              }
            },
             {
              text: "公交规划",
              className: "color-warning",
              onClick: function() {
               			$("#mapWrap").popup();
                		var lat = $(".address1").attr("data-lat");
                		var lng = $(".address1").attr("data-lng");
                		var address2 =$(".address2").text();
                		var lacation =lat+","+lng;
                		var url ='http://api.map.baidu.com/geocoder/v2/?callback=renderReverse&location='+lacation+'&output=json&pois=1&ak=fgLe6PL2rbdcBi904tBIaMsUGhAT5P0j';
                		console.log(url);
                		$.ajax({
                			url: url,
                			type: 'post',
                			dataType: 'jsonp',
                			data:"",
                			success:function(data){
                				console.log(data)
                				if(data.result){
                					var map = new BMap.Map("l-map");
                					var address1 = data.result.formatted_address;
                					// 百度地图API功能
                					map.centerAndZoom(new BMap.Point(113.30764968,23.1200491), 12);

                					var transit = new BMap.TransitRoute(map, {renderOptions: {map: map, panel: "r-result",}});
                					transit.search(address1, address2);
                				}
                			}
                		})
              }
            },
          ]
        });
		
	})*/

</script>
</body>
</html>