<?php

defined('BASEPATH') or exit('No direct script access allowed');

class itemModel extends CI_Model
{
    public function getItem($id = null)
    {
        if ($id != null) {
            return $this->db->get_where('barang', array('id_barang' => $id))->result_array();
        } else {
            return $this->db->get('barang')->result_array();
        }
    }

    public function get_ro()
    {
        $this->db->select('kode_ro');
        $this->db->from('request_order');
        $this->db->where('status_pengajuan >=', 5);
        return $this->db->get()->result_array();
    }

    public function get_po()
    {
        $this->db->select('kode_pur');
        $this->db->from('cashbank_requestion');
        return $this->db->get()->result_array();
    }

    public function AutoCode()
    {
        $this->db->select('RIGHT(barang.kode_barang,3) as kdbarang', FALSE);
        $this->db->order_by('kdbarang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('barang');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kdbarang) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "INGA" . $batas;
        return $kodetampil;
    }

    public function update($id, $data)
    {
        $this->db->where('id_barang', $id);
        $this->db->update('barang', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('barang');
    }
}
