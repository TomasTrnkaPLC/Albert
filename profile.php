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
                  <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
              </nav>
            </div>
            
          </div>
          <!--end breadcrumb-->

    <?php
    $getUinfo = $users->getUserInfoById($userid);
    if ($getUinfo) {
    ?>
      <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="card radius-10">
                <div class="card-body">
                
                  <h5 class="mb-3">Editácia profilu</h5>
                  
                  <h5 class="mb-0 mt-4">Informácie</h5>
                  <hr>
                  <div class="row g-3">
                  <form class="" action="" method="POST">  
                    <div class="col-6">
                       <label class="form-label">Meno</label>
                       <input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
                    </div>
                    <div class="col-6">
                     <label class="form-label">Priezvisko</label>
                     <input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
                   </div>
                     <div class="col-6">
                       <label class="form-label">Email</label>
                       <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
                   </div>
                   <div class="col-6">
                       <label class="form-label">Kontakt</label>
                       <input type="text" id="mobile" name="mobile" value="<?php echo $getUinfo->mobile; ?>" class="form-control">
                   </div>
                   <?php if (Session::get("roleid") == '1') { ?>

                              <div class="form-group
                              <?php if (Session::get("roleid") == '1' && Session::get("id") == $getUinfo->id) {
                                echo "d-none";
                              } ?>
                              ">
                                <div class="form-group">
                                  <label for="sel1">Pozícia</label>
                                  <select class="form-control" name="roleid" id="roleid">

                                  <?php

                                if($getUinfo->roleid == '1'){?>
                                  <option value="1" selected='selected'>Administrátor</option>
                                  <option value="2">Správca</option>
                                  <option value="3">Opatrovaťeľ</option>
                                  <option value="4">Recepcia</option>
                                <?php }elseif($getUinfo->roleid == '2'){?>
                                  <option value="1" selected='selected'>Administrátor</option>
                                  <option value="2">Správca</option>
                                  <option value="3">Opatrovaťeľ</option>
                                  <option value="4">Recepcia</option>
                                <?php }elseif($getUinfo->roleid == '3'){?>
                                  
                                  <option value="2">Správca</option>
                                  <option value="3">Opatrovaťeľ</option>
                                  <option value="4">Recepcia</option>


                                <?php } ?>


                                  </select>
                                </div>
                              </div>

                              <?php }else{?>
                              <input type="hidden" name="roleid" value="<?php echo $getUinfo->roleid; ?>">
                              <?php } ?>

                              <?php if (Session::get("id") == $getUinfo->id) {?>


                              <div class="form-group">
                                <button type="submit" name="update" class="btn btn-success">Aktualizuj</button>
                                <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Zmena Hesla</a>
                              </div>
                              <?php } elseif(Session::get("roleid") == '1') {?>


                              <div class="form-group">
                                <button type="submit" name="update" class="btn btn-success">Aktualizuj</button>
                                <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Zmena Hesla</a>
                              </div>
                              <?php } elseif(Session::get("roleid") == '2') {?>


                              <div class="form-group">
                                <button type="submit" name="update" class="btn btn-success">Aktualizuj</button>

                              </div>

                              <?php   }else{ ?>
                                  <div class="form-group">

                                    <a class="btn btn-primary" href="index.php">Ok</a>
                                  </div>
                                <?php } ?>


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
