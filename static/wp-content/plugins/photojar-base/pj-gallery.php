<?php

class PJGallery
{
	private $attributes;
	private $ID;
	private $items;
	
	function __construct($attributes, $id = null)
	{
		$this->setAttributes($attributes, $id);
		$this->ID = $this->attributes['id'];
	}
	
	public function getItems($exclude = array())
	{
		if($this->attributes['showchildren'] == 'true')
			return $this->getGalleries($exclude);
		else
			return $this->getImages($exclude);
	}
	
	private function getImages($exclude = array())
	{
		global $pjStatus;
		if(!isset($this->items))
		{
			$images = get_children(array('post_parent' => $this->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $this->attributes['order'], 'orderby' => $this->attributes['orderby'], 'numberposts' => $this->attributes['limit'], 'offset' => $this->attributes['offset'], 'exclude' => $this->attributes['exclude']));
			$galleryItems = array();
			if(!is_array($images))
				$images = array();
			foreach($images as $image)
			{
				if(!in_array($image->ID, $exclude))
				{
					$galleryItem = new PJGalleryItem();
					$galleryItem->imageID = $image->ID;
					$galleryItem->galleryID = $this->ID;
					$galleryItem->title = $image->post_title;
					$galleryItem->caption = $image->post_excerpt;
					$galleryItem->linkto = LinkUtility::imageLink($galleryItem->imageID, $this->attributes['linkto']);
					$galleryItems[] = $galleryItem;
				}
			}
			$this->items = $galleryItems;
		}
		return apply_filters('PJ-gallery-images', $this->items, $this);
	}
	
	private function getGalleries($exclude = array())
	{
		global $pjStatus;
		if(!isset($this->items))
		{
			$posts = get_posts( array('post_parent' => $this->ID, 'post_type' => 'page', 'order' => $this->attributes['order'], 'orderby' => $this->attributes['orderby'], 'numberposts' => $this->attributes['limit'], 'offset' => $this->attributes['offset'], 'exclude' => $this->attributes['exclude']));
			$galleryItems = array();
			if(!is_array($posts))
				$posts = array();
			foreach($posts as $post)
			{
				$gallery = PJGallery::getGalleryFromPost($post);
				if($gallery != null && !in_array($gallery->ID, $exclude))
				{
					$galleryItem = new PJGalleryItem();
					$galleryItem->imageID = $gallery->getThumbnailID($exclude);
					$galleryItem->galleryID = $this->ID;
					$galleryItem->title = $post->post_title;
					$galleryItem->caption = $post->post_title;
					$galleryItem->linkto = get_page_link($post->ID);
					$galleryItems[] = $galleryItem;
				}
			}
			$this->items = $galleryItems;
		}
		return apply_filters('PJ-gallery-galleries', $this->items, $this);
	}
	
	public function getThumbnail($exclude = array())
	{
		$exclude[] = $this->ID;
		$thumb = array_shift($this->getItems($exclude));
		return apply_filters('PJ-gallery-thumb', $thumb, $this);
	}
	
	public function getThumbnailID($exclude = array())
	{
		$thumb = $this->getThumbnail();
		return $thumb->imageID;
	}
	
	public function getID()
	{
		return $this->ID;
	}
	
	public function getAttributes()
	{
		return $this->attributes;
	}
	
	static function getGalleryFromPost($post)
	{
		$hasGallery = preg_match('/\[(gallery)\b(.*?)(?:(\/))?\](?:(.+?)\[\/\1\])?/', $post->post_content, $galleryInfo);

		if($hasGallery)
		{
			return new PJGallery($galleryInfo[2], $post->ID);
		}
		return null;
	}
	
	public function setAttributes($setAttributes, $id = null)
	{
		global $post;
		
		$defaultID = ($id == null)? $post->ID : $id;
		
		//if $attributes is not already parsed to an array, do it now.
		if(!is_array($setAttributes))
		{
			$setAttributes = shortcode_parse_atts($setAttributes);
		}
		$defaultLinkTo = get_option('pj_linkto');
		$defaultColumns = get_option('pj_gallery_columns');
		$defaultSize = get_option('pj_gallery_size');
		if($defaultSize == 'default')
		{
			$defaultSize = 'thumbnail';
		}
		else if($defaultSize == 'custom')
		{
			$defaultSize = get_option('pj_custom_width').'x'.get_option('pj_custom_height');
			if(get_option('pj_custom_crop')=='true')
			{ 
				$defaultSize.='xcrop';
			}
		}
		
		$attributes = shortcode_atts(array(
				'order'      => 'ASC',
				'orderby'    => 'menu_order ID',
				'id'         => $defaultID,
				'itemtag'    => 'dl',
				'icontag'    => 'dt',
				'captiontag' => 'dd',
				'columns'    => $defaultColumns,
				'size'       => $defaultSize,
				'linkto'       => $defaultLinkTo,
				'showchildren'    => 'false',
				'exclude'       => '',
				'offset'       => 0,
				'limit'       => -1
			), $setAttributes);
		
		//we want the offset to work even if there is no limit set
		if($attributes['offset'] > 0 && $attributes['limit'] == -1)
			$attributes['limit'] = PHP_INT_MAX; //assuming this will be less than MySQL's max of 18446744073709551615
			
		$this->attributes = apply_filters('PJ-gallery-attributes', $attributes, $setAttributes);	
	}
	
	public function viewerEnabled()
	{
		if($this->attributes['linkto'] == 'viewer')
			return true;
			
		return false;
	}
}

class PJGalleryItem
{
	public $linkto;
	public $imageID;
	public $galleryID;
	public $title;
	public $caption;
}
	
?>