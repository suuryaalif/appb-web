<?php
defined('BASEPATH') or exit('No direct script access allowed');

class requestModel extends CI_Model
{
    //fungsi mengambiil semua request
    // public function get_all_request()
    // {
    //     return $this->db->get('request_order')->result_array();
    // }
    public function get_request($where)
    {
        return $this->db->get_where('request_order', array('id_user' => $where))->result_array();
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
}
