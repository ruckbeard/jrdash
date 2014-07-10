<?php

class User extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function login()
    {
        $login = $this->input->post('email');
        $pasw = $this->input->post('pasw');
        
        $result = $this->user_model->get([
            'email' => $login,
            'password' => hash('sha256', $pasw . SALT)
        ]);
        
        $this->output->set_content_type('application_json');
        
        if ($result) {
            
            $this->session->set_userdata(['user_id' => $result[0]['user_id']]);
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }
        
        $this->output->set_output(json_encode(['result' => 0]));

    }
    
    public function register()
    {
        $this->output->set_content_type('application_json');
                
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('uname', 'Username', 'required|min_length[4]|max_length[16]|is_unique[user.uname]');
        $this->form_validation->set_rules('pasw', 'Password', 'required|min_length[4]|max_length[16]|matches[paswc]');
        $this->form_validation->set_message('matches', 'Password and confirm password must match.');
        
        
        
        if ($this->form_validation->run() == false) {       
            $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
            return false;
        }
        
        $email = $this->input->post('email');
        $uname = $this->input->post('uname');
        $pasw = $this->input->post('pasw');
        $paswc = $this->input->post('paswc');
        
        $user_id = $this->user_model->insert([
            'uname' => $uname,
            'password' => hash('sha256', $pasw . SALT),
            'email' => $email
        ]);
        
        if ($user_id) {
            
            $this->session->set_userdata(['user_id' => $user_id]);
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }
        
        $this->output->set_output(json_encode(['result' => 0, 'error' => 'User not created.']));

    }
    
    public function get($user_id)
    {
        $data = $this->user_model->get($user_id);
        print_r($data);
        
        $this->output->enable_profiler(true);
    }
    
    public function insert()
    {
        $result = $this->user_model->insert([
            'login' => 'Jethro'
        ]);
        print_r($result);
    }
    
    public function update()
    {
        $result = $this->user_model->update([
            'login' => 'Peggy'
        ], 3);
        print_r($result);
    }
    
    public function delete($user_id)
    {
        $result = $this->user_model->delete($user_id);
        print_r($result);
    }
}