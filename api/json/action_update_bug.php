<?php

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

if ( !access_has_project_level( 
		config_get( 'roadmap_update_threshold' ), 
		$t_bug_data->project_id ) ) {

			echo json_encode(array('result'=>'failed'));
			json_exit();
}


# Mark the added issue as visited so that it appears on the last visited list.
last_visited_issue( $t_bug_id );


$t_old_status = $t_bug_data->status;
$t_bug_data->status	= json_get_int( 'status', $t_bug_data->status );
//updating the status is optional
if ($t_bug_data->status != $t_old_status) {
	$t_bug_data->update();
}

$f_bugnote_text		= json_get_string( 'bugnote_text', '' );
if ($f_bugnote_text != '') {
	bugnote_add( $t_bug_id, $f_bugnote_text, '0:00', false, 0, '', NULL, FALSE );
}

$t_output['result'] =  lang_get( 'operation_successful' ) ;
$t_output['bug_id'] =  $t_bug_id;
echo json_encode($t_output);
json_exit();
