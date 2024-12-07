document.addEventListener("DOMContentLoaded", (event) => {
  // Slider 1
  let index1 = 0;
  const slides1 = document.querySelectorAll(".container-1-slide");
  const totalSlides1 = slides1.length;

  document
    .getElementById("container-1-left-arrow")
    .addEventListener("click", () => {
      index1 = index1 > 0 ? index1 - 1 : totalSlides1 - 1;
      updateSlidePosition(slides1, index1);
    });

  document
    .getElementById("container-1-right-arrow")
    .addEventListener("click", () => {
      index1 = index1 < totalSlides1 - 1 ? index1 + 1 : 0;
      updateSlidePosition(slides1, index1);
    });

  // Slider 2
  let index2 = 0;
  const slides2 = document.querySelectorAll(".container-2-slide");
  const totalSlides2 = slides2.length;

  const roomNames = [
    "Normal Room",
    "Funky Room",
    "Lumberjack Room",
    "Royal Room",
  ];
  const roomDescriptions = [
    "A Simple but comfy room!",
    "A funky room with vibrant colors!",
    "A rugged room with a lumberjack theme!",
    "A luxurious room fit for royalty!",
  ];
  const roomPrices = ["$350 / Day", "$450 / Day", "$550 / Day", "$999 / Day"];

  document
    .getElementById("container-2-left-arrow")
    .addEventListener("click", () => {
      index2 = index2 > 0 ? index2 - 1 : totalSlides2 - 1;
      updateSlidePosition(slides2, index2);
      updateRoomDetails(index2);
    });

  document
    .getElementById("container-2-right-arrow")
    .addEventListener("click", () => {
      index2 = index2 < totalSlides2 - 1 ? index2 + 1 : 0;
      updateSlidePosition(slides2, index2);
      updateRoomDetails(index2);
    });

  function updateSlidePosition(slides, index) {
    for (let slide of slides) {
      slide.style.transform = `translateX(-${index * 100}%)`;
    }
  }

  function updateRoomDetails(index) {
    document.querySelector(".container-2-content-subtitle").textContent =
      roomNames[index];
    document.querySelector(".container-2-content-description").textContent =
      roomDescriptions[index];
    document.querySelector(".container-2-price").textContent =
      roomPrices[index];
  }

  // Slider 3
  let index3 = 0;
  const slides3 = document.querySelectorAll(".container-3-slide");
  const totalSlides3 = slides3.length;

  const touristSpotNames = [
    "Goo Lagoon",
    "Mt. Bikini",
    "Jellyfish Fields",
  ];
  const touristSpotDescriptions = [
    "This sunny lagoon is the perfect spot for a day of fun and relaxation. Visitors can enjoy a variety of water sports, sunbathing on the sandy shores, or simply taking a refreshing dip in the clear, gooey waters. With plenty of food stands and shops nearby, it's easy to make a full day out of your visit to Goo Lagoon. Whether you're looking to catch some waves or just unwind under the sun, Goo Lagoon has something for everyone!",
    "Mt. Bikini offers breathtaking views and thrilling hiking trails. Visitors can explore the diverse flora and fauna unique to this underwater mountain. Don't miss the opportunity to visit the summit, where you can see the entire Bikini Bottom and beyond. It's a perfect spot for adventurers and nature lovers.",
    "Jellyfish Fields is a vibrant and lively destination, home to the famous jellyfish of Bikini Bottom. Visitors can safely observe jellyfish in their natural habitat or take part in the thrilling jellyfish catching activities. It's a must-visit spot for anyone who loves the wonders of marine life and the thrill of adventure.",
  ];

  document
    .getElementById("container-3-left-arrow")
    .addEventListener("click", () => {
      index3 = index3 > 0 ? index3 - 1 : totalSlides3 - 1;
      updateSlidePosition(slides3, index3);
      updateTouristSpotDetails(index3);
    });

  document
    .getElementById("container-3-right-arrow")
    .addEventListener("click", () => {
      index3 = index3 < totalSlides3 - 1 ? index3 + 1 : 0;
      updateSlidePosition(slides3, index3);
      updateTouristSpotDetails(index3);
    });

  function updateTouristSpotDetails(index) {
    document.getElementById("tourist-spot-name").textContent =
      touristSpotNames[index];
    document.getElementById("tourist-spot-description").textContent =
      touristSpotDescriptions[index];
  }
});

