<?php
	
global $current_user; get_currentuserinfo();

$token = 'B15B6C1E-9AED-4602-BEBA-06BB4318791B';
$email = 'sglazer@tolleson.com';
//$email = $current_user->user_email;

$client = new  
    SoapClient(  
        'http://www.pg2.angusanywhere.com/webservices/contacts.asmx?WSDL'
    );

$header = new SoapHeader('http://angus-group.com', 
                            'WebServiceToken',
                            array('WebServiceID' => $token));

$client->__setSoapHeaders($header);
//echo '<pre>'; print_r($client); echo '</pre>';

$response = $client->GetAuthenticationTokenByEmail(array('email' => $email));

?>
<?php
echo '<iframe src="'.$response->GetAuthenticationTokenByEmailResult->LoginUrl.'" width="100%" height="500px" frameborder="0" scrolling="no" seamless="seamless"></iframe>';
//echo file_get_contents($response->GetAuthenticationTokenByEmailResult->LoginUrl);
?>

