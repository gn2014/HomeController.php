<?php
App::uses('AppController', 'Controller');

class HomesController extends AppController {
  
	var $uses = array('User','PlaceType','Place','UserMailAlert','UserMobileAlert','Room','PlaceImage','PlaceVideo','PlaceRule','RoomImage','RatingByGuest','SendCard','RoomPayment','Page','Mail','Booking','Refund','AdminFund','UnavailableDate','HelpCategory','Help','Internship','Review','ScheduledPayment','ReviewResponse');
	public $components = array('Auth','Cookie','Session','Request111Handler','Email','DATA','THmail','Map','Payment','Crypter');
	public $helpers = array('Html', 'Form','JqueryEngine','Session','Text','Time');

	function beforeFilter()
	{
		AppController::beforeFilter();
		$this->Auth->allow('aaa', 'sitemap', 'index','success','add_listing','entire_place','room','place_photo','save_photo','save_video','success','add_rules','save_rules','host_rule','list_your_space','search','map_place','rent_term','rooms_images','room_video','listing_added','main_search','custom_search','Cont_Rental_Term','show_room','page','contact_host','monthly_alert','auto_cancel','message','Get_un_av_place_id','help','help_view','help_search','internship','afterintern','neighbor','getNearGivenAddress','keywords_search','host_rating','room_details');
		
		if($this->request->params['action'] != "manual_payment"  && $this->request->params['action'] != "set_manual_payment")
		{	$this->Session->delete('month_payment');	}
		if($this->params['controller'] == 'settings' && $this->params['action'] == 'make_payment'){}
		else
		{	if(isset($_SESSION['change_term']))
			{		unset($_SESSION['change_term']);	}
				
		}
		if($this->params['controller'] == 'settings' && $this->params['action'] == 'make_move_out')
		{}
		else
		{
			if(isset($_SESSION['move_out']))
			{ unset($_SESSION['move_out']); }
				
		}
	}

	public function sitemap() {
		
		
		$products = $this->Page->find('all');
		$this->set('Rooms',$products);
		$this->layout = 'xml';
		$this->response->type('xml');

		
	}
	
	function all_page($tbl,$limit,$url_tag)
	{
			$data_tbl = ClassRegistry::init($tbl);
			$total_data=$data_tbl->find('count');
			$limit=$limit;
			$a=null;
			$i=1;
			while( $total_data > 0){
			$a[]= SITEURL.$url_tag."/page:".$i;
			
			$total_data=$total_data - $limit;
			$i++;
			}
			return $a;
	}
	public function aaa()
	{
		
	if ($this->RequestHandler->isMobile()) {
        $this->is_mobile = true;
        $this->set('is_mobile', true );
        $isMobile = $requestHandler->isMobile(); // call method
		var_dump($isMobile);
		die('aa');
     }
     die;
		
		$days = 31-30;
		$today = DATE;
		//echo "<br>";
		$aa=array();
		$fromStart = date('Y-m-d',strtotime('+30 days',strtotime($today)));
		$go = true;
		while($go){
			if(($days-30) > 0)
			{
				$aa[]=array('day'=>30,'date'=>$fromStart);
				$nextSchedule = date('j F, Y',strtotime('+ 30 days',strtotime($fromStart)));
				//echo "For 30 Days ".$nextSchedule."<br/>";
				$fromStart = date('Y-m-d',strtotime($nextSchedule));
				$days = $days-30;
				
			}
			else{
				//echo "End Date after ".$days." Days ";
				$aa[]=array('day'=>$days,'date'=>$fromStart);
				$lastDay = date('j F, Y',strtotime('+ '.$days.' days'.$fromStart));
				
				
				
				$go =false;
			}
			
		} pr($aa);
		
		
		
		/*
		echo "<br><br><br>";
		$aa=DATE;
		for($i=1;$i <= 2;$i++)
		{
		echo $nextSchedule = date('Y-m-d',strtotime('+ 30 days',strtotime($aa)));
		$aa=$nextSchedule;
		echo "<br>";
		}
		echo "11<br>";
		echo $nextSchedule = date('Y-m-d',strtotime('- 13 days',strtotime('2013-05-31'))); */
		die;
		/*$url="http://www.hdcarwallpapers.com/volkswagen-desktop-wallpapers.html";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		preg_match_all('#<div class="thumbbg"><div class="thumb"><a href="(.*?)"><p>(.*?)</p>#is', $data, $matches);
		foreach ($matches[1] as $urls)
		{
			$newurl="http://www.hdcarwallpapers.com".$urls;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $newurl);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$datas = curl_exec($ch);
			curl_close($ch);
			preg_match_all('#<h1 style="width:500px;">(.*?)</h1>#is', $datas, $matches1);
			preg_match_all('#<a target="_blank" href="/walls(.*?)" title="(.*?)"><b>Original</b></a>#is', $datas, $matches2);
			
			foreach ($matches2[1] as $aa)
			{
				$img_url="http://www.hdcarwallpapers.com/walls".$aa; 
				$name= $matches1[1][0];
				$aa=explode('.', $img_url);
					$ext = strtolower(end($aa));
					$image = file_get_contents($img_url);
						$img_name=$name.".".$ext;
						$img_path = "data/".$img_name;
						if(file_put_contents($img_path, $image))
						{
							echo "done ".$name;
						}else{ echo "error "; }
			}
		}
		
		die;*/
		/*
		$url="http://www.girlhdwalls.com/megan-fox/";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		//pr($data);
		$ht='<div class="img"><a href="/megan-fox-1882/" title="Megan Fox wallpaper"><img src="/thumbs/megan-fox/megan-fox-1882-230x130.jpg" border="0" width="230" height="130" alt="Megan Fox" /></a></div>';
		//<div class="item"><div class="img"><a title="(.*?)" href="(.*?)"><img width="230" border="0" height="130" alt="(.*?)" src="(.*?)"></a></div><div class="down">(.*?)</div><div class="arrow"></div><div class="name"><a href="(.*?)">(.*?)</a></div></div>
		preg_match_all('#<div class="img"><a href="(.*?)" title="(.*?)"><img src="(.*?)" border="0" width="230" height="130" alt="(.*?)" /></a></div>#is', $data, $matches);
		 //pr($matches[1]);die;
		foreach ($matches[1] as $urls)
		{
			$newurl="http://www.girlhdwalls.com".$urls;
			$ex=explode('-', $newurl);
			$end=end($ex);
			$filename=str_replace('/',"",$end); 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $newurl);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$datas = curl_exec($ch);
			curl_close($ch);
			
			preg_match_all('#<div class="download"><a href="(.*?)" onclick="(.*?)" target="_blank">(.*?)</a></div>#is', $datas, $matches2);
			$ab=end($matches2[1]);
			
				$img_url="http://www.girlhdwalls.com".$ab; 
				$name= 'aabb';
				$aa=explode('.', $img_url);
					$ext = strtolower(end($aa));
					$image = file_get_contents($img_url);
						$img_name=$name.".".$ext;
						$img_path = "data/".$img_name;
						if(file_put_contents($img_path, $image))
						{
							echo "done ".$name;
						}else{ echo "error "; }
						die;
			}*/
		/*
		$url="http://killerprofilecovers.com/Categories.php?ID=20";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		//pr($data);
		 
		preg_match_all('#<a href="(.*?)" style="(.*?)" id="covers"><div style="(.*?)" class="box">#is', $data, $matches);
		pr($matches[2]);
		*/
		die;
			
		
	}
		//Get STATE from Google GeoData
		function reverse_geocode($address) {
			$address = str_replace(" ", "+", "$address");
			$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
			$result = file_get_contents("$url");
			$json = json_decode($result);
			foreach ($json->results as $result)
			{
				foreach($result->address_components as $addressPart) {
					if((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types)))
					$city = $addressPart->long_name;
					else if((in_array('administrative_area_level_1', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    	$state = $addressPart->long_name;
	    	else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    	$country = $addressPart->long_name;
					}
				}

				if(($city != '') && ($state != '') && ($country != ''))
				$address = $city.', '.$state.', '.$country;
				else if(($city != '') && ($state != ''))
				$address = $city.', '.$state;
				else if(($state != '') && ($country != ''))
				$address = $state.', '.$country;
				else if($country != '')
				$address = $country;

				// return $address;
				return "$city,$state,$country  ";
			}

		public function _GetNearBy($geo=null,$radius = '20' )
		{
			$gcode=explode(',', $geo);
			$this->Session->write('defalut_map',$gcode[0].",".$gcode[1]);
				//$this->set('Cmap',$lat.",".$lng);
				
				$NearByResult = $this->Place->query("SELECT id, (((acos(sin((".$gcode[0]."*pi()/180)) * sin((lat*pi()/180)) +cos((".$gcode[1]."*pi()/180)) * cos((lat*pi()/180)) * cos(((".$gcode[1]."- lng)*pi()/180))))*180/pi())*60*1.1515) as distance FROM dev_places WHERE id!=0 having distance < $radius ORDER BY distance ASC ");
				//pr($NearByResult);die;
				if(!empty($NearByResult))
				{
				 	foreach ($NearByResult as $pid)
						{
							$pids[]=$pid['dev_places']['id'];
						}
						return $pids;
				}else { return $p_id=array('empty'=>'0'); }
		}
			
		public function neighbor()
		{
			$this->layout=false;
			if($this->RequestHandler->isAjax())
		 	 {
		  		if(!empty($this->data['geo']))
		  		{
		  			$data=$this->_GetNearBy($this->data['geo']);
		  			if(!empty($data))
						{ 	
							$this->Session->write('P_ID',$data);
						}
						else{ $A=array(); 
							$this->Session->write('P_ID',$data);  }
						//$this->redirect('/search');	
		  			
		  		}else{ $A=array(); 
							$this->Session->write('P_ID',$data);  }
						//$this->redirect('/search');	
		  	}
		  	exit;
		}
		
		function Get_whole_place($search=null,$radius = '500') //get all place id searching by  city,state,country
		{
			$lat_lng=$this->DATA->Get_Lat_lng($search);
				$lat =$lat_lng['lat'];
				$lng = $lat_lng['lng'];
				$this->Session->write('defalut_map',$lat.",".$lng);
				//$this->set('Cmap',$lat.",".$lng);
				
				
				$NearByResult = $this->Place->query("SELECT id, (((acos(sin((".$lat."*pi()/180)) * sin((lat*pi()/180)) +cos((".$lat."*pi()/180)) * cos((lat*pi()/180)) * cos(((".$lng."- lng)*pi()/180))))*180/pi())*60*1.1515) as distance FROM dev_places WHERE id!=0 having distance < $radius ORDER BY distance ASC ");
				//pr($NearByResult);die;
				if(!empty($NearByResult))
				{
				 	foreach ($NearByResult as $pid)
						{
							$pids[]=$pid['dev_places']['id'];
						}
						return $pids;
				}else { return $p_id=array('empty'=>'0'); }
				
			}

		function Get_un_av_place_id($from=null,$to=null) // get with place is not aviable
		{
			$NOT_AVB[]=null;
			if(!empty($from) && empty($to))
			{
				$fdate=date("Y-m-d",strtotime($from));
				$conditions = array('UnavailableDate.end_date >=' => $fdate);
				$cus_not_av = $this->UnavailableDate->find('all', array('conditions' =>$conditions));
				if(!empty($cus_not_av))
				{
					foreach ($cus_not_av as $nt)
					{ $NOT_AVB[]=$nt['UnavailableDate']['place_id']; }
				}
				else{ $NOT_AVB=array('0'); }
			}
			elseif(!empty($from) && !empty($to))
			{
				$fdate=date("Y-m-d",strtotime($from));
				$edate=date("Y-m-d",strtotime($to));
				$conditions = array('UnavailableDate.start_date <=' => $edate,'UnavailableDate.end_date >=' => $fdate);
				$cus_not_av = $this->UnavailableDate->find('all', array('conditions' =>$conditions));
				if(!empty($cus_not_av))
				{
					foreach ($cus_not_av as $nt)
					{ $NOT_AVB[]=$nt['UnavailableDate']['place_id']; }
				}else{ $NOT_AVB=array('0'); }
			}
			
			return $NOT_AVB;
			
		}
			
		function Get_booked_place_id($from=null,$to=null) // get with place is booked or not aviable
		{
			$this->Booking->unbindModel(array('hasMany' => array('RoomPayment')));
			$bids[]=null;
			if(!empty($from))
			{
				$fdate=date("Y-m-d",strtotime($from));
				$Timedate = strtotime("-1 day", strtotime($fdate));
				$Virtual_from= date("Y-m-d", $Timedate);
					$con=array('Booking.end_date >=' => $Virtual_from,'Booking.status'=>'1');
					//$con=array('Booking.start_date' => $fdate,'Booking.status'=>'1');
				$book_id = $this->Booking->find('all', array('conditions' =>$con,'fields' =>'Booking.place_id'));
					if(!empty($book_id)){
							foreach ($book_id as $bid)
							{
								$bids[]=$bid['Booking']['place_id'];
							}
							return $bids;
						}else{ return $b_id=array('0'); }
					
			}
			elseif(!empty($from) && !empty($to))
			{
				$fdate=date("Y-m-d",strtotime($from));
				$edate=date("Y-m-d",strtotime($to));
				
				
					$Timedate = strtotime("-1 day", strtotime($fdate));
					$Virtual_from= date("Y-m-d", $Timedate);
					$con=array('Booking.start_date <=' => $edate,'Booking.end_date >=' => $Virtual_from,'Booking.status'=>'1');
				//con=array('Booking.start_date' => $fdate,'Booking.end_date'=>$edate,'Booking.status'=>'1');
				$book_id = $this->Booking->find('all', array('conditions' =>$con,
							'fields' =>'Booking.place_id'
						));
				if(!empty($book_id)){
							foreach ($book_id as $bid)
							{
								$bids[]=$bid['Booking']['place_id'];
							}
							return $book_id;
						}else{ return $b_id=array('0'); }
			}
		}
		
	function index()
		{	
			$this->set('title_for_layout','Welcome to Guestnest');
			$this->Session->delete('P_ID');
			$this->Session->delete('search_data');
			$this->Session->delete('Rental_Term');
			$this->Session->delete('room_type');
			$this->Session->delete('room_price');
			$this->Session->delete('amenity');
			$this->Session->delete('Is_Secure');
			$this->Session->delete('booking_verify_link');
			
			$this->redirect("/");
			
		}
		
		//request form home page seach 
		function main_search()
		{
			$this->Session->delete('P_ID');
			$this->Session->delete('search_data');
			$this->Session->delete('Rental_Term');
			$this->Session->delete('room_type');
			$this->Session->delete('room_price');
			$this->Session->delete('amenity');
			$this->Session->delete('Is_Secure');
			$this->Session->delete('booking_verify_link');
			
			
			if($this->data)
			{ 
				if(isset($this->data['search_home']))
				{
					$search=$this->data['search'];
					if(!empty($this->data['from'])){	$from=$this->data['from']; } else{ $from=date('d-m-Y', strtotime(' +1 day')); }
					if(!empty($this->data['to'])){ $to=$this->data['to']; } else { $to= date("Y-m-d", strtotime("+1 day", strtotime($from))); }
					
					$pids=$this->Get_whole_place($search);  // get place id according to lat lang
					$search_data=array('search_place'=>$search,'near_by'=>'','date_from'=>$from);
					$this->Session->write('search_data',$search_data);
					
					$this->Session->write('Lab_Start_date',$from);// set date for booking start date
					if(!isset($pids['empty']))
						{ 	$bids=$this->Get_booked_place_id($from,$to);
							$Not_Av=$this->Get_un_av_place_id($from,$to); // not ave room by host
							$A = array_diff($pids,$bids);// remove booked place
							$A = array_diff($A,$Not_Av);// remove booked place
							$this->Session->write('P_ID',$A);
						}
						else{ $A=array(); 
							$this->Session->write('P_ID',$A);  }
						$this->redirect('/search');	
				}
			}
			else { $this->redirect('/'); }
		}
		
		function custom_search()
		{
			$this->Session->delete('P_ID');
			$this->Session->delete('search_data');
			$this->Session->delete('Rental_Term');
			$this->Session->delete('room_type');
			$this->Session->delete('room_price');
			$this->Session->delete('amenity');
			$this->Session->delete('keywords_search');
			$this->Session->delete('host_rating');
			if($this->data)
			{
			if(isset($this->data['came_form']))
				{ 
					$search=$this->data['nearby']." ".$this->data['search'];
					$from=$this->data['from'];
					
					if(!empty($this->data['to']))
					$to = date("Y-m-d", strtotime($this->data['to']));
					else  $to= date("Y-m-d", strtotime("+1 day", strtotime($from)));
					//$to=null;
					
					
					$pids=$this->Get_whole_place($search);  // get place id according to lat lang
					$search_data=array('search_place'=>$this->data['search'],'near_by'=>$this->data['nearby'],'date_from'=>$from,'date_to'=>date("m/d/Y",strtotime($to)));
					$this->Session->write('search_data',$search_data);
					$this->Session->write('Lab_Start_date',$from);// set date for booking start date
						if(!isset($pids['empty']))
						{ 	$bids=$this->Get_booked_place_id($from,$to);
							$Not_Av=$this->Get_un_av_place_id($from,$to); // not ave room by host
							$A = array_diff($pids,$bids);// remove booked place
							$A = array_diff($A,$Not_Av);// remove booked place 
							$this->Session->write('P_ID',$A);
						}
						else{ $A=array(); 
							$this->Session->write('P_ID',$A);  }
						$this->redirect('/search');	
					
				}
			}
		else { $this->redirect('/'); }
			
		}
		
		/*
		 *function getNearGivenAddress
		 *
		 *Get nearby places of given address.
		 *
		 *@params distance and address
		 *
		 *@return void.
		 
		*/
		public function getNearGivenAddress()
		{
			
			if(!empty($this->request->data['distance']) && !empty($this->request->data['nearby_address'])) 
			{
				
				$distance = $this->request->data['distance'];
				$search_data = $this->Session->read('search_data');
				
				$search = $this->request->data['nearby_address'].' '.$search_data['search_place'];
				
				$search_data=array('search_place'=>$search_data['search_place'],'near_by'=>$this->request->data['nearby_address'],'date_from'=>@$search_data['date_from'],'date_to'=>@$search_data['date_to'],'distance'=>$distance);
				$this->Session->write('search_data',$search_data);
				
				$pids=$this->Get_whole_place($search,$distance);
				
				$search_data = $this->Session->read('search_data');
				$from  = $search_data['date_from'];
				$to  = $search_data['date_to'];
				$this->Session->write('Lab_Start_date',$from);// set date for booking start date
				if(!isset($pids['empty']))
				{ 	$bids=$this->Get_booked_place_id($from,$to);
					$Not_Av=$this->Get_un_av_place_id($from,$to); // not ave room by host
					$A = array_diff($pids,$bids);// remove booked place
					$A = array_diff($A,$Not_Av);// remove booked place 
					$this->Session->write('P_ID',$A);
				}
				else{ $A=array(); 
					$this->Session->write('P_ID',$A);  }
				
			}
			
		}
		
		/*
		 *function keywords_search
		 *
		 *Get  filter palaces through passed keywords.
		 *
		 *@params none
		 *
		 *@return void.
		 
		*/
		public function keywords_search()
		{
			if(!empty($this->request->data['keywrds']))
			{
				
				$search_data=array('keywords'=>$this->request->data['keywrds']);
				$this->Session->write('keywords_search',$search_data);
			}
			echo "<script>location.reload();</script>";
			die;
		}
		
		function Cont_Rental_Term()
		{
			
		if($this->RequestHandler->isAjax())
		  {
		  		
			if(isset($this->data['isrent']))
				{
					$this->Session->delete('Rental_Term');
					
					if($this->data['tm']=="checked")
					{	$tm='yes'; } else{ $tm='no'; }
					if($this->data['td']=="checked")
					{	$td='yes';} else{ $td='no'; }
					$rental_term=array('only_month'=>$tm,'only_day'=>$td);
					$this->Session->write('Rental_Term',$rental_term);
				}
				
			if(isset($this->data['isroom']))
			{
				$this->Session->delete('room_type');
				// for private room
				if($this->data['pr']=="checked")
					{ $pr='yes'; } else { $pr='no'; }
				//for shared room
				if($this->data['sr']=="checked")
					{ $sr='yes'; } else { $sr='no'; }
				// for entire rooom	
				if($this->data['er']=="checked")
					{ $er='yes'; } else { $er='no'; }
				// for entire place
				if($this->data['ep']=="checked")
					{ $ep="yes"; } else { $ep='no'; }
				//create session 
					$room_types=array('private'=>$pr,'share'=>$sr,'entire'=>$er,'place'=>$ep);
					$this->Session->write('room_type',$room_types);
				}
					
			if(isset($this->data['price']))
			{
				$this->Session->delete('room_price');
				$min=$this->data['min'];
				$max=$this->data['max'];
				$room_price=array('min'=>$min,'max'=>$max);
				$this->Session->write('room_price',$room_price);
			}
			
			if(isset($this->data['Amemitie']))
			{
				$this->Session->delete('amenity');
				$que=null;
				if(!empty($this->data['RoomAmenities'])){
				 $que=implode(",",$this->data['RoomAmenities']);
				}
				 $this->Session->write('amenity',$que);
				echo "<script>location.reload();</script>";
			}
			
			exit;
		}
		else { $this->redirect('/'); }
			
		}
		
		function host_rating()
		{
			
			if($this->RequestHandler->isAjax())
			{
				if(!empty($this->request->data['host_rating']))
				$this->Session->write('host_rating',$this->request->data['host_rating']);
				echo "Yes";die;
				
			}
			else  $this->redirect('/'); 
			
		}
		
		function search()
		{
			$this->set('title_for_layout','Search Place');
			$bids[]=null;
			$A=array();

			if ($this->Session->check('search_data') == true)
			{
				$search_data=$this->Session->read('search_data');
				//pr($search_data); die;
				$search_start_date=$search_data['date_from'];
				$this->set('Search_data',$search_data);
				$neighbor=$this->DATA->Neighborhood($search_data['search_place']);
				//$neighbor=0;
				$this->set('Neighborhood',$neighbor);
				
			}
			$this->set('Cmap',$this->Session->Read('defalut_map'));
	
			$A=$this->Session->read('P_ID');
		if(empty($A)) 
		{ $A=array('0'=>0); }
			$conditions = array();
			$conditions[]=array('Room.place_id' =>$A,'Room.status'=>'1');
			if(isset($search_start_date)){
			//$current_date = strtotime("1 day", strtotime($search_start_date));
			$Virtual_current_date= date("Y-m-d", strtotime($search_start_date));
			$conditions[]=array('Room.available_date <=' => $Virtual_current_date);  // condation for available date
			}
			
			if($this->Session->check('Rental_Term') == true){
				$Rental_Term=$this->Session->read('Rental_Term');
			}
			if(isset($Rental_Term)) // adv search for rent per month or per day 
			{
				if($Rental_Term['only_month']=='yes' && $Rental_Term['only_day']=='no' )
				{	$this->set('tm','yes');
					$conditions[]=array('Room.rent_month <>' =>'0');	}
				elseif($Rental_Term['only_day']=='yes' && $Rental_Term['only_month']=='no' )
				{ 	$this->set('td','yes');
					$conditions[]=array('Room.rent_day <>' => '0'); }
				elseif($Rental_Term['only_month']=='yes' && $Rental_Term['only_day']=='yes')
				{
					$this->set('tm','yes');
					$this->set('td','yes'); }
			}//end 
			
			 //Adv search for room type like private/shared or entire
		if($this->Session->check('room_type') == true){  
				$Room_type=$this->Session->read('room_type');
			}
			if(isset($Room_type)){
				//$this->set('Room_type',$Room_type);
				if( $Room_type['private']=="yes" && $Room_type['share']=="yes" && $Room_type['entire']=="yes" && $Room_type['place']=="yes" )
				{}
				else{
				if($Room_type['private']=="yes"){ $conditions[]=array('Room.room_type' =>'Private room'); $this->set('Room_private','yes'); }
				if($Room_type['share']=="yes"){ $conditions[]=array('Room.room_type' =>'Shared room');  $this->set('Room_share','yes');}
				if($Room_type['entire']=="yes"){ $conditions[]=array('Room.room_type' =>'Entire home/apt'); $this->set('Room_entire','yes'); }
				
				if($Room_type['place']=="yes"){ $conditions[]=array('Room.type' =>'place');  $this->set('Room_place','yes'); }
				}
			}
		// Adv search : price 
		if($this->Session->check('room_price')== true)
		{
			$Room_price=$this->Session->read('room_price');
		}
		if($this->Session->check('keywords_search')== true)
		{	$keywords = $this->Session->read('keywords_search');
			$keyword = $keywords['keywords'];
			$this->set('keywords',$keywords);
			//$conditions[]=array("MATCH(Room.title) AGAINST('$keyword' IN BOOLEAN MODE)" );
			//$conditions[]=array("MATCH(Room.description) AGAINST('$keyword' IN BOOLEAN MODE)" );
			$conditions[]=array("OR"=>array('Room.title like'=>"%".$keyword."%",'Room.description like'=>"%".$keyword."%"));
		}
	if(isset($Room_price))
	{
		$min=$Room_price['min'];
		$max=$Room_price['max'];
		//'conditions' => array('id BETWEEN ? AND ?' => array(286, 291))
		$conditions['or'][]=array('Room.rent_month BETWEEN ? AND ?' =>array($min,$max));
		$conditions['or'][]=array('Room.rent_day BETWEEN ? AND ?' =>array($min,$max));
		$this->set('Room_price_min',$min);
		$this->set('Room_price_max',$max);
	}
	
	if($this->Session->check('amenity')==true)
	{
		$ame=$this->Session->read('amenity');
		$conditions[]=array("MATCH(Room.furnished_details) AGAINST('$ame' IN BOOLEAN MODE)" );
		
		
	}
	
	
	
	$order  = 'FIELD(Room.place_id,'.implode(',', $A).')';
	if(!empty($this->params->query['sort']) && $this->params->query['sort'] == "lpn")
	$order = "Room.rent_day ASC";
	
	if(!empty($this->params->query['sort']) && $this->params->query['sort'] == "hpn")
	$order = "Room.rent_day DESC";
	
	if(!empty($this->params->query['sort']) && $this->params->query['sort'] == "lpm")
	$order = "Room.rent_month ASC";
	
	if(!empty($this->params->query['sort']) && $this->params->query['sort'] == "hpm")
	$order = "Room.rent_month DESC";
	
	//pr($conditions); 
	$this->Place->unbindModel(array('hasMany' => array('Room'),'belongsTo'=>array('User')));
	
	
	$this->Room->bindModel(array('hasOne' => array('RatingByHost' =>
		array(
		      'foreignKey'=>false,
		      'conditions' =>array('RatingByHost.room_id=Room.id'),
		      'fields'=>'id'),
	)));
	$this->Room->virtualFields['avgRate'] = 'CEIL((sum(`RatingByHost`.`courteousness`) + sum(`RatingByHost`.`cleanliness`) + sum(`RatingByHost`.`pay_on_time`) + sum(`RatingByHost`.`follow_house_rules`)) / (count(`RatingByHost`.`room_id`)+4))';
	
	
	$groupby = 'Room.id';
	if($this->Session->check('host_rating')==true)
	{
		$this->set('host_rating',$this->Session->read('host_rating'));
		$groupby = array('Room.id having '.$this->Room->virtualFields['avgRate'].'='.$this->Session->read('host_rating'));
	}
	
	
	
	$this->paginate= array(
		'limit' =>9,
		'recursive' => 2,
		'conditions' => $conditions,
		'order' => $order,
		'group' =>$groupby,
		'fields'=>'Room.id,Room.description,Room.place_id,Room.type,Room.title,Room.room_type,Room.privacy,Room.bath_type,Room.furnisher,Room.furnished_details,Room.avgRate,Room.status,id',
		
		);
	$room = $this->paginate('Room');
	$this->layout = "new";
	$this->set('rooms',$room);
	if($this->request->is('ajax'))
	{
		$this->layout = "ajax";
		
		if( $this->params->query['lyt'] == "list"){
			$this->Session->write('current_tab','search_list_view');
			$this->render('search_list_view');
			
		}
		
		if( $this->params->query['lyt'] == "photo"){
			$this->Session->write('current_tab','search_photo_view');
			$this->render('search_photo_view');
		}
		
		if( $this->params->query['lyt'] == "map"){
			$this->Session->write('current_tab','search_map_view');
			$this->render('search_map_view');
		}
			
	}
	
	if ($this->Session->check('booking_done') == true){
	if( $this->Auth->User('id') != "")
		{
			$cond=array('Booking.user_id'=>ME,'Booking.status'=>0,'Booking.move_in'=>0,'Booking.accepted'=>0);
			$myBooking = $this->Booking->find('first',array('recursive'=>-1,'conditions'=>$cond));
			$this->set('my_booking',$myBooking);
			$this->Session->delete('booking_done');
		}
	}
			
}

		function show_room($room_id=null,$view=null)
		{
			
			//----------------------------------//	
			if ($this->Session->check('finish_booking') == true){
				$this->redirect(array('controller'=>'homes','action'=>'message'));	}
			//----------------------------------//		
			if(isset($room_id) && !isset($view) || $view == 'msg' )
			{
				$data=$this->Room->find('first',array('conditions'=>array('Room.id'=>$room_id,'Room.status'=>'1')));
				if(!empty($data))
				{
					$this->set('title_for_layout',$data['Room']['title']." in ".$data['Place']['state']." : Guestnest");
					$this->set('room',$data);
					$nearBy=$this->DATA->Get_nearby($data['Place']['lat'],$data['Place']['lng']);
					//$nearBy=0;
					$this->set('nearby',$nearBy);
					if($view == 'msg')
					{
						if($this->Auth->User('id') != "")
						{
							$this->set('msg','yes');
						}
					}
					
				}
				else{
					$this->layout='404';
					//$this->redirect('/');
				}
			}
			elseif (isset($room_id) && ($view == ME))
			{
				
				$data=$this->Room->find('first',array('conditions'=>array('Room.id'=>$room_id)));
				if(!empty($data))
				{
					$this->set('title_for_layout',$data['Room']['title']." in ".$data['Place']['state']." : Guestnest");
					$this->set('room',$data);
					$nearBy=$this->DATA->Get_nearby($data['Place']['lat'],$data['Place']['lng']);
					$this->set('nearby',$nearBy);
					$this->set('preview','yes');
					if($data['Room']['status'] == 0){
					$this->Session->setFlash(__('Pending Guestnest Admin approval,Your new listing will be live soon!'),'default', array('class'=>'message error'));
					}elseif($data['Room']['status'] == 2){
					$this->Session->setFlash(__('You have deactivated this listing. Would you like to <a href="'.SITEURL.'webs/make_active_room/'.$data['Room']['id'].'"; style="font-weight: bold;">ACTIVATE NOW?</a>'),'default', array('class'=>'message error'));
					}
						
				}
				else{
					$this->layout='404';
					//$this->redirect('/');
				}
				
			}
			else{
				$this->redirect('/');
			}
			
		}
		
		function room_details($room_id=null,$view=null)
		{

	
			if ($this->Session->check('finish_booking') == true){
				$this->redirect(array('controller'=>'homes','action'=>'message'));	}
		
			if(isset($room_id) && !isset($view) || $view == 'msg' )
			{
				
			$this->Room->bindModel(array('hasOne' => array('RatingByHost' =>
				array('foreignKey'=>false, 'conditions' =>array('RatingByHost.room_id=Room.id'),'fields'=>'id'),
				)));
				$this->Room->virtualFields['avgRate'] = 'CEIL((sum(`RatingByHost`.`courteousness`) + sum(`RatingByHost`.`cleanliness`) + sum(`RatingByHost`.`pay_on_time`) + sum(`RatingByHost`.`follow_house_rules`)) / (count(`RatingByHost`.`room_id`)+4))';

				
				$data=$this->Room->find('first',array('conditions'=>array('Room.id'=>$room_id,'Room.status'=>'1')));
				if(!empty($data) && !empty($data['Room']['id']))
				{
					$this->set('title_for_layout',$data['Room']['title']." in ".$data['Place']['state']." : Guestnest");
					$this->set('room',$data);
					//$nearBy=$this->DATA->Get_nearby($data['Place']['lat'],$data['Place']['lng']);
					//$nearBy=0;
					//$this->set('nearby',$nearBy);
					//pr($nearBy);die;
					if($view == 'msg')
					{
						if($this->Auth->User('id') != "")
						{
							$this->set('msg','yes');
						}
					}
					
				} else{ $this->layout='404'; }
			}
			elseif (isset($room_id) && ($view == ME))
			{
				
				$data=$this->Room->find('first',array('conditions'=>array('Room.id'=>$room_id)));
				if(!empty($data))
				{
					$this->set('title_for_layout',$data['Room']['title']." in ".$data['Place']['state']." : Guestnest");
					$this->set('room',$data);
					//$nearBy=$this->DATA->Get_nearby($data['Place']['lat'],$data['Place']['lng']);
					//$this->set('nearby',$nearBy);
					$this->set('preview','yes');
					if($data['Room']['status'] == 0){
					$this->Session->setFlash(__('Pending Guestnest Admin approval,Your new listing will be live soon!'),'default', array('class'=>'message error'));
					}elseif($data['Room']['status'] == 2){
					$this->Session->setFlash(__('You have deactivated this listing. Would you like to <a href="'.SITEURL.'webs/make_active_room/'.$data['Room']['id'].'"; style="font-weight: bold;">ACTIVATE NOW?</a>'),'default', array('class'=>'message error'));
					}
						
				}
				else{ $this->layout='404'; }
				 } else{ $this->redirect('/'); }
			
		}
		
		// code for place listing 
		
		function list_your_space()
		{
			$this->Session->delete('New_User');
			$this->Session->delete('new_place');
			$this->Session->delete('EntirePlace');
			$this->Session->delete('Room');
			$this->Session->delete('media');
			$this->Session->delete('NextRule');
			$this->Session->delete('no_of_room');
			$this->Session->delete('first_room');
			$this->Session->delete('Img_Temp_Id');
			$this->Session->delete('Room_finished');
			$this->Session->delete('entire_id');
			$this->redirect(array('controller'=>'homes','action'=>'add_listing'));
		}
		
		function add_listing()
		{
			$this->set('title_for_layout','List Your Space : Guestnest');
			/****************prevent back after form submit *****************************/
			if ($this->Session->check('EntirePlace') == true){
				$this->redirect(array('controller'=>'homes','action'=>'entire_place'));	}
			if ($this->Session->check('Room') == true){
				$this->redirect(array('controller'=>'homes','action'=>'room'));	}
			/****************************************************************************/	
				if(!empty($this->data))
				{ 
			if(isset($this->request->data['User'])){
				$this->User->set($this->request->data['User']);
							}
				$this->Place->set($this->request->data['Place']);
				$r1 = $this->Place->validates();
				if(!empty($this->request->data['User']))
				{
					$r2 = $this->User->validates(); }
			else{
				$r2 = true;}
				if($r1 && $r2)
				{
					$full_address=$this->request->data['Place']['address']." ".$this->request->data['Place']['address1'];
					// address verification 
					$add2=$this->data['Place']['city'].",".$this->data['Place']['state'];	
					$add_verification=$this->DATA->Address_Verification($full_address,$add2,$this->data['Place']['zip']);
					if($add_verification){ $this->request->data['Place']['address_verified'] = 1; }
					
					
					unset($this->request->data['Place']['address']);
					unset($this->request->data['Place']['address1']);
					$this->request->data['Place']['address'] = $full_address;
					
					$new_array=array_filter($this->data['Place']['amentites']);
					$imploded = implode(',',$new_array);
					unset($this->request->data['Place']['amentites']);
					$this->request->data['Place']['amentites'] = $imploded;
					if($this->Auth->user() !="") /// if user is loing 
						{
							$user_id=$this->Auth->User('id');
							$this->request->data['Place']['user_id'] = $user_id;
						}
					
					$G_addresss=$full_address." ".$this->data['Place']['city']." ".$this->data['Place']['state']." ".$this->data['Place']['country'];
					$lat_lng=$this->DATA->Get_Lat_lng($G_addresss);
					if($lat_lng['status']== 'ok')
					{
						$this->request->data['Place']['lat'] = $lat_lng['lat'];
						$this->request->data['Place']['lng'] = $lat_lng['lng'];
					}
					else{
						unset($this->request->data['Place']['address']);
						}
						
					$this->request->data['Place']['status'] = 1;	
					if($this->Place->save($this->data))
					{
						if(isset($this->data['User']))
						{
							$this->User->save($this->data);
						}
						
						$P_id= $this->Place->getLastInsertId(); 
						//create user settings 
						if(isset($this->data['User']))
						{	
							
							$lid= $this->User->getLastInsertId();
							$Udata = $this->User->find("first",array("conditions" => array('User.id'=>$lid)));
							$this->Session->write('New_User',$lid);//no of rooms	
								//update new place user id 
								$this->Place->updateAll( array('Place.user_id' => $lid), array('Place.id' => $P_id ));
								$to=$Udata['User']['email'];
								$name=$Udata['User']['first_name']." ".$Udata['User']['last_name'];
								//'UserMailAlert','UserMobileAlert'
								$this->UserMailAlert->create();
								$this->UserMailAlert->set('user_id',$Udata['User']['id']);
								$this->UserMailAlert->save(null , false);
								
								$this->UserMobileAlert->create();
								$this->UserMobileAlert->set('user_id',$Udata['User']['id']);
								$this->UserMobileAlert->save(null , false);
								$this->THmail->welcome($to,$name,$this->data['User']['password']);
								
						}
						$new_arr=array('place_id'=>$P_id,'no_rooms'=>$this->request->data['Place']['no_rooms']);
						$this->Session->write('new_place',$new_arr);
						if($this->request->data['Place']['no_rooms'] == "entire place")
						{
							$this->Session->write('EntirePlace','complete');//new listing is complate 
							$this->redirect(array('controller'=>'homes','action'=>'entire_place'));
						}
						else{
							
							$this->Session->write('Room','complete');//new listing is complate 
							$this->Session->write('no_of_room',$this->request->data['Place']['no_rooms']);//no of rooms
							$this->Session->write('first_room','1');//no of rooms
								
							$this->redirect(array('controller'=>'homes','action'=>'room')); 
							}
												
						
					}
					else{
						/*$failed_fields = $this->Place->invalidFields();
						$failed = $this->User->invalidFields();
						pr($failed_fields);
						pr($failed);*/
					}
		}
				}
		}
		
		
		function entire_place()
		{
			$this->set('title_for_layout','List Your Space : Guestnest');
			//****************prevent back after form submit *********************************
		 if ($this->Session->check('media') == true){
					$this->redirect(array('controller'=>'homes','action'=>'place_photo'));	}    
			//***************************************************************************
		
		   if ($this->Session->check('new_place') == true){ $placeID = $this->Session->read('new_place'); }
			if(isset($placeID)){$this->set('placeID',$placeID['place_id']);	}
			else{$this->redirect('/add-listing');} 
			
			//$this->set('placeID','1');
						
			if(!empty($this->data))
			{
					if($this->Auth->user() !="") /// if user is loing 
						{	$user_id=$this->Auth->User('id');
							$this->request->data['Room']['user_id'] = $user_id;		}
						
				$this->request->data['Room']['type'] = 'place';
				$min_days=$this->data['Room']['min_day']['day'];
				unset($this->request->data['Room']['min_day']);
				$this->request->data['Room']['min_day'] = $min_days;
				
			if(isset($this->data['Room']['notice_day']))
				{
				$notice_day=$this->data['Room']['notice_day']['day'];
				unset($this->request->data['Room']['notice_day']);
					if($this->data['Room']['rent_month'] !="" ){
						$this->request->data['Room']['notice_day'] = $notice_day;
						
					}else{			unset($this->request->data['Room']['open_term']);
									unset($this->request->data['Room']['notice_day']);
								}
				}
			else{	unset($this->request->data['Room']['min_month']);}
				
				if($this->data['Room']['rent_month'] == "")
				{ 	unset($this->request->data['Room']['min_month']); }
				
				if($this->data['Room']['rent_day'] == "")
				{ unset($this->request->data['Room']['min_day']); }
				/*if(!isset($this->data['Room']['is_due']))
				{
					unset($this->request->data['Room']['due_date']);
				}*/
				$fdate=date("Y-m-d",strtotime($this->data['Room']['available_date']));
					unset($this->request->data['Room']['available_date']);
					$this->request->data['Room']['available_date'] =$fdate;
				
				if($this->Room->save($this->data))
				{
					$lid= $this->Room->getLastInsertId();
					$this->Session->write('entire_id',$lid);//entire place id
				    $this->Session->write('media','complete');//entire from is complate
					$this->redirect(array('controller'=>'homes','action'=>'place_photo'));
				}
				else{
					//echo "error";
						//$failed = $this->Room->invalidFields();
						//pr($failed);
				}
			}
			
		}
		
		function room()
		{
		$this->set('title_for_layout','List Your Space : Guestnest');
		$no=null;
		
	     if ($this->Session->check('new_place') == true){ $placeID = $this->Session->read('new_place'); }
			if(isset($placeID)){
			$this->set('placeID',$placeID['place_id']);	
			}
			else{$this->redirect('/add-listing');} 
		//****************prevent back after form submit ********************************
		if ($this->Session->check('Room_finished') == true){
				$this->redirect(array('controller'=>'homes','action'=>'add_rules'));	}  
			
			
		// check no of room
		if ($this->Session->check('no_of_room') == true){
				$No_of_Room = $this->Session->read('no_of_room');  //  2
				$no = $this->Session->read('first_room');//no of rooms   1
 			}
			$this->set('Room_no_start',$no);  
			
	
		
		// for test
		/*
		$placeID=254;
		$No_of_Room=2;
		$this->set('placeID',$placeID);
		$this->set('Room_no_start',$No_of_Room); // temp  
		*/
		
		$Img_tmp_id=$placeID['place_id']."_999".$No_of_Room;
		$this->Session->write('Img_Temp_Id',$Img_tmp_id);
		$this->set('temp_img_id',$Img_tmp_id);

		if($this->RequestHandler->isAjax())
		 {	
			if(!empty($this->data))
			{

				$Imgcount = $this->RoomImage->find('count',array('conditions'=>array('RoomImage.temp_id'=>$Img_tmp_id)));
				
			if(empty($this->data['Room']['rent_month']))
				{ 
					if(empty($this->data['Room']['rent_day']) && $this->data['Room']['rent_day'] <= 0)
					{ echo "Please enter daily or monthly rent  ! "; exit; }
				}
				
				if(empty($this->data['Room']['title']))
				{ echo "Please enter room title ! "; exit; }
				
			elseif(empty($this->data['Room']['description']))
				{ echo "Please enter room description ! "; exit; }
				
			elseif(empty($this->data['Room']['security_deposit']) && !is_numeric($this->data['Room']['security_deposit']))
				{ echo "Please enter room security deposit ! "; exit; }
			elseif($Imgcount == 0)
				{ echo "Please Upload Images for rooms !"; exit; }
			else  {
					// updatnow all data
					
						$furnishe=$this->data['Room']['furnisher'];
						if($furnishe=="Unfurnished")
						{
							unset($this->request->data['Room']['furnisher']);
							$this->request->data['Room']['furnisher'] = $furnishe;
						}
						else
						{
							unset($this->request->data['Room']['furnisher']);
							$this->request->data['Room']['furnisher'] = $furnishe;
							if(isset($this->request->data['Room']['Bed']) || !empty($this->request->data['Room']['Bed']))
							{ $bed=$this->request->data['Room']['Bed']['0'];  }
							if(isset($this->request->data['Room']['Flat_tv']) || !empty($this->request->data['Room']['Flat_tv']))
							{  $flact_tv=$this->request->data['Room']['Flat_tv'][0]; }
							if(isset($this->request->data['Room']['tv']) || !empty($this->request->data['Room']['tv']))
							{   $tv=$this->request->data['Room']['tv'][0]; }
								
							if(isset($this->request->data['Room']['furnished_details']) || !empty($this->request->data['Room']['furnished_details']))
							{
								$imploded = implode(',', $this->request->data['Room']['furnished_details']);
								unset($this->request->data['Room']['furnished_details']);
								unset($this->request->data['Room']['Bed']);
								unset($this->request->data['Room']['Flat_tv']);
								unset($this->request->data['Room']['tv']);
		
								if(isset($flact_tv)) { $imploded=$flact_tv.",".$imploded;	}
								if(isset($tv)) { $imploded=$tv.",".$imploded;	}
								if(isset($bed)) { $imploded=$bed.",".$imploded;	}
								$this->request->data['Room']['furnished_details'] = $imploded;
									}
								
						}
						$this->request->data['Room']['type']="room";
						$min_days=$this->data['Room']['min_day']['day'];
						unset($this->request->data['Room']['min_day']);
						$this->request->data['Room']['min_day'] = $min_days;
		
						if(isset($this->data['Room']['notice_day']))
						{
							$notice_day=$this->data['Room']['notice_day']['day'];
							unset($this->request->data['Room']['notice_day']);
							if($this->data['Room']['rent_month'] !="" ){
								$this->request->data['Room']['notice_day'] = $notice_day;
		
							}else{			
								unset($this->request->data['Room']['open_term']);
								unset($this->request->data['Room']['notice_day']);
							}
						}
						else{	unset($this->request->data['Room']['min_month']);}
		
						if($this->data['Room']['rent_month'] == "")
						{ 	unset($this->request->data['Room']['min_month']); }
		
						if($this->data['Room']['rent_day'] == "")
						{ unset($this->request->data['Room']['min_day']); }
		
						$room_size= $this->data['Room']['room_size']." X ".$this->data['Room']['room_size1'];
						unset($this->request->data['Room']['room_size']);
						$this->request->data['Room']['room_size'] = $room_size;
						
						if($this->Room->save($this->data))
						{
							$lid= $this->Room->getLastInsertId();
								
							$Imgdata=$this->RoomImage->find('all',array('conditions'=>array('RoomImage.temp_id'=>$Img_tmp_id)));
							foreach ($Imgdata as $img_data)
							{
								if(file_exists('data/temp_img/'.$img_data['RoomImage']['image']))
								{
									copy(WWW_ROOT.'data/temp_img/'.$img_data['RoomImage']['image'], WWW_ROOT.'data/place/'.$img_data['RoomImage']['image']);
									unlink('data/temp_img/'.$img_data['RoomImage']['image']);
								}
							}
							//update room photoes id
							$this->RoomImage->updateAll(array('RoomImage.room_id' => $lid,'RoomImage.place_id'=>$placeID['place_id']),array('RoomImage.temp_id' => $Img_tmp_id));
							$this->RoomImage->updateAll(array('RoomImage.temp_id' => '0'),array('RoomImage.room_id' => $lid));


							//update room video
							$room_V_data=$this->PlaceVideo->find('all',array('conditions'=>array('PlaceVideo.temp_id'=>$Img_tmp_id)));
							if(!empty($room_V_data))
							{
								$this->PlaceVideo->updateAll(array('PlaceVideo.room_id' => $lid,'PlaceVideo.place_id'=>$placeID['place_id']),array('PlaceVideo.temp_id' => $Img_tmp_id));
								$this->PlaceVideo->updateAll(array('PlaceVideo.temp_id' => '0'),array('PlaceVideo.room_id' => $lid));
							}
								
							if($No_of_Room >1)
							{
								$No_of_Room = $No_of_Room-1;
								$no = $no+1;
								$this->Session->write('no_of_room',$No_of_Room);//no of rooms
								$this->Session->write('first_room',$no);//no of rooms
								echo '<script>window.location = "'.SITEURL.'homes/room"</script>';
								exit;
								//$this->redirect(array('controller'=>'homes','action'=>'room'));
							}
							else{
									
								$this->Session->write('Room_finished','yes');// set session when all room listing compalte
								echo '<script>window.location = "'.SITEURL.'homes/add_rules"</script>';
								exit;
								//$this->redirect(array('controller'=>'homes','action'=>'add_rules'));

							}
						}
						else{ echo "Network error ! please try later ! ";  exit; }
						
			
					}
				
				
			}
		 }
		
		}
		
		
		function room_video()
		{
			$this->layout=false;
			$ii=null;
				if ($this->Session->check('Img_Temp_Id') == true)
				{
					$Img_Temp_Id = $this->Session->read('Img_Temp_Id');
				}
		if(!empty($this->data))
			{
				//pr($this->data);die;
				if(empty($this->data['PlaceVideo']['video']))
				{
					echo "<script>alert('Please enter Youtube video URL');</script>";
				}
				else
				{
				  if (preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $this->data['PlaceVideo']['video'], $match)) 
			 		{
			 			$Yurl=$this->DATA->youtubeID($this->data['PlaceVideo']['video']);
			 				$this->PlaceVideo->create();
							$this->PlaceVideo->set('place_id','0');
							$this->PlaceVideo->set('room_id','0');
							$this->PlaceVideo->set('temp_id',$Img_Temp_Id);
							$this->PlaceVideo->set('video',$Yurl);
							$this->PlaceVideo->save(null , false);	
			 			echo ' <ul class="upload_image"><li><img src="http://img.youtube.com/vi/'.$Yurl.'/2.jpg"></li></ul>';
			 			echo "<script>$('#PlaceVideo').hide(500)</script>";
			 			exit;
			 		}
			 		else{
			 			echo "<script>alert('Wrong Youtube video URL');</script>";
			 			exit;
			 		}
				}
			exit;
			
				
			}
		}
		
		function rooms_images()
		{
			$this->layout=false;
			$ii=null;
				if ($this->Session->check('Img_Temp_Id') == true)
				{
					$Img_Temp_Id = $this->Session->read('Img_Temp_Id');
				}
					if(!empty($this->data))
					{	
									//pr($this->data);die;
							$id=rand(1000,999999);
							$filename=$this->data['RoomImage']['img']['name']; //ogr file name
							$rev=strrev($filename);
							$file_ext=explode(".",$rev);
							$new_file=strtolower(strrev($file_ext[0]));
							$fianl_file_name=$id.".".$new_file;
							$si=($this->data['RoomImage']['img']['size']/1024)/1024;
							if($new_file != "jpeg" && $new_file != "jpg" && $new_file != "png" && $new_file != "gif")
							{	echo "<script>alert('Please Upload only Image');</script>";	
							}
							elseif($si >= 2)
								{	echo "<script>alert('You can\'t upload more than 5 MB file');</script>"; 
								}
							elseif(move_uploaded_file($this->data['RoomImage']['img']['tmp_name'], WWW_ROOT.'data/temp_img/'.$fianl_file_name))
								{
									$this->RoomImage->create();
									$this->RoomImage->set('room_id','0');
									$this->RoomImage->set('place_id','0');
									$this->RoomImage->set('image',$fianl_file_name);
									$this->RoomImage->set('temp_id',$Img_Temp_Id);
									$this->RoomImage->save(null , false);
								}
						$Idata=$this->RoomImage->find('all',array('conditions'=>array('RoomImage.temp_id'=>$Img_Temp_Id)));
						$t_im=count($Idata);
						if(!empty($Idata)){
							foreach ($Idata as $im)
							{
								$ii.='<li><img src="'.SITEURL.'timthumb.php?src='.SITEURL."app/webroot/data/temp_img/".$im['RoomImage']['image'].'&w=43&h=33&zc=1&q=100"></li>';
							}
							echo "<ul class='upload_image'>$ii</ul>";
							echo "<script>parent.$('#subm input').remove();</script>";
							echo "<script>parent.$('#subm').append('<input type=\"submit\" class=\"save_continue\" value=\"Save & Continue\">');</script>";
							echo "<script>parent.$('#img_hidden input').remove();</script>";
							echo "<script>parent.$('#img_hidden').append('<input type=\"hidden\" id=\"img_chk\" value=\"yes\">');</script>";
							echo "<script>parent.$('#Is_rent input').remove();</script>";
							echo "<script>parent.$('#Is_rent').append('<input type=\"hidden\" id=\"rent_chk\" value=\"yes\">');</script>";
							
						
						}
						else{ 
								
						}
						if($t_im >=12){
						echo "<script>$('#RoomImageImg').hide(500)</script>";
						}
						
						exit;
			}//end
			else {
			
				$Idata=$this->RoomImage->find('all',array('conditions'=>array('RoomImage.temp_id'=>$Img_Temp_Id)));
				$this->set('total_img',count($Idata));
				if(!empty($Idata)){
					foreach ($Idata as $im)
					{
						//pr($im);
						$ii.='<li><img src="'.SITEURL.'timthumb.php?src='.SITEURL."app/webroot/data/temp_img/".$im['RoomImage']['image'].'&w=43&h=33&zc=1&q=100"></li>';
					}
					$p_img= "<ul class='upload_image' id='showimg'>$ii</ul>";
					$this->set('pre_img',$p_img);
				$room_V_data=$this->PlaceVideo->find('first',array('conditions'=>array('PlaceVideo.temp_id'=>$Img_Temp_Id)));
				if(!empty($room_V_data))
				{
					$this->set('RoomV',$room_V_data['PlaceVideo']['video']);
				}
					
			}
			
		
		}
		}
		function place_photo()
		{
		$this->set('title_for_layout','Upload Photo for Space : Guestnest');
	 	if ($this->Session->check('NextRule') == true){
					$this->redirect(array('controller'=>'homes','action'=>'add_rules'));	}  
			
		if ($this->Session->check('new_place') == true){
			$placeID = $this->Session->read('new_place');	
			}
			if(isset($placeID)){	
			$this->set('placeID',$placeID['place_id']);
			//entire id 
			$entire_id=$this->Session->read('entire_id');
			$this->set('entire_id',$entire_id);

			}else{$this->redirect('/add-listing');}  
			
			//chke and get entire_id 
			/*$entire_id='120';
			$this->set('entire_id',$entire_id);
			$this->set('placeID','101');*/
		
			if(!empty($this->data))
			{
				//$data=$this->PlaceImage->find('all',array('conditions'=>array('PlaceImage.place_id'=>$placeID['place_id'])));
				$data=$this->RoomImage->find('all',array('conditions'=>array('RoomImage.room_id'=>$entire_id)));
				
				if(!empty($data))
				{
					$this->Session->write('NextRule','complete');//entire from is complate
					$this->redirect('/homes/add_rules');
				}else{
					$this->Session->setFlash(__("Please upload some images"), 'default', array('class'=>'message error'),'msg');
				}
				
				/*if($this->data['PlacePhoto']['msg']=='save')
				{
					$this->Session->write('NextRule','complete');//entire from is complate
					$this->redirect('/homes/add_rules');
					//$this->Session->setFlash(__("test"), 'default', array('class' => 'no_class'),'new_place');
					//$this->redirect('/homes/success');
				}
				elseif($this->data['PlacePhoto']['msg']=='not_save')
				{
					$this->Session->setFlash(__("Please upload some images"), 'default', array('class'=>'message error'),'msg');
					
				}*/
			}
		
			
			
		}
		function save_photo()
		{
			$this->layout=false;
			$ii=null;
			if($this->data)
			{
					$id=rand(1000,999999);
						$filename=$this->data['RoomImage']['img']['name']; //ogr file name
						$rev=strrev($filename);
						$file_ext=explode(".",$rev);
						$new_file=strtolower(strrev($file_ext[0]));
						$fianl_file_name=$id.".".$new_file;

						if($new_file != "jpeg" && $new_file != "jpg" && $new_file != "png" && $new_file != "gif")
						{
							echo "<script>alert('Please Upload only Jpg/Png/Gif Image');</script>";
	    						
						}
				elseif(move_uploaded_file($this->data['RoomImage']['img']['tmp_name'], WWW_ROOT.'data/place/'.$fianl_file_name))
						{
							$this->RoomImage->create();
							$this->RoomImage->set('room_id',$this->data['RoomImage']['room_id']);
							$this->RoomImage->set('place_id',$this->data['RoomImage']['place_id']);
							$this->RoomImage->set('image',$fianl_file_name);
							$this->RoomImage->save(null , false);	
						}
						$Idata=$this->RoomImage->find('all',array('conditions'=>array('RoomImage.room_id'=>$this->data['RoomImage']['room_id'])));
						$t_im=count($Idata);
						foreach ($Idata as $im)
						{
							$ii.='<li><img src="'.SITEURL.'timthumb.php?src='.SITEURL."app/webroot/data/place/".$im['RoomImage']['image'].'&w=43&h=33&zc=1&q=100"></li>';
						}
						echo "<ul class='upload_image'>$ii</ul>";
						if($t_im >=12){
						echo "<script>$('#RoomImageImg').hide(500)</script>";
						}
						exit;
			}
			
		}
		
		function save_video()
		{
			$this->layout=false;
			//pr($this->data);die;
			if(!empty($this->data))
			{
				if(empty($this->data['PlaceVideo']['video']))
				{
					echo "<script>alert('Please enter Youtube video URL');</script>";
				}
				else
				{
				  if (preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $this->data['PlaceVideo']['video'], $match)) 
			 		{
			 			$Yurl=$this->DATA->youtubeID($this->data['PlaceVideo']['video']);
			 				$this->PlaceVideo->create();
							$this->PlaceVideo->set('place_id',$this->data['PlaceVideo']['place_id']);
							$this->PlaceVideo->set('room_id',$this->data['PlaceVideo']['room_id']);
							$this->PlaceVideo->set('video',$Yurl);
							$this->PlaceVideo->save(null , false);	
			 			echo ' <ul class="upload_image"><li><img src="http://img.youtube.com/vi/'.$Yurl.'/2.jpg"></li></ul>';
			 			echo "<script>$('#PlaceVideo').hide(500)</script>";
			 			exit;
			 		}
			 		else{
			 			echo "<script>alert('Wrong Youtube video URL');</script>";
			 			exit;
			 		}
				}
			exit;
			
				
			}
		}
		function add_rules()
		{
			$this->set('title_for_layout','Add Rules : Guestnest');
			if ($this->Session->check('new_place') == true){
			$placeID = $this->Session->read('new_place');	
			}
			if(isset($placeID)){	
			$this->set('placeID',$placeID['place_id']);

			}else{$this->redirect('/add-listing');} 
			//$this->set('placeID','21');
			if(!empty($this->data))
			{
				//pr($this->data);die;
				if(empty($this->data['PlaceRule']['rule']))
				{  echo '<div class="message error" id="msgMessage">Enter Rules.</div>'; exit; }
				elseif(empty($this->data['PlaceRule']['chk']))
				{ echo '<div class="message error" id="msgMessage">Please select rules.</div>'; exit; }
				else{
					foreach($this->data['PlaceRule']['chk'] as $key=>$value)
					{
						if(array_key_exists($key, $this->data['PlaceRule']['rule']))
						{	
						$rule = $this->data['PlaceRule']['rule'][$key];
						
							if(!empty($rule))
							{	
								$this->PlaceRule->create();
								$this->PlaceRule->set('place_id',$this->data['PlaceRule']['place_id']);
								$this->PlaceRule->set('rule',$rule);
								$this->PlaceRule->save(null , false);
							}
						}
					}
				$getdata=$this->DATA->host_rules($this->data['PlaceRule']['place_id']);
				if(empty($getdata))
				{	echo '<div class="message error" id="msgMessage">Make sure you have check rules.</div>'; exit; }
				else{ 
					$place_title=$this->DATA->RoomDatabyPlace($this->data['PlaceRule']['place_id'],'title');
					if ($this->Session->check('New_User') == true)
						{
							$UserID = $this->Session->read('New_User');
							$Udata = $this->User->find("first",array("conditions" => array('User.id'=>$UserID)));
							$this->Auth->login($Udata['User']);
							$u_name=$Udata['User']['first_name']." ".$Udata['User']['last_name'];
							$this->THmail->NewListing($Udata['User']['email'],$u_name,$place_title);	
						}
				if($this->Auth->user() !="") /// if user is loing 
						{
							$to=$this->Auth->user('email');
							$u_name=$this->DATA->GetUserData($this->Auth->user('id'),'first_name')." ".$this->DATA->GetUserData($this->Auth->user('id'),'last_name');
							$this->THmail->NewListing($to,$u_name,$place_title);
						}
						
						$this->Session->delete('New_User');
						$this->Session->delete('new_place');
						$this->Session->delete('EntirePlace');
						$this->Session->delete('Room');
						$this->Session->delete('media');
						$this->Session->delete('NextRule');
						$this->Session->delete('no_of_room');
						$this->Session->delete('first_room');
					
						
						$this->Session->setFlash(__("test"), 'default', array('class' => 'no_class'),'new_place');
						echo '<script>window.location = "'.SITEURL.'homes/listing_added"</script>';
						exit;
					
				}echo '<div class="message success" id="msgMessage">Make sure you have check rules.</div>'; 
				
				exit; }
				
					
				die('end');
			}
			
		}
		
		function save_rules()
		{
			$this->layout=false;
			if($this->data)
			{
					$rule=$this->DATA->get_rules($this->data['rule_id']);
					//pr($rule);die;
					$this->PlaceRule->create();
					$this->PlaceRule->set('place_id',$this->data['place_id']);
					$this->PlaceRule->set('rule',$rule);
					if($this->PlaceRule->save(null , false))
					{
						echo '<input type="button" class="rule-save-btn" style="color: green !important;width: 111px !important;" value="Rule Saved">';
						exit;
					}
			}
		} 

		function host_rule()
		{
		$this->layout=false;
			if($this->data)
			{
				if($this->data['rule']=="")
				{
					echo "<script>alert('Please enter Rule');</script>";
	    			exit;
				}
				else{
				
					$this->PlaceRule->create();
					$this->PlaceRule->set('place_id',$this->data['place_id']);
					$this->PlaceRule->set('rule',$this->data['rule']);
					if($this->PlaceRule->save(null , false))
					{
						echo '<input type="button" class="rule-save-btn" style="color: green !important;width: 111px !important;" value="Rule Saved">';
						exit;
					}
				}
			}
		}
		
		
		function success()
		{
			$this->set('title_for_layout','Success : Guestnest');
			
		}
	function message()
		{
			$this->set('title_for_layout','Message : Guestnest');
			
		}
		
		function listing_added()
		{
			
		}
		
		function rental_agreement($str=null)
		{
			$this->layout=false;
			$this->set('title_for_layout','Rental Agreement : Guestnest');
			if(!empty($str))
			{
				$booking_id=base64_decode($str);
				$user_id=$this->Auth->user('id');
				$show=null;
				$booking=$this->Booking->find('first',array('recursive'=>2,
				'conditions'=>array(
				 'OR' => array(array('Booking.user_id'=>$user_id),array('Booking.host_id'=>$user_id)),
					'Booking.id'=>$booking_id,'Booking.accepted'=>'1')));
				$GuestRent=$this->DATA->GuestPayment($booking_id); 
				$guest_rent=$GuestRent['rent']; 
				$guest_deposit=$GuestRent['deposit'];

				//guest data
				$guest_data=$this->User->find('first',array('recursive'=>-1,'conditions'=>array('User.id'=>$booking['Booking']['user_id'])));
				$guest_name=$guest_data['User']['first_name']." ".$guest_data['User']['last_name'];
				$user_email=$guest_data['User']['email'];
				//host detials 
				$host_id=$booking['Booking']['host_id'];
				$host_data=$this->User->find('first',array('recursive'=>-1,'conditions'=>array('User.id'=>$host_id)));

				$place_id=$this->DATA->GetBookingData($booking_id,$user_id,'place_id');
				$p_amt=$this->DATA->GetPlaceData($place_id,'amentites');
				$add=$this->DATA->GetPlaceData($place_id,'address')." ".$this->DATA->GetPlaceData($place_id,'city')." ".$this->DATA->GetPlaceData($place_id,'state')." ".$this->DATA->GetPlaceData($place_id,'zip')." ".$this->DATA->GetPlaceData($place_id,'country');
				if(!empty($p_amt)){ $place_amt=$p_amt; }else { $place_amt="Not Set by host";}
				$rules=$this->DATA->Get_Rules_mail($place_id);
				if($booking['Booking']['rent_term'] == "m"){
					$show='yes';
					if($booking['Booking']['open_ended'] == 0 ){ 
						$t_stay="month to month";
						$t_rent=$guest_rent." per Month for month to month ";  
					}
					else {
						$t_stay=$booking['Booking']['total_stay']." Month";
					$t_rent=$guest_rent." per Month for  ".$booking['Booking']['total_stay']." Months"; }
				}else 
				{
					if($booking['Booking']['total_stay'] > 30) { $show='yes'; }
					$t_stay=$booking['Booking']['total_stay']." day";
					if($booking['Booking']['total_stay'] > 1) { $d=' days';} else { $d=' day'; } 
					$t_rent=$guest_rent." for  ".$booking['Booking']['total_stay'].$d; 
				}
				$paydate=date("d",strtotime($booking['Booking']['start_date']));
				$moveindate=date('m-d-Y',strtotime($booking['Booking']['start_date']));
				$notice=$this->DATA->GetRoomData($booking['Booking']['room_id'],'notice_day')." Days ";
				$emailformat=$this->Mail->find('first', array('conditions' => array('Mail.type' => 'RentalAgreement')));
				$body = str_replace('[HOSTNAME]', $host_data['User']['first_name']." ".$host_data['User']['last_name'], $emailformat['Mail']['message']);
				$body = str_replace('[GUESTNAME]',$guest_name , $body);
				$body = str_replace('[ROOMADDRESS]',$add , $body);
				$body = str_replace('[DEPOSIT]',$guest_deposit , $body);
				$body = str_replace('[AMENITIES]',$place_amt , $body);
				$body = str_replace('[MOVEIN]',$moveindate, $body);
				$body = str_replace('[TOT_STAY]',$t_stay , $body);
				$body = str_replace('[NOTICEDAY]',$notice , $body);
				$body = str_replace('[RENT]',$t_rent, $body);
				$body = str_replace('[RULES]',$rules , $body);
				$body = str_replace('[PAYDAY]',$paydate , $body);
				if($show == 'yes'){ 
					$body =  strtr($body, array('[START]' => '', '[END]' => ''));
				}else{
					$body =  preg_replace('#('.preg_quote('[START]').')(.*)('.preg_quote('[END]').')#si', '$1'.''.'$3', $body); 
                $body =  strtr($body, array('[START]' => '', '[END]' => ''));
				}
				
				$this->set('data',$body);
				
			}else{ $this->layout="404"; }
		
			//echo base64_encode('31');die;
		} 
		
		// for reservation
		function reservation($data=null)
		{
			$this->set('title_for_layout','CONFIRM YOUR RESERVATION : Guestnest');
			
			if(!empty($data))
			{
				$booking_id=base64_decode($data);
				$user_id=$this->Auth->user('id');
				$force_profile=$this->DATA->force($this->Auth->user('id'));
				
				if($force_profile['card'] == 0) // check card info save or not 
				{ 
					$this->Session->setFlash(__('Pleasee complete your account details before booking'),'default', array('class'=>'message error'));
					$this->redirect(array('controller'=>'settings','action'=>'card_set'));
					
					$this->set('IsCard','no');
				}
				else { $this->set('IsCard','yes'); }
				$booking=$this->Booking->find('first',array('recursive'=>2,
				'conditions'=>array('Booking.user_id'=>$user_id,'Booking.id'=>$booking_id,'Booking.status'=>'0','Booking.accepted'=>'1')));
				if(!empty($booking))
				{
					
					$conditions = array('Booking.start_date <=' => $booking['Booking']['end_date'],
					'Booking.end_date >=' => $booking['Booking']['start_date'],'Booking.room_id'=>$booking['Booking']['room_id'],'Booking.status'=>1);
					$GET_data = $this->Booking->find('first', array(
					'conditions' =>$conditions,
					));
					if(!empty($GET_data)){
						$this->Booking->updateAll( array('Booking.status' => '3'), array('Booking.id'=>$booking_id));
						$this->Session->setFlash(__("Success"), 'default', array('class'=>'message error'),'BookByOther');
						$this->redirect(array('controller'=>'homes','action'=>'message'));
					}
					
					
					
					$hourdiff = round((strtotime($booking['Booking']['accept_date']) - strtotime(DATE))/3600, 1);
					if($hourdiff > 12)
					{
						$this->Booking->updateAll( array('Booking.status' => '3'), array('Booking.id'=>$booking_id) );
						$this->Session->setFlash(__("Success"), 'default', array('class'=>'message error'),'time_out');
						$this->redirect(array('controller'=>'homes','action'=>'message'));
					}
				
					$BankAc=$this->DATA->GetBankAc(ME);
					if(!empty($BankAc))
					{
						$this->set('BankAc',$BankAc);
						if($BankAc['BankAccount']['is_auth'] == 1){	$this->set('bank','yes'); }
					else { $this->set('bank','no'); }
					}else { $this->set('bank','no'); }
					$this->set('book',$booking);
				}
				else 
				{
					$this->Session->setFlash(__("Success"), 'default', array('class'=>'message error'),'expire');
					$this->redirect(array('controller'=>'homes','action'=>'message'));
				}
			//}
		}
		else 
				{
					//echo base64_encode('36');die;
					$this->layout='404';
				}
	if($this->RequestHandler->isAjax())
	 {	
		if(!empty($this->data))
		{	
			//pr($this->data);die;
			$payment_amount=$this->DATA->GuestPayment($this->data['booking_id']);
			$user_id=$this->Auth->user('id');
			//user / guest info 
			$user_mob=$this->DATA->GetUserData($user_id,'mobile'); // user mobile no
			$guest_name=$this->DATA->GetUserData($user_id,'first_name')." ".$this->DATA->GetUserData($user_id,'last_name');
			$user_email=$this->DATA->GetUserData($user_id,'email'); // user email
			$room_title=$this->DATA->GetRoomData($this->data['room_id'],'title');
			//host info
			$host_id=$this->data['host_id'];
			$host_mob=$this->DATA->GetUserData($host_id,'mobile'); // host mobile no
			$host_name=$this->DATA->GetUserData($host_id,'first_name')." ".$this->DATA->GetUserData($host_id,'last_name');
			$host_email=$this->DATA->GetUserData($host_id,'email'); // host email
			// booking info  start_date
			$Booking_StartDate = $this->DATA->GetBookingData($this->data['booking_id'],$user_id,'start_date');
			$Book_Sc_date = strtotime("30 day", strtotime($Booking_StartDate));
			$Next_schedu_date= date("m/d/Y", $Book_Sc_date);
			
			if(isset($this->data['terms']))
			{
				$count=count($this->data['terms']);
			}
			else{ $count=0; }
			
			if($this->data['room_conf'] !="yes" || $this->data['date_conf'] !="yes" ||  $this->data['rent_conf'] !="yes" )
			{ echo '<div class="message error" id="msgMessage">If you found thats information is incorrect then you need to make new booking request</div>'; }
			elseif($count != $this->data['t_rule'])
			{	echo '<div class="message error" id="msgMessage">Must accept all CONFIRM POLICIES</div>';	}
			else if(!isset($this->data['policy'])) 
			{	echo '<div class="message error" id="msgMessage">Must accept T&C</div>';	}
			else if(!isset($this->data['card']))
			{ 	echo '<div class="message error" id="msgMessage">Please select payment method</div>';	}
			else{
				if($this->data['card'] == "card")
				{
					$card_data=$this->SendCard->find('first',array(
					'conditions'=>array('SendCard.user_id'=>$user_id)
					));
					
					$card_type=$card_data['SendCard']['card_type'] ;
		            $card_name= $card_data['SendCard']['card_name'];
		            $card_number=$this->Crypter->deCrypt($card_data['SendCard']['card_number']);
		            $card_month=$card_data['SendCard']['month'] ;
		            $card_year=$card_data['SendCard']['year'];
		            $card_cvv= $card_data['SendCard']['card_ccv'];
		            $user_name=$card_data['SendCard']['first_name'];
					$last_name=$card_data['SendCard']['last_name'];
					$address=$card_data['SendCard']['address'];
					$city=$card_data['SendCard']['city'];
					$state=$card_data['SendCard']['state'];
					$country=$card_data['SendCard']['country'];
					$zipcode=$card_data['SendCard']['zipcode'];
					
				}elseif ($this->data['card'] == "payment")
				{
					$card_type=$this->data['RoomPayment']['card_type'];
		            $card_name= $this->data['RoomPayment']['card_name'];
		            $card_number=$this->data['RoomPayment']['card_number']; 
		            $card_month=$this->data['RoomPayment']['cc_expires']['month'];
		            $card_year=$this->data['RoomPayment']['cc_expires']['year'];
		            $card_cvv= $this->data['RoomPayment']['card_ccv'];
		            $user_name=$this->data['RoomPayment']['first_name'];
					$last_name=$this->data['RoomPayment']['last_name'];
					$address=$this->data['RoomPayment']['address'];
					$city=$this->data['RoomPayment']['city'];
					$state=$this->data['RoomPayment']['state'];
					$country=$this->data['RoomPayment']['country'];
					$zipcode=$this->data['RoomPayment']['zipcode'];
										
					
				}elseif($this->data['card']=='bank')
				{
					$BankAc=$this->DATA->GetBankAc($user_id);
					$bank_account_number= $this->Crypter->deCrypt($BankAc['BankAccount']['account_number']);
		            $bank_routing_number=$this->Crypter->deCrypt($BankAc['BankAccount']['routing_number']);
		            $bank_type=$BankAc['BankAccount']['type'];
		            $user_name=$BankAc['BankAccount']['first_name'];
					$last_name=$BankAc['BankAccount']['last_name'];
					$address=$BankAc['BankAccount']['address'];
					$city=$BankAc['BankAccount']['city'];
					$state=$BankAc['BankAccount']['state'];
					$country=$BankAc['BankAccount']['country'];
					$zipcode=$BankAc['BankAccount']['zipcode'];
				}
			if($this->data['card']=='bank') { $payment_type='bank'; } else{ $payment_type="card"; }
				
			if ($this->data['card'] == "payment")
				{
					if(empty($card_type) || empty($card_name) || empty($card_number) || empty($card_month) || empty($card_year) || empty($card_cvv) || empty($user_name) || empty($last_name) || empty($address) || empty($city) || empty($state) || empty($country) || empty($zipcode)  )
					{
						echo '<div class="message error" id="msgMessage">Credit card field is required.</div>'; exit;
					}
				} 
				if($this->data['stay'] == "d")
				{
					$consumer_id=uniqid();
					$total_stay=$Day_term=$this->data['term'];
					$total_rent=$this->data['rent'];
					$tot_amt=$this->data['deposit']+$total_rent;
					
					$BookData=$this->Booking->find('first',array('recursive'=>-1,
				'conditions'=>array('Booking.user_id'=>ME,'Booking.id'=>$this->data['booking_id'],'Booking.status'=>'0')));
					if(empty($BookData))
					{
						echo '<div class="message error" id="msgMessage">Network error please reload page.</div>'; die;
					}
					else{ $current_rent=$this->DATA->GetBookingRentNew($this->data['booking_id']); }
					if($current_rent['rent_month'] !=0)
		              	{ 
		              		if($total_stay >= 30)
		              		{
		              			$GtAmount=$current_rent['rent_month'];
		              			$IsMonth='yes';
		              		}
		              		else {
		              			$GtAmount=$BookData['Booking']['total_stay'] * $current_rent['rent'];
		              			$IsMonth='no';
		              		}
		              	}
		              	else{
		              		$GtAmount=$BookData['Booking']['total_stay'] * $current_rent['rent'];
		              		$IsMonth='no';
		              	}
					
					if( $IsMonth == "yes")
					{
						$n_day=$total_stay - 30;
						$sch_amt=$this->DATA->AuotScheduleDate($n_day,DATE);
					}else{ $sch_amt=0; }
					
					/*if($sch_amt != 0)
					{ foreach ($sch_amt as $smt)
						{
							if($smt['day'] > 0){
							echo $current_rent['rent_month'];
							echo "<br>";
							echo $rent_d=$current_rent['rent_month'] / 30;
							echo "<br>";
							echo $amt=$smt['day'] * $rent_d;
							echo "<br>";
							$schj_date=$smt['date'];
							$schj_day=$smt['day'];
							}
						}
					}
					pr($sch_amt);die;*/
					
		              	
					if($payment_type == "card"){
						$output_transaction ="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=10&pg_consumer_id=".$consumer_id."&pg_total_amount=".$tot_amt."&ecom_billto_postal_name_first=".$user_name."&ecom_billto_postal_name_last=".$last_name."&ecom_billto_postal_street_line1=".$address."&ecom_billto_postal_city=".$city."&ecom_billto_postal_stateprov=".$state."&ecom_billto_postal_postalcode=".$zipcode."&Ecom_payment_card_type=".$card_type."&ecom_payment_card_name=".$card_name."&ecom_payment_card_number=".$card_number."&ecom_payment_card_expdate_month=".$card_month."&ecom_payment_card_expdate_year=".$card_year."&ecom_payment_card_verification=".$card_cvv."&pg_avs_method=22000&endofdata&";
					}elseif($payment_type == "bank")
					{
						$output_transaction="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=20&pg_consumer_id=".$consumer_id."&pg_total_amount=".$tot_amt."&ecom_billto_postal_name_first=".$user_name."&ecom_billto_postal_name_last=".$last_name."&ecom_billto_postal_street_line1=".$address."&ecom_billto_postal_city=".$city."&ecom_billto_postal_stateprov=".$state."&ecom_billto_postal_postalcode=".$zipcode."&ecom_payment_check_account_type=".$bank_type."&ecom_payment_check_account=".$bank_account_number."&ecom_payment_check_trn=".$bank_routing_number."&pg_avs_method=00000&endofdata&";
					}
					$get_payment=$this->Payment->direct_payment($output_transaction);
					if($get_payment['response_code']== "A01"){
						echo "<script>document.getElementById('send_request').style.display ='none';</script>";
						echo "<script>document.getElementById('inactive_btn').style.display ='block';</script>";
						
					if ($this->data['card'] == "payment")
					{
					$chk_card_data=$this->SendCard->find('first',array('conditions'=>array('SendCard.user_id'=>$user_id)));
					if(!empty($chk_card_data)){
						$this->request->data['SendCard']['id']=$chk_card_data['SendCard']['id'];}
						$this->request->data['SendCard']['user_id']=$user_id;
						$this->request->data['SendCard']['first_name']=$user_name;
						$this->request->data['SendCard']['last_name']=$last_name;
						$this->request->data['SendCard']['address']=$address;
						$this->request->data['SendCard']['city']=$city;
						$this->request->data['SendCard']['state']=$state;
						$this->request->data['SendCard']['zipcode']=$zipcode;
						$this->request->data['SendCard']['country']=$country;
						$this->request->data['SendCard']['card_type']=$card_type;
						$this->request->data['SendCard']['card_name']=$card_name;
						$this->request->data['SendCard']['card_number']=$this->Crypter->enCrypt($card_number);
						$this->request->data['SendCard']['month']=$card_month;
						$this->request->data['SendCard']['year']=$card_year;
						$this->request->data['SendCard']['card_ccv']=$card_cvv;
						$this->request->data['SendCard']['is_auth']='yes';
						if($this->SendCard->save($this->request->data))
						{
						}
					}
						
						
						$this->RoomPayment->create();
						$this->RoomPayment->set('user_id',$user_id);
						$this->RoomPayment->set('host_id',$this->data['host_id']);
						$this->RoomPayment->set('room_id',$this->data['room_id']);
						$this->RoomPayment->set('booking_id',$this->data['booking_id']);
						$this->RoomPayment->set('deposit',$this->data['deposit']);
						$this->RoomPayment->set('rent',$total_rent);
						$this->RoomPayment->set('total_amount',$tot_amt);
						$this->RoomPayment->set('consumer_id',$consumer_id);
						$this->RoomPayment->set('trace_number',$get_payment['trace_number']);
						$this->RoomPayment->set('payment_type','direct');
						$this->RoomPayment->set('payment_by',$payment_type);
						$this->RoomPayment->set('authorization_code',$get_payment['authorization_code']);
						$this->RoomPayment->set('payment_status','success');
						if($this->RoomPayment->save(null , false))
						{
							$room_payment_id= $this->RoomPayment->getLastInsertId();
							$this->Booking->updateAll( array('Booking.status' => '1'), array('Booking.id' =>$this->data['booking_id'],'Booking.user_id'=>$user_id ));
							$this->Session->setFlash(__("Success"), 'default', array('class'=>'message error'),'payment_done');
							$room_title=$this->DATA->GetRoomData($this->data['room_id'],'title'); // get Room title
							
							if($sch_amt != 0)
							{ foreach ($sch_amt as $smt)
								{
									if($smt['day'] > 0){
									$rent_d=$current_rent['rent_month'] / 30;
									$amt1=$smt['day'] * $rent_d;
									$amt=round($amt1,2);
									$schj_date=$smt['date'];
									
									$this->ScheduledPayment->create();
									$this->ScheduledPayment->set('booking_id',$this->data['booking_id']);
									$this->ScheduledPayment->set('room_id',$this->data['room_id']);
									$this->ScheduledPayment->set('room_payment_id',$room_payment_id);
									$this->ScheduledPayment->set('type','day');
									$this->ScheduledPayment->set('days',$smt['day']);
									$this->ScheduledPayment->set('amount',$amt);
									$this->ScheduledPayment->set('scheduled_date',$schj_date);
									$this->ScheduledPayment->save(null , false);
									}
								}
							}
							
								//send sms both host and guest
								if(!empty($user_mob))
								{ 
								$mob=$user_mob;
								$SmsToUser = array($user_mob =>$guest_name);
								$SMSmessage=$this->DATA->MySms('PaymentSuccessfullGuest',array('TITLE'=>$room_title));
								$this->DATA->SendSMS($SmsToUser,$SMSmessage);  }
								if(!empty($host_mob))
								{ 
								$mob1=$host_mob;
								$SmsToUser1 = array($host_mob =>$host_name);
								$SMSmessage1=$this->DATA->MySms('PaymentSuccessfull',array('USERNAME'=>$guest_name));
								$this->DATA->SendSMS($SmsToUser1,$SMSmessage1);  }
								//end of msg
								
							//deshboard noti
							
							//deshboard noti
							$room_title=$this->DATA->GetRoomData($this->data['room_id'],'title'); // get Room title
							//$note_data ="$room_title has been booked";
							$note_data =$this->DATA->MyNotification('BookingSuccessful',array('NAME'=>$room_title));
							$this->DATA->sendNotification($user_id,$note_data);
							$note_data_host =$this->DATA->MyNotification('BookingSuccessfulHost',array('NAME'=>$room_title));
							$this->DATA->sendNotification($host_id,$note_data_host);
							
							//end
							
							//dashboard message 
								$this->DATA->sendMsgDashboard($host_id,'BookingSuccessHost',array('ROOMTITLE'=>$room_title,'GUEST'=>$user_name));
								$this->DATA->sendMsgDashboard($user_id,'BookingSuccessGuest',array('ROOMTITLE'=>$room_title));
								
							//send email
							$StartDate=$this->DATA->GetBookingData($this->data['booking_id'],$user_id,'start_date');
							$EndDate=$this->DATA->GetBookingData($this->data['booking_id'],$user_id,'end_date');
							
							$recurring="No set";
							$encode_roomid=base64_encode($this->data['booking_id']);
							$agreement=SITEURL."homes/rental_agreement/".$encode_roomid;
							$this->THmail->RoomPayment($user_email,$user_name,$room_title,$StartDate,$EndDate,$this->data['deposit'],$total_rent,$recurring,$agreement,DATE);
							$this->THmail->RoomPaymentDetailsHost($host_email,$host_name,$room_title,$user_name,$StartDate,$EndDate,$this->data['deposit'],$total_rent,$recurring,$agreement,DATE);
							// end of email
							//echo '<div class="message error" id="msgMessage">"'.$get_payment['response_description'].'"</div>';
							echo '<script>window.location = "'.SITEURL.'homes/message"</script>';
						}
						
					}
					else{
			
						echo '<div class="message error" id="msgMessage">"'.$get_payment['response_description'].'"</div>';
					}
					
				}
			elseif($this->data['stay'] == "m")
				{
					$consumer_id=uniqid();
					$tot_amt=$this->data['deposit']+$this->data['rent'];
					$user_payment_method=$this->DATA->GetUserData($user_id,'payment_method');
					$tot_month=$this->DATA->GetBookingData($this->data['booking_id'],$user_id,'total_stay');
					$room_rent=$this->DATA->GetBookingData($this->data['booking_id'],$user_id,'room_rent'); // without admn fee
					$tot_sch=$tot_month-1;
					
				
				if($user_payment_method == 1)  // if user select recurring payment method
				{
					if($tot_sch > 0){
						
					if($payment_type == 'card'){	
						$output_transaction ="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_total_amount=".$tot_amt."&pg_schedule_quantity=".$tot_sch."&pg_consumer_id=".$consumer_id."&pg_schedule_frequency=20&pg_schedule_recurring_amount=".$this->data['rent']."&pg_transaction_type=10&pg_schedule_start_date=".$Next_schedu_date."&ecom_billto_postal_name_first=".$user_name."&ecom_billto_postal_name_last=".$last_name."&ecom_billto_postal_street_line1=".$address."&ecom_billto_postal_city=".$city."&ecom_billto_postal_stateprov=".$state."&ecom_billto_postal_postalcode=".$zipcode."&Ecom_payment_card_type=".$card_type."&ecom_payment_card_name=".$card_name."&ecom_payment_card_number=".$card_number."&ecom_payment_card_expdate_month=".$card_month."&ecom_payment_card_expdate_year=".$card_year."&ecom_payment_card_verification=".$card_cvv."&pg_avs_method=22000&endofdata&";
						}else{
						$output_transaction="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_total_amount=".$tot_amt."&pg_schedule_quantity=".$tot_sch."&pg_consumer_id=".$consumer_id."&pg_schedule_frequency=20&pg_schedule_recurring_amount=".$this->data['rent']."&pg_transaction_type=20&pg_schedule_start_date=".$Next_schedu_date."&ecom_billto_postal_name_first=".$user_name."&ecom_billto_postal_name_last=".$last_name."&ecom_billto_postal_street_line1=".$address."&ecom_billto_postal_city=".$city."&ecom_billto_postal_stateprov=".$state."&ecom_billto_postal_postalcode=".$zipcode."&ecom_payment_check_account_type=".$bank_type."&ecom_payment_check_account=".$bank_account_number."&ecom_payment_check_trn=".$bank_routing_number."&pg_avs_method=00000&endofdata&";
						}
					}else{
						if($payment_type == 'card'){
						$output_transaction ="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=10&pg_consumer_id=".$consumer_id."&pg_total_amount=".$tot_amt."&ecom_billto_postal_name_first=".$user_name."&ecom_billto_postal_name_last=".$last_name."&ecom_billto_postal_street_line1=".$address."&ecom_billto_postal_city=".$city."&ecom_billto_postal_stateprov=".$state."&ecom_billto_postal_postalcode=".$zipcode."&Ecom_payment_card_type=".$card_type."&ecom_payment_card_name=".$card_name."&ecom_payment_card_number=".$card_number."&ecom_payment_card_expdate_month=".$card_month."&ecom_payment_card_expdate_year=".$card_year."&ecom_payment_card_verification=".$card_cvv."&pg_avs_method=22000&endofdata&";
						}else {
							$output_transaction="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=20&pg_consumer_id=".$consumer_id."&pg_total_amount=".$tot_amt."&ecom_billto_postal_name_first=".$user_name."&ecom_billto_postal_name_last=".$last_name."&ecom_billto_postal_street_line1=".$address."&ecom_billto_postal_city=".$city."&ecom_billto_postal_stateprov=".$state."&ecom_billto_postal_postalcode=".$zipcode."&ecom_payment_check_account_type=".$bank_type."&ecom_payment_check_account=".$bank_account_number."&ecom_payment_check_trn=".$bank_routing_number."&pg_avs_method=00000&endofdata&";	
						}
					}	
				}
				elseif ($user_payment_method == 2){  // if user select manaul payment method
					if($payment_type == 'card'){
					$output_transaction ="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=10&pg_consumer_id=".$consumer_id."&pg_total_amount=".$tot_amt."&ecom_billto_postal_name_first=".$user_name."&ecom_billto_postal_name_last=".$last_name."&ecom_billto_postal_street_line1=".$address."&ecom_billto_postal_city=".$city."&ecom_billto_postal_stateprov=".$state."&ecom_billto_postal_postalcode=".$zipcode."&Ecom_payment_card_type=".$card_type."&ecom_payment_card_name=".$card_name."&ecom_payment_card_number=".$card_number."&ecom_payment_card_expdate_month=".$card_month."&ecom_payment_card_expdate_year=".$card_year."&ecom_payment_card_verification=".$card_cvv."&pg_avs_method=22000&endofdata&";
					}else {
							$output_transaction="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=20&pg_consumer_id=".$consumer_id."&pg_total_amount=".$tot_amt."&ecom_billto_postal_name_first=".$user_name."&ecom_billto_postal_name_last=".$last_name."&ecom_billto_postal_street_line1=".$address."&ecom_billto_postal_city=".$city."&ecom_billto_postal_stateprov=".$state."&ecom_billto_postal_postalcode=".$zipcode."&ecom_payment_check_account_type=".$bank_type."&ecom_payment_check_account=".$bank_account_number."&ecom_payment_check_trn=".$bank_routing_number."&pg_avs_method=00000&endofdata&";	
						}
				}
				else{  // in not set nothing recurring apply
						echo "Ooops, server porblem ! Please contact to webmaster "; die;			
				}
					$get_payment=$this->Payment->direct_payment($output_transaction);
					if($get_payment['response_code']== "A01"){
						echo "<script>document.getElementById('send_request').style.display ='none';</script>";
						echo "<script>document.getElementById('inactive_btn').style.display ='block';</script>";
						$this->RoomPayment->create();
						$this->RoomPayment->set('user_id',$user_id);
						$this->RoomPayment->set('host_id',$this->data['host_id']);
						$this->RoomPayment->set('room_id',$this->data['room_id']);
						$this->RoomPayment->set('booking_id',$this->data['booking_id']);
						$this->RoomPayment->set('deposit',$this->data['deposit']);
						$this->RoomPayment->set('rent',$this->data['rent']);
						$this->RoomPayment->set('total_amount',$tot_amt);
						$this->RoomPayment->set('consumer_id',$consumer_id);
						$this->RoomPayment->set('trace_number',$get_payment['trace_number']);
						if($user_payment_method == 1){
						$this->RoomPayment->set('payment_type','recurring');
						}else{ $this->RoomPayment->set('payment_type','manual');  }
						$this->RoomPayment->set('payment_by',$payment_type);
						$this->RoomPayment->set('authorization_code',$get_payment['authorization_code']);
						$this->RoomPayment->set('payment_status','success');
						if($this->RoomPayment->save(null , false))
						{
							if ($this->data['card'] == "payment")
								{
								$chk_card_data=$this->SendCard->find('first',array('conditions'=>array('SendCard.user_id'=>$user_id)));
								if(!empty($chk_card_data)){
									$this->request->data['SendCard']['id']=$chk_card_data['SendCard']['id'];}
									$this->request->data['SendCard']['user_id']=$user_id;
									$this->request->data['SendCard']['first_name']=$user_name;
									$this->request->data['SendCard']['last_name']=$last_name;
									$this->request->data['SendCard']['address']=$address;
									$this->request->data['SendCard']['city']=$city;
									$this->request->data['SendCard']['state']=$state;
									$this->request->data['SendCard']['zipcode']=$zipcode;
									$this->request->data['SendCard']['country']=$country;
									$this->request->data['SendCard']['card_type']=$card_type;
									$this->request->data['SendCard']['card_name']=$card_name;
									$this->request->data['SendCard']['card_number']=$this->Crypter->enCrypt($card_number);
									$this->request->data['SendCard']['month']=$card_month;
									$this->request->data['SendCard']['year']=$card_year;
									$this->request->data['SendCard']['card_ccv']=$card_cvv;
									$this->request->data['SendCard']['is_auth']='yes';
									if($this->SendCard->save($this->request->data))
									{ }}
									
							$room_payment_id= $this->RoomPayment->getLastInsertId();
							$this->Booking->updateAll( array('Booking.status' => '1'), array('Booking.id' =>$this->data['booking_id'],'Booking.user_id'=>$user_id ));
							if($user_payment_method == 1 ) { $type='recurring'; } else { $type='manual'; }
							$move_in_date=$Booking_StartDate;
							$i = 1;
							if($tot_sch > 0 ){
								while ($i <= $tot_sch) 
								{
									$sh_date =date("Y-m-d", strtotime("+30 day", strtotime($move_in_date)));
									$this->ScheduledPayment->create();
									$this->ScheduledPayment->set('booking_id',$this->data['booking_id']);
									$this->ScheduledPayment->set('room_id',$this->data['room_id']);
									$this->ScheduledPayment->set('room_payment_id',$room_payment_id);
									$this->ScheduledPayment->set('type',$type);
									$this->ScheduledPayment->set('amount',$room_rent);
									$this->ScheduledPayment->set('scheduled_date',$sh_date);
									$this->ScheduledPayment->save(null , false);
									$i++;
									$move_in_date=$sh_date;
								}
							}
							$this->Session->setFlash(__("Success"), 'default', array('class'=>'message error'),'payment_done');
								//send sms both host and guest
							if(!empty($user_mob))
								{ 
								$mob=$user_mob;
								$SmsToUser = array($user_mob =>$guest_name);
								$SMSmessage=$this->DATA->MySms('PaymentSuccessfullGuest',array('TITLE'=>$room_title));
								$this->DATA->SendSMS($SmsToUser,$SMSmessage);  }
								if(!empty($host_mob))
								{ 
								$mob1=$host_mob;
								$SmsToUser1 = array($host_mob =>$host_name);
								$SMSmessage1=$this->DATA->MySms('PaymentSuccessfull',array('USERNAME'=>$guest_name));
								$this->DATA->SendSMS($SmsToUser1,$SMSmessage1);  }
								//end of msg
								
							//deshboard noti
							$room_title=$this->DATA->GetRoomData($this->data['room_id'],'title'); // get Room title
							//$note_data ="$room_title has been booked";
							$note_data =$this->DATA->MyNotification('BookingSuccessful',array('NAME'=>$room_title));
							$this->DATA->sendNotification($user_id,$note_data);
							$note_data_host =$this->DATA->MyNotification('BookingSuccessfulHost',array('NAME'=>$room_title));
							$this->DATA->sendNotification($host_id,$note_data_host);
							
							//end
							//dashboard message  BookingSuccessHost  
								
								$this->DATA->sendMsgDashboard($host_id,'BookingSuccessHost',array('ROOMTITLE'=>$room_title,'GUEST'=>$user_name));
								$this->DATA->sendMsgDashboard($user_id,'BookingSuccessGuest',array('ROOMTITLE'=>$room_title));
								
							//send email
							$StartDate=$this->DATA->GetBookingData($this->data['booking_id'],$user_id,'start_date');
							$EndDate=$this->DATA->GetBookingData($this->data['booking_id'],$user_id,'end_date');
							$rent_term1=$this->DATA->GetBookingData($this->data['booking_id'],$user_id,'rent_term');
							$open_ended1=$this->DATA->GetBookingData($this->data['booking_id'],$user_id,'open_ended');
							if($user_payment_method == 1){ $recurring="Start"; } else{	$recurring="No set : payment method is manual"; }
							$encode_roomid=base64_encode($this->data['booking_id']);
							$agreement=SITEURL."homes/rental_agreement/".$encode_roomid;
							if($rent_term1 == 'm' && $open_ended1 == '0')
							{ $EndDate2='month-to-month'; }
							else { $EndDate2= date("m-d-Y",strtotime($EndDate));}
							$this->THmail->RoomPayment($user_email,$user_name,$room_title,$StartDate,$EndDate2,$this->data['deposit'],$this->data['rent'],$recurring,$agreement,DATE);
							$this->THmail->RoomPaymentDetailsHost($host_email,$host_name,$room_title,$user_name,$StartDate,$EndDate2,$this->data['deposit'],$this->data['rent'],$recurring,$agreement,DATE);
							$remberdate= date("Y-m-d");
							if($StartDate == $remberdate){ 
								$this->THmail->MoveInReminderGuest($user_email,$user_name,$room_title,$StartDate);
							}
							// end of email			
							
							echo '<script>window.location = "'.SITEURL.'page/about-move-in-process"</script>';
						}
				}
				else{
					echo '<div class="message error" id="msgMessage">"'.$get_payment['response_description'].'"</div>';
				}
			}
				
				
			}
			
			echo '<script>document.getElementById("loading").style.display = "none";</script>';
			exit;
			//echo $count=count($this->data['terms']);
			//$this->Session->setFlash(__('Slider Image Has Been Remove.'),'default', array('class'=>'message success'),'msg');
		}		
	 }
				
		}
		
		
	function page($url=null)
	{
	if(isset($url))
			{
				$page_data =  $this->Page->find('first',array('conditions' => array('Page.url' => $url)));	
				if(!empty($page_data)){
				$this->set('title_for_layout', $page_data['Page']['title'].' : Guestnest');
				$this->set('page',$page_data);
				$page_meta=array('des'=>$page_data['Page']['description'],'key'=>$page_data['Page']['keyword']);
				$this->set('page_meta',$page_meta);
					}else{
					$this->layout = "404";
					}
			}
		else{ $this->layout = "404";	}
	}	
		
	function contact_host($host_id=null,$room_id=null)
	{
		$cur_url=urlencode(SITEURL."room/".$room_id."/msg");
		if(!empty($host_id))
		{
			if($this->Auth->user('id') !="")
			{	$this->set('host_id',$host_id);
				$name=$this->DATA->GetUserData($host_id,'first_name')." ".$this->DATA->GetUserData($host_id,'last_name');
				$this->set('name',$name);
			}
			else{ $this->set('force_login',$cur_url);	}
		}
	}
	
	function message_to_host()
	{
		
		$this->layout=false;
		if($this->RequestHandler->isAjax())
		  {
		  
				$user_id=$this->Auth->user('id');
				$sub=$this->data['sub'];
				$msg=$this->DATA->FiltarString($this->data['msg']);
				$host_id=$this->data['host_id'];
				$guest_name=$this->DATA->GetUserData($user_id,'first_name')." ".$this->DATA->GetUserData($user_id,'last_name');
				$host_name=$this->DATA->GetUserData($host_id,'first_name')." ".$this->DATA->GetUserData($host_id,'last_name');
				$host_email=$this->DATA->GetUserData($host_id,'email');
				$host_mob=$this->DATA->GetUserData($host_id,'mobile');
				$id=$this->DATA->Send_Message($user_id,$host_id,$sub,$msg);
				$IsMail=$this->DATA->IsSend('UserMailAlert',$host_id,'receive_message');
				$IsSMS=$this->DATA->IsSend('UserMobileAlert',$host_id,'receive_message');
				if($id == "0")
				{	echo '<div id="new" style="text-align: center; font-size: 20px; font-weight: bold; color: red;">Oops network error. please reload page and resend message</div>'; exit;	}
				else{ 
					if($IsMail == 1) { $this->THmail->HostContact($host_email,$host_name,$guest_name,$msg); }
					if($IsSMS == 1) { 
								if(!empty($host_mob))
									{ 
									$SmsToUser = array($host_mob =>$host_name);
									$SMSmessage=$this->DATA->MySms('HostContact',array('USERNAME'=>$guest_name));
									$this->DATA->SendSMS($SmsToUser,$SMSmessage);  
									}
					}
					echo '<div id="new" style="text-align: center; font-size: 20px; font-weight: bold; color: green;">Message send successfully.</div>'; exit; }
 
		  }	
	}
	
	
	function manual()
	{
		
		
		$payment_type = $this->RoomPayment->find('first',array('conditions'=>
		array('RoomPayment.user_id'=>54,'RoomPayment.booking_id'=>1,'OR'=>array('RoomPayment.payment_type'=>'manual','RoomPayment.payment_type'=>'recurring'))));
		pr($payment_type);die('aa');
		//pr($book['Booking']);
				$start_date='2012-11-15';
				$end_date='2013-11-15';
				// get alert date 
				$timestamp = strtotime("-5 day", strtotime($start_date));
				$alert_date= date("d", $timestamp);
				// genrate alert date for every month
				$booking_Date= date('Y-m', strtotime(DATE));
				
				echo $alet_day= $booking_Date."-".$alert_date;   // after this date payment button appear 
				echo $let_fee =date("Y-m-d", strtotime("+6 day", strtotime($alet_day))); //after this date guest pay pay
				
				exit;
	}
	
	function monthly_alert($id=null)
	{
		
	if($id == C_URL)
	{	
		$booking=$this->Booking->find('all',array(
				'recursive'=>1,
				'conditions'=>array(
				'Booking.status'=>'1','Booking.accepted'=>'1','Booking.move_in'=>1,'Booking.rent_term'=>'m')));
		
		if(!empty($booking))
		{
			foreach ($booking as $book)
			{
				//pr($book['Booking']);
				$start_date=$book['Booking']['start_date'];
				$end_date=$book['Booking']['end_date'];
				// get alert date 
				$timestamp = strtotime("-5 day", strtotime($start_date));
				$alert_date= date("d", $timestamp);   
				// genrate alert date for every month
				$booking_Date= date('Y-m', strtotime(DATE));
				$alet_day= $booking_Date."-".$alert_date;
				if($alet_day == DATE)
				{
					//echo "Yes";
					$time_rent_date = strtotime("+5 day", strtotime($alet_day));
					$rent_date= date("Y-m-d", $time_rent_date); // next payment date 
					$room_rent=$book['Booking']['room_rent'];
					$guest_email=$book['User']['email'];
					$guest_name=$book['User']['first_name']." ".$book['User']['last_name'];
					$guest_id=$book['User']['id'];
					$room_title=$book['Room']['title'];
					
					//dashboard message 
					$sub="Montyly Room/place payment alert";
					$g_msg="your next room/place payment is near. please make sure you have enough blance in your account";
					$this->DATA->Send_Message('2',$guest_id,$sub,$g_msg);
					$this->THmail->MonthlyRentAlert($guest_email,$guest_name,$room_title,$rent_date,$book['Booking']['room_rent']);
					$this->THmail->cron('monthly rent alert','for '.$room_title);
				
				}
				else{ echo "No <br>"; 
				$this->THmail->cron('monthly rent alert','no rent this time ');
				}
				
			}	
			
		}
		die('end <br>');
	}
	else{
		die('access denied <br>');
	}
		
	}
	
 public function auto_cancel($id=null)
 {
 	$this->layout=false;
 	if($id == C_URL)
 	{
 		$new_date= date('Y-m-d H:i:s', strtotime('+48 hours', strtotime(DATE)));
 		 
 		$this->set('title_for_layout','Pending Move-in : Guestnest');
 		$conditions=array('Booking.status'=>'1',
	 						'Booking.accepted'=>'1',
	 						'Booking.move_in'=>0,
							'AND'=>array('Booking.start_date <='=>$new_date,'Booking.start_date <='=>DATE)
 		);
 		$data=$this->Booking->find('all',array('conditions' =>$conditions));
 		if(!empty($data))
 		{
 			//echo (count($data));

 			foreach ($data as $book)
 			{
 				$s_date=$book['Booking']['start_date']." 09:00:00";
 				$hourdiff = round((strtotime(DATE) - strtotime($s_date))/3600, 1);

 				if($hourdiff > 26 )    // if guest not move in that we  cancel her/his booking and return only rent and  deposti return to host
 				{	
 					$booking_id=$book['Booking']['id'];
 					$user_id=$book['Booking']['user_id'];
 					$admin_email= $this->DATA->AdminData('email');
 					
 					if(!empty($booking_id) && !empty($user_id))
 					{

 						$term=null;
 						$conditions = array('Booking.id' => $booking_id,'Booking.user_id'=>$user_id,'Room.status'=>1);
 						$data = $this->Booking->find('first', array('conditions' =>$conditions));
 						$booking_date=$data['Booking']['start_date'];
 						$days =ceil((strtotime($booking_date) - strtotime(DATE)) / (60 * 60 * 24));
 						// chk for booking payment
 						$pay_data=$this->DATA->Get_Payment_Data($booking_id,$user_id);

 						$admin_comm=$this->DATA->GetRoomData($data['Booking']['room_id'],'commission');
 						$admin_comm_for_both=$this->DATA->GetRoomData($data['Booking']['room_id'],'comm_for_both');

 						//data for email and message
 						$room_title=$this->DATA->GetRoomData($data['Booking']['room_id'],'title');
 						$user_mail=$this->DATA->GetUserData($user_id,'email');
 						$user_mobile=$this->DATA->GetUserData($user_id,'mobile');
 						$user_name=$this->DATA->GetUserData($user_id,'first_name')." ".$this->DATA->GetUserData($user_id,'last_name');
 						//host info
 						$host_id=$data['Booking']['host_id'];
 						$host_mail=$this->DATA->GetUserData($data['Booking']['host_id'],'email');
 						$host_mobile=$this->DATA->GetUserData($data['Booking']['host_id'],'mobile');
 						$host_name=$this->DATA->GetUserData($data['Booking']['host_id'],'first_name')." ".$this->DATA->GetUserData($data['Booking']['host_id'],'last_name');

 						//guest card info
 						$user_card=$this->DATA->Get_Card_Data($user_id);
 						//host card info
 						$host_card=$this->DATA->Get_Card_Data($host_id);
 						if($user_card != 0)
 						{
 							if($user_card['SendCard']['is_auth'] == "no" )
 							{	$IsGuestCart= 0;}
 							else
 							{ $IsGuestCart = 1;	}
 						}else{ $IsGuestCart = 0;  }

 						if($IsGuestCart == 0) { $this->THmail->AccountUpdate($user_name,$user_name,DATE); }	// end of # guest credit card 

 						if($host_card != 0)
 						{
 							if($host_card['SendCard']['is_auth'] == "no" )
 								{	$IsHostCart= 0;  }
 							else { $IsHostCart= 1; }
 						}else{ $IsHostCart= 0;  }

 						if($IsHostCart == 0) { $this->THmail->AccountUpdate($host_mail,$host_name,DATE); }	// end of # guest credit card
 						
 						if($IsHostCart == 1 &&  $IsGuestCart == 1 )
 						{
 							if($admin_comm < 10) { $admin_comm="0".$admin_comm; }
 							if($pay_data != 0){
 								$real_amt=$pay_data['deposit']+$pay_data['rent'];
 									
 								if($admin_comm_for_both == 1){	$deposit=$pay_data['deposit']/ ("1.".$admin_comm);}
 								else{ $deposit=$pay_data['deposit']; }
 								$rent=$pay_data['rent']/ ("1.".$admin_comm);
 								//Deposit after cancellation
 								$final_deposit=$deposit; //for guest
 								$final_rent=$rent;
 								//echo $total_refund=$final_deposit+$final_rent;echo "<br>";
 								$Admin_deposit=$real_amt-($deposit+$rent); // for admin

 								$user_DeCrypt_card_number=$this->Crypter->deCrypt($user_card['SendCard']['card_number']);
 								$host_DeCrypt_card_number=$this->Crypter->deCrypt($host_card['SendCard']['card_number']);
 								//refund to guest when she/he cancel his/her booking before move-in
 								$guest_transaction ="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=13&pg_total_amount=".$final_rent."&ecom_billto_postal_name_first=".$user_card['SendCard']['first_name']."&ecom_billto_postal_name_last=".$user_card['SendCard']['last_name']."&ecom_billto_postal_street_line1=".$user_card['SendCard']['address']."&ecom_billto_postal_city=".$user_card['SendCard']['city']."&ecom_billto_postal_stateprov=".$user_card['SendCard']['state']."&ecom_billto_postal_postalcode=".$user_card['SendCard']['zipcode']."&Ecom_payment_card_type=".$user_card['SendCard']['card_type']."&ecom_payment_card_name=".$user_card['SendCard']['card_name']."&ecom_payment_card_number=".$user_DeCrypt_card_number."&ecom_payment_card_expdate_month=".$user_card['SendCard']['month']."&ecom_payment_card_expdate_year=".$user_card['SendCard']['year']."&pg_avs_method=22000&endofdata&";
 								$get_payment=$this->Payment->direct_payment($guest_transaction);
 								//pr($get_payment);die('pay');

 								if($get_payment['response_code'] == 'A01')  // refund to guest
 								{
 									$this->Refund->create();
 									$this->Refund->set('user_id',$user_id);
 									$this->Refund->set('booking_id',$booking_id);
 									$this->Refund->set('room_payment_id',$pay_data['id']);
 									$this->Refund->set('deposit','0');
 									$this->Refund->set('rent',$final_rent);
 									$this->Refund->set('refund_amount',$final_rent);
 									$this->Refund->set('status','cancel');
 									$this->Refund->set('trace_number',$get_payment['trace_number']);
 									$this->Refund->set('authorization_code',$get_payment['authorization_code']);
 									$this->Refund->set('comment','Booking Cancel refund: guest not movie in');
 									if($this->Refund->save(null , false))
 									{

 										$guest_lid= $this->Refund->getLastInsertId();
 										//mail to guest for refund and cancel
 										$this->THmail->BookingCancel($user_mail,$user_name,$room_title,$data['Booking']['start_date'],$final_rent,DATE);

 										// chk for recurring payment data if booking is month to month
 										$last_payment_for_booking = $this->RoomPayment->find('first',array('conditions'=>
 										array('RoomPayment.booking_id'=>$booking_id,'RoomPayment.user_id'=>$user_id,'RoomPayment.payment_type'=>'recurring')));
 										if(!empty($last_payment_for_booking))
 										{
 											$trc_num=$last_payment_for_booking['RoomPayment']['trace_number'];
 											$ruc_transaction ="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=42&pg_original_trace_number=".$trc_num."&endofdata&";
 											$recurring_DELETE=$this->Payment->Delete_Recurring($ruc_transaction);
 											if($recurring_DELETE['response_code'] == 'A01')
 											{
 													
 												$this->Refund->set('user_id',$user_id);
 												$this->Refund->set('booking_id',$booking_id);
 												$this->Refund->set('room_payment_id',$pay_data['id']);
 												$this->Refund->set('deposit','0');
 												$this->Refund->set('rent','0');
 												$this->Refund->set('refund_amount','0');
 												$this->Refund->set('status','stop');
 												$this->Refund->set('trace_number',$recurring_DELETE['trace_number']);
 												$this->Refund->set('authorization_code',$recurring_DELETE['authorization_code']);
 												$this->Refund->set('comment','Recurring payment stop');
 												if($this->Refund->save(null , false))
 												{
 													$this->THmail->RecurringDelete($user_mail,$user_name,$room_title,$data['Booking']['start_date'],$recurring_DELETE['trace_number'],'Stop',DATE);
 												}
 											}
 										}
 									}

 									//send money to host
 									//refund to guest when she/he cancel his/her booking before move-in   host card info here  in $host_card array
 									$host_transaction ="pg_merchant_id=".merchant_id."&pg_password=".merchant_password."&pg_transaction_type=13&pg_total_amount=".$final_deposit."&ecom_billto_postal_name_first=".$host_card['SendCard']['first_name']."&ecom_billto_postal_name_last=".$host_card['SendCard']['last_name']."&ecom_billto_postal_street_line1=".$host_card['SendCard']['address']."&ecom_billto_postal_city=".$host_card['SendCard']['city']."&ecom_billto_postal_stateprov=".$host_card['SendCard']['state']."&ecom_billto_postal_postalcode=".$host_card['SendCard']['zipcode']."&Ecom_payment_card_type=".$host_card['SendCard']['card_type']."&ecom_payment_card_name=".$host_card['SendCard']['card_name']."&ecom_payment_card_number=".$host_DeCrypt_card_number."&ecom_payment_card_expdate_month=".$host_card['SendCard']['month']."&ecom_payment_card_expdate_year=".$host_card['SendCard']['year']."&pg_avs_method=22000&endofdata&";
 									$host_payment=$this->Payment->direct_payment($host_transaction);
 									if($host_payment['response_code'] == 'A01')
 									{
 										//$host_amt=null;
 										$this->Refund->create();
 										$this->Refund->set('user_id',$host_id);
 										$this->Refund->set('booking_id',$booking_id);
 										$this->Refund->set('room_payment_id',$pay_data['id']);
 										$this->Refund->set('deposit',$final_deposit);
 										$this->Refund->set('rent','0');
 										$this->Refund->set('refund_amount',$final_deposit);
 										$this->Refund->set('status','refund');
 										$this->Refund->set('trace_number',$host_payment['trace_number']);
 										$this->Refund->set('authorization_code',$host_payment['authorization_code']);
 										$this->Refund->set('comment','Refund form Canceled booking by guest (Guest not move in )');
 										if($this->Refund->save(null , false))
 										{
 											$host_lid= $this->Refund->getLastInsertId();
 											$this->THmail->BookingCancelHost($host_mail,$host_name,$room_title,$user_name,DATE,$data['Booking']['start_date'],$final_deposit,$host_payment['trace_number'],DATE);
 										}
 									}
 										
 									//AdminFund
 									$refun_ids=$guest_lid.",".$host_lid;
 									$this->AdminFund->create();
 									//$this->AdminFund->set('user_id',$host_id);
 									$this->AdminFund->set('room_payment_id',$pay_data['id']);
 									$this->AdminFund->set('booking_id',$booking_id);
 									$this->AdminFund->set('refund_id',$refun_ids);
 									$this->AdminFund->set('amt',$Admin_deposit);
 									$this->AdminFund->set('status','cancel');
 									$this->AdminFund->set('comment','Booking cancel by guest be for moive');
 									$this->AdminFund->save(null , false);
 										
 									$can_date=date("Y-m-d");
 									$this->Booking->updateAll( array('Booking.status' =>4,'Booking.cancel_date' =>$can_date),array('Booking.id' => $booking_id));
 									$this->THmail->cron('Booking cancel','booking cancel by corn guest not moved in'); 
 									//$this->Session->setFlash('Current Booking has been cancel.Deposit and rend has been transfer to host and guest Credit Card','default',array('class'=>'message success'),'msg');
 									//echo "<script>parent.location.reload();</script>";
 									//exit;

 										
 								}else{	
 									
 									$this->THmail->cron('Booking cancel error ','payment error'.$get_payment['response_description']);
 									echo '<div class="message error" id="msgMessage">"'.$get_payment['response_description'].'"</div>'; 	}
 							}
 							else{
 									
 								echo "Oops Server problem  .. Please reload page and try again !";
 							}
 						}else { $this->THmail->cron('Cron error . please done manual','host or guest card not valid for booking id '.$booking_id); echo "host or guest card not valid"; }
 					}else{ echo "wrong data in booking table"; } // end of // user id or booking is null // somehti is wrong with bookin data

 				} else{ 
 					
 					$this->THmail->cron('No move in this time','there is no any peding move in ');
 					echo "Wait <br>"; }  // booking under 48 hr 

 			} // end of foreach
 				
 		} else{ echo "empty  <br>";	} // end of // if result is empty

 	} else{ 	echo "access denied";	} // end of chekc id
 	die;
 } // end of function
	
 
 
 function test_mail($id=null)
 {
 	if(!empty($id))
 	{
 		if($this->THmail->cron('test','corn test') == 1)
 		{
 			echo "done";
 		}else{ echo "error"; }
 	}else { die('404'); }
 	die('exit');
 }
	public function help()
	{
		$this->layout = "help";
		$this->set('title_for_layout','Help : Guestnest');
		$this->HelpCategory->unbindModel(array('hasMany'=>array('Help')));
		$help_cats = $this->HelpCategory->find('all',array('limit'=>5,'conditions'=>array('HelpCategory.parent_id'=>0),'order'=>array('HelpCategory.id'=>'asc'),'recursive'=>1));
		//pr($help_cats);die;
		$this->set('help_cats',$help_cats);
		
		
		$pop_helps = $this->Help->find('all',array('conditions'=>array('Help.status'=>1),'order'=>array('Help.view'=>'desc'),'limit'=>20));
		$this->set('pop_helps',$pop_helps);
		$lat_helps = $this->Help->find('all',array('conditions'=>array('Help.status'=>1),'limit'=>5,'order'=>array('Help.id'=>'desc')));
		$this->set('lat_helps',$lat_helps);
		//pr($lat_helps);die;
	}
	public function help1()
	{
		$this->layout = "help";
		$this->set('title_for_layout','Help : Guestnest');
		$help_cats = $this->HelpCategory->find('all',array('limit'=>5,'conditions'=>array('HelpCategory.parent_id'=>0),'order'=>array('HelpCategory.id'=>'asc'),'recursive'=>1));
		//pr($help_cats);die;
		$this->set('help_cats',$help_cats);
		
		
		$pop_helps = $this->Help->find('all',array('conditions'=>array('Help.status'=>1),'order'=>array('Help.view'=>'desc'),'limit'=>20));
		$this->set('pop_helps',$pop_helps);
		$lat_nelps = $this->Help->find('all',array('conditions'=>array('Help.status'=>1),'limit'=>5,'order'=>array('Help.id'=>'desc')));
		$this->set('lat_nelps',$lat_nelps);
	}
	public function help_view()
	{ 
		if($this->RequestHandler->isAjax())
		{
			if(isset($_REQUEST['help_id']))
			{
				$help_id1 = $_REQUEST['help_id'];
				$exp = explode('_',$help_id1);
				$help_id = $exp[1];
				$view_data = $this->Help->find('first',array('conditions'=>array('Help.id'=>$help_id,'Help.status'=>1),'fields'=>array('view')));
				$view = $view_data['Help']['view'];
				$view++;
				$this->Help->id = $help_id;
				$this->Help->saveField('view',$view);
				exit;
			}
		}
		else
		{
			$this->layout = '404';
		}
	}
	public function help_search()
	{
		if($this->RequestHandler->isAjax())
		{
			if(isset($_REQUEST['keyword']))
			{
				$keyword = $_REQUEST['keyword'];
				$or['Help.title LIKE'] = '%'.$keyword.'%';
				$or['Help.post LIKE'] = '%'.$keyword.'%';
				//pr($or);
				$help_data = $this->Help->find('all',array('conditions'=>array('OR'=>$or),'group'=>array('Help.title')));
				//pr($help_data);die;
				$div_data = '<h2>Search Results</h2>';
				if($help_data)
				{
					foreach($help_data as $hd)
					{
						
						$div_data .= '<div class="faq-question-up" style="z-index: 41;" id="all_'.$hd['Help']['id'].'" >'.$hd['Help']['title'].'</div>';
						$div_data .= '<div style="display: none;" class="full-body-text-highlight-3" >'.$hd['Help']['post'].'</div>';
					}	
				}
				else
				{
					$div_data .= "No result found";
				}
				
				echo $div_data;exit;	
			}
		}
		else
		{
			$this->layout = "404";
		}
	}
	public function internship()
	{  //pr($this->request->data);die;
		if(!empty($this->request->data['Internship']))
		{ //pr($this->request->data);
			//echo mime_content_type($this->request->data['Internship']['resume']['tmp_name']);
			$this->Internship->set($this->request->data['Internship']);
			$vali = $this->Internship->validates();
			//pr($this->Internship->invalidFields());die;
			if($vali)
			{ 
				$flag1 = $flag2 = 0;
				$resume = $this->request->data['Internship']['resume'];
				//pr($this->request->data);die;
				if(isset($this->request->data['Internship']['resume']['error']) && $this->request->data['Internship']['resume']['error'] == 0)
				{  
					$name = $this->request->data['Internship']['resume']['name'];
					$arr_exe = explode(".",$name);
					foreach($arr_exe as $v)
						$exe = $v;				
					$name= uniqid('resume');
					$destination = realpath('data/internship') . '/';
					try
					{
						if(move_uploaded_file($this->request->data['Internship']['resume']['tmp_name'],$destination.$name.'.'.$exe))
						{
							$this->request->data['Internship']['resume'] = $name.'.'.$exe;
							$flag1 = 1;
							
						}
					}
					catch(Exception $e)
					{
						$this->Session->setFlash(__('Not able to upload resume'),'default', array('class'=>'message error'));
					}
					
					
				}
				else
				{
					$this->Session->setFlash(__('Error in resume uploading...'),'default', array('class'=>'message error'));
					
				}
				$resume = $this->request->data['Internship']['cover_letter'];
				//pr($this->request->data);die;
				if(isset($this->request->data['Internship']['cover_letter']['error']) && $this->request->data['Internship']['cover_letter']['error'] == 0)
				{  
					$name = $this->request->data['Internship']['cover_letter']['name'];
					$arr_exe = explode(".",$name);
					foreach($arr_exe as $v)
						$exe = $v;				
					$name= uniqid('cover_letter');
					$destination = realpath('data/internship') . '/';
					try
					{
						if(move_uploaded_file($this->request->data['Internship']['cover_letter']['tmp_name'],$destination.$name.'.'.$exe))
						{
							$this->request->data['Internship']['cover_letter'] = $name.'.'.$exe;
							$flag2 = 1;
							
						}
					}
					catch(Exception $e)
					{
						$this->Session->setFlash(__('Not able to upload cover letter'),'default', array('class'=>'message error'));
					}
				}
				else
				{
					$this->Session->setFlash(__('Error in cover letter uploading...'),'default', array('class'=>'message error'));
					
				}
				if($flag1 == 1 && $flag2 == 1)
				{
					if($this->Internship->save($this->request->data,false))
					{
						$this->redirect('/afterintern');
					}
					else
					{
						$this->Session->setFlash(__('Not able to save'),'default', array('class'=>'message error'));
					}
				}
			}
			
		}
		
		
	}
	public function afterintern()
	{
		
	}
	
	public function test()
	{
		
		die;
		
		//$this->Review->find('count',array('conditions'=>array('Review.status'=>1,'Review.by_guest'=>0,'Review.review_data <>'=>null,'Review.room_id'=>$room_id,'Place.status'=>1,'Room.status'=>1)));
		
	}
 
}
