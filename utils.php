<?php
/* Unset HTTP-request parameters in URL, that is the
   first parameter of the function. Parameters to 
   unset are given in the array that is the second parameter
 */
function Delete_Parameters_URL($url, $parameters) {
	$parts = parse_url($url);
	foreach ($parameters as $parameter) unset($parts['query'][$parameter]);
	return http_build_url($parts);
}

/* Get given HTTP-request parameters from URL. If not set, 
   parameters will not be in result. URL is the first parameter
   of the function and the array of parameters is
   the second one.
*/
function Get_Parameters_URL($url, $parameters) {
  $parts = parse($url);
  $query = $parts['query'];
  $res = array();
  foreach ($parameters as $parameter) {
    if (isset($query[$parameter])) {
      $res[$parameter] = $query[$parameter];
    }
  }
  return $res;
}

/* Add HTTP-request parameters to an URL, the URL
   is the first parameter of the function and the
   associated array of parameters is the second one.
 */
function Add_Parameters_URL($url, $parameters) {
	$parts = parse_url($url);
	foreach ($parameters as $parameter => $value) $parts['query'][$parameter] = $value;
	return http_build_url($parts);
}

/* Substitute given parameters from one URL to another,
   then delete given parameters. The first parameter is
   the URL to substitute to, the second one is the URL 
   to substitude from, the third parameter is an array 
   of parameters to substitude and the las one is an 
   array of parameters to delete.
 */
function Substitude_Parameters_URL($url1, $url2, $parameters, $parameters_to_delete = array()) {
  $parts = parse_url($url1);
  $parameters = Get_Parameters_URL($url2, $parameters);
  foreach ($parameters as $parameter => $value) $parts['query'][$parameter] = $value;
  foreach ($parameters as $parameter) unset($parts['query'][$parameter]);
  return http_build_url($parts);
} 
?>