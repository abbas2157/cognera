<?php
if($_POST)
{
    $file_parts = pathinfo($filename);

    $file_parts['extension'];
    $cool_extensions = Array('jpg','png','jpeg','dcm','DCM');

    $error = array();
    $extension = array('jpg','png','jpeg','dcm','DCM');
    for($i = 0; $i < count($_FILES); $i++) 
    {
        $file_name = $_FILES["file-".$i]["name"];
        $error[] =  $file_name;
        $file_tmp = $_FILES["file-".$i]["tmp_name"];
        $ext = pathinfo($file_name,PATHINFO_EXTENSION);

        if(in_array($ext,$extension)) 
        {
            if(!file_exists("uploads/".$file_name)) 
            {
                move_uploaded_file( $file_tmp = $_FILES["file-".$i]["tmp_name"] , "uploads/".$file_name);
            }
            else 
            {
                $filename = basename($file_name,$ext);
                $newFileName = $filename.time().".".$ext;
                move_uploaded_file($file_tmp = $_FILES["file-".$i]["tmp_name"],"uploads/".$newFileName);
            }
        }
        else 
        {
            array_push($error,"$file_name, ");
        }
    }
    return json_encode($error);
}
else
{
    return "Please Select File.";
}