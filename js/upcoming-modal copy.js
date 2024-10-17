$(document).on("click", ".view_order", function () {
  const reservationId = $(this).data("id");
  console.log("Fetching details for ID:", reservationId); // Log the ID

  $.ajax({
    url: "get_reservation_details.php",
    type: "GET",
    data: { id: reservationId },
    success: function (response) {
      console.log("Response:", response); // Log the response
      if (response) {
        $("#modalContent").html(response);
        $("#viewOrderModal").modal("show"); // Show the modal
      } else {
        alert("No details found for this reservation.");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching reservation details:", error); // Log the error
      alert("Error fetching reservation details.");
    },
  });
});
