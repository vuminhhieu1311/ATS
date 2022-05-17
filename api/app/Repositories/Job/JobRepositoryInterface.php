<?php

namespace App\Repositories\Job;

use App\Repositories\RepositoryInterface;

interface JobRepositoryInterface extends RepositoryInterface
{
    public function queryAllByConditions($conditions = [], $relations = []);
    public function getAllLocations($conditions = []);
}
