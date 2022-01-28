<?php

namespace App\Repository\WaitLister;

use App\Http\Resources\WaitListerResource;
// use App\Models\WaitLister;
use App\Repository\Actors\WaitListerActor;
use Exception;

/**
 * Class WaitListerRepository
 * @package App\Repository\WaitLister
 */
class WaitListerRepository
{
    /**
     * @var WaitListerActor
     */
    private $waitlister;

    /**
     * WaitListerRepository constructor.
     * @param WaitListerActor $waitlister
     */
    public function __construct(WaitListerActor $waitlister)
    {
        $this->waitlister = $waitlister;
    }

    /**
     * WaitList Sign Up
     * @param $input
     * @return array []
     * @throws Exception
     */
    public function signUp($input): array
    {
        $this->waitlister->create($input);
        $waitlister = $this->waitlister->findBy('email', $input['email']);

        return [
            'msg' => 'You are added to the waitlist',
            'data' => new WaitListerResource($waitlister),
            'code' => 201
        ];
    }
}