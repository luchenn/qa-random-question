<?php

	class qa_random_questions {

		function allow_template($template)
		{
			$allow=false;
			
			switch ($template)
			{
				case 'activity':
				case 'qa':
				case 'questions':
				case 'hot':
				case 'ask':
				case 'categories':
				case 'question':
				case 'tag':
				case 'tags':
				case 'unanswered':
				case 'user':
				case 'users':
				case 'search':
				case 'admin':
					$allow=true;
					break;
			}
			
			return $allow;
		}

		function allow_region($region)
		{
			return ($region=='side');
		}

		function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
		{
            $random_question = qa_db_read_one_assoc(
                qa_db_query_sub(
                    'SELECT * FROM ^posts WHERE type=$ ORDER BY rand() LIMIT 1',
                    'Q'
                ),
                true
            );

			if (is_array($random_question)) {
				$themeobject->output('<hr/><h2>Random Question</h2>');
				$themeobject->output('<p style="margin:0 0 10px 0; font-weight:bold;"><a href="'.qa_path_html(qa_q_request($random_question['postid'], $random_question['title'])).'">'.$random_question['title'].'</a></p><p>'.($random_question['netvotes']>0?'+'.$random_question['netvotes'].' vote, ':(((int)$random_question['netvotes'])<0?$random_question['netvotes'].' vote, ':'')).$random_question['acount'].' answer'.($random_question['acount']==1?'':'s').'</p><hr/>');
			}
		}
	};


/*
	Omit PHP closing tag to help avoid accidental output
*/
