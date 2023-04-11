<?php 
class Mcrud extends CI_Model{

    public function get_all_data($tabel){
        $q=$this->db->get($tabel);
        return $q;
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

    public function edit($id){
        $this->db->select('statusAktif');
        $this->db->from('tbl_member');
        $this->db->where('idKonsumen', $id);
        $query = $this->db->get();
        return $query;
    }

    public function data_setting()
    {
        $this->db->select('*');
        $this->db->from('tbl_toko');
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }

    public function edit_toko($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_toko', $data);
    }
}