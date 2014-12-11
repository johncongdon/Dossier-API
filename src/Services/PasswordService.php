<?php
namespace Dossier\Services;

/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Dossier
 * @subpackage Services
 */
class PasswordService
{
    /**
     * Verify a provided password
     *
     * @return bool true if password matches, false if no match
     */
    public function verify($password, $hash)
    {
        return \password_verify($password, $hash);
    }
}