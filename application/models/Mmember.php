<?php 
class Mmember extends CI_Model{

    public function register($data){
        $this->db->insert('tbl_pelanggan', $data);
    }

    public function cek_login($u, $p){
        $q = $this->db->get_where('tbl_pelanggan', array('username' => $u, 'password' => $p));
        return $q;
    }

    public function get_all_data(){
        $this->db->select('*');
        $this->db->from('tbl_pelanggan');
        return $this->db->get()->result();
    }

    public function get_produk_by_id($id){
        return $this->db->get_where('tbl_produk', $id);
    }

    public function insert($tabel, $data){
        $this->db->insert($tabel, $data);
    }

    public function get_by_id($tabel, $id){
        return $this->db->get_where($tabel, $id);
    }

    public function update($tabel, $data, $pk, $id){
        $this->db->where($pk, $id);
        $this->db->update($tabel, $data);
    }

    public function delete($tabel, $pk, $id){
        $this->db->where($pk, $id);
        $this->db->delete($tabel);
    }

    public function edit1($data)
    {
        $this->db->where('idPelanggan',$data['idPelanggan']);
        $this->db->update('tbl_pelanggan',$data);
    }


    public function edit($id){
        $this->db->select('statusAktif');
        $this->db->from('tbl_member');
        $this->db->where('idKonsumen', $id);
        $query = $this->db->get();
        return $query;
    }
    public function get_data($id_pelanggan){
        $this->db->select('*');
        $this->db->from('tbl_pelanggan');
        $this->db->where('idPelanggan', $id_pelanggan);
        
        return $this->db->get()->row();
    }
    
}