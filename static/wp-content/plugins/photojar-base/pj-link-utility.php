<?php
class LinkUtility
{
	public static function whateverBox($content, $viewer=null)
	{	
		global $post;
		if($viewer==null)
			$viewer=get_option('pj_viewer');
			
		if($viewer=='none')
			return $content;

		if($viewer=='custom')
		{
			$theClass=get_option('pj_custom_class');
			$theRel=get_option('pj_custom_rel');
		}
		else
		{
			$theClass=$viewer;
			$theRel=$viewer;
		}
		
		if($viewer == 'thickbox')
		{
			$groupPre = '-';
			$groupPost = '';
		}
		else
		{
			$groupPre = '[';
			$groupPost = ']';
		}
		
		$pattern[0] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)>/i";
		$pattern[1] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")(.*?)(rel=('|\")".$theRel."(.*?)('|\"))([ \t\r\n\v\f]*?)((rel=('|\")".$theRel."(.*?)('|\"))?)([ \t\r\n\v\f]?)([^\>]*?)>/i";
		$replacement[0] = '<a$1href=$2$3$4$5$6 rel="'.$theRel.$groupPre.$post->ID.$groupPost.'" >';
		$replacement[1] = '<a$1href=$2$3$4$5$6$7 >';
		if($linkTo!='lightbox' && $theClass!='')
		{
			$pattern[2] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)>/i";
			$pattern[3] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")(.*?)(class=('|\"))(.*?)(?=(".$theClass.")|('|\"))(".$theClass.")?((.*?)('|\")([ \t\r\n\v\f]*?))((class=('|\")".$theClass."(.*?)('|\")))([ \t\r\n\v\f]?)([^\>]*?)>/i";
			$replacement[2] = '<a$1href=$2$3$4$5$6 class="'.$theClass.'">';
			$replacement[3] = '<a$1href=$2$3$4$5$6$7'.$theClass.' $9$13>';
		}
		$content = preg_replace($pattern, $replacement, $content);
		return $content;
	}
	
	public static function imageLink($id, $linkTo)
	{
		$url = '';
		if($linkTo == 'none' || $linkTo == '')
			return false;
		else if($linkTo == 'default')
			$url = get_attachment_link($id);
		else if($linkTo == 'full' || $linkTo == 'viewer') {
			$image = (wp_get_attachment_image_src($id, 'full', false));
			$url = $image[0]; }
		else
			$url = $linkTo;
			
		return $url;
	}
}
?>