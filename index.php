<?php
include "header.php";
session_start();
error_reporting(0);
require_once("db.php");
$logPath = "logs/ais/thailand/index_ksaactelzainmob_".date("Ymd").".txt";
error_log(date('Ymd His')." :  requested url:".$_SERVER['REQUEST_URI']."\n", 3, $logPath);
$status = $_GET['status'];
if($_GET['success']=='true')
{
	 $_SESSION['act'] ="1";
}
if($_GET['success']=='already')
{
	 $_SESSION['act'] ="1";
}


////////////////////////////////////////////////////for headers////////////////////////////////////////////////////

foreach (getallheaders() as $name => $value) {
error_log("heder logs".date('Ymd His').":    header= ".$name."=".$value." \n", 3, $logPath);	
     
	if($name=='msisdn')
	{
		$msisdn1=$value;
error_log("heder logs".date('Ymd His').":    header= ".$msisdn1."=".$value." \n", 3, $logPath);
	}
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
error_log("act:".date('Ymd His').": ". $_SESSION['act']."\n", 3, $logPath);
error_log("msisdn:".date('Ymd His').": ". $_SESSION['msisdn']."\n", 3, $logPath);





if(!empty($_GET['msisdn']))
    {
	$msisdn= $_GET['msisdn'] % 1000000000;
 // $msisdn =  '66'.$_GET['msisdn'];
 $msisdn =  '66'.$msisdn;
//echo $msisdn;
$qry = "select * from tbl_subscription_aisstudiox where msisdn = '$msisdn' and  now() between regdate and validitydate";

  $result = mysqli_query($con1,$qry);
  if (!$result) {
    echo mysqli_error();
  }
  $isSubscribed = mysqli_num_rows($result);

  //echo 'isSubscribed'.$isSubscribed;
  //echo 'qry'.$qry;
  
  if($isSubscribed > 0) {
    $_SESSION['act'] ="1";
    $_SESSION['msisdn']=$msisdn;
   // header("Location:sub.php");
  } else {
     $_SESSION['msisdn'] = $msisdn;
  }

}


if($_SESSION['act']!='1')
{
	$referID=date("ymdHisu");
	$Query="insert into tbl_wapidentify_aisstudiox (msisdn,referid,entrydate,pubid,subid,campid) values ('".$_SESSION['msisdn']."','".$referID."',now(),'".$_GET['pubid']."','".$_GET['subid']."','".$_GET['id']."')";
	error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);
		
		//$result=mysqli_query($con1,$Query);
	
		if(!mysqli_query($con1,$Query))
		  {
			//echo("Error description: " . mysqli_error($con1));
			error_log("Error description:".date('Ymd His').": ". mysqli_error($con1)."\n", 3, $logPath);	
		  }
	
		$Query="select id as lastid from tbl_wapidentify_aisstudiox where referid='".$referID."' order by id desc limit 1";
		error_log("Query:".date('Ymd His').": ". $Query."\n", 3, $logPath);
		$result=mysqli_query($con1,$Query);
		while($mis_array=mysqli_fetch_assoc($result)) {
			
			$lastid = $mis_array['lastid'];
		}
		
		error_log("lastid:".date('Ymd His').": ". $lastid."\n", 3, $logPath);
		
		$_SESSION['lastid']=$lastid;
		  if($_GET['req']=='1cg')
    {
      $Price=$_GET['price'];
      $Validity=$_GET['validity'];
      header("Location:sub-category.php?req=act&price=".$Price."&validity=".$Validity."&id=15");
     
    }
	
	if($_GET['req']=='cg')
    {
      $Price=$_GET['price'];
      $Validity=$_GET['validity'];
      header("Location:newlpnew_aisthai.php?lastid=".$lastid);
     
    }
	
	
}

?>



  <!-- hero starts from here -->

  <section class="hero">
    <div class="container-fluid p-0">
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <a href=""><img src="./assets/hero/sh5.png" class="d-block w-100" alt="..." /></a>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <a href=""><img src="./assets/hero/sh6.png" class="d-block w-100" alt="..." /></a>
          </div>
          <div class="carousel-item">
            <a href=""><img src="./assets/hero/sh4.png" class="d-block w-100" alt="..." /></a>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>

  <!-- hero ends here -->

  <!-- about us starts from here -->



  <section>
    <div class="container padding-top padding-bottom about">
      <h1 data-aos="fade-right" class="heading-3 text-white">Fashion Boom </h1>
      <div class="row mt-5">

        <div class="col-md-4 mb-3 ">

          <a href="./assets/studioX_videos/bikini_s/2_480x240.mp4"><img data-aos="fade-down-right"
              class="img-fluid rounded-circle" alt="100%x280" src="./assets/new/95_640x320.jpg"></a>
          <div class="">
            <div data-aos="fade-left" class=" text-center mt-3 text-white heading-5">Runway</div>
          </div>


        </div>
        <div class="col-md-4 mb-3">

          <a href="./assets/studioX_videos/bikini_s/3_480x240.mp4"><img data-aos="flip-down"
              class="img-fluid rounded-circle" alt="100%x280" src="./assets/new/89_640x320.jpg"></a>
          <div class="">
            <div data-aos="fade-up-left" class="text-center mt-3 text-white heading-5">Advertising</div>
          </div>


        </div>
        <div class="col-md-4 mb-3">

          <a href="./assets/studioX_videos/bikini_s/40_480x240.mp4"><img data-aos="fade-down-left" class="img-fluid rounded-circle" alt="100%x280"
              src="./assets/new/90_640x320.jpg"></a>
          <div class="">
            <div data-aos="fade-right" class="text-center mt-3 text-white heading-5">Look Book</div>
          </div>


        </div>
        <!-- <div data-aos="zoom-in" class="col-md-3 mb-3">
            <div class="card new">
              <a href=""><img class="img-fluid new-img" alt="100%x280" src="./assets/new/n4.jpg"></a>
              <div class="new-po">
                <div class="new-text">Overwatch</div>
              </div>

            </div>
          </div> -->
      </div>

      <div class="row mt-4">

        <div class="col-md-4 mb-3">

          <a href="./assets/studioX_videos/bikini_s/43_480x240.mp4"><img data-aos="fade-down-right" class="img-fluid rounded-circle" alt="100%x280"
              src="./assets/new/91_640x320.jpg"></a>
          <div class="">
            <div data-aos="fade-left" class="text-center mt-3 text-white heading-5">Portrait</div>
          </div>


        </div>
        <div class="col-md-4 mb-3">

          <a href="./assets/studioX_videos/bikini_s/42_480x240.mp4"><img data-aos="flip-down" class="img-fluid rounded-circle" alt="100%x280"
              src="./assets/new/92_640x320.jpg"></a>
          <div class="">
            <div data-aos="fade-up-right" class="text-center mt-3 text-white heading-5">Glamour</div>
          </div>


        </div>
        <div class="col-md-4 mb-3">

          <a href="./assets/studioX_videos/bikini_s/6_480x240.mp4"><img data-aos="fade-down-left" class="img-fluid rounded-circle" alt="100%x280"
              src="./assets/new/94_640x320.jpg"></a>
          <div class="">
            <div data-aos="fade-right" class="text-center mt-3 text-white heading-5">Featured</div>
          </div>


        </div>
        <!-- <div data-aos="zoom-in" class="col-md-3 mb-3">
            <div class="card new">
              <a href=""><img class="img-fluid new-img" alt="100%x280" src="./assets/new/n8.jpg"></a>
              <div class="new-po">
                <div class="new-text">Bioshock</div>
              </div>

            </div>
          </div> -->
      </div>
    </div>
  </section>

  <!-- about us ends here -->

  <!-- top games starts from here -->

  <section>
    <div class="container">
      <h1 data-aos="fade-right" class="heading-3 text-white">Gym Girls </h1>
    </div>
  </section>

  <section class="top">

    <div class="container-fluid p-0 padding-bw">



      <article class="wrapper">
        <div class="marquee">
          <div class="marquee__group img-hover-zoom">
            <a href="./assets/studioX_videos/gym/73_480x240.mp4"><img src="./assets/top/88_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/74_480x240.mp4"><img src="./assets/top/81_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/75_480x240.mp4"><img src="./assets/top/82_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/76_480x240.mp4"><img src="./assets/top/83_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/77_480x240.mp4"><img src="./assets/top/84_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/78_480x240.mp4"><img src="./assets/top/85_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/79_480x240.mp4"><img src="./assets/top/86_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/82_480x240.mp4"><img src="./assets/top/87_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>

          </div>

          <div aria-hidden="true" class="marquee__group img-hover-zoom">
            <a href="./assets/studioX_videos/gym/73_480x240.mp4"><img src="./assets/top/88_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/74_480x240.mp4"><img src="./assets/top/81_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/75_480x240.mp4"><img src="./assets/top/82_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/76_480x240.mp4"><img src="./assets/top/83_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/77_480x240.mp4"><img src="./assets/top/84_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/78_480x240.mp4"><img src="./assets/top/85_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/79_480x240.mp4"><img src="./assets/top/86_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>
            <a href="./assets/studioX_videos/gym/82_480x240.mp4"><img src="./assets/top/87_720x1280.jpg"
                data-aos="zoom-in-down" class="img-fluid" alt=""></a>

          </div>
        </div>


    </div>
    </article>


    </div>
  </section>



  <!-- top games ends here -->




  <!-- featured games starts from here -->


  <section>
    <div class="container padding-top padding-bottom">
      <h1 data-aos="fade-right" class="heading-3 text-white">Poolside Bikini </h1>
      <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
        <div data-aos="flip-left" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/2_480x240.mp4"><img src="./assets/featured/73_640x480.jpg"
                class="card-img-top" alt="..."></a>

            
          </div>
        </div>
        <div data-aos="flip-up" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/3_480x240.mp4"><img src="./assets/featured/11_640x480.jpg"
                class="card-img-top" alt="..."></a>

            
          </div>
        </div>
        <div data-aos="flip-right" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/44_480x240.mp4"><img src="./assets/featured/2_640x480.jpg"
                class="card-img-top" alt="..."></a>

          </div>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
        <div data-aos="flip-left" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/45_480x240.mp4"><img src="./assets/featured/74_640x480.jpg"
                class="card-img-top" alt="..."></a>

          
          </div>
        </div>
        <div data-aos="flip-up" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/46_480x240.mp4"><img src="./assets/featured/76_640x480.jpg"
                class="card-img-top" alt="..."></a>

          
          </div>
        </div>
        <div data-aos="flip-right" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/48_480x240.mp4"><img src="./assets/featured/77_640x480.jpg"
                class="card-img-top" alt="..."></a>

           
          </div>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
        <div data-aos="flip-left" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/4_480x240.mp4"><img src="./assets/featured/78_640x480.jpg"
                class="card-img-top" alt="..."></a>

          </div>
        </div>
        <div data-aos="flip-up" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/55_480x240.mp4"><img src="./assets/featured/79_640x480.jpg"
                class="card-img-top" alt="..."></a>

         
          </div>
        </div>
        <div data-aos="flip-right" class="col">
          <div class="card h-100 img-hover-zoom">
            <a href="./assets/studioX_videos/bikini_p/58_480x240.mp4"><img src="./assets/featured/9_640x480.jpg"
                class="card-img-top" alt="..."></a>

          
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- featured games ends here -->

  <!-- quotes starts from here -->

  <!-- <section>
    <div class="container-fluid quotes">
    </div>
  </section> -->

  <!-- quotes ends here -->

  <!-- new games starts from here -->


  


  <section>
    <div class="container padding-top padding-bottom">
      <h1 data-aos="fade-right" class="heading-3 text-white">Bikini Photoshoot </h1>
      <div class="row mt-4">

        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/47_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/66_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Stretch</div>
            </div>

          </div>
        </div>
        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/49_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/67_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Pop the Hip</div>
            </div>

          </div>
        </div>
        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/50_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/68_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Quater Turn</div>
            </div>

          </div>
        </div>
        <!-- <div data-aos="zoom-in" class="col-md-3 mb-3">
            <div class="card new">
              <a href=""><img class="img-fluid new-img" alt="100%x280" src="./assets/new/n4.jpg"></a>
              <div class="new-po">
                <div class="new-text">Overwatch</div>
              </div>

            </div>
          </div> -->
      </div>

      <div class="row">

        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/51_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/69_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Lying Side</div>
            </div>

          </div>
        </div>
        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/52_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/71_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Lying Back</div>
            </div>

          </div>
        </div>
        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/53_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/72_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Booty Shots</div>
            </div>

          </div>
        </div>
        <!-- <div data-aos="zoom-in" class="col-md-3 mb-3">
            <div class="card new">
              <a href=""><img class="img-fluid new-img" alt="100%x280" src="./assets/new/n8.jpg"></a>
              <div class="new-po">
                <div class="new-text">Bioshock</div>
              </div>

            </div>
          </div> -->
      </div>


      <div class="row">

        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/54_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/63_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Peek Over</div>
            </div>

          </div>
        </div>
        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/56_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/64_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Kneeling</div>
            </div>

          </div>
        </div>
        <div data-aos="zoom-in" class="col-md-4 mb-3">
          <div class="card new">
            <a href="./assets/studioX_videos/bikini_pic/57_480x240.mp4"><img class="img-fluid new-img" alt="100%x280"
                src="./assets/old/65_640x480.jpg"></a>
            <div class="new-po">
              <div class="new-text text-dark heading-5">Sitting</div>
            </div>

          </div>
        </div>
        <!-- <div data-aos="zoom-in" class="col-md-3 mb-3">
            <div class="card new">
              <a href=""><img class="img-fluid new-img" alt="100%x280" src="./assets/new/n12.avif"></a>
              <div class="new-po">
                <div class="new-text">Skater</div>
              </div>

            </div>
          </div> -->
      </div>

    </div>
  </section>


  <!-- new games ends here -->




  


<?php include "footer.php"; ?>