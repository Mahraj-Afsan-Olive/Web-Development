document.addEventListener("DOMContentLoaded", () => {
   
    const approveButtons = document.querySelectorAll(".approve-btn");
    const rejectButtons = document.querySelectorAll(".reject-btn");
    const viewButtons = document.querySelectorAll(".view-btn");

    approveButtons.forEach(button => {
        button.addEventListener("click", () => {
            alert("User approved!");
        });
    });

    rejectButtons.forEach(button => {
        button.addEventListener("click", () => {
            alert("User rejected!");
        });
    });

    viewButtons.forEach(button => {
        button.addEventListener("click", () => {
            alert("View button clicked!");
        });
    });
});
