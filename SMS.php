<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Notification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #E3F2FD;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .sms-form {
        background-color: #C8E6C9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }
    .sms-form h2 {
        margin-bottom: 20px;
        color: #388E3C;
        font-size: 24px;
    }
    .sms-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #4CAF50;
        text-align: left;
    }
    .sms-form input, 
    .sms-form textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #B0BEC5;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 16px;
    }
    .sms-form input:focus, 
    .sms-form textarea:focus {
        border-color: #00796B;
        outline: none;
    }
    .sms-form button {
        width: 100%;
        padding: 12px;
        background-color: #FFEB3B;
        color: #333;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
        margin-bottom: 10px;
    }
    .sms-form button:hover {
        background-color: #FBC02D;
        transform: scale(1.05);
    }
    .notification {
        display: none;
        text-align: center;
        margin-top: 10px;
        padding: 10px;
        border-radius: 8px;
    }
    .success {
        background-color: #D4EDDA;
        color: #155724;
    }
    .error {
        background-color: #F8D7DA;
        color: #721C24;
    }
    @media (max-width: 600px) {
        .sms-form {
            padding: 15px;
        }
    }
    </style>
</head>
<body>
    <div class="sms-form">
        <h2>Send SMS</h2>
        <button onclick="goBack()">Back</button>
        <form id="smsForm">
            <label for="to">To:</label>
            <input type="text" id="to" name="to" placeholder="Enter phone number" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
            
            <button type="submit">Send</button>
        </form>

        <div class="notification success" id="successMessage">
            SMS sent successfully!
        </div>
        <div class="notification error" id="errorMessage">
            Error sending SMS!
        </div>
    </div>

    <script>
        document.getElementById('smsForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let to = document.getElementById('to').value;
            let message = document.getElementById('message').value;

            let formData = new FormData();
            formData.append('to', to);
            formData.append('message', message);

            fetch('sms2.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('successMessage').style.display = 'block';
                    document.getElementById('errorMessage').style.display = 'none';
                } else {
                    document.getElementById('errorMessage').innerText = data.message;
                    document.getElementById('errorMessage').style.display = 'block';
                    document.getElementById('successMessage').style.display = 'none';
                }
            })
            .catch(error => {
                document.getElementById('errorMessage').innerText = "Error sending SMS!";
                document.getElementById('errorMessage').style.display = 'block';
                document.getElementById('successMessage').style.display = 'none';
            });
        });

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
