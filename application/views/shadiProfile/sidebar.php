<div class="panel panel-default">
    <div class="panel-body">
        <div class="list-group">
            <a href="<?php echo site_url("ShadiProfile/viewProfile/" . $profile_id) ?>" class="btn btn-default btn-block">
                <i class="fa fa-user"></i> Member Profile
            </a>
            <a href="<?php echo site_url("ShadiProfile/profilePhotos/" . $profile_id) ?>" class="btn btn-info btn-block">
                <i class="fa fa-photo"></i> Member Photos
            </a>
            <a href="<?php echo site_url("ShadiProfile/profilePreferences/" . $profile_id) ?>" class="btn btn-success btn-block " >
                <i class="fa fa-gear"></i>   Partner Preferences

            </a>
            <a href="#" class="btn btn-success btn-block ">
                <i class="fa fa-gear"></i>   Account Setting
            </a>
            <a href="<?php echo site_url("ShadiProfile/profileContact/" . $profile_id) ?>"  class="btn btn-inverse btn-block"><i class="fa fa-phone"></i> Contact Filter</a>
            <a href="#" class="btn btn-white btn-block"><i class="fa fa-bell"></i> Email/SMS Alert</a>
            <a href="#" class="btn btn-warning btn-block"><i class="fa fa-lock"></i> Privacy Options</a>
            <a href="#" class="btn btn-danger btn-block" ng-click="removeProfileData()"><i class="fa fa-trash"></i> Hide / Delete Profile</a>
        </div>
    </div>
</div>
