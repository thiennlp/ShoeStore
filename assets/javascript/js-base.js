// JavaScript


//carousel slider
$(document).ready(function() {
    //dropdown menu
    $(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideDown("400");
            $(this).toggleClass('open');
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideUp("400");
            $(this).toggleClass('open');
        }
    );
    $('#Carousel').carousel({
        interval: 5000
    });
    $('#beCarousel').carousel({
        interval: 5000
    });
    $('#saCarousel').carousel({
        interval: 5000
    });
    $('#reCarousel').carousel({
        interval: 5000
    });
});
$(document).ready(function() {

    //-----------------------------------------------------------------------
    var colorList = ['#000000', '#993300', '#333300', '#003300', '#003366', '#000066', '#333399', '#333333',
        '#660000', '#FF6633', '#666633', '#336633', '#336666', '#0066FF', '#666699', '#666666',
        '#CC3333', '#FF9933', '#99CC33', '#669966', '#66CCCC', '#3366FF', '#663366', '#999999',
        '#CC66FF', '#FFCC33', '#FFFF66', '#99FF66', '#99CCCC', '#66CCFF', '#993366', '#CCCCCC',
        '#FF99CC', '#FFCC99', '#FFFF99', '#CCffCC', '#CCFFff', '#99CCFF', '#CC99FF', '#FFFFFF',
        '#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#00FFFF', '#FF00FF', '#C0C0C0', '#FF6600'
    ];
    var picker = $('#color-picker');

    for (var i = 0; i < colorList.length; i++) {
        picker.append('<li class="color-item" data-hex="' + colorList[i] + '" style="background-color:' + colorList[i] + ';"></li>');
    }

    // click de xuat hien bang mau
    $('#modal-color-picker').click(function() {
        picker.fadeIn();
        picker.children('li').hover(function() {
            var codeHex = $(this).data('hex');
            $('#modal-color-picker').val(codeHex);
        });
    });
    // khi click vao bang mau, no se tu mat
    $('#color-picker').click(function() {
        picker.fadeOut();
    });
    // khi click search
    $('#btn-on-search').click(function() {
        parent.location = "/search-" + document.getElementById('input-search').value + "/1";
    });
    // show modal checkout
    $('#btn-checkout').click(function() {
        $('#modal-checkout').modal('show');
    });
    // show modal report
    $('#btn-to-login').click(function() {
        $('#modal-report').modal('show');
    });
    $('#btn-cant-checkout').click(function() {
        $('#modal-report').modal('show');
    });
    $('[data-toggle="tooltip"]').tooltip();
});
//-------------- key Enter search ------------
function onSearch(e) {
    if (e.keyCode == 13) {
        var valSearch = $('#input-search').val();
        if (valSearch) {
            parent.location = "/search-" + valSearch + "/1";
        }
    }
}

//-------------- set value color ------------
function selectColor(color) {
    $('#selected-color').val(color);
    $(".error-color").text("");
}
//-------------- button back to top ------------

window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("back-top").style.display = "block";
    } else {
        document.getElementById("back-top").style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function onClear() {
    $('#options-size select[name=option-size]').prop('selectedIndex', 0);
    $('#options-size select[name=option-price]').prop('selectedIndex', 0);
    $('#options-size select[name=option-object]').prop('selectedIndex', 0);
    $('#options-size input[name=option-color]').val('');
}