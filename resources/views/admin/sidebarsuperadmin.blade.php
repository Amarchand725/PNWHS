<div class="leftpanel">

    <div class="logopanel text-center">
        <a href="{{url('/')}}" style="font-size: 34px; text-decoration: none; color: DimGray;">
            <span style="color: #1caf9a ">[</span><b>Shanghai Commercial City</b><span style="color: #1caf9a ">]</span>
        </a>
    </div>
         

    <div class="leftpanelinner">
        <h5 class="sidebartitle">Navigation</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
        @if(Auth::id() == 1)
            <li class="active"><a href="{{url('/')}}"><i   class="fa fa-home"></i> <span>Dashboard</span></a></li>            
            

            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-users"></i> <span>Users</span></a>
                <ul class="children">
                    <li><a href="{{url('/User')}}"><i class="fa fa-caret-right"></i>Manage Users</a></li>
                    <li><a href="{{url('/User/create')}}"><i class="fa fa-caret-right"></i>Create Users</a></li>                    
                </ul>
            </li>

            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-briefcase"></i> <span>Business</span></a>
                <ul class="children">
                    <li><a href="{{url('/Business')}}"><i class="fa fa-caret-right"></i>Manage Business</a></li>
                    <li><a href="{{url('/Business/create')}}"><i class="fa fa-caret-right"></i>Create Business</a></li>                    
                </ul>
            </li>

            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-codepen"></i> <span>Products</span></a>
                <ul class="children">
                    <li><a href="{{url('/Product')}}"><i class="fa fa-caret-right"></i>Manage Product</a></li>
                    <li><a href="{{url('/Product/create')}}"><i class="fa fa-caret-right"></i>Create Product</a></li>                    
                </ul>
            </li>

            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-bookmark"></i> <span>Orders</span></a>
                <ul class="children">
                    <?php $business = DB::table('business')->get(); ?>
                    @foreach($business as $value)
                        <li><a href="{{url('order') . '/' . $value->id}}"><i class="fa fa-caret-right"></i>{{$value->name}} Order</a></li>
                    @endforeach
                    <li><a href="{{url('/Orders')}}"><i class="fa fa-caret-right"></i>Manage Orders</a></li>                  
                    <li><a href="{{url('/OrderDetails')}}"><i class="fa fa-caret-right"></i>Manage Order Details</a></li>
                </ul>
            </li>

            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-male"></i> <span>Salesman</span></a>
                <ul class="children">
                    <li><a href="{{url('/Salesman')}}"><i class="fa fa-caret-right"></i>Manage Salesman</a></li>
                    <li><a href="{{url('/Salesman/create')}}"><i class="fa fa-caret-right"></i>Create Salesman</a></li>                   
                </ul>
            </li>

            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-shopping-cart"></i> <span>Shops</span></a>
                <ul class="children">
                    <li><a href="{{url('/Shop')}}"><i class="fa fa-caret-right"></i>Manage Shops</a></li>
                    <li><a href="{{url('/Shop/create')}}"><i class="fa fa-caret-right"></i>Create Shop</a></li>                   
                </ul>
            </li>          

            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-cogs"></i> <span>Domain Parameters</span></a>
                <ul class="children">
                    <li><a href="{{url('/AssignUsers')}}"><i class="fa fa-caret-right"></i>Manage Assign Users</a></li>
                    <li><a href="{{url('/UserType')}}"><i class="fa fa-caret-right"></i>Manage User Type</a></li>
                    <li><a href="{{url('/Rights')}}"><i class="fa fa-caret-right"></i>Manage User Rights</a></li>
                    <li><a href="{{url('/Brand')}}"><i class="fa fa-caret-right"></i>Manage Brand</a></li>
                </ul>
            </li>
        @endif
        </ul>



    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->