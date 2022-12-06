<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class cashbankModel extends CI_Model
{
    public function get_cbr($id = null)
    {
        if ($id == null) {
            $this->db->select('*');
            $this->db->from('cashbank_requestion cb');
            $this->db->join('request_order ro', 'ro.kode_ro = cb.kode_req');
            $this->db->join('purchase_order po', 'po.kode_po = cb.kode_pur');
            $this->db->join('supplier sp', 'sp.id_sup = cb.id_supplier');
            $this->db->join('status st', 'st.id_status = cb.status_cbr');
            return $this->db->get()->result_array();
        }

        $this->db->select('*');
        $this->db->from('cashbank_requestion cb');
        $this->db->join('request_order ro', 'ro.kode_ro = cb.kode_req');
        $this->db->join('purchase_order po', 'po.kode_po = cb.kode_pur');
        $this->db->join('supplier sp', 'sp.id_sup = cb.id_supplier');
        $this->db->join('status st', 'st.id_status = cb.status_cbr');
        $this->db->where('id_cbr', $id);
        return $this->db->get()->result_array();;
    }

    public function get_pay($id = null)
    {
        if ($id != null) {
            return $this->db->get_where('pembayaran', array('id_byr' => $id))->result_array();
        } else {
            return $this->db->get('pembayaran')->result_array();
        }
    }

    public function get_qr_usp()
    {
        $this->db->select('qr_sign');
        $this->db->from('user');
        $this->db->where('role_id', 4);
        return $this->db->get()->row_array();
    }


    public function get_ro($id)
    {
        $this->db->select('*');
        $this->db->from('cashbank_requestion');
        $this->db->where('id_cbr', $id);
        return $this->db->get()->row_array();
    }

    public function AutoCode()
    {
        $this->db->select('RIGHT(cashbank_requestion.kode_cbr,3) as kodecbr', FALSE);
        $this->db->order_by('kodecbr', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('cashbank_requestion');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kodecbr) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "CRFN" . $batas;
        return $kodetampil;
    }

    public function AutoCodePayment()
    {
        $this->db->select('RIGHT(pembayaran.kode_byr,3) as kodebyr', FALSE);
        $this->db->order_by('kodebyr', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pembayaran');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kodebyr) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "TFFN" . $batas;
        return $kodetampil;
    }

    public function get_po()
    {
        $this->db->select('kode_po');
        $this->db->from('purchase_order');
        return $this->db->get()->result_array();
    }

    public function add_cbr($data)
    {
        $this->db->insert('cashbank_requestion', $data);
    }

    public function add_pay($data)
    {
        $this->db->insert('pembayaran', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_cbr', $id);
        $this->db->update('cashbank_requestion', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_cbr', $id);
        $this->db->delete('cashbank_requestion');
    }

    public function approve($id)
    {
        $array = [
            'status_cbr' => 3,
            'approve_time' => time()
        ];

        $this->db->where('id_cbr', $id);
        $this->db->update('cashbank_requestion', $array);
    }

    public function reject($id)
    {
        $array = [
            'status_cbr' => 2,
            'approve_time' => time()
        ];

        $this->db->where('id_cbr', $id);
        $this->db->update('cashbank_requestion', $array);
    }

    public function set_confirm($id)
    {

        $this->db->where('id_cbr', $id);
        $this->db->set('status_cbr', 10);
        $this->db->update('cashbank_requestion');
    }

    public function approval_name()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 4);
        return $this->db->get()->row_array();
    }

    public function num_new()
    {
        $this->db->select('*');
        $this->db->from('cashbank_requestion');
        $this->db->where('status_cbr', 1);
        return $this->db->get()->num_rows();
    }

    public function num_approve()
    {
        return $this->db->get_where('cashbank_requestion', array('status_cbr' => 3))->num_rows();
    }

    public function num_reject()
    {
        return $this->db->get_where('cashbank_requestion', array('status_cbr' => 2))->num_rows();
    }

    public function num_paid()
    {
        return $this->db->get_where('cashbank_requestion', array('status_cbr' => 10))->num_rows();
    }
}
