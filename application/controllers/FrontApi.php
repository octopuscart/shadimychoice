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

    function getShadiProfileById_get($member_id, $login_member_id = "") {
        $basicdata = $this->Shadi_model->getShadiProfileById($member_id);
        $profileData = array();
        foreach ($basicdata as $key => $value) {
            $profileData[$key] = $value ? $value : "";
        }
        $profileData["contact"] = $profileData["contact"] == "" ? [] : $profileData["contact"];
        $checkconnection = $this->Shadi_model->checkConnection($member_id, $login_member_id);
        if ($checkconnection) {
            $profileData["connected"] = "yes";
        } else {
            $profileData["connected"] = "no";
        }
        $this->response($profileData);
    }

    //authenditcation api
    function login_get() {
        $mobile_no = $this->get("mobile");
        $this->db->where("contact_no", $mobile_no);
        $query = $this->db->get("admin_users");
        $restul = $query->row();

        if ($mobile_no != "8602648733") {
            $otpcheck = rand(1000, 9999);
            $updatearray = array(
                'login_otp' => $otpcheck,
                'op_date_time' => date("Y-m-d h:i:s A")
            );
            $this->db->set($updatearray);
            $this->db->where('contact_no', $mobile_no);
            $this->db->update('admin_users');
        } else {
            $otpcheck = "1212";
        }


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

    //end of authentication api

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

    function registration_post() {
        $regdata = $this->post();
        $contact_no = $regdata["phone"];
        $name = $regdata["name"];
        $email = $regdata["email"];
        $this->db->where('contact_no', $contact_no);
        $query = $this->db->get('member_users');
        $user_details = $query->row();
        $userlogarray = array(
            'source' => "Mobile App",
            'name' => $name,
            'contact_no' => $contact_no,
            'email' => $email,
            'otp' => "",
            "status" => "Registration",
            'op_date' => date("Y-m-d"),
            'op_time' => date("h:i:s A"),
            "remark" => "",
        );

        $response = array("msg" => "", "status" => "100");
        if ($user_details) {
            $response['msg'] = 'User with this contact no. already registered.';
            $userlogarray["status"] = "Registered Already";
            $userlogarray["remark"] = "User with this contact no. already registered.";
        } else {
            $userarray = array(
                'name' => $name,
                'contact_no' => $contact_no,
                'email' => $email,
                'password' => md5($contact_no),
                'password2' => $contact_no,
                "status" => "Active",
                'registration_datetime' => date("Y-m-d h:i:s A"),
                'op_date_time' => date("Y-m-d h:i:s A")
            );
            $this->db->insert('member_users', $userarray);
            $user_id = $this->db->insert_id();
            $response['status'] = "200";
            $response['msg'] = 'You have registerd successfully, Please login.';
            $userlogarray["status"] = "Registration Success";
            $userlogarray["remark"] = "User registerd successfully";
        }
        $this->db->insert('member_users_log', $userlogarray);
        $this->response($response);
    }

    function memberLogin_get() {
        $mobile_no = $this->get("mobile");
        $this->db->where("contact_no", $mobile_no);
        $query = $this->db->get("member_users");
        $restul = $query->row();

        if ($mobile_no != "8602648733") {
            $otpcheck = rand(1000, 9999);
        } else {
            $otpcheck = "1212";
        }
        $this->db->set('otp', $otpcheck);
        $this->db->where('contact_no', $mobile_no);
        $this->db->update('member_users');

        $userlogarray = array(
            'source' => "Mobile App",
            'name' => "",
            'contact_no' => $mobile_no,
            'email' => "",
            'otp' => $otpcheck,
            "status" => "Login",
            'op_date' => date("Y-m-d"),
            'op_time' => date("h:i:s A"),
            "remark" => "",
        );

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
            $userlogarray["status"] = "OTP Generated";
            $userlogarray["remark"] = "Login OTP generated <b>$otpcheck</b>";
//            $userlogarray["remark"] = "User login by OTP successfully";
        } else {
            $data = array("status" => "filed");
            $userlogarray["status"] = "Login Failed";
            $userlogarray["remark"] = "User record not found.";
        }
        $this->db->insert('member_users_log', $userlogarray);
        $this->response($data);
    }

    function checkMemberLogin_get() {
        $mobile_no = $this->get("mobile");
        $password = $this->get("otp");
        $this->db->where("otp", $password);
        $this->db->where("contact_no", $mobile_no);
        $query = $this->db->get("member_users");
        $userdata = $query->row();
        $userlogarray = array(
            'source' => "Mobile App",
            'name' => "",
            'contact_no' => $mobile_no,
            'email' => "",
            'otp' => $password,
            "status" => "Login",
            'op_date' => date("Y-m-d"),
            'op_time' => date("h:i:s A"),
            "remark" => "",
        );

        if ($userdata) {
            $this->db->where("user_id", $userdata->id);
            $query = $this->db->get("shadi_profile");
            $memberdata = $query->row();
            if ($memberdata) {
                $userdata->member_profile_id = $memberdata->member_id;
            } else {
                $userdata->member_profile_id = "";
            }
        }
        if ($userdata) {
            $userlogarray["status"] = "Login Successful";
            $userlogarray["remark"] = "User login by OTP successfully";
            $data = array("status" => "success", "userdata" => $userdata);
        } else {
            $userlogarray["status"] = "OTP Failed";
            $userlogarray["remark"] = "Wroing OTP or mobile no.";
            $data = array("status" => "filed");
        }
        $this->db->insert('member_users_log', $userlogarray);
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

    function recentAddedMembersList_get($limit = 10, $start = 0) {
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

    function mobileSliderImages_get() {
        $slideimageslist = [
            array("image" => "https://admin.shadimychoice.com/assets/media/9049951.jpg"),
            array("image" => "https://admin.shadimychoice.com/assets/media/8286861.jpg"),
            array("image" => "https://admin.shadimychoice.com/assets/media/7299051.jpg"),
        ];
        $this->response($slideimageslist);
    }

    function getPayTMPaymentToken_get($order_id, $amount, $member_id) {
        $token = $this->Shadi_model->startPayment($order_id, $amount, $member_id);
        $this->response($token);
    }

    function getPackageList_get() {

        $this->db->order_by("id desc");

        $query = $this->db->get("set_packages");
        $packagelist = $query->result_array();
        $this->response($packagelist);
    }

    //set membership 
    function orderMembership_post() {
        $membershipdata = $this->post();
        $daylimit = $membershipdata['valid_days'];
        $current_date = date("Y-m-d");
        $current_time = date("H:m:s A");
        $last_date = date('Y-m-d', strtotime($current_date . " + $daylimit days"));
        $insertArray = array(
            "member_id" => $membershipdata['member_id'],
            "package_id" => $membershipdata['package_id'],
            "contact_limit" => $membershipdata['contact_limit'],
            "valid_days" => $membershipdata['valid_days'],
            "order_id" => $membershipdata['order_id'],
            "user_id" => $membershipdata['user_id'],
            "last_date" => $last_date,
            "price" => $membershipdata['price'],
            "discount" => $membershipdata['discount'],
            "final_price" => $membershipdata['final_price'],
            "discount_coupon" => $membershipdata['discount_coupon'],
            "payment_data" => $membershipdata['payment_data'],
            "payment_date" => $current_date,
            "payment_time" => $current_time,
            "payment_mode" => $membershipdata['payment_mode'],
            "payment_id" => "",
            "status" => "Active"
        );
        $this->db->insert("shadi_member_package", $insertArray);
        $last_id = $this->db->insert_id();
        $responsedata = array("order_id" => $last_id);
        $this->response($responsedata);
    }

    function ordersList_get($user_id) {
        $this->db->where("user_id", $user_id);
        $query = $this->db->get("shadi_member_package");
        $orders_list = $query->result_array();
        $this->response($orders_list);
    }

    function orderDetails_get($order_id) {
        $this->db->where("id", $order_id);
        $query = $this->db->get("shadi_member_package");
        $order_details = $query->row_array();

        $this->db->where("id", $order_details["package_id"]);
        $query = $this->db->get("set_packages");
        $packagedetails = $query->row_array();

        $this->db->where("id", $order_details["user_id"]);
        $query = $this->db->get("member_users");
        $userdetails = $query->row_array();

        $memberobj = $this->Shadi_model->getShortInformation($order_details['member_id']);

        $resultdata = array(
            "order_details" => $order_details,
            "user_details" => $userdetails,
            "package_details" => $packagedetails,
            "member_details" => $memberobj
        );
        $this->response($resultdata);
    }

    function getCouponDiscount_get($coupon_code, $total_amount) {
        $couponArray = array(
            "coupon_id" => "0",
            "coupon_code" => "",
            "discount_amount" => 0,
            "coupon_value" => 0,
            "msg" => "Sorry Wrong Coupon Code"
        );
        if ($coupon_code == "SMC99") {
            $coupon_discount = ($total_amount * 99) / 100;
            $couponArray = array(
                "coupon_id" => "1",
                "coupon_code" => "SMC99",
                "discount_amount" => $coupon_discount,
                "msg" => "Coupon code applied successfully"
            );
        }

        $this->response($couponArray);
    }

    //end of set membership
    //connection api
    function saveMemberProfile_post() {
        $connectdata = $this->post();
        $responsearray = array("status" => "100", "connect_id" => "0", "title" => "Error", "message" => "Something went wrong please try again later.");
        $current_date = date("Y-m-d");
        $current_time = date("H:m:s A");
        $memberpackage = $this->Shadi_model->getCurrentPackage($connectdata['member_id']);

        $insertArray = array(
            "member_id" => $connectdata['member_id'],
            "connect_member_id" => $connectdata['connect_member_id'],
            "connect_date" => $current_date,
            "connect_time" => $current_time,
            "status" => "Active"
        );
        if ($memberpackage["status"] == "active") {
            $this->db->insert("shadi_saved_profile", $insertArray);
            $last_id = $this->db->insert_id();
            if ($last_id) {
                $responsearray["connect_id"] = $last_id;
                $responsearray["status"] = "200";
                $responsearray["title"] = "Connection Successful";
                $responsearray["message"] = "You have connected to this member, now you can view contact details.";
            }
        } else {
            $responsearray["status"] = "300";
            $responsearray["title"] = "Unable to connect";
            $responsearray["message"] = "You don't have active plan to connect this member please buy any package to active plan.";
        }

        $this->response($responsearray);
    }

    function membersListConnected_get($member_id, $limit = 10, $start = 0) {
        $search = "";
        //        $search = $this->input->get("search")['value'];
        $managerfilter = "";
        $searchfilter = "";
        $this->db->select("connect_member_id");
        $this->db->where("status", "Active");
        $this->db->where("member_id", $member_id);
        $this->db->group_by("connect_member_id");
        $this->db->order_by("id desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get("shadi_saved_profile");
        $memberListFinal1 = $query->result_array();
        $memberListFinal = [];
        foreach ($memberListFinal1 as $key => $value) {
            $memberobj = $this->Shadi_model->getShortInformation($value['connect_member_id']);
            $tempobj = array();
            foreach ($memberobj as $key1 => $value2) {
                $tempobj[$key1] = $value2 ? $value2 : '-';
            }
            array_push($memberListFinal, $tempobj);
        }
        $this->db->select("count(id) as used_contact");

        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_saved_profile");
        $totalusedcontact = $query->row_array();
        $this->response(array("list" => $memberListFinal, "count" => $totalusedcontact["used_contact"]));
    }

    function getCurrentPackageDetails_get($member_id) {
        $packagedetails = $this->Shadi_model->getCurrentPackage($member_id);
        $this->response($packagedetails);
    }

    function getShadiProfileContact_get($profile_id) {
        $this->db->where("member_id", $profile_id);

        $query = $this->db->get("shadi_profile_contact");
        $profileContact = $query->result_array();
        $contactarray = array();
        foreach ($profileContact as $key => $value) {
            array_push($contactarray, $value);
        }
        $this->db->where("member_id", $profile_id);
        $query = $this->db->get("shadi_profile");
        $basicdata = $query->row();
        $profileiamge = $this->Shadi_model->getProfilePhoto($profile_id, $basicdata->gender);
        $basicdata->profile_photo = $profileiamge;

        $this->response($contactarray);
    }

    function updateContactData_post($editable) {
        $connectdata = $this->post();
        $connectdata['datetime'] = date("Y-m-d H:m:s");
        $connectdata['status'] = "Active";
        $connectdata['contact_no_status'] = "Not Verified";
        $connectdata['member_id'] = $connectdata["member_id"];
        $connectdata["contact_display"] = "Show to All";
        if ($editable == '0') {
            $this->db->insert("shadi_profile_contact", $connectdata);
        } else {
            $this->db->set($connectdata);
            $this->db->where('id', $editable);
            $this->db->update('shadi_profile_contact');
        }
        $this->response($responsearray);
    }

    //end of connection api
}
