<?php 
	 
	if(!isset($_SESSION)){
		session_start();
	}
	if(isset($_SESSION['standby'])){
		/**
		 * AntiDDOS System
		 * FILE: index.php
		 * By Sanix Darker
		 */

		// There is all your configuration

		$_SESSION['standby'] = $_SESSION['standby']+1;

		 $ad_ddos_query = 5;// ​​number of requests per second to detect DDOS attacks
		 $ad_check_file = 'check.txt';// file to write the current state during the monitoring
		 $ad_all_file = 'all_ip.txt';// temporary file
		 $ad_black_file = 'black_ip.txt';// will be entered into a zombie machine ip
		 $ad_white_file = 'white_ip.txt';// ip logged visitors
		 $ad_temp_file = 'ad_temp_file.txt';// ip logged visitors
		 $ad_dir = 'anti_ddos/files';// directory with scripts
		 $ad_num_query = 0;// ​​current number of requests per second from a file $check_file
		 $ad_sec_query = 0;// ​​second from a file $check_file
		 $ad_end_defense = 0;// ​​end while protecting the file $check_file
		 $ad_sec = date ("s");// current second
		 $ad_date = date ("is");// current time
		 $ad_defense_time = 100;// ddos ​​attack detection time in seconds at which stops monitoring
		 

		$config_status = "";
		function Create_File($the_path){

			$handle = fopen($the_path, 'w') or die('Cannot open file:  '.$the_path);
			return "Creating ".$the_path." .... done";
		}


		 // Checking if all files exist before launching the cheking
		$config_status .= (!file_exists("{$ad_dir}/{$ad_check_file}")) ? Create_File("{$ad_dir}/{$ad_check_file}") : "ERROR: Creating "."{$ad_dir}/{$ad_check_file}<br>";
		$config_status .= (!file_exists("{$ad_dir}/{$ad_temp_file}")) ? Create_File("{$ad_dir}/{$ad_temp_file}") : "ERROR: Creating "."{$ad_dir}/{$ad_temp_file}<br>";
		$config_status .= (!file_exists("{$ad_dir}/{$ad_black_file}")) ? Create_File("{$ad_dir}/{$ad_black_file}") : "ERROR: Creating "."{$ad_dir}/{$ad_black_file}<br>";
		$config_status .= (!file_exists("{$ad_dir}/{$ad_white_file}")) ? Create_File("{$ad_dir}/{$ad_white_file}") : "ERROR: Creating "."{$ad_dir}/{$ad_white_file}<br>";
		$config_status .= (!file_exists("{$ad_dir}/{$ad_all_file}")) ? Create_File("{$ad_dir}/{$ad_all_file}") : "ERROR: Creating "."{$ad_dir}/{$ad_all_file}<br>";

		if(!file_exists ("{$ad_dir}/../anti_ddos.php")){
			$config_status .= "anti_ddos.php does'nt exist!";
		}

		if (!file_exists("{$ad_dir}/{$ad_check_file}") or 
		 		!file_exists("{$ad_dir}/{$ad_temp_file}") or 
		 			!file_exists("{$ad_dir}/{$ad_black_file}") or 
		 				!file_exists("{$ad_dir}/{$ad_white_file}") or 
		 					!file_exists("{$ad_dir}/{$ad_all_file}") or 
		 						!file_exists ("{$ad_dir}/../anti_ddos.php")) {

			 						$config_status .= "Some files does'nt exist!";
			 						die($config_status);
		}


		// TO verify the session start or not
		require ("{$ad_dir}/{$ad_check_file}");

		if ($ad_end_defense and $ad_end_defense> $ad_date) {
			require ("{$ad_dir}/../anti_ddos.php");
		} else {

			$ad_num_query = ($ad_sec == $ad_sec_query) ? $ad_num_query++ : '1 ';
			$ad_file = fopen ("{$ad_dir}/{$ad_check_file}", "w");

			$ad_string = ($ad_num_query >= $ad_ddos_query) ? '<?php $ad_end_defense ='.($ad_date + $ad_defense_time).'; ?>' : '<?php $ad_num_query ='. $ad_num_query. '; $ad_sec_query ='. $ad_sec. '; ?>';

			fputs ($ad_file, $ad_string);
			fclose ($ad_file);
		}
	}else{

			$_SESSION['standby'] = 1;
			
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			header("refresh:8,".$actual_link);
		?>
		  <style type="text/css">
		  .loading {display: flex; flex-direction: column; align-items: center; } .loading__msg {font-family: Roboto; font-size: 16px; } .loading__dots {display: flex; flex-direction: row; width: 100%; justify-content: center; margin: 100px 0 30px 0; } .loading__dots__dot {background-color: #44BBA4; width: 20px; height: 20px; border-radius: 50%; margin: 0 5px; color: #587B7F; } .loading__dots__dot:nth-child(1) {animation: bounce 1s 1s infinite; } .loading__dots__dot:nth-child(2) {animation: bounce 1s 1.2s infinite; } .loading__dots__dot:nth-child(3) {animation: bounce 1s 1.4s infinite; } @keyframes bounce {0% {transform: translate(0, 0); } 50% {transform: translate(0, 15px); } 100% {transform: translate(0, 0); } }
		  </style>
		<html>
  
  <head>
    <meta charset="UTF-8">
    <title>正在为您防止cc攻击</title>
    
    <body>
      <div id="t-ov">
        <div class="motime">
          <div id="head-body"></div>
          <div id="head-topcover"></div>
          <div id="head-toplogo-bg"></div>
          <div id="head-toplogo"></div>
          <div id="head-toplogo-2"></div>
          <div id="head-bottom"></div>
          <div id="head-bottom-2"></div>
          <div id="head-sw"></div>
          <div id="head-sw-2"></div>
          <div id="head-eye"></div>
          <div id="head-eye-2"></div>
        </div>
      </div>
      <style>
      	body{min-width:320px;background:#333}#head-body{position:relative;z-index:2;margin:25px 0 50px 0;width:200px;height:0;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}#head-body:after{position:absolute;top:0;left:0;width:0;height:0;border-color:#555 transparent transparent transparent;border-style:solid;border-width:150px 100px 0 100px;content:""}#head-eye{position:relative;top:-585px;left:67px;z-index:12;width:32px;height:22px;background:#4CBEFF;box-shadow:rgba(255,255,255,.4) 0 0 15px,rgba(76,190,255,.95) 0 0 10px;-webkit-transform:skew(46deg) rotate(14deg);-moz-transform:skew(46deg) rotate(14deg);-o-transform:skew(46deg) rotate(14deg)}#head-eye-2{position:relative;top:-607px;left:150px;z-index:12;width:32px;height:22px;background:#4CBEFF;box-shadow:rgba(255,255,255,.4) 0 0 15px,rgba(76,190,255,.95) 0 0 10px;-webkit-transform:skew(-46deg) rotate(-14deg);-moz-transform:skew(-46deg) rotate(-14deg);-o-transform:skew(-46deg) rotate(-14deg)}#head-topcover{position:relative;top:-225px;left:-19px;z-index:5;width:169px;height:0;border-top:80px solid #333;border-right:60px solid transparent;border-left:60px solid transparent}#head-topcover:after{position:absolute;top:0;left:0;width:0;height:0;border-color:#333 transparent transparent transparent;border-style:solid;border-width:15px 85px 0 85px;content:""}#head-toplogo-bg{position:relative;top:-267px;left:67px;z-index:6;width:46px;height:0;border-top:110px solid #333;border-right:35px solid transparent;border-left:35px solid transparent}#head-toplogo-bg:after{position:absolute;top:0;left:0;width:0;height:0;border-color:#333 transparent transparent transparent;border-style:solid;border-width:30px 23px 0 23px;content:""}#head-toplogo{position:relative;top:-377px;left:75px;z-index:7;width:40px;height:0;border-top:105px solid #555;border-right:30px solid transparent;border-left:30px solid transparent}#head-toplogo:before{position:absolute;top:-42px;left:10px;display:block;width:0;height:0;border-top:30px solid #333;border-right:10px solid transparent;border-left:10px solid transparent;content:''}#head-toplogo:after{position:absolute;top:0;left:0;width:0;height:0;border-color:#555 transparent transparent transparent;border-style:solid;border-width:28px 20px 0 20px;content:""}#head-toplogo-2{position:relative;top:-482px;left:75px;z-index:8;width:30px;height:0;border-top:37px solid #333;border-right:35px solid transparent;border-left:35px solid transparent}#head-bottom{position:relative;top:-365px;left:-31px;z-index:10;display:block;margin:50px 0;width:0;height:0;border-right:107px solid transparent;border-bottom:44px solid #555;border-left:60px solid transparent;color:#555;-webkit-transform:rotate(236deg);-moz-transform:rotate(236deg);-o-transform:rotate(236deg);-ms-transform:rotate(236deg)}#head-bottom-2{position:relative;top:-460px;left:115px;display:block;width:0;height:0;border-right:60px solid transparent;border-bottom:44px solid #555;border-left:107px solid transparent;color:#555;-webkit-transform:rotate(484deg);-moz-transform:rotate(484deg);-o-transform:rotate(484deg);-ms-transform:rotate(484deg)}#head-sw{position:relative;top:-629px;left:45px;z-index:15;width:49px;height:8px;background:#333;-webkit-transform:skew(-149deg) rotate(9deg);-moz-transform:skew(-149deg) rotate(9deg);-o-transform:skew(-149deg) rotate(9deg)}#head-sw:after{position:absolute;top:24px;left:-6px;width:53px;height:8px;background:#333;content:"";-webkit-transform:skew(-174deg) rotate(1deg);-moz-transform:skew(-174deg) rotate(1deg);-o-transform:skew(-174deg) rotate(1deg)}#head-sw-2{position:relative;top:-637px;left:155px;z-index:15;width:49px;height:8px;background:#333;-webkit-transform:skew(279deg) rotate(10deg);-moz-transform:skew(279deg) rotate(10deg);-o-transform:skew(279deg) rotate(10deg)}#head-sw-2:after{position:absolute;top:-2px;left:132px;width:45px;height:9px;background:#333;content:"";-webkit-transform:skew(-212deg) rotate(0);-moz-transform:skew(-212deg) rotate(0);-o-transform:skew(-212deg) rotate(0)}#t-ov{overflow:hidden;margin:50px auto 20px auto;width:250px;height:325px}.motime #head-body{animation:head-body-1 4s cubic-bezier(.25,.1,.25,1);-moz-animation:head-body-1 4s cubic-bezier(.25,.1,.25,1);-webkit-animation:head-body-1 4s cubic-bezier(.25,.1,.25,1);-o-animation:head-body-1 4s cubic-bezier(.25,.1,.25,1)}@keyframes head-body-1{0%{top:350px;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}100%{top:0;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}}@-moz-keyframes head-body-1{0%{top:350px;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}100%{top:0;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}}@-webkit-keyframes head-body-1{0%{top:350px;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}100%{top:0;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}}@-o-keyframes head-body-1{0%{top:350px;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}100%{top:0;border-top:150px solid #555;border-right:25px solid transparent;border-left:25px solid transparent}}.motime #head-toplogo{animation:head-body-2 2s cubic-bezier(.25,.1,.25,1);-moz-animation:head-body-2 2s cubic-bezier(.25,.1,.25,1);-webkit-animation:head-body-2 2s cubic-bezier(.25,.1,.25,1);-o-animation:head-body-2 2s cubic-bezier(.25,.1,.25,1)}@keyframes head-body-2{0%{top:-600px}100%{top:-377px}}@-moz-keyframes head-body-2{0%{top:-600px}100%{top:-377px}}@-webkit-keyframes head-body-2{0%{top:-600px}100%{top:-377px}}@-o-keyframes head-body-2{0%{top:-600px}100%{top:-377px}}.motime #head-toplogo-2{animation:head-body-3 4s cubic-bezier(1,.5,.25,.1);-moz-animation:head-body-3 4s cubic-bezier(1,.5,.25,.1);-webkit-animation:head-body-3 4s cubic-bezier(1,.5,.25,.1);-o-animation:head-body-3 4s cubic-bezier(1,.5,.25,.1)}@keyframes head-body-3{0%{top:-800px}100%{top:-482px}}@-moz-keyframes head-body-3{0%{top:-800px}100%{top:-482px}}@-webkit-keyframes head-body-3{0%{top:-800px}100%{top:-482px}}@-o-keyframes head-body-3{0%{top:-800px}100%{top:-482px}}.motime #head-eye,.motime #head-eye-2{animation:head-body-4 5s cubic-bezier(1,1,.5,.005);-moz-animation:head-body-4 5s cubic-bezier(1,1,.5,.005);-webkit-animation:head-body-4 5s cubic-bezier(1,1,.5,.005);-o-animation:head-body-4 5s cubic-bezier(1,1,.5,.005)}@keyframes head-body-4{0%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}5%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}10%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}15%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}20%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}25%{background:0
        0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}30%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}35%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}40%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}45%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}50%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}55%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}60%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}65%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}70%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}75%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}80%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}85%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}90%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}95%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}100%{background:#4CBEFF;-webkit-box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;-moz-box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px}}@-moz-keyframes head-body-4{0%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}5%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}10%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}15%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}20%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}25%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}30%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}35%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}40%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}45%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}50%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}55%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}60%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}65%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}70%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}75%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}80%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}85%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}90%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}95%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}100%{background:#4CBEFF;-webkit-box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;-moz-box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px}}@-webkit-keyframes head-body-4{0%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}5%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}10%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}15%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}20%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}25%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}30%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}35%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}40%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}45%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}50%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}55%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}60%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}65%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}70%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}75%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}80%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}85%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}90%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}95%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}100%{background:#4CBEFF;-webkit-box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;-moz-box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px}}@-o-keyframes head-body-4{0%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}5%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}10%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}15%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}20%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}25%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}30%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}35%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}40%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}45%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}50%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}55%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}60%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}65%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}70%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}75%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}80%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}85%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}90%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}95%{background:0 0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}100%{background:#4CBEFF;-webkit-box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;-moz-box-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;box-shadow:rgba(255,255,255,.4)
        0 0 35px,rgba(76,190,255,.95) 0 0 25px}}.motime #head-bottom{animation:head-body-5 3s cubic-bezier(.1,.025,.005,.005);-moz-animation:head-body-5 3s cubic-bezier(.1,.025,.005,.005);-webkit-animation:head-body-5 3s cubic-bezier(.1,.025,.005,.005);-o-animation:head-body-5 3s cubic-bezier(.1,.025,.005,.005)}@keyframes head-body-5{0%{left:300px}50%{left:-120px}100%{left:-31px}}@-moz-keyframes head-body-5{0%{left:300px}50%{left:-120px}100%{left:-31px}}@-webkit-keyframes head-body-5{0%{left:300px}50%{left:-120px}100%{left:-31px}}@-o-keyframes head-body-5{0%{left:300px}50%{left:-120px}100%{left:-31px}}.motime #head-bottom-2{animation:head-body-6 3s cubic-bezier(.1,.025,.005,.005);-moz-animation:head-body-6 3s cubic-bezier(.1,.025,.005,.005);-webkit-animation:head-body-6 3s cubic-bezier(.1,.025,.005,.005);-o-animation:head-body-6 3s cubic-bezier(.1,.025,.005,.005)}@keyframes head-body-6{0%{left:-300px}50%{left:300px}100%{left:115px}}@-moz-keyframes head-body-6{0%{left:-300px}50%{left:300px}100%{left:115px}}@-webkit-keyframes head-body-6{0%{left:-300px}50%{left:300px}100%{left:115px}}@-o-keyframes head-body-6{0%{left:-300px}50%{left:300px}100%{left:115px}}.motime #head-toplogo:before{animation:head-body-7 3s cubic-bezier(1,1,.005,.005);-moz-animation:head-body-7 3s cubic-bezier(1,1,.005,.005);-webkit-animation:head-body-7 3s cubic-bezier(1,1,.5,.005);-o-animation:head-body-7 3s cubic-bezier(1,1,.005,.005)}@keyframes head-body-7{0%{border-top:30px solid #555}5%{border-top:30px solid #555}10%{border-top:30px solid #555}15%{border-top:30px solid #555}20%{border-top:30px solid #555}25%{border-top:30px solid #555}30%{border-top:30px solid #555}35%{border-top:30px solid #555}40%{border-top:30px solid #555}45%{border-top:30px solid #555}50%{border-top:30px solid #555}55%{border-top:30px solid #555}60%{border-top:30px solid #555}65%{border-top:30px solid #555}70%{border-top:30px solid #555}75%{border-top:30px solid #555}80%{border-top:30px solid #555}85%{border-top:30px solid #555}90%{border-top:30px solid #333}95%{border-top:30px solid #555}100%{border-top:30px solid #333}}@-moz-keyframes head-body-7{0%{border-top:30px solid #555}5%{border-top:30px solid #555}10%{border-top:30px solid #555}15%{border-top:30px solid #555}20%{border-top:30px solid #555}25%{border-top:30px solid #555}30%{border-top:30px solid #555}35%{border-top:30px solid #555}40%{border-top:30px solid #555}45%{border-top:30px solid #555}50%{border-top:30px solid #555}55%{border-top:30px solid #555}60%{border-top:30px solid #555}65%{border-top:30px solid #555}70%{border-top:30px solid #555}75%{border-top:30px solid #555}80%{border-top:30px solid #555}85%{border-top:30px solid #555}90%{border-top:30px solid #333}95%{border-top:30px solid #555}100%{border-top:30px solid #333}}@-webkit-keyframes head-body-7{0%{border-top:30px solid #555}5%{border-top:30px solid #555}10%{border-top:30px solid #555}15%{border-top:30px solid #555}20%{border-top:30px solid #555}25%{border-top:30px solid #555}30%{border-top:30px solid #555}35%{border-top:30px solid #555}40%{border-top:30px solid #555}45%{border-top:30px solid #555}50%{border-top:30px solid #555}55%{border-top:30px solid #555}60%{border-top:30px solid #555}65%{border-top:30px solid #555}70%{border-top:30px solid #555}75%{border-top:30px solid #555}80%{border-top:30px solid #555}85%{border-top:30px solid #555}90%{border-top:30px solid #333}95%{border-top:30px solid #555}100%{border-top:30px solid #333}}@-o-keyframes head-body-7{0%{border-top:30px solid #555}5%{border-top:30px solid #555}10%{border-top:30px solid #555}15%{border-top:30px solid #555}20%{border-top:30px solid #555}25%{border-top:30px solid #555}30%{border-top:30px solid #555}35%{border-top:30px solid #555}40%{border-top:30px solid #555}45%{border-top:30px solid #555}50%{border-top:30px solid #555}55%{border-top:30px solid #555}60%{border-top:30px solid #555}65%{border-top:30px solid #555}70%{border-top:30px solid #555}75%{border-top:30px solid #555}80%{border-top:30px solid #555}85%{border-top:30px solid #555}90%{border-top:30px solid #333}95%{border-top:30px solid #555}100%{border-top:30px solid #333}}.wrap{margin:0 auto;width:200px;height:80px}.loading{position:relative;width:185px;height:20px;color:#4CBEFF;text-align:right;text-shadow:0 0 6px #bce4ff;text-shadow:rgba(255,255,255,.4) 0 0 35px,rgba(76,190,255,.95) 0 0 25px;font-family:arial}.loading span{position:absolute;right:30px;display:block;width:200px;height:20px;text-transform:uppercase;line-height:20px}.loading span:after{position:absolute;top:-2px;right:-21px;display:block;width:16px;height:20px;background:#4CBEFF;-webkit-box-shadow:0 0 15px #bce4ff;-moz-box-shadow:0 0 15px #bce4ff;box-shadow:0 0 15px #bce4ff;content:"";-moz-animation:blink 5s infinite;-webkit-animation:blink 5s infinite;animation:blink 5s infinite}.loading span.title{-moz-animation:title 12s linear infinite;-webkit-animation:title 12s linear infinite;animation:title 12s linear infinite}.loading span.text{opacity:0;-moz-animation:title 12s linear 5s infinite;-webkit-animation:title 12s linear 5s infinite;animation:title 12s linear 5s infinite}@-webkit-keyframes title{0%{right:130px;opacity:0}48%{right:130px;opacity:0}52%{right:30px;opacity:1}70%{right:30px;opacity:1}100%{right:30px;opacity:0}}@-moz-keyframes title{0%{right:130px;opacity:0}48%{right:130px;opacity:0}52%{right:30px;opacity:1}70%{right:30px;opacity:1}100%{right:30px;opacity:0}}@-webkit-keyframes fade{0%{opacity:1}100%{opacity:0}}@-moz-keyframes fade{0%{opacity:1}100%{opacity:0}}@-webkit-keyframes bg{0%{background-color:#306f99}50%{background-color:#19470f}90%{background-color:#734a10}}@-moz-keyframes bg{0%{background-color:#306f99}50%{background-color:#19470f}90%{background-color:#734a10}}@-webkit-keyframes blink{0%{opacity:0}5%{opacity:1}10%{opacity:0}15%{opacity:1}20%{opacity:0}25%{opacity:1}30%{opacity:0}35%{opacity:1}40%{right:-21px;opacity:0}45%{right:80px;opacity:1}50%{right:-21px;opacity:0}51%{right:-21px}55%{opacity:1}60%{opacity:0}65%{opacity:1}70%{opacity:0}75%{opacity:1}80%{opacity:0}85%{opacity:1}90%{right:-21px;opacity:0}95%{right:80px;opacity:1}96%{right:-21px}100%{right:-21px;opacity:0}}@-moz-keyframes blink{0%{opacity:0}5%{opacity:1}10%{opacity:0}15%{opacity:1}20%{opacity:0}25%{opacity:1}30%{opacity:0}35%{opacity:1}40%{right:-21px;opacity:0}45%{right:80px;opacity:1}50%{right:-21px;opacity:0}51%{right:-21px}55%{opacity:1}60%{opacity:0}65%{opacity:1}70%{opacity:0}75%{opacity:1}80%{opacity:0}85%{opacity:1}90%{right:-21px;opacity:0}95%{right:80px;opacity:1}96%{right:-21px}100%{right:-21px;opacity:0}}
      </style>
      <iframe frameborder="0" scrolling="no" src="" width="100%" height="100px"></iframe>
    </body>
  </head>

</html>
<h1 style="text-align:center">
  <span style="color:#555;font-family:'Microsoft YaHei'">苏皓先生</span></h1>
<blockquote>
  <p style="text-align:center">
    <span style="font-size:14pt;font-family:'comic sans ms',sans-serif">
      <span style="color:#555;font-family:'Microsoft YaHei'">防cc进行中&nbsp;</span>
      <span style="color:#555540">Lur team</span></span>
     <span style="color:#555;font-family:'Microsoft YaHei'">苏皓提醒:显示此页面刷新一下即可...&nbsp;</span>
    <span style="color:#555;font-family:'Microsoft YaHei'">站长QQ28422961&nbsp;</span>
  </p>
</blockquote>

	<?php exit(); }

?>
