<img src = "<?php echo $basicdata[2] ?>" id="pfp"/>
<h1>
    <?php echo $basicdata[0] ?>
</h1>
<h2> <?php echo $basicdata[1] ?> </h2>

<br/>
<h2>Posts:</h2>

<div>
    <?php foreach ( $data as $post ){
        echo "<a href='post/{$post['id']}'>". $post["title"];
        echo "</a><hr/>";
    }
?>

</div>
