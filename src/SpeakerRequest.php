<?php
namespace Dossier;

use Spot\Mapper;
use Valitron\Validator;

/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Dossier
 * @subpackage Request
 */
class SpeakerRequest
{
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

    public function create(Array $data, Validator $validator)
    {
        $emails = $mapper->getExistingEmails();
        $validator->rule('email', 'email');
        $validator->rule('equals', 'password', 'password_confirmation');
        $this->validator->rule('notIn', 'email', $this->existing_emails)->message('{field} is already registered')->label('Email');
        $validator->rule('required', [
            'first_name',
            'last_name',
            'email',
            'password',
            'password_confirm'
        ]);
        if ($validator->validate()) {
            $mapper->create($data);
        }
    }

}