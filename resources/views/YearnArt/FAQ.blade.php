<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/faq.css">
<link rel="stylesheet" href="assets/css/navbar.css">
<link rel="stylesheet" href="assets/css/typing.css">
<link rel="stylesheet" href="assets/css/chatbot.css">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

<title>Yearn Art | FAQ</title>
<link rel="icon" href="assets/image/Yearn.jpg" type="image/png">

</head>
<body>
@include('home.header')

  <div class="container">
    <div class="faq">
        <p>Frequently Asked Question</p>
    </div>

    <div class="accordion">
        <div class="contentBx">
            <div class="label">
                <p>How can I place a custom order for a baby costume for monthly milestones?</p>
            </div>
            <div class="content">
                <p>To place a custom order, simply send a message through our Chatbot, YearnBot. Indicate theme or design you have in mind, along with the specific month you'd like the costume for.</p>
            </div>
        </div>
        <div class="contentBx">
            <div class="label">
                <p>Can I request a specific design for the crochet beachwear top?</p>
            </div>
            <div class="content">
                <p>Absolutely! I'd love to create a crochet beachwear top that matches your style and personality. Just reach out to me and share your preferences in terms of color, pattern, or any other details you have in mind. Whether you're going for a boho vibe or a vibrant tropical look, we'll make it happen!</p>
            </div>
        </div>
        <div class="contentBx">
            <div class="label">
                <p>Do you offer personalized crochet tote bags?</p>
            </div>
            <div class="content">
                <p>Yes, we do! Our crochet tote bags are not only practical but also stylish. If you're looking to add a personal touch, we can definitely embroider a name or a cute design on the bag. Let me know your preferences, and we'll create a personalized tote that you'll love carrying around! </p>
            </div>
        </div>
        <div class="contentBx">
            <div class="label">
                <p>How long does it take to receive a customized item?</p>
            </div>
            <div class="content">
                <p>As each item is handmade with love, the time required can vary depending on the complexity and current order queue. Generally, for baby costumes and beachwear tops, it takes around 2-3 weeks to complete and ship your order. For personalized tote bags, it usually takes 1-2 weeks. I'll keep you updated throughout the process, so you're always in the loop!</p>
            </div>
        </div>
        <div class="contentBx">
            <div class="label">
                <p>Can I choose the colors for my custom order?</p>
            </div>
            <div class="content">
                <p>Absolutely! Color choices are what make each item unique and special. You can choose from a wide variety of colors for your baby costume, beachwear top, or tote bag. If you need help deciding, don't hesitate to ask. I'm here to offer suggestions and make sure you're thrilled with the final result!</p>
            </div>
        </div>
        <div class="contentBx">
            <div class="label">
                <p>Are your crochet items safe for babies?</p>
            </div>
            <div class="content">
                <p> Safety is a top priority when creating items for little ones. Rest assured, all our crochet products are made with baby-friendly materials that are soft, gentle, and free from any harmful substances. We also ensure that all pieces are securely attached, making them safe for your precious bundle of joy.</p>
            </div>
        </div>
        <div class="contentBx">
            <div class="label">
                <p>How do I care for my crochet items?</p>
            </div>
            <div class="content">
                <p>Caring for your crochet items is easy-peasy! Hand washing is generally recommended to maintain the shape and quality. Gently soak the item in lukewarm water with a mild detergent, then rinse and lay it flat to dry. Avoid wringing or twisting the crochet pieces. With a little love and care, your crochet creations will last for a long time! 

 

                    I hope these FAQs help you provide valuable information to your customers. If you need any further assistance, feel free to ask. Happy crocheting! </p>
            </div>
        </div>
    </div>
  </div>

  <script>
    const accordion = document.getElementsByClassName
    ('contentBx');

    for (i = 0; i<accordion.length; i++){
        accordion[i].addEventListener('click', function(){
            this.classList.toggle('active')
        })
    }
  </script>

@include ('YearnArt.chatbot')
@include ('YearnArt.script')
</body>
</html>

