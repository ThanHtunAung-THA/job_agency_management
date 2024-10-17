// Email function
function sendEmail() {
  var name = document.getElementById('name').value;
  var email = document.getElementById('email').value;
  var subj = document.getElementById('subj').value;
  var msg = document.getElementById('msg').value;

  var mailtoLink = 'mailto:t.thantunaung@gmail.com?subject=Contact%20Form%20Submission&body=' +
    'Name: ' + encodeURIComponent(name) + '%0D%0A' +
    'Email: ' + encodeURIComponent(email) + '%0D%0A' +
    'Subj: ' + encodeURIComponent(subj) + '%0D%0A' +
    'Message: ' + encodeURIComponent(msg);

  window.location.href = mailtoLink;
}

// Popup message box function
function popupMessageBox() {
  const popupMessage = document.getElementById('popup-message');
  const closePopup = document.getElementById('close-popup');

  if (popupMessage && closePopup) {
    closePopup.addEventListener('click', () => {
      popupMessage.style.display = 'none';
    });

    popupMessage.addEventListener('click', (e) => {
      if (e.target === popupMessage) {
        popupMessage.style.display = 'none';
      }
    });
  }
}

// Show thumbnail function
function showThumbnail(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var thumbnail = document.getElementById('thumbnail-container');
      thumbnail.innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;">';
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Initialize tooltip feature function
function initTooltips() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });
}

// Get current year function
function getYear() {
  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  document.querySelector("#displayYear").innerHTML = currentYear;
}
  
// Nice select function
function niceSelect() {
  $(document).ready(function () {
    $('select').niceSelect();
  });
}
  
// Search bar function
function searchBar() {
  var searchBar = document.getElementById('searchBar').value.trim();
  if (searchBar !== '') {
    window.location.href = '/ojc.com/jobs/search.php?q=' + searchBar;
  }
}

function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('collapsed');
}

// Run functions on page load
document.addEventListener('DOMContentLoaded', function () {
  popupMessageBox();
  initTooltips();
  getYear();
  niceSelect();
});

// Add event listener to send button
document.getElementById('sendButton').addEventListener('click', sendEmail);

