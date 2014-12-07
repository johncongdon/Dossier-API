<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 *
 */
require '../vendor/autoload.php';

use Spot\Config as DBConfig;
use Valitron\Validator;
use Dossier\Validator\Validatable;

Dotenv::load(dirname(__DIR__));

$cfg = new DBConfig();
$cfg->addConnection('mysql', $_ENV['DSN']);
$spot = new \Spot\Locator($cfg);

$app = new \Slim\Slim();
$app->spot = $spot;

/**
 * Declaring the Options routes - since we're using CORS
 */
$app->options('/register', function() use ($app) {
	$app->response->setStatus(200);
});

$app->post('/register', function() use ($app) {
	$input = json_decode($app->request->getBody(), true);
	
});

$app->get('/', function() use ($app) {
});
$app->run();
