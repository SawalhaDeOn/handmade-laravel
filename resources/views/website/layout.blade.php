<!DOCTYPE html>


<html @if($lang==1) lang="en" dir="ltr" @elseif($lang==2) lang="ar" dir="rtl"@elseif($lang==3) lang="he" dir="rtl" @endif>


<head>
    <base href="{{ URL::asset('/') }}">
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=0.7"/>
    <title>{{__('Handmade')}}</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    {{--  <link rel="stylesheet" href="website/css/all.min.css"/>--}}
    <link rel="stylesheet" href="website/css/animate.css"/>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="website/css/styles.css"/>
    @if($lang==2 || $lang==3)
        <link rel="stylesheet" href="website/css/home.css"/>
        <link rel="stylesheet" href="website/css/footer.css"/>
        <link rel="stylesheet" href="website/css/about-us.css"/>
        <link rel="stylesheet" href="website/css/prodect.css"/>
    @else
        <link rel="stylesheet" href="website/css/footer-en.css"/>
        <link rel="stylesheet" href="website/css/prodect-en.css"/>
        <link rel="stylesheet" href="website/css/about-us-en.css"/>
        <link rel="stylesheet" href="website/css/home-en.css"/>
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Droid+Arabic+Kufi&display=swap" rel="stylesheet"/>

    {{--   <link rel="stylesheet"
             href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/website/css/all.min.css"/>--}}



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JS -->

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet"/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @yield('css')


</head>

<body>
<div class="all">

    @include('website.parts.header')
    @yield('content')
    @include('website.parts.footer')

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<script src="website/script.js"></script>

<script src="website/js/jquery-3.6.0.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


<script>

    function PageLoadMethod() {


        $(".ajaxForm").ajaxForm({

            success: function (json) {

                ShowMessage(json.msg);
                if (json.status == 1 && json.redirect == undefined) {
                    $(".ajaxForm").resetForm();
                    $(".ajaxForm").find(".form-control").first().focus();

                }
                $(".ajaxForm :submit").prop("disabled", false);
                if (json.redirect != undefined) {
                    setTimeout(function () {
                        window.location = json.redirect;
                    }, 1200);
                }
                if (json.close == true) {

                    $("#" + json.modal).modal("hide");

                }
            },
            beforeSubmit: function () {
                em = 0;
                $(".ajaxForm").find("input[type='text'], input[type='email'], input[type='tel']").each(function () {
                    em = em + highlightIfEmpty($(this));
                });

                // Prevent form submission if there are empty fields
                if (em > 0) {
                    event.preventDefault();
                    ShowMessage("e:{{__('Fill Inputs')}}");
                    return false;
                }
                $(".ajaxForm :submit").prop("disabled", true);
            },
            error: function (json) {
                ShowMessage("e:Error in Data");
                $(".ajaxForm :submit").prop("disabled", false);
            }
        });
        $(".ajaxForm2").ajaxForm({

            success: function (json) {

                ShowMessage(json.msg);
                if (json.status == 1 && json.redirect == undefined) {
                    $(".ajaxForm2").resetForm();
                    $(".ajaxForm2").find(".form-control").first().focus();

                }
                $(".ajaxForm2 :submit").prop("disabled", false);
                if (json.redirect != undefined) {
                    setTimeout(function () {
                        window.location = json.redirect;
                    }, 1200);
                }
                if (json.close == true) {

                    $("#" + json.modal).modal("hide");

                }
            },
            beforeSubmit: function () {
                em = 0;
                $(".ajaxForm2").find("input[type='text'], input[type='email'], input[type='tel']").each(function () {
                    em = em + highlightIfEmpty($(this));
                });
                console.log(em)
                // Prevent form submission if there are empty fields
                if (em > 0) {
                    event.preventDefault();
                    ShowMessage("e:{{__('Fill Inputs')}}");
                    return false;
                }
                $(".ajaxForm2 :submit").prop("disabled", true);
            },
            error: function (json) {
                ShowMessage("e:Error in Data");
                $(".ajaxForm2 :submit").prop("disabled", false);
            }
        });
    }

    PageLoadMethod();

    @if($lang==1)
    $('.owl-carousel').owlCarousel({
        center: true,
        loop: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    @else
    $('.owl-carousel').owlCarousel({
        rtl: true,
        center: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        loop: true,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    @endif



    jQuery(document).on('click', '#submit_contact1', function () {
        console.log("hh");

        $("#formy").submit();
    });
    jQuery(document).on('click', '#submit_contact2', function () {
        if ($(this).hasClass('disable')) {

            $(".check-radius").css("border", "2px solid red");

            ShowMessage("e:{{__('Accept Terms')}}")
            return false;
        }
        else{
            $(".check-radius").css("border", "");
        }
        console.log("formy2");
        $("#formy2").submit();
    });
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right", // Options include top-right, top-left, etc.
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    function ShowMessage(msg) {
        var first2Letter = msg.substring(0, 2).toLowerCase();
        var msgClass = "info";
        if (first2Letter == "e:") {
            msgClass = "error";
            msg = msg.substring(2);
        } else if (first2Letter == "s:") {
            msgClass = "success";
            msg = msg.substring(2);
        } else if (first2Letter == "w:") {
            msgClass = "warning";
            msg = msg.substring(2);
        } else if (first2Letter == "i:") {
            msgClass = "info";
            msg = msg.substring(2);
        }
        toastr[msgClass](msg, "{{__('Insurey')}}");
    }

    function highlightIfEmpty(input) {


        if (input.val().trim() === "") {
            if (input.attr("type") == "tel") {
                $(".phone-input-wrapper").css("border", "2px solid red");
            }
            input.css("border", "2px solid red"); // Highlight with red border
            return 1;
        } else {
            input.css("border", ""); // Reset border if not empty
            if (input.attr("type") == "tel") {
                $(".phone-input-wrapper").css("border", "");
            }
            return 0;
        }
    }

    $(document).ready(function () {

        $(".check-circle").toggle();
        $(".check-radius").click(function () {
            $(".check-circle").toggle(); // Toggle the visibility of both divs

            if ($(".check-circle").is(":visible")) {
                console.log("v");
                $(".check-radius").css("border", "");
                $(".btnlead").removeClass("disable"); // Disable button when div1 is visible
                $(".btnlead").removeClass(".btn-submit");
            } else {
                $(".btnlead").addClass("disable"); // Disable button when div1 is visible
                $(".btnlead").addClass("disable");
                console.log("vv");
                $(".btnlead").addClass(".btn-submit");
            }

        });
        $(".navbar-toggler").click(function () {
            if ($(this).attr("aria-expanded") === "true") {
                $('.navbar-top').addClass('navbar-down');
                $('.navbar').removeClass('navbar-top');
                $('.logo-scrolled').removeClass('d-none');
                $('.logo-default').addClass('d-none');
                $('.navbar-toggler-icon').css('color:2F195F');
                $('.navbar-toggler').removeClass('bg-white');
            } else {
                $('.navbar').addClass('navbar-top');
                $('.navbar-top').removeClass('navbar-down');
                $('.logo-default').removeClass('d-none');
                $('.logo-scrolled').addClass('d-none');
                $('.navbar-toggler').addClass('bg-white');
            }
        });

        $(window).scroll(function () {
            if ($(this).scrollTop() < 100) {
                $('.navbar').addClass('navbar-top');
                $('.navbar-top').removeClass('navbar-down');
                $('.logo-default').removeClass('d-none');
                $('.logo-scrolled').addClass('d-none');
                $('.navbar-toggler').addClass('bg-white');
            } else {
                $('.navbar-top').addClass('navbar-down');
                $('.navbar').removeClass('navbar-top');
                $('.logo-scrolled').removeClass('d-none');
                $('.logo-default').addClass('d-none');
                $('.navbar-toggler-icon').css('color:2F195F');
                $('.navbar-toggler').removeClass('bg-white');
            }
        });
    });
</script>

@yield('js')
</body>
</html>
