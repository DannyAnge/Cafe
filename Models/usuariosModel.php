<?php 

class usuariosModel extends Model
{
     function __construct()
    {
    	parent::__construct();
    }

	public function obtenerUsuarios($campo=null,$valor=null){
		$fila=$this->_db->query("SELECT * FROM usuarios")->fetchAll();
		return $fila;
	}

	public function agregarUsuarios( $nombre, $password){
	  $this->_db->prepare('INSERT INTO usuarios (id, nombre, password) VALUES(:id, :nombre, :password)')->execute(
	    	array(
				'id'=>$id,
	    		'nombre'=>$nombre,
	    		'password'=>$password,
	    	
	    	));
	}
		
 	public function actualizarUsuarios($id,$nombre,$password)

	 {	$this->_db->prepare('UPDATE usuarios SET 
			nombre = :nombre,
			password = :password,
		
			where id= :id')->execute(array(
				'id'=>$id,
	    		'nombre'=>$nombre,
	    		'password'=>$password,
	    		
	    	

	    ));
	}

	

	public function eliminar($id){
        $this->_db->prepare('DELETE FROM usuarios WHERE id =:id')->execute(
        	array(
        		'id'=>$id,
        	));
    }
}


 ?>
