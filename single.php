<?php get_header(); ?>

<main>

<section class="section-padding">
	<div class="row">
		<div class="col span-8 col-margin">

			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
			?>

				<h2 class="post-title"><?php the_title(); ?></h2>

				<ul class="post-details">
					<li class="post-details-date"><?php e_svgi('calendar'); ?><?php the_time('F j\<\s\u\p\>S\<\/\s\u\p\>, Y'); ?></li>
					<li class="post-details-cats"><?php e_svgi('folder'); ?><?php echo get_the_category_list(', '); ?></li>
					<?php echo the_tags('<li class="post-details-tags">' . svgi('tags'), ', ', '</li>'); ?>
				</ul>

			<?php
			// Content
			the_content();
			?>

			<?php endwhile; else: ?>

				<p>Sorry, no posts matched your criteria.</p>

			<?php endif; ?>

		</div>
		<div class="col span-4">

			<?php get_sidebar('blog'); ?>

		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
