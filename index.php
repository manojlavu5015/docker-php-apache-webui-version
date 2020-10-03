<!DOCTYPE html>
<html>
<head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"></script>
        <script type="text/javascript" src=https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js></script>
        <style type="text/css">
                h2 {
  text-align: center;
}

                table {
  text-align: center;
}

tr {
        color: solid black;
        font-weight: 700;

}

.main_body{
        margin-top: 5%;
}
@media screen and (max-width: 767px) {
  table caption {
    border-bottom: 1px solid #ddd;
  }
}
        </style>
</head>
<body class="main_body">
<h2>Host Name Web UI and version</h2>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Host Name</th>
                      <th scope="col">Web UI Information</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td><?php echo $_SERVER['SERVER_NAME']; echo "-01"; ?></td>
                      <td><?php 
                                                function getBrowser() { 
                                                  $u_agent = $_SERVER['HTTP_USER_AGENT'];
                                                  $bname = 'Unknown';
                                                  $platform = 'Unknown';
                                                  $version= "";

                                                  //First get the platform?
                                                  if (preg_match('/linux/i', $u_agent)) {
                                                    $platform = 'linux';
                                                  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                                                    $platform = 'mac';
                                                  }elseif (preg_match('/windows|win32/i', $u_agent)) {
                                                    $platform = 'windows';
                                                  }

                                                  // Next get the name of the useragent yes seperately and for good reason
                                                  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
                                                    $bname = 'Internet Explorer';
                                                    $ub = "MSIE";
                                                  }elseif(preg_match('/Firefox/i',$u_agent)){
                                                    $bname = 'Mozilla Firefox';
                                                    $ub = "Firefox";
                                                  }elseif(preg_match('/OPR/i',$u_agent)){
                                                    $bname = 'Opera';
                                                    $ub = "Opera";
                                                  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                                                    $bname = 'Google Chrome';
                                                    $ub = "Chrome";
                                                  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                                                    $bname = 'Apple Safari';
                                                    $ub = "Safari";
                                                  }elseif(preg_match('/Netscape/i',$u_agent)){
                                                    $bname = 'Netscape';
                                                    $ub = "Netscape";
                                                  }elseif(preg_match('/Edge/i',$u_agent)){
                                                    $bname = 'Edge';
                                                    $ub = "Edge";
                                                  }elseif(preg_match('/Trident/i',$u_agent)){
                                                    $bname = 'Internet Explorer';
                                                    $ub = "MSIE";
                                                  }
						// finally get the correct version number
                                                  $known = array('Version', $ub, 'other');
                                                  $pattern = '#(?<browser>' . join('|', $known) .
                                                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
                                                  if (!preg_match_all($pattern, $u_agent, $matches)) {
                                                    // we have no matching number just continue
                                                  }
                                                  // see how many we have
                                                  $i = count($matches['browser']);
                                                  if ($i != 1) {
                                                    //we will have two since we are not using 'other' argument yet
                                                    //see if version is before or after the name
                                                    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                                                        $version= $matches['version'][0];
                                                    }else {
                                                        $version= $matches['version'][1];
                                                    }
                                                  }else {
                                                    $version= $matches['version'][0];
                                                  }

                                                  // check if we have a number
                                                  if ($version==null || $version=="") {$version="?";}

                                                  return array(
                                                    'userAgent' => $u_agent,
                                                    'name'      => $bname,
                                                    'version'   => $version,
                                                    'platform'  => $platform,
                                                    'pattern'    => $pattern
                                                  );
                                                }

 						// now try it
                                                $ua=getBrowser();
                                                $yourbrowser= "Web UI: " . $ua['name'] . " <br />  " .  " Version:  " . $ua['version'];
                                                print_r($yourbrowser);
                         ?>
                                </td>
                        </tr>
                        </tbody>
                </table>



      </div><!--end of .table-responsive-->
    </div>
  </div>
</div>
</body>
</html>
	
