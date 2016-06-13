<?php

namespace Yajra\CMS\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait NotificationResponse
{
    /**
     * @var string
     */
    protected $notificationType = 'success';

    /**
     * @param mixed $response
     * @return \Illuminate\Http\JsonResponse
     */
    public function notifyError($response)
    {
        if (is_string($response)) {
            $response = ['text' => $response];
        }

        $default = [
            'status' => false,
            'title'  => 'Error',
            'text'   => 'Oops! An error occurred and we were not able to process your request!',
        ];

        $data = array_diff_key($default, $response) + $response;

        return $this->setNotificationType('error')->notify($data);
    }

    /**
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function notify(array $data, $code = 200)
    {
        $data['type'] = $this->getNotificationType();

        return new JsonResponse($data, $code);
    }

    /**
     * @return string
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * @param string $responseType
     * @return $this
     */
    public function setNotificationType($responseType)
    {
        $this->notificationType = $responseType;

        return $this;
    }

    /**
     * @param mixed $response
     * @return \Illuminate\Http\JsonResponse
     */
    public function notifySuccess($response)
    {
        if (is_string($response)) {
            $response = ['text' => $response];
        }

        $default = [
            'status' => true,
            'title'  => 'Success',
            'text'   => 'Requested process successfully completed!',
        ];

        $data = array_diff_key($default, $response) + $response;

        return $this->setNotificationType('success')->notify($data, Response::HTTP_OK);
    }
}

