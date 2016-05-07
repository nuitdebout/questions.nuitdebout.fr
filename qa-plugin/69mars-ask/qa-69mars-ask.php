<?php

require_once QA_INCLUDE_DIR.'db/selects.php';
require_once QA_INCLUDE_DIR.'app/format.php';
require_once QA_INCLUDE_DIR.'app/q-list.php';

class qa_69mars_ask
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
				'title' => '69 mars - Ask',
				'request' => '69mars-ask',
				'nav' => 'M', // 'M'=main, 'F'=footer, 'B'=before main, 'O'=opposite main, null=none
			),
		);
	}


	public function match_request($request)
	{
		return $request == '69mars-ask';
	}


	public function process_request($request)
	{
		$qa_content = include QA_INCLUDE_DIR.'pages/ask.php';

		$categoryslugs = ['propositions-69-mars-paris'];

		$categoryid = qa_db_select_with_pending(qa_db_slugs_to_category_id_selectspec($categoryslugs));

		$qa_content['title'] = $qa_content['form']['buttons']['ask']['label'] = 'Ajouter une proposition';
		$qa_content['form']['fields']['title']['label'] = 'La proposition en une phrase';
		$qa_content['form']['fields']['content']['label'] = 'Plus d\'informations sur la proposition';

		$qa_content['sidebar'] = null;
		$qa_content['sidepanel'] = qa_lang('69mars/sidepanel');

		$qa_content['form']['fields']['custom'] = [
			'type' => 'custom',
			'note' => qa_lang('69mars/custom')
		];

		unset($qa_content['form']['fields']['category']);
		$qa_content['form']['hidden']['category_'.$categoryid] = $categoryid;

		unset($qa_content['body_header']);

		return $qa_content;
	}
}
