<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('M_pengunjung','m_pengunjung');
		$this->load->model('M_slider','m_slider');
		$this->load->model('M_tulisan','m_tulisan');
		$this->load->model('M_product','m_product');
        $this->m_pengunjung->count_visitor();
	}

	public function index(){
		$x['slider']=$this->m_slider->get_all_slider();
		$x['product']=$this->m_product->get_all_product_home();
		$x['testimony']=$this->m_tulisan->get_blog_home();
		$this->load->view('frontend/home_view',$x);
		
	}

}
