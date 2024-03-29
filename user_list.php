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


 ?>


        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
          <!-- start page content-->
         <div class="page-content">

          <!--start breadcrumb-->
          <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Zoznam užívatelov</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                  <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Zoznam</li>
                </ol>
              </nav>
            </div>
		   </div>
          <!--end breadcrumb-->

				
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th  class="text-center">SL</th>
										<th  class="text-center">Meno</th>
										<th  class="text-center">Užívaťelské meno</th>
										<th  class="text-center">Email</th>
										<th  class="text-center">Mobil</th>
										<th  class="text-center">Status</th>
										<th  class="text-center">Dátum vytvorenia</th>
										<th  width='25%' class="text-center">Akcia</th>
									</tr>
									
								</thead>
								<tbody>
											<?php

											$allUser = $users->selectAllUserData();

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
												<td><?php echo $value->name; ?></td>
												<td><?php echo $value->username; ?> <br>
												<?php $role = $users->selectRole($value->roleid);
												echo "<span class='badge badge-lg badge-info text-black'>".$role."</span>";
												?>
												</td>
												<td><?php echo $value->email; ?></td>

												<td><span class="badge badge-lg badge-secondary text-black "><?php echo $value->mobile; ?></span></td>
												<td>
												<?php if ($value->isActive == '0') { ?>
												<span class="badge badge-lg badge-info text-black">Aktívny</span>
												<?php }else{ ?>
											<span class="badge badge-lg badge-danger text-black">Neaktívny</span>
												<?php } ?>

												</td>
												<td><span class="badge badge-lg badge-secondary text-black"><?php echo $users->formatDate($value->created_at);  ?></span></td>

												<td>
												<?php if ( Session::get("roleid") == '1') {?>
													<a class="btn btn-success btn-sm
													" href="profile.php?id=<?php echo $value->id;?>">Zobraz</a>
													<a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Uprav</a>
													<a onclick="return confirm('Naozaj chete odstániť užívatela ?')" class="btn btn-danger
											<?php if (Session::get("id") == $value->id) {
											echo "disabled";
											} ?>
													btn-sm " href="?remove=<?php echo $value->id;?>">Odstániť</a>

													<?php if ($value->isActive == '0') {  ?>
													<a onclick="return confirm('Naozaj chcete deaktivovat užívatela ?')" class="btn btn-warning
											<?php if (Session::get("id") == $value->id) {
												echo "disabled";
											} ?>
														btn-sm " href="?deactive=<?php echo $value->id;?>">Deaktivovať</a>
													<?php } elseif($value->isActive == '1'){?>
													<a onclick="return confirm('Naozaj chcete aktivovať užívatela  ?')" class="btn btn-secondary
											<?php if (Session::get("id") == $value->id) {
												echo "disabled";
											} ?>
														btn-sm " href="?active=<?php echo $value->id;?>">Aktívovať</a>
													<?php } ?>




												<?php  }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '2'){ ?>
												<a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">Zobraz</a>
												<a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edituj</a>
												<?php  }elseif( Session::get("roleid") == '2'){ ?>
												<a class="btn btn-success btn-sm
												<?php if ($value->roleid == '1') {
													echo "disabled";
												} ?>
												" href="profile.php?id=<?php echo $value->id;?>">Zobraz</a>
												<a class="btn btn-info btn-sm
												<?php if ($value->roleid == '1') {
													echo "disabled";
												} ?>
												" href="profile.php?id=<?php echo $value->id;?>">Edituj</a>
												<?php }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '3'){ ?>
												<a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">Zobraz</a>
												<a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edituj</a>
												<?php }else{ ?>
												<a class="btn btn-success btn-sm
												<?php if ($value->roleid == '1') {
													echo "disabled";
												} ?>
												" href="profile.php?id=<?php echo $value->id;?>">Zobraz</a>

												<?php } ?>

												</td>
											</tr>
											<?php }}else{ ?>
											<tr class="text-center">
											<td>Žiaden užívaťel!</td>
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