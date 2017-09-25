<?php
// on post generate new sitemap
function save_post_function( $ID, $post ) {
   
    $ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, home_url() . '/generate-sitemap.php');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    // grab URL and pass it to the browser
    curl_exec($ch);
    
    // close cURL resource, and free up system resources
    curl_close($ch);
}
//add_action( 'save_post', 'save_post_function', 10, 2 );
?>
