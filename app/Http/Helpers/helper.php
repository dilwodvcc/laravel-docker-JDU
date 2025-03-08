<?php
function success($data = [], string $message = 'Success', int $status = 200)
{
    $response = [
        'success' => true,
        'data' => (object) $data,
    ];
    if (!empty($message)) {
        $response['message'] = $message;
    }
    return response()->json($response, $status);
}
