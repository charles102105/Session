<?php
ob_start();
session_start();

if (!empty($_POST['submit'])) {
    $_SESSION['q2'] = $_POST['q2'];
    
    $correct_answer = 'a'; 
    
    
    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }
    
    if ($_POST['q2'] == $correct_answer) {
        $_SESSION['score'] +=1;
    }
    
    header("Location: q3.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Question 3</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .quiz-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .decorative-line {
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
            margin-bottom: 20px;
        }

        .user-info {
            text-align: center;
            margin-bottom: 30px;
            padding: 15px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 12px;
            border: 1px solid rgba(102, 126, 234, 0.2);
        }

        .user-info p {
            color: #333;
            font-size: 16px;
            font-weight: 600;
        }

        .question-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .question-header h1 {
            color: #333;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .question-text {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            margin-bottom: 25px;
        }

        .question-text p {
            color: #333;
            font-size: 18px;
            font-weight: 500;
            margin: 0;
        }

        .options-container {
            margin-bottom: 30px;
        }

        .option {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            margin-bottom: 15px;
            background: #f8f9fa;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .option:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
        }

        .option input[type="radio"] {
            margin-right: 15px;
            width: 20px;
            height: 20px;
            accent-color: #667eea;
            cursor: pointer;
        }

        .option label {
            color: #333;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            flex: 1;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }

        
        .option input[type="radio"] {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #667eea;
            border-radius: 50%;
            margin-right: 15px;
            position: relative;
            cursor: pointer;
        }

        .option input[type="radio"]:checked {
            background: #667eea;
            border-color: #667eea;
        }

        .option input[type="radio"]:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
        }

        @media (max-width: 480px) {
            .quiz-container {
                padding: 30px 25px;
                margin: 10px;
            }
            
            .question-header h1 {
                font-size: 20px;
            }
            
            .question-text p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <div class="decorative-line"></div>
        
        <div class="user-info">
            <p><?php print "User " . $_SESSION['username']; ?></p>
        </div>

        <div class="question-header">
            <h1>Question 2</h1>
        </div>

        <div class="question-text">
            <p>Where was Jesus Born?</p>
        </div>
        
        <form action="q2.php" method="post">
            <div class="options-container">
                <div class="option">
                    <input type="radio" value="a" name="q2" id="option-a">
                    <label for="option-a">Bethlehem</label>
                </div>
                <div class="option">
                    <input type="radio" value="b" name="q2" id="option-b">
                    <label for="option-b">Nazareth</label>
                </div>
            </div>
            <input type="submit" value="Next Question" name="submit">
        </form>
    </div>

    

</body>
</html>