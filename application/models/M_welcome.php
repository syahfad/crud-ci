<?php
defined('BASEPATH') or exit('No direct script access allowed');
//membuat model dengan nama M_welcome dan kita gunakan parent class CI_Model
class M_welcome extends CI_Model
{
    //membuat function read, yang berfungsi untuk mengambil data yang ada ditable post
    public function read($id = false)
    {
        if ($id === false) {
            return $this->db->get('post')->result_array();
        } else {
            $query = $this->db->get_where('post', array('id=' > $id));
            return $query->row();
        }
    }
    //membuat fungsi create, yang berfungsi untuk menambahkan data baru kedalam table post
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
    //membuat function update, berfungsu untuk memperbaharui data yang ada di table post berdasarkan id yang dipilih
    public function update($id)
    {
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'description' => $this->input->post('description', TRUE)
        );
        $this->db->where('id', $id);
        $this->db->update('post', $data);
    }
    //membuat function delete, berfungsi untuk menghapus data dari table post dimana data yang akan dihapus ialah data yang dipilih user (berdasarkan id)
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('post');
    }
    public function deleteAll()
    //membuat function deleteAll, berfungsi untuk menghapus seluruh data yang ada ditable post
    {
        $this->db->empty_table('post');
    }
}
