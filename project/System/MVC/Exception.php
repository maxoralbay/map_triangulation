<?php

namespace MVC;

class Exception extends \Exception
{
    public function __construct($message)
    {
        echo $message;
    }

}
