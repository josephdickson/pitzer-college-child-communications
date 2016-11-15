<?php
/**
 * modified by Joseph Dickson 05/22/14
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
// Check for ACF Function to pull in "publication_name"
if(function_exists('publication_name')) {
        $values = get_field( 'publication_name' );
}

else {

    echo 'Advanced Custom Fields is not installed or enabled for <strong>publication_name</strong> <br />';

}

$time = '<span class="time extra-small right">' . str_replace(array('am','pm'),array('a.m.','p.m.'),get_the_date(' F j, Y g:i a')) . '</span>' ;

$include = array( 'Spotlights', 'Press Releases', 'Video', 'In the News' ); // Only display these categories on box labels
$categories = get_the_category();
	$separator = ' | ';
	$output = '';
		if ( ! empty( $categories ) ) {
		    foreach( $categories as $category ) {
			if (in_array($category->cat_name, $include))
			$output .= '<a class="category" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
		}
		    echo trim( $output, $separator );
		    echo $time;
}
?>
	<div class="entry-content">
            <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( array(100,100) );
                    }
                if ( in_category('Video') ) {
                  get_template_part('acf/acf','video');
                }
		else { ?>
				<header>
					<h2><a class="block" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</header>
<?php }
            ?>
		<?php the_excerpt('Continue reading...'); ?>


<?php
				if ( is_single() ) {
					the_title( '<span class="entry-title">', '</span>' );
                    echo ( '<em>' . $values . '</em>' );
				} else {
					the_title( '<span class="entry-title">', '</span>' );
				}

			if ( 'post' === get_post_type() ) : ?>

			<?php
			endif; ?>
	</div>
	<footer>
		<?php $tag = get_the_tags(); if (!$tag) { } else { ?><p><?php the_tags(); ?></p><?php } ?>

		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit', 'communications-pitzer-college-child' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>

		<a href="<?php the_permalink(); ?>">Permalink</a>

	</footer>
</article>
