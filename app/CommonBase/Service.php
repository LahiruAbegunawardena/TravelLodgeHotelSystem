<?php
/**
 * ${MODULE}
 *
 * @package    ${PACKAGE}
 * @subpackage ${SUB_PACKAGE}
 * @author     Dev2
 * Date: 4/30/2019
 * Time: 5:44 PM
 */

namespace App\CommonBase;

// App\BO\Entities\Models\Entity;
use Illuminate\Http\Request;

class Service
{
    protected $entity = null;

    public function __construct()
    {
        // setting role id
        // $role_id = \request()->header('role');
        // $entity = Entity::find($role_id);
        // $this->entity = $entity;
    }
}
