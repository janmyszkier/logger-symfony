<?php
namespace AppBundle\Services;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Symfony\Component\Cache\Adapter\DoctrineAdapter;

class LogBrowserService {
    public function __construct(ManagerRegistry $doctrine)
    {
        /* @var EntityManager $manager */
        $this->em = $doctrine->getManager();
    }

    public function getBetween($from,$to = null){

        if(!is_int($from)){
            throw new \Exception('from parameter should be a timestamp');
        }

        if($to && !is_int($to)){
            throw new \Exception('to parameter should be a timestamp');
        }

        if($to == null){
            $to = strtotime('now');
        }

        $manager = $this->em;
        /* @var EntityManager $manager */
        $queryBuilder = $manager->createQueryBuilder();

        $from = date("Y-m-d H:i:s",$from);
        $to = date("Y-m-d H:i:s",$to);

        /* @var Query $query */
        $query = $queryBuilder->select(['l'])
            ->from('AppBundle:Log','l')
            ->where(
                $queryBuilder->expr()->between('l.createdAt',"'".$from."'","'".$to."'")
            )
            ->getQuery();

        var_dump($query->getSQL());

        return $query->getResult();
    }
}