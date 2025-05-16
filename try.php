<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Processing System</title>
    <link href="https://fonts.googleapis.com/css2?family=Arial:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
            margin: 0;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
			justify-content: center;
            gap: 15px;
        }

        form label {
            font-weight: 600;
            color: #34495e;
			align-items: center;
			justify-content: center;
        }

        input[type="number"] {
            padding: 10px;
            margin-right: 10px;
            width: 100px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            transition: border-color 0.3s ease;
			align-items: center;
			justify-content: center;
        }

        input[type="number"]:focus {
            border-color: #3498db;
            outline: none;
			align-items: center;
			justify-content: center;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
			align-items: center;
			justify-content: center;
        }

        input[type="submit"]:hover {
            background-color: #217dbb;
			align-items: center;
			justify-content: center;
        }

        .log-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-height: 500px;
            overflow-y: auto;
            margin-top: 20px;
        }

        .log-entry {
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            font-size: 1rem;
            word-wrap: break-word;
			align-items: center;
			justify-content: center;
        }

        .special {
            color: #fff;
            background-color: #c0392b;
        }

        .vvip {
            color: #fff;
            background-color: #e74c3c;
        }

        .vip {
            color: #fff;
            background-color: #3498db;
        }

        .regular {
            color: #fff;
            background-color: #2ecc71;
        }

        .general {
            color: #fff;
            background-color: #f39c12;
        }

        .end {
            color: #fff;
            background-color: #9b59b6;
        }

        @media (max-width: 768px) {
            form {
                flex-direction: column;
                align-items: flex-start;
            }

            input[type="number"] {
                margin-bottom: 15px;
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <h1>Ticket Processing Log</h1>
    <form method="post" action="">
        <label for="start">Start Code:</label>
        <input type="number" name="start" id="start" value="<?php echo isset($_POST['start']) ? (int)$_POST['start'] : 1; ?>" min="1" max="50" required>

        <input type="submit" value="Process Tickets">
    </form>

    <div class="log-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $start = (int) $_POST["start"];
            $end = 50; //implicitly set the end

            if ($start < 1 || $start > 50) {
                echo "<div class='log-entry special'>Invalid range. Start must be between 1 and 50.</div>";
            } else {
                for ($code = $start; $code <= $end; $code++) {
                    // Special check to terminate the loop early if the code is exactly 50
                    if ($code == 50) {
                        echo "<div class='log-entry special'>Processing special termination code: $code</div>";
                        break;
                    }

                    // Check if code is for VVIP (divisible by 15)
                    if ($code % 15 == 0) {
                        echo "<div class='log-entry vvip'>Processing VVIP event ticket: $code</div>";
                        continue;
                    }

                    // Skip processing codes not divisible by 3 or 5
                    if ($code % 3 != 0 && $code % 5 != 0) {
                        echo "<div class='log-entry general'>General inquiry for code: $code, skipping...</div>";
                        continue;
                    }

                    // Processing regular event tickets (divisible by 3)
                    if ($code % 3 == 0) {
                        echo "<div class='log-entry regular'>Processing regular event ticket: $code</div>";
                    }

                    // Process VIP event tickets (divisible by 5)
                    if ($code % 5 == 0) {
                        echo "<div class='log-entry vip'>Processing VIP event ticket: $code</div>";
                    }

                    echo "<div class='log-entry end'>End of processing for code: $code</div><br>";
                }
            }
        }
        ?>
    </div>
</body>
</html>
