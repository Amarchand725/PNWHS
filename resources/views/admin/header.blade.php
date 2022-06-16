<div class="headerbar nav_head">
    <a class="menutoggle"><i class="fa fa-bars"></i></a>
    <?php 
        $user_type = Auth::user()->user_type;
    ?>

    <div class="header-right">
        <ul class="headermenu">
            @if ($user_type == 4 || $user_type == 1)
                @php
                    $notification = DB::table('allottee_particulars')->where('seen',0)->where('form_status', 0)->orderBy('id','desc')->limit(5)->get();
                    $count = DB::table('allottee_particulars')->where('seen',0)->where('form_status', 0)->count();
                    $new_users = DB::table('users')->where('is_active', 0)->orderBy('id', 'desc')->get();
                    $user_counts = DB::table('users')->where('is_active', 0)->count();
                @endphp
                <li>
                    <div class="btn-group">
                        <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-globe"></i>
                            <span class="badge">{{ $count+$user_counts }} </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You Have  {{ $count+$user_counts }} Notifications</h5>
                            <ul class="dropdown-list gen-list">
                                @foreach($notification as $noti)
                                    <li class="new" id='notifications'>
                                        <a href="{{url('AllotteeParticular/approveapp')}}/{{ $noti->id }}">
                                            <span class="desc">
                                                <span class="name">{{ 'Active Application of '.' '.$noti->name }}<span class="badge badge-success">new</span></span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                                @foreach($new_users as $noti)
                                    <li class="new" id='notifications'>
                                        <a href="{{url('Users/approve')}}/{{ $noti->id }}">
                                            <span class="desc">
                                                <span class="name">{{ 'Active '.$noti->name.' User' }}<span class="badge badge-success">new</span></span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="    width: 150px;">
                        <img src="{{url('')}}/public/images/photos/loggeduser.png" alt="" />
                       @if(!empty(Auth::user()->name))
                            {{ Auth::user()->name }}
                        @else
                            <?php header("url('/login');");
                           ?>
                        @endif
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li>
                            <a href="{{url('/Users/ChangePassword',Auth::id())}}"><i class='fa fa-key'></i> Password</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class='fa fa-lock'></i> {{ __('Logout') }}
                                </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>