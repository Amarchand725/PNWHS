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
</style>
<body>
{!! Form::open([
'route' => 'standalonesubmit',
'files' => 'true',
'id' => 'form2'
]) !!}
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 text text-center">
              <h1>Restricted</h1>
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
                    <h4 class="text text-center"><u >PNWHS REGISTRATION FORM FOR HOUSE CATEGORY A,B&C</u></h4>
                    <h5 class="text text-center"><ul><li>                 Please read the instructions and terms/conditions overleaf</li></ul></h5>
                    </div>
                    <div class="col-sm-8 col-md-3 col-lg-3">
                    <input type="file" name="image[]" class="form-control">
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4><u>1). Particular of the applicant </u></h4>
                            </div>
                            <div class='col-md-2 form-group col-lg-2'>
                                <span>P/PJ/O No</span>
                                </div>
                            <div class='col-md-4 form-group col-lg-4'>
                            <input  type='text' name='p_no' placeholder="P/PJ No" class="form-control bordernone"/>
                        </div>
                        <div class='col-md-2 form-group col-lg-2'>
                        <span>Rank/Rate</span>
                        </div>
                                    <div class='col-md-4 form-group col-lg-4'>
                                          <span> <input type='text' name='rank_rate' placeholder="Rank Rate" class="form-control bordernone"/></span>
                            </div>
                            <div class='col-md-2 form-group col-lg-2'>
                                <span>Name</span>
                                </div>
                            <div class='col-md-4 form-group col-lg-4'>
                            <input  type='text' name='name' placeholder="Name" class="form-control bordernone"/>
                        </div>
                        <div class='col-md-2 form-group col-lg-2'>
                        <span>CNIC NO</span>
                        </div>
                        <div class='col-md-4 form-group col-lg-4'>
                             <span> <input type='text' name='cnic_no' placeholder="Cnic Number" class="form-control bordernone"/></span>
                            </div>
                            <div class='col-md-2 form-group col-lg-2'>
                                <span>Date Of Birth</span>
                                </div>
                            <div class='col-md-4 form-group col-lg-4'>
                            <input  type='date' name='d_o_b' placeholder="Date Of Birth" class="form-control d_o_b hasDatepicker bordernone"/>
                        </div>
                        <div class='col-md-2 form-group col-lg-2'>
                        <span>Father's Name</span>
                        </div>
                                    <div class='col-md-4 form-group col-lg-4'>
                                          <span> <input type='text' name='father_name_particular' placeholder="Father Name" class="form-control bordernone"/></span>
                            </div>
                            <div class='col-md-2 form-group col-lg-2'>
                                <span>Date of Enrolment</span>
                                </div>
                            <div class='col-md-4 form-group col-lg-4'>
                            <input  type='date' name='d_o_e' placeholder="Date of Enrolment" class="form-control d_o_e hasDatepicker bordernone"/>
                        </div>
                        <div class='col-md-2 form-group col-lg-2'>
                        <span>Branch</span>
                        </div>
                                    <div class='col-md-4 form-group col-lg-4'>
                                          <span> <input type='text' name='branch' placeholder="Branch" class="form-control bordernone"/></span>
                            </div>
                            <div class='col-md-4 form-group col-lg-4'>
                                <span>Date Of Completion of Probationary Period</span>
                                </div>
                            <div class='col-md-8 form-group col-lg-8'>
                            <input  type='date' name='d_o_c' placeholder="Date Of Completion" class="form-control d_o_c hasDatepicker bordernone"/>
                        </div>
                        <div class='col-md-4 form-group col-lg-4'>
                        <span>Date Of Promotion to Present Bank</span>
                        </div>
                             <div class='col-md-8 form-group col-lg-8'>
                             <span> <input type='date' name='d_o_p' placeholder="Date Of Promotion" class="form-control d_o_p hasDatepicker bordernone"/></span>
                            </div>
                            <div class='col-md-2 form-group col-lg-2'>
                                <span>Date of SOD</span>
                                </div>
                            <div class='col-md-4 form-group col-lg-4'>
                            <input  type='date' name='d_o_sod' placeholder="Date of SOD" class="form-control d_o_sod hasDatepicker bordernone"/>
                        </div>
                        <div class='col-md-2 form-group col-lg-2'>
                        <span>Date of SOS</span>
                        </div>
                                    <div class='col-md-4 form-group col-lg-4'>
                                          <span> <input type='date' name='d_o_sos' placeholder="Date of SOS" class="form-control d_o_sos hasDatepicker bordernone"/></span>
                            </div>
                            <div class='col-md-5 form-group col-lg-5'>
                            <span>Date of Superannuation age: (for Navy Civilians)</span>
                            </div>
                        <div class='col-md-7 form-group col-lg-7'>
                        <input  type='date' name='d_o_s' placeholder="Date of Superannuation age" class="form-control d_o_s hasDatepicker bordernone"/>
                    </div>
                            <div class='col-md-5 form-group col-lg-5'>
                                <span>Total Service rendered in PN excluding probationary Period</span>
                                </div>
                            <div class='col-md-7 form-group col-lg-7'>
                            <input  type='text' name='total_service' placeholder="Total Service rendered" class="form-control bordernone"/>
                        </div>
                     
                    <div class='col-md-2 form-group col-lg-2'>
                        <span>Tel No</span>
                        </div>
                    <div class='col-md-4 form-group col-lg-4'>
                    <input  type='text' name='tel_no' placeholder="Telephone Number" class="form-control bordernone"/>
                </div>
                <div class='col-md-2 form-group col-lg-2'>
                    <span>Mob No</span>
                    </div>
                <div class='col-md-4 form-group col-lg-4'>
                <input  type='text' name='mob_no' placeholder="Mob No" class="form-control bordernone"/>
            </div>
            <div class='col-md-3 form-group col-lg-3'>
                <span>Email Address</span>
                </div>
            <div class='col-md-9 form-group col-lg-9'>
            <input  type='email' name='email_address' placeholder="Email Address" class="form-control bordernone"/>
        </div> 
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                <h4><u>2). Details of Next Of Kin/Parents</u></h4>
                </div>
                <div class='col-md-4 form-group col-lg-4'>
                    <span>
                        Next Of Kin (Name & Relationship)<br>
            <span style="font-size: 9px;"> (In Case of more than one wife/ or then wife)</span>
                    </span>
                    </div>
                    <div class='col-md-1 form-group col-lg-1'>
                        <p class="pull-right">(1)</p>
                        </div>
                <div class='col-md-3 form-group col-lg-3'>
                <input  type='text' name='transactionform2[0][relation]' placeholder="Relation" class="form-control bordernone"/>
            </div> 
            <div class='col-md-2 form-group col-lg-2'>
               <span>CNIC No</span>
            </div>
            <div class='col-md-2 form-group col-lg-2'>
                <input  type='text' name='transactionform2[0][cnic]' placeholder="CNIC" class="form-control bordernone"/>
             </div>  
            

                </div>
                <div class="row">
                    <div class='col-md-4 form-group col-lg-4'>

                    </div>
                    <div class='col-md-1 form-group col-lg-1'>
                        <p class="pull-right">(2)</p>
                        </div>
                <div class='col-md-3 form-group col-lg-3'>
                <input  type='text' name='transactionform2[1][relation]' placeholder="Relation" class="form-control bordernone"/>
            </div> 
            <div class='col-md-2 form-group col-lg-2'>
               <span>CNIC No</span>
            </div>
            <div class='col-md-2 form-group col-lg-2'>
                <input  type='text' name='transactionform2[1][cnic]' placeholder="CNIC" class="form-control bordernone"/>
             </div>
                </div>
                <div class="row">
                    <div class='col-md-4 form-group col-lg-4'>

                    </div>
                    <div class='col-md-1 form-group col-lg-1'>
                        <p class="pull-right">(3)</p>
                        </div>
                <div class='col-md-3 form-group col-lg-3'>
                <input  type='text' name='transactionform2[2][relation]' placeholder="Relation" class="form-control bordernone"/>
            </div> 
            <div class='col-md-2 form-group col-lg-2'>
               <span>CNIC No</span>
            </div>
            <div class='col-md-2 form-group col-lg-2'>
                <input  type='text' name='cnic_no' placeholder="CNIC No" class="form-control bordernone"/>
             </div>
                </div>
                <div class="row">
                    <div class='col-md-4 form-group col-lg-4'>

                    </div>
                    <div class='col-md-1 form-group col-lg-1'>
                        <p class="pull-right">(4)</p>
                        </div>
                <div class='col-md-3 form-group col-lg-3'>
                <input  type='text' name='transactionform2[3][relation]' placeholder="Relation" class="form-control bordernone"/>
            </div> 
            <div class='col-md-2 form-group col-lg-2'>
               <span>CNIC No</span>
            </div>
            <div class='col-md-2 form-group col-lg-2'>
                <input  type='text' name='transactionform2[3][cnic]' placeholder="CNIC" class="form-control bordernone"/>
             </div>
                </div>
                <div class="row">
                    <div class='col-md-5 form-group col-lg-5'>
                        <span>Father (Alive/Deceased) Name </span>
                        </div>
                    <div class='col-md-7 form-group col-lg-7'>
                    <input  type='text' name='father_name' placeholder="Father (Alive/Deceased) Name " class="form-control bordernone"/>
                </div>
                <div class='col-md-5 form-group col-lg-5'>
                        <span>Father (Alive/Deceased) Address</span>
                        </div>
                    <div class='col-md-7 form-group col-lg-7'>
                    <input  type='text' name='father_address' placeholder="Father (Alive/Deceased) NameAddress" class="form-control bordernone"/>
                </div>




                
                <div class='col-md-5 form-group col-lg-5'>
                    <span>Mother (Alive/Deceased) Name</span>
                    </div>
                <div class='col-md-7 form-group col-lg-7'>
                <input  type='text' name='mother_name' placeholder="Mother (Alive/Deceased) Name" class="form-control bordernone"/>
            </div>
            <div class='col-md-5 form-group col-lg-5'>
                    <span>Mother (Alive/Deceased) Address</span>
                    </div>
                <div class='col-md-7 form-group col-lg-7'>
                <input  type='text' name='mother_address' placeholder="Mother (Alive/Deceased) Address" class="form-control bordernone"/>
            </div>


            <div class='col-md-5 form-group col-lg-5'>
                <span>Present Address</span>
                </div>
            <div class='col-md-7 form-group col-lg-7'>
            <input  type='text' name='present_address' placeholder="Present Address" class="form-control bordernone"/>
        </div>
        <div class='col-md-5 form-group col-lg-5'>
            <span>Permanent Address</span>
            </div>
        <div class='col-md-7 form-group col-lg-7'>
        <input  type='text' name='permanent_address' placeholder="Permanent Address" class="form-control bordernone"/>
    </div>
                </div>
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <p>3). Details of received service benefits (constructed house/flat) in any PN/Govt scheme through naval quota or otherwise.</p>
                    </div>
                    <div class='col-md-2 form-group col-lg-2'>
                        <span>a.</span>
                        </div>
                    <div class='col-md-10 form-group col-lg-10'>
                    <input  type='text' name='transaction[0][service_details]' placeholder="" class="form-control bordernone"/>
                </div>
                <div class='col-md-2 form-group col-lg-2'>
                    <span>b.</span>
                    </div>
                <div class='col-md-10 form-group col-lg-10'>
                <input  type='text' name='transaction[1][service_details]' placeholder="" class="form-control bordernone"/>
            </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                        <p>4). I hereby certify that: </p>
                        </div>
                        <div class='col-md-1 form-group col-lg-1'>
                            <span>a.</span>
                            </div>
                            <div class='col-md-11 form-group col-lg-11'>
                               <p>
                                   Information given above is true and correct, to the best of my knowledge and belief Mis-declaration of information may result in cancellation of allotment and confiscation of deposited 
                                   amount at any stage. I also agree that NHQ retains the right to cancel or re-allot any house number without assigning any reason.
                               </p>
                                </div>
                                <div class='col-md-12 form-group col-lg-12'>
                                    <span>b. I am not re-employed</span>
                                    </div>
                                    <div class='col-md-1 form-group col-lg-1'>
                                        <span>c.</span>
                                        </div>
                                        <div class='col-md-11 form-group col-lg-11'>
                                           <p>
                                               <u>The following documents have been enclosed:</u>
                                           </p>
                                            </div>
                                            <div class='col-md-1 form-group col-lg-1'>
                                            
                                                </div>
                                                <div class='col-md-11 form-group col-lg-11'>
                                                   <p>
                                                      (1) A sum of Rs <input  type='text' name='sum_of' placeholder="Sum Of" class="bordernone"/>through Pay order / Demand Draft No <input  type='text' name='draft_no' placeholder=" Draft No" class="bordernone"/> dated <input  type='date' name='date' placeholder="Date" class="bordernone"/><br>
                                                      <u> A/C # 15-1, Allied Bank Ltd, Code 0680, E-8 Branch Naval Complex,Islamabad</u> forward herewith<br>
                                                      (2)  Attested copies of CNIC (Self + NOK).<br>
                                                      (3)  Nok Form in case of SD list Officers F(CW-10),CPOs/Sailors F(RP)-36 and Navy Civilians (Form of Nomination)<br>
                                                      (4) Attested copy of Children B form from NADRA.
                                                      (5) Copy of F(PA)-7 form for Officers & F(PA)-5 for CPOs/Sailors.<br>
                                                      (4) All applicant are to affix color photograph in Uniform (*Uniform (for Svc personnel) on Registration Form)
                                                   </p>
                                                    </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                            <p>5). I will abide by: </p>
                            </div>
                            <div class='col-md-1 form-group col-lg-1'>
                                <span>a.</span>
                                </div>
                                <div class='col-md-11 form-group col-lg-11'>
                                   <p>
                                       The Payment shedule as specified and issued from time to time by Director PNWHS, Naval Headquaters,Islamabad
                                   </p>
                                    </div>
                                    <div class='col-md-1 form-group col-lg-1'>
                                        <span>b.</span>
                                        </div>
                                        <div class='col-md-11 form-group col-lg-11'>
                                           <p>
                                               All other instruction issued from time by NHQs/Competent Authorities 
                                           </p>
                                        </div>
                                        <div class='col-md-1 form-group col-lg-1'>
                                            <span>c.</span>
                                            </div>
                                            <div class='col-md-11 form-group col-lg-11'>
                                               <p>
                                                 The Lease rules regarding land. 
                                               </p>
                                            </div>
                                            <div class='col-md-1 form-group col-lg-1'>
                                                <span>d.</span>
                                                </div>
                                                <div class='col-md-11 form-group col-lg-11'>
                                                   <p>
                                        The Lease deed to be executed at the time of transfer of house/flat in my name. 
                                                   </p>
                                                </div>
                                                <div class='col-md-1 form-group col-lg-1'>
                                                    <span>e.</span>
                                                    </div>
                                                    <div class='col-md-11 form-group col-lg-11'>
                                                       <p>
                                    I will render myself liable for disciplinary action under PN Ordinance 1961 as amended upto date for incorrect particulars given by me or non-compliance of other instructions issued by the Competent Authorities from time to time. 
                                                       </p>
                                                    </div>
                                                    <div class='col-md-2 form-group col-lg-2'>
                                                        <span>Date:</span>
                                                        </div>
                                                        <div class='col-md-4 form-group col-lg-4'>
                                                        <input  type='date' name='1' placeholder="" class="bordernone"/>
                                                            </div>
                                                            <div class='col-md-2 form-group col-lg-2'>
                                                                <span>Applicant Signature</span>
                                                                </div>
                                                                <div class='col-md-4 form-group col-lg-4'>
                                                                    <span>____________________________</span>
                                                                    </div>
                                                                    <div class='col-md-12 form-group col-lg-12 text text-center'>
                                                                        <span><h3><u>
                                                                            COUNTERSIGNED BY COMMANDANT/COMMANDING OFFICER /HOD/DIRECTOR ATNHQ
                                                                </h3></u></span>
                                                                    </div>
                                                                    <div class='col-md-12 form-group col-lg-12 text text-center'>
                                                                        <span>
                                            <p> 
                                    It is certificated that P/PJO/O No <input  type='text' name='pjo' placeholder="Enter P/PJO/O No" class="bordernone"/> Rate/Rate <input  type='text' name='rate' placeholder="Enter Rate" class="bordernone"/> Name <input  type='text' name='countersigned_name' placeholder="Countersigned Name" class="bordernone"/> is serving
                                    under my command and all the particulars rendered by him are correct to the best of my knowledge
                                             </p>
                                                                    </span>
                                                                    </div>
                                                                    <div class='col-md-1 form-group col-lg-1'>
                                                                        <span>
                                                                            No.
                                                                    </span>
                                                                    </div>
                                                                    <div class='col-md-5 form-group col-lg-5'>
                                                                        <span>
                                                                        <input  type='text' name='countersigned_no' placeholder="Countersigned No" class="bordernone"/>
                                                                    </span>
                                                                    </div>
                                                                    <div class='col-md-6 form-group col-lg-6 text text-center'>
                                                                        <span>
                                                                         Commandant/CO/HOD/Director
                                                                    </span>
                                                                    </div>
                                                                    <div class='clearfix'></div>
                                                                    <div class='col-md-1 form-group col-lg-1'>
                                                                        <span>
                                                                         dated:
                                                                    </span>
                                                                    </div>
                                                                    <div class='col-md-5 form-group col-lg-5'>
                                                                        <span>
                                                                        <input  type='date' name='dated' placeholder="" class="bordernone"/>
                                                                        </span>
                                                                    </div>
                                                                    <div class='col-md-6 form-group col-lg-6'>
                                                                        <span>
                                                                           
                                                                        </span>
                                                                    </div>
                            </div>
                            <div class='row'>
	<div class="col-md-12">
		<div class="form-group">
	<ul class="pager wizard">
					<li class=" pull-right">
					<input type='submit' name='next' class=" btn btn-info" value='Submit'/>
					
					</li>
				</ul>
</div>
</div>
                            {!! Form::close() !!}
</body>
</html>