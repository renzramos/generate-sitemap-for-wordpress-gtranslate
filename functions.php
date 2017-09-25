<?php
// on post generate new sitemap
function save_post_generate_sitemap( $ID, $post ) {
   $generate  = file_get_contents(home_url() . '/generate-sitemap.php');
}
add_action( 'save_post', 'save_post_generate_sitemap', 10, 2 );
?>
