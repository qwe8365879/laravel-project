<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Exception;

class FailedInternalRequestException extends Exception
{
    /**
    * Request instance
    *
    * @var $request
    */
   protected $request;
   /**
    * Response instance
    *
    * @var $response
    */
   protected $response;
   /**
    * Constructor
    *
    * @param Request  $request  The request object.
    * @param Response $response The response object.
    * @return void
    */
   public function __construct(Request $request, Response $response)
   {
       parent::__construct();
       $this->request = $request;
       $this->response = $response;
   }
   /**
    * Get request object
    *
    * @return Request
    */
   public function getRequest()
   {
       return $this->request;
   }
   /**
    * Get response object
    *
    * @return Response
    */
   public function getResponse()
   {
       return $this->response;
   }
}
