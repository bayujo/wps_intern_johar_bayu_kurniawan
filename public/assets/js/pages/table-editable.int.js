$(function () {
    var e = {};
    $(".table-edits tr").editable({
        dropdowns: optionsData,
        edit: function (t) {
            $(".edit i", this)
                .removeClass("fa-pencil-alt")
                .addClass("fa-save")
                .attr("title", "Save");
        },
        save: function (t) {
            var rowData = {};
            $(this)
                .closest("tr")
                .find("td")
                .each(function (index) {
                    var headerText = $(this)
                        .closest("table")
                        .find("th")
                        .eq($(this).index())
                        .text()
                        .trim();
                    rowData[headerText] = $(this).text().trim();
                });

            var url = "your_default_backend_endpoint";
            if (typeof saveUrl !== "undefined") {
                url = saveUrl;
            }

            rowData['_token'] = csrfToken;

            $.ajax({
                url: url,
                method: "POST",
                data: rowData,
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: error,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                    });
                },
            });

            $(".edit i", this)
                .removeClass("fa-save")
                .addClass("fa-pencil-alt")
                .attr("title", "Edit");

            this in e && (e[this].destroy(), delete e[this]);
        },
        cancel: function (t) {
            $(".edit i", this)
                .removeClass("fa-save")
                .addClass("fa-pencil-alt")
                .attr("title", "Edit");

            this in e && (e[this].destroy(), delete e[this]);
        },
    });
});
