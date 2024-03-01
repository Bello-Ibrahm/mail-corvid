
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