<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    
    public function aksi_login(){
        $this->form_validation->set_rules('username', 'Username', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('password', 'Password', 'required',  array('required' =>
        '%s Harus Diisi'));

        if ($this->form_validation->run() ==  TRUE) {
            $this->load->model('Mlogin');
            $u= $this->input->post('username');
            $p= $this->input->post('password');
            $cek = $this->Mlogin->cek_login($u,$p)->num_rows();
            if($cek==1){
                $data_session = array(
                    'username' => $u,
                    'status' => 'login'
                );
                $this->session->set_userdata($data_session);
                redirect('admin/home');
            }else{
                $this->ci->session->set_flashdata('error', 'Username Atau Password Salah');
                redirect('admin');
            }
        } 
        $this->load->view('backend/template/header.php');
        $this->load->view('backend/login.php');
        $this->load->view('backend/template/footer.php');
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('admin');
    }
}
