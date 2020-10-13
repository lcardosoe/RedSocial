<?php include('header.php'); ?>
<?php include('session.php'); ?>

<body>
	<?php include('navbar.php'); ?>
	<div id="masthead">
		<div class="container">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100 img-responsive" src="images/foto.png" alt="First slide">
					</div>

				</div>
			</div>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
					</div>
				</div>
			</div><!-- /cont -->
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-body">
							<!--/stories-->
							<div class="row">
								<br>



								<div class="col-md-2 col-sm-3 text-center">
									<img src="images/lion.jpg" style="width:100px;height:100px" class="img-circle"></a>
								</div>






								<div class="col-md-9 col-sm-3">

									<form method="post" id="send_message" action="send_message.php">
										<div class="control-group">
											<label>Selecciona tu Contacto:</label>
											<div class="controls">
												<select name="friend_id" class="combo" required>
													<option></option>
													<?php
													$query = $conn->query("select members.member_id , members.firstname , members.lastname , members.image , friends.friends_id   from members  , friends
	where friends.my_friend_id = '$session_id' and members.member_id = friends.my_id
	OR friends.my_id = '$session_id' and members.member_id = friends.my_friend_id
	");
													while ($row = $query->fetch()) {
														$friend_name = $row['firstname'] . " " . $row['lastname'];
														$friend_image = $row['image'];
														$id = $row['member_id'];
													?>
														<option value="<?php echo $id; ?>"><?php echo $friend_name; ?></option>
													<?php } ?>
													<div class="control-group">
														<label>Tu mensaje:</label>
														<div class="controls">
															<textarea name="my_message" class="my_message" placeholder="Escribe a tus amigos ♥" required></textarea>
														</div>
													</div>

													<div class="container">
														<div class="row">
															<div class="col-md-2 col-md-offset-10">
																<div class="card">
																	<div class="card-body d-flex justify-content-between align-items-left">

																		<button class="btn btn-success"><i class="icon-envelope-alt"></i> Enviar </button>
																		<br>
																		<br>

																	</div>
																</div>
															</div>
														</div>
													</div>

											</div>





											<div class="col-md-12 col-sm-3 text-left">
												<hr>
												<label>BANDEJA DE ENTRADA:</label>
												<hr>
												<?php
												$query = $conn->query("select * from message
				LEFT JOIN members on message.sender_id = members.member_id where reciever_id = '$session_id' ");
												while ($row = $query->fetch()) {
													$id = $row['message_id'];

												?>
													<div class="mes">

														<div class="col-md-2 col-sm-1 text-center">
															<img src="images/ester.jpg" style="width:70px;height:70px" class="img-circle"></a>
														</div>
														<div class="message"><?php echo $row['content']; ?>
															<div class="pull-center">enviado por:
																<p class="text-muted"><?php echo $row['firstname'] . " " . $row['lastname']; ?> a las <?php echo $row['date_sended']; ?>
																	<a href="delete_message.php<?php echo '?id=' . $id; ?>" class="btn btn-danger">Eliminar <i class="icon-remove"></i></a></div>
															</p>
															<hr>

														</div>
													</div>
												<?php } ?>
											</div>


											<hr>
										</div>
								</div>



							</div>
							<!--/col-12-->
						</div>
					</div>






					<?php include('footer.php'); ?>

</body>

</html>
