<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_transaksi');
    }

    public function index(){
      $status= $this->session->userdata('userName');
      if(empty($status)){
         redirect('frontend/login');
      }
      if(empty($this->cart->contents())){
         $this->session->set_flashdata('error', 'Keranjang kosong');
         redirect('frontend');
      }
      $data['total_asset'] = $this->M_transaksi->hitung();
      $this->load->view('frontend/template/header.php',$data);
      $this->load->view('frontend/cart.php');
      $this->load->view('frontend/template/footer.php');
    }

   public function add(){
        $status= $this->session->userdata('userName');
        $qty=$this->input->post('qty');
        $id = $this->input->post('id');
        $stok = $this->M_transaksi->get_stok_by_id($id);
      if(empty($status)){
        redirect('frontend/login');
      } else if($qty > $stok->stok){
        $this->session->set_flashdata('error', 'Stok yang diinputkan melebihi stok yang tersedia');
        redirect('frontend/detail_produk/'.$id);
      } else {
         $data_produk = $this->M_transaksi->get_produk_by_id($this->input->post('id'));
         $data = array(
            'id' => $this->input->post('id'),
            'name' => $data_produk->namaProduk,
            'price' => $data_produk->harga,
            'berat' => $data_produk->berat,
            'qty' => $this->input->post('qty')
         );
         $this->cart->insert($data);
         $this->session->set_flashdata('pesan', 'Produk ditambahkan');
         redirect('belanja');
      }
   }

    public function delete($rowid){
        $this->cart->remove($rowid);
        $this->session->set_flashdata('error', 'Produk dihapus dari cart');
        redirect('belanja');
    }

    public function clear()
    {
        $this->cart->destroy();
        redirect('belanja');
    }   
   
    function updateItemQty(){
      $update = 0;
      
      // Get cart item info
      $rowid = $this->input->get('rowid');
      $qty = $this->input->get('qty');
      
      // Update item in the cart
      if(!empty($rowid) && !empty($qty)){
          $data = array(
              'rowid' => $rowid,
              'qty'   => $qty
          );
          $update = $this->cart->update($data);
      }
      
      // Return response
      echo $update?'ok':'err';
    }

    public function cekout(){
      $status= $this->session->userdata('userName');
      if(empty($status)){
         redirect('frontend/login');
      }
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('kota', 'Kota', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('expedisi', 'Expedisi', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('paket', 'Paket', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('hp_penerima', 'Nomer Handphone', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required',  array('required' =>
        '%s Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $data['total_asset'] = $this->M_transaksi->hitung();
            $this->load->view('frontend/template/header.php',$data);
            $data = array(
               $this->session->set_flashdata('pesan', validation_errors()),
               'error_upload' => $this->upload->display_errors()
            );
            $this->load->view('frontend/cekout.php', $data);
            $this->load->view('frontend/template/footer.php');
        } else {
            //Data tersimpan ke tabel transaksi
            $data = array(
                'no_order'  => $this->input->post('no_order'),
                'idPelanggan' => $this->session->userdata('id'),
                'tgl_order' => date('ymd'),
                'penerima' => $this->input->post('nama_penerima'),
                'hp_penerima' => $this->input->post('hp_penerima'),
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota'),
                'alamat' => $this->input->post('alamat'),
                'kode_pos' => $this->input->post('kode_pos'),
                'ekspedisi' => $this->input->post('expedisi'),
                'paket' => $this->input->post('paket'),
                'estimasi' => $this->input->post('estimasi'),
                'ongkir' => $this->input->post('ongkir'),
                'berat' => $this->input->post('berat'),
                'sub_total' => $this->input->post('sub_total'),
                'total_bayar' => $this->input->post('total_bayar'),
                'status_bayar' => '0'
            );
            $this->M_transaksi->simpan_transaksi($data);

            $data = array('no_order'  => $this->input->post('no_order'),
                            'status_order' => '0');
            $this->M_transaksi->konfirmasi($data);

            //simpan ke tabel rincian transaksi
            $i= 1;
            foreach ($this->cart->contents() as $item) {
                $data_rinci = array(
                    'no_order'  => $this->input->post('no_order'),
                    'idProduk' => $item['id'],
                    'qty' =>$this->input->post('qty'.$i++),
                );
                $this->M_transaksi->simpan_rinci_order($data_rinci);
            }
            
            $this->session->set_flashdata('Pesan', 'Pesanan Berhasil Di Proses');
            $this->cart->destroy();
            redirect('pesanan_saya');
        }
    }
}