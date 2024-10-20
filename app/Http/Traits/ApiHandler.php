<?php

namespace App\Http\Traits;

trait ApiHandler {
    public function successResponse($data = null, $message = 'ok', $status = 200) {
        if(!$data) {
            return response(['message' => $message, 'status' => $status], $status);
        }
        return response(['data' => $data, 'message' => $message, 'status' => $status], $status);
    }

    public function errorResponse($data = null, $message = 'error', $status = 404) {
        if(!$data) {
            return response(['message' => $message, 'status' => $status], $status);
        }
        return response(['data' => $data, 'message' => $message, 'status' => $status], $status);
    }
}
