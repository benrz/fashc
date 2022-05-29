<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CMSController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('CMSModel');
	}
	
	public function index(){
		$this->CMS();
	}

	public function CMS(){
		$data = $this->dataNeeded();

		if($this->uri->segment(3) == "Product"){
			$temp['productData'] = $this->CMSModel->getProductData($this->uri->segment(4));
			$temp['productAge'] = $this->uri->segment(4);
			$data['MainView'] = $this->load->view('cms/product/CProductView.php', $temp, TRUE);
		}
		else if($this->uri->segment(3) == "Transaction"){
			$temp['transactionData'] = $this->CMSModel->getTransactionData(NULL);
			$data['MainView'] = $this->load->view('cms/transaction/CTransactionView.php', $temp, TRUE);
		}
		else if($this->uri->segment(3) == "Customer"){
			$temp['customerData'] = $this->CMSModel->getCustomerData();
			$data['MainView'] = $this->load->view('cms/customer/CCustomerView.php', $temp, TRUE);
		}
		else if($this->uri->segment(3) == "FlashSale"){
			$this->CMSModel->deleteFlashSaleByID(NULL);
			$temp['flashSaleData'] = $this->CMSModel->getFlashSaleData(NULL);
			$data['MainView'] = $this->load->view('cms/flashSale/CFlashSaleView.php', $temp, TRUE);			
		}

		$this->load->view('cms/CHomeView.php', $data);
	}

	public function dataNeeded(){
		$data['js'] = $this->load->view('cms/cmsInclude/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('cms/cmsInclude/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('cms/template/CHeaderView.php', NULL, TRUE);
		$data['FooterView'] = $this->load->view('cms/template/CFooterView.php', NULL, TRUE);
		$data['SideBarView'] = $this->load->view('cms/template/CSideBarView.php', NULL, TRUE);
		$data['itemCategory'] = $this->CMSModel->getCategoryList();
		$data['itemSize'] = $this->CMSModel->getSizeList();
		$data['itemColor'] = $this->CMSModel->getColorList();
		$data['MainView'] = $this->load->view('cms/template/CIndexView.php', NULL, TRUE);
		return $data;
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Product
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function addProductView(){
		$data = $this->dataNeeded();
		$data['itemID'] = $this->CMSModel->getItem(NULL);
		$data['itemCategory'] = $this->CMSModel->getCategoryList();
		$data['itemSize'] = $this->CMSModel->getSizeList();
		$data['itemColor'] = $this->CMSModel->getColorList();
		
		$this->load->view('cms/product/CAddProductView', $data);
	}

	public function addProduct(){
		$this->load->library('form_validation');
		if($this->input->post('newData') == 'accept'){
			$this->form_validation->set_rules('itemName', 'itemName', 'required', array('required' => 'You must provide a %s!'));
			$this->form_validation->set_rules('itemDescription', 'itemDescription', 'required|max_length[100]', array('required' => 'You must provide a %s!'));
			$this->form_validation->set_rules('itemImage', 'itemImage', 'callback_itemImage_check');	
		}
		else{
			$this->form_validation->set_rules('itemPrice', 'itemPrice', 'required|greater_than[0]', array('required' => 'You must provide a %s!'));
			$this->form_validation->set_rules('itemStock', 'itemStock', 'required|greater_than[0]', array('required' => 'You must provide a %s!'));
		}

		if ($this->form_validation->run() == FALSE) {
			$this->addProductView();
		}
		else {
			$data = array(
				"newData" => $this->input->post('newData'),
				"itemID" => $this->input->post('itemID'),
				"itemName" => $this->input->post('itemName'),
				"itemDescription" => $this->input->post('itemDescription'),
				"itemAge" => $this->input->post('itemAge'),
				"itemCategoryID" => $this->input->post('itemCategoryName'),
				"itemSizeID" => $this->input->post('itemSizeName'),
				"itemColorID" => $this->input->post('itemColorName'),
				"itemPrice" => ltrim($this->input->post('itemPrice'), '0'),
				"itemStock" => ltrim($this->input->post('itemStock'), '0'),
				"itemImage" => 'assets/cms_assets/productImage/'. $this->upload->data('file_name')
			);

			$this->CMSModel->addProduct($data);
			redirect(site_url('CMSController/CMS'));
		}
	}

	
	public function itemImage_check() {
		$config['upload_path'] 	 = './assets/cms_assets/productImage';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']      = '1024';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('itemImage')) {
			$this->form_validation->set_message('itemImage_check', $this->upload->display_errors());
			return FALSE;
		};
	}

	// Halaman Product CMS
	public function productDetail(){ // Melihat Detail Product (child/variasi) dari suatu itemData (parent) berdasarkan itemID (ID milik parent)
		$data = $this->dataNeeded();
		$itemID = $this->input->get('itemID', TRUE);
		
		$data['itemDetail'] = $this->CMSModel->getItemDetail($itemID,NULL);
		
		$this->load->view('cms/product/CProductDetailView', $data);
	}

	
	public function productEditView($ID = NULL){ // View dari Edit Product (Menampilkan kolom tabel itemData / parent)
		$data = $this->dataNeeded();
		if($ID != NULL){
			$itemID = $ID;
		}
		else{
			$itemID = $this->input->get('itemID', TRUE);
		}
		$data['itemData'] = $this->CMSModel->getItem($itemID);
		
		$this->load->view('cms/product/CProductEditView',$data);
	}
	
	public function productEdit(){ // Mengupdate dari Edit Product
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('itemName', 'itemName', 'required', array('required' => 'You must provide a %s!'));
		$this->form_validation->set_rules('itemDescription', 'itemDescription', 'required|max_length[100]', array('required' => 'You must provide a %s!'));
		if ($this->form_validation->run() == FALSE) {
			$this->productEditView($this->input->post('itemID'));
		}
		else{
			$data = array(
				'itemAvailability' => $this->input->post('itemAvailability'),
				'itemID' => $this->input->post('itemID'),
				'itemName' => $this->input->post('itemName'),
				'itemCategoryID' => $this->input->post('itemCategoryName'),
				'itemAge' => $this->input->post('itemAge'),
				'itemDescription' => $this->input->post('itemDescription'),
				'itemDiscount' => $this->input->post('itemDiscount'),
				'itemImage' => $this->input->post('itemImage')
			);
		
			$this->CMSModel->updateItemByID($data);
			redirect(site_url("CMSController/CMS/Product/".$data['itemAge'].""));
		}
	}
	
	// public function productDelete(){ // Menghapus Tabel itemData (Parent) beserta itemDetail (Child), dimulai dari child terlebih dahulu
	// 	$data = $this->dataNeeded();
	// 	$itemID = $this->input->get('itemID', TRUE);
	// 	$itemAge = $this->input->get('itemAge', TRUE);
	// 	$this->CMSModel->deleteItemByID($itemID);
	// 	redirect("CMSController/CMS/Product/$itemAge");
	// }

	
	// Halaman Detail Product CMS

	// public function productDetailDelete(){ // Menghapus Tabel Detail Product berdasarkan itemDetailID yang dipilih
	// 	$itemDetailID = $this->input->get('itemDetailID', TRUE);
	// 	$itemID = $this->input->get('itemID', TRUE);
		
	// 	$this->CMSModel->deleteItemDetailByID(NULL,$itemDetailID);
		
	// 	redirect("CMSController/productDetail?itemID=$itemID");
	// }

	
	public function productDetailEditView($ID = NULL){ // View dari Edit Detail Product
		$data = $this->dataNeeded();
		if($ID != NULL){
			$itemDetailID = $ID;
		}
		else{
			$itemDetailID = $this->input->get('itemDetailID', TRUE);
		}
		$data['itemDetail'] = $this->CMSModel->getItemDetail(NULL,$itemDetailID);
	
		$this->load->view('cms/product/CProductDetailEditView',$data);
	}
	
	public function productDetailEdit(){ // Mengupdate Tabel Detail Product dengan data baru berdasarkan itemDetailID yang dipilih
		$itemID = $this->input->post('itemID');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('itemPrice', 'Price', 'required|min_length[1]|callback_itemPrice_check', array('required' => 'You must provide a %s!'));
		$this->form_validation->set_rules('itemStock', 'Stock', 'required', array('required' => 'You must provide a %s!'));
		
		if ($this->form_validation->run() == FALSE) {
			$this->productDetailEditView($this->input->post('itemDetailID'));
		}
		else{
			$data = array(
				'itemDetailAvailability' => $this->input->post('itemDetailAvailability'),
				'itemDetailID' => $this->input->post('itemDetailID'),
				'itemSizeID' => $this->input->post('itemSizeName'),
				'itemColorID' => $this->input->post('itemColorName'),
				'itemPrice' => $this->input->post('itemPrice'),
				'itemStock' => $this->input->post('itemStock')
			);
			$this->CMSModel->updateItemDetailByDetailID($data);
		
			redirect("CMSController/productDetail?itemID=$itemID");
		}
	}
	
	public function itemPrice_check(){
		if($_POST['itemPrice'] > 0){
			return True;
		}
		else{
			$this->form_validation->set_message('itemPrice_check', '%s cannot be 0.');
			return False;
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Transaction
///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function transactionDetailView(){
		$data = $this->dataNeeded();
		$data['transactionID'] = $this->input->get('transactionID', TRUE);
		////////////////////////
		$data['transactionDetail'] = $this->CMSModel->getTransactionDetail($data['transactionID']);
		//////////////////////// BELUM DiTAMBAHIN transactionDetailID dr DB VENTRY

		$this->load->view('cms/transaction/CTransactionDetailView.php', $data);
	}

	public function transactionEditView(){
		$data = $this->dataNeeded();
		$data['transactionID'] = $this->input->get('transactionID', TRUE);
		$data['transactionData'] = $this->CMSModel->getTransactionData($data['transactionID']);
		$data['statusList'] = $this->CMSModel->getStatusList();

		// echo "<pre>";
		// print_r($data['transactionData']);
		// echo "</pre>";
		$this->load->view('cms/transaction/CTransactionEditView.php', $data);
	}

	public function transactionEdit(){
		$data = array(
			'transactionID' => $this->input->post('transactionID'),
			'transactionStatus' => $this->input->post('status')
		);
		$this->CMSModel->updateStatus($data);
		redirect(site_url('CMSController/CMS/Transaction'));
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Customer
///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function customerDetail(){
		$data = $this->dataNeeded();
		$data['transactionID'] = $this->input->get('customerID', TRUE);

		$this->load->view('cms/customer/CCustomerDetailView', $data);
	}
	//????????????????????????????????????????????????????????????///

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Flash Sale
///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function flashSaleDetailView(){
		$data = $this->dataNeeded();
		$data['flashSaleID'] = $this->input->get('flashSaleID', TRUE);
		$data['flashSaleDetail'] = $this->CMSModel->getFlashSaleDetail($data['flashSaleID']);
		$this->load->view('cms/flashSale/CFlashSaleDetailView.php', $data);
	}

	
	public function flashSaleEditView($flashSaleID = NULL){
		$data = $this->dataNeeded();
		if($flashSaleID == NULL){
			$data['flashSaleID'] = $this->input->get('flashSaleID',TRUE);
		}
		else{
			$data['flashSaleID'] = $flashSaleID;
		}
		$data['flashSaleData'] = $this->CMSModel->getFlashSaleData($data['flashSaleID']);
	  
		$this->load->view('cms/flashSale/CFlashSaleEditView.php', $data);
	}
	  
	public function flashSaleEdit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('flashSaleDate', 'Flash Sale Date', 'required|callback_compareDate', array('required' => 'You must provide a %s!'));
		$this->form_validation->set_rules('flashSaleStartTime', 'Start Time', 'required', array('required' => 'You must provide a %s!'));
		$this->form_validation->set_rules('flashSaleEndTime', 'End Time', 'required|callback_compareTime', array('required' => 'You must provide a %s!'));
	  
		if ($this->form_validation->run() == FALSE) {
			$this->flashSaleEditView($this->input->post('flashSaleID'));
		}
		else {
			$data = array(
				'flashSaleID' => $this->input->post('flashSaleID'),
				'flashSaleDate' => $this->input->post('flashSaleDate'),
				'flashSaleStartTime' => $this->input->post('flashSaleStartTime'),
				'flashSaleEndTime' => $this->input->post('flashSaleEndTime'),
			);
			$this->CMSModel->updateFlashSaleData($data);
			redirect(site_url('CMSController/CMS/FlashSale'));
		}
	}
	
	public function flashSaleDelete(){
		$flashSaleID = $this->input->get('flashSaleID', TRUE);
		$this->CMSModel->deleteFlashSaleByID($flashSaleID);
		redirect(site_url("CMSController/CMS/FlashSale"));
	}
	
	public function addFlashSaleView(){
		$data = $this->dataNeeded();
		$this->load->view('cms/flashSale/CAddFlashSaleView.php', $data);
	}
	
	public function addFlashSale(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('flashSaleDate', 'Flash Sale Date', 'required|callback_compareDate', array('required' => 'You must provide a %s!'));
		$this->form_validation->set_rules('flashSaleStartTime', 'Start Time', 'required', array('required' => 'You must provide a %s!'));
		$this->form_validation->set_rules('flashSaleEndTime', 'End Time', 'required|callback_compareTime', array('required' => 'You must provide a %s!'));
		
		if ($this->form_validation->run() == FALSE) {
			$this->addFlashSaleView();
		}
		else {
			$data = array(
			"flashSaleDate" => $this->input->post('flashSaleDate'),
			"flashSaleStartTime" => $this->input->post('flashSaleStartTime'),
			"flashSaleEndTime" => $this->input->post('flashSaleEndTime'),
			);
		
			$this->CMSModel->addFlashSaleData($data);
			redirect(site_url('CMSController/CMS/FlashSale'));
		}
	}
	
	public function compareDate(){
		$flashSaleDate = $_POST['flashSaleDate'];
		$nowDate = date('Y-m-d');
		
		if($flashSaleDate > $nowDate){
			return True;
		}
		else{
			$this->form_validation->set_message('compareDate', '%s must be at least 1 day different from the current date.');
			return False;
		}
	}
	
	public function compareTime() {
		$startTime = strtotime($_POST['flashSaleStartTime']);
		$endTime = strtotime($_POST['flashSaleEndTime']);
			
		if ($endTime > $startTime)
			return True;
		else {
			$this->form_validation->set_message('compareTime', '%s should be greater than Start Time.');
			return False;
		}
	}

	public function addFlashSaleDetailView($flashSaleID = NULL){
		$data = $this->dataNeeded();
		if($flashSaleID == NULL){
			$data['flashSaleID'] = $this->input->get('flashSaleID',TRUE);
		}
		else{
			$data['flashSaleID'] = $flashSaleID;
		}
		$data['itemID'] = $this->CMSModel->getItem(NULL);
		$this->load->view('cms/flashSale/CAddFlashSaleDetailView.php', $data);
	}

	public function addFlashSaleDetail(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('itemID', 'Item', 'required|callback_checkItemExistence', array('required' => 'You must provide a %s!'));
		$this->form_validation->set_rules('flashSaleDiscount', 'Discount', 'required', array('required' => 'You must provide a %s!'));

		if ($this->form_validation->run() == FALSE) {
			$this->addFlashSaleDetailView($this->input->post('flashSaleID'));
			// redirect(site_url('CMSController/addFlashSaleDetailView?flashSaleID='.$this->input->post('flashSaleID').''));
		}
		else {
			$data = array(
				"flashSaleID" => $this->input->post('flashSaleID'),
				"itemID" => $this->input->post('itemID'),
				"flashSaleDiscount" => $this->input->post('flashSaleDiscount'),
			);

			$this->CMSModel->addFlashSaleDetailData($data);
			redirect(site_url('CMSController/flashSaleDetailView?flashSaleID='.$this->input->post('flashSaleID').''));
		}
	}

	public function checkItemExistence(){
		if ($this->CMSModel->checkItemExistence($_POST['flashSaleID'], $_POST['itemID'])){
			$this->form_validation->set_message('checkItemExistence', '%s has already exist in this flash sale session!');
			return False;
		}
		else {
			return True;
		}
	}

	public function flashSaleDetailDelete(){
		$flashSaleDetailID = $this->input->get('flashSaleDetailID', TRUE);
		$flashSaleID = $this->input->get('flashSaleID', TRUE);
		$this->CMSModel->deleteFlashSaleDetailByID($flashSaleDetailID);
		redirect(site_url("CMSController/flashSaleDetailView?flashSaleID=$flashSaleID"));

	}

}
