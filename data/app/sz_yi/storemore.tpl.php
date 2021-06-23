<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<head>
	<meta charset="UTF-8">
	<title>线下门店</title>
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/jquery.min.js"></script>
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/bootstrap.js"></script>
	<script type="text/javascript" src="../addons/sz_yi/template/mobile/style1/static/js/bootstrap-chinese-region.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=fgLe6PL2rbdcBi904tBIaMsUGhAT5P0j"></script>
	<style type="text/css">
	.m-searchDiv{background: rgb(242, 242, 242);width: 90%;top: 50px;position: fixed;}
	.m-shiyongList li {width: 25%;text-align: center;float: left; padding: 10px 0px 0px 95px;}
	.m-shiyongList li p {font-size: 14px;margin: 7px 0 0;color: #666666;}
	.m-shiyongList li a{display: block;}
	.m-shiyongList li .icon {width: 53px;height: 53px;}
	.catory{padding: 10px 0px;}
	.dropdown-menu{min-width: 185px;}
	.aa {padding: 10px 0px 5px 10px;}
	.f-margin0010 {margin: 0px 10px;}
	.juli{top:54px;}
	.shopList li{margin:0px; border-bottom: 1px solid #eaeaea;}
	.slot ul li{float: left;width: 50%;}
	.dropdown2 .nav {width: 50%;text-align: center;margin: 5px 0px;float: left;font-size: 15px;}
	.dropdown2 {height: 40px;background: white;border-bottom: 1px solid #eee;}
	.f-borderR {border-right: 1px solid #eee;}
	.dropdownList ul li {list-style: none;text-align: center;color: #282828;background:white;border-bottom: 1px solid #eee;height: 45px;line-height: 40px;font-size: 15px;}
	.dropdownList ul li:hover{background: #f2f2f2;color: #e45050;}
	.div1,.div2{width: 50%;}
	.div1{border-right: 1px solid #eaeaea;}
	.div2{border-left: 1px solid #eaeaea;}
	.div2{float: right;}
	.dropdown2 .active {color: #e45050;}
	p{margin: 0px;}
	.juli{top: 61px;}
	.dropdown-menu{z-index: 99999;}
	.dropdown-menu{position: fixed;top:82px;border:0px;}
	a{color:#282828;}
	.dropdown2{position: fixed;width: 100%;top:94px;z-index: 2;}
	.dropdownList{position: fixed;width: 100%;top:125px;z-index: 99;}
	.div{background: white;}
	.ab{width: 100%;top: 40px;position: fixed;z-index: 99;}
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
		<div class="f-relative f-bgWhite ab" style="height: 55px;">
			<!-- 搜索框 -->
	      	<div class="m-searchDiv">
	      	  	<div class="fl f-relative" style="width: 30%;">
	      	  		<div class="bs-chinese-region flat dropdown" data-submit-type="id" data-min-level="1" data-max-level="3">
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
	      	<div class="f-cb"></div>
	    </div>
	    <div class="f-relative">
		    <div class="dropdown2">
		      	<div class="nav nav_btn f-borderR tab1" data-id='1'><!-- index=1 -->
		      		<span>全部分类</span>
		      		<i class="iconfont arrow">&#xe61f;</i>
		      	</div>
		      	<div class="nav nav_btn tab2" data-id='2'><!-- index=2 -->
		      		<span>排序</span>
		      		<i class="iconfont arrow">&#xe61f;</i>
		      	</div>
		    </div>
		    <div class="dropdownList">
		    	<div class="div1 div" style="display: none;" data-ids='1'>
		    		<ul>
		    			<li data-cateid="0">全部分类</li>
		    			<?php  if(is_array($supplier_cate)) { foreach($supplier_cate as $row) { ?>
		    			<li data-cateid="<?php  echo $row['id'];?>"><?php  echo $row['name'];?></li>
		    			<?php  } } ?>
		    		</ul>
		    	</div>
		    	<div class="div2 div" style="display: none;" data-ids='2' data-type2="0">
		    		<ul>
		    			<li class="number" data-select="0" data-number="1">按距离远近</li>
		    			<li class="distance" data-select="1" data-distance="1">按消费次数</li>
		    		</ul>
		    	</div>
		    </div>
		    <div class="store">
		    	<ul class="shopList" id="shopList" style="margin-top: 134px;">
                	
                </ul>
            </div>
		</div>
		
	</div>
	<div id="container"></div>

	<script type="text/html" id='tpl_store_list'>
		
			<%each list as stores%>
			<li>
				<a href="<%stores.href%>">
					<img src="../attachment/<%stores.logo%>" alt="" class="logo">
					<p class="f-fsize16"><%stores.storename%></p>
					<p class="f-fsize13 f-colorgray"><%stores.cname%></p>
					<p class="f-fsize12 f-colorRed">消费&nbsp;
						<span class="f-marginR10"><%stores.total_order%> &nbsp;次</span>
					</p>
					<div class="juli" data-lngss="<%stores.lng%>" data-latss="<%stores.lat%>">距离：定位中</div>
				</a>
			</li>
			<%/each%>

	</script>
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
	})

	// 在 nav_btn 上绑定 mouseup 事件，当触发时缓存事件的 timeStamp:
	var clickATimeStamp;
	$('.nav_btn').on('mouseup', function(e) {
		    clickATimeStamp = e.timeStamp;
		    var eq = $(this).index();//index是用于位置,从1开始
			if($(this).hasClass("active")){
				$(this).removeClass("active");
				if(eq>=0){
					$(".dropdownList .div").eq(eq).slideUp(200); //eq是用于索引,从0开始		
					$(".dropdownList .div").eq(eq).siblings().slideUp(200);
				}
			}else{
				$(this).addClass("active");
				$(this).siblings().removeClass("active")
				if(eq>=0){
					$(".dropdownList .div").eq(eq).siblings().hide();
					$(".dropdownList .div").eq(eq).slideDown(500);
					
				}
			}
	});



	// 在 a 以外的地方（且为 body 也可以是 ul）也绑上 mouseup 事件
	$('body').on('mouseup', function(e) {
	    if (clickATimeStamp === e.timeStamp) {
	     	// 点在 a 以内
	    } else {
	        // 点在 a 以外
	        $(".nav_btn").removeClass("active");
			$(".dropdownList .div").slideUp(200);
	    }
	});



		var url = window.location;
	   function getUrlParam(url,name){
	    
	       var pattern = new RegExp("[?&]" + name +"\=([^&]+)","g");
	       var matcher = pattern.exec(url);
	       var items = null;
	       if(matcher != null){
	           try{
	               items = decodeURIComponent(decodeURIComponent(matcher[1]));   
	           }catch(e){
	               try{
	                   items = decodeURIComponent(matcher[1]);
	               }catch(e){
	                   items = matcher[1];
	               }
	           }
	       }
	       return items;
	   }


	   

	   



	require(['tpl', 'core'], function (tpl, core) {

	var map = new BMap.Map("container"); //初始化地图类  

		   loadData();
		   function loadData(){
		   	   var address=getUrlParam(url,'address');//获取上一个界面传过来的address
			   var keyword=getUrlParam(url,'keyword');//获取上一个界面传过来的keyword
			   var dingwei=getUrlParam(url,'dingwei');//获取上一个界面传过来的dingwei
			   var args = {
		     				"address":address,
		     				"keyword":keyword,
		     				"dingwei":dingwei,
		     			}
			   $.ajax({
		     			url: url,
		     			type: 'post',
		     			dataType: 'json',
		     			data: args,
		     			success:function(datas){   				
		     				var store = {};
		     				store.list = datas;
		     				console.log(store.list.length)

		     				/*var href = "<?php  echo $this->createPluginMobileUrl('suppliermenu/storelist',array('op'=>'detail','id'=>$row['id']))?>"*/

		     				var arr = [];
		     				for(var i = 0; i<store.list.length;i++){
		     					
		     					 href =  "<?php  echo $this->createPluginMobileUrl('suppliermenu/storelist',array('op'=>'detail'))?>"+"&id="+store.list[i].id;
		     					store.list[i].href=href
		     					
		     				}
		     				

		     				$('#shopList').html(tpl('tpl_store_list',store));


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
		     				            $("#address").attr("data-lng",pt.lng); 
		     				            $("#address").attr("data-lat",pt.lat);   
		     				            var district = result.addressComponents.district;	           
		     				            $("#address").attr("data-dingwei",0);   
		     				            var addComp = result.addressComponents;  
		     						    province= addComp.province;
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


		     			}
		     		})
		   }

		function getGoodsMore(cate_id,select) {
     		var dingwei =$("#address").attr("data-dingwei");
     		var keyword =$(".searchInput").val();
     		var url = "<?php  echo $this->createPluginMobileUrl('suppliermenu/storelist',array('op'=>'more'))?>";
     		var number =$(".number").attr("data-number");
     		var distance =$(".distance").attr("data-distance");  		
     		var hasAddress =$("#address").attr("data-address");
     		var cate_id = cate_id;
     		var lng =$("#address").attr("data-lng");
     		var lat =$("#address").attr("data-lat");
     		

     	 	if(select == 0){
     			var args = {
     				"address":hasAddress,
     				"keyword":keyword,
     				"dingwei":dingwei,
     				"distance":distance,
     				"cate_id":cate_id,
     				"lng":lng,
     				"lat":lat,
     			}
	     		
     		}else{
     			var args = {
     				"address":hasAddress,
     				"keyword":keyword,
     				"dingwei":dingwei,
     				"number":number,
     				"cate_id":cate_id,
     			}
	     		
     		}

     		$.ajax({
     			url: url,
     			type: 'post',
     			dataType: 'json',
     			data: args,
     			success:function(datas){   				
     				var store = {};
     				store.list = datas;
     				console.log(store.list)

     				$('#shopList').html(tpl('tpl_store_list',store));

     				setTimeout(function(){
		            	$(".juli").each(function(){
		            		var lon=$("#address").attr('data-lng');
		               		var lat=$("#address").attr('data-lat');
		                	var alon=$(this).attr('data-lngss');
		               		var alat=$(this).attr('data-latss');
		               		var pointA = new BMap.Point(lon,lat);  // 创建点坐标A
		               		var pointB = new BMap.Point(alon,alat);  // 创建点坐标B
		               		var mi=(map.getDistance(pointA,pointB)).toFixed(1);
		               		if(mi>1000){
		               			$(this).text("距离："+(mi/1000).toFixed(1)+'km');		
		               		}else{
		               			$(this).text("距离："+mi+'m');		  
		               		}    
		 			  });  
		            },1000)


     			}
     		})


        }

				$(".div1 ul li").on("click",function(){
     				var type2 =$(".div2").attr("data-type2");
					var cate_id = $(this).attr("data-cateid");
					$(this).parents(".div1").attr("data-cateid",cate_id);
					var text = $(this).text();
					$(".tab1 span").text(text);
					getGoodsMore(cate_id,type2);
					
				})


     			$(".div2 ul li").on("click",function(){
     				var cate_id =$(".div1").attr("data-cateid");
					var select = $(this).attr("data-select");
					$(this).parents(".div2").attr("data-type2",select);
					var text = $(this).text();
					$(".tab2 span").text(text);
					getGoodsMore(cate_id,select);
				})


				$(".searchIcon").on("click",function(){
					var cate_id =$(".div1").attr("data-cateid");
					var type2 =$(".div2").attr("data-type2");
					getGoodsMore(cate_id,type2);
				})


	})




</script>
</body>
</html>