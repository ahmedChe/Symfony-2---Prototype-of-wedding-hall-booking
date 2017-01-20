<?php

namespace FrontOffice\StaticBundle\Entity;

use Doctrine\ORM\EntityRepository;
use FrontOffice\StaticBundle\Entity\Client as client;

/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends EntityRepository
{
    public function existClient ($username,$pass)
    {
        $repository = $this->getEntityManager();
        $query=$repository->createQueryBuilder('c')
            ->from('FrontOffice\StaticBundle\Entity\Client','c')
            ->select('c.cin')
            ->where('c.login = :identifier')
            ->andwhere('c.password = :pass')
            ->setParameter('identifier', $username)
            ->setParameter('pass', $pass);
        return $query->getQuery()->getOneOrNullResult();
    }
    public function customizedUpdateWithPicture(client $client)
    {
        $repository = $this->getEntityManager();
        $query=$repository->createQueryBuilder('c')
            ->update('FrontOffice\StaticBundle\Entity\Client','c')
            ->set('c.tel',':tel')
            ->set('c.email',':email')
            ->set('c.photo',':photo')
            ->set('c.login',':login')
            ->set('c.password',':pass')
            ->where('c.cin = :cin')
            ->setParameter('tel', $client->getTel())
            ->setParameter('email', $client->getEmail())
            ->setParameter('photo', $client->getPhoto())
            ->setParameter('login', $client->getLogin())
            ->setParameter('pass', $client->getPassword())
            ->setParameter('cin', $client->getCin());
         return $query->getQuery()->execute();
    }
    public function customizedUpdateWithoutPicture(client $client)
    {
        $repository = $this->getEntityManager();
        $query=$repository->createQueryBuilder('c')
            ->update('FrontOffice\StaticBundle\Entity\Client','c')
            ->set('c.tel',':tel')
            ->set('c.email',':email')
            ->set('c.login',':login')
            ->set('c.password',':pass')
            ->where('c.cin = :cin')
            ->setParameter('tel', $client->getTel())
            ->setParameter('email', $client->getEmail())
            ->setParameter('login', $client->getLogin())
            ->setParameter('pass', $client->getPassword())
            ->setParameter('cin', $client->getCin());
        return $query->getQuery()->execute();
    }
}
