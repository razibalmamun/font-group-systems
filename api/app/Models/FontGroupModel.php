<?php
class FontGroupModel extends DBConnection implements FontGroupOperation
{
    use CommonResponse;
    private $conn;

    //Table Name
    private $table_name = "font_groups";
    private $child_table_name = "font_group_items";

    public function __construct() {
        $this->conn = $this->connect(new MySQL());
    }

    public function insert() {
        $post = json_decode(file_get_contents('php://input'), true);
        $data = [];
        $data['status'] = 1;
        try {
            $this->conn->beginTransaction();

            if(count($post['rows']) > 1) {
                //add in parent table
                $sql = "INSERT INTO ".$this->table_name." (title, created_at) VALUES (:title, :created_at)";
                $stmt = $this->conn->prepare($sql);

                $title = $this->sanitizeData($post['title']);
                $createdDate = date('Y-m-d H:i:s');

                $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                $stmt->bindParam(':created_at', $createdDate, PDO::PARAM_STR);
                $stmt->execute();

                $fontGroupId = $this->conn->lastInsertId();

                //add in child table
                $db_query = "INSERT INTO  ". $this->child_table_name . " (font_group_id, font_id, font_name, font_size, font_price) VALUES(:font_group_id, :font_id, :font_name, :font_size, :font_price)";    
                $statement = $this->conn->prepare($db_query);
                if($post['rows']) {
                    foreach ($post['rows'] as $key => $value) {
                        $fontId     = $this->sanitizeData($value['font_id']);
                        $fontName   = $this->sanitizeData($value['font_name']);
                        $fontSize   = $this->sanitizeData($value['font_size']);
                        $fontPrice  = $this->sanitizeData($value['font_price']);

                        $statement->bindParam(':font_group_id', $fontGroupId, PDO::PARAM_STR);
                        $statement->bindParam(':font_id', $fontId, PDO::PARAM_STR);
                        $statement->bindParam(':font_name', $fontName, PDO::PARAM_STR);
                        $statement->bindParam(':font_size', $fontSize, PDO::PARAM_STR);
                        $statement->bindParam(':font_price', $fontPrice, PDO::PARAM_STR);
                        $statement->execute();
                    }
                }
                $data['message'] = "Successfully added font group";
            } else {
                $data['message'] = "You have to select at least two fonts";
                $data['status'] = 0;
                // http_response_code(422);
            }
            $this->conn->commit();
        } catch (PDOException $e) {
            $data['message'] = "Error Message: " . $e->getMessage();
            $data['status'] = 0;
            $this->conn->rollBack();
        } 
        return $data;
    }

    public function getAll(){
        $db_query  = "SELECT font_groups.*, group_concat(font_group_items.font_name) AS fonts, count(font_group_items.id) AS total_fonts
        FROM font_groups INNER JOIN font_group_items ON font_group_items.font_group_id = font_groups.id
        GROUP BY font_groups.id ORDER BY font_groups.id DESC";

        $statement = $this->conn->query($db_query) or die("failed!");

        $fontGroups= [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $fontGroups[] = [
                'id'    =>  $row['id'],
                'title' =>  $row['title'],
                'total_fonts'   =>  $row['total_fonts'],
                'fonts'  =>  $row['fonts'],
            ];
        }
        $data['status'] = 1;
        $data['font_groups']  =   $fontGroups;
        return $data;
    }

    public function findById($id){
        $statement = $this->conn->prepare("SELECT id, title FROM " . $this->table_name . " WHERE id=? LIMIT 1"); 
        $statement->execute([$id]); 
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result) {
            $group = [
                'id'    =>  $result['id'],
                'title'    =>  $result['title'],
            ];
            //get details
            $stmt = $this->conn->prepare("SELECT * FROM " . $this->child_table_name . " WHERE font_group_id=?"); 
            $stmt->execute([$id]); 
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $group['rows'][] = $row;
            }
        }

        $data['status'] = 1;
        $data['row']    =   $group;
        return $data;
    }

    public function update($id) {
        $post = json_decode(file_get_contents('php://input'), true);

        $data = [];
        $data['status'] = 1;
        try {
            $this->conn->beginTransaction();

            if(count($post['rows']) > 1) {
                //add in parent table
                $sql = "UPDATE ".$this->table_name." SET title = :title where id = :id";
                $stmt = $this->conn->prepare($sql);
                $title = $this->sanitizeData($post['title']);
                $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                //before delete child table data
                $deleteStmt = $this->conn->prepare("DELETE FROM " . $this->child_table_name . " WHERE font_group_id = :font_group_id");
                $deleteStmt->bindParam(':font_group_id', $id, PDO::PARAM_INT);
                $deleteStmt->execute();

                //add in child table
                $db_query = "INSERT INTO  ". $this->child_table_name . " (font_group_id, font_id, font_name, font_size, font_price) VALUES(:font_group_id, :font_id, :font_name, :font_size, :font_price)";    
                $statement = $this->conn->prepare($db_query);
                if($post['rows']) {
                    $rows = [];
                    foreach ($post['rows'] as $key => $value) {
                        $fontId     = $this->sanitizeData($value['font_id']);
                        $fontName   = $this->sanitizeData($value['font_name']);
                        $fontSize   = $this->sanitizeData($value['font_size']);
                        $fontPrice  = $this->sanitizeData($value['font_price']);

                        $statement->bindParam(':font_group_id', $id, PDO::PARAM_STR);
                        $statement->bindParam(':font_id', $fontId, PDO::PARAM_STR);
                        $statement->bindParam(':font_name', $fontName, PDO::PARAM_STR);
                        $statement->bindParam(':font_size', $fontSize, PDO::PARAM_STR);
                        $statement->bindParam(':font_price', $fontPrice, PDO::PARAM_STR);
                        $statement->execute();
                    }
                }
                $data['message'] = "Successfully was updated";
            } else {
                $data['message'] = "You have to select at least two fonts";
                $data['status'] = 0;
            }
            $this->conn->commit();
        } catch (PDOException $e) {
            $data['message'] = "Error Message: " . $e->getMessage();
            $data['status'] = 0;
            $this->conn->rollBack();
        } 
        return $data;
    }

    public function delete($id)
    {
        try {
            $db_query  = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $statement = $this->conn->prepare($db_query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $data['message'] = "Successfully was deleted";
            $data['status'] = 1;
        } catch (PDOException $e) {
            $data['message'] = "Error Message: " . $e->getMessage();
            $data['status'] = 0;
        } 
        return $data;
    }
}
