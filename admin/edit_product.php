<?php
$page = "product";
include "layout/header.php";
include '../config/config.php';

$id = $_GET['id'];
$productList = mysqli_query($con, "select*from products  where id='$id'");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" rel="stylesheet" />
<style>
    /* * {
        box-sizing: border-box;
    } */

    input[type=text],
    input[type=date],
    input[type=number],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    label {
        padding: 12px 12px 12px 0;
        display: inline-block;
    }

    input[type=submit] {
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
    }

    .cancelBtn {
        background-color: orange;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-right: 5px;
    }


    input[type=submit]:hover {
        background-color: #45a049;
    }

    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }

    .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
    }

    .col-75 {
        float: left;
        width: 50%;
        margin-top: 6px;
    }

    .btn-rmv1 {
        height: 40px;
        width: 250px;

    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

        .col-25,
        .col-75,
        input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
    }

    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }

    .remove:hover {
        background: white;
        color: black;
    }

    /* upload image */
    .profilepic {
        position: relative;
        width: 250px;
        height: 250px;
        /* border-radius: 50%; */
        overflow: hidden;
        background-color: #111;
    }

    .profilepic:hover .profilepic__content {
        opacity: 1;
    }

    .profilepic:hover .profilepic__image {
        opacity: .5;
    }

    .profilepic__image {

        object-fit: cover;
        opacity: 1;
        transition: opacity .2s ease-in-out;
    }

    .profilepic__content {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        opacity: 0;
        transition: opacity .2s ease-in-out;
    }

    .profilepic__icon {
        color: white;
        padding-bottom: 8px;
    }

    .fas {
        font-size: 20px;
    }

    .profilepic__text {
        text-transform: uppercase;
        font-size: 12px;
        width: 50%;
        text-align: center;
    }

    /* upload image end */
</style>
<?php
while ($row = mysqli_fetch_array($productList)) {
    $path = "../uploads/";

?>
    <div class="container">
        <form enctype="multipart/form-data" action="updateProduct.php" method="post" id="order_form">
            <input type="hidden" id="id" value="<?php echo $id ?>">
            <div class="row">
                <div class="col-25">
                    <label for="date">Date</label>
                </div>
                <div class="col-75">
                    <input type="date" id="date" name="date" required="required" value="<?php echo $row['date']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="productName">Product Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="productName" name="productName" placeholder="Product Name.." required="required" value="<?php echo $row['name']; ?>">
                    <input type="hidden" id="productId" name="id" placeholder="Product Name.." required="required" value="<?php echo $row['id']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="mrp">MRP</label>
                </div>
                <div class="col-75">
                    <input type="number" id="mrp" name="mrp" placeholder="MRP.." required="required" value="<?php echo $row['mrp']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="sprice">Special Price</label>
                </div>
                <div class="col-75">
                    <input type="number" id="sprice" name="sprice" placeholder="Special Price.." required="required" value="<?php echo $row['sprice']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="quantity">Quantity</label>
                </div>
                <div class="col-75">
                    <input type="number" id="quantity" name="quantity" placeholder="Quantity.." required="required" value="<?php echo $row['quantity']; ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="description">Description</label>
                </div>
                <div class="col-75">
                    <textarea id="description" name="description" placeholder="Write something.." style="height:200px"><?php echo $row['description']; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="youtubeLink">Youtube Link</label>
                </div>
                <div class="col-75">
                    <input type="text" id="youtubeLink" name="youtubeLink" placeholder="youtubeLink.." value="<?php echo $row['youtube_link']; ?>">
                </div>
            </div>
            <p id="filep"></p>


            <div class="row">
                <div class="col-25">
                    <label for="youtubeLink">Images</label>
                </div>
                <br>
                <div class="col-25">

                    <div class="profilepic">
                        <label for="imgInp">
                            <input accept="image/*" type='file' id="imgInp" name="image1" style="display:none" />
                            <img id="blah" class="profilepic__image w-100 h-100" src="<?php echo $path . $row['image_1']; ?>" alt="your image" />
                            <div class="profilepic__content">
                                <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                                <span class="profilepic__text">Change Image</span>
                            </div>
                        </label>
                    </div>
                    <input type="button" id="removeImage1" value="Remove Image" class="btn-rmv1 removeProductImage" imageValue="1" />
                </div>
                <div class="col-25">

                    <div class="profilepic">
                        <label for="imgInp1">
                            <input accept="image/*" type='file' id="imgInp1" name="image2" style="display:none" />
                            <img id="blah1" class="profilepic__image w-100 h-100" src="<?php echo $path . $row['image_2']; ?>" alt="your image" />
                            <div class="profilepic__content">
                                <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                                <span class="profilepic__text">Change Image</span>
                            </div>
                        </label>
                    </div>
                    <input type="button" id="removeImage2" value="Remove Image" class="btn-rmv1 removeProductImage" imageValue="2" />
                </div>
                <div class="col-25">

                    <div class="profilepic">
                        <label for="imgInp2">
                            <input accept="image/*" type='file' id="imgInp2" name="image3" style="display:none" />
                            <img id="blah2" class="profilepic__image w-100 h-100" src="<?php echo $path . $row['image_3']; ?>" alt="your image" />
                            <div class="profilepic__content">
                                <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                                <span class="profilepic__text">Change Image</span>
                            </div>
                        </label>
                    </div>
                    <input type="button" id="removeImage3" value="Remove Image" class="btn-rmv1 removeProductImage" imageValue="3" />

                </div>


                <!-- <label for="files">Image(Only 3 Images)</label> -->

                <!-- <div class="col-75">
                    <input type="file" id="files" name="files[]" multiple />
                </div> -->
            </div>

            <br>
            <div class="col-md-3 col-sm-3 col-xs-3">

                <div class="row">

                    <input type="submit" value="Submit">


                    <button type="button" onclick="location.href='index.php'" class="cancelBtn">Cancel</button>&nbsp;&nbsp;
                </div>

        </form>
    </div><?php } ?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script type="text/javascript">
    function removeImage(imageValue) {
        var num = document.getElementById("productId").value;
        $.ajax({
            url: 'remove.php',
            type: "post",
            data: {
                id: num,
                value: imageValue,

            },
            dataType: "text",
            success: function(result) {
                if (result) {
                    if (imageValue == 1) {
                        $("#imgInp").val("");
                        $("#blah").attr("src", "");
                    } else if (imageValue == 2) {
                        $("#imgInp1").val("");
                        $("#blah1").attr("src", "");
                    } else if (imageValue == 3) {
                        $("#imgInp2").val("");
                        $("#blah2").attr("src", "");
                    }

                }
            }

        });
    }
    $(".removeProductImage").click(function(e) {
        e.preventDefault();
        var $imagevalue = $(this).attr("imageValue");
        if (confirm("Are You Sure To Delete This Image")) {
            removeImage($imagevalue);
        }
    });
    // $("#removeImage11").click(function(e) {
    //     e.preventDefault();
    //     $(this).attr(data - imageValue);

    //     if (confirm("Are You Sure To Delete This Image")) {
    //         $.ajax({
    //             url: 'remove.php',
    //             type: "post",
    //             data: {
    //                 id: num,
    //                 value: "1",

    //             },
    //             dataType: "text",
    //             success: function(result) {
    //                 console.log(result);
    //                 if (result) {
    //                     $("#imgInp").val("");
    //                     $("#blah").attr("src", "");
    //                 }
    //             }

    //         });





    //     }
    // });
    // $("#removeImage21").click(function(e) {


    //     var num = document.getElementById("productId").value;

    //     $.ajax({
    //         url: 'remove.php',
    //         type: "post",
    //         data: {
    //             id: num,
    //             value: "2",

    //         },
    //         dataType: "text",

    //     });


    //     e.preventDefault();
    //     $("#imgInp1").val("");
    //     $("#blah1").attr("src", "");
    // });
    // $("#removeImage31").click(function(e) {


    //     var num = document.getElementById("productId").value;

    //     $.ajax({
    //         url: 'remove.php',
    //         type: "post",
    //         data: {
    //             id: num,
    //             value: "3",

    //         },
    //         dataType: "text",

    //     });


    //     e.preventDefault();
    //     $("#imgInp2").val("");
    //     $("#blah2").attr("src", "");
    // });

    $(document).ready(function() {
        $("#order_form").validate({
            rules: {
                productName: {
                    required: true,
                    minlength: 3
                },
                mrp: {
                    required: true,
                    minlength: 2
                },
                sprice: {
                    required: true,
                    minlength: 2
                },
                quantity: {
                    required: true,
                    minlength: 1
                },


            }
        });
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }

        imgInp1.onchange = evt => {
            const [file] = imgInp1.files
            if (file) {
                blah1.src = URL.createObjectURL(file)
            }
        }
        imgInp2.onchange = evt => {
            const [file] = imgInp2.files
            if (file) {
                blah2.src = URL.createObjectURL(file)
            }
        }


        if (window.File && window.FileList && window.FileReader) {

            $("#files").on("change", function(e) {

                var files = e.target.files,
                    filesLength = files.length;

                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Remove image</span>" +
                            "</span>").insertAfter("#files");
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });

                        // Old code here
                        /*$("<img></img>", {
                          class: "imageThumb",
                          src: e.target.result,
                          title: file.name + " | Click to remove"
                        }).insertAfter("#files").click(function(){$(this).remove();});*/

                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });
</script>
<?php
include "layout/footer.php";
?>