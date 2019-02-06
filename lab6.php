<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab No. 6 - Temp. Converter</title>
</head>
<body>

<?php
// function to calculate converted temperature
function convertTemp($temp, $unit1, $unit2)
{
    // checks if the user is weird and selects the same unit of conversion for both
    if ($unit1 == $unit2){
        return $temp;
    // checks for initial conversion unit of C
    } else if ($unit1 == 'celsius'){
        if ($unit2 == 'fahrenheit'){
            return $temp * 9 / 5 + 32;
        } else if ($unit2 == 'kelvin'){
            return $temp + 273.15;
        } else {
            echo 'Oops!! Something went wrong.';
        }
    // checks for initial conversion unit of F
    } else if ($unit1 == 'fahrenheit'){
        if ($unit2 == 'celsius'){
            return ($temp - 32) * 5 / 9;
        } else if ($unit2 == 'kelvin'){
            return ($temp + 459.67) * 5 / 9;
        } else {
            echo 'Oops!!! Something went wrong.';
        }
    // checks for initial conversion unit of K
    } else if ($unit1 == 'kelvin'){
        if ($unit2 == 'celsius'){
            return $temp - 273.15;
        } else if ($unit2 == 'fahrenheit'){
            return $temp * 9 / 5 - 459.67;
        } else {
            echo 'Oops!!!! Something went wrong.';
        }
    // error handing if no conditions were met
    } else {
        echo 'Oops! Something went wrong.';
    }

    // conversion formulas
    // Celsius to Fahrenheit = T(°C) × 9/5 + 32
    // Celsius to Kelvin = T(°C) + 273.15
    // Fahrenheit to Celsius = (T(°F) - 32) × 5/9
    // Fahrenheit to Kelvin = (T(°F) + 459.67)× 5/9
    // Kelvin to Fahrenheit = T(K) × 9/5 - 459.67
    // Kelvin to Celsius = T(K) - 273.15

    // You need to develop the logic to convert the temperature based on the selections and input made

} // end function

// Logic to check for POST and grab data from $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store the original temp and units in variables
    // You can then use these variables to help you make the form sticky
    // then call the convertTemp() function
    // Once you have the converted temperature you can place PHP within the converttemp field using PHP
    // I coded the sticky code for the originaltemp field for you

    $originalTemperature = $_POST['originaltemp'];
    $originalUnit = $_POST['originalunit'];
    $conversionUnit = $_POST['conversionunit'];
    // only perform the calculate function if the user selects a unit in both dropdowns
    if ($originalUnit != '--Select--' && $conversionUnit != '--Select--'){
        // further checks to see if the input is a number
        if (is_numeric($originalTemperature)){
            $convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);
        } else {
            echo 'Please enter a numeric value.';
        }
    } else{
        echo 'Please select a conversion unit for both fields.';
    }
} // end if

?>

<?php
// if the form is being posted, populate the select option with the one previously used
if (isset($_POST['originalunit'])){
    $originalUnitName = $_POST['originalunit'];
} else { // uses the default value for dropdown
    $originalUnitName = '';
}

if (isset($_POST['conversionunit'])){
    $conversionUnitName = $_POST['conversionunit'];
} else { 
    $conversionUnitName = '';
}
?>


<!-- Form starts here -->
<h1>Temperature Converter</h1>
<h4>CTEC 127 - PHP with SQL 1</h4>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <div class="group">
        <label for="temp">Temperature</label>
        <input type="text" value="<?php if (isset($_POST['originaltemp'])) {
    echo $_POST['originaltemp'];
}
?>" name="originaltemp" size="14" maxlength="7" id="temp">

        <select name="originalunit">
            <option value="--Select--"<?php if ($originalUnitName == '--Select--') echo ' selected="selected"'; ?>>--Select--</option>
            <option value="celsius"<?php if ($originalUnitName == 'celsius') echo ' selected="selected"'; ?>>Celsius</option>
            <option value="fahrenheit"<?php if ($originalUnitName == 'fahrenheit') echo ' selected="selected"'; ?>>Fahrenheit</option>
            <option value="kelvin"<?php if ($originalUnitName == 'kelvin') echo ' selected="selected"'; ?>>Kelvin</option>
        </select>
    </div>

    <div class="group">
        <label for="convertedtemp">Converted Temperature</label>
        <input type="text" value="<?php if (isset($convertedTemp)){echo $convertedTemp;} else{echo' ';}?>"
        name="convertedtemp" size="14" maxlength="7" id="convertedtemp" readonly>

        <select name="conversionunit">
            <option value="--Select--"<?php if ($conversionUnitName == '--Select--') echo ' selected="selected"'; ?>>--Select--</option>
            <option value="celsius"<?php if ($conversionUnitName == 'celsius') echo ' selected="selected"'; ?>>Celsius</option>
            <option value="fahrenheit"<?php if ($conversionUnitName == 'fahrenheit') echo ' selected="selected"'; ?>>Fahrenheit</option>
            <option value="kelvin"<?php if ($conversionUnitName == 'kelvin') echo ' selected="selected"'; ?>>Kelvin</option>
        </select>
    </div>
    <input type="submit" value="Convert"/>
</form>
</body>
</html>