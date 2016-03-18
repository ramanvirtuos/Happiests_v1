<?
if (!defined('DOCROOT')) {
	$docroot = get_cfg_var('doc_root');
	define('DOCROOT', $docroot);
}
require_once (DOCROOT . '/include/services/AgentAuthenticator.phph');
require_once( get_cfg_var("doc_root")."/ConnectPHP/Connect_init.php" );
$account = AgentAuthenticator::authenticateCredentials('gursimran' , 'Rightnow!');
use RightNow\Connect\v1_2 as RNCPHP;
/*
File Name: incident_view.php
Description: 
URL: https://opn-virt.rightnowdemo.com/cgi-bin/opn_virt.cfg/php/custom/incident_view.php?ref_no=15345-123123&i_id=23423
*/
try{	
	//$ref_no = $_GET['ref_no'];
	$i_id = $_GET['i_id'];
	if(strlen($i_id)){
		$incident = RNCPHP\Incident::fetch($i_id);
		echo $incident->Subject;
	}
} // try
catch(Exception $e){	
	echo "Error: ".$e->getMessage()." | Line: ".$e->getLine();
} // catch
?><?
if (!defined('DOCROOT')) {
	$docroot = get_cfg_var('doc_root');
	define('DOCROOT', $docroot);
}
require_once (DOCROOT . '/include/services/AgentAuthenticator.phph');
require_once( get_cfg_var("doc_root")."/ConnectPHP/Connect_init.php" );
$account = AgentAuthenticator::authenticateCredentials('gursimran' , 'Rightnow!');
use RightNow\Connect\v1_2 as RNCPHP;
/*
File Name: incident_view.php
Description: 
URL: https://opn-virt.rightnowdemo.com/cgi-bin/opn_virt.cfg/php/custom/incident_view.php?ref_no=15345-123123&i_id=23423
*/
try{	
	//$ref_no = $_GET['ref_no'];
	$i_id = $_GET['i_id'];
	if(strlen($i_id)){
		$incident = RNCPHP\Incident::fetch($i_id);
		echo $incident->Subject;
	}
} // try
catch(Exception $e){	
	echo "Error: ".$e->getMessage()." | Line: ".$e->getLine();
} // catch
?>