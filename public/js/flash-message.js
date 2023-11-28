document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function(){
        var flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.display = 'none';
        }
    }, 5000); // 5000 milliseconds = 5 seconds, adjust as needed
});
