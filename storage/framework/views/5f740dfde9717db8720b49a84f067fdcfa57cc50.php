
<?php $__env->startSection('contentss'); ?>
    <style>
        th{
            text-align:left
        }
    </style>
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">Member Form</h4>
        </div>

        <div class="panel-body">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-3" style='float:right'>
                        <?php if(!empty($model->hasAllotteeFiles->applicant_photograph)): ?>
                            <?php if(explode('.', $model->hasAllotteeFiles->applicant_photograph)[1]=='pdf'): ?>
                                <embed src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph)); ?>" style='height:180px; width:200px' class="img-responsive thumbnail"/>
                            <?php else: ?>
                                <img src="<?php echo e(url('public/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph)); ?>" style='height:180px; width:200px' class="img-responsive thumbnail"/>
                            <?php endif; ?>
                        <?php else: ?>
                            <img src="<?php echo e(url('public/images/no-image.jpg')); ?>" style='height:180px; width:200px' class="img-responsive thumbnail"/>
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
                                            <?php echo e($model->p_no??'--'); ?>

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
                                        <th>Category:</th>
                                        <td>
                                            <?php if(!empty($model->hasPromotedMember)): ?>
                                                <?php echo e($model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'--'); ?>

                                            <?php else: ?>
                                                <?php echo e($model->hasRank->hasHouseCategory->name??'--'); ?> 
                                            <?php endif; ?> 
                                        </td>
                                    </tr>
                                </tr>
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
                                <?php else: ?>
                                    <tr>
                                        <th>Registration /File Number</th>
                                        <td>
                                            <?php echo e($model->reg_file_no??'--'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>P/PJ/O No:</th>
                                        <td>
                                            <?php echo e($model->p_no??'--'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rank/Rate:</th>
                                        <td>
                                            <?php echo e($model->hasRank->name??'--'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Category:</th>
                                        <td>
                                            <?php echo e($model->hasRank->hasHouseCategory->name??'--'); ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Person:</th>
                                        <td> 
                                            <?php echo e(ucfirst($model->soldier??'--')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
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
                                            <?php echo e($model->hasPromotedMember->total_service??'--'); ?>

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
                                    <th>Branch:</th>
                                    <td> <?php echo e($model->branch??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Unit:</th>
                                    <td> <?php echo e($model->unit??'--'); ?> </td>
                                </tr>
                                <tr>
                                    <th>Other benefit:<small>(From Govt. of Pakistan e,g house, flat, plot etc)</small></th>
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
                    <div class="col-sm-12">
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
                </div>
            </div>
        </div>
    </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master_without_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>