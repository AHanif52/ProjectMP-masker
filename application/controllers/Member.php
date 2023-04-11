<?php 
class Member extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Mcrud');
    }

    public function index(){
        if(empty($this->session->userdata('username'))){
            redirect('admin');
        }
        $data['member']= $this->Mcrud->get_all_data('tbl_pelanggan')->result_array();
        $this->load->view('backend/template/header');
        $this->load->view('backend/template/sidebar');
        $this->load->view('backend/member/index', $data);
        $this->load->view('backend/template/footer');
    }

    public function aktif($id){
        $dataupdate = array('status'=>'Y');
        $this->Mcrud->update('tbl_pelanggan', $dataupdate, 'idPelanggan', $id);
        redirect('member');
    }

    public function non_aktif($id){
        $dataupdate = array('status'=>'N');
        $this->Mcrud->update('tbl_pelanggan', $dataupdate, 'idPelanggan', $id);
    redirect('member');
    }
    
    
    public function getid($id){
        if(empty($this->session->userdata('username'))){
            redirect('admin');
        }
        $datawhere = array(
            'idPelanggan' => $id
        );
        $data['member']= $this->Mcrud->get_by_id('tbl_pelanggan', $datawhere)->row_object();
        $this->load->view('backend/template/header.php');
        $this->load->view('backend/template/sidebar.php');
        $this->load->view('backend/member/edit.php', $data);
        $this->load->view('backend/template/footer.php');
    }

    public function edit($id = NULL){
        $this->form_validation->set_rules('status', 'Status', 'required',  array('required' =>
        '%s Harus Diisi'));

        if ($this->form_validation->run() ==  TRUE) {
            $status = $this->input->post('status');

            $data_insert = array(
                'status' => $status,
            );

            $this->Mcrud->update('tbl_pelanggan', $data_insert, 'idPelanggan', $id);
            redirect('member');   
        }
        
    }

    public function save(){
        $this->form_validation->set_rules('namapelanggan', 'Nama Pelanggan', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('password', 'password', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('status', 'Status', 'required',  array('required' =>
        '%s Harus Diisi'));

        if ($this->form_validation->run() ==  TRUE) {
            $namaProduk = $this->input->post('namapelanggan');
            $password = md5($this->input->post('password'));
            $status = $this->input->post('status');
            $deskripsi = $this->input->post('deskripsi');
            
            $config['upload_path'] = './gambar/member/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|JPEG';
            $config['max_size']     = '2000';
    
            $this->upload->initialize($config);
            $field_name = "foto";
    
            if($this->upload->do_upload($field_name)){
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/member/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
    
                $data_insert = array(
                    'namaProduk' => $namaProduk,
                    'password' => $password,
                    'status' => $status,
                    'foto' => $upload_data['uploads']['file_name'],
                    'deskripsi' => $deskripsi,
                );
    
                $this->Mcrud->insert('tbl_pelanggan', $data_insert);
                redirect('member');   
            } else {
                $data = array(
                    'error_upload' => $this->upload->display_errors()
                );
                $this->load->view('backend/template/header.php');
                $this->load->view('backend/template/sidebar.php');
                $this->load->view('backend/member/add.php', $data);
                $this->load->view('backend/template/footer.php');    
            }
        }
        
    }
}