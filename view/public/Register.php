
<form method="POST" action ="register" enctype="multipart/form-data" id="register">
    <label>Ime</label> 
    <input type="text" name="ime" id="ime"/>
    <label>Email</label>
    <input type="email" name="email" id="email"/>
    <label>Password</label> 
    <input type="password" name="password" id="password"/>
    <label>Cofnirm your password</label>
    <input type="password" name="conf_pass" id="conf_pass"/>
    <div id="imgsub">
    <div id = "choose-image">
    <label for="myfile">Select Image</label>
    <input type="file" id="pfp" name="pfp">
    <input type="hidden" name="edited_image" id="edited_image"/>
    </div>

    <input type="submit"/>
    </div>
</form>


<div id="img-handling">


<img id="uploaded-img" draggable="false"/>
<div id="circle">   </div><div id ="square"></div>

<button id="download-button">Download Cropped Image</button>


</div>
<canvas id="canvas"></canvas>
