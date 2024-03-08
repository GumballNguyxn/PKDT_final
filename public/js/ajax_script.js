$(document).ready(function () {

    console.log(searchTerm);

    start();

});


let chooseCateData = [];
let chooseBrandData = [];
let choosePriceData = [];
let pageIndex = 1;
let searchTerm = '';
let selectedValue = 0 ;
// document.addEventListener('DOMContentLoaded', function () {
//     var categoryLinks = document.querySelectorAll('.main-nav a[data-category]');

//     categoryLinks.forEach(function (link) {
//         link.addEventListener('click', function (event) {
//             event.preventDefault();

//             // Lấy giá trị category từ thuộc tính data-category
//             var category = this.getAttribute('data-category');

//             // Chuyển hướng đến trang products với tham số category
//             window.location.href = 'products?keyword=' + category;
//         });
//     });
// });
document.addEventListener('DOMContentLoaded', function () {
    var categoryLinks = document.querySelectorAll(' a[data-key]');

    categoryLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            // Lấy giá trị category từ thuộc tính data-category
            var category = this.getAttribute('data-key');

            // Chuyển hướng đến trang products với tham số category
            var baseUrl = 'http://127.0.0.1:8000/products'; // Lấy phần cơ bản của URL
            window.location.href = baseUrl + '?keyword=' + category;
        });
    });
});

function handlePageClick(i) {
    pageIndex = i;
    console.log(pageIndex);
    var checkCate = document.getElementsByName('category');
    var tempCate = [];
    var checkBrand = document.getElementsByName('brand');
    var tempBrand = [];
    var urlParams = new URLSearchParams(window.location.search);
    searchTerm = urlParams.get('keyword');
    selectedValue = document.getElementById("sortSelect").value;

    for (var i = 0; i < checkCate.length; i++) {
        if (checkCate[i].checked && !tempCate.includes(checkCate[i].value)) {
            tempCate.push(checkCate[i].value);
        } else {
            tempCate.splice(i, 1);
        }

    }
    for (var i = 0; i < checkBrand.length; i++) {
        if (checkBrand[i].checked && !tempBrand.includes(checkBrand[i].value)) {
            tempBrand.push(checkBrand[i].value);
        } else {
            tempBrand.splice(i, 1);
        }
    }

    chooseCateData = tempCate;
    chooseBrandData = tempBrand;


    console.log(chooseCateData.toString());
    // if(chooseCateData.length < 1 && chooseBrandData.length <1)
    //     phantrang(pageIndex)
    if(chooseCateData.length > 0 || chooseBrandData.length > 0 || choosePriceData.length > 0) {
    getProduct();
    }else phantrang();

}

function Choose() {
    var checkCate = document.getElementsByName('category');
    var tempCate = [];
    var checkBrand = document.getElementsByName('brand');
    var tempBrand = [];
    var checkPrice = document.getElementsByName('price');
    var tempPrice = [];
    selectedValue = document.getElementById("sortSelect").value;
    pageIndex = 1;

    for (var i = 0; i < checkCate.length; i++) {
        if (checkCate[i].checked && tempCate.indexOf(checkCate[i].value) === -1) {
            tempCate.push(checkCate[i].value);
        } else if (!checkCate[i].checked) {
            var index = tempCate.indexOf(checkCate[i].value);
            if (index !== -1) {
                tempCate.splice(index, 1);
            }
        }
    }

    for (var i = 0; i < checkBrand.length; i++) {
        if (checkBrand[i].checked && tempBrand.indexOf(checkBrand[i].value) === -1) {
            tempBrand.push(checkBrand[i].value);
        } else if (!checkBrand[i].checked) {
            var index = tempBrand.indexOf(checkBrand[i].value);
            if (index !== -1) {
                tempBrand.splice(index, 1);
            }
        }
    }

    for (var i = 0; i < checkPrice.length; i++) {
        if (checkPrice[i].checked && tempPrice.indexOf(checkPrice[i].value) === -1) {
            tempPrice.push(checkPrice[i].value);
        } else if (!checkPrice[i].checked) {
            var index = tempPrice.indexOf(checkPrice[i].value);
            if (index !== -1) {
                tempPrice.splice(index, 1);
            }
        }
    }

    chooseCateData = tempCate;
    chooseBrandData = tempBrand;
    if (tempPrice.length > 0) {
        choosePriceData = tempPrice;
    }

    console.log(chooseCateData.toString());

    if (chooseCateData.length > 0 || chooseBrandData.length > 0 || choosePriceData.length > 0) {
        console.log("chooseCateData:", chooseCateData.toString());
        console.log("chooseBrandData:", chooseBrandData.toString());
        console.log("choosePriceData:", choosePriceData.toString());

        // Gọi hàm getProduct để load sản phẩm theo các lựa chọn
        getProduct();
    } else {
        start();
    }
}
// function ChooseBrand() {
//     var checkBrand = document.getElementsByName('brand');
//     var tempBrand = [];
//     for (var i = 0; i < checkBrand.length; i++) {
//         if (checkBrand[i].checked && !tempBrand.includes(checkBrand[i].value)) {
//             tempBrand.push(checkBrand[i].value);
//         } else {
//             tempBrand.splice(i, 1);
//         }
//     }

//     chooseBrandData = tempBrand;
//     console.log(chooseBrandData.toString());
//     if(chooseBrandData.length > 0){
//         getProduct();
//         }else start();



// }

function getProduct() {
    let data = {
        keycate_id: chooseCateData.toString(),
        keybrand_id: chooseBrandData.toString(),
        pricex: choosePriceData.toString(),
        pageIndex: pageIndex.toString(),
        selectedValue: selectedValue.toString(),
    };
    $.ajax({
        async: false,
        url: "productAjax",
        type: 'get',
        // dataType: 'json',
        data: data,
        success: function (data) {
            $('#storess').html(data);
            addCart();

        },
        error: function (err) {
            console.log(err);
        }
    });

}
function start(){
    var urlParams = new URLSearchParams(window.location.search);
    var searchTerm = urlParams.get('keyword');
    // selectedValue = document.getElementById("sortSelect").value;
    if(searchTerm != null ){

        let data = {
            searchTerm: searchTerm.toString(),
            selectedValue:selectedValue.toString(),
        }
        $.ajax({
            async: false,
            url: "productAjaxStart",
            type: 'get',
            data: data,
            success: function (data) {
                $('#storess').html(data);
                addCart();

            },
            error: function (err) {
                console.log(err);
            }
        });
    }else{
        let data = {
            selectedValue:selectedValue.toString(),
        }
        $.ajax({
            async: false,
            url: "productAjaxStart",
            type: 'get',
            // dataType: 'json',
            data: data,
            success: function (data) {
                $('#storess').html(data);
                addCart();

            },
            error: function (err) {
                console.log(err);
            }
        });
    }

}

function phantrang(){
    let data = {
        pageIndex: pageIndex,
        searchTerm: searchTerm,
        selectedValue: selectedValue.toString(),
    };
    $.ajax({
        async: false,
        url: "productAjaxPhanTrang",
        type: 'get',
        // dataType: 'json',
        data: data,
        success: function (data) {
            $('#storess').html(data);
            addCart();

        },
        error: function (err) {
            console.log(err);
        }
    });
}

$(document).ready(function() {
    addCart();
});

$(document).ready(function() {
    $('.sanphammoi a').on('click', function(e) {
        e.preventDefault();

        // Lấy giá trị từ thuộc tính data-sp của thẻ a
        var category = $(this).data('sp');
        let data = {category: category};
        console.log(category);

        // Gửi yêu cầu Ajax với giá trị category
        $.ajax({
            url: 'homeAjaxProductMoi',  // Thay đổi đường dẫn nếu cần
            type: 'GET',
            data: data,
            success: function(data) {
                // Xử lý dữ liệu nhận được từ server
                $('#mot').html(data);
                addCart();
                initSlickSlider('.products-slick');
                

                // Hiển thị sản phẩm mới tại đây
            },
            error: function(error) {
                console.log(error);
            }
        });

    });

});
$(document).ready(function() {
    $('.sanphambanchay a').on('click', function(e) {
        e.preventDefault();

        // Lấy giá trị từ thuộc tính data-sp của thẻ a
        var category = $(this).data('sp');
        let data = {category: category};
        console.log(category);

        // Gửi yêu cầu Ajax với giá trị category
        $.ajax({
            url: 'homeAjaxProductBanChay',  // Thay đổi đường dẫn nếu cần
            type: 'GET',
            data: data,
            success: function(data) {
                // Xử lý dữ liệu nhận được từ server
                $('#mot').html(data.outputdf);
                $('#hai').html(data.output);
                initSlickSlider('.products-slick');
                addCart();



                // Hiển thị sản phẩm mới tại đây
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
    function initSlickSlider(target) {
        console.log("Init Slick Slider");
        $(target).slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: false,
            arrows: false, // Ẩn nút prev và next
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                // Thêm các đối tượng responsive khác nếu cần
            ]
        });
    }

function addCart(){
    $('.add-to-cart-form').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn việc gửi form một cách thông thường
        var formData = $(this).serialize(); // Lấy dữ liệu từ form
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function (response) {
                // Hiển thị toast thành công bằng SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Sản phẩm đã đươc thêm vào giỏ hàng',
                    text: response.message,
                    toast: true,
                    position: 'top-end', // Hiển thị ở góc trên cùng bên phải
                    timer: 2000, // Thời gian tự động đóng (miliseconds)
                    showConfirmButton: false, // Ẩn nút xác nhận
                });
            },
            error: function (xhr, status, error) {
                // Hiển thị toast lỗi bằng SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: xhr.responseJSON.message,
                    toast: true,
                    position: 'top-end', // Hiển thị ở góc trên cùng bên phải
                    timer: 2000, // Thời gian tự động đóng (miliseconds)
                    showConfirmButton: false, // Ẩn nút xác nhận
                });
            }
        });
    });
}
