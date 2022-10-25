<?php
//using functions not oop because this is a small project
if(isset($_POST['submit'])){

    $newfile = $_POST['filename'];
    if(empty($newfile)){
        $newfile = 'gallery';
    } else{
        $newfile = strtolower(str_replace(" ", "-",$newfile));//sanitising

    }
    $image_title = $_POST['filetitle'];
    $image_desc = $_POST['filedesc'];

    $file = $_FILES['file'];
    $file_name = $file['name'];
    // $file_path = $file['full_path'];
    $file_type = $file['type'];
    $file_temp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];
// print_r($file);

    $file_exp = explode(".",$file_name);
    $file_ext = strtolower(end($file_exp));

    $allowed = array("jpg","jpeg","png");
    // i would use oop for validation but i am quite new to it

    if(in_array($file_ext,$allowed)){
        if($file_error === 0){
            if($file_size < 20000000){
                $image_fullname = $newfile . '.' . uniqid("",true). "." . $file_ext;
                $destination = "img/gallery/" . $image_fullname;
                // $destination = "    img/gallery/" . $image_fullname;
                include_once "db.php";
                

                if (empty($image_title) || empty($image_desc)){
                    header("Location: gallery.php?upload=empty");
                    exit();
                }else{
                    $sql = "SELECT * FROM gallery;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo "unable to execute query";
                        
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $count = mysqli_num_rows($result);
                        $new_order = $count +1;
                        $sql = "INSERT INTO `gallery` (`title`, `imgdesc`, `imgfullname`, `imgorder`) VALUES (?, ?, ?, ?);";//much better in pdo
                    }
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        header("Location: gallery.php");
                        echo "unable to execute query";
                        
                    }else{
                        mysqli_stmt_bind_param($stmt, "ssss",$image_title,$image_desc,$image_fullname,$new_order);
                        mysqli_stmt_execute($stmt);
                        move_uploaded_file($file_temp_name,$destination);
                        // echo $destination;
                        // echo $file_temp_name;
                        // exit();
                   

                        header("Location: gallery.php?upload=success");
                    }
                }


                
            }
            else{
                echo "the size is too large";
            }
            
        }
        else{
            echo "<p class='error'>an error has occured.</p>";
        }


    }else{
        header("Location: gallery.php");
        echo "<p class='error'>upload the proper file type.</p>";
        exit();
    }

    // print_r($file_ext);

    // print_r($file);
    
}