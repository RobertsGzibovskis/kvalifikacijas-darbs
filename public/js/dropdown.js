document.addEventListener('DOMContentLoaded', function () {
    var gameStatusDropdown = document.getElementById('gameStatus');
    var scheduledFields = document.getElementById('scheduledFields');

    gameStatusDropdown.addEventListener('change', function () {
      if (gameStatusDropdown.value === 'Scheduled') {
        scheduledFields.classList.remove('hidden');
      } else {
        scheduledFields.classList.add('hidden');
      }
    });
  });
