var actualDir = "My Files/";

$("#root").data("path","My Files/").click(changeFolder);

function getFolderContent() {
    // Request to PHP the folder's content
    return $.get({
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
            .dblclick(changeFolder));
    }
    // Appending files to main container
    for (let i = 0; i < Object.keys(content[1]).length; i++){
        let file = $('<li class="media"></li>')
        let img = '<img src="assets/img/file.png" class="mr-3 ml-1 mt-2 mb-1" height="50px" width="50px">'
        let div = '<div class="media-body"><h5 class="mt-0 mb-1 mt-3">'+files[i]+'<span class="float-right">'+filesSize[i]+'</span></h5></div>'
        $(file).append(img,div);
        $('#folder').append($(file)
            .data("path",actualDir+files[i])
            .click(fileClicked));
    }
}

function updateFoldersTree(dirs) {
    // Verifies if the directory is open on Folder's tree explorer to create a <UL>
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

function fileClicked() {
    console.log($(event.target).data("path"));
}

function changeFolder() {
    // Gets the clicked folder on Folder's tree explorer
    var dirMenu = $(event.target);

    // Verifies if the clicked folder is the actual
    if($(event.target).hasClass("active")) {
        $(dirMenu).find("ul").empty();
        $(".active").removeClass("active");
    } else {
        $(".active").removeClass("active");
        $(event.target).addClass("active");
        actualDir = $(event.target).data("path");

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
    $.get({
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

// Right click menu
window.addEventListener("contextmenu",function(event){
    event.preventDefault();
    var contextElement = document.getElementById("rightclick-menu");
    contextElement.style.top = event.offsetY + "px";
    contextElement.style.left = event.offsetX + "px";
    contextElement.classList.add("menu-active");
});
window.addEventListener("click",function(){
    document.getElementById("rightclick-menu").classList.remove("menu-active");
});





