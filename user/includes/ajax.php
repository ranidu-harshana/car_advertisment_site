<?php
    if (isset($_POST['display'])) {
        $province = $_POST['province'];
        echo "<select name='district' id='' class='form-control' required>";
        if ($province == "Central") {
            echo "<option value='Kandy'>Kandy</option>";
            echo "<option value='Matale'>Matale</option>";
            echo "<option value='Nuwara Eliya'>Nuwara Eliya</option>";
        }elseif ($province == "Eastern") {
            echo "<option value='Ampara'>Ampara</option>";
            echo "<option value='Batticaloa'>Batticaloa</option>";
            echo "<option value='Trincomalee'>Trincomalee</option>";
        }if ($province == "North Central") {
            echo "<option value='Anuradhapura'>Anuradhapura</option>";
            echo "<option value='Polonnaruwa'>Polonnaruwa</option>";
        }if ($province == "Northern") {
            echo "<option value='Jaffna'>Jaffna</option>";
            echo "<option value='Kilinochchi'>Kilinochchi</option>";
            echo "<option value='Mannar'>Mannar</option>";
            echo "<option value='Mullaitivu'>Mullaitivu</option>";
            echo "<option value='Vavuniya'>Vavuniya</option>";
        }if ($province == "North Western") {
            echo "<option value='Kurunegala'>Kurunegala</option>";
            echo "<option value='Puttalam'>Puttalam</option>";
        }if ($province == "Sabaragamuwa") {
            echo "<option value='Ratnapura'>Ratnapura</option>";
            echo "<option value='Kegalle'>Matale</option>";
        }if ($province == "Southern") {
            echo "<option value='Galle'>Galle</option>";
            echo "<option value='Hambantota'>Hambantota</option>";
            echo "<option value='Matara'>Matara</option>";
        }if ($province == "Uva") {
            echo "<option value='Badulla'>Badulla</option>";
            echo "<option value='Monaragala'>Monaragala</option>";
        }if ($province == "Western") {
            echo "<option value='Colombo'>Colombo</option>";
            echo "<option value='Gampaha'>Gampaha</option>";
            echo "<option value='Kalutara'>Kalutara</option>";
        }
        echo "</select>";
    }