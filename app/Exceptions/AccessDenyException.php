<?php

namespace App\Exceptions;

use Illuminate\Http\Request;

use Exception;

class AccessDenyException extends Exception
{
    /**
    * Request instance
    *
    * @var $request
    */
    protected $request;

    /**
    * Constructor
    *
    * @param Request  $request  The request object.
    * @return void
    */
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
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
}
