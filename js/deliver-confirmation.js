$(document).on("click", ".view_order", function () {
  const reservationId = $(this).data("id");
  console.log("Fetching details for ID:", reservationId);

  $.ajax({
    url: "confirm-order.php",
    type: "GET",
    data: { id: reservationId },
    success: function (response) {
      console.log("Response:", response);
      if (response) {
        $("#modalContent").html(response);
        $("#viewOrderModal").modal("show");
      } else {
        alert("No details found for this reservation.");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching reservation details:", error);
      alert("Error fetching reservation details.");
    },
  });
});
