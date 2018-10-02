<h4>Twittering</h4>
<?php require_once (ABSPATH . WPINC . '/rss-functions.php'); ?>
<?php $today = current_time('mysql', 1); ?>

<ul>
<?php
$rss = @fetch_rss('http://twitter.com/statuses/user_timeline/1487781.rss');
if ( isset($rss->items) && 0 != count($rss->items) ) {
?>

<?php
$rss->items = array_slice($rss->items, 0, 1);
foreach ($rss->items as $item ) {
?>
<li>
  <a title="my latest twitter" href='<?php echo wp_filter_kses($item['link']); ?>'>
  <?php echo wp_specialchars($item['title']); ?></a>
</li>


<?php
}
}
?>
</ul>