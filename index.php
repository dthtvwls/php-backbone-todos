<?php
require 'ActiveRecord/ActiveRecord.php';
require 'Slim/Slim/Slim.php';

class Todo extends ActiveRecord\Model { }

ActiveRecord\Config::initialize(function($cfg) {
  $cfg->set_model_directory('.');
  $cfg->set_connections(array('development' => 'mysql://root:@localhost/todos'));
});


$app = new Slim();

$app->get('/json', function() {
  echo "Index";
});
$app->get('/json/:id', function($id) {
  echo "Hello, $id!";
});
$app->post('/json', function() {

});

$app->run();
