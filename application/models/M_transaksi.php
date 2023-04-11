<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model{
    public function simpan_transaksi($data)
    {
        $this->db->insert('tbl_transaksi',$data);
    } 

    public function get_produk_by_id($id){
            $this->db->select('*');
            $this->db->from('tbl_produk');
            $this->db->where('idProduk', $id);
    
            return $this->db->get()->row();
    }

    public function stok_by_id($id){
        $this->db->select('stok');
        $this->db->from('tbl_produk');
        $this->db->where('idProduk', $id);
        return $this->db->get()->row();
    }

    public function get_stok_by_id($id){
        $this->db->select('*');
        $this->db->from('tbl_produk');
        $this->db->where('idProduk', $id);
        return $this->db->get()->row();
    }

    public function simpan_rinci_order($data){
        $this->db->insert('tbl_detail_transaksi',$data);
    }

    public function konfirmasi($data){
        $this->db->insert('tbl_konfirmasi',$data);
    }

    public function rinci_order($no_order){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_detail_transaksi', 'tbl_detail_transaksi.no_order = tbl_transaksi.no_order');
        $this->db->join('tbl_produk', 'tbl_detail_transaksi.idProduk = tbl_produk.idProduk');
        $this->db->where('idPelanggan', $this->session->userdata('id'));
        $this->db->where('tbl_transaksi.no_order',$no_order);
        return $this->db->get()->result();
    }

    public function hitung(){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('idPelanggan', $this->session->userdata('id'));
        $this->db->where('tbl_transaksi.status_bayar=0');
        return $this->db->get()->num_rows();
    }

    public function belum_bayar(){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('idPelanggan', $this->session->userdata('id'));
        $this->db->where('tbl_konfirmasi.status_order=0');
        return $this->db->get()->result();
    }

    public function proses(){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('idPelanggan', $this->session->userdata('id'));
        $this->db->where('tbl_konfirmasi.status_order=1');
        return $this->db->get()->result();
    }

    public function kirim(){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('idPelanggan', $this->session->userdata('id'));
        $this->db->where('tbl_konfirmasi.status_order=2');
        return $this->db->get()->result();
    }

    public function selesai(){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('idPelanggan', $this->session->userdata('id'));
        $this->db->where('tbl_konfirmasi.status_order=3');
        return $this->db->get()->result();
    }

    public function detail_pembayaran($no_order){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order');
        $this->db->where('tbl_konfirmasi.no_order', $no_order);
        return $this->db->get()->row();
    }

    public function rekening(){
        $this->db->select('*');
        $this->db->from('tbl_rekening');
        return $this->db->get()->result();
    }

    public function upload_bukti($data){
        $this->db->where('no_order',$data['no_order']);
        $this->db->update('tbl_konfirmasi',$data);
    }

    public function upload_bukti_bayar($data){
        $this->db->where('no_order',$data['no_order']);
        $this->db->update('tbl_transaksi',$data);
    }
    
    public function batal($id){
        $tables = array('tbl_transaksi', 'tbl_konfirmasi', 'tbl_detail_transaksi');
        $this->db->where('no_order', $id);
        $this->db->delete($tables);
    }

    public function selesai_bener(){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_konfirmasi', 'tbl_konfirmasi.no_order = tbl_transaksi.no_order','right');
        $this->db->join('tbl_detail_transaksi', 'tbl_detail_transaksi.no_order = tbl_transaksi.no_order','right');
        $this->db->join('tbl_produk', 'tbl_detail_transaksi.idProduk = tbl_produk.idProduk','right');
        $this->db->where('idPelanggan', $this->session->userdata('id'));
        $this->db->group_by('tbl_transaksi.no_order'); 
        $this->db->having('tbl_konfirmasi.status_order=3');
        return $this->db->get()->result();
    }

    public function selesai_by_id($id){
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_detail_transaksi', 'tbl_detail_transaksi.no_order = tbl_transaksi.no_order','right');
        $this->db->join('tbl_produk', 'tbl_detail_transaksi.idProduk = tbl_produk.idProduk','right');
        $this->db->where('idPelanggan', $this->session->userdata('id'));
        $this->db->where('tbl_transaksi.no_order', $id);
        $this->db->group_by('tbl_produk.idProduk'); 
        return $this->db->get()->result();
    }
    
    public function update_stok($data_produk, $id){
        $this->db->where('idProduk', $id);
        $this->db->update('tbl_produk', $data_produk);
    }
}