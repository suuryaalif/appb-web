<?php
defined('BASEPATH') or exit('No direct script access allowed');

class supplierModel extends CI_Model
{
    public function get_data($id = null)
    {
        if ($id == null) {
            return $this->db->get('supplier')->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('supplier');
            $this->db->where('id_sup', $id);
            return $this->db->get()->result_array();
        }
    }
    public function update_sup($data, $id)
    {
        $this->db->where('id_sup', $id);
        $this->db->update('supplier', $data);
    }

    public function delete_byid($id)
    {
        $this->db->where('id_sup', $id);
        $this->db->delete('supplier');
    }
}
