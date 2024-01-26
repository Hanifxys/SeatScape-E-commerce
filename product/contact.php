<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Playfair Display SC', serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
    
    
        .highlight-text {
            color: #2c3e50;
        }
    
        .align-center {
            text-align: center;
        }
    
        .bold-text {
            font-weight: bold;
        }
    
        .question {
            font-size: 1rem;
            color: #7f8c8d;
        }
    
        .answer {
            color: #34495e;
        }
    
        .flex-container {
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between;
        }
    
        .flex-half {
            flex: 0 0 48%;  
            padding: 1rem;
            background-color: #ecf0f1;
            border-radius: 5px;
            margin: 1rem;
        }
    
        .hidden-answer {
            display: none;
        }
    
        .faq-entry {
            margin-bottom: 1rem;
        }
    
        .contact-section {
            background-color: white;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
    
        .input-field {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }
    
        .input-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #7f8c8d;
        }
    
        .highlight-button {
            background-color: #2c3e50;
            color: white;
            transition: background-color 0.3s ease;
        }
    
        .highlight-button:hover {
            background-color: #34495e;
        }
    
        section {
        padding-top: 50px;
     
    }
        @media (max-width: 900px) {
        section {
            padding-top: 50px;
        }       
            .align-center {
                margin-top: 90px;
            }
                .flex-container {
                    flex-direction: column;
                
                }
                .flex-half {
                    flex: 1 1 100%;  
                    margin: 0.5rem 0;
                }
                h3 {
                    font-size: 1.5rem;
                }
                .question, .input-label {
                    font-size: 0.9rem;
                }
                nav ul {
                    display: block;
                    text-align: center;
                }
                nav li {
                    display: block;
                    margin: 5px 0;
                }
                .about-company .container {
                    margin-bottom: 1rem;
                }
            }
    
    </style>
</head>
<body>
<?php include '../Templates/navbar.php' ?>

    <section>
        <h3 class="align-center ">Frequently Asked Questions & Contact us</h3>
        <div class="flex-container">
            <!-- FAQ on the Left -->
            <div class="flex-half">
                <!-- Sample FAQ item -->
                <div class="faq-entry">
                    <h6 class="question"><i class="far fa-paper-plane highlight-text pe-2"></i> How do your chairs enhance the indoor workshop experience?</h6>
                    <div class="hidden-answer answer">
                        <p>Our indoor workshop chairs are ergonomically designed to ensure that participants remain comfortable, allowing them to focus better throughout the workshop. They come with adjustable features, ensuring a personalized seating experience.</p>
                    </div>
                </div>
                <!-- Other FAQ items -->
                <div class="faq-entry">
                    <h6 class="question"><i class="far fa-paper-plane highlight-text pe-2"></i> What warranty do you offer on your chairs?</h6>
                    <div class="hidden-answer answer">
                        <p>Every chair comes with a 1-year warranty that covers any manufacturing defects. We prioritize our customers' satisfaction and ensure the quality of our products.</p>
                    </div>
                </div>

                <div class="faq-entry">
                    <h6 class="question"><i class="far fa-paper-plane highlight-text pe-2"></i> Do you provide discounts for bulk orders?</h6>
                    <div class="hidden-answer answer">
                        <p>Yes, we offer special discounts for bulk orders. For detailed pricing, you can contact our sales team who would be happy to assist you.</p>
                    </div>
                </div>

                <div class="faq-entry">
                    <h6 class="question"><i class="far fa-paper-plane highlight-text pe-2"></i> How should I maintain the chairs?</h6>
                    <div class="hidden-answer answer">
                        <p>Our chairs are designed to be low maintenance. For cleaning, just a simple wipe with a damp cloth should suffice. Avoid using harsh chemicals. For any specific concerns, feel free to contact our support team.</p>
                    </div>
                </div>

                <div class="faq-entry">
                    <h6 class="question"><i class="far fa-paper-plane highlight-text pe-2"></i> What materials are used in the manufacturing of the chairs?</h6>
                    <div class="hidden-answer answer">
                        <p>Our chairs are crafted using high-quality materials such as premium leather, durable plastics, and sturdy metal frames. We ensure that all the materials undergo strict quality checks to deliver a comfortable and long-lasting product to our customers.</p>
                    </div>
                </div>

                <div class="faq-entry">
                    <h6 class="question"><i class="far fa-paper-plane highlight-text pe-2"></i> How long does the delivery typically take after placing an order?</h6>
                    <div class="hidden-answer answer">
                        <p>After placing an order, the delivery typically takes between 5 to 7 business days. However, for bulk orders or customized chairs, the delivery time might vary. We always keep our customers updated regarding the delivery status.</p>
                    </div>
                </div>

            </div>
            <!-- Contact Us on the Right -->
            <div class="flex-half">
                <div class="contact-section">
                    <h4 class="align-center margin-bottom-medium highlight-text">Need Further Assistance?</h4>
                    <p class="align-center">Reach out to us and we'll be happy to help!</p>

                    <form action="https://formspree.io/f/mbjvrgbo" method="POST" class="margin-top-medium">
                        <div class="form-group margin-bottom-medium">
                            <label for="userEmail" class="input-label">Your Email</label>
                            <input type="email" class="input-field" id="userEmail" name="userEmail" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group margin-bottom-medium">
                            <label for="userMessage" class="input-label">Your Query</label>
                            <textarea class="input-field" id="userMessage" name="userMessage" rows="4" placeholder="How can we assist you?" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button highlight-button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include '../Templates/footer.php' ?>
</body>
</html>