
<?php $__env->startSection('content'); ?>
    <style>
        th{
            text-align:left
        }
    </style>
    <div class="panel panel-dark">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="minimize">−</a>
            </div>
            <h4 class="panel-title">Member Form
                <span style='text-algin:right'>
                    <a href="<?php echo e(url('/download_form')); ?>/<?php echo e($model->id); ?>" title='Down Load Form' class='btn btn-success'><i class='fa fa-download'></i></a>
                </span>
            </h4>
        </div>

        <div class="panel-body">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-3">
                        <legend>Applicant Photograph:
                            <?php if(!empty($model->hasAllotteeFiles->applicant_photograph)): ?>
                                <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->applicant_photograph); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                            <?php endif; ?>
                        </legend>
                        <?php if(!empty($model->hasAllotteeFiles->applicant_photograph)): ?>
                            <?php if(explode('.', $model->hasAllotteeFiles->applicant_photograph)[1]=='pdf'): ?>
                                <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph)); ?>" type="application/pdf" style='height:250px; width:400px' />
                            <?php else: ?>
                                <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph)); ?>" style='height:250px; width:400px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        <?php else: ?>
                            <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:250px; width:400px' class="img-responsive thumbnail"/>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-9">
                        <fieldset>
                            <legend>Basic Information:</legend>
                            <table class="table table-bordered">
                                <?php if(!empty($model->hasPromotedMember->old_p_no) && Auth::user()->hasRole->role=='Admin'): ?>
                                    <tr>
                                        <th>New Registration /File Number</th>
                                        <td>
                                            <?php echo e($model->hasPromotedMember->file_registration_no??'--'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Old Registration /File Number</th>
                                        <td>
                                            <?php echo e($model->reg_file_no??'--'); ?>

                                    </td>
                                    </tr>
                                    <tr>
                                        <th>New P/PJ/O No:</th>
                                        <td>
                                            <?php echo e($model->hasPromotedMember->new_p_no??'--'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Old P/PJ/O No:</th>
                                        <td>
                                            <?php echo e($model->hasPromotedMember->old_p_no??'--'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Promoted Rank/Rate:</th>
                                        <td>
                                            <?php echo e($model->hasPromotedMember->hasPromotedRank->name??'--'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Old Rank/Rate:</th>
                                        <td>
                                            <?php echo e($model->hasRank->name??'--'); ?> 
                                        </td>
                                    </tr>
                                     <tr>
                                <?php else: ?>
                                    <tr>
                                        <th>Registration /File Number</th>
                                        <td>
                                            <?php if(!empty($model->hasPromotedMember)): ?>
                                                <?php echo e($model->hasPromotedMember->file_registration_no??'--'); ?>

                                            <?php else: ?>
                                                <?php echo e($model->reg_file_no??'--'); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>P/PJ/O No:</th>
                                        <td>
                                        <?php if(!empty($model->hasPromotedMember)): ?>
                                            <?php echo e($model->hasPromotedMember->new_p_no); ?>

                                        <?php else: ?>
                                            <?php echo e($model->p_no??'--'); ?>

                                        <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rank/Rate:</th>
                                        <td>
                                            <?php if(!empty($model->hasPromotedMember)): ?>
                                                <?php echo e($model->hasPromotedMember->hasPromotedRank->name); ?>

                                            <?php else: ?>
                                                <?php echo e($model->hasRank->name??'--'); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th>Branch:</th>
                                    <td> <?php echo e($model->branch??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td>
                                        <?php if(!empty($model->hasPromotedMember)): ?>
                                            <?php echo e($model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'--'); ?>

                                        <?php else: ?>
                                            <?php echo e($model->hasRank->hasHouseCategory->name??'--'); ?> 
                                        <?php endif; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Person:</th>
                                    <td>
                                        <?php if(!empty($model->hasPromotedMember)): ?>
                                            <?php echo e(ucfirst($model->hasPromotedMember->soldier)??'--'); ?>

                                        <?php else: ?>
                                            <?php echo e(ucfirst($model->soldier??'--')); ?> 
                                        <?php endif; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td><span><?php echo e(ucfirst($model->name)??'--'); ?></span></td>
                                </tr>
                                <tr>
                                    <th>CNIC No:</th>
                                    <td> <?php echo e($model->cnic_no??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Date of Birth:</th>
                                    <td> <?php echo e(date('d, F Y', strtotime($model->d_o_b))??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Total Service:</th>
                                    <td> 
                                        <?php if(!empty($model->hasPromotedMember)): ?>
                                            <?php echo e(ucfirst($model->hasPromotedMember->total_service)??'--'); ?>

                                        <?php else: ?>
                                            <?php echo e($model->total_service??'--'); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend>Job Information:</legend>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Membership Date:</th>
                                    <td> <?php echo e(date('d, F Y', strtotime($model->membership_date))??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Date of Enrolment:</th>
                                    <td>  <?php echo e(date('d, F Y', strtotime($model->d_o_e))??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Probationary Complete Date:</th>
                                    <td> <?php echo e(date('d, F Y', strtotime($model->d_o_c))??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Date of Promotion to Present Rank:</th>
                                    <td> 
                                        <?php if(!empty($model->hasPromotedMember)): ?>
                                            <?php echo e(date('d, F Y', strtotime($model->hasPromotedMember->d_o_p))??'--'); ?>

                                        <?php else: ?>
                                            <?php echo e(date('d, F Y', strtotime($model->d_o_p))??'--'); ?>

                                        <?php endif; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date of SOD:</th>
                                    <td>
                                        <?php if(!empty($model->hasPromotedMember)): ?>
                                            <?php echo e(date('d, F Y', strtotime($model->hasPromotedMember->d_o_sod))??'--'); ?>  
                                        <?php else: ?>
                                            <?php echo e(date('d, F Y', strtotime($model->d_o_sod))??'--'); ?>  
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if(!empty($model->hasPromotedMember)): ?> 
                                    <?php if($model->hasPromotedMember->soldier=='uniform'): ?>
                                        <tr>
                                            <th>Date of SOS(<small>Uniform</small>):</th>
                                            <td>  <?php echo e(date('d, F Y', strtotime($model->hasPromotedMember->d_o_sos))??'--'); ?> </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <th>Date of Superannuation age(<small>Civilian</small>):</th>
                                            <td> <?php echo e(date('d, F Y', strtotime($model->hasPromotedMember->d_o_s))??'--'); ?> </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php else: ?> 
                                    <?php if($model->soldier=='uniform'): ?>
                                        <tr>
                                            <th>Date of SOS(<small>Uniform</small>):</th>
                                            <td>  <?php echo e(date('d, F Y', strtotime($model->d_o_sos))??'--'); ?> </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <th>Date of Superannuation age(<small>Civilian</small>):</th>
                                            <td> <?php echo e(date('d, F Y', strtotime($model->d_o_s))??'--'); ?> </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <tr>
                                    <th>Unit:</th>
                                    <td> <?php echo e($model->unit??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Other benefit: <small>(From Govt. of Pakistan e,g house, flat, plot etc)</small></th>
                                    <td> <?php echo e($model->any_other_benifit??'--'); ?> </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend>Contact Information:</legend>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Mobile No:</th>
                                    <td> <?php echo e($model->mob_no??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Telephone No:</th>
                                    <td> <?php echo e($model->tel_no??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Email Address:</th>
                                    <td> <?php echo e($model->email_address??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Present Address:</th>
                                    <td> <?php echo e($model->present_address??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Permanent Address:</th>
                                    <td> <?php echo e($model->permanent_address??'--'); ?> </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                </div>

                <div class="row">
                    <fieldset>
                        <legend>Details of next of Kin/Parents:</legend>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Share %</th>
                                <th>Name</th>
                                <th>Relation</th>
                                <th>CNIC No</th>
                                <th>Mobile No</th>
                                <th>Address</th>
                            </tr>
                            <?php $counter = 1; ?>
                            <?php $__currentLoopData = $model->hasAllotteKinDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($counter++); ?>.</td>
                                    <td><?php echo e($value->share??'--'); ?>%</td>
                                    <td><?php echo e($value->name??'--'); ?></td>
                                    <td><?php echo e($value->relation??'--'); ?></td>
                                    <td><?php echo e($value->cnic_no??'--'); ?></td>
                                    <td><?php echo e($value->mobile_no??'--'); ?></td>
                                    <td><?php echo e($value->address??'--'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </fieldset>
                </div>

                <div class="row">
                    <fieldset>
                        <legend>Uploaded Documents:</legend>
                        <div class="col-md-4">
                            <legend>CNIC Front:
                                <?php if(!empty($model->hasAllotteeFiles->cnicfront)): ?>
                                    <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->cnicfront); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                <?php endif; ?>
                            </legend>
                            <?php if(!empty($model->hasAllotteeFiles->cnicfront)): ?>
                                <?php if(explode('.', $model->hasAllotteeFiles->cnicfront)[1]=='pdf'): ?>
                                    <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->cnicfront)); ?>" type="application/pdf" style='height:300px; width:600px' />
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->cnicfront)); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <legend>CNIC Back:
                                <?php if(!empty($model->hasAllotteeFiles->cnicback)): ?>
                                    <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->cnicback); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                <?php endif; ?>
                            </legend>
                            <?php if(!empty($model->hasAllotteeFiles->cnicback)): ?>
                                <?php if(explode('.', $model->hasAllotteeFiles->cnicback)[1]=='pdf'): ?>
                                    <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->cnicback)); ?>" type="application/pdf" style='height:300px; width:600px' />
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->cnicback)); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <legend>Children B form:
                                <?php if(!empty($model->hasAllotteeFiles->childrenbform)): ?>
                                    <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->childrenbform); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                <?php endif; ?>
                            </legend>
                            <?php if(!empty($model->hasAllotteeFiles->childrenbform)): ?>
                                <?php if(explode('.', $model->hasAllotteeFiles->cnicfront)[1]=='pdf'): ?>
                                    <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->childrenbform)); ?>" type="application/pdf" style='height:300px; width:600px' />
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->childrenbform)); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                </div>
                <br /><br />
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <legend>Allotment Form:
                                <?php if(!empty($model->hasAllotteeFiles->fpaform)): ?>
                                    <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->fpaform); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                <?php endif; ?>
                            </legend>
                            <?php if(!empty($model->hasAllotteeFiles->fpaform)): ?>
                                <?php if(explode('.', $model->hasAllotteeFiles->fpaform)[1]=='pdf'): ?>
                                    <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->fpaform)); ?>" type="application/pdf" style='height:300px; width:600px' />
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->fpaform)); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <legend>FRP-36 & FC(W)-10 form:
                                <?php if(!empty($model->hasAllotteeFiles->frp_fc)): ?>
                                    <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->frp_fc); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                <?php endif; ?>
                            </legend>
                            <?php if(!empty($model->hasAllotteeFiles->frp_fc)): ?>
                                <?php if(explode('.', $model->hasAllotteeFiles->frp_fc)[1]=='pdf'): ?>
                                    <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->frp_fc)); ?>" type="application/pdf" style='height:300px; width:600px' />
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->frp_fc)); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <legend>Demand Draft/ Banker cheque:
                                <?php if(!empty($model->hasAllotteeFiles->draft_cheque)): ?>
                                    <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->draft_cheque); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                <?php endif; ?>
                            </legend>
                            <?php if(!empty($model->hasAllotteeFiles->draft_cheque)): ?>
                                <?php if(explode('.', $model->hasAllotteeFiles->draft_cheque)[1]=='pdf'): ?>
                                    <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->draft_cheque)); ?>" type="application/pdf" style='height:300px; width:600px' />
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->draft_cheque)); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <br /><br />
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <legend>Promotion Letter:
                                <?php if(!empty($model->hasAllotteeFiles->promotion_letter)): ?>
                                    <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->promotion_letter); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                <?php endif; ?>
                            </legend>
                            <?php if(!empty($model->hasAllotteeFiles->promotion_letter)): ?>
                                <?php if(explode('.', $model->hasAllotteeFiles->promotion_letter)[1]=='pdf'): ?>
                                    <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->promotion_letter)); ?>" type="application/pdf" style='height:300px; width:600px' />
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->promotion_letter)); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <legend>Any other document:
                                <?php if(!empty($model->hasAllotteeFiles->any_other_docs)): ?>
                                    <a title='Download This Image' href="<?php echo e(url('download_image')); ?>/<?php echo e($model->hasAllotteeFiles->any_other_docs); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                <?php endif; ?>
                            </legend>
                            <?php if(!empty($model->hasAllotteeFiles->any_other_docs)): ?>
                                <?php if(explode('.', $model->hasAllotteeFiles->any_other_docs)[1]=='pdf'): ?>
                                    <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->any_other_docs)); ?>" type="application/pdf" style='height:300px; width:600px' />
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->any_other_docs)); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php if(count($model->hasAllotteeKinsMultipleFiles)>0): ?>
                        <legend>Next of Kins file:</legend>
                        <?php $__currentLoopData = $model->hasAllotteeKinsMultipleFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kinsfile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <?php if(!empty($kinsfile)): ?>
                                    <div style='float:left'><a title='Download This Image' href="<?php echo e(url('download_kins_doc')); ?>/<?php echo e($kinsfile->filetext); ?>" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a></div>
                                    <?php if(explode('.', $kinsfile->filetext[1]=='pdf')): ?>
                                        <embed src="<?php echo e(url('public/kinsfiles/'.$kinsfile->filetext)); ?>" type="application/pdf" style='height:320px; width:600px' />
                                    <?php else: ?>
                                        <img src="<?php echo e(url('public/kinsfiles/'.$kinsfile->filetext)); ?>" style='height:320px; width:600px' class="img-responsive thumbnail"/>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                
                <?php if($model->form_status==1): ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="<?php echo e(url('update_form_status')); ?>" method='post'>
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <input type="hidden" name='p_no' value='<?php echo e($model->p_no); ?>'>
                                    <button type='submit' name='submit' value='submit' class='btn btn-success'><i class='fa fa-save'></i> Save</button>
                                    <button type='submit' name='submit' value='canceled' class='btn btn-danger'><i class='fa fa-times'></i> Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>