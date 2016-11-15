<?php
/*
Template Name: News Landing Page
*/
get_header(); ?>
<!-- Row for main content area - news.php -->

	<div class="news small-12 large-9 columns" role="main">

	    	<article>
		    	<header>

		                    <?php if ( function_exists('yoast_breadcrumb') ) {
		    		yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>

		                <h1 class="entry-title"><?php the_title(); ?></h1>

		    	</header>

				<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
		'post_type'           =>	'post',
		'category_name'       =>	'press-release', // categories in order of numbers at left: press-releases, video-gallery, spotlights, In the News
		'posts_per_page'      =>	'10',
		'paged'               =>	$paged,
	);
	$query = new WP_Query( $args );

				// The Query
				$the_query = new WP_Query( $args );
				// The Loop
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						get_template_part( 'template-parts/news-categories' );
					}
				} else {
					// no posts found
				}
				/* Restore original Post Data */
				wp_reset_postdata();
				?>

<div class="row">

	<div class="small-12 columns">

            <nav id="post-nav">

				<div class="nav-previous"><?php previous_posts_link( 'Newer posts' ); ?></div>

				<div class="nav-next"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>

            </nav>

	</div>

</div>

		</article>

	</div>

		<div class="small-12 large-3 columns menu accordion-menu active">
			<?php dynamic_sidebar("section-menu"); ?>
		</div>

<?php get_footer(); ?>
