<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class purchaseModel extends CI_Model
{
    public function get_data($id = null)
    {
        if ($id == null) {
            $this->db->select('*');
            $this->db->from('purchase_order');
            $this->db->join('supplier', 'supplier.id_sup = purchase_order.id_supplier');
            return $this->db->get()->result_array();
        }

        $this->db->select('*');
        $this->db->from('purchase_order');
        $this->db->join('detail_purchase', 'detail_purchase.kode_purchase = purchase_order.kode_po');
        $this->db->join('supplier', 'supplier.id_sup = purchase_order.id_supplier');
        $this->db->where('id_po', $id);
        return $this->db->get()->result_array();;
    }

    public function get_sup()
    {
        $this->db->select('id_sup,nama_sup');
        $this->db->from('supplier');
        return $this->db->get()->result_array();
    }

    public function get_ro()
    {
        $this->db->select('kode_ro');
        $this->db->from('request_order');
        return $this->db->get()->result_array();
    }

    public function get_PobyCode($kode_po = null)
    {
        $this->db->select('*');
        $this->db->from('purchase_order');
        $this->db->join('supplier', 'supplier.id_sup = purchase_order.id_supplier');
        $this->db->where('kode_po', $kode_po);
        return $this->db->get()->result_array();;
    }

    public function get_detailbyCode($kode_po = null)
    {
        if ($kode_po == null) {
            return $this->db->get('detail_purchase')->result_array();
        }
        return $this->db->get_where('detail_purchase', array('kode_purchase' => $kode_po))->result_array();
    }

    public function get_kodebyID($id)
    {
        $this->db->select('kode_purchase');
        $this->db->from('detail_purchase');
        $this->db->where('id_dpo', $id);
        return $this->db->get()->row_array();
    }

    public function get_detailbyID($id = null)
    {
        if ($id == null) {
            return $this->db->get('detail_purchase')->result_array();
        }
        return $this->db->get_where('detail_purchase', array('id_dpo' => $id))->result_array();
    }

    public function update_detail($data, $id)
    {
        $this->db->where('id_dpo', $id);
        $this->db->update('detail_purchase', $data,);
    }

    public function update_po($data, $kode_po)
    {
        $this->db->where('kode_po', $kode_po);
        $this->db->update('purchase_order', $data,);
    }

    public function delete_detail($id)
    {
        $this->db->where('id_dpo', $id);
        $this->db->delete('detail_purchase');
    }

    public function delete_po($kode_po)
    {
        $this->db->where('kode_po', $kode_po);
        $this->db->delete('purchase_order');
    }

    public function delete_all_detail($kode_po)
    {
        $this->db->where('kode_purchase', $kode_po);
        $this->db->delete('detail_purchase');
    }

    public function AutoCode()
    {
        $this->db->select('RIGHT(purchase_order.kode_po,3) as kodepo', FALSE);
        $this->db->order_by('kodepo', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('purchase_order');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kodepo) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "POGA" . $batas;
        return $kodetampil;
    }

    public function get_tempPo($kode_po = null)
    {
        if ($kode_po != null) {
            return $this->db->get_where('temp_po', array('id' => $kode_po))->result_array();
        }
        return $this->db->get('temp_po')->result_array();
    }

    public function delete_tempByID($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('temp_po');
    }

    public function post_detail($kode_po)
    {
        $sql = "INSERT INTO detail_purchase (kode_purchase,jenis_barang,desk_barang,qty_order,sat_order) SELECT kode_purchase,jenis_barang,desk_barang,qty_order,sat_order FROM temp_po WHERE kode_purchase='$kode_po'";
        $this->db->query($sql);
    }
}
