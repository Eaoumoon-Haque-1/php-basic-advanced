<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Form</title>
    <style>
        body {
            background: #e6f7ff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .calc-container {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 320px;
        }

        h2 {
            margin-bottom: 20px;
            color: #0077b6;
        }

        .calc-form {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        input[type="number"],
        select {
            padding: 10px;
            border: 2px solid #90e0ef;
            border-radius: 8px;
            font-size: 16px;
            width: 80px;
            text-align: center;
            transition: 0.3s;
        }

        input[type="number"]:focus,
        select:focus {
            border-color: #0077b6;
            outline: none;
            box-shadow: 0 0 5px #90e0ef;
        }

        button {
            background: #0077b6;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #023e8a;
        }

        .result {
            font-size: 18px;
            margin-top: 15px;
            color: #333;
            font-weight: bold;
        }

        /* Styled error messages */
        .error {
            color: #d90429;
            background: #ffd6d6;
            padding: 8px 12px;
            border-radius: 6px;
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="calc-container">
        <h2>Simple Calculator</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="calcForm" class="calc-form">
            <input type="number" id="num1" name="num1">
            <select name="operator">
                <option value="add">+</option>
                <option value="sub">−</option>
                <option value="mul">×</option>
                <option value="div">÷</option>
            </select>
            <input type="number" id="num2" name="num2">
            <button type="submit">=</button>
        </form>
        <div class="result" id="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                ///Grabbing data
                $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT);
                $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);
                $operator = htmlspecialchars($_POST["operator"]);

                ///error handlers
                $errors = false;
                if ($num1 == null || $num2 == null || $operator == null) {
                    echo '<p class="error">Fill all fields</p>';
                    $errors = true;
                }
                if (!is_numeric($num1) || !is_numeric($num2)) {
                    echo '<p class="error">Fill only numeric value</p>';
                    $errors = true;
                } 
                if (!is_numeric($num1) || !is_numeric($num2)) {
                    echo '<p class="error">Fill only numeric value</p>';
                    $errors = true;
                }

                //calculate
                if (!$errors) {
                    $result = 0;
                    switch ($operator) {
                        case "add":
                            $result = $num1 + $num2;
                            break;
                        case "sub":
                            $result = $num1 - $num2;
                            break;
                        case "mul":
                            $result = $num1 * $num2;
                            break;
                        case "div":
                            $result = $num2 != 0 ? $num1 / $num2 : "Error: divide by zero";
                            break;
                        default:
                            echo '<p class="error">Something went wrong</p>';
                    }
                    echo "<p>The calculated value is: " . $result . "</p>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
