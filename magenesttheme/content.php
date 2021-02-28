<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php magenest_thumbnail('thumbnail'); ?>
    </div>
    <div class="entry-header">
        <?php magenest_entry_header(); ?>
        <?php magenest_entry_meta(); ?>
    </div>
    <div class="entry-content">
        <?php magenest_content(); ?>
    </div>
</article>