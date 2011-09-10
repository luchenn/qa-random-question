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
            $max = qa_db_read_one_value(
                qa_db_query_sub(
                    'SELECT MAX(postid) FROM ^posts'
                ),
                true
            );
            
            if(!$max) return;
            
            $themeobject->output('<h2>'.qa_opt('random_question_title').'</h2>');

            for($i=0;$i < qa_opt('random_question_number'); $i++) {
            
                $rand = rand()/getrandmax()*$max;
                $random_question = qa_db_read_one_assoc(
                    qa_db_query_sub(
                        'SELECT BINARY title as title, postid, netvotes, acount FROM ^posts WHERE type=$ AND postid >= # LIMIT 1',
                        'Q',$rand
                    ),
                    true
                );
                
                if (is_array($random_question)) {
                    $themeobject->output('<div class="random-question" style="padding-bottom:4px;"><a href="'.qa_path_html(qa_q_request($random_question['postid'], $random_question['title'])).'">'.$random_question['title'].'</a></div><div class="random-question-meta" style="padding-bottom:4px; border-bottom:1px solid; margin-bottom:2px;">'.($random_question['netvotes']>0?'+'.$random_question['netvotes'].' vote, ':(((int)$random_question['netvotes'])<0?$random_question['netvotes'].' vote, ':'')).$random_question['acount'].' answer'.($random_question['acount']==1?'':'s').'</div>');
                }
            }
        }
    };


/*
    Omit PHP closing tag to help avoid accidental output
*/
