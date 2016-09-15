<?php
require ("../app.php");
include ("../z_format/head.php");

if (empty($_GET["s"])) { 
    $s = 0;
} else {
    $s = $_GET["s"];
}
$data = show_db($s, 1000);
?>
<?php if (count($data) > 0): ?>
<p><a href="csv.php">Download CSV</a></p>
<?php if ($s !== 0) { ?>
<p><a href="?s=<?=$s-1000?>">PREV 1000</a></p>
<?}?>
<?php if (count($data) == 1000) { ?>
<p><a href="?s=<?=$s+1000?>">NEXT 1000</a></p>
<?}?>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys(current($data))); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($data as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>
<?php
include ("../z_format/foot.php");
?>