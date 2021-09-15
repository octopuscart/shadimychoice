<?php
$userdata = $this->session->userdata('logged_in');
if ($userdata) {
    
} else {
    redirect("Authentication/index", "refresh");
}
$menu_control = array();



if (DEFAULT_PAYMENT == 'No') {
    unset($product_menu['sub_menu']['Items Prices']);
} else {
    
}







$schedule_menu = array(
    "title" => "Member Management",
    "icon" => "fa fa-user",
    "active" => "",
    "sub_menu" => array(
        "Add Member" => site_url("ShadiProfile/addProfile"),
        "List Of Members" => site_url("ShadiProfile/listOfProfile"),
        "Schedule Report" => site_url("#"),
    ),
);
array_push($menu_control, $schedule_menu);






$lookbook_menu = array(
    "title" => "Media Management",
    "icon" => "fa fa-image",
    "active" => "",
    "sub_menu" => array(
        "Images" => site_url("Media/images"),
//        "Tags" => site_url("CMS/blogTag"),
    ),
);

if ($userdata['user_type'] == 'Admin') {
    array_push($menu_control, $lookbook_menu);
}


$msg_menu2 = array(
    "title" => "Message Management",
    "icon" => "fa fa-envelope",
    "active" => "",
    "sub_menu" => array(
        "Send Mail To Clinet" => site_url("#"),
        "Email Configuration" => site_url("#"),
    ),
);

$user_menu = array(
    "title" => "Agent Management",
    "icon" => "fa fa-user",
    "active" => "",
    "sub_menu" => array(
        "Add Agent" => site_url("UserManager/addManager"),
        "Agent Reports" => site_url("UserManager/usersReportManager"),
    ),
);
if ($userdata['user_type'] == 'Admin') {
    array_push($menu_control, $user_menu);
}
$appuser_menu = array(
    "title" => "App Users management",
    "icon" => "fa fa-mobile",
    "active" => "",
    "sub_menu" => array(
        "Users Reports" => site_url("UserManager/appUsersReport"),
        "Access Reports" => site_url("UserManager/appUsersLog"),
    ),
);
if ($userdata['user_type'] == 'Admin') {
    array_push($menu_control, $appuser_menu);
}



$setting_menu = array(
    "title" => "Settings",
    "icon" => "fa fa-cogs",
    "active" => "",
    "sub_menu" => array(
        "Event Categories" => site_url("Events/eventCategories"),
        "System Log" => site_url("Services/systemLogReport"),
        "Report Configuration" => site_url("Configuration/reportConfiguration"),
    ),
);

if ($userdata['user_type'] == 'Admin') {
    array_push($menu_control, $setting_menu);
}







foreach ($menu_control as $key => $value) {
    $submenu = $value['sub_menu'];
    foreach ($submenu as $ukey => $uvalue) {
        if ($uvalue == current_url()) {
            $menu_control[$key]['active'] = 'active';
            break;
        }
    }
}
?>

<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src='<?php echo base_url(); ?>assets/profile_image/<?php echo $userdata['image'] ?>' alt="" class="media-object rounded-corner" style="    width: 35px;background: url(<?php echo base_url(); ?>assets/emoji/user.png);    height: 35px;background-size: cover;" /></a>
                </div>
                <div class="info textoverflow" >

                    <?php echo $userdata['first_name']; ?>
                    <small class="textoverflow" title="<?php echo $userdata['username']; ?>"><?php echo $userdata['username']; ?></small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="has-sub ">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-laptop"></i>
                    <span>Dashboard</span>
                </a>
                <ul class="sub-menu">

                    <li class="active "><a href="<?php echo site_url("Order/index"); ?>">Dashboard</a></li>

                </ul>
            </li>
            <?php foreach ($menu_control as $mkey => $mvalue) { ?>

                <li class="has-sub <?php echo $mvalue['active']; ?>">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>  
                        <i class="<?php echo $mvalue['icon']; ?>"></i> 
                        <span><?php echo $mvalue['title']; ?></span>
                    </a>
                    <ul class="sub-menu">
                        <?php
                        $submenu = $mvalue['sub_menu'];
                        foreach ($submenu as $key => $value) {
                            ?>
                            <li><a href="<?php echo $value; ?>"><?php echo $key; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <li class="nav-header">Tailor Admin V <?php echo PANELVERSION; ?></li>
            <li class="nav-header">-</li>
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->