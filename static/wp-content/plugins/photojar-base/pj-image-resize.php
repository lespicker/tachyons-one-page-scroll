<?php
//only call these once
$thumbWidth = get_option('thumbnail_size_w');
$thumbHeight = get_option('thumbnail_size_h');
$thumbCrop = get_option('thumbnail_crop');
$medWidth = get_option('medium_size_w');
$medHeight = get_option('medium_size_h');
$resizeFull = get_option('pj_resize_full');
$resizeFullWidth = get_option('pj_full_width');
$resizeFullHeight = get_option('pj_full_height');

class ImageResize
{
	public function imageDownsizeFilter($crop, $id, $size)
	{
		global $thumbWidth, $thumbHeight, $thumbCrop, $medWidth, $medHeight, $resizeFull, $resizeFullWidth, $resizeFullHeight, $pagenow;
		
		if(!is_array($imagedata = wp_get_attachment_metadata($id))
			|| is_admin() && $pagenow == 'media-upload.php' && get_option('pj_insert_image') != 'true')
		{
			return false;
		}
		if($size == 'thumbnail') 
		{
			$width = $thumbWidth;
			$height = $thumbHeight;
			$crop = $thumbCrop;
		}
		else if($size == 'medium')
		{
			$width = $medWidth;
			$height = $medHeight;
			$crop=0;//false
		}
		else if(is_array($size))
		{
			$width=$size[0];
			$height=$size[1];
			$crop=0;
		}
		else if(preg_match('/^([0-9]+)x([0-9]+)x?(crop)?$/', $size, $matches))
		{
			$width=$matches[1];
			$height=$matches[2];
			$crop=0;
			if($matches[3]=='crop')
				$crop=1;//true
		}
		else if($size == 'full' && $resizeFull == 'true')
		{
			$width=$resizeFullWidth;
			$height=$resizeFullHeight;
			$crop=0;
		}
		else
		{
			return false;
		}
		$originalImage = get_attached_file($id);
		if ($width >= $imagedata['width'] && $height >= $imagedata['height'])
			return array( wp_get_attachment_url($id), $width, $height );
			
		$imageFile = $this->getFromCache($originalImage, $width, $height, $crop, $id);
		
		if($imageFile == null)
		{
			require_once(ABSPATH . 'wp-admin/admin-functions.php');
			$imageFile = image_resize($originalImage, $width, $height, $crop, $width.'x'.$height.'-'.$crop.'-img'.$id, PJ_CACHE_PATH, get_option('pj_jpeg_quality'));
		}
		if(is_wp_error($imageFile)) //...or there was a problem
		{
			//Debugging info...
			echo '<p>Error Resizing Image: '.$imageFile->get_error_code().'<br />';
			echo 'Original Image Path: "'.$originalImage.'"<br />';
			foreach( $imageFile->get_error_messages() as $em )
			{
				echo $em.'<br />';
			}
			echo '</p>';
			return false;
		}
		$img_info = getimagesize($imageFile);
		$img_url = PJ_CACHE_URL.basename($imageFile);

		return array( $img_url, $img_info[0], $img_info[1] );
	}
	
	private function getFromCache($file, $width, $height, $crop, $id)
	{
		$info = pathinfo($file);
		$ext = $info['extension'];
		$name = basename($file, '.'.$ext);
		$suffix = $width.'x'.$height.'-'.$crop.'-img'.$id;
		$thumbName = $name.'-'.$suffix.'.'.$ext;
		if(file_exists(PJ_CACHE_PATH.$thumbName))
		{
			return PJ_CACHE_PATH.$thumbName;
		}
		
		return null;
	}
}
?>