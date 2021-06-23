<?php defined('IN_IA') or exit('Access Denied');?><!-- 33393339912472 -->
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<head>
	<meta charset="UTF-8">
	<title>线下门店</title>
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/bootstrap.js"></script>
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/bootstrap-chinese-region.js"></script>
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/jquery.loadTemplate.min.js"></script>
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/jquery-weui.min.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=fgLe6PL2rbdcBi904tBIaMsUGhAT5P0j"></script>

	<style type="text/css">
	.m-searchDiv{background: rgb(242, 242, 242);width: 90%;top: 50px;position: fixed;}
	.m-shiyongList li {width: 25%;text-align: center;float: left;}
	.m-shiyongList li p {font-size: 14px;margin: 7px 0 0;color: #666666;}
	.m-shiyongList li a{display: block;}
	.m-shiyongList li .icon {width: 53px;height: 53px;}
	.catory{padding: 10px 0px;}
	.dropdown-menu{min-width: 185px;}
	.aa {padding: 10px 0px 5px 10px;}
	.f-margin0010 {margin: 0px 10px;}
	.juli{top:54px;}
	.shopList li{margin:0px; border-bottom: 1px solid #e6e6e6;}
	.dropdown-menu{z-index: 99999;}
	.dropdown-menu{position: fixed;top:82px;border:0px;}
	.shopList li p{margin: 0 0 5px;}
	a{color:#282828;}
	.juli {top: 72px;}
	.m-shiyongList li{ padding-bottom: 10px;margin-top: 0px;border-bottom:0px;}
	.center-arrow{margin-top: 2px;}
	.m-shiyongList{height: 175px;}
	.form-control:focus{border:0px !important;box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 1px 1px rgba(0,0,0,.075);}
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
	<div class="content">
		<div class="f-relative f-bgWhite" style="height: 55px;">
			<!-- 搜索框 -->
	      	<div class="m-searchDiv">
	      	  	<div class="fl f-relative" style="width: 30%;">
	      	  		<div class="bs-chinese-region flat dropdown" data-submit-type="id" data-min-level="1" data-max-level="3">
	      	  			<!-- <input type="text" class="form-control" name="address" id="address" placeholder="定位中" data-toggle="dropdown" readonly="" value="440100"> -->
	      	  			<input type="text" class="form-control" name="address" id="address" placeholder="定位中" data-toggle="dropdown" readonly="" value="">
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
	      	  		<i class="iconfont f-col333 spanIcon">&#xe61f;</i>
	      	  	</div>
	      	  	<input type="text" class="searchInput fl" placeholder="输入店铺名称">
	      	  	<div class="fr" style="margin-top: 5px;">
	      	  		<i class="iconfont f-col333 searchIcon">&#xe699;</i>
	      	  	</div>
	      	  	<div class="f-cb"></div>
	      	</div>
	    </div>
	    <div class="catory f-bgWhite">
	    	<ul class="m-shiyongList">
	    				<?php  if(is_array($supplier_cate)) { foreach($supplier_cate as $row) { ?>
						<li class="">
							<a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/storelist',array('op'=>'more','cate_id'=>$row['id']))?>">
							  	<img src="../attachment/<?php  echo $row['logo'];?>" class="icon">
							  	<p><?php  echo $row['name'];?></p>
						  	</a>
						</li>
					    <?php  } } ?>
						<li class="omore" data-type="0">
							<a href="#">
						  		<img src="../addons/sz_yi/plugin/suppliermenu/template/mobile/style1/images/oicon8.png" class="icon">
						  		<p>更多</p>
							</a>
						</li> 
						<div class="f-cb"></div>
					</ul>
	    </div>

	    <div class="aa bg_white f-borderB m-orderTit f-marginT10 " style="padding: 10px;">
			<span class="f-fsize16 f-fwb">附近商家</span>
			<div class="fr f-relative">
				<span class="fr f-fsize12 f-marginL5 center-arrow f-colorgray">
					<i class="iconfont" style="font-size:12px"></i> 
				</span>
				<a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/storelist',array('op'=>'more'))?>"><span class="f-fsize14 f-colorgray all"  data-num="0">更多</span></a>
			</div>
		</div>
		<ul class="shopList">

			<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<li>
				<a href="<?php  echo $this->createPluginMobileUrl('suppliermenu/storelist',array('op'=>'detail','id'=>$row['id']))?>">
				<img src="../attachment/<?php  echo $row['logo'];?>" alt="" class="logo">
				<p class="f-fsize16"><?php  echo $row['storename'];?></p>
				<p class="f-fsize13 f-colorgray"><?php  echo $row['cname'];?></p>
				<p class="f-fsize12 f-colorRed">消费&nbsp;
					<span class="f-marginR10"><?php  echo $row['total_order'];?> &nbsp;次</span>
				</p>
				<div class="juli" data-lngss="<?php  echo $row['lng'];?>" data-latss="<?php  echo $row['lat'];?>">距离：定位中</div>
				</a>
			</li>
			<?php  } } ?>
		</ul>
	</div>
	<div id="container"></div>
<script type="text/javascript">
	$(function(){
		  /*地址*/
		    $.getJSON('../addons/sz_yi/template/mobile/style1/static/js/sql_areas.json',function(data){
				for (var i = 0; i < data.length; i++) {
					var area = {id:data[i].id,name:data[i].cname,level:data[i].level,parentId:data[i].upid};
						data[i] = area;
				}
				
				$('.bs-chinese-region').chineseRegion('source',data);
			});

			var map = new BMap.Map("container"); //初始化地图类  
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
			            var district = result.addressComponents.district;			            
			            $("#address").attr("data-dingwei",0);   
			            var addComp = result.addressComponents;  
			            var province= addComp.province;
	 					var city= addComp.city;
	 					var district= addComp.district;
	 					var address=addComp.province+"-"+city+"-"+district;
	 					$("#address").val(addComp.district)
	 					$("#address").attr("data-address",address)  

			            setTimeout(function(){
			            	$(".juli").each(function(){
			                	var alon=$(this).attr('data-lngss');
			               		var alat=$(this).attr('data-latss');
			               		var pointB = new BMap.Point(alon,alat);  // 创建点坐标B
			               		var mi=(map.getDistance(pt,pointB)).toFixed(1);
			               		if(mi>1000){
			               			$(this).text("距离："+(mi/1000).toFixed(1)+'km');		
			               		}else{
			               			$(this).text("距离："+mi+'m');		  
			               		}    
			 			  });  
			            },1000)
			        }      
			    });   
			   }  
			});  


			$(".omore").on("click",function(){
				var type = $(this).attr("data-type");
				if(type == 0){
					 style=" height: auto;"
					 $(".m-shiyongList").css({
					 	"overflow": "visible",
					 	"height":"auto",
					 })
					$(this).attr("data-type",1);
				}else{
					$(".m-shiyongList").css({
					 	"overflow": "hidden",
					 	"height":"175px",
					 })
					$(this).attr("data-type",0);
				}
			})

			$(".searchIcon").on("click",function(){
				var dingwei =$("#address").attr("data-dingwei");
				var keyword =$(".searchInput").val();
				var hasAddress =$("#address").attr("data-address");
				var	url = "<?php  echo $this->createPluginMobileUrl('suppliermenu/storelist',array('op'=>'more'))?>"+'&address='+hasAddress+'&keyword='+keyword+'&dingwei='+dingwei;
				window.location.href=url;
			})
	})
</script>
</body>
</html>