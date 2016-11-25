<?php

namespace Tests\GcoBundle\DataFixture;

use GcoBundle\DataFixture\TechnologyDataFixture;
use GcoBundle\Factory\TechnologyFactory;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
class TechnologyDataFixtureTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @TechnologyDataFixture
     */
    private $daoMock;
    private $dbMock;

    public function setUp()
    {

        $this->dbMock = $this->getMockBuilder('Doctrine\Bundle\DoctrineBundle\Registry')
            ->disableOriginalConstructor()
            ->getMock();

        $this->daoMock = $this->getMockBuilder('GcoBundle\DataFixture\TechnologyDataFixture')
            ->disableOriginalConstructor()
            ->getMock();

        $this->daoMock = new TechnologyDataFixture($this->dbMock);
    }

    public function providerGetTechnology()
    {
        return array(
            array(
                array(
                    'id' => 1,
                    'core_id' => 2,
                    'technology' => 'javascript'
                )
            )
        );
    }

    /**
     * @dataProvider providerGetTechnology
     */
    public function testGetListOfTechnologies($technologyArray) {

        $actualResult = TechnologyFactory::create($technologyArray);

        $repository = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->dbMock->expects($this->once())
            ->method('getRepository')
            ->with('GcoBundle:Technology')
            ->will($this->returnValue($repository));
        $queryBuilder = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $repository->expects($this->once())
            ->method('createQueryBuilder')
            ->with('t')
            ->will($this->returnValue($queryBuilder));
        $queryBuilder->expects($this->at(0))
            ->method('where')
            ->with('t.technology LIKE :technology')
            ->will($this->returnValue($queryBuilder));
        $queryBuilder->expects($this->at(1))
            ->method('setParameter')
            ->with('technology', '%'.$actualResult->getTechnology().'%')
            ->will($this->returnValue($queryBuilder));
        $getQuery = $this->getMockBuilder(AbstractQuery::class)
            ->setMethods(array('getResult'))
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $queryBuilder->expects($this->at(2))
            ->method('getQuery')
            ->will($this->returnValue($getQuery));
        $getQuery->expects($this->once())
            ->method('getResult')
            ->will($this->returnValue(array($actualResult)));


        $expectedResult = $this->daoMock->getListOfTechnologies($actualResult);
        $this->assertEquals(array($actualResult), $expectedResult);

    }

}