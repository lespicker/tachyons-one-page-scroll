<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php bloginfo('name'); ?>: <?php bloginfo('description'); ?></title>
        
        <!-- Usual WP META -->
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
        <link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
        <!-- Javascript -->
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.jfade.1.0.min.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.masonry.min.js"></script>

        
        <!-- CSS -->
        <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="screen" />
        
        <script language="javascript">

		$(document).ready(function() {
		
			$(".post").jFade({
				trigger: "mouseover",
				property: 'background',
				start: 'f5d312',
				end: 'ffffff',
				steps: 8,
				duration: 8
			}).jFade({
				trigger: "mouseout",
				property: 'background',
				start: 'ffffff',
				end: 'f5d312',
				steps: 8,
				duration: 8
			});
			
			// set width of posts and initiate stacking
			$('.post').css('width','220px');
			$('.postWrap').masonry({
				singleMode: true,
				itemSelector: '.post' 
			});
			
		});
		
		</script>
		
		<script>
		  $(document).ready(function(){
			$(".post").css({opacity: 0});
			$(".post").fadeTo("slow", 1); 
		  });
		 </script>

        
        <!-- WP Head -->
    	<?php wp_head(); ?>
	</head>
    
    <body>
    
    <div id="header">
        <div class="blogInfo">
            <p><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> | <?php bloginfo('description'); ?></p>
        </div>
        <div class="pages">
            <h3>Menu</h3>
            <ul>
                <li class="first"><a href="<?php bloginfo('url'); ?>">Home</a></li>
                <?php wp_list_pages('title_li=&depth=1'); ?>
            </ul>
        </div>
        <div class="categories">
            <h3>Categories</h3>
            <?php wp_dropdown_categories('show_option_none=Select Category'); ?>

				<script type="text/javascript"><!--
                var dropdown = document.getElementById("cat");
                function onCatChange() {
                    if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                        location.href = "<?php echo get_option('home');
            ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
                    }
                }
                dropdown.onchange = onCatChange;
            --></script>
    
        </div>
        
        <div class="categories">
            
            <h3>Archives</h3>
            <select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
                <option value=""><?php echo attribute_escape(__('Select Month')); ?></option>
                <?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
        </div>	
        
        <div class="search">
            <h3>Search</h3>
            <form method="get" class="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" value="Search term..." name="s" class="s" onblur="if(this.value=='')this.value='Search term...';" onfocus="if(this.value=='Search term...')this.value='';" />
            </form>
        </div>
        
    </div>
    
    <div id="foliogrid"></div>
    
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#foliogrid .post').click(function(){
            href = $(this).children('div').children("a[rel='bookmark']").attr('href');
            if (href != undefined)
            {
                window.location = href; 
            }
        }).hover(function(){
            $(this).css('cursor', 'pointer');
        }, function(){
            $(this).css('cursor', 'default');        
        });
    });
    </script>
    
    

   
    