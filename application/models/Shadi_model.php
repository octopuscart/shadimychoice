<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/Paytm/PaytmChecksum.php');

class Shadi_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $test = 0;
        if ($test == 1) {
            $this->MID = "kPXSdS51683887501020";
            $this->MKEY = "1yJH@wbgVVEEhOye";
            $this->WEBSITE = "WEBSTAGING";
            $this->Industry = "Retail";
            $this->ChannelId_web = "WEB";
            $this->ChannelId_wap = "WAP";
            $this->endpoint = "https://securegw-stage.paytm.in/theia/api/v1/";
        } else {
            $this->MID = "JExSZL42779741544455";
            $this->MKEY = "03r48Nx2_UY@p5bW";
            $this->WEBSITE = "DEFAULT";
            $this->Industry = "Retail";
            $this->ChannelId_web = "WEB";
            $this->ChannelId_wap = "WAP";
            $this->endpoint = "https://securegw.paytm.in/theia/api/v1/";
        }
    }

    function getTableIformation($table_name, $listid) {
        $templist = [];
        foreach ($listid as $key => $value) {
            if ($key) {
                array_push($templist, $key);
            }
        }
        $this->db->where_in("id", $templist);
        $query = $this->db->get($table_name);
        $returndata = $query->result_array();
        $returndatatemp = array();
        foreach ($returndata as $key => $value) {
            if (isset($listid[$value['id']])) {
                $value['count'] = $listid[$value['id']];
                $returndatatemp[$value['id']] = $value;
            }
        }
        $finaldata = array();
        foreach ($listid as $key => $value) {
            if (isset($returndatatemp[$key])) {
                array_push($finaldata, $returndatatemp[$key]);
            } else {
                $nsp = array("title" => "Not Spacified", "count" => $value, "id" => 0);
                array_push($finaldata, $nsp);
            }
        }
        return $finaldata;
    }

    function getProfilePhoto($member_id, $gender, $list_type = "private") {
        $this->db->where("member_id", $member_id);
        if ($list_type == "public") {
            $this->db->where("photo_status!=", "inactive");
        }
        $this->db->where("status", "profile");
        $query = $this->db->get("shadi_profile_photos");
        $profilephoto = $query->row();
        if ($profilephoto) {
            $baselink = 'http://' . $_SERVER['SERVER_NAME'];
            switch ($baselink) {
                case "http://localhost":
                    $baselinkmain = "https://admin.shadimychoice.com/";
                    break;
                case "http://192.168.1.3":
                    $baselinkmain = "https://admin.shadimychoice.com/";
                    break;
                default:
                    $baselinkmain = base_url();
            }
            $baselinkmain = base_url();
            $defaultImage = $baselinkmain . "assets/profile_image/" . $profilephoto->image;
        } else {
            $defaultimageexe = $gender == 'Male' ? 'male.jpg' : 'female.jpg';
            $defaultImage = base_url() . "assets/emoji/$defaultimageexe";
        }

        return $defaultImage;
    }

    function getProfilePhotoAll($member_id, $gender = "Male", $list_type = "private") {
//        echo "===".$gender."===";
        if ($list_type == "public") {
            $this->db->where("photo_status!=", "inactive");
        }
        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile_photos");
        $profilephoto = $query->result();
        $baselink = 'http://' . $_SERVER['SERVER_NAME'];
        switch ($baselink) {
            case "http://localhost":
                $baselinkmain = "https://admin.shadimychoice.com/";
                break;
            case "http://192.168.1.3":
                $baselinkmain = "https://admin.shadimychoice.com/";
                break;
            default:
                $baselinkmain = base_url();
        }
        $baselinkmain = base_url();
        $imagelist = [];
        if ($profilephoto) {
            foreach ($profilephoto as $key => $value) {
                $image = $baselinkmain . "assets/profile_image/" . $value->image;
                array_push($imagelist, $image);
            }
        } else {
            $defaultimageexe = $gender == 'Male' ? 'male.jpg' : 'female.jpg';
            $defaultImage = base_url() . "assets/emoji/$defaultimageexe";
            array_push($imagelist, $defaultImage);
        }
        return $imagelist;
    }

    function getShortInformation($member_id) {
        $query = "SELECT member_id, name, gender, manager_id, height, father_name, marital_status,
 prof.title as profession, profc.title as profession_category, ai.title as income ,      
lsc.title as city, lss.title as state,
DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')) AS age,
            scc.title as religion, sc.title as community, prof.title as profession, profc.title as profession_category,
            lss.title as state, lsc.title as city  FROM shadi_profile as sbp
left join set_states as lss on lss.id = sbp.family_location_state
left join set_cities as lsc on lsc.id = sbp.family_location_city
left join set_community_category as scc on scc.id = sbp.religion
left join set_community as sc on sc.id = sbp.community
left join set_profession as prof on sbp.career_profession = prof.id
left join set_profession_category as profc on profc.id = prof.category_id

left join  set_annual_income as ai on ai.id = sbp.career_income
where  member_id = '$member_id'
order by sbp.id desc";
        $query_m = $this->db->query($query);
        $profile = $query_m->row_array();
        $profile["community"] = $profile["community"] ? $profile["community"] : "-";

        $profile_image = $this->getProfilePhoto($member_id, $profile["gender"], "public");
        $profile['profile_image'] = $profile_image;
        $resutdata = array();
        foreach ($profile as $key => $value) {
            $resutdata[$key] = $value ? $value : "";
        }
        return $resutdata;
    }

    function getProfileContact($member_id) {
        $this->db->where("contact_no!=", "");
        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile_contact");
        $contacts = $query->result_array();

        return $contacts;
    }

    function daysBetween($dt1, $dt2) {
        return date_diff(
                        date_create($dt2),
                        date_create($dt1)
                )->format('%a');
    }

    function checkConnection($member_id, $login_member_id) {
        $this->db->where("member_id", $login_member_id);
        $this->db->where("connect_member_id", $member_id);
        $query = $this->db->get("shadi_saved_profile");
        $checkconnection = $query->row_array();
        return $checkconnection;
    }

    function getCurrentPackage($member_id) {
        $current_date = date("Y-m-d");
        $this->db->select("package_id, last_date, valid_days, sum(contact_limit) as total_contacts, '' as title, '0' as validity, '' as image   ");
        $this->db->where("member_id", $member_id);
        $this->db->where("last_date>", $current_date);
        $this->db->order_by("id desc");
        $this->db->limit(1);
        $query = $this->db->get("shadi_member_package");
        $packageobj = $query->row_array();
        if ($packageobj["total_contacts"]) {
            $packageobj["status"] = "active";
        } else {
            $packageobj["status"] = "inactive";
            $packageobj["total_contacts"] = "0";
            $packageobj["last_date"] = "";
            $packageobj["package_id"] = "";
            $packageobj["valid_days"] = "";
        }
        $packageobj["contact_left"] = 0;
        $packageobj["contact_used"] = 0;
        if ($packageobj["status"] == "active") {
            $this->db->where("id", $packageobj["package_id"]);
            $query = $this->db->get("set_packages");
            $packagedetails = $query->row_array();
            $packageobj["title"] = $packagedetails["title"];
            $packageobj["image"] = $packagedetails["image"];
            $packageobj["validity"] = $this->daysBetween($current_date, $packageobj["last_date"]);

            $this->db->select("count(id) as used_contact");
            $this->db->where("member_id", $member_id);
//            $this->db->group_by("connect_member_id");
            $query = $this->db->get("shadi_saved_profile");
            $totalusedcontact = $query->row_array();
            $usedcontact = $totalusedcontact["used_contact"];
            $packageobj["contact_used"] = $usedcontact;
            $totalleft = ($packageobj["total_contacts"] - $usedcontact);
            if ($totalleft > 0) {
                
            } else {
                $packageobj["status"] = "inactive";
            }
            $packageobj["contact_left"] = "" . $totalleft;
        }
        return $packageobj;
    }

    function getShadiProfileById($member_id) {
        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile");
        $basicdata = $query->row();

        $contactdata = $this->getProfileContact($member_id);
        $basicdata->contact = $contactdata;

        $profileiamge = $this->getProfilePhoto($member_id, $basicdata->gender);
        $basicdata->profile_photo = $profileiamge;

        $basicdata->profilepackage = $this->getCurrentPackage($member_id);

        $basicdata->profile_photo_all = $this->getProfilePhotoAll($member_id, $basicdata->gender);

        $basicdata->steps = $this->checkProfileCompletion($member_id);
        $basicdata->status = $basicdata->steps["status"];

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
        $basicdata->mother_tongue_title = $mother_tongue ? $mother_tongue->title : "";
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




        $ressultdata = array();
        foreach ($basicdata as $key => $value) {
            $ressultdata[$key] = $value ? $value : "";
        }

        //end fo profession
        return $ressultdata;
    }

    function checkProfileCompletion($member_id) {
        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile");
        $basicdata = $query->row();
        $completStepts = array();
        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile_photos");
        $profilephoto = $query->result();

        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile_contact");
        $profileContact = $query->result_array();

        $sttepdata = array("status" => $basicdata->status);

        if ($profileContact) {
            
        } else {
            array_push($completStepts, array("title" => "Please add contact Information", "link" => "ShadiProfile/profileContact/$member_id"));
        }
        if ($profilephoto) {
            
        } else {
            array_push($completStepts, array("title" => "Add your phots", "link" => "ShadiProfile/profilePhotos/$member_id"));
        }
        if ($basicdata->father_name == "") {
            array_push($completStepts, array("title" => "Add your family details", "link" => "ShadiProfile/editMemberProfile/$member_id?family"));
        }


        $basicparameter = array(
            "height" => "Your Height",
            "mother_tongue" => "Mother Tongue",
            "community" => "Community",
            "birth_location_city" => "Birth Location",
            "father_status" => "Father Working Status",
            "mother_status" => "Mother Working Status",
            "family_type" => "Family Type",
            "family_value" => "Family Value",
            "family_affluence" => "Family Affluence"
        );
        foreach ($basicparameter as $key => $value) {
            if ($basicdata->$key == "") {
                array_push($completStepts, array("title" => "$value", "link" => "ShadiProfile/editMemberProfile/$member_id?family"));
            }
        }
        $totalsteps = 10;
        $totalpercentt = $totalsteps - count($completStepts);
        $totalpercent = ($totalpercentt * 100) / $totalsteps;
        if ($totalpercent == 100) {
//            $this->db->where("member_id", $member_id);
//            $this->db->set(array("status" => "Review"));
//            $this->db->update("shadi_profile_photos");
            $sttepdata['status'] = "Review";
        }

//        print_r($completStepts);
        return $sttepdata;
    }

    function sendOTPEmail($email, $message) {

        setlocale(LC_MONETARY, 'en_US');
        $emailsender = EMAIL_SENDER;
        $sendername = EMAIL_SENDER_NAME;
        $email_bcc = EMAIL_BCC;
        $this->email->from(EMAIL_BCC, $sendername);
        $this->email->to($email);
        $this->email->bcc(EMAIL_BCC);
        $subject = "Login OTP for Shadimychoice.com";
        $this->email->subject($subject);
        $checkcode = REPORT_MODE;
        $this->email->message("$message", array(), true);
        $this->email->print_debugger();
        $result = $this->email->send();
    }

    private function useCurl($url, $headers, $fields = null, $post = true) {
        // Open connection
        $ch = curl_init();
        if ($url) {
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            if ($fields) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            }
            // Execute post
            $result = curl_exec($ch);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
            // Close connection
            curl_close($ch);
            $curldata = array("result" => $result, "headers" => $header_size);

            $response = $curldata['result'];
            $header_size = $curldata['headers'];
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $codehas = $response;

            $returnbody = json_decode($body, true);
            return $returnbody;
        }
    }

    public function createSignature() {
        /* initialize an array */
        $paytmParams = array();
        $orderid = "SMC" . date("YMDHMS");

        /* add parameters in Array */
        $paytmParams["MID"] = $this->MID;
        $paytmParams["ORDERID"] = $orderid;

        /**
         * Generate checksum by parameters we have
         * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
         */
        $paytmChecksum = PaytmChecksum::generateSignature($paytmParams, $this->MKEY);
        return array("order_id" => $orderid, "paytmChecksum" => $paytmChecksum);
    }

    public function startPayment($order_id, $amount, $member_id) {
        $mid = $this->MID;
//        $orderid = "SMC" . date("Ymdhms");
        $mkey = $this->MKEY;
        $paytmParams = array();
        $paytmParams["body"] = array(
            "requestType" => "Payment",
            "mid" => "$mid",
            "websiteName" => $this->WEBSITE,
            "orderId" => $order_id,
            "callbackUrl" => "https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=$order_id",
            "txnAmount" => array(
                "value" => $amount,
                "currency" => "INR",
            ),
            "userInfo" => array(
                "custId" => $member_id,
            ),
            "disablePaymentMode" => [array("mode" => "BALANCE"), array("mode" => "PPBL")]
        );
        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $mkey);
        $paytmParams["head"] = array(
            "signature" => $checksum
        );
        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
        $url = $this->endpoint . "/initiateTransaction?mid=$mid&orderId=$order_id";
        $response = $this->useCurl($url, array("Content-Type: application/json"), $post_data);
        return $response["body"];
    }

}

?>