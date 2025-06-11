<?php
class Category extends Model
{
    private $table = 'categories';


    public function create($name)
    {
        return $this->queryBuilder->table('categories')->create([
            'name' => $name
        ]);
    }

    public function update($id, $name)
    {
        return $this->queryBuilder
            ->table('categories')
            ->where('id', '=', $id)
            ->update(['name' => $name]);
    }
    public function readOne($id)
    {
        $result = $this->queryBuilder->table($this->table)
            ->where('id', '=', $id)
            ->limit(1)
            ->get();

        return $result->fetch_assoc();
    }



    public function delete($id)
    {
        $result = $this->queryBuilder->table($this->table)
            ->where("id", "=", $id)
            ->delete();
        return $result;
    }

    //    public function getAllCategory() {
    //     $query = "SELECT * FROM categories";
    //     $result = $this->db->query($query);
    //     $categories = [];
    //     while ($row = $result->fetch_assoc()) {
    //         $categories[] = $row;
    //     }
    //     return $categories;
    // }

    public function getAllCategory()
    {
        $result = $this->queryBuilder
            ->table($this->table)
            ->select(['id', 'name'])
            ->orderBy('id', 'ASC')
            ->get();

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }
}
