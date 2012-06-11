<?php $this->pageTitle=Yii::app()->name; ?>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/files.css" />
<script type="text/javascript" charset="utf-8" src="js/jQuery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jQuery/jQuery.UI.js"></script>
<script type="text/javascript" src="js/jQuery/UI.js"></script>
<script type="text/javascript" src="js/jQuery/script.js"></script>
<!–[if lt IE 9]> <script src="js/html5.js"></script>

<hr />

<?php echo 'Current directory ID: ' . $intCurrentDirId; ?>

<?php if (!empty($boolUploaded)) { ?>
	<p>File uploaded successfully!</p>
<?php } ?>

<form action="index.php?r=site/index" method="POST">
    Create Directory: <input name="dir_name" type="text" />
    <input name="curr_dir_id" type="hidden" value= "<?php echo $intCurrentDirId ?>" />
    <input type="submit" value="Create Directory" />
</form>

<form enctype="multipart/form-data" action="index.php?r=site/index" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <!-- Name of input element determines name in $_FILES array -->
    Upload this file: <input name="uploaded_file" type="file" /><br />
    <input name="curr_dir_id" type="hidden" />
    <input type="submit" value="Upload File" />
</form>