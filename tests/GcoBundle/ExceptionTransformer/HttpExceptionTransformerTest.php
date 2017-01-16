<?php
namespace Tests\GcoBundle\ExceptionTransformer;

use GcoBundle\ExceptionTransformer\HttpExceptionTransformer;

class HttpExceptionTransformerTest extends \PHPUnit_Framework_TestCase
{
    protected $exceptionMapper;

    protected $shortcuts;

    public function setUp()
    {
        $this->shortcuts = array(
            'NotFoundHttpException' => 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException',
        );
        $this->exceptionMapper = array(
            'Doctrine\ORM\NoResultException' => 'NotFoundHttpException'
        );
    }

    public function testTransform()
    {
        $transformer = new HttpExceptionTransformer($this->shortcuts);
        $transformer->addMap($this->exceptionMapper);
        foreach ($this->exceptionMapper as $source => $destination)
        {
            $exception = new $source();
            try {
                $transformer->transform($exception);
            }
            catch (\Exception $e)
            {
                $this->assertEquals($this->shortcuts[$destination], get_class($e));
            }
        }
    }
}
