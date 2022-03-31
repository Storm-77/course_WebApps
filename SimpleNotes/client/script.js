function RemoveNote(Id, uiElem) {

    console.log(Id);

    $.ajax({
        type: "post",
        url: "api/removeNote.php",
        data: {
            id: Id

        },
        success: function(response) {
            document.removeChild(uiElem);
        }
    });
}

function GetNoteDom({
    Content,
    Title,
    Id,
    Date
}) {
    let note = document.createElement("div");
    note.classList.add("column");

    note.innerHTML = `
        <h2 class="ui header">${Title}</h2>
        <h6 class="ui">${Date}</h6>
        <p> ${Content}</p>
        <button class="ui tiny button m-top-10">Delete &raquo;</button>
    `;

    return note;
}

$(document).ready(function() {

    $("#loginBtn").click(function(e) {

        // if ($('#login').val() && sessionStorage.length == 0) {
        if ($('#login').val()) {

            $.ajax({
                type: "post",
                url: "api/login.php",
                data: {
                    login: $("#login").val(),
                    passwd: $("#password").val()
                },
                success: function(response) {
                    let json = JSON.parse(response);
                    console.log(json);
                    let userId = json.UserId;
                    // sessionStorage.setItem("UserId", userId);

                    $.ajax({
                        type: "post",
                        url: "api/getNotes.php",
                        data: {
                            userId: userId
                        },
                        success: function(response) {
                            let notes = JSON.parse(response).notes;
                            notes.forEach(element => {
                                let el = $(GetNoteDom(element)).hide();
                                $("#notes").append(el);
                                el.show("slow");
                                console.log(element);
                            });
                        }
                    });
                }
            });
        }
    });
});