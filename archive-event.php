<?php
get_header();
pageBanner(
	array(
		'title'    => 'All Events',
		'subtitle' => 'See What is going on in our worlds.',
	)
);
?>

<div class="container container--narrow page-section">
	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', 'event' );
	}
	?>
	<div class="pagination">
		<?php echo paginate_links(); ?>
		<hr class="section-break">
		<p>Looking for a recap of a past events? Check out our <a href="<?php echo site_url( '/past-events' ); ?>">past events archive</a>.</p>
	</div>
</div>

<?php get_footer();
?>
