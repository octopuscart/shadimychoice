<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>?>
<style>
    .product_text {
        float: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        width:350px
    }
    .product_title {
        font-weight: 700;
    }
    .price_tag{
        float: left;
        width: 100%;
        border: 1px solid #222d3233;
        margin: 2px;
        padding: 0px 2px;
    }
    .price_tag_final{
        width: 100%;
    }

    .exportdata{
        margin: 15px 0px 0px 0px;
    }
</style>
<!-- Main content -->


<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<section class="content">
    <div class="">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Users Reports
                    <span class="pull-right label label-success">
                        <a class="btn btn-success btn-xs" href="<?php echo site_url('userManager/user_profile_record_xls'); ?>"  targer="_blank">
                            <i class="fa fa-file-excel-o"></i>  Export Data
                        </a>
                    </span>
                </h3>
                <div class="panel-tools">

                </div>

            </div>
            <div class="panel-body">



                <!-- Tab panes -->
                <div class="">


                    <div class="" style="padding:20px">
                        <table id="tableData" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">S.N.</th>
                                    <th style="width:40px;">Profile ID</th>
                                    <th style="width: 75px;">Name</th>
                                    <th style="width: 75px;">Gender</th>
                                    <th style="width: 100px;">Cast</th>
                                    <th style="width: 100px;">Location</th>
                                    <?php
                                    if ($usertype == 'Admin') {
                                        ?>
                                        <th style="width: 100px;">Agent</th>
                                        <?php
                                    }
                                    ?>
                                    <th style="width: 75px;">View</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </div>
    </div>
</section>
<!-- end col-6 -->
</div>
<script src="<?php echo base_url(); ?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/table-manage-default.demo.min.js"></script>

<?php
$this->load->view('layout/footer');
?> 
<script>
    $(function () {

    $('#tableData').DataTable({
    "processing": true,
            "serverSide": true,
            "ajax": {
            url: "<?php echo site_url("LocalApi/profileListApi") ?>",
                    type: 'GET'
            },
            "columns": [
            {"data": "sn"},
            {"data": "member_id"},
            {"data": "name"},
            {"data": "gender"},
            {"data": "cast"},
            {"data": "location"},
<?php
if ($usertype == 'Admin') {
    ?>
                {"data": "agent"},
    <?php
}
?>
            {"data": "edit"}]
    })
    }
    )

</script>