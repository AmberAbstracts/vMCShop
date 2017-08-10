<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * Created with ♥ by Verlikylos on 25.07.2017 22:45.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
*/

class Services extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {

        if (!$this->session->userdata('logged')) redirect(base_url());

        /**  Head Section  */

        $header_data['page_title'] = $this->config->item('page_title') . " | Usługi";

        $this->load->view('panel/components/Header', $header_data);


        /**  Body Section  */

        $this->load->model('ServicesModel');
        $this->load->model('ServersModel');
        $this->load->library('form_validation');
        $this->load->helper('smsnumbers_helper');

        $services = $this->ServicesModel->getAll();
        $bodyData['smsnumbers'] = getSmsNumbers();
        $bodyData['servers'] = $this->ServersModel->getAll();
        $bodyData['services'] = array();

        foreach ($bodyData['servers'] as $server) {

            foreach ($services as $service) {

                if ($service['server'] == $server['id']) {

                    $service['server'] = $server['name'];
                    $service['commands'] = explode(';', $service['commands']);

                    array_push($bodyData['services'], $service);

                }

            }

        }

        $this->load->view('panel/Services', $bodyData);


        /**  Footer Section  */

        $this->load->view('panel/components/Footer');

    }

    public function create() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('serviceName', 'serviceName', 'required|trim');
        $this->form_validation->set_rules('serviceServer', 'serviceServer', 'required|trim');
        $this->form_validation->set_rules('serviceDesc', 'serviceDesc', 'required|trim');
        $this->form_validation->set_rules('serviceSmsChannel', 'serviceSmsChannel', 'required|trim');
        $this->form_validation->set_rules('serviceSmsChannelId', 'serviceSmsChannelId', 'required|trim');
        $this->form_validation->set_rules('serviceSmsNumber', 'serviceSmsNumber', 'required|trim');
        $this->form_validation->set_rules('servicePaypalCost', 'servicePaypalCost', 'required|trim');
        $this->form_validation->set_rules('serviceCommands', 'serviceCommands', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $data['server'] = $this->input->post('serviceServer');
            $data['name'] = $this->input->post('serviceName');
            $data['description'] = $this->input->post('serviceDesc');
            $data['sms_channel'] = $this->input->post('serviceSmsChannel');
            $data['sms_channel_id'] = $this->input->post('serviceSmsChannelId');
            $data['sms_number'] = $this->input->post('serviceSmsNumber');
            $data['paypal_cost'] = $this->input->post('servicePaypalCost');
            $data['commands'] = $this->input->post('serviceCommands');

            $this->load->helper('string');

            $config['upload_path'] = './assets/images/services';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10240;
            $config['max_width'] = 360;
            $config['max_height'] = 360;
            $config['file_name'] = random_string('alnum', 16);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('serviceImage')) {

                $data['image'] = $this->upload->data('full_path');

            } else {

                $_SESSION['messageDanger'] = $this->upload->display_errors();
                redirect(base_url('panel/services'));

            }

            $this->load->model('ServicesModel');


            if (!$this->ServicesModel->add($data)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/services'));
            }

            $_SESSION['messageSuccess'] = "Pomyślnie utworzono usługę o nazwie <strong>" . $data['name'] . "</strong>!";
            redirect(base_url('panel/services'));
        } else {
            $_SESSION['messageDanger'] = "Proszę wypełnić wszystkie pola formularza!";
            redirect(base_url('panel/services'));
        }
    }

    public function remove() {
        if (!$this->session->userdata('logged')) redirect(base_url());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('serviceId', 'serviceId', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $serviceId = $this->input->post('serviceId');

            $this->load->model('ServicesModel');

            if (!$service = $this->ServicesModel->getByID($serviceId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
                redirect(base_url('panel/services'));
            }

            if (!$this->ServicesModel->delete($serviceId)) {
                $_SESSION['messageDanger'] = "Wystąpił błąd podczas łączenia z bazą danych!";
                redirect(base_url('panel/services'));
            }

            $_SESSION['messageSuccess'] = "Pomyślnie usunięto usługę o nazwie <strong>" . $service['name'] . " (ID:" . $service['id'] . ")</strong>!";
            redirect(base_url('panel/services'));
        } else {
            $_SESSION['messageDanger'] = "Wystąpił błąd, spróbuj jeszcze raz!";
            redirect(base_url('panel/services'));
        }
    }
}