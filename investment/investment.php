

<?php
require '../db_connect.php';
session_start();
$user=$_SESSION['user'];
//$sql = "SELECT SUM(amount) FROM `expenditure` GROUP BY(email) HAVING email='$user'";
//$sql1=" SELECT year(max(timestamp))-1 FROM `expenditure` where email='gnk@ise20' ";
//$result = mysqli_query($conn, $sql1);
//$row = mysqli_fetch_array($result);

$total_expenditure=0;
$fv=0;
$yr=1;

//1 yr
$returnph=0;
$returnpl=0;
$returnpm=0;

$mutualfundl;
$mutualfundm;
$mutualfundh;



        //default value
        $sql=" SELECT sum(amount) FROM `expenditure` where email='$user' and year(timestamp) between (SELECT year(max(timestamp))-1 FROM `expenditure` )  and  (SELECT year(max(timestamp)) FROM `expenditure`)";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
       
        //max return %
        $sql1="select max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='High'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnph=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return1yr) = (select risktype,max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='High')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundh=$r2[0];


        //low return %
        $sql1="select max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Low'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnpl=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return1yr) = (select risktype,max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Low')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundl=$r2[0];

        //moderate return%
        $sql1="select max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Moderate'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnpm=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return1yr) = (select risktype,max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Moderate')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundm=$r2[0];



         $total_expenditure=$row[0];
         $fv=$total_expenditure*pow(1.06,1);

        //default close





if($_SERVER['REQUEST_METHOD']=='POST'){
    //$exp=0;
    $yr=$_POST['expenditureyr'];  
    if($yr==1){
        $sql=" SELECT sum(amount) FROM `expenditure` where email='$user' and year(timestamp) between (SELECT year(max(timestamp))-1 FROM `expenditure` )  and  (SELECT year(max(timestamp)) FROM `expenditure`)";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
       
        //max return %
        $sql1="select max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='High'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnph=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return1yr) = (select risktype,max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='High')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundh=$r2[0];


        //low return %
        $sql1="select max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Low'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnpl=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return1yr) = (select risktype,max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Low')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundl=$r2[0];

        //moderate return%
        $sql1="select max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Moderate'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnpm=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return1yr) = (select risktype,max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Moderate')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundm=$r2[0];


        if(!empty($row)){
            $total_expenditure=$row[0];
            $fv=$total_expenditure*pow(1.06,1);
        }

    }

    if($yr==3){
        
        $sql="SELECT sum(amount) from `expenditure` where email ='$user' and year(timestamp) between (SELECT year(max(timestamp))-3 FROM `expenditure` ) and (SELECT year(max(timestamp)) FROM `expenditure`)";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);


         //max return %
         $sql1="select max(return3yr) from `mutual funds` GROUP BY(risktype) having risktype='High'";
         $res1 = mysqli_query($conn, $sql1);
         $r1 = mysqli_fetch_array($res1);
         $returnph=$r1[0];
 
         $sql2="select name from `mutual funds` where (risktype,return3yr) = (select risktype,max(return3yr) from `mutual funds` GROUP BY(risktype) having risktype='High')";
         $res2 = mysqli_query($conn,$sql2);
         $r2 = mysqli_fetch_array($res2);
         $mutualfundh=$r2[0];
 
 
         //low return %
         $sql1="select max(return3yr) from `mutual funds` GROUP BY(risktype) having risktype='Low'";
         $res1 = mysqli_query($conn, $sql1);
         $r1 = mysqli_fetch_array($res1);
         $returnpl=$r1[0];
 
         $sql2="select name from `mutual funds` where (risktype,return3yr) = (select risktype,max(return3yr) from `mutual funds` GROUP BY(risktype) having risktype='Low')";
         $res2 = mysqli_query($conn,$sql2);
         $r2 = mysqli_fetch_array($res2);
         $mutualfundl=$r2[0];
 
         //moderate return%
         $sql1="select max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Moderate'";
         $res1 = mysqli_query($conn, $sql1);
         $r1 = mysqli_fetch_array($res1);
         $returnpm=$r1[0];
 
         $sql2="select name from `mutual funds` where (risktype,return3yr) = (select risktype,max(return3yr) from `mutual funds` GROUP BY(risktype) having risktype='Moderate')";
         $res2 = mysqli_query($conn,$sql2);
         $r2 = mysqli_fetch_array($res2);
         $mutualfundm=$r2[0];
 

        if($row!=null){
            $total_expenditure=$row[0];
            $fv=$total_expenditure*pow(1.06,3);

        }

    }

    if($yr==5){

        $sql="SELECT sum(amount) from `expenditure` where email ='$user' and year(timestamp) between (SELECT year(max(timestamp))-5 FROM `expenditure` ) and (SELECT year(max(timestamp)) FROM `expenditure`)";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result); 


        //max return %
        $sql1="select max(return5yr) from `mutual funds` GROUP BY(risktype) having risktype='High'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnph=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return5yr) = (select risktype,max(return5yr) from `mutual funds` GROUP BY(risktype) having risktype='High')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundh=$r2[0];


        //low return %
        $sql1="select max(return5yr) from `mutual funds` GROUP BY(risktype) having risktype='Low'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnpl=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return5yr) = (select risktype,max(return5yr) from `mutual funds` GROUP BY(risktype) having risktype='Low')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundl=$r2[0];

        //moderate return%
        $sql1="select max(return1yr) from `mutual funds` GROUP BY(risktype) having risktype='Moderate'";
        $res1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($res1);
        $returnpm=$r1[0];

        $sql2="select name from `mutual funds` where (risktype,return5yr) = (select risktype,max(return5yr) from `mutual funds` GROUP BY(risktype) having risktype='Moderate')";
        $res2 = mysqli_query($conn,$sql2);
        $r2 = mysqli_fetch_array($res2);
        $mutualfundm=$r2[0];


        if($row!=null){
            $total_expenditure=$row[0];
            $fv=$total_expenditure*pow(1.06,5);
        }
    }
     


}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- piechartjs -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Dancing+Script&family=Kalam:wght@300&family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Growwmore</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Dancing+Script&family=Kalam:wght@300&family=Permanent+Marker&display=swap');
        /* @import "https://code.highcharts.com/css/highcharts.css"; */
        .card:hover{
            cursor:pointer;
            border: 2px solid red;
            background-color: black;
            color: white;
            

        }
        #funds{
            font-family: 'Anton', sans-serif;
            font-size: 40px;
            color:beige;
            margin: 17px;;

        }
        #analysis:hover{
            background-color: black;

        }
        #highrisk{
            background-color: lightcoral;

        }
        #lowrisk{
            background-color: lightgreen;
        }
        #mediumrisk{
            background-color:yellowgreen;
        }

        #highrisk:hover{
            background-color: red;
            border:2px solid lightcoral;
            border-radius: 5px;

        }
        #mediumrisk:hover{
            background-color: goldenrod;
            border:2px solid yellow;
            border-radius: 5px;
        }
        #lowrisk:hover{
            background-color: green;
            border:2px solid lightgreen;
            border-radius: 5px;

        }
        
    </style>

</head>

<body >


    <!-- mutualfundscard-->
<div class="bgimage">
    <img src="bg2.jpg" alt="" style="position:absolute;z-index:-1;width:100%;height:130%;filter:blur(4px);opacity:0.5px">
  </div>
    <!-- navbar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color:#34568B;border:2px solid white;border-radius: 5px;">
    <div class="container-fluid" style="background-color: #34568B;">
      <a class="navbar-brand" href="#" style="margin:0px;font-size:30px;">Groww more</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="/growwmore/dashboard/dashboard.php" style="margin:15px;font-size:16px">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#" style="margin:15px;font-size:16px" >Investment</a>
          </li>
      </div>
    </div>
  </nav>
    <!-- end of navbar -->


    <!-- piechart -->
    <figure class="highcharts-figure" style="background-color: transparent;">
        <div id="container" style="background-color:transparent;"></div>
    </figure>
    <!-- endofpiechart -->

    
    

        


    <div class="card"  style="margin:auto;background-color:transparent">

        <div class="card-body" id="analysis" >
        <h5 class="card-title" style="font-family:'Bebas Neue', cursive;color:chocolate;font-size:45px">ANALYSIS:</h5>
       

        <form action="investment.php" method="post" onchange="myFunction()" id="myForm1">
        <select name="expenditureyr">
        <option value="0" selected disabled>--select the expenditure year--</option>
        <option value="1">1 year</option>
        <option value="3">3 year</option>
        <option value="5">5 year</option>
        </select>
        </form>

        <?php
        if($yr!=0){
        echo '<h6 class="card-text" style="color:brown;font-size:20px"> Expenditure(for '.$yr.' years):' . $total_expenditure . '</h6>';
        echo '<h6 class="card-text" style="color:brown;font-size:20px">Estimated future expenditure(after '.$yr.' years):' . round($fv) . '</h6>';
        }
        ?>  
        </div>
    </div>

    <h4 id="funds">Mutual funds:</h4>
    <?php
    echo '<p style="color:aquamarine;text-indent:20px;font-size:25px">The investment plans below shows the amount you have to invest to spend the same money after '.$yr.' years </p>';
     ?>
    <div class="row">
        <div class="card1" style="width:33%;background-color:transparent">
            <div class="card-body" id="highrisk">
                <h5 class="card-title" style="font-family:'Bebas Neue';font-size:30px;text-decoration:underline;">High-risk</h5>
                <?php
                if(!empty($mutualfundh)){
                echo '
                <p class="card-text">'.$mutualfundh.'</p>
                <p class="card-text">'.$returnph.'%( for '.$yr.' year)</p>';
                
                  $return=$fv/pow((1+($returnph/100)),$yr);
                  echo '<p class="card-text">One-time amount to be invested:'.round($return).'</p>'; 
                } 
                ?>
            </div>
        </div>

        <div class="card2" style="width:33%;">
            
            <div class="card-body" id="mediumrisk" >
                <h5 class="card-title" style="font-family:'Bebas Neue';font-size:30px;text-decoration:underline;">Medium-risk</h5>
    
                <?php
                   if(!empty($mutualfundm)){
                    echo '
                    <p class="card-text">'.$mutualfundm.'</p>
                    <p class="card-text">'.$returnpm.'%( for '.$yr.' year)</p>';
                    
                      $return=$fv/pow((1+($returnpm/100)),$yr);
                      echo '<p class="card-text">One-time amount to be invested:'.round($return).'</p>'; 
                    } 
                ?>
                
            </div>
        </div>

        <div class="card3" style="width:33%;background-color:transparent">
            <div class="card-body"  id="lowrisk">
                <h5 class="card-title" style="font-family:'Bebas Neue';font-size:30px;text-decoration:underline;">Low-risk</h5>
                <?php
                   if(!empty($mutualfundl)){
                    echo '
                    <p class="card-text">'.$mutualfundl.'</p>
                    <p class="card-text">'.$returnpl.'%( for '.$yr.' year)</p>';
                    
                      $return=$fv/pow((1+($returnpl/100)),$yr);
                      echo '<p class="card-text">One-time amount to be invested:'.round($return).'</p>'; 
                    } 
                ?>
            </div>
        </div>

    </div>

    <!-- endofmutualfunds -->

    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
        Highcharts.chart('container', {
            chart: {backgroundColor: 'rgba(0,0,0,0)',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie', 
            },
            title: {
                style:{
                    color:'#FFFFFF',
                    fontSize:'30px',
                    textDecoration:'underline'

                },
                text: 'YOUR EXPENDITURE'
                
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        color:'white',
                        enabled: false,
                    },

                    showInLegend: true
                }
            },
            legend:{
                align:'left',
                layout:'vertical',
                floating:true,
                verticalAlign: 'top',
                x: 90,
                y: 95,
                symbolPadding: 40,
                symbolWidth: 100,
                itemStyle: {
                color: 'blue',
                // fontWeight: 'bold',
                fontSize:'20px',
                font:'20pt Permanent Marker ',
            }
            },
            series: [{
                name: 'category',
                colorByPoint: true,
                data: [
               <?php
                $sql = "SELECT category, SUM(amount) AS amount FROM `expenditure`  WHERE email='$user' GROUP BY category";
                $result=mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "{name:'".$row['category']."'
                        , y: ".$row['amount']."
                }, ";
                }
               ?>  
        ]
        }]
});


    function myFunction(){
        document.getElementById("myForm1").submit()
    }
</script>

</body>

</html>