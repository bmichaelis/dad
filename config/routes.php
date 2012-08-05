<?php

/**
 * The routes file is where you define your URL structure, which is an important part of the
 * [information architecture](http://en.wikipedia.org/wiki/Information_architecture) of your
 * application. Here, you can use _routes_ to match up URL pattern strings to a set of parameters,
 * usually including a controller and action to dispatch matching requests to. For more information,
 * see the `Router` and `Route` classes.
 *
 * @see lithium\net\http\Router
 * @see lithium\net\http\Route
 */
use li3_rest\net\http\Router;
use lithium\core\Environment;

/**
 * Here, we are connecting `'/'` (the base path) to controller called `'Pages'`,
 * its action called `view()`, and we pass a param to select the view file
 * to use (in this case, `/views/pages/home.html.php`; see `app\controllers\PagesController`
 * for details).
 *
 * @see app\controllers\PagesController
 */
Router::connect('/', 'Pages::view');

/**
 * Connect the rest of `PagesController`'s URLs. This will route URLs like `/pages/about` to
 * `PagesController`, rendering `/views/pages/about.html.php` as a static page.
 */
Router::connect('/pages/{:args}', 'Pages::view');

/**
 * Add the testing routes. These routes are only connected in non-production environments, and allow
 * browser-based access to the test suite for running unit and integration tests for the Lithium
 * core, as well as your own application and any other loaded plugins or frameworks. Browse to
 * [http://path/to/app/test](/test) to run tests.
 */
if (!Environment::is('production')) {
	Router::connect('/test/{:args}', ['controller' => 'lithium\test\Controller']);
	Router::connect('/test', ['controller' => 'lithium\test\Controller']);
}

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

?>