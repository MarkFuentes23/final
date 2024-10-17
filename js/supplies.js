$("#new_parcel").click(function () {
  let row = `
                            <tr>
                               <td><textarea name='linens[]' class="form-control" rows="3" placeholder="Enter linens and bedding details" required></textarea></td>
                                <td><textarea name='towels[]' class="form-control" rows="3" placeholder="Enter towels and bath supplies" required></textarea></td>
                                <td><textarea name='cleaning[]' class="form-control" rows="3" placeholder="Enter cleaning supplies" required></textarea></td>
                                <td><textarea name='guest_amenities[]' class="form-control" rows="3" placeholder="Enter guest room amenities" required></textarea></td>
                                <td><textarea name='laundry[]' class="form-control" rows="3" placeholder="Enter laundry supplies" required></textarea></td>
                                <td><input type="text" class="form-control price-input" name='price[]' placeholder="Enter price" required></td>
                                <td><button class="btn1 btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove()"><i class="fa fa-times"></i></button></td>

                            </tr>`;
  $("#parcel-items tbody").append(row);
});

// Keyup event for price input to calculate total
$('[name="price[]"]').keyup(function () {
  calc(); // Recalculate total on keyup
});

// Add new row to the supplies information table
$("#new_parcel").click(function () {
  var tr = $("#ptr_clone tr").clone(); // Clone the row template
  $("#parcel-items tbody").append(tr); // Append the new row to the table body

  // Re-apply keyup event for the new 'price[]' inputs
  $('[name="price[]"]').keyup(function () {
    calc(); // Recalculate total on keyup
  });

  // Format number input fields
  $(".number").on("input keyup keypress", function () {
    var val = $(this).val();
    val = val.replace(/[^0-9]/g, ""); // Allow only numbers
    val = val.replace(/,/g, ""); // Remove commas
    val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0; // Format number
    $(this).val(val);
  });
});

// Submit form with AJAX
$("#manage-parcel").submit(function (e) {
  e.preventDefault();
  start_load(); // Start loading animation

  // Validate if at least one parcel info is added
  if ($("#parcel-items tbody tr").length <= 0) {
    alert_toast("Please add at least 1 parcel information.", "error");
    end_load();
    return false;
  }

  // Submit form data via AJAX
  $.ajax({
    url: "ajax.php?action=save_parcel",
    data: new FormData($(this)[0]),
    cache: false,
    contentType: false,
    processData: false,
    method: "POST",
    type: "POST",
    success: function (resp) {
      if (resp == 1) {
        alert_toast("Data successfully saved", "success");
        setTimeout(function () {
          location.href = "index.php?page=parcel_list";
        }, 2000);
      }
    },
  });
});

// Display selected image in 'cover' element
function displayImgCover(input, _this) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#cover").attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Calculate total price for the parcels
function calc() {
  var total = 0;
  $('#parcel-items [name="price[]"]').each(function () {
    var p = $(this).val();
    p = p.replace(/,/g, ""); // Remove commas
    p = p > 0 ? p : 0; // Default to 0 if no value
    total = parseFloat(p) + parseFloat(total); // Sum up the prices
  });

  // Display total amount in 'tAmount' element
  if ($("#tAmount").length > 0) {
    $("#tAmount").text(
      parseFloat(total).toLocaleString("en-US", {
        style: "decimal",
        maximumFractionDigits: 2,
        minimumFractionDigits: 2,
      })
    );
  }
}
