<?php


include_once 'Session.php';


class Klient{


  // Db Property
  private $db;

  // Db __construct Method
  public function __construct(){
    $this->db = new Database();
  }

  // Date formate Method
   public function formatDate($date){
     // date_default_timezone_set('Asia/Dhaka');
      $strtime = strtotime($date);
    return date('Y-m-d H:i:s', $strtime);
   }



  // Check Exist Email Address Method
  public function checkExistEmail($email){
    $sql = "SELECT email from  tbl_users WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }



  // User Registration Method
  public function userRegistration($data){
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $roleid = $data['roleid'];
    $password = $data['password'];

    $checkEmail = $this->checkExistEmail($email);

    if ($name == "" || $username == "" || $email == "" || $mobile == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Please, User Registration field must not be Empty !</div>';
        return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
        return $msg;
    }elseif (filter_var($mobile,FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
        return $msg;

    }elseif(strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Password at least 6 Characters !</div>';
        return $msg;
    }elseif(!preg_match("#[0-9]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
        return $msg;
    }elseif(!preg_match("#[a-z]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
        return $msg;
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address !</div>';
        return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
        return $msg;
    }else{

      $sql = "INSERT INTO tbl_users(name, username, email, password, mobile, roleid) VALUES(:name, :username, :email, :password, :mobile, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-Hotovo alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Hotovo !</strong> Wow, you have Registered Hotovofully !</div>';
          return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Something went Wrong !</div>';
          return $msg;
      }



    }





  }
  
  public function addNewUserByAdmin($data){
    $meno = $data['meno'];
    $priezvisko = $data['priezvisko'];
    $vek = $data['vek'];
    $note = $data['note'];
    $izba = $data['izba'];
    $blood_type = $data['blood_type'];
    $kontakt = $data['kontakt'];
    $adresa = $data['adresa'];
    $bio = $data['bio'];

    $sql = "INSERT INTO tbl_klient (meno, priezvisko, vek, note,izba, blood_type,kontakt, adresa, bio) VALUES(:meno, :priezvisko, :vek, :note, :izba, :blood_type, :kontakt, :adresa, :bio)";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':meno', $meno);
    $stmt->bindValue(':priezvisko', $priezvisko);
    $stmt->bindValue(':vek', $vek);
    $stmt->bindValue(':note', $note);
    $stmt->bindValue(':izba', $izba);
    $stmt->bindValue(':blood_type', $blood_type);
    $stmt->bindValue(':kontakt', $kontakt);
    $stmt->bindValue(':adresa', $adresa);
    $stmt->bindValue(':bio', $bio);
    $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-Hotovo alert-dismissible mt-3" id="flash-msg" style=" z-index: 20; background-color: greenyellow;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Hotovo !</strong> Registrácia úspešná !</div>';
          return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20; background-color: red;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Ups.. Niečo je zle!</div>';
          return $msg;
      }
    }


  public function addcaretype($data){
        $item = $data['item'];
        $note = $data['note'];
        $link = $data['link'];
    
        $sql = "INSERT INTO tbl_care_type (item, note, link) VALUES(:item,:note,:link)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':item', $item);
        $stmt->bindValue(':note', $note);
        $stmt->bindValue(':link', $link);
      
        $result = $stmt->execute();
          if ($result) {
            $msg = '<div class="alert alert-dismissible mt-3" id="flash-msg" style=" z-index: 20; background-color: greenyellow;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Hotovo !</strong> Oprácia úspešná !</div>';
              return $msg;
          }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20; background-color: red;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Chyba !</strong> Ups.. Niečo je zle!</div>';
              return $msg;
          }
    }

    public function addcaretypetoklient($data){
      $care_type = $data['care_type'];
      $client_id = $data['client_id'];
      $status = $data['status'];
  
      $sql = "INSERT INTO klient_care_list (care_type, client_id, care_time, status) VALUES(:care_type,:client_id,:care_time,:status)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':care_type', $care_type);
      $stmt->bindValue(':client_id', $client_id);
      $stmt->bindValue(':care_time', $care_time);
      $stmt->bindValue(':status', $status);
    
      $result = $stmt->execute();
        if ($result) {
          $msg = '<div class="alert alert-dismissible mt-3" id="flash-msg" style=" z-index: 20; background-color: greenyellow;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Hotovo !</strong> Oprácia úspešná !</div>';
            return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20; background-color: red;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Chyba !</strong> Ups.. Niečo je zle!</div>';
            return $msg;
        }
  }

  
  // Select All care
  public function selectAllCare(){
    $sql = "SELECT * FROM tbl_care_type ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

// Select Role
  public function selectRole($role){
  $sql = "SELECT *FROM tbl_roles WHERE id = :roles LIMIT 1";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':roles', $role);
  $stmt->execute();
  while($row = $stmt->fetch()) {
    $data = $row['role'];
  }
  return $data;
  }
 //Select Client name
 
 public function selectClientName($role){
  $sql = "SELECT *FROM tbl_klient WHERE id = :roles LIMIT 1";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':roles', $role);
  $stmt->execute();
  while($row = $stmt->fetch()) {
    $meno = $row['meno'];
    $priezvisko = $row['priezvisko'];
  }
  $data = $meno.' '.$priezvisko;
  return $data;
  }

  public function selectAllcareForKlient($role){
    $sql = "SELECT * FROM klient_care_list WHERE client_id = :roles ORDER BY care_time DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':roles', $role);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // Select All User Method
  public function selectAllUserData(){
    $sql = "SELECT * FROM tbl_klient ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // User login Autho Method
  public function userLoginAutho($email, $password){
    $password = SHA1($password);
    $sql = "SELECT * FROM tbl_users WHERE email = :email and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  // Check User Account Satatus
  public function CheckActiveUser($email){
    $sql = "SELECT * FROM tbl_users WHERE email = :email and isActive = :isActive LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':isActive', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }





    // Get Single User Information By Id Method
    public function getUserInfoById($userid){
      $sql = "SELECT * FROM tbl_klient WHERE id = :id LIMIT 1";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $userid);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      }else{
        return false;
      }


    }
        // Get Single User Information By Id Method
    public function getCareInfoById($userid){
          $sql = "SELECT * FROM tbl_care_type WHERE id = :id LIMIT 1";
          $stmt = $this->db->pdo->prepare($sql);
          $stmt->bindValue(':id', $userid);
          $stmt->execute();
          $result = $stmt->fetch(PDO::FETCH_OBJ);
          if ($result) {
            return $result;
          }else{
            return false;
          }
    
    
        }


  //
  //   Get Single User Information By Id Method
    public function updateUserByIdInfo($userid, $data){
      $name = $data['name'];
      $username = $data['username'];
      $email = $data['email'];
      $mobile = $data['mobile'];
      $roleid = $data['roleid'];



      if ($name == "" || $username == ""|| $email == "" || $mobile == ""  ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> POlia nesmú byť prázdne !</div>';
          return $msg;
        }elseif (strlen($username) < 3) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Meno je krátke. Aspoň 3 písmená !</div>';
            return $msg;
        }elseif (filter_var($mobile,FILTER_SANITIZE_NUMBER_INT) == FALSE) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Len čísla!</div>';
            return $msg;


      }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Zlá emailová adresa!</div>';
          return $msg;
      }else{

        $sql = "UPDATE tbl_users SET
          name = :name,
          username = :username,
          email = :email,
          mobile = :mobile,
          roleid = :roleid
          WHERE id = :id";
          $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':name', $name);
          $stmt->bindValue(':username', $username);
          $stmt->bindValue(':email', $email);
          $stmt->bindValue(':mobile', $mobile);
          $stmt->bindValue(':roleid', $roleid);
          $stmt->bindValue(':id', $userid);
        $result =   $stmt->execute();

        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-Hotovo alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Hotovo !</strong> Aktualizácia úspešná!</div>');



        }else{
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Ups. Niečo je zle !</div>');


        }


      }


    }

    public function updatecareByIdInfo($userid, $data){
      $item = $data['item'];
      $note = $data['note'];
      $link = $data['link'];
     


        $sql = "UPDATE tbl_care_type SET
          item = :item,
          note = :note,
          link = :link
         
          WHERE id = :id";
          $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':item', $item);
          $stmt->bindValue(':note', $note);
          $stmt->bindValue(':link', $link);
          $stmt->bindValue(':id', $userid);
          
        $result =   $stmt->execute();

        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-Hotovo alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Hotovo !</strong> Aktualizácia úspešná!</div>');



        }else{
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Ups. Niečo je zle !</div>');


        


      }


    }


    // Delete User by Id Method
    public function deleteUserById($remove){
      $sql = "DELETE FROM tbl_users WHERE id = :id ";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
          $msg = '<div class="alert alert-Hotovo alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Hotovo !</strong> Zamestnanec je fuč !</div>';
            return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Ups. Niečo je zle !</div>';
            return $msg;
        }
    }

    // User Deactivated By Admin
    public function userDeactiveByAdmin($deactive){
      $sql = "UPDATE tbl_users SET

       isActive=:isActive
       WHERE id = :id";

       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindValue(':isActive', 1);
       $stmt->bindValue(':id', $deactive);
       $result =   $stmt->execute();
        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-Hotovo alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Úspech !</strong> Užívaťel bol deaktivovaný !</div>');

        }else{
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Chyba !</strong> DUpss niečo sa pokazilo !</div>');

            return $msg;
        }
    }


    // User Deactivated By Admin
    public function userActiveByAdmin($active){
      $sql = "UPDATE tbl_users SET
       isActive=:isActive
       WHERE id = :id";

       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindValue(':isActive', 0);
       $stmt->bindValue(':id', $active);
       $result =   $stmt->execute();
        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-Hotovo alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Úspech !</strong> Užívaťel bol deaktivovaný !</div>');
        }else{
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Chyba !</strong> DUpss niečo sa pokazilo !</div>');

        }
    }




    // Check Old password method
    public function CheckOldPassword($userid, $old_pass){
      $old_pass = SHA1($old_pass);
      $sql = "SELECT password FROM tbl_users WHERE password = :password AND id =:id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':password', $old_pass);
      $stmt->bindValue(':id', $userid);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        return true;
      }else{
        return false;
      }
    }



    // Change User pass By Id
    public  function changePasswordBysingelUserId($userid, $data){

      $old_pass = $data['old_password'];
      $new_pass = $data['new_password'];


      if ($old_pass == "" || $new_pass == "" ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Heslo nesmie byť prázdne!</div>';
          return $msg;
      }elseif (strlen($new_pass) < 6) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Nové heslo musí mať aspoň 6 znakov !</div>';
          return $msg;
       }

         $oldPass = $this->CheckOldPassword($userid, $old_pass);
         if ($oldPass == FALSE) {
           $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Error !</strong> Staré heslo sa nezhoduje!</div>';
             return $msg;
         }else{
           $new_pass = SHA1($new_pass);
           $sql = "UPDATE tbl_users SET

            password=:password
            WHERE id = :id";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':password', $new_pass);
            $stmt->bindValue(':id', $userid);
            $result =   $stmt->execute();

          if ($result) {
            echo "<script>location.href='index.php';</script>";
            Session::set('msg', '<div class="alert alert-Hotovo alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Hotovo !</strong> Zmena hesla úspešná !</div>');

          }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg" style=" z-index: 20;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Ups niečo je zle !</div>';
              return $msg;
          }

         }



    }








}
