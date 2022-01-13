<?php


namespace App\Traits;


use App\Services\ToastResponse;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{

    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string|null  $message
     * @param  int|null  $status
     * @return JsonResponse
     */
    protected function success($data, string $message = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'status'    => 'Success',
            'message'   => $message,
            'data'      => $data
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $status
     * @param  array|string|null  $data
     * @return JsonResponse
     */
    protected function error(string $message, int $status, $data = null): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Return a toast JSON response.
     *
     * @param string $message
     * @param null $data
     * @param string $type
     * @param string|null $title
     * @param array $options
     * @param int|null $code
     * @return JsonResponse
     */
    protected function toast(string $message, string $type = ToastResponse::SUCCESS, int $status = 200, $data = null, string $title = null, array $options = []): JsonResponse
    {

        return response()->toast($message)
            ->withData([
                'status' => 'Success',
                'message' => $message,
                'data' => $data
            ])
            ->setType($type)
            ->setTitle($title)
            ->setOption($options)
            ->setStatusCode($status)
        ;
    }

    /**
     * Return a successToast JSON response.
     *
     * @param string $message
     * @param null $data
     * @param string|null $title
     * @param array $options
     * @return JsonResponse
     */
    protected function successToast(string $message, $data = null, string $title = null, array $options = []): JsonResponse
    {
        return $this->toast($message, ToastResponse::SUCCESS, 200, $data, $title, $options);
    }

    /**
     * Return a infoToast JSON response.
     *
     * @param string $message
     * @param null $data
     * @param string|null $title
     * @param array $options
     * @return JsonResponse
     */
    protected function infoToast(string $message, $data = null, string $title = null, array $options = []): JsonResponse
    {
        return $this->toast($message, ToastResponse::INFO, 200, $data, $title, $options);
    }

    /**
     * Return a warningToast JSON response.
     *
     * @param string $message
     * @param null $data
     * @param string|null $title
     * @param array $options
     * @return JsonResponse
     */
    protected function warningToast(string $message, $data = null, string $title = null, array $options = []): JsonResponse
    {
        return $this->toast($message, ToastResponse::WARNING, 200, $data, $title, $options);
    }

    /**
     * Return a errorToast JSON response.
     *
     * @param string $message
     * @param int $status
     * @param string|null $title
     * @param array $options
     * @return JsonResponse
     */
    protected function errorToast(string $message, int $status = 404, string $title = null, array $options = []): JsonResponse
    {
        return $this->toast($message, ToastResponse::ERROR, $status, [], $title, $options);
    }
}
