<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Madmin extends CI_Model{
    public function total_barang()
    {
        return $this->db->get('tbl_produk')->num_rows();
    }
    public function total_pelanggan()
    {
        return $this->db->get('tbl_pelanggan')->num_rows();
    }
    public function total_pesanan_masuk()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('tbl_konfirmasi.status_order=0');
        $this->db->where('tbl_transaksi.status_bayar=1');
        $this->db->group_by('tbl_transaksi.no_order'); 
        return $this->db->get()->num_rows();
    }

    public function pesanan_masuk()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('tbl_konfirmasi.status_order=0');
        $this->db->where('tbl_transaksi.status_bayar=1');
        $this->db->group_by('tbl_transaksi.no_order'); 
        return $this->db->get()->result();
    }
    public function pesanan_diproses()
    {

        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('tbl_konfirmasi.status_order=1');
        return $this->db->get()->result();
    }
    public function pesanan_dikirim()
    {

        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('tbl_konfirmasi.status_order=2');
        return $this->db->get()->result();
    }
    public function pesanan_selesai()
    {

        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('tbl_konfirmasi.status_order=3');
        return $this->db->get()->result();
    }
    public function proses_pesanan($data){
        $this->db->where('no_order', $data['no_order']);
        $this->db->update('tbl_konfirmasi', $data);
    }
    public function data_setting()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }
    public function edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_setting', $data);
    }
}
