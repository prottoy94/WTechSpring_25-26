<?php
include "../Controller/RegistrationValidation.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>
        <form method="post" action="">
            <h2>PHP Validation Example</h2>
            <p style="color: red">* required field</p>
            <table>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="name"><?php echo $name; ?></td>
                    <td> <p style = 'color: red'>*</p></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password"><?php echo $password; ?></td>
                    <td> <p style = 'color: red'>*</p> </td>
                </tr>
                <tr>
                    <td>Website:</td>
                    <td><input type="text" name="website"><?php echo $website; ?></td>
                    <td> <p style = 'color: red'>*</p> </td>
                </tr>
                <tr>
                    <td>Comment:</td>
                    <td><textarea cols="20" rows="5" name="comment"><?php echo $comment; ?></textarea></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <input type="radio" name="gender" value="Female" ><?php if($gender == "Female") echo "checked"; ?>Female
                        <input type="radio" name="gender" value="Male"><?php if($gender == "Male") echo "checked"; ?> Male
                        <input type="radio" name="gender" value="Other"><?php if($gender == "Other") echo "checked"; ?> Other
                    </td>
                    <td> <p style = 'color: red'>*</p> </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
        
    </body>
</html>