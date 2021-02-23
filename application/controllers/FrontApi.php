<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class FrontApi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Shadi_model');
        $this->load->library('session');
        $this->load->model('Curd_model');
        $this->checklogin = $this->session->userdata('logged_in');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
    }

    public function memberFilterApi_get() {
        $this->db->select("member_id, career_income, religion, career_sector, career_profession, "
                . "family_location_state, mother_tongue, family_location_city, high_qualification");
        $this->db->order_by("id desc");
//        $query = $this->db->where("gender", "Female");
        $query = $this->db->get("shadi_profile");
        $result = $query->result_array();



        $this->load->library('JsonSorting', $result);

        $income = $this->jsonsorting->collect_data('career_income');
        $incomelist = $this->Shadi_model->getTableIformation("set_annual_income", $income);


        $religin = $this->jsonsorting->collect_data('religion');
        $religinlist = $this->Shadi_model->getTableIformation("set_community_category", $religin);

        $location_state = $this->jsonsorting->collect_data('family_location_state');
        $location_state_list = $this->Shadi_model->getTableIformation("set_states", $location_state);

        $family_location = $this->jsonsorting->data_combination('family_location_city', 'family_location_state');

        $high_qualification = $this->jsonsorting->collect_data('high_qualification');

//        SELECT * FROM `set_qualification` as sq
//join set_qualification_category as sqc on sqc.id = sq.category_id
//where sq.id in (5,9,7,2,88,1,23,4,18,47,6,3,14,33,30,10)


        $career_profession = $this->jsonsorting->collect_data('career_profession');
//        print_r($career_profession);


        $mother_tongue = $this->jsonsorting->collect_data('mother_tongue');
        $mother_tongue_list = $this->Shadi_model->getTableIformation("set_mother_tongue", $mother_tongue);


        $career_sector = $this->jsonsorting->collect_data('career_sector');
        $career_sector_list = $this->Shadi_model->getTableIformation("set_profession_sector", $career_sector);





        $filterdata = array(
            "religion" => array("title" => "Religion", "data" => $religinlist),
            "states" => array("title" => "State Living in", "data" => $location_state_list),
            "income" => array("title" => "Annual Income", "data" => $incomelist),
            "career_sector" => array("title" => "Working With", "data" => $career_sector_list),
            "mother_tongue" => array("title" => "Mother Tongue", "data" => $mother_tongue_list),
            "religion" => array("title" => "Religion", "data" => $religinlist),
            "states" => array("title" => "State Living in", "data" => $location_state_list),
        );
        $this->response(array("filter" => $filterdata, "total_members" => count($result)));
    }

    public function memberListApi_get() {
        $attrdatak = $this->get();
        $products = [];
        $countpr = 0;
        $startpage = $attrdatak["start"] - 1;
        $endpage = $attrdatak["end"];
        unset($attrdatak["start"]);
        unset($attrdatak["end"]);
        $this->db->select("member_id, career_income, religion, career_sector, career_profession, gender, "
                . "family_location_state, mother_tongue, family_location_city, high_qualification");
        $this->db->order_by("id desc");
        $this->db->limit(16, $startpage);
//        $query = $this->db->where("gender", "Female");
        $query = $this->db->where("status", "Active");
        $query = $this->db->get("shadi_profile");
        $memberListFinal1 = $query->result_array();

        $memberListFinal = [];
        foreach ($memberListFinal1 as $key => $value) { 
            if(($value['gender'])) {
                $memberobj = $this->Shadi_model->getShortInformation($value['member_id']);
                array_push($memberListFinal, $memberobj);
            }
        }
        $this->output->set_header('Content-type: application/json');
        $memberArray = array('attributes' => array(),
            'memberslist' => $memberListFinal,
            'offers' => array(),
        );
        $this->response($memberArray);
    }

    function getProfilePhoto($member_id) {
        $defaultImage = base_url() . "assets/emoji/user.png";
        $this->db->where("member_id", $member_id);
        $this->db->where("status", "profile");
        $query = $this->db->get("shadi_profile_photos");
        $profilephoto = $query->row();
        if ($profilephoto) {
            $defaultImage = base_url() . "assets/profile_image/" . $profilephoto->image;
        }
        return $defaultImage;
    }

    function getProfilePhotosAll($member_id) {
        $defaultImage = base_url() . "assets/emoji/user.png";
        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile_photos");
        $profilephoto = $query->result();
        $photoarray = [];
        foreach ($profilephoto as $key => $value) {
            $image = base_url() . "assets/profile_image/" . $value->image;
            array_push($photoarray, $image);
        }
        return $photoarray;
    }

    function getShadiProfileById_get($member_id) {
        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile");
        $basicdata = $query->row();

        $profileiamge = $this->Shadi_model->getProfilePhoto($member_id, $basicdata->gender);
        $basicdata->profile_photo = $profileiamge;

        $profileiamges = $this->Shadi_model->getProfilePhotoAll($member_id, $basicdata->gender);
        $basicdata->profile_photo_all = $profileiamges;

        $basicdata->baseProfile = $this->Shadi_model->getShortInformation($member_id);



        //community
        $religion = $this->Curd_model->get_single("set_community_category", $basicdata->religion);
        $basicdata->religion_title = $religion->title;

        $community = $this->Curd_model->get_single("set_community", $basicdata->community);
        $basicdata->community_title = $community ? $community->title : '';
        //end of community
        //
        //mother tounge
        $mother_tongue = $this->Curd_model->get_single("set_mother_tongue", $basicdata->mother_tongue);
        $basicdata->mother_tongue_title = $mother_tongue->title;
        //end fo mother tounge
        //
        //qualification
        $high_qualification = $this->Curd_model->get_single("set_qualification", $basicdata->high_qualification);
        $basicdata->high_qualification_title = $high_qualification ? $high_qualification->title : '';
        $basicdata->high_qualification_category_title = "";
        if ($high_qualification) {
            $high_qualification_category = $this->Curd_model->get_single("set_qualification_category", $high_qualification->category_id);
            $basicdata->high_qualification_category_title = $high_qualification_category ? $high_qualification_category->title : "";
        }
        //end fo qualification
        //
        //birth location
        $birth_location_state = $this->Curd_model->get_single("set_states", $basicdata->birth_location_state);
        $basicdata->birth_location_state_title = $birth_location_state ? $birth_location_state->title : '';

        $birth_location_city = $this->Curd_model->get_single("set_cities", $basicdata->birth_location_city);
        $basicdata->birth_location_city_title = $birth_location_city ? $birth_location_city->title : "";
        //end birth location
        //
        //family location
        $family_location_state = $this->Curd_model->get_single("set_states", $basicdata->family_location_state);
        $basicdata->family_location_state_title = $family_location_state ? $family_location_state->title : "";

        $family_location_city = $this->Curd_model->get_single("set_cities", $basicdata->family_location_city);
        $basicdata->family_location_city_title = $family_location_city ? $family_location_city->title : "";
        //end family location
        //
        //annual income
        $career_income = $this->Curd_model->get_single("set_annual_income", $basicdata->career_income);
        $basicdata->career_income_title = $career_income ? $career_income->title : '';
        //end fo annual income
        //
        //profession
        $career_sector = $this->Curd_model->get_single("set_profession_sector", $basicdata->career_sector);
        $basicdata->career_sector_title = $career_sector ? $career_sector->title : "";

        $profession = $this->Curd_model->get_single("set_profession", $basicdata->career_profession);
        $basicdata->career_profession_title = $profession ? $profession->title : '';
        if ($profession) {
            $profession_category = $this->Curd_model->get_single("set_profession_category", $profession->category_id);
            $basicdata->career_profession_category_title = $profession_category ? $profession_category->title : '';
        } else {
            $basicdata->career_profession_category_title = "";
        }
        //end fo profession
        $this->response($basicdata);
    }

    function login_get() {
        $mobile_no = $this->get("mobile");
        $this->db->where("contact_no", $mobile_no);
        $query = $this->db->get("admin_users");
        $restul = $query->row();
        if ($restul) {
            $data = array("status" => "success");
        } else {
            $data = array("status" => "filed");
        }
        $this->response($data);
    }

    function checklogin_get() {
        $mobile_no = $this->get("mobile");
        $password = $this->get("otp");
        $this->db->where("password", md5($password));
        $this->db->where("contact_no", $mobile_no);
        $query = $this->db->get("admin_users");
        $restul = $query->row();
        if ($restul) {
            $data = array("status" => "success", "userdata" => $restul);
        } else {
            $data = array("status" => "filed");
        }
        $this->response($data);
    }

    function managerMemberList_get($manager_id, $usertype) {
        $userid = $manager_id;

        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $start = "0";
        $length = "100";
        $search = "";

//        $search = $this->input->get("search")['value'];

        $managerfilter = "";


        $searchfilter = "";



        $this->db->select("member_id, career_income, religion, career_sector, career_profession, "
                . "family_location_state, mother_tongue, family_location_city, high_qualification");
        if ($usertype == 'Admin') {
            
        } else {
            $this->db->where("manager_id", $userid);
        }
        $this->db->where("status", "active");

        $this->db->order_by("id desc");
//        $this->db->limit(16, $startpage);
        $query = $this->db->get("shadi_profile");
        $memberListFinal1 = $query->result_array();
        $memberListFinal = [];
        foreach ($memberListFinal1 as $key => $value) {
            $memberobj = $this->Shadi_model->getShortInformation($value['member_id']);
            $tempobj = array();
            foreach ($memberobj as $key1 => $value2) {
                $tempobj[$key1] = $value2 ? $value2 : '-';
            }
            array_push($memberListFinal, $tempobj);
        }



        $this->response($memberListFinal);
    }

    function getCommunities_get() {
        $query = $this->db->get("set_community_category");
        $category = $query->result_array();
        $finaldata = [];
        foreach ($category as $key => $value) {
            $this->db->where("category_id", $value["id"]);
            $query2 = $this->db->get("set_community");
            $value["sub_category"] = $category = $query2->result_array();
            array_push($finaldata, $value);
        }
        $this->response($finaldata);
    }

}

?>