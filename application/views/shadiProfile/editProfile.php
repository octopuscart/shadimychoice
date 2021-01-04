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
        color:black;
    }
    .list-group-item.active a {
        position: relative;
        display: block;
        padding: 5px 3px;
        margin-bottom: -1px;
        text-decoration: none;
        color:white;
    }
    .list-group-item.active {
        position: relative;
        display: block;
        padding: 5px 3px;
        margin-bottom: -1px;
        color:white;
        background: #242a30;
        border-color: #242a30;
    }
</style>

<!-- Main content -->
<section class="" ng-controller="editShadiProfileController">

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Update Member Profile #<?php echo $profile_id; ?><small></small></h1>
        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="">
            <!-- begin profile-section -->
            <div class="profile-section">

                <div class="row">
                    <div class="col-md-12">
                        <!-- begin profile-info -->
                        <div class="profile-info" style="    font-size: 14px;">

                            <div class="col-md-8 table-responsive">
                                <form action="#" method="post"  enctype="multipart/form-data">


                                    <div class="tab-content" style="padding: 0px">
                                        <div class="tab-pane fade active in" id="basicinformation">
                                            <div class="panel panel-inverse">
                                                <div class="panel-heading">
                                                    <h2 class="panel-title">Basic Information
                                                    </h2>
                                                </div>
                                                <div class="panel-body">
                                                    <table class="table table-profile">
                                                        <tbody>
                                                            <tr >
                                                                <td class="field" >Name</td>
                                                                <td>
                                                                    <input type="text" name="name" class="form-control" placeholder="Profile Name" ng-model="memberData.profile.name">     
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field">Gender</td>
                                                                <td>
                                                                    <select name="gender" class="form-control" ng-model="memberData.profile.gender">
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </td>
                                                            </tr>


                                                            <tr >
                                                                <td class="field">Marital status</td>
                                                                <td>
                                                                    <select name="marital_status" class="form-control" ng-model="marital_status.status">
                                                                        <option value="Never Married" label="Never Married">Never Married</option>
                                                                        <option value="Divorced" label="Divorced">Divorced</option>
                                                                        <option value="Awaiting Divorce" label="Awaiting Divorce">Awaiting Divorce</option>
                                                                    </select>                                                </td>
                                                            </tr>

                                                            <tr ng-if="marital_status.status != 'Never Married'">
                                                                <td class="field">Have children</td>
                                                                <td>
                                                                    <select name="marital_status_children" class="form-control" ng-model="marital_status.marital_status_children" >
                                                                        <option value="No">No</option>
                                                                        <option value="Yes, Living together">Yes, Living together</option>
                                                                        <option value="Yes, Not Living together">Yes, Not Living together</option>

                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr ng-if="marital_status.status != 'Never Married'">
                                                                <td class="field">No. of children</td>
                                                                <td>
                                                                    <select name="marital_children_count" ng-model="marital_status.marital_children_count" class="form-control" ng-if="marital_status.marital_status_children != 'No'">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="More then 3+">More then 3</option>
                                                                    </select>
                                                                    <select name="marital_children_count" ng-model="marital_status.marital_children_count" class="form-control" ng-if="marital_status.marital_status_children == 'No'">
                                                                        <option value="No">No</option>


                                                                    </select>
                                                                </td>
                                                            </tr>


                                                            <tr ng-if="marital_status.status == 'Never Married'">
                                                                <td colspan="2">
                                                                    <input name="marital_status_children" type="hidden" value="">
                                                                    <input name="marital_children_count" type="hidden" value="">
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Height</td>
                                                                <td>
                                                                    <select name="height" class="form-control" ng-model="memberData.profile.height">
                                                                        <option value="" label="Select">Select</option>
                                                                        <option value="4ft 5in - 134cm">4ft 5in - 134cm</option>
                                                                        <option value="4ft 6in - 137cm">4ft 6in - 137cm</option>
                                                                        <option value="4ft 7in - 139cm">4ft 7in - 139cm</option>
                                                                        <option value="4ft 8in - 142cm">4ft 8in - 142cm</option>
                                                                        <option value="4ft 9in - 144cm">4ft 9in - 144cm</option>
                                                                        <option value="4ft 10in - 147cm">4ft 10in - 147cm</option>
                                                                        <option value="4ft 11in - 149cm">4ft 11in - 149cm</option>
                                                                        <option value="5ft - 152cm">5ft - 152cm</option>
                                                                        <option value="5ft 1in - 154cm">5ft 1in - 154cm</option>
                                                                        <option value="5ft 2in - 157cm">5ft 2in - 157cm</option>
                                                                        <option value="5ft 3in - 160cm">5ft 3in - 160cm</option>
                                                                        <option value="5ft 4in - 162cm" selected="selected">5ft 4in - 162cm</option>
                                                                        <option value="5ft 5in - 165cm">5ft 5in - 165cm</option>
                                                                        <option value="5ft 6in - 167cm">5ft 6in - 167cm</option>
                                                                        <option value="5ft 7in - 170cm">5ft 7in - 170cm</option>
                                                                        <option value="5ft 8in - 172cm">5ft 8in - 172cm</option>
                                                                        <option value="5ft 9in - 175cm">5ft 9in - 175cm</option>
                                                                        <option value="5ft 10in - 177cm">5ft 10in - 177cm</option>
                                                                        <option value="5ft 11in - 180cm">5ft 11in - 180cm</option>
                                                                        <option value="6ft - 182cm">6ft - 182cm</option>
                                                                        <option value="6ft 1in - 185cm">6ft 1in - 185cm</option>
                                                                        <option value="6ft 2in - 187cm">6ft 2in - 187cm</option>
                                                                        <option value="6ft 3in - 190cm">6ft 3in - 190cm</option>
                                                                        <option value="6ft 4in - 193cm">6ft 4in - 193cm</option>
                                                                        <option value="6ft 5in - 195cm">6ft 5in - 195cm</option>
                                                                        <option value="6ft 6in - 198cm">6ft 6in - 198cm</option>
                                                                        <option value="6ft 7in - 200cm">6ft 7in - 200cm</option>
                                                                        <option value="ft 8in - 203cm">6ft 8in - 203cm</option>
                                                                        <option value="6ft 9in - 205cm">6ft 9in - 205cm</option>
                                                                        <option value="6ft 10in - 208cm">6ft 10in - 208cm</option>
                                                                        <option value="6ft 11in - 210cm">6ft 11in - 210cm</option>
                                                                        <option value="7ft - 213cm">7ft - 213cm</option>
                                                                    </select>                                                
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Weight</td>
                                                                <td>
                                                                    <input type="text" name="weight" ng-model="memberData.profile.weight" class="form-control littletextbox" placeholder="Weight" style="">  KG     
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Any Disability?</td>
                                                                <td>
                                                                    <input type="text" name="disablity" class="form-control" ng-model="memberData.profile.disablity" placeholder="Disability" >       
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Blood Group</td>
                                                                <td>
                                                                    <select class="form-control" name="blood_group" ng-model="memberData.profile.blood_group">
                                                                        <option value="" label="Select" selected="selected">Select</option>
                                                                        <option value="Don't Know" label="Don't Know">Don't Know</option>
                                                                        <option value="A+" label="A+">A+</option>
                                                                        <option value="A-" label="A-">A-</option>
                                                                        <option value="B+" label="B+">B+</option>
                                                                        <option value="B-" label="B-">B-</option>
                                                                        <option value="AB+" label="AB+">AB+</option>
                                                                        <option value="AB-" label="AB-">AB-</option>
                                                                        <option value="O+" label="O+">O+</option>
                                                                        <option value="O-" label="O-">O-</option>
                                                                    </select>                                                 </td>
                                                            </tr>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="religious">
                                            <!--religous profile-->
                                            <div class="panel panel-inverse">
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
                                                                    <select class="form-control" name="religion" ng-model="memberData.profile.religion" ng-change="getSubCommunity()">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($community_category as $key => $value) {
                                                                            ?>
                                                                            <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field" style="width: 200px;">Community</td>
                                                                <td>
                                                                    <select name="community" class="form-control" ng-model="religious.community"  >
                                                                        <option value="">Select</option>
                                                                        <option value="{{cmt.id}}" label="{{cmt.title}}" ng-repeat="cmt in religious.sub_community_list">{{cmt.title}}</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field">Other Religious</td>
                                                                <td>
                                                                    <input type="text" name="other_religious_info" class="form-control" placeholder="Other Religious" ng-model="memberData.profile.other_religious_info">       
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field">Mother Tongue</td>
                                                                <td>
                                                                    <select class="form-control" name="mother_tongue" ng-model="memberData.profile.mother_tongue" >
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_mother_tongue as $key => $value) {
                                                                            ?>
                                                                            <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="horoscope">
                                            <!--HOROSCOPE profile-->
                                            <div class="panel panel-inverse">
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
                                                                    <input type="date" name="date_of_birth" max="<?php echo date('Y-m-d', strtotime('-18 year')); ?>" value="<?php echo date('Y-m-d', strtotime('-18 year')); ?>" class="form-control" placeholder="Date Of Birth" ng-model="horoscope.date_of_birth">     
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field">Time Of Birth</td>
                                                                <td>
                                                                    <input type="text" name="time_of_birth"  class="form-control" placeholder="Date Of Birth" ng-model="memberData.profile.time_of_birth">     
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field" rowspan="2">Birth  Location </td>
                                                                <td>
                                                                    <select class="form-control" name="birth_location_state" ng-model="memberData.profile.birth_location_state" ng-change="getStateCity()">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_state as $key => $value) {
                                                                            ?>
                                                                            <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td>
                                                                    <select class="form-control" name="birth_location_city" ng-model="locationdata.city" >
                                                                        <option value="">Select</option>
                                                                        <option value="{{cmt.id}}" label="{{cmt.title}}" ng-repeat="cmt in locationdata.city_list">{{cmt.title}}</option>
                                                                    </select>
                                                                </td>
                                                            </tr>



                                                            <tr ng-if="memberData.profile.religion == 1">
                                                                <td class="field">Mangalik Status</td>
                                                                <td>
                                                                    <select class="form-control" name="manglik_status" ng-model="memberData.profile.manglik_status">
                                                                        <option value="" label="Select" selected="selected">Select</option>
                                                                        <option value="No" label="No">No</option>
                                                                        <option value="Don't Know" label="Don't Know">Don't Know</option>
                                                                        <option value="Manglik" label="Manglik">Manglik</option>
                                                                        <option value="Anshik Maglik" label="Anshik Maglik">Anshik Maglik</option>

                                                                    </select>   
                                                                </td>
                                                            </tr>
                                                            <tr ng-if="memberData.profile.religion != 1">
                                                                <td colspan="2">
                                                                    <input type="hidden" name="manglik_status" value="" ng-model="memberData.profile.manglik_status">
                                                                </td>

                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="education">
                                            <!--EducationCarrier profile-->
                                            <div class="panel panel-inverse">
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
                                                                    <select class="form-control" name="high_qualification" ng-model="memberData.profile.high_qualification" >
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_qualification_dict as $qualificationkey => $qualificationvalue) {
                                                                            ?>
                                                                            <optgroup id="<?php echo $qualificationkey; ?>" label="<?php echo $qualificationkey; ?>"><?php echo $qualificationkey; ?></optgroup>
                                                                            <?php
                                                                            foreach ($set_qualification_dict[$qualificationkey] as $key => $value) {
                                                                                ?>
                                                                                <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>


                                                            <tr >
                                                                <td class="field">Higher Edu. College/School</td>
                                                                <td>
                                                                    <input type="text" name="high_qualification_college" class="form-control" placeholder="Higher Edu. College/School" ng-model="memberData.profile.high_qualification_college">       
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Qualification Details</td>
                                                                <td>
                                                                    <input type="text" name="qualification_details" class="form-control" placeholder="Qualification Details" ng-model="memberData.profile.qualification_details">       
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Working With </td>
                                                                <td>
                                                                    <select class="form-control" name="career_sector" ng-model="educareer.career_sector" >
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_profession_sector as $key => $value) {
                                                                            ?>
                                                                            <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </td>
                                                            </tr>


                                                        <tbody ng-if="(educareer.career_sector != 4) && (educareer.career_sector != 5)">
                                                            <tr >
                                                                <td class="field">Profession </td>
                                                                <td>
                                                                    <select class="form-control" name="career_profession" ng-model="memberData.profile.career_profession">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_profession_dict as $professionkey => $professionvalue) {
                                                                            ?>
                                                                            <optgroup id="<?php echo $professionkey; ?>" label="<?php echo $professionkey; ?>"><?php echo $professionkey; ?></optgroup>
                                                                            <?php
                                                                            foreach ($set_profession_dict[$professionkey] as $key => $value) {
                                                                                ?>
                                                                                <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field">Working Position</td>
                                                                <td>
                                                                    <input type="text" name="career_position" class="form-control" placeholder="Working Position" ng-model="memberData.profile.career_position">       
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Employer Name</td>
                                                                <td>
                                                                    <input type="text" name="career_employer" class="form-control" placeholder="Employer Name" ng-model="memberData.profile.career_employer">       
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Annual Income </td>
                                                                <td>
                                                                    <select class="form-control" name="career_income" ng-model="memberData.profile.career_income" >
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_annual_income as $key => $value) {
                                                                            ?>
                                                                            <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody ng-if="(educareer.career_sector == 4) && (educareer.career_sector != 5)">
                                                            <tr >
                                                                <td class="field">Profession </td>
                                                                <td>
                                                                    <select class="form-control" name="career_profession" ng-model="memberData.profile.career_profession">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_profession_dict as $professionkey => $professionvalue) {
                                                                            ?>
                                                                            <optgroup id="<?php echo $professionkey; ?>" label="<?php echo $professionkey; ?>"><?php echo $professionkey; ?></optgroup>
                                                                            <?php
                                                                            foreach ($set_profession_dict[$professionkey] as $key => $value) {
                                                                                ?>
                                                                                <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field">Business Type</td>
                                                                <td>
                                                                    <input type="text" name="career_position" class="form-control" placeholder="Working Position" ng-model="memberData.profile.career_position">       
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Business Name</td>
                                                                <td>
                                                                    <input type="text" name="career_employer" class="form-control" placeholder="Employer Name" ng-model="memberData.profile.career_employer">       
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field">Annual Income </td>
                                                                <td>
                                                                    <select class="form-control" name="career_income"  ng-model="memberData.profile.career_income">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_annual_income as $key => $value) {
                                                                            ?>
                                                                            <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="familydetails">
                                            <!--Family profile-->
                                            <div class="panel panel-inverse">
                                                <div class="panel-heading">
                                                    <h2 class="panel-title">Family

                                                    </h2>
                                                </div>
                                                <div class="panel-body">
                                                    <table class="table table-profile">
                                                        <tbody>
                                                            <tr >
                                                                <td class="field">Father's Name</td>
                                                                <td>
                                                                    <input type="text" name="father_name" class="form-control" placeholder="Father's Name" ng-model="memberData.profile.father_name">       
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field" style="width: 200px;">Father's Status</td>
                                                                <td>
                                                                    <select class="form-control"  name="father_status" ng-model="memberData.profile.father_status">
                                                                        <option value="" label="Select" selected="selected">Select</option>
                                                                        <option value="Employed" label="Employed">Employed</option>
                                                                        <option value="Business" label="Business">Business</option>
                                                                        <option value="Retired" label="Retired">Retired</option>
                                                                        <option value="Not Employed" label="Not Employed">Not Employed</option>
                                                                        <option value="Passed Away" label="Passed Away">Passed Away</option>
                                                                    </select>
                                                                </td>
                                                            </tr>


                                                            <tr >
                                                                <td class="field">Father's Work Information</td>
                                                                <td>
                                                                    <input type="text" name="father_work" class="form-control" placeholder="Father's Profession" ng-model="memberData.profile.father_work">       
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field">Mother's Name</td>
                                                                <td>
                                                                    <input type="text" name="mother_name" class="form-control" placeholder="Mother's Name" ng-model="memberData.profile.mother_name">       
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="field" style="width: 200px;">Mothers's Status</td>
                                                                <td>
                                                                    <select class="form-control" name="mother_status" ng-model="memberData.profile.mother_status">
                                                                        <option value="" label="Select" selected="selected">Select</option>
                                                                        <option value="House Wife" label="House Wife">House Wife</option>
                                                                        <option value="Employed" label="Employed">Employed</option>
                                                                        <option value="Business" label="Business">Business</option>
                                                                        <option value="Retired" label="Retired">Retired</option>
                                                                        <option value="Not Employed" label="Not Employed">Not Employed</option>
                                                                        <option value="Passed Away" label="Passed Away">Passed Away</option>
                                                                    </select>
                                                                </td>
                                                            </tr>


                                                            <tr >
                                                                <td class="field">Mothers's Work Information</td>
                                                                <td>
                                                                    <input type="text" name="mother_work" class="form-control" placeholder="Mothers's Profession" ng-model="memberData.profile.mother_work">       
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="familybackground">
                                            <!--Family profile-->
                                            <div class="panel panel-inverse">
                                                <div class="panel-heading">
                                                    <h2 class="panel-title">Family Background

                                                    </h2>
                                                </div>
                                                <div class="panel-body">
                                                    <table class="table table-profile">
                                                        <tbody>
                                                            <tr >
                                                                <td class="field" rowspan="2">Family Location </td>
                                                                <td>
                                                                    <select class="form-control" name="family_location_state" ng-model="memberData.profile.family_location_state" ng-model="familylocationdata.state" ng-change="getFamilyStateCity()">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        foreach ($set_state as $key => $value) {
                                                                            ?>
                                                                            <option value="<?php echo $value['id']; ?>" label="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td>
                                                                    <select class="form-control" name="family_location_city" ng-model="familylocationdata.city" >
                                                                        <option value="">Select</option>
                                                                        <option value="{{cmt.id}}" label="{{cmt.title}}" ng-repeat="cmt in familylocationdata.city_list">{{cmt.title}}</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field" rowspan="2">No. of Siblings</td>
                                                                <td class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="font-10" > Brothers Unmarried</p>
                                                                        <input type="text" name="brother_unmarried" class="form-control" placeholder="Brothers Unmarried" ng-model="memberData.profile.brother_unmarried">       
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="font-10" > Brothers Married</p>
                                                                        <input type="text" name="brother_married" class="form-control" placeholder="Brothers Married"  ng-model="memberData.profile.brother_married">       
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="font-10" > Sisters Unmarried</p>
                                                                        <input type="text" name="sister_unmarried" class="form-control" placeholder="Sisters Unmarried" ng-model="memberData.profile.sister_unmarried">       
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="font-10" > Sisters Married</p>
                                                                        <input type="text" name="sister_married" class="form-control" placeholder="Sisters Married" ng-model="memberData.profile.sister_married">       
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field" style="width: 200px;">Family Type</td>
                                                                <td>
                                                                    <select class="form-control" name="family_type" ng-model="memberData.profile.family_type">
                                                                        <option value="" label="Select" selected="selected">Select</option>
                                                                        <option value="Joint" label="Joint">Joint</option>
                                                                        <option value="Nuclear" label="Nuclear">Nuclear</option>

                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <tr >
                                                                <td class="field" style="width: 200px;">Family values</td>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="family_value"  ng-model="memberData.profile.family_value">
                                                                        <option value="" label="Select" selected="selected">Select</option>
                                                                        <option value="Traditional" label="Traditional">Traditional</option>
                                                                        <option value="Moderate" label="Moderate">Moderate </option>
                                                                        <option value="Liberal" label="Liberal">Liberal </option>

                                                                    </select>
                                                                </td>
                                                            </tr>


                                                            <tr >
                                                                <td class="field" style="width: 200px;">Family Affluence</td>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="family_affluence" ng-model="memberData.profile.family_affluence">
                                                                        <option value="" label="Select" selected="selected">Select</option>
                                                                        <option value="Affluent" label="Affluent">Affluent</option>
                                                                        <option value="Upper Middle Class" label="Upper Middle Class">Upper Middle Class </option>
                                                                        <option value="Middle Class" label="Middle Class">Middle Class </option>
                                                                        <option value="Lower Middle Class" label="Lower Middle Class">Lower Middle Class</option>

                                                                    </select>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <button type="submit" name="updatememeber" class="btn btn-inverse btn-lg" value="updateProfile"><i class="fa fa-save"></i> Update Profile</button>

                                            <a class="btn btn-inverse btn-lg pull-right" href="<?php echo site_url("ShadiProfile/viewProfile/".$profile_id);?>" value="updateProfile"><i class="fa fa-arrow-left"></i> Back</a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- end table -->

                        </div>
                        <!-- begin table -->
                        <div class="col-md-4">
                            <ul class="list-group ">
                                <li class="list-group-item active"><a href="#basicinformation" data-toggle="tab">Basic Information</a></li>
                                <li class="list-group-item"><a href="#religious" data-toggle="tab">Religious Background</a></li>
                                <li class="list-group-item"><a href="#horoscope" data-toggle="tab">Horoscope Information</a></li>
                                <li class="list-group-item"><a href="#education" data-toggle="tab">Education & Career</a></li>
                                <li class="list-group-item"><a href="#familydetails" data-toggle="tab">Family Details</a></li>
                                <li class="list-group-item"><a href="#familybackground" data-toggle="tab">Family Background</a></li>
                            </ul>
                            <?php
                        $this->load->view('shadiProfile/sidebar');
                        ?>
                        </div>  
                        <!-- end profile-info -->
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
                                                                        var memberprofile = "<?php echo $profile_id; ?>";
</script>
<script src="<?php echo base_url(); ?>assets/angular/shadiController.js"></script>
<?php
$this->load->view('layout/footer');
?> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
