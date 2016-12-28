<?php

namespace GcoBundle\Listener;

use GcoBundle\Exceptions\ErrorCodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
class MessageExceptionListener
{
    /**
     * handle error for a route
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        if(method_exists('getStatusCode', $exception)){
            $statusCode = $exception->getStatusCode();
        }
        if ($exception instanceof HttpExceptionInterface) {
            $previousException = $exception->getPrevious();
            if ($previousException instanceof ErrorCodeInterface) {
                $code   = $previousException->getErrorCode();
                $message = $previousException->getMessage();
            } else {
                $statusText = Response::$statusTexts[$exception->getStatusCode()];
                $code = strtoupper(str_replace(' ', '_', $statusText));
                $message = $exception->getMessage();
            }
        } else {
            $code = 'INTERNAL_ERROR';
            $message = $exception->getMessage();
        }
        $responseData = [
            'error' => [
                'code' => $code,
                'message' => $message
            ]
        ];
        $event->setResponse(new JsonResponse($responseData, $statusCode));
    }
}
