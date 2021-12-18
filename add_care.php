<?php
include 'template/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
if ($sId === '1') { ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {

  $userAdd = $klient->addcaretype($_POST);
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
                  <li class="breadcrumb-item active" aria-current="page">Pridaj Starostlivosť</li>
                </ol>
              </nav>
            </div>
            
          </div>
          <!--end breadcrumb-->
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="card radius-10">
                <div class="card-body">
                
                  <h5 class="mb-3">Pridaj Starostlivosť</h5>
                  
                  <h5 class="mb-0 mt-4">Informácie</h5>
                  <hr>
                  <div class="row g-3">
            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <label for="item">Názov</label>
                  <input type="text" name="item"  class="form-control" required>
                </div>
          
                <div class="form-group pt-3">
                  <label for="link">Popis</label>
                  <input type="text" name="link"  class="form-control" required>
                </div>
                <div class="form-group pt-3">
                  <label for="note">Poznámka</label>
                  <input type="text" name="note"  class="form-control" required>
                </div>
          
                
                <div class="form-group">
                  <button type="submit" name="addUser" class="btn btn-success">Pridaj starostlivosť</button>
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
