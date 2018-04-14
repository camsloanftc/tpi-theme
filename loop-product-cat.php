<article class="loop-post cat-col-<?php echo $post->term_id; ?> cc-border cc-headings cc-buttons cc-links">

	<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

	<p><?php echo get_field('blurb', 'product_cat_' . $post->term_id); ?></p>

	<a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>" class="button post-read">View Products</a>

</article>
