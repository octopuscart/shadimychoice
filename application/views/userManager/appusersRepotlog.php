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

<?php

function userReportFunction($users) {
    ?>
    <table id="tableDataOrder" class="table ">
        <thead>
            <tr>
                <th style="width: 20px;">S.N.</th>
                <th style="width: 75px;">Name</th>
                <th style="width: 100px;">Contact No./ Email</th>
                <th style="width: 200px;">Status </th>
                <th style="width: 100px;"> Date</th>
                <th style="width: 100px;"> Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($users)) {

                $count = 1;
                foreach ($users as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>



                        <td>
                            <span class="">
                                <b><span class="seller_tag"><?php echo $value->name; ?> </span></b>
                            </span>
                        </td>


                        <td>
                            <span class="">

                                <h4>  <?php echo $value->contact_no; ?></h4>
                                <span class="seller_tag">
                                    <?php echo $value->email; ?>
                                </span>
                            </span>
                        </td>
                        <td>
                            <span class="">

                                <h5>  <?php echo $value->status; ?></h5>
                                <p><?php echo $value->remark; ?></p>
                            </span>
                        </td>



                        <td>
                            <span class="">
                                <?php echo $value->op_date; ?>
                            </span>
                        </td>
                        <td>
                            <span class="">
                                <?php echo $value->op_time; ?>
                            </span>
                        </td>

                    </tr>
                    <?php
                    $count++;
                }
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>


<section class="content">
    <div class="">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">
                    App User Access Log

                </h3>
                <div class="panel-tools">

                </div>

            </div>
            <div class="panel-body">



                <!-- Tab panes -->
                <div class="tab-content">


                    <div class="" style="padding:20px">
                        <?php userReportFunction($users_report); ?>
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

        $('#tableDataOrder').DataTable({
            language: {
                "search": "Apply filter _INPUT_ to table"
            }
        })
    })

</script>