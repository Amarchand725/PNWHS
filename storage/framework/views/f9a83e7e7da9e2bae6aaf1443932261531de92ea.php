<div class="leftpanel hidensidebar">
    <div class="logopanel text-center">
        <a href="<?php echo e(url('/')); ?>" style="font-size: 34px; text-decoration: none; color: DimGray;">
            <span style="color: #1caf9a ">[</span><b>PNWHS</b><span style="color: #1caf9a ">]</span>
        </a>
    </div>
    <?php
        $usersdata =  DB::table('userroles')->where('id',Auth::user()->role)->first();
        if(!empty($usersdata)){
            $userrightsjson =  json_decode($usersdata->rights);
        }
        else{
            $dummyarray = array();
            $userrightsjson = $dummyarray;
        }
    ?>
    <div class="leftpanelinner">
        <h5 class="sidebartitle">Navigation</h5>
        <?php
            $user = App\Users::where('id', Auth::user()->id)->first();
            $member = App\AllotteeParticular::where('p_no', Auth::user()->p_no)->where('form_status', 0)->first();
        ?>

        <ul class="nav nav-pills nav-stacked nav-bracket">
            <li class="active"><a href="<?php echo e(url('/')); ?>"><i   class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <?php if($user->userType->name != 'user'): ?>
                <?php if(in_array("Application_update", $userrightsjson) || in_array("Application_view", $userrightsjson) || in_array("Application_delete", $userrightsjson)): ?>
                    <li class="nav-parent <?php echo e((request()->is('AllotteeParticular') || request()->is('AllotteeParticular/create') || request()->is('AllotteeParticular/*/edit') || request()->is('PromotedMember') || request()->is('PromotedMember/create') || request()->is('PromotedMember/*/edit')) ? 'nav-active' : ''); ?>"><a href=""><i class="fa fa-users"></i> <span>Member Management</span></a>
                        <ul class="children" 
                            <?php if(request()->is('AllotteeParticular') || request()->is('AllotteeParticular/create') || request()->is('AllotteeParticular/*/edit') || 
                                request()->is('PromotedMember') || request()->is('PromotedMember/create') || request()->is('PromotedMember/*/edit')): ?> 
                                style='display: block;' 
                            <?php endif; ?>
                        >
                            <li class="<?php echo e((request()->is('AllotteeParticular') || request()->is('AllotteeParticular/create') || request()->is('AllotteeParticular/*/edit')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/AllotteeParticular')); ?>"><i class="fa fa-caret-right"></i>Manage Members</a></li>
                            <li class="<?php echo e((request()->is('PromotedMember') || request()->is('PromotedMember/create') || request()->is('PromotedMember/*/edit')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/PromotedMember')); ?>"><i class="fa fa-caret-right"></i>Manage Promotions</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(in_array("Users", $userrightsjson)): ?>
                    <li class="nav-parent 
                        <?php echo e((request()->is('/Users') || request()->is('/Userroles') || request()->is('/Userpermission') || request()->is('/Users/ChangePassword')) ? 'nav-active' : ''); ?>

                    ">
                        <a href=""><i class="fa fa-users"></i> <span>User Management</span></a>
                        <ul class="children" 
                            <?php if(request()->is('Users') || request()->is('Userroles') || request()->is('Userpermission') || request()->is('Users/ChangePassword/*')): ?> 
                                style='display: block;' 
                            <?php endif; ?>
                        >
                            <!--<li class="<?php echo e((request()->is('Users')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Users')); ?>"><i class="fa fa-caret-right"></i>Manage Users</a></li>-->
                            <li class="<?php echo e((request()->is('Userroles')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Userroles')); ?>"><i class="fa fa-caret-right"></i>Manage Roles</a></li>
                            <li class="<?php echo e((request()->is('Userpermission')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Userpermission')); ?>"><i class="fa fa-caret-right"></i>Permission</a></li>
                            <li class="<?php echo e((request()->is('Users/ChangePassword/*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Users/ChangePassword',Auth::id())); ?>"><i class="fa fa-caret-right"></i>Change Password</a></li>
                        </ul>
                    </li>

                    <li class="nav-parent 
                        <?php echo e((request()->is('/Rank')) ? 'nav-active' : ''); ?>

                    ">
                        <a href=""><i class="fa fa-star"></i> <span>Rank Management</span></a>
                        <ul class="children" 
                            <?php if(request()->is('Rank')): ?> 
                                style='display: block;' 
                            <?php endif; ?>
                        >
                            <li class="<?php echo e((request()->is('Rank')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Rank')); ?>"><i class="fa fa-caret-right"></i>Manage Ranks</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-parent 
                    <?php echo e((request()->is('/PaymentPolicy') || request()->is('/HouseCost') || request()->is('/MemberProfit')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-lock"></i> <span>Policy Management</span></a>
                    <ul class="children" 
                        <?php if(request()->is('PaymentPolicy') || request()->is('HouseCost') || request()->is('MemberProfit')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('PaymentPolicy')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/PaymentPolicy')); ?>"><i class="fa fa-caret-right"></i>Manage Payment Policy</a></li>
                        <li class="<?php echo e((request()->is('HouseCost')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/HouseCost')); ?>"><i class="fa fa-caret-right"></i>Manage House Cost</a></li>
                        <li class="<?php echo e((request()->is('MemberProfit')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/MemberProfit')); ?>"><i class="fa fa-caret-right"></i>Manage Profit Rate</a></li>
                    </ul>
                </li>

                <li class="nav-parent
                    <?php echo e((request()->is('/Contractor') || request()->is('/Construction')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-building"></i> <span>Construct Management</span></a>
                    <ul class="children"
                        <?php if(request()->is('Contractor') || request()->is('Construction')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('Contractor')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Contractor')); ?>"><i class="fa fa-caret-right"></i>Manage Contractors</a></li>
                        <li class="<?php echo e((request()->is('Construction')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Construction')); ?>"><i class="fa fa-caret-right"></i>Manage Constructions</a></li>
                    </ul>
                </li>

                <li class="nav-parent 
                    <?php echo e((request()->is('/Payment') || request()->is('/CsvData') || request()->is('/CsvFile') || request()->is('/import')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-money"></i> <span>Payment Management</span></a>
                    <ul class="children" 
                        <?php if(request()->is('Payment') || request()->is('CsvData') || request()->is('CsvFile') || request()->is('import')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('Payment')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Payment')); ?>"><i class="fa fa-caret-right"></i>Manage Payments</a></li>
                        <li class="<?php echo e((request()->is('GetProfit')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/GetProfit')); ?>"><i class="fa fa-caret-right"></i>Manage Returned Fund</a></li>
                        <li class="<?php echo e((request()->is('CsvData')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/CsvData')); ?>"><i class="fa fa-caret-right"></i>File's Payments</a></li>
                        <li class="<?php echo e((request()->is('CsvFile')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/CsvFile')); ?>"><i class="fa fa-caret-right"></i>Manage Payment Sheets</a></li>
                        <li class="<?php echo e((request()->is('import')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/import')); ?>" title='Upload Monthly or Six Month Sheet'><i class="fa fa-caret-right"></i>Upload Sheet</a></li>
                        <!-- (<small>Monthly|Six Month</small>) -->
                    </ul>
                </li>

                <li class="nav-parent 
                    <?php echo e((request()->is('/AllotteeParticular/assigndata') || request()->is('/GetProfit') || request()->is('/AllotedHouse') || request()->is('/Payment')) ? 'nav-active' : ''); ?>

                ">
                    <a href="#">
                    <i style="" class="fa fa-tasks"></i> <span>Allotment Management</span></a>
                    <ul class="children"
                        <?php if(request()->is('AllotteeParticular/assigndata') || request()->is('GetProfit') || request()->is('AllotedHouse') || request()->is('Payment')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('AllotteeParticular/assigndata')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/AllotteeParticular/assigndata')); ?>"><i class="fa fa-caret-right"></i>Manage Allotments</a></li>
                        <li class="<?php echo e((request()->is('AllotedHouse')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/AllotedHouse')); ?>"><i class="fa fa-caret-right"></i>Manage Alloted Houses</a></li>
                    </ul>
                </li>

                <li class="nav-parent 
                    <?php echo e((request()->is('/Plot') || request()->is('/Propertytype') || request()->is('/Size') || request()->is('/Block')) ? 'nav-active' : ''); ?>

                ">
                    <a href="#">
                    <i style="" class="fa fa-tasks"></i> <span>Project Management</span></a>
                    <ul class="children"
                        <?php if(request()->is('Plot') || request()->is('Propertytype') || request()->is('Size') || request()->is('Block')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('Plot')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Plot')); ?>"><i class="fa fa-caret-right"></i>Manage Plots</a></li>
                        <li class="<?php echo e((request()->is('Propertytype')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Propertytype')); ?>"><i class="fa fa-caret-right"></i>Manage Property Types</a></li>
                        <li class="<?php echo e((request()->is('Size')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Size')); ?>"><i class="fa fa-caret-right"></i>Manage Sizes</a></li>
                        <li class="<?php echo e((request()->is('Block')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Block')); ?>"><i class="fa fa-caret-right"></i>Manage Blocks</a></li>
                    </ul>
                </li>

                <li class="nav-parent 
                    <?php echo e((request()->is('/member_financial_report') || request()->is('/project_financial_report') || request()->is('/eligibility_report') || request()->is('/profit_statement_report') || request()->is('/member_financial_report')) ? 'nav-active' : ''); ?>

                ">
                    <a href="#"><i style="" class="fa fa-file"></i> <span>Report Management</span></a>
                    <ul class="children"
                        <?php if(request()->is('member_financial_report') || request()->is('project_financial_report') || request()->is('member_financial_report') || request()->is('profit_statement_report') || request()->is('profit_statement_report')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('member_financial_report')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/member_financial_report')); ?>"><i class="fa fa-caret-right"></i>Member Financial Report</a></li>
                        <li class="<?php echo e((request()->is('project_financial_report')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/project_financial_report')); ?>"><i class="fa fa-caret-right"></i>Project Financial Report</a></li>
                        <li class="<?php echo e((request()->is('eligibility_report')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/eligibility_report')); ?>"><i class="fa fa-caret-right"></i>Eligibility Report</a></li>
                        <li class="<?php echo e((request()->is('profit_statement_report')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/profit_statement_report')); ?>"><i class="fa fa-caret-right"></i>Profit Statement</a></li>
                        <!--<li class="<?php echo e((request()->is('member_financial_report')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/member_financial_report')); ?>"><i class="fa fa-caret-right"></i>Account Statement</a></li>-->
                    </ul>
                </li>
                <li class="nav-parent 
                    <?php echo e((request()->is('/Feedback')) ? 'nav-active' : ''); ?>

                ">
                    <a href="#"><i class="fa fa-comments"></i> <span>User Feedbacks</span></a>
                    <ul class="children" 
                        <?php if(request()->is('Feedback')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('Feedback')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Feedback')); ?>"><i class="fa fa-caret-right"></i>Feedback</a></li>
                    </ul>
                </li>
                <li class="nav-parent
                    <?php echo e((request()->is('/Newsletter')) ? 'nav-active' : ''); ?>

                ">
                    <a href="#"><i class="fa fa-envelope"></i><span>News Letters</span></a>
                    <ul class="children"
                        <?php if(request()->is('Newsletter')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('Newsletter')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Newsletter')); ?>"><i class="fa fa-caret-right"></i><span>News Letters</span></a></li>
                    </ul>
                </li>
                <li class="nav-parent
                    <?php echo e((request()->is('/activemembers')) ? 'nav-active' : ''); ?>

                ">
                    <a href="#"><i class="fa fa-home"></i><span>Colony Management</span></a>
                    <ul class="children"
                        <?php if(request()->is('activemembers')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('activemembers')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/activemembers')); ?>"><i class="fa fa-caret-right"></i><span>Manage House</span></a></li>
                        <!-- <li><a href="<?php echo e(url('#')); ?>"><i class="fa fa-caret-right"></i><span>Black list</span></a></li> -->
                    </ul>
                </li>
                <li class="nav-parent
                    <?php echo e((request()->is('/GalleryImage')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-image"></i> <span>Gallery Management</span></a>
                    <ul class="children"
                        <?php if(request()->is('GalleryImage')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('GalleryImage')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/GalleryImage')); ?>"><i class="fa fa-caret-right"></i>Manage Gallery</a></li>
                    </ul>
                </li>
            <?php else: ?>
                <li class="nav-parent 
                    <?php echo e((request()->is('/AllotteeParticular/create') || request()->is('/AllotteeParticular/*')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-user"></i> <span>Membership</span></a>
                    <ul class="children"
                        <?php if(request()->is('AllotteeParticular/create') || request()->is('AllotteeParticular/*')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <?php if(empty($member)): ?>
                            <li class="<?php echo e((request()->is('AllotteeParticular/create')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/AllotteeParticular/create')); ?>"><i class="fa fa-caret-right"></i>Get Membership</a></li>  
                        <?php else: ?>
                            <li class="<?php echo e((request()->is('AllotteeParticular/*')) ? 'active' : ''); ?>"><a href="<?php echo e(route('AllotteeParticular.show', $member->p_no)); ?>"><i class="fa fa-caret-right"></i>Display Membership Form</a></li>  
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-parent 
                    <?php echo e((request()->is('/Payment')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-money"></i> <span>Payment</span></a>
                    <ul class="children"
                        <?php if(request()->is('Payment')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('Payment')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Payment')); ?>"><i class="fa fa-caret-right"></i>Paid Payments</a></li>
                    </ul>
                </li>
                <li class="nav-parent 
                    <?php echo e((request()->is('/GalleryImage')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-image"></i> <span>Picture Gallery</span></a>
                    <ul class="children"
                        <?php if(request()->is('GalleryImage')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('GalleryImage')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/GalleryImage')); ?>"><i class="fa fa-caret-right"></i>Gallery</a></li>
                    </ul>
                </li>
                <li class="nav-parent 
                    <?php echo e((request()->is('/Feedback')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-comment"></i> <span>Feed Back</span></a>
                    <ul class="children"
                        <?php if(request()->is('Feedback')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('Feedback')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Feedback')); ?>"><i class="fa fa-caret-right"></i>Feedback</a></li>
                    </ul>
                </li>
                <li class="nav-parent 
                    <?php echo e((request()->is('/Newsletter')) ? 'nav-active' : ''); ?>

                ">
                    <a href=""><i class="fa fa-envelope"></i> <span>News Letters</span></a>
                    <ul class="children"
                        <?php if(request()->is('Newsletter')): ?> 
                            style='display: block;' 
                        <?php endif; ?>
                    >
                        <li class="<?php echo e((request()->is('Newsletter')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/Newsletter')); ?>"><i class="fa fa-caret-right"></i>News Letters</a></li>
                    </ul>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</div>