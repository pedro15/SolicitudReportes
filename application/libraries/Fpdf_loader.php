<?php
defined('BASEPATH') OR exit('No esta permitido el acceso directo al script.');

class Fpdf_loader 
{	
	public function __construct() 
    {
		require_once APPPATH.'third_party/fpdf/fpdf.php';
		
		$pdf = new FPDF();
		$pdf->AddPage();
		
		$CI =& get_instance();
		$CI->fpdf = $pdf;		
	}	
}