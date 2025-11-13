<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $company = htmlspecialchars(trim($_POST['company']));
    $budget = htmlspecialchars(trim($_POST['budget']));
    $timeline = htmlspecialchars(trim($_POST['timeline']));
    $message = htmlspecialchars(trim($_POST['message']));
    $newsletter = isset($_POST['newsletter']) ? 'Yes' : 'No';
    
    // Process services
    $services = '';
    if (isset($_POST['services']) && is_array($_POST['services'])) {
        $services = implode(', ', $_POST['services']);
    }
    
    // Email configuration
    $to = "info@amateta.com, order@amateta.com"; // Replace with your email
    $subject = "New Contact Form Submission - AMATETA Techs & Designs";
    
    // Email content
    $email_content = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .header { background: #0a2540; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .field { margin-bottom: 15px; }
            .field-label { font-weight: bold; color: #0a2540; }
            .footer { background: #f8fafc; padding: 15px; text-align: center; font-size: 12px; color: #64748b; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>New Contact Form Submission</h2>
            <p>AMATETA Techs & Designs</p>
        </div>
        <div class='content'>
            <div class='field'>
                <span class='field-label'>Name:</span> $name
            </div>
            <div class='field'>
                <span class='field-label'>Email:</span> $email
            </div>
            <div class='field'>
                <span class='field-label'>Phone:</span> " . ($phone ? $phone : 'Not provided') . "
            </div>
            <div class='field'>
                <span class='field-label'>Company:</span> " . ($company ? $company : 'Not provided') . "
            </div>
            <div class='field'>
                <span class='field-label'>Services Interested In:</span> " . ($services ? $services : 'Not specified') . "
            </div>
            <div class='field'>
                <span class='field-label'>Budget:</span> " . ($budget ? $budget : 'Not specified') . "
            </div>
            <div class='field'>
                <span class='field-label'>Timeline:</span> " . ($timeline ? $timeline : 'Not specified') . "
            </div>
            <div class='field'>
                <span class='field-label'>Newsletter Subscription:</span> $newsletter
            </div>
            <div class='field'>
                <span class='field-label'>Message:</span><br>
                <p>$message</p>
            </div>
        </div>
        <div class='footer'>
            <p>This email was sent from the contact form on AMATETA Techs & Designs website.</p>
            <p>© " . date('Y') . " AMATETA Techs & Designs. All rights reserved.</p>
        </div>
    </body>
    </html>
    ";
    
    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        // Success response
        echo "<script>
            alert('Thank you for your message! We will get back to you within 24 hours.');
            window.location.href = 'contact.html';
        </script>";
    } else {
        // Error response
        echo "<script>
            alert('Sorry, there was an error sending your message. Please try again or contact us directly.');
            window.history.back();
        </script>";
    }
    
    // Optional: Save to database or file (uncomment if needed)
    /*
    $data = array(
        'timestamp' => date('Y-m-d H:i:s'),
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'company' => $company,
        'services' => $services,
        'budget' => $budget,
        'timeline' => $timeline,
        'message' => $message,
        'newsletter' => $newsletter
    );
    
    // Save to JSON file
    $file = 'contact_submissions.json';
    $current_data = file_exists($file) ? json_decode(file_get_contents($file), true) : array();
    $current_data[] = $data;
    file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT));
    */
    
} else {
    // Not a POST request, redirect to contact page
    header("Location: contact.html");
    exit();
}
?>