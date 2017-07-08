<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;

/**
 * Controller
 *
 * This controller is used as to send the json response to application based on operation.
 *
 * @author Jitender <jitender65@gmail.com>
 */
class Controller extends BaseController {
    
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;
    /**
     * status code to send the HTTP response.
     * @var integer 
     */
    protected $statusCode = Response::HTTP_OK;
    
    /**
     * $status is used to send the status of request.
     * @var integer // 0 or 1. 
     */
    protected $status = 1;
    
    /**
     * $success is used to set the success status.
     * @var integer
     */
    protected $success = 1;
    
    /**
     * $failed is used to set the faluire status.
     * @var integer
     */
    protected $failed = 0;

    /**
     * This method is used to get the $status property
     * @return integer // 0 or 1.
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * This method is used to set the $status property
     * @param integer $status
     * @return \App\Http\Controllers\Controller
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    /**
     * This method is used to get the $statusCode property
     * @return integer // 0 or 1.
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * This method is used to set the $statusCode property
     * @param integer $statusCode
     * @return \App\Http\Controllers\Controller
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * This method is used to send the json response in case of success.
     * @param string $message
     * @param array $data
     * @return json
     */
    public function respondSuccess($message = 'Success', $data = array()) {
        return $this->setStatus($this->success)->setStatusCode(Response::HTTP_OK)->respond($data, $message);
    }
    
    /**
     * This method is used to send the json response using custom status code.
     * @param integer $statusCode
     * @param string $message
     * @param array $data
     * @return json
     */
    public function respondCustom($status,$statusCode, $message = '', $data = array()) {
        return $this->setStatus($status)->setStatusCode($statusCode)->respond($data, $message);
    }

    /**
     * This method is used to send the response for unauthorized access.
     * @param string $message
     * @param array $data
     * @return json
     */
    public function respondUnauthorized($message = 'Unauthorized Access.', $data = array()) {
        return $this->setStatus($this->failed)->setStatusCode(Response::HTTP_UNAUTHORIZED)->respond($data, $message);
    }

    /**
     * This method is used to send the bad request response.
     * @param string $message
     * @param array $data
     * @return json
     */
    public function respondBadRequest($message = 'Bad Request.', $data = array()) {
        return $this->setStatus($this->failed)->setStatusCode(Response::HTTP_BAD_REQUEST)->respond($data, $message);
    }

    /**
     * This method is used to send the response when resource not found.
     * @param string $message
     * @param array $data
     * @return json
     */
    public function respondNotFound($message = 'Not Found.', $data = []) {
        return $this->setStatus($this->failed)->setStatusCode(Response::HTTP_NOT_FOUND)->respond($data, $message);
    }

    /**
     * This method is used to send the Server error.
     * @param string $message
     * @param array $data
     * @return json
     */
    public function respondServerError($message = 'Internal Server Error.', $data = []) {
        return $this->setStatus($this->failed)->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respond($data, $message);
    }

    /**
     * This method is used to send the json response.
     * @param array $data
     * @param string $message
     * @param integer $headers
     * @return json
     */
    public function respond($data, $message, $headers = []) {
        $response = array(
            'status' => $this->getStatus(),
            'statusCode' => $this->getStatusCode(),
            'message' => $message,
            'result' => (object) $data ,
        );

        return \Illuminate\Support\Facades\Response::json($response, $response['statusCode'], $headers);
    }
    
    /**
     * This method is used to send the response for forbidden access.
     * @param string $message
     * @param array $data
     * @return json
     */
    public function respondForbidden($message = 'Forbidden Access.', $data = array()) {
        return $this->setStatus($this->failed)->setStatusCode(Response::HTTP_FORBIDDEN)->respond($data, $message);
    }
}
