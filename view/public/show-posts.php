
<?php

    foreach ($rows as $row):?>
        <div class="group">
            <div class="img">
                <a href="user-profile/<?php echo $row["fk_id"]; ?>">
                <img src="<?php echo $row["pfp_loc"] ?>" class="pfp-image"/>
                <div class="user">
                    <?php echo $row["name"]; ?>
                </div>
                </a>
                <?php if($_SESSION["id"]!= $row["fk_id"]): ?>
                <?php if($row["i_follow"]==null || $row["i_follow"] == 1 || $row["i_follow"]==2):?>
                <div class="follow" data-post-id = "<?php echo $row["id"]?>"><?php
                        if ($row["i_follow"] ==1){echo "PENDING";}else if($row["i_follow"]==2){echo "Following";}
                        else if($row["i_follow"] == null){
                            echo "Follow";
                        }
                        ?></div>
                <?php endif ?>
                <?php endif; ?>
            </div>

            <div class="col1">


                <div class="post">
                    <?php echo "<a href='/post/".$row["id"]."'>";
                    echo "<h2 class='title'>".$row["title"]."</h2>";
                    echo $row["text"];
                    echo "</a></div>";
                    ?>

                    <div class="function">
                        <?php echo "<div data-post-id=" . $row["id"]."  class= 'func-prop like-button' ' > "?><i class="  <?php echo $row["i_like"] ? " fa-solid" : "fa-regular" ?> fa-heart" id="like"> </i><p class="num_of_likes"> <?php echo $row["like"];?></p></div>
                        <?php echo "<div class= 'func-com func-prop' data-post-id='".$row["id"]."' >"?><i class="fa-regular fa-comment"></i></div>
                        <?php echo "<div class= 'func-prop'>"?><i class="fa-regular fa-share-from-square"></i></div>
                    </div>


                </div>
                <div class="comments">
                        <input type="text" class="comment-box" name="comment-box"/>
                        <i class="fa-regular fa-paper-plane"></i>
                    </div>

</div>
    <?php endforeach;?>

            
