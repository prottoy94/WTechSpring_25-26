<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PHP Web Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #1a73e8;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            font-weight: bold;
        }
        .php-info {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        button {
            background-color: #1a73e8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #1557b0;
        }
        #message {
            margin-top: 20px;
            padding: 10px;
            display: none;
        }
        .info {
            background-color: #e7f3ff;
            padding: 15px;
            border-left: 4px solid #1a73e8;
            margin: 20px 0;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #1a73e8;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Welcome to My PHP Website!</h1>
        
        <div class="success">
            ✅ Your web server is working perfectly!
        </div>

        <!-- PHP CODE SECTION 1: Basic PHP Info -->
        <div class="php-info">
            <strong>🐘 PHP Information:</strong><br>
            <?php
                echo "PHP Version: " . phpversion() . "<br>";
                echo "Server Time: " . date("Y-m-d H:i:s") . "<br>";
                echo "Your IP Address: " . $_SERVER['REMOTE_ADDR'] . "<br>";
                echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "<br>";
            ?>
        </div>

        <!-- PHP CODE SECTION 2: Dynamic Content -->
        <div class="info">
            <strong>📅 Dynamic Content:</strong><br>
            <?php
                // Array of greetings based on time of day
                $hour = date('H');
                if ($hour < 12) {
                    $greeting = "Good Morning! 🌅";
                } elseif ($hour < 18) {
                    $greeting = "Good Afternoon! ☀️";
                } else {
                    $greeting = "Good Evening! 🌙";
                }
                
                // Array of motivational quotes
                $quotes = [
                    "Code is poetry! 📝",
                    "Keep learning! 📚",
                    "You're doing great! 🎯",
                    "PHP is awesome! 🚀"
                ];
                $randomQuote = $quotes[array_rand($quotes)];
                
                echo "<strong>$greeting</strong><br>";
                echo "Random quote: $randomQuote<br>";
                echo "Today is: " . date("l, F j, Y") . "<br>";
            ?>
        </div>

        <!-- PHP CODE SECTION 3: Server Information Table -->
        <h2>🖥️ Server Information</h2>
        <table>
            <tr>
                <th>Setting</th>
                <th>Value</th>
            </tr>
            <?php
                $server_info = [
                    "Server Software" => $_SERVER['SERVER_SOFTWARE'],
                    "Server Name" => $_SERVER['SERVER_NAME'],
                    "Server Port" => $_SERVER['SERVER_PORT'],
                    "Document Root" => $_SERVER['DOCUMENT_ROOT'],
                    "PHP Version" => phpversion(),
                    "Operating System" => PHP_OS,
                    "Current Date/Time" => date("Y-m-d H:i:s")
                ];
                
                foreach($server_info as $key => $value) {
                    echo "<tr>";
                    echo "<td>$key</td>";
                    echo "<td>$value</td>";
                    echo "</tr>";
                }
            ?>
        </table>

        <!-- PHP CODE SECTION 4: Simple Calculator (FIXED) -->
        <h2>🧮 Simple PHP Calculator</h2>
        <?php
        $result = "";
        $num1 = "";
        $num2 = "";
        $operation = "";

        // Check if form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculate'])) {
            // Check if values exist
            if(isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operation'])) {
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $operation = $_POST['operation'];
                
                // Make sure inputs are numeric
                if(is_numeric($num1) && is_numeric($num2)) {
                    switch($operation) {
                        case "add":
                            $result = $num1 + $num2;
                            break;
                        case "subtract":
                            $result = $num1 - $num2;
                            break;
                        case "multiply":
                            $result = $num1 * $num2;
                            break;
                        case "divide":
                            $result = ($num2 != 0) ? $num1 / $num2 : "Cannot divide by zero";
                            break;
                    }
                } else {
                    $result = "Please enter valid numbers";
                }
            }
        }
        ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="number" name="num1" placeholder="Enter first number" value="<?php echo $num1; ?>" required step="any">
            <select name="operation">
                <option value="add" <?php echo ($operation == "add") ? "selected" : ""; ?>>+ (Addition)</option>
                <option value="subtract" <?php echo ($operation == "subtract") ? "selected" : ""; ?>>- (Subtraction)</option>
                <option value="multiply" <?php echo ($operation == "multiply") ? "selected" : ""; ?>>× (Multiplication)</option>
                <option value="divide" <?php echo ($operation == "divide") ? "selected" : ""; ?>>÷ (Division)</option>
            </select>
            <input type="number" name="num2" placeholder="Enter second number" value="<?php echo $num2; ?>" required step="any">
            <button type="submit" name="calculate">Calculate</button>
        </form>

        <?php if($result !== "") { ?>
            <div class="success">
                <strong>Result:</strong> <?php echo $num1; ?> 
                <?php 
                    switch($operation) {
                        case "add": echo "+"; break;
                        case "subtract": echo "-"; break;
                        case "multiply": echo "×"; break;
                        case "divide": echo "÷"; break;
                    }
                ?> 
                <?php echo $num2; ?> = <strong><?php echo $result; ?></strong>
            </div>
        <?php } ?>
        
        <form method="POST" action="">
            <input type="number" name="num1" placeholder="Enter first number" required>
            <select name="operation">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">×</option>
                <option value="divide">÷</option>
            </select>
            <input type="number" name="num2" placeholder="Enter second number" required>
            <button type="submit">Calculate</button>
        </form>
        
        <?php if($result !== "") { ?>
            <div class="success">
                Result: <?php echo $result; ?>
            </div>
        <?php } ?>

        <!-- PHP CODE SECTION 5: Display Numbers Loop -->
        <h2>🔢 PHP Loop Example</h2>
        <div class="info">
            <strong>Counting from 1 to 10:</strong><br>
            <?php
                for($i = 1; $i <= 10; $i++) {
                    echo " $i ";
                    if($i < 10) echo "→ ";
                }
                echo "<br><br>";
                
                // Even numbers
                echo "<strong>Even numbers between 1 and 20:</strong><br>";
                for($i = 2; $i <= 20; $i+=2) {
                    echo " $i ";
                    if($i < 20) echo "• ";
                }
            ?>
        </div>

        <!-- PHP CODE SECTION 6: Array Display -->
        <h2>📋 PHP Array Example</h2>
        <div class="info">
            <strong>Programming Languages:</strong>
            <ul>
                <?php
                    $languages = ["PHP", "JavaScript", "Python", "Java", "C++", "Ruby"];
                    foreach($languages as $language) {
                        echo "<li>$language</li>";
                    }
                ?>
            </ul>
        </div>

        <!-- ORIGINAL HTML CONTENT (now with PHP variables) -->
        <h2>📝 Interactive Demo</h2>
        <p>Click the button below to see JavaScript in action:</p>
        <button onclick="showMessage()">Click Me!</button>
        
        <div id="message" class="success"></div>

        <h2>🔧 What This Means</h2>
        <ul>
            <li>✅ Apache is running correctly</li>
            <li>✅ PHP is working! (<?php echo phpversion(); ?>)</li>
            <li>✅ Your file is in the right folder (htdocs)</li>
            <li>✅ HTML, CSS, JS, and PHP all work together</li>
        </ul>

        <h2>📚 PHP Features Demonstrated</h2>
        <ol>
            <li>✅ Variables and Data Types</li>
            <li>✅ Conditional Statements (if/else)</li>
            <li>✅ Loops (for, foreach)</li>
            <li>✅ Arrays</li>
            <li>✅ Form Handling (POST method)</li>
            <li>✅ Server Variables ($_SERVER)</li>
            <li>✅ Date/Time Functions</li>
        </ol>

        <?php
            // PHP CODE SECTION 7: Footer with dynamic year
            $currentYear = date("Y");
            $scriptCount = 7; // Number of PHP sections
        ?>
        
        <footer>
            Created with XAMPP | Apache Web Server | Localhost<br>
            © <?php echo $currentYear; ?> - This page has <?php echo $scriptCount; ?> PHP code sections
        </footer>
    </div>

    <script>
        function showMessage() {
            const messageDiv = document.getElementById('message');
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            
            // Mixing PHP and JavaScript - PHP generates the initial message
            messageDiv.innerHTML = `🎉 Great! JavaScript is working! Button clicked at ${timeString}<br>
            <?php echo "PHP says: Welcome to dynamic web development!"; ?>`;
            messageDiv.style.display = 'block';
            
            // Hide message after 3 seconds
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 3000);
        }
        
        // Additional JavaScript that can interact with PHP-generated content
        console.log("Page loaded at: <?php echo date('Y-m-d H:i:s'); ?>");
        console.log("PHP Version: <?php echo phpversion(); ?>");
    </script>
</body>
</html>