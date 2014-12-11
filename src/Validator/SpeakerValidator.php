<?php
namespace Dossier\Validator;

use Valitron\Validator;

/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Dossier
 * @subpackage Validator
 */
class SpeakerValidator 
{
    /**
     * Validator object
     */
    private $validator;

    /**
     * A collection of existing emails
     */
    private $existingEmails = [];

    /**
     * A collection of validation errors
     *
     * @var $errors
     */
    private $errors;

    /**
     * Constructor
     *
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validation for the creation context of the Speaker Entity
     *
     * @param array $existingEmails
     * @return bool
     */
    public function creationContext($existingEmails)
    {
        $this->validator->rule('email', 'email');
        $this->validator->rule('notIn', 'email', $existingEmails)->message('{field} is already registered')->label('Email');
        $this->validator->rule('equals', 'password', 'passwordConfirm');
        $this->validator->rule(
            'required',
            [
                'firstName',
                'lastName',
                'email',
                'password',
                'passwordConfirm',
            ]
        );

        $this->errors = $this->validator->errors();
        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Validation for the retrieval context of the Speaker entity
     *
     * @return bool
     */
    public function retrievalByEmailContext()
    {
        $this->validator->rule('email', 'email');
        $this->validator->rule('required', ['email']);

        $this->errors = $this->validator->errors();
        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Retrieve the error array from the previous request
     *
     * @return Array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}