<?php

defined('BASEPATH') or exit('No direct script access allowed !');

class customer_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_deliveryService()
	{
	    $this->db->query("SET sql_mode = '' ");
		$query = $this->db->query("SELECT * FROM DeliveryService");

		return $query->result_array();
	}

	public function get_paymentMethod()
	{
	    $this->db->query("SET sql_mode = '' ");
		$query = $this->db->query("SELECT * FROM paymentmethod");

		return $query->result_array();
	}

	public function get_provinsi()
	{
		$query = $this->db->query("SELECT * FROM provinsi");

		return $query->result_array();
	}
	public function get_kota()
	{
		$query = $this->db->query("SELECT * FROM kota");

		return $query->result_array();
	}

	public function getInvoice($id)
	{
		$this->db->select('invoiceID, totalTransaksi, invoiceDate, paymentMethod, deliveryService');
		$this->db->from('invoice');
		$this->db->join('transaction', 'invoice.transactionID = transaction.transactionID');
		$this->db->join('receiver', 'receiver.receiverID = transaction.receiverID');
		$this->db->join('DeliveryService', 'receiver.DeliveryServiceID = DeliveryService.deliveryServiceID');
		$this->db->join('paymentmethod', 'receiver.paymentMethodID = paymentmethod.paymentMethodID');
		$this->db->where('transaction.transactionID', $id);

		$query = $this->db->get();
		return $query;
	}

	public function getreceiver($id)
	{
		$this->db->select('ReceiverName, Address, ZIP, kota, provinsi');
		$this->db->from('receiver');
		$this->db->join('kota', 'kota.kotaID = receiver.kotaID');
		$this->db->join('provinsi', 'provinsi.provinsiID = kota.provinsiID');
		$this->db->join('transaction', 'transaction.receiverID = receiver.receiverID');
		$this->db->where('transaction.transactionID', $id);

		$query = $this->db->get();

		return $query->row();
	}

	public function get_receiver($name)
	{
		$this->db->select('receiverID');
		$this->db->from('receiver');
		$this->db->where('ReceiverName', $name);

		$query = $this->db->get();

		return $query->result_array();
	}

	public function get_transaction()
	{
		$this->db->select_max('transactionID');
		$this->db->from('transaction');

		$query = $this->db->get();
		return $query->row();
	}

	public function get_image($id)
	{
		$this->db->select('itemImage');
		$this->db->from('itemData');
		$this->db->join('itemData', 'itemdata.itemID = itemdetail.itemID');
		$this->db->join('itemdetail', 'itemdetail.itemdetailID = shoppingcart.itemdetailID');
		$this->db->join('shoppingcart', 'shoppingcart.shoppingcartID = transactiondetail.shoppingcartID');
		$this->db->join('transactiondetail', 'transactiondetail.transactionID = transaction.transactionID');

		$query = $this->db->get();
		return $query;
	}

	public function get_orders($id)
	{
	    $this->db->query("SET sql_mode = '' ");
		$this->db->select('transactionID, promoDisc');
		$this->db->from('transaction');
		$this->db->join('promo', 'promo.KodePromo = transaction.KodePromo');
		$this->db->where('transaction.transactionID', $id);

		$query = $this->db->get();
		// echo $id;

		return $query;
	}

	public function gettrackorder($id)
	{
		$this->db->distinct();
		$this->db->select('transaction.transactionID, transactionDate, itemName, itemDetail.itemPrice, itemQuantity, itemImage, Address, kota, provinsi, TotalTransaksi, status_id, Status, Progress, transaction.BuktiPayment');
		$this->db->from('transaction');
		$this->db->join('transactiondetail', 'transactiondetail.transactionID = transaction.transactionID');
		$this->db->join('itemDetail', 'itemDetail.itemDetailID = transactiondetail.itemDetailID');
		$this->db->join('itemData', 'itemData.itemID = itemDetail.itemID');
		$this->db->join('receiver', 'receiver.receiverID = transaction.receiverID');
		$this->db->join('kota', 'receiver.kotaID = kota.kotaID');
		$this->db->join('provinsi', 'kota.provinsiID = provinsi.provinsiID');
		$this->db->join('status', 'transaction.transactionStatus = status.status_id');
		$this->db->where('transaction.user_id', $id);
		$this->db->where('transaction.transactionStatus !=', 5);
		$this->db->group_by('transaction.transactionID');
		$this->db->order_by('transaction.transactionID', 'DESC');

		$query = $this->db->get();

		return $query;
	}

	public function get_invoicedata($id)
	{
		$this->db->distinct();
		$this->db->select('itemName, itemDetail.itemPrice, itemQuantity, itemImage, totalTransaksi, deliveryFee');
		$this->db->from('transactiondetail');
		$this->db->join('transaction', 'transactiondetail.transactionID = transaction.transactionID');
		$this->db->join('receiver', 'receiver.receiverID = transaction.receiverID');
		$this->db->join('DeliveryService', 'receiver.DeliveryServiceID = DeliveryService.DeliveryServiceID');
		$this->db->join('paymentmethod', 'paymentmethod.paymentMethodID = paymentmethod.paymentMethodID');
		$this->db->join('itemDetail', 'itemDetail.itemdetailID = transactiondetail.itemdetailID');
		$this->db->join('itemData', 'itemData.itemID = itemDetail.itemID');
		$this->db->where('transaction.transactionID', $id);

		$query = $this->db->get();
		return $query;
	}

	public function get_images($id)
	{
		$this->db->distinct();
		$this->db->select('itemImage');
		$this->db->from('transaction');
		$this->db->join('transactiondetail', 'transactiondetail.transactionID = transaction.transactionID');
		$this->db->join('itemDetail', 'itemDetail.itemDetailID = transactiondetail.itemDetailID');
		$this->db->join('itemData', 'itemData.itemID = itemDetail.itemID');
		$this->db->join('status', 'transaction.transactionStatus = status.status_id');
		$this->db->where('transaction.user_id', $id);
		$this->db->where('transaction.transactionStatus !=', 5);
		// $this->db->group_by('transaction.transactionID');
		$this->db->order_by('transaction.transactionID', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	public function ShowShoppingCart($id)
	{
		$this->db->trans_begin();

		$this->db->select('shoppingcartID, shoppingcart.KodePromo, itemDetail.itemDetailID, itemName, itemImage, itemPrice, itemColorName, itemSizeName, itemQuantity, itemDiscount');
		$this->db->from('shoppingcart');
		$this->db->join('itemDetail', 'itemDetail.itemDetailID = shoppingcart.itemDetailID');
		$this->db->join('itemData', 'itemData.itemID = itemDetail.itemID');
		$this->db->join('itemColor', 'itemDetail.itemColorID = itemColor.itemColorID');
		$this->db->join('itemsize', 'itemDetail.itemSizeID = itemsize.itemSizeID');
		$this->db->where('shoppingcart.user_id', $id);


		$query = $this->db->get();

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
		}
		return $query->result();
	}

	public function AddReceiver($name, $address, $zipcode, $kota, $deliveryservice, $paymentmethod)
	{
		$this->db->trans_begin();

		$value = array(
			'receivername' => $name,
			'address' => $address,
			'zip' => $zipcode,
			'kotaID' => $kota,
			'deliveryserviceID' => $deliveryservice,
			'paymentmethodID' => $paymentmethod
		);
		$this->db->insert('receiver', $value);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
		}
	}

	public function AddProducttoTransaction($id, $data, $receiver, $promo, $totalsemua)
	{
		$this->db->trans_begin();
		$total = 0;
		foreach ($data as $row) {
			$total +=  $row->itemQuantity * $row->itemPrice;
			$promos = $row->KodePromo;
		}

		foreach ($promo as $row) {
			if ($promos == $row['KodePromo']) {
				$promodisc = $row['PromoDisc'];
				break;
			}
		}

		$date = date('y-m-d');

		$value = array(
			'user_id' => $id,
			'ReceiverID' => $receiver['ReceiverID'],
			'KodePromo' => $promos,
			'transactionStatus' => 1,
			'TotalTransaksi' => $totalsemua,
			'transactionDate' => $date
		);

// 		$this->db->insert('transaction', $value);
$receiverID = $receiver['ReceiverID'];
        $this->db->query("INSERT INTO transaction(user_id, receiverID, KodePromo, transactionStatus, TotalTransaksi, transactionDate)  VALUES($id, $receiverID, '$promos', 1, $totalsemua, '$date')");
        
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
		}
	}

	public function AddTransactionDetail($data, $trns_id)
	{
		foreach ($data as $row) {
		    $this->db->trans_begin();
			$detail = array(
				'transactionID' => $trns_id,
				'itemDetailID' => $row->itemDetailID,
				'itemQuantity' => $row->itemQuantity,
				'itemPrice' => $row->itemPrice
			);
			$this->db->insert('transactiondetail', $detail);
			
    		if ($this->db->trans_status() === FALSE) {
    			$this->db->trans_rollback();
    			return FALSE;
    		} else {
    			$this->db->trans_commit();
    		}
		}
	}

	public function AddInvoice($id)
	{
	    $this->db->trans_begin();
		$date = date('y-m-d');

		$value = array(
			'InvoiceDate' => $date,
			'transactionID' => $id
		);

		$this->db->insert('invoice', $value);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
		}
	}

	public function getpromo()
	{
		$query = $this->db->query("SELECT * FROM promo");

		return $query->result_array();
	}

	public function hapus($data, $user)
	{
		$query = $this->db->query("DELETE FROM shoppingcart WHERE user_id = $user");

		return $query;
	}

	// public function getRating($itemID)
	// {
	// 	$rat = $this->db->query("SELECT ROUND(AVG(rating),1) FROM comment WHERE CommentStatus='0' AND itemID='$itemID'");
	// 	return $rat->row_array();
	// }

	public function getRating($itemID)
	{
		$this->db->select('ROUND(AVG(itemData.itemRating),1)');
		$this->db->from('comment');
		$this->db->where('CommentStatus', 0);
		$this->db->where('comment.itemID', $itemID);
        $this->db->join('itemData', 'comment.itemID = itemData.itemID');
		
		$rat = $this->db->get();
		return $rat->row_array();
	}
	
	public function getComment($itemID)
	{
		$this->db->select('comment.*, itemData.itemRating');
		$this->db->from('comment');
		$this->db->where('CommentStatus', 0);
		$this->db->where('comment.itemID', $itemID);
        $this->db->join('itemData', 'comment.itemID = itemData.itemID');
		
		$query = $this->db->get();
		return $query->result();
	}

	public function view()
	{
		return $this->db->get('provinsi')->result(); // Tampilkan semua data yang ada di tabel provinsi
	}

	public function viewByProvinsi($id_provinsi)
	{
		$this->db->where('provinsiID', $id_provinsi);
		$result = $this->db->get('kota')->result(); // Tampilkan semua data kota berdasarkan id provinsi

		return $result;
	}
}
