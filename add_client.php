<?php
include 'template/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
if ($sId === '1') { ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {

  $userAdd = $klient->addNewUserByAdmin($_POST);
}

if (isset($userAdd)) {
  echo $userAdd;
}


 ?>

   <!-- start page content wrapper-->
   <div class="page-content-wrapper">
          <!-- start page content-->
         <div class="page-content">

          <!--start breadcrumb-->
          <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Stránka</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                  <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Pridaj klienta</li>
                </ol>
              </nav>
            </div>
            
          </div>
          <!--end breadcrumb-->
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="card radius-10">
                <div class="card-body">
                
                  <h5 class="mb-3">Pridaj klienta</h5>
                  
                  <h5 class="mb-0 mt-4">Informácie</h5>
                  <hr>
                  <div class="row g-3">
            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <label for="meno">Meno</label>
                  <input type="text" name="meno"  class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="priezvisko">Priezvisko</label>
                  <input type="text" name="priezvisko"  class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="vek">Vek</label>
                  <input type="number" name="vek"  class="form-control" required> 
                </div>
                <div class="form-group">
                  <label for="kontakt">Telefón</label>
                  <input type="number" name="kontakt"  class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="adresa">Adresa</label>
                  <input type="text" name="adresa"  class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="blood_type">Krvná skupina</label>
                  <input type="text" name="blood_type" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="izba">Izba</label>
                  <input type="text" name="izba" class="form-control" required>  
                </div>
                <div class="form-group">
                  <label for="bio">Bio</label>
                  <input type="text" name="bio" class="form-control" required>  
                </div>
                <div class="form-group">
                  <label for="note">Poznámka</label>
                  <input type="text" name="note" class="form-control" required>  
                </div>
                
                <div class="form-group">
                  <button type="submit" name="addUser" class="btn btn-success">Pridaj klienta</button>
                </div>


            </form>
     

<?php
}else{

  header('Location:index.php');



}
 ?>
 </div>                
               
               </div>
             </div>
           </div><!--end row-->
 
           </div>
           <!-- end page content-->
          </div>
  <?php
  include 'template/footer.php';

  ?>
