/**
 * Created by root on 02/02/17.
 */

(function () {

    console.log(123);
    $('.pagination').on('click', function (e) {
        e.preventDefault();
        var elems = $(this).find('li').removeClass('active');
        var page = location.search.substr(1).slice(5);
        var elem = $(e.target);
        elem.parent().addClass('active');
        location.href = elem.attr('href');
    });

})();