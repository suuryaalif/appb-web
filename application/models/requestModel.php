<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class requestModel extends CI_Model
{
    public function get_allRequest()
    {
        // return $this->db->get('request_order')->result_array();
        $this->db->select('*');
        $this->db->from('request_order');
        $this->db->join('status', 'status.id_status = request_order.status_pengajuan');
        return $this->db->get()->result_array();
    }
    //menampilkan request order berdasarkan id
    public function get_requestbyID($where)
    {
        // return $this->db->get_where('request_order', array('id_user' => $where))->result_array();
        $this->db->select('*');
        $this->db->from('request_order');
        $this->db->join('status', 'status.id_status = request_order.status_pengajuan');
        $this->db->where('id_user', $where);
        return $this->db->get()->result_array();
    }
    public function get_detailbyID($id = null)
    {
        if ($id != null) {
            return $this->db->get_where('detail_request', array('id_detail' => $id));
        }
        return $this->db->get('detail_request')->result_array();
    }
    public function get_detailbyKode($where)
    {
        // return $this->db->get_where('request_order', array('id_user' => $where))->result_array();
        $this->db->select('*');
        $this->db->from('detail_request d');
        $this->db->join('status s', 's.id_status = d.status_detail');
        $this->db->join('request_order r', 'r.kode_ro = d.kode_order');
        $this->db->where('kode_order', $where);
        return $this->db->get()->result_array();
    }

    public function get_requestbyDiv($id_div)
    {
        $this->db->select('*');
        $this->db->from('request_order');
        $this->db->join('status', 'status.id_status = request_order.status_pengajuan');
        $this->db->where('divisi', $id_div);
        return $this->db->get()->result_array();
    }
    //panggil berdasarkan kode order
    public function get_requestbyKode($where)
    {
        $this->db->select('*');
        $this->db->from('request_order');
        $this->db->join('status', 'status.id_status = request_order.status_pengajuan');
        $this->db->join('user', 'user.nip = request_order.id_user');
        $this->db->join('divisi', 'divisi.div_id=request_order.divisi');
        $this->db->where('kode_ro', $where);
        return $this->db->get()->result_array();
    }

    //cari data gambar
    public function get_imagebyKode($where)
    {
        $this->db->select('img_order');
        $this->db->from('detail_request');
        $this->db->where('kode_order', $where);
        return $this->db->get()->result_array();
    }

    //panggil siapa approval
    public function get_user_approval($div)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_divisi', $div);
        $this->db->where_in('role_id', 3);
        return $this->db->get()->result_array();
    }

    //fungis ngegabung 3 tabel
    public function JoinDetail($kode_ro)
    {
        $this->db->select('*');
        $this->db->from('request_order a');
        $this->db->join('detail_request b', 'b.kode_order=a.kode_ro', 'left');
        $this->db->join('status c', 'c.id_status=b.status_detail', 'left');
        $this->db->where('a.kode_ro', $kode_ro);
        $this->db->order_by('a.kode_ro', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    //ini fungsi validasi approvalnya ada yang belum di kasih gak?
    public function check_empty_status($kode_ro)
    {
        $this->db->select('*');
        $this->db->from('detail_request');
        $this->db->where('kode_order', $kode_ro);
        $this->db->where_in('status_detail', 1);
        return $this->db->get();
    }
    //ini fungsi validasi approvalnya ada yang disetujui gak?
    public function check_approved_status($kode_ro)
    {
        $this->db->select('*');
        $this->db->from('detail_request');
        $this->db->where('kode_order', $kode_ro);
        $this->db->where_in('status_detail', 3);
        return $this->db->get();
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
        $this->db->join('status', 'status.id_status = detail_request.status_detail');
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

    //fungsi untuk menampilakn seluruh temp_order / berdasarkan idd_detaialnya dan berdasarkan usernya
    public function get_temp_detail($id = null)
    {
        if ($id <= 8) {
            return $this->db->get_where('temp_order', array('id' => $id));
        }
        return $this->db->get_where('temp_order', array('id_user' => $id));
    }

    //menambahkan kolom detail_request
    public function insert_detail($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //fungsi menghapus satu baris pada temp_order
    public function delete_temp_detail($id)
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
    public function approve_ro()
    {
        //update
        $data = [
            "status_pengajuan" => 3,
            "note_ro" => $this->input->post('note_ro'),
            "approval_time" => time()
        ];
        $this->db->where('id_ro', $this->input->post('id_ro'));
        $this->db->update('request_order', $data);
    }

    //reject RO
    public function reject_ro()
    {
        //update
        $data = [
            "status_pengajuan" => 2,
            "note_ro" => $this->input->post('note_ro'),
            "approval_time" => time()
        ];
        $this->db->where('id_ro', $this->input->post('id_ro'));
        $this->db->update('request_order', $data);
    }

    public function update_status($id)
    {
        $this->db->set('status_pengajuan', 'status_pengajuan+1', false);
        $this->db->where('kode_ro', $id);
        $this->db->update('request_order');
    }

    public function back_status($id)
    {
        $this->db->set('status_pengajuan', 'status_pengajuan-1', false);
        $this->db->where('kode_ro', $id);
        $this->db->update('request_order');
    }

    public function reject_status($id)
    {
        $this->db->set('status_pengajuan', 2);
        $this->db->where('kode_ro', $id);
        $this->db->update('request_order');
    }

    //fungsi update data
    public function update_detail($data, $id)
    {
        $this->db->where('id_detail', $id);
        $this->db->update('detail_request', $data);
    }

    //fungsi update data
    public function update_request($data, $id)
    {
        $this->db->where('kode_ro', $id);
        $this->db->update('request_order', $data);
    }

    //fungsi delete detail data pada detail_request
    public function delete_detail($kode_ro)
    {
        $this->db->where('kode_order', $kode_ro);
        $this->db->delete('detail_request');
    }
    public function delete_detailByID($id)
    {
        $this->db->where('id_detail', $id);
        $this->db->delete('detail_request');
    }
    //fungsi delete request data pada request_order
    public function delete_request($kode_ro)
    {
        $this->db->where('kode_ro', $kode_ro);
        $this->db->delete('request_order');
    }

    public function total_all($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('requestorder');
        return $this->db->get()->row($field);
    }

    public function total($field)
    {
        $this->db->select_sum($field);
        $this->db->from('request');
        return $this->db->get()->row($field);
    }

    public function confirm_terima($id)
    {
        $this->db->set('status_pengajuan', 7);
        $this->db->where('id_ro', $id);
        $this->db->update('request_order');
    }
    public function confirm_selesai($id)
    {
        $this->db->set('status_pengajuan', 8);
        $this->db->where('id_ro', $id);
        $this->db->update('request_order');
    }
}
