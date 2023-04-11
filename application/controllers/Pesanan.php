<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');
        $this->load->model('Madmin');
    }

    public function pesanan_masuk(){
        if(empty($this->session->userdata('username'))){
            redirect('admin');
        }
        $data = array(
            'total_barang' => $this->Madmin->total_barang(),
            'pesanan_masuk' => $this->Madmin->pesanan_masuk(),
            'pesanan_diproses' => $this->Madmin->pesanan_diproses(),
            'pesanan_dikirim' => $this->Madmin->pesanan_dikirim(),
            'pesanan_selesai' => $this->Madmin->pesanan_selesai(),
        );
        $this->load->view('backend/template/header.php');
        $this->load->view('backend/template/sidebar.php');
        $this->load->view('backend/pesanan.php',$data);
        $this->load->view('backend/template/footer.php');
    }

    public function proses($no_order){
        if(empty($this->session->userdata('username'))){
            redirect('admin');
        }
        $data = array(
            'no_order' => $no_order,
            'status_order' => '1'
        );
        $this->Madmin->proses_pesanan($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil di Proses');

        redirect('pesanan/pesanan_masuk');
    }
    
    public function kirim($id_transaksi){
        if(empty($this->session->userdata('username'))){
            redirect('admin');
        }
        $data = array(
            'no_order' => $id_transaksi,
            'no_resi' => $this->input->post('no_resi'),
            'status_order' => '2'
        );
        $this->Madmin->proses_pesanan($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil di Kirim');

        redirect('pesanan/pesanan_masuk');
    }

    
}