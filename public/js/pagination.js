


var updatePaginationOnLoad = function () {
    var elems = $('.pagination').find('li').removeClass('active');
    var page = location.search.substr(1).slice(5);
    elems.find('li').eq(page).addClass('active')

};

updatePaginationOnLoad();
