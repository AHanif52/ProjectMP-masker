<?php 
class Produk extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Mcrud');
    }

    public function index(){
        if(empty($this->session->userdata('username'))){
            redirect('admin');
        }
        $data['produk']= $this->Mcrud->get_all_data('tbl_produk')->result_array();
        $this->load->view('backend/template/header');
        $this->load->view('backend/template/sidebar');
        $this->load->view('backend/produk/index', $data);
        $this->load->view('backend/template/footer');
    }

    public function add(){
        if(empty($this->session->userdata('username'))){
            redirect('admin');
        }

        $this->load->view('backend/template/header.php');
        $this->load->view('backend/template/sidebar.php');
        $this->load->view('backend/produk/add.php');
        $this->load->view('backend/template/footer.php');
    }

    public function save(){
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('harga', 'Harga', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('stok', 'Stok', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('berat', 'Berat', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required',  array('required' =>
        '%s Harus Diisi'));

        if ($this->form_validation->run() ==  TRUE) {
            $namaProduk = $this->input->post('nama_produk');
            $harga = $this->input->post('harga');
            $stok = $this->input->post('stok');
            $berat = $this->input->post('berat');
            $deskripsi = $this->input->post('deskripsi');
            
            $config['upload_path'] = './gambar/produk/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|JPEG';
            $config['max_size']     = '2000';
    
            $this->upload->initialize($config);
            $field_name = "foto";
    
            if($this->upload->do_upload($field_name)){
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/produk/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
    
                $data_insert = array(
                    'namaProduk' => $namaProduk,
                    'stok' => $stok,
                    'harga' => $harga,
                    'berat' => $berat,
                    'foto' => $upload_data['uploads']['file_name'],
                    'deskripsi' => $deskripsi,
                );
    
                $this->Mcrud->insert('tbl_produk', $data_insert);
                redirect('produk');   
            } else {
                $data = array(
                    'error_upload' => $this->upload->display_errors()
                );
                $this->load->view('backend/template/header.php');
                $this->load->view('backend/template/sidebar.php');
                $this->load->view('backend/produk/add.php', $data);
                $this->load->view('backend/template/footer.php');    
            }
        }
    }

    public function getid($id){
        if(empty($this->session->userdata('username'))){
            redirect('admin');
        }
        $datawhere = array(
            'idProduk' => $id
        );
        $data['produk']= $this->Mcrud->get_by_id('tbl_produk', $datawhere)->row_object();
        $this->load->view('backend/template/header.php');
        $this->load->view('backend/template/sidebar.php');
        $this->load->view('backend/produk/edit.php', $data);
        $this->load->view('backend/template/footer.php');
    }

    public function edit($id = NULL){
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('harga', 'Harga', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('stok', 'Stok', 'required', array(
            'required' => '%s Harus Diisi'
        ));
        $this->form_validation->set_rules('berat', 'Berat', 'required',  array('required' =>
        '%s Harus Diisi'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required',  array('required' =>
        '%s Harus Diisi'));

        if ($this->form_validation->run() ==  TRUE) {
            $namaProduk = $this->input->post('nama_produk');
            $harga = $this->input->post('harga');
            $stok = $this->input->post('stok');
            $berat = $this->input->post('berat');
            $deskripsi = $this->input->post('deskripsi');
            
            $config['upload_path'] = './gambar/produk/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPG|JPEG';
            $config['max_size']     = '2000';
    
            $this->upload->initialize($config);
            $field_name = "foto";
    
                if($this->upload->do_upload($field_name)){
                    //menghapus gambar pada bagian file manager 
                    $produk = $this->Mcrud->get_by_id('tbl_produk', $id);
                    if ($produk->foto != "") {
                        unlink('./gambar/produk/' . $produk->foto);
                    }
                    //end hapus gambar 

                    $upload_data = array('uploads' => $this->upload->data());
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './gambar/produk/' . $upload_data['uploads']['file_name'];
                    $this->load->library('image_lib', $config);
        
                    $data_insert = array(
                        'namaProduk' => $namaProduk,
                        'stok' => $stok,
                        'harga' => $harga,
                        'berat' => $berat,
                        'foto' => $upload_data['uploads']['file_name'],
                        'deskripsi' => $deskripsi,
                    );
        
                    $this->Mcrud->update('tbl_produk', $data_insert, 'idProduk', $id);
                    redirect('produk');   
                } else {
                    $data = array(
                        'error_upload' => $this->upload->display_errors()
                    );
                    $this->load->view('backend/template/header.php');
                    $this->load->view('backend/template/sidebar.php');
                    $this->load->view('backend/produk/edit.php', $data);
                    $this->load->view('backend/template/footer.php');    
                }

            $data_insert = array(
                'namaProduk' => $namaProduk,
                'stok' => $stok,
                'harga' => $harga,
                'berat' => $berat,
                'deskripsi' => $deskripsi,
            );

            $this->Mcrud->update('tbl_produk', $data_insert, 'idProduk', $id);
            redirect('produk');   
        }
    }

    public function delete($id){
        $this->Mcrud->delete('tbl_produk', 'idProduk', $id);
        if($this->db->affected_rows()){
            redirect('Produk');
        } else {
            echo "Data gagal dihapus";
        }
    }
}