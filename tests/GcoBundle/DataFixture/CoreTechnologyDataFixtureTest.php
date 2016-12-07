<?php
use Doctrine\ORM\EntityManager;
use GcoBundle\Entity\CoreTechnology;

class CoreTechnologyDataFixtureTest {


         /**
     *
     * @param string $technologyName
     */
    public function testSetCoreTechnology()
    {
        $coreTechnologyName = "{name:'php'}";
        $coreTechnologyName= json_encode($coreTechnologyName);
        $request = new Request(array(), $coreTechnologyName, array(), array(), array(), array(), null);        
        $coreTechnologyEntity = CoreTechnologyController::createCoreTechnology($request);
        
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->getMock();
        $em->expects($coreTechnologyEntity)
            ->method('persist')
            ->shouldBeCalledTimes(1);
        
        $em->expects($coreTechnologyEntity)
            ->method('flush')
            ->shouldBeCalledTimes(1);
    }

    /**
     * check if the core technology already exists in database
     *
     * @param string $technologyName
     */
   public function testGetTechnologyByName($technologyName){

        $connection = $this->em->getConnection();
        $statement = $connection->prepare("SELECT * FROM core_technology WHERE technology = :technology");
        $statement->bindValue('technology', $technologyName);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;

    }
}
