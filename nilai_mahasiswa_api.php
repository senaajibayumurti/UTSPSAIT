<?php
require_once "config.php";

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
      case 'GET':
         if (!empty($_GET["nim"])) {
               $nim = $_GET["nim"];
               get_nilai($nim);
         } else {
               get_all_nilai();
         }
         break;
      case 'POST':
         $input = json_decode(file_get_contents('php://input'), true);
         if (!empty($input["nim"]) && !empty($input["kode_mk"])) {
               $nim = $input["nim"];
               $kode_mk = $input["kode_mk"];
               update_nilai($nim, $kode_mk, $input);
         } else {
               insert_nilai($input);
         }
         break;
      case 'DELETE':
         $input = json_decode(file_get_contents('php://input'), true);
         if (!empty($input["nim"]) && !empty($input["kode_mk"])) {
               $nim = $input["nim"];
               $kode_mk = $input["kode_mk"];
               delete_nilai($nim, $kode_mk);
         } else {
               header("HTTP/1.0 400 Bad Request");
               $response = array(
                  'status' => 0,
                  'message' => 'Parameter NIM dan Kode MK diperlukan untuk menghapus perkuliahan.'
               );
               header('Content-Type: application/json');
               echo json_encode($response);
         }
         break;
      default:
         header("HTTP/1.0 405 Method Not Allowed");
         break;
   }

   function get_all_nilai()
   {
      global $mysqli;
      $query = "SELECT m.nim, m.nama, m.alamat, m.tanggal_lahir, mk.kode_mk, mk.nama_mk, mk.sks, pk.nilai 
                  FROM mahasiswa m 
                  JOIN perkuliahan pk ON m.nim = pk.nim 
                  JOIN matakuliah mk ON pk.kode_mk = mk.kode_mk";
      $data = array();
      $result = $mysqli->query($query);
      while ($row = mysqli_fetch_assoc($result)) {
         $data[] = $row;
      }
      $response = array(
         'status' => 1,
         'message' => 'Get List Nilai Successfully.',
         'data' => $data
      );
      header('Content-Type: application/json');
      echo json_encode($response);
   }

   function get_nilai($nim)
   {
      global $mysqli;
      $query = "SELECT m.nim, m.nama, m.alamat, m.tanggal_lahir, mk.kode_mk, mk.nama_mk, mk.sks, pk.nilai 
                  FROM mahasiswa m 
                  JOIN perkuliahan pk ON m.nim = pk.nim 
                  JOIN matakuliah mk ON pk.kode_mk = mk.kode_mk 
                  WHERE m.nim = '$nim'";
      $data = array();
      $result = $mysqli->query($query);
      while ($row = mysqli_fetch_assoc($result)) {
         $data[] = $row;
      }
      $response = array(
         'status' => 1,
         'message' => 'Get Nilai Successfully.',
         'data' => $data
      );
      header('Content-Type: application/json');
      echo json_encode($response);
   }

   function insert_nilai()
   {
      global $mysqli;
      $nim = $input["nim"];
      $kode_mk = $input["kode_mk"];
      $nilai = $input["nilai"];

      $query = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', '$nilai')";
      if ($mysqli->query($query)) {
         $response = array(
               'status' => 1,
               'message' => 'Nilai Added Successfully.'
         );
      } else {
         $response = array(
               'status' => 0,
               'message' => 'Nilai Addition Failed: ' . $mysqli->error
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

   function update_nilai($nim, $kode_mk, $input)
   {
      global $mysqli;
      $nilai = $input["nilai"];

      $check_query = "SELECT * FROM perkuliahan WHERE nim = '$nim' AND kode_mk = '$kode_mk'";
      $check_result = $mysqli->query($check_query);

      if ($check_result->num_rows > 0) {
         $update_query = "UPDATE perkuliahan SET nilai = '$nilai' WHERE nim = '$nim' AND kode_mk = '$kode_mk'";
         if ($mysqli->query($update_query)) {
               $response = array(
                  'status' => 1,
                  'message' => 'Nilai Updated Successfully.'
               );
         } else {
               $response = array(
                  'status' => 0,
                  'message' => 'Nilai Updation Failed: ' . $mysqli->error
               );
         }
      } else {
         $insert_query = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', '$nilai')";
         if ($mysqli->query($insert_query)) {
               $response = array(
                  'status' => 1,
                  'message' => 'Nilai Added Successfully.'
               );
         } else {
               $response = array(
                  'status' => 0,
                  'message' => 'Nilai Addition Failed: ' . $mysqli->error
               );
         }
      }

      header('Content-Type: application/json');
      echo json_encode($response);
   }

   function delete_nilai($nim, $kode_mk)
   {
      global $mysqli;
      $query = "DELETE FROM perkuliahan WHERE nim = '$nim' AND kode_mk = '$kode_mk'";
      if ($mysqli->query($query)) {
         $response = array(
               'status' => 1,
               'message' => 'Nilai Deleted Successfully.'
         );
      } else {
         $response = array(
               'status' => 0,
               'message' => 'Nilai Deletion Failed: ' . $mysqli->error
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
?>