<?php
	require_once __DIR__ . '/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => 'your app id',
  'app_secret' => 'your app secret',
  'default_graph_version' => 'v2.0',
  'default_access_token' => 'your access token', // optional
]);

try {
  $gitCommit = json_decode($_REQUEST['payload'], true);
  $post = ['message' => $gitCommit['commits'][0]['message'] . '-' . $gitCommit['commits'][0]['url']];
  $response = $fb->post('/me/feed', $post);
  
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}