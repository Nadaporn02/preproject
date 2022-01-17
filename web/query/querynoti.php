

<?php  // sql จำนวนdatabaseที่มี status = unread

include("functions.php");

        $query = "SELECT * from `error` where `status` = 'unread' order by `event` DESC";
        if(count(fetchAll($query))>0){  ?>
          <span class="badge" id="count"><?php echo count(fetchAll($query));?></span>
<?php
        }

?>
