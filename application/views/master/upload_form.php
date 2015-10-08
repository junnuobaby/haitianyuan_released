<html>
<head>
    <title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('modify_info/do_upload');?>

<input type="file" name="master-profile-avatar"/>
<br><input type="text" name="x"/><br>
<input type="text" name="y"/><br>
<input type="text" name="w"/><br>
<input type="text" name="h"/>


<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>