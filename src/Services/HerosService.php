<?php
namespace App\Services;

use App\Entity\Hero;


class HeroService
{
    private $_listeHeros=[];

    public function __construct()
    {
        $this->addHero(new Hero('Rogers','Steve',false,'Captain Americana', 'Un maigrichon dopé par  l armee'));
        $this->addHero(new Hero('Romanof','Natasha',false,'La Veuve Noire', 'La james bond girl qui a pris la place de 007'));
    
    }
    public function getList()
    {
        return $this->_listeHeros;
    }
    public function addHero($pHero)
    {
        array_push($this->_listeHeros,$pHero);
    }
    public function getHero($pId)
    {
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
