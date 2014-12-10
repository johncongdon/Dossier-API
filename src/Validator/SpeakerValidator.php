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
    public function __construct(Validator $validator, $existingEmails)
    {
        $this->validator = $validator;
        $this->existingEmails = $existingEmails;
    }

    /**
     * Validation for the creation context of the Speaker Entity
     *
     * @return bool
     */
    public function creationContext()
    {
        $this->validator->rule('email', 'email');
        $this->validator->rule('notIn', 'email', $this->existingEmails)->message('{field} is already registered')->label('Email');
        $this->validator->rule('equals', 'password', 'passwordConfirm');
        $this->validator->rule(
            'required',
            array(
                'firstName',
                'lastName',
                'email',
                'password',
                'passwordConfirm',
            )
        );

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