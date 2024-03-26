
// Toggle the Bot form display
const toggleBotDisplay = () => {
    // const bot_checkbox = $("#bot_checkbox");
    const bot_checkbox = document.querySelector("#bot_checkbox");

    if (bot_checkbox.checked === true) {
        // Display the Bot form
        const q1 = document.querySelector(".q1").value = Math.floor(Math.random() * 9 + 1); // Generate 1-9
        const q2 = document.querySelector(".q2").value = Math.floor(Math.random() * 9 + 1); // Generate 1-9
        const total = document.querySelector(".total").value = (q1 + q2);


        document.querySelector("#bot-eval").classList.remove("d-none");
        // total.value = (q1 + q2);
    } else {
        // Hide the Bot form
        document.querySelector("#bot-eval").classList.add("d-none");
        document.querySelector(".btn-user").setAttribute("disabled", "");
    }
}

// Check user input with the total in other to enable login button
const isEqual = () => {
    const total = document.querySelector(".total").value;
    const ans = document.querySelector(".ans").value;
    const success = document.querySelector("#success");
    const fail = document.querySelector("#fail");
    
    if (total === ans) {
        fail.classList.add("d-none");
        success.classList.remove("d-none");
        document.querySelector(".btn-user").removeAttribute("disabled");
    } else {
        success.classList.add("d-none");
        fail.classList.remove("d-none");
        document.querySelector(".btn-user").setAttribute("disabled", "");
    }
}

// Load image display
const loadFile = function (event) {
    let image = document.getElementById('image');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function () {
        URL.revokeObjectURL(image.src)
    }
};

$(document).ready(function() {
    $('#summernote').summernote({
        placeholder: 'You can type in your message here',
        tabsize: 5,
        height: 200
    });
});

// Swal.fire({
//     title: "success",
//     text: "This is a test",
//     icon: "success",
//     showConfirmButton: true,
//     confirmButtonText: "ok"
//   });

// Swal.fire({
//     position: "top-end",
//     icon: "warning",
//     title: "Contact already subscribed",
//     showConfirmButton: false,
//     timer: 2000
// });