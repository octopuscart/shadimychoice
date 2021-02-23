<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shadi_model extends CI_Model {

    function __construct() {
        parent::__construct();
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

    function getProfilePhoto($member_id, $gender) {
        $defaultimageexe = $gender == 'Male' ? 'male.jpg' : 'female.jpg';
        $defaultImage = base_url() . "assets/emoji/$defaultimageexe";
        $this->db->where("member_id", $member_id);
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

            $defaultImage = $baselinkmain . "assets/profile_image/" . $profilephoto->image;
        }
        return $defaultImage;
    }

    function getProfilePhotoAll($member_id, $gender) {
//        echo "===".$gender."===";
        $defaultimageexe = $gender == 'Male' ? 'male.jpg' : 'female.jpg';
        $defaultImage = base_url() . "assets/emoji/$defaultimageexe";
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
        $imagelist = [];
        foreach ($profilephoto as $key => $value) {
            $image = $baselinkmain . "assets/profile_image/" . $value->image;
            array_push($imagelist, $image);
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
where status = 'Active' and member_id = '$member_id'
order by sbp.id desc";
        $query_m = $this->db->query($query);
        $profile = $query_m->row_array();
        $profile["community"] = $profile["community"] ? $profile["community"]:"-";
     
        $profile_image = $this->getProfilePhoto($member_id, $profile["gender"]);
        $profile['profile_image'] = $profile_image;
        return $profile;
    }

}

?>