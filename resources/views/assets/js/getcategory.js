function getSubCat(categoryId) {
    if (categoryId) {
        // let url = window.location.href;

        // console.log(url);
        let url = "get_subcategories/" + categoryId;
        console.log(url);
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $("#subcategory-select").empty();
                $("#subcategory-select").append(
                    '<option value="">Select SubCategory</option>'
                );
                $.each(data, function (key, value) {
                    $("#subcategory-select").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.sub_category_name +
                            "</option>"
                    );
                });
            },
        });
    }
}

$(document).ready(function () {
    $("#category-select").on("change", function () {
        var categoryId = $(this).val();
        console.log(categoryId);
        if (categoryId) {
            $.ajax({
                url: "get_subcategories/" + categoryId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $("#subcategory-select").empty();
                    $("#subcategory-select").append(
                        '<option value="">Select SubCategory</option>'
                    );
                    $.each(data, function (key, value) {
                        $("#subcategory-select").append(
                            '<option value="' +
                                value.id +
                                '">' +
                                value.sub_category_name +
                                "</option>"
                        );
                    });
                },
            });
        } else {
            $("#subcategory-select").empty();
            $("#subcategory-select").append(
                '<option value="">Select SubCategory</option>'
            );
        }
    });
});
