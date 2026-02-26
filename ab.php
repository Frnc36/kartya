<?php
    class AB
    { //osztály nagybetus, adattagok az osztáyban
        private $host = "localhost";
        private $fNev = "root";
        private $jelszo = "";
        private $abNev = "magyarkartya"; //phpadatbázis neve
        private $kapcsolat; // az elözö négy adattag alapján jön létre
        //ameddig saját gépen vagyunk
        public function __construct()
        {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            try {
                $this->kapcsolat = new mysqli(
                    $this->host,
                    $this->fNev,
                    $this->jelszo,
                    $this->abNev
                ); //nem kell a $jel, mert a $thissel új változó lesz, ->hivatkozól, mint a . jaba,python
                $this->kapcsolat->set_charset("utf8");
            } catch (mysqli_sql_exception $e) { //$e szokott lenni
                throw new Exception("Adatbázis kapcsolódáis hiba történt: ".$e->getMessage());
            }
        }
    }







    
?>