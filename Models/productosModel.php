<?php
    class productosModel extends Model{
        public function __construct(){
            parent::__construct();
        }

        public function getProductos($clave = null, $valor = null){
            $fila = $this->_db->query("SELECT * FROM fincas")->fetchAll();
            return $fila;
        }

        public function addProducto($nom,$prop,$dir){
            $this->_db->prepare("INSERT INTO fincas(nombre,propietario,direccion) VALUES(:nom,:prop,:dir)")->execute(array(
                "nom" => $nom,
                "prop" => $prop,
                "dir" => $dir
            ));
        }

        public function updProducto($id,$nombre,$propietario,$direccion){
            $this->_db->prepare("UPDATE fincas set nombre = :nom, propietario = :prop ,direccion = :dir WHERE id = :id")->execute(array(
                "id"  => $id,
                "nom" => $nombre,
                "prop" => $propietario,
                "dir" => $direccion,
            ));
        }

        public function elim($id){
            $this->_db->prepare("DELETE FROM fincas WHERE id = :id")->execute(array("id" => $id));
        }
    }
    ?>

