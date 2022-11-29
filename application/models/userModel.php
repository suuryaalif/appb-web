<?php
defined('BASEPATH') or exit('No direct script access allowed');

class userModel extends CI_Model
{
    public function get_user_session()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function get_user_info($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('divisi', 'divisi.div_id = user.id_divisi');
        $this->db->where('email', $email);
        return $this->db->get()->row_array();
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'role.id_role = user.role_id');
        $this->db->join('divisi', 'divisi.div_id = user.id_divisi');
        return $this->db->get()->result_array();
    }

    public function get_byID($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'role.id_role = user.role_id');
        $this->db->join('divisi', 'divisi.div_id = user.id_divisi');
        $this->db->where('id_user', $id);
        return $this->db->get()->result_array();
    }

    public function update_user($data, $id)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    public function delete_byID($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }
}
