<?php
if (isset($_POST['submit'])) {

    $directory = __DIR__ . "/uploads/";

    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }

    if ($_FILES['files']['name'][0] != '') {

        $message = '';

        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

            $extension = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['files']['tmp_name'][$i], $directory . rand() . "." . $extension);

            $message .= "<li> " . $_FILES['files']['name'][$i] . " </li>";

        }
    } else {
        $error = "Upload field cannot be empty.";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Multiple File Upload</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="well">

			<h2 class="text-center">Multiple File Uploader</h2>

			<?php if (isset($message)): ?>
				<div class="alert alert-success">
					<b>All files has been uploaded successfully. </b>
					<ul>
						<?php echo $message?>
					</ul>
				</div>
			<?php endif;?>

			<?php if (isset($error)): ?>
				<div class="alert alert-danger">
					<b><?php echo $error?> </b>
				</div>
			<?php endif;?>

			<form  action="" method="post" enctype="multipart/form-data" >
				<div class="form-group">
					<label>Upload: </label>
					<input type="file" name="files[]" multiple="multiple">
				</div>
				<div class="form-group">
					<input type="submit" value="Upload" name="submit" class="btn btn-primary">
				</div>
			</form>

		</div>
	</div>
</div>
</body>
</html>
