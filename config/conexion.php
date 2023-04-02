<?php 

    class Conectar {
        protected $dbh;

        /*TODO Función Protegida de la cadena de conexión */
        protected function Conexion() {
            try {
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=crudphp01","root","");
                return $conectar;
            } catch (Exception $e) {
                print "¡Error DB!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function set_names() {
            return $this->dbh->query("SET NAMES 'utf8'");
        }
    }

?>