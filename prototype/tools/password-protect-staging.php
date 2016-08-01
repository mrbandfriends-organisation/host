<?php
function password_protect_staging($env, $unprotected_envs) {

	// Don't protect "unprotected" envs
    if( in_array($env, $unprotected_envs) ) {
    	return;
    }

    $sAuthHeader = '';
    if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
    {
        $sAuthHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    }
    elseif (isset($_SERVER['HTTP_AUTHORIZATION']))
    {
        $sAuthHeader = $_SERVER['HTTP_AUTHORIZATION'];
    }

    if(preg_match('/Basic+(.*)$/i', $sAuthHeader, $matches))	{
		list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':' , base64_decode($matches[1]));
	}

    // Auth details - could go in ENV file
	$details = array(
		'username' => 'mrb',
		'password' => 'pass4mrb'
	);

	// no user or pw = not protected
	if (empty($details['username']) || empty($details['password'])) {
		return;
	}


	if ( (!isset($_SERVER['PHP_AUTH_USER']) || ($_SERVER['PHP_AUTH_USER'] != $details['username'] ) || ($_SERVER['PHP_AUTH_PW'] != $details['password'] ))) {
	    header('WWW-Authenticate: Basic realm="Staging"');
	    header('HTTP/1.0 401 Unauthorized');
	    echo 'Access denied';
	    exit;
	}
}
?>
