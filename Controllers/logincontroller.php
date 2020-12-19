<?php 

class loginController extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

    public function index()
    {	
    	if ($this->getTexto('ingresar')=='1') {
    		//acceso a la base de datos 
    		if ($this->getTexto('usuario')=='Danny' && $this->getTexto('clave')=='2020') {

    			// validados
    			Accesos::setDatos('validados', true);
    			Accesos::setDatos('rol', 'admin');
    			Accesos::setDatos('usuario', 'Danny Flores');
    			$this->redireccionar('index');

    		} else{
    			$this->_view->mensaje='<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><i class="icon fas fa-exclamation-triangle"></i>Usuario y/o Clave Incorrectos.</strong>
			  </div>';
    		}
    	}
    	$this->_view->renderizar('index');

    }
    public function salir()
    {
    	Accesos::salir();
    	$this->redireccionar('login/index');
    }
}

 ?>