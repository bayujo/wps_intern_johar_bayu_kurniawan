$(function () {
  $(".table-responsive").responsiveTable({
    sortable: true,
    addDisplayAllBtn: "btn btn-secondary",
    buttons: ["copy", "excel", "pdf", "colvis"],
  }),
    $(".btn-toolbar [data-toggle=dropdown]").attr("data-bs-toggle", "dropdown");
});
