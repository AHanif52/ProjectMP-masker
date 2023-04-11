<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');
        $this->load->model('Madmin');
    }

    public function index(){
        $status= $this->session->userdata('userName');
        if(empty($status)){
            redirect('frontend/login');
        }
        $data['total_asset'] = $this->M_transaksi->hitung();
        $this->load->view('frontend/template/header.php',$data);
        $data = array(
            'belum_bayar' => $this->M_transaksi->belum_bayar(),
            'proses' => $this->M_transaksi->proses(),
            'kirim' => $this->M_transaksi->kirim(),
            'selesai' => $this->M_transaksi->selesai(),
        );
        $this->load->view('frontend/pesanan_saya.php', $data);
        $this->load->view('frontend/template/footer.php');
    }

    public function bayar($id_transaksi){
        $status= $this->session->userdata('userName');
        if(empty($status)){
            redirect('frontend/login');
        }
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('no_rek', 'Nomer Rekening', 'required',  array('required' =>
        '%s Harus Diisi'));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './gambar/bukti_bayar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '20000';
            $this->upload->initialize($config);
            $field_name = 'bukti_bayar';
            if (!$this->upload->do_upload($field_name)) {
                redirect('pesanan_saya/bayar/'.$id_transaksi);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/bukti_bayar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                
                $data = array(
                    'no_order' => $id_transaksi,
                    'status_bayar' => '1',
                );
                $this->M_transaksi->upload_bukti_bayar($data);

                $data = array(
                    'no_order' => $id_transaksi,
                    'atas_nama' => $this->input->post('atas_nama'),
                    'nama_bank' => $this->input->post('nama_bank'),
                    'no_rek' => $this->input->post('no_rek'),
                    'bukti_bayar' => $upload_data['uploads']['file_name']
                );
                $this->M_transaksi->upload_bukti($data);

                $this->session->set_flashdata('pesan', 'Bukti Pembayaran Berhasil Diupload');
                redirect('pesanan_saya');
            }
        }
        $data['total_asset'] = $this->M_transaksi->hitung();
        $this->load->view('frontend/template/header.php',$data);
        $data = array(
            'produk' => $this->M_transaksi->rinci_order($id_transaksi),
            'pesanan' => $this->M_transaksi->detail_pembayaran($id_transaksi),
            'rekening' => $this->M_transaksi->rekening(),
            'error_upload' => $this->upload->display_errors(),
        );
        $this->load->view('frontend/pembayaran.php', $data);
        $this->load->view('frontend/template/footer.php');
    }

    public function diterima($id_transaksi){
        $status= $this->session->userdata('userName');
        if(empty($status)){
            redirect('frontend/login');
        }
        $data = array(
            'no_order' => $id_transaksi,
            'status_order' => '3'
        );
        $this->Madmin->proses_pesanan($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil di Terima');

        redirect('pesanan_saya');
    }

    public function batal($id){
        $this->M_transaksi->batal($id);
        if($this->db->affected_rows()){
            $this->session->set_flashdata('error', 'Pesanan gagal dihapus');
            redirect('Pesanan_saya');
        } else {
            $this->session->set_flashdata('pesan', 'Pesanan telah dibatalkan');
            redirect('Pesanan_saya');
        }
    }

    public function history(){
        $status= $this->session->userdata('userName');
        if(empty($status)){
            redirect('frontend/login');
        }
        $data['total_asset'] = $this->M_transaksi->hitung();
        $this->load->view('frontend/template/header.php',$data);
        $data = array(
            'selesai' => $this->M_transaksi->selesai_bener(),
        );
        $this->load->view('frontend/history.php', $data);
        $this->load->view('frontend/template/footer.php');
       
    }
}
