<?php
    class AB
    { //osztály nagybetus
        //adattagok az osztáyban
        private $host = "localhost";
        private $fNev = "root";
        private $jelszo = "";
        private $abNev = "magyarkartya"; //phpadatbázis neve
        private $kapcsolat; // az elözö négy adattag alapján jön létre
        //ameddig saját gépen vagyunk
        //konstruktor
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
                $this->kapcsolat->set_charset("utf8"); //utf-8 - kötöjel nem jó
            } catch (mysqli_sql_exception $e) { //$e szokott lenni
                throw new Exception("Adatbázis kapcsolódáis hiba történt: ".$e->getMessage());
            }
        }
        
        //tagfuggvenyek
        public function oszlopLeker($oszlop, $tabla) {
            $sql = "SELECT $oszlop FROM $tabla";
            $matrix = $this->kapcsolat->query($sql);
            return $matrix;
        }

        public function megejelenit($matrix) {
            while ($sor = $matrix->fetch_row()) {
                echo "<img src='forras/$sor[0]' alt='$sor[0]'>";
            }
        }


        public function oszlopLekerNev($oszlop1, $oszlop2, $tabla) {
            $sql = "SELECT $oszlop1, $oszlop2 FROM $tabla";
            $matrix = $this->kapcsolat->query($sql);
            return $matrix;
        }
        
        public function megejelenitNev($matrix) {
            echo "<table>";
            while ($sor = $matrix->fetch_row()) {
                echo "<tr>";
                echo "<td> <img src='forras/$sor[0]'</td> <td> $sor[1] </td>";
                /* fetch_assoc() 
                $oszlop1 = "kep";
                $oszlop2 = "nev";
                echo "<td> <img src='forras/$sor[$oszlop1]'</td> <td> $sor[$oszlop2] </td>"; */
                echo "</tr>";
            }
            echo "</table>";
        }

        public function feltoltes() {
            $formaMeret = $this->meret("forma");
            $szinMeret = $this->meret("szin");
            for ($i=1; $i <= $formaMeret ; $i++) { //1-gyel indul, mert a autoicrement 1-től számozza
                for ($j=1; $j <= $szinMeret ; $j++) { 
                    try {
                        $stmt = $this->kapcsolat->prepare("INSERT INTO `kartya`(`formaAzon`, `szinAzon`) VALUES (?,?)");
                        $formaAzon = $i;
                        $szinAzon = $j;
                        $stmt->bind_param("ss",$formaAzon,$szinAzon); //ss, String, String a két típusa
                        $stmt->execute();
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            }
        }

        public function tombbeAlakit($matrix) {
            return $matrix->fetch_all(MYSQLI_ASSOC);
        }

        public function tablazatKiir($tomb) {
            echo "<table>";
            foreach ($tomb as $kulcs => $ertek) {
                echo "<tr>";
                //echo "<td>.$kulcs. ':' .$ertek.</td>";
                echo "<td>$kulcs. ':' .$ertek.<td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        public function meret($tabla) {
            $sql = "SELECT * FROM $tabla";
            return $this->kapcsolat->query($sql)->num_rows;
        }
        
        //tagfüggvények fölött kell lennie VAGY lehet nen? 
        public function kapcsolatLezar() {
            $this->kapcsolat->close();
        }
    
    }

?>