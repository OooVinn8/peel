document.addEventListener('DOMContentLoaded', () => {
    const timer = document.querySelector('[data-expire]');
    let expireTime = new Date(timer.getAttribute('data-expire')).getTime();

    const menus = ["Menu A", "Menu B", "Menu C", "Menu D"]; 
    let currentMenuIndex = 0;

    function updateMenu() {
        currentMenuIndex = (currentMenuIndex + 1) % menus.length;
        document.getElementById('menu').innerText = menus[currentMenuIndex];
    }

    const interval = setInterval(() => {
        const now = new Date().getTime();
        let distance = expireTime - now;

        if (distance <= 0) {
            // Reset 24 jam dari waktu sekarang
            expireTime = now + 24 * 60 * 60 * 1000; 

            // Ganti menu
            updateMenu();
            distance = expireTime - now;
        }

        let hours = Math.floor(distance / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        hours = hours.toString().padStart(2, '0');
        minutes = minutes.toString().padStart(2, '0');
        seconds = seconds.toString().padStart(2, '0');

        document.getElementById('jam').innerText = `${hours} : ${minutes} : ${seconds}`;
    }, 1000);
});