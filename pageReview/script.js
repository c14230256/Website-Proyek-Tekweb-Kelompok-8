document.addEventListener('DOMContentLoaded', (event) => {
    // Slider 1
    let index1 = 0;
    const slides1 = document.querySelectorAll('.container-1-slide');
    const totalSlides1 = slides1.length;

    document.getElementById('container-1-left-arrow').addEventListener('click', () => {
        index1 = (index1 > 0) ? index1 - 1 : totalSlides1 - 1;
        updateSlidePosition(slides1, index1);
    });

    document.getElementById('container-1-right-arrow').addEventListener('click', () => {
        index1 = (index1 < totalSlides1 - 1) ? index1 + 1 : 0;
        updateSlidePosition(slides1, index1);
    });

    // Slider 2
    let index2 = 0;
    const slides2 = document.querySelectorAll('.container-2-slide');
    const totalSlides2 = slides2.length;
    
    const roomNames = ["Normal Room", "Funky Room", "Lumberjack Room", "Royal Room"];
    const roomDescriptions = [
        "A Simple but comfy room!",
        "A funky room with vibrant colors!",
        "A rugged room with a lumberjack theme!",
        "A luxurious room fit for royalty!"
    ];
    const roomPrices = ["$350 / Day", "$450 / Day", "$550 / Day", "$999 / Day"];
    
    document.getElementById('container-2-left-arrow').addEventListener('click', () => {
        index2 = (index2 > 0) ? index2 - 1 : totalSlides2 - 1;
        updateSlidePosition(slides2, index2);
        updateRoomDetails(index2);
    });

    document.getElementById('container-2-right-arrow').addEventListener('click', () => {
        index2 = (index2 < totalSlides2 - 1) ? index2 + 1 : 0;
        updateSlidePosition(slides2, index2);
        updateRoomDetails(index2);
    });

    // Slider 3
    let index3 = 0;
    const slides3 = document.querySelectorAll('.container-3-slide');
    const totalSlides3 = slides3.length;

    const spotNames = ["Goo Lagoon", "Mt. Bikini", "Jellyfish Fields"];
    const spotDescriptions = [
        "This sunny lagoon is the perfect spot for a day of fun and relaxation. Visitors can enjoy a variety of water sports, sunbathing on the sandy shores, or simply taking a refreshing dip in the clear, gooey waters. With plenty of food stands and shops nearby, it's easy to make a full day out of your visit to Goo Lagoon. Whether you're looking to catch some waves or just unwind under the sun, Goo Lagoon has something for everyone!",
        "Mt. Bikini offers breathtaking views and an adventurous experience for hikers and nature enthusiasts. The mountain's trails range from easy walks to challenging climbs, ensuring there's something for everyone. At the summit, you'll find an incredible panoramic view of Bikini Bottom, making the trek well worth it.",
        "Jellyfish Fields is a beautiful, sprawling meadow filled with vibrant jellyfish. It's a popular spot for both locals and visitors looking to explore the natural beauty of Bikini Bottom. You can safely observe the jellyfish from a distance or join the fun in catching them with a net, making for a memorable experience."
    ];

    document.getElementById('container-3-left-arrow').addEventListener('click', () => {
        index3 = (index3 > 0) ? index3 - 1 : totalSlides3 - 1;
        updateSlidePosition(slides3, index3);
        updateSpotDetails(index3);
    });

    document.getElementById('container-3-right-arrow').addEventListener('click', () => {
        index3 = (index3 < totalSlides3 - 1) ? index3 + 1 : 0;
        updateSlidePosition(slides3, index3);
        updateSpotDetails(index3);
    });

    function updateSlidePosition(slides, index) {
        for (let slide of slides) {
            slide.style.transform = `translateX(-${index * 100}%)`;
        }
    }

    function updateRoomDetails(index) {
        document.querySelector('.container-2-content-subtitle').textContent = roomNames[index];
        document.querySelector('.container-2-content-description').textContent = roomDescriptions[index];
        document.querySelector('.container-2-price').textContent = roomPrices[index];
    }

    function updateSpotDetails(index) {
        document.getElementById('tourist-spot-name').textContent = spotNames[index];
        document.getElementById('tourist-spot-description').textContent = spotDescriptions[index];
    }
});
