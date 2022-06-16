<div class="leftpanel hidensidebar">
    <div class="logopanel text-center">
        <a href="{{url('/')}}" style="font-size: 34px; text-decoration: none; color: DimGray;">
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
        @php
            $user = App\Users::where('id', Auth::user()->id)->first();
            $member = App\AllotteeParticular::where('p_no', Auth::user()->p_no)->first();
        @endphp

        <ul class="nav nav-pills nav-stacked nav-bracket">
            <li class="active"><a href="{{url('/')}}"><i   class="fa fa-home"></i> <span>Dashboard</span></a></li>
            @if($user->userType->name != 'user')
                @if(in_array("Application_update", $userrightsjson) || in_array("Application_view", $userrightsjson) || in_array("Application_delete", $userrightsjson))
                    <li class="nav-parent"><a href=""><i class="fa fa-users"></i> <span>Member Management</span></a>
                        <ul class="children">
                            <li><a href="{{url('/AllotteeParticular')}}"><i class="fa fa-caret-right"></i>Manage Members</a></li>
                            <li><a href="{{url('/PromotedMember')}}"><i class="fa fa-caret-right"></i>Manage Promoted Members</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array("Users", $userrightsjson))
                    <li class="nav-parent"><a href=""><i class="fa fa-users"></i> <span>User Management</span></a>
                        <ul class="children">
                            <li><a href="{{url('/Users')}}"><i class="fa fa-caret-right"></i>Manage Users</a></li>
                            <li><a href="{{url('/Userroles')}}"><i class="fa fa-caret-right"></i>Manage Roles</a></li>
                            <li><a href="{{url('/Userpermission')}}"><i class="fa fa-caret-right"></i>Permission</a></li>
                            <li><a href="{{url('/Users/ChangePassword',Auth::id())}}"><i class="fa fa-caret-right"></i>Change Password</a></li>
                        </ul>
                    </li>

                    <li class="nav-parent"><a href=""><i class="fa fa-star"></i> <span>Rank Management</span></a>
                        <ul class="children">
                            <li><a href="{{url('/Rank')}}"><i class="fa fa-caret-right"></i>Manage Ranks</a></li>
                        </ul>
                    </li>
                @endif

                <li class="nav-parent"><a href=""><i class="fa fa-lock"></i> <span>Policy Management</span></a>
                    <ul class="children">
                        <li><a href="{{url('/PaymentPolicy')}}"><i class="fa fa-caret-right"></i>Manage Payment Policy</a></li>
                        <li><a href="{{url('/HouseCost')}}"><i class="fa fa-caret-right"></i>Manage House Cost</a></li>
                        <li><a href="{{url('/MemberProfit')}}"><i class="fa fa-caret-right"></i>Manage Profit Rate</a></li>
                    </ul>
                </li>

                <li class="nav-parent"><a href=""><i class="fa fa-building"></i> <span>Construct Management</span></a>
                    <ul class="children">
                        <li><a href="{{url('/Constructor')}}"><i class="fa fa-caret-right"></i>Manage Contractors</a></li>
                        <li><a href="{{url('/Construction')}}"><i class="fa fa-caret-right"></i>Manage Constructions</a></li>
                    </ul>
                </li>

                <li class="nav-parent"><a href=""><i class="fa fa-money"></i> <span>Payment Management</span></a>
                    <ul class="children">
                        <li><a href="{{url('/Payment')}}"><i class="fa fa-caret-right"></i>Manage Payments</a></li>
                        <li><a href="{{url('/CsvData')}}"><i class="fa fa-caret-right"></i>File's Payments</a></li>
                        <li><a href="{{url('/CsvFile')}}"><i class="fa fa-caret-right"></i>Manage Uploaded Files</a></li>
                        <li><a href="{{url('/import')}}"><i class="fa fa-caret-right"></i>Upload Monthly Payment</a></li>
                        <li><a href="{{url('/import')}}"><i class="fa fa-caret-right"></i>Upload Six Month Payment</a></li>
                    </ul>
                </li>

                <li class="nav-parent"><a href="#"><i style="" class="fa fa-ticket"></i> <span>Allotment Management</span></a>
                    <ul class="children">
                        <li><a href="{{url('/AllotteeParticular/assigndata')}}"><i class="fa fa-caret-right"></i>Manage Allotments</a></li>
                        <li><a href="{{url('/GetProfit')}}"><i class="fa fa-caret-right"></i>Manage Member's Profit</a></li>
                        <li><a href="{{url('/AllotedHouse')}}"><i class="fa fa-caret-right"></i>Manage Alloted Houses</a></li>
                        <li><a href="{{url('/Payment')}}"><i class="fa fa-caret-right"></i>Schedule</a></li>
                    </ul>
                </li>

                <li class="nav-parent"><a href="#"><i style="" class="fa fa-tasks"></i> <span>Project Management</span></a>
                    <ul class="children">
                        <li><a href="{{url('/Plot')}}"><i class="fa fa-caret-right"></i>Manage Plots</a></li>
                        <li><a href="{{url('/Propertytype')}}"><i class="fa fa-caret-right"></i>Manage Property Types</a></li>
                        <li><a href="{{url('/Size')}}"><i class="fa fa-caret-right"></i>Manage Sizes</a></li>
                        <li><a href="{{url('/Block')}}"><i class="fa fa-caret-right"></i>Manage Blocks</a></li>
                    </ul>
                </li>

                <li class="nav-parent"><a href="#"><i style="" class="fa fa-file"></i> <span>Report Management</span></a>
                    <ul class="children">
                        <li><a href="{{ url('/member_financial_report') }}"><i class="fa fa-caret-right"></i>Member Financial Report</a></li>
                        <li><a href="{{ url('/project_financial_report') }}"><i class="fa fa-caret-right"></i>Project Financial Report</a></li>
                        <li><a href="{{ url('/eligibility_report') }}"><i class="fa fa-caret-right"></i>Eligibility Report</a></li>
                        <li><a href="{{ url('/profit_statement_report') }}"><i class="fa fa-caret-right"></i>Profit Statement</a></li>
                        <li><a href="{{ url('/member_financial_report') }}"><i class="fa fa-caret-right"></i>Account Statement</a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href="#"><i class="fa fa-comments"></i> <span>User Feedbacks</span></a>
                    <ul class="children">
                        <li><a href="{{url('/Feedback')}}"><i class="fa fa-caret-right"></i>Feedback</a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href="#"><i class="fa fa-envelope"></i><span>News Letters</span></a>
                    <ul class="children">
                        <li><a href="{{url('/Newsletter')}}"><i class="fa fa-caret-right"></i><span>News Letters</span></a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href="#"><i class="fa fa-home"></i><span>Colony Management</span></a>
                    <ul class="children">
                        <li><a href="{{ url('/activemembers') }}"><i class="fa fa-caret-right"></i><span>Manage House</span></a></li>
                        <li><a href="{{ url('#') }}"><i class="fa fa-caret-right"></i><span>Black list</span></a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-image"></i> <span>Gallery Management</span></a>
                    <ul class="children">
                        <li><a href="{{url('/GalleryImage')}}"><i class="fa fa-caret-right"></i>Manage Gallery</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-parent"><a href=""><i class="fa fa-user"></i> <span>Membership</span></a>
                    <ul class="children">
                        @if(empty($member))
                            <li><a href="{{url('/AllotteeParticular/create')}}"><i class="fa fa-caret-right"></i>Get Membership</a></li>  
                        @else
                            <li><a href="{{ route('AllotteeParticular.show', $member->p_no) }}"><i class="fa fa-caret-right"></i>Display Membership Form</a></li>  
                        @endif
                    </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-money"></i> <span>Payment</span></a>
                    <ul class="children">
                        <li><a href="{{url('/Payment')}}"><i class="fa fa-caret-right"></i>Paid Payments</a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-image"></i> <span>Picture Gallery</span></a>
                    <ul class="children">
                        <li><a href="{{url('/GalleryImage')}}"><i class="fa fa-caret-right"></i>Gallery</a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-comment"></i> <span>Feed Back</span></a>
                    <ul class="children">
                        <li><a href="{{url('/Feedback')}}"><i class="fa fa-caret-right"></i>Feedback</a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-envelope"></i> <span>News Letters</span></a>
                    <ul class="children">
                        <li><a href="{{url('/Newsletter')}}"><i class="fa fa-caret-right"></i>News Letters</a></li>
                    </ul>
                </li>
            </ul>
        @endif
    </div>
</div>
