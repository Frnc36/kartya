<?php
class Kartya
{
    //adattagok
    private $szin; //tábla vagy egy mező
    private $forma;

    //tagfüggvények
    //konstruktor
    public function __construct($szin, $forma)
    {
        $this->szin = $szin;
        $this->forma = $forma;
    }

    public function getSzin()
    { //public function default
        return $this->szin;
    }

    function getForma()
    {
        return $this->forma;
    }

    function setSzin($szin)
    {
        $this->szin = $szin;
    }

    function setForma($forma)
    {
        $this->forma = $forma;
    }

    function __toString()
    {
        return "<br>Kártya színe: " . $this->szin . "<br>Kártya formája: " . $this->forma;
    }
}
