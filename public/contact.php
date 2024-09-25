<?php
session_start();
include '../includes/config.php';
?>

<?php include '../includes/head.php'; ?>
<body style="  background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/header.php'; ?>

<section class="info_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 info_links">
          <h4>
            Contact Us
          </h4>
          <ul>
            <li >
              <a href="<?php echo PUBLIC_URL; ?>">
                Home
              </a>
            </li>
            <li>
              <a href="<?php echo PUBLIC_URL; ?>/about.php">
                About
              </a>
            </li>
            <li class="active">
              <a class="" href="<?php echo PUBLIC_URL; ?>/contact.php">
                Contact
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h4>
            Get in Touch
          </h4>
          <p>
            We'd love to hear from you. Send us a message and we'll get back to you as soon as possible.
          </p>
        </div>
        <div class="col-md-3">
          <div class="info_social">
            <h4>
              Contact Information
            </h4>
            <p>
              Address: 123 Main St, Anytown, USA 12345<br>
              Phone 1: (+959) 798174380<br>
              Phone 2: (+959) 974847753<br>
              Email: <a href="mailto:t.thantunaung@gmail.com">info@m2y2.com</a>
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info_form">
            <h4>
              Send a Message
            </h4>
            <form action="" id="contactForm">
              <input id="name" type="text" placeholder="Your Name"  required/>
              <input id="email" type="email" placeholder="Your Email"  required/>
              <input id="subj" type="text" placeholder="Subject"  required/>
              <textarea id="msg" placeholder="Message" required></textarea>
              <button id="sendButton" type="submit">
                Send Message
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include '../includes/foot.php'; ?>
</body>
</html>