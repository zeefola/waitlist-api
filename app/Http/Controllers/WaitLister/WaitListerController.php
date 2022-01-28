<?php

namespace App\Http\Controllers\WaitLister;

use App\Http\Controllers\Controller;
use App\Http\Requests\WaitListerRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Repository\WaitLister\WaitListerRepository;
use App\Traits\ApiResponse;

/**
 * Class WaitListerController
 * @package App\Http\Controllers\WaitLister
 */
class WaitListerController extends Controller
{
    /**
     * @var WaitListerRepository
     */
    private $waitlister;

    /**
     * WaitListerController constructor.
     * @param WaitListerRepository $waitlister
     */
    public function __construct(WaitListerRepository $waitlister)
    {
        $this->waitlister = $waitlister;
    }

    /**
     * @param WaitListerRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function signUp(WaitListerRequest $request): JsonResponse
    {
        $newWaitlister = $request->validated();

        $data = $this->waitlister->signUp($newWaitlister);

        return ApiResponse::successResponseWithData($data['data'], $data['msg'], $data['code']);
    }
}