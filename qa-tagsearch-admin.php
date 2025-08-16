<?php
class qa_tagsearch_admin {

	function allow_template($template)
	{
		return ($template!='admin');
	}

	function option_default($option) {

		switch($option) {
			case 'tagsearch_plugin_css':
return '
.qa-tag-search-group {
    position: relative;
}

.tagsearch-widget-container #tag_search {
    border: none;
    width: 100%;
    max-width: 100%;
    background-color: #f1f3f4;
    padding: .8rem 2.5rem .8rem .8rem; /* give space for search icon */
    margin-bottom: .5rem;
    border-radius: 6px;
}

.qa-tag-search-group .qa-search-button {
    position: absolute;
    right: 2px; /* border */
    top: 50%;
    transform: translateY(-50%);
	border-radius: 6px;
}

.qa-tag-search .qa-tag-link, .qa-tag-search a.qa-tag-link {
    margin-top: .5rem;
    margin-bottom: 0;
}
';
			default:
				return null;

		}
	}
	
	function admin_form(&$qa_content)
	{

		//	Process form input
		$ok = null;
		if (qa_clicked('tagsearch_save_button')) {
			qa_opt('tagsearch_plugin_css',qa_post_text('tagsearch_plugin_css'));
			$ok = qa_lang('admin/options_saved');
		}
		else if (qa_clicked('tagsearch_reset_button')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}
		
		//	Create the form for display
		$fields = array();

		$fields[] = array(
				'label' => 'Tag Search custom css',
				'tags' => 'NAME="tagsearch_plugin_css"',
				'value' => qa_opt('tagsearch_plugin_css'),
				'type' => 'textarea',
				'rows' => 20
				);

		return array(
				'ok' => ($ok && !isset($error)) ? $ok : null,

				'fields' => $fields,

				'buttons' => array(
					array(
						'label' => qa_lang_html('main/save_button'),
						'tags' => 'NAME="tagsearch_save_button"',
					     ),
					array(
						'label' => qa_lang_html('admin/reset_options_button'),
						'tags' => 'NAME="tagsearch_reset_button"',
					     ),
					),
			    );
	}
	
	function getMyPath($location) { 
		$getMyPath = str_replace($_SERVER['DOCUMENT_ROOT'],'',$location); 
		return $getMyPath; 
	} 

}
