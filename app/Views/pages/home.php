<!-- The flashdata messages that come up when not loggedin or when Reggistered-->
<?php if(session()->has('error')): ?>
    <div class="alert alert-danger" role="alert">
        *<?= session()->getFlashdata('error');?>
    </div>
<?php endif;?>
<?php if(session()->has('success')): ?>
    <div class="alert alert-success" role="alert">
        *<?= session()->getFlashdata('success');?>
    </div>
<?php endif;?>

<!-- Bootstrap Toast messages-->
<div class="toast position-fixed top-43 end-0" style="z-index: 5" id="NoToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Error</strong>
        <small> this is toast</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"->
        </button>
    </div>
    <div class="toast-body text-danger">
        Please Log In!!!
    </div>
</div>

<div class="toast position-fixed top-43 end-0" style="z-index: 5" id="AddToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Add</strong>
        <small> this is toast</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"->
        </button>
    </div>
    <div class="toast-body text-success">
        Added to Basked
    </div>
</div>

<!--Side Bar using bootstrap-->
<div class="container">
    <div class="row pt-2 bp-2">
        <div id="sidebar" class="col-2 mt-5">
            <a type="button" class="btn btn-secondary nav-link" onclick="loadProduct('All')">Products</a>
            <ul class="card nav flex-column">
                <li id="laptopT" class="nav-item dropdown" onclick="toggle('laptop')">
                    <a class="nav-link active dropdown-toggle" data-bs-toggle="collapse" href="#laptopCollapse"
                       role="button" aria-expanded="false" aria-controls="laptopCollapse">Laptop</a>
                </li>
                <li class="nav-item collapse multi-collapse ps-3" id="laptopCollapse">
                    <a class="nav-link" style="cursor: pointer;" onclick="loadProduct('Lenovo')">Lenovo</a>
                </li>
                <li class="nav-item collapse multi-collapse ps-3" id="laptopCollapse">
                    <a class="nav-link" style="cursor: pointer;" onclick="loadProduct('HP')">HP</a>
                </li>
                <li class="nav-item collapse multi-collapse ps-3" id="laptopCollapse">
                    <a class="nav-link" style="cursor: pointer;" onclick="loadProduct('Dell')">Dell</a>
                </li>
                <li id="phoneT" class="nav-item dropdown" onclick="toggle('phone')">
                    <a class="nav-link active dropdown-toggle" data-bs-toggle="collapse" href="#phoneCollapse"
                       role="button" aria-expanded="false" aria-controls="phoneCollapse">Mobile phone</a>
                </li>
                <li class="nav-item collapse multi-collapse ps-3" id="phoneCollapse">
                    <a class="nav-link" style="cursor: pointer;" onclick="loadProduct('Samsung')">Samsung</a>
                </li>
                <li class="nav-item collapse multi-collapse ps-3" id="phoneCollapse">
                    <a class="nav-link" style="cursor: pointer;" onclick="loadProduct('Apple')">Apple</a>
                </li>
                <li class="nav-item collapse multi-collapse ps-3" id="phoneCollapse">
                    <a class="nav-link" style="cursor: pointer;" onclick="loadProduct('Huawei')">Huawei</a>
                </li>
            </ul>
        </div>
        <div class="col-10">
            <h1 class="ps-5">Products</h1>
            <div class="container">

                <div class="container">
                    <div class="product row">

                    </div>
                    <div class="pageLink"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Facebook like button -->
<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>

<!-- Javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {
        /* Load all products */
        loadProduct("All");
    });

    /* Here the contend is put in */
    function loadProduct(data) {
        console.log(data);
        $.ajax({
            method: "post",
            data:{'data':data},
            url: `<?= base_url('/product/getproduct') ?>`,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function (response) {
                //console.log(response);
                $('.product').empty();
                $.each(response, function (key, value) {
                    //console.log(value['name']);
                    $('.product').append('<div class="card mb-3" >\
                        <div class="row no-gutters">\
                        <div class="col-md-4">\
                        <img src="assets/images/' + value['image'] + '" alt=”' + value['name'] + '" width="20" height="250" class="card-img" alt="...">\
                        </div>\
                    <div class="col-md-8 card">\
                        <div class="card-body">\
                            <h5 id="pMame" class="card-title">' + value['name'] + '</h5>\
                            <p class="card-text">' + value['description'] + '</p>\
                        </div>\
                        <div class="ms-auto">\
                            <label for="' + value['name'] + '" class="form-label">Quantity</label>\
                            <select id="' + value['name'] + '" class="form-select">\
                                <option>1</option>\
                                <option>2</option>\
                                <option>3</option>\
                                <option>4</option>\
                                <option>5</option>\
                                <option>6</option>\
                                <option>7</option>\
                                <option>8</option>\
                                <option>9</option>\
                                <option>10</option>\
                                <option>11</option>\
                                <option>12</option>\
                                <option>13</option>\
                                <option>14</option>\
                                <option>15</option>\
                                <option>16</option>\
                                <option>17</option>\
                                <option>18</option>\
                                <option>19</option>\
                                <option>20</option>\
                                <option>21</option>\
                                <option>22</option>\
                                <option>23</option>\
                                <option>24</option>\
                                <option>25</option>\
                                <option>26</option>\
                                <option>27</option>\
                                <option>28</option>\
                                <option>29</option>\
                                <option>30</option>\
                            </select>\
                        </div>\
                        <div class="">\
                        \<p class="ps-4">&pound;' + value['price'] + '</p>\
                        </div>\
                        <button type="button" class="btn btn-info" onclick="addBasket(\'' + value['name'] + '\', document.getElementById(\'' + value['name'] + '\').value )">Add to Basket </button>\
                    </div>\
                </div>\
                </div>');
                });
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    /*Delay time */
    var my_delay = 2000;

    /* Adding to basket */
    function addBasket(data, quantity){
        $.ajax({
            method:"post",
            data:{'data':data, 'quantity':quantity},
            url: `<?= base_url('/cart/tocart') ?>`,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            success: function(response){
                if(response == "Please LogIn")
                {
                    toast();
                    setTimeout(addBasket, my_delay);
                }else{toasty();}

            }
        });
    }

    /* Variables for the toast */
    var options = {
        animation : true,
        delay : 5000
    };

    var options2 = {
        animation : true,
        delay : 2000
    };

    /* Toasts */
    function toast(){
        var toastElement = document.getElementById("NoToast");
        var tElement = new bootstrap.Toast(toastElement, options);

        tElement.show();
    }
    function toasty(){
        var toastElement = document.getElementById("AddToast");
        var tElement = new bootstrap.Toast(toastElement, options2);

        tElement.show();
    }

    /* Change the toggle of the side bar up or down */
    function toggle(item){
        if(item == "laptop") {
            if (document.getElementById("laptopT").classList.contains("dropup")) {
                document.getElementById("laptopT").classList.remove("dropup");
                document.getElementById("laptopT").classList.add("dropdown");
            } else if (document.getElementById("laptopT").classList.contains("dropdown")) {
                document.getElementById("laptopT").classList.remove("dropdown");
                document.getElementById("laptopT").classList.add("dropup");
            }
        }else{
            if (document.getElementById("phoneT").classList.contains("dropup")) {
                document.getElementById("phoneT").classList.remove("dropup");
                document.getElementById("phoneT").classList.add("dropdown");
            } else if (document.getElementById("phoneT").classList.contains("dropdown")) {
                document.getElementById("phoneT").classList.remove("dropdown");
                document.getElementById("phoneT").classList.add("dropup");
            }
        }

    }
</script>