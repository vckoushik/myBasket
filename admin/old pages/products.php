<?php
session_start();
require_once '../config/connect.php';
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
	header('location: login.php');
}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<section id="content">
	<div class="content-blog">
		<div class="page_header text-center">
			<h1>Products</h1>
		</div>
		<div style="margin-left:42%; text-align: center;">
			<form>
				<div class="input-group mb-3">
					<input name ="search_key" style="width:250px" type="text" class="form-control" placeholder="Enter Product Name/Id" aria-label="Enter Product Name or Id" aria-describedby="basic-addon2" autocomplete="off">
					<div class="input-group-append" >
						<button style="margin:20px" class="btn btn-primary btn-outline-primary" type="submit">Search</button>
					</div>
				</div>
			</form>
		</div>
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Product Name</th>
						<th>Category Name</th>
						<th>Thumbnail</th>
						<th>Operations</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT * FROM products";
					if(isset($_GET) && !empty($_GET))
					{
						$skey = $_GET['search_key'];
						if( is_numeric($skey))
						{
							$sql .= " WHERE id=$skey";
						}
						else{
							$sql .= " WHERE name LIKE '%$skey%'";
						}
					}

					$res = mysqli_query($connection, $sql);
					while ($r = mysqli_fetch_assoc($res)) {
					?>
						<tr>
							<th scope="row"><?php echo $r['id']; ?></th>
							<td><?php echo $r['name']; ?></td>
							<td><?php echo $r['catid']; ?></td>
							<td><?php if ($r['thumb']) {
									echo "Yes";
								} else {
									echo "No";
								} ?></td>
							<td><a href="editproduct.php?id=<?php echo $r['id']; ?>">Edit</a> | <a href="delproduct.php?id=<?php echo $r['id']; ?>">Delete</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>
	</div>

</section>
<?php include 'inc/footer.php' ?>