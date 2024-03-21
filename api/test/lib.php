<?php

/** 
 * Send a POST request to the specified endpoint
 * 
 * @param string $endpoint The endpoint URL
 * @param array $data The data to send
 * @return mixed The response data
 */
function make_post($endpoint, $data) {
	$ch = curl_init();
	$url = 'http://localhost:80/backend/api/' . $endpoint;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}

/**
 * Return false and an error message
 */
function failed($message) {
	return array('status' => 'failed', 'message' => $message);
}

/**
 * Return true
 */
function passed() {
	return array('status' => 'ok');
}

/**
 * Generate a random string
 * 
 * @param int $length The length of the string
 * @return string The random string
 */
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charLength - 1)];
    }

    return $randomString;
}

/**
 * Test the function
 *
 * @param function $function The function to test
 */
function test($function) {
	$result = $function();
	echo "Testing " . $function . " ... ";
	if ($result['status'] === 'failed') {
		echo "FAILED: " . $result['message'] . "\n";
	} else {
		echo "PASSED\n";
	}
}
?>
