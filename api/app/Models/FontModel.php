<?php
class FontModel extends DBConnection implements FontOperation
{
    use CommonResponse;
    private $conn;

    //Table Name
    private $table_name = "fonts";

    public function __construct() {
        $this->conn = $this->connect(new MySQL());
    }

    public function insert($request) {
        $data = $this->upload();

        $this->conn->beginTransaction();
        if($data['status']) {
            try {
                $db_query = "INSERT INTO  ". $this->table_name . " (font_file_name, font_original_file_name, created_at) VALUES(:file_name, :original_file_name, :created_at)";    
                $statement = $this->conn->prepare($db_query);

                $fileName    = $this->sanitizeData($data['font_file_name']);
                $originalFileName   = $this->sanitizeData($data['font_original_file_name']);
                $createdDate = date('Y-m-d H:i:s');
    
                $statement->bindParam(':file_name', $fileName, PDO::PARAM_STR);
                $statement->bindParam(':original_file_name', $originalFileName, PDO::PARAM_STR);
                $statement->bindParam(':created_at', $createdDate, PDO::PARAM_STR);
                $statement->execute();

                $this->conn->commit();
            } catch (PDOException $e) {
                $data['message'] = "Error Message: " . $e->getMessage();
                $data['status'] = 0;
                $this->conn->rollBack();
            } 
        }
        return $data;
    }

    public function getAll(){
        $db_query  = "SELECT *FROM " . $this->table_name . " ORDER BY id DESC";
        $statement = $this->conn->query($db_query) or die("failed!");

        $fonts= [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $fonts[] = $row;
        }

        $data['status'] = 1;
        $data['fonts']  =   $fonts;
        return $data;
    }

    //Delete Data from Database
    public function delete($id)
    {
        //get deleted font details
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id=? LIMIT 1"); 
        $stmt->execute([$id]); 
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $fontFile = isset($result['font_file_name']) ? "./uploads/".$result['font_file_name'] : '';

        try {
            $db_query  = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $statement = $this->conn->prepare($db_query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            //deletig file
            if(file_exists($fontFile)) {
                unlink($fontFile);
            }

            $data['message'] = "Successfully was deleted";
            $data['status'] = 1;
        } catch (PDOException $e) {
            $data['message'] = "Error Message: " . $e->getMessage();
            $data['status'] = 0;
        } 
        return $data;
    }
}
