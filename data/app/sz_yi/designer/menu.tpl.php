<?php defined('IN_IA') or exit('Access Denied');?><link href="../addons/sz_yi/plugin/designer/template/imgsrc/menu.css" rel="stylesheet">
<?php  if(empty($_W['angular_loaded'])) { ?>
<script type="text/javascript" src="../addons/sz_yi/plugin/designer/template/imgsrc/angular.min.js"></script>
<?php  } ?>
<?php  if(empty($_W['angular_loaded'])) { ?>
<div ng-app="myApp">
<?php  } ?>
<div ng-controller="MenuCtrl">
<div class="designer-menu"  style='position: fixed;bottom:0px;' data-bgalpha="{{params.bgalpha}}" >
    <ul>
        <li ng-repeat="menu in menus"
            ng-class="{'designer-menu-line':params.showicon==0 || params.showicon==1,'designer-menu-w1':menus.length == 1,
                        'designer-menu-w2':menus.length == 2,'designer-menu-w3':menus.length == 3,'designer-menu-w4':menus.length == 4,
                        'designer-menu-w5':menus.length == 5,'designer-menu-border': params.showborder==1,'designer-menu-noborder': params.showborder!=1}"
            ng-style="{'border-top-color': menu.bordercolor}"
            ng-click="openMenu(menu,$event)"
            >
         <div class="designer-menu-bg" ng-style="{'background':menu.bgcolor,'opacity':params.bgalpha}"></div>
          <div class="designer-menu-item" ng-style="{'color':menu.textcolor}" >
                <span ng-class="{'designer-menu-block':params.showicon==2,'designer-menu-icon':params.showicon==2}"><i class="{{menu.icon}} "  ng-style="{color:menu.iconcolor}" ng-show="params.showicon!=0"></i></span>
                <span class='designer-menu-label' ng-class="{'designer-menu-block':params.showicon==2,'designer-menu-text':params.showicon==2}"  ng-show="params.showtext==1"> {{menu.title}}</span>
          </div>
           <div class="sub" ng-style="{'border-color':params.bordercolor2,'background':params.bgcolor2}">
                <span>
                    <a 
                        class="designer-menu-link"
                        ng-repeat="sub in menu.subMenus" 
                        ng-style="{'border-bottom-color':params.bordercolor2,'color':params.textcolor2}"
                        href="{{sub.url}}">{{sub.title}}</a>
                </span>
                <div class="corner"  ng-style="{'border-top-color':params.bordercolor2}"></div>
                <div class="corner2"  ng-style="{'border-top-color':params.bgcolor2}"></div>
            </div>
            <div class="designer-menu-spliter"  ng-show="params.showborder==1" ng-style="{'background':menu.bordercolor}"></div>
        
          </li>
    </ul>
</div>
</div>
<?php  if(empty($_W['angular_loaded'])) { ?>
</div>
<?php  } ?>
 
<script type="text/javascript">
<?php  if(empty($_W['angular_loaded'])) { ?>
   var app = angular.module('myApp', []);
 <?php  } ?> 
    app.controller('MenuCtrl', ['$scope', function($scope){
    
            $scope.menus = <?php echo !empty($this->footer['diymenus'])?$this->footer['diymenus']:json_encode($menus)?>;
            $scope.params = <?php echo !empty($this->footer['diyparams'])?$this->footer['diyparams']:json_encode($params)?>;
            $scope.clear =function(m){
                 angular.forEach($scope.menus, function(m,index) {

                    m.textcolor  = $scope.params.textcolor;
                    m.bgcolor  =$scope.params.bgcolor;
                    m.iconcolor  = $scope.params.iconcolor;
                    m.bordercolor  = $scope.params.bordercolor;

                 });
            }
            $scope.clear();
            $scope.openMenu = function(menu,event){
                 if(menu.subMenus.length<=0){
                        if(menu.url==''){
                            return;
                        }
                        location.href = menu.url;
                         return;
                    }
                    var current = $(event.currentTarget).closest('li').find('.sub');
                    var h = current.height();
                    $scope.clear();
                    var bgalpha = $scope.params.bgalpha ;
                    if( !$.isNumber(bgalpha) || parseFloat(bgalpha )>1){
                        bgalpha = 1;
                    }
          
                     if(bgalpha!=1){
                              //????????????
                              if(parseInt(current.css('opacity'))>=1){ //???????????????
                                    current.animate({opacity:0,bottom:-h-50},200);    
                            } else{
                                current.css('bottom',50).animate({opacity:1},200);        
                                 menu.textcolor  = $scope.params.textcolorhigh;
                                 menu.bgcolor  = $scope.params.bgcolorhigh;
                                 menu.iconcolor  = $scope.params.iconcolorhigh;
                                 menu.bordercolor  = $scope.params.bordercolorhigh;
                            }
                                $(event.currentTarget).siblings().closest('li').find('.sub').each(function(){
                            var h = $(this).height();
                           $(this).animate({opacity:0},200); 
                     });
                     }
                     else{
                           if(parseInt(current.css('bottom'))>0){
                                current.animate({bottom:-h-50,opacity:0},200);       
                           } else{
                                current.animate({bottom:50,opacity:1},200);        
                                menu.textcolor  = $scope.params.textcolorhigh;
                                menu.bgcolor  = $scope.params.bgcolorhigh;
                                menu.iconcolor  = $scope.params.iconcolorhigh;
                                menu.bordercolor  = $scope.params.bordercolorhigh;
                           }
                               $(event.currentTarget).siblings().closest('li').find('.sub').each(function(){
                           var h = $(this).height();
                          $(this).animate({bottom:-h-50,opacity:0},200); 
                    });
                     }
                  
                
            }
    }]);
$(function(){
	var len =$('.designer-menu .sub').length;
 
    $('.designer-menu .sub').each(function(i){
         var h = $(this).height();
         var w = $(this).closest('li').width();
   
         $(this).css('bottom',  -h-50);
         var left = parseFloat( $(this).offset().left.toString().replace('px',''));
         if(i==0){
         	if(left<0){
         		left =Math.abs(left);
         		$(this).offset({left:5});
         	 
         		var corner = $(this).find('.corner');
         		var cornerleft = ( parseFloat( $(this).css('left').replace('px','')) - left  ) /2 + 5;
         		corner.css('left',cornerleft);
         	    $(this).find('.corner2').css('left',cornerleft);
         	}
        }else if(i+1==len){
        	
        	var right = $(this).width() + left;
         	if(right>=$(document).width()){
         		var newoffset = $(document).width() - $(this).width() - 5;
         	    $(this).offset({left:newoffset});
         	    
         	    
         	    var corner = $(this).find('.corner');
         	    var cornerleft= ($(this).width() - $(this).closest('li').width()) / 2 + $(this).width()/2 + 5;
         		corner.css('left',cornerleft);
         	    $(this).find('.corner2').css('left',cornerleft);
         	    
         	}
        }
         
    })
})
</script>


