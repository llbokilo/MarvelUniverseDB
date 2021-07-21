<?php
namespace App\Services;

use App\Entity\Hero;


class OrganisationService
{
    private $_listeOrgas=[];

    public function __construct(){
        $this->addOrga(new Organisation('S.H.I.E.L.D.', 'Washington'));
        $this->addOrga(new Organisation('Les Avengers', 'Los Angeles'));
    }
    public function getListOrga(){
        return $this->_listeOrgas;
    }
    public function addOrga($pOrga){
        array_push($this->_listeOrgas,$pOrga);
    }
    public function getOrga($pNomOrga){
        $find = false;
        $Orga = null;
        $i = 0;
        while (($i < count($this->_listeOrgas))&& $find == false)
        {
            if ($this->_listeOrgas[$i]->getName()==$pNomOrga)
            {
                $find = true;
            $Orga = $this->_listeOrgas[$i];
            }
            $i++;
        }
        return  ['found'=>$find,'Organisation'=>$Orga];
    }
}
