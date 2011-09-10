<?php
	class qa_random_question_admin {

		function option_default($option) {
			
			switch($option) {
				case 'random_question_title':
					return 'Random Question';
				case 'random_question_number':
					return '1';
				default:
					return null;				
			}
			
		}
		
		function allow_template($template)
		{
			return ($template!='admin');
		}	   
			
		function admin_form(&$qa_content)
		{					   
							
		// Process form input
			
			$ok = null;
			
			if (qa_clicked('random_question_save')) {
				qa_opt('random_question_number',qa_post_text('random_question_number'));
				qa_opt('random_question_title',qa_post_text('random_question_title'));
				$ok = qa_lang_html('admin/options_saved');
			}
			
					
			// Create the form for display
			
			$fields = array();
			
			$fields[] = array(
				'label' => 'Number of questions to show',
				'tags' => 'NAME="random_question_number"',
				'value' => qa_opt('random_question_number'),
				'type' => 'number',
			);
			$fields[] = array(
				'label' => 'Widget title',
				'tags' => 'NAME="random_question_title"',
				'value' => qa_opt('random_question_title'),
				'type' => 'text',
			);

			return array(		   
				'ok' => ($ok && !isset($error)) ? $ok : null,
					
				'fields' => $fields,
			 
				'buttons' => array(
					array(
						'label' => 'Save',
						'tags' => 'NAME="random_question_save"',
					)
				),
			);
		}
	}

