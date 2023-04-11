<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

   function __construct(){
      parent::__construct();
      $this->load->model('Mcrud');
      $this->load->model('Madmin');
   }
   public function index(){
      $this->load->view('backend/template/header.php');
      $this->load->view('backend/login');
      $this->load->view('backend/template/footer.php');
   }

   public function home(){
      if(empty($this->session->userdata('username'))){
         redirect('admin');
     }
      $data = array(
         'total_barang' => $this->Madmin->total_barang(),
         'total_pelanggan' => $this->Madmin->total_pelanggan(),
         'total_pesanan_masuk' => $this->Madmin->total_pesanan_masuk(),
      );
      $this->load->view('backend/template/header.php');
      $this->load->view('backend/template/sidebar.php');
      $this->load->view('backend/dashboard.php',$data);
      $this->load->view('backend/template/footer.php');
   }
  
   public function setting(){
      if(empty($this->session->userdata('username'))){
      redirect('admin');
      }
      $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required',  array('required' =>
      '%s Harus Diisi'));
      $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required',  array('required' =>
      '%s Harus Diisi'));
      $this->form_validation->set_rules('kota', 'Kota', 'required',  array('required' =>
      '%s Harus Diisi'));
      $this->form_validation->set_rules('alamat_toko', 'Alamat Toko', 'required',  array('required' =>
      '%s Harus Diisi'));

      if ($this -> form_validation -> run() == FALSE) {
         $data = array(
            'setting' => $this->Mcrud->data_setting()
         );
         $this->load->view('backend/template/header.php');
         $this->load->view('backend/template/sidebar.php');
         $this->load->view('backend/toko.php',$data);
         $this->load->view('backend/template/footer.php');
      } else {
         $data = array(
            'id' => 1,
            'lokasi' => $this->input->post('kota'),
            'nama_toko' =>$this->input->post('nama_toko'),
            'alamat_toko' =>$this->input->post('alamat_toko'),
            'no_telepon' =>$this->input->post('no_telepon'),
         );
         $this->Mcrud->edit_toko($data);
         $this->session->set_flashdata('pesan', 'Settingan Berhasil DiUbah');
         redirect('admin/setting');
      }
   }
}