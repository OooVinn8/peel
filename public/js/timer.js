let detik = 12 * 60 * 60;

setInterval(() => {
  let h = String(Math.floor(detik / 3600)).padStart(2, "0");
  let m = String(Math.floor(detik % 3600 / 60)).padStart(2, "0");
  let s = String(detik % 60).padStart(2, "0");

  document.getElementById("jam").textContent = `${h} : ${m} : ${s}`;

  detik = detik > 0 ? detik - 1 : 12 * 60 * 60;