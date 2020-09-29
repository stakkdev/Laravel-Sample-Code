<?php

namespace App\Traits\API\V1\Common;

use  Response;
use Illuminate\Http\Response as IlluminateResponse;

trait APIResponse
{

    protected static $response = null;

    /**
     * @var int
     */
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return  $this->statusCode;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondUnauthorized($message = 'Unauthorized!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondForbidden($message = 'Forbidden!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInvalidParameters($message = 'Invalid Parameters!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);
    }

    /**
     * @param string $message
     * @param object $model
     * @return mixed
     */
    public function respondCreated($model = null, $message = 'Resource Successfully Created.')
    {
        $data = ['message' => $message];
        if ($model) {
            $data['model'] = $model;
        }

        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond($data);
    }


    public function reponseSuccess($data = [], $message = 'Response Successfully!')
    {
        $data = $this->setData($data);
        $data = ['status_code' => $this->getStatusCode(), 'message' => $message, 'data' => $data,];
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respond($data);
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    private function respond($data, $headers = [])
    {
        $data = $this->setData($data);
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param string $message
     * @return mixed
     */
    protected function respondWithError($message)
    {
        return $this->respond([
            'status_code' => $this->getStatusCode(),
            'message' => $message,
            'data' => "",
        ]);
    }
    protected function setData($complexObject){
        $json = json_encode($complexObject);
        $encodedString = preg_replace('/null/', '""' , $json);
        $data = json_decode($encodedString);
        return $data;
    }
}
