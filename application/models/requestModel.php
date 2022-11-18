<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class requestModel extends CI_Model
{
    public function get_allRequest()
    {
        return $this->db->get('request_order')->result_array();
    }
    //menampilkan request order berdasarkan id
    public function get_requestbyID($where)
    {
        return $this->db->get_where('request_order', array('id_user' => $where))->result_array();
    }

    public function get_requestbyDiv()
    {
        $id_div = $this->session->userdata('id_divisi');
        $request = $this->db->get_where('request_order', array('divisi' => $id_div))->result_array();
    }
    //panggil berdasarkan kode order
    public function get_requestbyKode($where)
    {
        return $this->db->get_where('request_order', array('kode_ro' => $where))->result_array();
    }

    public function joinDetail($where)
    {
        //kita ambil nila dimana nilai tersebut merupakan kode yang nantinya di join dengan 2 table
        $this->db->from('request_order');
        $this->db->join('detail_request', 'detail_request.kode_order = request_order.kode_ro');
        $this->db->join('user', 'request_order.id_user = user.nip');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }

    //fungsi join request order dengan user
    public function joinRequest($where)
    {
        $this->db->from('request_order');
        $this->db->join('user', 'user.nip = request_order.id_user');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }


    //fungsi join request order dengan status
    public function joinStatus($where)
    {
        $this->db->from('detail_request');
        $this->db->join('status_pengajuan_detail', 'status_pengajuan_detail.id_status = detail_request.status_detail');
        $this->db->where($where);
        return $this->db->get()->result_array();
    }

    //fungsi kodeotomatis pada setiap buat form baru
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

    //fungsi untuk menampilkan seluruh detail request
    public function get_all_detail()
    {
        return $this->db->get('detail_request')->result_array();
    }

    //fungsi untuk menampilakn seluruh temp_order / berdasarkan id
    public function get_temp_detail($id = null)
    {
        if ($id != null) {
            return $this->db->get_where('temp_order', array('id' => $id));
        }
        return $this->db->get('temp_order')->result_array();
    }

    //menambahkan kolom detail_request
    public function insert_detail($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //fungsi menghapus satu baris pada temp_order
    public function delete_detail($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('temp_order');
    }

    //measukan data ke tabel request_order
    public function insert_request($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //memasukan seluruh kolom punya kode ro where dari temp order ke detail request
    public function post_detail($kode_ro)
    {
        $sql = "INSERT INTO detail_request (kode_order,jenis_barang,desk_barang,qty_order,sat_order,img_order,status_detail) SELECT kode_order,jenis_barang,desk_barang,qty_order,sat_order,img_order,status_detail FROM temp_order WHERE kode_order='$kode_ro'";
        $this->db->query($sql);
    }

    //fungsi mengosokan seluruh tabel temp
    public function delete_temp()
    {
        $this->db->truncate('temp_order');
    }

    //fungsi menampilkan data request yang telah disubmit
    public function result_last_request($where)
    {
        $last_row = $this->db->select('*')->from('request_order')->where('id_user', $where)->limit(1)->order_by('id_ro', "DESC");
        return $last_row->get()->result_array();
    }

    //approve detail order
    public function approve_det($id)
    {
        $this->db->set('status_detail', 3);
        $this->db->where('id_detail', $id);
        $this->db->update('detail_request');
    }

    //reject detail order
    public function reject_det($id)
    {
        $this->db->set('status_detail', 2);
        $this->db->where('id_detail', $id);
        $this->db->update('detail_request');
    }

    //approve RO
    public function approve_ro($data, $id)
    {
        //update
        $this->db->set('status_pengajuan', 'telah disetujui');
        $this->db->where('id_ro', $id);
        $this->db->update('request_order', $data, array('id_ro' => $id));
    }

    //reject RO
    public function reject_ro($data, $id)
    {
        //update
        $this->db->set('status_pengajuan', 'telah disetujui');
        $this->db->where('id_ro', $id);
        $this->db->update('request_order', $data, array('id_ro' => $id));
    }
}
