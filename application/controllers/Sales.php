<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Application
{

	/**
	* The sales controller.
	* Show a menu of purchaseable items, with description & price for each.
	*
	*/
	public function index()
	{                    
		$this->data['pagebody'] = 'sales';
		//the supplies
		$supplies = $this->supplies->get_all();
                $suppliesJSON = json_decode(json_encode($supplies), True);
		//the stocks
		$stocks = $this->stocks->get_all();
                $stocksJSON = json_decode(json_encode($stocks), True);

		//go through supplies
		foreach ($suppliesJSON as $supply)
		{
			//add supply info
			$standalone[] = array('supply' => $supply['name'], 'description' => $supply['description'], 'price' => $supply['price'], 'link' => $supply['link']);
		}
		//go through services
		foreach ($stocksJSON as $stock)
		{
			//add service info
			$bundle[] = array('service' => $stock['name'], 'description' => $stock['description'], 'price' => $stock['price']);
		}
		//add both supplies and services
		$this->data['sales'] = array(array('supplies' => $standalone, 'services' => $bundle));
		$this->render();
	}

	/**
	* Display a product.
	* 
	*
	*/
	public function product($id)
	{
		$this->data['pagebody'] = 'item';
		$product = $this->supplies->get_one($id);
		$this->data = array_merge($this->data, $product);
		$this->render();
	}

	/**
	* Display a service.
	*
	*
	*/
	public function service($id)
	{
		$this->data['pagebody'] = 'item';
		$services = $this->services->get_one($id);
		$this->data = array_merge($this->data, $services);
		$this->render();
	}

	/**
	* Updates database with purchases.
	*
	*
	*/
	public function purchase()
	{
		//results returned from POST
		$results = $this->input->post();

		//go through results and add the quanity specified to the stocks
		foreach ($results as $service)
		{
			//add function in model to add to stock of selected service
			$data->stock->set_quantity($service['name'], "minus", $service['quantity']);
		}

		//return message upon successful purchase
	}
}
