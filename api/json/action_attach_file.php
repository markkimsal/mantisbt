<?php

global $g_json_file_tmp_name;
$g_json_file_tmp_name = '';

access_ensure_project_level( config_get('report_bug_threshold' ) , $project_id, $user_id);

$t_bug_id = json_get_int('bug_id');
if ($t_bug_id < 1 ) {
	echo json_encode(array('result'=>'failed'));
	json_exit();
}
$t_bug_data =  bug_get($t_bug_id);

if ($t_bug_data->id < 1 ) {
	echo json_encode(array('result'=>'failed'));
	json_exit();
}

$f_file                    = json_get_file( 'file', null ); /** @todo (thraxisp) Note that this always returns a structure */

if ( !access_has_project_level( 
		config_get( 'roadmap_update_threshold' ), 
		$t_bug_data->project_id ) ) {

			echo json_encode(array('result'=>'failed'));
			json_exit();
}


# Mark the added issue as visited so that it appears on the last visited list.
last_visited_issue( $t_bug_id );

# Handle the file upload
if ( !is_blank( $f_file['tmp_name'] ) && ( 0 < $f_file['size'] ) ) {
	file_add( $t_bug_id, $f_file, 'bug' );
}

$t_output['result'] =  lang_get( 'operation_successful' ) ;
$t_output['bug_id'] =  $t_bug_id;

echo json_encode($t_output);
json_exit();
