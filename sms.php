<!DOCTYPE html>
<html>
<head>
    <title>Send SMS</title>
</head>
<body>
    <h1>Send SMS with Africa's Talking</h1>
    <form method="post" action="send_sms.php">
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>
        <br>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <br>
        <button type="submit">Send SMS</button>

        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your Africa's Talking API credentials
    $username = 'your_username';
    $apiKey = 'your_api_key';

    // Get data from the HTML form
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Set up the SMS parameters
    $smsData = [
        'to' => $phone,
        'message' => $message,
    ];

    // Send the SMS using cURL
    $url = 'https://api.africastalking.com/version1/messaging';

    $headers = [
        'Content-Type: application/x-www-form-urlencoded',
        'apiKey: ' . $apiKey,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($smsData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Process the API response
    $result = json_decode($response);

    if ($result->status == "Success") {
        echo "SMS sent successfully!";
    } else {
        echo "SMS sending failed. Error: " . $result->message;
    }
}
?>

    </form>
</body>
</html>
