<?php

use li3_rest\net\http\Router;

Router::connect('/', 'Projects::index');

/**
 * Handling API output formats.
 */
Router::connect('/{:args}.{:type:json}', [], ['continue' => true]);

/**
 * People routes
 */
Router::resource('People');

Router::connect('/signup', ['People::add']);

Router::connect('/signin', ['Sessions::add']);
Router::connect('/sessions', ['Sessions::create', 'http:method' => 'POST']);

Router::connect('/signout', ['Sessions::delete']);

/**
 * Projects routes
 */
Router::resource('Projects');

$project_path = '/projects/{:project_id:[0-9a-f]{24}}';

/**
 * Disucssions routes
 */
Router::connect($project_path . '/discussions'                         , ['Discussions::index'  , 'http:method' => 'GET']);
Router::connect($project_path . '/discussions/{:id:[0-9a-f]{24}}'      , ['Discussions::show'   , 'http:method' => 'GET']);
Router::connect($project_path . '/discussions/add'                     , ['Discussions::add'    , 'http:method' => 'GET']);
Router::connect($project_path . '/discussions'                         , ['Discussions::create' , 'http:method' => 'POST']);
Router::connect($project_path . '/discussions/{:id:[0-9a-f]{24}}/edit' , ['Discussions::edit'   , 'http:method' => 'GET']);
Router::connect($project_path . '/discussions/{:id:[0-9a-f]{24}}'      , ['Discussions::update' , 'http:method' => 'PUT']);
Router::connect($project_path . '/discussions/{:id:[0-9a-f]{24}}'      , ['Discussions::delete' , 'http:method' => 'DELETE']);

$discussions_path = $project_path . '/discussions/{:discussion_id:[0-9a-f]{24}}';

/**
* Messages routes
*/
Router::connect($discussions_path . '/messages/add'        , ['Messages::add'    , 'http:method' => 'GET']);
Router::connect($discussions_path . '/messages'            , ['Messages::create' , 'http:method' => 'POST']);
Router::connect($discussions_path . '/messages/{:id}/edit' , ['Messages::edit'   , 'http:method' => 'GET']);
Router::connect($discussions_path . '/messages/{:id}'      , ['Messages::update' , 'http:method' => 'PUT']);
Router::connect($discussions_path . '/messages/{:id}'      , ['Messages::delete' , 'http:method' => 'DELETE']);

/**
 * Activities routes
 */
Router::connect('/progress', ['Activities::index']);

?>