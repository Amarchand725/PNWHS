@extends('admin.master')
@section('content')
    <div class="contentpanel">
        <div class="panel panel-default">
            <div class="panel-body editable-list-group">
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Title</b></div>
                    <div class="col-sm-9">{{!empty($model->title) ? $model->title : "-"}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Subject</b></div>
                    <div class="col-sm-9">{{!empty($model->subject) ? $model->subject : "-"}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Expiry date</b></div>
                    <?php $expiryddate =  date('d-M-Y',strtotime($model->expiry_date)) ?>
                    <td></td>
                    <div class="col-sm-9">{{!empty($model->expiry_date) ? $expiryddate : "-"}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Expiry date</b></div>
                    <div class="col-sm-9">
                        <?php
                        $checkextension =  explode('.',$model->newsletterfile);
                        if(!empty($model->newsletterfile)){
                            if($checkextension[1] == 'png' || $checkextension[1] == 'PNG' || $checkextension[1] == 'jpg' || $checkextension[1] == 'JPG' || $checkextension[1] == 'jpeg' || $checkextension[1] == 'JPEG'){
                        ?>
                                <img class='img-responsive img-thumbnail' style='width:100%;height:170px;' src='<?= url('public/attachments/'.$model->newsletterfile); ?>' />
                        <?php
                            }else{
                        ?>
                            <a href="<?= url('attachments/'.$model->newsletterfile); ?>" download="download">Download</a>
                        <?php

                            }
                        }else{
                            echo '-';
                        }
                        ?>
                    </div>
                </div>
            </div><!-- panel-body -->
        </div>
    </div>
@endsection