<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class Controller
{
    /**
     * Summary of jsonResponse: A protected function that returns a json response.
     * @param mixed $data
     * @param int $status
     * @param array $headers
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($data, int $status = 200, array $headers = []): JsonResponse {
        return response()->json($data, $status, $headers);
    }

    /**
     * Summary of sanitizeAndGet: Helper metod to get the search data, sanitize, and return.
     * @param \App\Http\Controllers\Request $request
     * @return string
     */
    protected function sanitizeAndGet(Request $request) {
        return trim($request->input('search', ''));
    }

    /**
     * Summary of generateID: A helper function that generates a uuid
     * @param array $validated
     * @return array|string
     */
    protected function generateUUID(array $validated=[]): array|string {

        // Generates UUID
        $UUID = Str::uuid()->toString();

        // Check if validated does exist
        if(isset($validated)) {
            // Append
            $validated['id'] = $UUID;
            
             // Return validated (for array only)
             return $validated;
        }

        // Return (for string only)
        return $UUID;

    }
}
