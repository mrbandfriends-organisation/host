<?php

/**
 * EXAMPLE TEMPLATE HELPERS
 *
 * template helper functions to allow WordPress templates
 * to access Example data
 *
 */

// Require the Repos required
use HostPluginNamespace\Repos\Example as Repo;
//use Roots\Sage\Utils;


/**
 * FIND ALL
 * returns all records from Repo
 */
function hostp_example_find_all() {
	$repo = Repo::init();
	return $repo->find_all();	
}



