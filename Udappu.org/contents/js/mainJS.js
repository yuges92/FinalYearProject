$(function() {
    submitForm();
    imagePreview();
    // addAdminForm();
    login();
    updatePassword();
    updateProfileForm();
    checkUsername();
    checkEmail();
});

function submitForm() {
    $('#registerForm').submit(function(event) {
        event.preventDefault();
        var cPass = $('#confirmPassword');
        var pass = $('#password');
        if (cPass.val() == pass.val()) {
            formData = $(this).serialize();
            $.ajax({
                url: '../Controller/register.php',
                type: 'POST',
                data: {
                    register: formData
                },
                success: function(response) {
                    if (response == 'success') {
                        alert('Successfuly registered. Please use your username and password to login');
                        $('#registerForm')[0].reset();

                        location.href = "../View/login.php";
                    } else {
                        alert('Please Enter Valid Details');
                    }
                }
            });
        } else {
            alert('The Password do not Match');
        }
    });
}

function imagePreview() {
    $('#file-input').on("change", previewImages);
}

function previewImages() {
    var $preview = $('#preview').empty();
    if (this.files) $.each(this.files, readAndPreview);

    function readAndPreview(i, file) {
        var reader = new FileReader();
        $(reader).on("load", function() {
            $preview.append($("<img/>", {
                src: this.result,
                height: 100
            }));
        });
        reader.readAsDataURL(file);
    }
}

function addAdminForm() {
    $('#formaddAdminForm').submit(function(event) {
        event.preventDefault();
        alert();
        formData = $(this).serialize();
        $.ajax({
            url: '../Controller/addAdminController.php',
            type: 'POST',
            data: {
                addAdmin: formData
            },
            success: function(response) {
                if (response == 'success') {
                    alert('Successfuly Added');
                    $('#formaddAdminForm')[0].reset();
                    location.href = '../View/manageUsers.php';
                } else {
                    alert('Please Enter Valid Details');
                }
            }
        });
    });
}

function login() {
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        $.ajax({
            url: '../Controller/login.php',
            type: 'POST',
            data: {
                login,
                username: username,
                password: password
            },
            success: function(response) {
                if (response == 'Member') {
                    location.href = '../index.php';
                } else if (response == 'Admin') {
                    location.href = '../View/manageUsers.php';
                } else {
                    $('#loginError').removeClass('hidden');
                    $('#loginError').show(1000);

                }
            }
        });
    });
}


function addHidden() {
    $('#loginError').hide(1000);
    //  $('#loginError').addClass('hidden');
}

function sendFriendRequest($id) {

    var friendID = $id;
    if ($('#friend' + friendID).text() == 'Add Friend') {
        $.ajax({
            url: '../Controller/friendRequestController.php',
            type: 'POST',
            data: {
                sendFriendRequest: friendID
            },
            success: function(response) {

                if (response == 'requested') {
                    $('#friend' + friendID).hide();
                    $('a[name="cancelFriendRequestBtn"]').removeAttr('hidden');
                    $('a[name="cancelFriendRequestBtn"]').addClass('btn btn-warning');


                } else if (response == 'logged in user') {
                    alert('You Can Not Send Friend Request To Yourself');
                } else {

                }
            }
        });
    }
}

function confirmFriendRequest($id) {
    var friendID = $id;
    $.ajax({
        url: '../Controller/friendRequestController.php',
        type: 'POST',
        data: {
            confirmFriendRequest: friendID
        },
        success: function(response) {
            if (response == 'confirmed') {
                window.location.reload(true);
            } else {}
        }
    });
}


function rejectFriendRequest($id) {
    var friendID = $id;
    $.ajax({
        url: '../Controller/friendRequestController.php',
        type: 'POST',
        data: {
            rejectFriendRequest: friendID
        },
        success: function(response) {
            if (response == 'rejected') {
                window.location.reload(true);
            } else {}
        }
    });
}


function unfriend($id) {
    var friendID = $id;
    $.ajax({
        url: '../Controller/friends.php',
        type: 'POST',
        data: {
            unfriend: friendID
        },
        success: function(response) {
            if (response == 'deleted') {
                window.location.reload(true);
            } else {
                alert(response);
            }
        }
    });
}

function cancelFriendRequest($id) {
    var friendID = $id;
    $.ajax({
        url: '../Controller/friends.php',
        type: 'POST',
        data: {
            cancelFriendRequest: friendID
        },
        success: function(response) {
            if (response == 'deleted') {
                window.location.reload(true);
            } else {
                alert(response);
            }
        }
    });
}


function submitComment(id) {
    var comment = $('textarea#comment' + id).val();
    $.ajax({
        url: '../Controller/commentsController.php',
        type: 'POST',
        data: {
            postID: id,
            postComment: comment,
        },
        success: function(response) {
            if (response == 'success') {
                $('textarea#comment' + id).val('');
                $('#commentsBody' + id).append('<div class=""><div class="col-sm-10 col-sm-offset-1"> You Commented:<div class="well row-fluid">' + comment + '</div></div></div>');
            } else {
                alert('failed');
            }

        }
    });

}



function sendMessage(id) {

    var message = $('textarea#message' + id);
    if ($.trim($(message).val())) {
        var messageContent = message.val();
        $.ajax({
            url: '../Controller/messageController.php',
            type: 'POST',
            data: {
                friendID: id,
                sendMessage: messageContent,
            },
            success: function(response) {
                if (response == 'success') {
                    $(message).val('');
                    $('#newMessage').modal('toggle');

                } else {
                    alert('failed');
                }

            }
        });
    } else {
        alert('Your Message is empty');
    }
}

function updatePassword() {
    $('#updatePasswordForm').submit(function(event) {
        event.preventDefault();
        var updatePassword = $(this).serialize();

        $.ajax({
            url: '../Controller/manageAllUsersController.php',
            type: 'POST',
            data: {
                updatePassword: updatePassword
            },
            success: function(response) {
                alert(response);
                $('#updatePasswordForm')[0].reset();
            }
        });
    });
}

function updateProfileForm() {
    $('#updateProfileForm').submit(function(event) {
        event.preventDefault();
        var updateProfile = $(this).serialize();

        $.ajax({
            url: '../Controller/profile.php',
            type: 'POST',
            data: {
                updateProfile: updateProfile
            },
            success: function(response) {
                alert(response);
            }
        });
    });
}

function deletePost(id) {
    var deletePost = id;
    var confirmBox = confirm("Are you sure you want to delete the post!");
    if (confirmBox) {
        $.ajax({
            url: '../Controller/deleteController.php',
            type: 'POST',
            data: {
                deletePost: deletePost
            },
            success: function(response) {
                alert(response);
                location.href = "../View/timeLine.php";
            }
        });
    }

}

function deleteAdminPost(id) {
    var deletePost = id;
    var confirmBox = confirm("Are you sure you want to delete the post!");
    if (confirmBox) {
        $.ajax({
            url: '../Controller/deleteController.php',
            type: 'POST',
            data: {
                deleteAdminPost: deletePost
            },
            success: function(response) {
                alert(response);
                location.href = "../View/manageContents.php";
            }
        });
    }

}

function deleteEvent(id) {
    var deleteEvent = id;
    var confirmBox = confirm("Are you sure you want to delete the Event!");
    if (confirmBox) {
        $.ajax({
            url: '../Controller/deleteController.php',
            type: 'POST',
            data: {
                deleteEvent: deleteEvent
            },
            success: function(response) {
                alert(response);
                location.href = "../View/manageContents.php";
            }
        });
    }

}


function deleteUser(id) {
    var deleteUser = id;
    var confirmBox = confirm("Are you sure you want to remove the User!");
    if (confirmBox) {
        $.ajax({
            url: '../Controller/deleteController.php',
            type: 'POST',
            data: {
                deleteUser: deleteUser
            },
            success: function(response) {
                alert(response);
                location.href = "../View/manageUsers.php";
            }
        });
    }
}

function updateMessageNotification(id) {

    var messageID = $('[name=message' + id + ']').val();
    $.ajax({
        url: '../Controller/messageController.php',
        type: 'POST',
        data: {
            updateMessageNotification: messageID
        },
        success: function(response) {
            if (response == 'success') {
                $('[name=messageBadge' + id + ']').addClass('hidden');
            }
        }
    });

}

function scrollToLastLine(id) {
    $('[name=messageContainer' + id + ']').animate({
        scrollTop: $('[name=lastLine' + id + ']').offset().top
    }, 'slow');
}

function checkUsername() {
    var usernameInput = $('#username');
    usernameInput.blur(function(event) {

        var username = $('#username').val();

        if (username.length < 5) {
            $('#usernameFeedOK').addClass('hidden');
            $('#usernameFeedNo').removeClass('hidden');
        } else {

            $.ajax({
                type: 'POST',
                url: '../Controller/register.php',
                data: {
                    checkUsername: username,
                },
                success: function(response) {
                    if (response == 'available') {
                        $('#usernameFeedOK').removeClass('hidden');
                        $('#usernameFeedNo').addClass('hidden');
                    } else {
                        $('#usernameFeedOK').addClass('hidden');
                        $('#usernameFeedNo').removeClass('hidden');
                    }
                }
            });
        }
    });
}

function checkEmail() {
    var emailInput = $('#email');
    emailInput.blur(function(event) {
        var email = emailInput.val();
        if (email.length < 5) {
            $('#emailFeedOK').addClass('hidden');
            $('#emailFeedNo').removeClass('hidden');
        } else {

            $.ajax({
                type: 'POST',
                url: '../Controller/register.php',
                data: {
                    emailCheck: email,
                },
                success: function(response) {
                    if (response == 'available') {
                        $('#emailFeedOK').removeClass('hidden');
                        $('#emailFeedNo').addClass('hidden');
                    } else {
                        $('#emailFeedOK').addClass('hidden');
                        $('#emailFeedNo').removeClass('hidden');
                    }
                }
            });
        }
    });
}

function showChangePasswordForm() {

}
