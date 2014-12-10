<?php namespace Dossier\Entities\Mapper;

use Carbon\Carbon;
use Dossier\Entities\Hash;
use Spot\Mapper;

/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 10/29/14
 * Time: 10:57 PM
 */
class Speaker extends Mapper
{
    use Hash;

    public function fromForm($form)
    {
        return [
            'id' => $this->generate(),
            'first_name' => $form->getFirstName(),
            'last_name' => $form->getLastName(),
            'email' => $form->getEmail(),
            'password' => password_hash($form->getPassword(), PASSWORD_DEFAULT),
            'created_at' => Carbon::now()
        ];
    }

    public function getExistingEmails()
    {
        $emails =  $this->all();

        $return = array();

        foreach ($emails as $email)
        {
            $return[] = $email->email;
        }

        return $return;
    }


    /**
     * Implementation of abstract Hash::exists() used to make sure
     * the generated ID isn't already used for a user
     *
     * @param string $id the id that is being checked
     * @return boolean true if ID exists, false otherwise
     */
    public function exists($id)
    {
        if ($id === '' || !$this->validateHash($id)) {
            throw new \RuntimeException('Oh noes! Something went wrong and we weren\'t able to fix it');
        }
        try {
            $result = $this->get($id);

            if ($result) {
                return true;
            }
        } catch (\Exception $e) {
            // log it
            throw new \RuntimeException('Oh noes! Something went wrong and we weren\'t able to fix it');
        }
        return false;
    }

} 