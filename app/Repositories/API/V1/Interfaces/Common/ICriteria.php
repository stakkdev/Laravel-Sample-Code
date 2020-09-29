<?php

namespace App\Repositories\API\V1\Interfaces\Common;

use App\Repositories\API\V1\Common\Criteria;

/**
 * Interface CriteriaInterface
 * @package Bosnadev\Repositories\Contracts
 */
interface ICriteria
{

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true);

    /**
     * @return mixed
     */
    public function getCriteria();

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria);

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria);

    /**
     * @return $this
     */
    public function  applyCriteria();
}
