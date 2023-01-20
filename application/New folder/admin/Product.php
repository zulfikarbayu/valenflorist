<?php
class Product extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('M_product','m_product');
		
	}
	function index(){
		$x['product']=$this->m_product->get_all_product();
		$this->load->view('admin/v_products',$x);
	}

	function add_new(){
		$x['type']=$this->m_product->get_product_type();
		$this->load->view('admin/v_add_product',$x);
	}

	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['record']=$this->m_product->get_product_by_kode($kode);
		$x['type']=$this->m_product->get_product_type();
		$this->load->view('admin/v_edit_product',$x);
	}

	function simpan_product(){
		$data = array();
		$config['upload_path'] = './assets/images/'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('userfile')) {
		    $error = array('error' => $this->upload->display_errors());
		}else{
		    $fileData = $this->upload->data();
		    $data['userfile'] = $fileData['file_name'];
		}

		if (!$this->upload->do_upload('userfile2')) {
		    $error = array('error' => $this->upload->display_errors()); 
		}else{
		    $fileData = $this->upload->data();
		    $data['userfile2'] = $fileData['file_name'];
		}

		$img_large=$data['userfile'];
		$img_thumb=$data['userfile2'];
		$deskripsi=$this->input->post('xdeskripsi');
		$product_type=strip_tags($this->input->post('xtype'));
		$product_rate=strip_tags($this->input->post('xrate'));

		$this->m_product->simpan_product($product_type,$img_large,$img_thumb,$deskripsi,$product_rate);
	    redirect('admin/product');
	}

	function update_product(){
		$data = array();
		$config['upload_path'] = './assets/images/'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	    $this->load->library('upload', $config);

	    if(!empty($_FILES['userfile']['name']) && !empty($_FILES['userfile2']['name'])){
		    
		    if (!$this->upload->do_upload('userfile')) { //upload image 1
			    $error = array('error' => $this->upload->display_errors());
			}else{
			    $fileData = $this->upload->data();
			    $data['userfile'] = $fileData['file_name'];
			    
			}

			if (!$this->upload->do_upload('userfile2')) { //upload image 2
			    $error = array('error' => $this->upload->display_errors()); 
			}else{
			    $fileData = $this->upload->data();
			    $data['userfile2'] = $fileData['file_name'];
			}

			$img_large=$data['userfile'];
			$img_thumb=$data['userfile2'];
			$kode=$this->input->post('xkode');
			$deskripsi=$this->input->post('xdeskripsi');
			$product_type=strip_tags($this->input->post('xtype'));
			$product_rate=strip_tags($this->input->post('xrate'));

			$this->m_product->update_product($kode,$product_type,$img_large,$img_thumb,$deskripsi,$product_rate);
		    redirect('admin/product');

	    }elseif (!empty($_FILES['userfile']['name']) || !empty($_FILES['userfile2']['name'])) {

	    	if(!empty($_FILES['userfile']['name'])){
	    		if (!$this->upload->do_upload('userfile')) { //upload image 1
			    $error = array('error' => $this->upload->display_errors());
				}else{
				    $fileData = $this->upload->data();
				    $data['userfile'] = $fileData['file_name'];
				    
				}
				$img_large=$data['userfile'];
				$kode=$this->input->post('xkode');
				$deskripsi=$this->input->post('xdeskripsi');
				$product_type=strip_tags($this->input->post('xtype'));
				$product_rate=strip_tags($this->input->post('xrate'));

				$this->m_product->update_product_img_large($kode,$product_type,$img_large,$deskripsi,$product_rate);
			    redirect('admin/product');
	    	}else{
	    		if (!$this->upload->do_upload('userfile2')) { //upload image 2
			    $error = array('error' => $this->upload->display_errors()); 
				}else{
				    $fileData = $this->upload->data();
				    $data['userfile2'] = $fileData['file_name'];
				}
				$img_thumb=$data['userfile2'];
				$kode=$this->input->post('xkode');
				$deskripsi=$this->input->post('xdeskripsi');
				$product_type=strip_tags($this->input->post('xtype'));
				$product_rate=strip_tags($this->input->post('xrate'));

				$this->m_product->update_product_img_thumb($kode,$product_type,$img_thumb,$deskripsi,$product_rate);
			    redirect('admin/product');
	    	}
	    
	    }else{
	    	$kode=$this->input->post('xkode');
			$deskripsi=$this->input->post('xdeskripsi');
			$product_type=strip_tags($this->input->post('xtype'));
			$product_rate=strip_tags($this->input->post('xrate'));

			$this->m_product->update_product_no_img($kode,$product_type,$deskripsi,$product_rate);
			redirect('admin/product');
	    }

	    
	}

	function hapus_product(){
		$kode=$this->input->post('kode');
		$this->m_product->hapus_product($kode);
		redirect('admin/product');
	}

	

}