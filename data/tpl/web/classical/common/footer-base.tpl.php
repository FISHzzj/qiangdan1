<?php defined('IN_IA') or exit('Access Denied');?>	</div>
	<div class="container-fluid footer text-center" role="footer">	
		<span class="friend-link">
				<?php  echo $_W['setting']['copyright']['footerright'];?>
		</span>
		<span><?php  echo $_W['setting']['copyright']['footerleft'];?></span>
	</div>
	<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
	<?php  if(!empty($_GPC['m']) && !in_array($_GPC['m'], array('keyword', 'special', 'welcome', 'default', 'userapi')) || defined('IN_MODULE')) { ?>
	<script>
		if(typeof $.fn.tooltip != 'function' || typeof $.fn.tab != 'function' || typeof $.fn.modal != 'function' || typeof $.fn.dropdown != 'function') {
			require(['bootstrap']);
		}
	</script>
	<?php  } ?>
</div>