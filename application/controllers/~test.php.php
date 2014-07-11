<?php

class Test extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        
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