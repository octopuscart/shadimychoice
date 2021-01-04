<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class LocalApi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->checklogin = $this->session->userdata('logged_in');
        $this->load->model('Order_model');
        $this->load->model('Curd_model');
        $this->userdata = $this->session->userdata('logged_in');
    }

    function testGet_get() {
        print_r($this->checklogin['user_type']);
    }

    //function for user settingt
    function updateUserSession_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_users", $data);
            if (isset($this->checklogin[$fieldname])) {

                $this->checklogin[$fieldname] = $value;
                $this->session->set_userdata('logged_in', $this->checklogin);
            }
        }
    }

    function updateUserClient_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_users", $data);
        }
    }

    function updateUser() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');

        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_user", $data);
        }
    }

    function updateAppointment_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update('events', $data);
        }
    }

    function updateAppointmentTime_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update('events_dates', $data);
        }
    }

    //function for curd update
    function updateCurd_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('tablename');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($tablename, $data);
        }
    }

    //function for curd update
    function curd_get($table_name) {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($table_name, $data);
        }
    }

    //function for product list
    function deleteCurd_post($table_name) {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($table_name, $data);
        }
    }

    //function for curd update
    function cartUpdate_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $quantity = $this->post('quantity');
        $totalPrice = (intval($quantity) * intval($value));
        if ($this->checklogin) {
            $data = array($fieldname => $value, "total_price" => "$totalPrice");
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("cart");

            $this->db->where('id', $pk_id);
            $query = $this->db->get('cart');
            $cart_items = $query->row();

            $order_details = $this->Order_model->recalculateOrder($cart_items->order_id);
        }
    }

    function notificationUpdate_get() {
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('system_log');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function getSimpleTableDataById_get($tablename, $foreignkey, $category_id) {
        $this->db->where($foreignkey, $category_id);
        $query = $this->db->get($tablename);
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function getSimpleTableDataByPrId_get($tablename, $idname, $mainid) {
        $this->db->where($idname, $mainid);
        $query = $this->db->get($tablename);
        $systemlog = $query->row();
        $this->response($systemlog);
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

    //shadiApi
    function profileListApi_get() {
        $userid = $this->userdata['login_id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $search = $this->input->get("search")['value'];

        $usertype = $this->userdata['user_type'];
        $managerfilter = "";
        if ($usertype == 'Admin') {
            
        } else {
            $managerfilter = " and manager_id = $userid ";
        }

        $searchfilter = "";
        if ($search) {
            $searchfilter = " and (name like '%$search%' or member_id like '%$search%') ";
        }


        $query = "SELECT member_id, name, gender, manager_id,
            scc.title as religion, sc.title as community,
            lss.title as state, lsc.title as city  FROM shadi_profile as sbp
left join set_states as lss on lss.id = sbp.family_location_state
left join set_cities as lsc on lsc.id = sbp.family_location_city
left join set_community_category as scc on scc.id = sbp.religion
left join set_community as sc on sc.id = sbp.community
where status = 'Active'  $searchfilter $managerfilter
order by sbp.id desc

limit $start, $length";
        $query1 = $this->db->query($query);
        $listcount = $query1->result_array();


        $query = $this->db->get("shadi_profile");
        $profilecount = $query->result_array();


        $profilelist = array();
        $counter = 1;
        foreach ($listcount as $key => $value) {
            $profile = $value;
            $manager_id = $value['manager_id'];
            $this->db->where("id", $manager_id);
            $query = $this->db->get("admin_users");
            $manager = $query->row_array();
            if ($manager) {
                $profile["manager"] = $manager['first_name']. " ".$manager['last_name'];
            }
            $profileiamge = $this->getProfilePhoto($value['member_id']);
            $profile['profileimage'] = $profileiamge;

            $profile['location'] = $value['city'] . ", " . $value['state'];
            $profile['cast'] = $value['community'] . " (" . $value['religion'] . ")";
            $profile['sn'] = $counter;
            $profile['edit'] = '<a href="' . site_url('ShadiProfile/viewProfile/' . $value['member_id']) . '" class="btn btn-danger"><i class="fa fa-view"></i> View Profile</a>';
            $counter++;
            array_push($profilelist, $profile);
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query1->num_rows(),
            "data" => $profilelist
        );
        $this->response($output);
    }

    function getShadiProfileById_get($member_id) {
        $this->db->where("member_id", $member_id);
        $query = $this->db->get("shadi_profile");
        $basicdata = $query->row();

        $profileiamge = $this->getProfilePhoto($member_id);
        $basicdata->profile_photo = $profileiamge;

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

    //function for curd update
    function deleteShadiProfileById_post() {
        $member_id = $this->post('member_id');
        if ($this->checklogin) {
            $this->db->set(array("status" => "Delete"));
            $this->db->where("member_id", $member_id);
            $this->db->update("shadi_profile");
            $this->response(array("url" => site_url("ShadiProfile/listOfProfile")));
        }
    }

    function getShadiProfilePhotos_get($profile_id) {
        $this->db->where("member_id", $profile_id);
        $this->db->order_by("display_index");
        $query = $this->db->get("shadi_profile_photos");
        $profilePhotos = $query->result_array();
        $photoarray = array();
        foreach ($profilePhotos as $key => $value) {
            array_push($photoarray, $value);
        }

        $this->db->where("member_id", $profile_id);
        $query = $this->db->get("shadi_profile");
        $basicdata = $query->row();
        $profileiamge = $this->getProfilePhoto($profile_id);
        $basicdata->profile_photo = $profileiamge;

        $this->response(array("photos" => $photoarray, "profile" => $basicdata));
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
        $profileiamge = $this->getProfilePhoto($profile_id);
        $basicdata->profile_photo = $profileiamge;

        $this->response(array("contact" => $contactarray, "profile" => $basicdata));
    }

}

?>