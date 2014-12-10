<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 *
 */
require '../vendor/autoload.php';
require '../vendor/ircmaxell/password-compat/lib/password.php';

use Dossier\Entities as Entities;
use Dossier\Mapper as Mapper;
use Dossier\Services as Services;
use Dossier\Validator as Validate;
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
    try {

        $input = json_decode($app->request->getBody(), true);
        
        $validator = new Validator($input);
        $mapper = $app->spot->mapper('Dossier\Entities\Speaker');
        $speakerValidation = new Validate\SpeakerValidator($validator, $mapper->getExistingEmails());

        if ($speakerValidation->creationContext()) {
            $speakerRequest = new Services\SpeakerService($mapper);
            $speakerRequest->create($input, $validator);
            $app->response->setStatus(201);
        } else {
            $app->response->setStatus(400);
            $app->response->setBody($speakerValidation->getErrors());
        }

    } catch (Exception $e) {
    	echo $e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage();
        $app->response->setStatus(500);
    }
});

$app->get('/', function() use ($app) {
});

$app->run();
