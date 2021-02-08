<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Leaflet
{
	protected $ci;
	var $tileLayer = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
	var $attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	function leaflet ($config = array())
	{
		if (count($config) > 0){
			$this->initialize ($config);
		}
	}

	function initialize ($config = array())
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}

	function add_marker ($params = array())
	{
		//membuat marker
		$marker_output = '';
		foreach ($params as $key => $value)
		{
			if (isset ($marker[$key]))
			{
				$marker[$key] = $value;
			}
		}
		array_push($this->markers, $marker_output);

	}

	function create_map()
	{
		$this->output_js= '';
		$this->output_js_contents = '';
		$this->output_html = '';
		$this->output_html .= '<div id="map" style="width:100%; height:400px;"></div>';

		$this->output_js .= '
			<script type="text/javascript">
			$(document).ready(function() {
		';

		$this->output_js_contents .= '
			var map = L.map("map", {
				center: ['.$this->center.'],
				zoom: '.$this->zoom.'
			})
		';

		$this->output_js_contents .= '
			L.tileLayer("'.$this->tileLayer.'", {
		';

		$this->output_js_contents .= "attribution: '$this->attribution'";

		$this->output_js_contents .= '
			}).addTo(map)';

		if ($this->customFunction !=""){
			$this->output_js_contents .= $this->customFunction;
		}

		if (count($this->markers)){
			foreach($this->markers as $marker){
				$this->output_js_contents .= $marker;

			}
		}
		$this->output_js .= $this->output_js_contents;
		$this->output_js .= '})';
		$this->output_js .= '</script>';

		return array ('js'=>$this->output_js, 'html'=>$this->output_html);
		
	}

}
