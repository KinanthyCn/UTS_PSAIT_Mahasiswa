<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
            if(!empty($_GET["nim"]))
            {
                $nim=($_GET["nim"]);
                get_perkuliahan($nim);
            }
            else
            {
                get_perkuliahann();
            }
            break;

    case 'POST':
    
        if (!empty($_GET["nim"]) && !empty($_GET["kode_mk"]) && !empty($_GET["nilai"])) {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            $nilai = $_GET["nilai"];
            update_nilai_mahasiswa($nim, $kode_mk, $nilai);

        } else {
            insert_nilai();
        }

        break;

    case 'DELETE':
        if (!empty($_GET["nim"]) && !empty($_GET["kode_mk"])) {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            delete_nilai_mahasiswa($nim, $kode_mk);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("status" => 0, "message" => "Parameter missing"));
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;

 }



   function get_perkuliahann()
   {
      global $mysqli;
      $query="SELECT * FROM perkuliahan ";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List nilai mahasiswa  Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function get_perkuliahan($nim)
   {
      global $mysqli;
      $query="SELECT * FROM perkuliahan WHERE nim='$nim'";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_assoc($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get nilai mahasiswa with id Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   function insert_nilai(){
   // nim, kode mk, nilai

       global $mysqli;
       $data = json_decode(file_get_contents('php://input'), true);
       $nim = $data['nim'];
       $kode_mk = $data['kode_mk'];
       $nilai = $data['nilai'];
   
       $query = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', '$nilai')";
       if ($mysqli->query($query) === TRUE) {
           $response = array(
               'status' => 1,
               'message' => 'Nilai Mahasiswa Added Successfully.'
           );
       } else {
           $response = array(
               'status' => 0,
               'message' => 'Failed to Add Nilai Mahasiswa.'
           );
       }
       header('Content-Type: application/json');
       echo json_encode($response);
   }
 
      
 

   function update_nilai_mahasiswa($nim, $kode_mk, $nilai)
   {
       global $mysqli;
       $query = "UPDATE perkuliahan SET nilai = '$nilai' WHERE nim = '$nim' AND kode_mk = '$kode_mk'";

       $result = mysqli_query($mysqli, $query);

       if ($result) {
           $response = array(
               'status' => 1,
               'message' => 'Nilai Mahasiswa Updated Successfully.',
           );
       } else {
           $response = array(
               'status' => 0,
               'message' => 'Failed to Update Nilai Mahasiswa.'
           );
       }
       header('Content-Type: application/json');
       echo json_encode($response);
   }
    
    
 
   function delete_nilai_mahasiswa($nim, $kode_mk)
   {
       global $mysqli;
       $query = "DELETE FROM perkuliahan WHERE nim = '$nim' AND kode_mk = '$kode_mk'";
       if ($mysqli->query($query) === TRUE) {
           $response = array(
               'status' => 1,
               'message' => 'Nilai Mahasiswa Deleted Successfully.'
           );
       } else {
           $response = array(
               'status' => 0,
               'message' => 'Failed to Delete Nilai Mahasiswa.'
           );
       }
       header('Content-Type: application/json');
       echo json_encode($response);
   }
    
      

 
?>