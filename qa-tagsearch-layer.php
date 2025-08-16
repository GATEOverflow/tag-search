<?php

class qa_html_theme_layer extends qa_html_theme_base {

	function head_custom()
	{
		qa_html_theme_base::head_custom();
		$this->output('<style type="text/css">'.qa_opt('tagsearch_plugin_css').'</style>');
	}
	
	function body_suffix()
	{
		qa_html_theme_base::body_suffix();

		$template = '<a href="#" class="qa-tag-link" onclick="return qa_tag_search_click(this);">^</a>';

		$this->output('
			<script>
				var qa_tags_search_examples = "";
				if (typeof qa_tags_complete === "undefined") {
					var qa_tags_complete = "";
				}
				var qa_tag_search_template = \'' . $template . '\';
			</script>
		');

		$this->output('<script async type="text/javascript" src="' . QA_HTML_THEME_LAYER_URLTOROOT . 'js/tag-search.min.js?v=3"></script>');

		$ajaxUrl = qa_path('qa_tagsearch_ajax_page');

		$this->output('
			<script type="text/javascript">
				document.addEventListener("DOMContentLoaded", function () {
					const tagSearchInput = document.getElementById("tag_search");

					if (tagSearchInput) {
						tagSearchInput.addEventListener("click", function () {
							if (typeof qa_tags_complete === "undefined" || qa_tags_complete === "") {
								fetch("' . $ajaxUrl . '", {
									method: "POST",
									headers: {
										"Content-Type": "application/x-www-form-urlencoded"
									},
									body: "ajax=hello"
								})
								.then(function (response) {
									if (!response.ok) throw new Error("Network response was not ok");
									return response.text();
								})
								.then(function (data) {
									qa_tags_complete = data;
								})
								.catch(function (error) {
									console.error("server: ajax error", error);
								});
							}
						});
					}
				});
			</script>
		');
	}
}
