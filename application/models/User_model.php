<?php

class User_model extends CI_Model
{
    private $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }
    // where like search
    public function getList($where = [], $select = '*')
    {
        $query = $this->db
            ->select($select)
            ->where($where)
            ->order_by('id', 'DESC')
            ->get($this->table);

        return $query->result();

    }
    public function getUserList()
    {
        $query = $this->db
            ->from($this->table . ' AS u')
            ->join('order_course_count AS oc', 'oc.user_id = u.id')
            ->select('oc.id,oc.user_id,oc.course_id,oc.count,u.name,u.tel,u.email')
            ->order_by('oc.id', 'DESC')
            ->get();

        return $query->result();

    }
    public function insertRow(array $data)
    {
        return $this->db->insert($this->table, $data) ? $this->db->insert_id() : false;
    }

    public function updateRow(array $where, array $data)
    {
        return $this->db->where($where)->update($this->table, $data);
    }

    public function getRow(array $where, $select = '*')
    {
        return $this->db->select($select)->get_where($this->table, $where)->row();
    }

    public function getRowId(array $where)
    {
        $data = $this->getRow($where, 'id');
        return isset($data) ? $data->id : false;
    }
}
