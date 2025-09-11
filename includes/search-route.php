<?php 
add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch() {
	register_rest_route('university/v1', 'search', array(
		'methods'  => WP_REST_SERVER::READABLE,
		'callback' => 'universitySearchResults',
	) );
}

function universitySearchResults($data) {
	$searchTerm = $data['term'];
	$mainQuery = new WP_Query(array(
		'post_type' => array('post', 'page', 'professor', 'program', 'event'),
        's' => sanitize_text_field($searchTerm),
	));
	$results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
    );
	while ($mainQuery->have_posts()) {
		$mainQuery->the_post();
        if (get_post_type() == 'post' || get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author(),
            ));
        } 
        if (get_post_type() == 'professor') {
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape'),
            ));
        } 
        if (get_post_type() == 'program') {
            array_push($results['programs'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ));
        } 
        if (get_post_type() == 'event') {
            $eventDate = new DateTime(get_field('event_date'));
            $description = null;
            if (has_excerpt()) {
                $description = get_the_excerpt();
            } else {
                $description = wp_trim_words(get_the_content(), 18);
            }
            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'description' => $description,
            ));

        } 
    }
    // Reset post data after custom query
    wp_reset_postdata();
    // Return the results
    // echo json_encode($results); // For debugging purposes
    // die(); // For debugging purposes
    // Ensure the response is in the correct format

    if($results['programs']) {
        $programsMetaQuery = array('relation' => 'OR');
        foreach($results['programs'] as $item) {
            array_push($programsMetaQuery, array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
            ));
        }

        $programRelationshipQuery = new WP_Query(array(
            'post_type' => array('professor','event'),
            'meta_query' => $programsMetaQuery
        ));
        while ($programRelationshipQuery->have_posts()) {
            $programRelationshipQuery->the_post();
           if(get_post_type() == 'professor') {
               array_push($results['professors'], array(
                   'title' => get_the_title(),
                   'permalink' => get_the_permalink(),
                   'image' => get_the_post_thumbnail_url(0, 'professorLandscape'),
               ));
           }
             if (get_post_type() == 'event') {
            $eventDate = new DateTime(get_field('event_date'));
            $description = null;
            if (has_excerpt()) {
                $description = get_the_excerpt();
            } else {
                $description = wp_trim_words(get_the_content(), 18);
            }
            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'description' => $description,
            ));

        } 
        }
    $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));
    $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));
        wp_reset_postdata();
    }
	return rest_ensure_response($results);
}
?>