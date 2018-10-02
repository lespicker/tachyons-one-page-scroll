<?php

class ImageShortcode
{
	private $mode;
	private $defaultLinkTo;
	private $insertShortcode;
	
	function __construct()
	{
		$this->defaultLinkTo=get_option('pj_linkto_single');
		$this->insertShortcode=get_option('pj_insert_image');
		$this->mode='shortcode';
	}
	
	public function imageShortcodeHandler( $atts, $content = null ) 
	{
		global $pjStatus;
		extract(shortcode_atts(array(
			'id' => '0', 
			'size' => 'thumbnail',
			'title' => null,
			'align' => 'left',
			'alt' => null,
			'linkto' => $this->defaultLinkTo), $atts ) );
		
		$this->mode = 'html';
		$html = get_image_tag($id, $alt, $title, $align, $size);
		$this->mode = 'shortcode';
		
		$url = LinkUtility::imageLink($id, $linkto);
		
		if($url)
			$html = '<a href="'.attribute_escape($url).'" >'.$html.'</a>';
		
		if($linkto == 'viewer')
			$html = LinkUtility::whateverBox($html);
			
		return $html;
	}
	
	public function generateTagForEditor($html, $id, $alt, $title, $align, $url, $size) //image_send_to_editor filter
	{
		if($this->mode == 'shortcode' && $this->insertShortcode == 'true')
		{
			$html = '[image title="'.$title.'" size="'.$size.'" id="'.$id.'" align="'.$align.'" ';
			if($alt)
				$html .= 'alt="'.$alt.'" ';
			
			$image = wp_get_attachment_url($id);
			if($url == $image)
			{
				if($this->defaultLinkTo == 'viewer')
					$html .= 'linkto="viewer" ';
				else
					$html .= 'linkto="full" ';
			}
			else if($url == get_attachment_link($id))
			{
				$html .= 'linkto="default" ';
			}
			else if($url)
			{
				$html .= 'linkto="'.$url.'" ';
			}
			$html .= ']';
		}
		return $html;
	}
}