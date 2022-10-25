<?php
include "/var/www/html/frbackend/Ecell/upload.php";
include "/var/www/html/frbackend/Ecell/includes/navbar.php";

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="gallery.css"> -->
    <style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    /* background-color: #BFAE9C; */


    body {
        /* background-color: #948779; */
        background-color: #948779;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 200 200'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='100' y1='33' x2='100' y2='-3'%3E%3Cstop offset='0' stop-color='%23000' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23000' stop-opacity='1'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='100' y1='135' x2='100' y2='97'%3E%3Cstop offset='0' stop-color='%23000' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23000' stop-opacity='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='%237e7164' fill-opacity='0.6'%3E%3Crect x='100' width='100' height='100'/%3E%3Crect y='100' width='100' height='100'/%3E%3C/g%3E%3Cg fill-opacity='0.5'%3E%3Cpolygon fill='url(%23a)' points='100 30 0 0 200 0'/%3E%3Cpolygon fill='url(%23b)' points='100 100 0 130 0 100 200 100 200 130'/%3E%3C/g%3E%3C/svg%3E");
    }

    .gallery-container {
        margin-bottom: 25%;

    }

    .container {
        /* border: 1px black solid; */

        display: flex;
        justify-content: start;
        flex-wrap: wrap;
        align-items: center;


    }

    .photo {
        border: 1px solid black;
        flex-wrap: wrap;

        background: #403a34;
        color: #ead4be;
        margin: 10px;
        margin-top: 50px;
    }



    .photoimg {

        aspect-ratio: 3/2;
    }

    .form {
        display: flex;
        box-sizing: border-box;
        padding: 40px 20px;
        width: 90%;
        justify-content: center;
        /* margin-bottom: 10px; */
        flex-wrap: wrap;
        border: 2px black solid;
        border-radius: 19px;
        background-color: #384034;
        margin: auto;
        /* position: relative; */
        /* left: 40%; */
    }

    #fill {
        color: white;
    }


    h1 {
        color: white;
    }

    .formint {
        margin: 10px;
        transform: scale(1);
        width: 50%;
        border-radius: 5px;
        /* border: white 1px solid; */
    }


    .space {
        min-height: 90px;
    }

    .title {
        color: white;
    }
    </style>

    <title>Louvre - Gallery</title>
</head>

<body>
    <h2 class="text-center title">The Louvre Gallery</h2>
    <h3 class="text-center title">Format your images to 3/2 ratio for the prettiest results </h2>
        <div class="gallery-container">
            <div class="container">
                <?php
        include_once "db.php";
        
        // $sql = 'SELECT `title`,`imgdesc` FROM `gallery` ORDER BY `imgorder`; ';
        $sql = 'SELECT * FROM `gallery` ORDER BY `imgorder`; ';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "unable to execute query";
            
        }else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            while($row = mysqli_fetch_assoc($result)){
                // echo $row["imgfullname"];
                
                
                echo(
                    '<div class="photo" style="width: 18rem;">
                    <img src="img/gallery/'.$row["imgfullname"].'" class="photoimg card-img-top" alt="...">
                    <div class="card-body">
                    <h3>'.$row["title"].'</h3>
                    <p class="card-text">'.$row['imgdesc'].'</p>
                    </div>
                    </div>'
                );
                
            }
        }
        
        
        
        ?>


            </div>
        </div>


        <div class="form">

            <?php
$url = $_SERVER['REQUEST_URI'];
// if(isset($_SESSION['username'])){
    
    echo('
    <h1 class="formint text-center">Upload</h1>
    <form action='.$url.' method="post" enctype="multipart/form-data">
    <input type="text" class = "formint" name="filename" placeholder="File name.....">
    <input type="text" class = "formint" name="filetitle" placeholder="Image Title.....">
    <input type="text" class = "formint" name="filedesc" placeholder="Image Description.....">
    <input type="file" class = "formint" id="fill" name="file" placeholder="File name.....">
    <button type="submit" id="upload" name="submit">UPLOAD</button>
    </form>
    ');
    ?>

        </div>
        <div class="space"></div>
        <?php
include "/var/www/html/frbackend/Ecell/includes/footer.php";
?>











        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>