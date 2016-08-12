<?php
/**
 * UNIVERSITIES TEMPLATE HELPERS.
 *
 * template helper functions to allow WordPress templates
 * to access Examples data
 */
use HostPluginNamespace\App\Rooms\Repos\Examples as Repo;

/**
 * FIND ALL
 * returns all records from Repo.
 */
function host_rooms_find_all()
{
    $repo = Repo::init();

    return $repo->find_all();
}
