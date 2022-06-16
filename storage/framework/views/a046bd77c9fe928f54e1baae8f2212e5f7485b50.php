<?php $__env->startSection('content'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('public/css/lightbox.min.css')); ?>">

  <style>
    .photo-gallery {
      color:#313437;
      background-color:#fff;
    }

    .photo-gallery p {
      color:#7d8285;
    }

    .photo-gallery h2 {
      font-weight:bold;
      margin-bottom:40px;
      padding-top:40px;
      color:inherit;
    }

    @media (max-width:767px) {
      .photo-gallery h2 {
        margin-bottom:25px;
        padding-top:25px;
        font-size:24px;
      }
    }

    .photo-gallery .intro {
      font-size:16px;
      max-width:500px;
      margin:0 auto 40px;
    }

    .photo-gallery .intro p {
      margin-bottom:0;
    }

    .photo-gallery .photos {
      padding-bottom:20px;
    }

    .photo-gallery .item {
      padding-bottom:30px;
    }
  </style>
  <?php if(Auth::user()->hasRole->role=='Admin'): ?>
    <div class="contentpanel">
      <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-home'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">No of Built Houses</small>
                    <h1><?php echo e($total_built_houses); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-spinner'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">No of Houses in progress</small>
                    <h1><?php echo e($total_progress_houses); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-dark panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-clock-o '></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Pending Constructions</small>
                    <h1><?php echo e($total_plots-($total_built_houses+$total_progress_houses)); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="<?php echo e(url('')); ?>/public/images/plotlogo.png" alt="" style="width: 50px" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">No of plots</small>
                    <h1><?php echo e($total_plots); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-info panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-users'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Total Users</small>
                    <h1><?php echo e($total_users); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-warning panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-users'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Total In Active Members</small>
                    <h1><?php echo e($total_members-$total_active_members); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-users'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Total Active Members</small>
                    <h1><?php echo e($total_active_members); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-info panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-money'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Membership fees</small>
                    <h1><?php echo e($members_total_amount); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-user'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Constructors</small>
                    <h1><?php echo e($total_contractors); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-home'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Total Allotted Houses</small>
                    <h1><?php echo e($total_alloted_houses); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-info panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-file'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Total Letters</small>
                    <h1><?php echo e($total_letters); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-warning panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-comment'></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Total Feed Backs</small>
                    <h1><?php echo e($total_feedbacks); ?></h1>
                  </div>
                </div><!-- row -->
                <div class="mb15"></div>
              </div><!-- stat -->
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
      </div>
    </div>
  <?php else: ?> 
    <div class="contentpanel">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class='fa fa-user'></i>
                  </div>
                  <div class="col-xs-8">
                    <span style='font-size:20px'>Member Status</span>
                    <?php if($payment_ledger): ?>
                      <span style='font-size:20px'>Active</span>
                    <?php else: ?>
                      <span style='font-size:20px'>In-Active</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="mb15"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel panel-info panel-stat">
            <div class="panel-heading">
              <div class="stat">
                <a href="<?php echo e(url('Payment')); ?>" style='color:white' data-toggle="tooltip" data-placement="top" title="Display payment ledger">
                  <div class="row">
                    <div class="col-xs-4">
                      <img src="<?php echo e(url('')); ?>/public/images/construction.png" alt="" style="width: 60px" />
                    </div>
                    <div class="col-xs-8">
                    <span style='font-size:20px'>Payment Ledger</span><br />
                    <span style='font-size:20px'><?php echo e($members_total_amount); ?></span>
                    </div>
                  </div>
                </a>
                <div class="mb15"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>