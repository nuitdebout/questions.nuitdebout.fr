<?php

require_once QA_INCLUDE_DIR.'db/selects.php';
require_once QA_INCLUDE_DIR.'app/format.php';
require_once QA_INCLUDE_DIR.'app/q-list.php';

class qa_69mars
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
				'title' => '69 mars',
				'request' => '69mars',
				'nav' => 'M', // 'M'=main, 'F'=footer, 'B'=before main, 'O'=opposite main, null=none
			),
		);
	}


	public function match_request($request)
	{
		return $request == '69mars';
	}


	public function process_request($request)
	{
		$qa_content = qa_content_prepare();

		$start = qa_get_start();
		$userid = qa_get_logged_in_userid();
		$categoryslugs = ['propositions-69-mars-paris'];
		$selectsort = 'netvotes';

		list($questions, $categories, $categoryid) = qa_db_select_with_pending(
			qa_db_qs_selectspec($userid, $selectsort, $start, $categoryslugs, null, false, false, qa_opt_if_loaded('page_size_qs')),
			qa_db_category_nav_selectspec($categoryslugs, false, false, true),
			qa_db_slugs_to_category_id_selectspec($categoryslugs)
		);

		$qa_content['title'] = qa_lang_html('69mars/page_title');
		$qa_content['custom'] = qa_lang('69mars/custom');
		$qa_content['sidepanel'] = qa_lang('69mars/sidepanel');
		$qa_content['sidebar'] = null;

		$keep = ['ask', 'admin'];
		foreach ($qa_content['navigation']['main'] as $key => $value) {
			if (!in_array($key, $keep))
				unset($qa_content['navigation']['main'][$key]);
		}

		$qa_content['navigation']['main']['ask']=array(
			'url' => qa_path_html('69mars-ask'),
			'label' => qa_lang_html('69mars/nav_ask'),
		);

		$page_content = qa_q_list_page_content(
			$questions, // questions
			qa_opt('page_size_qs'), // questions per page
			$start, // start offset
			$categories[$categoryid]['qcount'], // total count
			$sometitle, // title if some questions
			$nonetitle, // title if no questions
			$categories, // categories for navigation
			$categoryid, // selected category id
			true, // show question counts in category navigation
			null, // $categorypathprefix, // prefix for links in category navigation
			null, //$feedpathprefix, // prefix for RSS feed paths
			null, // $countslugs ? qa_html_suggest_qs_tags(qa_using_tags()) : qa_html_suggest_ask($categoryid), // suggest what to do next
			[], // extra parameters for page links
			[] // category nav params
		);

		$qa_content['q_list'] = $page_content['q_list'];
		$qa_content['suggest_next'] = 'Commencer par <a href="'.qa_path_html('69mars-ask').'">ajouter une proposition</a>';

		return $qa_content;
	}
}
