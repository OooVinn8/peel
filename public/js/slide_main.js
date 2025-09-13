document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".slides");
  const dots = document.querySelectorAll(".dot");
  let currentSlide = 0;

  function showSlide(n) {
    slides.forEach((slide, i) => {
      slide.classList.add("hidden");
      dots[i].classList.remove("bg-blue-600");
      dots[i].classList.add("bg-gray-400");
    });
    slides[n].classList.remove("hidden");
    dots[n].classList.remove("bg-gray-400");
    dots[n].classList.add("bg-blue-600");
    currentSlide = n;
  }

  dots.forEach((dot, i) => {
    dot.addEventListener("click", () => showSlide(i));
  });

  showSlide(0);
});
