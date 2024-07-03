<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static function jsonResponse($message, $status)
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
        ], $status);
    }
}
