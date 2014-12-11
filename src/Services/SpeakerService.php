<?php
namespace Dossier\Services;

use Spot\Mapper;
use Valitron\Validator;
use Dossier\Entities\Hash;

/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Dossier
 * @subpackage Services
 */
class SpeakerService
{
    use Hash;
    /**
     * @var \Spot\Mapper $mapper
     *
     * Mapper object
     */

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * Method to create a speaker record using the provided mapper
     *
     * @param Array $data
     * @throws \Exception
     */
    public function create(Array $data)
    {
        if (isset($data['passwordConfirm'])) {
            unset($data['passwordConfirm']);
        }

        if (!array_key_exists('id', $data)) {
            $data['id'] = $this->generate();
        }

        $data['password'] = \password_hash($data['password'], PASSWORD_DEFAULT, ['cost' => 10, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)]);

        $this->mapper->create($data);
    }

    /**
     * Method to retrieve a speaker record by email with the mapper
     *
     * @param string $email
     * @return array
     */
    public function retrieveByEmail($email)
    {
        $speaker = $this->mapper->where(['email' => $email])->execute();
        return $speaker;
    }

    /**
     * Exists functionality to ensure the generated hash is not a duplicate
     *
     * @param string $id
     * @return bool
     */
    public function exists($id)
    {
        return false;
    }

}