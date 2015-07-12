<?php
namespace SamBurns\Psr11Symfony\Exception;

class NotFoundException extends \Exception
{
    /**
     * @param string $serviceId
     * @return NotFoundException
     */
    public static function constructWithThingNotFound($serviceId)
    {
        $exception = new static();
        $exception->message = "Service '$serviceId' not found in DI container";
        return $exception;
    }
}
