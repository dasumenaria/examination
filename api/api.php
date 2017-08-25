<?php
require_once("Rest.inc.php");
date_default_timezone_set('asia/kolkata');
 
class API extends REST {

    public $data = "";
    
    const DB_SERVER = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB = "mds_pratap_primary_2016-2017";
	 
    private $db = NULL;

    public function __construct() {
    parent::__construct();  // Init parent constructor
    $this->dbConnect();    // Initiate Database connection     
    }

    public function __destruct() {
    $this->db = NULL;
    }
    
    private function dbConnect() {
        // Set up the database
        try {            
            $this->db = new PDO('mysql:host=' . self::DB_SERVER . ';dbname=' . self::DB, self::DB_USER, self::DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
           /* $error = array('Type' => 'Error', "Error" => 'Some Error From Server', 'Responce' => "");
            $this->response($this->json($error), 251);*/
        }
    }
     /*
     * Public method for access api.
     * This method dynmically call the method based on the query string
     *
     */
    public function processApi(){
    $func = strtolower(trim(str_replace("/", "", $_REQUEST['rquest'])));
	if ((int) method_exists($this, $func) > 0){
    $this->$func();
		   }
    else{
    $this->response('', 404);  
	//If the method not exist with in this class, response would be "Page not found".
		}	
                                }
////////////My API FUN/////////////////////////////// 
 
////////////Search///Marksheet/////START////////////////////////// 
public function search_marksheet() {
		//include_once("common/global.inc.php") 
       // global $link;
			    $scholar_no='MDSPS-2279';
				
				$school_id=1;
			
			  if($school_id==1){
			$qry = "SELECT * FROM `mds_sector_2016-2017`.`student` where `scholar_no`='$scholar_no'";			
			$sql = $this->db->prepare($qry);
            $sql->execute();
			$row_count= $sql->fetchALL(PDO::FETCH_ASSOC);
				}
			else if($school_id==2){
			$qry = "SELECT * FROM `mds_pratap_primary_2016-2017`.`student` where `scholar_no`='$scholar_no'";			
			$sql = $this->db->prepare($qry);
            $sql->execute();
			$row_count= $sql->fetchALL(PDO::FETCH_ASSOC);
				}
			

			if($sql->rowCount()>0){
				foreach ($row_count as $row_item) {
					
			  $full_path="http://www.smtmarbles.com/exam/mds/exam_new/marksheet/".$row_item['pdf_path'];
			  $updt_date=$row_item['pdf_update_date'];
			  $orignal_date=date('d-m-Y', strtotime($updt_date));
			  
				$result[] = array(
				'book_id' =>$row_item['id'],	 
				'pdf_path' =>$full_path,
				'pdf_update_date' =>$orignal_date
				 
				);
		}
                $success = array('status' => true, "msg" => 'yes', 'search_data' => $result);
                $this->response($this->json($success), 200);
				} else {
                $error = array('status' => false, "Error" => "No data found", 'Responce' => '');
                $this->response($this->json($error), 200);
            }
    }

////////////Search///Marksheet/////START////////////////////////// 
 
    /*
     *  Encode array into JSON
     */
    private function json($data) {

        if (is_array($data)) {
         
            return json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP );
        }
    }
}
// Initiiate Library    
$api = new API;
$api->processApi();
?>