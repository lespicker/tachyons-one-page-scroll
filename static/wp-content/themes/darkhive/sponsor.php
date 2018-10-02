<li id="sponsorbox">
<h6><?php _e('Advertisements'); ?></h6>
<ul id="sponsor">

<?php $sponsor_banner = get_theme_option('sponsor_banner_one'); if($sponsor_banner == '') { ?>
<li class="noarrow"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/banner_125x125.gif" alt="Sponsor Banner" /></a></li>
<?php } else { ?>
<li class="noarrow"><?php echo stripcslashes($sponsor_banner); ?></li>
<?php } ?>

<?php $sponsor_banner = get_theme_option('sponsor_banner_two'); if($sponsor_banner == '') { ?>
<li class="noarrow"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/banner_125x125.gif" alt="Sponsor Banner" /></a></li>
<?php } else { ?>
<li class="noarrow"><?php echo stripcslashes($sponsor_banner); ?></li>
<?php } ?>

<?php $sponsor_banner = get_theme_option('sponsor_banner_three'); if($sponsor_banner == '') { ?>
<li class="noarrow"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/banner_125x125.gif" alt="Sponsor Banner" /></a></li>
<?php } else { ?>
<li class="noarrow"><?php echo stripcslashes($sponsor_banner); ?></li>
<?php } ?>

<?php $sponsor_banner = get_theme_option('sponsor_banner_four'); if($sponsor_banner == '') { ?>
<li class="noarrow"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/banner_125x125.gif" alt="Sponsor Banner" /></a></li>
<?php } else { ?>
<li class="noarrow"><?php echo stripcslashes($sponsor_banner); ?></li>
<?php } ?>

<?php $sponsor_banner = get_theme_option('sponsor_banner_five'); if($sponsor_banner == '') { ?>
<li class="noarrow"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/banner_125x125.gif" alt="Sponsor Banner" /></a></li>
<?php } else { ?>
<li class="noarrow"><?php echo stripcslashes($sponsor_banner); ?></li>
<?php } ?>

<?php $sponsor_banner = get_theme_option('sponsor_banner_six'); if($sponsor_banner == '') { ?>
<li class="noarrow"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/banner_125x125.gif" alt="Sponsor Banner" /></a></li>
<?php } else { ?>
<li class="noarrow"><?php echo stripcslashes($sponsor_banner); ?></li>
<?php } ?>

</ul>
</li><!-- SPONSORBOX END -->