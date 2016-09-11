<?php
/*
 * Template Name: Home page
 */

$GLOBALS['melica_homepage_id'] = get_the_ID();
get_header();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
query_posts( 'post_type=post&post_status=publish&paged=' . $paged );

get_template_part( 'inc/featured-slider' );
get_template_part( 'index' );

get_footer();