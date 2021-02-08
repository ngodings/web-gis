<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peta extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		$this->load->library('leaflet');
	}
	
	public function index()
	{
		//memakai libraries
		$config = array(
			'center'         => '-7.5775527, 110.825103', // Center of the map
			'zoom'           => 12, // Map zoom
			);
		$this->leaflet->initialize($config);
		
		$marker = array(
			'latlng' 		=>'-7.5775527, 110.825103', // Marker Location
			'popupContent' 	=> 'Hi, iam a popup!!', // Popup Content
			);
			$this->leaflet->add_marker($marker);
		
	   
		$data['map'] =  $this->leaflet->create_map();
		
		$this->load->view('v_peta', $data); //ini menggunakan libraries
		
	}
}
