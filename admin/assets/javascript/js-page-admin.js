// JavaScript
$(function() {
    $('#side-menu').metisMenu();
});
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});
$(document).ready(function() {
    // -----------------------------------------------------

    $(".nav-tabs a").click(function() {
        $(this).tab('show');
    });

    $(".tr-search").hide();
    $(".tr-title").show();
    $('.filterable .btn-search').click(function() {
        var $panel = $(this).parents('.filterable'),
            $search = $panel.find('.tr-search input'),
            $tbody = $panel.find('.table tbody');

        if ($search.prop('disabled') == true) {
            $(".tr-search").show();
            $(".tr-title").hide();
            $search.prop('disabled', false);
            $search.first().focus();
            if ($('#searchUser').hasClass('no-active')) {
                $('#searchUser').removeClass('no-active');
            }
            $('#searchUser').addClass('active');
        } else {
            $(".tr-search").hide();
            $(".tr-title").show();
            $search.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
            if ($('#searchUser').hasClass('active')) {
                $('#searchUser').removeClass('active');
            }
            $("#searchUser").addClass("no-active");
        }
    });

    $('.filterable .tr-search input').keyup(function(e) {
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.tr-search th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function() {
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.tr-search th').length + '">Không tìm thấy kết quả tương ứng</td></tr>'));
        }
    });
    //-----------------------------------------------------------------------
    $(".change-display").change(function() {
        id_category = $(this).val();
        if ($(this).is(":checked")) {
            display = 1;
        } else {
            display = 0;
        }
        $.ajax({
            type: "POST",
            url: "page/ajax-update-category.php",
            data: "id_category=" + id_category + "&display=" + display,
            success: function(html) {
                if (html == 1) {
                    $('#modalAjaxGood').modal('show');
                } else {
                    $('#modalAjaxFail').modal('show');
                    $(document).on('hide.bs.modal', '#modalAjaxFail', function() {
                        location.reload(true);
                    });
                }
            }
        });
        return false;
    });
    //-----------------------------------------------------------------------
    var colorList = ['#FFFFFF', '#DCDCDC', '#CFCFCF', '#BEBEBE', '#696969', '#363636', '#1C1C1C', '#000000',
        '#C6E2FF', '#9FB6CD', '#778899', '#6C7B8B', '#8DEEEE', '#79CDCD', '#528B8B', '#2F4F4F',
        '#FDF5E6', '#FFEFD5', '#FFE4B5', '#CD853F', '#A0522D', '#8B4513', '#B22222', '#8B1A1A',
        '#FFE1FF', '#EED2EE', '#CDB5CD', '#8B7B8B', '#AB82FF', '#8968CD', '#7D26CD', '#5D478B',
        '#DDA0DD', '#FFBBFF', '#8B668B', '#BF3EFF', '#B23AEE', '#68228B', '#C71585', '#8B008B',
        '#4169E1', '#27408B', '#0000EE', '#00008B', '#54FF9F', '#43CD80', '#98FB98', '#00FF00',
        '#EEC591', '#F5DEB3', '#FFA54F', '#FF8247', '#FF7F24', '#D2691E', '#8B4513', '#FF4500'
    ];
    var picker = $('#color-picker');

    for (var i = 0; i < colorList.length; i++) {
        picker.append('<li class="color-item" data-hex="' + colorList[i] + '" style="background-color:' + colorList[i] + ';"></li>');
    }

    // click de xuat hien bang mau
    $('#call-picker').click(function() {
        picker.fadeIn();
        var hex = $('#pickcolor').val();
        picker.children('li').click(function() {
            var codeHex = $(this).data('hex');
            if (hex) {
                $('#pickcolor').val(hex.concat(",", codeHex));
            } else {
                $('#pickcolor').val(codeHex);
            }
        });
    });
    // khi click vao bang mau, no se tu mat
    $('#color-picker').click(function() {
        picker.fadeOut();
    });

    //-----------------------------------------------------------------------
    $(".change-campaign").change(function() {
        id_product = $(this).val();
        if ($(this).is(":checked")) {
            is_campaign = 1;
        } else {
            is_campaign = 0;
        }
        $.ajax({
            type: "POST",
            url: "page/ajax-update-campaign.php",
            data: "id_product=" + id_product + "&is_campaign=" + is_campaign,
            success: function(html) {
                if (html == 1) {
                    $('#modalAjaxGood').modal('show');
                } else {
                    $('#modalAjaxFail').modal('show');
                    $(document).on('hide.bs.modal', '#modalAjaxFail', function() {
                        location.reload(true);
                    });
                }
            }
        });
        return false;
    });
    //-----------------------------------------------------------------------
    $(".change-banner").change(function() {
        id_banner = $(this).val();
        if ($(this).is(":checked")) {
            display = 1;
        } else {
            display = 0;
        }
        $.ajax({
            type: "POST",
            url: "page/ajax-update-banner.php",
            data: "id_banner=" + id_banner + "&display=" + display,
            success: function(html) {
                if (html == 1) {
                    $('#modalAjaxGood').modal('show');
                } else {
                    $('#modalAjaxFail').modal('show');
                    $(document).on('hide.bs.modal', '#modalAjaxFail', function() {
                        location.reload(true);
                    });
                }
            }
        });
        return false;
    });

    //-----------------------------------------------------------------------
    $(".opt_status").change(function() {
        id_bill = $(this).val();
    });

    //---------------------------Clear fied--------------------------------------------
    $("#btnClear").click(function() {
        $("input[type=text], textarea, input[type='password'], input[type='number']").val('');
    });

    $(".required").blur(function() {
        var text = $(this).val();
        if (!text) {
            $(".required").addClass("error");
        }
    });

    $(".required-next-1").blur(function() {
        var text = $(this).val();
        if (!text) {
            $(".required-next-1").addClass("error");
        }
    });

    $(".required-next-2").blur(function() {
        var text = $(this).val();
        if (!text) {
            $(".required-next-2").addClass("error");
        }
    });

    $(".required-next-3").blur(function() {
        var text = $(this).val();
        if (!text) {
            $(".required-next-3").addClass("error");
        }
    });

    $(".required-next-4").blur(function() {
        var text = $(this).val();
        if (!text) {
            $(".required-next-4").addClass("error");
        }
    });

    $(".required-next-5").blur(function() {
        var text = $(this).val();
        if (!text) {
            $(".required-next-5").addClass("error");
        }
    });

    $(".required").focus(function() {
        if ($(".required").hasClass('error')) {
            $(".required").removeClass("error");
        }
    });

    $(".required-next-1").focus(function() {
        if ($(".required-next-1").hasClass('error')) {
            $(".required-next-1").removeClass("error");
        }
    });

    $(".required-next-2").focus(function() {
        if ($(".required-next-2").hasClass('error')) {
            $(".required-next-2").removeClass("error");
        }
    });

    $(".required-next-3").focus(function() {
        if ($(".required-next-3").hasClass('error')) {
            $(".required-next-3").removeClass("error");
        }
    });

    $(".required-next-4").focus(function() {
        if ($(".required-next-4").hasClass('error')) {
            $(".required-next-4").removeClass("error");
        }
    });

    $(".required-next-5").focus(function() {
        if ($(".required-next-5").hasClass('error')) {
            $(".required-next-5").removeClass("error");
        }
    });
});

function getAge(value) {
    if (value == 0) {
        $("#optionAge").html("")
    } else {
        $.ajax({
            type: "POST",
            url: "page/ajax-get-age.php",
            data: "id_object=" + value,
            success: function(html) {
                if (html) {
                    $("#optionAge").html(html)
                }
            }
        });
    }

    return false;
}

function changeStatus(id, value) {
    $.ajax({
        type: "POST",
        url: "page/ajax-update-bill.php",
        data: "id=" + id + "&value=" + value,
        success: function(html) {
            if (html == 1) {
                $('#modalAjaxGood').modal('show');
            } else {
                $('#modalAjaxFail').modal('show');
                $(document).on('hide.bs.modal', '#modalAjaxFail', function() {
                    location.reload(true);
                });
            }
        }
    });
    return false;
}