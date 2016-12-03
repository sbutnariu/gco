<?php

namespace GcoBundle\Listener;

use GcoBundle\Exceptions\ErrorCodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use GcoBundle\Exceptions\NotFoundException;
class MessageExceptionListener
{
    /**
     * handle error for a route
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $previous = $exception->getPrevious();
        if ($previous instanceof  ErrorCodeInterface) {
            $message = $previous->getMessage();
            $code = $previous->getErrorCode();
        } else {
            $message = NotFoundException::MESSAGE;
            $code = NotFoundException::INVALID_ROUTE_NAME;
        }

        $responseData = [
            'error' => [
                'code' => $code,
                'message' => $message
            ]
        ];
        $event->setResponse(new JsonResponse($responseData, $exception->getStatusCode()));
    }
}
