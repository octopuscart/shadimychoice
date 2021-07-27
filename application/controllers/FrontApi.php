<?php

defined('BASEPATH') or exit('No direct script access allowed');
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

    public function memberFilterApiMobile_get() {
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
            array("title" => "Religion", "data" => $religinlist),
            array("title" => "State Living in", "data" => $location_state_list),
            array("title" => "Annual Income", "data" => $incomelist),
            array("title" => "Working With", "data" => $career_sector_list),
            array("title" => "Mother Tongue", "data" => $mother_tongue_list),
            array("title" => "Religion", "data" => $religinlist),
            array("title" => "State Living in", "data" => $location_state_list),
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
            if (($value['gender'])) {
                $memberobj = $this->Shadi_model->getShortInformation($value['member_id']);
                array_push($memberListFinal, $memberobj);
            }
        }
        $this->output->set_header('Content-type: application/json');
        $memberArray = array(
            'attributes' => array(),
            'memberslist' => $memberListFinal,
            'offers' => array(),
        );
        $this->response($memberArray);
    }

    function getShadiProfileById_get($member_id) {
        $basicdata = $this->Shadi_model->getShadiProfileById($member_id);
        $profileData = array();
        foreach ($basicdata as $key => $value) {
            $profileData[$key] = $value ? $value : "";
        }
        $this->response($basicdata);
    }

    function login_get() {
        $mobile_no = $this->get("mobile");
        $this->db->where("contact_no", $mobile_no);
        $query = $this->db->get("admin_users");
        $restul = $query->row();

        $otpcheck = rand(1000, 9999);
        $this->db->set('login_otp', $otpcheck);
        $this->db->where('contact_no', $mobile_no);
        $this->db->update('admin_users');
        $api_key = '56038B83D0D233';
        $testmode = 0;
        $from = 'SHADMC';
        $message = "$otpcheck is your OTP to login to shadimychoice.com";
        if ($testmode == 0) {
            $sms_text = urlencode($message);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://sms.arasko.com/app/smsapi/index.php");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "key=" . $api_key . "&campaign=10800&routeid=7&type=text&contacts=" . $mobile_no . "&senderid=" . $from . "&msg=" . $sms_text);
            $response = curl_exec($ch);
            curl_close($ch);
            $strvrfy = $response;
//            print_r($strvrfy);
        }


        if ($restul) {
            $this->Shadi_model->sendOTPEmail($restul->email, $message);
            $data = array("status" => "success");
        } else {
            $data = array("status" => "filed");
        }
        $this->response($data);
    }

    function checklogin_get() {
        $mobile_no = $this->get("mobile");
        $password = $this->get("otp");
        $this->db->where("login_otp", $password);
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

    function managerMemberListAll_get() {


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
            $category = $query2->result_array();
            $tempcat = [array("id" => "", "title" => "")];
            $value["sub_category"] = $category;
            array_push($finaldata, $value);
        }
        $this->response($finaldata);
    }

    function sendSms_get() {
        $api_key = '56038B83D0D233';
        $contacts = '8602648733';
        $from = 'FIVEDU';
        $sms_text = urlencode('Hello People, have a great day');

        //Submit to server

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms.arasko.com/app/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=" . $api_key . "&campaign=10800&routeid=7&type=text&contacts=" . $contacts . "&senderid=" . $from . "&msg=" . $sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }

    function getQualification_get() {
        $set_qualification_category = $this->Curd_model->get("set_qualification_category");
        $set_qualification_dict = [];
        foreach ($set_qualification_category as $key => $value) {
            $sub_category = $this->Curd_model->getByForeignKey("set_qualification", "category_id", $value['id']);
            foreach ($sub_category as $skey => $svalue) {
                $svalue["group"] = $value["title"];
                array_push($set_qualification_dict, $svalue);
            }
        }
        $this->response($set_qualification_dict);
    }

    function getProfession_get() {
        $set_profession_category = $this->Curd_model->get("set_profession_category");
        $set_profession_dict = [];
        foreach ($set_profession_category as $key => $value) {
            $sub_category = $this->Curd_model->getByForeignKey("set_profession", "category_id", $value['id']);
            foreach ($sub_category as $skey => $svalue) {
                $svalue["group"] = $value["title"];
                array_push($set_profession_dict, $svalue);
            }
        }
        $this->response($set_profession_dict);
    }

    function professionSector_get() {
        $set_profession_sector = $this->Curd_model->get("set_profession_sector");
        array_push($set_profession_sector, array("id" => "", "title" => ""));
        $this->response($set_profession_sector);
    }

    function getTableData_get($tablename) {
        $set_profession_sector = $this->Curd_model->get($tablename);
        $this->response($set_profession_sector);
    }

    //add profile from mobile app

    function addBaseProfile_post() {
        $shadidata = $this->post();
        $shadidata['status'] = "Active";
        $this->db->insert("shadi_profile", $shadidata);
        $last_id = $this->db->insert_id();
        $profile_id = "SMC" . date("Ymd") . $last_id;
        $this->db->where("id", $last_id);
        $this->db->set("member_id", $profile_id);
        $this->db->update("shadi_profile");

        $this->db->where("member_id", $profile_id);
        $query = $this->db->get("shadi_profile");
        $resultdata = $query->row();
        $this->response($resultdata);
    }

    function updateProfile_post() {
        $shadidata = $this->post();
        $profile_id = $shadidata["member_id"];
        unset($shadidata["member_id"]);

        $this->db->where("member_id", $profile_id);
        $this->db->set($shadidata);
        $this->db->update("shadi_profile");

        $this->db->where("member_id", $profile_id);
        $query = $this->db->get("shadi_profile");
        $resultdata = $query->row();
        $this->response($resultdata);
    }

    function getShadiProfileAuth_get($profile_id) {
        $this->db->where("member_id", $profile_id);

        $query = $this->db->get("shadi_profile_contact");
        $profileContact = $query->result_array();
        $contactarray = array();
        foreach ($profileContact as $key => $value) {
            array_push($contactarray, $value);
        }

        $this->response($contactarray);
    }

    function memberLogin_get() {
        $mobile_no = $this->get("mobile");
        $this->db->where("contact_no", $mobile_no);
        $query = $this->db->get("member_users");
        $restul = $query->row();

        $otpcheck = rand(1000, 9999);
        $this->db->set('otp', $otpcheck);
        $this->db->where('contact_no', $mobile_no);
        $this->db->update('member_users');
        $api_key = '56038B83D0D233';
        $testmode = 0;
        $from = 'SHADMC';
        $message = "$otpcheck is your OTP to login to shadimychoice.com";
        if ($testmode == 0) {
            $sms_text = urlencode($message);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://sms.arasko.com/app/smsapi/index.php");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "key=" . $api_key . "&campaign=10800&routeid=7&type=text&contacts=" . $mobile_no . "&senderid=" . $from . "&msg=" . $sms_text);
            $response = curl_exec($ch);
            curl_close($ch);
            $strvrfy = $response;
//            print_r($strvrfy);
        }


        if ($restul) {
            $this->Shadi_model->sendOTPEmail($restul->email, $message);
            $data = array("status" => "success");
        } else {
            $data = array("status" => "filed");
        }
        $this->response($data);
    }

    function checkMemberLogin_get() {
        $mobile_no = $this->get("mobile");
        $password = $this->get("otp");
        $this->db->where("otp", $password);
        $this->db->where("contact_no", $mobile_no);
        $query = $this->db->get("member_users");
        $userdata = $query->row();

        if ($userdata) {
            $this->db->where("user_id", $memberdata->id);
            $query = $this->db->get("shadi_profile");
            $memberdata = $query->row();
            $userdata->member_profile_id = $memberdata->member_id;
        }
        if ($userdata) {
            $data = array("status" => "success", "userdata" => $userdata);
        } else {
            $data = array("status" => "filed");
        }
        $this->response($data);
    }

    function membersList_get($limit = 10, $start = 0) {



        $search = "";

        //        $search = $this->input->get("search")['value'];

        $managerfilter = "";


        $searchfilter = "";



        $this->db->select("member_id, career_income, religion, career_sector, career_profession, "
                . "family_location_state, mother_tongue, family_location_city, high_qualification");

        $this->db->where("status", "active");

        $this->db->order_by("id desc");
        $this->db->limit($limit, $start);
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

}
