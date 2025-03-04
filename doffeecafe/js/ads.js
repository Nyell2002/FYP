const slogans = [
  "Ingat Kopi, Ingat Doffee! \u{2B24} Ingat Kopi, Ingat Doffee! \u{2B24} Ingat Kopi, Ingat Doffee!",
  "Your Coffee, Your Way! \u{2B24} Your Coffee, Your Way!  \u{2B24} Your Coffee, Your Way!",
  "Brewed to Perfection! \u{2B24} Brewed to Perfection! \u{2B24} Brewed to Perfection!",
];

const sloganElement = document.querySelector(".slogan");
let index = 0;

setInterval(() => {
  sloganElement.textContent = slogans[index];
  index = (index + 1) % slogans.length; // Loop through slogans
}, 15000); // Change text every 5 seconds
