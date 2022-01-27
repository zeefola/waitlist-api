<?php

namespace App\Repository\Actors;

use App\Repository\Contracts\Repository;
use App\Models\WaitLister;

class WaitListerActor extends Repository
{

    public function __construct(WaitLister $waitlister)
    {
        $this->model = $waitlister;
    }
}