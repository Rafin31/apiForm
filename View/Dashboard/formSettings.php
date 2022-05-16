<?php

use libphonenumber\NumberFormat;

require('../../Model/db.php');

function insert($order)
{
    $conn = getConnection();
    $sql = "update settings set FirstButton = '{$order['FirstButton']}',FirstButtonColor = '{$order['FirstButtonColor']}',SecondButton= '{$order['SecondButton']}',SecondButtonColor= '{$order['SecondButtonColor']}',FormTitle='{$order['FormTitle']}',FormTitleColor='{$order['FormTitleColor']}',FirstInputBoxPlaceholder='{$order['FirstInputBoxPlaceholder']}',SecondInputBoxPlaceholder='{$order['SecondInputBoxPlaceholder']}',ThirdInputBoxPlaceholder='{$order['ThirdInputBoxPlaceholder']}',FourthInputboxplaceholder	='{$order['FourthInputboxplaceholder']}',	FifthInpurBoxPlaceholder='{$order['FifthInpurBoxPlaceholder']}',checkBoxText='{$order['checkBoxText']}',bgImage = '{$order['bgImage']}',FirstButtonTextColor='{$order['FirstButtonTextColor']}',SecondButtonTextColor='{$order['SecondButtonTextColor']}',checkBoxTextColor='{$order['checkBoxTextColor']}' where id='1' ";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function getAll()
{
    $conn = getConnection();
    $sql = "select * from settings";
    $result = mysqli_query($conn, $sql);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }

    return $data;
}
$error = null;
$res = getAll();
$data = $res[0];

if (isset($_POST['submit'])) {

    $first_button = $_POST['1st_button'];
    $second_button = $_POST['second_button'];
    $first_button_color = $_POST['first_button_color'];
    $second_button_color = $_POST['second_button_color'];

    $bg_img = $_FILES['bg_image'];
    $name =  $bg_img['name'];
    $error = $bg_img['error'];
    $tmp_name = $bg_img['tmp_name'];

    if ($first_button == "" || $second_button == "" || $first_button_color == "" || $second_button_color == "") {
        $error = "Input required";
    } else {

        if ($name) {
            $filetxt = explode('.', $name);
            $filecheck = strtolower(end($filetxt));
            $fileExtensions = array('jpg', 'png', 'jpeg');
            if (in_array($filecheck,  $fileExtensions)) {
                $fileDestination = "../../Assets/images/" . $name;
                move_uploaded_file($tmp_name, $fileDestination);
                $error = null;
            } else {
                $error =  '*Please upload only JPG,PNG,JPEG files';
            }
        } else {
            $error = null;
            $fileDestination = $data['bgImage'];
        }

        $data = [
            'FirstButton' => $first_button,
            'FirstButtonColor' => $first_button_color,
            'SecondButton' => $second_button,
            'SecondButtonColor' => $second_button_color,
            'FormTitle' => $_POST['form_title'],
            'FormTitleColor' => $_POST['FormTitleColor'],
            'FirstInputBoxPlaceholder' => $_POST['FirstInputBoxPlaceholder'],
            'SecondInputBoxPlaceholder' => $_POST['SecondInputBoxPlaceholder'],
            'ThirdInputBoxPlaceholder' => $_POST['ThirdInputBoxPlaceholder'],
            'FourthInputboxplaceholder' => $_POST['FourthInputboxplaceholder'],
            'FifthInpurBoxPlaceholder' => $_POST['FifthInpurBoxPlaceholder'],
            'checkBoxText' => $_POST['checkBoxText'],
            'FirstButtonTextColor' => $_POST['FirstButtonTextColor'],
            'SecondButtonTextColor' => $_POST['SecondButtonTextColor'],
            'checkBoxTextColor' => $_POST['checkBoxTextColor'],
            'bgImage' => $fileDestination,
        ];
        $status = insert($data);
    }
}


?>


<?php require_once '../Layout/head.php' ?>
<?php require_once '../Layout/navbar.php' ?>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <form method="POST" action="#" enctype="multipart/form-data">
            <div class="row">

                <!-- Form Title -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Title Style</h4>
                            <p class="text-muted m-b-15 f-s-12">It will appear Top of the Sign up form </p>
                            <div class="basic-form">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="form_title" value="<?= $data['FormTitle'] ?>">
                                </div>
                                <div class="example">
                                    <h5 class="box-title">Color for the Form Title</h5>
                                    <p class="text-muted m-b-20">just pick the color or pase the color RGB,HEX or HSL value </p>
                                    <input type="color" name="FormTitleColor" class="colorpicker form-control" value="<?= $data['FormTitleColor'] ?>">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- all of the inputs -->

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Title Style</h4>
                            <p class="text-muted m-b-15 f-s-12">It will appear Top of the Sign up form </p>
                            <div class="basic-form">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="FirstInputBoxPlaceholder" value="<?= $data['FirstInputBoxPlaceholder'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="SecondInputBoxPlaceholder" value="<?= $data['SecondInputBoxPlaceholder'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="ThirdInputBoxPlaceholder" value="<?= $data['ThirdInputBoxPlaceholder'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="FourthInputboxplaceholder" value="<?= $data['FourthInputboxplaceholder'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="FifthInpurBoxPlaceholder" value="<?= $data['FifthInpurBoxPlaceholder'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="checkBoxText" value="<?= $data['checkBoxText'] ?>">
                                </div>
                                <div class="example">
                                    <h5 class="box-title">Color for the Check box text</h5>
                                    <p class="text-muted m-b-20">just pick the color or pase the color RGB,HEX or HSL value </p>
                                    <input type="color" name="checkBoxTextColor" class="colorpicker form-control" value="<?= $data['checkBoxTextColor'] ?>">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>



                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">First button Style</h4>
                            <p class="text-muted m-b-15 f-s-12">It will appear beside the password filed on the Sign up form </p>
                            <div class="basic-form">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="1st_button" value="<?= $data['FirstButton'] ?>">
                                </div>

                                <div class="example">
                                    <h5 class="box-title"> Background Color for the button</h5>
                                    <p class="text-muted m-b-20">just pick the color or pase the color RGB,HEX or HSL value </p>
                                    <input type="color" name="first_button_color" class="colorpicker form-control" value="<?= $data['FirstButtonColor'] ?>">
                                </div>

                                <br>

                                <div class="example">
                                    <h5 class="box-title">Text Color for the button</h5>
                                    <p class="text-muted m-b-20">just pick the color or pase the color RGB,HEX or HSL value </p>
                                    <input type="color" name="FirstButtonTextColor" class="colorpicker form-control" value="<?= $data['FirstButtonTextColor'] ?>">
                                </div>




                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Second button Style</h4>
                            <p class="text-muted m-b-15 f-s-12">It will appear on the bottom of the Sign up form as a final submission button </p>
                            <div class="basic-form">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="second_button" value="<?= $data['SecondButton'] ?>">
                                </div>

                                <div class="example">
                                    <h5 class="box-title">Color for the button</h5>
                                    <p class="text-muted m-b-20">just pick the color or pase the color RGB,HEX or HSL value </p>
                                    <input type="color" name="second_button_color" class="colorpicker form-control" value="<?= $data['SecondButtonColor'] ?>">
                                </div>
                                <br>
                                <div class="example">
                                    <h5 class="box-title">Text Color for the button</h5>
                                    <p class="text-muted m-b-20">just pick the color or pase the color RGB,HEX or HSL value </p>
                                    <input type="color" name="SecondButtonTextColor" class="colorpicker form-control" value="<?= $data['SecondButtonTextColor'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form background Image</h4>
                            <div class="basic-form">

                                <div class="form-group">
                                    <input type="file" name="bg_image" class="form-control-file">
                                    <p class="error mt-2" style="color: red;"><?= $error ?></p>
                                </div>
                                <h5 class="card-title">Current background Image</h5>
                                <div class="img">
                                    <img class="w-25" src="<?= $data['bgImage'] ?>" alt="" srcset="">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <input class="btn btn-dark mb-4 py-3 w-25 mx-auto" type="submit" name="submit" value="Update">
            </div>
        </form>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->


<!--**********************************
            Footer start
   ***********************************-->

<?php require_once '../Layout/scriptsAndFooter.php' ?>