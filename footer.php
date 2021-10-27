<footer id="footer">
    <?php
        $query = "SELECT COUNT(*) as c FROM `orders` WHERE `status` = 1";
        $result = $link->query($query);
        $row = $result->fetch_assoc();
        $count = $row['c'];
        echo "<h3 class='count'>Количество заявок в работе $count</h3>";
    ?>

<a href="javascript:void(document.getElementById('footer').style.backgroundColor='green');">
  Click here for green background
</a>
<br>
<a href="javascript:void(document.getElementById('footer').style.backgroundColor='blanchedalmond');">
  Click here for blanchedalmond background

</a>
</footer>