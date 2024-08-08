// ========= sending email =========
document.getElementById('sendButton').addEventListener('click', function() {
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
  });

// ========= popup msg box ==========
document.addEventListener('DOMContentLoaded', (event) => {
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
});

// ========= imgae thumbnail ==========
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

// ========= Initialize tooltip feature =========
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
});

// ========= get current year ==========
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}
getYear();

// nice select
$(document).ready(function () {
    $('select').niceSelect();
});


// ========= search btn in jobs.php ==========
$(document).ready(function(){
  $("#searchBtn").click(function(){
    var searchTerm = $("#searchBar").val();
    $.ajax({
      type: "POST",
      url: "search-jobs.php",
      data: {searchTerm: searchTerm},
      success: function(data){
        $("#job-list").html(data);
      }
    });
  });
});

// ========= search in jobs.php ==========
// document.getElementById('searchBtn').addEventListener('click', function() {
//   var searchBar = document.getElementById('searchBar').value.trim();
//   if (searchBar !== '') {
//     window.location.href = 'search.php?q=' + searchBar;
//   }
// });