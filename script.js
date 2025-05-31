$(document).ready(function () {
  // Tooltip Bootstrap
  $('[data-bs-toggle="tooltip"]').tooltip();

  // Status interaktif AJAX
  $(".btn-edit-status").on("click", function () {
    const parent = $(this).closest(".status-editable");
    parent.find(".status-badge").hide();
    parent.find(".status-select").show().focus();
  });

  $(".status-select").on("blur change", function () {
    const select = $(this);
    const parent = select.closest(".status-editable");
    const val = select.val();
    const badgeType = select.find("option:selected").data("badge");
    const badge = parent.find(".status-badge");
    const row = select.closest("tr");
    const aspirasiId = row.data("id");

    // AJAX update status
    $.ajax({
      url: "api/aspirasi/update-status.php",
      type: "POST",
      data: { id: aspirasiId, status: val },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          badge
            .removeClass()
            .addClass("badge status-badge bg-" + badgeType)
            .text(val)
            .fadeIn(140);
          select.hide();
          showModal(
            "Status Diperbarui",
            "Status berhasil diubah menjadi <b>" + val + "</b>."
          );
        } else {
          select.hide();
          badge.fadeIn(140);
          showModal(
            "Gagal",
            response.message || "Terjadi kesalahan saat mengubah status."
          );
        }
      },
      error: function () {
        select.hide();
        badge.fadeIn(140);
        showModal("Gagal", "Terjadi kesalahan saat mengubah status.");
      },
    });
  });

  $(".status-select").on("keydown", function (e) {
    if (e.key === "Enter") {
      $(this).blur();
    }
  });

  // Konfirmasi hapus data AJAX
  let rowToDelete = null;
  $(".btn-delete").click(function () {
    rowToDelete = $(this).closest("tr");
    $("#confirmDeleteModal").modal("show");
  });
  $("#btnConfirmDelete").click(function () {
    if (rowToDelete) {
      let aspirasiId = rowToDelete.data("id");
      $.ajax({
        url: "api/aspirasi/delete.php",
        type: "POST",
        data: { id: aspirasiId },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            rowToDelete.remove();
            rowToDelete = null;
            $("#confirmDeleteModal").modal("hide");
            showModal("Data dihapus", "Data berhasil dihapus dari daftar.");
          } else {
            showModal("Gagal", response.message || "Gagal menghapus data.");
          }
        },
        error: function () {
          showModal("Gagal", "Terjadi kesalahan saat menghapus data.");
        },
      });
    }
  });

  // Modal feedback reusable
  function showModal(title, message) {
    $("#globalModal .modal-title").html(title);
    $("#globalModal .modal-body").html(message);
    $("#globalModal").modal("show");
  }
});
