<?php

namespace App\Http\Controllers\WaitLister;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use App\Repository\WaitLister\WaitListerRepository;
use Illuminate\Validation\Rule;

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
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function signUp(Request $request): JsonResponse
    {
        $email = ['bail', 'required', 'email'];
        if (App::environment('production')) {
            $email = ['bail', 'required', 'email:rfc,dns'];
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'fullname' => ['bail', 'required', 'string'],
            'email' => $email,
            'type' => ['bail', 'required', Rule::in('investor', 'asset_lister')],
            'asset_description' => ['bail', 'required_if:type,asset_lister', 'string'],
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json(['error' => true, 'msg' => $messages], 422);
        }

        return response()->json($this->waitlister->signUp($input));
    }
}