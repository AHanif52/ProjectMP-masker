<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mhome');
        $this->load->model('Mlaporan');
    }

    public function index(){
        if(empty($this->session->userdata('username'))){
           redirect('admin');
       }
       $data['laporan']= $this->Mlaporan->display_laporan();
        $this->load->view('backend/template/header.php');
        $this->load->view('backend/template/sidebar.php');
        $this->load->view('backend/laporan/index',$data);
        $this->load->view('backend/template/footer.php');
    }

   public function laporan_harian()
    {
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data = array(
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->Mlaporan->laporan_harian($tanggal, $bulan, $tahun),
        );
        $this->load->view('backend/template/header.php');
        $this->load->view('backend/template/sidebar.php');
        $this->load->view('backend/laporan/harian',$data);
        $this->load->view('backend/template/footer.php');
    }
    public function laporan_bulanan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data = array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->Mlaporan->laporan_bulanan($bulan, $tahun)
        );
        $this->load->view('backend/template/header.php');
        $this->load->view('backend/template/sidebar.php');
        $this->load->view('backend/laporan/bulanan',$data);
        $this->load->view('backend/template/footer.php');
    }
    public function laporan_tahunan()
    {
        $tahun = $this->input->post('tahun');

        $data = array(
            'tahun' => $tahun,
            'laporan' => $this->Mlaporan->laporan_tahunan($tahun)
        );
        $this->load->view('backend/template/header.php');
        $this->load->view('backend/template/sidebar.php');
        $this->load->view('backend/laporan/tahunan',$data);
        $this->load->view('backend/template/footer.php');
    }
}