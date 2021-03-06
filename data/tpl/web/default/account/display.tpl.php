<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-cut" id="js-account-display" ng-controller="AccountDisplay" ng-cloak>
	<div class="panel-heading">
		<span class="panel-heading-left"><i class="wi wi-wechat" style="font-size: 24px; margin-right: 10px; vertical-align:middle;"></i>请选择您要操作的公众号</span>
		<div class="font-default pull-right">
			
				<?php  if(!empty($account_info['uniacid_limit']) || $_W['isfounder'] && !user_is_vice_founder()) { ?>
				<a href="./index.php?c=account&a=post-step" class="color-default"><i class="fa fa-plus"></i>新增公众号</a>
				<?php  } ?>
			
			
			<?php  if($state == ACCOUNT_MANAGE_NAME_FOUNDER || $state == ACCOUNT_MANAGE_NAME_MANAGER) { ?>
			<a href="<?php  echo url('account/manage', array('account_type' => ACCOUNT_TYPE_OFFCIAL_NORMAL))?>" class="color-default"><i class="wi wi-wechatstatistics"></i>公众号管理</a>
			<?php  } ?>
		</div>
	</div>
	<div class="panel-body" >
		<?php  if(!$_W['isfounder'] && !empty($account_info['uniacid_limit'])) { ?>
			<div class="alert alert-warning hidden">
				温馨提示：
				<i class="fa fa-info-circle"></i>
				Hi，<span class="text-strong"><?php  echo $_W['username'];?></span>，您所在的会员组： <span class="text-strong"><?php  echo $account_info['group_name'];?></span>
				账号有效期限：<span class="text-strong"><?php  echo date('Y-m-d', $_W['user']['starttime'])?> ~~ <?php  if(empty($_W['user']['endtime'])) { ?>无限制<?php  } else { ?><?php  echo date('Y-m-d', $_W['user']['endtime'])?><?php  } ?></span>，
				可创建 <span class="text-strong"><?php  echo $account_info['maxaccount'];?> </span>个公众号，已创建<span class="text-strong"> <?php  echo $account_info['uniacid_num'];?> </span>个，还可创建 <span class="text-strong"><?php  echo $account_info['uniacid_limit'];?> </span>个公众号。
			</div>
		<?php  } ?>
		<div class="cut-header" ng-if="searchShow">
			<form action="./index.php" method="get">
				<input type="hidden" name="c" value="account">
				<input type="hidden" name="a" value="display">
				
				<input type="text" name="letter" ng-model="activeLetter" ng-style="{'display': 'none'}">
				<div class="cut-search">
					<div class="input-group pull-left">
						<input class="form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" type="text" placeholder="请输入微信公众号名称" >
						<span class="input-group-btn"><button class="btn btn-default button"><i class="fa fa-search"></i></button></span>
					</div>
				</div>
			</form>
		</div>
		<div class="clearfix"></div>
		<ul class="letters-list cut-wechat-letters" ng-if="searchShow">
			<li ng-repeat="letter in alphabet" ng-style="{'background-color': letter == activeLetter ? '#ddd' : 'none'}" ng-class="{'active': letter == activeLetter}" ng-click="searchModule(letter)">
				<a href="javascript:;" ng-bind="letter"></a>
			</li>
		</ul>
		<div class="cut-list clearfix" ng-if="accountList" infinite-scroll='loadMore()' infinite-scroll-disabled='busy' infinite-scroll-distance='0' infinite-scroll-use-document-bottom="true">
			<div class="item" ng-repeat="detail in accountList" ng-mouseenter="show = true" ng-mouseleave="show = false">
				<div class="content">
					<img ng-src="{{detail.logo}}" class="icon-account" onerror="this.src='./resource/images/nopic-107.png'"/>
					<div class="name" ng-bind="detail.name"></div>
					<div class="type">
						<span ng-if="detail.level == 1">类型：普通订阅号</span>
						<span ng-if="detail.level == 2">类型：普通服务号</span>
						<span ng-if="detail.level == 3">类型：认证订阅号</span>
						<span ng-if="detail.level == 4">类型：认证服务号</span>
					</div>
				</div>
				<div class="mask" ng-show="show">
					<a ng-href="{{detail.switchurl}}" class="entry">
						<div>进入公众号 <i class="wi wi-angle-right"></i></div>
					</a>
					<a href="javascript:;" class="stick" ng-click="stick(detail.uniacid)" title="置顶">
						<i class="wi wi-stick-sign"></i>
					</a>
				</div>
			</div>
		</div>
		<ul ng-if="!accountList" style="text-align:center;width:100%"><span ng-if="!accountList">暂无数据</span></ul>
	</div>	
</div>
<script>
	angular.module('accountApp').value('config', {
		accountList: <?php echo !empty($account_list) ? json_encode($account_list) : 'null'?>,
		accountTotal: "<?php  echo $total;?>",
		pagesize: "<?php  echo $psize;?>",
		links: {
			rank: "<?php  echo url('account/display/rank')?>",
			display: "<?php  echo url('account/display/display')?>",
		},
		scrollUrl : "<?php  echo url('account/display')?>",
		keyword : "<?php  echo $keyword;?>",
		letter : "<?php  echo $letter;?>"
	});
	angular.bootstrap($('#js-account-display'), ['accountApp']);
	// 鼠标移入显示隐藏
	angular.module('accountApp').controller('AccountDisplay',function($scope){
		$scope.show = false;
	})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>