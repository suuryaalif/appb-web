<?php

defined('BASEPATH') or exit('No direct script access allowed');

class reportModel extends CI_Model
{
    public function get_ro($tgl_awal, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->from('request_order');
        $this->db->join('status', 'status.id_status = request_order.status_pengajuan');
        $this->db->join('divisi', 'divisi.div_id = request_order.divisi');
        $this->db->where('submit_date >=', $tgl_awal);
        $this->db->where('submit_date <=', $tgl_akhir);
        return $this->db->get()->result_array();
    }

    public function get_robyDiv($tgl_awal, $tgl_akhir, $div)
    {
        $this->db->select('*');
        $this->db->from('request_order');
        $this->db->join('status', 'status.id_status = request_order.status_pengajuan');
        $this->db->join('divisi', 'divisi.div_id = request_order.divisi');
        $this->db->where('submit_date >=', $tgl_awal);
        $this->db->where('submit_date <=', $tgl_akhir);
        $this->db->where('divisi.div_id', $div);
        return $this->db->get()->result_array();
    }

    public function get_robyStatus($tgl_awal, $tgl_akhir, $status)
    {
        $this->db->select('*');
        $this->db->from('request_order');
        $this->db->join('status', 'status.id_status = request_order.status_pengajuan');
        $this->db->join('divisi', 'divisi.div_id = request_order.divisi');
        $this->db->where('submit_date >=', $tgl_awal);
        $this->db->where('submit_date <=', $tgl_akhir);
        $this->db->where('status_pengajuan', $status);
        return $this->db->get()->result_array();
    }

    public function get_robyFilters($tgl_awal, $tgl_akhir, $div, $status)
    {
        $this->db->select('*');
        $this->db->from('request_order');
        $this->db->join('status', 'status.id_status = request_order.status_pengajuan');
        $this->db->join('divisi', 'divisi.div_id = request_order.divisi');
        $this->db->where('submit_date >=', $tgl_awal);
        $this->db->where('submit_date <=', $tgl_akhir);
        $this->db->where('divisi.div_id', $div);
        $this->db->where('status_pengajuan', $status);
        return $this->db->get()->result_array();
    }
}
