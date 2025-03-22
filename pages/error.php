<?php
// Get error message from URL if available
$error_message = $_GET['message'] ?? "You have been logged out or an error has occurred.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Error</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #34495e;
            --accent: #3498db;
            --danger: #e74c3c;
            --warning: #f39c12;
            --success: #2ecc71;
            --light: #f5f7fa;
            --dark: #2c3e50;
            --text: #333333;
        }
        
        body {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f7fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            position: relative;
        }
        
        .background-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(120deg, rgba(240, 244, 248, 0.8) 0%, rgba(237, 239, 245, 0.8) 100%);
            z-index: -1;
            opacity: 0.8;
        }
        
        .background-pattern::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233498db' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: -1;
        }
        
        .error-container {
            max-width: 600px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(44, 62, 80, 0.1);
            padding: 3rem;
            text-align: center;
            position: relative;
            z-index: 10;
            overflow: hidden;
        }
        
        .error-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(to right, var(--accent), #5dade2);
        }
        
        .icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(52, 152, 219, 0.1);
            position: relative;
        }
        
        .icon {
            font-size: 2.5rem;
            color: var(--accent);
        }
        
        h2 {
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: var(--dark);
            font-size: 1.75rem;
        }
        
        .message {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.75rem;
            font-weight: 400;
            border-left: 4px solid var(--danger);
            text-align: left;
        }
        
        .countdown-wrapper {
            margin: 1.75rem 0;
            position: relative;
            display: flex;
            justify-content: center;
        }
        
        .countdown {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--accent);
            position: relative;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .countdown-circle {
            position: absolute;
            width: 70px;
            height: 70px;
        }
        
        .circle-bg {
            fill: none;
            stroke: rgba(52, 152, 219, 0.1);
            stroke-width: 6;
        }
        
        .circle {
            fill: none;
            stroke: var(--accent);
            stroke-width: 6;
            stroke-linecap: round;
            transform: rotate(-90deg);
            transform-origin: center;
            transition: all 1s linear;
            stroke-dasharray: 188;
            stroke-dashoffset: 0;
        }
        
        .redirect-info {
            color: var(--secondary);
            font-size: 0.9rem;
            margin-bottom: 1.75rem;
        }
        
        .btn-redirect {
            background: linear-gradient(to right, var(--accent), #5dade2);
            color: white;
            border: none;
            padding: 0.85rem 2.5rem;
            font-weight: 500;
            border-radius: 30px;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-redirect:hover {
            background: linear-gradient(to right, #2980b9, #3498db);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.3);
            color: white;
            text-decoration: none;
        }
        
        @media (max-width: 576px) {
            .error-container {
                margin: 0 15px;
                padding: 2rem 1.5rem;
            }
            
            .icon-wrapper {
                width: 60px;
                height: 60px;
            }
            
            .icon {
                font-size: 1.8rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .countdown {
                font-size: 2rem;
                width: 60px;
                height: 60px;
            }
            
            .countdown-circle {
                width: 60px;
                height: 60px;
            }
        }
    </style>
    <!-- Redirect after 3 seconds -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let secondsLeft = 3;
            let countdownEl = document.getElementById('countdown');
            let circleEl = document.getElementById('circle');
            const circumference = 188; // 2 * PI * r (for 30px radius)
            
            function updateCountdown() {
                countdownEl.textContent = secondsLeft;
                
                // Update the circle animation
                let offset = circumference * ((3 - secondsLeft) / 3);
                circleEl.style.strokeDashoffset = offset;
                
                if (secondsLeft <= 0) {
                    window.location.href = 'login.php';
                } else {
                    secondsLeft--;
                    setTimeout(updateCountdown, 1000);
                }
            }
            
            updateCountdown();
        });
    </script>
</head>
<body>
    <!-- Background Pattern -->
    <div class="background-pattern"></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="error-container">
                    <div class="icon-wrapper">
                        <i class="fas fa-clock icon"></i>
                    </div>
                    <h2>Session Expired</h2>
                    
                    <div class="message">
                        <i class="fas fa-info-circle me-2"></i>
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                    
                    <div class="redirect-info">
                        <p>You will be redirected to the login page automatically.</p>
                    </div>
                    
                    <div class="countdown-wrapper">
                        <div class="countdown" id="countdown">3</div>
                        <svg class="countdown-circle">
                            <circle class="circle-bg" cx="35" cy="35" r="30"></circle>
                            <circle id="circle" class="circle" cx="35" cy="35" r="30"></circle>
                        </svg>
                    </div>
                    
                    <p class="mb-4 text-muted">seconds</p>
                    
                    <a href="login.php" class="btn btn-redirect">
                        <i class="fas fa-sign-in-alt me-2"></i> Login Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>