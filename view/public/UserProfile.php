 

 <div id = "head-profile">
     <img src = '<?php echo $basicdata["pfp_loc"]; ?>'   id="pfp"/>
<div id ="head-profile-name">
    <p class="head-profile-name-1"> <?php echo $basicdata["name"]; ?> </p>
    <p class="head-profile-name-2"> <?php echo $basicdata["email"]; ?> </p>
</div>
 </div>
<div id="friend-list"></div>
 <div id="posts">
     <?php foreach ($posts as $row) :?>
     <div class="group">
        <a href = "user-profile/<?php echo $row["fk_id"]?>" style="text-decoration:none">
         <div class="img">
             <img src="<?php echo $row["pfp_loc"] ?>" class="pfp-image"/>
             <div class="user">
                 <?php echo $row["name"]; ?>
             </div>

         </div>
        </a>

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
                 
            <div class="comments">
                        <input type="text" class="comment-box" name="comment-box"/>
                        <i class="fa-regular fa-paper-plane"></i>
                    </div>

 </div>
 </div>

     <? endforeach;    ?>

 </div>