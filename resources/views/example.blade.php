<?php

require '/Users/Kaemsitumorang/test-laravel/resources/views/vendor/SSO-master/SSO/SSO.php';

$cas_path ='/Users/Kaemsitumorang/test-laravel/resources/views/vendor/CAS/CAS.php';

SSO\SSO::setCASPath($cas_path);

// Authenticate the user
SSO\SSO::authenticate();
// At this point, the authentication has succeeded.
// This shows how to get the user details.
$user = SSO\SSO::getUser();
if(true): ?>
{{ action('Controller@loginyes') }} 
<?php endif;