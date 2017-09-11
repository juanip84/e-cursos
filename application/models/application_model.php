<?php
class Application_model extends CI_Model {
	public function __construct() {
            parent::__construct();
        }
	
	function login($usuario, $clave, $empresa)
	{
            $prefijo='';
            
            $this->db->select('e.pre');
            $this->db->from('empresas as e');
            $this->db->where('e.id', $empresa);
            $this->db->where('e.estado', 1);
            $this->db->limit(1);
            
            $query = $this->db->get();
            
            if($query->num_rows() >0) {
                $result=$query->row();

                $prefijo=$result->pre;
            }
            
            if ($prefijo!='' and $prefijo !=null){
                $this->db->select('u.id,u.nombre,u.usuario,u.email,u.perfil,u.empresa,u.estado,e.nombre as empresa_nombre,e.carpeta as empresa_carpeta,e.pre');
                $this->db->from($prefijo.'_usuarios as u');
                $this->db->join('empresas as e', 'u.empresa = e.id');
                $this->db->where('u.usuario', $usuario);
                $this->db->where('u.clave', $clave);
                $this->db->where('u.estado', 1);
                $this->db->where('e.id', $empresa);
                $this->db->limit(1);
                
                $query = $this->db->get();
                
                if($query->num_rows() >0) {
	   
                    $result=$query->row();

                    $this->session->set_userdata(array(
                        'id'       => $result->id,
                        'nombre' => $result->nombre,
                        'usuario' => $result->usuario,
                        'email' => $result->email,
                        'perfil' => $result->perfil,
                        'empresa' => $result->empresa,
                        'empresa_nombre' => $result->empresa_nombre,
                        'empresa_carpeta' => $result->empresa_carpeta,
                        'empresa_pre' => $result->pre,
                        'busqueda_cursos' => ''
                    ));

                    return true;
                }
                else
                {
                    return false;
                }
            }
            else {
                return false;
            }
	}
        
        function get_empresas()
	{   
            $select="SELECT emp.id,emp.nombre 
		FROM empresas as emp
		where emp.estado=1
		order by emp.nombre asc;";

            $query = $this->db->query($select);
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}
	
	function cambiar_clave($id,$clave)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $data = array(
                'clave' => $clave 
            );
		
            $this->db->where('id', $id);
            $query=$this->db->update($prefijo.'_usuarios', $data); 
	   
            if($query) {
                return true;
            }
            else
            {
                return false;
            }
	}
        
	function cambiar_mail($id,$email)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $data = array(
               'email' => $email 
            );
		
            $this->db->where('id', $id);
            $query=$this->db->update($prefijo.'_usuarios', $data); 
	   
            if($query) {
                $this->session->unset_userdata('email');
                $this->session->set_userdata('email',$email);
                return true;
            }
            else
            {
                return false;
            }
	}        
	
	function grabar_calificacion($idcurso,$idusuario,$calificacion)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $this->db->set('calificacion', $calificacion);
            $this->db->where('idcurso', $idcurso);
            $this->db->where('idusuario', $idusuario);
            $query=$this->db->update($prefijo.'_cursos_usuario'); 
	   
            if($query) {
                return true;
            }
            else
            {
                return false;
            }
	}
	
	function eliminar_curso($id,$empresa)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $espacio=0;
            $this->db->select('espacio');
            $this->db->from($prefijo.'_cursos');
            $this->db->where('id', $id);

            $query = $this->db->get();

            if($query->num_rows() >0) {
                $result=$query->row();
                $espacio=$result->espacio;
            }
		
            $this->db->where('idcurso', $id);
            $this->db->delete($prefijo.'_cursos_usuario'); 
		
            $this->db->where('id', $id);
            $this->db->delete($prefijo.'_cursos'); 
		
            $cant=$this->db->affected_rows();
	   
	    if($cant!=null && $cant>0) {
                $this->update_espacio_restante($espacio,$empresa,1);

	   	return true;
	    }
	    else
	    {
		return false;
	    }
	}
	
	function registrar($nombre,$usuario,$email,$empresa,$clave)
	{
            $data_empresa = array(
               'nombre' => $empresa 
            );
		
            $this->db->insert('empresas', $data_empresa); 
		
            $id=$this->db->insert_id();
		
            if($id==null || $id<=0) {
                return 0;
            }
		
            $data = array(
                'nombre' => $nombre ,
                'usuario' => $usuario ,
		'email' => $email,
		'clave' => $clave,
		'perfil' => 1,
		'empresa' => $id,
		'estado' => 1
            );
		
            $this->db->insert('usuarios', $data); 
		
            $id=$this->db->insert_id();

            if($id!=null && $id>0) {   
                $this->session->set_userdata(array(
                    'id'       => $id,
                    'usuario' => $data['usuario'],
                    'clave' => $data['clave'],
                    'email' => $data['email'],
                    'empresa' => $data['empresa']
		));

                return 1;
            }
            else
            {
                return 0;
            }
	}
        
	function new_user($nombre,$usuario,$email,$empresa,$clave)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $data = array(
                'nombre' => $nombre,
		'usuario' => $usuario,
		'email' => $email,
		'clave' => $clave,
		'perfil' => 2,
		'empresa' => $empresa,
		'estado' => 1
            );
		
            $insert = $this->db->insert($prefijo.'_usuarios', $data); 
		
            if(!$insert) {
		return 0;
            }
                
            $this->update_usuarios_restantes($empresa,0);
                        
            return 1;
	}
        
	function edit_user($id,$nombre,$usuario,$email)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $data = array(
		'nombre' => $nombre, 
		'usuario' => $usuario, 
		'email' => $email  
            );
		
            $this->db->where('id', $id);
            $query=$this->db->update($prefijo.'_usuarios', $data); 
            
            if($query) {
                return true;
            }
            else
            {
                return false;
            }
	}
        
	function delete_user($id,$empresa)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $data = array(
		'estado' => 0
            );
		
            $this->db->where('id', $id);
            $query=$this->db->update($prefijo.'_usuarios', $data); 
           
            if($query) {
                $this->update_usuarios_restantes($empresa,1);
	   	return true;
            }
            else
            {
                return false;
            }
	}
	
	function grabar_curso($titulo,$descripcion,$idcategoria,$idsubcategoria,$autor,$fecha,$hora,$link_imagen,$link_video,$link_material,$estado,$empresa,$espacio, $youtube, $link_audio)
	{	
            $prefijo=$this->session->userdata("empresa_pre");
            $data = array(
                'idcategoria' => $idcategoria ,
		'idsubcategoria' => $idsubcategoria,
		'empresa' => $empresa,
		'titulo' => $titulo,
		'descripcion' => $descripcion,
		'autor' => $autor,
		'fecha' => $fecha,
		'hora' => $hora,
		'link_imagen' => $link_imagen,
		'link_video' => $link_video,
		'link_doc' => $link_material,
                'link_audio' => $link_audio,
		'youtube' => $youtube,
                'espacio' => $espacio,
		'estado' => $estado
            );
            $error='';

            $insert=$this->db->insert($prefijo.'_cursos', $data); 
			
            if(!$insert) {
                $error='Surgio un error al insertar';
            }
		
            return $error;
	}	
        
        function grabar_examen($idusuario,$idcurso,$preguntas)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $error = 1;
            $autor=$this->get_autor($idcurso);
		
            if ($autor!=$idusuario) {
	    	$error='No se puede grabar un examen a un curso del cual no es autor';
	        return $error;
            }
            
            $data = array(
                'idcurso' => $idcurso
            );

            $insert=$this->db->insert($prefijo.'_examenes', $data); 
			
            if(!$insert) {
                $error='Surgio un error al insertar';
            }
            else {
                $idexamen=$this->db->insert_id();
        	if ($idexamen!=null && $idexamen>0) {
                    
                    foreach ($preguntas as $row) {
                        $pregunta = $row ['actual_question'];
                        $data = array(
                            'idexamen' => $idexamen,
                            'pregunta' => $pregunta
                        );
			$insert=$this->db->insert($prefijo.'_examenes_preguntas', $data);
			$idpregunta=$this->db->insert_id();
					
                        if ($idpregunta!=null && $idpregunta>0) {
                            $respuestas = $row['answers'];
                            foreach ($respuestas as $key => $rowResp) {
                                if($key == 0){
                                    $correcta = 1;
                                }
                                else{
                                    $correcta = 0;
                                }
                                
                        	$data = array(
                                    'idpregunta' => $idpregunta,
                                    'respuesta' => $rowResp,
                                    'correcta' => $correcta
				);
				
                                $insert=$this->db->insert($prefijo.'_examenes_respuestas', $data);
                            }
			}
                    }
                }
            }
            
            return $error;
        }	
	
        
        function grabar_examen_usuario($idusuario,$idexamen,$preguntas)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $error = 1;
            $total=0;
            $puntos=0;
            $respuesta_correcta=0;
            $calificacion='';

            foreach ($preguntas as $row) {
                    
                $data = array(
                    'idusuario' => $idusuario,
                    'idexamen' => $idexamen,
                    'idpregunta' => $row['idquestion'],
                    'idrespuesta' => $row['idanswer']
                );
                    
                $insert=$this->db->insert($prefijo.'_examenes_usuarios', $data);
                    
                $respuesta=$row['idanswer'];
                $pregunta=$row['idquestion'];
                    
                $respuesta_correcta=$this->get_respuesta_correcta($pregunta);
                    
                if ($respuesta_correcta==$respuesta) {
                    $puntos++;
                }
                    
                $total++;
            }
                
            $calificacion=$puntos.'/'.$total;
                
            $data = array(
                'calificacion' => $calificacion
            );
                
            $idcurso=$this->get_curso_porexamen($idexamen);
                
            $this->db->where('idusuario', $idusuario);
            $this->db->where('estado', 1);
            $this->db->where('idcurso', $idcurso);
            $insert=$this->db->update($prefijo.'_asignaciones', $data);
			
            return $error;
	}
        
        function get_respuesta_correcta($idpregunta)
	{		
            $prefijo=$this->session->userdata("empresa_pre");
            $this->db->select('er.id');
            $this->db->from($prefijo.'_examenes_respuestas as er');
            $this->db->where('er.idpregunta', $idpregunta);
            $this->db->where('er.correcta', 1);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
		$result=$query->row();

	   	return $result->id;
            }
	}
        
        function get_curso_porexamen($idexamen)
	{	
            $prefijo=$this->session->userdata("empresa_pre");
            $this->db->select('e.idcurso');
            $this->db->from($prefijo.'_examenes as e');
            $this->db->where('e.id', $idexamen);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                $result=$query->row();

                return $result->idcurso;
            }
	}
	
	function inscribirme($id,$idusuario)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            $data = array(
		'idcurso' => $id ,
		'idusuario' => $idusuario
            );
            $error=null;
		
            $autor=$this->get_autor($id);
		
            if ($autor!=$idusuario) {
                $insert=$this->db->insert($prefijo.'_cursos_usuario', $data); 
			
		if (!$insert && $this->db->_error_number()==1062) {
                    $error='El curso ya esta en favoritos';
		}
		else if(!$insert) {
                    $error='Surgio un error al insertar';
		}

            }
            else {
		$error='No se puede agregar a favoritos un curso del que es autor';
            }
	
            return $error;
	}	
	
	function grabar_notificacion($idautor,$idcurso,$idusuario,$tipo,$mensaje,$estado)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $data = array(
                'idautor' => $idautor ,
		'idcurso' => $idcurso ,
		'idusuario' => $idusuario,
		'tipo' => $tipo,
		'mensaje' => $mensaje,
		'estado' => $estado
            );
		
            $error=null;

            $insert=$this->db->insert($prefijo.'_notificaciones', $data); 

            if(!$insert) {
                $error='Surgio un error al insertar';
            }
		
            return $error;
	}
	
	function get_autor($id)
	{	
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.autor');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->where('c.id', $id);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                $result=$query->row();

                return $result->autor;
            }
	}
        
        function get_autor_mail($id)
	{	
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('email');
            $this->db->from($prefijo.'_usuarios as u');
            $this->db->where('u.id', $id);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                $result=$query->row();

                return $result->email;
            }
	}
        
        function get_examen_usuario($id,$idusuario,$empresa)
	{	
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('e.id,c.titulo');
            $this->db->from($prefijo.'_examenes as e');
            $this->db->join($prefijo.'_asignaciones as a', 'a.idcurso = e.idcurso');
            $this->db->join($prefijo.'_cursos as c', 'c.id = e.idcurso');
            $this->db->where('e.id', $id);
            $this->db->where('a.idusuario', $idusuario);
            $this->db->where('c.empresa', $empresa);

            $query = $this->db->get();

            if($query->num_rows() >0) {
                $result=$query->row();

                return $result;
            }
	}
        
        function get_preguntas_examen($id)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('id,pregunta');
            $this->db->from($prefijo.'_examenes_preguntas ep');
            $this->db->where('ep.idexamen', $id);

            $query = $this->db->get();

            if($query->num_rows() >0) {
                return $query->result();
            }
	}
        
        function get_respuestas_examen($id)
	{	
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('id,respuesta');
            $this->db->from($prefijo.'_examenes_respuestas er');
            $this->db->where('er.idpregunta', $id);
            $this->db->order_by("rand()","DESC");

            $query = $this->db->get();

            if($query->num_rows() >0) {
                return $query->result();
            }
	}        
       

        function get_curso_usuario($id,$empresa,$idusuario)
        {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,c.autor,u.nombre,c.fecha,c.hora,c.link_imagen,c.link_video,c.link_doc,c.link_audio,c.youtube,cu.id as idfavorito');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->join($prefijo.'_cursos_usuario as cu', 'cu.idcurso = c.id and cu.idusuario='.$idusuario, 'left');
            $this->db->where('c.id', $id);
            $this->db->where("(c.empresa = $empresa OR c.empresa = 0)");
            $this->db->limit(1);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
		$result=$query->row();
                   
                $data = array(
                    'visto' => 1
                );

                $this->db->where('idcurso',$id);
                $this->db->where('idusuario',$idusuario);
                $this->db->update($prefijo.'_asignaciones', $data); 

	   	return $result;
            }
            else {
                return null;
            }
	}
        
        function get_notificaciones_curso_usuario($id,$idusuario)
        {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('count(*) as cant');
            $this->db->from($prefijo.'_notificaciones as n');
            $this->db->where('n.idusuario', $idusuario);
            $this->db->where('n.idcurso', $id);
            $this->db->where('n.tipo', 1);
            $this->db->limit(1);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->row()->cant;
            }
            else {
                return 0;
            }
	}
        
        function get_titulo_curso($id)
        {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.titulo');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->where('c.id', $id);
            $this->db->limit(1);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->row()->titulo;
            }
            else {
                return null;
            }
	}    
	
	function get_calificacion($id)
        {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('avg(calificacion) as calif');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_cursos_usuario as cu', 'cu.idcurso = c.id');
            $this->db->where('c.id', $id);
            $this->db->where('cu.calificacion >0');
            $this->db->limit(1);

            $query = $this->db->get();
	   
            if ($query) {
		if($query->num_rows() >0) {
                    $result=$query->row()->calif;
	
                    return $result;
		}
		else {
                    return null;
		}
            }
            else {
		return null;
            }
	}
	
	function get_curso_autor($id,$idusuario,$empresa)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen,c.link_video,c.link_doc,c.link_audio,c.youtube');
            //avg(calificacion) as calificacion');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            //$this->db->join('cursos_usuario as cu', 'c.id = cu.idcurso');
            $this->db->where('c.id', $id);
            $this->db->where('c.autor', $idusuario);
            $this->db->where('c.empresa', $empresa);
            $this->db->limit(1);
	   
            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                $result=$query->row();

                return $result;
            }
	}
	
	function get_curso_info($id,$empresa)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->where('c.id', $id);
            $this->db->where("(c.empresa = $empresa OR c.empresa = 0)");
            $this->db->limit(1);
	   
            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                $result=$query->row();

                return $result;
            }
	}	
        
        function get_curso_titulo($id,$empresa)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.titulo');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->where('c.id', $id);
            $this->db->where("(c.empresa = $empresa OR c.empresa = 0)");
            $this->db->limit(1);
	   
            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                $result=$query->row();

                return $result->titulo;
            }
	}

        function get_ultimos_cursos($empresa)
	{	               
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->where('c.estado',1);
            $this->db->where('c.empresa',$empresa);
            $this->db->order_by("c.id","DESC");
            $this->db->limit(6);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}
        
        function buscar_cursos($frase,$empresa,$limit, $start)
	{	               
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->where('c.estado',1);
            $this->db->where('c.empresa',$empresa);
            $this->db->like('c.titulo', $frase);
            $this->db->order_by("c.id","DESC");
            $this->db->limit($limit,$start);

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}
        
        function buscar_cursos_count($frase,$empresa)
	{         
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->where('c.estado',1);
            $this->db->where('c.empresa',$empresa);
            $this->db->like('c.titulo', $frase); ;
	   
            return $this->db->count_all_results();
	}
        
        function get_categorias($empresa)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('cat.id as idcategoria,cat.nombre as categoria,subcat.id as idsubcategoria,subcat.nombre as subcategoria');
            $this->db->from($prefijo.'_categorias as cat');
            $this->db->join($prefijo.'_subcategorias as subcat', 'subcat.idcategoria = cat.id');
            $this->db->where('cat.idempresa',$empresa);
            $this->db->or_where('cat.idempresa', 0); 
            $this->db->order_by("cat.id","ASC");

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}
	
	function get_categorias_edit($empresa)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('cat.id as idcategoria,cat.nombre as categoria,subcat.id as idsubcategoria,subcat.nombre as subcategoria');
            $this->db->from($prefijo.'_categorias as cat');
            $this->db->join($prefijo.'_subcategorias as subcat', 'subcat.idcategoria = cat.id');
            $this->db->where('cat.idempresa',$empresa);
            $this->db->order_by("cat.id","ASC");

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();    
            }
	}	
	
	function get_cat_data($cat_id)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('cat.id as idcategoria,cat.nombre as categoria,subcat.id as idsubcategoria,subcat.nombre as subcategoria');
            $this->db->from($prefijo.'_categorias as cat');
            $this->db->join($prefijo.'_subcategorias as subcat', 'subcat.idcategoria = cat.id');
            $this->db->where('cat.id',$cat_id);
            $this->db->order_by("cat.id","ASC");

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}	
	
	function edit_cat($id,$nombre)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $data = array(
                'nombre' => $nombre
            );
		
            $this->db->where('id', $id);
            $query = $this->db->update($prefijo.'_categorias', $data); 
            if($query) {
                return true;
            }
            else
            {
                return false;
            }
	}
	
	public function new_cat($nombre,$empresa)
        {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $data = array(
		'nombre'=> $nombre,
		'idempresa'=> $empresa
            );
            $this->db->insert($prefijo.'_categorias', $data);
            
            return $this->db->insert_id();
	}
	
	function delete_cat($id)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->where('idcategoria', $id);
            $this->db->delete($prefijo.'_subcategorias'); 
		
            $this->db->where('id', $id);
            $this->db->delete($prefijo.'_categorias'); 
            $cant=$this->db->affected_rows();
	   
	    if($cant!=null && $cant>0) {
                return true;
	    }
	    else
	    {
                return false;
	    }
	}
	
	function delete_subcat($id)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->where('id', $id);
            $this->db->delete($prefijo.'_subcategorias'); 
            $cant=$this->db->affected_rows();
	   
	    if($cant!=null && $cant>0) {
                return true;
	    }
	    else
	    {
                return false;
	    }
	}
	
	function new_subcat($idcategoria, $nombre)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $data = array(
		'idcategoria' => $idcategoria,
		'nombre' => $nombre
            );
		
            $insert = $this->db->insert($prefijo.'_subcategorias', $data); 
		
            if(!$insert) {
		return 0;
            }
            
            return 1;
	}
	
	function edit_subcat($id,$nombre)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $data = array(
		'nombre' => $nombre
            );
		
            $this->db->where('id', $id);
            $query = $this->db->update($prefijo.'_subcategorias', $data); 
            if($query) {
                return true;
            }
            else
            {
                return false;
            }
	}
	
	function get_cursos_top()
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
	    $select="SELECT * 
		FROM (
		SELECT cu.idcurso, c.titulo, COUNT( * ) AS vistas
		FROM ".$prefijo."_cursos_usuario as cu
		join ".$prefijo."_cursos as c on cu.idcurso=c.id
		GROUP BY cu.idcurso,c.titulo
		) AS cursos
		order by vistas desc
		LIMIT 3;";

            $query = $this->db->query($select);
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}	
	
	function get_categorias_drop($empresa)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.nombre');
            $this->db->from($prefijo.'_categorias as c');
            $this->db->where('c.idempresa',$empresa);
            $this->db->order_by("c.id","ASC");

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}		
	
	function get_subcategorias($id)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('sub.id,sub.nombre');
            $this->db->from($prefijo.'_subcategorias as sub');
            $this->db->where('sub.idcategoria',$id);
            $this->db->order_by("sub.id","ASC");

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}		
        
        function get_cursos($empresa,$limit,$start)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->where('c.estado',1);
            $this->db->where('c.empresa',$empresa);
            $this->db->order_by("c.id","DESC");
            //$this->db->limit($limit,$start);  //paginado

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}		
	
	function get_listado($idcategoria,$idsubcategoria,$empresa,$limit,$start)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->where('c.idcategoria',$idcategoria);
            $this->db->where('c.idsubcategoria',$idsubcategoria);
            $this->db->where('c.estado',1);
            $this->db->where("(c.empresa = $empresa OR c.empresa = 0)");
            $this->db->order_by("c.id","DESC");
            $this->db->limit($limit,$start);  //paginado

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}	
        
	function get_company_users($empresa,$idusuario)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('id, nombre, usuario, email, perfil, estado');
            $this->db->from($prefijo.'_usuarios');
            $this->db->where('estado',1);
            $this->db->where('empresa',$empresa);
            $this->db->where_not_in('id', $idusuario);
            $this->db->order_by("nombre","ASC");

            $query = $this->db->get();

            if($query->num_rows() >0) {
                return $query->result();
            }
	}
        
        function get_asig_users($empresa,$idusuario,$idcurso)
	{      
            $prefijo=$this->session->userdata("empresa_pre");
            
            /*$this->db->select('u.id, u.nombre, u.usuario, u.email, u.perfil, u.estado');
	    $this->db->from($prefijo.'_usuarios as u');
            $this->db->join($prefijo.'_asignaciones as a', 'a.idusuario=u.id and a.idcurso='.$idcurso.' and a.estado=1','left');
	    $this->db->where('u.estado',1);
	    $this->db->where('u.empresa',$empresa);
            $this->db->where_not_in('u.id', $idusuario);
            $this->db->order_by("a.idusuario","ASC");
	    $this->db->order_by("u.nombre","ASC");*/
            
            $select="SELECT u.id, u.nombre, u.usuario, u.email, u.perfil, u.estado
		FROM ".$prefijo."_usuarios as u
                left join ".$prefijo."_asignaciones as a on a.idusuario=u.id and a.idcurso=$idcurso and a.estado=1
                where u.estado=1
                and u.empresa=$empresa
                and u.id !=$idusuario
                order by a.id desc, u.nombre asc;";

            $query = $this->db->query($select);
            //$query = $this->db->get();
	   
            if($query->num_rows() >0) {
                return $query->result();
            }
	}
        
        function eliminar_favorito($id,$idusuario)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->where('idcurso', $id);
            $this->db->where('idusuario', $idusuario);
            $this->db->delete($prefijo.'_cursos_usuario'); 
		
            $cant=$this->db->affected_rows();
	   
	    if($cant!=null && $cant>0) {
	   	return true;
	    }
	    else
	    {
		return false;
	    }
	}
	
	function get_cursos_inscripto($idusuario,$limit,$start)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen,calificacion', false);
            $this->db->from($prefijo.'_cursos_usuario as cu');
            $this->db->join($prefijo.'_cursos as c', 'cu.idcurso = c.id');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->where('cu.idusuario',$idusuario);
            $this->db->limit($limit,$start);  //agregado paginado

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                if ($query->num_rows() ==1 && $query->row()->id==null) {
                    return null;
		}
		else {
                    return $query->result();
		}
            }
            else {
                return null;
            }
	}	
        
       	function get_cursos_asignados($idusuario,$limit,$start)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen,e.id as examen, a.calificacion', false);
            $this->db->from($prefijo.'_asignaciones as a');
            $this->db->join($prefijo.'_cursos as c', 'a.idcurso = c.id');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->join($prefijo.'_examenes as e', 'e.idcurso = a.idcurso', 'left');
            $this->db->where('a.idusuario',$idusuario);
            $this->db->where('a.estado','1');
            $this->db->limit($limit,$start);  //agregado paginado

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
		if ($query->num_rows() ==1 && $query->row()->id==null) {
                    return null;
		}
		else {
                    return $query->result();
		}
            }
            else {
                return null;
            }
	} 
	
	function get_notificaciones($idusuario,$limit,$start)
	{	   
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('notif.idcurso,notif.idusuario,notif.tipo,notif.estado,notif.mensaje,c.titulo as nombre_curso, u.usuario as nombre_usuario');
            $this->db->from($prefijo.'_notificaciones as notif');
            $this->db->join($prefijo.'_cursos as c', 'notif.idcurso = c.id');
            $this->db->join($prefijo.'_usuarios as u', 'notif.idusuario = u.id');
            $this->db->where('notif.idautor',$idusuario);
            $this->db->order_by("notif.id","DESC");
            $this->db->limit($limit,$start);  //agregado paginado

            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
                if ($query->num_rows() ==1 && $query->row()->idcurso==null) {
                    return null;
                }
		else {
                    $this->notificaciones_leidas($idusuario);
                    return $query->result();
		}
            }
            else {
                return null;
            }
	}	
	
	function notificaciones_leidas($id) {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $data = array(
                'estado' => 1 
            );
		
            $this->db->where('idautor', $id);
            $query=$this->db->update($prefijo.'_notificaciones', $data); 
	}
        
        function get_listado_count($idcategoria,$idsubcategoria,$empresa)
	{   
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->from($prefijo.'_cursos as c');
            $this->db->where('c.idcategoria',$idcategoria);
            $this->db->where('c.idsubcategoria',$idsubcategoria);
            $this->db->where('c.estado',1);
            $this->db->where('c.empresa',$empresa);

            return $this->db->count_all_results();
	}
        
        function get_favoritos_count($idusuario)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->from($prefijo.'_cursos_usuario as cu');
            $this->db->where('cu.idusuario',$idusuario);

            return $this->db->count_all_results();
	}
        
        function get_asignados_count($idusuario)
        {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->from($prefijo.'_asignaciones as a');
            $this->db->where('a.idusuario',$idusuario);
            $this->db->where('a.estado','1');

            return $this->db->count_all_results();
        }   

        function get_mis_cursos_count($idusuario)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->from($prefijo.'_cursos as c');
            $this->db->where('c.autor',$idusuario);

            return $this->db->count_all_results();
	}
        
        function get_notificaciones_count($idusuario)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->from($prefijo.'_notificaciones as n');
            $this->db->join($prefijo.'_cursos as c', 'n.idcurso = c.id');
            $this->db->where('n.idautor',$idusuario);

            return $this->db->count_all_results();
	}
	
	function get_mis_cursos($idusuario,$limit,$start)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.id,c.titulo,c.descripcion,u.nombre,c.fecha,c.hora,c.link_imagen, c.estado,e.id as idexamen', false);
            $this->db->from($prefijo.'_cursos as c');
            $this->db->join($prefijo.'_usuarios as u', 'c.autor = u.id');
            $this->db->join($prefijo.'_examenes as e', 'e.idcurso = c.id', 'left');
            $this->db->where('c.autor',$idusuario);
            $this->db->order_by("c.id","DESC");
            $this->db->limit($limit,$start);

            $query = $this->db->get();
            if($query->num_rows() >0) {
                if ($query->num_rows() ==1 && $query->row()->id==null) {
                    return null;
		}
		else {
                    return $query->result();
		}
            }
            else {
                return null;
            }
	}	
        
        function get_espacio_restante($empresa)
	{
            //$prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('espacio,espacio_utilizado');
            $this->db->from('empresas');
            $this->db->where('id', $empresa);

            $query = $this->db->get();

            if($query->num_rows() >0) {
                $result=$query->row();
                $espacio=$result->espacio;
                $espacio_utilizado=$result->espacio_utilizado;

                return ($espacio-$espacio_utilizado);
            }
	}
        
        function update_espacio_restante($espacio,$empresa,$operacion)
	{
            //$prefijo=$this->session->userdata("empresa_pre");
            
            $sql="";
            if ($operacion==0) {
                $sql="update empresas set espacio_utilizado=espacio_utilizado+? where id=?";
            }
            else {
                $sql="update empresas set espacio_utilizado=espacio_utilizado-? where id=?";
            }
            
            $query=$this->db->query($sql, array($espacio,$empresa)); 

	    if($query) {
                return true;
	    }
	    else
	    {
                return false;
	    }
	}
        
        function get_usuarios_restantes($empresa)
        {
            //$prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('usuarios,usuarios_utilizados');
            $this->db->from('empresas');
	    $this->db->where('id', $empresa);
	   
	    $query = $this->db->get();

	    if($query->num_rows() >0) {
                $result=$query->row();
                $usuarios=$result->usuarios;
                $usuarios_utilizados=$result->usuarios_utilizados;
                
                return ($usuarios-$usuarios_utilizados);
	   }
        }
        
        function update_usuarios_restantes($empresa,$operacion)
        {
            //$prefijo=$this->session->userdata("empresa_pre");
            
            $sql="";
            if ($operacion==0) {
                $sql="update empresas set usuarios_utilizados=usuarios_utilizados+? where id=?";
            }
            else {
                $sql="update empresas set usuarios_utilizados=usuarios_utilizados-? where id=?";
            }
            
            $query=$this->db->query($sql, array(1,$empresa)); 

	    if($query) {
                return true;
	    }
	    else
	    {
                return false;
	    }
        }
        
        function get_curso_archivos($id,$empresa)
        {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('c.link_imagen,c.link_video,c.link_doc,c.youtube');
            $this->db->from($prefijo.'_cursos as c');
            $this->db->where('c.id', $id);
            $this->db->where('c.empresa', $empresa);
            $this->db->limit(1);
	   
            $query = $this->db->get();
	   
            if($query->num_rows() >0) {
	   
		$result=$query->row();

	   	return $result;
            }
            else {
                return null;
            }
	}
	
	function get_asig($idcurso)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('a.id,a.idusuario,a.calificacion,a.visto');
            $this->db->from($prefijo.'_asignaciones as a');
            $this->db->where('a.idcurso', $idcurso);
            $this->db->where('a.estado', 1);
            
            //$this->db->select('u.id,a.idusuario,a.calificacion,a.visto');
            //$this->db->from($prefijo.'_usuarios as u');
            //$this->db->join($prefijo.'_asignaciones as a', 'u.id = a.idusuario and a.estado=1 and a.idcurso='.$idcurso, 'left');
            
            $query = $this->db->get();
            
            if($query->num_rows() >0) {
                return $query->result();
            }
	}	

	function add_asig($idcurso,$idusuario,$idautor)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $data = array(
                'idcurso' => $idcurso ,
                'idusuario' => $idusuario,
                'estado' => 1
            );
                
            $this->db->where('idcurso', $idcurso);
            $this->db->where('idusuario', $idusuario);
            $q = $this->db->get($prefijo.'_asignaciones');
            if ( $q->num_rows() > 0 ) 
            {
                $this->db->where('idcurso', $idcurso);
                $this->db->where('idusuario', $idusuario);
                $this->db->update($prefijo.'_asignaciones',$data);
            } 
            else {
                $this->db->insert($prefijo.'_asignaciones',$data);
                    
                /*$data = array(
                    'idcurso' => $idcurso ,
                    'idusuario' => $idautor,
                    'idautor' =>$idusuario,
                    'tipo' => 2,
                    'mensaje' => 'Se le asigno como obligatorio el curso: '.$titulo,
                    'estado' => 0
                );
                    
                $this->db->insert('notificaciones',$data);*/
            }
               
            return true;
	}
	
	function remove_asig ($idcurso,$idusuario)
	{
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->where('idcurso', $idcurso);
            $this->db->where('idusuario', $idusuario);
            $this->db->delete($prefijo.'_asignaciones'); 
		
            $cant=$this->db->affected_rows();
	   
	    if($cant!=null && $cant>0) {
	   	return true;
	    }
	    else
	    {
		return false;
	    }
	}
        
        function get_are_notifications ($idusuario)
        {
            $prefijo=$this->session->userdata("empresa_pre");
            
            $this->db->select('count(*) as cant');
            $this->db->from($prefijo.'_notificaciones');
            $this->db->where('idautor', $idusuario);
            $this->db->where('estado', 0);
                
            $query = $this->db->get();
                
            if($query->num_rows() >0) {
                $result=$query->row();
                $cant=$result->cant;
                
                return $cant;
            }
        }

}
?>