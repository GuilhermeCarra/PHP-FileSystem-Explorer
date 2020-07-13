var actualDir;

$("#root").data("path","My Files/").click(changeFolder);

function changeFolder() {
    actualDir = $(event.target).data("path");
    $.get({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "showFolder", actualDir: actualDir}),
        success: function(php_script_response){
            console.log(php_script_response);
            $('#folder').empty();
            var folderContent = php_script_response;
            var dirs = JSON.parse(folderContent)[0];
            var files = JSON.parse(folderContent)[1];
            files = JSON.parse(files);
            dirs = JSON.parse(dirs);
            for (let i = 0; i < Object.keys(dirs).length; i++){
                let folder = '<li>'+dirs[i]+'</li>"'
                $('#folder').append($(folder)
                    .data("path",actualDir+dirs[i]+"/")
                    .click(changeFolder));
            }
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
