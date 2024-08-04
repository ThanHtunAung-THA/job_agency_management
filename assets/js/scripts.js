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
})