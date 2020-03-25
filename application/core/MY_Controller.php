<?php
class MY_Controller extends CI_Controller {

    protected $_index = 'index.php/';

    function __construct(){
        parent::__construct();
        $this->update_token_session();
    }

    public function render_html($data){
        $this->load->view($this->view_agent.$this->view_folder.$data['content'], $data);
    }

    public function render_json($response){
        header('Content-Type: application/json');
        echo json_encode($response); exit;
    }

    public function render_preview(){
        $input = $this->input->get('v');
        $this->load->view($input);
    }

    protected function update_token_session(){
        $session = $this->session->userdata('authentication');
        if(isset($session['status']) and $session['status'] and isset($session['token'])){
            $this->load->model('auth/Token_model');
            $this->Token_model->update_token_session(['token'=>$session['token']]);
        }
    }

}

class Auth_Controller extends MY_Controller{
    function __construct(){
        parent::__construct();
    }
}

class Leave_Controller extends MY_Controller{
    function __construct(){
        parent::__construct();

        $login = $this->session->userdata('authentication');

        if(isset($login['status']) and !$login['status']){
            redirect(url_index().'login/?status=exp');
        }


    }
}

?>
