document.addEventListener("DOMContentLoaded", (event) => {
  // Slider 1
  let index1 = 0
  const slides1 = document.querySelectorAll(".container-1-slide")
  const totalSlides1 = slides1.length

  document
    .getElementById("container-1-left-arrow")
    .addEventListener("click", () => {
      index1 = index1 > 0 ? index1 - 1 : totalSlides1 - 1
      updateSlidePosition(slides1, index1)
    })

  document
    .getElementById("container-1-right-arrow")
    .addEventListener("click", () => {
      index1 = index1 < totalSlides1 - 1 ? index1 + 1 : 0
      updateSlidePosition(slides1, index1)
    })

  // Slider 2
  let index2 = 0
  const slides2 = document.querySelectorAll(".container-2-slide")
  const totalSlides2 = slides2.length

  const roomNames = [
    "Normal Room",
    "Funky Room",
    "Lumberjack Room",
    "Royal Room",
  ]
  const roomDescriptions = [
    "A Simple but comfy room!",
    "A funky room with vibrant colors!",
    "A rugged room with a lumberjack theme!",
    "A luxurious room fit for royalty!",
  ]
  const roomPrices = ["$350 / Day", "$450 / Day", "$550 / Day", "$999 / Day"]

  document
    .getElementById("container-2-left-arrow")
    .addEventListener("click", () => {
      index2 = index2 > 0 ? index2 - 1 : totalSlides2 - 1
      updateSlidePosition(slides2, index2)
      updateRoomDetails(index2)
    })

  document
    .getElementById("container-2-right-arrow")
    .addEventListener("click", () => {
      index2 = index2 < totalSlides2 - 1 ? index2 + 1 : 0
      updateSlidePosition(slides2, index2)
      updateRoomDetails(index2)
    })

  function updateSlidePosition(slides, index) {
    for (let slide of slides) {
      slide.style.transform = `translateX(-${index * 100}%)`
    }
  }

  function updateRoomDetails(index) {
    document.querySelector(".container-2-content-subtitle").textContent =
      roomNames[index]
    document.querySelector(".container-2-content-description").textContent =
      roomDescriptions[index]
    document.querySelector(".container-2-price").textContent = roomPrices[index]
  }
})
