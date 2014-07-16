<?php

class CRUD_model extends CI_Model {

    protected $_table = null;
    protected $_primary_key = null;

    public function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------

    /*
     * 
     * @usage
     *  All:    $this->user_model->get();
     *  Single: $this->user_model->get(2);
     *  Custom: $this->user_model->get(array('any' => 'param'))
     * 
     */

    public function get($id = null, $order_by = null) {

        if (is_numeric($id)) {
            $this->db->where($this->_primary_key, $id);
        }

        if (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        }

        $q = $this->db->get($this->_table);

        return $q->result_array();
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------


    /*
     * @param array $data
     * 
     * @usage $result = $this->user_model->insert(['login' => 'Jethro']); 
     */

    public function insert($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------


    /*
     * @param array $data, int $user_id
     * 
     * @usage $result = $this->user_model->update(['login' => 'Peggy']);
     * 
     */

    public function update($data, $user_id) {
        $this->db->where(['user_id' => $user_id]);
        $this->db->update('user', $data);
        return $this->db->affected_rows();
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------


    /*
     * @param int $user_id
     * 
     * @usage $result = $this->user_model->delete(6);
     */

    public function delete($user_id) {
        $this->db->delete('user', ['user_id' => $user_id]);
        return $this->db->affected_rows();
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------------
}
