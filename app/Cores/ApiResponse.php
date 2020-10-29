<?php

namespace App\Cores;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

trait ApiResponse
{
    private $statusCode = HttpResponse::HTTP_OK;
    private $errors;

    /**
     * Return a 201 response with the given created resource.
     *
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public function withCreated($message = 'Created', $data = [])
    {
        return $this->setStatusCode(HttpResponse::HTTP_CREATED)->withSuccess($message, $data);
    }

    /**
     * Make a 400 'Bad Request' response.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function withBadRequest($message = 'Bad Request')
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_BAD_REQUEST
        )->withError($message);
    }

    /**
     * Make a 401 'Unauthorized' response.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function withUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_UNAUTHORIZED
        )->withError($message);
    }

    /**
     * Make a 403 'Forbidden' response.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function withForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_FORBIDDEN
        )->withError($message);
    }

    /**
     * Make a 404 'Not Found' response.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function withNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_NOT_FOUND
        )->withError($message);
    }

    /**
     * Make an error response.
     *
     * @param $message
     *
     * @return JsonResponse
     */
    public function withError($message)
    {
        $response = [
            'meta' => [
                'success' => false,
                'statusCode' => $this->getStatusCode(),
                'message' => $message,
            ]
        ];
        if ($this->getErrors()) {
            $response['meta']['errors'] = $this->getErrors();
        }
        return $this->json($response);
    }

    /**
     * Make a success response.
     *
     * @param $message
     * @param $data
     *
     * @return JsonResponse
     */
    public function withSuccess($message = 'Success', $data = [])
    {
        $response = [
            'meta' => [
                'success' => true,
                'statusCode' => $this->getStatusCode(),
                'message' => $message,
            ]
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return $this->json($response);
    }

    /**
     * @param array $data
     * @param array $headers
     * @return JsonResponse
     */
    public function json($data = [], array $headers = [])
    {
        return response()->json($data, $this->statusCode, $headers);
    }

    /**
     * Set HTTP status code.
     *
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Gets the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set Errors
     *
     * @param array $errors
     * @return $this
     */
    public function setErrors($errors = [])
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
