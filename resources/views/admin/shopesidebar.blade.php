<div class="leftpanel">

    <div class="logopanel text-center">
        <a href="{{url('/')}}" style="font-size: 34px; text-decoration: none; color: DimGray;">
            <span style="color: #1caf9a ">[</span><b>BOS</b><span style="color: #1caf9a ">]</span>
        </a>
    </div>
         

    <div class="leftpanelinner">
        <h5 class="sidebartitle">Navigation</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
        
           <!--  <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-users"></i> <span>Users</span></a>
                <ul class="children">
                    <li><a href="{{url('/User')}}"><i class="fa fa-caret-right"></i>Manage Users</a></li>
                    <li><a href="{{url('/User/create')}}"><i class="fa fa-caret-right"></i>Create Users</a></li>                    
                </ul>
            </li> -->
              <li class="active"><a href="{{url('/')}}"><i   class="fa fa-home"></i> <span>Dashboard</span></a></li>   
            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-bookmark"></i> <span>Orders</span></a>
                <ul class="children">
                    <?php $business = DB::table('business')->get(); ?>
                    @foreach($business as $value)
                        <li><a href="{{url('order') . '/' . $value->id}}"><i class="fa fa-caret-right"></i>{{$value->name}} Order</a></li>
                    @endforeach
                    <li><a href="{{url('/Orders')}}"><i class="fa fa-caret-right"></i>Manage Orders</a></li>                  
                  <!--   <li><a href="{{url('/OrderDetails')}}"><i class="fa fa-caret-right"></i>Manage Order Details</a></li> -->
                </ul>
            </li>

            <li class="nav-parent"><a href=""><i style="color: orange" class="fa fa-shopping-cart"></i> <span>Shops</span></a>
                <ul class="children">
                    <li><a href="{{url('/Shop')}}"><i class="fa fa-caret-right"></i>Manage Shops</a></li>
                    
                </ul>
            </li>

        </ul>

    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->