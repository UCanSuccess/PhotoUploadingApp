<?php
/**
 * New User Administration Screen.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );
global $wpdb;
if (!defined('ABSPATH'))
	die('-1');
require_once(ABSPATH.'wp-admin/admin-header.php');
?>
<div class="add-database">
	<div class="add-database-header">
		<h1>Add Streams</h1>
	</div>
	<div class="add-database-content">
		<div class="add-database-content-table">
			<table class='table table-striped table-bordered table-hover' id='stream_table' name='stream-check'>
				<thead>
					<th>Image</th><th>Name</th><th>Select</th>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript" src="http://localhost/wp-content/themes/"></script>
<script type="text/javascript">
	jQuery(document).ready(function (){
		//select_stream();
	})
</script>

<? include( ABSPATH . 'wp-admin/admin-footer.php' );
