<?php

namespace App\Repositories\API\V1\Common;

use App\Repositories\API\V1\Interfaces\Common\IGenericRepository;

abstract class Criteria
{

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, IGenericRepository $repository);
}
