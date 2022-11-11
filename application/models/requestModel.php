<?php
defined('BASEPATH') or exit('No direct script access allowed');

class requestModel extends CI_Model
{
    public function get_all_request()
    {
        return $this->db->get('request_order')->result_array();
    }
    public function joinDetail($where)
    {
        //kita ambil nila dimana nilai tersebut merupakan kode yang nantinya di join dengan 2 table
        $this->db->from('request_order');
        $this->db->join('detail_request', 'detail_request.kode_order = request_order.kode_ro');
        $this->db->join('user', 'request_order.nip_user = user.nip');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }
}
