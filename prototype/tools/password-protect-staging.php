<?php 
function password_protect_staging($env, $unprotected_envs) {
	
	// Don't protect "unprotected" envs
    if( in_array($env, $unprotected_envs) ) {
    	return;
    }

    if(preg_match('/Basic+(.*)$/i', $_SERVER['REDIRECT_HTTP_AUTHORIZATION'], $matches))	{
		list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':' , base64_decode(substr($_SERVER['REDIRECT_HTTP_AUTHORIZATION'], 6)));
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