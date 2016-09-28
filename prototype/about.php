<?php
	require 'bootstrap.php';

	/**
	 * Page Data
	 *
	 * set data that you wish to be made available
	 * within your views. A a nested 'data' array
	 * is used because Plates PHP extracts all vars
	 * passed into templates
	 */
	$data = array(
		// Define all data within this array
		'data' => array(
            //'my_data_key' => true

		)
		// do not add additional keys
	);

	$templates->addData($data);

	echo $templates->render('pages::about', $data);
?>
