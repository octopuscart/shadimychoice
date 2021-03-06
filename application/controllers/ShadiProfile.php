<?php

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ShadiProfile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Event_model');
        $this->curd = $this->load->model('Curd_model');
        $this->userdata = $this->session->userdata('logged_in');
        $this->load->model('Shadi_model');
    }

    public function addProfile() {

        $data = array("last_aid" => 1);
        $data['manager_id'] = $this->userdata['login_id'];

        //community
        $community_category = $this->Curd_model->get("set_community_category");
        $data['community_category'] = $community_category;

        //mother tounge
        $set_mother_tongue = $this->Curd_model->get("set_mother_tongue");
        $data['set_mother_tongue'] = $set_mother_tongue;

        //qualification
        $set_qualification_category = $this->Curd_model->get("set_qualification_category");
        $set_qualification_dict = array();
        foreach ($set_qualification_category as $key => $value) {
            $set_qualification_dict[$value['title']] = $this->Curd_model->getByForeignKey("set_qualification", "category_id", $value['id']);
        }
        $data['set_qualification_dict'] = $set_qualification_dict;

        //profession
        $set_profession_sector = $this->Curd_model->get("set_profession_sector");
        $data['set_profession_sector'] = $set_profession_sector;
        $set_profession_category = $this->Curd_model->get("set_profession_category");
        $set_profession_dict = array();
        foreach ($set_profession_category as $key => $value) {
            $set_profession_dict[$value['title']] = $this->Curd_model->getByForeignKey("set_profession", "category_id", $value['id']);
        }
        $data['set_profession_dict'] = $set_profession_dict;

        //income
        $set_annual_income = $this->Curd_model->get("set_annual_income");
        $data['set_annual_income'] = $set_annual_income;

        //city state
        $set_state = $this->Curd_model->get("set_states");
        $data['set_state'] = $set_state;

        if (isset($_POST['addmemeber'])) {
            $shadidata = $this->input->post();
            unset($shadidata['addmemeber']);
            $shadidata['status'] = "Active";
            $this->db->insert("shadi_profile", $shadidata);
            $last_id = $this->db->insert_id();
            $profile_id = "SMC" . date("Ymd") . $last_id;
            $this->db->where("id", $last_id);
            $this->db->set("member_id", $profile_id);
            $this->db->update("shadi_profile");
            redirect("ShadiProfile/viewProfile/" . $profile_id);
        }



        $this->load->view('shadiProfile/addProfile', $data);
    }

    function editMemberProfile($profile_id) {
        $data = array("profile_id" => $profile_id);
        //community
        $community_category = $this->Curd_model->get("set_community_category");
        $data['community_category'] = $community_category;

        //mother tounge
        $set_mother_tongue = $this->Curd_model->get("set_mother_tongue");
        $data['set_mother_tongue'] = $set_mother_tongue;

        //qualification
        $set_qualification_category = $this->Curd_model->get("set_qualification_category");
        $set_qualification_dict = array();
        foreach ($set_qualification_category as $key => $value) {
            $set_qualification_dict[$value['title']] = $this->Curd_model->getByForeignKey("set_qualification", "category_id", $value['id']);
        }
        $data['set_qualification_dict'] = $set_qualification_dict;

        //profession
        $set_profession_sector = $this->Curd_model->get("set_profession_sector");
        $data['set_profession_sector'] = $set_profession_sector;
        $set_profession_category = $this->Curd_model->get("set_profession_category");
        $set_profession_dict = array();
        foreach ($set_profession_category as $key => $value) {
            $set_profession_dict[$value['title']] = $this->Curd_model->getByForeignKey("set_profession", "category_id", $value['id']);
        }
        $data['set_profession_dict'] = $set_profession_dict;

        //income
        $set_annual_income = $this->Curd_model->get("set_annual_income");
        $data['set_annual_income'] = $set_annual_income;

        //city state
        $set_state = $this->Curd_model->get("set_states");
        $data['set_state'] = $set_state;


        if (isset($_POST['updatememeber'])) {
            $shadidata = $this->input->post();
            unset($shadidata['updatememeber']);

            $this->db->where("member_id", $profile_id);
            $this->db->set($shadidata);
            $this->db->update("shadi_profile");

            redirect("ShadiProfile/editMemberProfile/" . $profile_id);
        }

        $this->load->view('shadiProfile/editProfile', $data);
    }

    function listOfProfile() {
        $usertype = $this->userdata['user_type'];
        $data = array("usertype" => $usertype);
        $this->load->view('shadiProfile/listProfile', $data);
    }

    function viewProfile($profile_id) {
        $data = array("profile_id" => $profile_id);
        $this->load->view('shadiProfile/viewProfile', $data);
    }

    function profilePhotos($profile_id) {
        $data = array("profile_id" => $profile_id);
        $config['upload_path'] = 'assets/profile_image';
        $config['allowed_types'] = '*';
        if (isset($_POST['submit'])) {
            $picture = '';
            if (!empty($_FILES['picture']['name'])) {
                $temp1 = rand(100, 1000000);
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . $profile_id;

                $config['file_name'] = $file_newname;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }


            $post_data = array(
                'member_id' => $profile_id,
                'image' => $picture,
                'status' => "",
                'datetime' => date("Y-m-d H:m:s"),
                'display_index' => 0,
            );
            $this->db->insert('shadi_profile_photos', $post_data);
            redirect('ShadiProfile/profilePhotos/' . $profile_id);
        }

        if (isset($_POST['reindex'])) {
            $image_index = $this->input->post("image_index");
            $imageids = $this->input->post("image_id");
            foreach ($imageids as $key => $value) {
                $imgid = $imageids[$key];
                $imgidx = $image_index[$key];
                $indexarray = array(
                    "display_index" => $imgidx,
                );
                $this->db->where("id", $imgid);
                $this->db->set($indexarray);
                $this->db->update("shadi_profile_photos");
            }
            redirect('ShadiProfile/profilePhotos/' . $profile_id);
        }
        if (isset($_POST['profilePhoto'])) {
            $this->db->where("member_id", $profile_id);
            $this->db->where("status", "profile");
            $this->db->set(array("status" => ""));
            $this->db->update("shadi_profile_photos");
            $imageids = $this->input->post("photo_id");
            $indexarray = array(
                "status" => "profile",
            );
            $this->db->where("id", $imageids);
            $this->db->set($indexarray);
            $this->db->update("shadi_profile_photos");
            redirect('ShadiProfile/profilePhotos/' . $profile_id);
        }
        if (isset($_POST['deletePhoto'])) {


            $imageids = $this->input->post("photo_id");
            $this->db->where("id", $imageids);
            $this->db->delete("shadi_profile_photos");
            redirect('ShadiProfile/profilePhotos/' . $profile_id);
        }
        $this->load->view('shadiProfile/profilePhotos', $data);
    }

    function profilePhotosFrontEnd($profile_id) {
        $data = array("profile_id" => $profile_id);
        $config['upload_path'] = 'assets/profile_image';
        $config['allowed_types'] = '*';
        if (isset($_POST['submit'])) {
            $picture = '';
            if (!empty($_FILES['picture']['name'])) {
                $temp1 = rand(100, 1000000);
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . $profile_id;

                $config['file_name'] = $file_newname;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }


            $post_data = array(
                'member_id' => $profile_id,
                'image' => $picture,
                'status' => "",
                'datetime' => date("Y-m-d H:m:s"),
                'display_index' => 0,
                "photo_status" => "inactive",
            );
            $this->db->insert('shadi_profile_photos', $post_data);
            $siteurlredirect = $this->input->post("siteurl");
            redirect($siteurlredirect);
        }

        if (isset($_POST['reindex'])) {
            $image_index = $this->input->post("image_index");
            $imageids = $this->input->post("image_id");
            foreach ($imageids as $key => $value) {
                $imgid = $imageids[$key];
                $imgidx = $image_index[$key];
                $indexarray = array(
                    "display_index" => $imgidx,
                );
                $this->db->where("id", $imgid);
                $this->db->set($indexarray);
                $this->db->update("shadi_profile_photos");
            }
        }
        if (isset($_POST['profilePhoto'])) {
            $this->db->where("member_id", $profile_id);
            $this->db->where("status", "profile");
            $this->db->set(array("status" => ""));
            $this->db->update("shadi_profile_photos");
            $imageids = $this->input->post("photo_id");
            $indexarray = array(
                "status" => "profile",
            );
            $this->db->where("id", $imageids);
            $this->db->set($indexarray);
            $this->db->update("shadi_profile_photos");
        }
        if (isset($_POST['deletePhoto'])) {


            $imageids = $this->input->post("photo_id");
            $this->db->where("id", $imageids);
            $this->db->delete("shadi_profile_photos");
        }
    }

    function profileContact($profile_id) {
        $data = array("profile_id" => $profile_id);


        if (isset($_POST['deletecontact'])) {
            $contact_id = $this->input->post("contact_id");
            $this->db->where("id", $contact_id);
            $this->db->delete("shadi_profile_contact");
            redirect('ShadiProfile/profileContact/' . $profile_id);
        }

        if (isset($_POST['addcontact'])) {
            $shadidata = $this->input->post();
            unset($shadidata['addcontact']);
            $shadidata['datetime'] = date("Y-m-d H:m:s");
            $shadidata['status'] = "Active";
            $shadidata['member_id'] = $profile_id;
            $this->db->insert("shadi_profile_contact", $shadidata);
            redirect('ShadiProfile/profileContact/' . $profile_id);
        }

        $this->load->view('shadiProfile/profileContact', $data);
    }

    function downloadProfile($member_id, $viewtyp = "D") {
        $fieldsdata = [
            array(
                "title" => "Religious Background",
                "elements" => [
                    array("title" => "Religion", "field" => "religion_title"),
                    array("title" => "Community", "field" => "community_title"),
                    array("title" => "Other Religious", "field" => "other_religious_info"),
                    array("title" => "Mother Tongue", "field" => "mother_tongue_title"),
                ],
            ),
            array(
                "title" => "Horoscope Information",
                "elements" => [
                    array("title" => "Birth State", "field" => "birth_location_state_title"),
                    array("title" => "Birth City", "field" => "birth_location_city_title"),
                    array("title" => "Birth Time", "field" => "time_of_birth"),
                    array("title" => "Birth Date", "field" => "date_of_birth"),
                    array("title" => "Mangalik", "field" => "manglik_status"),
                ],
            ),
            array(
                "title" => "Education & Career",
                "elements" => [
                    array("title" => "Highest Qualification", "field" => "high_qualification_title"),
                    array(
                        "title" => "Qualification Field",
                        "field" => "high_qualification_category_title"
                    ),
                    array(
                        "title" => "Higher Edu. College/School",
                        "field" => "high_qualification_college"
                    ),
                    array("title" => "Qualification Details", "field" => "qualification_details"),
                    array("title" => "Working With ", "field" => "career_sector_title"),
                    array("title" => "Profession", "field" => "career_profession_title"),
                    array(
                        "title" => "Profession Area",
                        "field" => "career_profession_category_title"
                    ),
                    array("title" => "Working Position", "field" => "career_position"),
                    array("title" => "Employer Name", "field" => "career_employer"),
                    array("title" => "Annual Income ", "field" => "career_income_title"),
                ],
            ),
            array(
                "title" => "Family",
                "elements" => [
                    array("title" => "Father Name", "field" => "father_name"),
                    array("title" => "Work Stuatus", "field" => "father_status"),
                    array("title" => "Work Info", "field" => "father_work"),
                    array("title" => "Mother Name", "field" => "mother_name"),
                    array("title" => "Work Stuatus", "field" => "mother_status"),
                    array("title" => "Work Info", "field" => "mother_work"),
                    array("title" => "State", "field" => "family_location_state_title"),
                    array("title" => "City", "field" => "family_location_city_title"),
                    array("title" => "Married Brothers", "field" => "brother_married"),
                    array("title" => "Married Sisters", "field" => "sister_married"),
                    array("title" => "Unmarried Brothers", "field" => "brother_unmarried"),
                    array("title" => "Unmarried Sisters", "field" => "sister_unmarried"),
                ],
            ),
            array(
                "title" => "Family Type",
                "elements" => [
                    array("title" => "Living Type", "field" => "family_type"),
                    array("title" => "Family values", "field" => "family_value"),
                    array("title" => "Family Affluence", "field" => "family_affluence"),
                ]
            )
        ];
        $basicdata = $this->Shadi_model->getShadiProfileById($member_id);
        $profileData = array();
        foreach ($basicdata as $key => $value) {
            $profileData[$key] = $value ? $value : "";
        }
        
        $outputdata = array("fielddata" => $fieldsdata, "data" => $profileData);
        setlocale(LC_MONETARY, 'en_US');
        $this->load->helper('download');
        if (1) {
            error_reporting(0);

            $html = $this->load->view('Email/profile_pdf', $outputdata, true);
            $pdfFilePath = $member_id . ".pdf";
            $checkcode = 0;
            if ($checkcode == 1) {
                echo $html;
            } else {
                ob_get_clean();
                $filepath = base_url("assets/profile_pdf/$pdfFilePath");
                $filepath_abc =  APPPATH ."../assets/profile_pdf/$pdfFilePath";
                $this->load->library('m_pdf');
                $this->m_pdf->pdf->WriteHTML($html);
                $file = $this->m_pdf->pdf->Output($filepath_abc, $viewtyp);
                $data = file_get_contents($filepath_abc);
                //force download
                $fileName = "profile.pdf";
                force_download($fileName, $data);
            }
        }
    }

}
