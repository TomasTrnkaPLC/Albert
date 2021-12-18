<?php include 'template/header.php';
Session::CheckSession();

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $users->updateUserByIdInfo($userid, $_POST);

}
if (isset($updateUser)) {
  echo $updateUser;
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
                  <li class="breadcrumb-item active" aria-current="page">Karta Klienta</li>
                </ol>
              </nav>
            </div>
            
          </div>
          <!--end breadcrumb-->

    <?php
    $getUinfo = $klient->getUserInfoById($userid);
    if ($getUinfo) {
    ?>
               <div class="row">
              <div class="col-12 col-lg-8 col-xl-9">
                <div class="card overflow-hidden radius-10">
                 
                  <div class="card-body">
                    <div class="mt-5 d-flex align-items-start justify-content-between">
                      <div class="">
                        <h3 class="mb-2"><?php echo $getUinfo->meno; ?> <?php echo $getUinfo->priezvisko; ?></h3>
                       
                       
                      </div>
                     
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h4 class="mb-3">Bio</h4>
                    <p class=""><?php echo $getUinfo->bio; ?></p>
                
                  </div>
                  <div class="card-body">
                    <h4 class="mb-3">Poznámka</h4>
                    <p class=""><?php echo $getUinfo->note; ?></p>
              
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-lg-4 col-xl-3">
                <div class="card radius-10">
                  <div class="card-body">
                    <h5 class="mb-3">Izba</h5>
                     <p class="mb-0"><ion-icon name="compass-sharp" class="me-2"></ion-icon><?php echo $getUinfo->izba; ?></p>
                  </div>
                  <div class="card-body">
                    <h5 class="mb-3">Krvná skupina</h5>
                     <p class="mb-0"><ion-icon name="compass-sharp" class="me-2"></ion-icon><?php echo $getUinfo->blood_type; ?></p>
                  </div>
                </div>

                <div class="card radius-10">
                  <div class="card-body">
                    <h5 class="mb-3">Kontakt</h5>
                     <p class=""><?php echo $getUinfo->kontakt; ?></p>
                     <p class=""><?php echo $getUinfo->adresa; ?></p>
         
                  </div>
                </div>


              </div>
            </div><!--end row-->


              


          </div>
          <!-- end page content-->
         </div>
                              <?php }else{

header('Location:index.php');
} ?>



                 </div>                
               
              </div>
            </div>
          </div><!--end row-->

          </div>
          <!-- end page content-->
         </div>
      



    <?php include 'template/footer.php';?>
