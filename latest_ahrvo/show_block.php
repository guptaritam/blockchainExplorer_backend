<?php
function relativeTime($time) {
            $d[0] = array(1,"Sec");
            $d[1] = array(60,"Min");
            $d[2] = array(3600,"hr");
            $d[3] = array(86400,"Day");
            $d[4] = array(604800,"W");
            $d[5] = array(2592000,"Mon");
            $d[6] = array(31104000,"Yr");

            $w = array();

            $return = "";
            $now = time();
            $diff = ($now-$time);
            $secondsLeft = $diff;

            for($i=6;$i>-1;$i--)
            {
                 $w[$i] = intval($secondsLeft/$d[$i][0]);
                 $secondsLeft -= ($w[$i]*$d[$i][0]);
                 if($w[$i]!=0)
                 {
                    $return.= abs($w[$i]) . " " . $d[$i][1] . (($w[$i]>1)?'s':'') ." ";
                 }

            }
            $return .= ($diff>0)?"ago":"left";
            return $return;
        }

  $data = file_get_contents("http://13.233.7.230:3003/api/dataManager/explorer");
    $data = json_decode($data,true);
    //print_r($data);
    $datav = array();
    foreach ($data as $key => $value) {
      if ($_REQUEST['block_id']==$value['number']) {
        $datav = $value;
      }
    }

    if ($datav['number']=="") {
      header('Location:index.php?choice=error&value=Your Search was not found please check and Try Again.');
    }
 ?><!DOCTYPE html>
<html lang="en">
<head>
  <title>Block Scanner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <style type="text/css">
    @media 
    only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

      /* Force table to not be like tables anymore */
      table, thead, tbody, th, td, tr { 
        display: block; 
      }
      
      /* Hide table headers (but not display: none;, for accessibility) */
      thead tr { 
        position: absolute;
        top: -9999px;
        left: -9999px;
      }
      
      tr { border: 1px solid #132461; }
      
      td { 
        /* Behave  like a "row" */
        border: none;
        border-top: 1px solid #132461; 
        position: relative;
        padding-left: 50%; 
        
      }
      
      td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
      }
      
      
    }

    .box{
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px #eee;
      font-family: poppins;
    }
    td{
      border-top: solid 1px #132461;
    }
  </style>
</head>
<body style="background-color: #f4f4f4">
  
    <?php include 'header.php'; ?>
    <?php include 'gabar.php'; ?>
<div style="padding: 30px"></div>

  <div class="container" >
    <div class="row">
      <div class="col-sm-12">
        <div class="box" style="background-color: #0a1646;color: #fff;">
          <h6 style="color: #fff;">Block Details</h6>
          <div style="padding: 20px;"></div>
          <b style="color: #fff;">Block Height: <?php echo $datav['number']; ?></b>
          <div style="padding: 10px;"></div>
          <span><?php echo count($datav['transactions']); ?> Transaction</span><br/>
          <span><?php echo count($datav['size']); ?> bytes</span><br/>
          <span><?php $time = explode("T", $datav['time']); $time_set = explode(".", $time[1]); echo $time[0]." ".$time_set[0]." GMT"; ?></span>
          

          <div style="padding: 10px;"></div>
          <hr/>
          <div style="color: #fff;word-break: break-all;">
            <b style="color: #9db1ff;">Block No. : </b><?php echo $datav['number']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">Block Difficulty : </b><?php echo $datav['blockDifficulty']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">Tx Hash Count : </b><?php echo $datav['number']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">GasLimit : </b><br/><?php echo $datav['gasLimit']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">blockHash : </b><br/><?php echo $datav['blockHash']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">Parent Hash : </b><br/><?php echo $datav['parentHash']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">receiptsRoot : </b><br/><?php echo $datav['receiptsRoot']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">sha3Uncles : </b><br/><?php echo $datav['sha3Uncles']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">size : </b><?php echo $datav['size']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">totalDifficulty : </b><?php echo $datav['totalDifficulty']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">transactionsRoot : </b><br/><?php echo $datav['transactionsRoot']; ?><br/>
            <div style="padding: 3px;"></div>
            <b style="color: #9db1ff;">time : </b><?php //GMT
              $time = explode("T", $datav['time']);
             // print_r($time);
              $time_set = explode(".", $time[1]);
              echo $time[0]." ".$time_set[0]." GMT"; ?><br/>
              <b style="color: #9db1ff;">stateRoot</b> : <br/><?php echo $datav['stateRoot']; ?>


          </div>
          <!-- <table class="table" style="font-size: 12px;">
            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;"></td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['number']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">Block Difficulty</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['blockDifficulty']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">Tx Hash Count</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo count($datav['transactions']); ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">GasLimit</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['gasLimit']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">blockHash</td>
              <td style="word-break: break-all;color: #fff;border-top: solid 1px #132461;"><?php echo $datav['blockHash']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">parentHash</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['parentHash']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">receiptsRoot</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['receiptsRoot']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">sha3Uncles</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['sha3Uncles']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">size</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['size']; ?></td>
            </tr>

           

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">totalDifficulty</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['totalDifficulty']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">transactionsRoot</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php echo $datav['transactionsRoot']; ?></td>
            </tr>

            <tr>
              <td style="background-color: #142461;border-color:#0a1645;color:#fff;">time</td>
              <td style="color:#fff;border-top: solid 1px #132461;"><?php //GMT
              $time = explode("T", $datav['time']);
             // print_r($time);
              $time_set = explode(".", $time[1]);
              echo $time[0]." ".$time_set[0]." GMT"; ?></td>
            </tr>


           </table>
 -->
        </div>
      </div>
      <!-- <div class="col-sm-4">
        <div class="box" style="background-color: #0a1647;color: #fff;font-size: 12px;word-break:break-all;height: 720px;">
          <h6 style="color: #fff;opacity: .8">Block Details</h6>
          <div style="padding: 10px;"></div>
          <b>stateRoot</b> : <br/><?php echo $datav['stateRoot']; ?>
          <div style="padding: 10px;"></div>
        </div>
      </div> -->
    </div>

    <div style="padding: 20px;"></div>
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
           <h6>Transactions</h6>
           <div style="padding: 10px;"></div>
           <!-- <div style="font-size: 12px;color: #999;padding: 10px;background-color: #e1e7ff"></div> -->
            <?php //echo $datav['transactions'][0];
              $dodo = $datav['transactions'];
             ?>
              <?php foreach ( $dodo as $key => $value) {             
               // echo "http://13.233.7.230:3003/api/dataManager/get/transactionDetails?_txhash=".$value;
              $data = file_get_contents("http://13.233.7.230:3003/api/dataManager/get/transactionDetails?_txhash=".$value);              
              $data = json_decode($data,true);
              //print_r($data);

            echo '<div class="col-sm-12" style="margin-top:13px;">
                  <div style="padding: 10px;border:solid 1px #eee;border-radius: 4px;background-color:#fff;border-left: solid 4px #b1cffd;font-size: 12px;">
                    <div class="row">
                      <div class="col-sm-9">
                        <div style="padding: 6px;">
                          <a href="show_tx_2.php?id='.$data['result']['transactionHash'].'"><h6 style="cursor:pointer;color:#007bff;word-break: break-all;font-size:15px;" class="openBtn" data-id="'.$data['result']['transactionHash'].'" >'.$data['result']['transactionHash'].'</h6></a>
                        </div>
                        <div style="padding: 10px;background-color: #f3f9ff;font-family: arial;color: #333">
                          '.$data['result']['from'].' >  '.$data['result']['to'].'<br/>

                          <b>Gas Used </b> : '.hexdec($data['result']['gasUsed']).', <b>Tx Fees </b> : '.hexdec($data['result']['cumulativeGasUsed']).'
                        </div>
                      </div>
                      <div class="col-sm-3" style="text-align:right">
                        <h6><span style="color:#333">Block # : </span><a href="show_block.php?block_id='.hexdec($data['result']['blockNumber']).'">'.hexdec($data['result']['blockNumber']).'</a></h6>
                      </div>
                    </div>
                  </div>
                </div>';
            } ?>
            

             
           
        </div>
      </div>
    </div>
  </div>


  <?php include 'footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

</body>
</html>
