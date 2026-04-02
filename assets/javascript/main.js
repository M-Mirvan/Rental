const accountImage = document.querySelector('.account img');
if (accountImage) {
    accountImage.addEventListener('click', function () {
        const account = this.closest('.account');
        account.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
        const account = document.querySelector('.account');
        if (account && !account.contains(e.target)) {
            account.classList.remove('active');
        }
    });
}

const startButton = document.querySelector('.button-primary');
if (startButton) {
    startButton.addEventListener('click', function(e) {
        e.preventDefault();
        const modal = document.getElementById('loginModal');
        if (modal) modal.classList.remove('hidden');
    });
}

const modalClose = document.querySelector('.modal-close');
if (modalClose) {
    modalClose.addEventListener('click', function () {
        const modal = document.getElementById('loginModal');
        if (modal) modal.classList.add('hidden');
    });
}

const modal = document.getElementById('loginModal');
if (modal) {
    modal.addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
}



document.addEventListener("DOMContentLoaded", function() {
    const ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; // bestaande auto IDs
    const randomId = ids[Math.floor(Math.random() * ids.length)];
    
    document.getElementById("randomCarBtn").href = "pages/car-detail.php?id=" + randomId;
});

// /assets/js/search-filter.js
document.addEventListener("DOMContentLoaded", function() {
  const filterToggle = document.getElementById('filterToggle');
  const filterModal = document.getElementById('filterModal');
  const filterClose = document.getElementById('filterClose');

  // Open modal
  filterToggle.addEventListener('click', () => {
    filterModal.classList.add('show');
  });

  // Close modal
  filterClose.addEventListener('click', () => {
    filterModal.classList.remove('show');
  });

  // Close by clicking outside content
  filterModal.addEventListener('click', (e) => {
    if (e.target === filterModal) {
      filterModal.classList.remove('show');
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
    // De modal zelf
    const modal = document.getElementById('filterModal'); 
    // De knop die de modal OPENT (bij de zoekbalk)
    const openBtn = document.getElementById('filterToggle');
    // De knop die de modal SLUIT (het kruisje)
    const closeBtn = document.getElementById('filterClose');

    // 1. Open de modal
    if (openBtn && modal) {
        openBtn.onclick = function(e) {
            e.preventDefault();
            modal.style.display = "block";
        }
    }

    // 2. Sluit de modal via de X
    if (closeBtn && modal) {
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
    }

    // 3. Sluit de modal als je buiten de witte box klikt
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});