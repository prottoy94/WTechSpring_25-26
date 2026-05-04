<?php
include "../Controller/RegistrationValidation.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
        <script src="../Controller/JS/CheckUserName.js?v=2"></script>
    </head>
    <body>
        <form method="post" action="" enctype="multipart/form-data">
            <h2>PHP Validation Example</h2>
            <p style="color: red">* required field</p>
            <table>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" id="name" name="name" onkeyup="checkUserName()"></td>
                    <td> <p style = 'color: red'>*</p></td>
                    <td><p id="userresponse"></p></td>
                    <td><?php echo $ccname; ?></td>
                </tr>
                <tr>
                    <td>User Password:</td>
                    <td><input type="password" name="password"></td>
                    <td> <p style = 'color: red'>*</p></td>
                    <td><?php echo $ccpassword; ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email"></td>
                    <td> <p style = 'color: red'>*</p> </td>
                    <td><?php echo $ccemail; ?></td>
                </tr>
                <tr>
                    <td>Website:</td>
                    <td><input type="text" name="website"></td>
                    <td> <p style = 'color: red'>*</p> </td>
                    <td><?php echo $ccwebsite; ?></td>
                </tr>
                <tr>
                    <td>Comment:</td>
                    <td><textarea cols="20" rows="5" name="comment"></textarea> </td>
                    <td><?php echo $cccomment; ?></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <input type="radio" name="gender" value="Female" >Female <?php if($gender == "Female") echo " <span style='color: green;'>checked</span>"; ?>
                        <input type="radio" name="gender" value="Male"> Male <?php if($gender == "Male") echo " <span style='color: green;'>checked</span>"; ?>
                        <input type="radio" name="gender" value="Other"> Other <?php if($gender == "Other") echo " <span style='color: green;'>checked</span>"; ?>
                    </td>
                    <td> <p style = 'color: red'>*</p> </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Submit"></td>
                </tr>
                <tr>
                    <td>Add an attachment:</td>
                    <td><input type="file" name="file"></td>
                    <td><?php echo $ccfile ?></td>
                </tr>
            </table>
        </form>
    </body>
</html>
