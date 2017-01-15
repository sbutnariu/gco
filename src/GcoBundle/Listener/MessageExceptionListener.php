<?php

namespace GcoBundle\Listener;

use GcoBundle\Exceptions\ErrorCodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;
class MessageExceptionListener implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => array('onKernelException', 10)
        );
    }

    /**
     * handle error for a route
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        if ($exception instanceof HttpExceptionInterface) {
            $statusCode = $exception->getStatusCode();
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
