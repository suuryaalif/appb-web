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
    public function AutoCode()
    {
        $this->db->select('RIGHT(request_order.kode_ro,3) as koderequest', FALSE);
        $this->db->order_by('koderequest', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('request_order');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->koderequest) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "PBGA" . $batas;
        return $kodetampil;
    }

    public function get_all_detail()
    {
        return $this->db->get('detail_request')->result_array();
    }
}
