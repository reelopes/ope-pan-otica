<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
              
    }

public function index(){
   
    $dados= Array(
      'pagina'=>'principal',
      'titulo'=>'Tela Principal'
    );
    
    $this->load->view('Principal',$dados);
    
}

 
}

?>
