<?php
namespace GcoBundle\Listener;

use GcoBundle\ExceptionTransformer\HttpExceptionTransformer;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionTransformerListener implements EventSubscriberInterface
{

    /**
     * @var HttpExceptionTransformer
     */
    private $exceptionTransformer;


    public function __construct(HttpExceptionTransformer $exceptionTransformer)
    {
        $this->exceptionTransformer = $exceptionTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => array('onKernelException', 11)
        );
    }

    /**
     * Executed when an exception is thrown and not caught by the program
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $ex = $event->getException();
        try {
            $this->exceptionTransformer->transform($ex);
        } catch (\Exception $e) {
            $event->setException($e);
        }
    }
}
