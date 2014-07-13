<?php

class Api extends CI_Controller {

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    private function _require_login() {
        if ($this->session->userdata('user_id') == false) {
            $this->output->set_output(json_encode(['result' => 0, 'error' => 'You are not authorized']));
            return false;
        }
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------    

    public function login() {
        $login = $this->input->post('email');
        $pasw = $this->input->post('pasw');

        $this->load->model('user_model');

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

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function register() {
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
        //$paswc = $this->input->post('paswc');

        $this->load->model('user_model');

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

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function get_todo($id = null) {
        $this->_require_login();

        if ($id != null) {
            $this->db->where([
                'todo_id' => $id,
                'user_id' => $this->session->userdata('user_id')
            ]);
        } else {
            $this->db->where('user_id', $this->session->userdata('user_id'));
        }
        $query = $this->db->get('todo');
        $result = $query->result();

        $this->output->set_output(json_encode($result));
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function create_todo() {
        $this->_require_login();

        $this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');
        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode([
                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));
            return false;
        }

        $result = $this->db->insert('todo', [
            'content' => $this->input->post('content'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result) {
            //get the freshest entry for the DOM
            $query = $this->db->get_where('todo', ['todo_id' => $this->db->insert_id()]);
            $this->output->set_output(json_encode([
                'result' => 1,
                'data' => $query->result()
            ]));
            return false;
        }

        $this->output->set_output(json_encode([
            'result' => 0,
            'error' => 'Could not insert record'
        ]));
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function update_todo() {
        $this->_require_login();
        $todo_id = $this->input->post('todo_id');
        $completed = $this->input->post('completed');

        $this->db->where(['todo_id' => $todo_id]);
        $this->db->update('todo', [
            'completed' => $completed
        ]);

        $result = $this->db->affected_rows();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }
        
        $this->output->set_output(json_encode(['result' => 0]));
        return false;
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function delete_todo() {
        $this->_require_login();

        $result = $this->db->delete('todo', [
            'todo_id' => $todo_id = $this->input->post('todo_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($this->db->affected_rows() > 0) {
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }
        $this->output->set_output(json_encode([
            'result' => 0,
            'message' => 'Could not delete.'
        ]));
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function get_note() {
        $this->_require_login();
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function create_note() {
        $this->_require_login();
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function update_note() {
        $this->_require_login();
        $note_id = $this->input->post('note_id');
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function delete_note() {
        $this->_require_login();
        $note_id = $this->input->post('note_id');
    }

}
