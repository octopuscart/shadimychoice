
Admin.controller('addShadiProfileController', function ($scope, $http, $timeout, $interval) {

    //merital Status
    $scope.marital_status = {"status": "Never Married", "marital_status_children": "No"};
    //end of marital status


    //get religin data
    $scope.religious = {'sub_community_list': [], "community": "1", "sub_community": "", "mother_tongue": "24"};
    $scope.getSubCommunity = function () {
        $scope.religious.sub_community = "";
        var religiousurl = rootBaseUrl + "localApi/getSimpleTableDataById/set_community/category_id/" + $scope.religious.community;
        $http.get(religiousurl).then(function (rdata) {
            $scope.religious.sub_community_list = rdata.data;
        }, function () {})
    }
    $scope.getSubCommunity(1);
    //end of religin 


    //get education Carrier data
    $scope.educareer = {'career_sector': "", "qualification": "", "income": ""};

    //get education Carrier data 

    //get religin data
    $scope.locationdata = {'city_list': [], "state": "1", "city": ""};
    $scope.getStateCity = function () {
        console.log($scope.locationdata);
        $scope.locationdata.city = "";
        var religiousurl = rootBaseUrl + "localApi/getSimpleTableDataById/set_cities/state_id/" + $scope.locationdata.state;
        $http.get(religiousurl).then(function (rdata) {
            $scope.locationdata.city_list = rdata.data;
        }, function () {})
    }
    $scope.getStateCity(1);
    //end of religin 



    //get family location data
    $scope.familylocationdata = {'city_list': [], "state": "1", "city": ""};
    $scope.getFamilyStateCity = function () {
        $scope.familylocationdata.city = "";
        var religiousurl = rootBaseUrl + "localApi/getSimpleTableDataById/set_cities/state_id/" + $scope.familylocationdata.state;
        $http.get(religiousurl).then(function (rdata) {
            $scope.familylocationdata.city_list = rdata.data;
        }, function () {})
    }
    $scope.getFamilyStateCity(1);
    //end of religin 


})


Admin.controller('editShadiProfileController', function ($scope, $http, $timeout, $interval) {

//merital Status
    $scope.marital_status = {"status": "Never Married", "marital_status_children": "No", "marital_children_count": ""};
    //end of marital status
    $scope.memberData = {"profile": {}};
    var religiousurl = rootBaseUrl + "localApi/getSimpleTableDataByPrId/shadi_profile/member_id/" + memberprofile;
    $http.get(religiousurl).then(function (rdata) {
        $scope.memberData.profile = rdata.data;
        console.log($scope.memberData.profile.marital_status);
        $scope.marital_status.status = $scope.memberData.profile.marital_status;
        $scope.marital_status.marital_status_children = $scope.memberData.profile.marital_status_children;
        $scope.marital_status.marital_children_count = $scope.memberData.profile.marital_children_count;
        $scope.getSubCommunity();
        $scope.getStateCity();
        $scope.educareer.career_sector = $scope.memberData.profile.career_sector;
        $scope.getFamilyStateCity();

    }, function () {})




    //get religin data
    $scope.religious = {'sub_community_list': [], "community": "1", "sub_community": "", "mother_tongue": "24"};
    $scope.getSubCommunity = function () {

        $scope.religious.sub_community = "";
        var religiousurl = rootBaseUrl + "localApi/getSimpleTableDataById/set_community/category_id/" + $scope.memberData.profile.religion;
        $http.get(religiousurl).then(function (rdata) {
            $scope.religious.sub_community_list = rdata.data;
            $timeout(function () {
                $scope.religious.community = $scope.memberData.profile.community;
                $scope.getHoroscope();
            }, 1000)

        }, function () {})
    }
    //end of religin 


    $scope.horoscope = {"date_of_birth": "", "time_of_birth": ""};
    $scope.getHoroscope = function () {
        $scope.horoscope.date_of_birth = new Date($scope.memberData.profile.date_of_birth);

    }

    //get education Carrier data
    $scope.educareer = {'career_sector': "", "qualification": "", "income": ""};

    //get education Carrier data 

    //get religin data
    $scope.locationdata = {'city_list': [], "state": "1", "city": ""};
    $scope.getStateCity = function () {
        console.log($scope.locationdata);
        $scope.locationdata.city = "";
        var religiousurl = rootBaseUrl + "localApi/getSimpleTableDataById/set_cities/state_id/" + $scope.memberData.profile.birth_location_state;
        $http.get(religiousurl).then(function (rdata) {
            $scope.locationdata.city_list = rdata.data;
            $timeout(function () {
                $scope.locationdata.city = $scope.memberData.profile.birth_location_city;
            })
        }, function () {})
    }

    //end of religin 



    //get family location data
    $scope.familylocationdata = {'city_list': [], "state": "1", "city": ""};
    $scope.getFamilyStateCity = function () {
        $scope.familylocationdata.city = "";
        var religiousurl = rootBaseUrl + "localApi/getSimpleTableDataById/set_cities/state_id/" + $scope.memberData.profile.family_location_state;
        $http.get(religiousurl).then(function (rdata) {
            $scope.familylocationdata.city_list = rdata.data;
            $timeout(function () {
                $scope.familylocationdata.city = $scope.memberData.profile.family_location_city;
            })

        }, function () {})
    }

    //end of religin 


})

Admin.controller('viewShadiProfileController', function ($scope, $http, $timeout, $interval) {

//merital Status
    $scope.marital_status = {"status": "Never Married", "marital_status_children": "No", "marital_children_count": ""};
    //end of marital status
    $scope.memberData = {"profile": {}};
    var religiousurl = rootBaseUrl + "localApi/getShadiProfileById/" + memberprofile;
    $http.get(religiousurl).then(function (rdata) {
        $scope.memberData.profile = rdata.data;

    }, function () {})



    $scope.removeProfileData = function () {
        Swal.fire({
            title: 'Are you sure want to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var deleteurl = rootBaseUrl + "localApi/deleteShadiProfileById";
                var formData = new FormData();
                formData.append("member_id", memberprofile);
                $http.post(deleteurl, formData).then(function (returndata) {

                    Swal.fire(
                            'Deleted!',
                            'Member profile has been deleted.',
                            'success'
                            );
                    window.location = returndata.data.url;
                })


            }
        })
    }



})

Admin.controller('photosShadiProfileController', function ($scope, $http, $timeout, $interval) {
    $scope.memberData = {"photos": [], "selected": "", "profile": {}};
    var photourl = rootBaseUrl + "localApi/getShadiProfilePhotos/" + memberprofile;
    $http.get(photourl).then(function (rdata) {
        $scope.memberData.photos = rdata.data.photos;
        $scope.memberData.profile = rdata.data.profile;
        $("#sortable").sortable({
            stop: function (event, ui) {
                $("#sortable .thumbnail").each(function (e, i) {
                    $(this).find("input.imageindex").val(e);

                })
            }
        });
    }, function () {})

    $scope.viewPhoto = function (photoobj) {
        $scope.memberData.selected = photoobj;
        $("#imagemodel").modal("show");
    }

})



Admin.controller('contactShadiProfileController', function ($scope, $http, $timeout, $interval) {
    $scope.memberData = {"contact": [], "selected": "", "profile": {}};
    var photourl = rootBaseUrl + "localApi/getShadiProfileContact/" + memberprofile;
    $http.get(photourl).then(function (rdata) {
        $scope.memberData.contact = rdata.data.contact;
        $scope.memberData.profile = rdata.data.profile;

        $timeout(function () {
            $(".editable").editable();
            $('.editableselectdisplay').editable({
                source: {
                    'Show to All': 'Visible to all Premium Members',
                    'When I Contact': 'Visible to Premium Members you wish to connect to',
                    'Hide My Contact': 'Hide my Phone number',
                    'Show To Free And Premium': 'Visible to all your Matches (Expires with Membership)',
                }
            });

            $(".editableselectrelation").editable({
                source: {
                    'Self': 'Self',
                    'Parent': 'Parent',
                    'Guardian': 'Guardian',
                    'Sibling': 'Sibling',
                    'Friend': 'Friend',
                    'Relative': 'Relative',
                    'Other': 'Other',

                }
            });
        }, 1000)

    }, function () {})



})
