<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	public $arrMenu = array();
	public $data;
	public $privilege = array();
	public $section = 16; //get module group id from database
	public $module_id = 18; //get module id from database
	
	public function __construct()
	{
		parent::__construct();
	
		if(empty($_SESSION['admin_data'])){
			session_destroy();
			redirect(BASE_URL_BACKEND."/signin");
			exit();
		}
		
		$this->load->model(array('backend/model_product'));
		$this->load->helper(array('funcglobal','menu','accessprivilege'));
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
        $this->data['ListMenu'] = $this->arrMenu;
        $this->data['CountMenu'] = count($this->arrMenu);
		
		//get menu from helper menu
		$this->arrMenu = menu();
		$this->data = array();
        $this->data['ListMenu'] = $this->arrMenu;
        $this->data['CountMenu'] = count($this->arrMenu);
		
		//check privilege module
		$this->privilege = accessprivilegeuserlevel($_SESSION['admin_data']['user_level_id'], $this->module_id);
	}
	
	public function index()
	{
		$this->view();
	}
	
	function view(){
		$this->session->unset_userdata(array("searchkey" => '', "searchby" => '', "perpage" => ''));
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		
		$searchkey = "";
		$searchby = "";
		$where = "";
		$orderBy = "";
		$perpage = "";

		if(isset($_POST["tbSearch"])){
			$this->session->unset_userdata(array("searchkey" => '', "searchby" => '', "perpage" => ''));
			
			$searchkey = $this->security->xss_clean(secure_input($_POST['searchkey']));
			$searchby = $this->security->xss_clean(secure_input($_POST['searchby']));
			$perpage = $this->security->xss_clean(secure_input($_POST['perpage']));
			
			$pesan = array();

			if ($searchkey=="") {
				$pesan[] = 'Keyword search is empty';
			} else if ($searchby=="") {
				$pesan[] = 'Search by has not been choose';
			}
			
			if (! count($pesan)==0 ) {
				foreach ($pesan as $indeks=>$pesan_tampil) {
					//$this->data['error'] = $pesan_tampil;
					$this->session->unset_userdata(array("searchkey" => '', "searchby" => '', "perpage" => ''));
				}
			} else {
				$this->session->set_userdata(array("searchkey" => $searchkey, "searchby" => $searchby, "perpage" => $perpage));

				if(isset($_POST['searchkey'])){
					$searchkey = $this->session->userdata("searchkey");
				}
				if(isset($_POST['searchby'])){
					$searchby = $this->session->userdata("searchby");
				}
				
				if($searchkey != "" && $searchby != ""){
					$where   =   " WHERE ".$searchby." LIKE '%". $searchkey ."%' ";
				}
			}	
		} else {
			$searchkey = $this->session->userdata("searchkey");
			$searchby = $this->session->userdata("searchby");
			
			if($searchkey != "" && $searchby != ""){
				$where   =   " WHERE ".$searchby." LIKE '%". $searchkey ."%' ";
			}
			
			if(isset($_POST['perpage'])){
				$perpage = $this->security->xss_clean(secure_input($_POST['perpage'])); 
				$this->session->set_userdata(array("perpage" => $perpage));
			} else {
				$perpage = $this->session->userdata("perpage");
				
				if($perpage == ""){
					$perpage = PER_PAGE;
				}
			}
		}
		
		$orderBy = "ORDER BY product_id DESC";
		
		$cond 				= $where." ".$orderBy;
		$rsProduct	= $this->model_product->getListProduct($cond);
		$base_url			= BASE_URL_BACKEND."/product/view/";
		$total_rows			= count($rsProduct);
		$per_page			= $perpage;
		
		$this->data['paging']		= pagging($base_url , $total_rows, $per_page);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start = $per_page*$page - $per_page;
		if ($start<0) $start = 0;
		$cond .= " LIMIT ".$start.",".$per_page;
		$this->data["ListProduct"] = $this->model_product->getListProduct($cond);
		
		//echo "<pre>";print_r($this->data["ListProduct"] );echo "</pre>";
		//extract privilege
		$this->data["list"] = $this->privilege[0];
		$this->data["view"] = $this->privilege[1];
		$this->data["add"] = $this->privilege[2];
		$this->data["edit"] = $this->privilege[3];
		$this->data["publish"] = $this->privilege[4];
		$this->data["approve"] = $this->privilege[5];
		$this->data["delete"] = $this->privilege[6];
		$this->data["order"] = $this->privilege[7];
		
		
		$this->data['searchkey'] = $searchkey;
		$this->data['searchby'] = $searchby;
		$this->data['perpage'] = $perpage;
		
		$this->data['total'] = $total_rows;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/product/list');
	}
	
	public function add(){
		//extract privilege
		$this->data["approve"] = $this->privilege[2];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		
		$supplierid = 0;
		$this->data['supplierid'] = $supplierid;
		$cond = "WHERE supplier_active_status = 1";
		$supplierid = $this->model_product->getListSupplier($cond);
		$this->data['SupplierId'] = $supplierid;
		
		$menuparent2 = 0;
		$this->data['menuparent2'] = $menuparent2;
		$cond = "WHERE catalog_active_status = 1";
		$MenuParent2 = $this->model_product->getListCatalog($cond);
		$this->data['MenuParent2'] = $MenuParent2;
		
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/product/add',$this->data);
	}
	
	public function doAdd(){
		//extract privilege
		$this->data["approve"] = $this->privilege[2];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$tb = $_POST['tbSave'];
		if (!$tb) {
			redirect(BASE_URL_BACKEND."/product");
			exit();
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		
		$productname = $this->security->xss_clean(secure_input($_POST['productname']));
		$productweight = $this->security->xss_clean(secure_input($_POST['productweight']));
		$productshortdesc = $this->security->xss_clean(secure_input($_POST['productshortdesc']));
		$productlogdesc = secure_input_editor($_POST['productlogdesc']);
		$producturl = $this->security->xss_clean(secure_input($_POST['producturl']));
		$productimageurl = $this->security->xss_clean(secure_input($_POST['productimageurl']));
		$catid = $this->security->xss_clean(secure_input($_POST['catid']));

		
		$productcode = $this->security->xss_clean(secure_input($_POST['productcode']));
		
		$pesan = array();
		// Validasi data
		if ($productname=="") {
			$pesan[] = 'Product Name is empty';
		}elseif($productweight==""){
			$pesan[] = 'Product Weight is empty';
		}elseif($productshortdesc==""){
			$pesan[] = 'Product description is empty';
		}elseif($catid==""){
			$pesan[] = 'Product catalog is empty';
		}elseif($productimageurl==""){
			$pesan[] = 'Product image is empty';
		}
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;
				
				$menuparent2 = 0;
				$this->data['menuparent2'] = $menuparent2;
				$cond = "WHERE catalog_active_status = 1";
				$MenuParent2 = $this->model_product->getListCatalog($cond);
				$this->data['MenuParent2'] = $MenuParent2;
				
				$this->data['productname']=$productname;
				$this->data['productweight']=$productweight;
				$this->data['productcode']=$productcode;
				$this->data['productbarcode']=$productbarcode;
				$this->data['productshortdesc']=$productshortdesc;
				$this->data['productlogdesc']=$productlogdesc;
				$this->data['producturl']=$producturl;
				$this->data['productimageurl']=$productimageurl;
				
				$this->data['catid']=$catid;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/product/add',$this->data);
			}
		} else {
			$cekProduct = $this->model_product->checkProduct($productname);
			$countProduct = count($cekProduct);
			
			if ($countProduct > 0 ) {
				$this->data['error']='Product Name '.$productname.' already exist';
				
				$menuparent2 = 0;
				$this->data['menuparent2'] = $menuparent2;
				$cond = "WHERE catalog_active_status = 1";
				$MenuParent2 = $this->model_product->getListCatalog($cond);
				$this->data['MenuParent2'] = $MenuParent2;
				$this->data['productname']=$productname;
				$this->data['productweight']=$productweight;
				$this->data['productcode']=$productcode;
				$this->data['productbarcode']=$productbarcode;
				$this->data['productshortdesc']=$productshortdesc;
				$this->data['productlogdesc']=$productlogdesc;
				$this->data['producturl']=$producturl;
				$this->data['productimageurl']=$productimageurl;

				$this->data['catid']=$catid;

				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/product/add',$this->data);
			} else {
				$productimageurl = str_replace(BASE_URL,"",$productimageurl);
				
				$arr_input = array(
							'productname'=>$productname,
							'productweight'=>$productweight,
							'productcode'=>$productcode,
							'productshortdesc'=>$productshortdesc,
							'productlogdesc'=>$productlogdesc,
							'productimageurl'=>$productimageurl,
							'producturl'=>$producturl,
							'catid'=>$catid);
				$this->model_product->insertProduct($arr_input);
				
				$productalias = strtolower(str_replace(' ','-',$productname));
				$this->mdl_menu->insertAlias('product',$productalias);
				
				$alias = $this->mdl_menu->getAlias();
				$aliasjson = json_encode($alias);
				write_file(JSON_ALIAS,$aliasjson);
				
				redirect(base_url('backend/product'));
			}	
		}	
	}
	
	public function edit($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/product");
			exit();
		}

		//extract privilege
		$this->data["approve"] = $this->privilege[3];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		
		$cond = "WHERE supplier_active_status = 1";
		$supplierid = $this->model_product->getListSupplier($cond);
		$this->data['SupplierId'] = $supplierid;
		

		$cond = "WHERE catalog_active_status = 1";
		$MenuParent2 = $this->model_product->getListCatalog($cond);
		$this->data['MenuParent2'] = $MenuParent2;
		
		$rsProduct = $this->model_product->getProduct($id);  // mengambil database dari model untuk dikirim ke view
		$countProduct = count($rsProduct);
		
		//echo "<pre>";print_r($rsProduct);echo "<pre>";
		
		$this->data['rsProduct'] = $rsProduct;
		$this->data['countProduct'] = $countProduct;
		
		$this->load->view('backend/header',$this->data);
		$this->load->view('backend/product/edit',$this->data);
	}
	
	public function doEdit($id){
		$tb = $_POST['tbEdit'];
		if (!$tb OR $id == '') {
			redirect(BASE_URL_BACKEND."/product");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[3];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$admin_data = $_SESSION['admin_data'];
		$this->data['admin_data'] = $admin_data;
		$this->data['section'] = $this->section; 
		$this->data['modul_id'] = $this->module_id;
		
		$productname = $this->security->xss_clean(secure_input($_POST['productname']));
		$productweight = $this->security->xss_clean(secure_input($_POST['productweight']));
		$productnameOld = $this->security->xss_clean(secure_input($_POST['productnameOld']));
		$productshortdesc = $this->security->xss_clean(secure_input($_POST['productshortdesc']));
		$productlogdesc = secure_input_editor($_POST['productlogdesc']);
		
		$producturl = $this->security->xss_clean(secure_input($_POST['producturl']));
		$productimageurl = $this->security->xss_clean(secure_input($_POST['productimageurl']));
		$catid = $this->security->xss_clean(secure_input($_POST['catid']));

        
        $supplierid = $_POST['supplierid'];
		
		//echo $productimageurl; die;
		
		$pesan = array();
		// Validasi data
		if ($productname=="") {
			$pesan[] = 'Product Name is empty';
		}elseif($productshortdesc==""){
			$pesan[] = 'Product description is empty';
		}elseif($catid==""){
			$pesan[] = 'Product catalog is empty';
		}elseif($productimageurl==""){
			$pesan[] = 'Product image is empty';

		}elseif($productweight==""){
			$pesan[] = 'Product weight is empty';

		}
		
		if (! count($pesan)==0 ) {
			foreach ($pesan as $indeks=>$pesan_tampil) {
				$this->data['error'] = $pesan_tampil;

				$cond = "WHERE supplier_active_status = 1";
				$supplierid = $this->model_product->getListSupplier($cond);
				$this->data['SupplierId'] = $supplierid;
				

				$cond = "WHERE catalog_active_status = 1";
				$MenuParent2 = $this->model_product->getListCatalog($cond);
				$this->data['MenuParent2'] = $MenuParent2;
				
				$rsProduct = $this->model_product->getProduct($id);  // mengambil database dari model untuk dikirim ke view
				$countProduct = count($rsProduct);
				$this->data['rsProduct'] = $rsProduct;
                
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/product/edit',$this->data);
			}
		} else {
		
				$cekProduct = $this->model_product->checkProduct($productname);
				$countcekProduct = count($cekProduct);
			
				if($productname == $productnameOld){
					$countcekProduct = 0;
				}
			
			if ($countcekProduct > 0 ) {
				$this->data['error']='Product Name '.$productname.' already exist';
				
				$rsCatalog = $this->model_katalog->getCatalogProduct($id);  // mengambil database dari model untuk dikirim ke view
				$countCatalog = count($rsCatalog);
		
				$cond = "WHERE supplier_active_status = 1";
				$supplierid = $this->model_product->getListSupplier($cond);
				$this->data['SupplierId'] = $supplierid;
				

				$cond = "WHERE catalog_active_status = 1";
				$MenuParent2 = $this->model_product->getListCatalog($cond);
				$this->data['MenuParent2'] = $MenuParent2;
				
				$rsProduct = $this->model_product->getProduct($id);  // mengambil database dari model untuk dikirim ke view
				$countProduct = count($rsProduct);
				$this->data['rsProduct'] = $rsProduct;
				
				$this->load->view('backend/header',$this->data);
				$this->load->view('backend/product/edit',$this->data);
			} else {
			
				$productimageurl = str_replace(BASE_URL,"",$productimageurl);
				
				$arr_input = array(
							'productid'=>$id,
							'productname'=>$productname,
							'productweight'=>$productweight,
							'productshortdesc'=>$productshortdesc,
							'productlogdesc'=>$productlogdesc,
							'productimageurl'=>$productimageurl,
							'producturl'=>$producturl,
							'catid'=>$catid);
				$this->model_product->updateProduct($arr_input);
				
				$productaliasOld = strtolower(str_replace(' ','-',$productnameOld));
				
				$this->mdl_menu->deleteAlias($productaliasOld);
				
				$productalias = strtolower(str_replace(' ','-',$productname));
				$this->mdl_menu->insertAlias('product',$productalias);
				
				$alias = $this->mdl_menu->getAlias();
				$aliasjson = json_encode($alias);
				write_file(JSON_ALIAS,$aliasjson);
				
				redirect(base_url('backend/product'));
			}	
		}
		
	}
	
	function active($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/product");
			exit();
		}
		
		//extract privilege
		$this->data["approve"] = $this->privilege[5];
		
		if($this->data["approve"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$active = $this->model_product->activeProduct($id);
		
		$alias = $this->mdl_menu->getAlias();
				$aliasjson = json_encode($alias);
				write_file(JSON_ALIAS,$aliasjson);
				
		redirect(BASE_URL_BACKEND."/product");
		
	}
	
	function delete($id){
		if (empty($id)) {
			redirect(BASE_URL_BACKEND."/product");
			exit();
		}
		
		//extract privilege
		$this->data["delete"] = $this->privilege[6];
		
		if($this->data["delete"] == 0){
			echo "<script>alert('Can\'t Access Module');window.location.href='".BASE_URL_BACKEND."/home';</script>";
			die;
		}
		
		$delete = $this->model_product->deleteProduct($id);
		
		$alias = $this->mdl_menu->getAlias();
				$aliasjson = json_encode($alias);
				write_file(JSON_ALIAS,$aliasjson);

		redirect(BASE_URL_BACKEND."/product");
	}
	

}
                            
                            
                            