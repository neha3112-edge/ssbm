

<!-- <div class="multicolor-border"></div> -->
    <div id="footer">
    <div class="container">
    <div class="footer-section">
            <div class="footer-column"><br>
                <img src="assets/img/ssbm-logo-webp.webp" alt="logo-img" width="50%"/><br><br>
                  <h2 style="font-size:30px;">Got a Query ?<br> Let Us Guide You</h2>
               
<!-- <button class="enquireNowBtn">Enquire Now</button> -->
              
            </div>
            <div class="footer-column">
                <h2>DBA Specialization</h2>
               <br>
				      <p>Global and International Management<br>
                      <p>Cybersecurity Management<br>
                      <p>Tax Management<br>
                      <p>Finance and banking<br>
                      <p>Marketing<br>
                      <p>Operations Management<br>
                      <p>Strategic Management<br>
                      <p>Entrepreneurship<br>
                      <p>IT Management<br>
                      <p>Energy Management<br>
                      <p>Health care Management<br>
                      <p>Data Science<br>
                      <p>Machine Learning<br>
                      <p>Finance<br>
                      <p>International Business Leadership<br>
                      <p>Global Supplychain Management<br>
                      <p>Accounting<br>
                      <p>AML Compliance<br>
            </div>
            <div class="footer-column">
                <h2>QUICK LINKS</h2><br>
				<p><a href="#" style="text-decoration:none;">Accreditations</a></p>
				<p><a href="#" style="text-decoration:none;">Advantages</a></p>
				<p><a href="#faqs" style="text-decoration:none;">FAQ</a></p>
                <br/>
            </div> 
        </div>
      
        
    
   
     
    </div>
</div>


<div id="footer-bottom-bar">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
            <!--<p>Home | About | Courses | FAQ</p>-->
            <center><hr/></center>
            <p>&copy; <?php echo date("Y"); ?>  This information is provided by SODE Counselling Services LLP. All university names, logos, and trademarks mentioned are used for informational purposes only. We are not a university or an admission authority. <br><span class="disclaimer_popup" onclick="disclaimerModal()" style="color:#8DB3F0; font-size:14px; cursor:pointer; font-weight:bold; text-decoration:underline;">Disclaimer</span></p>
            </div>
        </div>
    </div>
</div>
<?php include 'popup.php'; ?>
<script>
//     start on scroll popup

  window.addEventListener('scroll', function () {
    const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrolledPercentage = (window.scrollY / scrollableHeight) * 100;

    if (scrolledPercentage >= 50) {
      const modal = document.getElementById('myModal');
      modal.style.display = 'flex';
      window.removeEventListener('scroll', arguments.callee);
    }
  });

  document.getElementById('closeButton').addEventListener('click', function () {
    const modal = document.getElementById('myModal');
    modal.style.display = 'none';
  });
    </script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


        <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        // Function to get the value of a URL parameter
        function getQueryParam(param) {
            var searchParams = new URLSearchParams(window.location.search);
            return searchParams.get(param) || ''; // Return an empty string if the parameter is not found
        }

        // Get all forms on the page
        var forms = document.querySelectorAll('form');

        // Loop through each form to set the values
        forms.forEach(function(form) {
            form.querySelector('#sub_source').value = getQueryParam('sub_source');
            form.querySelector('#utm_source').value = getQueryParam('utm_source');
            form.querySelector('#utm_campaign').value = getQueryParam('utm_campaign');
            form.querySelector('#utm_medium').value = getQueryParam('utm_medium');
            form.querySelector('#utm_term').value = getQueryParam('utm_term');

            // Get the current URL
            const currentURL = window.location.href;

            // Remove UTM parameters and fragments from the URL
            const urlWithoutParams = currentURL.split(/[?#]/)[0];

            // Set the extracted URL to the input field
            form.querySelector('#page_url').value = urlWithoutParams;
        });
    });
</script>