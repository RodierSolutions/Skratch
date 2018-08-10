<?php
/**
 * Template Name: 
 *
 * Description: This is the default template used for the page selected as the static homepage.
 * 
 * 
 * @package WordPress
 * @subpackage skratch
 * @since Skratch 1.0
 */
?>

<?php get_header(); ?>

  <section class="page-content">
    <h1><?php echo get_the_title(); ?></h1>
    <br />
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
      echo the_content();
    endwhile; else: ?>
      <p>Sorry, there doesn't seem to be any content on this page. Try again later!</p>
    <?php endif; ?>
  </section>

<?php get_footer(); ?>
