<?php include 'template/header.php';

Session::CheckSession();
$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}
if (isset($_GET['id'])) {
	$clientid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
  
  }

 ?>


        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
          <!-- start page content-->
         <div class="page-content">

          <!--start breadcrumb-->
          <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Zoznam klientov</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                  <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Zoznam úkonov pre klienta <b> <?php echo $klient->selectClientName($clientid); ?></b></li>
                </ol>
              </nav>
            </div>
		   </div>
          <!--end breadcrumb-->
              
				
				<hr/>
				<div class="card">
					<div class="card-body">
					<td><a class="btn btn-success btn-sm" href="add_care_for_customer_detail.php?id=<?php echo $clientid;?>">Pridaj starostlivosť</a></td>
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th  class="text-center">SL</th>
										<th  class="text-center">Úkon</th>
										<th  class="text-center">Planovaný čas </th>
										<th  class="text-center">Čas úkonu</th>
										<th  class="text-center">Ošetrovaťeľ</th>
										<th  class="text-center">Poznámka</th>
										<th  class="text-center">Status</th>
										
									</tr>
									
								</thead>
								<tbody>
											<?php

											$allUser = $klient->selectAllcareForKlient($clientid);

											if ($allUser) {
												$i = 0;
												foreach ($allUser as  $value) {
												$i++;

											?>

											<tr class="text-center"
											<?php if (Session::get("id") == $value->id) {
												echo " ";
											} ?>
											>

												<td><?php echo $i; ?></td>
												<td><?php echo $value->care_type; ?> </td>
												<td><?php echo $value->care_time; ?> </td>
												<td><?php echo $value->care_done; ?> </td>
												<td><?php echo $value->user_id; ?> </td>
												<td><?php echo $value->note; ?> </td>
												<td><?php echo $value->status; ?> </td>
											
											</tr>
											<?php }}else{ ?>
											<tr class="text-center">
											<td>Žiaden záznam!</td>
											</tr>
											<?php } ?>

                  </tbody>
							
							</table>
						</div>
					</div>
				</div>
             

          </div>
          <!-- end page content-->
         </div>
         

		 <?php include 'template/footer.php';?>