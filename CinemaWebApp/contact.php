<?php include("header.php") ?>
<style>
    body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background: url('images/backround.png') ; 
    background-size: cover;
    margin: 0;
    padding: 0;
    height: 100%;
    width: 100%;
}

.contact-container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.8);
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

form {
    margin-top: 20px;
}

input[type="email"], input[type="tel"], textarea {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

textarea {
    height: 100px;
}

button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

</style>
<!-- Contact container with content and form -->
<div class="contact-container" >
    <!-- Heading for the contact section -->
    <h2>Contact Us</h2>

    <!-- Introductory text for the contact section -->
    <p>If you have any questions, please don't hesitate to contact us:</p>

    <!-- Contact information: email and phone -->
    <p><strong>Email:</strong> info@example.com</p>
    <p><strong>Phone:</strong> +1234567890</p>

    <!-- Contact form with action pointing to contact_process.php, which will handle the form submission -->
    <form action="contact_process.php" method="post">
        <!-- Email input field -->
        <div class="form-group">
            <input type="email" class="form-control" name="contact_email" placeholder="Your Email" required>
        </div>

        <!-- Phone number input field -->
        <div class="form-group">
            <input type="tel" class="form-control" name="contact_phone" placeholder="Your Phone Number" required>
        </div>

        <!-- Message textarea -->
        <div class="form-group">
            <textarea class="form-control" name="contact_message" placeholder="Your Message" required></textarea>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>



<?php include("footer.php") ?>
