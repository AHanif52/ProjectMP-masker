<?php 
class Mhome extends CI_Model{

    public function get_all_data($tabel){
        $q=$this->db->get($tabel);
        return $q;
    }

    public function get_all_produk_terbaru(){
        $this->db->order_by('idProduk', 'DESC');
        $this->db->where('stok >', 0);
        //$this->db->limit(4);
        return $this->db->get('tbl_produk');
    }
    
    public function detail_produk($id){
        $this->db->select('*');
        $this->db->from('tbl_produk');
        $this->db->where('idProduk', $id);

        return $this->db->get()->row();
    }

    public function getById($id) {
        return $this->db->get_where('tbl_produk', ["idProduk" => $id]);
    }

    public function get_keyword($keyword){
        $this->db->select('*');
        $this->db->from('tbl_produk');
        $this->db->like('namaProduk',$keyword);
        $this->db->or_like('harga',$keyword);
        return $this->db->get()->result();
    }
}