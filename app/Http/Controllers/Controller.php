<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sentSuccessResponse($data = '', $message = 'success', $extraDataTransmission = [], $status = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'extra_data_transmission' => $extraDataTransmission
        ], $status);
    }
}
