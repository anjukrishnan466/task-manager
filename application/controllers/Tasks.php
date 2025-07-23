<?php
 class Tasks extends CI_Controller {
      /**
     * Constructor for the Tasks controller.
     * Loads the Task_model, form and URL helpers, and session library.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }
  /**
     * Displays the list of tasks.
     * Allows filtering by status, sorting by due date or other fields, and ordering.
     * Loads the 'tasks_view' with the relevant data.
     */
    public function index() {
        $status = $this->input->get('status') ?? 'pending';
        $sort = $this->input->get('sort') ?? 'due_date';
        $order = $this->input->get('order') ?? 'asc';

        $data['tasks'] = $this->Task_model->get_tasks($status, $sort, $order);
        $data['counts'] = $this->Task_model->get_counts();
        $data['status'] = $status;
        $data['sort'] = $sort;
        $data['order'] = $order;

        $this->load->view('tasks_view', $data);
    }
/**
     * Loads the form view for adding a new task.
     */
    public function add() {
        $this->load->view('add_task');
    }
 /**
     * Handles the submission of a new task.
     * Validates the due date to ensure it is not in the past.
     * Adds the task to the database if valid, otherwise sets an error message.
     * Redirects back to the tasks list.
     */
    public function store() {
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
 /**
     * Marks a specific task as completed.
     * @param int $id The ID of the task to mark as completed.
     * Redirects back to the tasks list.
     */
    public function complete($id) {
        $this->Task_model->mark_completed($id);
        redirect('tasks');
    }
}