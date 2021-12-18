<?php include 'template/header.php';
Session::CheckSession();

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $klient->updatecareByIdInfo($userid, $_POST);

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
                  <li class="breadcrumb-item active" aria-current="page">Starostlivosť</li>
                </ol>
              </nav>
            </div>
            
          </div>
          <!--end breadcrumb-->

    <?php
    $getUinfo = $klient->getCareInfoById($userid);
    if ($getUinfo) {
    ?>
      <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="card radius-10">
                <div class="card-body">
                
                  <h5 class="mb-3">Editácia úkonu</h5>
                  
                  <h5 class="mb-0 mt-4">Informácie</h5>
                  <hr>
                  <div class="row g-3">
                  <form class="" action="" method="POST">  
                    <div class="col-6">
                       <label class="form-label">Názov</label>
                       <input type="text" name="item" value="<?php echo $getUinfo->item; ?>" class="form-control">
                    </div>
                    <div class="col-6">
                     <label class="form-label">Popis</label>
                     <input type="text" name="link" value="<?php echo $getUinfo->link; ?>" class="form-control">
                   </div>
                     <div class="col-6">
                       <label class="form-label">Poznámka</label>
                       <input type="text" id="note" name="note" value="<?php echo $getUinfo->note; ?>" class="form-control">
                   </div>
                  <div class="form-group">
                     <button type="submit" name="update" class="btn btn-success">Aktualizuj</button>
                  </div>

                            


                              </form>
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
