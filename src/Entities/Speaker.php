<?php
namespace Dossier\Entities;

use Carbon\Carbon;
use Spot\Entity;

/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 9/22/14
 * Time: 2:05 PM
 */

class Speaker extends Entity
{
    protected static $mapper = 'Dossier\Entities\Mapper\Speaker';
    protected static $table = 'speakers';
    public static function fields()
    {
        return [
            'id'           => ['type' => 'string', 'primary' => true, 'required' => true],
            'first_name'   => ['type' => 'string', 'required' => true],
            'last_name'    => ['type' => 'string', 'required' => true],
            'email'        => ['type' => 'string','required' => true],
            'password'     => ['type' => 'string', 'required' => true],
            'created_at'   => ['type' => 'string', 'required' => true, 'value' => new Carbon()],
            'updated_at'   => ['type' => 'datetime', 'value' => new Carbon()],
            'deleted_at'   => ['type' => 'datetime', 'value' => new Carbon()]
        ];
    }
} 