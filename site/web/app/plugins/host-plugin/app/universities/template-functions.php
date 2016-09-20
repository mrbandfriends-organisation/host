<?php
/**
 * UNIVERSITIES TEMPLATE HELPERS.
 *
 * template helper functions to allow WordPress templates
 * to access Examples data
 */
use HostPluginNamespace\App\Universities\Repos\Universities as Repo;

/**
 * FIND ALL
 * returns all records from Repo.
 */
function host_universities_find_all()
{
    $repo = Repo::init();

    return $repo->find_all();
}
