var tempMessageId = 0;
const messageForm = $(".message-form"),
    messageInput = $(".message-input"),
    messageBoxContainer = $(".wsus__chat_area_body"),
    csrf_token = $("meta[name='csrf-token']").attr("content");

const getMessageId = () => $("meta[name='id']").attr("content");
const setMessageId = (id) => $("meta[name='id']").attr("content", id);

function imagePreview(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(selector).attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function enableChatBox() {
    $(".wsus__message_paceholder").removeClass("d-none");
}

function disableChatBox() {
    $(".wsus__message_paceholder").addClass("d-none");
}

let searchPage = 1;
let noMoreDataSearch = false;
let searchTempVal = "";
let setSearchLoading = false;
function searchUsers(query) {
    if (query != searchTempVal) {
        searchPage = 1;
        noMoreDataSearch = false;
    }
    searchTempVal = query;

    if (!setSearchLoading && !noMoreDataSearch) {
        $.ajax({
            method: "GET",
            url: "/messenger/search",
            data: { query: query, page: searchPage },
            beforeSend: function () {
                setSearchLoading = true;
                let loadar = `<div class="text-center search-loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`;
                $(".user_search_list_result").append(loadar);
            },
            success: function (data) {
                setSearchLoading = false;
                $(".user_search_list_result").find(".search-loader").remove();
                if (searchPage < 2) {
                    $(".user_search_list_result").html(data.records);
                } else {
                    $(".user_search_list_result").append(data.records);
                }
                noMoreDataSearch = searchPage >= data?.last_page;
                if (!noMoreDataSearch) searchPage += 1;
            },
            error: function (xhr, status, error) {
                setSearchLoading = false;
            },
        });
    }
}

function debounce(callback, delay) {
    let timerId;
    return function (...args) {
        clearTimeout(timerId);
        timerId = setTimeout(() => {
            callback.apply(this, args);
        }, delay);
    };
}

function actionOnScroll(selector, callback, topScroll = false) {
    $(selector).on("scroll", function () {
        let element = $(this).get(0);
        const condition = topScroll
            ? element.scrollTop == 0
            : element.scrollTop + element.clientHeight >= element.scrollHeight;

        if (condition) {
            callback();
        }
    });
}

function getIdInfo(id) {
    $.ajax({
        method: "GET",
        url: "/get-user",
        data: { id: id },
        beforeSend: function () {
            nProgress.start();
            enableChatBox();
        },
        success: function (data) {
            $(".message-header").find("img").attr("src", data.avatar);
            $(".message-header").find("h4").text(data.name);
            $(".message-info-view").find(".user_name").text(data.name);
            $(".message-info-view")
                .find(".user_photo img")
                .attr("src", data.avatar);
            $(".message-info-view")
                .find(".unique_user_name")
                .text(data.user_name);
            disableChatBox();
            nProgress.done();
        },
        error: function (xhr, status, error) {
            disableChatBox();
        },
    });
}

function sendMessage() {
    tempMessageId += 1;
    let tempID = `temp_${tempMessageId}`;
    const inputValue = messageInput.val();
    if (inputValue.length > 0) {
        const formData = new FormData(messageForm[0]);
        formData.append("message", inputValue);
        formData.append("id", getMessageId());
        formData.append("temporaryMsgId", tempID);
        formData.append("_token", csrf_token);
        $.ajax({
            method: "POST",
            url: "/send-message",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function () {
                messageBoxContainer.append(
                    sendTempMessageCard(tempID, inputValue)
                );
                messageForm.trigger("reset");
                $(".emojionearea-editor").text("");
            },
            success: function (data) {
                const tempMessageCardElement = messageBoxContainer.find(
                    `.message-card[data-id="${tempID}"]`
                );
                tempMessageCardElement.before(data.message);
                tempMessageCardElement.remove();
            },
            error: function (xhr, status, error) {},
        });
    }
}

function sendTempMessageCard(tempId, message) {
    return `
   <div class="wsus__single_chat_area message-card" data-id="${tempId}">
      <div class="wsus__single_chat chat_right">
         <p class="messages">${message}</p>
         <span class="clock"><i class="fas fa-clock"></i>Now</span>
         <a class="action" href="#"><i class="fas fa-trash"></i></a>
      </div>
   </div>`;
}

function messageFormReset() {
    $(".attachment-block").addClass("d-none");
    messageForm.trigger("reset");
    $(".emojionearea-editor").text("");
}

//  ON DOM LOAD
$(document).ready(function () {
    $("#select_file").change(function () {
        imagePreview(this, ".profile-image-preview");
    });

    const debounceSearch = debounce(function () {
        const value = $(".user_search").val();
        searchUsers(value);
    }, 500);

    $(".user_search").on("keyup", function () {
        let query = $(this).val();
        if (query.length > 0) debounceSearch();
    });

    //search pagination
    actionOnScroll(".user_search_list_result", function () {
        let value = $(".user_search").val();
        searchUsers(value);
    });

    $("body").on("click", ".messenger-item-list", function () {
        const dataId = $(this).data("id");
        setMessageId(dataId);
        getIdInfo(dataId);
    });

    messageForm.on("submit", function (e) {
        e.preventDefault();
        sendMessage();
    });

    //send attachment
    $(".attachment-input").on("change", function () {
        imagePreview(this, ".attachment-preview");
        $(".attachment-block").removeClass("d-none");
    });

    $(".cancel-attachment").on("click", function () {
        messageFormReset();
    });
});
