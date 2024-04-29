$(document).ready(function () {
    $('.user-follow').click(function () {
        var $button = $(this);

        var elementId = $button.attr('id');
        var userId = elementId.split('-')[1];

        $.ajax({
            url: '/user-follow',
            type: 'POST',
            data: {userIdToFollow: userId},
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.action === 'follow') {
                    $button.removeClass('button-secondary').addClass('button-success');
                    $button.find('span.fa-user-plus').removeClass('fa-user-plus').addClass('fa-check');
                } else {
                    $button.removeClass('button-success').addClass('button-secondary');
                    $button.find('span.fa-check').removeClass('fa-check').addClass('fa-user-plus');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error', status, error);
            }
        });
    });
});
