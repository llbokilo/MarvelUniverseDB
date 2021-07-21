<?php
namespace App\Services;

use App\Entity\Hero;


class HeroService
{
    private $_listeHeros=[];

    public function __construct(){
        $this->addHero(new Hero('Rogers','Steve',false,'Captain America', 'Un maigrichon dopé par  l armee'));
        $this->addHero(new Hero('Romanof','Natasha',false,'La Veuve Noire', 'La james bond girl qui a pris la place de 007'));
        $this->addHero(new Hero("Barnes","Bucky",false,"Le soldat de l'hiver", "L'un des meilleurs amis/ennemis de Captain America"));
        $this->addHero(new Hero("Barnes","Bucky",true,"Magneto", "Le roi du magnétisme et meilleur ami de Charles Xavier"));
        $this->addHero(new Hero("Barnes","Bucky",true,"Thanos", "Le titan fou"));
        $this->addHero(new Hero("Barnes","Bucky",true,"Galactus", "Le dévoreur de mondes"));
    }
    public function getList(){
        return $this->_listeHeros;
    }
    public function addHero($pHero){
        array_push($this->_listeHeros,$pHero);
    }
    public function getHero($pId){
        $find = false;
        $hero = null;
        $i = 0; 
        while (($i < count($this->_listeHeros))&& $find == false)
        {
            if ($this->_listeHeros[$i]->getId()==$pId)
            {
                $find = true;
            $hero = $this->_listeHeros[$i];
            }
            $i++;
        }
        return  ['found'=>$find,'hero'=>$hero];
    }
}