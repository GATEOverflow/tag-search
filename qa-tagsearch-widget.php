<?php

class qa_tagsearch_widget {

	var $urltoroot;

	function load_module($directory, $urltoroot)
	{
		$this->urltoroot = $urltoroot;
	}

	function allow_template($template)
	{
		return true;
	}

	function allow_region($region)
	{
		return ($region=='side');
	}

	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{
		$field = [
			'tags' => 'id="exact-tag-match" name="exact-tag-match"',
			'type'  => 'checkbox',
			'value' => '0',
			'label' => 'Match the exact tag',
		];
		
		// Capture the output using output buffering
		ob_start();
		$themeobject->form_checkbox($field, 'tall');
		$checkbox_html = ob_get_clean();
		
		$searchIcon = '
			<svg xmlns="http://www.w3.org/2000/svg" class="qa-svg" height="24" width="24" viewBox="0 0 50 50">
				<path d="M39.8 41.95 26.65 28.8q-1.5 1.3-3.5 2.025-2 .725-4.25.725-5.4 0-9.15-3.75T6 18.75q0-5.3 3.75-9.05 3.75-3.75 9.1-3.75 5.3 0 9.025 3.75 3.725 3.75 3.725 9.05 0 2.15-.7 4.15-.7 2-2.1 3.75L42 39.75Zm-20.95-13.4q4.05 0 6.9-2.875Q28.6 22.8 28.6 18.75t-2.85-6.925Q22.9 8.95 18.85 8.95q-4.1 0-6.975 2.875T9 18.75q0 4.05 2.875 6.925t6.975 2.875Z"></path>
			</svg>
		';

		// Build the inner HTML
		$searchForm = '
			<div class="qa-tag-search">
				<form method="GET" action="' . qa_path('tag-search-page') . '">
					<div class="qa-search-container qa-tag-search-group">
						<input 
							type="text" 
							name="q" 
							id="tag_search" 
							autocomplete="off" 
							class="qa-tag-search-field"  
							placeholder="' . qa_lang('tagsearch_page/widget_input_placeholder') . '" 
						>
						
						<button 
							type="submit" 
							value="tagsearch" 
							class="qa-search-button no-select"
							title="' . qa_lang('tagsearch_page/search_button') . '"
						>' . $searchIcon . '</button>
					</div>
					
					<div class="qa-form-tall-label">
						<label for="exact-tag-match">
							' . $checkbox_html .  qa_lang('tagsearch_page/widget_match_tag') . '
						</label>
					</div>

					<div class="qa-form-tall-note2">
						<span id="tag_search_examples_title" style="display:none;"></span>
						<span id="tag_search_complete_title" style="display:none;"></span>
						<span id="tag_search_hints"></span>
					</div>
				</form>
			</div>
		';

		// Wrap the form in a container
		$widgetTitle = '<h2>' . qa_lang('tagsearch_page/widget_title') . '</h2>';
		$output = '<div class="tagsearch-widget-container">' . $widgetTitle . $searchForm . '</div>';

		// Output the final HTML using the theme object
		$themeobject->output($output);
	}
};


/*
   Omit PHP closing tag to help avoid accidental output
 */
