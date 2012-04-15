<?php
require 'ActiveRecord/ActiveRecord.php';
require 'Slim/Slim/Slim.php';

class Todo extends ActiveRecord\Model { }

ActiveRecord\Config::initialize(function($cfg) {
  $cfg->set_connections(array('development' => 'mysql://root:@localhost/todos'));
});


$app = new Slim();

$app->get('/todos', function() {
  echo json_encode(array_map(function($todo) { return $todo->attributes(); }, Todo::all()));
});

$app->post('/json', function() {
  global $app;
  $todo = new Todo(json_decode($app->request()->getBody(), true));
  $todo->save();
});

$app->get('/json/:id', function($id) {
  echo Todo::find($id)->to_json();
});

$app->put('/json/:id', function($id) {
  global $app;
  Todo::find($id)->update_all(array('set' => json_decode($app->request()->getBody(), true)));
});

$app->delete('/json/:id', function($id) {
  Todo::find($id)->delete();
});

$app->run();
