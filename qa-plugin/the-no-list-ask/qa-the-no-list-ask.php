<?php

require_once QA_INCLUDE_DIR.'db/selects.php';
require_once QA_INCLUDE_DIR.'app/format.php';
require_once QA_INCLUDE_DIR.'app/q-list.php';

class the_no_list_ask
{
	private $directory;
	private $urltoroot;


	public function load_module($directory, $urltoroot)
	{
		$this->directory=$directory;
		$this->urltoroot=$urltoroot;
	}


	public function suggest_requests() // for display in admin interface
	{
		return array(
			array(
				'title' => 'The #Nolist - add an alternative',
				'request' => 'the-no-list-ask',
				'nav' => 'M', // 'M'=main, 'F'=footer, 'B'=before main, 'O'=opposite main, null=none
			),
		);
	}


	public function match_request($request)
	{
		return $request == 'the-no-list-ask';
	}


	public function process_request($request)
	{
		$qa_content = include QA_INCLUDE_DIR.'pages/ask.php';

		$categoryslugs = ['the-no-list'];

		$categoryid = qa_db_select_with_pending(qa_db_slugs_to_category_id_selectspec($categoryslugs));

		$qa_content['title'] = $qa_content['form']['buttons']['ask']['label'] = 'Add a brand to the #Nolist';
		$qa_content['form']['fields']['title']['label'] = 'Please use <strong>#NObrand</strong> and no brand. Ex: #NOcocacola NO Coca Cola';
		$qa_content['form']['fields']['content']['label'] = 'More details (optional)';
		$qa_content['form']['fields']['tags']['label'] = 'Tags - Please add at least one (max 5 tags allowed).';

		$qa_content['sidebar'] = null;
		$qa_content['sidepanel'] = qa_lang('the-no-list/sidepanel');

		// $qa_content['form']['fields']['custom'] = [
		// 	'type' => 'custom',
		// 	'note' => qa_lang('69mars/custom')
		// ];

		unset($qa_content['form']['fields']['category']);
		$qa_content['form']['hidden']['category_'.$categoryid] = $categoryid;

		unset($qa_content['body_header']);

		return $qa_content;
	}
}
