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
<section class="" ng-controller="viewShadiProfileController">

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Member Profile #<?php echo $profile_id; ?> <small></small></h1>
        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="">
            <!-- begin profile-section -->
            <div class="profile-section">

                <div class="row">
                    <div class="col-md-3">
                        <?php
                        $this->load->view('shadiProfile/sidebarprofile');
                        ?>
                    </div>
                    <div class="col-md-6 profilemiddlesection">
                        <!-- begin profile-info -->
                        <div class="profile-info" style="   ">
                            <!-- begin table -->
                            <div class="table-responsive">
                                <div class="panel panel-inverse">

                                    <div class="panel-heading">
                                        <div class="btn-group pull-right">

                                            <a class="btn btn-danger btn-xs" href="<?php echo site_url("ShadiProfile/editMemberProfile/" . $profile_id) ?>">
                                                Edit Profile
                                            </a>
                                        </div>
                                        <h2 class="panel-title">Basic Information</h2>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-profile">

                                            <tbody>


                                                <tr >
                                                    <td class="field" style="width: 200px;">Name</td>
                                                    <td>
                                                        {{memberData.profile.name}}     
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="field">Gender</td>
                                                    <td>
                                                        {{memberData.profile.gender}}
                                                    </td>
                                                </tr>


                                                <tr >
                                                    <td class="field">Marital status</td>
                                                    <td>
                                                        {{marital_status.status}}

                                                    </td>
                                                </tr>

                                                <tr ng-if="marital_status.status != 'Never Married'">
                                                    <td class="field">Have children</td>
                                                    <td>
                                                        {{marital_status.marital_status_children}}
                                                    </td>
                                                </tr>

                                                <tr ng-if="marital_status.status != 'Never Married'">
                                                    <td class="field">No. of children</td>
                                                    <td>
                                                        <span ng-if="marital_status.marital_status_children != 'No'">{{marital_status.marital_children_count}}</span>
                                                        <span ng-if="marital_status.marital_status_children == 'No'">{{marital_status.marital_children_count}}</span>


                                                    </td>
                                                </tr>




                                                <tr >
                                                    <td class="field">Height</td>
                                                    <td>{{memberData.profile.height}} </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Weight</td>
                                                    <td>
                                                        {{memberData.profile.weight}}  KG     
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Any Disability?</td>
                                                    <td>
                                                        {{memberData.profile.disablity ?memberData.profile.disablity:'No'}}      
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Blood Group</td>
                                                    <td>
                                                        {{memberData.profile.blood_group}}                                             
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel-heading">
                                        <h2 class="panel-title">Religious Background
                                        </h2>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-profile">
                                            <tbody>
                                                <tr >
                                                    <td class="field" style="width: 200px;">Religion</td>
                                                    <td>
                                                        {{memberData.profile.religion_title}}
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="field" style="width: 200px;">Community</td>
                                                    <td>
                                                        {{memberData.profile.community_title}}
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Other Religious</td>
                                                    <td>
                                                        {{memberData.profile.other_religious_info}}       
                                                    </td>
                                                </tr>



                                                <tr >
                                                    <td class="field">Mother Tongue</td>
                                                    <td>
                                                        {{memberData.profile.mother_tongue_title}}
                                                    </td>
                                                </tr>




                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel-heading">
                                        <h2 class="panel-title">Horoscope Information
                                        </h2>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-profile">
                                            <tbody>
                                                <tr >
                                                    <td class="field" style="width: 200px;">Date Of Birth</td>
                                                    <td>
                                                        {{memberData.profile.date_of_birth}}     
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="field">Time Of Birth</td>
                                                    <td>
                                                        {{memberData.profile.time_of_birth}}     
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="field" >Birth  Location </td>
                                                    <td>
                                                        {{memberData.profile.birth_location_city_title}}, {{memberData.profile.birth_location_state_title}}
                                                    </td>
                                                </tr>





                                                <tr ng-if="memberData.profile.religion == 1">
                                                    <td class="field">Mangalik Status</td>
                                                    <td>
                                                        {{memberData.profile.manglik_status}}
                                                    </td>
                                                </tr>
                                                <tr ng-if="memberData.profile.religion != 1">
                                                    <td colspan="2">
                                                        {{memberData.profile.manglik_status}}   
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel-heading">
                                        <h2 class="panel-title">Education & Career

                                        </h2>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-profile">
                                            <tbody>
                                                <tr >
                                                    <td class="field" style="width: 200px;">Highest Qualification</td>
                                                    <td>
                                                        {{memberData.profile.high_qualification_title}} ({{memberData.profile.high_qualification_category_title}})
                                                    </td>
                                                </tr>


                                                <tr >
                                                    <td class="field">Higher Edu. College/School</td>
                                                    <td>
                                                        {{memberData.profile.high_qualification_college}}      
                                                    </td>
                                                </tr>

                                                <tr ng-if="memberData.profile.qualification_details">
                                                    <td class="field">Qualification Details</td>
                                                    <td>
                                                        {{memberData.profile.qualification_details}}       
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Working With </td>
                                                    <td>
                                                        {{memberData.profile.career_sector_title}}
                                                    </td>
                                                </tr>


                                            <tbody ng-if="(memberData.profile.career_sector != 4) && (memberData.profile.career_sector != 5)">
                                                <tr >
                                                    <td class="field">Profession </td>
                                                    <td>
                                                        {{memberData.profile.career_profession_title}} ({{memberData.profile.career_profession_category_title}}  ) 

                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="field">Working Position</td>
                                                    <td>
                                                        {{memberData.profile.career_position}}       
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Employer Name</td>
                                                    <td>
                                                        {{memberData.profile.career_employer}}     
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Annual Income </td>
                                                    <td>
                                                        {{memberData.profile.career_income_title}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody ng-if="(memberData.profile.career_sector == 4) && (memberData.profile.career_sector != 5)">
                                                <tr >
                                                    <td class="field">Profession </td>
                                                    <td>
                                                        {{memberData.profile.career_profession_title}} ({{memberData.profile.career_profession_category_title}}  ) 
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="field">Business Type</td>
                                                    <td>
                                                        {{memberData.profile.career_position}}      
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Business Name</td>
                                                    <td>
                                                        {{memberData.profile.career_employer}}      
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field">Annual Income </td>
                                                    <td>
                                                        {{memberData.profile.career_income_title}}
                                                    </td>
                                                </tr>
                                            </tbody>



                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel-heading">
                                        <h2 class="panel-title">Family

                                        </h2>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-profile">
                                            <tbody>
                                                <tr >
                                                    <td class="field" style="width: 200px;">Father's Name</td>
                                                    <td>
                                                        {{memberData.profile.father_name}}
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="field" style="width: 200px;">Father's Status</td>
                                                    <td>
                                                        {{memberData.profile.father_status}}
                                                    </td>
                                                </tr>


                                                <tr >
                                                    <td class="field">Father's Work Information</td>
                                                    <td>
                                                        {{memberData.profile.father_work}}    
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="field" style="width: 200px;">Mothers's Name</td>
                                                    <td>
                                                        {{memberData.profile.mother_name}}
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field" style="width: 200px;">Mothers's Status</td>
                                                    <td>
                                                        {{memberData.profile.mother_status}}
                                                    </td>
                                                </tr>


                                                <tr >
                                                    <td class="field">Mothers's Work Information</td>
                                                    <td>
                                                        {{memberData.profile.mother_work}} 
                                                    </td>
                                                </tr>



                                                <tr >
                                                    <td class="field" >Family Location </td>
                                                    <td>
                                                        {{memberData.profile.family_location_city_title}}, {{memberData.profile.family_location_state_title}}

                                                    </td>
                                                </tr>



                                                <tr >
                                                    <td class="field" rowspan="2">No. of Siblings</td>
                                                    <td class="row">
                                                        <div class="col-md-6">
                                                            <p class="font-10" > Brothers Unmarried</p>
                                                            {{memberData.profile.brother_unmarried}}    
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="font-10" > Brothers Married</p>
                                                            {{memberData.profile.brother_married}}    
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="row">
                                                        <div class="col-md-6">
                                                            <p class="font-10" > Sisters Unmarried</p>
                                                            {{memberData.profile.sister_unmarried}}      
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="font-10" > Sisters Married</p>
                                                            {{memberData.profile.sister_married}}    
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field" style="width: 200px;">Family Type</td>
                                                    <td>
                                                        {{memberData.profile.family_type}}
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td class="field" style="width: 200px;">Family values
                                                    </td>
                                                    <td>
                                                        {{memberData.profile.family_value}}
                                                    </td>
                                                </tr>


                                                <tr >
                                                    <td class="field" style="width: 200px;">Family Affluence</td>
                                                    </td>
                                                    <td>
                                                        {{memberData.profile.family_affluence}}
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                            </div>
                            <!-- end table -->

                        </div>
                        <!-- end profile-info -->
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
