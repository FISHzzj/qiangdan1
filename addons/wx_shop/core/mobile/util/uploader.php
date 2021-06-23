<?php
header('Access-Control-Allow-Origin:*'); 
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Uploader_WxShopPage extends MobilePage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		load()->func('file');
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $_GPC['bakeq'], $result)){
			$field = $this->base64_image_content($_GPC['bakeq']);
			if($field){
				$field['result']['message'] = '上传成功';
				exit(json_encode($field));
			}else{
				$results['message'] = '请选择要上传的图片！';
				exit(json_encode($results));
			}
		}

		// var_dump($_GPC['file']);
		$field = $_GPC['file']?$_GPC['file']:'file';



		if (!(empty($_FILES[$field]['name']))) 
		{
			if (is_array($_FILES[$field]['name'])) 
			{
				$files = array();
				foreach ($_FILES[$field]['name'] as $key => $name ) 
				{
					if (strrchr($name, '.') === false) 
					{
						$name = $name . '.jpg';
					}
					$file = array('name' => $name, 'type' => $_FILES[$field]['type'][$key], 'tmp_name' => $_FILES[$field]['tmp_name'][$key], 'error' => $_FILES[$field]['error'][$key], 'size' => $_FILES[$field]['size'][$key]);
					$files[] = $this->upload($file);
				}
				$ret = array('status' => 'success', 'files' => $files);
				exit(json_encode($ret));
			}
			else 
			{
				if (strrchr($_FILES[$field]['name'], '.') === false) 
				{
					$_FILES[$field]['name'] = $_FILES[$field]['name'] . '.jpg';
				}
				$result = $this->upload($_FILES[$field]);
				exit(json_encode($result));
			}
		}
		else 
		{
			$result['message'] = '请选择要上传的图片！';
			exit(json_encode($result));
		}
	}
	protected function upload($uploadfile) 
	{
		global $_W;
		global $_GPC;
		$result['status'] = 'error';
		if ($uploadfile['error'] != 0) 
		{
			$result['message'] = '上传失败，请重试！';
			return $result;
		}
		load()->func('file');
		$path = '/images/wx_shop/' . $_W['uniacid'];
		if (!(is_dir(ATTACHMENT_ROOT . $path))) 
		{
			mkdirs(ATTACHMENT_ROOT . $path);
		}

		$_W['uploadsetting'] = array();
		$_W['uploadsetting']['image']['folder'] = $path;
		$_W['uploadsetting']['image']['extentions'] = $_W['config']['upload']['image']['extentions'];
		$_W['uploadsetting']['image']['limit'] = $_W['config']['upload']['image']['limit'];
		$file = file_upload($uploadfile, 'image');

		if (is_error($file)) 
		{
			$result['message'] = $file['message'];
			return $result;
		}
		if (function_exists('file_remote_upload')) 
		{
			$remote = file_remote_upload($file['path']);
			if (is_error($remote)) 
			{
				$result['message'] = $remote['message'];
				return $result;
			}
		}
		$result['status'] = 'success';
		$result['url'] = $file['url'];
		$result['error'] = 0;
		$result['filename'] = $file['path'];
		$result['url'] = trim($_W['attachurl'] . $result['filename']);
		pdo_insert('core_attachment', array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid'], 'filename' => $uploadfile['name'], 'attachment' => $result['filename'], 'type' => 1, 'createtime' => TIMESTAMP));
		return $result;
	}
	public function remove() 
	{
		global $_W;
		global $_GPC;
		load()->func('file');
		$file = $_GPC['file'];
		file_delete($file);
		exit(json_encode(array('status' => 'success')));
	}

	public function base64_image_content($base64_image_content){
		global $_W;
		global $_GPC;

		//匹配出图片的格式
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
			if(!$base64_image_content){
				$base64_image_content = $_GPC['bakeq'];
			}
		
			$type = $result[2];
			load()->func('file');
			$new_file = '../attachment/images/' . $_W['uniacid']."/".date('Y',time())."/".date('d',time())."/";
			if (!(is_dir(ATTACHMENT_ROOT . $new_file))) 
			{
				mkdirs(ATTACHMENT_ROOT . $new_file);
			}
			$new_file = $new_file.time().".{$type}";
			if (file_put_contents($new_file,base64_decode(str_replace($result[1],'', $base64_image_content)))){
				$results['url'] = trim($_W['siteroot'] .$new_file);
				$results['fielname'] = ltrim($new_file,"\.\./attachment");
			
				return $results;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
}
?>