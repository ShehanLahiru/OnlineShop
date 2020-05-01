$("#ofBar").hide();

$(document).ready(function () {
    //load upload image preview
    $(document).on("click", "#prev_img", function () {
        $("#custom-file-input").click();
    });

    $(document).on("change", "input[type=file]", function () {
        var currentEle = $(this);
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                currentEle
                    .closest(".form-group")
                    .find("#prev_img")
                    .attr("src", e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
    //load upload image preview
    $(document).on("click", "#prev_img2", function () {
        $("#custom-file-input2").click();
    });

    $(document).on("change", "input[type=file]", function () {
        var currentEle = $(this);
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                currentEle
                    .closest(".form-group")
                    .find("#prev_img2")
                    .attr("src", e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
});
