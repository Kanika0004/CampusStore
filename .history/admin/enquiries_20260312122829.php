<?php
include "../backend/db.php";

$query = "SELECT * FROM enquiries ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<h2>Customer Enquiries</h2>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Message</th>
<th>Status</th>
<th>Reply</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['message']; ?></td>
<td><?php echo $row['status']; ?></td>

<td>
<form method="POST" action="reply_enquiry.php">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="text" name="reply" placeholder="Write reply">
</td>

<td>
<button type="submit">Send</button>
</form>

<a href="delete_enquiry.php?id=<?php echo $row['id']; ?>">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>
