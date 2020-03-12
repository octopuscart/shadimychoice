<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>    

<?php
$eventdate = $eventData['date_time_list'];
$event = $eventData['appointment'];
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
        <h1 class="page-header"><?php echo $event['venue']; ?>, <?php echo $event['country']; ?> <br/><small>(<?php echo $event['days']; ?>)</small></h1>
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
                                <table class="table table-profile table-bordered">

                                    <tbody>
                                        <tr >
                                            <td class="field">Title</td>
                                            <td>
                                                <span id="title" data-type="text" data-pk="<?php echo $event['aid']; ?>" data-name="title" data-value="<?php echo $event['title']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Title" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_title" > <?php echo $event['title']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">Description</td>
                                            <td>
                                                <span id="description" data-type="textarea" data-pk="<?php echo $event['aid']; ?>" data-name="description" data-value="<?php echo $event['description']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Description" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_description" > <?php echo $event['description']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>


                                        <tr >
                                            <td class="field">Country</td>
                                            <td>
                                                <span id="country" data-type="text" data-pk="<?php echo $event['aid']; ?>" data-name="country" data-value="<?php echo $event['country']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Country" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_country" > <?php echo $event['country']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">State</td>
                                            <td>
                                                <span id="state" data-type="text" data-pk="<?php echo $event['aid']; ?>" data-name="state" data-value="<?php echo $event['state']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter State" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#state" > <?php echo $event['state']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">City</td>
                                            <td>
                                                <span id="city" data-type="text" data-pk="<?php echo $event['aid']; ?>" data-name="city" data-value="<?php echo $event['city']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter City" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#city" > <?php echo $event['city']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">Venue</td>
                                            <td>
                                                <span id="hotel" data-type="text" data-pk="<?php echo $event['aid']; ?>" data-name="venue" data-value="<?php echo $event['venue']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Venue Name" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#venue_hotel" > <?php echo $event['venue']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">Address</td>
                                            <td>
                                                <span id="address" data-type="textarea" data-pk="<?php echo $event['aid']; ?>" data-name="address" data-value="<?php echo $event['address']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Address" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_address" > <?php echo $event['address']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>

                                        <tr >
                                            <td class="field">Contact No.</td>
                                            <td>
                                                <span id="contact_no" data-type="text" data-pk="<?php echo $event['aid']; ?>" data-name="contact_no" data-value="<?php echo $event['contact_no']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Contact No." class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_contact_no" > <?php echo $event['contact_no']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>

                                        <tr >
                                            <td class="field">Email</td>
                                            <td>
                                                <span id="email" data-type="text" data-pk="<?php echo $event['aid']; ?>" data-name="email" data-value="<?php echo $event['email']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Email" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_email" > <?php echo $event['email']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>

                                        <tr >
                                            <td class="field">Website</td>
                                            <td>
                                                <span id="website" data-type="text" data-pk="<?php echo $event['aid']; ?>" data-name="website" data-value="<?php echo $event['website']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Website" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_website" > <?php echo $event['website']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>


                                        <tr >
                                            <td class="field">Event Image</td>
                                            <td>
                                                <div class="col-md-4 imagelist">
                                                    <img src="<?php echo (base_url() . "assets/media/" . $event['image']); ?>" style="height:60px;" />
                                                </div>
                                                <div class="col-md-8">

                                                    <form action="#" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <input type="file" name="picture" required="" />           
                                                        </div> 
                                                        <button type="submit" name="changeimage" class="btn btn-primary">Change Image</button>

                                                    </form>
                                                </div>
                                            </td>

                                        </tr>


                                        <tr>


                                        <tr>
                                            <td class="field">Select Dates</td>
                                            <td>
                                                <form action="#" method="post">
                                                    <div id="advance-daterange" class="btn btn-white">
                                                        <span></span>
                                                        <i class="fa fa-angle-down fa-fw"></i>
                                                    </div> 
                                                    <input type="hidden" id="start_date" name="start_date" value="<?php echo $event['start_date']; ?>">
                                                    <input type="hidden" id="end_date" name="end_date" value="<?php echo $event['end_date']; ?>">
                                                    <button type="submit" class="btn btn-warning" name="set_date">Set Dates</button>
                                                </form>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
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
                                                            <p class="text-danger">Note: If you change date(s), You would have to change time.</p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Date</th>
                                                        <th>From Time</th>
                                                        <th>To Time</th>
                                                    </tr>

                                                    <?php
                                                    foreach ($eventdate as $key => $value) {
                                                        ?>

                                                        <tr>
                                                            <td>
                                                                <?php echo $value['date']; ?>

                                                            </td>
                                                            <td>
                                                                <span id="date1<?php echo $value['id']; ?>" data-type="select" data-pk="<?php echo $value['id']; ?>" data-name="from_time" data-value="<?php echo $value['from_time']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointmentTime"); ?>" data-original-title="From Time" class="m-l-5 editable editable-click time_data" tabindex="-1" data-toggle="#date1<?php echo $value['id']; ?>" > <?php echo $value['from_time']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                                            </td>
                                                            <td>
                                                                <span id="date2<?php echo $value['id']; ?>" data-type="select" data-pk="<?php echo $value['id']; ?>" data-name="to_time" data-value="<?php echo $value['to_time']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointmentTime"); ?>" data-original-title="From Time" class="m-l-5 editable editable-click time_data" tabindex="-1" data-toggle="#date2<?php echo $value['id']; ?>" > <?php echo $value['to_time']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                                            </td>
                                                        </tr>



                                                        <?php
                                                    }
                                                    ?>
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
                        <h4><i class="fa fa-cog"></i> Settings</h4>
                        <div class="checkbox m-b-5 m-t-0" >
                            <label><input type="checkbox" id="edit_toggle" /> Edit Information</label>
                        </div>
                        <div style="text-align: center">
                            <img src="<?php echo (base_url() . "assets/media/" . $event['image']); ?>" style="height:200px;" />
                        </div>
                        <iframe  frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'  height="400px" width="100%" id='mapifram'  src="https://maps.google.com/?q=<?php echo $event['venue']; ?>+<?php echo $event['address']; ?>&output=embed">
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
        $scope.viewOnModal = function (address, hotel) {
            $("#mapifram").attr("src", "https://maps.google.com/?q=" + hotel + "+" + address + "&output=embed")
            $scope.mapdata.address = address;
            $scope.mapdata.hotel = hotel;
            console.log($scope.mapdata);
            $("#modal-dialog-map").modal("show")
        }

        var startdate = "<?php echo $event['start_date']; ?>";
        var enddate = "<?php echo $event['end_date']; ?>";
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
            opens: 'left',
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