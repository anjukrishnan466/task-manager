<?php
class Task_model extends CI_Model {


     public function get_tasks() {
        $this->db->order_by('due_date', 'ASC');
        return $this->db->get_where('tasks', array('status' => 'pending'))->result();
    }

    public function add_task($title, $due_date, $priority) {
        $this->db->insert('tasks', [
            'title' => $title,
            'due_date' => $due_date,
            'priority' => $priority,
            'status' => 'pending'
        ]);
    }

    public function mark_completed($id) {
        $this->db->where('id', $id)->update('tasks', ['status' => 'completed']);
    }

    public function get_counts() {
        return [
            'total' => $this->db->count_all('tasks'),
            'pending' => $this->db->where('status', 'pending')->count_all_results('tasks'),
            'completed' => $this->db->where('status', 'completed')->count_all_results('tasks'),
        ];
    }
}
 