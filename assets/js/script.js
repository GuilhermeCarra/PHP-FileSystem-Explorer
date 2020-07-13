var actualDir;

$("#root").data("path","My Files/").click(changeFolder);

function changeFolder() {
    actualDir = $(event.target).data("path");
    var dirMenu = $(event.target);

    // Verifies if the directory is open to create or not a list for inside folders
    if($(dirMenu).find("ul").length > 0){
        $(dirMenu).find("ul").empty();
    } else {
        $(dirMenu).append("<ul>");
    }

    // Request to PHP the folder's content
    $.get({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "showFolder", actualDir: actualDir}),
        success: function(php_script_response){
            // Clears main container to show actual folder's content
            $('#folder').empty();

            // Receives the response from PHP and parses the JSON
            var folderContent = php_script_response;
            var dirs = JSON.parse(folderContent)[0];
            var files = JSON.parse(folderContent)[1];
            var filesSize = JSON.parse(folderContent)[2];
            dirs = JSON.parse(dirs);
            files = JSON.parse(files);
            filesSize = JSON.parse(filesSize);
            console.log(php_script_response);

            // Appending folders to side menu folder navigation (<ul> created above)
            for (let i = 0; i < Object.keys(dirs).length; i++){
                let folder = $("<li><i class='fa fa-folder'></i>"+dirs[i]+"<li>");
                $(dirMenu).find("ul").append($(folder)
                    .data("path",actualDir+dirs[i]+"/"));
            }

            // Appending folders to main container
            for (let i = 0; i < Object.keys(dirs).length; i++){
                let folder = '<li>'+dirs[i]+'</li>'
                $('#folder').append($(folder)
                    .data("path",actualDir+dirs[i]+"/")
                    .click(changeFolder));
            }
            // Appending files to main container
            for (let i = 0; i < Object.keys(files).length; i++){
                let file = '<li>'+files[i]+'</li>"'
                $('#folder').append($(file)
                    .data("path",actualDir+files[i])
                    .click(fileClicked));
            }
        }
    });
}

function fileClicked() {
    console.log($(event.target).data("path"));
}
