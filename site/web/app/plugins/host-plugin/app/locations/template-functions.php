<?php
/**
 * UNIVERSITIES TEMPLATE HELPERS.
 *
 * template helper functions to allow WordPress templates
 * to access Examples data
 */
use HostPluginNamespace\App\Locations\Repos\Locations as Repo;

/**
 * FIND ALL
 * returns all records from Repo.
 */
function host_locations_find_all($args = [])
{
    $repo = Repo::init();

    return $repo->find_all($args);
}
