$(document).ready(function() {
    // Xác định trang hiện tại
    //var currentPage = $(location).attr('pathname');
    var currentPage = $(location).attr('href');
    if (currentPage.indexOf('?') != -1) {
        currentPage = currentPage.substring(0, currentPage.indexOf('?'));
    }
    if (currentPage.indexOf('#') != -1) {
        currentPage = currentPage.substring(0, currentPage.indexOf('#'));
    }
    //if (currentPage == '') {currentPage = 'index.php'}
    
    // Kích hoạt thẻ li của trang hiện tại
    var navLinkSet = $('ul.navigation li>a');
    var activated = false; // Chưa xác định được thẻ li của trang hiện tại
    navLinkSet.each(function() {
        if ($(this).attr('href') == currentPage) {
            $(this).parent().addClass('active');
            activated = true; // Đã kích hoạt thẻ li của trang hiện tại
        }
    });
    // Nếu vẫn chưa được
    /*
    if (activated == false) {
        navLinkSet.each(function() {
            if (currentPage.indexOf($(this).attr('href')) != -1 && $(this).attr('href') != 'index.php?module=admin') {
                $(this).parent().addClass('active');
            }
        });
    }*/
    
    // Mở rộng nhánh cha của li hiện tại
    var currentNav = $('ul.navigation li.active').parents('ul.navigation li');
    currentNav.addClass('active');
    var currentNavLink = currentNav.children('a');
    var currentNavLinkLevel = currentNavLink.attr('level');
    currentNavLink.attr('id', currentNavLinkLevel);

});