<?php 
	
	add_action('rest_api_init', 'saarbaktSearch');

	function saarbaktSearch() {
		register_rest_route('saarbakt', 'search', array(
			'methods' => WP_REST_SERVER::READABLE,
			'callback' => 'saarbaktSearchResults',
		));
	}

	function saarbaktSearchResults($data) {
			$mainQuery = new WP_Query(array(
				'post_type' => array('post', 'page', 'nieuwtje', 'tipstricks'),
				's' => sanitize_text_field($data['term']),
			)); 

			$results = array(
				'generalInfo' => array(),
				'allenieuwtjes' => array(),
				'alletipstricks' => array(),
			);

			while($mainQuery->have_posts()) {
				$mainQuery->the_post();

				if (get_post_type() == 'post' OR get_post_type() =='page') {
				array_push($results['generalInfo'], array(
					'title' => get_the_title(),
					'excerpt' => wp_trim_words(get_the_content(), 20),
					'permalink' => get_the_permalink(),
					'postType' => get_post_type(),
					'authorName' => get_the_author(),
				));
			}

			if (get_post_type() == 'nieuwtje') {
				array_push($results['allenieuwtjes'], array(
					'title' => get_the_title(),
					'excerpt' => wp_trim_words(get_the_content(), 20),
					'permalink' => get_the_permalink(),
					'postType' => get_post_type(),
					'authorName' => get_the_author(),

				));
			}

			if (get_post_type() == 'tipstricks') {
				array_push($results['alletipstricks'], array(
					'title' => get_the_title(),
					'excerpt' => wp_trim_words(get_the_content(), 20),
					'permalink' => get_the_permalink(),
					'postType' => get_post_type(),
					'authorName' => get_the_author(),
				));
			}
		}		

	return $results;
}