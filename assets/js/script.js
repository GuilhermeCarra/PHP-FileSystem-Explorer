Array.prototype.forEach.call(
    document.querySelectorAll(".file-upload__button"),
    function(button) {
    const hiddenInput = button.parentElement.querySelector(
        ".file-upload__input"
    );
    const label = button.parentElement.querySelector(".file-upload__label");
    const defaultLabelText = "No file(s) selected";

    // Set default text for label
    label.textContent = defaultLabelText;
    label.title = defaultLabelText;

    button.addEventListener("click", function() {
        hiddenInput.click();
    });

    hiddenInput.addEventListener("change", function() {
        const filenameList = Array.prototype.map.call(hiddenInput.files, function(
        file
        ) {
        return file.name;
        });

        label.textContent = filenameList.join(", ") || defaultLabelText;
        label.title = label.textContent;
    });
    }
);

document.getElementById("logofile").addEventListener("click",function(){
    location.reload();
});



  // TIME TO FINISH
/* Timer to finish 
setTimeout(fade_out, 5000);

 function fade_out() {
  $(".file-upload__label").fadeOut().empty();
} */ 

// Right click menu
function rightclick(event){
    // Getting data-path from li to know which file was clicked
    if ($(event.target).is("li")) {
        var file = $(event.target).data("path");
        $(event.target).addClass("active-file");
    } else {
        var file = $(event.target).closest("li").data("path");
        $(event.target).closest("li").addClass("active-file");
    }

    event.preventDefault();

    // Passing file path to menu
    $("#rightclick-menu").data("path",file);

    // Applying styles to show right click menu
    var contextElement = document.getElementById("rightclick-menu");
    contextElement.style.top = event.clientY + "px";
    contextElement.style.left = event.clientX + "px";
    contextElement.classList.add("menu-active");
};
window.addEventListener("click",function(){
    $(".active-file").removeClass("active-file");
    document.getElementById("rightclick-menu").classList.remove("menu-active");
});

var actualDir = "Root/";

$("#root").data("path","Root/").click(changeFolder);

function getFolderContent() {
    // Request to PHP the folder's content
    return $.post({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "showFolder", actualDir: actualDir}),
    });
}

function parseContent(folderContent) {
    var dirs = JSON.parse(folderContent)[0];
    var files = JSON.parse(folderContent)[1];
    var filesSize = JSON.parse(folderContent)[2];
    dirs = JSON.parse(dirs);
    files = JSON.parse(files);
    filesSize = JSON.parse(filesSize);
    var content = [dirs,files,filesSize];
    return content;
}

function updateScreen(content) {
    var dirs = content[0];
    var files = content[1];
    var filesSize = content[2];
    // Clears main container to show actual folder's content
    $('#folder').empty();

    // Appending folders to main container
    for (let i = 0; i < Object.keys(content[0]).length; i++){
        let folder = $('<li class="media"></li>')
        let img = '<img src="assets/img/folder.png" class="mr-3 ml-1 mt-2 mb-1" height="50px" width="50px">'
        let div = '<div class="media-body"><h5 class="mt-0 mb-1 mt-3">'+dirs[i]+'</h5></div>'
        $(folder).append(img,div);
        $('#folder').append($(folder)
            .data("path",actualDir+dirs[i]+"/")
            .dblclick(changeFolder)
            .contextmenu(rightclick));
    }
    // Appending files to main container
    for (let i = 0; i < Object.keys(content[1]).length; i++){
        let ext = files[i].split('.')[1];
        let file = $('<li class="media"></li>');
        let img = $('<img src="assets/img/'+ext+'.png" class="mr-3 ml-1 mt-2 mb-1" height="50px" width="50px">');
        let div = '<div class="media-body"><h5 class="mt-0 mb-1 mt-3">'+files[i]+'<span class="float-right">'+filesSize[i]+'</span></h5></div>';
        $(file,img,div).data("path",actualDir+files[i]);

        $(file).append(img,div);
        $('#folder').append($(file)
            .data("path",actualDir+files[i])
            .click(fileClicked)
            .contextmenu(rightclick));
    }
}

function updateFoldersTree(dirs) {
    // Verifies if the folder was changed by main container of files (not folders tree)
    if($(".active").hasClass("media")) {
        var path = $(".active").data("path");
        $(".active").removeClass(".active");
        $("#root li").each(function(_, li) {
            if($(li).data("path") == path) {
                $(li).addClass("active");
            }
        });
    }

    // Verifies if the directory is open on Folder's tree explorer to create a <UL> (or not)
    if($(".active").find("ul").length > 0){
        $(".active").find("ul").empty();
    } else {
        $(".active").append("<ul>");
    }

    // Appending folders to side menu folder navigation (<ul> created above)
    for (let i = 0; i < Object.keys(dirs).length; i++){
        let folder = $("<li><i class='fa fa-folder'></i>"+dirs[i]+"</li>");
        $(".active").find("ul").append($(folder)
            .data("path",actualDir+dirs[i]+"/"));
    }
}

function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

// Show "Trash" files
$("#delete").data("path","Trash/");
$("#delete").click(function(){
    changeFolder(event);
});

function fileClicked() {
    if ($(event.target).is("li")) {
        var file = $(event.target).data("path");
        var fileLI = $(event.target);
    } else {
        var file = $(event.target).closest("li").data("path");
        var fileLI = $(event.target).closest("li");
    }
    var extension = getExtension(file);
    var icon = $(fileLI).find("img").attr("src");
    $('#details-preview').empty();
    $('#details-preview').addClass("d-none");
    $.post({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "viewFile", file: file}),
        success: function(response) {
            var fileInfo = JSON.parse(response);
            $('#detail-icon').attr('src',icon);
            $('#detail-name').text(fileInfo['name']);
            $('#detail-type').text(fileInfo['type']);
            $('#detail-size').text(fileInfo['size']);
            $('#detail-mod').text(fileInfo['modified']);
            $('#detail-creat').text(fileInfo['created']);
            $('#details-file').removeClass("d-none");
            if (extension == 'mp3' || extension == 'wav' || extension == 'wma' || extension == 'm4a') {
                $('#details-preview').removeClass("d-none");
                let audio = '<audio controls class="col"><source src="'+file+'"></audio>'
                $('#details-preview').append(audio);
            }
            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'gif' || extension == 'svg') {
                $('#details-preview').removeClass("d-none");
                let img = '<img class="img-thumbnail" src="'+file+'">';
                $('#details-preview').append(img);
            }
            if (extension == 'mp4' || extension == 'avi' || extension == 'wmv' || extension == 'mov' || extension == 'mpg') {
                $('#details-preview').removeClass("d-none");
                let video = '<video controls class="img-thumbnail"><source src="'+file+'"></video>'
                $('#details-preview').append(video);
            }
        }
    });

}

function changeFolder() {
    // Gets the clicked folder on Folder's tree explorer
    if ($(event.target).is("li")){
        var dirMenu = $(event.target);
    } else {
        var dirMenu = $(event.target).closest("li");
    }

    // Verifies if the clicked folder is the actual
    if($(dirMenu).hasClass("active")) {
        $(dirMenu).find("ul").empty();
        $(".active").removeClass("active");
    } else {
        $(".active").removeClass("active");
        $(dirMenu).addClass("active");
        actualDir = dirMenu.data("path");

        // Gets new folder contents
        $.when(getFolderContent()).then(function(JSONcontent) {
            content = parseContent(JSONcontent);
            var dirs = content[0];

            // Updates Folder's tree (left side menu navigation)
            updateFoldersTree(dirs);

            // Updates main container with new folder's content
            updateScreen(content);
        });
    }
}

function newFolder(name) {
    $.post({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "newFolder", actualDir: actualDir, folderName: name}),
        success: function() {
            // Before folder creation on PHP update screen to show the new folder
            $.when(getFolderContent()).then(function(JSONcontent) {
                content = parseContent(JSONcontent);
                var dirs = content[0];
                updateFoldersTree(dirs);
                updateScreen(content);
            });
        }
    });
}

$("#newFolderModalBtn").click(function(){
    $('#fname').val("");
});

$("#createFolderBtn").click(function(){
    let name = $('#fname').val();
    newFolder(name);
    $('#newfolderModal').modal('hide');
});

// Remove function
$("#rightClickRemove").click(removeFile);
function removeFile() {
    var file = $("#rightclick-menu").data("path");
    $.post({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "removeFile", name: file}),
        success: function() {
            // After file elimination on PHP update screen to show modifications
            $.when(getFolderContent()).then(function(JSONcontent) {
                content = parseContent(JSONcontent);
                var dirs = content[0];
                updateFoldersTree(dirs);
                updateScreen(content);
            });
        }
    });
}

// Rename function
$("#rightClickRename").click(function() {
    var file = $("#rightclick-menu").data("path");
    if (file.includes(".")) {
        var filename = file.replace(/^.*[\\\/]/, '')
    } else {
        var filename = file.split("/");
        filename = filename[filename.length-2];
    }
    $("#oldNameRenameModal").text(filename);
    $("#fnewname").val("");
    $('#renameFileModal').modal('show');
});

$("#renameFileBtn").click(function() {
    var newName = $("#fnewname").val();
    if (newName.length > 0 && newName.trim().length > 0) {
        newName = newName.trim();
        renameFile(newName);
    }
});

function renameFile(newName) {
    var file = $("#rightclick-menu").data("path");
    $.post({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "renameFile", name: file, newName: newName}),
        success: function() {
            // After file rename on PHP update screen to show modifications
            $.when(getFolderContent()).then(function(JSONcontent) {
                content = parseContent(JSONcontent);
                var dirs = content[0];
                updateFoldersTree(dirs);
                updateScreen(content);
                $('#renameFileModal').modal('hide');
            });
        }
    });
}

// Cut + Paste file
$("#rightClickCut").click(function(){
    var file = $("#rightclick-menu").data("path");
    $.post({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "cutFile", name: file}),
        success: function() {
            // After file cut on PHP update screen to show modifications
            $.when(getFolderContent()).then(function(JSONcontent) {
                content = parseContent(JSONcontent);
                var dirs = content[0];
                updateFoldersTree(dirs);
                updateScreen(content);
                $("#rightClickCut").addClass("d-none");
                $("#rightClickPaste").removeClass("d-none");
            });
        }
    });
});

$("#rightClickPaste").click(function(){
    var file = $("#rightclick-menu").data("path");
    $.post({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "pasteFile", name: file}),
        success: function() {
            // After file paste on PHP update screen to show modifications
            $.when(getFolderContent()).then(function(JSONcontent) {
                content = parseContent(JSONcontent);
                var dirs = content[0];
                updateFoldersTree(dirs);
                updateScreen(content);
                $("#rightClickPaste").addClass("d-none");
                $("#rightClickCut").removeClass("d-none");
            });
        }
    });
});

// Search bar function
$("#search-bar").keypress(function(){
    var searchedWord = $("#search-bar").val().trimStart().trimEnd();
    if(event.keyCode == '13'){
        if(searchedWord.length > 0) {
            $.post({
                type: 'POST',
                url: 'filesFunctions.php',
                data: ({operation: "search", searchWord: searchedWord}),
                success: function(JSONcontent) {
                    $("#search-bar").val("");
                    // After file search on PHP update screen to results

                    // Parsing and divide JSON Content by file category
                    var content = parseContent(JSONcontent)
                    var folders = content[0];
                    var files = content[1];
                    var filesSize = content[2];

                    $('#folder').empty();

                    // Printing search results
                    if (folders.length > 0) {
                        for (let i = 0; i < folders.length; i++) {
                            let name = folders[i].split('/');
                            name = name[name.length-2];
                            let folder = $('<li class="media"></li>')
                            let img = '<img src="assets/img/folder.png" class="mr-3 ml-1 mt-2 mb-1" height="50px" width="50px">'
                            let div = '<div class="media-body"><h5 class="mt-0 mb-1 mt-3">'+name+'</h5></div>'
                            $(folder).append(img,div);
                            $('#folder').append($(folder)
                                .data("path",folders[i]+"/")
                                .dblclick(changeFolder)
                                .contextmenu(rightclick));
                        }
                    }
                    if (files.length > 0) {
                        for (let i = 0; i < files.length; i++) {
                            let ext = files[i].split('.')[1];
                            let name = files[i].split('/');
                            name = name[name.length-1];
                            let file = $('<li class="media"></li>');
                            let img = $('<img src="assets/img/'+ext+'.png" class="mr-3 ml-1 mt-2 mb-1" height="50px" width="50px">');
                            let div = '<div class="media-body"><h5 class="mt-0 mb-1 mt-3">'+name+'<span class="float-right">'+filesSize[i]+'</span></h5></div>';
                            $(file,img,div).data("path",files[i]);

                            $(file).append(img,div);
                            $('#folder').append($(file)
                                .data("path",files[i])
                                .click(fileClicked)
                                .contextmenu(rightclick));
                        }
                    }
                }
            });
        }
    }
});

