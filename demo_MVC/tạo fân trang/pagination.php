<style type="text/css">
	.page-item{
		font-size: 20px;
		font-weight: bold;
		margin: 10px;
		border: 2px solid #ccc;
	}
</style>
<?php if ($current_page > 3) {
	$first_page = 1;
	?>
	<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
<?php } ?>
<?php for ($num =1; $num <= $totalPages ; $num++) { 
	if ($num != $current_page) { ?>
		<!-- Số trang ở phần per_page = ( tổng số item chia cho số item mỗi trang) -->
		<?php if($num > $current_page - 5 && $num < $current_page + 5) { ?>
		<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
			<?php } ?>
	<?php } else { ?>
		<strong class="current-page"><?= $num ?></strong>
	<?php } ?>
<?php } ?>
<?php if ($current_page < $totalPages - 3 ){
	$end_page = $totalPages;
	?>
	<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">End</a>
<?php } ?>