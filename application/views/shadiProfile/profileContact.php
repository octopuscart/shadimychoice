7<?php
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
<section class="" ng-controller="contactShadiProfileController">

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Member Contact #<?php echo $profile_id; ?> <small></small></h1>
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
                        <a href="<?php echo site_url("ShadiProfile/viewProfile/" . $profile_id) ?>" class="btn btn-warning ">
                            <i class="fa fa-user"></i> Member Profile
                        </a>
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

                    <div class="col-md-12 profilemiddlesection">

                        <div class="panel panel-inverse">

                            <div class="panel-heading">

                                <h2 class="panel-title">Member Contact List</h2>
                            </div>
                            <div class="panel-body"  id="sortable">
                                <table class="table table-profile">

                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th>Relationship</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Contact display setting</th>
                                            <th>Contact Remark</th>

                                            <th>Remove Contact</th>
                                        </tr>

                                        <tr ng-repeat="contact in memberData.contact">
                                            <td>
                                                <span id="idid" data-type="text" data-pk="{{contact.id}}" data-name="name" data-value="{{contact.name}}" data-params ={'tablename':'shadi_profile_contact'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-original-title="Enter Name" data-mode="inline"  class="m-l-5 editable editable-click" tabindex="-1"  > {{contact.name}}</span>

                                            </td>
                                            <td>
                                                <span id="idrelation{{contact.id}}" data-type="select" data-pk="{{contact.id}}" data-name="relation" data-value="{{contact.relation}}" data-params ={'tablename':'shadi_profile_contact'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-original-title="Enter Name" data-mode="inline"  class="m-l-5 editableselectrelation editable-click" tabindex="-1"  > {{contact.relation}}</span>

                                            </td>
                                            <td>
                                                <span id="idname" data-type="tel" data-pk="{{contact.id}}" data-name="contact_no" data-value="{{contact.contact_no}}" data-params ={'tablename':'shadi_profile_contact'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-original-title="Enter Name" data-mode="inline"  class="m-l-5 editable editable-click" tabindex="-1"  > {{contact.contact_no}}</span>

                                            </td>
                                            <td>
                                                <span id="idname" data-type="email" data-pk="{{contact.id}}" data-name="email" data-value="{{contact.email}}" data-params ={'tablename':'shadi_profile_contact'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-original-title="Enter Name" data-mode="inline"  class="m-l-5 editable editable-click" tabindex="-1"  > {{contact.email}}</span>

                                            </td>
                                            <td>
                                                <span id="contactdisplay" data-type="select" data-pk="{{contact.id}}" data-name="contact_display" data-value="{{contact.contact_display}}" data-params ={'tablename':'shadi_profile_contact'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-original-title="Enter Name" data-mode="inline"  class="m-l-5 editableselectdisplay editable-click" tabindex="-1"  > {{contact.contact_display}}</span>

                                            </td>
                                            <td>
                                                <span id="idname" data-type="textarea" data-pk="{{contact.id}}" data-name="contact_display" data-value="{{contact.remark}}" data-params ={'tablename':'shadi_profile_contact'} data-url="<?php echo site_url("LocalApi/updateCurd"); ?>" data-original-title="Enter Name" data-mode="inline"  class="m-l-5 editable editable-click" tabindex="-1"  > {{contact.remark}}</span>

                                            </td>
                                            <td>
                                                <form action="#" method="post" >
                                                    <input type="hidden" name="contact_id" value="{{contact.id}}">
                                                    <button class="btn btn-danger" type="submit" name="deletecontact">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- begin profile-info -->
                        <form action="#" method="post"  ng-if=" memberData.contact.length < 2">
                            <div class="panel panel-inverse">

                                <div class="panel-heading">

                                    <h2 class="panel-title">Member Contact List</h2>
                                </div>
                                <div class="panel-body"  id="sortable">
                                    <table class="table table-profile">

                                        <tbody>


                                            <tr >
                                                <td class="field" style="width: 250px;">Name of contact person</td>
                                                <td>

                                                    <input type="text" name="name" class="form-control" placeholder="Name" >     
                                                </td>
                                            </tr>
                                            <tr >
                                                <td class="field">Relationship with the member</td>
                                                <td>
                                                    <select name="relation" class="form-control">
                                                        <option value="Self" label="Self" selected="selected">Self</option>
                                                        <option value="Parent" label="Parent">Parent</option>
                                                        <option value="Guardian" label="Guardian">Guardian</option>
                                                        <option value="Sibling" label="Sibling">Sibling</option>
                                                        <option value="Friend" label="Friend">Friend</option>
                                                        <option value="Relative" label="Relative">Relative</option>
                                                        <option value="Other" label="Other">Other</option>
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr >
                                                <td class="field">Contact No.</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="text" name="contact_no" class="form-control" placeholder="+91 XXXXX XXXXX" >  
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="contact_no_status" value="Not Verified" checked="">
                                                                Not Verified
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="contact_no_status" value="Verified">
                                                                Verified
                                                            </label>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Email</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="email" name="email" class="form-control" placeholder="email@domain.com" >  
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="email_status" value="Not Verified" checked="">
                                                                Not Verified
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="email_status" value="Verified">
                                                                Verified
                                                            </label>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field" style="width: 250px;">Contact display settingn</td>
                                                <td>

                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="contact_display" value="Show to All" checked=true>
                                                            Visible to all Premium Members
                                                        </label>
                                                    </div> 
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="contact_display" value="When I Contact" >
                                                            Visible to Premium Members you wish to connect to
                                                        </label>
                                                    </div> 
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="contact_display" value="Hide My Contact" >
                                                            Hide my Phone number
                                                        </label>
                                                    </div> 
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="contact_display" value="Show To Free And Premium" >
                                                            Visible to all your Matches (Expires with Membership)
                                                        </label>
                                                    </div> 
                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field" style="width: 250px;">Remark (Contact Timing)</td>
                                                <td>

                                                    <input type="text" name="remark" class="form-control" placeholder="Remark" >     
                                                </td>
                                            </tr>

                                            <tr >
                                                <td colspan="2">
                                                    <button type="submit" name="addcontact" class="btn btn-inverse btn-lg" value="addcontact"><i class="fa fa-save"></i> Add Contact</button>

                                                    <a class="btn btn-inverse btn-lg pull-right" href="<?php echo site_url("ShadiProfile/viewProfile/" . $profile_id); ?>" value="updateProfile"><i class="fa fa-arrow-left"></i> Back</a>

                                                </td>
                                            </tr>




                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </form>
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
