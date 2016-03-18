<?php
//next example will recieve all messages for specific conversation
//$service_url = 'https://RNTpartner_VirtuosGS:Rightnow!@opn-virtuos.rightnowdemo.com/services/rest/connect/v1.3';
$service_url = 'https://RNTpartner_VirtuosMahak:Rightnow!@opn-virtuos.rightnowdemo.com/services/rest/connect/v1.3';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);

echo 'response ok!';
var_export($curl_response);

echo "**************************************************************";
die;
$service_url = 'https://RNTpartner_VirtuosGS:Rightnow!@opn-virtuos.rightnowdemo.com/services/rest/connect/v1.3';
$curl = curl_init($service_url);
$curl_post_data = array(
       
       
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
var_export($decoded->response);
 

?>