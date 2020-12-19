<?php 

class usuariosController extends Controller
{  
    private $_usuarios;
     function __construct()
    {
        parent::__construct();
        $this->_usuarios=$this->loadModel('usuarios');
    }

    public function generarTabla(){
        $fila=$this->_usuarios->obtenerUsuarios();
        
        $tabla='';
        foreach ($fila as $f) {

        $datos= json_encode($f);
      
        $tabla.='<tr>
            <td class="text-center">'.$f['id'].'</td>
            <td class="text-center">'.$f['nombre'].'</td>
            <td class="text-center">'.$f['password'].'</td>
            <td class="text-center">
                <div class="btn-group">
                   <button class="btn btn-primary botonEditarusr" data-toggle="modal" data-target="#modalEditarusr" data-p=\'' .$datos. '\'>
                    <span class="fas fa-edit"></span>
                   </button>
                  
                   <button class="btn btn-dark botonEliminarusr" data-d=\'' .$f['id']. '\'>
                    <span class="fas fa-trash"></span>
                   </button>

                </div>
            </td>
            </tr>';
        }

        return $tabla;
    }

    public function index()
    {   
        $tabla=$this->generarTabla();
        $this->_view->tabla=$tabla;
        $this->_view->renderizar('index');
           
    }
    public function edit(){
            $id=$this->getTexto('id');
            $nombre=$this->getTexto('nombre');
            $password=$this->getTexto('password');
            $this->_usuarios->actualizarUsuarios($id, $nombre, $password);
        echo $this->generarTabla();
    }

   public function agregar()
    {
        
            if($this->getTexto('agregar')=='1') {
            $nombre=$this->getTexto('nombre');
            $password=$this->getTexto('password');
            $this->_usuarios->agregarUsuarios($nombre, $password);
            $this->redireccionar('usuarios');
        }
      
        $this->_view->renderizar('agregar');
    }

    public function eliminar(){
        $id = $this->getTexto('id');
        $this->_usuarios->eliminar($id);
        echo $this->generarTabla();
    }
    

}


 ?>
