<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    
</head>
<style>
    .bordernone{
        background-color: none;
        border:1px solid black;
        border-left: none;
        border-right: none;
        border-top: none;
    }
    td{
        font-size:10px;
    }
    p{
        font-size:10px;  
    }
</style>
<body>

      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 text text-center">
              <h2>Restricted</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
           <p class='pull-right'> <u>ANNEX B TO NHQ LETTER</u></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <p class='pull-right'> <u>PANWHS-37|56|Policy|463</u></p>
                 </div>
                </div>
                <div class="row">
                 <div class="col-sm-12 col-lg-12 col-md-12">
                    <p class='pull-right'> <u>DATED: 07 DECEMBER 2018</u></p>
                     </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h5 >Eligibility Category</h5>
                    <h5 class="text text-left"><u>PNWHS REGISTRATION FORM FOR HOUSE CATEGORY A,B&C</u></h5>
                    <p class="text text-left"><ul><li> Please read the instructions and terms/conditions overleaf</li></ul></p>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                      <div class="pull-right" style=''>
                      <?php
$jsondata = json_decode($model->image);

foreach ($jsondata as $key => $value) {
 ?>
 
 
 <a href="{{url('/')}}/public/attachment/{{$value}}">
 <img class="img-responsive" src="{{url('/')}}/public/attachment/{{$value}}" style='height:131px;width:20% !important;margin-bottom:0px !important;margin-top:-8%;'/>
 </a>
 
 <?php
}
?>
                      </div>
                        </div>
                        <div class="clearfix"></div>
                
                        </div>
                        <table class='table table-responsive' style='margin-top:0px !important'>
                        <tr><td><p><u><strong>1). Particular of the applicant </strong></u></p></td></tr>
                        <tr>
                        <td>P/PJ/O No</td>
                        <td><u style='width:100%;'>{{$model->p_no}}</u></td>
                        <td>Rank/Rate</td>
                        <td><u style='width:100%;'>{{$model->p_no}}</u></td>
                        </tr>
                        <tr>
                        <td>Name</td>
                        <td><u style='width:100%;'>{{$model->name}}</u></td>
                        <td>CNIC NO</td>
                        <td><u style='width:100%;'>{{$model->cnic_no}}</u></td>
                        </tr>
                        <tr>
                        <td>Date Of Birth</td>
                        <td><u style='width:100%;'>{{$model->d_o_b}}</u></td>
                        <td>Father's Name</td>
                        <td><u style='width:100%;'>{{$model->father_name_particular}}</u></td>
                        </tr>
                        <tr>
                        <td>Date Of Enrolment</td>
                        <td><u style='width:100%;'>{{$model->d_o_e}}</u></td>
                        <td>Branch</td>
                        <td><u style='width:100%;'>{{$model->branch}}</u></td>
                        </tr>
                        <tr>
                        <td col-span='2'>Date Of Completion Of Probationary period</td>
                        <td col-span='2'><u style='width:100%;'>{{$model->d_o_c}}</u></td>
                        </tr>
                        <tr>
                        <td col-span='2'>Date Of Promotion to present Rank</td>
                        <td col-span='2'><u style='width:100%;'>{{$model->d_o_p}}</u></td>
                        </tr>
                        <tr>
                        <td>Date Of SOD</td>
                        <td><u style='width:100%;'>{{$model->d_o_sod}}</u></td>
                        <td>Date Of SOS</td>
                        <td><u style='width:100%;'>{{$model->d_o_sos}}</u></td>
                        </tr>
                        <tr>
                        <td col-span='2'>Total Service rendered in PN excluding probationary period</td>
                        <td col-span='2'><u style='width:100%;'>{{$model->total_service}}</u></td>
                        </tr>
                        <tr>
                        <td col-span='2'>Date Of Superannuation age (for Navy Civilians)</td>
                        <td col-span='2'><u style='width:100%;'>{{$model->d_o_s}}</u></td>
                        </tr>
                        <tr>
                        <td>Tel No</td>
                        <td><u style='width:100%;'>{{$model->tel_no}}</u></td>
                        <td>Mob No</td>
                        <td><u style='width:100%;'>{{$model->mob_no}}</u></td>
                        </tr>
                        <tr>
                        <td col-span='2'>Email Address</td>
                        <td col-span='2'><u style='width:100%;'>{{$model->email_address}}</u></td>
                        </tr>
                        
                        </table>
                        <table class='table table-responsive' style='margin-top:0px;'>
                        <tr><td><p><u><strong>2). Details Of Next Of Kin/Parents </strong></u></p></td></tr>
                        <?php
$jsondata = json_decode($model->transactionform2);
$k=1;
if(!empty($jsondata)){
foreach ($jsondata as $key => $value) {
  //  echo '<pre>';print_r($value->cnic);die;
    if($k == 1){

    
 ?>
 <tr>
 <td><span>
              Next Of Kin (Name & Relationship)<br>
            <span style="font-size: 9px;"> (In Case of more than one wife/ or then wife)</span>
                    </span>
                    </td>
                  
                        <td>1). <?= $value->relation ?></td>
                        <td>CNIC No <?php  echo  (!empty($value->cnic)) ? $value->cnic : '-'; ?></td>
</tr>
 <?php

}else{
    ?>
     <tr>
                        <td>     </td>
                        <td><?= $k; ?>). <?= $value->relation ?></td>
                        <td>CNIC No <?php  echo  (!empty($value->cnic)) ? $value->cnic : '-'; ?></td>
</tr>
    <?php
}
$k++;
}
}

?>
 <tr>
                        <td col-span='2'>Father (Alive/Deceased) Name/Address</td>
                        <td col-span='1'><u style='width:100%;'>{{$model->father_name.' , '.$model->father_address}}</u></td>
                        </tr>
                        <tr>
                        <td col-span='2'>Mother (Alive/Deceased) Name/Address</td>
                        <td col-span='1'><u style='width:100%;'>{{$model->mother_name.' , '.$model->mother_address}}</u></td>
                        </tr>
                        <tr>
                        <td col-span='2'>Present Address</td>
                        <td col-span='1'><u style='width:100%;'>{{$model->present_address}}</u></td>
                        </tr>
                        <tr>
                        <td col-span='2'>Permanent Address</td>
                        <td col-span='1'><u style='width:100%;'>{{$model->permanent_address}}</u></td>
                        </tr>
                    
                        </table>
                             <table class='table table-responsive' style='margin-top:0px;'>
                        <tr><td><p><u><strong>3). Details of received service benefits (constructed house/flat) in any PN/Govt scheme through naval quota or otherwise. </strong></u></p></td></tr>
                        <?php
$jsondatatransaction = json_decode($model->transaction);
$kk=1;
if(!empty($jsondatatransaction)){
foreach ($jsondatatransaction as $key => $value) {
  //  echo '<pre>';print_r($value->cnic);die;
    if($kk == 1){

    
 ?>
 <tr>     
                        <td>a). <u><?= $value->service_details ?></u></td>
</tr>
 <?php

}else{
    ?>
     <tr>
                        <td>b.  <u><?= $value->service_details ?> </u></td>

</tr>
    <?php
}
$kk++;
}
}

?>
                    
                        </table>
                        <table class='table table-responsive' style='margin-top:0px;'>
                        <tr>
                        <td><strong>4). I hereby certify that: </strong></td>
                        </tr>
                        <tr>
                        <td><strong>a). Information given above is true and correct, to the best of my knowledge and belief Mis-declaration of information may result in cancellation of allotment and confiscation of deposited 
                                   amount at any stage. I also agree that NHQ retains the right to cancel or re-allot any house number without assigning any reason. </strong></td>
                        </tr>
                        <tr>
                        <td><strong>b).I am not re-employed</strong></td>
                        </tr>
                        <tr>
                        <td><strong><u>c).The following documents have been enclosed:</u></strong></td>
                        </tr>
                        <tr>
                        <td>
                        (1) A sum of Rs <u><?= $model->sum_of ?></u> through Pay order / Demand Draft No <br>
                        <u><?= $model->sum_of ?></u>  dated <u><?= $model->date ?></u> drawn on PN Welfare Housing scheme 
                                                      <u> A/C # 15-1, Allied Bank Ltd, Code 0680, E-8 Branch Naval Complex,Islamabad</u> forward herewith<br>
                                                      (2)  Attested copies of CNIC (Self + NOK).<br>
                                                      (3)  Nok Form in case of SD list Officers F(CW-10),CPOs/Sailors F(RP)-36 and Navy Civilians (Form of Nomination)<br>
                                                      (4) Attested copy of Children B form from NADRA.
                                                      (5) Copy of F(PA)-7 form for Officers & F(PA)-5 for CPOs/Sailors.<br>
                                                      (4) All applicant are to affix color photograph in Uniform (*Uniform (for Svc personnel) on Registration Form)
                       </td>
                        </tr>
                        <tr>
                        <td><strong>4). I will abide by: </strong></td>
                        </tr>
                        <tr>
                        <td>
                        a. The Payment shedule as specified and issued from time to time by Director PNWHS, Naval Headquaters,Islamabad<br>
                        b. All other instruction issued from time by NHQs/Competent Authorities <br>
                        c. The Lease rules regarding land.  <br>
                        d. The Lease deed to be executed at the time of transfer of house/flat in my name. <br>
                        e. I will render myself liable for disciplinary action under PN Ordinance 1961 as amended upto date for incorrect particulars given by me or non-compliance of other<br> instructions issued by the Competent Authorities from time to time.   <br>
                        </td>
                        </tr>
                        <tr>
                        <td>Date: <u><?= $model->date ?></u></td>
                        <td>Application Signature: ___________________</td>
                        </tr>
                        <tr><h5><u> COUNTERSIGNED BY COMMANDANT/COMMANDING OFFICER /HOD/DIRECTOR ATNHQ</u></h5></tr>
                       
                        

                      
                    
                        </table>
                        <table class='table table-responsive' style='margin-top:0px;'>
                        <tr>
                        <td>
    It is certificated that P/PJO/O No <u><?= $model->pjo; ?></u> Rate/Rate <u><?= $model->rate; ?></u> Name <u><?= $model->countersigned_name; ?></u> is serving
    under my command and all the particulars rendered by him are correct to the best of my knowledge.</td>
    </tr>
    <tr>
    <td>No.  <u><?= $model->countersigned_no; ?></u></td>
    <td> Commandant/CO/HOD/Director</td>
    </tr>
    <tr>
    <td>
    dated. <u><?= $model->date ?></u>
    </td>
    </tr>
                        </table>
                        
   
</body>
</html>