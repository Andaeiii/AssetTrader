<?php

	DEFINE('DS', DIRECTORY_SEPARATOR);
	DEFINE('site_name', 'Assets Management');
	DEFINE('site_url', 'http://www.sftasets.com');
	DEFINE('site_desc', 'tailor3ed for the this and that..');

	
	function pr($ar, $bool=true){
		echo '<pre>';
		print_r($ar);
		echo '</pre>';

		if($bool){
			exit;
		}
	}

	function rdate($dt, $type){

		switch($type){
			case 'long':
				$dt = date("D, M jS, Y", strtotime($dt)); //, 'F jS, Y');
			break;
			case 'short':
				$dt = date("M d, y", strtotime($dt)); //, 'F jS, Y');
			break;
			case 'medium':
				$dt = date("D - M d, Y", strtotime($dt)); //, 'F jS, Y');
			break;
			case 'full':
				$dt = date("D, M jS, Y", strtotime($dt)); //, 'F jS, Y');
			default:
				$dt = date("F jS, Y", strtotime($dt)); //, 'F jS, Y');
		}

		if (strpos($dt, '70') !== false) {
		    return '-- -- --';
		}else{
			return $dt;
		}
	}

	function cleanHtml($html){
		//return $html;
		 return preg_replace('~>\s+<~', '><', $html);
	}

	function chkVal($v){
		$v = trim($v);
		if(!empty($v)){
			return $v;
		}else{
			return '  --- ---- ---- ---  ';
		}
	}

	

	function mkStars($r){
		$arr = array(
				'poor' => 1,
				'average' => 2,
				'good' => 3,
				'verygood' => 4,
				'excellent' => 5
			);

		$intx = intval($arr[strtolower($r)]);
		$st = '';
		for($i=0; $i<$intx; $i++){
			$st .= '<img src="/imgs/star.png" align="absmiddle" title="' . $r . '" width="15"/>';
		}
		$st .= '&nbsp;&nbsp';

		//return stars....
		return $st;
	}



	function mkYNOptions($title, $name, $ans){

		$ar = explode(';','true;false');

		$radiooptns = ' <div class="form-group"><label>'. $title .'</label> <br/>';

		foreach($ar as $opt){
		  $el = (boolval($opt) == boolval($ans)) ? 'checked' : '';
		  //echo '<br/>state '. $opt .' = ' .  $el;
		  $radiooptns .= '<input type="radio" name="'.$name.'" value="'. $opt .'"'.$el.'> '. strval($opt) .' &nbsp;';
		}

		//exit;
        $radiooptns .= '</div>';

        return $radiooptns;

	}


	function elapsedTime($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		if (20 > $diff->days / 7) {
		    $diff->y = $diff->m = $diff->h = $diff->i = $diff->s = 0;
		    $diff->w = floor($diff->days / 7);
		    $diff->d = $diff->days - $diff->w * 7;
		} else {
		    $diff->w = floor($diff->d / 7);
		    $diff->d -= $diff->w * 7;
		}

		$string = array(
		    'y' => 'year',
		    'm' => 'month',
		    'w' => 'week',
		    'd' => 'day',
		);
		foreach ($string as $k => &$v) {
		    if ($diff->$k) {
		        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		    } else {
		        unset($string[$k]);
		    }
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}