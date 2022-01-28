<?php

namespace App\Repository\WaitLister;

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
        $fullname = strip_tags($input['fullname']);
        $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $type = $input['type'];
        $asset_description = !empty($input['asset_description']) ?
            strip_tags($input['asset_description']) : null;

        $emailExists = $this->waitlister->where('email', $email)
            ->first();

        if ($emailExists) {
            return [
                'error' => true,
                'msg' => [
                    'email' => array(['Email associated with another waitlister.'])
                ],
            ];
        }

        $this->waitlister->create([
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type,
            'asset_description' => $asset_description
        ]);

        $waitlister = $this->waitlister->findBy('email', $email);

        return [
            'error' => false,
            'msg' => 'You are added to the waitlist',
            'data' => $waitlister,
        ];
    }
}