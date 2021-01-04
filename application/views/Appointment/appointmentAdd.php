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
</style>

<!-- Main content -->
<section class="" ng-controller="AppointmentController">

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Set An Event <small></small></h1>
        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            <!-- begin profile-section -->
            <div class="profile-section">

                <div class="row">
                    <div class="col-md-7">
                        <!-- begin profile-info -->
                        <div class="profile-info" style="    font-size: 14px;">
                            <!-- begin table -->
                            <div class="table-responsive">
                                <form action="#" method="post"  enctype="multipart/form-data">
                                    <input type="hidden" name="aid" class="form-control" value="<?php echo $last_aid; ?>">

                                    <table class="table table-profile">

                                        <tbody>
                                            <tr>
                                                <td style="width: 300px;">Category</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <select name="category_id" class="form-control">
                                                                <?php
                                                                foreach ($category_list as $key => $value) {
                                                                    ?>
                                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['category_name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="<?php echo site_url("Events/eventCategories") ?>" class="btn btn-sm btn-link">Add Category</a>
                                                        </div>

                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Name</td>
                                                <td>
                                                    <input type="text" name="title" class="form-control" placeholder="Profile Name" ng-model="mapdata.title">     
                                                </td>
                                            </tr>
                                            <tr >
                                                <td class="field">Gender</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Date Of Birth</td>
                                                <td>
                                                    <input type="text" name="date_of_birth" class="form-control" placeholder="Date Of Birth" ng-model="mapdata.hotel">     
                                                </td>
                                            </tr>
                                            <tr >
                                                <td class="field">Marital status</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option value="" label="Select">Select</option>
                                                        <option value="Never Married" label="Never Married" selected="selected">Never Married</option>
                                                        <option value="Divorced" label="Divorced">Divorced</option>
                                                        <option value="Awaiting Divorce" label="Awaiting Divorce">Awaiting Divorce</option>
                                                    </select>                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Height</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option value="" label="Select">Select</option>
                                                        <option value="53" label="4ft 5in - 134cm">4ft 5in - 134cm</option>
                                                        <option value="54" label="4ft 6in - 137cm">4ft 6in - 137cm</option>
                                                        <option value="55" label="4ft 7in - 139cm">4ft 7in - 139cm</option>
                                                        <option value="56" label="4ft 8in - 142cm">4ft 8in - 142cm</option>
                                                        <option value="57" label="4ft 9in - 144cm">4ft 9in - 144cm</option>
                                                        <option value="58" label="4ft 10in - 147cm">4ft 10in - 147cm</option>
                                                        <option value="59" label="4ft 11in - 149cm">4ft 11in - 149cm</option>
                                                        <option value="60" label="5ft - 152cm">5ft - 152cm</option>
                                                        <option value="61" label="5ft 1in - 154cm">5ft 1in - 154cm</option>
                                                        <option value="62" label="5ft 2in - 157cm">5ft 2in - 157cm</option>
                                                        <option value="63" label="5ft 3in - 160cm">5ft 3in - 160cm</option>
                                                        <option value="64" label="5ft 4in - 162cm" selected="selected">5ft 4in - 162cm</option>
                                                        <option value="65" label="5ft 5in - 165cm">5ft 5in - 165cm</option>
                                                        <option value="66" label="5ft 6in - 167cm">5ft 6in - 167cm</option>
                                                        <option value="67" label="5ft 7in - 170cm">5ft 7in - 170cm</option>
                                                        <option value="68" label="5ft 8in - 172cm">5ft 8in - 172cm</option>
                                                        <option value="69" label="5ft 9in - 175cm">5ft 9in - 175cm</option>
                                                        <option value="70" label="5ft 10in - 177cm">5ft 10in - 177cm</option>
                                                        <option value="71" label="5ft 11in - 180cm">5ft 11in - 180cm</option>
                                                        <option value="72" label="6ft - 182cm">6ft - 182cm</option>
                                                        <option value="73" label="6ft 1in - 185cm">6ft 1in - 185cm</option>
                                                        <option value="74" label="6ft 2in - 187cm">6ft 2in - 187cm</option>
                                                        <option value="75" label="6ft 3in - 190cm">6ft 3in - 190cm</option>
                                                        <option value="76" label="6ft 4in - 193cm">6ft 4in - 193cm</option>
                                                        <option value="77" label="6ft 5in - 195cm">6ft 5in - 195cm</option>
                                                        <option value="78" label="6ft 6in - 198cm">6ft 6in - 198cm</option>
                                                        <option value="79" label="6ft 7in - 200cm">6ft 7in - 200cm</option>
                                                        <option value="80" label="6ft 8in - 203cm">6ft 8in - 203cm</option>
                                                        <option value="81" label="6ft 9in - 205cm">6ft 9in - 205cm</option>
                                                        <option value="82" label="6ft 10in - 208cm">6ft 10in - 208cm</option>
                                                        <option value="83" label="6ft 11in - 210cm">6ft 11in - 210cm</option>
                                                        <option value="84" label="7ft - 213cm">7ft - 213cm</option>
                                                    </select>                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Weight</td>
                                                <td>
                                                    <input type="number" name="weight" class="form-control littletextbox" placeholder="Weight" style="">  KG     
                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Any Disability?</td>
                                                <td>
                                                    <input type="text" name="disablity" class="form-control" placeholder="Disability" >       
                                                </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Blood Group</td>
                                                <td>
                                                    <select class="form-control">
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

                                            <tr >
                                                <td class="field">Contact No.</td>
                                                <td>
                                            </tr>


                                            <tr >
                                                <td class="field">Email</td>
                                                <td>
                                                    <input type="text" name="email" class="form-control" placeholder="Email">                                            </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Website</td>
                                                <td>
                                                    <input type="text" name="website" class="form-control" placeholder="Website">                                            </td>
                                            </tr>

                                            <tr >
                                                <td class="field">Event Image</td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="image1">Upload Primary Image</label>
                                                        <input type="file" name="picture" required="" />           
                                                    </div>                                            </tr>


                                            <tr>
                                                <td class="field">Select Dates</td>
                                                <td>

                                                    <div id="advance-daterange" class="btn btn-white">
                                                        <span></span>
                                                        <i class="fa fa-angle-down fa-fw"></i>
                                                    </div> 
                                                    <input type="hidden" id="start_date" name="start_date" value="<?php echo date("Y-m-d"); ?>">
                                                    <input type="hidden" id="end_date" name="end_date" value="<?php echo date("Y-m-d"); ?>">

                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="field">Select Time</td>
                                                <td>
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <input type="time" name="from_time" class="form-control" placeholder="Start Time">                                            
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <input type="time" name="to_time" class="form-control" placeholder="End Time">                                            
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-warning btn-lg" name="set_date">Set Dates</button>

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <!-- end table -->


                            <!-- begin table -->
                            <div class="table-responsive">

                                <table class="table table-profile">

                                    <tbody>

                                        <tr >

                                            <td colspan="2">
                                                <table style="    width: 500px;" class="table">
                                                    <tr>
                                                        <td colspan="3">
                                                            <p class="text-danger">Note: You can change event dates after add the appointment.</p>
                                                        </td>
                                                    </tr>


                                                </table>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- end table -->
                        </div>
                        <!-- end profile-info -->
                    </div>
                    <div class="col-md-5">
                        <h4><i class="fa fa-cog"></i> <button class="btn btn-success" ng-click="viewOnModal()">View Map</button></h4>

                        <iframe  frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'  height="400px" width="100%" id='mapifram'  src="https://maps.google.com/?q=<?php echo $appointment['hotel']; ?>+<?php echo $appointment['address']; ?>&output=embed">
                        </iframe> 

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
                            Admin.controller('AppointmentController', function ($scope, $http, $filter, $timeout) {
                                $scope.mapdata = {'address': '', 'hotal': '', 'url': ''};
                                $scope.viewOnModal = function () {
                                    $("#mapifram").attr("src", "https://maps.google.com/?q=" + $scope.mapdata.hotel + "+" + $scope.mapdata.address + "&output=embed")
                                }

                                var startdate = "<?php echo date("Y-m-d"); ?>";
                                var enddate = "<?php echo date("Y-m-d"); ?>";
                                $('#advance-daterange span').html(moment(startdate).format('DD MMMM YYYY') + ' - ' + moment(enddate).format('DD MMMM YYYY'));
                                $('#advance-daterange').daterangepicker({
                                    format: 'YYYY-MM-DD',
                                    startDate: startdate,
                                    endDate: enddate,
                                    // minDate: startdate,
//        maxDate: '<?php echo date('Y-m-d') ?>',
//        dateLimit: { days: 60 },
                                    showDropdowns: true,
                                    showWeekNumbers: true,
                                    timePicker: false,
                                    timePickerIncrement: 1,
                                    timePicker12Hour: true,
                                    opens: 'right',
                                    drops: 'down',
                                    buttonClasses: ['btn', 'btn-sm'],
                                    applyClass: 'btn-primary',
                                    cancelClass: 'btn-default',
                                    separator: ' to ',
                                    locale: {
                                        applyLabel: 'Submit',
                                        cancelLabel: 'Cancel',
                                        fromLabel: 'From',
                                        toLabel: 'To',
                                        customRangeLabel: 'Custom',
                                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                        firstDay: 1
                                    }
                                }, function (start, end, label) {
                                    $("#start_date").val(start.format('YYYY-MM-DD'));
                                    $("#end_date").val(end.format('YYYY-MM-DD'));
                                    $('#advance-daterange span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
                                });
                            })
</script>
<?php
$this->load->view('layout/footer');
?> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
                            $(function () {
                                $('.edit_detail').hide();
                                $("#edit_toggle").click(function () {
                                    $('.edit_detail').hide();
                                    if (this.checked) {
                                        $('.edit_detail').show();
                                    }
                                })

                                $('.edit_detail').click(function (e) {
                                    e.stopPropagation();
                                    e.preventDefault();
                                    $($(this).prev()).editable('toggle');
                                });
                                $('.time_data').editable({
                                    source: {
<?php
$timeselection = [
    '06:00 AM',
    '06:30 AM',
    '07:00 AM',
    '07:30 AM',
    '08:00 AM',
    '08:30 AM',
    '09:00 AM',
    '09:30 AM',
    '10:00 AM',
    '10:30 AM',
    '11:00 AM',
    '11:30 AM',
    '12:00 PM',
    '01:00 PM',
    '01:30 PM',
    '02:00 PM',
    '02:30 PM',
    '03:00 PM',
    '04:30 PM',
    '05:00 PM',
    '05:30 PM',
    '06:00 PM',
    '06:30 PM',
    '07:00 PM',
    '07:30 PM',
    '08:00 PM',
    '08:30 PM',
    '09:00 PM',
    '09:30 PM',
    '10:00 PM',
    '10:30 PM',
    '11:00 PM',
    '11:30 PM',
];
foreach ($timeselection as $key => $value) {
    echo "'$value':'$value',";
}
?>
                                    }
                                });
                                $('#profession').editable({
                                    source: {
                                        'Academic': 'Academic',
                                        'Medicine': 'Medicine',
                                        'Law': 'Law',
                                        'Banking': 'Banking',
                                        'IT': 'IT',
                                        'Entrepreneur': 'Entrepreneur',
                                        'Sales/Marketing': 'Sales/Marketing',
                                        'Other': 'Other',
                                    }
                                });
                                $('#country').editable({
                                    source: {
<?php ?>

                                    }
                                });
                            })
</script>