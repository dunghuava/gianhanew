$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('#scroll').fadeIn();
    } else {
        $('#scroll').fadeOut();
    }
});
$(function() {
    checkCookie();
    GetProductlist();
    /***********************************************************************************/
    $("img.lazy").lazyload({
        effect : "fadeIn"
    });
    var currentPage = $(location).attr('href');
    if (currentPage.indexOf('#') != -1) {
        currentPage = currentPage.substring(0, currentPage.indexOf('#'));
    }
    var navLinkSet = $('ul.navbar-nav li > a');
    var activated = false;
    navLinkSet.each(function() {
        if ($(this).attr('href') == currentPage) {
            $(this).parents('li').addClass('active');
            activated = true;
        }
    });
    if (activated == false) {
        currentPage = currentPage.substring(0, currentPage.lastIndexOf('/'));
        navLinkSet.each(function() {
            if ($(this).attr('href') == currentPage) {
                $(this).parents('li').addClass('active');
                activated = true;
            }
        });
    }
    /***********************************************************************************/
    $("#mobile-menu").mobileMenu({
        MenuWidth: 250,
        SlideSpeed : 300,
        WindowsMaxWidth : 767,
        PagePush : true,
        FromLeft : true,
        Overlay : true,
        CollapseMenu : true,
        ClassName : "mobile-menu"
    });
	/***********************************************************************************/
	if($(window).width()>769){
        $('.navbar .dropdown').hover(function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(200).slideDown('fast');

        }, function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp('fast');

        });

        $('.navbar .dropdown > a').click(function(){
            location.href = this.href;
        });

    }
    $(".article,.project").matchHeight({
        byRow: true,
        property: 'height',
        target: null,
        remove: false
    });
    $("article.product").matchHeight({
        byRow: true,
        property: 'height',
        target: null,
        remove: false
    });
    $('select').select2();
});
function menu () {
    $('.menu-open').click( function () {
        $('.menu-responsive').animate({left: '0px'}, 200);
        });
    $('.menu-close').click( function () {
        $('.menu-responsive').animate({left: '-250px'}, 200);
        });
    };  
$(document).ready(menu);
function main () {
    $('.icon-open').click( function () {
        $('.support-online').animate({right: '0px'}, 200);
        });
    $('.icon-close').click( function () {
        $('.support-online').animate({right: '-370px'}, 200);
        });
    };  
$(document).ready(main);
function _toastr(text,theme)
{
    $.jGrowl('<i class="fa fa-check fa-fw"></i>'+text, {
        theme : theme,
        position: 'under-right',
        appendTo: 'div.top-cart-info',
        life: 211500,
        closerTemplate:'<div>[ Xóa hết ]</div>'
    });
}
$(document).ready(function () {
    if ((window.location.pathname == "/dang-nhap.htm" || window.location.pathname == "/dang-ky.htm") && $(".ban_scroll .item").hide(), $("#SiteLeft").show(), $("#SiteRight").show(), c = ".ban_scroll .item", c.length > 0) {
        var r = 1e3,
            o = $("#SiteLeft .ban_scroll").width(),
            l = $("#SiteRight .ban_scroll").width(),
            a = ($(document).width() - r) / 2 + r,
            e = ($(document).width() - r) / 2 - o;
        $(window).scroll(function() {
            h()
        });
        $(window).resize(function() {
            h()
        });

        function h() {
            if ($(document.body).width() < r + o + l) {
                $(".ban_scroll").css("display", "none");
                return
            }
            $(".ban_scroll").css("display", "block");
            a = ($(document.body).width() - 0 - r) / 2 + r + 10;
            e = o == null ? ($(document.body).width() - 0 - r) / 2 - l - 10 : ($(document.body).width() - 0 - r) / 2 - o - 10;
            var f = 0,
                n = $(window).scrollTop(),
                u = window.location.pathname != "/" ? 213 : 460,
                t = 0,
                i = $(".footer").position().top - $(".ban_scroll").height() ;
            t = n < u ? u - n : n >= i ? 246 : 0;
            $("#SiteLeft .ban_scroll .item").length != 0 && (n >= i ? $("#SiteLeft .ban_scroll").css({
                position: "fixed",
                bottom: t,
                top: "",
                left: e
            }) : $("#SiteLeft .ban_scroll").css({
                position: "fixed",
                top: t,
                bottom: "",
                left: e
            }));
            $("#SiteRight .ban_scroll .item").length != 0 && (n >= i ? $("#SiteRight .ban_scroll").css({
                position: "fixed",
                bottom: t,
                top: "",
                right: e
            }) : $("#SiteRight .ban_scroll").css({
                position: "fixed",
                top: t,
                bottom: "",
                right: e
            }));
            f = n
        }
        h();
    }
});
function checkCookie() {
    var n = $.cookie("savedProductIds");
    n == null ? $("#boxProductSaved").hide() : hideBox()
}
function changeHtml() {
    $("#saveNews").text("Đã lưu").removeClass("save").addClass("saved").removeAttr("onclick")
}
function productSaved(n,t)
{
    var i = $.cookie("savedProductIds");
    i != null ? i.search(t) == -1 && $.cookie("savedProductIds", t + "," + i, {
        domain: domainCookie,
        path: "/",
        expires: 7
    }) : $.cookie("savedProductIds", t, {
        domain: domainCookie,
        path: "/",
        expires: 7
    });
    GetProductlist();
    $("#boxProductSaved").show();
}
function hideBox() {
    $.cookie("statusBox") == 0 && ($("#boxProductSaved ul").hide(), $("#boxProductSaved").css("bottom", "-10px"), $("#boxProductSaved #btn_close").removeClass().addClass("showAll"))
}
function openBox() {
    $("#boxProductSaved ul").show();
    var n = $("#boxProductSaved").css("bottom");
    n.replace("px", "") < -1 && $("#boxProductSaved").animate({
        bottom: "0"
    }, 200, function() {
        $("#boxProductSaved #btn_close").removeClass().addClass("hideAll")
    })
}
function deleteAllNews() {
    if (confirm("Bạn có chắc chắn muốn xóa tất cả ?")) {
        var n = $.cookie("savedProductIds");
        (n == null || n == "") && (n = "", $("#boxProductSaved li").each(function() {
            n += $(this).attr("pid") + ","
        }));
        //deleteListProductSaved(n);
        $.removeCookie("savedProductIds", {
            domain: domainCookie,
            path: "/"
        });
        $("#boxProductSaved").hide();
    }
}
function GetProductlist(){
    var listProductId = $.cookie("savedProductIds");
        html = "";
    listProductId != null ? ($("#boxProductSaved ul").html(html),$.ajax({
        type : "POST",
        async: true,
        url  : DIR_ROOT + "handler.htm",
        data: {
            productIds: listProductId, module : 'getProductList'
        },
        success:function(data)
        {
            $.each(JSON.parse(data), function(n, t) {
                html += '<li pid="' + t.id + '" ><i class="fa fa-circle fa-fw"></i><a href="'+DIR_ROOT + t.source_link + '">' + t.title + '<\/a><span title="Xóa" onclick="deleteProduct(this,' + t.id + ');"><\/span><\/li>'
            });
            $("#boxProductSaved ul").html(html);   
            
        }
    })) : '';
}
$(document).ready(function() {
    $("#btn_close").click(function() {
        var n = $("#boxProductSaved ul").height() + 15,
            t = $("#boxProductSaved").css("bottom");
        t == -n + "px" || t == "-10px" ? ($("#boxProductSaved ul").show(), $("#boxProductSaved #btn_close").removeClass().addClass("hideAll"), $("#boxProductSaved").animate({
            bottom: "0"
        }, 200, function() {
            $.cookie("statusBox", 1, {
                domain: domainCookie,
                path: "/",
                expires: 7
            })
        })) : $("#boxProductSaved").animate({
            bottom: -n
        }, 200, function() {
            $("#boxProductSaved #btn_close").removeClass().addClass("showAll");
            $.cookie("statusBox", 0, {
                domain: domainCookie,
                path: "/",
                expires: 7
            })
        })
    });
    $('#scroll').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
     $('#send_contact_consult').on('click',function(){
        var email_st = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var number = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        var url = $(this).attr('data-url');
        console.log(url);
        var apartment_id = $('#send_contact_consult').attr('data-apartment-id');
        var contact_id = $(this).attr('data-contact');
        var name = $('#name_consult').val();
        var phone = $('#phone_consult').val();
        var email = $('#email_consult').val();
        var content = $('#content_text_area_consult').val();
        var like_id = $('#hddlike_id').val();
        if(name==''){
            $('#name_consult').addClass('error_contact');
            $('#phone_consult').removeClass("error_contact");
            $('#email_consult').removeClass('error_contact');
            $('#content_text_area_consult').removeClass('error_contact');
            $('#name_consult').focus();
            $('.error_span').text('Chưa nhập Họ tên');
            return false;
        }else{
            $('#name_consult').removeClass('error_contact');
            $('.error_span').text('')
        }

        if(phone==''){
            $('#phone_consult').addClass('error_contact');
            $('#name_consult').removeClass('error_contact');
            $('#email_consult').removeClass('error_contact');
            $('#content_text_area_consult').removeClass('error_contact');
            $('.error_span').text('Chưa nhập Điện thoại');
            $('#phone_consult').focus();
            return false;
        }else{

            if(!number.test(phone)){
                $('#phone_consult').addClass('error_contact');
                $('#name_consult').removeClass('error_contact');
                $('#email_consult').removeClass('error_contact');
                $('#content_text_area_consult').removeClass('error_contact');
                $('#phone_consult').focus();
                $('.error_span').text('Số điện thoại chưa đúng');
                return false;
            }else{
                if(phone.charAt(0)!=0)
                {
                    $('#phone_consult').addClass('error_contact');
                    $('#name_consult').removeClass('error_contact');
                    $('#email_consult').removeClass('error_contact');
                    $('#content_text_area_consult').removeClass('error_contact');
                    $('.error_span').text('Số điện thoại chưa đúng');
                    $('#phone_consult').focus();
                    return false;
                }
                else{
                    if(phone.length < 10 || phone.length >11){
                        $('#phone_consult').addClass('error_contact');
                        $('#name_consult').removeClass('error_contact');
                        $('#email_consult').removeClass('error_contact');
                        $('#content_text_area_consult').removeClass('error_contact');
                        $('.error_span').text('Số điện thoại chưa đúng');
                        $('#phone_consult').focus();
                        return false;
                    }
                    else{
                        $('#phone_consult').removeClass("error");
                        $('.error_span').text('')
                        $('.div_error').hide();
                    }
                }
            }
            $('#phone_consult').removeClass('error_contact');
            $('.error_span').text('')
        }

        if(email==''){
            $('#email_consult').addClass('error_contact');
            $('#name_consult').removeClass('error_contact');
            $('#phone_consult').removeClass('error_contact');
            $('#content_text_area_consult').removeClass('error_contact');
            $('.error_span').text('Chưa nhập Email');
            return false;
        }else{
            if(!email_st.test(email)){
                $('#email_consult').addClass('error_contact');
                $('.error_span').text('Email không đúng');
                $('#name_consult').removeClass('error_contact');
                $('#phone_consult').removeClass('error_contact');
                $('#content_text_area_consult').removeClass('error_contact');
                $('#email_consult').focus();
                return false;
            }
            else{
                $('#email_consult').removeClass('error_contact');
                $('.error_span').text('');
            }
        }

        if(content==''){
            $('#content_text_area_consult').focus();
            $('#content_text_area_consult').addClass('error_contact');
            $('#name_consult').removeClass('error_contact');
            $('#phone_consult').removeClass('error_contact');
            $('#email_consult').removeClass('error_contact');
            $('.error_span').text('Chưa nhập nội dung liên hệ');
            return false;
        }else{
            $('#content_text_area_consult').removeClass('error_contact');
            $('.error_span').text('');
        }
        $.post( url,{
            name:name,
            apartment_id:apartment_id,
            phone:phone,
            email:email,
            content:content,
            contact_id: contact_id,
            like_id:like_id
        },
        function(response){
            if(response.status == 200){
                $('#name_consult').val('');
                $('#email_consult').val('');
                $('#phone_consult').val('');
                $('#content_text_area_consult').val('')
                $('.error_span').text('');
                setTimeout(function(){
                    $(".error_span").text('');
                },5000);
                $('#msg').html('<p class="alert alert-success">'+response.msg+'</p>');
            }else{
                $('#msg').html('<p class="alert alert-danger">'+response.msg+'</p>');
            }
            $('#fProject')[0].reset();
        },'json');
    });
})