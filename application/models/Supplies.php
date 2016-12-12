<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define('REST_SERVER', 'http://backend.local');  // the REST server host
define('REST_PORT', $_SERVER['SERVER_PORT']);   // the port you are running the server on

class Supplies extends CI_Model {

    // Default Constructor
    public function __construct()
    {
            parent::__construct();
		//*** Explicitly load the REST libraries. 
		$this->load->library(['curl', 'format', 'rest']);
    }

    // Grab all of the supply data
    public function get_all()
    {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->get('/receiving');
    }

    // Get one supply item
    public function get_one($key, $key2 = null)
    {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->get('/receiving/item/id/' . $key);
    }
    
    // Get the description of the supply
    public function get_description($name)
    {
        // find the correct supply name, return the supply description
        foreach($this->supplies as $supply)
        {
            if($supply['name'] == $name)
            {
                return $supply['description'];
            }
        }
    }
    
    // Get the price of the supply
    public function get_price($name)
    {
        // find the correct supply name, return the supply price
        foreach($this->supplies as $supply)
        {
            if($supply['name'] == $name)
            {
                return $supply['price'];
            }
        }
    }
    
    // Get the quantity of the supply
    public function get_quantity($name)
    {
        // find the correct supply name, return the supply quantity
        foreach($this->supplies as $supply)
        {
            if($supply['name'] == $name)
            {
                return $supply['quantity'];
            }
        }
    }
        
    // Set the description of the supply item
    public function set_description($name, $description)
    {
        // find the correct supply name, set the supply description
        foreach($this->supplies as $supply)
        {
            if($supply['name'] == $name)
            {
                $supply['description'] = $description;
            }
        }
    }
    
    // Set the price of the supply item
    public function set_price($name, $price)
    {
        // find the correct supply name, set the supply price
        foreach($this->supplies as $supply)
        {
            if($supply['name'] == $name)
            {
                $supply['price'] = $price;
            }
        }
    }
    
/**
     * Sets or modifes the quanitity of a Supply item.
     * @param type $name The name of the Supply item
     * @param type $mode Add, Minus, or Equal
     * @param type $quantity Set the quantity of the Supply item
     */
    public function set_quantity($id, $quantity)
    {
        
        
        
        
        $result = $this->rest->put('/receiving/item/id/' . $key, $value);
        echo($result);
        
        /*
        // find the correct supply name, set the quantity
        foreach($this->supplies as $supply)
        {
            if($supply['name'] == $name)
            {
                // Add, Minus, or Equal the value to the quantity amount.
                switch($mode)
                {
                    case 'add':
                        $supply['quantity'] += $quantity;
                        break;
                    case 'minus':
                        $supply['quantity'] -= $quantity;
                        break;
                    case 'equal':
                        $supply['quantity'] = $quantity;
                        break;
                }
            }
        }
         */
    }
  
}
