<!DOCTYPE html>
<html>
<head>
    <title>Job Application System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #2563eb, #1e40af);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .landing-container {
            background: rgba(255, 255, 255, 0.95);
            color: #1e3a8a;
            padding: 50px;
            border-radius: 12px;
            text-align: center;
            max-width: 600px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .landing-container h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .landing-container p {
            font-size: 16px;
            margin-bottom: 25px;
        }

        .features li {
            margin: 10px 0;
            text-align: left;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: #2563eb;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            margin: 5px;
        }

        .btn:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

<div class="landing-container">

    <!-- Temporary placeholder logo -->
  <img src="logo.jpg" alt="Job Application Logo" style="margin-bottom:20px; width:100px;">


    <h1>Welcome to Job Application System</h1>
    <p>Manage your job applications efficiently and track progress easily.</p>

    <ul class="features">
        <li>✔ User Registration and Login</li>
        <li>✔ Dashboard to view applications</li>
        <li>✔ Real-time task progress tracking</li>
        <li>✔ Secure password storage</li>
    </ul>

    <!-- Buttons -->
    <div style="margin-top:30px;">
        <a href="login_choice.php" class="btn">Login</a>
        <a href="registration.php" class="btn">Register</a>
    </div>

</div>

</body>
</html>
