<?php 
class Product extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_product','m_product');
		$this->load->model('M_pengunjung','m_pengunjung');
		$this->m_pengunjung->count_visitor();
	}

	function index(){
		$x['data']=$this->m_product->get_all_product();
		$this->load->view('frontend/product_view',$x);
	}
}