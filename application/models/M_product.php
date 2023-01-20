<?php
class M_product extends CI_Model{

	function get_product_type(){
		$hsl=$this->db->get('product_type');
		return $hsl;
	}

	function get_all_product(){
		$hsl=$this->db->get('compare');
		return $hsl;
	}

	function simpan_product($product_type,$img_large,$img_thumb,$deskripsi,$product_rate){
		$hsl=$this->db->query("INSERT INTO compare(type,gambar_large,gambar_kotak,detail,rate) VALUES ('$product_type','$img_large','$img_thumb','$deskripsi','$product_rate')");
		return $hsl;
	}

	//front End
	function get_all_product_home(){
		$hsl=$this->db->query("SELECT * FROM compare LIMIT 4");
		return $hsl;
	}

	function get_product_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM compare WHERE kd_compare='$kode'");
		return $hsl;
	}

	function update_product($kode,$product_type,$img_large,$img_thumb,$deskripsi,$product_rate){
		$hsl=$this->db->query("UPDATE compare SET type='$product_type',gambar_large='$img_large',gambar_kotak='$img_thumb',detail='$deskripsi',rate='$product_rate' WHERE kd_compare='$kode'");
		return $hsl;
	}

	function update_product_img_large($kode,$product_type,$img_large,$deskripsi,$product_rate){
		$hsl=$this->db->query("UPDATE compare SET type='$product_type',gambar_large='$img_large',detail='$deskripsi',rate='$product_rate' WHERE kd_compare='$kode'");
		return $hsl;
	}

	function update_product_img_thumb($kode,$product_type,$img_thumb,$deskripsi,$product_rate){
		$hsl=$this->db->query("UPDATE compare SET type='$product_type',gambar_kotak='$img_thumb',detail='$deskripsi',rate='$product_rate' WHERE kd_compare='$kode'");
		return $hsl;
	}

	function update_product_no_img($kode,$product_type,$deskripsi,$product_rate){
		$hsl=$this->db->query("UPDATE compare SET type='$product_type',detail='$deskripsi',rate='$product_rate' WHERE kd_compare='$kode'");
		return $hsl;
	}

	function hapus_product($kode){
		$hsl=$this->db->query("DELETE FROM compare WHERE kd_compare='$kode'");
		return $hsl;
	}
}