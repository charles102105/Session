<?php
ob_start();
session_start();

$correct_answers = [
    'q1' => 'b',
    'q2' => 'a',
    'q3' => 'a',
    'q4' => 'a',
    'q5' => 'a',
    'q6' => 'a',
    'q7' => 'b',
    'q8' => 'a',
    'q9' => 'a',
    'q10' => 'b'
];

$score = 0;
foreach ($correct_answers as $key => $correct) {
    if (isset($_SESSION[$key]) && $_SESSION[$key] === $correct) {
        $score++;
    }
}

$_SESSION['score'] = $score;


$total_questions = 10;
$percentage = ($score / $total_questions) * 100;
$display_score = $score;


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


function getResultMessage($percentage) {
    if ($percentage >= 90) {
        return ["Excellent!", "Outstanding performance!", "#4CAF50"];
    } elseif ($percentage >= 80) {
        return ["Great Job!", "Very good performance!", "#2196F3"];
    } elseif ($percentage >= 70) {
        return ["Good Work!", "Good performance!", "#FF9800"];
    } elseif ($percentage >= 60) {
        return ["Not Bad!", "You can do better!", "#FF5722"];
    } else {
        return ["Keep Trying!", "Practice makes perfect!", "#F44336"];
    }
}

list($title, $message, $color) = getResultMessage($percentage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Quiz Results</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

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
      text-align: center;
    }

    .decorative-line {
      height: 4px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 2px;
      margin-bottom: 20px;
    }

    .user-info {
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

    .result-header h1 {
      color: #333;
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .score-circle {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin: 20px auto;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      background: conic-gradient(<?php echo $color; ?> <?php echo min($percentage * 3.6, 360); ?>deg, #e1e5e9 0deg);
    }

    .score-inner {
      width: 120px;
      height: 120px;
      background: white;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .score-number {
      font-size: 32px;
      font-weight: bold;
      color: <?php echo $color; ?>;
      margin-bottom: 5px;
    }

    .score-text {
      font-size: 12px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .result-details {
      background: #f8f9fa;
      padding: 25px;
      border-radius: 12px;
      margin: 30px 0;
      border-left: 4px solid <?php echo $color; ?>;
    }

    .result-title {
      font-size: 24px;
      font-weight: bold;
      color: <?php echo $color; ?>;
      margin-bottom: 10px;
    }

    .result-message {
      font-size: 16px;
      color: #333;
      margin-bottom: 20px;
    }

    .performance-bar {
      width: 100%;
      height: 8px;
      background: #e1e5e9;
      border-radius: 4px;
      margin: 15px 0;
    }

    .performance-fill {
      height: 100%;
      background: <?php echo $color; ?>;
      border-radius: 4px;
      width: 0%;
      transition: width 1s ease-out;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-top: 20px;
    }

    .stat-item {
      background: white;
      padding: 15px;
      border-radius: 8px;
      border: 1px solid #e1e5e9;
    }

    .stat-number {
      font-size: 24px;
      font-weight: bold;
      color: #333;
      margin-bottom: 5px;
    }

    .stat-label {
      font-size: 14px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .action-buttons {
      margin-top: 30px;
      display: flex;
      gap: 15px;
    }

    .btn {
      flex: 1;
      padding: 15px;
      border: none;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
      text-decoration: none;
      text-align: center;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .btn-secondary {
      background: #f8f9fa;
      color: #333;
      border: 2px solid #e1e5e9;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .btn:active {
      transform: translateY(0);
    }

    @media (max-width: 480px) {
      .quiz-container { padding: 30px 25px; margin: 10px; }
      .result-header h1 { font-size: 24px; }
      .score-circle { width: 120px; height: 120px; }
      .score-inner { width: 95px; height: 95px; }
      .score-number { font-size: 24px; }
      .action-buttons { flex-direction: column; }
    }
  </style>
</head>
<body>
  <div class="quiz-container">
    <div class="decorative-line"></div>

    <div class="user-info">
      <p><?php echo "User: " . $_SESSION['username']; ?></p>
    </div>

    <div class="result-header">
      <h1>Quiz Complete!</h1>
    </div>

    <div class="score-circle">
      <div class="score-inner">
        <div class="score-number"><?php echo $display_score; ?>/<?php echo $total_questions; ?></div>
        <div class="score-text">Score</div>
      </div>
    </div>

    <div class="result-details">
      <div class="result-title"><?php echo $title; ?></div>
      <div class="result-message"><?php echo $message; ?></div>

      <div class="performance-bar">
        <div class="performance-fill"></div>
      </div>

      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number"><?php echo number_format($percentage, 1); ?>%</div>
          <div class="stat-label">Percentage</div>
        </div>
        <div class="stat-item">
          <div class="stat-number"><?php echo $total_questions - $display_score; ?></div>
          <div class="stat-label">Incorrect</div>
        </div>
      </div>
    </div>

    <div class="action-buttons">
      <a href="q1.php" class="btn btn-secondary">Take Again</a>
    </div>
  </div>

  <script>
    window.addEventListener('load', function() {
      const performanceFill = document.querySelector('.performance-fill');
      setTimeout(() => {
        performanceFill.style.width = '<?php echo min($percentage, 100); ?>%';
      }, 500);
    });
  </script>
</body>
</html>
<?php ob_end_flush(); ?>
