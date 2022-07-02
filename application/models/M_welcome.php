<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_welcome extends CI_Model
{
    public function read($id = false)
    {
        if ($id === false) {
            return $this->db->get('post')->result_array();
        } else {
            $query = $this->db->get_where('post', array('id=' > $id));
            return $query->row();
        }
    }
    public function create($id, $filename)
    {
        $data = array(
            'id' => $id,
            'name' => $this->input->post('name', TRUE),
            'description' => $this->input->post('description', TRUE),
            'filename' => $filename
        );
        $this->db->insert('post', $data);
    }
    public function update($id)
    {
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'description' => $this->input->post('description', TRUE)
        );
        $this->db->where('id', $id);
        $this->db->update('post', $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('post');
    }
    public function deleteAll()
    {
        $this->db->empty_table('post');
    }
}
