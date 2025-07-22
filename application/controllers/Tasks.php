<?php
  class Tasks extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

    public function index() {
        $data['tasks'] = $this->Task_model->get_tasks();
        $data['counts'] = $this->Task_model->get_counts();
        $this->load->view('tasks_view', $data);
    }

    public function add() {
        $title = $this->input->post('title');
        $due_date = $this->input->post('due_date');
        $priority = $this->input->post('priority');

        if (strtotime($due_date) < time()) {
            $this->session->set_flashdata('error', 'Due date cannot be in the past.');
        } else {
            $this->Task_model->add_task($title, $due_date, $priority);
        }
        redirect('tasks');
    }

    public function complete($id) {
        $this->Task_model->mark_completed($id);
        redirect('tasks');
    }
}
 