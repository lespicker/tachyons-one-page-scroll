<?php
function pjDisplayGallery($attributes)
{
	$gallery = new PJGallery($attributes);
	extract($gallery->getAttributes());
	$images = $gallery->getItems();
	
	if(count($images) == 0)
		return '<p>No Content in this Gallery</p>';
		
	if (is_feed()) 
	{	
		//$output = apply_filters('PJ-gallery-display-feed', $gallery);
		if ( $output != '' )
			return $output;
			
		$output = "\n";
		foreach ($images as $image)
		{
			if($image->linkto)
				$output .= '<a href="'.$image->linkto.'" title="'.$image->title.'">'.wp_get_attachment_image($image->imageID).'</a>\n';
			else
				$output .= wp_get_attachment_image($image->imageID).'\n';
		}
		return $output;
	}
	
	//$output = apply_filters('PJ-gallery-display', $gallery);
	if ( $output != '' )
		return $output;

	$listtag = tag_escape($listtag);
	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	
	$output = apply_filters('gallery_style', "
		<style type='text/css'>
			.gallery {
				margin: auto;
			}
			.gallery-item {
				float: left;
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;			}
			.gallery img {
				border: 2px solid #cfcfcf;
			}
			.gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->
		<div class='gallery'>");

	foreach ( $images as $image ) {
		$imageSrc = image_downsize($image->imageID, $size);
		if($image->linkto)
			$link = '<a href="'.$image->linkto.'" title="'.$image->title.'"><img src="'.$imageSrc[0].'" width="'.$imageSrc[1].'" height="'.$imageSrc[2].'" title="'.$galleryItem->title.'" alt="'.$galleryItem->title.'" /></a>';
		else
			$link = '<img src="'.$imageSrc[0].'" width="'.$imageSrc[1].'" height="'.$imageSrc[2].'" title="'.$galleryItem->title.'" alt="'.$galleryItem->title.'" />';
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($image->caption) ) {
			$output .= "
				<{$captiontag} class='gallery-caption'>
				{$image->caption}
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";
		
	if($gallery->viewerEnabled() == true)
	{
		$output = LinkUtility::whateverBox($output);
	}
		
	return $output;
}
?>