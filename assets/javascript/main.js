document.addEventListener("DOMContentLoaded", function () {

    // --- 1. Account Dropdown Logic ---
    const accountImage = document.querySelector('.account img');
    if (accountImage) {
        accountImage.addEventListener('click', function (e) {
            e.stopPropagation(); // Stops the click from immediately hitting the document listener
            const account = this.closest('.account');
            if (account) {
                account.classList.toggle('active');
            }
        });

        // Close dropdown when clicking anywhere else on the page
        document.addEventListener('click', function (e) {
            const account = document.querySelector('.account');
            if (account && !account.contains(e.target)) {
                account.classList.remove('active');
            }
        });
    }

    // --- 2. Login Modal Logic ---
    const loginModal = document.getElementById('loginModal');
    const startButton = document.querySelector('.button-primary'); // The button that opens login
    const loginClose = document.getElementById("loginClose"); // The 'X' button inside login modal

    if (startButton && loginModal) {
        startButton.addEventListener('click', function (e) {
            // Only prevent default if it's an anchor tag used as a button
            if (this.tagName === 'A') e.preventDefault();
            loginModal.classList.remove('hidden');
        });
    }

    if (loginClose && loginModal) {
        loginClose.addEventListener('click', function () {
            loginModal.classList.add('hidden');
        });
    }

    // Close Login Modal by clicking on the dark background
    if (loginModal) {
        loginModal.addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    }

    // --- 3. Random Car Button Logic ---
    const randomCarBtn = document.getElementById("randomCarBtn");
    if (randomCarBtn) {
        const ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        const randomId = ids[Math.floor(Math.random() * ids.length)];
        // Note: Check if the path needs to be "/pages/..." depending on where this JS runs
        randomCarBtn.href = "pages/car-detail.php?id=" + randomId;
    }

    // --- 4. Filter Modal Logic ---
    const filterModal = document.getElementById('filterModal');
    const filterToggle = document.getElementById('filterToggle'); // The search icon/button
    const filterClose = document.getElementById('filterClose');   // The 'X' inside filter modal

    if (filterToggle && filterModal) {
        filterToggle.addEventListener('click', function (e) {
            e.preventDefault();
            // Use 'show' class or inline style depending on your CSS
            filterModal.classList.add('show'); 
            filterModal.style.display = "block"; 
        });
    }

    if (filterClose && filterModal) {
        filterClose.addEventListener('click', function () {
            filterModal.classList.remove('show');
            filterModal.style.display = "none";
        });
    }

    // Close Filter Modal by clicking on the dark background
    window.addEventListener('click', function (event) {
        if (event.target === filterModal) {
            filterModal.classList.remove('show');
            filterModal.style.display = "none";
        }
    });

});