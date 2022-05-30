<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Frontend\FrontendModel;

class Template extends BaseController
{
	protected $frontendModel;

	function __construct()
	{
		$this->frontendModel = new FrontendModel;	
	}

	public function index() {
		return view('frontend/frontend_dashboard');
	}

	public function templatelist() {
		$categeory_id = $_GET['q'];
		return view('frontend/template_list',compact('categeory_id'));
	}

	public function fetch()
	{
		$this->_check_ajax();

		$response = array(
			'status' 	=> 'success',
			'records' 	=> [],
		);

		$filters 	= [];
		$page 		= 1;
		$export 	= 'N';

		if (!empty($_GET)) {
			$categeory_id[] = $_GET['categeory_id'];
			$filters["slug"] = $categeory_id;
		}

		// if (!empty($categeory_id)) {
		// 		$filters["slug"] = $categeory_id;
		// 	}

		if (strtolower($this->request->getMethod()) == 'post') {
			$response['token'] = csrf_hash();
			$page 		= preg_replace('#[^0-9]#', '', $this->request->getPost('page'));
			$keyword 	= preg_replace('#[^a-zA-Z0-9\s\-\.]#', '', $this->request->getPost('filter_keyword'));
			$tag 		= preg_replace('#[^a-zA-Z0-9\s\-\.]#', '', $this->request->getPost('checkedTags'));
			if (!empty($keyword)) {
				$filters["slug"] = $keyword;
			}
			if (!empty($tag)) {
				$filters["tag"] = $tag;
			}
		}
		
		$start 				 	= (($page - 1) * PAGE_LIMIT_TEMP);
		$records 			 	= $this->frontendModel->getTemplateData($filters, $start);
		$categeory 			 	= $this->frontendModel->getCategeoryList();
		$tag 			 		= $this->frontendModel->getTagList();
		$response['records'] 	= $records;
		$response['categeory'] 	= $categeory;
		$response['tag'] 		= $tag;
		return $this->response->setJSON($response);
	}

	public function details($id)
	{
		if (!empty($id)) {
			$template_detail['template'] = $this->frontendModel->getTemplateDetail($id);
			if (!empty($template_detail)) {
				return view('frontend/template_detail', $template_detail);
			}
		}
	}

	public function msgdisplay()
	{
		if ($this->request->getMethod() == 'post') {
			$msg = $this->request->getPost('msg');
			$imgpath = $this->request->getPost('imgpath');

			header('content_type:image/jpeg');
			$font="BRUSHSCI.TTF";
			$image = imagecreatefromjpeg($imgpath);
			$color = imagecolorallocate($image, 19, 21, 22);
			$message = $msg;
			imagettftext($image, 50, 0, 365, 420, $color, $font, $message);
			$date = date("d-m-Y");
			imagettftext($image, 20, 0, 450, 595, $color, 'AGENCYR.TTF', $date);
			imagejpeg($image);
			imagedestroy($img);
			print_r($msg);
			print_r($imgpath);die;
		}
	}

	function getmsg_working() {
		$src 		= $this->request->getPost('src');
		$position 	= $this->request->getPost('position');
		$txt 		= $this->request->getPost('msg');

		$img = imagecreatefromjpeg($src);

		$txt = mb_convert_encoding($txt, "HTML-ENTITIES", "UTF-8");
		$txt = preg_replace('~^(&([a-zA-Z0-9]);)~', htmlentities('${1}'), $txt);

		$lines = explode('|', wordwrap($txt, 47, '|'));

		// (C) WRITE TEXT TO IMAGE
		$fontFile 	= "C:\Windows\Fonts\simsun.ttc"; // CHANGE TO YOUR OWN!
		$fontSize 	= 13;
		$fontColor 	= imagecolorallocate($img, 0, 0, 0);

		if ($position == 'top') {
			$posX 		= 10;
			$posY 		= 30;
		} else if($position == 'bottom') {
			$posX 		= 10;
			$posY 		= 400;
		} else {
			$posX 		= 10;
			$posY 		= 550;
		}
		$angle 		= 0;

		// (D) WRITE UTF-8 TEXT
		foreach ($lines as $line)
		{
		    // imagettftext($image, $font_size, 0, 50, $y, $font_color, $font, $line);
		    imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $line);

		    // Increment Y so the next line is below the previous line
		    $posY += 23;
		}

		//new line 15/12/21
		// $logo = imagecreatefromjpeg(base_url('assets/frontend/img/logo.jpg'));
		// imagecopymerge($img, $logo, 10, 550, 0, 0, 90, 89, 75);
		
		// (E) OUTPUT IMAGE
		header("Content-type: image/jpeg");

		$img_name = 'images/'.date('ymdhis').'.jpg';
		$result = imagejpeg($img,$img_name);

		//
		$data = [
			'name' 		=> user()->name,
			'userid' 	=> user()->email,
			'thumbnail' => $img_name,
		];
		$template_detail = $this->frontendModel->addNewaTemplate($data);
		if (!empty($template_detail)) {
			if ($result == true) {
				return base_url($img_name);
			}

			imagedestroy($img);
		}
	}


	// function getmsg() {
	// 	$src 		= $this->request->getPost('src');
	// 	$position 	= $this->request->getPost('position');
	// 	$txt 		= $this->request->getPost('msg');

	// 	$email = user()->email;
	// 	$company_profile = $this->frontendModel->getCompanyProfile($email);
	// 	if ($company_profile->company_logo) {
	// 		$cLogo 	= base_url('filereader/fetchfile/').'/'. $company_profile->company_logo;

	// 		list($logoWidth, $logoHeight, $logoType, $logoAttr) = getimagesize($cLogo);

	//         $logo = imagecreatefromjpeg($cLogo);
	// 	} else {
	// 		$logoHeight = 0;
	// 	}

	//     $img  = imagecreatefromjpeg($src);
	//     list($imgWidth, $imgHeight, $imgType, $imgAttr) = getimagesize($src);

	// 	// echo '<pre>';print_r($imgHeight);
	// 	// echo '<pre>';print_r($imgWidth); die;

	// 	if ($position == 'top') {
 //            $posX       = 5;
 //            $posY       = 20;
 //            $logoX     	= 0;

 //            switch ($imgHeight) {
	// 			case $imgHeight >=0 && $imgHeight <=100:
	// 	            $logoY     	= $imgHeight - $logoHeight;	
	// 		 	break;

	// 		 	case $imgHeight >=101 && $imgHeight <=200:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;

	// 		 	case $imgHeight >=201 && $imgHeight <=300:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;

	// 		 	case $imgHeight >=301 && $imgHeight <=400:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;

	// 		 	case $imgHeight >=401 && $imgHeight <=500:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;

	// 		 	case $imgHeight >=501 && $imgHeight <=600:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;

	// 		 	case $imgHeight >=601 && $imgHeight <=700:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;

	// 		 	case $imgHeight >=701 && $imgHeight <=800:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;

	// 		 	case $imgHeight >=801 && $imgHeight <=900:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;

	// 		 	case $imgHeight >=901 && $imgHeight <1000:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		 	break;
	// 			default:
	// 	            $logoY     	= $imgHeight - $logoHeight;
	// 		}
 //        } else {
 //        	$posX       = 5;
 //            $logoX      = 0;
	// 	    $logoY      = 0;
 //            switch ($imgHeight) {
	// 			case $imgHeight >=0 && $imgHeight <=100:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=101 && $imgHeight <=200:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=201 && $imgHeight <=300:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=301 && $imgHeight <=400:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=401 && $imgHeight <=500:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=501 && $imgHeight <=600:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=601 && $imgHeight <=700:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=701 && $imgHeight <=800:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=801 && $imgHeight <=900:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;

	// 		 	case $imgHeight >=901 && $imgHeight <1000:
	// 		 		$posY       = $imgHeight - 100;
	// 		 	break;
	// 		 	default:
	// 		 		$posY       = $imgHeight - 100;
	// 		}
 //        }


	// 	// echo '<pre>';print_r($x);
	// 	// echo '<pre>';print_r($height); die;

	//     $txt = 'The host header specifies which website or web application should process an incoming HTTP request. The web server uses the value of this header to dispatch the request to the specified website or web.';

	//     $txt 		= mb_convert_encoding($txt, "HTML-ENTITIES", "UTF-8");
	//     $txt 		= preg_replace('~^(&([a-zA-Z0-9]);)~', htmlentities('${1}'), $txt);
	//     $lines 		= explode('|', wordwrap($txt, 47, '|'));
	//     $fontFile  	= "C:\Windows\Fonts\simsun.ttc"; // CHANGE TO YOUR OWN!
 //        $fontColor  = imagecolorallocate($img, 0, 0, 0);
 //        $fontSize   = 13;
 //        $angle      = 0;
 //        // logo add config
 //        $imgX       = 0;
 //        $imgY       = 0;
 //        $pct 		= 100;

 //        foreach ($lines as $line)
 //        {
 //            imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $line);
 //            $posY += 19;
 //        }

 //        if (!empty($company_profile->company_logo)) {
 //        	imagecopymerge($img, $logo, $logoX, $logoY, $imgX, $imgY, $logoWidth, $logoHeight, $pct);
 //        }

 //        // Output and free from memory
 //        header('Content-Type: image/jpeg');

 //        $img_name = 'images/'.date('ymdhis').'.jpg';
	// 	$result = imagejpeg($img,$img_name);

	// 	$data = [
	// 		'name' 		=> user()->name,
	// 		'userid' 	=> user()->email,
	// 		'thumbnail' => $img_name,
	// 	];
	// 	$template_detail = $this->frontendModel->addNewaTemplate($data);
	// 	if (!empty($template_detail)) {
	// 		if ($result == true) {
	// 			return base_url($img_name);
	// 		}

	// 		imagedestroy($img);
	// 	}
	// }

	function getmsg() {
		$src 		= $this->request->getPost('src');
		$position 	= $this->request->getPost('position');
		$txt 		= $this->request->getPost('msg');
		$font 		= $this->request->getPost('fontsize');

		$email = user()->email;
		$company_profile = $this->frontendModel->getCompanyProfile($email);
		if ($company_profile->company_logo) {
			$cLogo 	= base_url('filereader/fetchfile/').'/'. $company_profile->company_logo;

			list($logoWidth, $logoHeight, $logoType, $logoAttr) = getimagesize($cLogo);

	        $logo = imagecreatefromjpeg($cLogo);
		} else {
			$logoHeight = 0;
		}

	    $img  = imagecreatefromjpeg($src);
	    list($imgWidth, $imgHeight, $imgType, $imgAttr) = getimagesize($src);

		// echo '<pre>';print_r($imgHeight);
		// echo '<pre>';print_r($imgWidth); die;

	    $txt = 'The host header specifies which website or web application should process an incoming HTTP request. The web server uses the value of this header to dispatch the request to the specified website or web.';

	    $txt 		= mb_convert_encoding($txt, "HTML-ENTITIES", "UTF-8");
	    $txt 		= preg_replace('~^(&([a-zA-Z0-9]);)~', htmlentities('${1}'), $txt);
	    $lines 		= explode('|', wordwrap($txt, 47, '|'));
	    $fontFile  	= "C:\Windows\Fonts\simsun.ttc"; // CHANGE TO YOUR OWN!
        $fontColor  = imagecolorallocate($img, 0, 0, 0);
        // $fontSize   = 13;
        $fontSize   = $font;
        $angle      = 0;

        // logo add config
        if ($position == 'top') {
        	$posX       = 5;
            $posY       = 20;

            //logo config
            $logoX      = 0;
            $logoY      = $imgHeight - $logoHeight;;
            $imgX       = 0;
            $imgY       = 0;
            $imgWidth   = $logoWidth;
            $imgHight   = $logoHeight;
            $pct 		= 100;
        } else {
        	$posX       = 5;
            $posY       = $imgHeight - 100;

            //logo config
            $logoX     	= 0;
            $logoY     	= 0;
            // $logoY     	= $imgHeight - 100;
            $imgX     	= 0;
            $imgY     	= 0;
            $imgWidth  	= $logoWidth;
            $imgWidth  	= $logoHeight;
            $imgHight  	= 20;
            $pct 		= 100;
        }

        foreach ($lines as $line)
        {
            imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $line);
            $posY += 19;
        }

        if (!empty($company_profile->company_logo)) {
        	imagecopymerge($img, $logo, $logoX, $logoY, $imgX, $imgY, $logoWidth, $logoHeight, $pct);
        }

        // Output and free from memory
        header('Content-Type: image/jpeg');

        $img_name = 'newtemplates/'.date('ymdhis').'.jpg';
		$result = imagejpeg($img,$img_name);

		$data = [
			'name' 		=> user()->name,
			'userid' 	=> user()->email,
			'thumbnail' => $img_name,
		];
		$template_detail = $this->frontendModel->addNewaTemplate($data);
		if (!empty($template_detail)) {
			if ($result == true) {
				return base_url($img_name);
			}

			imagedestroy($img);
		}
	}

	public function demo() {

		// print_r('sachin');die;

		$logo = base_url('assets/frontend/img/old.jpg');
		// $img = base_url('assets/frontend/img/old.jpg');
		$img = base_url('assets/frontend/img/testing/1.jfif');
		$img = base_url('assets/frontend/img/testing/11.jpg');

		// // Calling getimagesize() function
		list($width, $height, $type, $attr) = getimagesize($img);

		list($Lwidth, $Lheight, $Ltype, $Lattr) = getimagesize($logo);
		

		// echo '<br>';print_r($Lwidth);
		// echo '<br>';print_r($Lheight);
		// echo '<br>';print_r($Ltype);
		// echo '<br>';print_r($Lattr);die;

		// $height=31;

		$x;
		$Ly;

		switch ($height) {
		case $height >=0 && $height <=100:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=101 && $height <=200:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=201 && $height <=300:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=301 && $height <=400:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=401 && $height <=500:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=501 && $height <=600:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=601 && $height <=700:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=701 && $height <=800:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=801 && $height <=900:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 case $height >=901 && $height <1000:
		 	$x = '10';
		 	$Ly = $height - $Lheight;
		 break;

		 default:
		 	$x 	= '';
		 	$Ly = '';
		}

		echo '<pre>';print_r($x);
		echo '<pre>';print_r($Ly);die;
			// echo '<br>';

		// Displaying dimensions of the image
		echo "Width of image : " . $width . "<br>";
		  
		echo "Height of image : " . $height . "<br>";
		  
		echo "Image type :" . $type . "<br>";
		  
		echo "Image attribute :" .$attr;
	}

	public function demodata() {
		 // Create image instances
	        // $dest = imagecreatefromjpeg(base_url('public/uploads/photo.jpg'));
	        // $src = imagecreatefromjpeg(base_url('public/uploads/logo.jpg'));
	    // imagecopymerge($dest, $src, 10, 10, 0, 0, 200, 100, 75);
	    // imagecopymerge($dest, $src, 10, 10, 0, 0, 90, 90, 75);
		$position = 'top';
		// $position = 'bottom';
		$cLogo = base_url('assets/frontend/img/old.jpg');
		// $cLogo = base_url('assets/frontend/img/testing/download.jpg');
		$image = base_url('assets/frontend/img/testing/7.jfif');
		// $image = base_url('assets/frontend/img/testing/11.jpg');

	    // $image = base_url('public/uploads/photo.jpg');
	    // $cLogo = base_url('public/uploads/logo.jpg');

	    $img = imagecreatefromjpeg($image);
	    $logo = imagecreatefromjpeg($cLogo);

	    list($imgWidth, $imgHeight, $imgType, $imgAttr) = getimagesize($image);

		list($logoWidth, $logoHeight, $logoType, $logoAttr) = getimagesize($cLogo);

		// echo '<pre>';print_r($imgHeight);
		// echo '<pre>';print_r($imgWidth); die;

		// if ($position == 'top') {
  //           $posX       = 5;
  //           $posY       = 20;
  //           $logoX     	= 10;

  //           switch ($imgHeight) {
		// 		case $imgHeight >=0 && $imgHeight <=100:
		//             $logoY     	= $imgHeight - $logoHeight;	
		// 	 	break;

		// 	 	case $imgHeight >=101 && $imgHeight <=200:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;

		// 	 	case $imgHeight >=201 && $imgHeight <=300:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;

		// 	 	case $imgHeight >=301 && $imgHeight <=400:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;

		// 	 	case $imgHeight >=401 && $imgHeight <=500:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;

		// 	 	case $imgHeight >=501 && $imgHeight <=600:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;

		// 	 	case $imgHeight >=601 && $imgHeight <=700:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;

		// 	 	case $imgHeight >=701 && $imgHeight <=800:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;

		// 	 	case $imgHeight >=801 && $imgHeight <=900:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;

		// 	 	case $imgHeight >=901 && $imgHeight <1000:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	 	break;
		// 	 default:
		//             $logoY     	= $imgHeight - $logoHeight;
		// 	}
  //       } else {
  //       	$posX       = 5;
  //           $logoX      = 10;
		//     $logoY      = 0;
  //           switch ($imgHeight) {
		// 		case $imgHeight >=0 && $imgHeight <=100:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=101 && $imgHeight <=200:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=201 && $imgHeight <=300:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=301 && $imgHeight <=400:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=401 && $imgHeight <=500:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=501 && $imgHeight <=600:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=601 && $imgHeight <=700:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=701 && $imgHeight <=800:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=801 && $imgHeight <=900:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;

		// 	 	case $imgHeight >=901 && $imgHeight <1000:
		// 	 		$posY       = $imgHeight - 100;
		// 	 	break;
		// 	 default:
		// 	 		$posY       = $imgHeight - 100;
		// 	}
  //       }

        // echo '<pre>';print_r($imgHeight);
		// echo '<pre>';print_r($imgWidth); die;


		// echo '<pre>';print_r($x);
		// echo '<pre>';print_r($height); die;
	    
	    // $txt = 'The host header specifies which website or web application should process an incoming HTTP request. The web server uses the value of this header to dispatch the request to the specified website or web application. Each web application hosted on the same IP address is commonly referred to as a virtual host. Most web servers are configured to pass the unrecognized host header to the first virtual host in the list. Therefore, it’s possible to send requests with arbitrary host headers to the first virtual host.';

	    $txt = 'The host header specifies which website or web application should process an incoming HTTP request. The web server uses the value of this header to dispatch the request to the specified website or web.';

	    $txt 		= mb_convert_encoding($txt, "HTML-ENTITIES", "UTF-8");
	    $txt 		= preg_replace('~^(&([a-zA-Z0-9]);)~', htmlentities('${1}'), $txt);
	    $lines 		= explode('|', wordwrap($txt, 47, '|'));
	    $fontFile  	= "C:\Windows\Fonts\simsun.ttc"; // CHANGE TO YOUR OWN!
        $fontSize   = 13;
        $fontColor  = imagecolorallocate($img, 0, 0, 0);

        if ($position == 'top') {
            $posX       = 5;
            $posY       = 20;
        } else if($position == 'bottom') {
            $posX       = 5;
            $posY       = $imgHeight - 100;
            // $posY       = 550;
        } else {
            $posX       = 10;
            $posY       = 550;
        }
        $angle      = 0;

        // logo add config
        $imgX       = 0;
        $imgY       = 0;
        $pct 		= 100;

        foreach ($lines as $line)
        {
            imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $line);
            $posY += 19;
        }

        // start add company logo
       
        
        if ($position == 'top') {
            $logoX       	= 10;
            // $logoY       	= 500;
            $logoY       	= $imgHeight - $logoHeight;;
            $imgX       	= 0;
            $imgY       	= 0;
            $imgWidth       = $logoWidth;
            $imgHight       = $logoHeight;
            $pct 			= 100;
        } else {
            $logoX       	= 10;
            $logoY       	= 0;
            // $logoY       	= $imgHeight - 100;
            $imgX       	= 0;
            $imgY       	= 0;
            $imgWidth       = $logoWidth;
            $imgWidth       = $logoHeight;
            $imgHight       = 20;
            $pct 			= 100;
        }

        imagecopymerge($img, $logo, $logoX, $logoY, $imgX, $imgY, $logoWidth, $logoHeight, $pct);
        // Copy and merge
  //       $email = user()->email;
		// $company_profile = $this->frontendModel->getCompanyProfile($email);

		// if ($company_profile->company_logo) {
		// 	// $logo 	= base_url('assets/frontend/img/old.jpg');
	 //        // $logo = imagecreatefromjpeg($logo);
	 //        imagecopymerge($img, $logo, $desX, $desY, $srcX, $srcY, $srcWidth, $srcHight, $pct);
		// } // end add company logo

	    // $fontFile     = "C:\Windows\Fonts\simsun.ttc"; // CHANGE TO YOUR OWN!
	    // $fontSize     = 15;
	    // $fontColor     = imagecolorallocate($img, 255, 255, 255);
	    // $posX         = 0;
	    // $posY         = 50;
	    // $angle         = 0;

	    // foreach ($lines as $line)
	    // {
	    //     imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $line);
	    //     $posY += 23;
	    // }

	    // Copy and merge
	    // imagecopymerge($img, $logo, 10, 500, 0, 0, 90, 90, 75);
	      
	    // Output and free from memory
	    header('Content-Type: image/gif');
	    print_r(base64_encode(imagejpeg($img)));die;

	    imagegif($dest);
	      
	    imagedestroy($dest);
	    imagedestroy($src);
	    

	    // // Create a image
	    // $im = imagecreatetruecolor(800, 250);
	     
	    // // Set the background to be light blue
	    // imagefilledrectangle($im, 0, 0, 800, 299,
	    //             imagecolorallocate($im, 255, 0, 100));
	     
	    // // Create bounding box with local font file
	    // $bbox = imagettfbbox(10, 0,
	    //             'C:\Windows\Fonts\simsun.ttc', 'GeeksforGeekss-da-sachin-sachin-kapate');
	     
	    //  // print_r($bbox);die;
	    // // Calculate coordinates using bounding box
	    // $x = $bbox[0] + 0;
	    // $y = $bbox[1] + 50;
	     
	    // // Add text
	    // imagettftext($im, 20, 0, $x, $y,
	    //         imagecolorallocate($im, 0, 122, 56),
	    //         'C:\Windows\Fonts\simsun.ttc', 'aaaaaa-bbbb-cccccc-dddddd-eeeeee-ffffff');
	     
	    // // Output to browser
	    // header('Content-Type: image/png');
	    // imagepng($im);
	    // print_r(base64_encode(imagejpeg($im)));die;
	    // imagedestroy($im);de(imagejpeg($im)));die;
	}

	public function api() {
		return view('frontend/web');
	}

}	