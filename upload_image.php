<!DOCTYPE html>
<html>

<head>
    <title>Insert Image in MySql using PHP</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image[]" />
        <button type="submit">Upload</button>
    </form>
</body>

</html>


<?php
if (isset($_POST["submit"])) {
    $connn = mysqli_connect("localhost", "root", "", "image") or die("Could not Connect My Sql");
    $output_dir = "upload/";/* Path for file upload */
    $RandomNum   = time();
    $ImageName      = str_replace(' ', '-', strtolower($_FILES['image']['name'][0]));
    $ImageType      = $_FILES['image']['type'][0];

    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.', '', $ImageExt);
    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
    $ret[$NewImageName] = $output_dir . $NewImageName;

    /* Try to create the directory if it does not exist */
    if (!file_exists($output_dir)) {
        @mkdir($output_dir, 0777);
    }
    move_uploaded_file($_FILES["image"]["tmp_name"][0], $output_dir . "/" . $NewImageName);
    $sql = "INSERT INTO `img`(`image`)VALUES ('$NewImageName')";
    if (mysqli_query($cn, $sql)) {
        echo "successfully !";
    } else {
        echo "Error: " . $sql . "" . mysqli_error($cn);
    }
}
?>