<?php 

class ControllerNoticia extends BaseController
{
    protected static $requiere_autentificacion = ['edit','add'];
    
    public function list()
    {
        $this->data = ModelNoticia::getAll();
    }//list

    public function show($id)
    {
        $this->data['perfil'] = "Guillen";
        $this->data['publicidad'] = "franziskaner es la mejor Cerveza";

        $this->data['noticia'] = ModelNoticia::getById($id);
        
    }//show
    public function add(){
        $form = new ModelNoticiaForm($_POST);

        if(count($_POST)>0 && $form->datosValidos()) {
            $form->guardaInformacion();
            App::getRouter()::redirect('/noticia/list/');
        }

        $this->data['form'] = $form->pintar();
    }

    public function edit($id) {

        if(count($_POST) == 0 ){
            $n = ModelNoticia::getById($id);
            $form = new ModelNoticiaForm($n->toArray());
        } else {
            $form = new ModelNoticiaForm($_POST);
        }

        if(count($_POST)>0 && $form->datosValidos()) {
          $form->guardaInformacion();
          App::getRouter()::redirect('/noticia/list/');
        }

        $this->data['form'] = $form->pintar();
    }
}//ControllerDWES

?>
