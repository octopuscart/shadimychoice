<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>    


<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet"  />

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<style>
    .appointmentheader div{
        font-size: 20px;
    }
    .appointmentfooter{
        border-bottom: 2px solid #000;
    }
    .list-group-item {
        position: relative;
        display: block;
        padding: 5px 3px;
        margin-bottom: -1px;
    }
    .profilemiddlesection table td, .profilemiddlesection table th{
        border-bottom: 1px solid #d9e0e7!important;
        padding:4px 0px;

    } 
</style>

<!-- Main content -->
<section class="" ng-controller="photosShadiProfileController">

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Member Photos #<?php echo $profile_id; ?> <small></small></h1>
        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="">
            <ul class="media-list">
                <li class="media media-sm">
                    <a class="media-left" href="javascript:;">
                        <img src="{{memberData.profile.profile_photo}}" alt="" class="media-object rounded-corner" style="height: 64px;">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{memberData.profile.name}}</h4>
                        <p>
                            Father:{{memberData.profile.father_name}}
                        </p>
                        <div class="media media-sm">
                            <a class="media-left" href="javascript:;">
                                <img src="assets/img/user-6.jpg" alt="" class="media-object rounded-corner">
                            </a>

                        </div>

                    </div>
                </li>
             
            </ul>
            <!-- begin profile-section -->
            <div class="profile-section">

                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-info" style="background: #fff;text-align: center;padding-top: 20px   ">
                            <img src="<?php echo base_url(); ?>assets/emoji/user.png" id="previewImage" class="thumbnail" style="height: 200px;    display: inline-block;" />
                            <form action="#" method="post" enctype="multipart/form-data">
                                <div class="btn-group" role="group" aria-label="..." style="    width: 100%;">
                                    <span class="btn btn-success col fileinput-button" style="width: 50%">
                                        <i class="fa fa-plus"></i>
                                        <span>Add files...</span>
                                        <input type="file" name="picture" required="" onchange="loadFile(event)">
                                    </span>
                                    <button type="submit" name="submit" class="btn btn-warning" style="width: 50%"><i class="fa fa-upload"></i> Upload Now</button>

                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-6 profilemiddlesection">
                        <!-- begin profile-info -->
                        <form action="#" method="post" >
                            <div class="panel panel-inverse">

                                <div class="panel-heading">
                                    <div class="btn-group pull-right">

                                        <button class="btn btn-danger btn-xs" type="submit" name="reindex" value="submitindex">
                                            Reset Index
                                        </button>
                                    </div>
                                    <h2 class="panel-title">Member Photos</h2>
                                </div>
                                <div class="panel-body"  id="sortable">
                                    <div class="col-md-6" ng-repeat="photo in memberData.photos">
                                        <div class="thumbnail">
                                            <img src="<?php echo base_url(); ?>assets/profile_image/default.png" class=" profileimageblock" style="background: url(<?php echo base_url(); ?>assets/profile_image/{{photo.image}});    width: 100%;"/>

                                            <div class="caption">
                                                <p>Index:<input type="number" name="image_index[]" class="imageindex form-control" readonly="" value="{{photo.display_index}}"></p>
                                                <input type="hidden" name="image_id[]" value="{{photo.id}}" />
                                                <button  type="button" ng-click="viewPhoto(photo)">View Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="col-md-3">
                        <?php
                        $this->load->view('shadiProfile/sidebar');
                        ?>
                    </div>

                </div>



            </div>
            <!-- end profile-section -->
            <!-- begin profile-section -->
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="imagemodel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <form action="#" method="post" >
                        <input type="hidden" name="photo_id" value="{{memberData.selected.id}}">
                        <button type="submit" class="btn btn-success" name="profilePhoto">Set As Profile Photo</button>
                        <button type="submit" class="btn btn-danger" name="deletePhoto">Delete Photo</button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                    </form>
                </div>
                <div class="modal-body">
                    <div class="thumbnail">
                        <img src="<?php echo base_url(); ?>assets/profile_image/{{memberData.selected.image}}"/>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</section>


<script src="<?php echo base_url(); ?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<!--datepicker-->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!--end of datepicker-->
<script>
                            var memberprofile = "<?php echo $profile_id; ?>";</script>
<script src="<?php echo base_url(); ?>assets/angular/shadiController.js"></script>
<?php
$this->load->view('layout/footer');
?> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
