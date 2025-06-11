<?php
class QueryBuilder
{
    protected $db;
    protected $table;
    protected $select = '*';
    protected $where = [];
    protected $order = '';
    protected $limit = '';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select($columns = ['*'])
    {
        $this->select = is_array($columns) ? implode(', ', $columns) : $columns; //implode converts array in string 
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $escaped = $this->db->real_escape_string($value); //This ensures that special characters in the value (like ', ", ;, etc.) are escaped to prevent SQL injection
        $this->where[] = "$column $operator '$escaped'"; //->where('id', '=', 5)
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->order = "ORDER BY $column $direction";
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = "LIMIT $limit";
        return $this;
    }

     public function create(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $escapedValues = array_map(function ($value) {
            return "'" . $this->db->real_escape_string($value) . "'";
        }, array_values($data));
        $values = implode(', ', $escapedValues);

        $query = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        return $this->db->query($query);
    }

    public function update(array $data)
    {
        if (empty($this->where)) {
            throw new Exception("Update operation requires at least one WHERE condition to prevent full table update.");
        }

        $setClause = [];
        foreach ($data as $column => $value) {
            $escapedValue = $this->db->real_escape_string($value);
            $setClause[] = "$column = '$escapedValue'";
        }

        $query = "UPDATE {$this->table} SET " . implode(', ', $setClause);
        $query .= " WHERE " . implode(" AND ", $this->where);

        return $this->db->query($query);
    }

    public function get()
    {
        $query = "SELECT {$this->select} FROM {$this->table}"; //$this->select contains the selected columns (e.g., "*" or "id, name").
        if (!empty($this->where)) {
            $query .= " WHERE " . implode(" AND ", $this->where); //implode(" AND ", $this->where)  joins all the where() conditions with AND.
        }
        if ($this->order) {
            $query .= " " . $this->order;
        }
        if ($this->limit) {
            $query .= " " . $this->limit;
        }
        return $this->db->query($query);
    }

    public function delete()
    {
        if (empty($this->where)) {
            throw new Exception("Delete operation requires at least one WHERE condition to prevent full table deletion.");
        }
        $query = "DELETE FROM {$this->table} WHERE " . implode(" AND ", $this->where);//combines all conditions with AND.
        return $this->db->query($query);
    }
}
