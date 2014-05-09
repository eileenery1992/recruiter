<?php
$interviewers = array("mclean"=>"Mike McLean (mclean)");

parse_str($_SERVER['QUERY_STRING']);

$arr = array();

foreach ($interviewers as $key => $value) {
	if (strpos($value, $q) !== false) {
		array_push($arr, array("id"=>$key, "name"=>$value));
	}
}

# JSON-encode the response
$json_response = json_encode($arr);

# Return the response
echo $json_response;
?>

