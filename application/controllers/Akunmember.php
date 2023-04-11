<?php


defined('BASEPATH') or exit('No direct script access allowed');

class akunmember extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mmember');
        //Load Dependencies
    }

    // List all your items
    public function register(){
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_pelanggan.userName]', array(
            'required' => '%s Harus Diisi',
            'is_unique' => '%s ini sudah terdaftar'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]',  
        array('required' =>'%s Harus Diisi',
                'min_length' => '%s Terlalu Pendek' ));

        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]', array('required' =>
        '%s Harus Diisi', 'matches' => '%s tidak sama'));

        $this->form_validation->set_rules('nama', 'Nama Pelanggan', 'required', array('required' => '%s Harus Diisi'
        ));

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $nama = $this->input->post('nama');

            $config['upload_path'] = './gambar/profil/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '2000';

            $this->upload->initialize($config);
            $field_name = 'foto';
            
            if($this->upload->do_upload($field_name)){
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/profil/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
    
                $data = array(
                    'userName' => $username,
                    'password' => $password,
                    'namapelanggan' => $nama,
                    'status' => 'Y',
                    'foto' => $upload_data['uploads']['file_name']
                );
                
                $this->Mmember->register($data);
                redirect('akunmember/login');
            } else {
                $data = array(
                    $this->session->set_flashdata('pesan', validation_errors()),
                    'error_upload' => $this->upload->display_errors()
                );
                $this->load->view('frontend/template/header.php');
                $this->load->view('frontend/register.php', $data);
                $this->load->view('frontend/template/footer.php');
            }
        } else {
            $data = array(
                $this->session->set_flashdata('pesan', validation_errors()),
                'error_upload' => $this->upload->display_errors()
            );
            $this->load->view('frontend/template/header.php');
            $this->load->view('frontend/register.php', $data);
            $this->load->view('frontend/template/footer.php');
        }

        $this->load->view('frontend/template/header.php');
        $this->load->view('frontend/register.php');
        $this->load->view('frontend/template/footer.php');
    }

    public function login(){
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Harus Diisi'
        ));

        if ($this->form_validation->run() ==  TRUE) {
            $u = $this->input->post('username');
            $p = md5($this->input->post('password'));

            $cek = $this->Mmember->cek_login($u, $p)->row();
            if ($cek) {
                $id_pelanggan = $cek->idPelanggan;
                $namapelanggan = $cek->namapelanggan;
                $u = $cek->userName;
                $foto = $cek->foto;
                //buat session
                $data_session = array(
                    'userName' => $u,
                    'id' => $id_pelanggan,
                    'status' => 'login',
                    'foto' => $foto,
                    'namapelanggan' => $namapelanggan
                );
                $this->session->set_userdata($data_session);
                redirect('frontend');
            }  else {
                $this->session->set_flashdata('error', 'Username Atau Password Salah');
                $this->load->view('frontend/template/header.php');
                $this->load->view('frontend/login.php');
                $this->load->view('frontend/template/footer.php');
            }
        } else {
            $data = array(
                'error_upload' => $this->upload->display_errors()
            );
            $this->load->view('frontend/template/header.php');
            $this->load->view('frontend/login.php', $data);
            $this->load->view('frontend/template/footer.php');
        }
    }

    public function akun(){
        $status= $this->session->userdata('userName');
        if(empty($status)){
         redirect('frontend/login');
        }
        $data['total_asset'] = $this->M_transaksi->hitung();
        $this->load->view('frontend/template/header.php',$data);
        $this->load->view('frontend/akun.php');
        $this->load->view('frontend/template/footer.php');
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('userName');
        $this->session->unset_userdata('namapelanggan');
        $this->session->unset_userdata('foto');
        $this->session->sess_destroy();
        $this->session->set_flashdata('pesan', 'Anda Berhasil Logout');
        redirect('akunmember/login');
    }


    public function edit($id_pelanggan = NULL){
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]', array(
            'required' => '%s Harus Diisi!!!',
            'matches' => '%s Password Tidak sama'
        ));

        $data = array(
            'idPelanggan' => $id_pelanggan,
            'password' => md5($this->input->post('password'))
        );
        $this->Mmember->edit1($data);

        if ($this->form_validation->run() != false) {
            redirect('akunmember/logout');
        } else {
            $data['total_asset'] = $this->M_transaksi->hitung();
            $this->load->view('frontend/template/header.php',$data);
            $data = array(
                'pelanggan' => $this->Mmember->get_data($id_pelanggan),
            );
            $this->load->view('frontend/edit_akun.php');
            $this->load->view('frontend/template/footer.php');
        }
    }
}
