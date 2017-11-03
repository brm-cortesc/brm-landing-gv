<?php

require 'src/facebook-sdk-v5/autoload.php';

session_start();

$fb = new Facebook\Facebook([
  'app_id' => '187597281786470',
  'app_secret' => '066e01e4e47096002d1488f05ffc2f18',
  'default_graph_version' => 'v2.2',
  ]);