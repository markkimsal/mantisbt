<?php



# MantisBT - a php based bugtracking system

# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @copyright Copyright (C) 2000 - 2002  Kenzaburo Ito - kenito@300baud.org
 * @copyright Copyright (C) 2002 - 2011  MantisBT Team - mantisbt-dev@lists.sourceforge.net
 * @link http://www.mantisbt.org
 * @package MantisBT
 */

access_ensure_project_level( config_get('report_bug_threshold' ) , $project_id, $user_id);

/**
 * requires current_user_api
 */
//require_once( 'current_user_api.php' );
/**
 * requires bug_api
 */
// require_once( 'bug_api.php' );
/**
 * requires string_api
 */
//require_once( 'string_api.php' );
/**
 * requires date_api
 */
//require_once( 'date_api.php' );
/**
 * requires icon_api
 */
//require_once( 'icon_api.php' );

$t_filter = current_user_get_bug_filter();
if( $t_filter === false ) {
	$t_filter = filter_get_default();
}

$t_sort = $t_filter['sort'];
$t_dir = $t_filter['dir'];

$t_checkboxes_exist = false;

$t_icon_path = config_get( 'icon_path' );
$t_update_bug_threshold = config_get( 'update_bug_threshold' );
$t_bug_resolved_status_threshold = config_get( 'bug_resolved_status_threshold' );
$t_hide_status_default = config_get( 'hide_status_default' );
$t_default_show_changed = config_get( 'default_show_changed' );

$c_filter['assigned'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => $t_current_user_id,
	),
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => $t_bug_resolved_status_threshold,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => META_FILTER_ANY,
	),
);

$c_filter['recent_mod'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => META_FILTER_NONE,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => META_FILTER_ANY,
	),
);

$c_filter['reported'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => $t_current_user_id,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SORT_FIELD_NAME => 'last_updated',
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => $t_hide_status_default,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => META_FILTER_ANY,
	),
);

$c_filter['resolved'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => $t_bug_resolved_status_threshold,
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => $t_hide_status_default,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => META_FILTER_ANY,
	),
);

$c_filter['unassigned'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => META_FILTER_NONE,
	),
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => $t_hide_status_default,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => META_FILTER_ANY,
	),
);

# TODO: check. handler value looks wrong

$c_filter['monitored'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => $t_hide_status_default,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => $t_current_user_id,
	),
);


$c_filter['feedback'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => config_get( 'bug_feedback_status' ),
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => $t_current_user_id,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => $t_hide_status_default,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => META_FILTER_ANY,
	),
);

$c_filter['verify'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => $t_bug_resolved_status_threshold,
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => $t_current_user_id,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => $t_hide_status_default,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => META_FILTER_ANY,
	),
);

$c_filter['my_comments'] = array(
	FILTER_PROPERTY_CATEGORY => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_SEVERITY_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_STATUS_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIGHLIGHT_CHANGED => $t_default_show_changed,
	FILTER_PROPERTY_REPORTER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HANDLER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_RESOLUTION_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_BUILD => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_PRODUCT_VERSION => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_HIDE_STATUS_ID => Array(
		'0' => $t_hide_status_default,
	),
	FILTER_PROPERTY_MONITOR_USER_ID => Array(
		'0' => META_FILTER_ANY,
	),
	FILTER_PROPERTY_NOTE_USER_ID=> Array(
		'0' => META_FILTER_MYSELF,
	),
);

$rows = json_filter_get_bug_rows( $f_page_number, $t_per_page, $t_page_count, $t_bug_count, $c_filter[$t_box_title], $project_id );
$t_output['bug_list'] =  $rows;

# Improve performance by caching category data in one pass
if( helper_get_current_project() == 0 ) {
	$t_categories = array();
	foreach( $rows as $t_row ) {
		$t_categories[] = $t_row->category_id;
	}

	category_cache_array_rows( array_unique( $t_categories ) );
}

$t_filter = array_merge( $c_filter[$t_box_title], $t_filter );

$box_title = lang_get( 'my_view_title_' . $t_box_title );

$t_output['result']   =  lang_get( 'operation_successful' ) ;

echo json_encode($t_output);

json_exit();


/**
 * @todo Had to make all these parameters required because we can't use
 *  call-time pass by reference anymore.  I really preferred not having
 *  to pass all the params in if you didn't want to, but I wanted to get
 *  rid of the errors for now.  If we can think of a better way later
 *  (maybe return an object) that would be great.
 *
 * @param int $p_page_number the page you want to see (set to the actual page on return)
 * @param int $p_per_page the number of bugs to see per page (set to actual on return)
 *      -1   indicates you want to see all bugs
 *      null indicates you want to use the value specified in the filter
 * @param int $p_page_count you don't need to give a value here, the number of pages will be stored here on return
 * @param int $p_bug_count you don't need to give a value here, the number of bugs will be stored here on return
 * @param mixed $p_custom_filter Filter to use.
 * @param int $p_project_id project id to use in filtering.
 * @param int $p_user_id user id to use as current user when filtering.
 * @param bool $p_show_sticky get sticky issues only.
 */
function json_filter_get_bug_rows( &$p_page_number, &$p_per_page, &$p_page_count, &$p_bug_count, $p_custom_filter = null, $p_project_id = null, $p_user_id = null, $p_show_sticky = null ) {
	log_event( LOG_FILTERING, 'START NEW FILTER QUERY' );

	$t_bug_table = db_get_table( 'mantis_bug_table' );
	$t_bug_text_table = db_get_table( 'mantis_bug_text_table' );
	$t_bugnote_table = db_get_table( 'mantis_bugnote_table' );
	$t_category_table = db_get_table( 'mantis_category_table' );
	$t_custom_field_string_table = db_get_table( 'mantis_custom_field_string_table' );
	$t_bugnote_text_table = db_get_table( 'mantis_bugnote_text_table' );
	$t_project_table = db_get_table( 'mantis_project_table' );
	$t_bug_monitor_table = db_get_table( 'mantis_bug_monitor_table' );
	$t_limit_reporters = config_get( 'limit_reporters' );
	$t_bug_relationship_table = db_get_table( 'mantis_bug_relationship_table' );
	$t_report_bug_threshold = config_get( 'report_bug_threshold' );
	$t_where_param_count = 0;

	$t_current_user_id = auth_get_current_user_id();

	if( null === $p_user_id ) {
		$t_user_id = $t_current_user_id;
	} else {
		$t_user_id = $p_user_id;
	}

	$c_user_id = db_prepare_int( $t_user_id );

	if( null === $p_project_id ) {

		# @@@ If project_id is not specified, then use the project id(s) in the filter if set, otherwise, use current project.
		$t_project_id = helper_get_current_project();
	} else {
		$t_project_id = $p_project_id;
	}

	if( $p_custom_filter === null ) {

		# Prefer current_user_get_bug_filter() over user_get_filter() when applicable since it supports
		# cookies set by previous version of the code.
		if( $t_user_id == $t_current_user_id ) {
			$t_filter = current_user_get_bug_filter();
		} else {
			$t_filter = user_get_bug_filter( $t_user_id, $t_project_id );
		}
	} else {
		$t_filter = $p_custom_filter;
	}

	$t_filter = filter_ensure_valid_filter( $t_filter );

	if( false === $t_filter ) {
		return false;

		# signify a need to create a cookie
		# @@@ error instead?
	}

	$t_view_type = $t_filter['_view_type'];
	$t_where_clauses = array(
		"$t_project_table.enabled = " . db_param(),
		"$t_project_table.id = $t_bug_table.project_id",
	);
	$t_where_params = array(
		1,
	);
	$t_select_clauses = array(
		"$t_bug_table.*",
		"$t_bug_table.last_updated",
		"$t_bug_table.date_submitted",
	);

	$t_join_clauses = array();
	$t_from_clauses = array();

	// normalize the project filtering into an array $t_project_ids
	if( 'simple' == $t_view_type ) {
		log_event( LOG_FILTERING, 'Simple Filter' );
		$t_project_ids = array(
			$t_project_id,
		);
		$t_include_sub_projects = true;
	} else {
		log_event( LOG_FILTERING, 'Advanced Filter' );
		if( !is_array( $t_filter[FILTER_PROPERTY_PROJECT_ID] ) ) {
			$t_project_ids = array(
				db_prepare_int( $t_filter[FILTER_PROPERTY_PROJECT_ID] ),
			);
		} else {
			$t_project_ids = array_map( 'db_prepare_int', $t_filter[FILTER_PROPERTY_PROJECT_ID] );
		}

		$t_include_sub_projects = (( count( $t_project_ids ) == 1 ) && ( $t_project_ids[0] == META_FILTER_CURRENT ) );
	}

	log_event( LOG_FILTERING, 'project_ids = @P' . implode( ', @P', $t_project_ids ) );
	log_event( LOG_FILTERING, 'include sub-projects = ' . ( $t_include_sub_projects ? '1' : '0' ) );

	// if the array has ALL_PROJECTS, then reset the array to only contain ALL_PROJECTS.
	// replace META_FILTER_CURRENT with the actualy current project id.
	$t_all_projects_found = false;
	$t_new_project_ids = array();
	foreach( $t_project_ids as $t_pid ) {
		if( $t_pid == META_FILTER_CURRENT ) {
			$t_pid = $t_project_id;
		}

		if( $t_pid == ALL_PROJECTS ) {
			$t_all_projects_found = true;
			log_event( LOG_FILTERING, 'all projects selected' );
			break;
		}

		// filter out inaccessible projects.
		if( !access_has_project_level( VIEWER, $t_pid, $t_user_id ) ) {
			continue;
		}

		$t_new_project_ids[] = $t_pid;
	}

	$t_projects_query_required = true;
	if( $t_all_projects_found ) {
		if( user_is_administrator( $t_user_id ) ) {
			log_event( LOG_FILTERING, 'all projects + administrator, hence no project filter.' );
			$t_projects_query_required = false;
		} else {
			$t_project_ids = user_get_accessible_projects( $t_user_id );
		}
	} else {
		$t_project_ids = $t_new_project_ids;
	}

	if( $t_projects_query_required ) {
		// expand project ids to include sub-projects
		if( $t_include_sub_projects ) {
			$t_top_project_ids = $t_project_ids;

			foreach( $t_top_project_ids as $t_pid ) {
				log_event( LOG_FILTERING, 'Getting sub-projects for project id @P' . $t_pid );
				$t_project_ids = array_merge( $t_project_ids, user_get_all_accessible_subprojects( $t_user_id, $t_pid ) );
			}

			$t_project_ids = array_unique( $t_project_ids );
		}

		// if no projects are accessible, then return an empty array.
		if( count( $t_project_ids ) == 0 ) {
			log_event( LOG_FILTERING, 'no accessible projects' );
			return array();
		}

		log_event( LOG_FILTERING, 'project_ids after including sub-projects = @P' . implode( ', @P', $t_project_ids ) );

		// this array is to be populated with project ids for which we only want to show public issues.  This is due to the limited
		// access of the current user.
		$t_public_only_project_ids = array();

		// this array is populated with project ids that the current user has full access to.
		$t_private_and_public_project_ids = array();

		$t_access_required_to_view_private_bugs = config_get( 'private_bug_threshold' );
		foreach( $t_project_ids as $t_pid ) {
			if( access_has_project_level( $t_access_required_to_view_private_bugs, $t_pid, $t_user_id ) ) {
				$t_private_and_public_project_ids[] = $t_pid;
			} else {
				$t_public_only_project_ids[] = $t_pid;
			}
		}

		log_event( LOG_FILTERING, 'project_ids (with public/private access) = @P' . implode( ', @P', $t_private_and_public_project_ids ) );
		log_event( LOG_FILTERING, 'project_ids (with public access) = @P' . implode( ', @P', $t_public_only_project_ids ) );

		$t_private_and_public_query = null;
		if( count( $t_private_and_public_project_ids ) == 1 ) {
			$t_private_and_public_query = "( $t_bug_table.project_id = " . $t_private_and_public_project_ids[0] . " )";
		}
		else if( count( $t_private_and_public_project_ids ) > 1 ) {
			$t_private_and_public_query = "( $t_bug_table.project_id in (" . implode( ', ', $t_private_and_public_project_ids ) . ") )";
		}

		
		$t_public_only_query = null;
		$t_public_view_state_check = "( ( $t_bug_table.view_state = " . VS_PUBLIC . " ) OR ( $t_bug_table.reporter_id = $t_user_id ) )";
		if( count( $t_public_only_project_ids ) == 1 ) {
			$t_public_only_query = "( ( $t_bug_table.project_id = " . $t_public_only_project_ids[0] . " ) AND $t_public_view_state_check )";
		}
		else if( count( $t_public_only_project_ids ) > 1 ) {
			$t_public_only_query = "( ( $t_bug_table.project_id in (" . implode( ', ', $t_public_only_project_ids ) . ") ) AND $t_public_view_state_check )";
		}

		// both queries can't be null, so we either have one of them or both.

		if( $t_private_and_public_query === null ) {
			$t_project_query = $t_public_only_query;
		} else if( $t_public_only_query === null ) {
			$t_project_query = $t_private_and_public_query;
		} else {
			$t_project_query = "( $t_public_only_query OR $t_private_and_public_query )";
		}

		log_event( LOG_FILTERING, 'project query = ' . $t_project_query );
		array_push( $t_where_clauses, $t_project_query );
	}

	# view state
	$t_view_state = db_prepare_int( $t_filter[FILTER_PROPERTY_VIEW_STATE_ID] );
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_VIEW_STATE_ID] ) ) {
		$t_view_state_query = "($t_bug_table.view_state=" . db_param() . ')';
		log_event( LOG_FILTERING, 'view_state query = ' . $t_view_state_query );
		$t_where_params[] = $t_view_state;
		array_push( $t_where_clauses, $t_view_state_query );
	} else {
		log_event( LOG_FILTERING, 'no view_state query' );
	}

	# reporter
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_REPORTER_ID] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_REPORTER_ID] as $t_filter_member ) {
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, "0" );
			} else {
				$c_reporter_id = db_prepare_int( $t_filter_member );
				if( filter_field_is_myself( $c_reporter_id ) ) {
					array_push( $t_clauses, $c_user_id );
				} else {
					array_push( $t_clauses, $c_reporter_id );
				}
			}
		}

		if( 1 < count( $t_clauses ) ) {
			$t_reporter_query = "( $t_bug_table.reporter_id in (" . implode( ', ', $t_clauses ) . ") )";
		} else {
			$t_reporter_query = "( $t_bug_table.reporter_id=$t_clauses[0] )";
		}

		log_event( LOG_FILTERING, 'reporter query = ' . $t_reporter_query );
		array_push( $t_where_clauses, $t_reporter_query );
	} else {
		log_event( LOG_FILTERING, 'no reporter query' );
	}

	# limit reporter
	# @@@ thraxisp - access_has_project_level checks greater than or equal to,
	#   this assumed that there aren't any holes above REPORTER where the limit would apply
	#
	if(( ON === $t_limit_reporters ) && ( !access_has_project_level( REPORTER + 1, $t_project_id, $t_user_id ) ) ) {
		$c_reporter_id = $c_user_id;
		$t_where_params[] = $c_reporter_id;
		array_push( $t_where_clauses, "($t_bug_table.reporter_id=" . db_param() . ')' );
	}

	# handler
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_HANDLER_ID] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_HANDLER_ID] as $t_filter_member ) {
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, 0 );
			} else {
				$c_handler_id = db_prepare_int( $t_filter_member );
				if( filter_field_is_myself( $c_handler_id ) ) {
					array_push( $t_clauses, $c_user_id );
				} else {
					array_push( $t_clauses, $c_handler_id );
				}
			}
		}

		if( 1 < count( $t_clauses ) ) {
			$t_handler_query = "( $t_bug_table.handler_id in (" . implode( ', ', $t_clauses ) . ") )";
		} else {
			$t_handler_query = "( $t_bug_table.handler_id=$t_clauses[0] )";
		}

		log_event( LOG_FILTERING, 'handler query = ' . $t_handler_query );
		array_push( $t_where_clauses, $t_handler_query );
	} else {
		log_event( LOG_FILTERING, 'no handler query' );
	}

	# category
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_CATEGORY] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_CATEGORY] as $t_filter_member ) {
			if( !filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, $t_filter_member );
			}
		}

		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.category_id in ( SELECT id FROM $t_category_table WHERE name in (" . implode( ', ', $t_where_tmp ) . ") ) )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.category_id in ( SELECT id FROM $t_category_table WHERE name=" . db_param() . ") )" );
		}
	}

	# severity
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_SEVERITY_ID] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_SEVERITY_ID] as $t_filter_member ) {
			$c_show_severity = db_prepare_int( $t_filter_member );
			array_push( $t_clauses, $c_show_severity );
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.severity in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.severity=" . db_param() . " )" );
		}
	}

	# show / hide status
	# take a list of all available statuses then remove the ones that we want hidden, then make sure
	# the ones we want shown are still available
	$t_desired_statuses = array();
	$t_available_statuses = MantisEnum::getValues( config_get( 'status_enum_string' ) );

	if( 'simple' == $t_filter['_view_type'] ) {

		# simple filtering: if showing any, restrict by the hide status value, otherwise ignore the hide
		$t_any_found = false;
		$t_this_status = $t_filter[FILTER_PROPERTY_STATUS_ID][0];
		$t_this_hide_status = $t_filter[FILTER_PROPERTY_HIDE_STATUS_ID][0];

		if( filter_field_is_any( $t_this_status ) ) {
			foreach( $t_available_statuses as $t_this_available_status ) {
				if( $t_this_hide_status > $t_this_available_status ) {
					$t_desired_statuses[] = $t_this_available_status;
				}
			}
		} else {
			$t_desired_statuses[] = $t_this_status;
		}
	} else {
		# advanced filtering: ignore the hide
		if( filter_field_is_any( $t_filter[FILTER_PROPERTY_STATUS_ID] ) ) {
			$t_desired_statuses = array();
		} else {
			foreach( $t_filter[FILTER_PROPERTY_STATUS_ID] as $t_this_status ) {
				$t_desired_statuses[] = $t_this_status;
			}
		}
	}

	if( count( $t_desired_statuses ) > 0 ) {
		$t_clauses = array();

		foreach( $t_desired_statuses as $t_filter_member ) {
			$c_show_status = db_prepare_int( $t_filter_member );
			array_push( $t_clauses, $c_show_status );
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.status in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.status=" . db_param() . " )" );
		}
	}

	# resolution
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_RESOLUTION_ID] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_RESOLUTION_ID] as $t_filter_member ) {
			$c_show_resolution = db_prepare_int( $t_filter_member );
			array_push( $t_clauses, $c_show_resolution );
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.resolution in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.resolution=" . db_param() . " )" );
		}
	}

	# priority
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_PRIORITY_ID] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_PRIORITY_ID] as $t_filter_member ) {
			$c_show_priority = db_prepare_int( $t_filter_member );
			array_push( $t_clauses, $c_show_priority );
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.priority in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.priority=" . db_param() . " )" );
		}
	}

	# product build
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_PRODUCT_BUILD] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_PRODUCT_BUILD] as $t_filter_member ) {
			$t_filter_member = stripslashes( $t_filter_member );
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, '' );
			} else {
				$c_show_build = db_prepare_string( $t_filter_member );
				array_push( $t_clauses, $c_show_build );
			}
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.build in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.build=" . db_param() . " )" );
		}
	}

	# product version
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_PRODUCT_VERSION] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_PRODUCT_VERSION] as $t_filter_member ) {
			$t_filter_member = stripslashes( $t_filter_member );
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, '' );
			} else {
				$c_show_version = db_prepare_string( $t_filter_member );
				array_push( $t_clauses, $c_show_version );
			}
		}

		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.version in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.version=" . db_param() . " )" );
		}
	}

	# profile
	if( !filter_field_is_any( $t_filter['show_profile'] ) ) {
		$t_clauses = array();

		foreach( $t_filter['show_profile'] as $t_filter_member ) {
			$t_filter_member = stripslashes( $t_filter_member );
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, "0" );
			} else {
				$c_show_profile = db_prepare_int( $t_filter_member );
				array_push( $t_clauses, "$c_show_profile" );
			}
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.profile_id in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.profile_id=" . db_param() . " )" );
		}
	}

	# platform
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_PLATFORM] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_PLATFORM] as $t_filter_member ) {
			$t_filter_member = stripslashes( $t_filter_member );
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, '' );
			} else {
				$c_platform = db_prepare_string( $t_filter_member );
				array_push( $t_clauses, $c_platform );
			}
		}

		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.platform in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.platform = " . db_param() . " )" );
		}
	}

	# os
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_OS] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_OS] as $t_filter_member ) {
			$t_filter_member = stripslashes( $t_filter_member );
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, '' );
			} else {
				$c_os = db_prepare_string( $t_filter_member );
				array_push( $t_clauses, $c_os );
			}
		}

		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.os in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.os = " . db_param() . " )" );
		}
	}

	# os_build
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_OS_BUILD] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_OS_BUILD] as $t_filter_member ) {
			$t_filter_member = stripslashes( $t_filter_member );
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, '' );
			} else {
				$c_os_build = db_prepare_string( $t_filter_member );
				array_push( $t_clauses, $c_os_build );
			}
		}

		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.os_build in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.os_build = " . db_param() . " )" );
		}
	}

	# date filter
	if(( 'on' == $t_filter[FILTER_PROPERTY_FILTER_BY_DATE] ) && is_numeric( $t_filter[FILTER_PROPERTY_START_MONTH] ) && is_numeric( $t_filter[FILTER_PROPERTY_START_DAY] ) && is_numeric( $t_filter[FILTER_PROPERTY_START_YEAR] ) && is_numeric( $t_filter[FILTER_PROPERTY_END_MONTH] ) && is_numeric( $t_filter[FILTER_PROPERTY_END_DAY] ) && is_numeric( $t_filter[FILTER_PROPERTY_END_YEAR] ) ) {

		$t_start_string = $t_filter[FILTER_PROPERTY_START_YEAR] . "-" . $t_filter[FILTER_PROPERTY_START_MONTH] . "-" . $t_filter[FILTER_PROPERTY_START_DAY] . " 00:00:00";
		$t_end_string = $t_filter[FILTER_PROPERTY_END_YEAR] . "-" . $t_filter[FILTER_PROPERTY_END_MONTH] . "-" . $t_filter[FILTER_PROPERTY_END_DAY] . " 23:59:59";

		$t_where_params[] = strtotime( $t_start_string );
		$t_where_params[] = strtotime( $t_end_string );
		array_push( $t_where_clauses, "($t_bug_table.date_submitted BETWEEN " . db_param() . " AND " . db_param() . " )" );
	}

	# fixed in version
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_FIXED_IN_VERSION] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_FIXED_IN_VERSION] as $t_filter_member ) {
			$t_filter_member = stripslashes( $t_filter_member );
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, '' );
			} else {
				$c_fixed_in_version = db_prepare_string( $t_filter_member );
				array_push( $t_clauses, $c_fixed_in_version );
			}
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.fixed_in_version in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.fixed_in_version=" . db_param() . " )" );
		}
	}

	# target version
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_TARGET_VERSION] ) ) {
		$t_clauses = array();

		foreach( $t_filter[FILTER_PROPERTY_TARGET_VERSION] as $t_filter_member ) {
			$t_filter_member = stripslashes( $t_filter_member );
			if( filter_field_is_none( $t_filter_member ) ) {
				array_push( $t_clauses, '' );
			} else {
				$c_target_version = db_prepare_string( $t_filter_member );
				array_push( $t_clauses, $c_target_version );
			}
		}

		# echo var_dump( $t_clauses ); exit;
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bug_table.target_version in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bug_table.target_version=" . db_param() . " )" );
		}
	}

	# users monitoring a bug
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_MONITOR_USER_ID] ) ) {
		$t_clauses = array();
		$t_table_name = 'user_monitor';
		array_push( $t_join_clauses, "LEFT JOIN $t_bug_monitor_table $t_table_name ON $t_table_name.bug_id = $t_bug_table.id" );

		foreach( $t_filter[FILTER_PROPERTY_MONITOR_USER_ID] as $t_filter_member ) {
			$c_user_monitor = db_prepare_int( $t_filter_member );
			if( filter_field_is_myself( $c_user_monitor ) ) {
				array_push( $t_clauses, $c_user_id );
			} else {
				array_push( $t_clauses, $c_user_monitor );
			}
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_table_name.user_id in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_table_name.user_id=" . db_param() . " )" );
		}
	}

	# bug relationship
	$t_any_found = false;
	$c_rel_type = $t_filter[FILTER_PROPERTY_RELATIONSHIP_TYPE];
	$c_rel_bug = $t_filter[FILTER_PROPERTY_RELATIONSHIP_BUG];
	if( -1 == $c_rel_type || 0 == $c_rel_bug ) {
		$t_any_found = true;
	}
	if( !$t_any_found ) {
		# use the complementary type
		$t_comp_type = relationship_get_complementary_type( $c_rel_type );
		$t_clauses = array();
		$t_table_name = 'relationship';
		array_push( $t_join_clauses, "LEFT JOIN $t_bug_relationship_table $t_table_name ON $t_table_name.destination_bug_id = $t_bug_table.id" );
		array_push( $t_join_clauses, "LEFT JOIN $t_bug_relationship_table ${t_table_name}2 ON ${t_table_name}2.source_bug_id = $t_bug_table.id" );

		// get reverse relationships
		$t_where_params[] = $t_comp_type;
		$t_where_params[] = $c_rel_bug;
		$t_where_params[] = $c_rel_type;
		$t_where_params[] = $c_rel_bug;
		array_push( $t_clauses, "($t_table_name.relationship_type=" . db_param() . " AND $t_table_name.source_bug_id=" . db_param() . ')' );
		array_push( $t_clauses, "($t_table_name" . "2.relationship_type=" . db_param() . " AND $t_table_name" . "2.destination_bug_id=" . db_param() . ')' );
		array_push( $t_where_clauses, '(' . implode( ' OR ', $t_clauses ) . ')' );
	}

	# tags
	$c_tag_string = trim( $t_filter[FILTER_PROPERTY_TAG_STRING] );
	$c_tag_select = trim( $t_filter[FILTER_PROPERTY_TAG_SELECT] );
	if( is_blank( $c_tag_string ) && !is_blank( $c_tag_select ) && $c_tag_select != 0 ) {
		$t_tag = tag_get( $c_tag_select );
		$c_tag_string = $t_tag['name'];
	}

	if( !is_blank( $c_tag_string ) ) {
		$t_tags = tag_parse_filters( $c_tag_string );

		if( count( $t_tags ) ) {

			$t_tags_all = array();
			$t_tags_any = array();
			$t_tags_none = array();

			foreach( $t_tags as $t_tag_row ) {
				switch( $t_tag_row['filter'] ) {
					case 1:
						$t_tags_all[] = $t_tag_row;
						break;
					case 0:
						$t_tags_any[] = $t_tag_row;
						break;
					case -1:
						$t_tags_none[] = $t_tag_row;
						break;
				}
			}

			if( 0 < $t_filter[FILTER_PROPERTY_TAG_SELECT] && tag_exists( $t_filter[FILTER_PROPERTY_TAG_SELECT] ) ) {
				$t_tags_any[] = tag_get( $t_filter[FILTER_PROPERTY_TAG_SELECT] );
			}

			$t_bug_tag_table = db_get_table( 'mantis_bug_tag_table' );

			if( count( $t_tags_all ) ) {
				$t_clauses = array();
				foreach( $t_tags_all as $t_tag_row ) {
					array_push( $t_clauses, "$t_bug_table.id IN ( SELECT bug_id FROM $t_bug_tag_table WHERE $t_bug_tag_table.tag_id = $t_tag_row[id] )" );
				}
				array_push( $t_where_clauses, '(' . implode( ' AND ', $t_clauses ) . ')' );
			}

			if( count( $t_tags_any ) ) {
				$t_clauses = array();
				foreach( $t_tags_any as $t_tag_row ) {
					array_push( $t_clauses, "$t_bug_tag_table.tag_id = $t_tag_row[id]" );
				}
				array_push( $t_where_clauses, "$t_bug_table.id IN ( SELECT bug_id FROM $t_bug_tag_table WHERE ( " . implode( ' OR ', $t_clauses ) . ') )' );
			}

			if( count( $t_tags_none ) ) {
				$t_clauses = array();
				foreach( $t_tags_none as $t_tag_row ) {
					array_push( $t_clauses, "$t_bug_tag_table.tag_id = $t_tag_row[id]" );
				}
				array_push( $t_where_clauses, "$t_bug_table.id NOT IN ( SELECT bug_id FROM $t_bug_tag_table WHERE ( " . implode( ' OR ', $t_clauses ) . ') )' );
			}
		}
	}

	# note user id
	if( !filter_field_is_any( $t_filter[FILTER_PROPERTY_NOTE_USER_ID] ) ) {
		$t_bugnote_table_alias = 'mbnt';
		$t_clauses = array();
		array_push( $t_from_clauses, "$t_bugnote_table  $t_bugnote_table_alias" );
		array_push( $t_where_clauses, "( $t_bug_table.id = $t_bugnote_table_alias.bug_id )" );

		foreach( $t_filter[FILTER_PROPERTY_NOTE_USER_ID] as $t_filter_member ) {
			$c_note_user_id = db_prepare_int( $t_filter_member );
			if( filter_field_is_myself( $c_note_user_id ) ) {
				array_push( $t_clauses, $c_user_id );
			} else {
				array_push( $t_clauses, $c_note_user_id );
			}
		}
		if( 1 < count( $t_clauses ) ) {
			$t_where_tmp = array();
			foreach( $t_clauses as $t_clause ) {
				$t_where_tmp[] = db_param();
				$t_where_params[] = $t_clause;
			}
			array_push( $t_where_clauses, "( $t_bugnote_table_alias.reporter_id in (" . implode( ', ', $t_where_tmp ) . ") )" );
		} else {
			$t_where_params[] = $t_clauses[0];
			array_push( $t_where_clauses, "( $t_bugnote_table_alias.reporter_id=" . db_param() . " )" );
		}
	}

	# plugin filters
	$t_plugin_filters = filter_get_plugin_filters();
	foreach( $t_plugin_filters as $t_field_name => $t_filter_object ) {
		if ( !filter_field_is_any( $t_filter[ $t_field_name ] ) || $t_filter_object->type == FILTER_TYPE_BOOLEAN ) {
			$t_filter_query = $t_filter_object->query( $t_filter[ $t_field_name ] );
			if ( is_array( $t_filter_query ) ) {
				if ( isset( $t_filter_query['join'] ) ) {
					array_push( $t_join_clauses, $t_filter_query['join'] );
				}
				if ( isset( $t_filter_query['where'] ) ) {
					array_push( $t_where_clauses, $t_filter_query['where'] );
				}
				if ( isset( $t_filter_query['params'] ) && is_array( $t_filter_query['params'] ) ) {
					array_merge( $t_where_params, $t_filter_query['params'] );
				}
			}
		}
	}

	# custom field filters
	if( ON == config_get( 'filter_by_custom_fields' ) ) {

		# custom field filtering
		# @@@ At the moment this gets the linked fields relating to the current project
		#     It should get the ones relating to the project in the filter or all projects
		#     if multiple projects.
		$t_custom_fields = custom_field_get_linked_ids( $t_project_id );

		foreach( $t_custom_fields as $t_cfid ) {
			$t_field_info = custom_field_cache_row( $t_cfid, true );
			if( !$t_field_info['filter_by'] ) {
				continue;

				# skip this custom field it shouldn't be filterable
			}

			$t_custom_where_clause = '';

			# Ignore all custom filters that are not set, or that are set to '' or "any"
			if( !filter_field_is_any( $t_filter['custom_fields'][$t_cfid] ) ) {
				$t_def = custom_field_get_definition( $t_cfid );
				$t_table_name = $t_custom_field_string_table . '_' . $t_cfid;

				# We need to filter each joined table or the result query will explode in dimensions
				# Each custom field will result in a exponential growth like Number_of_Issues^Number_of_Custom_Fields
				# and only after this process ends (if it is able to) the result query will be filtered
				# by the WHERE clause and by the DISTINCT clause
				$t_cf_join_clause = "LEFT JOIN $t_custom_field_string_table $t_table_name ON $t_table_name.bug_id = $t_bug_table.id AND $t_table_name.field_id = $t_cfid ";

				if( $t_def['type'] == CUSTOM_FIELD_TYPE_DATE ) {
					switch( $t_filter['custom_fields'][$t_cfid][0] ) {
						case CUSTOM_FIELD_DATE_ANY:
							break;
						case CUSTOM_FIELD_DATE_NONE:
							array_push( $t_join_clauses, $t_cf_join_clause );
							$t_custom_where_clause = '(( ' . $t_table_name . '.bug_id is null) OR ( ' . $t_table_name . '.value = 0)';
							break;
						case CUSTOM_FIELD_DATE_BEFORE:
							array_push( $t_join_clauses, $t_cf_join_clause );
							$t_custom_where_clause = '(( ' . $t_table_name . '.value != 0 AND (' . $t_table_name . '.value+0) < ' . ( $t_filter['custom_fields'][$t_cfid][2] ) . ')';
							break;
						case CUSTOM_FIELD_DATE_AFTER:
							array_push( $t_join_clauses, $t_cf_join_clause );
							$t_custom_where_clause = '( (' . $t_table_name . '.value+0) > ' . ( $t_filter['custom_fields'][$t_cfid][1] + 1 );
							break;
						default:
							array_push( $t_join_clauses, $t_cf_join_clause );
							$t_custom_where_clause = '( (' . $t_table_name . '.value+0) BETWEEN ' . $t_filter['custom_fields'][$t_cfid][1] . ' AND ' . $t_filter['custom_fields'][$t_cfid][2];
							break;
					}
				} else {

					array_push( $t_join_clauses, $t_cf_join_clause );

					$t_filter_array = array();
					foreach( $t_filter['custom_fields'][$t_cfid] as $t_filter_member ) {
						$t_filter_member = stripslashes( $t_filter_member );
						if( filter_field_is_none( $t_filter_member ) ) {

							# coerce filter value if selecting META_FILTER_NONE so it will match empty fields
							$t_filter_member = '';

							# but also add those _not_ present in the custom field string table
							array_push( $t_filter_array, "$t_bug_table.id NOT IN (SELECT bug_id FROM $t_custom_field_string_table WHERE field_id=$t_cfid)" );
						}

						switch( $t_def['type'] ) {
							case CUSTOM_FIELD_TYPE_CHECKBOX:
							case CUSTOM_FIELD_TYPE_MULTILIST:
								$t_where_params[] = '%|' . $t_filter_member . '|%';
								array_push( $t_filter_array, db_helper_like( "$t_table_name.value" ) );
								break;
							default:
								array_push( $t_filter_array, "$t_table_name.value = '" . db_prepare_string( $t_filter_member ) . "'" );
						}
					}
					$t_custom_where_clause .= '(' . implode( ' OR ', $t_filter_array );
				}
				if( !is_blank( $t_custom_where_clause ) ) {
					array_push( $t_where_clauses, $t_custom_where_clause . ')' );
				}
			}
		}
	}

	# Text search
	if( !is_blank( $t_filter[FILTER_PROPERTY_FREE_TEXT] ) ) {

		# break up search terms by spacing or quoting
		preg_match_all( "/-?([^'\"\s]+|\"[^\"]+\"|'[^']+')/", $t_filter[FILTER_PROPERTY_FREE_TEXT], $t_matches, PREG_SET_ORDER );

		# organize terms without quoting, paying attention to negation
		$t_search_terms = array();
		foreach( $t_matches as $t_match ) {
			$t_search_terms[ trim( $t_match[1], "\'\"" ) ] = ( $t_match[0][0] == '-' );
		}

		# build a big where-clause and param list for all search terms, including negations
		$t_first = true;
		$t_textsearch_where_clause = "( ";
		foreach( $t_search_terms as $t_search_term => $t_negate ) {
			if ( !$t_first ) {
				$t_textsearch_where_clause .= ' AND ';
			}

			if ( $t_negate ) {
				$t_textsearch_where_clause .= 'NOT ';
			}

			$c_search = '%' . $t_search_term . '%';
			$t_textsearch_where_clause .= '( ' . db_helper_like( 'summary' ) .
				' OR ' . db_helper_like( "$t_bug_text_table.description" ) .
				' OR ' . db_helper_like( "$t_bug_text_table.steps_to_reproduce" ) .
				' OR ' . db_helper_like( "$t_bug_text_table.additional_information" ) .
				' OR ' . db_helper_like( "$t_bugnote_text_table.note" );

			$t_where_params[] = $c_search;
			$t_where_params[] = $c_search;
			$t_where_params[] = $c_search;
			$t_where_params[] = $c_search;
			$t_where_params[] = $c_search;

			if( is_numeric( $t_search_term ) ) {
				$c_search_int = (int) $t_search_term;
				$t_textsearch_where_clause .= " OR $t_bug_table.id = " . db_param();
				$t_textsearch_where_clause .= " OR $t_bugnote_table.id = " . db_param();
				$t_where_params[] = $c_search_int;
				$t_where_params[] = $c_search_int;
			}

			$t_textsearch_where_clause .= ' )';
			$t_first = false;
		}
		$t_textsearch_where_clause .= ' )';

		# add text query elements to arrays
		if ( !$t_first ) {
			$t_from_clauses[] = "$t_bug_text_table";
			$t_where_clauses[] = "$t_bug_table.bug_text_id = $t_bug_text_table.id";
			$t_where_clauses[] = $t_textsearch_where_clause;
			$t_join_clauses[] = " LEFT JOIN $t_bugnote_table ON $t_bug_table.id = $t_bugnote_table.bug_id";
			$t_join_clauses[] = " LEFT JOIN $t_bugnote_text_table ON $t_bugnote_table.bugnote_text_id = $t_bugnote_text_table.id";
		}
	}

	# End text search

	$t_from_clauses[] = $t_project_table;
	$t_from_clauses[] = $t_bug_table;

	$t_query_clauses['select'] = $t_select_clauses;
	$t_query_clauses['from'] = $t_from_clauses;
	$t_query_clauses['join'] = $t_join_clauses;
	$t_query_clauses['where'] = $t_where_clauses;
	$t_query_clauses['where_values'] = $t_where_params;
	$t_query_clauses = filter_get_query_sort_data( $t_filter, $p_show_sticky, $t_query_clauses );

	# assigning to $p_* for this function writes the values back in case the caller wants to know
	# Get the total number of bugs that meet the criteria.
	$p_bug_count = filter_get_bug_count( $t_query_clauses );
	if( 0 == $p_bug_count ) {
		return array();
	}
	$p_per_page = filter_per_page( $t_filter, $p_bug_count, $p_per_page );
	$p_page_count = filter_page_count( $p_bug_count, $p_per_page );
	$p_page_number = filter_valid_page_number( $p_page_number, $p_page_count );
	$t_offset = filter_offset( $p_page_number, $p_per_page );
	$t_query_clauses = filter_unique_query_clauses( $t_query_clauses );
	$t_select_string = "SELECT DISTINCT " . implode( ', ', $t_query_clauses['select'] );
	$t_from_string = " FROM " . implode( ', ', $t_query_clauses['from'] );
	$t_order_string = " ORDER BY " . implode( ', ', $t_query_clauses['order'] );
	$t_join_string = count( $t_query_clauses['join'] ) > 0 ? implode( ' ', $t_query_clauses['join'] ) : '';
	$t_where_string = count( $t_query_clauses['where'] ) > 0 ? 'WHERE ' . implode( ' AND ', $t_query_clauses['where'] ) : '';
//	var_dump( "$t_select_string $t_from_string $t_join_string $t_where_string $t_order_string");
	$t_result = db_query_bound( "$t_select_string $t_from_string $t_join_string $t_where_string $t_order_string", $t_query_clauses['where_values'], $p_per_page, $t_offset );
	$t_row_count = db_num_rows( $t_result );

	$t_id_array_lastmod = array();
	for( $i = 0;$i < $t_row_count;$i++ ) {
		$t_row = db_fetch_array( $t_result );
		$t_id_array_lastmod[] = (int) $t_row['id'];
		$t_rows[] = $t_row;
	}

	return $t_rows;
}
