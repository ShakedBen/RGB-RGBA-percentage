<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Select image</title>
</head>
<body>
	<form action="infoPage.php" method="POST" enctype="multipart/form-data">
		<label for="file" class="custom-file-upload"><i class="material-icons" style="font-size:25px">add_a_photo</i>&nbsp;Choose png/jpeg image 
	    <br/>
        <span id="imageName"></span>
	</label>
		<input type="file" for="mediaCapture"  id="file" name="file" >
		
		<span id="imageName"></span>
		</div>
		<button type="submit"   name="submit"> UPLOAD </button>
	</form>
	

	<script>
        let input = document.getElementById("file");
        let imageName = document.getElementById("imageName")

        input.addEventListener("change", ()=>{
            let inputImage = document.querySelector("input[type=file]").files[0];

            imageName.innerText = inputImage.name;
        })
    </script>
</body>
</html>
