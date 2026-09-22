<?php

namespace App\Http\Controllers;

use App\Application\Actions\RegisterDeviceAction;
use App\Http\Requests\RegisterDeviceRequest;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    public function register(
        RegisterDeviceRequest $request,
        RegisterDeviceAction $action
    ): JsonResponse {
        $device = $action->execute(
            auth()->id(),
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Device registered successfully.',
            'data' => [
                'id' => $device->id,
                'platform' => $device->platform,
                'is_active' => $device->is_active,
            ],
        ]);
    }
}