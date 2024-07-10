<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<form enctype="multipart/form-data" method="post">
  <input id="file" name="file[]" type="file"  multiple/>
  <input class="update" type="submit" />
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>

// Updated part
jQuery.each(jQuery('#file')[0].files, function(i, file) {
    data.append('file-'+i, file);
});

// Full Ajax request
$(".update").click(function(e) {
    // Stops the form from reloading
    e.preventDefault();
    $.ajax({
        url: 'index.php',
        type: 'POST',
        contentType:false,
        processData: false,
        dataType : 'json',
        data: function(){
            var data = new FormData();
            jQuery.each(jQuery('#file')[0].files, function(i, file) {
                data.append('file-'+i, file);
            });
            data.append('body' , $('#body').val());
            data.append('uid', $('#uid').val());
            return data;
        }(),
            success: function(result) {
            // alert(result);
            },
        error: function(xhr, result, errorThrown){
            alert('Request failed.');
        }
    });
});
    </script>
</body>
</html>