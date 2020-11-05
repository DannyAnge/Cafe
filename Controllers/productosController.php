<?php
    class productosController extends Controller{
        private $productos;

        public function __construct(){
            parent::__construct();
            $this->productos = $this->loadModel("productos");
        }

        public function generarTabla(){
            $fila = $this->productos->getProductos();
            $table = '';

            foreach($fila AS $f){

                $datos = json_encode($f);
                $table .= '
                <tr>
                    <td>'.$f['id'].'</td>
                    <td>'.$f['nombre'].'</td>
                    <td>'.$f['propietario'].'</td>
                    <td>'.$f['direccion'].'</td>
                    <td><button class="btn btn-info editBoton"  data-p=\''.$datos.'\' data-target="#modalEditar" data-toggle="modal">Update</button></td>
                    <td><button class="btn btn-danger delBoton"  data-i=\''.$f['id'].'\'>Delete</button></td>
                </tr>
                ';
            }

            return $table;
        }

        public function index(){
            $this->_view->titulo = '
                <h6 class="m-0 font-weight-bold text-primary"><span class="fas fa-table"></span> Información General de los productos</h6>
            ';

            $tabla = $this->generarTabla();

            $this->_view->contenido = $tabla;

            $this->_view->renderizar("index");
        }

        public function edit(){
            $id = $this->getTexto("id");
            $nombre = $this->getTexto("nombre");
            $propietario = $this->getTexto("propietario");
            $direccion = $this->getTexto("direccion");
            $this->productos->updProducto($id,$nombre,$propietario,$direccion);

            echo $this->generarTabla();         
        }

        public function add(){
            if($this->getTexto("add") == "1"){
                $nombre = $this->getTexto("nombre");
                $propietario = $this->getTexto("propietario");
                $direccion = $this->getTexto("direccion");
                $this->productos->addProducto($nombre,$propietario,$direccion);
                $this->redireccionar("productos/index");
            }

            $this->_view->renderizar("agregarProducto");
        }

        public function eliminar(){
            $id = $this->getTexto("id");
            $this->productos->elim($id);
            echo $this->generarTabla();
        }
    }