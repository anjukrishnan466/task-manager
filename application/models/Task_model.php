<?php
class Task_model extends CI_Model
{

    public function get_tasks($status = 'pending', $sort = 'due_date', $order = 'asc')
    {
        if ($status !== 'all') {
            $this->db->where('status', $status);
        }
        $this->db->order_by($sort, $order);
        return $this->db->get('tasks')->result();
    }

    public function add_task($title, $due_date, $priority)
    {
        $data = [
            'title' => $title,
            'due_date' => $due_date,
            'priority' => $priority,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->db->insert('tasks', $data)) {
            return $this->db->insert_id(); // returns insert ID, which is truthy
        } else {
            return false;
        }
    }


    public function mark_completed($id)
    {
        $this->db->where('id', $id)->update('tasks', ['status' => 'completed']);
    }

    public function get_counts()
    {
        return [
            'total' => $this->db->count_all('tasks'),
            'pending' => $this->db->where('status', 'pending')->count_all_results('tasks'),
            'completed' => $this->db->where('status', 'completed')->count_all_results('tasks'),
        ];
    }
}
