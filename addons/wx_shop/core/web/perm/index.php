<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_WxShopPage extends WebPage 
{
	public function main() 
	{	
		if (cv('perm.log')) 
		{
			header('location: ' . webUrl('perm/log'));
			exit();
		}
		/*if (cv('perm.role')) 
		{
			header('location: ' . webUrl('perm/role'));
			exit();
		}
		else if (cv('perm.user')) 
		{
			header('location: ' . webUrl('perm/user'));
			exit();
		}
		else if (cv('perm.log')) 
		{
			header('location: ' . webUrl('perm/log'));
			exit();
		}
*/	}
}
?>