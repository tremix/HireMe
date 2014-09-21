<?php
/**
 * Created by PhpStorm.
 * User: Tremix
 * Date: 12/09/14
 * Time: 20:00
 */

namespace HireMe\Repositories;

use HireMe\Entities\Category;


class CategoryRepo extends BaseRepo{

    public function getModel()
    {
        return new Category;
    }

} 