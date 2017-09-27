<?php
/* 
* Name: Generate Sitemap for GTranslate.io
* Author: Renz Ramos
* Version : 1.0
*/

define('WP_USE_THEMES', true);
require( 'wp-load.php' );
$data = get_option('GTranslate');
$languages = $data['fincl_langs'];
$output = '';

$output.='<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 
$output.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' .PHP_EOL; 
 
foreach ($languages as $language){
    
    if ($language == "en") continue;
    
    $post_types = array('page','post');
   
    foreach ($post_types as $post_type){
        $args = array(
            'post_type' => array( $post_type ),
            'post_status' => array( 'publish'),
            'posts_per_page' => -1
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); 
               $url = str_replace(home_url('/'), home_url(). '/' . $language . '/', get_permalink());
               $output.= urlElement($url);
            endwhile; 
            wp_reset_postdata();
        endif; 
    }
    
}

$output.='</urlset>'; 
$sitemap = fopen("generated-sitemap.xml", "w") or die("Unable to open file!");
$write_status =  fwrite($sitemap, $output);
fclose($sitemap);

echo 'Sitemap Generated!';

function urlElement($url) {
    $url_output = '';
    $url_output.='<url>'.PHP_EOL; 
    $url_output.='<loc>'.$url.'</loc>'. PHP_EOL; 
    $url_output.='<changefreq>weekly</changefreq>'.PHP_EOL; 
    $url_output.='</url>'.PHP_EOL;
    return $url_output;
} 
?>
