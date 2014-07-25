<?php

class Api extends CI_Controller {

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('todo_model');
        $this->load->model('note_model');
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
            $result = $this->todo_model->get([
                'todo_id' => $id,
                'user_id' => $this->session->userdata('user_id')
            ]);
        } else {
            $result = $this->todo_model->get([
                'user_id' => $this->session->userdata('user_id')
            ]);
        }

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
        
        $content = $this->input->post('content');

        $result = $this->todo_model->insert([
            'content' => $content,
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result) {
            //get the freshest entry for the DOM
            $this->output->set_output(json_encode([
                'result' => 1,
                'data' => array(
                    'todo_id' => $result,
                    'content' => $content,
                    'completed' => 0
                )
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
        $content = $this->input->post('content');
        $completed = $this->input->post('completed');

        $result = $this->todo_model->update([
            'completed' => $completed
                ], $todo_id);

        if ($result) {
            $this->output->set_output(json_encode([
                'result' => 1,
                'data' => array(
                    'todo_id' => $todo_id,
                    'content' => $content,
                    'completed' => $completed 
                )
                ]));
            return false;
        }

        $this->output->set_output(json_encode(['result' => 0]));
        return false;
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function delete_todo() {
        $this->_require_login();

        $result = $this->todo_model->delete([
            'todo_id' => $todo_id = $this->input->post('todo_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result > 0) {
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }
        $this->output->set_output(json_encode([
            'result' => 0,
            'message' => 'Could not delete.'
        ]));
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function get_note($id = null) {
        $this->_require_login();

        if ($id != null) {
            $result = $this->note_model->get([
                'note_id' => $id,
                'user_id' => $this->session->userdata('user_id')
            ]);
        } else {
            $result = $this->note_model->get([
                'user_id' => $this->session->userdata('user_id')
            ]);
        }

        $this->output->set_output(json_encode($result));
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function create_note() {
        $this->_require_login();

        $this->form_validation->set_rules('title', 'Title', 'required|max_length[50]');
        $this->form_validation->set_rules('content', 'Content', 'required|max_length[500]');
        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode([
                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));
            return false;
        }
        
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        $result = $this->note_model->insert([
            'title' => $title,
            'content' => $content,
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result) {
            //get the freshest entry for the DOM
            $this->output->set_output(json_encode([
                'result' => 1,
                'data' => array(
                    'note_id' => $result,
                    'title' => $title,
                    'content' => $content
                )
            ]));
            return false;
        }

        $this->output->set_output(json_encode([
            'result' => 0,
            'error' => 'Could not insert record'
        ]));
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function update_note() {
        $this->_require_login();
        $note_id = $this->input->post('note_id');
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        $result = $this->note_model->update([
            'title' => $title,
            'content' => $content
                ], $note_id);

        if ($result) {
            $this->output->set_output(json_encode([
                'result' => 1,
                'data' => array(
                    'note_id' => $note_id,
                    'title' => $title,
                    'content' => $content
                )
                ]));
            return false;
        }

        $this->output->set_output(json_encode(['result' => 0]));
        return false;
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    public function delete_note() {
        $this->_require_login();

        $result = $this->note_model->delete([
            'note_id' => $todo_id = $this->input->post('note_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result > 0) {
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }
        $this->output->set_output(json_encode([
            'result' => 0,
            'message' => 'Could not delete.'
        ]));
    }

}
