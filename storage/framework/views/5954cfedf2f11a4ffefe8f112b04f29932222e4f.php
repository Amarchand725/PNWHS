<div class="headerbar nav_head">
    <a class="menutoggle"><i class="fa fa-bars"></i></a>
    <?php 
        $user_type = Auth::user()->user_type;
    ?>

    <div class="header-right">
        <ul class="headermenu">
            <?php if($user_type == 4 || $user_type == 1): ?>
                <?php
                    $notification = DB::table('allottee_particulars')->where('seen',0)->where('form_status', 0)->orderBy('id','desc')->limit(5)->get();
                    $count = DB::table('allottee_particulars')->where('seen',0)->where('form_status', 0)->count();
                    $new_users = DB::table('users')->where('is_active', 0)->orderBy('id', 'desc')->get();
                    $user_counts = DB::table('users')->where('is_active', 0)->count();
                ?>
                <li>
                    <div class="btn-group">
                        <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-globe"></i>
                            <span class="badge"><?php echo e($count+$user_counts); ?> </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You Have  <?php echo e($count+$user_counts); ?> Notifications</h5>
                            <ul class="dropdown-list gen-list">
                                <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="new" id='notifications'>
                                        <a href="<?php echo e(url('AllotteeParticular/approveapp')); ?>/<?php echo e($noti->id); ?>">
                                            <span class="desc">
                                                <span class="name"><?php echo e('Active Application of '.' '.$noti->name); ?><span class="badge badge-success">new</span></span>
                                            </span>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $new_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="new" id='notifications'>
                                        <a href="<?php echo e(url('Users/approve')); ?>/<?php echo e($noti->id); ?>">
                                            <span class="desc">
                                                <span class="name"><?php echo e('Active '.$noti->name.' User'); ?><span class="badge badge-success">new</span></span>
                                            </span>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="    width: 150px;">
                        <img src="<?php echo e(url('')); ?>/public/images/photos/loggeduser.png" alt="" />
                       <?php if(!empty(Auth::user()->name)): ?>
                            <?php echo e(Auth::user()->name); ?>

                        <?php else: ?>
                            <?php header("url('/login');");
                           ?>
                        <?php endif; ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li>
                            <a href="<?php echo e(url('/Users/ChangePassword',Auth::id())); ?>"><i class='fa fa-key'></i> Password</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class='fa fa-lock'></i> <?php echo e(__('Logout')); ?>

                                </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>