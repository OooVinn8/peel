const slidesTrack = document.getElementById("slidesTrack");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const dots = document.querySelectorAll(".dot");

    let currentIndex = 0;
    const totalSlides = dots.length;

    function updateUI() {
        slidesTrack.style.transform = `translateX(-${currentIndex * 100}%)`;

        dots.forEach((dot, i) => {
            dot.classList.toggle("bg-blue-600", i === currentIndex);
            dot.classList.toggle("bg-gray-400", i !== currentIndex);
        });

        prevBtn.style.opacity = currentIndex === 0 ? "0" : "1";
        prevBtn.style.pointerEvents = currentIndex === 0 ? "none" : "auto";

        nextBtn.style.opacity = currentIndex === totalSlides - 1 ? "0.5" : "1";
    }

    nextBtn.addEventListener("click", () => {
        if (currentIndex < totalSlides - 1) {
            currentIndex++;
            updateUI();
        }
    });

    prevBtn.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateUI();
        }
    });

    dots.forEach(dot => {
        dot.addEventListener("click", () => {
            currentIndex = parseInt(dot.dataset.index);
            updateUI();
        });
    });

    updateUI();