<?php

    class qa_random_questions {

        function allow_template($template)
        {

            $allow=true;
            
            return $allow;
        }

        function allow_region($region)
        {
            return ($region=='side');
        }

        function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
        {
            $temp = qa_db_query_sub(
				'SELECT BINARY title as title, postid, netvotes, acount FROM ^posts WHERE type=$',
                'Q'
			);
            $max = mysql_num_rows($temp);
            if(!$max) return;
            
            $themeobject->output('<h2>'.qa_opt('random_question_title').'</h2>');

            for($i=0;$i < qa_opt('random_question_number'); $i++) {
                
                $rand = rand()/getrandmax()*$max;
                $check = mysql_data_seek(
                    $temp,$rand
                );
                if(!check) $i--;
                else $random_question = qa_db_read_one_assoc($temp,true);
                
                if (is_array($random_question)) {
                    $votes = (int)$random_question['netvotes'];
                    if($votes>0) {
                        if($votes > 1) $votes = str_replace('^','+'.$votes,qa_lang('main/x_votes'));
                        else $votes = '+'.qa_lang('main/1_vote');
                    }
                    else if($votes<0) {
                        if($votes < -1) $votes = str_replace('^',$votes,qa_lang('main/x_votes'));
                        else $votes = '-'.qa_lang('main/1_vote');
                    }
                    else $votes = '';
                    
                    $answers = (int)$random_question['acount'];
                    if($answers>0) {
                        if($answers > 1) $answers = str_replace('^','+'.$answers,qa_lang('main/x_answers'));
                        else $answers = qa_lang('main/1_answer');
                    }
                    else $answers = '';
                    
                    $themeobject->output('<div class="random-question" style="padding-bottom:4px;"><a href="'.qa_path_html(qa_q_request($random_question['postid'], $random_question['title'])).'">'.$random_question['title'].'</a></div><div class="random-question-meta" style="padding-bottom:4px; border-bottom:1px solid; margin-bottom:2px;">'.$votes.($votes&&$answers?', ':'').$answers.'</div>');
                }
            }
        }
    };


/*
    Omit PHP closing tag to help avoid accidental output
*/
