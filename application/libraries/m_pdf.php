<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
	Sumber : http://www.programming.smktarunabhakti.net/blog/2016/04/04/tutorial-membuat-report-pdf-mudah-dalam-php-dan-framework-codeigniter/
*/

class m_pdf {
    
    function m_pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf60/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';          
        }
         
        return new mPDF($param);
    }
}