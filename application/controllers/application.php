<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class application extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
            parent::__construct();
            $this->load->model('application_model');
            $this->load->helper('url');
            $this->load->library('session');

            $this->load->library('javascript');
            $this->load->library('javascript/jquery');
            $this->load->library("pagination");
            $this->load->library("Pdf");
        }

	public function index()
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata['empresa'];
                //$data['title'] = "Inicio | E-Cursos";
		$title = "Inicio | E-Cursos";
                $data['cursos'] = $this->application_model->get_ultimos_cursos($empresa);
		$data['categorias'] = $this->application_model->get_categorias($empresa);

                //$this->load->view('header', $data);
                $this->header($title);
                $this->load->view('index', $data);
                $this->load->view('footer', $data);

            }
            else {
		$data['title'] = "Bienvenido a E-Cursos | E-Cursos";
		$this->load->view('principal', $data);
            }
	}

	public function principal()
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata['empresa'];
		//$data['title'] = "Inicio | E-Cursos";
		$title = "Inicio | E-Cursos";
                $data['cursos'] = $this->application_model->get_ultimos_cursos($empresa);
		$data['categorias'] = $this->application_model->get_categorias($empresa);

		//$this->load->view('header', $data);
                $this->header($title);
                $this->load->view('index', $data);
                $this->load->view('footer', $data);
            }
            else {
		$this->index();
            }
	}

        public function header($title){
            if ($this->session->userdata("id")>0) {
                $idusuario=$this->session->userdata("id");
                $data2['new_notifications'] =  $this->application_model->get_are_notifications($idusuario);
            }
            else {
                $data2['new_notifications'] =  0;
            }

            $data2['title']=$title;
            $this->load->view('header',$data2);
        }

	public function administracion()
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata['empresa'];
                $idusuario=$this->session->userdata("id");
                //$data['title'] = "Administracion | E-Cursos";
                $title="Administracion | E-Cursos";
                $data['empresa'] = $empresa;
		$data['users_data'] =  $this->application_model->get_company_users($empresa,$idusuario);
		$data['users_table'] = $this->load->view('users_table', $data,true);
		$data['categorias'] = $this->application_model->get_categorias_edit($empresa);
                $data['cursos'] = $this->application_model->get_cursos($empresa,0,0);

                //$this->load->view('header', $data);
                $this->header($title);
                $this->load->view('administracion', $data);
                $this->load->view('footer', $data);
            }
            else {
		$this->login();
            }
	}

        public function buscar_cursos()
	{
            if ($this->session->userdata("id")>0) {
                $title = "Busqueda | E-Cursos";
                $empresa=$this->session->userdata['empresa'];

		$frase=$this->input->post('frase');

                if ($frase!=null) {
                    $this->session->set_userdata(array(
                        'busqueda_cursos' => $frase
                    ));
                }
                else {
                    $frase=$this->session->userdata("busqueda_cursos");
                }

		$data['categorias'] = $this->application_model->get_categorias($empresa);

                //paginacion

		$config = array();
		$config["base_url"] = base_url() . "index.php/application/buscar_cursos";
		$config["total_rows"] = $this->application_model->buscar_cursos_count($frase,$empresa);
		$config["per_page"] = 6;
		$config["uri_segment"] = 3;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		//$data['reservas'] = $this->operaciones_model->get_reservas_like($cliente_nombre, $config["per_page"], $page);
                $data['cursos'] = $this->application_model->buscar_cursos($frase,$empresa,$config["per_page"], $page);

                $data["links"] = $this->pagination->create_links();

		//fin paginacion

                $this->header($title);
                $this->load->view('listado_busqueda', $data);
                $this->load->view('footer', $data);
            }
            else {
		$this->login();
            }
	}

	public function get_users_table()
	{
            if ($this->session->userdata("id")>0) {
                $idusuario=$this->session->userdata("id");
		$data['empresa'] = $this->session->userdata("empresa");
		$data['users_data'] =  $this->application_model->get_company_users($this->session->userdata['empresa'],$idusuario);

                echo json_encode($this->load->view('users_table', $data,true));
		return;
            }
            else {
		$this->login();
            }
	}

	public function get_cat_list()
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata("empresa");
		$data['empresa'] = $empresa;
		$data['categorias'] = $this->application_model->get_categorias_edit($empresa);

		echo json_encode($this->load->view('categorias_edit', $data,true));
		return;
            }
            else {
		$this->index();
            }
	}

	public function get_cat_edit_form()
	{
            if ($this->session->userdata("id")>0) {
		$cat_id = $this->input->post('cat_id');
		$data['cat_data'] = $this->application_model->get_cat_data($cat_id);
		$data['cat_id'] = $cat_id;

                echo json_encode($this->load->view('cat_edit_form', $data,true));
		return;
            }
            else {
		$this->index();
            }
	}

	public function get_cat_new_form()
	{
            if ($this->session->userdata("id")>0) {
		$data['cat_data'] = null;
		$data['cat_id'] = 0;

                echo json_encode($this->load->view('cat_edit_form', $data,true));
		return;
            }
            else {
		$this->index();
            }
	}


        public function get_exam_new_form()
	{
            if ($this->session->userdata("id")>0) {
		$data['exam_data'] = null;
		$data['exam_id'] = 0;

                echo json_encode($this->load->view('exam_edit_form', $data,true));
		return;
            }
            else {
		$this->index();
            }
	}

        public function crear_examen($id)
	{
            if ($this->session->userdata("id")>0) {
                $title = "Crear examen | E-Cursos";
                $data['curso_id'] = $id;
                $data['curso_titulo'] = $this->application_model->get_titulo_curso($id);
		$data['exam_data'] = null;
		$data['exam_id'] = 0;

                $this->header($title);
		$this->load->view('crear_examen', $data);
                $this->load->view('footer', $data);
            }
            else {
		$this->index();
            }
	}

	public function grabar_examen()
	{
            if ($this->session->userdata("id")>0) {
		$questions = $this->input->post('questions');
		$idcurso = $this->input->post('edit_id');
		$idusuario=$this->session->userdata("id");
                $empresa=$this->session->userdata("empresa");
                $titulo=$this->application_model->get_curso_titulo($idcurso,$empresa);
		$resultado = $this->application_model->grabar_examen($idusuario,$idcurso,$questions);

                $usuarios = $this->application_model->get_asig($idcurso);

                if ($usuarios!=null){
                    foreach ($usuarios as $usuario) {

                        $usuarioMail = $this->application_model->get_autor_mail($usuario->idusuario);

                        $this->generic_email($usuarioMail,'E-Cursos - Examen',"Se creo un examen para el curso: ".$titulo."\n\nEl equipo de E-Cursos.\nhttp://www.e-cursos.com.ar\ninfo@e-cursos.com.ar");

                        $mensaje='Se creo un examen para el curso: '.$titulo;

                        $this->application_model->grabar_notificacion($usuario->idusuario,$idcurso,$idusuario,3,$mensaje,0);
                    }
                }

                echo json_encode($resultado);
            }
            else {
		$this->index();
            }
	}

        public function grabar_examen_usuario()
	{
            if ($this->session->userdata("id")>0) {
		$questions = $this->input->post('questions');
		$idexamen = $this->input->post('edit_id');
		$idusuario=$this->session->userdata("id");
		$resultado = $this->application_model->grabar_examen_usuario($idusuario,$idexamen,$questions);

                echo json_encode($resultado);
            }
            else {
		$this->index();
            }
	}

	public function edit_cat()
	{
            $id = $this->input->post('id');
            $nombre = $this->input->post('nombre');
            $subcats = $this->input->post('subcats');
            if($id == 0){
		$empresa = $this->session->userdata("empresa");
		$id = $this->application_model->new_cat($nombre,$empresa);
            }else{
		$result = $this->application_model->edit_cat($id,$nombre);
            }

            foreach ($subcats as $key => $subcat) {
		if($subcat['deleted'] == 1){
			$result = $this->application_model->delete_subcat($subcat['id']);
		}else if($subcat['id'] == 0){
			$result = $this->application_model->new_subcat($id,$subcat['name']);
		}else{
			$result = $this->application_model->edit_subcat($subcat['id'],$subcat['name']);
		}
            }

            if($result>0)
            {
        	echo json_encode(1);
		return;
            }
            else {
		echo json_encode(0);
		return;
            }
	}

	public function delete_cat()
	{
            if ($this->session->userdata("id")>0) {
		$id = $this->input->post('id');
		$result = $this->application_model->delete_cat($id);
		if($result>0)
	        {
                    echo json_encode(1);
                    return;
	        }
		else {
                    echo json_encode(0);
                    return;
                }
            }
	}

	public function get_asig_form()
	{
            if ($this->session->userdata("id")>0) {
		$idcurso = $this->input->post('id');
                $idusuario = $this->session->userdata("id");

                $ret = new stdClass();
                //$data = new stdClass();

                //$data->idcurso = $idcurso;
                //$data->empresa = $this->session->userdata("empresa");
                //$data->users_data =  $this->application_model->get_asig_users($this->session->userdata['empresa'],$idusuario,$idcurso);

		$data['idcurso'] = $idcurso;
		$data['empresa'] = $this->session->userdata("empresa");
		$data['users_data'] =  $this->application_model->get_asig_users($this->session->userdata['empresa'],$idusuario,$idcurso);

                if($idcurso != 0){
                    $asig_data = $this->application_model->get_asig($idcurso);
		}
                else{
                    $asig_data = null;
		}

                $ret->html=$this->load->view('asig_form', $data,true);
		$ret->asig_data = $asig_data;

                echo json_encode($ret);
		return;
            }
            else {
		$this->index();
            }
	}

	public function edit_asig()
	{
            if ($this->session->userdata("id")>0) {
                $empresa = $this->session->userdata("empresa");
                $idusuario = $this->session->userdata("id");
		$idcurso = $this->input->post('id');

                $titulo=$this->application_model->get_curso_titulo($idcurso,$empresa);

		$adds = null;
		$adds = $this->input->post('adds');
		$removes = null;
		$removes = $this->input->post('removes');

                if($adds != null){
                    foreach ($adds as $key => $add) {
			$this->application_model->add_asig($idcurso,$add,$idusuario);

                        $usuarioMail = $this->application_model->get_autor_mail($add);

                        $this->generic_email($usuarioMail,'E-Cursos - Asignacion',"Se le asigno como obligatorio el curso: ".$titulo."\n\nEl equipo de E-Cursos.\nhttp://www.e-cursos.com.ar\ninfo@e-cursos.com.ar");

                        $mensaje='Se le asigno como obligatorio el curso: '.$titulo;

                        $this->application_model->grabar_notificacion($add,$idcurso,$idusuario,2,$mensaje,0);
                    }
		}

                if($removes != null){
                    foreach ($removes as $key => $remove) {
			$this->application_model->remove_asig($idcurso,$remove);
                    }
		}

                echo json_encode(1);
		return;
            }
            else {
		$this->index();
            }
	}


	public function contacto()
	{
            $title = "Contacto | E-Cursos";

            $this->header($title);
            $this->load->view('contacto');
            $this->load->view('footer');
	}

	public function como_subir_curso()
	{
            $title = "Como subir un curso | E-Cursos";
            $data['seccion'] = "subir_curso";

            $this->header($title);
            $this->load->view('seccion', $data);
            $this->load->view('footer', $data);
	}

	public function como_ver_curso()
	{
            $title = "Como ver un curso | E-Cursos";
            $data['seccion'] = "ver_curso";

            $this->header($title);
            $this->load->view('seccion', $data);
            $this->load->view('footer', $data);
	}

	public function convertir_video()
	{
            $title = "Como convertir un video | E-Cursos";
            $data['seccion'] = "convertir_video";

            $this->header($title);
            $this->load->view('seccion', $data);
            $this->load->view('footer', $data);
	}

	public function envio_mail()
	{
            $empresa=$this->session->userdata['empresa'];
            $nombre=$this->input->post('nombre');
            $email=$this->input->post('email');
            $asuntoform=$this->input->post('asunto');
            $asunto="Mensaje enviado desde e-cursos.com.ar";
            $mensaje=$this->input->post('mensaje');
            $contenido="";
            $data['categorias'] = $this->application_model->get_categorias($empresa);
            $data['top'] = $this->application_model->get_cursos_top();

            if(isset($nombre) && isset($email) && isset($asunto) && isset($mensaje)){
		$to = "info@e-cursos.com.ar";
		//$subject = "Mensaje Enviado";
		$contenido = $contenido."Nombre: ".$nombre."\n";
		$contenido = $contenido."Email: ".$email."\n\n";
		$contenido = $contenido."Asunto: ".$asuntoform."\n\n";
		$contenido = $contenido."Mensaje: ".$mensaje."\n\n";
		$header = "From: info@e-cursos.com.ar\nReply-To:".$email."\n";
		$header .= "Mime-Version: 1.0\n";
		$header .= "Content-Type: text/plain";

		if(mail($to, $asunto, $contenido ,$header)) {
                    //$data['title'] = "Email enviado | E-Cursos";
                    $title = "Email enviado | E-Cursos";
                    $data['mensaje'] = "Email enviado correctamente";
                    $data['subtitle']="Confirmación";

                    //$this->load->view('header', $data);
                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
                }
		else {
                    //$data['title'] = "Error | E-Cursos";
                    $title = "Error | E-Cursos";
                    $data['mensaje'] = "Error al enviar el mail";
                    $data['subtitle']="Error";

                    //$this->load->view('header', $data);
                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
                }
            }
        }

	public function generic_email($email,$subject,$msg)
	{
            if(isset($email) && isset($subject) && isset($msg)){
		$to = $email;
		$header = "From: info@e-cursos.com.ar\nReply-To:info@e-cursos.com.ar\n";
		$header .= "Mime-Version: 1.0\n";
		$header .= "Content-Type: text/plain;charset=utf-8";
		mail($to, $subject, $msg ,$header);
            }
	}

	public function terminos()
	{
            $title = "Terminos y condiciones | E-Cursos";
            $data['seccion'] = "terminos";

            $this->header($title);
            $this->load->view('seccion', $data);
            $this->load->view('footer', $data);
	}

	public function privacidad()
	{
            $title = "Políticas de privacidad | E-Cursos";
            $data['seccion'] = "privacidad";

            $this->header($title);
            $this->load->view('seccion', $data);
            $this->load->view('footer', $data);
	}

	public function ecursos()
	{
            $data['title'] = "Que es E-Cursos | E-Cursos";
            $title = "Que es E-Cursos | E-Cursos";
            $data['seccion'] = "ecursos";

            $this->header($title);
            $this->load->view('seccion', $data);
            $this->load->view('footer', $data);
	}

	public function cuenta()
	{
            if ($this->session->userdata("id")>0) {
                $title = "Cuenta | E-Cursos";

                $this->header($title);
                $this->load->view('cuenta');
                $this->load->view('footer');
            }
            else {
                $this->login();
            }

	}

        public function eliminar_favorito($id)
	{
            $empresa=$this->session->userdata['empresa'];
            $data['title']="Error | E-Cursos";
            $title="Error | E-Cursos";
            $data['subtitle']="Error";
            $data['mensaje']="No se pudo eliminar el curso de favoritos";
            $data['categorias'] = $this->application_model->get_categorias($empresa);

            if ($this->session->userdata("id")>0) {
                $idusuario=$this->session->userdata("id");

                $result = $this->application_model->eliminar_favorito($id,$idusuario);

                if($result>0)
                {
                    $this->cursos_inscriptos(0);
                }
		else {

                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
		}
            }
            else {
                $this->login();
            }

	}

	public function cursos_inscriptos($origen)
	{
            if ($this->session->userdata("id")>0) {
                //$this->generarPdf('Titulo pdf','Ejemplo del texto pasado por parametro');
                $title = "Favoritos | E-Cursos";
                $idusuario=$this->session->userdata("id");

                $empresa=$this->session->userdata['empresa'];
		$data['categorias'] = $this->application_model->get_categorias($empresa);
                //paginacion

		$config = array();
		$config["base_url"] = base_url() . "index.php/application/cursos_inscriptos/0";
		$config["total_rows"] = $this->application_model->get_favoritos_count($idusuario);
		$config["per_page"] = 4;
		$config["uri_segment"] = 4;

		$this->pagination->initialize($config);

                if ($origen==1){
                    $page=0;
                }
                else {
                    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                }

                        //armar array cursos

                $result = $this->application_model->get_cursos_inscripto($idusuario,$config["per_page"], $page);
		$i=0;
		$cursos=array();

		if ($result!=null){
                    foreach ($result as $curso) {
                        $datos=array(
			   'id' => $curso->id,
			   'titulo' => $curso->titulo,
			   'descripcion' => $curso->descripcion,
			   'nombre' => $curso->nombre,
			   'fecha' => $curso->fecha,
			   'hora' => $curso->hora,
			   'link_imagen' => $curso->link_imagen
			);

                        $cursos[$i]=$datos;
			$i++;
                    }

                    $data['cursos'] = $cursos;
                }
		else {
                    $data['cursos'] = null;
		}
                //fin array cursos

		$data["links"] = $this->pagination->create_links();

                $this->header($title);
                $this->load->view('cursos_inscriptos', $data);
                $this->load->view('footer', $data);

		//fin paginacion
            }
            else {
                $this->login();
            }
	}

        public function cursos_asignados($origen)
	{
            if ($this->session->userdata("id")>0) {
                $title = "Asignaciones | E-Cursos";
                $idusuario=$this->session->userdata("id");

                $empresa=$this->session->userdata['empresa'];
		$data['categorias'] = $this->application_model->get_categorias($empresa);
                        //paginacion

		$config = array();
		$config["base_url"] = base_url() . "index.php/application/cursos_asignados/0";
		$config["total_rows"] = $this->application_model->get_asignados_count($idusuario);
		$config["per_page"] = 4;
		$config["uri_segment"] = 4;

		$this->pagination->initialize($config);

                if ($origen==1){
                    $page=0;
                }
                else {
                    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                }

                        //armar array cursos

                $result = $this->application_model->get_cursos_asignados($idusuario,$config["per_page"], $page);
		$i=0;
		$cursos=array();

		if ($result!=null){
                    foreach ($result as $curso) {
			$datos=array(
			   'id' => $curso->id,
			   'titulo' => $curso->titulo,
			   'descripcion' => $curso->descripcion,
			   'nombre' => $curso->nombre,
			   'fecha' => $curso->fecha,
			   'hora' => $curso->hora,
			   'link_imagen' => $curso->link_imagen,
                           'idexamen' => $curso->examen,
                           'calificacion' => $curso->calificacion
			);

                        $cursos[$i]=$datos;
			$i++;
                    }

                    $data['cursos'] = $cursos;
                }
		else {
                    $data['cursos'] = null;
		}

                //fin array cursos

		$data["links"] = $this->pagination->create_links();

                $this->header($title);
                $this->load->view('cursos_asignados', $data);
                $this->load->view('footer', $data);
			//fin paginacion
            }
            else {
                $this->login();
            }
	}

	public function notificaciones($origen)
	{
            if ($this->session->userdata("id")>0) {
		$idusuario=$this->session->userdata("id");
                $title = "Notificaciones | E-Cursos";
                $empresa=$this->session->userdata['empresa'];
                $data['categorias'] = $this->application_model->get_categorias($empresa);

                $config = array();
		$config["base_url"] = base_url() . "index.php/application/notificaciones/0";
		$config["total_rows"] = $this->application_model->get_notificaciones_count($idusuario);
		$config["per_page"] = 4;
		$config["uri_segment"] = 4;

                $this->pagination->initialize($config);

                if ($origen==1){
                    $page=0;
                }
                else {
                    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                }

                //nuevo
		$result = $this->application_model->get_notificaciones($idusuario,$config["per_page"], $page);

		$i=0;
		$notificaciones=array();

		if ($result!=null){
                    foreach ($result as $notificacion) {
			$datos=array(
                            'idcurso' => $notificacion->idcurso,
			    'nombre_curso' => $notificacion->nombre_curso,
                            'mensaje' => $notificacion->mensaje,
                            'idusuario' => $notificacion->idusuario,
                            'nombre_usuario' => $notificacion->nombre_usuario,
                            'tipo' => $notificacion->tipo,
                            'estado' => $notificacion->estado
			);

                        $notificaciones[$i]=$datos;
			$i++;
                    }

                    $data['notificaciones'] = $notificaciones;
		}
		else {
                    $data['notificaciones'] = null;
		}


		//fin

                $data["links"] = $this->pagination->create_links();

                $this->header($title);
                $this->load->view('notificaciones', $data);
                $this->load->view('footer', $data);
            }
            else {
                $this->login();
            }
	}


	public function inscribirme($id)
	{
            if ($this->session->userdata("id")>0) {
		$idusuario=$this->session->userdata("id");
		$error=null;

		$error = $this->application_model->inscribirme($id,$idusuario);

		if($error==null)
		{
                    $this->cursos_inscriptos(1);
		}
		else {
                    $empresa=$this->session->userdata['empresa'];
                    $data['categorias'] = $this->application_model->get_categorias($empresa);
                    $data['top'] = $this->application_model->get_cursos_top();
                    $data['title']="Error | E-Cursos";
                    $title="Error | E-Cursos";
                    $data['subtitle']="Error";

                    $data['mensaje']=$error;

                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
		}
            }
            else {
                $this->login();
            }
	}

	public function ver_curso($id)
	{
            if ($this->session->userdata("id")>0) {
		$idusuario=$this->session->userdata("id");
		$error=null;

		$error = $this->application_model->inscribirme($id,$idusuario);

		if($error!=null && $error=='')
		{
                    $this->cursos_inscriptos();
		}
		else {
                    $empresa=$this->session->userdata['empresa'];
                    $data['categorias'] = $this->application_model->get_categorias($empresa);
                    $data['top'] = $this->application_model->get_cursos_top();
                    $data['title']="Error | E-Cursos";
                    $title ="Error | E-Cursos";
                    $data['subtitle']="Error";

                    $data['mensaje']=$error;

                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
		}
            }
            else {
                $this->login();
            }
	}

	public function cambiar_clave()
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata['empresa'];
		$idusuario=$this->session->userdata("id");
		$clave=$this->input->post('clave');
		$resultado = $this->application_model->cambiar_clave($idusuario,$clave);

		/*$data['title']="Error | E-Cursos";
                $title="Error | E-Cursos";
		$data['subtitle']="Error";
		$data['mensaje']="No se pudo modificar la clave";
		$data['categorias'] = $this->application_model->get_categorias($empresa);
		$data['top'] = $this->application_model->get_cursos_top();

		if($resultado>0)
		{
                    $this->cuenta();
		}
		else {
                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
		}*/

                if($resultado>0)
		{
                    echo json_encode(1);
                    return;
		}
		else {
                    echo json_encode(0);
                    return;
		}
            }
            else {
                $this->login();
            }
	}

	public function cambiar_mail()
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata['empresa'];
		$idusuario=$this->session->userdata("id");
		$email=$this->input->post('mail');
		$resultado = $this->application_model->cambiar_mail($idusuario,$email);

		if($resultado>0)
		{
                    echo json_encode(1);
                    return;
		}
		else {
                    echo json_encode(0);
                    return;
		}
            }
            else {
                $this->login();
            }
	}

	public function eliminar_curso_usuario($id)
	{
            $empresa=$this->session->userdata['empresa'];
            $title="Error | E-Cursos";
            $data['title']="Error | E-Cursos";
            $data['subtitle']="Error";
            $data['mensaje']="No se pudo eliminar el curso";
            $data['categorias'] = $this->application_model->get_categorias($empresa);

            if ($this->session->userdata("id")>0) {
                $result = $this->eliminar_curso($id);

                if($result>0)
                {
                    $this->mis_cursos(1);
                }
		else {
                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
		}
            }
            else {
                $this->login();
            }

	}

        public function eliminar_curso_administrador()
	{
            if ($this->session->userdata("id")>0) {
                $id = $this->input->post('id');
                $result = $this->eliminar_curso($id);
                if($result>0)
                {
                    echo json_encode(1);
                    return;
                }
		else {
                    echo json_encode(0);
                    return;
		}
            }
        }

        public function eliminar_curso($id)
	{
            $empresa=$this->session->userdata['empresa'];
            $carpeta=$this->session->userdata['empresa_carpeta'];
            $path='/home/ecursos/public_html/archivos/';
            $path_video='';
            $path_imagen='';
            $path_doc='';
            $doc='';
            $video='';
            $imagen='';
            $youtube=0;
            $error=0;

            $result = $this->application_model->get_curso_archivos($id,$empresa);

            if ($result!=null) {
                $video=$result->link_video;
                $imagen=$result->link_imagen;
                $doc=$result->link_doc;
                $youtube=$result->youtube;
            }

            $resultado = $this->application_model->eliminar_curso($id,$empresa);

            $data['title']="Error | E-Cursos";
            $data['subtitle']="Error";
            $data['mensaje']="No se pudo eliminar el curso";
            $data['categorias'] = $this->application_model->get_categorias($empresa);
			//$data['top'] = $this->application_model->get_cursos_top();

            if($resultado>0)
            {
                //borrado fisico archivos

                if ($youtube==0 && $video!=null && $video!='') {
                    $path_video=$path.'videos/'.$carpeta.'/'.$video;

                    if (!unlink($path_video)) {
                                    $error=1;
                    }
                }

                if ($imagen!=null && $imagen!='') {
                    $path_imagen=$path.'imagenes/'.$carpeta.'/'.$imagen;
                    if (!unlink($path_imagen)) {
                        $error=1;
                    }
                }

                if ($path_doc!=null && $path_doc!='') {
                    $path_doc=$path.'documentos/'.$carpeta.'/'.$doc;
                    if (!unlink($path_doc)) {
                        $error=1;
                    }
                }


                            //fin borrado fisico archivos
                return 1;
            }
            else {
                 return 0;
                 //$this->load->view('mensaje', $data);
            }
        }

	public function listado($idcategoria,$idsubcategoria)
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata['empresa'];
                $title = "Listado | E-Cursos";
                $data['title'] = "Listado | E-Cursos";
                $data['categorias'] = $this->application_model->get_categorias($empresa);

                //paginacion

                $config = array();
		$config["base_url"] = base_url() . "index.php/application/listado/".$idcategoria."/".$idsubcategoria;
		$config["total_rows"] = $this->application_model->get_listado_count($idcategoria,$idsubcategoria,$empresa);
		$config["per_page"] = 6;
		$config["uri_segment"] = 5;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

                $data['cursos'] = $this->application_model->get_listado($idcategoria,$idsubcategoria,$empresa,$config["per_page"], $page);

		$data["links"] = $this->pagination->create_links();

		//fin paginacion

                $this->header($title);
                $this->load->view('listado', $data);
                $this->load->view('footer', $data);
            }
            else {
		$this->login();
            }
	}

        public function listado_total()
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata['empresa'];
                $data['empresa'] = $empresa;
                $data['cursos'] = $this->application_model->get_cursos($empresa,0,0);

                echo json_encode($this->load->view('cursos_edit', $data,true));

		return;
            }
            else {
		$this->login();
            }
	}

	public function mis_cursos($origen)
	{
            if ($this->session->userdata("id")>0) {
                $idusuario=$this->session->userdata("id");
                $empresa=$this->session->userdata['empresa'];
                $title = "Mis Cursos | E-Cursos";
		$data['categorias'] = $this->application_model->get_categorias($empresa);

                //paginacion

		$config = array();
		$config["base_url"] = base_url() . "index.php/application/mis_cursos/0";
		$config["total_rows"] = $this->application_model->get_mis_cursos_count($idusuario);
		$config["per_page"] = 4;
		$config["uri_segment"] = 4;

		$this->pagination->initialize($config);

                if ($origen==1){
                    $page=0;
                }
                else{
                    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                }

                $data['cursos'] = $this->application_model->get_mis_cursos($this->session->userdata['id'],$config["per_page"], $page);

		$data["links"] = $this->pagination->create_links();

                $this->header($title);
                $this->load->view('mis_cursos', $data);
                $this->load->view('footer', $data);

		//fin paginacion

            }
            else {
		$this->login();
            }
	}

	public function nuevo_curso()
	{
            if ($this->session->userdata("id")>0) {
                $medida_espacio='';
                $empresa = $this->session->userdata("empresa");
                $title = "Nuevo curso | E-Cursos";
		$data['categorias'] = $this->application_model->get_categorias($empresa);
		$data['top'] = $this->application_model->get_cursos_top();
		$data['categorias_drop'] = $this->application_model->get_categorias_drop($empresa);
                $espacio=$this->application_model->get_espacio_restante($empresa);
                $espacio=number_format($espacio/1024/1024,2,",","");

                if ($espacio>=1000) {
                    $espacio_final=number_format($espacio/1024,2,",","");
                    $medida_espacio='GB';
                }
                else {
                    $espacio_final=$espacio;
                    $medida_espacio='MB';
                }

                $data['espacio'] = $espacio_final;
                $data['medida_espacio'] = $medida_espacio;

                $this->header($title);
                $this->load->view('nuevo_curso', $data);
                $this->load->view('footer', $data);
            }
            else {
		$this->login();
            }
	}

	public function login()
	{
            $title = "Log in | E-Cursos";
            $empresas = $this->application_model->get_empresas();
            $data['empresas']=$empresas;

            $this->header($title);
            $this->load->view('login',$data);
            $this->load->view('footer');
	}

	public function logout()
	{
            if ($this->session->userdata("id")>0) {
		$array_items = array('usuario' => '', 'clave' => '','email' => '', 'perfil' => '', 'empresa' => '');

		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
            }

            $this->index();
	}

	public function login_data()
	{
            $data['title'] = "Cuenta | E-Cursos";
            $usuario = $this->input->post('usuario');
            $clave = $this->input->post('clave');
            $empresa = $this->input->post('empresa');

            $result = $this->application_model->login($usuario,$clave,$empresa);

            if($result>0)
            {
		$this->principal();
            }
            else {
		$this->index();
            }
	}

	public function registro()
	{
            $data['title'] = "Registro | E-Cursos";
            $this->load->view('registro', $data);
	}

	public function registrar()
	{
            $data['title'] = "Cuenta | E-Cursos";
            $nombre = $this->input->post('nombre');
            $usuario = $this->input->post('usuario');
            $email = $this->input->post('email');
            $empresa = $this->input->post('empresa');
            $clave = $this->input->post('clave');
            $result = $this->application_model->registrar($nombre,$usuario,$email,$empresa,$clave);

            if($result>0)
            {
		$this->index();
            }
            else {
                $this->index();
            }
	}

	public function grabar_curso()
	{
            if ($this->session->userdata("id")>0) {
                $this->load->library('upload');
                $empresa = $this->session->userdata("empresa");
                $carpeta = $this->session->userdata("empresa_carpeta");
                $filefrom = $this->input->post('filefrom');
                $docfrom = $this->input->post('docfrom');
                $espacio_restante = $this->application_model->get_espacio_restante($empresa);

                $espacio=$_FILES['imagen']['size'];
                $espacio=$espacio+$_FILES['material']['size'];

                if ($filefrom==0) {
                    $espacio=$espacio+$_FILES['video']['size'];
                }

                if ($espacio_restante>$espacio) {
                    $config['upload_path'] = './archivos/imagenes/'.$carpeta.'/';
                    //$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|avi|mp4|mpg|mpeg';
                    $config['allowed_types'] = '*';

                    //subir imagen
                    $fecha = date_create();
                    $timestamp=date_timestamp_get($fecha);
                    $file_name = $_FILES['imagen']['name'];
                    $file_name_format = explode('.', $file_name);
                    $config['file_name'] = $timestamp.'.'.$file_name_format[1];
                    $imagen=$config['file_name'];

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('imagen')){
                        $title="Error | E-Cursos";
                        $data['title']="Error | E-Cursos";
                        $data['subtitle']="Error";
                        $data['mensaje']='La imagen supera las máximas dimensiones permitidas (1280x1280)';
                        $data['categorias'] = $this->application_model->get_categorias($empresa);

                        //$this->load->view('header', $data);
                        $this->header($title);
                        $this->load->view('mensaje', $data);
                        $this->load->view('footer', $data);

                        return;
                    }

                    //resize imagen
                    $upload_data = $this->upload->data();

                    $config_image['image_library']='gd2';
                    //$config_image['source_image']=base_url().'archivos/imagenes/'.$imagen;
                    $config_image['source_image'] = $upload_data['full_path'];
                    $config_image['maintain_ratio']=FALSE;
                    $config_image['width']=268;
                    $config_image['height']=249;

                    //$this->load->library('image_lib', $config_image);
                    $this->load->library('image_lib');
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_image);

                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    //subir documento
                    $fecha = date_create();
                    $timestamp=date_timestamp_get($fecha);
                    $material='';
                    $audio='';

                    /*if ($docfrom==0) { */
                        $file_name = $_FILES['material']['name'];

                        if ($file_name!=null && $file_name!='') {
                            $file_name_format = explode('.', $file_name);
                            $config['file_name'] = $timestamp.'.'.$file_name_format[1];
                            $config['upload_path'] = './archivos/documentos/'.$carpeta.'/';
                            //$config['upload_path'] = './archivos/documentos/';
                            $material=$config['file_name'];
                            $this->upload->initialize($config);
                            $this->upload->do_upload('material');
                        }
                    /*}*/

                    //subir audio
                    $file_name = $_FILES['audio']['name'];

                    if ($file_name!=null && $file_name!='') {
                        $file_name_format = explode('.', $file_name);
                        $config['file_name'] = $timestamp.'.'.$file_name_format[1];
                        $config['upload_path'] = './archivos/audios/'.$carpeta.'/';
                            //$config['upload_path'] = './archivos/documentos/';
                        $audio=$config['file_name'];
                        $this->upload->initialize($config);
                        $this->upload->do_upload('audio');
                    }

                    //subir video
                    $video='';
                    if ($filefrom==0) {
                        $fecha = date_create();
                        $timestamp=date_timestamp_get($fecha);
                        $file_name = $_FILES['video']['name'];

                        if ($file_name!=null && $file_name!='') {
                            $file_name_format = explode('.', $file_name);
                            $config['file_name'] = $timestamp.'.'.$file_name_format[1];
                            $config['upload_path'] = './archivos/videos/'.$carpeta.'/';
                            //$config['upload_path'] = './archivos/videos/';
                            $video=$config['file_name'];
                            $this->upload->initialize($config);
                            $this->upload->do_upload('video');
                        }
                    }

                    $data['title'] = "Mis | E-Cursos";
                    $title = "Mis | E-Cursos";
                    $titulo = $this->input->post('titulo');
                    $descripcion = $this->input->post('descripcion');
                    $idcategoria = $this->input->post('categoria');
                    $idsubcategoria = $this->input->post('subcategoria');
                    $autor = $this->session->userdata("id");
			//$fecha = '02/03/2015';
                    $fecha = date("d").'/'.date("m").'/'.date("Y");
			//$hora = '2:40 pm';
                    $hora = date("g").':'.date("i").' '.date("a");
                    $link_audio = '';
                    $link_video = '';
                    $link_material = '';
                    $link_imagen = '';

                    if ($imagen!=null & $imagen!=''){
                        $link_imagen = $imagen;
                        //$link_imagen = base_url().'archivos/imagenes/'.$imagen;
                    }

                    if ($audio!=null & $audio!=''){
                        $link_audio = $audio;
                        //$link_imagen = base_url().'archivos/imagenes/'.$imagen;
                    }

                    if ($filefrom==0 &  $video!=null & $video!=''){
                        $link_video = $video;
                        //$link_video = base_url().'archivos/videos/'.$video;
                    }
                    else if ($filefrom==1) {
                        $link_video=$this->input->post('link_video');
                    }

                    if ($docfrom==0 & $material!=null & $material!=''){
                        $link_material = $material;
                    }
                    else if ($docfrom==1){
                        $link_material=$this->input->post('material_nombre');
                    }

                    $estado = '1';
                    $error = $this->application_model->grabar_curso($titulo,$descripcion,$idcategoria,$idsubcategoria,$autor,$fecha,$hora,$link_imagen,$link_video,$link_material,$estado,$empresa,$espacio,$filefrom,$link_audio);
                    $data['title']="Error | E-Cursos";
                    $title="Error | E-Cursos";
                    $data['subtitle']="Error";
                    $data['mensaje']=$error;
                    $data['categorias'] = $this->application_model->get_categorias($empresa);

                    if($error==null || $error=='')
                    {
                        $this->application_model->update_espacio_restante($espacio,$empresa,0);

                        $this->mis_cursos(1);
                    }
                    else {
                        $this->header($title);
                        $this->load->view('mensaje', $data);
			$this->load->view('footer', $data);
                    }
                }
                else {
                    $data['title']="Error | E-Cursos";
                    $data['subtitle']="Error";
                    $data['mensaje']='No tiene espacio suficiente para subir el curso';
                    $data['categorias'] = $this->application_model->get_categorias($empresa);

                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
                }
            }
            else {
		$this->login();
            }
	}

	public function curso_autor($id)
	{
            if ($this->session->userdata("id")>0) {
		$idusuario=$this->session->userdata("id");
		$empresa=$this->session->userdata("empresa");
		$result = $this->application_model->get_curso_autor($id,$idusuario,$empresa);

		if ($result!=null && $result->id!=null) {
                    $data['title'] = "Curso | E-Cursos";
                    $title = "Curso | E-Cursos";
                    $data['id'] = $result->id;
                    $data['curso'] = $result->titulo;
                    $data['descripcion'] = $result->descripcion;
                    $data['autor'] = $result->nombre;
                    $data['fecha'] = $result->fecha;
                    $data['hora'] = $result->hora;
                    $data['link_imagen'] = $result->link_imagen;
                    $data['link_video'] = $result->link_video;
                    $data['link_doc'] = $result->link_doc;
                    $data['link_audio'] = $result->link_audio;
                    $data['youtube'] = $result->youtube;
                    $data['categorias'] = $this->application_model->get_categorias($empresa);

                    $this->header($title);
                    $this->load->view('curso_autor', $data);
                    $this->load->view('footer', $data);
                }
		else {
                    $data['title']="Error | E-Cursos";
                    $title="Error | E-Cursos";
                    $data['subtitle']="Error";
                    $data['mensaje']="No se encontro el curso";
                    $data['categorias'] = $this->application_model->get_categorias($empresa);

                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
		}
            }
            else {
		$this->login();
            }
	}

	public function subcategorias($id) {
            $subcategorias=$this->application_model->get_subcategorias($id);

            echo '<option value="0">SubCategoria</option>';
            foreach ($subcategorias as $row) {
		echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
            }
	}

	public function curso_usuario($id)
	{
            if ($this->session->userdata("id")>0) {
                $mostrar_feedback=0;
		$idusuario=$this->session->userdata("id");
		$empresa=$this->session->userdata("empresa");
		$result = $this->application_model->get_curso_usuario($id,$empresa, $idusuario);
                $feedback=$this->application_model->get_notificaciones_curso_usuario($id,$idusuario);

		if ($result!=null) {
                    $idautor=$result->autor;

                    if ($idautor!=$idusuario && $feedback==0){
                        $mostrar_feedback=1;
                    }

                    if ($idautor==$idusuario){
                        $mostrar_feedback=-1;
                    }

                    $data['title'] = "Curso | E-Cursos";
                    $title = "Curso | E-Cursos";
                    $data['id'] = $result->id;
                    $data['curso'] = $result->titulo;
                    $data['descripcion'] = $result->descripcion;
                    $data['autor'] = $result->nombre;
                    $data['fecha'] = $result->fecha;
                    $data['hora'] = $result->hora;
                    $data['link_imagen'] = $result->link_imagen;
                    $data['link_video'] = $result->link_video;
                    $data['link_doc'] = $result->link_doc;
                    $data['link_audio'] = $result->link_audio;
                    $data['youtube'] = $result->youtube;
                    $data['idfavorito'] = $result->idfavorito;
                    $data['categorias'] = $this->application_model->get_categorias($empresa);
                    $data['mostrar_feedback'] = $mostrar_feedback;

                    //$this->load->view('header', $data);
                    $this->header($title);
                    $this->load->view('curso_usuario', $data);
                    $this->load->view('footer', $data);
		}
		else {
                    $data['title']="Error | E-Cursos";
                    $title="Error | E-Cursos";
                    $data['subtitle']="Error";
                    $data['mensaje']="No se encontro el curso";
                    $data['categorias'] = $this->application_model->get_categorias($empresa);

                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
		}
            }
            else {
		$this->login();
            }
	}

        public function ver_examen($id)
	{
            if ($this->session->userdata("id")>0) {
		$idusuario=$this->session->userdata("id");
		$empresa=$this->session->userdata("empresa");
		$result = $this->application_model->get_examen_usuario($id,$idusuario,$empresa);

		if ($result!=null && $result->id>0) {
                    $arrayPreguntas=array();
                    $title = "Examen | E-Cursos";
                    $data['title'] = "Examen | E-Cursos";
                    $data['curso_titulo']=$result->titulo;
                    $data['idexamen']=$id;
                    $preguntas = $this->application_model->get_preguntas_examen($id);
                    $i=0;

                    foreach ($preguntas as $pregunta) {
			$datos=array(
                            'id' => $pregunta->id,
                            'pregunta' => $pregunta->pregunta
			);

                        $respuestas = $this->application_model->get_respuestas_examen($pregunta->id);

                        $j=0;
                        $arrayRespuestas=array();

                        foreach ($respuestas as $respuesta) {
                            $datosRespuestas=array(
                                'id' => $respuesta->id,
                                'respuesta' => $respuesta->respuesta
                            );

                            $arrayRespuestas[$j]=$datosRespuestas;
                            $j++;
                        }

                        $datos["respuestas"]=$arrayRespuestas;
			$arrayPreguntas[$i]=$datos;
			$i++;
                    }

                    $data['preguntas']=$arrayPreguntas;
                    $data['nro_preguntas']=$i;

                    //$this->load->view('header', $data);
                    $this->header($title);
                    $this->load->view('curso_examen', $data);
                    $this->load->view('footer', $data);
		}
		else {
                    $title="Error | E-Cursos";
                    $data['title']="Error | E-Cursos";
                    $data['subtitle']="Error";
                    $data['mensaje']="No se encontro el examen";
                    $data['categorias'] = $this->application_model->get_categorias($empresa);

                    $this->header($title);
                    $this->load->view('mensaje', $data);
                    $this->load->view('footer', $data);
                }
            }
            else {
		$this->login();
            }
	}

	public function feedback()
	{
            if ($this->session->userdata("id")>0) {
                $empresa=$this->session->userdata['empresa'];
                $idusuario=$this->session->userdata("id");
		$mensaje=$this->input->post('mensaje');
		$idcurso=$this->input->post('id');
		$tipo='1';
		$estado='0';

		$idautor = $this->application_model->get_autor($idcurso);
                $autorMail = $this->application_model->get_autor_mail($idautor);
                $titulo=$this->application_model->get_curso_titulo($idcurso,$empresa);

		if ($idautor!=null) {
                    $resultado = $this->application_model->grabar_notificacion($idautor,$idcurso,$idusuario,$tipo,$mensaje,$estado);

                    if ($resultado==null){
                        $title="Feedback enviado | E-Cursos";
			$data['title']="Feedback enviado | E-Cursos";
			$data['subtitle']="Feedback enviado";
			$data['mensaje']="El feedback se envio exitosamente";

                        $this->generic_email($autorMail,'E-Cursos - Feedback',"Recibio feedback de su curso: ".$titulo." \n\nMensaje: ".$mensaje."\n\nEl equipo de E-Cursos.\nhttp://www.e-cursos.com.ar\ninfo@e-cursos.com.ar");
                    }
                    else {
                        $title="Error | E-Cursos";
			$data['title']="Error | E-Cursos";
			$data['subtitle']="Error";
			$data['mensaje']="No se pudo enviar el feedback";
                    }
		}
		else {
                    $title="Error | E-Cursos";
                    $data['title']="Error | E-Cursos";
                    $data['subtitle']="Error";
                    $data['mensaje']="No se pudo enviar el feedback";
		}

		$data['categorias'] = $this->application_model->get_categorias($empresa);

                //$this->load->view('header', $data);
                $this->header($title);
                $this->load->view('mensaje', $data);
                $this->load->view('footer', $data);
            }
            else {
		$this->login();
            }
	}

	/*public function grabar_calificacion()
	{
		$data['title'] = "Cuenta | E-Cursos";
		$idusuario=$this->session->userdata("id");
		$idcurso = $this->input->get('id');
		$calificacion = $this->input->get('calificacion');

		//if ($calificacion<1)
		//	$this->curso_usuario($idcurso);

		$result = $this->application_model->grabar_calificacion($idcurso,$idusuario,$calificacion);

		if($result>0)
        {
			$this->curso_usuario($idcurso);
        }
		else {
			$data['title']="Error | E-Cursos";
			$data['subtitle']="Error";
			$data['mensaje']="No se pudo grabar la calificacion";
			$data['categorias'] = $this->application_model->get_categorias();
			$data['top'] = $this->application_model->get_cursos_top();

			$this->load->view('mensaje', $data);
		}
	}*/

	public function curso_info($id)
	{
            if ($this->session->userdata("id")>0) {

		$empresa=$this->session->userdata("empresa");

		$data['title'] = "Curso | E-Cursos";
		$result = $this->application_model->get_curso_info($id,$empresa);

		$data['id'] = $result->id;
		$data['curso'] = $result->titulo;
		$data['descripcion'] = $result->descripcion;
		$data['autor'] = $result->nombre;
		$data['fecha'] = $result->fecha;
		$data['hora'] = $result->hora;
		$data['link_imagen'] = $result->link_imagen;
		//$data['calificacion'] = $result->calificacion;
		$data['categorias'] = $this->application_model->get_categorias($empresa);

                $this->load->view('header', $data);
		$this->load->view('curso_info', $data);
                $this->load->view('footer', $data);
            }
            else {
		$this->login();
            }
	}

	public function new_user()
	{
            $usuario = $this->input->post('usuario');
            $nombre = $this->input->post('nombre');
            $email = $this->input->post('email');
            $empresa = $this->session->userdata("empresa");
            $clave = $this->random_password();

            $usuarios_restantes=$this->application_model->get_usuarios_restantes($empresa);

            if ($usuarios_restantes>=1){

                $result = $this->application_model->new_user($nombre,$usuario,$email,$empresa,$clave);
                if($result>0)
                {
                    $this->generic_email($email,'E-Cursos - Nuevo usuario',"Bienvenido a E-cursos, a continuación figuran sus datos para ingresar a la plataforma: \n\nUsuario: ".$usuario." \nContraseña: ".$clave."\n\nRecuerde que puede cambiar la contraseña desde Mi cuenta.\n\nEl equipo de E-Cursos.\nhttp://www.e-cursos.com.ar\ninfo@e-cursos.com.ar");

                    echo json_encode(1);
                    return;
                }
                else {
                    echo json_encode(0);
                    return;
                }
            }
            else {
                echo json_encode(0);
                return;
            }
	}
	public function edit_user()
	{
            $id = $this->input->post('id');
            $nombre = $this->input->post('nombre');
            $usuario = $this->input->post('usuario');
            $email = $this->input->post('email');
            $result = $this->application_model->edit_user($id,$nombre,$usuario,$email);
            if($result>0)
            {
                echo json_encode(1);
		return;
            }
            else {
		echo json_encode(0);
		return;
            }
	}

	public function delete_user()
	{
            $id = $this->input->post('id');
            $empresa = $this->session->userdata("empresa");
            $result = $this->application_model->delete_user($id,$empresa);
            if($result>0)
            {
                echo json_encode(1);
		return;
            }
            else {
                echo json_encode(0);
		return;
            }
	}

	public function random_password()
	{
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array();
	    $alphaLength = strlen($alphabet) - 1;

	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }

	    return implode($pass);
	}

        public function new_pdf2() {
            $titulo = $this->input->post('title');
            $texto = $this->input->post('content');
            $filename = $this->input->post('filename');

            //$fecha = date_create();
            //$timestamp=date_timestamp_get($fecha);

            //$filename=$timestamp.'.pdf';

            //echo json_encode(1);

            echo json_encode(1);
            return;
        }

        public function new_pdf() {
            $this->load->library('Pdf');

            $titulo = $this->input->post('title');
            $texto = $this->input->post('content');
            $filename = $this->input->post('filename');

            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('E-Cursos');
            $pdf->SetTitle($titulo);
            $pdf->SetSubject('Ejemplo');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

            // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // se pueden modificar en el archivo tcpdf_config.php de libraries/config
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // se pueden modificar en el archivo tcpdf_config.php de libraries/config
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // se pueden modificar en el archivo tcpdf_config.php de libraries/config
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            //relación utilizada para ajustar la conversión de los píxeles
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // ---------------------------------------------------------
            // establecer el modo de fuente por defecto
            $pdf->setFontSubsetting(true);

            // Establecer el tipo de letra

            //Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
            // Helvetica para reducir el tamaño del archivo.
            $pdf->SetFont('freemono', '', 14, '', true);

            // Añadir una página
            // Este método tiene varias opciones, consulta la documentación para más información.
            $pdf->AddPage();

            //fijar efecto de sombra en el texto
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            // Establecemos el contenido para imprimir
            /*$provincia = $this->input->post('provincia');
            $provincias = $this->pdfs_model->getProvinciasSeleccionadas($provincia);
            foreach($provincias as $fila)
            {
                $prov = $fila['p.provincia'];
            }*/
            //preparamos y maquetamos el contenido a crear
            /*$html = '';
            $html .= "<style type=text/css>";
            $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
            $html .= "td{background-color: #AAC7E3; color: #fff}";
            $html .= "</style>";
            $html .= "<h2>Localidades de Buenos aires</h2><h4>Actualmente: 100 localidades</h4>";
            $html .= "<table width='100%'>";
            $html .= "<tr><th>Id localidad</th><th>Localidades</th></tr>";

            $html .= "</table>";*/

            $html = '';
            $html .= "<h2>$titulo</h2>";
            $html .= '<div align="center">';
            $html .= '<p>';
            $html .= $texto;
            $html .= '</p>';
            $html .= '</div>';

            // Imprimimos el texto con writeHTMLCell()
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

            // ---------------------------------------------------------
            // Cerrar el documento PDF y preparamos la salida
            // Este método tiene varias opciones, consulte la documentación para más información.
            //$nombre_archivo = utf8_decode("./archivos/documentos/ecursos/ejemplo.pdf");

            $pdf->Output($_SERVER['DOCUMENT_ROOT']."e-cursos/archivos/documentos/ecursos/$filename", 'F');
            //$pdf->Output("./archivos/documentos/ecursos/ejemplo.pdf", 'F');

            echo json_encode(1);
            return;
        }

        public function prueba_pago()
	{
            if ($this->session->userdata("id")>0) {

		$empresa=$this->session->userdata("empresa");

		$title = "Prueba pago | E-Cursos";
		$data['categorias'] = $this->application_model->get_categorias($empresa);

                $this->header($title);
		$this->load->view('prueba_pago', $data);
                $this->load->view('footer', $data);
            }
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
