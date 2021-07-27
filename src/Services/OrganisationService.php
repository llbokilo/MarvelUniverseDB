<?php
namespace App\Services;

use App\Entity\Organisation;
use Doctrine\ORM\EntityManagerInterface;

class OrganisationService
{
    private $_listeOrgas=[];
    private $_entityManager;

    public function __construct(EntityManagerInterface $em){
        $this->_entityManager = $em;
        /* $this->addOrga(new Organisation('S.H.I.E.L.D.', 'Washington'));
        $this->addOrga(new Organisation('Les Avengers', 'Los Angeles'));
        $this->addOrga(new Organisation('La confrérie des mauvais mutants', 'Genosha')); */
    }

    public function getListOrga(){
        $this->_listeOrgas = $this->_entityManager
        ->getRepository(Organisation::class)
        ->findall();

        return $this->_listeOrgas;
    }

    public function addOrga($pOrga){
        array_push($this->_listeOrgas,$pOrga);
        $this->_entityManager->persist($pOrga);
        $this->_entityManager->flush();
    }

    public function getOrga($pId){
        $find = false;
        /* $Orga = null;
        $i = 0;
        while (($i < count($this->_listeOrgas))&& $find == false)
        {
            if ($this->_listeOrgas[$i]->getId()==$pId)
            {
                $find = true;
            $Orga = $this->_listeOrgas[$i];
            }
            $i++;
        }
        return  ['found'=>$find,'organisation'=>$Orga]; */
        $orga = $this->_entityManager->getRepository(Organisation::class)->find($pId);
        if (isset($orga))
            $find = true;
        return  ['found'=>$find,'organisation'=>$orga];
    }

    public function delOrga($pId){
        $orga = $this->getOrga($pId);
        if ($orga['found']== true){
            $this->_entityManager->remove($orga['organisation']);
            $this->_entityManager->flush();
        }
    }
}
