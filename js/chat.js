$(document).ready(function () {

    //$(".chatContainer").hide();

    $(".submit").click(function () {
        var username = $('#regusername').val();
        var password = $("#regpassword").val();

        if (username == '' || password == '')
        {
            alert('empty');
        } else {
            regUser(username, password);
        }
        return false;
    });

    function regUser(username, password) {
        if ($.trim(username).length != 0) {
            $.ajax({
                type: "POST",
                url: 'addUsername.php',
                data: {post: 'regsiter', username: username, password: password},
                dataType: 'json',
                success: function (data) {
                    if (data.success == false) {
                        alert(data.Exists);
                    } else {
                        $(".panel-login").hide(100);
                        $(".chatContainer").show(100);
                        $('.chatHeader').text('Welcome, ' + username + '!');
                    }
                }
            });
        }
    }


    $(".login-submit").click(function () {
        var username = $('#loginusername').val();
        var password = $("#loginpassword").val();

        if (username == '' || password == '')
        {
            alert('empty login');
        } else {
            loginUser(username, password);
        }
        return false;
    });

    function loginUser(username, password) {
        $.ajax({
            type: "POST",
            url: 'addUsername.php',
            data: {post: 'login', username: username, password: password},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.success == false) {
                    alert(data.Exists);
                } else {
                    $(".panel-login").hide(300);
                    //$(".chatContainer").css("display", "block");
                    $(".chatContainer").show(300);
                    $('.chatHeader').text('Welcome, ' + username + '!');
                }
            }
        });
    }

    // messages
    function throwMessage(message) {
        if ($.trim(message).length != 0) {
            $.ajax({
                type: "POST",
                url: 'addMessage.php',
                data: {message: message},
                success: function (data) {
                    fetchMessage();
                    addMessage.val('');
                }
            });
        }
    }

    addMessage = $('.addMessage');
    addMessage.bind('keydown', function (e) {
        if (e.keyCode === 13 && e.shiftKey === false) {
            throwMessage($(this).val());
            e.preventDefault();
        }
    });

    var Scroll = document.getElementById('chatMessage');
    Scroll.scrollTop = Scroll.scrollHeight;

    function fetchMessage() {
        $.ajax({
            type: "POST",
            url: 'showMessage.php',
            //dataType: 'json',
            success: function (data) {
                //$.each(data, function(key, val) {
                //$('.chatMessage').html('<p class=cm><b>'+ val.Username + ' </b>says:<br>' + val.Message + '</p>');
                $('.chatMessage').html(data);
                Scroll.scrollTop = Scroll.scrollHeight;
                //})
            }
        });
    }

    setInterval(function () {
        fetchMessage();
    }, 2000);
});
