<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

   function __construct(){
     parent::__construct();
     $this->load->model('Mhome');
   }

   public function index(){
      $data['total_asset'] = $this->M_transaksi->hitung();
      $this->load->view('frontend/template/header.php',$data);
      $data['produk'] = $this->Mhome->get_all_produk_terbaru()->result();;
      $this->load->view('frontend/home.php', $data);
      $this->load->view('frontend/template/footer.php');
   }

   public function login(){
      $data['total_asset'] = $this->M_transaksi->hitung();
      $this->load->view('frontend/template/header.php',$data);
      $this->load->view('frontend/login.php');
      $this->load->view('frontend/template/footer.php');
   }

   public function keyword(){
      $data['total_asset'] = $this->M_transaksi->hitung();
      $this->load->view('frontend/template/header.php',$data);
      $keyword = $this->input->post('keyword');
      $data['produk'] = $this->Mhome->get_keyword($keyword);
      $data = array(
          'produk' => $this->Mhome->get_keyword($keyword),
      );
      $this->load->view('frontend/home.php', $data);
      $this->load->view('frontend/template/footer.php');
  }

  public function detail_produk($id = null){
   $data['total_asset'] = $this->M_transaksi->hitung();
   $this->load->view('frontend/template/header.php',$data);
   $data = array(
      'produk' => $this->Mhome->detail_produk($id)
   );
   $data["produk"] = $this->Mhome->getById($id)->row();
   if (!$data["produk"]) show_404();
   $this->load->view('frontend/detail_produk.php', $data);
   $this->load->view('frontend/template/footer.php');
   }
}